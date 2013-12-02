<?php
function create_the_programs() {
	$labels = array(
		'name' 					=> _x( 'Programs', 'taxonomy general name' ),
		'singular_name' 		=> _x( 'Program', 'taxonomy singular name' ),
		'add_new' 				=> _x( 'Add New Program', 'Program'),
		'add_new_item' 			=> __( 'Add New Program' ),
		'edit_item' 			=> __( 'Edit Program' ),
		'new_item' 				=> __( 'New Program' ),
		'view_item' 			=> __( 'View Program' ),
		'search_items' 			=> __( 'Search Programs' ),
		'not_found' 			=> __( 'No Program found' ),
		'not_found_in_trash' 	=> __( 'No Program found in Trash' ),
	);
	
	$pages = array('courses','profile','post','slider','bulletinboard');
				
	$args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __('Program'),
		'public' 			=> true,
		'show_ui' 			=> true,
		'hierarchical' 		=> true,
		'show_tagcloud' 	=> false,
		'show_in_nav_menus' => false,
		'rewrite' 			=> array('slug' => 'program', 'with_front' => false ),
	 );
	register_taxonomy('program', $pages, $args);
}
add_action('init', 'create_the_programs');
function create_the_sidebars() {
	if ( function_exists('register_sidebar') ) {
		$all_programs = get_terms('program', array('hide_empty'=> 0));
		foreach($all_programs as $single_program) {
			$single_name = $single_program->name;
			$single_slug = $single_program->slug;
			register_sidebar(array(
				'name'          => $single_name .  ' Sidebar',
				'id'            => $single_slug . '-sb',
				'description'   => 'This is the ' . $single_name . ' homepage sidebar',
				'before_widget' => '<div id="widget" class="widget %2$s row">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="blue_bg widget_title"><h5 class="white">',
				'after_title'   => '</h5></div>' 
				));
		}

	}	
}
add_action('init', 'create_the_sidebars');

function remove_unused_sidebars() {
		unregister_sidebar('page-sb');
		unregister_sidebar('graduate-sb');
		unregister_sidebar('undergrad-sb');
		unregister_sidebar('research-sb');
}
add_action( 'widgets_init', 'remove_unused_sidebars', 11 );


function get_the_program_slug($post) {
	wp_reset_query();
	$post = get_queried_object_id();
		if( is_page() && !is_page_template('template-program-frontpage.php') ) { 
        	/* Get an array of Ancestors and Parents if they exist */
			$parents = get_post_ancestors( $post );
			if (!empty($parents)) {
			/* Get the top Level page->ID count base 1, array base 0 so -1 */ 
			$id = ($parents) ? $parents[count($parents)-1]: $post->ID;
			/* Get the parent and set the $class with the page slug (post_name) */
			$parent = get_post( $id );
			$program = $parent->post_name;
			}
		}  elseif (is_page_template('template-program-frontpage.php')) {
			$program = get_the_title($post);
			$program = strtolower($program);
		}elseif (is_singular() && !is_singular('people')){
			$terms = get_the_terms($post, 'program');
			if(is_array($terms)) {
				$term_names = array();
				foreach( $terms as $term) { 
					$term_names[] = $term->slug;
				 } 
				 $program = implode('', $term_names);
			} 
			
			else { $program = $terms->slug; }
		} elseif (is_singular('people')) {
			$terms = get_the_terms($post, 'filter');
			if(is_array($terms)) {
				$term_names = array();
				foreach( $terms as $term) { 
					$term_names[] = $term->slug;
				 } 
				 $program = implode('', $term_names);
			} 
			
			else { $program = $terms->slug; }
		} else { $program = '';}
	return $program;
}

function get_the_program_name($post) {
	wp_reset_query();
	$post = get_queried_object_id();
		if( is_page() && !is_page_template('template-program-frontpage.php') ) { 
        	/* Get an array of Ancestors and Parents if they exist */
			$parents = get_post_ancestors( $post );
			if (!empty($parents)) {

			/* Get the top Level page->ID count base 1, array base 0 so -1 */ 
			$id = ($parents) ? $parents[count($parents)-1]: $post->ID;
			/* Get the parent and set the $class with the page slug (post_name) */
			$parent = get_post( $id );
			$program = $parent->post_title;
			}
		} elseif (is_page_template('template-program-frontpage.php')) {
			$program = get_the_title($post);
		
		} elseif (is_singular() && !is_singular('people')){
			$terms = get_the_terms($post, 'program');
			if(is_array($terms)) {
				$term_names = array();
				foreach( $terms as $term) { 
					$term_names[] = $term->name;
				 } 
				 $program = implode('', $term_names);
			} 
			
			else { $program = $terms->name; }
		} elseif (is_singular('people')){
			$terms = get_the_terms($post, 'filter');
			if(is_array($terms)) {
				$term_names = array();
				foreach( $terms as $term) { 
					$term_names[] = $term->name;
				 } 
				 $program = implode('', $term_names);
			} 
			
			else { $program = $terms->name; }
		} else { $program = '';}
	return $program;
}
