<?php
/**
 * Template Name: Featured Season
 *
 * The template for displaying the current or select featured season.
 *
 * @package understrap
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<?php get_template_part( 'global-templates/hero', 'image' ); ?>

<div class="wrapper" id="page-wrapper">

	<?php if ( have_posts() ) : ?>

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-9 order-md-last content-area" id="primary">

				<main class="site-main" id="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/content', 'page' ); ?>

					<?php endwhile; // end of the loop. ?>

					<?php 
					
					$featured_season = get_field('featured_season');					
					$taxonomy = array( "name" => 'season' , "slug" => 'season');
					$custom_post_type = "production";
										
					$args = array(
						'orderby'	=> 'name', 
						'order'		=> 'ASC',
						'include' => $featured_season,
					);
					
					$terms = get_terms($taxonomy['name'], $args);
					
					foreach ( $terms as $category ) {
						?>

					<div class="featured-production-year">										

						<?php
						global $post; // Access the global $post object.

						// Setup query to return each custom post within this taxonomy category
						$o_queried_posts = get_posts( array(
							'nopaging' => true,
							'post_type' => $custom_post_type,
							'taxonomy' => $category->taxonomy,
							'term' => $category->slug,
							'order' => 'ASC',
							//'orderby' => 'title',
						) );

						$productions = array();

						foreach ( $o_queried_posts as $post ) {
							$venue = get_field( 'venue', $post->id );
							$productions[ $venue ][] = $post;
						}

						wp_reset_query();

						foreach ( $productions as $production => $venue_title ) {
							?>	

							<h3 class="featured-venue-name">
								<?php echo esc_html($production); ?>
							</h3>

							<div class="row">
								<?php
								foreach ( $venue_title as $listing => $single_listing ) {
									setup_postdata( $single_listing );
									$post_id = $single_listing->ID;
									$title = get_the_title( $post_id );
									$link = get_the_permalink( $post_id );
									$dates = get_field('short_dates', $post_id);
									?>
									<div class="col-sm-4">
										<div class="production-box">
											<a href="<?php echo $link; ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
											<?php if ( has_post_thumbnail() ) : ?>
												<img src="<?php echo get_the_post_thumbnail_url( $post_id, 'large-square' ); ?>" class="production-thumbnail" />
											<?php endif; ?>
												<h4 class="entry-title">
												<?php echo $title; ?>
											</h4>
											</a>
											<div class="production-date"><?php echo $dates; ?></div>
										</div>	
									</div>	

								<?php
								}
								wp_reset_postdata(); ?>
							</div>

						<?php }
						?>

						</div>	
					
					<?php } // foreach( $categories as $category ) ; ?>					
					
				</main>

			</div>
			
			<div class="col-md-3 order-md-first widget-area" id="left-sidebar" role="complementary">
				<?php get_template_part( 'sidebar-templates/sidebar', 'subnav' ); ?>
			</div>

		</div>

	</div>

	<?php endif; ?>

</div> <!-- #page-wrapper -->

<?php get_footer(); ?>