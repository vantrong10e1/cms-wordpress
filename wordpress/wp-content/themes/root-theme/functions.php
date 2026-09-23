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
// Module tự chọn: bình chọn cảm xúc cho bài viết.
function root_theme_get_reaction_options() {
    return array(
        'helpful'     => array('emoji' => '💡', 'label' => 'Hữu ích'),
        'interesting' => array('emoji' => '✨', 'label' => 'Thú vị'),
        'surprising'  => array('emoji' => '😮', 'label' => 'Bất ngờ'),
        'confusing'   => array('emoji' => '🤔', 'label' => 'Khó hiểu'),
        'needs_more'  => array('emoji' => '📝', 'label' => 'Cần bổ sung'),
    );
}

function root_theme_get_reaction_counts($post_id) {
    $counts = get_post_meta($post_id, '_tdc_reaction_counts', true);
    $counts = is_array($counts) ? $counts : array();

    foreach (root_theme_get_reaction_options() as $key => $option) {
        $counts[$key] = isset($counts[$key]) ? max(0, (int) $counts[$key]) : 0;
    }

    return $counts;
}

function root_theme_reaction_cookie_name($post_id) {
    return 'tdc_post_reaction_' . absint($post_id);
}

function root_theme_encode_reaction_cookie($post_id, $reaction) {
    return $reaction . '.' . wp_hash($post_id . '|' . $reaction, 'nonce');
}

function root_theme_get_selected_reaction($post_id) {
    $cookie_name = root_theme_reaction_cookie_name($post_id);

    if (empty($_COOKIE[$cookie_name])) {
        return '';
    }

    $cookie_value = sanitize_text_field(wp_unslash($_COOKIE[$cookie_name]));
    $parts = explode('.', $cookie_value, 2);
    $options = root_theme_get_reaction_options();

    if (count($parts) !== 2 || !isset($options[$parts[0]])) {
        return '';
    }

    $expected = wp_hash($post_id . '|' . $parts[0], 'nonce');
    return hash_equals($expected, $parts[1]) ? $parts[0] : '';
}

function root_theme_set_reaction_cookie($post_id, $reaction) {
    $cookie_name   = root_theme_reaction_cookie_name($post_id);
    $cookie_value  = root_theme_encode_reaction_cookie($post_id, $reaction);
    $cookie_path   = defined('COOKIEPATH') && COOKIEPATH ? COOKIEPATH : '/';
    $cookie_domain = defined('COOKIE_DOMAIN') ? COOKIE_DOMAIN : '';

    setcookie($cookie_name, $cookie_value, array(
        'expires'  => time() + YEAR_IN_SECONDS,
        'path'     => $cookie_path,
        'domain'   => $cookie_domain,
        'secure'   => is_ssl(),
        'httponly' => true,
        'samesite' => 'Lax',
    ));

    $_COOKIE[$cookie_name] = $cookie_value;
}

function root_theme_handle_post_reaction() {
    check_ajax_referer('tdc_post_reaction', 'nonce');

    $post_id  = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    $reaction = isset($_POST['reaction']) ? sanitize_key(wp_unslash($_POST['reaction'])) : '';
    $options  = root_theme_get_reaction_options();

    if (!$post_id || get_post_status($post_id) !== 'publish' || !isset($options[$reaction])) {
        wp_send_json_error(array('message' => 'Không thể ghi nhận lựa chọn này.'), 400);
    }

    $selected = root_theme_get_selected_reaction($post_id);
    $counts   = root_theme_get_reaction_counts($post_id);

    if ($selected === $reaction) {
        wp_send_json_success(array(
            'counts'   => $counts,
            'selected' => $selected,
            'message'  => 'Bạn đã chọn cảm xúc này rồi.',
        ));
    }

    if ($selected && isset($counts[$selected])) {
        $counts[$selected] = max(0, $counts[$selected] - 1);
    }

    $counts[$reaction]++;
    update_post_meta($post_id, '_tdc_reaction_counts', $counts);
    root_theme_set_reaction_cookie($post_id, $reaction);

    wp_send_json_success(array(
        'counts'   => $counts,
        'selected' => $reaction,
        'message'  => $selected ? 'Đã cập nhật cảm xúc của bạn.' : 'Cảm ơn bạn đã chia sẻ cảm xúc!',
    ));
}
add_action('wp_ajax_tdc_post_reaction', 'root_theme_handle_post_reaction');
add_action('wp_ajax_nopriv_tdc_post_reaction', 'root_theme_handle_post_reaction');

