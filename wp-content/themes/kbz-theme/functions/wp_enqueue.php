<?php
function theme_enqueue_styles() {
	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/* =====================================
* FONT
* ===================================== */
define( 'FONT_URL', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Zen+Kaku+Gothic+New:wght@400;500;700;900&display=swap' );
function enqueue_fonts() {
    wp_enqueue_style('fonts', FONT_URL, array(), null);
}
add_action('wp_enqueue_scripts', 'enqueue_fonts'); // Front
add_action('enqueue_block_editor_assets', 'enqueue_fonts'); // Block
function add_editor_font() {
    add_editor_style(FONT_URL);
}
add_action('after_setup_theme', 'add_editor_font'); // Classic


/* =====================================
* CSS & JS
* ===================================== */
add_action('wp_enqueue_scripts', function() {
    $css_path = '/assets/css/';
    $dir_path = get_stylesheet_directory() . $css_path;
    $uri_path = get_stylesheet_directory_uri() . $css_path;

    /* =====================================
     * ① Tailwind
     * ===================================== */
    // $tailwind_min = $dir_path . 'tailwind.min.css';
    // $tailwind_css = $dir_path . 'tailwind.css';

    // $use_cdn = defined('tailwind_cdn_mode') && tailwind_cdn_mode;
    // if ( !$use_cdn && (file_exists($tailwind_min) || file_exists($tailwind_css)) ){
    //     if (file_exists($tailwind_min)) {
    //         $file = 'tailwind.min.css';
    //     } else {
    //         $file = 'tailwind.css';
    //     }
    //     wp_enqueue_style('tailwind', $uri_path . $file, [], filemtime($dir_path . $file), 'all');
    // } else {
    //     wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', [], null, false);
    // }


    /* =====================================
     * ② 共通CSS
     * ===================================== */
    wp_enqueue_style('splide-css', get_template_directory_uri() . '/assets/library/splide/splide.min.css', [], '4.1.3');
    // wp_enqueue_style('style', _get_file('/assets/css/style.min.css'), [], null, 'all');


    /* =====================================
     * ③ ページ別CSS
     * ===================================== */
    $css_name = '';
    // TOP
    if (is_front_page()) {
        $css_name = 'top';
    }
    // taxonomy / category / tag
    elseif (is_tax() || is_category() || is_tag()) {
        $obj = get_queried_object();
        $css_name = $obj->slug ?? '';
    }
    // 固定ページ（親基準）
    elseif (is_page()) {
        global $post;
        $ancestors = get_post_ancestors($post);
        if (!empty($ancestors)) {
            // 一番上の親ページ
            $top_parent_id = end($ancestors);
            $css_name = get_post_field('post_name', $top_parent_id);
        } else {
            // 親ページがなければ自分の
            $css_name = $post->post_name;
        }
    }
    // 投稿タイプアーカイブ
    elseif (is_post_type_archive()) {
        $css_name = get_post_type();
    }
    // 投稿の詳細ページ（single）
    elseif (is_singular()) {
        $css_name = get_post_type();
    }
    else {
        $css_name = get_query_var('pagename');
    }

    // css出力
    if ($css_name) {
        $min_file = $dir_path . "style-{$css_name}.min.css";
        $css_file = $dir_path . "style-{$css_name}.css";

        if (file_exists($min_file)) {
            $file = "style-{$css_name}.min.css";
        } elseif (file_exists($css_file)) {
            $file = "style-{$css_name}.css";
        } else {
            $file = '';
        }

        if ($file) {
            wp_enqueue_style("style-{$css_name}", $uri_path . $file, [], filemtime($dir_path . $file), 'all');
        }
    }


    /* =====================================
     * ④ 共通JS
     * ===================================== */
    wp_enqueue_script('splide-js', get_template_directory_uri().'/assets/library/splide/splide.min.js', [], '4.1.3', true);
    wp_enqueue_script('splide-auto-scroll', get_template_directory_uri().'/assets/library/splide/splide-extension-auto-scroll.min.js', ['splide-js'], '0.5.3', true);

    wp_enqueue_script('gsap', get_template_directory_uri().'/assets/library/gsap/gsap.min.js', [], null, true);
    wp_enqueue_script('gsap-scroll-trigger', get_template_directory_uri().'/assets/library/gsap/ScrollTrigger.min.js', ['gsap'], null, true);

    wp_enqueue_script('util-js', _get_file('/assets/js/util.js'), [], null, true);
    wp_enqueue_script('script-js', _get_file('/assets/js/script.js'), ['util-js'], null, true);
});
?>