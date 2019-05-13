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

?>

<?php //get_template_part( 'global-templates/hero', 'image' ); ?>

<div class="wrapper" id="page-wrapper">
	
	<?php if ( have_posts() ) : ?>

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">		
		
		<header class="page-header">
			<h1 class="page-title">Production History</h1>
		</header>

		<div class="row">

			<div class="col-md-3 widget-area" id="left-sidebar" role="complementary">
				<?php get_template_part( 'sidebar-templates/sidebar', 'subnav' ); ?>
			</div>

			<div class="col-md-9 content-area" id="primary">
				
				<main class="site-main" id="main">
					
					<p>*World premiere of Original Literary Adaptation<br>
					**World premiere of Original Work</p>
					
					
					<?php $taxonomy = array( "name" => 'season' , "slug" => 'season');
						$custom_post_type = "production";

						if ( have_posts() )
						the_post();
						?>

						<?php
						// Query your specified taxonomy to get, in order, each category
						$categories = get_terms($taxonomy['name'], 'orderby=title&order=DESC');
						foreach( $categories as $category ) {
						?>

						<div id="content">    
						<h2 class="page-title">
						<?php echo $category->name; ?>
						</h2>
					
					<?php
						global $post; // Access the global $post object.

						// Setup query to return each custom post within this taxonomy category
						$o_queried_posts = get_posts(array(
							'nopaging' => true,
							'post_type' => $custom_post_type,
							'taxonomy' => $category->taxonomy,
							'term' => $category->slug,
						));
					?>

					<div id='archive-content'>

					<?php
					// Loop through each custom post type
					foreach($o_queried_posts as $post) : 
						setup_postdata($post); // setup post data to use the Post template tags. ?>

						<div id="post-<?php the_ID(); ?>">
							
							<?php 
							$venue = get_field('venue', $post->id); 
							$world_premiere = get_field('world_premiere', $post->id); 
							//var_dump($world_premiere);
							?>

						   <h3 class="entry-title">
							   <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><?php if ($world_premiere == 'adaptation') { echo '*'; } else if ($world_premiere == 'work') { echo '**'; }; ?>
							</h3>

						</div><!-- #post -->
					<?php endforeach; wp_reset_postdata(); ?>

					</div> <!-- archive-content -->
							
					</div> <!-- #content -->
					<?php } // foreach( $categories as $category ) ; ?>
							

				</main><!-- #main -->
				
			</div>

		</div><!-- .row -->

	</div><!-- #content -->
		
	<?php endif; ?>	

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
