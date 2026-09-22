<?php
/**
 * MODULE (11) - ARCHIVE / TOP BÀI VIẾT 2 CỘT (PHONG CÁCH VNEXPRESS "XEM NHIỀU")
 * Đặc trưng: Tiêu đề gạch chân đỏ, danh sách 8 bài viết chia 2 cột đều nhau, số thứ tự 1-8 to đậm
 */

$archive_count = isset($args['count']) ? absint($args['count']) : 8;
$archive_title = isset($args['title']) ? $args['title'] : 'Xem nhiều';

$archive_query = new WP_Query(array(
    'posts_per_page'      => $archive_count,
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
));

$all_posts = $archive_query->posts;
$half = ceil(count($all_posts) / 2);
$col1 = array_slice($all_posts, 0, $half);
$col2 = array_slice($all_posts, $half);
?>
<section class="widget tdc-vne-archive-widget">
    <div class="tdc-vnexpress-wrap">
        <?php if (!empty($archive_title)) : ?>
            <div class="tdc-vne-header">
                <h3 class="tdc-vne-title"><?php echo esc_html($archive_title); ?></h3>
            </div>
        <?php endif; ?>

        <div class="tdc-vne-grid">
            <!-- Cột 1 (Số 1 -> 4) -->
            <div class="tdc-vne-col">
                <?php
                $idx = 1;
                foreach ($col1 as $p) :
                    $permalink = esc_url(get_permalink($p->ID));
                    $comment_count = get_comments_number($p->ID);
                    ?>
                    <div class="tdc-vne-item">
                        <div class="tdc-vne-number"><?php echo $idx; ?></div>
                        <div class="tdc-vne-title-wrap">
                            <a href="<?php echo $permalink; ?>" class="tdc-vne-item-title">
                                <?php echo esc_html(get_the_title($p->ID)); ?>
                            </a>
                            <?php if ($comment_count > 0) : ?>
                                <span class="tdc-vne-comments-count">&#128172; <?php echo esc_html($comment_count); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                    $idx++;
                endforeach;
                ?>
            </div>

            <!-- Cột 2 (Số 5 -> 8) -->
            <div class="tdc-vne-col">
                <?php
                foreach ($col2 as $p) :
                    $permalink = esc_url(get_permalink($p->ID));
                    $comment_count = get_comments_number($p->ID);
                    ?>
                    <div class="tdc-vne-item">
                        <div class="tdc-vne-number"><?php echo $idx; ?></div>
                        <div class="tdc-vne-title-wrap">
                            <a href="<?php echo $permalink; ?>" class="tdc-vne-item-title">
                                <?php echo esc_html(get_the_title($p->ID)); ?>
                            </a>
                            <?php if ($comment_count > 0) : ?>
                                <span class="tdc-vne-comments-count">&#128172; <?php echo esc_html($comment_count); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                    $idx++;
                endforeach;
                ?>
            </div>
        </div>
    </div>
</section>
