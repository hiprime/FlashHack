<?php get_header(); ?>

<?php
/** Themify Default Variables
 *  @var object */
	global $themify; ?>

<?php if( have_posts() ) while ( have_posts() ) : the_post(); ?>

<!-- layout-container -->
<div id="layout" class="pagewidth clearfix">

	<?php themify_content_before(); //hook ?>
	<!-- content -->
	<div id="content" class="list-post">
    	<?php themify_content_start(); //hook ?>
        
        <?php themify_post_before(); //hook ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('post clearfix ' . $themify->get_categories_as_classes(get_the_ID())); ?>>
        	<?php themify_post_start(); //hook ?>
            
			<div class="post-inner">

			<?php get_template_part( 'includes/loop' , 'single'); ?>
	
			<?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'themify') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			<?php get_template_part( 'includes/author-box', 'single'); ?>

		<?php get_template_part( 'includes/post-nav'); ?>

		<?php if(!themify_check('setting-comments_posts')): ?>
			<?php comments_template(); ?>
		<?php endif; ?>
			</div>
			<!-- /.post-inner -->
            
            <?php themify_post_end(); //hook ?>
		</article>
		<!-- /.post -->
        <?php themify_post_after(); //hook ?>
        
        <?php themify_content_end(); //hook ?>
	</div>
	<!-- /content -->
    <?php themify_content_after() //hook; ?>

<?php endwhile; ?>

<?php 
/////////////////////////////////////////////
// Sidebar							
/////////////////////////////////////////////
if ($themify->layout != "sidebar-none"): get_sidebar(); endif; ?>

</div>
<!-- /layout-container -->
	
<?php get_footer(); ?>