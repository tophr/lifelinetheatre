<?php
/**
 * The sidebar containing production subnav
 *
 * @package understrap
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$categories = get_the_terms( $post->id, 'season' );

foreach ( $categories as $category ) {
	?>
<h3 class=""> <?php echo $category->name; ?> </h3>
<ul class="subnav">
	
	<?php
	global $post; // Access the global $post object.

	// Setup query to return each custom post within this taxonomy category
	$o_queried_posts = get_posts( array(
		'nopaging' => true,
		'post_type' => 'production',
		'taxonomy' => $category->taxonomy,
		'term' => $category->slug,
		'order' => 'ASC',
		//'orderby' => 'title',
	) );
	?>
	<?php
	$productions = array();

	foreach ( $o_queried_posts as $post ) {
		$venue = get_field( 'venue', $post->id );
		$productions[ $venue ][] = $post;
	}

	wp_reset_query();

	foreach ( $productions as $production => $venue_title ) {
		?>
	<?php
	foreach ( $venue_title as $listing => $single_listing ) {
		setup_postdata( $single_listing );
		$post_id = $single_listing->ID;
		$title = get_the_title( $post_id );
		$link = get_the_permalink( $post_id );
		$world_premiere = get_field( 'world_premiere', $post_id );
		?>
	<li <?php if ($post_id == $post->ID) { echo 'class="current_page_item"'; }; ?>><a href="<?php echo $link; ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo $title; ?></a> </li>
	<?php
	}
	wp_reset_postdata();
	?>
	<?php
	}
	?>
</ul>
<?php } // foreach( $categories as $category ) ; ?>
