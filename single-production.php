<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod( 'understrap_container_type' );

function cleanName($input) {
	// strip out all whitespace
	$input = preg_replace('/\s*/', '', $input);	
	// convert the string to all lowercase
	$input = strtolower($input);	
	return $input;
}

?>

<?php get_template_part( 'global-templates/hero', 'image' ); ?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-9 order-2 content-area" id="primary">
				
				<main class="site-main" id="main">

					<div class="production-intro">
						<?php the_field('date_information'); ?>
					</div>			

					<?php
					// check if the flexible content field has rows of data
					if( have_rows('production_content') ):

						echo '<ul class="nav nav-tabs" id="myTab" role="tablist"> <li class="nav-item">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Info</a>
						  </li>';

						// loop through the rows of data
						while ( have_rows('production_content') ) : the_row();

							// check current row layout
							if( get_row_layout() == 'content' ):

								$slug = cleanName(get_sub_field('title'));

								echo '<li class="nav-item">
									<a class="nav-link" id="' . $slug . '-tab" data-toggle="tab" href="#' . $slug . '" role="tab" aria-controls="' . $slug . '">' . get_sub_field('title') . '</a>
								  </li>';

							endif;

							// check current row layout
							if( get_row_layout() == 'cast_crew' ):

								echo '<li class="nav-item">
										<a class="nav-link" id="cast-crew-tab" data-toggle="tab" href="#cast-crew" role="tab" aria-controls="cast-crew" aria-selected="false">Cast &amp; Crew</a>
									  </li>';

							endif;					

							// check current row layout
							if( get_row_layout() == 'link' ):

								$slug = cleanName(get_sub_field('title'));

								$link = get_sub_field('link');

								echo '<li class="nav-item">
									<a class="nav-link" id="' . $slug . '-tab" href="' . $link['url'] . '">' . get_sub_field('title') . '</a>
								  </li>';

							endif;

						endwhile;

						echo '<li class="nav-item">
							<a class="nav-link" id="accessibility-tab" href="/productions/accessibility/">Accessibility</a>
						  </li></ul>';

					else :

						// no layouts found

					endif;

					?>

					<?php
					// check if the flexible content field has rows of data
					if( have_rows('production_content') ):

						echo '<div class="tab-content" id="myTabContent">';
						echo '<div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">';

							while ( have_posts() ) : the_post(); 

								get_template_part( 'loop-templates/content', 'page' ); 					

							endwhile; // end of the loop. 

						echo '</div>';

						// loop through the rows of data
						while ( have_rows('production_content') ) : the_row();

							// check current row layout
							if( get_row_layout() == 'content' ):

								$slug = cleanName(get_sub_field('title'));

								echo '<div class="tab-pane fade" id="' . $slug . '" role="tabpanel" aria-labelledby="' . $slug . '-tab">';

									the_sub_field('content');

								echo '</div>';

							endif;

							// check current row layout
							if( get_row_layout() == 'cast_crew' ):

								echo '<div class="tab-pane fade" id="cast-crew" role="tabpanel" aria-labelledby="cast-crew-tab">';

									// check if the nested repeater field has rows of data
									if( have_rows('cast_member') ):

										echo '<ul>';

										// loop through the rows of data
										while ( have_rows('cast_member') ) : the_row();

											$name = get_sub_field('name');
											$title = get_sub_field('title');
											$bio = get_sub_field('bio');
											$image = get_sub_field('headshot');

											echo '<li>';
											if ($image) {
												echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" class="headshot float-left" />';
											}
											echo '<h3>' . $name . ' <span class="title">(' . $title . ')</span></h3>';
											echo $bio;
											echo '</li>';

										endwhile;

										echo '</ul>';

									endif;

								echo '</div>';

							endif;					

							// check current row layout
							if( get_row_layout() == 'link' ):

								$slug = cleanName(get_sub_field('title'));

								echo '<div class="tab-pane fade" id="' . $slug . '" role="tabpanel" aria-labelledby="' . $slug . '-tab">';

									the_sub_field('link');

								echo '</div>';

							endif;

						endwhile; ?>

						</div>
						<script>
							(function($) {
								// Adding hash to tabs	
								$(document).ready(() => {
								  let url = location.href.replace(/\/$/, "");

								  if (location.hash) {
									const hash = url.split("#");
									$('#myTab a[href="#'+hash[1]+'"]').tab("show");
									url = location.href.replace(/\/#/, "#");
									history.replaceState(null, null, url);
									setTimeout(() => {
									  $(window).scrollTop(0);
									}, 400);
								  } 

								  $('a[data-toggle="tab"]').on("click", function() {
									let newUrl;
									const hash = $(this).attr("href");
									if(hash == "#home") {
									  newUrl = url.split("#")[0];
									} else {
									  newUrl = url.split("#")[0] + "/" + hash;
									}
									//newUrl += "/";
									history.replaceState(null, null, newUrl);
								  });
								});	
							})( jQuery );		
						</script>

					<?php else :

						while ( have_posts() ) : the_post(); 

							get_template_part( 'loop-templates/content', 'page' ); 					

						endwhile; // end of the loop. 

					endif;

					?>

				</main><!-- #main -->
				
			</div>			
			
			<div class="col-md-3 order-1 widget-area" id="left-sidebar" role="complementary">
				<?php get_template_part( 'sidebar-templates/sidebar', 'production' ); ?>
			</div>


		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
