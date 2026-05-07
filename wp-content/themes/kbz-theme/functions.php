<?php
define('TMP_DIR',get_stylesheet_directory_uri().'/assets');
define('TMP_IMG',TMP_DIR . '/img');

// function theme_enqueue_styles() {
// 	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css');
// }
// add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/* **************************************************************************************************** */
// Load Public Scripts
/* **************************************************************************************************** */
require_once get_template_directory() . '/functions/wp_enqueue.php';

//スマホとタブレット判別
function is_mobile() {
    $useragents = array(
        'iPhone',          // iPhone
        'iPod',            // iPod touch
        '^(?=.*Android)(?=.*Mobile)', // 1.5+ Android
        'dream',           // Pre 1.5 Android
        'CUPCAKE',         // 1.5+ Android
        'blackberry9500',  // Storm
        'blackberry9530',  // Storm
        'blackberry9520',  // Storm v2
        'blackberry9550',  // Storm v2
        'blackberry9800',  // Torch
        'webOS',           // Palm Pre Experimental
        'incognito',       // Other iPhone browser
        'webmate'          // Other iPhone browser
    );
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

//URLスラッグの自動生成
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ){
    if(preg_match( '/(%[0-9a-f]{2})+/', $slug)){
        $slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
    }
    return $slug;
}
add_filter('wp_unique_post_slug', 'auto_post_slug', 10, 4);

//ウィジェット追加
// function sample_widgets(){
//     register_sidebar(array(
//         'name' => '共通サイドバー', /* ←追加したいウィジェットの名前 */
//         'description' => 'サイドバーウィジェット', /* ←追加したいウィジェットの概要 */
//         'id' => 'sidebar', /* ←追加したいウィジェットのID */
//         'before_widget' => '<div class="box">', /* ←追加したいウィジェットを囲う開始タグ */
//         'after_widget' => '</div>', /* ←追加したいウィジェットを囲う閉じタグ */
//         'before_title' => '<h2 class="widget_title">', /* ←追加したいウィジェットのタイトルを囲う開始タグ */
//         'after_title' => '</h2 class="widget_title">' /* ←追加したいウィジェットのタイトルを囲う閉じタグ */
//     ));
// }
// add_action('widgets_init', 'sample_widgets');

//テーマフォルダ直下のeditor-style.cssを読み込み
add_action('admin_init',function(){
    add_editor_style();
});

//GutenbergにオリジナルのCSSを適用する
add_action('admin_init', 'classic_editor_css');
function classic_editor_css() {
    add_editor_style('css/editor-style.css'); //エディタ専用
    // add_editor_style('css/page.css'); //サイトオリジナル
}
add_action('after_setup_theme', 'block_editor_css');
function block_editor_css() {
  add_theme_support('editor-styles');
  add_editor_style('css/page.css'); //サイトオリジナル
  add_editor_style('css/editor-style.css'); //エディタ専用
}

//エディタースタイルのキャッシュクリア
function extend_tiny_mce_before_init($mce_init){
    $mce_init['cache_suffix']='v='.time();
    return $mce_init;
}
add_filter('tiny_mce_before_init','extend_tiny_mce_before_init');

// 投稿エディターでh2以降しかタイトルを入れられないようにする（クラシックエディター）
function custom_editor_settings( $initArray ){
    $initArray['block_formats'] = "見出し1=h2; 見出し2=h3; 見出し3=h4; 段落=p; グループ=div;";
    return $initArray;
}
add_filter('tiny_mce_before_init', 'custom_editor_settings');

//投稿エディターでh2以降しかタイトルを入れられないようにする（ブロックエディタ用）
function modify_heading_block_settings($settings, $context){
    if(isset($settings['attributes']['level']['enum'])){
        $settings['attributes']['level']['enum'] = array_values(
            array_diff( $settings['attributes']['level']['enum'],[1])
        );
    }
    return $settings;
}
add_filter('allowed_block_types_all', function($allowed_blocks, $editor_context){
    if(isset( $allowed_blocks['core/heading'])){
        $allowed_blocks['core/heading'] = modify_heading_block_settings( $allowed_blocks['core/heading'], $editor_context );
    }
    return $allowed_blocks;
}, 10, 2);


/* **************************************************************************************************** */
// 不要な<head>内要素を除去
/* **************************************************************************************************** */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'feed_links_extra', 3);


/***********************************************************
* 管理画面関係
***********************************************************/
// 管理バーを画面下部に表示
add_action('wp_footer', function() {
    if ( is_admin_bar_showing() && current_user_can('administrator') ) {
        echo '<style>#wpadminbar{top:auto!important;bottom:0!important;overflow:hidden;}html{margin-top:0 !important;}</style>';
    }
});

