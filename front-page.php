<?php
/**
 *
 * Template for displaying the front page.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">
					
					<?php
					if( have_rows('mainstage_productions') ): ?>
						<div class="clearfix">
							<h3>MainStage</h3>

							<?php while ( have_rows('mainstage_productions') ) : the_row();

								$overline = get_sub_field('overline');
								$title = get_sub_field('title');
								$dates = get_sub_field('dates');
								$link = get_sub_field('link');
								$image = get_sub_field('image'); 

						echo '<div><h4>' . $overline . '</h4>';
								echo '<a href="' . $link . '"><img src="' . $image['url'] . '" class="float-left">';
								echo '<h5>' . $title . '</h5>';
								echo '<p>' . $dates . '</p></a></div>';

							endwhile;

						else : ?>

						</div>
					
					<?php endif; ?>
					
					<?php
					if( have_rows('kidseries_productions') ): ?>
						<div class="clearfix" style="clear: both;">
							<h3>KidSeries</h3>

							<?php while ( have_rows('kidseries_productions') ) : the_row();

								$overline = get_sub_field('overline');
								$title = get_sub_field('title');
								$dates = get_sub_field('dates');
								$link = get_sub_field('link');
								$image = get_sub_field('image'); 

								echo '<div><h4>' . $overline . '</h4>';
								echo '<a href="' . $link . '"><img src="' . $image['url'] . '" class="float-left">';
								echo '<h5>' . $title . '</h5>';
								echo '<p>' . $dates . '</p></a></div>';

							endwhile;

						else : ?>

						</div>
					
					<?php endif; ?>
					
					<div class="clearfix" style="clear: both;">
						<?php the_field('additional_content'); ?>
					</div>
						
					<?php 
					$rows = get_field('hero_image' ); // get all the rows
					$rand_row = $rows[ array_rand( $rows ) ]; // get a random row
					$rand_row_image = $rand_row['image' ]; // get the sub field value 
					$image = wp_get_attachment_image_src( $rand_row_image['ID'], 'full' );
					// url = $image[0];
					// width = $image[1];
					// height = $image[2];
					?>
					<img src="<?php echo $image[0]; ?>" />

					<?php while ( have_posts() ) : the_post(); ?>

						<?php the_content(); ?>

					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php get_footer(); ?>
