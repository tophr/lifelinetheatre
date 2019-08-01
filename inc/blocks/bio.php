<?php

/**
 * Bio Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'bio-' . $block[ 'id' ];
if ( !empty( $block[ 'anchor' ] ) ) {
	$id = $block[ 'anchor' ];
}

// Create class attribute allowing for custom "classname" and "align" values.
$classname = 'bio';
if ( !empty( $block[ 'classname' ] ) ) {
	$classname .= ' ' . $block[ 'classname' ];
}

// Load values and assing defaults.
$text = get_field( 'bio' ) ? : 'Your bio here...';
$name = get_field( 'name' ) ? : 'Name';
$title = get_field( 'title' );
$image = get_field( 'headshot' );

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classname); ?>-row">
	<a name="<?php print str_replace(' ', '-', strtolower($name)); ?>"></a>
	<div class="bio-image">
		<img src="<?php echo $image['url']; ?>" alt="" class="headshot" />
	</div>
	<div class="bio-content">
		<h3 classs="bio-name"><?php echo $name; ?> <?php if ($title) { ?><span class="title">(<?php echo $title; ?>)</span><?php }; ?></h3> 
		<div class="bio-content"><?php echo $text; ?></div>
	</div>	
</div>
