<?php get_header(); ?>

<main class="home-page">

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