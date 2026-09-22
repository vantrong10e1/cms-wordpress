<?php
/**
 * MODULE (9) - CATEGORIES (PHONG CÁCH KHOA CNTT - TDC / FIT TDC)
 * Đặc trưng: Tiêu đề có gạch sọc pattern mờ, danh sách bullet tròn màu vàng, link xanh gạch chân khi hover
 */
?>
<section class="widget tdc-fit-categories-widget">
    <div class="tdc-fit-categories-box">
        <h3 class="tdc-fit-categories-title">Categories</h3>
        <div class="tdc-fit-title-stripe"></div>
        <ul class="tdc-fit-categories-list">
            <?php
            $categories = get_categories(array(
                'orderby'    => 'name',
                'order'      => 'ASC',
                'hide_empty' => false,
            ));

            if (!empty($categories)) :
                foreach ($categories as $cat) :
                    $cat_link = esc_url(get_category_link($cat->term_id));
                    ?>
                    <li>
                        <span class="tdc-fit-bullet">&#8226;</span>
                        <a href="<?php echo $cat_link; ?>" class="tdc-fit-cat-link">
                            <?php echo esc_html($cat->name); ?>
                        </a>
                    </li>
                <?php
                endforeach;
            else :
                ?>
                <li>Chưa có chuyên mục nào</li>
            <?php endif; ?>
        </ul>
    </div>
</section>
