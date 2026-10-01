<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
    (function () {
        var theme = localStorage.getItem('profile_theme') || 'system';
        var isDark = theme === 'dark' || (theme === 'system' && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);
        if (isDark) {
            document.documentElement.classList.add('profile-theme-dark');
        }
        var lang = localStorage.getItem('profile_language') || 'vi';
        document.documentElement.lang = lang;
    })();
    </script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- MODULE (1) - MAIN HEADER -->
<header class="main-header" id="site-main-header">

    <!-- 1. Logo -->
    <div class="header-logo">
        <a href="<?php echo esc_url(home_url('/')); ?>" title="Group D">
            Group D
        </a>
    </div>

    <!-- 2. Home -->
    <div class="header-home">
        <a href="<?php echo esc_url(home_url('/')); ?>" title="Trang chủ" data-i18n="home">
            Trang chủ
        </a>
    </div>

    <!-- 3. Search -->
    <form
        class="header-search"
        method="get"
        action="<?php echo esc_url(home_url('/')); ?>"
        id="headerSearchForm"
    >
        <input
            type="search"
            name="s"
            id="header-search-input"
            placeholder="Tìm kiếm..."
            data-i18n-placeholder="search_placeholder"
            value="<?php echo esc_attr(get_search_query()); ?>"
            required
        >

        <button
            type="submit"
            id="header-search-submit"
            title="Tìm kiếm"
            data-i18n="search_submit"
        >
            Tìm kiếm
        </button>
    </form>

    <!-- Spacer -->
    <div class="header-spacer"></div>

    <!-- 4. Navigation -->
    <nav class="header-nav">

        <?php
        $thethao = get_category_by_slug('the-thao');
        $thethao_url = $thethao
            ? get_category_link($thethao->term_id)
            : home_url('/?cat=3');

        $congnghe = get_category_by_slug('cong-nghe');
        $congnghe_url = $congnghe
            ? get_category_link($congnghe->term_id)
            : home_url('/?cat=2');

        $doisong = get_category_by_slug('doi-song');
        $doisong_url = $doisong
            ? get_category_link($doisong->term_id)
            : home_url('/?cat=5');
        ?>

        <a href="<?php echo esc_url($thethao_url); ?>" data-i18n="sports">
            Thể thao
        </a>

        <a href="<?php echo esc_url($congnghe_url); ?>" data-i18n="science">
            Khoa học
        </a>

        <a href="<?php echo esc_url($doisong_url); ?>" data-i18n="news">
            Tin tức
        </a>

    </nav>

    <!-- 5. Menu -->
    <div
        class="header-icon-item header-menu-trigger"
        id="headerMenuBtn"
        title="Menu"
    >

        <div class="header-icon menu-icon dots-menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <span data-i18n="menu">Menu</span>

        <div
            class="header-menu-dropdown"
            id="headerMenuDropdown"
        >

            <div class="menu-dropdown-title" data-i18n="menu_categories">
                Danh mục liên kết
            </div>

            <ul class="menu-dropdown-list">

                <li>
                    <a href="<?php echo esc_url(home_url('/')); ?>" data-i18n="menu_home">
                        🏠 Trang chủ
                    </a>
                </li>

                <li>
                    <a href="<?php echo esc_url($thethao_url); ?>" data-i18n="menu_sports">
                        ⚽ Thể thao
                    </a>
                </li>

                <li>
                    <a href="<?php echo esc_url($congnghe_url); ?>" data-i18n="menu_science">
                        🔬 Khoa học - Công nghệ
                    </a>
                </li>

                <li>
                    <a href="<?php echo esc_url($doisong_url); ?>" data-i18n="menu_news">
                        📰 Tin tức đời sống
                    </a>
                </li>

                <?php
                $football = get_category_by_slug('football');
                if ($football) :
                ?>
                    <li>
                        <a href="<?php echo esc_url(get_category_link($football->term_id)); ?>" data-i18n="menu_football">
                            🏆 Football
                        </a>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="<?php echo esc_url(home_url('/demo_4_modules.php')); ?>" data-i18n="menu_demo">
                        📋 Demo 4 Modules
                    </a>
                </li>

                <li>
                    <a href="#" class="open-profile-settings-link" id="openProfileSettingsMenu" data-i18n="menu_settings">
                        ⚙️ Cài đặt
                    </a>
                </li>

            </ul>

        </div>

    </div>

    <!-- 6. Search Icon -->
    <div
        class="header-icon-item header-search-trigger"
        id="headerSearchIconBtn"
        title="Tìm kiếm"
    >

        <div class="header-icon search-icon"></div>

        <span data-i18n="search">Search</span>

    </div>

    <!-- 7. Settings Icon Button -->
    <div
        class="header-icon-item header-settings-trigger open-profile-settings-link"
        id="headerSettingsBtn"
        title="Cài đặt"
        role="button"
        tabindex="0"
    >

        <div class="header-icon settings-icon" style="font-size: 16px; line-height: 22px; display: flex; align-items: center; justify-content: center;">
            ⚙️
        </div>

        <span data-i18n="settings">Settings</span>

    </div>

    <!-- 8. Account -->
    <div
        class="header-account dropdown"
        id="headerAccountDropdown"
    >

        <button
            type="button"
            class="account-btn dropdown-toggle"
            id="accountDropdownBtn"
            aria-expanded="false"
            title="Tài khoản"
        >

            <div class="account-icon">
                <div class="account-head"></div>
                <div class="account-body"></div>
            </div>

            <div class="account-text">
                <span data-i18n="account">Account</span>
                <span class="account-arrow"></span>
            </div>

        </button>

        <!-- Account Dropdown -->
        <ul
            class="dropdown-menu account-dropdown-menu"
            id="accountDropdownMenu"
        >

            <?php if (is_user_logged_in()) : ?>

                <?php $current_user = wp_get_current_user(); ?>

                <li class="dropdown-header">
                    <span data-i18n="hello">Xin chào,</span>
                    <strong>
                        <?php
                        echo esc_html(
                            $current_user->display_name
                            ? $current_user->display_name
                            : $current_user->user_login
                        );
                        ?>
                    </strong>
                </li>

                <li class="dropdown-divider"></li>

                <li>
                    <a
                        href="<?php echo esc_url(admin_url()); ?>"
                        class="dropdown-item"
                    >
                        <span class="dropdown-icon">&#9881;</span>
                        <span data-i18n="admin_dashboard">Trang quản trị</span>
                    </a>
                </li>

                <!-- SETTINGS -->
                <li>
                    <a
                        href="#"
                        class="dropdown-item open-profile-settings-link"
                        id="openProfileSettings"
                    >
                        <span class="dropdown-icon">⚙️</span>
                        <span data-i18n="settings">Cài đặt</span>
                    </a>
                </li>

                <li class="dropdown-divider"></li>

                <li>
                    <a
                        href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>"
                        class="dropdown-item text-danger"
                    >
                        <span class="dropdown-icon">&#128682;</span>
                        <span data-i18n="logout">Đăng xuất</span>
                    </a>
                </li>

            <?php else : ?>

                <!-- SETTINGS FOR GUEST -->
                <li>
                    <a
                        href="#"
                        class="dropdown-item open-profile-settings-link"
                        id="openProfileSettingsGuest"
                    >
                        <span class="dropdown-icon">⚙️</span>
                        <span data-i18n="settings">Cài đặt</span>
                    </a>
                </li>

                <li class="dropdown-divider"></li>

                <li>
                    <a
                        href="<?php echo esc_url(wp_login_url()); ?>"
                        class="dropdown-item"
                    >
                        <span class="dropdown-icon">&#128272;</span>
                        <span data-i18n="login">Đăng nhập</span>
                    </a>
                </li>

                <li>
                    <a
                        href="<?php echo esc_url(site_url('wp-login.php?action=register')); ?>"
                        class="dropdown-item"
                    >
                        <span class="dropdown-icon">&#128221;</span>
                        <span data-i18n="register">Đăng ký tài khoản</span>
                    </a>
                </li>

                <li class="dropdown-divider"></li>

                <li>
                    <a
                        href="<?php echo esc_url(wp_lostpassword_url()); ?>"
                        class="dropdown-item text-muted"
                        data-i18n="forgot_password"
                    >
                        Quên mật khẩu?
                    </a>
                </li>

            <?php endif; ?>

        </ul>

    </div>

