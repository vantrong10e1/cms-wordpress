<?php
/**
 * MODULE (3) - FOOTER THEO MẪU BOOTSNIPP rIXdE
 *
 * Theme: Root Theme
 */
?>

<footer class="site-footer">
    <div class="footer-container">
        <!-- Cột 1: Giới thiệu -->
        <div class="footer-column">
            <h3 data-i18n="footer_about">Về chúng tôi</h3>
            <p data-i18n="footer_about_desc" style="line-height: 1.6; color: inherit; opacity: 0.9;">
                Website cung cấp tin tức nhanh chóng, chính xác về công nghệ, đời sống và thể thao.
            </p>
        </div>

        <!-- Cột 2: Danh mục & Liên kết -->
        <div class="footer-column">
            <h3 data-i18n="footer_links">Liên kết nhanh</h3>
            <ul>
                <li>
                    <a href="<?php echo esc_url(home_url('/')); ?>" data-i18n="menu_home">🏠 Trang chủ</a>
                </li>
                <li>
                    <a href="<?php echo esc_url(home_url('/?cat=3')); ?>" data-i18n="menu_sports">⚽ Thể thao</a>
                </li>
                <li>
                    <a href="<?php echo esc_url(home_url('/?cat=2')); ?>" data-i18n="menu_science">🔬 Khoa học - Công nghệ</a>
                </li>
                <li>
                    <a href="<?php echo esc_url(home_url('/?cat=5')); ?>" data-i18n="menu_news">📰 Tin tức đời sống</a>
                </li>
            </ul>
        </div>

        <!-- Cột 3: Liên hệ & Hỗ trợ -->
        <div class="footer-column">
            <h3 data-i18n="footer_contact">Liên hệ</h3>
            <ul>
                <li>Email: contact@groupd.local</li>
                <li>Hotline: 1900 1234</li>
                <li><a href="#" class="open-profile-settings-link" data-i18n="settings">⚙️ Cài đặt</a></li>
            </ul>
        </div>
    </div>

    <!-- Mạng xã hội -->
    <div class="footer-social">
        <a href="#" title="Facebook" aria-label="Facebook">
            <i class="fa fa-facebook" aria-hidden="true"></i>
        </a>
        <a href="#" title="Twitter" aria-label="Twitter">
            <i class="fa fa-twitter" aria-hidden="true"></i>
        </a>
        <a href="#" title="YouTube" aria-label="YouTube">
            <i class="fa fa-youtube-play" aria-hidden="true"></i>
        </a>
        <a href="#" title="GitHub" aria-label="GitHub">
            <i class="fa fa-github" aria-hidden="true"></i>
        </a>
    </div>

    <!-- Bản quyền -->
    <div class="footer-copyright">
        <p data-i18n="footer_copyright">© 2026 Group D. Tất cả các quyền được bảo lưu.</p>
    </div>
</footer>
