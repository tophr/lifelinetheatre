<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">
					
					<?php wp_nav_menu(
						array(
							'theme_location'  => 'footer',
							//'container_class' => 'navbar',
							//'container_id'    => 'footerNav',
							//'menu_class'      => 'navbar-nav justify-content-between',
							'fallback_cb'     => '',
							'menu_id'         => 'footer-menu',
							'depth'           => 1,
							//'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
						)
					); ?>

					<div class="site-info row">

						<div class="col-sm-6">
							&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
						</div>
						<div class="col-sm-6 text-right">
							6912 N Glenwood Ave, Chicago, IL, 60626<br><a href="/news/photos">Photo Credits</a>
						</div>

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