function remove_dashboard_widgets_for_editors() {
    if ( current_user_can('editor') && !current_user_can('administrator') ) {
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // 概要
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // クイックドラフト
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress イベントとニュース
        remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // アクティビティ
    }
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets_for_editors', 9999 );
function hide_screen_options_for_editors() {
    if ( current_user_can('editor') && !current_user_can('administrator') ) {
        return false;
    }
    return true;
}
add_filter( 'screen_options_show_screen', 'hide_screen_options_for_editors' );

//投稿一覧から「投稿者」「タグ」「コメント」の列を非表示にする
function custom_manage_posts_columns($columns) {
    // unset($columns['author']);   // 投稿者列を非表示
    unset($columns['tags']);     // タグ列を非表示
    unset($columns['comments']); // コメント列を非表示
    return $columns;
}
add_filter('manage_posts_columns', 'custom_manage_posts_columns');

/***********************************************************
* Options Page
***********************************************************/
// if( function_exists('acf_add_options_page') ) {

//   acf_add_options_page(array(
//     'page_title' 	=> 'イベント情報',
//     'menu_title'	=> 'イベント情報',
//     'menu_slug' 	=> 'event-settings',
//     'capability'	=> 'edit_posts',
//     'redirect'		=> false
//   ));

// }


/* **************************************************************************************************** */
// Pagenation
/* **************************************************************************************************** */
function kriesi_pagination($pages = '', $range = 3){
    global $paged;
    if(empty($paged)) $paged = 1;

	if($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages) $pages = 1;
	}

	$start = $paged - $range;
	if($start < 3){
		$start = 1;
	}

	$end = $start + $range * 2;
	if($end > $pages){
		$end = $pages;
		$start = $pages - $range * 2;
		if($start < 1) $start = 1;
	}

	echo '<div class="pagination space-half">';

	if($start > 2){
		echo '<a href="' . get_pagenum_link(1) . '">1</a>' . "\n";
		echo '<span class="no-navi navi-co">･･･</span>' . "\n";
	}
	for($i = $start; $i <= $end; $i++){
		echo ($paged == $i ? '<span class="current">' . $i . '</span>' : '<a href="' . get_pagenum_link($i) . '" class="inactive">' . $i . '</a>') . "\n";
	}
	if($end < $pages - 1){
		echo '<span class="no-navi navi-co">･･･</span>' . "\n";
		echo '<a href="' . get_pagenum_link($pages) . '" class="inactive">' . $pages . '</a>' . "\n";
	}

	echo '</div>' . "\n";
}

// function kriesi_pagination($pages = '', $range = 1){
//     global $paged;
//     if(empty($paged)) $paged = 1;

//     if($pages == ''){
//         global $wp_query;
//         $pages = $wp_query->max_num_pages;
//         if(!$pages) $pages = 1;
//     }

//     if($pages <= 1) return;

//     echo "<div class='pagination'>";

//     $showitems = ($range * 2) + 1;

//     /* --------------------------
//     1️⃣ 終盤に近い場合は末尾ブロックを強制表示
//     -------------------------- */
//     if($paged > $pages - ($range + 1)){
//         $start = $pages - $showitems + 1;
//         $end   = $pages;
//     }
//     /* --------------------------
//     2️⃣ 先頭に近い場合は先頭ブロックを表示
//     -------------------------- */
//     elseif($paged <= $range + 1){
//         $start = 1;
//         $end   = $showitems;
//     }
//     /* --------------------------
//     3️⃣ 中央エリア
//     -------------------------- */
//     else{
//         $start = $paged - $range;
//         $end   = $paged + $range;
//     }

//     // 安全補正
//     $start = max(1, $start);
//     $end   = min($pages, $end);

//     /* 最初ページの処理 */
//     if($start > 1){
//         echo "<a href='".get_pagenum_link(1)."' class='pagination-btn'>1</a>";
//         if($start > 2){
//             echo '<span class="no-navi">･･･</span>';
//         }
//     }

//     /* メインループ */
//     for($i = $start; $i <= $end; $i++){
//         echo ($i == $paged)
//             ? "<span class='pagination-btn current'>$i</span>"
//             : "<a href='".get_pagenum_link($i)."' class='pagination-btn'>$i</a>";
//     }

//     /* 最後ページの処理 */
//     if($end < $pages){
//         if($end < $pages - 1){
//             echo '<span class="no-navi">･･･</span>';
//         }
//         echo "<a href='".get_pagenum_link($pages)."' class='pagination-btn'>$pages</a>";
//     }

//     echo "</div>";
// }


/* **************************************************************************************************** */
// ショートコード作成
/* **************************************************************************************************** */
// 固定ページ呼び出し用のショートコード（MW WP FORM内にプライバシーポリシーの固定ページ呼び出しなど）
function display_page_content_by_id( $atts ) {
	$atts = shortcode_atts(
		array(
			'id' => 0,
		),
		$atts,
		'display_page_content'
	);

	$page_id = (int) $atts['id'];

	if ( ! $page_id ) {
		return '';
	}

	$page_to_display = get_post( $page_id );

	if ( ! $page_to_display || 'publish' !== $page_to_display->post_status ) {
		return '';
	}

	$content = $page_to_display->post_content;

	return wpautop( apply_filters( 'the_content', $content ) );
}
add_shortcode( 'display_page_content', 'display_page_content_by_id' );

