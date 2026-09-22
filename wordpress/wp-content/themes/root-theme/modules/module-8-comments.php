<?php
/**
 * MODULE (8) - FORM BINH LUAN "MAKE A POST" (BOOTSNIPP) & DANH SACH BINH LUAN
 * Vi tri: Hien thi o cuoi trang chi tiet bai viet (single.php)
 */

if (post_password_required()) {
    return;
}
?>

<section id="comments" class="comments-area tdc-module-8-container">

    <!-- FORM MAKE A POST (BOOTSNIPP) -->
    <div class="tdc-make-post-card-wrapper">
        <div class="tdc-make-a-post-card">
            <div class="tdc-make-a-post-tab">Make a Post</div>

            <?php if (comments_open()) : ?>
            <form action="<?php echo esc_url(site_url('/wp-comments-post.php')); ?>" method="post" id="commentform" class="tdc-make-post-form">

                <?php comment_id_fields(); ?>
                <input type="hidden" name="redirect_to" value="<?php echo esc_url(get_permalink()); ?>">

                <div class="tdc-make-a-post-body">
                    <textarea
                        id="comment"
                        name="comment"
                        class="tdc-make-a-post-textarea"
                        placeholder="What are you thinking..."
                        required="required"
                        rows="4"
                    ></textarea>
                </div>

                <?php if (!is_user_logged_in()) : ?>
                    <div class="tdc-comment-guest-fields">
                        <input type="text" name="author" id="author" placeholder="Ho va ten *" required="required" class="tdc-guest-input">
                        <input type="email" name="email" id="email" placeholder="Email *" required="required" class="tdc-guest-input">
                        <input type="url" name="url" id="url" placeholder="Website (tuy chon)" class="tdc-guest-input">
                    </div>
                <?php else : ?>
                    <div class="tdc-logged-in-info">
                        <?php
                        $current_user = wp_get_current_user();
                        echo '<p>Dang nhap voi tu cach <strong>' . esc_html($current_user->display_name) . '</strong>. ';
                        echo '<a href="' . esc_url(wp_logout_url(get_permalink())) . '">Dang xuat?</a></p>';
                        ?>
                    </div>
                <?php endif; ?>

                <div class="tdc-make-a-post-footer">
                    <button name="submit" type="submit" id="submit" class="tdc-make-post-share-btn">share</button>
                </div>

            </form>
            <?php else : ?>
                <p class="tdc-comments-closed">Binh luan da duoc dong cho bai viet nay.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- DANH SACH BINH LUAN DA CO -->
    <?php if (have_comments()) : ?>
        <div class="existing-comments tdc-existing-comments">
            <h3 class="comments-title">
                <?php echo esc_html(get_comments_number()) . ' Binh luan'; ?>
            </h3>

            <ol class="comment-list">
                <?php
                wp_list_comments(array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 48,
                ));
                ?>
            </ol>

            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                <nav class="comment-navigation" role="navigation">
                    <div class="nav-previous"><?php previous_comments_link('&laquo; Binh luan cu hon'); ?></div>
                    <div class="nav-next"><?php next_comments_link('Binh luan moi hon &raquo;'); ?></div>
                </nav>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</section>
