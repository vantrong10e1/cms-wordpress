<?php
/**
 * The template for displaying comments (Module 8: Make a Post Bootsnipp)
 * Theme: Root Theme
 */

if (post_password_required()) {
    return;
}

// Gọi template Module 8
if (file_exists(get_template_directory() . '/modules/module-8-comments.php')) {
    include get_template_directory() . '/modules/module-8-comments.php';
    return;
}
?>

<section id="comments" class="comments-area tdc-module-8-container">
    <div class="tdc-make-post-card-wrapper">
        <div class="tdc-make-a-post-card">
            <div class="tdc-make-a-post-tab">Make a Post</div>
            <form action="<?php echo esc_url(site_url('/wp-comments-post.php')); ?>" method="post" id="commentform" class="tdc-make-post-form">
                <div class="tdc-make-a-post-body">
                    <textarea id="comment" name="comment" class="tdc-make-a-post-textarea" placeholder="What are you thinking..." required="required" rows="4"></textarea>
                </div>
                <?php if (!is_user_logged_in()) : ?>
                    <div class="tdc-comment-guest-fields">
                        <input type="text" name="author" id="author" placeholder="Họ và tên *" required="required" class="tdc-guest-input">
                        <input type="email" name="email" id="email" placeholder="Email *" required="required" class="tdc-guest-input">
                    </div>
                <?php endif; ?>
                <div class="tdc-make-a-post-footer">
                    <button name="submit" type="submit" id="submit" class="tdc-make-post-share-btn">share</button>
                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', get_the_ID()); ?>
                </div>
            </form>
        </div>
    </div>

    <?php if (have_comments()) : ?>
        <div class="existing-comments tdc-existing-comments">
            <h3 class="comments-title"><?php echo esc_html(get_comments_number()); ?> Bình luận</h3>
            <ol class="comment-list">
                <?php
                wp_list_comments(array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 48,
                ));
                ?>
            </ol>
        </div>
    <?php endif; ?>
</section>