// サイトのurl呼び出し用のショートコード
function shortcode_siteurl() {
    return home_url();
}
add_shortcode('siteurl', 'shortcode_siteurl');


/* **************************************************************************************************** */
// 埋め込み動画のダウンロードボタンを無効化
/* **************************************************************************************************** */
function add_nodownload_to_video_block( $block_content, $block ) {
    // ブロックがWordPress標準の「動画」ブロックの場合のみ処理
    if ( 'core/video' === $block['blockName'] && ! is_admin() ) {
        // <video タグに controlsList="nodownload" を追加する
        $block_content = str_replace( '<video ', '<video controlsList="nodownload" ', $block_content );
    }
    return $block_content;
}
add_filter( 'render_block', 'add_nodownload_to_video_block', 10, 2 );


/* **************************************************************************************************** */
// 下階層はアンダーバーで繋ぐことでテンプレートファイルとして認識
/* **************************************************************************************************** */
add_filter('page_template_hierarchy', 'my_page_templates');
function my_page_templates($templates) {
    global $wp_query;

    $template = get_page_template_slug();
    $pagename = '';
    if ( isset($wp_query->query) && is_array($wp_query->query) && isset($wp_query->query['pagename']) ) {
        $pagename = $wp_query->query['pagename'];
    }

    if ($pagename && ! $template) {
        $pagename = str_replace('/', '__', $pagename);
        $decoded = urldecode($pagename);

        if ($decoded == $pagename) {
            array_unshift($templates, "page-{$pagename}.php");
        }
    }
    return $templates;
}

/***********************************************************
* 投稿サムネイル
***********************************************************/
$types = ['post'];
add_theme_support('post-thumbnails', $types);
foreach ($types as $type) {
    add_filter("manage_{$type}_posts_columns", function($columns) {
        $new = [];
        $new['thumbnail'] = 'サムネイル';
        return $new + $columns;
    });
    add_action("manage_{$type}_posts_custom_column", function($column, $post_id) use ($type) {
        if ($column !== 'thumbnail') return;

        // 通常投稿はアイキャッチ
        if ($type === 'post') {
            $thumb = get_the_post_thumbnail($post_id, 'thumbnail');
            echo $thumb ?: '—';
            return;
        }

        // ACF product_img Repeater
        // $field_name = 'product_img';
        // if(!have_rows($field_name, $post_id)){
        //     $field_name = 'process_img';
        // }
        // if(have_rows($field_name, $post_id)){
        //     the_row();
        //     $image = get_sub_field('img');
        //     if ($image) {
        //         // IDの場合
        //         if (is_numeric($image)) {
        //             echo wp_get_attachment_image($image, 'thumbnail');
        //         }
        //         // Arrayのばあい
        //         elseif (is_array($image) && isset($image['ID'])) {
        //             echo wp_get_attachment_image($image['ID'], 'thumbnail');
        //         } else {
        //             echo '—';
        //         }
        //     } else {
        //         echo '—';
        //     }
        //     reset_rows();
        // } else {
        //     echo '—';
        // }
    }, 10, 2);
}

add_action('admin_head', function(){
    echo '<style>
        .column-thumbnail { width: 80px; text-align:center; }
        .column-thumbnail img { max-width: 70px; height:auto; }
    </style>';
});


/**
 * 現在日から指定日まで日数が経っているかチェック
 * 主にアイコン「NEW」で使う
 * 単位は日
 * 初期値は31日
 *
 * @param int $days = 31
 * @return bool
 */
function is_new_check($days = 31) {
    $post_time = get_the_time('U');
    $last = time() - ($days * 24 * 60 * 60);
    if ($post_time > $last) {
        return true;
    } else {
        return false;
    }
}


/***********************************************************
* File Time Stamp
***********************************************************/
/* 読み込みファイルのtime stamp取得 */
function _get_fileTimestamp($file,$fileTargetPath = '') {
	if(empty($file)) {
		return;
	}
	if(empty($fileTargetPath)) {
		$fileTargetPath = get_template_directory();
	}
	if(!(file_exists($fileTargetPath.$file))) {
		return;
	}
	return filemtime($fileTargetPath.$file);
}
function _get_file($file,$filePath = '',$fileTargetPath = '') {
	if(empty($file)) {
		return;
	}
	if(empty($filePath)) {
		$filePath = get_template_directory_uri();
	}
	return $filePath.$file.'?'._get_fileTimestamp($file, $fileTargetPath);
}
?>


