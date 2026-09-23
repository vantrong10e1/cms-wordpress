<?php
get_header();

global $wpdb;
$module_13_posts = $wpdb->get_results("
    SELECT ID, post_title, post_content, post_excerpt
    FROM {$wpdb->posts}
    WHERE post_type = 'post'
      AND post_status = 'publish'
    ORDER BY post_date DESC
    LIMIT 3
");
?>

<main class="home-page">

    <?php if (!empty($module_13_posts)) : ?>
        <!-- MODULE 13: 3 bài viết trên một hàng, responsive thành 1 cột -->
        <section class="tdc-module-13" aria-labelledby="tdc-module-13-title">
            <h2 id="tdc-module-13-title" class="tdc-module-13__heading">Pages</h2>

            <div class="tdc-module-13__grid">
                <?php foreach ($module_13_posts as $module_13_index => $module_13_post) :
                    $module_13_url = get_permalink($module_13_post->ID);
                    $module_13_excerpt = !empty($module_13_post->post_excerpt)
                        ? $module_13_post->post_excerpt
                        : $module_13_post->post_content;
                    $module_13_image_url = root_theme_get_module_13_image_url(
                        $module_13_post->ID,
                        $module_13_post->post_content
                    );

                    if ($module_13_index === 0) {
                        $module_13_image_url = get_template_directory_uri() . '/assets/images/module-13-football.png';
                    }
                ?>
                    <article class="tdc-module-13__card">
                        <?php if ($module_13_image_url) : ?>
                            <a class="tdc-module-13__image-link" href="<?php echo esc_url($module_13_url); ?>" aria-label="<?php echo esc_attr($module_13_post->post_title); ?>">
                                <img class="tdc-module-13__image" src="<?php echo esc_url($module_13_image_url); ?>" alt="<?php echo esc_attr($module_13_post->post_title); ?>" loading="lazy">
                            </a>
                        <?php else : ?>
                            <a class="tdc-module-13__placeholder" href="<?php echo esc_url($module_13_url); ?>" aria-label="<?php echo esc_attr($module_13_post->post_title); ?>"></a>
                        <?php endif; ?>

                        <div class="tdc-module-13__body">
                            <h3 class="tdc-module-13__title">
                                <a href="<?php echo esc_url($module_13_url); ?>"><?php echo esc_html($module_13_post->post_title); ?></a>
                            </h3>
                            <p class="tdc-module-13__excerpt">
                                <?php echo esc_html(wp_trim_words(wp_strip_all_tags($module_13_excerpt), 24, '...')); ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <div class="home-layout">

        <!-- ================================
             MAIN CONTENT
        ================================= -->

        <section class="home-content">

            <div class="section-heading">
                <h1>Latest Posts</h1>
            </div>

            <?php if (have_posts()) : ?>

                <div class="news-list">

                    <?php while (have_posts()) : the_post(); ?>

                        <article class="news-item tdc-content-post-card">

                            <!-- DATE (Module 2 FIT TDC) -->
                            <div class="news-date tdc-post-date-col">
                                <span class="date-day"><?php echo esc_html(get_the_date('d')); ?></span>
                                <span class="date-month">THÁNG <?php echo esc_html(get_the_date('m')); ?></span>
                            </div>

                            <!-- CONTENT (Module 2 FIT TDC) -->
                            <div class="news-content tdc-post-content-col">
                                <h2 class="tdc-post-card-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <p class="tdc-post-card-excerpt">
                                    <?php
                                    echo esc_html(
                                        wp_trim_words(
                                            get_the_excerpt(),
                                            30,
                                            '[...]'
                                        )
                                    );
                                    ?>
                                </p>
                            </div>

                        </article>

                    <?php endwhile; ?>

                </div>


                <!-- ================================
                     PAGINATION
                ================================= -->

                <div class="home-pagination">

                    <?php
                    the_posts_pagination(
                        array(
                            'mid_size'  => 2,
                            'prev_text' => '« Previous',
                            'next_text' => 'Next »',
                        )
                    );
                    ?>

                </div>


            <?php else : ?>

                <div class="no-posts">

                    <h2>No posts found.</h2>

                    <p>
                        There are currently no posts to display.
                    </p>

                </div>

            <?php endif; ?>

        </section>


        <!-- ================================
             SIDEBAR (Modules 9, 10, 11)
        ================================= -->
        <?php get_sidebar(); ?>

    </div>

</main>

<?php get_footer(); ?>
