<?php
/**
 * Template for Search Page (Module 4: Search Form & Module 5: Search Results)
 * Theme: Root Theme - Module 4: Search Form (Bootsnipp 35V6b) & Module 5: Search Results (FIT TDC Style)
 */
get_header();
?>

<main class="search-page tdc-search-container">

    <?php if (have_posts()) : ?>

        <!-- MODULE (5) - SEARCH RESULTS -->
        <section class="search-result-header tdc-has-results-header">
            <h1 class="tdc-search-title">
                Search: <span>"<?php echo esc_html(get_search_query()); ?>"</span>
            </h1>
        </section>

        <section class="search-results tdc-search-results-list">

            <?php while (have_posts()) : the_post(); ?>
                <?php
                // Gợi ý từ đề bài Module 5:
                $post_date  = get_the_date('d');
                $post_month = get_the_date('m');
                ?>
                <article class="search-result-card tdc-search-item-card">

                    <!-- 1. HÌNH ẢNH BÊN TRÁI -->
                    <div class="result-image tdc-search-thumb-box">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', array('class' => 'tdc-search-thumbnail')); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>" class="tdc-search-no-thumb">
                                <div class="tdc-search-thumb-placeholder">
                                    <span>TDC FIT</span>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- 2. Ô NGÀY THÁNG Ở GIỮA -->
                    <div class="result-date tdc-search-date-box">
                        <div class="result-day tdc-search-day">
                            <?php echo esc_html($post_date); ?>
                        </div>
                        <div class="result-month tdc-search-month">
                            THÁNG <?php echo esc_html($post_month); ?>
                        </div>
                    </div>

                    <!-- 3. TIÊU ĐỀ & NỘI DUNG BÊN PHẢI -->
                    <div class="result-content tdc-search-content-box">
                        <h2 class="tdc-search-item-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <p class="tdc-search-item-excerpt">
                            <?php
                            echo esc_html(wp_trim_words(
                                get_the_excerpt(),
                                25,
                                '[...]'
                            ));
                            ?>
                        </p>
                    </div>

                </article>
            <?php endwhile; ?>

            <!-- Phân trang tìm kiếm -->
            <div class="home-pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '« Previous',
                    'next_text' => 'Next »',
                ));
                ?>
            </div>

        </section>

    <?php else : ?>

        <!-- MODULE (4) - KHÔNG CÓ KẾT QUẢ TÌM KIẾM (BOOTSNIPP 35V6b) -->
        <section class="tdc-search-not-found-wrapper">
            
            <div class="tdc-search-not-found-header">
                <h1 class="tdc-search-keyword-highlight">
                    Search: <span>"<?php echo esc_html(get_search_query()); ?>"</span>
                </h1>
                <p class="tdc-search-not-found-msg">
                    We could not find any results for your search. You can give it another try through the search form below.
                </p>
            </div>

            <div class="tdc-search-form-banner">
                <form class="tdc-large-search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="tdc-search-input-wrap">
                        <span class="tdc-search-lens-icon">&#128269;</span>
                        <input
                            type="search"
                            name="s"
                            class="tdc-search-banner-input"
                            placeholder="Search topics or keywords"
                            value="<?php echo esc_attr(get_search_query()); ?>"
                            required
                        >
                    </div>
                    <button type="submit" class="tdc-search-banner-btn">
                        Search
                    </button>
                </form>
            </div>

        </section>

    <?php endif; ?>

</main>

<?php get_footer(); ?>