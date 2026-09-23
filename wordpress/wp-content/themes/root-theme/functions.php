<?php
/**
 * Root Theme Functions and definitions
 */

// 1. Nạp Stylesheet của Theme & Font Awesome cho Bootsnipp
function group_c_enqueue_styles() {
    wp_enqueue_style(
        'font-awesome-4',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
        array(),
        '4.7.0'
    );
    wp_enqueue_style(
        'group-c-style',
        get_stylesheet_uri(),
        array('font-awesome-4'),
        time() // Cache buster để nhận CSS mới nhất ngay lập tức
    );
}
add_action('wp_enqueue_scripts', 'group_c_enqueue_styles');

// Module 13: CSS được khai báo trong PHP theo yêu cầu không sửa style.css.
function root_theme_enqueue_module_13_styles() {
    $module_13_css = <<<'CSS'
.tdc-module-13 {
    width: min(100% - 40px, 1200px);
    margin: 0 auto 42px;
}
.tdc-module-13__heading {
    margin: 0 0 20px;
    color: #1f2937;
    font-size: 24px;
    font-weight: 700;
}
.tdc-module-13__grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 22px;
}
.tdc-module-13__card {
    min-width: 0;
    overflow: hidden;
    background: #fff;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 14px rgba(15, 23, 42, .06);
}
.tdc-module-13__image-link,
.tdc-module-13__placeholder {
    display: block;
    width: 100%;
    aspect-ratio: 16 / 9;
    overflow: hidden;
    background: #dcebf5;
}
.tdc-module-13__image {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .25s ease;
}
.tdc-module-13__image-link:hover .tdc-module-13__image {
    transform: scale(1.035);
}
.tdc-module-13__placeholder {
    background: linear-gradient(135deg, #dbeafe, #e2e8f0);
}
.tdc-module-13__body {
    padding: 16px 18px 18px;
}
.tdc-module-13__title {
    margin: 0 0 10px;
    font-size: 17px;
    line-height: 1.4;
}
.tdc-module-13__title a {
    color: #4b6f88;
    text-decoration: none;
}
.tdc-module-13__title a:hover {
    color: #1681c4;
    text-decoration: underline;
}
.tdc-module-13__excerpt {
    margin: 0;
    color: #64748b;
    font-size: 14px;
    line-height: 1.6;
}
@media (max-width: 768px) {
    .tdc-module-13 {
        width: min(100% - 28px, 1200px);
    }
    .tdc-module-13__grid {
        grid-template-columns: 1fr;
    }
}
CSS;

    wp_add_inline_style('group-c-style', $module_13_css);
}
add_action('wp_enqueue_scripts', 'root_theme_enqueue_module_13_styles', 20);

function root_theme_get_module_13_image_url($post_id, $post_content = '') {
    $featured_image_url = get_the_post_thumbnail_url($post_id, 'medium_large');

    if ($featured_image_url) {
        return $featured_image_url;
    }

    if (!preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $post_content, $matches)) {
        return '';
    }

    $content_image_url = html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8');
    $uploads_marker = '/wp-content/uploads/';
    $uploads_position = strpos($content_image_url, $uploads_marker);

    if ($uploads_position !== false) {
        $uploads_path = substr($content_image_url, $uploads_position + strlen('/wp-content'));
        return content_url($uploads_path);
    }

    if (strpos($content_image_url, '//') === 0) {
        return (is_ssl() ? 'https:' : 'http:') . $content_image_url;
    }

    if (strpos($content_image_url, '/') === 0) {
        return home_url($content_image_url);
    }

    return $content_image_url;
}

// Module đề xuất: thời gian đọc và thanh tiến trình đọc bài.
function root_theme_get_reading_time($content) {
    $plain_text = trim(wp_strip_all_tags(strip_shortcodes($content)));

    if ($plain_text === '') {
        return 1;
    }

    $words = preg_split('/\s+/u', $plain_text, -1, PREG_SPLIT_NO_EMPTY);
    return max(1, (int) ceil(count($words) / 200));
}

