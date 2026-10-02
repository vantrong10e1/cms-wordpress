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


/**
 * widget_test_4 - Thông tin tòa soạn theo ảnh số 29.
 * Cấu hình widget được WordPress lưu trong cơ sở dữ liệu.
 */
function root_theme_widget_test_4_is_visible() {
    return is_front_page() || is_home() || is_archive() || is_search() || is_single();
}
function root_theme_widget_test_4_categories() {
    $items = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'number' => 19));
    return is_wp_error($items) ? array() : $items;
}
function root_theme_render_widget_test_4($settings = array()) {
    $settings = wp_parse_args($settings, array(
        'editor_name' => 'TRẦN XUÂN TOÀN', 'publisher' => 'Báo điện tử Tuổi Trẻ (tuoitre.vn)',
        'agency' => 'Cơ quan Báo và Phát thanh, Truyền hình TP.HCM',
        'license' => 'Giấy phép hoạt động báo điện tử tiếng Việt, tiếng Anh số 561/GP-BTTTT, cấp ngày 25-11-2022.',
        'address' => '60A Hoàng Văn Thụ, phường Đức Nhuận, TP. Hồ Chí Minh',
        'hotline' => '0918.033.133', 'advertising' => '028.39974848',
        'service_links' => 'Dịch vụ truyền thông|Điều khoản bảo mật|Liên hệ góp ý|RSS',
        'youtube_url' => 'https://www.youtube.com/', 'facebook_url' => 'https://www.facebook.com/',
        'copyright' => 'Báo điện tử Tuổi Trẻ giữ bản quyền nội dung trên website này',
    ));
    $site_name = get_bloginfo('name') ?: 'Root Theme';
    $tagline = get_bloginfo('description');
    $email = sanitize_email(get_option('admin_email'));
    $service_links = array_filter(array_map('trim', explode('|', $settings['service_links'])));
    ?>
    <section class="tdc-widget-test-4" aria-label="Thông tin website và tòa soạn">
        <nav class="tdc-widget-test-4__nav" aria-label="Danh mục nội dung">
            <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
            <?php foreach (root_theme_widget_test_4_categories() as $category) :
                $url = get_category_link((int) $category->term_id);
                if (!is_wp_error($url)) : ?>
                    <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($category->name); ?></a>
                <?php endif;
            endforeach; ?>
        </nav>
        <div class="tdc-widget-test-4__rule"></div>
        <div class="tdc-widget-test-4__content">
            <div class="tdc-widget-test-4__brand"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($site_name); ?></a><?php if ($tagline) : ?><small><?php echo esc_html($tagline); ?></small><?php endif; ?></div>
            <div class="tdc-widget-test-4__text">
                <p>Tổng biên tập: <strong><?php echo esc_html($settings['editor_name']); ?></strong></p>
                <p><strong><?php echo esc_html($settings['publisher']); ?></strong></p>
                <p><?php echo esc_html($settings['agency']); ?></p><p><?php echo esc_html($settings['license']); ?></p>
                <p><strong>Thông tin tòa soạn</strong></p><p><?php echo esc_html($settings['agency']); ?></p>
            </div>
            <div class="tdc-widget-test-4__text">
                <p>Địa chỉ: <?php echo esc_html($settings['address']); ?></p>
                <p>Hotline: <?php echo esc_html($settings['hotline']); ?><?php if ($email) : ?> - Email: <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a><?php endif; ?></p>
                <p>Quảng cáo: <?php echo esc_html($settings['advertising']); ?></p>
                <p class="tdc-widget-test-4__services"><?php foreach ($service_links as $index => $label) : ?><?php if ($index) : ?><span>|</span><?php endif; ?><a href="<?php echo esc_url(home_url('/?s=' . rawurlencode($label))); ?>"><?php echo esc_html($label); ?></a><?php endforeach; ?></p>
            </div>
            <div class="tdc-widget-test-4__social">
                <a href="<?php echo esc_url($settings['youtube_url']); ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fa fa-youtube-play"></i></a>
                <a href="<?php echo esc_url($settings['facebook_url']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fa fa-facebook"></i></a>
            </div>
        </div>
        <p class="tdc-widget-test-4__copyright">© Copyright <?php echo esc_html(wp_date('Y')); ?> <?php echo esc_html($site_name); ?>, All rights reserved ® <?php echo esc_html($settings['copyright']); ?></p>
    </section>
    <?php
}
class Root_Theme_Widget_Test_4 extends WP_Widget {
    public function __construct() {
        parent::__construct('widget_test_4', 'widget_test_4', array('description' => 'Thông tin tòa soạn theo ảnh số 29.'));
    }
    public function widget($args, $instance) {
        echo $args['before_widget'];
        root_theme_render_widget_test_4($instance);
        echo $args['after_widget'];
    }
    public function form($instance) {
        $fields = array(
            'editor_name' => 'Tổng biên tập', 'publisher' => 'Đơn vị xuất bản', 'agency' => 'Cơ quan chủ quản',
            'license' => 'Giấy phép', 'address' => 'Địa chỉ', 'hotline' => 'Hotline',
            'advertising' => 'Điện thoại quảng cáo', 'service_links' => 'Liên kết dịch vụ (cách nhau bằng |)',
            'youtube_url' => 'YouTube', 'facebook_url' => 'Facebook', 'copyright' => 'Nội dung bản quyền',
        );
        foreach ($fields as $field => $label) : ?>
            <p><label for="<?php echo esc_attr($this->get_field_id($field)); ?>"><?php echo esc_html($label); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id($field)); ?>" name="<?php echo esc_attr($this->get_field_name($field)); ?>" type="text" value="<?php echo esc_attr(isset($instance[$field]) ? $instance[$field] : ''); ?>"></p>
        <?php endforeach;
    }
    public function update($new_instance, $old_instance) {
        $clean = array();
        foreach ($new_instance as $field => $value) {
            $clean[$field] = in_array($field, array('youtube_url', 'facebook_url'), true) ? esc_url_raw($value) : sanitize_text_field($value);
        }
        return $clean;
    }
}
function root_theme_enqueue_widget_test_4_styles() {
    if (!root_theme_widget_test_4_is_visible()) return;
    $css = <<<'CSS'
.tdc-widget-test-4-area{clear:both;width:100%;padding:0 28px;background:#f7f7f9;color:#555;font-family:Arial,Helvetica,sans-serif}.tdc-widget-test-4-area>.widget{margin:0;padding:0;background:transparent;border:0}.tdc-widget-test-4{width:min(100%,1600px);margin:auto;padding:24px 10px 30px}.tdc-widget-test-4__nav{display:flex;flex-wrap:wrap;gap:11px 14px;padding-bottom:20px}.tdc-widget-test-4__nav a{color:#282828!important;font-size:13px;font-weight:700;text-decoration:none!important;text-transform:uppercase;white-space:nowrap}.tdc-widget-test-4__nav a:hover{color:#e4002b!important}.tdc-widget-test-4__rule{height:3px;background:#e4002b}.tdc-widget-test-4__content{display:grid;grid-template-columns:minmax(220px,.8fr) minmax(330px,1.2fr) minmax(390px,1.35fr) auto;gap:42px;padding:30px 50px}.tdc-widget-test-4__brand{align-self:center}.tdc-widget-test-4__brand>a{display:block;color:#e4002b!important;font-size:44px;font-weight:900;font-style:italic;line-height:.95;letter-spacing:-3px;text-decoration:none!important}.tdc-widget-test-4__brand small{display:block;margin-top:7px;font-size:10px;font-weight:700;text-transform:uppercase}.tdc-widget-test-4__text p{margin:0 0 4px;font-size:14px;line-height:1.35}.tdc-widget-test-4__text a{color:#555!important;text-decoration:none!important}.tdc-widget-test-4__services{display:flex;flex-wrap:wrap;gap:4px 8px}.tdc-widget-test-4__services a{font-weight:700}.tdc-widget-test-4__services span{color:#bbb}.tdc-widget-test-4__social{display:flex;gap:18px}.tdc-widget-test-4__social a{display:grid;width:40px;height:40px;border:2px solid #858585;border-radius:50%;place-items:center;color:#666!important;font-size:19px;text-decoration:none!important}.tdc-widget-test-4__social a:hover{border-color:#e4002b;color:#e4002b!important}.tdc-widget-test-4__copyright{margin:0;padding-top:27px;border-top:1px dashed #d5d5d5;color:#858585;font-size:13px}@media(max-width:1100px){.tdc-widget-test-4__content{grid-template-columns:220px 1fr 1fr;padding:28px 20px}.tdc-widget-test-4__social{grid-column:2/4}}@media(max-width:760px){.tdc-widget-test-4-area{padding:0 18px}.tdc-widget-test-4__nav{overflow-x:auto;flex-wrap:nowrap}.tdc-widget-test-4__content{grid-template-columns:1fr;padding:26px 0}.tdc-widget-test-4__social{grid-column:auto}.tdc-widget-test-4__brand>a{font-size:38px}}
CSS;
    wp_add_inline_style('group-c-style', $css);
}
add_action('wp_enqueue_scripts', 'root_theme_enqueue_widget_test_4_styles', 50);
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
    register_sidebar(array(
        'name' => 'widget_test_4',
        'id' => 'widget_test_4',
        'description' => 'Khối thông tin tòa soạn ảnh số 29, hiển thị phía trên footer.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_widget('Root_Theme_Widget_Test_4');
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

// Module 12 (Tự chọn 1): Tiêu Điểm Thể Thao & Highlights
if (!shortcode_exists('tdc_featured_sports')) {
    add_shortcode('tdc_featured_sports', function($atts) {
        ob_start();
        if (file_exists(get_template_directory() . '/modules/module-12-featured-sports.php')) {
            include get_template_directory() . '/modules/module-12-featured-sports.php';
        }
        return ob_get_clean();
    });
}

// Module 13 (Tự chọn 2): Lịch Thi Đấu & Kết Quả Thể Thao
if (!shortcode_exists('tdc_sports_fixtures')) {
    add_shortcode('tdc_sports_fixtures', function($atts) {
        ob_start();
        if (file_exists(get_template_directory() . '/modules/module-13-fixtures.php')) {
            include get_template_directory() . '/modules/module-13-fixtures.php';
        }
        return ob_get_clean();
    });
}

// 5. Module 14 - Featured Visuals

if (!shortcode_exists('tdc_featured_module_14')) {
    add_shortcode('tdc_featured_module_14', function () {

        ob_start();

        $module_14_file = get_template_directory()
            . '/modules/module-14-featured.php';

        if (file_exists($module_14_file)) {
            include $module_14_file;
        }

        return ob_get_clean();
    });
}

