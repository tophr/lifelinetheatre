<?php

/**
 * Production History Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'prod-history-' . $block[ 'id' ];
if ( !empty( $block[ 'anchor' ] ) ) {
	$id = $block[ 'anchor' ];
}

// Create class attribute allowing for custom "classname" and "align" values.
$classname = 'prod-history';
if ( !empty( $block[ 'classname' ] ) ) {
	$classname .= ' ' . $block[ 'classname' ];
}

// Load values and assign defaults.
$year = get_field( 'year' ) ? : 'Year';
$venue = 'venue';
$season_award = get_field('season_award');
?>

<div class="archive-production-year">
	<div id="<?php echo esc_attr($id); ?>" class="row <?php echo esc_attr($classname); ?>-row">

		<div class="col-sm-3">
			<h2 class="">
				<?php echo $year; ?>
			</h2>
		</div>	

		<?php if( have_rows($venue) ): ?>

			<div class='archive-content col-sm-9'>
				<?php while( have_rows($venue) ): the_row(); 

					// vars
					$venue_name = get_sub_field('venue_name');
					$production = 'production';
					
					?>

					<div class="row archive-venue-row">
						<div class="col-sm-3">
							<h3 class="archive-venue-name">
								<?php echo $venue_name; ?>
							</h3>
						</div>
						<div class="col-sm-9">
						<?php if( have_rows($production) ): ?>	
							<?php
							while( have_rows($production) ): the_row(); 
								$title = get_sub_field( 'title' );
								$awards = get_sub_field( 'awards' );
								$world_premiere = get_sub_field( 'world_premiere' );
								?>
							<h4 class="entry-title">
								<?php echo $title; ?><?php if ($world_premiere == 'adaptation') { echo '*'; } else if ($world_premiere == 'work') { echo '**'; }; ?>
							</h4>

							<?php if ($awards) {  echo $awards; }; ?>

							<?php endwhile; ?>
						<?php endif; ?>	
						</div>
						
					</div>

				<?php endwhile; ?>
				
				<?php echo $season_award; ?>
				
			</div>

		<?php endif; ?>

	</div>
</div>	

