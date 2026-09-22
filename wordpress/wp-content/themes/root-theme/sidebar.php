<?php
/**
 * The sidebar template containing Module 9, Module 10, Module 11
 * Theme: Root Theme
 */
?>
<aside id="secondary" class="site-sidebar home-sidebar tdc-sidebar-area" role="complementary">



    <!-- MODULE (10): 10 BÀI VIẾT MỚI NHẤT PHONG CÁCH FIT TDC -->
    <?php
    if (file_exists(get_template_directory() . '/modules/module-10-recent-posts.php')) {
        include get_template_directory() . '/modules/module-10-recent-posts.php';
    }
    ?>

    <!-- MODULE (11): ARCHIVE / XEM NHIỀU 2 CỘT PHONG CÁCH VNEXPRESS -->
    <?php
    if (file_exists(get_template_directory() . '/modules/module-11-archive.php')) {
        include get_template_directory() . '/modules/module-11-archive.php';
    }
    ?>

    <!-- DYNAMIC SIDEBAR (Nếu có widget được kéo thả thêm trong wp-admin) -->
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <div class="dynamic-sidebar-widgets">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </div>
    <?php endif; ?>

</aside>