function root_theme_render_post_reactions($post_id) {
    $post_id  = absint($post_id);
    $options  = root_theme_get_reaction_options();
    $counts   = root_theme_get_reaction_counts($post_id);
    $selected = root_theme_get_selected_reaction($post_id);
    ?>
    <section class="tdc-reactions" data-post-id="<?php echo esc_attr($post_id); ?>" aria-labelledby="tdc-reactions-title-<?php echo esc_attr($post_id); ?>">
        <div class="tdc-reactions__intro">
            <span class="tdc-reactions__eyebrow">PHẢN HỒI NHANH</span>
            <h2 id="tdc-reactions-title-<?php echo esc_attr($post_id); ?>">Bài viết này mang lại cảm xúc gì cho bạn?</h2>
            <p>Chọn một cảm xúc phù hợp nhất. Bạn có thể đổi lựa chọn bất cứ lúc nào.</p>
        </div>
        <div class="tdc-reactions__grid" role="group" aria-label="Chọn cảm xúc">
            <?php foreach ($options as $key => $option) :
                $is_selected = $selected === $key;
                ?>
                <button class="tdc-reaction<?php echo $is_selected ? ' is-selected' : ''; ?>"
                        type="button"
                        data-reaction="<?php echo esc_attr($key); ?>"
                        aria-pressed="<?php echo $is_selected ? 'true' : 'false'; ?>">
                    <span class="tdc-reaction__emoji" aria-hidden="true"><?php echo esc_html($option['emoji']); ?></span>
                    <span class="tdc-reaction__label"><?php echo esc_html($option['label']); ?></span>
                    <span class="tdc-reaction__count" aria-label="<?php echo esc_attr($counts[$key] . ' lượt chọn'); ?>"><?php echo esc_html($counts[$key]); ?></span>
                </button>
            <?php endforeach; ?>
        </div>
        <p class="tdc-reactions__status" role="status" aria-live="polite"></p>
    </section>
    <?php
}

function root_theme_enqueue_reaction_styles() {
    if (!is_single()) {
        return;
    }

    $reaction_css = <<<'CSS'
.tdc-reactions {
    position: relative;
    clear: both;
    margin: 38px 0 34px;
    padding: 28px;
    overflow: hidden;
    color: #334155;
    background: #f1f7fb;
    border: 1px solid #d9e8f2;
    border-left: 4px solid #1681c4;
    box-shadow: 0 12px 28px rgba(15, 53, 77, .08);
}
.tdc-reactions::after {
    content: '';
    position: absolute;
    right: -42px;
    top: -52px;
    width: 140px;
    height: 140px;
    border: 24px solid rgba(22, 129, 196, .06);
    border-radius: 50%;
    pointer-events: none;
}
.tdc-reactions__intro {
    position: relative;
    z-index: 1;
    max-width: 720px;
}
.tdc-reactions__eyebrow {
    display: block;
    margin-bottom: 7px;
    color: #1681c4;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: .14em;
}
.tdc-reactions h2 {
    margin: 0 0 7px;
    color: #172b3a;
    font-size: clamp(20px, 2.4vw, 27px);
    line-height: 1.25;
}
.tdc-reactions__intro p {
    margin: 0;
    color: #5d7080;
    font-size: 14px;
    line-height: 1.55;
}
.tdc-reactions__grid {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 10px;
    margin-top: 22px;
}
.tdc-reaction {
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: center;
    gap: 8px;
    min-width: 0;
    min-height: 58px;
    padding: 10px 11px;
    color: #334155;
    font: inherit;
    text-align: left;
    cursor: pointer;
    background: #fff;
    border: 1px solid #d5e1e9;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(15, 53, 77, .04);
    transition: transform .18s ease, border-color .18s ease, box-shadow .18s ease, color .18s ease;
}
.tdc-reaction:hover {
    color: #096aa6;
    border-color: #58a8d8;
    transform: translateY(-2px);
}
.tdc-reaction:focus-visible {
    outline: 3px solid rgba(14, 165, 233, .3);
    outline-offset: 2px;
}
.tdc-reaction.is-selected {
    color: #075f98;
    border-color: #1681c4;
    box-shadow: 0 0 0 2px #1681c4, 0 9px 18px rgba(22, 129, 196, .15);
    transform: translateY(-3px);
}
.tdc-reaction:disabled {
    cursor: wait;
    opacity: .65;
}
.tdc-reaction__emoji {
    font-size: 20px;
    line-height: 1;
}
.tdc-reaction__label {
    overflow: hidden;
    font-size: 13px;
    font-weight: 700;
    line-height: 1.2;
    text-overflow: ellipsis;
}
.tdc-reaction__count {
    display: inline-grid;
    place-items: center;
    min-width: 25px;
    height: 25px;
    padding: 0 6px;
    color: #496273;
    font-size: 12px;
    font-weight: 800;
    background: #edf3f7;
    border-radius: 5px;
}
.tdc-reaction.is-selected .tdc-reaction__count {
    color: #fff;
    background: #1681c4;
}
.tdc-reactions__status {
    min-height: 20px;
    margin: 13px 0 -5px;
    color: #1373ad;
    font-size: 13px;
    font-weight: 600;
}
.tdc-reactions__status.is-error {
    color: #b42318;
}
@media (max-width: 900px) {
    .tdc-reactions__grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}
@media (max-width: 480px) {
    .tdc-reactions {
        margin: 30px 0;
        padding: 22px 18px;
    }
    .tdc-reactions__grid {
        gap: 8px;
    }
    .tdc-reaction {
        min-height: 56px;
    }
    .tdc-reaction:last-child:nth-child(odd) {
        grid-column: 1 / -1;
    }
}
@media (max-width: 340px) {
    .tdc-reactions__grid {
        grid-template-columns: 1fr;
    }
    .tdc-reaction:last-child:nth-child(odd) {
        grid-column: auto;
    }
}
@media (prefers-reduced-motion: reduce) {
    .tdc-reaction {
        transition: none;
    }
}
CSS;

    wp_add_inline_style('group-c-style', $reaction_css);
}
add_action('wp_enqueue_scripts', 'root_theme_enqueue_reaction_styles', 40);

