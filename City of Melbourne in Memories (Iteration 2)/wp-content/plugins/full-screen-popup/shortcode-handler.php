<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$xyz_fsp_cache_enable=get_option('xyz_fsp_cache_enable');
$xyz_fsp_enable=get_option('xyz_fsp_enable');
$page_option=get_option('xyz_fsp_page_option');
if($xyz_fsp_enable==1)
{
	if($xyz_fsp_cache_enable==1)
	{	
       add_shortcode( 'xyz_fsp_default_code', 'xyz_fsp_shortcode' );
	}
	else 
	{
		if($page_option==3)
		   add_shortcode( 'xyz_fsp_default_code', 'xyz_fsp_display' );
	}	   
}
function xyz_fsp_shortcode()
{
	return "<span id='xyz_fsp_shortcode'></span>";
}
?>