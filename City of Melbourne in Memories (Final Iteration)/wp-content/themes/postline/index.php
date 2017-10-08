<?php get_header(); ?>

<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<!-- layout -->
<div id="layout" class="pagewidth clearfix">

	<?php themify_content_before(); //hook ?>
	<!-- content -->
	<div id="content" class="clearfix">
    	<?php themify_content_start(); //hook ?>
		
		<?php 
		/////////////////////////////////////////////
		// Author Page	 							
		/////////////////////////////////////////////
		?>
		<?php if(is_author()) : ?>
			<?php
			$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
			$author_url = $curauth->user_url;
			?>
			<div class="author-bio clearfix">
				<p class="author-avatar"><?php echo get_avatar( $curauth->user_email, $size = '48' ); ?></p>
				<h2 class="author-name"><?php _e('About','themify'); ?> <?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></h2>
				<?php if($author_url != ''): ?><p class="author-url"><a href="<?php echo $author_url; ?>"><?php echo $author_url; ?></a></p><?php endif; //author url ?>
				<div class="author-description">
					<?php echo $curauth->user_description; ?>
				</div>
				<!-- /.author-description -->
			</div>
			<!-- /.author bio -->
			
			<h2 class="author-posts-by"><?php _e('Posts by','themify'); ?> <?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?>:</h2>
		<?php endif; ?>

		<?php 
		/////////////////////////////////////////////
		// Search Title	 							
		/////////////////////////////////////////////
		?>
		<?php if(is_search()): ?>
			<h1 class="page-title"><?php _e('Search Results for:','themify'); ?> <em><?php echo get_search_query(); ?></em></h1>
		<?php endif; ?>
	
		<?php
		/////////////////////////////////////////////
		// Date Archive Title
		/////////////////////////////////////////////
		?>
		<?php if ( is_day() ) : ?>
			<h1 class="page-title"><?php printf( __( 'Daily Archives: <span>%s</span>', 'themify' ), get_the_date() ); ?></h1>
		<?php elseif ( is_month() ) : ?>
			<h1 class="page-title"><?php printf( __( 'Monthly Archives: <span>%s</span>', 'themify' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'themify' ) ) ); ?></h1>
		<?php elseif ( is_year() ) : ?>
			<h1 class="page-title"><?php printf( __( 'Yearly Archives: <span>%s</span>', 'themify' ), get_the_date( _x( 'Y', 'yearly archives date format', 'themify' ) ) ); ?></h1>
		<?php endif; ?>

		<?php 
		/////////////////////////////////////////////
		// Category Title	 							
		/////////////////////////////////////////////
		?>
		<?php if(is_category() || is_tag() || is_tax() ): ?>
			<h1 class="page-title"><?php single_cat_title(); ?></h1>
			<?php echo $themify->get_category_description(); ?>
		<?php endif; ?>

		<?php 
		/////////////////////////////////////////////
		// Default query categories	 							
		/////////////////////////////////////////////
		?>
		
		<?php if( !is_search() && !isset( $_POST['ajax_load'] ) ): ?>
			<?php
			global $query_string;
			query_posts( apply_filters( 'themify_query_posts_args', $query_string.'&order='.$themify->order.'&orderby='.$themify->orderby ) );
			?>
		<?php endif; ?>

		<?php 
		/////////////////////////////////////////////
		// Loop	 							
		/////////////////////////////////////////////
		if( 'timeline' == $themify->post_layout || isset($_POST['ajax_load']) ){
			$default_timeline_layout = themify_get('setting-default_timeline_query');
			get_template_part('includes/layout-timeline', $default_timeline_layout);
		} else {
			get_template_part('includes/layout', 'general');
		}
		?>
        
        <?php themify_content_end(); //hook ?>
	</div>
	<!-- /#content -->
    <?php themify_content_after() //hook; ?>

	<?php 
	/////////////////////////////////////////////
	// Sidebar							
	/////////////////////////////////////////////
	if ($themify->layout != "sidebar-none"): get_sidebar(); endif; ?>

</div>
<!-- /#layout -->

<?php get_footer(); ?>