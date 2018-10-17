<?php

/**
 * @package JFW
 * @subpackage Blank
 * @since JFW Blank ! 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>

<!-- Made by Julien Félix Web -->
<!-- Julien Félix Web is @ http://www.julienfelix.com/ -->
<!-- Julien Félix Web contact: contact@julienfelix.com -->

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">

<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<div class="site-inner">

		<header id="masthead" class="site-header" role="banner">

			<div class="site-header-main">

				<div class="site-branding">
				
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				</div><!-- .site-branding -->

				<div id="site-header-menu" class="site-header-menu">

					<?php if ( has_nav_menu( 'primary' ) ) : ?>
						<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'jfw_blank' ); ?>">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'menu_class'     => 'primary-menu',
								 ) );
							?>
						</nav><!-- .main-navigation -->
					<?php endif; ?>
	
				</div><!-- .site-header-menu -->

			</div><!-- .site-header-main -->

		</header><!-- .site-header -->

		<div id="content" class="site-content">
