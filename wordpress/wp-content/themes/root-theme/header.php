<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- MODULE (1) - MAIN HEADER -->
<header class="main-header" id="site-main-header">

    <!-- 1. Nút Logo: Về trang chủ -->
    <div class="header-logo">
        <a href="<?php echo esc_url(home_url('/')); ?>" title="Trang chủ Group C">
            Group D
        </a>
    </div>

    <!-- 2. Nút Home: Về trang chủ -->
    <div class="header-home">
        <a href="<?php echo esc_url(home_url('/')); ?>" title="Trang chủ">
            Home
        </a>
    </div>

    <!-- 3. Form Search: Nhập từ khóa tìm kiếm ra trang kết quả search -->
    <form class="header-search" method="get" action="<?php echo esc_url(home_url('/')); ?>" id="headerSearchForm">
        <input
            type="search"
            name="s"
            id="header-search-input"
            placeholder="Search"
            value="<?php echo esc_attr(get_search_query()); ?>"
            required
        >
        <button type="submit" id="header-search-submit" title="Tìm kiếm">
            Submit
        </button>
    </form>

    <!-- Spacer giãn khoảng cách -->
    <div class="header-spacer"></div>

    <!-- 4. Navigation Menu: Link thật tới chuyên mục và bài viết -->
    <nav class="header-nav">
        <?php
        $thethao = get_category_by_slug('the-thao');
        $thethao_url = $thethao ? get_category_link($thethao->term_id) : home_url('/?cat=3');

        $congnghe = get_category_by_slug('cong-nghe');
        $congnghe_url = $congnghe ? get_category_link($congnghe->term_id) : home_url('/?cat=2');

        $doisong = get_category_by_slug('doi-song');
        $doisong_url = $doisong ? get_category_link($doisong->term_id) : home_url('/?cat=5');
        ?>
        <a href="<?php echo esc_url($thethao_url); ?>" title="Chuyên mục Thể thao">
            Thể thao
        </a>

        <a href="<?php echo esc_url($congnghe_url); ?>" title="Chuyên mục Khoa học & Công nghệ">
            Khoa học
        </a>

        <a href="<?php echo esc_url($doisong_url); ?>" title="Chuyên mục Tin tức">
            Tin tức
        </a>
    </nav>

    <!-- 5. Nút Menu: 3 chấm tròn ngang đúng mẫu đề bài kèm tính năng mở menu chuyên mục -->
    <div class="header-icon-item header-menu-trigger" id="headerMenuBtn" title="Danh mục Menu mở rộng">
        <div class="header-icon menu-icon dots-menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <span>Menu</span>

        <!-- Dropdown Danh mục Menu khi click Menu 3 chấm -->
        <div class="header-menu-dropdown" id="headerMenuDropdown">
            <div class="menu-dropdown-title">Danh mục liên kết</div>
            <ul class="menu-dropdown-list">
                <li><a href="<?php echo esc_url(home_url('/')); ?>">🏠 Trang chủ</a></li>
                <li><a href="<?php echo esc_url($thethao_url); ?>">⚽ Thể thao</a></li>
                <li><a href="<?php echo esc_url($congnghe_url); ?>">🔬 Khoa học - Công nghệ</a></li>
                <li><a href="<?php echo esc_url($doisong_url); ?>">📰 Tin tức đời sống</a></li>
                <?php
                $football = get_category_by_slug('football');
                if ($football) :
                ?>
                    <li><a href="<?php echo esc_url(get_category_link($football->term_id)); ?>">🏆 Football</a></li>
                <?php endif; ?>
                <li><a href="<?php echo esc_url(home_url('/demo_4_modules.php')); ?>">📋 Demo 4 Modules</a></li>
            </ul>
        </div>
    </div>

    <!-- 6. Nút Search Icon: Nhấn search ra trang tìm kiếm hoặc submit form -->
    <div class="header-icon-item header-search-trigger" id="headerSearchIconBtn" title="Nhấn để tìm kiếm">
        <div class="header-icon search-icon"></div>
        <span>Search</span>
    </div>

    <!-- 7. Nút Account: Icon người dùng + Dropdown Menu phong cách Bootstrap -->
    <div class="header-account dropdown" id="headerAccountDropdown">
        <button type="button" class="account-btn dropdown-toggle" id="accountDropdownBtn" aria-expanded="false" title="Tài khoản">
            <div class="account-icon">
                <div class="account-head"></div>
                <div class="account-body"></div>
            </div>
            <div class="account-text">
                Account
                <span class="account-arrow"></span>
            </div>
        </button>

        <!-- Dropdown Menu Account -->
        <ul class="dropdown-menu account-dropdown-menu" id="accountDropdownMenu">
            <?php if (is_user_logged_in()) : ?>
                <?php $current_user = wp_get_current_user(); ?>
                <li class="dropdown-header">
                    Xin chào, <strong><?php echo esc_html($current_user->display_name ? $current_user->display_name : $current_user->user_login); ?></strong>
                </li>
                <li class="dropdown-divider"></li>
                <li>
                    <a href="<?php echo esc_url(admin_url()); ?>" class="dropdown-item">
                        <span class="dropdown-icon">&#9881;</span> Trang quản trị
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url(admin_url('profile.php')); ?>" class="dropdown-item">
                        <span class="dropdown-icon">&#128100;</span> Hồ sơ cá nhân
                    </a>
                </li>
                <li class="dropdown-divider"></li>
                <li>
                    <a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>" class="dropdown-item text-danger">
                        <span class="dropdown-icon">&#128682;</span> Đăng xuất
                    </a>
                </li>
            <?php else : ?>
                <li>
                    <a href="<?php echo esc_url(wp_login_url()); ?>" class="dropdown-item">
                        <span class="dropdown-icon">&#128272;</span> Đăng nhập
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url(site_url('wp-login.php?action=register')); ?>" class="dropdown-item">
                        <span class="dropdown-icon">&#128221;</span> Đăng ký tài khoản
                    </a>
                </li>
                <li class="dropdown-divider"></li>
                <li>
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="dropdown-item text-muted">
                        Quên mật khẩu?
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>

