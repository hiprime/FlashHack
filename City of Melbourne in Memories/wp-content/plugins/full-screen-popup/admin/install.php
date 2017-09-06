<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function xyz_fsp_network_install($networkwide) {
	global $wpdb;

	if (function_exists('is_multisite') && is_multisite()) {
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) {
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				fsp_install();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	fsp_install();
}

function fsp_install()
{
	global $wpdb;
	if(get_option('xyz_credit_link')=="")
	{
		add_option("xyz_credit_link", '0');
	}
	
	$fullscreen_installed_date = get_option('fullscreen_installed_date');
	if ($fullscreen_installed_date=="") {
		$fullscreen_installed_date = time();
		update_option('fullscreen_installed_date', $fullscreen_installed_date);
	}
	
	add_option("xyz_fsp_html", 'Hello world.');
	add_option("xyz_fsp_tinymce", '1');	
	add_option("xyz_fsp_enable", '1');
	add_option("xyz_fsp_adds_enable", '1');
	add_option("xyz_fsp_cache_enable", '0');
	add_option('xyz_fsp_showing_option','0,0,0');
	add_option("xyz_fsp_delay", '0');
	add_option("xyz_fsp_page_count", '1');
	add_option("xyz_fsp_mode", 'delay_only'); //page_count_only,both are other options
	add_option("xyz_fsp_repeat_interval", '1');
	add_option("xyz_fsp_repeat_interval_timing", '1');//hrs or  minute
	add_option("xyz_fsp_z_index",'100000');
	add_option("xyz_fsp_corner_radius",'0');
	add_option("xyz_fsp_border_color",'#cccccc');
	add_option("xyz_fsp_bg_color",'#ffffff');
	add_option("xyz_fsp_title",'Title');
	add_option("xyz_fsp_title_color",'#fcfcfa');
	add_option("xyz_fsp_border_width",'10');
	add_option("xyz_fsp_page_option",'1');
	add_option("xyz_fsp_iframe",'1');

	$version=get_option('xyz_fsp_free_version');
	$currentversion=xyz_fsp_plugin_get_version();
	if($version=="")
	{
		add_option("xyz_fsp_free_version", $currentversion);
	}
	else
	{
	
		update_option('xyz_fsp_free_version', $currentversion);
	}
	
	
}
//register_activation_hook(XYZ_FSP_PLUGIN_FILE,'fsp_install');
register_activation_hook( XYZ_FSP_PLUGIN_FILE ,'xyz_fsp_network_install');

?>
