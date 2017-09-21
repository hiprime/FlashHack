<!doctype html>
<html <?php echo themify_get_html_schema(); ?> <?php language_attributes(); ?>>
<head>
<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<title itemprop="name"><?php wp_title( '' ); ?></title>

<?php
/**
 *  Stylesheets and Javascript files are enqueued in theme-functions.php
 */
?>

<!-- wp_header -->
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php themify_body_start(); //hook ?>
<div id="pagewrap" class="hfeed site">

	<div id="headerwrap">

		<?php themify_header_before(); //hook ?>
		<header id="header" class="pagewidth">
        	<?php themify_header_start(); //hook ?>
        
			<hgroup>
				<?php echo themify_logo_image('site_logo'); ?>
			</hgroup>
	
			<nav id="main-nav-wrap">
				<div id="menu-icon" class="mobile-button"></div>
				<?php if (function_exists('wp_nav_menu')) {
					wp_nav_menu(array('theme_location' => 'main-nav' , 'fallback_cb' => 'themify_default_main_nav' , 'container'  => '' , 'menu_id' => 'main-nav' , 'menu_class' => 'main-nav'));
				} else {
					themify_default_main_nav();
				} ?>
			</nav>
			<!-- /#main-nav -->
			
			<div id="social-wrap">
				<?php if(!themify_check('setting-exclude_search_form')): ?>
					<div id="searchform-wrap">
						<div id="search-icon" class="mobile-button"></div>
							<?php get_search_form(); ?>
					</div>
					<!-- /searchform-wrap -->
				<?php endif; ?>
		
				<div class="social-widget">
					<?php dynamic_sidebar('social-widget'); ?>
		
					<?php if(!themify_check('setting-exclude_rss')): ?>
						<div class="rss"><a href="<?php if(themify_get('setting-custom_feed_url') != ""){ echo themify_get('setting-custom_feed_url'); } else { bloginfo('rss2_url'); } ?>">RSS</a></div>
					<?php endif ?>
				</div>
				<!-- /.social-widget -->
			</div>
            
            <?php themify_header_end(); //hook ?>
		</header>
		<!-- /#header -->
        <?php themify_header_after(); //hook ?>
				
	</div>
	<!-- /#headerwrap -->
	
	<div id="body" class="clearfix"> 
	<?php themify_layout_before(); //hook ?>