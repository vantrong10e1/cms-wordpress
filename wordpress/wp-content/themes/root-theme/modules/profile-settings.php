<?php
/**
 * MODULE - PROFILE SETTINGS
 *
 * Popup Settings:
 * - Appearance
 * - Theme
 * - Language
 * - Account
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

            <h2 id="profileSettingsTitle">
                Settings
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

                <h3>
                    Appearance
                </h3>

                <p class="profile-settings-description">
                    Choose how the website looks.
                </p>


                <div class="profile-theme-options">

                    <label class="profile-theme-option">

                        <input
                            type="radio"
                            name="profile_theme"
                            value="light"
                            id="profileThemeLight"
                        >

                        <span>
                            Light
                        </span>

                    </label>


                    <label class="profile-theme-option">

                        <input
                            type="radio"
                            name="profile_theme"
                            value="dark"
                            id="profileThemeDark"
                        >

                        <span>
                            Dark
                        </span>

                    </label>


                    <label class="profile-theme-option">

                        <input
                            type="radio"
                            name="profile_theme"
                            value="system"
                            id="profileThemeSystem"
                        >

                        <span>
                            System
                        </span>

                    </label>

                </div>

            </section>


            <!-- LANGUAGE -->
            <section class="profile-settings-section">

                <h3>
                    Language
                </h3>

                <p class="profile-settings-description">
                    Select your preferred language.
                </p>


                <select
                    id="profileLanguage"
                    class="profile-settings-select"
                >

                    <option value="vi">
                        Vietnamese
                    </option>

                    <option value="en">
                        English
                    </option>

                </select>

            </section>


            <!-- ACCOUNT -->
            <section class="profile-settings-section">

                <h3>
                    Account
                </h3>

                <label
                    class="profile-settings-label"
                    for="profileUsername"
                >
                    Username
                </label>

                <input
                    type="text"
                    id="profileUsername"
                    class="profile-settings-input"
                    value="<?php
                        if (is_user_logged_in()) {

                            $user = wp_get_current_user();

                            echo esc_attr(
                                $user->user_login
                            );

                        }
                    ?>"
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
            >
                Cancel
            </button>

            <button
                type="button"
                class="profile-settings-save"
                id="saveProfileSettings"
            >
                Save Changes
            </button>

        </div>

    </div>

</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        /*
        |--------------------------------------------------------------------------
        | ELEMENTS
        |--------------------------------------------------------------------------
        */

        var openButton =
            document.getElementById(
                'openProfileSettings'
            );

        var overlay =
            document.getElementById(
                'profileSettingsOverlay'
            );

        var closeButton =
            document.getElementById(
                'closeProfileSettings'
            );

        var cancelButton =
            document.getElementById(
                'cancelProfileSettings'
            );

        var saveButton =
            document.getElementById(
                'saveProfileSettings'
            );

        var languageSelect =
            document.getElementById(
                'profileLanguage'
            );

        var lightTheme =
            document.getElementById(
                'profileThemeLight'
            );

        var darkTheme =
            document.getElementById(
                'profileThemeDark'
            );

        var systemTheme =
            document.getElementById(
                'profileThemeSystem'
            );


        /*
        |--------------------------------------------------------------------------
        | OPEN
        |--------------------------------------------------------------------------
        */

        if (openButton && overlay) {

            openButton.addEventListener(
                'click',
                function (e) {

                    e.preventDefault();

                    e.stopPropagation();

                    var accountDropdown =
                        document.getElementById(
                            'headerAccountDropdown'
                        );

                    if (accountDropdown) {

                        accountDropdown.classList.remove(
                            'show'
                        );

                    }

                    loadSettings();

                    overlay.classList.add('show');

                    overlay.setAttribute(
                        'aria-hidden',
                        'false'
                    );

                    document.body.classList.add(
                        'settings-open'
                    );

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | CLOSE
        |--------------------------------------------------------------------------
        */

        function closeSettings() {

            if (!overlay) {
                return;
            }

            overlay.classList.remove('show');

            overlay.setAttribute(
                'aria-hidden',
                'true'
            );

            document.body.classList.remove(
                'settings-open'
            );

        }


        if (closeButton) {

            closeButton.addEventListener(
                'click',
                closeSettings
            );

        }


        if (cancelButton) {

            cancelButton.addEventListener(
                'click',
                closeSettings
            );

        }


        /*
        |--------------------------------------------------------------------------
        | CLICK OUTSIDE
        |--------------------------------------------------------------------------
        */

        if (overlay) {

            overlay.addEventListener(
                'click',
                function (e) {

                    if (e.target === overlay) {

                        closeSettings();

                    }

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | ESC
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'keydown',
            function (e) {

                if (
                    e.key === 'Escape' &&
                    overlay &&
                    overlay.classList.contains('show')
                ) {

                    closeSettings();

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | LOAD SETTINGS
        |--------------------------------------------------------------------------
        */

        function loadSettings() {

            var savedTheme =
                localStorage.getItem(
                    'profile_theme'
                ) || 'system';

            var savedLanguage =
                localStorage.getItem(
                    'profile_language'
                ) || 'vi';


            if (savedTheme === 'light') {

                lightTheme.checked = true;

            } else if (savedTheme === 'dark') {

                darkTheme.checked = true;

            } else {

                systemTheme.checked = true;

            }


            languageSelect.value =
                savedLanguage;

        }


        /*
        |--------------------------------------------------------------------------
        | APPLY THEME
        |--------------------------------------------------------------------------
        */

        function applyTheme(theme) {

            document.body.classList.remove(
                'profile-theme-light',
                'profile-theme-dark'
            );


            if (theme === 'dark') {

                document.body.classList.add(
                    'profile-theme-dark'
                );

            }


            if (theme === 'light') {

                document.body.classList.add(
                    'profile-theme-light'
                );

            }


            if (theme === 'system') {

                var prefersDark =
                    window.matchMedia &&
                    window.matchMedia(
                        '(prefers-color-scheme: dark)'
                    ).matches;


                if (prefersDark) {

                    document.body.classList.add(
                        'profile-theme-dark'
                    );

                } else {

                    document.body.classList.add(
                        'profile-theme-light'
                    );

                }

            }

        }


        /*
        |--------------------------------------------------------------------------
        | SAVE
        |--------------------------------------------------------------------------
        */

        if (saveButton) {

            saveButton.addEventListener(
                'click',
                function () {

                    var selectedTheme =
                        document.querySelector(
                            'input[name="profile_theme"]:checked'
                        );


                    var theme =
                        selectedTheme
                            ? selectedTheme.value
                            : 'system';


                    var language =
                        languageSelect
                            ? languageSelect.value
                            : 'vi';


                    localStorage.setItem(
                        'profile_theme',
                        theme
                    );

                    localStorage.setItem(
                        'profile_language',
                        language
                    );


                    applyTheme(theme);

                    closeSettings();

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | APPLY SAVED THEME ON PAGE LOAD
        |--------------------------------------------------------------------------
        */

        var savedTheme =
            localStorage.getItem(
                'profile_theme'
            ) || 'system';

        applyTheme(savedTheme);

    }
);

</script>