function root_theme_enqueue_reading_progress_styles() {
    if (!is_single()) {
        return;
    }

    $reading_progress_css = <<<'CSS'
.tdc-reading-progress {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 99999;
    width: 100%;
    height: 4px;
    background: rgba(226, 232, 240, .9);
    pointer-events: none;
}
.tdc-reading-progress__bar {
    display: block;
    width: 0;
    height: 100%;
    background: linear-gradient(90deg, #06b6d4, #2563eb);
    box-shadow: 0 1px 5px rgba(37, 99, 235, .35);
    transition: width .08s linear;
}
.admin-bar .tdc-reading-progress {
    top: 32px;
}
.tdc-single-heading-content {
    flex: 1 1 auto;
    min-width: 0;
    padding-right: 32px;
}
.tdc-single-heading-content .single-post-title {
    padding-right: 0;
}
.tdc-reading-meta {
    display: flex;
    align-items: center;
    gap: 7px;
    width: max-content;
    max-width: 100%;
    margin-top: 12px;
    color: #64748b;
    font-size: 14px;
    line-height: 1.4;
    white-space: nowrap;
}
.tdc-reading-meta__icon {
    flex: 0 0 18px;
    width: 18px;
    height: 18px;
    color: #1681c4;
}
.tdc-reading-meta span {
    white-space: nowrap;
}
@media screen and (max-width: 782px) {
    .admin-bar .tdc-reading-progress {
        top: 46px;
    }
}
@media (max-width: 600px) {
    .tdc-single-heading-content {
        padding-right: 18px;
    }
    .tdc-reading-meta {
        max-width: 100%;
        font-size: 13px;
    }
}
CSS;

    wp_add_inline_style('group-c-style', $reading_progress_css);
}
add_action('wp_enqueue_scripts', 'root_theme_enqueue_reading_progress_styles', 30);

function root_theme_render_reading_progress_script() {
    if (!is_single()) {
        return;
    }
    ?>
    <script>
    (function () {
        'use strict';

        var content = document.querySelector('.single-post-content');
        var progressBar = document.querySelector('.tdc-reading-progress__bar');
        var ticking = false;

        if (!content || !progressBar) {
            return;
        }

        function updateReadingProgress() {
            var viewportHeight = window.innerHeight || document.documentElement.clientHeight;
            var contentTop = content.getBoundingClientRect().top + window.pageYOffset;
            var contentHeight = content.offsetHeight;
            var readableDistance = Math.max(contentHeight - viewportHeight, 1);
            var currentDistance = window.pageYOffset - contentTop;
            var percentage = Math.min(100, Math.max(0, (currentDistance / readableDistance) * 100));

            progressBar.style.width = percentage.toFixed(2) + '%';
            ticking = false;
        }

        function requestProgressUpdate() {
            if (!ticking) {
                window.requestAnimationFrame(updateReadingProgress);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestProgressUpdate, { passive: true });
        window.addEventListener('resize', requestProgressUpdate);
        updateReadingProgress();
    }());
    </script>
    <?php
}
add_action('wp_footer', 'root_theme_render_reading_progress_script', 30);


// 2. Đăng ký khu vực Sidebar & Footer Widgets
function root_theme_widgets_init() {
    register_sidebar(array(
        'name'          => 'Main Sidebar',
        'id'            => 'sidebar-1',
        'description'   => 'Khu vực Sidebar chính (hiển thị cùng Modules 9, 10, 11)',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'root_theme_widgets_init');


// 3. Đăng ký các Shortcodes cho 4 Modules
if (!shortcode_exists('tdc_categories')) {
    add_shortcode('tdc_categories', function($atts) {
        ob_start();
        if (file_exists(get_template_directory() . '/modules/module-9-categories.php')) {
            include get_template_directory() . '/modules/module-9-categories.php';
        }
        return ob_get_clean();
    });
}

if (!shortcode_exists('tdc_recent_posts')) {
    add_shortcode('tdc_recent_posts', function($atts) {
        $args = shortcode_atts(array(
            'count'     => 10,
            'title'     => 'Bài viết mới nhất',
            'more_link' => home_url('/'),
        ), $atts);
        ob_start();
        if (file_exists(get_template_directory() . '/modules/module-10-recent-posts.php')) {
            include get_template_directory() . '/modules/module-10-recent-posts.php';
        }
        return ob_get_clean();
    });
}

if (!shortcode_exists('tdc_vnexpress_archive')) {
    add_shortcode('tdc_vnexpress_archive', function($atts) {
        $args = shortcode_atts(array(
            'count' => 8,
            'title' => 'Xem nhiều',
        ), $atts);
        ob_start();
        if (file_exists(get_template_directory() . '/modules/module-11-archive.php')) {
            include get_template_directory() . '/modules/module-11-archive.php';
        }
        return ob_get_clean();
    });
}