</header>

<!-- JavaScript xử lý toàn bộ tính năng tương tác của Module 1 -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Xử lý Nút Search Icon bên phải
    var searchIconBtn = document.getElementById('headerSearchIconBtn');
    var searchInput = document.getElementById('header-search-input');
    var searchForm = document.getElementById('headerSearchForm');

    if (searchIconBtn && searchForm) {
        searchIconBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (searchInput && searchInput.value.trim() !== '') {
                searchForm.submit();
            } else if (searchInput) {
                searchInput.focus();
                searchInput.classList.add('highlight-search');
                setTimeout(function() {
                    searchInput.classList.remove('highlight-search');
                }, 1500);
            }
        });
    }

    // 2. Xử lý Nút Menu 3 chấm (Bật/tắt menu liên kết mở rộng)
    var menuBtn = document.getElementById('headerMenuBtn');
    var menuDropdown = document.getElementById('headerMenuDropdown');

    if (menuBtn && menuDropdown) {
        menuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            menuDropdown.classList.toggle('show');
            // Đóng dropdown account nếu đang mở
            var accountDropdown = document.getElementById('headerAccountDropdown');
            if (accountDropdown) accountDropdown.classList.remove('show');
        });
    }

    // 3. Xử lý Nút Account (Bật/tắt dropdown tài khoản khi click)
    var accountDropdown = document.getElementById('headerAccountDropdown');
    var dropdownBtn = document.getElementById('accountDropdownBtn');

    if (accountDropdown && dropdownBtn) {
        dropdownBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            accountDropdown.classList.toggle('show');
            // Đóng menu 3 chấm nếu đang mở
            if (menuDropdown) menuDropdown.classList.remove('show');
        });
    }

    // Đóng tất cả dropdown khi click ra ngoài màn hình
    document.addEventListener('click', function(e) {
        if (menuDropdown && !menuBtn.contains(e.target)) {
            menuDropdown.classList.remove('show');
        }
        if (accountDropdown && !accountDropdown.contains(e.target)) {
            accountDropdown.classList.remove('show');
        }
    });
});
</script>