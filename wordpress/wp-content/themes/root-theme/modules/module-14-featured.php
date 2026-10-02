<?php
/**
 * Module 14 - Featured / Image News
 * Hiển thị 4 bài viết mới nhất có hình ảnh
 */

$module_14_query = new WP_Query(array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 4,
    'orderby'        => 'date',
    'order'          => 'DESC',
));

if ($module_14_query->have_posts()) :
?>

<section class="module-14-featured">

    <div class="module-14-featured__header">

        <div class="module-14-featured__categories">
            <span class="module-14-featured__category active">
                Ảnh
            </span>

            <span class="module-14-featured__category">
                Megastory
            </span>

            <span class="module-14-featured__category">
                Infographic
            </span>
        </div>

        <a
            class="module-14-featured__more"
            href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
        >
            Xem thêm
        </a>

    </div>


    <div class="module-14-featured__grid">

        <?php
        while ($module_14_query->have_posts()) :
            $module_14_query->the_post();

            $post_id      = get_the_ID();
            $post_content = get_the_content();

            /*
             * 1. Ưu tiên Featured Image
             */
            $image_url = get_the_post_thumbnail_url($post_id, 'large');

            /*
            * Nếu bài viết không có Featured Image,
            * lấy ảnh đầu tiên trong nội dung bài viết.
            */
            if (!$image_url && $post_content) {

                if (preg_match(
                    '/<img[^>]+src=["\']([^"\']+)["\']/i',
                    $post_content,
                    $matches
                )) {
                    $image_url = html_entity_decode(
                        $matches[1],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                }
            }

            /*
            * Thử data-src nếu src không tồn tại.
            */
            if (!$image_url && $post_content) {

                if (preg_match(
                    '/<img[^>]+data-src=["\']([^"\']+)["\']/i',
                    $post_content,
                    $matches
                )) {
                    $image_url = html_entity_decode(
                        $matches[1],
                        ENT_QUOTES,
                        'UTF-8'
                    );
                }
            }

            /*
             * 3. Nếu vẫn không có ảnh,
             *    dùng ảnh mặc định.
             */
            if (!$image_url) {
                $image_url = get_template_directory_uri()
                    . '/assets/images/module-14-default.jpg';
            }

            $comments_number = get_comments_number();
        ?>

            <article class="module-14-featured__item">

                <a
                    class="module-14-featured__link"
                    href="<?php the_permalink(); ?>"
                >

                    <div class="module-14-featured__image-wrap">

                        <img
                            class="module-14-featured__image"
                            src="<?php echo esc_url($image_url); ?>"
                            alt="<?php echo esc_attr(get_the_title()); ?>"
                            loading="lazy"
                        >

                        <div class="module-14-featured__overlay"></div>

                        <span class="module-14-featured__camera">
                            <span class="module-14-featured__camera-icon"></span>
                        </span>

                        <span class="module-14-featured__comments">
                            <?php echo esc_html($comments_number); ?>
                        </span>

                        <!-- Nội dung đè lên ảnh -->
                        <div class="module-14-featured__content">

                            <h3 class="module-14-featured__title">
                                <?php the_title(); ?>
                            </h3>

                            <div class="module-14-featured__excerpt">
                                <?php
                                echo esc_html(
                                    wp_trim_words(
                                        get_the_excerpt(),
                                        18,
                                        '...'
                                    )
                                );
                                ?>
                            </div>

                        </div>

                    </div>

                </a>

            </article>

        <?php endwhile; ?>

    </div>


    <div class="module-14-featured__dots">

        <span class="module-14-featured__dot active"></span>
        <span class="module-14-featured__dot"></span>
        <span class="module-14-featured__dot"></span>

    </div>

</section>

<?php
endif;

wp_reset_postdata();
?>