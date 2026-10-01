<?php
/**
 * MODULE - PROFILE SETTINGS
 *
 * Popup Settings:
 * - Appearance (Light, Dark, System)
 * - Language (Vietnamese, English)
 * - Account info
 */
?>

<div
    class="profile-settings-overlay"
    id="profileSettingsOverlay"
    aria-hidden="true"
>

    <div
        class="profile-settings-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="profileSettingsTitle"
    >

        <!-- HEADER -->
        <div class="profile-settings-header">

            <h2 id="profileSettingsTitle" data-i18n="settings_modal_title">
                Cài đặt
            </h2>

            <button
                type="button"
                class="profile-settings-close"
                id="closeProfileSettings"
                aria-label="Close"
            >
                &times;
            </button>

        </div>


        <!-- CONTENT -->
        <div class="profile-settings-content">

            <!-- APPEARANCE -->
            <section class="profile-settings-section">

                <h3 data-i18n="appearance_title">
                    Giao diện
                </h3>

                <p class="profile-settings-description" data-i18n="appearance_desc">
                    Chọn giao diện hiển thị cho website.
                </p>

                <div class="profile-theme-options">

                    <label class="profile-theme-option">
                        <input
                            type="radio"
                            name="profile_theme"
                            value="light"
                            id="profileThemeLight"
                        >
                        <span data-i18n="theme_light">
                            Sáng
                        </span>
                    </label>

                    <label class="profile-theme-option">
                        <input
                            type="radio"
                            name="profile_theme"
                            value="dark"
                            id="profileThemeDark"
                        >
                        <span data-i18n="theme_dark">
                            Tối
                        </span>
                    </label>

                    <label class="profile-theme-option">
                        <input
                            type="radio"
                            name="profile_theme"
                            value="system"
                            id="profileThemeSystem"
                        >
                        <span data-i18n="theme_system">
                            Hệ thống
                        </span>
                    </label>

                </div>

            </section>


            <!-- LANGUAGE -->
            <section class="profile-settings-section">

                <h3 data-i18n="language_title">
                    Ngôn ngữ
                </h3>

                <p class="profile-settings-description" data-i18n="language_desc">
                    Chọn ngôn ngữ hiển thị.
                </p>

                <select
                    id="profileLanguage"
                    class="profile-settings-select"
                >
                    <option value="vi" data-i18n="lang_vi">
                        Tiếng Việt
                    </option>

                    <option value="en" data-i18n="lang_en">
                        English
                    </option>
                </select>

            </section>


            <!-- ACCOUNT -->
            <section class="profile-settings-section">

                <h3 data-i18n="account_title">
                    Tài khoản
                </h3>

                <label
                    class="profile-settings-label"
                    for="profileUsername"
                    data-i18n="username_label"
                >
                    Tên đăng nhập
                </label>

                <input
                    type="text"
                    id="profileUsername"
                    class="profile-settings-input"
                    value="<?php
                        if (is_user_logged_in()) {
                            $user = wp_get_current_user();
                            echo esc_attr($user->user_login);
                        } else {
                            echo 'Khách';
                        }
                    ?>"
                    data-guest-text="Khách"
                    readonly
                >

            </section>

        </div>


        <!-- FOOTER -->
        <div class="profile-settings-footer">

            <button
                type="button"
                class="profile-settings-cancel"
                id="cancelProfileSettings"
                data-i18n="cancel"
            >
                Hủy
            </button>

            <button
                type="button"
                class="profile-settings-save"
                id="saveProfileSettings"
                data-i18n="save_changes"
            >
                Lưu thay đổi
            </button>

        </div>

    </div>

</div>


<!-- =========================================================
     JAVASCRIPT - THEME & LANGUAGE MANAGEMENT
========================================================= -->

