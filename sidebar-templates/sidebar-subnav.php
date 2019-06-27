<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<ul class="subnav">
	<?php
		function has_children($post_id) {
			$children = get_pages("child_of=$post_id");
			if( count( $children ) != 0 ) { return true; } // Has Children
			else { return false; } // No children
		}
		
		$kids = has_children($post->ID);
		
		//var_dump($kids);
		
		if (!$kids) {
			global $post;
			
			$parentId = $post->post_parent;
			$linkToParent = get_permalink($parentId);
			$parent_title = get_the_title( $post->post_parent );
			
			echo '<li class="page_item parent_page"><a href="' . esc_url( get_permalink( $post->post_parent ) ) . '" alt="' . esc_attr( $parent_title ) . '">' . $parent_title . '</a>';
			
			$current_page_parent = ( $post->post_parent ? $post->post_parent : $post->ID );
	
			wp_list_pages( array(
				 'title_li' => '',
				 'child_of' => $current_page_parent,
				 'depth' => '1' )
			);
	
			//$parentId = $post->post_parent;
			//$linkToParent = get_permalink($parentId);	
			//echo '<li><a href="' . $linkToParent . '">' . $parentId . '</a></li>';
			
			/*$parent_title = get_the_title( $post->post_parent );
			if ( $parent_title != the_title( ' ', ' ', false ) ) {
				echo '<li><a href="' . esc_url( get_permalink( $post->post_parent ) ) . '" alt="' . esc_attr( $parent_title ) . '">' . $parent_title . '</a><ul class="children manual">';
			}*/
			
		} else {
			global $post;
			
			$page_title = get_the_title( $post->ID );
			echo "<li class='page_item parent_page current_page_item'><a href='#'>" . esc_attr( $page_title ) . "</a></li>"; 
			
			$current_page_parent = ( $post->post_parent ? $post->post_parent : $post->ID );
			
			wp_list_pages( array(
				 'title_li' => '',
				 'child_of' => $post->ID,
				 'depth' => '2' )
			);
		}
	
		if (!$kids) { 
			//echo '</ul></li>';
		}	
		
	?>		
	</ul>	