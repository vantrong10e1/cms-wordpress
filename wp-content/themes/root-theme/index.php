<?php if (!defined("ABSPATH")) { header("Location: " . (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . preg_replace("#/wp-content/themes/.*#", "/", $_SERVER["REQUEST_URI"])); exit; } ?>
<?php get_header(); ?>

<!-- ===================== (2) MODULE CONTENT (fit.tdc.edu.vn) ===================== -->
<div class="site-container fit-content-wrapper">
  <main class="content-area fit-main-content">
    
    <?php if (have_posts()): ?>
      <div class="fit-posts-list">
        <?php while (have_posts()): the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('fit-post-item'); ?>>
            
            <!-- Date box: Ngày số to phía trên, THÁNG MM ở dưới -->
            <div class="fit-date-box">
              <span class="fit-day"><?php echo get_the_date('d'); ?></span>
              <span class="fit-month"><?php echo 'THÁNG ' . get_the_date('m'); ?></span>
            </div>

            <!-- Content: Tiêu đề in hoa màu xanh + đoạn trích dẫn excerpt -->
            <div class="fit-content">
              <h2 class="fit-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>
              <div class="fit-excerpt">
                <?php 
                $excerpt = get_the_excerpt();
                echo esc_html(wp_strip_all_tags($excerpt)); 
                ?>
              </div>
            </div>

          </article>
        <?php endwhile; ?>
      </div>

      <!-- Pagination -->
      <div class="fit-pagination">
        <?php echo paginate_links([
            'prev_text' => '&laquo; Trước',
            'next_text' => 'Sau &raquo;',
        ]); ?>
      </div>

    <?php else: ?>
      <p class="no-posts-text">Chưa có bài viết nào.</p>
    <?php endif; ?>

  </main>
</div>

<?php get_footer(); ?>