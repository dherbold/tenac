<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="site-header">
    <div class="container">
      <a href="<?php echo site_url() ?>">
        <img class="logo-star float-left" src="/wp-content/uploads/512xStar.png" alt="Tenac Championship Coaching's star logo">
      </a>
      <h1 class="logo-text float-left">
        <a href="<?php echo site_url() ?>"><strong><?php echo esc_html(get_bloginfo('name')) ?></strong></a>
      </h1>

      <!--<a href="<?php // echo esc_url(site_url('/search')); 
                    ?>" class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
                    -->

      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <ul>
            <!-- coaching, events, about us, contact, news  -->
            <li>
              <a href="<?php echo site_url('/coaching') ?>">Coaching</a>
            </li>
            <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"' ?>>
              <a href="<?php echo site_url('/news'); ?>">News</a>
            </li>
            <li <?php if (get_post_type() == 'event' or is_page('past-events')) echo 'class="current-menu-item"';  ?>>
              <a href="<?php echo get_post_type_archive_link('event'); ?>">Events</a>
            </li>

            <li <?php if (is_page('about-us')) echo 'class="current-menu-item"'; ?>>
              <a href="<?php echo site_url('/about-us'); ?>">About Us</a>
            </li>
            <li <?php if (is_page('contact-us')) echo 'class="current-menu-item"'; ?>>
              <a href="<?php echo site_url('/contact-us'); ?>">Contact Us</a>
            </li>
            <li <?php if (is_page('be-a-champion')) echo 'class="current-menu-item"'; ?>>
              <a style="color: yellow;" href="<?php echo site_url('/be-a-champion'); ?>">#BeAChampion</a>
            </li>
          </ul>
        </nav>
        <div class="site-header__util">
          <?php if (is_user_logged_in()) { ?>

            <a href="<?php echo wp_logout_url();  ?>" class="btn btn--small btn--blue float-left">
              <span class="btn__text">Log Out</span>
            </a>
          <?php } else { ?>
            <a href="<?php echo wp_login_url(); ?>" class="btn btn--small btn--blue float-left push-right"><strong>Login</strong></a>
            <!--<a href="<?php // echo wp_registration_url(); 
                          ?>" class="btn btn--small btn--dark-orange float-left"><strong>Sign Up</strong></a>-->
          <?php } ?>

          <a href="<?php echo esc_url(site_url('/search')); ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </header>