<?php

if (!function_exists('diarjolite_loadwidgets')) {

	function diarjolite_loadwidgets() {

		register_sidebar(array(
		
			'name' => __('Sidebar','diarjo-lite'),
			'id'   => 'side-sidebar-area',
			'description' => __('This sidebar will be shown after the content.','diarjo-lite'),
			'before_widget' => '<div class="post-article">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="title">',
			'after_title'   => '</h3>'
		
		));
	
		register_sidebar(array(

			'name' => __('Home Sidebar','diarjo-lite'),
			'id'   => 'home-sidebar-area',
			'description' => __('This sidebar will be shown in the homepage.','diarjo-lite'),
			'before_widget' => '<div class="post-article">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="title">',
			'after_title'   => '</h3>'
		
		));
	
		register_sidebar(array(

			'name' => __('Category Sidebar','diarjo-lite'),
			'id'   => 'category-sidebar-area',
			'description' => __('This sidebar will be shown at the side of content.','diarjo-lite'),
			'before_widget' => '<div class="post-article">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="title">',
			'after_title'   => '</h3>'
		
		));
	
		register_sidebar(array(

			'name' => __('Bottom Sidebar','diarjo-lite'),
			'id'   => 'bottom-sidebar-area',
			'description' => __('This sidebar will be shown at the bottom of page.','diarjo-lite'),
			'before_widget' => '<div class="col-md-4 widget-box">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'
		
		));

	}

	add_action( 'widgets_init', 'diarjolite_loadwidgets' );

}

?>