<?php
/**
 * The sidebar template containing Module 9, Module 10, Module 11
 * Theme: Root Theme
 */
?>
<aside id="secondary" class="site-sidebar home-sidebar tdc-sidebar-area" role="complementary">


    <!-- MODULE (9): CATEGORIES PHONG CÁCH KHOA CNTT -->
    <?php
    global $wpdb;

    $tdc_categories = $wpdb->get_results("
        SELECT t.term_id, t.name, t.slug
        FROM {$wpdb->terms} t
        INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id
        WHERE tt.taxonomy = 'category'
        ORDER BY t.name ASC
    ");
    ?>
    <section class="widget tdc-fit-categories-widget">
        <div class="tdc-fit-categories-box">
            <h3 class="tdc-fit-categories-title">Categories</h3>
            <div class="tdc-fit-title-stripe"></div>
            <ul class="tdc-fit-categories-list">
                <?php if (!empty($tdc_categories)) : ?>
                    <?php foreach ($tdc_categories as $tdc_category) : ?>
                        <li>
                            <span class="tdc-fit-bullet">&#8226;</span>
                            <a href="<?php echo esc_url(get_category_link($tdc_category->term_id)); ?>" class="tdc-fit-cat-link">
                                <?php echo esc_html($tdc_category->name); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li>Chưa có chuyên mục nào</li>
                <?php endif; ?>
            </ul>
        </div>
    </section>

    <!-- MODULE (10): RECENT POSTS -->
    <?php
    $tdc_recent_posts = new WP_Query(array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
    ?>

    <section class="tdc-module-10">
        <?php if ($tdc_recent_posts->have_posts()) : ?>

            <div class="tdc-module-10-list">

                <?php while ($tdc_recent_posts->have_posts()) : $tdc_recent_posts->the_post(); ?>

                    <article class="tdc-module-10-item">

                        <div class="tdc-module-10-date">
                            <span class="tdc-date-day">
                                <?php echo esc_html(get_the_date('d')); ?>
                            </span>

                            <span class="tdc-date-month">
                                <?php echo esc_html(get_the_date('m')); ?>
                            </span>

                            <span class="tdc-date-year">
                                <?php echo esc_html(get_the_date('y')); ?>
                            </span>
                        </div>

                        <div class="tdc-module-10-content">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </div>

                    </article>

                <?php endwhile; ?>

            </div>

        <?php else : ?>

            <div class="tdc-module-10-empty">
                Chưa có bài viết nào.
            </div>

        <?php endif; ?>

        <div class="tdc-module-10-footer">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                XEM TẤT CẢ TIN TỨC
            </a>
        </div>

    </section>

    <?php wp_reset_postdata(); ?>

    <!-- MODULE (11): ARCHIVE / XEM NHIỀU 2 CỘT PHONG CÁCH VNEXPRESS -->
    <?php
    $tdc_popular_posts = new WP_Query(array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 8,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
    ?>

    <section class="tdc-module-11">

        <div class="tdc-module-11-header">
            <h3 class="tdc-module-11-title">Xem nhiều</h3>
            <span class="tdc-module-11-menu">&#8942;</span>
        </div>

        <?php if ($tdc_popular_posts->have_posts()) : ?>

            <div class="tdc-module-11-list">

                <?php
                $tdc_popular_number = 1;

                while ($tdc_popular_posts->have_posts()) :
                    $tdc_popular_posts->the_post();
                ?>

                    <article class="tdc-module-11-item">

                        <div class="tdc-module-11-number">
                            <?php echo esc_html($tdc_popular_number); ?>
                        </div>

                        <div class="tdc-module-11-content">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </div>

                    </article>

                <?php
                    $tdc_popular_number++;
                endwhile;
                ?>

            </div>

        <?php else : ?>

            <div class="tdc-module-11-empty">
                Chưa có bài viết nào.
            </div>

        <?php endif; ?>

    </section>

    <?php wp_reset_postdata(); ?>
    
    <!-- MODULE (12): COMMENTS -->
    <?php
    $tdc_recent_comments = new WP_Comment_Query();

    $tdc_comments = $tdc_recent_comments->query(array(
        'status'  => 'approve',
        'type'    => 'comment',
        'number'  => 3,
        'orderby' => 'comment_date',
        'order'   => 'DESC',
    ));
    ?>

    <section class="widget tdc-module-12">

        <div class="tdc-module-12-header">
            <h3 class="tdc-module-12-title">Comments</h3>
            <div class="tdc-module-12-stripe"></div>
        </div>

        <?php if (!empty($tdc_comments)) : ?>

            <div class="tdc-module-12-list">

                <?php foreach ($tdc_comments as $tdc_comment) : ?>

                    <article class="tdc-module-12-item">

                        <a
                            href="<?php echo esc_url(get_comment_link($tdc_comment->comment_ID)); ?>"
                            class="tdc-module-12-comment"
                        >
                            <?php
                            echo esc_html(
                                wp_trim_words(
                                    $tdc_comment->comment_content,
                                    12,
                                    '...'
                                )
                            );
                            ?>
                        </a>

                    </article>

                <?php endforeach; ?>

            </div>

        <?php else : ?>

            <div class="tdc-module-12-empty">
                Chưa có bình luận nào.
            </div>

        <?php endif; ?>

    </section>
    <!-- DYNAMIC SIDEBAR (Nếu có widget được kéo thả thêm trong wp-admin) -->
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <div class="dynamic-sidebar-widgets">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </div>
    <?php endif; ?>

</aside>