<script>
(function () {
    /*
    |--------------------------------------------------------------------------
    | DICTIONARY
    |--------------------------------------------------------------------------
    */
    var i18nDictionary = {
        vi: {
            'home': 'Trang chủ',
            'search': 'Tìm kiếm',
            'search_placeholder': 'Tìm kiếm...',
            'search_submit': 'Tìm kiếm',
            'sports': 'Thể thao',
            'science': 'Khoa học',
            'news': 'Tin tức',
            'menu': 'Menu',
            'menu_categories': 'Danh mục liên kết',
            'menu_home': '🏠 Trang chủ',
            'menu_sports': '⚽ Thể thao',
            'menu_science': '🔬 Khoa học - Công nghệ',
            'menu_news': '📰 Tin tức đời sống',
            'menu_football': '🏆 Football',
            'menu_demo': '📋 Demo 4 Modules',
            'menu_settings': '⚙️ Cài đặt',
            'settings': 'Cài đặt',
            'account': 'Tài khoản',
            'hello': 'Xin chào,',
            'admin_dashboard': 'Trang quản trị',
            'logout': 'Đăng xuất',
            'login': 'Đăng nhập',
            'register': 'Đăng ký tài khoản',
            'forgot_password': 'Quên mật khẩu?',
            'pages': 'Trang',
            'latest_posts': 'Bài viết mới nhất',
            'month_prefix': 'THÁNG ',
            'prev_page': '« Trước',
            'next_page': 'Tiếp »',
            'no_posts_title': 'Không tìm thấy bài viết.',
            'no_posts_desc': 'Hiện tại chưa có bài viết nào để hiển thị.',
            'categories': 'Chuyên mục',
            'no_categories': 'Chưa có chuyên mục nào',
            'view_all_news': 'XEM TẤT CẢ TIN TỨC',
            'most_viewed': 'Xem nhiều',
            'comments': 'Bình luận',
            'comments_count_suffix': ' Bình luận',
            'no_posts': 'Chưa có bài viết nào.',
            'latest_news_title': 'Tin mới nhất',
            'reading_time_prefix': 'Đã đọc được ',
            'reading_time_suffix': ' phút',
            'source_prefix': '(Theo Người Lao Động)',
            'make_a_post': 'Viết bình luận',
            'comment_placeholder': 'Bạn đang nghĩ gì...',
            'author_placeholder': 'Họ và tên *',
            'email_placeholder': 'Email *',
            'url_placeholder': 'Website (tùy chọn)',
            'share_btn': 'Chia sẻ',
            'comment_says': 'viết:',
            'comments_closed': 'Bình luận đã được đóng cho bài viết này.',
            'logged_in_as': 'Đăng nhập với tư cách',
            'search_results_title': 'Kết quả tìm kiếm cho: ',
            'search_not_found': 'Không tìm thấy kết quả nào phù hợp.',
            'settings_modal_title': 'Cài đặt',
            'appearance_title': 'Giao diện',
            'appearance_desc': 'Chọn giao diện hiển thị cho website.',
            'theme_light': 'Sáng',
            'theme_dark': 'Tối',
            'theme_system': 'Hệ thống',
            'language_title': 'Ngôn ngữ',
            'language_desc': 'Chọn ngôn ngữ hiển thị.',
            'lang_vi': 'Tiếng Việt',
            'lang_en': 'English',
            'account_title': 'Tài khoản',
            'username_label': 'Tên đăng nhập',
            'guest_user': 'Khách',
            'cancel': 'Hủy',
            'save_changes': 'Lưu thay đổi',
            'footer_about': 'Về chúng tôi',
            'footer_about_desc': 'Website cung cấp tin tức nhanh chóng, chính xác về công nghệ, đời sống và thể thao.',
            'footer_links': 'Liên kết nhanh',
            'footer_contact': 'Liên hệ',
            'footer_copyright': '© 2026 Group D. Tất cả các quyền được bảo lưu.'
        },
        en: {
            'home': 'Home',
            'search': 'Search',
            'search_placeholder': 'Search...',
            'search_submit': 'Search',
            'sports': 'Sports',
            'science': 'Science',
            'news': 'News',
            'menu': 'Menu',
            'menu_categories': 'Navigation Menu',
            'menu_home': '🏠 Home',
            'menu_sports': '⚽ Sports',
            'menu_science': '🔬 Science & Tech',
            'menu_news': '📰 Life & News',
            'menu_football': '🏆 Football',
            'menu_demo': '📋 Demo 4 Modules',
            'menu_settings': '⚙️ Settings',
            'settings': 'Settings',
            'account': 'Account',
            'hello': 'Welcome,',
            'admin_dashboard': 'Admin Dashboard',
            'logout': 'Log out',
            'login': 'Log in',
            'register': 'Register',
            'forgot_password': 'Forgot password?',
            'pages': 'Pages',
            'latest_posts': 'Latest Posts',
            'month_prefix': 'MONTH ',
            'prev_page': '« Previous',
            'next_page': 'Next »',
            'no_posts_title': 'No posts found.',
            'no_posts_desc': 'There are currently no posts to display.',
            'categories': 'Categories',
            'no_categories': 'No categories available',
            'view_all_news': 'VIEW ALL NEWS',
            'most_viewed': 'Most Viewed',
            'comments': 'Comments',
            'comments_count_suffix': ' Comments',
            'no_posts': 'No posts available.',
            'latest_news_title': 'Latest News',
            'reading_time_prefix': 'Reading time: ',
            'reading_time_suffix': ' min',
            'source_prefix': '(Source: Nguoi Lao Dong)',
            'make_a_post': 'Make a Post',
            'comment_placeholder': 'What are you thinking...',
            'author_placeholder': 'Full Name *',
            'email_placeholder': 'Email *',
            'url_placeholder': 'Website (optional)',
            'share_btn': 'Share',
            'comment_says': 'wrote:',
            'comments_closed': 'Comments are closed for this post.',
            'logged_in_as': 'Logged in as',
            'search_results_title': 'Search results for: ',
            'search_not_found': 'We could not find any results for your search.',
            'settings_modal_title': 'Settings',
            'appearance_title': 'Appearance',
            'appearance_desc': 'Choose how the website looks.',
            'theme_light': 'Light',
            'theme_dark': 'Dark',
            'theme_system': 'System',
            'language_title': 'Language',
            'language_desc': 'Select your preferred language.',
            'lang_vi': 'Tiếng Việt',
            'lang_en': 'English',
            'account_title': 'Account',
            'username_label': 'Username',
            'guest_user': 'Guest',
            'cancel': 'Cancel',
            'save_changes': 'Save Changes',
            'footer_about': 'About Us',
            'footer_about_desc': 'Providing fast and accurate news on technology, lifestyle, and sports.',
            'footer_links': 'Quick Links',
            'footer_contact': 'Contact Us',
            'footer_copyright': '© 2026 Group D. All rights reserved.'
        }
    };

    /*
    |--------------------------------------------------------------------------
    | APPLY THEME
    |--------------------------------------------------------------------------
    */
    window.applyTheme = function (theme) {
        document.documentElement.classList.remove('profile-theme-light', 'profile-theme-dark');
        document.body.classList.remove('profile-theme-light', 'profile-theme-dark');

        var effectiveTheme = theme;
        if (theme === 'system') {
            effectiveTheme = (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'light';
        }

        if (effectiveTheme === 'dark') {
            document.documentElement.classList.add('profile-theme-dark');
            document.body.classList.add('profile-theme-dark');
        } else {
            document.documentElement.classList.add('profile-theme-light');
            document.body.classList.add('profile-theme-light');
        }
    };

    /*
    |--------------------------------------------------------------------------
    | APPLY LANGUAGE
    |--------------------------------------------------------------------------
    */
    window.applyLanguage = function (lang) {
        if (!lang || !i18nDictionary[lang]) {
            lang = 'vi';
        }

        document.documentElement.lang = lang;
        var dict = i18nDictionary[lang];

        // 1. Text elements with data-i18n
        document.querySelectorAll('[data-i18n]').forEach(function (el) {
            var key = el.getAttribute('data-i18n');
            if (dict[key] !== undefined) {
                el.textContent = dict[key];
            }
        });

        // 2. Placeholder attributes
        document.querySelectorAll('[data-i18n-placeholder]').forEach(function (el) {
            var key = el.getAttribute('data-i18n-placeholder');
            if (dict[key] !== undefined) {
                el.placeholder = dict[key];
            }
        });

        // 3. Title attributes
        document.querySelectorAll('[data-i18n-title]').forEach(function (el) {
            var key = el.getAttribute('data-i18n-title');
            if (dict[key] !== undefined) {
                el.title = dict[key];
            }
        });

        // 4. Date month labels
        document.querySelectorAll('.date-month, .tdc-search-month').forEach(function (el) {
            var m = el.getAttribute('data-month');
            if (!m) {
                var match = el.textContent.match(/\d+/);
                if (match) {
                    m = match[0];
                    el.setAttribute('data-month', m);
                }
            }
            if (m) {
                el.textContent = dict['month_prefix'] + m;
            }
        });

        // 5. Guest user text
        var usernameInput = document.getElementById('profileUsername');
        if (usernameInput && usernameInput.hasAttribute('data-guest-text')) {
            usernameInput.value = dict['guest_user'];
        }

        // 6. Language select sync
        var langSelect = document.getElementById('profileLanguage');
        if (langSelect && langSelect.value !== lang) {
            langSelect.value = lang;
        }
    };

    /*
    |--------------------------------------------------------------------------
    | INITIALIZE ON DOM LOAD
    |--------------------------------------------------------------------------
    */
    document.addEventListener('DOMContentLoaded', function () {

        var overlay = document.getElementById('profileSettingsOverlay');
        var closeButton = document.getElementById('closeProfileSettings');
        var cancelButton = document.getElementById('cancelProfileSettings');
        var saveButton = document.getElementById('saveProfileSettings');
        var languageSelect = document.getElementById('profileLanguage');

        var lightTheme = document.getElementById('profileThemeLight');
        var darkTheme = document.getElementById('profileThemeDark');
        var systemTheme = document.getElementById('profileThemeSystem');

        /*
        |--------------------------------------------------------------------------
        | LOAD SAVED SETTINGS
        |--------------------------------------------------------------------------
        */
        function loadSettings() {
            var savedTheme = localStorage.getItem('profile_theme') || 'system';
            var savedLanguage = localStorage.getItem('profile_language') || 'vi';

            if (savedTheme === 'light' && lightTheme) {
                lightTheme.checked = true;
            } else if (savedTheme === 'dark' && darkTheme) {
                darkTheme.checked = true;
            } else if (systemTheme) {
                systemTheme.checked = true;
            }

            if (languageSelect) {
                languageSelect.value = savedLanguage;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | OPEN SETTINGS MODAL
        |--------------------------------------------------------------------------
        */
        function openSettings(e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Close any open dropdowns
            var accountDropdown = document.getElementById('headerAccountDropdown');
            var menuDropdown = document.getElementById('headerMenuDropdown');
            if (accountDropdown) accountDropdown.classList.remove('show');
            if (menuDropdown) menuDropdown.classList.remove('show');

            loadSettings();

            if (overlay) {
                overlay.classList.add('show');
                overlay.setAttribute('aria-hidden', 'false');
                document.body.classList.add('settings-open');
            }
        }

        // Attach open listeners to all trigger buttons
        var triggerSelectors = [
            '#openProfileSettings',
            '#openProfileSettingsGuest',
            '#openProfileSettingsMenu',
            '#headerSettingsBtn',
            '.open-profile-settings-link'
        ];
        document.querySelectorAll(triggerSelectors.join(',')).forEach(function (btn) {
            btn.addEventListener('click', openSettings);
        });

        /*
        |--------------------------------------------------------------------------
        | CLOSE SETTINGS MODAL
        |--------------------------------------------------------------------------
        */
        function closeSettings() {
            if (!overlay) return;
            overlay.classList.remove('show');
            overlay.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('settings-open');
        }

        if (closeButton) {
            closeButton.addEventListener('click', closeSettings);
        }

        if (cancelButton) {
            cancelButton.addEventListener('click', function () {
                // Revert to saved settings on cancel
                var savedTheme = localStorage.getItem('profile_theme') || 'system';
                var savedLanguage = localStorage.getItem('profile_language') || 'vi';
                applyTheme(savedTheme);
                applyLanguage(savedLanguage);
                closeSettings();
            });
        }

        if (overlay) {
            overlay.addEventListener('click', function (e) {
                if (e.target === overlay) {
                    closeSettings();
                }
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && overlay && overlay.classList.contains('show')) {
                closeSettings();
            }
        });

        /*
        |--------------------------------------------------------------------------
        | LIVE THEME SWITCHING ON SELECTION
        |--------------------------------------------------------------------------
        */
        document.querySelectorAll('input[name="profile_theme"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                applyTheme(this.value);
                localStorage.setItem('profile_theme', this.value);
            });
        });

        /*
        |--------------------------------------------------------------------------
        | LIVE LANGUAGE SWITCHING ON SELECTION
        |--------------------------------------------------------------------------
        */
        if (languageSelect) {
            languageSelect.addEventListener('change', function () {
                var lang = this.value;
                applyLanguage(lang);
                localStorage.setItem('profile_language', lang);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE SETTINGS
        |--------------------------------------------------------------------------
        */
        if (saveButton) {
            saveButton.addEventListener('click', function () {
                var selectedTheme = document.querySelector('input[name="profile_theme"]:checked');
                var theme = selectedTheme ? selectedTheme.value : 'system';
                var lang = languageSelect ? languageSelect.value : 'vi';

                localStorage.setItem('profile_theme', theme);
                localStorage.setItem('profile_language', lang);

                applyTheme(theme);
                applyLanguage(lang);
                closeSettings();
            });
        }

        /*
        |--------------------------------------------------------------------------
        | APPLY PERSISTED SETTINGS ON PAGE LOAD
        |--------------------------------------------------------------------------
        */
        var savedTheme = localStorage.getItem('profile_theme') || 'system';
        var savedLanguage = localStorage.getItem('profile_language') || 'vi';

        applyTheme(savedTheme);
        applyLanguage(savedLanguage);

        // System theme change listener
        if (window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function () {
                var currentTheme = localStorage.getItem('profile_theme') || 'system';
                if (currentTheme === 'system') {
                    applyTheme('system');
                }
            });
        }

    });
})();
</script>