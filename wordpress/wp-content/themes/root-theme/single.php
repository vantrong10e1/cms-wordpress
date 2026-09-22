<?php get_header(); ?>

<main class="single-page">

    


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