</header>


<!-- =========================================================
     MODULE - PROFILE SETTINGS
========================================================= -->

<?php
if (file_exists(get_template_directory() . '/modules/profile-settings.php')) {
    include get_template_directory() . '/modules/profile-settings.php';
}
?>


<!-- =========================================================
     JAVASCRIPT - HEADER INTERACTIONS
========================================================= -->

<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | 1. SEARCH ICON
    |--------------------------------------------------------------------------
    */
    var searchIconBtn = document.getElementById('headerSearchIconBtn');
    var searchInput = document.getElementById('header-search-input');
    var searchForm = document.getElementById('headerSearchForm');

    if (searchIconBtn && searchForm) {
        searchIconBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (searchInput && searchInput.value.trim() !== '') {
                searchForm.submit();
            } else if (searchInput) {
                searchInput.focus();
                searchInput.classList.add('highlight-search');
                setTimeout(function () {
                    searchInput.classList.remove('highlight-search');
                }, 1500);
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | 2. MENU 3 DOTS
    |--------------------------------------------------------------------------
    */
    var menuBtn = document.getElementById('headerMenuBtn');
    var menuDropdown = document.getElementById('headerMenuDropdown');
    var accountDropdown = document.getElementById('headerAccountDropdown');
    var dropdownBtn = document.getElementById('accountDropdownBtn');

    if (menuBtn && menuDropdown) {
        menuBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            menuDropdown.classList.toggle('show');
            if (accountDropdown) {
                accountDropdown.classList.remove('show');
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | 3. ACCOUNT DROPDOWN
    |--------------------------------------------------------------------------
    */
    if (accountDropdown && dropdownBtn) {
        dropdownBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            accountDropdown.classList.toggle('show');
            if (menuDropdown) {
                menuDropdown.classList.remove('show');
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | 4. CLICK OUTSIDE
    |--------------------------------------------------------------------------
    */
    document.addEventListener('click', function (e) {
        if (menuDropdown && menuBtn && !menuBtn.contains(e.target)) {
            menuDropdown.classList.remove('show');
        }

        if (accountDropdown && !accountDropdown.contains(e.target)) {
            accountDropdown.classList.remove('show');
        }
    });

});
</script>