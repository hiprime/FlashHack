<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function xyz_fsp_network_destroy($networkwide) {
	global $wpdb;

	if (function_exists('is_multisite') && is_multisite()) {
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) {
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				fsp_destroy();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	fsp_destroy();
}

function fsp_destroy()
{
	global $wpdb;
	delete_option("xyz_fsp_tinymce");
	if(get_option('xyz_credit_link')=="fsp")
	{
		update_option("xyz_credit_link", '0');
	}
	delete_option("xyz_fsp_html");
	delete_option("xyz_fsp_top");
	delete_option("xyz_fsp_width");
	delete_option("xyz_fsp_height");
	delete_option("xyz_fsp_left");
	
	delete_option("xyz_fsp_enable");
	delete_option("xyz_fsp_adds_enable");
	delete_option("xyz_fsp_cache_enable");
	delete_option("xyz_fsp_showing_option");
	
	delete_option("xyz_fsp_delay");
	delete_option("xyz_fsp_page_count");
	delete_option("xyz_fsp_mode"); //page_count_only,both are other options
	delete_option("xyz_fsp_repeat_interval");
	delete_option("xyz_fsp_repeat_interval_timing");//hrs or  minute
	delete_option("xyz_fsp_z_index");
	delete_option("xyz_fsp_color");	
	delete_option("xyz_fsp_corner_radius");
	delete_option("xyz_fsp_width_dim");
	delete_option("xyz_fsp_height_dim");
	delete_option("xyz_fsp_left_dim");
	delete_option("xyz_fsp_top_dim");
	delete_option("xyz_fsp_border_color");
	delete_option("xyz_fsp_bg_color");
	delete_option("xyz_fsp_opacity");
	delete_option("xyz_fsp_border_width");
	delete_option("xyz_fsp_page_option");
	delete_option("xyz_fsp_close_button_option");
	delete_option("xyz_fsp_iframe");
	
	delete_option("xyz_fsp_positioning");
	delete_option("xyz_fsp_position_predefined");
	delete_option("xyz_fsp_display_position");
	
	
	delete_option("fullscreen_installed_date");
	

}

register_uninstall_hook(XYZ_FSP_PLUGIN_FILE,'xyz_fsp_network_destroy');


?>