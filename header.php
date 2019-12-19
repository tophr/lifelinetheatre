<?php
/**
* The header for our theme.
*
* Displays all of the <head> section and everything up till <div id="content">
*
* @package understrap
*/

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php include_once("inc/analytics.php") ?>

  <div class="site" id="page">

    <header id="header">
      <div class="<?php echo esc_attr( $container ); ?>">

        <div class="row">
          <div class="col-sm-4 header-branding">
            <?php if ( ! has_custom_logo() ) { ?>

              <?php if ( is_front_page() && is_home() ) : ?>

                <h1 class="mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

              <?php else : ?>

                <a class="" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

              <?php endif; ?>


            <?php } else {
              the_custom_logo();
            } ?>
          </div>

          <div class="col-sm-8 text-right header-info">
            <?php dynamic_sidebar( 'right-header' ); ?>
            <div class="social-links">
              <a href="http://visitor.r20.constantcontact.com/d.jsp?llr=dmdmnpbab&p=oi&m=1101102714243&sit=rvw8sq8ab" target="_blank" title="Join our email list"><i class="fas fa-envelope-square"></i></a>
              <a href="http://www.facebook.com/pages/Lifeline-Theatre/55661357652" target="_blank" title="Find us on Facebook!"><i class="fab fa-facebook"></i></a> <a href="http://twitter.com/lifelinetheatre" target="_blank"  title="Follow us on Twitter" ><i class="fab fa-twitter-square"></i></a>
            </div>            
          </div>

        </div>
      </div>
    </header>

    <div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

      <a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

      <nav class="navbar navbar-expand-md navbar-dark bg-primary">

        <div class="<?php echo esc_attr( $container ); ?>">

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
            <span class="navbar-toggler-icon"></span>
          </button>

          <?php wp_nav_menu(
            array(
              'theme_location'  => 'primary',
              'container_class' => 'collapse navbar-collapse',
              'container_id'    => 'navbarNavDropdown',
              'menu_class'      => 'navbar-nav justify-content-between',
              'fallback_cb'     => '',
              'menu_id'         => 'main-menu',
              'depth'           => 3,
              'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
            )
          ); ?>
        </div>

      </nav>

    </div>
