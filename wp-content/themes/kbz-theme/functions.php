<?php
// define('TMP_DIR', get_stylesheet_directory_uri());
define('TMP_DIR', get_stylesheet_directory_uri().'/assets');
define('TMP_IMG', TMP_DIR . '/img');

function tmpImg($folder = NULL, $echo = true){
	$path = TMP_IMG . (!empty($folder) ? '/' . $folder : NULL);
	if($echo) {
		echo $path;
	}else{
		return $path;
	}
}

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
function classic_editor_css() {
    add_editor_style('assets/css/editor-style.css'); //エディタ専用
    // add_editor_style('assets/css/page.css'); //サイトオリジナル
}
add_action('admin_init', 'classic_editor_css');
function block_editor_css() {
  add_theme_support('editor-styles');
  add_editor_style('assets/css/editor-style.css'); //エディタ専用
//   add_editor_style('assets/css/page.css'); //サイトオリジナル
}
add_action('after_setup_theme', 'block_editor_css');

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

// 投稿エディターでh2以降しかタイトルを入れられないようにする（ブロックエディター）
function custom_editor_settings_block( $args, $block_type ) {
    if ( 'core/heading' !== $block_type ) {
        return $args;
    }
    // H1以外
    $args['attributes']['levelOptions']['default'] = [ 2, 3, 4, 5, 6 ];
    return $args;
}
add_filter( 'register_block_type_args', 'custom_editor_settings_block', 10, 2 );

add_action('after_setup_theme', function() {
    add_theme_support('post-thumbnails', array('post', 'page'));
});

// 投稿のみClassic editor
add_filter('use_block_editor_for_post_type', function($use_block_editor, $post_type){
    if ($post_type === 'post') {
        return false; // classic editor
    }
    return $use_block_editor;
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
    // unset($columns['tags']);     // タグ列を非表示
    unset($columns['comments']); // コメント列を非表示
    return $columns;
}
add_filter('manage_posts_columns', 'custom_manage_posts_columns');

// 管理画面のメニューから「コメント」を非表示
add_action('admin_menu', 'hide_comments_menu', 999);
function hide_comments_menu() {
    remove_menu_page('edit-comments.php');
}

// アドミンバーから「コメント」を非表示
add_action('wp_before_admin_bar_render', 'hide_comments_admin_bar');
function hide_comments_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_node('comments');
}

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

/***********************************************************
* get ACF Option page by Meny slug
***********************************************************/
function get_acf_fields_by_menu_slug($menu_slug) {
    if (!function_exists('acf_get_options_pages')) return null;

    $pages = acf_get_options_pages();
    if (!$pages) return null;

    foreach ($pages as $page) {
        if (isset($page['menu_slug']) && $page['menu_slug'] === $menu_slug) {
            $post_id = $page['post_id'] ?? 'options';

            return get_field_objects($post_id);
        }
    }

    return null;
}


/* **************************************************************************************************** */
// Pagenation
/* **************************************************************************************************** */
function kriesi_pagination($pages = '', $range = 2){
    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == ''){
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages) $pages = 1;
    }

    $showitems = ($range * 2) + 1;
    echo "<div class='pagination font-mont'>";
    $show_arrows = ($pages >= ($showitems + 1));
    if($show_arrows && $paged > 1){
        echo "<a href='".get_pagenum_link(1)."' class='pagination-arr first' aria-label='最初のページへ'><i class='arr'></i></a>";
        echo "<a href='".get_pagenum_link($paged - 1)."' class='pagination-arr prev' aria-label='前のページへ'><i class='arr'></i></a>";
    }

    $start = max(1, $paged - $range);
    $end   = min($pages, $paged + $range);
    if(($end - $start + 1) < $showitems){
        if($start == 1){
            $end = min($pages, $start + $showitems - 1);
        } elseif($end == $pages){
            $start = max(1, $end - $showitems + 1);
        }
    }

    for($i = $start; $i <= $end; $i++){
        echo ($paged == $i)
            ? "<span class='pagination-btn current'>$i</span>"
            : "<a href='".get_pagenum_link($i)."' class='pagination-btn'>$i</a>";
    }

    if($show_arrows && $paged < $pages){
        echo "<a href='".get_pagenum_link($paged + 1)."' class='pagination-arr next' aria-label='次のページへ'><i class='arr'></i></a>";
        echo "<a href='".get_pagenum_link($pages)."' class='pagination-arr last' aria-label='最後のページへ'><i class='arr'></i></a>";
    }
    echo "</div>";
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


/***********************************************************
* 投稿設定
***********************************************************/
/* 投稿：サムネイル追加 */
// $types = ['post'];
// add_theme_support('post-thumbnails', $types);
// foreach ($types as $type) {
//     add_filter("manage_{$type}_posts_columns", function($columns) {
//         $new = [];
//         $new['thumbnail'] = 'サムネイル';
//         return $new + $columns;
//     });
//     add_action("manage_{$type}_posts_custom_column", function($column, $post_id) {
//         if ($column === 'thumbnail') {
//             $thumb = get_the_post_thumbnail($post_id, 'thumbnail');
//             echo $thumb ?: '—';
//         }
//     }, 10, 2);
// }
// add_action('admin_head', function(){
//     echo '<style>
//         .column-thumbnail { width: 80px; text-align:center; }
//         .column-thumbnail img { max-width: 70px; height:auto; }
//     </style>';
// });

/* 投稿：PICKUP有無を管理画面の一覧に表示 */
// add_filter('manage_post_posts_columns', function($columns){
//     $columns['column_pickup'] = 'ピックアップにする';
//     return $columns;
// });
// add_action('manage_post_posts_custom_column', function($column, $post_id){
//     if ($column === 'column_pickup') {
//         $pickup = get_field('column_pickup', $post_id);
//         echo $pickup ? '✔' : '-';
//     }
// }, 10, 2);
?>