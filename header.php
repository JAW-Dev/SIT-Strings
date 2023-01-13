<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="apple-mobile-web-app-status-bar-style" content="default">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Montserrat:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
		<?php wp_head() ?>
	</head>

	<?php
  $has_transparent_header = get_field('transparent_header');
  $has_white_logo = get_field('white_logo');
  $has_white_icons = get_field('white_icons');
  $body_classes = array_filter([
    !$has_transparent_header ?: 'has-transparent-header',
    !$has_white_logo ?: 'has-white-logo',
    !$has_white_icons ?: 'has-white-icons'
  ]);
?>

	<body <?php body_class(implode(' ', $body_classes)); ?>>
		<?php wp_body_open() ?>

    <header class="top">
      <div class="navbar container">
        <div class="navbar-brand">
          <?= inline_svg('images/sit-strings-logo.svg') ?>
          <a class="stretched-link" href="/" aria-label="SIT Strings Home"></a>
        </div>

        <div class="navbar-controls">

  			  <div class="navbar-controls--link-override"><?php dynamic_sidebar('header-button'); ?></div>

          <?php if (!is_user_logged_in()): ?>
            <div class="navbar-controls--link-override ml-4">
              <p class="mb-0"><a href="/my-account">Sign In</a></p>
            </div>
          <?php else:
              $current_user = wp_get_current_user();
          ?>
            <a href="/my-account" class="navbar-controls__icon navbar-controls__icon-user" aria-label="Logged in as <?= $current_user->first_name ?> <?= $current_user->last_name ?>">

              <span class="navbar-controls__icon-user-hover">Logged in as <?= $current_user->first_name ?> <?= $current_user->last_name ?></span>
              <?= inline_svg('images/icon-user.svg') ?>
            </a>
          <?php endif; ?>

          <a href="/search/" class="navbar-controls__icon" aria-label="Search this site">
            <?= inline_svg('images/icon-search.svg') ?>
          </a>

          <a href="/cart/" class="navbar-controls__icon navbar-controls__cart" aria-label="View cart">
            <?php $count = WC()->cart->cart_contents_count; ?>
            <span class="navbar-controls__cart-count" data-count="<?= $count ?>">
              <?= $count ?>
            </span>
            <?= inline_svg('images/icon-cart.svg') ?>
          </a>


          <button class="navbar-controls__icon navbar-toggler" type="button" data-toggle="collapse" aria-controls="primary-nav-wrapper" data-target="#primary-nav-wrapper" aria-expanded="false" aria-label="Toggle navigation">
            <?= inline_svg('images/icon-menu-toggle.svg') ?>
          </button>
        </div>
      </div>

      <div id="primary-nav-wrapper" class="collapse navbar-collapse">
        <?php
          wp_nav_menu([
            'theme_location'  => 'primary_navigation',
            'container'       => 'nav',
            'container_id'    => 'primary-nav',
            'container_class' => 'navbar-nav-wrap container',
            'menu_class'      => 'list-unstyled navbar-nav'
          ]);
        ?>
      </div>
    </header>

		<main role="main">
