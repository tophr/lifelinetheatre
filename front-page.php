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

<?php 
$rows = get_field('hero_image' ); // get all the rows
$rand_row = $rows[ array_rand( $rows ) ]; // get a random row
$rand_row_image = $rand_row['image' ]; // get the sub field value 
$image = wp_get_attachment_image_src( $rand_row_image['ID'], 'full' );
?>

<div class="wrapper" id="full-width-page-wrapper" style="background-image: linear-gradient(to right, rgba(0,0,0,0.95) 20%,rgba(0,0,0,0) 100%), url('<?php echo $image[0]; ?>')">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">
					
					<?php
					if( have_rows('mainstage_productions') ): ?>
						<div class="clearfix home-production-container">
							<h3>MainStage</h3>

							<?php while ( have_rows('mainstage_productions') ) : the_row();

								$overline = get_sub_field('overline');
								$title = get_sub_field('title');
								$dates = get_sub_field('dates');
								$link = get_sub_field('link');
								$image = get_sub_field('image'); 

								echo '<h5>' . $overline . '</h5><div class="home-production-box">';
								echo '<a href="' . $link . '"><img src="' . $image['url'] . '" class="float-left">';
								echo '<div class="home-production-description"><h4>' . $title . '</h4>';
								echo '<p>' . $dates . '</p></div></a></div>';

							endwhile;

						else : ?>

						</div>
					
					<?php endif; ?>
					
					<?php
					if( have_rows('kidseries_productions') ): ?>
						<div class="clearfix home-production-container">
							<h3>KidSeries</h3>

							<?php while ( have_rows('kidseries_productions') ) : the_row();

								$overline = get_sub_field('overline');
								$title = get_sub_field('title');
								$dates = get_sub_field('dates');
								$link = get_sub_field('link');
								$image = get_sub_field('image'); 

								echo '<h5>' . $overline . '</h5><div class="home-production-box">';
								echo '<a href="' . $link . '"><img src="' . $image['url'] . '" class="float-left">';
								echo '<div class="home-production-description"><h4>' . $title . '</h4>';
								echo '<p>' . $dates . '</p></div></a></div>';

							endwhile;

						else : ?>

						</div>
					
					<?php endif; ?>
					
					<div class="entry-content clearfix" style="clear: both;">
						<?php the_field('additional_content'); ?>															

						<?php while ( have_posts() ) : the_post(); ?>

							<?php the_content(); ?>

						<?php endwhile; // end of the loop. ?>
					</div>		

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php get_footer(); ?>
