<?php get_header(); ?>

<main class="single-page">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <article class="single-post">

                <!-- =====================================
                     POST HEADER
                ====================================== -->

                <header class="single-post-header">

                    <h1 class="single-post-title">
                        <?php the_title(); ?>
                    </h1>


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