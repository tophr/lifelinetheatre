<?php
/**
* Template Name: Production History
*
* The template for displaying production history.
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

            <p>*World premiere of Original Literary Adaptation<br> **World premiere of Original Work</p>

            <?php $taxonomy = array( "name" => 'season' , "slug" => 'season');
            $custom_post_type = "production";

            if ( have_posts() )
            the_post();
            ?>

            <?php
            // Query your specified taxonomy to get, in order, each category
            $categories = get_terms( $taxonomy[ 'name' ], 'orderby=title&order=DESC' );
            foreach ( $categories as $category ) {
              ?>

              <div class="archive-production-year">
                <div class="row">

                  <div class="col-sm-3">
                    <h2 class="">
                      <?php echo $category->name; ?>
                    </h2>
                  </div>

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
                  ?>

                  <div class='archive-content col-sm-9'>


                    <?php
                    $productions = array();

                    foreach ( $o_queried_posts as $post ) {
                      $venue = get_field( 'venue', $post->id );
                      $productions[ $venue ][] = $post;
                    }

                    wp_reset_query();

                    foreach ( $productions as $production => $venue_title ) {
                      ?>
                      <div class="row archive-venue-row">
                        <div class="col-sm-3">
                          <h3 class="archive-venue-name">
                            <?php echo esc_html($production); ?>
                          </h3>
                        </div>
                        <div class="col-sm-9">
                          <?php
                          foreach ( $venue_title as $listing => $single_listing ) {
                            setup_postdata( $single_listing );
                            $post_id = $single_listing->ID;
                            $title = get_the_title( $post_id );
                            $link = get_the_permalink( $post_id );
                            $awards = get_field( 'awards', $post_id );
                            $world_premiere = get_field( 'world_premiere', $post_id );
                            ?>
                            <h4 class="entry-title">
                              <a href="<?php echo $link; ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo $title; ?></a><?php if ($world_premiere == 'adaptation') { echo '*'; } else if ($world_premiere == 'work') { echo '**'; }; ?>
                            </h4>

                            <?php if ( $awards ): ?>
                              <p><?php echo $awards ?></p>
                            <?php endif; ?>

                            <?php
                          }
                          wp_reset_postdata(); ?>
                        </div></div>

                      <?php }
                      ?>

                    </div>
                  </div>
                </div>

              <?php } // foreach( $categories as $category ) ; ?>

              <?php // General page content / manual production entry ?>
              <?php get_template_part( 'loop-templates/content', 'page' ); ?>

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
