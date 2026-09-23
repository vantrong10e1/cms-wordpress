<?php get_header(); ?>

<main class="single-page">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <!-- MODULE ĐỀ XUẤT: READING PROGRESS -->
            <div class="tdc-reading-progress" aria-hidden="true">
                <span class="tdc-reading-progress__bar"></span>
            </div>

            <article class="single-post">

                <!-- =====================================
                     POST HEADER
                ====================================== -->

                <header class="single-post-header">

                    <div class="tdc-single-heading-content">
                        <h1 class="single-post-title">
                            <?php the_title(); ?>
                        </h1>

                        <?php $reading_time = root_theme_get_reading_time(get_the_content()); ?>
                        <div class="tdc-reading-meta" aria-label="Thời gian đọc dự kiến">
                            <svg class="tdc-reading-meta__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                <circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2"></circle>
                                <path d="M12 7v5l3 2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span>Đã đọc được <?php echo esc_html($reading_time); ?> phút</span>
                        </div>
                    </div>


                    <!-- DATE -->
                    <div class="single-post-date">

                        <div class="single-date-day">
                            <?php echo get_the_date('d'); ?>
                        </div>

                        <div class="single-date-month">
                            <?php echo get_the_date('m'); ?>
                        </div>

                        <div class="single-date-year">
                            '<?php echo get_the_date('y'); ?>
                        </div>

                    </div>

                </header>


                <!-- =====================================
                     DIVIDER
                ====================================== -->

                <div class="single-divider">

                    <span></span>

                </div>


                <!-- =====================================
                     POST CONTENT
                ====================================== -->

                <div class="single-post-content">

                    <?php the_content(); ?>

                </div>


                <!-- =====================================
                     SOURCE
                ====================================== -->

                <div class="single-post-source">

                    (Theo Người Lao Động)

                </div>


                <!-- =====================================
                     PREVIOUS / NEXT
                ====================================== -->

                <?php
                $previous_post = get_previous_post();
                $next_post = get_next_post();
                ?>

                <?php if ($previous_post || $next_post) : ?>

                    <nav class="post-navigation"
                         aria-label="Post navigation">


                        <!-- =================================
                             PREVIOUS POST
                        ================================== -->

                        <?php if ($previous_post) : ?>

                            <div class="post-nav-item">

                                <div class="post-nav-date">

                                    <div class="post-nav-day">
                                        <?php
                                        echo get_the_date(
                                            'd',
                                            $previous_post
                                        );
                                        ?>
                                    </div>

                                    <div class="post-nav-month">
                                        <?php
                                        echo get_the_date(
                                            'm',
                                            $previous_post
                                        );
                                        ?>
                                    </div>

                                    <div class="post-nav-year">
                                        <?php
                                        echo get_the_date(
                                            'y',
                                            $previous_post
                                        );
                                        ?>
                                    </div>

                                </div>


                                <div class="post-nav-title">

                                    <a href="<?php echo esc_url(
                                        get_permalink($previous_post)
                                    ); ?>">

                                        <?php echo esc_html(
                                            get_the_title($previous_post)
                                        ); ?>

                                    </a>

                                </div>

                            </div>

                        <?php endif; ?>


                        <!-- =================================
                             NEXT POST
                        ================================== -->

                        <?php if ($next_post) : ?>

                            <div class="post-nav-item">

                                <div class="post-nav-date">

                                    <div class="post-nav-day">
                                        <?php
                                        echo get_the_date(
                                            'd',
                                            $next_post
                                        );
                                        ?>
                                    </div>

                                    <div class="post-nav-month">
                                        <?php
                                        echo get_the_date(
                                            'm',
                                            $next_post
                                        );
                                        ?>
                                    </div>

                                    <div class="post-nav-year">
                                        <?php
                                        echo get_the_date(
                                            'y',
                                            $next_post
                                        );
                                        ?>
                                    </div>

                                </div>


                                <div class="post-nav-title">

                                    <a href="<?php echo esc_url(
                                        get_permalink($next_post)
                                    ); ?>">

                                        <?php echo esc_html(
                                            get_the_title($next_post)
                                        ); ?>

                                    </a>

                                </div>

                            </div>

                        <?php endif; ?>

                    </nav>

                <?php endif; ?>

                <?php root_theme_render_post_reactions(get_the_ID()); ?>

                    <!-- =====================================
                        COMMENTS
                    ====================================== -->

                    <?php
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                    ?>

            </article>

        <?php endwhile; ?>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
