<?php
/**
 * MODULE - LATEST NEWS
 *
 * Hiển thị 3 bài viết mới nhất theo dạng timeline.
 *
 * Location:
 * /modules/module-latest-news.php
 */

$current_post_id = 0;

/*
 * Chỉ loại bài hiện tại khi đang ở trang Single Post.
 * Khi ở các trang khác, vẫn lấy 3 bài mới nhất.
 */
if (is_single()) {
    $current_post_id = get_the_ID();
}

$latest_news_query = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 3,
    'post__not_in'        => $current_post_id ? [$current_post_id] : [],
    'orderby'             => 'date',
    'order'               => 'DESC',
    'ignore_sticky_posts' => true,
]);

if ($latest_news_query->have_posts()) :
?>

<section class="latest-news">

    <div class="latest-news-container">

        <h2 class="latest-news-title">
            Latest News
        </h2>

        <div class="latest-news-timeline">

            <?php while ($latest_news_query->have_posts()) : ?>

                <?php
                $latest_news_query->the_post();

                $post_id = get_the_ID();

                $title = get_the_title();

                $permalink = get_permalink();

                $date = get_the_date('j F, Y');

                $excerpt = get_the_excerpt();

                /*
                 * Nếu bài viết không có Excerpt,
                 * lấy nội dung bài viết làm fallback.
                 */
                if (empty($excerpt)) {
                    $excerpt = wp_strip_all_tags(get_the_content());
                }

                $excerpt = wp_trim_words(
                    $excerpt,
                    25,
                    '...'
                );
                ?>

                <article class="latest-news-item">

                    <!-- Timeline dot -->
                    <span
                        class="latest-news-dot"
                        aria-hidden="true"
                    ></span>

                    <div class="latest-news-content">

                        <div class="latest-news-header">

                            <!-- Post title -->
                            <a
                                class="latest-news-post-title"
                                href="<?php echo esc_url($permalink); ?>"
                            >
                                <?php echo esc_html($title); ?>
                            </a>

                            <!-- Post date -->
                            <time
                                class="latest-news-date"
                                datetime="<?php echo esc_attr(get_the_date('c')); ?>"
                            >
                                <?php echo esc_html($date); ?>
                            </time>

                        </div>

                        <!-- Post excerpt -->
                        <?php if (!empty($excerpt)) : ?>

                            <div class="latest-news-excerpt">
                                <?php echo esc_html($excerpt); ?>
                            </div>

                        <?php endif; ?>

                    </div>

                </article>

            <?php endwhile; ?>

        </div>

    </div>

</section>

<?php
endif;

/*
 * Restore the original WordPress query.
 */
wp_reset_postdata();
?>