<?php
/**
 * MODULE (3) - FOOTER THEO MẪU BOOTSNIPP rIXdE
 * Link mẫu: https://bootsnipp.com/snippets/rIXdE
 * Tác giả gốc: Sunlimetech
 * Yêu cầu:
 * - Thay "Quick links" thành 3 cột tương ứng: Comments, Categories, Last posts
 * - Toàn bộ dữ liệu được lấy động từ Database
 */
?>
<!-- Footer Bootsnipp rIXdE -->
<section id="footer" class="site-footer">
    <div class="footer-container">
        <div class="footer-row">

            <!-- CỘT 1: Comments (Bình luận mới nhất từ Database) -->
            <div class="footer-col">
                <h5>Comment</h5>
                <ul class="list-unstyled quick-links">
                    <?php
                    $footer_comments = get_comments(array(
                        'number' => 5,
                        'status' => 'approve',
                    ));

                    if (!empty($footer_comments)) :
                        foreach ($footer_comments as $c_item) :
                            $author = !empty($c_item->comment_author) ? $c_item->comment_author : 'Khách';
                            $content_snippet = wp_trim_words(wp_strip_all_tags($c_item->comment_content), 5, '...');
                            $display_text = $author . ': ' . $content_snippet;
                            ?>
                            <li>
                                <a href="<?php echo esc_url(get_comment_link($c_item->comment_ID)); ?>" title="<?php echo esc_attr($c_item->comment_author . ': ' . wp_strip_all_tags($c_item->comment_content)); ?>">
                                    <i class="fa fa-angle-double-right"></i><?php echo esc_html($display_text); ?>
                                </a>
                            </li>
                        <?php
                        endforeach;
                    else :
                        ?>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa fa-angle-double-right"></i>Chưa có bình luận</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- CỘT 2: Categories (Chuyên mục từ Database) -->
            <div class="footer-col">
                <h5>Categories</h5>
                <ul class="list-unstyled quick-links">
                    <?php
                    $footer_categories = get_categories(array(
                        'number'     => 5,
                        'orderby'    => 'count',
                        'order'      => 'DESC',
                        'hide_empty' => false,
                    ));

                    if (!empty($footer_categories)) :
                        foreach ($footer_categories as $cat_item) :
                            ?>
                            <li>
                                <a href="<?php echo esc_url(get_category_link($cat_item->term_id)); ?>" title="<?php echo esc_attr($cat_item->name); ?>">
                                    <i class="fa fa-angle-double-right"></i><?php echo esc_html($cat_item->name); ?>
                                </a>
                            </li>
                        <?php
                        endforeach;
                    else :
                        ?>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa fa-angle-double-right"></i>Tin tức</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- CỘT 3: Last posts (Bài viết mới nhất từ Database) -->
            <div class="footer-col">
                <h5>Last posts</h5>
                <ul class="list-unstyled quick-links">
                    <?php
                    $footer_posts = wp_get_recent_posts(array(
                        'numberposts' => 5,
                        'post_status' => 'publish',
                    ));

                    if (!empty($footer_posts)) :
                        foreach ($footer_posts as $post_item) :
                            $post_title = wp_trim_words($post_item['post_title'], 6, '...');
                            ?>
                            <li>
                                <a href="<?php echo esc_url(get_permalink($post_item['ID'])); ?>" title="<?php echo esc_attr($post_item['post_title']); ?>">
                                    <i class="fa fa-angle-double-right"></i><?php echo esc_html($post_title); ?>
                                </a>
                            </li>
                        <?php
                        endforeach;
                        wp_reset_query();
                    else :
                        ?>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><i class="fa fa-angle-double-right"></i>Bài viết mới</a></li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>

        <!-- Social Icons (Bootsnipp rIXdE) -->
        <div class="footer-social-row">
            <ul class="list-unstyled list-inline social text-center">
                <li class="list-inline-item">
                    <a href="https://www.facebook.com" target="_blank" aria-label="Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="https://twitter.com" target="_blank" aria-label="Twitter">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="https://www.instagram.com" target="_blank" aria-label="Instagram">
                        <i class="fa fa-instagram"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="https://plus.google.com" target="_blank" aria-label="Google Plus">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="mailto:contact@sunlimetech.com" aria-label="Email">
                        <i class="fa fa-envelope"></i>
                    </a>
                </li>
            </ul>
        </div>
        <hr class="footer-divider">

        <!-- Copyright (Bootsnipp rIXdE) -->
        <div class="footer-copyright text-center">
            <p>
                <u><a href="https://www.nationaltransaction.com/" target="_blank">National Transaction Corporation</a></u>
                is a Registered MSP/ISO of Elavon, Inc. Georgia [a wholly owned subsidiary of U.S. Bancorp, Minneapolis, MN]
            </p>
            <p class="copyright-author">
                © All right Reversed. <a class="text-green ml-2" href="https://www.sunlimetech.com" target="_blank">Sunlimetech</a>
            </p>
        </div>

    </div>
</section>