function root_theme_render_reaction_script() {
    if (!is_single()) {
        return;
    }
    ?>
    <script>
    (function () {
        'use strict';

        var config = <?php echo wp_json_encode(array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('tdc_post_reaction'),
        )); ?>;

        document.querySelectorAll('.tdc-reactions').forEach(function (module) {
            var buttons = Array.prototype.slice.call(module.querySelectorAll('.tdc-reaction'));
            var status = module.querySelector('.tdc-reactions__status');

            buttons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var previous = module.querySelector('.tdc-reaction.is-selected');
                    var reaction = button.getAttribute('data-reaction');
                    var formData = new FormData();
                    var originalCounts = {};

                    if (button.getAttribute('aria-pressed') === 'true') {
                        status.textContent = 'Bạn đã chọn cảm xúc này rồi.';
                        return;
                    }

                    buttons.forEach(function (item) { item.disabled = true; });
                    buttons.forEach(function (item) {
                        originalCounts[item.getAttribute('data-reaction')] = parseInt(item.querySelector('.tdc-reaction__count').textContent, 10) || 0;
                    });
                    module.setAttribute('aria-busy', 'true');
                    status.classList.remove('is-error');
                    status.textContent = 'Đang ghi nhận lựa chọn…';

                    if (previous) {
                        var previousCount = previous.querySelector('.tdc-reaction__count');
                        previousCount.textContent = Math.max(0, parseInt(previousCount.textContent, 10) - 1);
                        previous.classList.remove('is-selected');
                        previous.setAttribute('aria-pressed', 'false');
                    }

                    var currentCount = button.querySelector('.tdc-reaction__count');
                    currentCount.textContent = parseInt(currentCount.textContent, 10) + 1;
                    button.classList.add('is-selected');
                    button.setAttribute('aria-pressed', 'true');

                    formData.append('action', 'tdc_post_reaction');
                    formData.append('nonce', config.nonce);
                    formData.append('post_id', module.getAttribute('data-post-id'));
                    formData.append('reaction', reaction);

                    fetch(config.ajaxUrl, {
                        method: 'POST',
                        credentials: 'same-origin',
                        body: formData
                    })
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error('request_failed');
                        }
                        return response.json();
                    })
                    .then(function (response) {
                        if (!response.success) {
                            throw new Error(response.data && response.data.message ? response.data.message : 'request_failed');
                        }

                        buttons.forEach(function (item) {
                            var key = item.getAttribute('data-reaction');
                            var count = response.data.counts[key] || 0;
                            var countNode = item.querySelector('.tdc-reaction__count');
                            var selected = key === response.data.selected;
                            countNode.textContent = count;
                            countNode.setAttribute('aria-label', count + ' lượt chọn');
                            item.classList.toggle('is-selected', selected);
                            item.setAttribute('aria-pressed', selected ? 'true' : 'false');
                        });
                        status.textContent = response.data.message;
                    })
                    .catch(function (error) {
                        buttons.forEach(function (item) {
                            var key = item.getAttribute('data-reaction');
                            var countNode = item.querySelector('.tdc-reaction__count');
                            var wasSelected = item === previous;
                            countNode.textContent = originalCounts[key];
                            countNode.setAttribute('aria-label', originalCounts[key] + ' lượt chọn');
                            item.classList.toggle('is-selected', wasSelected);
                            item.setAttribute('aria-pressed', wasSelected ? 'true' : 'false');
                        });
                        status.classList.add('is-error');
                        status.textContent = error.message !== 'request_failed' ? error.message : 'Chưa thể ghi nhận. Vui lòng thử lại.';
                    })
                    .then(function () {
                        buttons.forEach(function (item) { item.disabled = false; });
                        module.removeAttribute('aria-busy');
                    });
                });
            });
        });
    }());
    </script>
    <?php
}
add_action('wp_footer', 'root_theme_render_reaction_script', 40);

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
