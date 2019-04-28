<?php
/**
 * Static hero image.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( has_post_thumbnail() ) : ?>
	<div class="hero-image" style="background-image: url('<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>')">
		<div class="<?php echo esc_attr( $container ); ?>">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</div>
<?php endif; ?>
