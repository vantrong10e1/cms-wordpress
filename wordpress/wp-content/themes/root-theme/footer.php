<?php
// MODULE (3) - FOOTER THEO MẪU BOOTSNIPP rIXdE
if (file_exists(get_template_directory() . '/modules/module-3-footer.php')) {
    include get_template_directory() . '/modules/module-3-footer.php';
}
?>

<?php
if (is_front_page() || is_home() || is_single() || is_search() || is_archive()) :
?>
    <section class="widget-test-4-area">
        <?php
        if (is_active_sidebar('widget_test_4')) {
            dynamic_sidebar('widget_test_4');
        } elseif (class_exists('Root_Theme_Widget_Test_4')) {
            the_widget(
                'Root_Theme_Widget_Test_4',
                array(),
                array(
                    'before_widget' => '<div class="widget widget-test-4-widget">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h2 class="widget-title">',
                    'after_title'   => '</h2>',
                )
            );
        }
        ?>
    </section>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>