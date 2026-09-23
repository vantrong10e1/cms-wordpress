<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ==================== (1) MODULE HEADER ==================== -->
<header id="site-header" class="custom-navbar">
  <div class="header-container">

    <!-- Left side: Brand, Home, Search form -->
    <div class="header-left">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand">Nhom D</a>

      <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-item-home <?php if (is_front_page() && !is_category()) echo 'active'; ?>">
        Home
      </a>

      <!-- Search Form: Nhap tu khoa tim kiem ra trang ket qua search -->
      <form class="navbar-search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>" role="search">
        <input type="search" name="s" class="navbar-search-input" placeholder="Search" value="<?php echo esc_attr(get_search_query()); ?>" required>
        <button type="submit" class="navbar-search-submit">Submit</button>
      </form>
    </div>

    <!-- Right side: Categories, Menu, Search Icon, Account Dropdown -->
    <div class="header-right">
      <nav class="navbar-links" aria-label="Menu phu">
        <?php
        // Categories list
        $nav_cats = [
            'the-thao'  => 'Thể thao',
            'khoa-hoc'  => 'Khoa học',
            'tin-tuc'   => 'Tin tức'
        ];

        foreach ($nav_cats as $slug => $fallback_label) {
            $cat = get_term_by('slug', $slug, 'category');
            if ($cat) {
                $link = get_category_link($cat->term_id);
                $label = $cat->name;
            } else {
                // If specific category doesn't exist, link to home or existing categories
                $link = home_url('/category/' . $slug . '/');
                $label = $fallback_label;
            }
            $is_act = (is_category($slug)) ? 'active' : '';
            echo '<a href="' . esc_url($link) . '" class="nav-text-link ' . $is_act . '">' . esc_html($label) . '</a>';
        }
        ?>

        <!-- Menu icon: "Khong xu ly cho Menu" -->
        <div class="nav-icon-link" title="Menu">
          <i class="fa fa-ellipsis-h nav-icon-glyph"></i>
          <span class="nav-icon-text">Menu</span>
        </div>

        <!-- Search icon: "Nhan search ra trang tim kiem" -->
        <a href="<?php echo esc_url(home_url('/?s=')); ?>" class="nav-icon-link" id="navSearchTrigger" title="Trang tìm kiếm">
          <i class="fa fa-search nav-icon-glyph"></i>
          <span class="nav-icon-text">Search</span>
        </a>

        <!-- Account dropdown: "Day la dang dropdown" -->
        <div class="nav-dropdown-wrapper">
          <button type="button" class="nav-icon-link nav-dropdown-btn" id="accountDropdownBtn" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-circle nav-icon-glyph"></i>
            <span class="nav-icon-text">Account <span class="caret-arrow">&#9662;</span></span>
          </button>
          <ul class="nav-dropdown-menu" id="accountDropdownMenu">
            <?php if (is_user_logged_in()): ?>
              <li class="dropdown-header">
                <span>Xin chào, <strong><?php echo esc_html(wp_get_current_user()->display_name); ?></strong></span>
              </li>
              <li><a href="<?php echo esc_url(admin_url()); ?>"><i class="fa fa-tachometer"></i> Trang quản trị</a></li>
              <li><a href="<?php echo esc_url(admin_url('profile.php')); ?>"><i class="fa fa-user"></i> Hồ sơ cá nhân</a></li>
              <li class="dropdown-divider"></li>
              <li><a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
            <?php else: ?>
              <li><a href="<?php echo esc_url(wp_login_url()); ?>"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
              <li><a href="<?php echo esc_url(wp_registration_url()); ?>"><i class="fa fa-user-plus"></i> Đăng ký</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </nav>

      <!-- Mobile Hamburger Button -->
      <button class="nav-hamburger" aria-label="Menu" onclick="document.querySelector('.navbar-links').classList.toggle('open')">
        <i class="fa fa-bars"></i>
      </button>
    </div>

  </div>
</header>