<?php
/**
 * MODULE (10) - 10 BÀI VIẾT MỚI NHẤT (PHONG CÁCH KHOA CNTT - TDC / FIT TDC)
 * Đặc trưng: Hộp màu xanh ngọc, hiển thị ngày-năm / tháng, nút "XEM TẤT CẢ TIN TỨC" ở footer
 */

$recent_count = isset($args['count']) ? absint($args['count']) : 10;
$recent_title = isset($args['title']) ? $args['title'] : 'Bài viết mới nhất';
$more_link    = isset($args['more_link']) ? esc_url($args['more_link']) : home_url('/');

$recent_query = new WP_Query(array(
    'posts_per_page'      => $recent_count,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
));
?>
<section class="widget tdc-fit-recent-widget">
    <div class="tdc-fit-recent-box">
        <?php if (!empty($recent_title)) : ?>
            <div class="tdc-fit-recent-header"><?php echo esc_html($recent_title); ?></div>
        <?php endif; ?>

        <div class="tdc-fit-recent-list">
            <?php
            if ($recent_query->have_posts()) :
                while ($recent_query->have_posts()) : $recent_query->the_post();
                    $day   = get_the_date('d');
                    $month = get_the_date('m');
                    $year  = get_the_date('y');
                    ?>
                    <div class="tdc-fit-post-item">
                        <div class="tdc-fit-date-box">
                            <div class="tdc-fit-date-top">
                                <span class="tdc-fit-day"><?php echo esc_html($day); ?></span>
                                <span class="tdc-fit-dash">—</span>
                                <span class="tdc-fit-year"><?php echo esc_html($year); ?></span>
                            </div>
                            <div class="tdc-fit-date-bottom">
                                <span class="tdc-fit-month"><?php echo esc_html($month); ?></span>
                            </div>
                        </div>
                        <div class="tdc-fit-title-wrap">
                            <a href="<?php the_permalink(); ?>" class="tdc-fit-post-title" title="<?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <p style="color:#ffffff; padding:15px; margin:0;">Chưa có bài viết nào.</p>
            <?php endif; ?>
        </div>

        <div class="tdc-fit-recent-footer">
            <a href="<?php echo $more_link; ?>" class="tdc-fit-all-news-btn">XEM TẤT CẢ TIN TỨC</a>
        </div>
    </div>
</section>
