<?php if (root_theme_widget_test_4_is_visible()) : ?>
    <aside class="tdc-widget-test-4-area" aria-label="Thông tin website và tòa soạn">
        <?php
        if (!is_active_sidebar('widget_test_4') || !dynamic_sidebar('widget_test_4')) {
            root_theme_render_widget_test_4();
        }
        ?>
    </aside>
<?php endif; ?>

<?php
// MODULE - LATEST NEWS
if (file_exists(get_template_directory() . '/modules/module-latest-news.php')) {
    include get_template_directory() . '/modules/module-latest-news.php';
}
?>

<?php
// MODULE (3) - FOOTER THEO MẪU BOOTSNIPP rIXdE
if (file_exists(get_template_directory() . '/modules/module-3-footer.php')) {
    include get_template_directory() . '/modules/module-3-footer.php';
}
?>

<?php wp_footer(); ?>

</body>
</html>