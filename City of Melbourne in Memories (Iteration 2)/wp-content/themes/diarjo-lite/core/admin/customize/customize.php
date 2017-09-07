<?php

if (!function_exists('diarjolite_customize_panel_function')) {

	function diarjolite_customize_panel_function() {
		
		$theme_panel = array ( 

			/* FULL IMAGE BACKGROUND */ 

			array(
				
				"label" => __( "Full Image Background",'diarjo-lite'),
				"description" => __( "Do you want to set a full background image? (After the upload, check 'Fixed', from the Background Attachment section)",'diarjo-lite'),
				"id" => "diarjolite_full_image_background",
				"type" => "select",
				"section" => "background_image",
				"options" => array (
				   "off" => __( "No",'diarjo-lite'),
				   "on" => __( "Yes",'diarjo-lite'),
				),
				
				"std" => "off",
			
			),

			/* START GENERAL SECTION */ 

			array( 
				
				"title" => __( "General",'diarjo-lite'),
				"description" => __( "General",'diarjo-lite'),
				"type" => "panel",
				"id" => "general_panel",
				"priority" => "10",
				
			),

			array( 

				"title" => __( "Load system",'diarjo-lite'),
				"type" => "section",
				"id" => "loadsystem_section",
				"panel" => "general_panel",
				"priority" => "11",

			),

			array(
				
				"label" => __( "Choose a load system",'diarjo-lite'),
				"description" => __( "Select a load system, if you've some problems with the theme (for example a blank page).",'diarjo-lite'),
				"id" => "diarjolite_skins",
				"type" => "select",
				"section" => "loadsystem_section",
				"options" => array (
				   "mode_a" => __( "Mode a",'diarjo-lite'),
				   "mode_b" => __( "Mode b",'diarjo-lite'),
				),
				
				"std" => "mode_a",
			
			),

			/* SKINS */ 

			array( 

				"title" => __( "Color Scheme",'diarjo-lite'),
				"type" => "section",
				"panel" => "general_panel",
				"priority" => "12",
				"id" => "colorscheme_section",

			),

			array(
				
				"label" => __( "Predefined Color Schemes",'diarjo-lite'),
				"description" => __( "Choose your Color Scheme",'diarjo-lite'),
				"id" => "diarjolite_skin",
				"type" => "select",
				"section" => "colorscheme_section",
				"options" => array (
				   "turquoise" => __( "Turquoise","diarjo-lite"),
				   "orange" => __( "Orange","diarjo-lite"),
				   "blue" => __( "Blue","diarjo-lite"),
				   "red" => __( "Red","diarjo-lite"),
				   "purple" => __( "Purple","diarjo-lite"),
				   "yellow" => __( "Yellow","diarjo-lite"),
				   "green" => __( "Green","diarjo-lite"),
				   "light_turquoise" => __( "Light & Turquoise","diarjo-lite"),
				   "light_orange" => __( "Light & Orange","diarjo-lite"),
				   "light_blue" => __( "Light & Blue","diarjo-lite"),
				   "light_red" => __( "Light & Red","diarjo-lite"),
				   "light_purple" => __( "Light & Purple","diarjo-lite"),
				   "light_yellow" => __( "Light & Yellow","diarjo-lite"),
				   "light_green" => __( "Light & Green","diarjo-lite"),
				   "white_turquoise" => __( "White & Turquoise",'diarjo-lite'),
				   "white_orange" => __( "White & Orange",'diarjo-lite'),
				   "white_blue" => __( "White & Blue",'diarjo-lite'),
				   "white_red" => __( "White & Red",'diarjo-lite'),
				   "white_purple" => __( "White & Purple",'diarjo-lite'),
				   "white_yellow" => __( "White & Yellow",'diarjo-lite'),
				   "white_green" => __( "White & Green",'diarjo-lite'),
				),
				
				"std" => "turquoise",
			
			),

			/* STYLES */ 

			array( 

				"title" => __( "Styles",'diarjo-lite'),
				"type" => "section",
				"id" => "styles_section",
				"panel" => "general_panel",
				"priority" => "14",

			),

			array( 

				"label" => __( "Custom css",'diarjo-lite'),
				"description" => __( "Insert your custom css code.",'diarjo-lite'),
				"id" => "diarjolite_custom_css_code",
				"type" => "custom_css",
				"section" => "styles_section",
				"std" => "",

			),

			/* LAYOUTS SECTION */ 

			array( 

				"title" => __( "Layouts",'diarjo-lite'),
				"type" => "section",
				"id" => "layouts_section",
				"panel" => "general_panel",
				"priority" => "15",

			),

			array(
				
				"label" => __("Home Blog Layout",'diarjo-lite'),
				"description" => __("If you've set the latest articles, for the homepage, choose a layout.",'diarjo-lite'),
				"id" => "diarjolite_home",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
				   "full" => __( "Full Width",'diarjo-lite'),
				   "left-sidebar" => __( "Left Sidebar",'diarjo-lite'),
				   "right-sidebar" => __( "Right Sidebar",'diarjo-lite'),
				),
				
				"std" => "right-sidebar",
			
			),
	

			array(
				
				"label" => __("Category Layout",'diarjo-lite'),
				"description" => __("Select a layout for category pages.",'diarjo-lite'),
				"id" => "diarjolite_category_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
				   "full" => __( "Full Width",'diarjo-lite'),
				   "left-sidebar" => __( "Left Sidebar",'diarjo-lite'),
				   "right-sidebar" => __( "Right Sidebar",'diarjo-lite'),
				),
				
				"std" => "right-sidebar",
			
			),
	

			array(
				
				"label" => __("Search Layout",'diarjo-lite'),
				"description" => __("Select a layout for the search page.",'diarjo-lite'),
				"id" => "diarjolite_search_layout",
				"type" => "select",
				"section" => "layouts_section",
				"options" => array (
				   "full" => __( "Full Width",'diarjo-lite'),
				   "left-sidebar" => __( "Left Sidebar",'diarjo-lite'),
				   "right-sidebar" => __( "Right Sidebar",'diarjo-lite'),
				),
				
				"std" => "right-sidebar",
			
			),

			/* LOGIN AREA SECTION */ 

			array( 

				"title" => __( "Login Area",'diarjo-lite'),
				"type" => "section",
				"id" => "login_area_section",
				"panel" => "general_panel",
				"priority" => "17",

			),

			array( 

				"label" => __( "Custom Logo",'diarjo-lite'),
				"description" => __( "Upload your custom logo, for the admin area.( Max 320px as width )",'diarjo-lite'),
				"id" => "diarjolite_login_logo",
				"type" => "upload",
				"section" => "login_area_section",
				"std" => "",

			),


			array( 

				"label" => __( "Height",'diarjo-lite'),
				"description" => __( "Insert the height of your custom logo, without 'px' (for example 550 and not 550px).",'diarjo-lite'),
				"id" => "diarjolite_login_logo_height",
				"type" => "text",
				"section" => "login_area_section",
				"std" => "550",

			),

			/* HEADER AREA SECTION */ 

			array( 

				"title" => __( "Header",'diarjo-lite'),
				"type" => "section",
				"id" => "header_section",
				"panel" => "general_panel",
				"priority" => "18",

			),

			array( 

				"label" => __( "Custom Logo",'diarjo-lite'),
				"description" => __( "Upload your custom logo",'diarjo-lite'),
				"id" => "diarjolite_custom_logo",
				"type" => "upload",
				"section" => "header_section",
				"std" => "",

			),

			/* FOOTER AREA SECTION */ 

			array( 

				"title" => __( "Footer",'diarjo-lite'),
				"type" => "section",
				"id" => "footer_section",
				"panel" => "general_panel",
				"priority" => "19",

			),

			array( 

				"label" => __( "Copyright Text",'diarjo-lite'),
				"description" => __( "Insert your copyright text.",'diarjo-lite'),
				"id" => "diarjolite_copyright_text",
				"type" => "textarea",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Facebook Url",'diarjo-lite'),
				"description" => __( "Insert Facebook Url (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_facebook_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Twitter Url",'diarjo-lite'),
				"description" => __( "Insert Twitter Url (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_twitter_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Flickr Url",'diarjo-lite'),
				"description" => __( "Insert Flickr Url (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_flickr_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Google Url",'diarjo-lite'),
				"description" => __( "Insert Google Url (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_google_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Linkedin Url",'diarjo-lite'),
				"description" => __( "Insert Linkedin Url (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_linkedin_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Pinterest Url",'diarjo-lite'),
				"description" => __( "Insert Pinterest Url (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_pinterest_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Tumblr Url",'diarjo-lite'),
				"description" => __( "Insert Tumblr Url (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_tumblr_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Youtube Url",'diarjo-lite'),
				"description" => __( "Insert Youtube Url (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_youtube_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Skype Url",'diarjo-lite'),
				"description" => __( "Insert Skype ID (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_skype_button",
				"type" => "button",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Instagram Url",'diarjo-lite'),
				"description" => __( "Insert Instagram Url (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_instagram_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Github Url",'diarjo-lite'),
				"description" => __( "Insert Github Url (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_github_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Xing Url",'diarjo-lite'),
				"description" => __( "Insert Xing Url (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_xing_button",
				"type" => "url",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "WhatsApp number",'diarjo-lite'),
				"description" => __( "Insert WhatsApp number (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_whatsapp_button",
				"type" => "button",
				"section" => "footer_section",
				"std" => "",

			),

			array( 

				"label" => __( "Email Address",'diarjo-lite'),
				"description" => __( "Insert Email Address (empty if you want to hide the button)",'diarjo-lite'),
				"id" => "diarjolite_footer_email_button",
				"type" => "button",
				"section" => "footer_section",
				"std" => "",

			),

			array(
				
				"label" => __( "Feed Rss Button",'diarjo-lite'),
				"description" => __( "Do you want to display the Feed Rss button?",'diarjo-lite'),
				"id" => "diarjolite_footer_rss_button",
				"type" => "select",
				"section" => "footer_section",
				"options" => array (
				   "off" => __( "No",'diarjo-lite'),
				   "on" => __( "Yes",'diarjo-lite'),
				),
				
				"std" => "off",
			
			),

			/* TYPOGRAPHY SECTION */ 

			array( 
				
				"title" => __( "Typography",'diarjo-lite'),
				"description" => __( "Typography",'diarjo-lite'),
				"type" => "panel",
				"id" => "typography_panel",
				"priority" => "11",
				
			),

			/* LOGO */ 

			array( 

				"title" => __( "Logo",'diarjo-lite'),
				"type" => "section",
				"id" => "logo_section",
				"panel" => "typography_panel",
				"priority" => "10",

			),

			array( 

				"label" => __( "Font size",'diarjo-lite'),
				"description" => __( "Insert a size, for logo font (For example, 60px) ",'diarjo-lite'),
				"id" => "diarjolite_logo_font_size",
				"type" => "text",
				"section" => "logo_section",
				"std" => "60px",

			),

			/* MENU */ 

			array( 

				"title" => __( "Menu",'diarjo-lite'),
				"type" => "section",
				"id" => "menu_section",
				"panel" => "typography_panel",
				"priority" => "11",

			),

			array( 

				"label" => __( "Font size",'diarjo-lite'),
				"description" => __( "Insert a size, for menu font (For example, 14px) ",'diarjo-lite'),
				"id" => "diarjolite_menu_font_size",
				"type" => "text",
				"section" => "menu_section",
				"std" => "14px",

			),

			/* CONTENT */ 

			array( 

				"title" => __( "Content",'diarjo-lite'),
				"type" => "section",
				"id" => "content_section",
				"panel" => "typography_panel",
				"priority" => "12",

			),

			array( 

				"label" => __( "Font size",'diarjo-lite'),
				"description" => __( "Insert a size, for content font (For example, 14px) ",'diarjo-lite'),
				"id" => "diarjolite_content_font_size",
				"type" => "text",
				"section" => "content_section",
				"std" => "14px",

			),


			/* HEADLINES */ 

			array( 

				"title" => __( "Headlines",'diarjo-lite'),
				"type" => "section",
				"id" => "headlines_section",
				"panel" => "typography_panel",
				"priority" => "13",

			),

			array( 

				"label" => __( "H1 headline",'diarjo-lite'),
				"description" => __( "Insert a size, for for H1 elements (For example, 24px) ",'diarjo-lite'),
				"id" => "diarjolite_h1_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "24px",

			),

			array( 

				"label" => __( "H2 headline",'diarjo-lite'),
				"description" => __( "Insert a size, for for H2 elements (For example, 22px) ",'diarjo-lite'),
				"id" => "diarjolite_h2_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "22px",

			),

			array( 

				"label" => __( "H3 headline",'diarjo-lite'),
				"description" => __( "Insert a size, for for H3 elements (For example, 20px) ",'diarjo-lite'),
				"id" => "diarjolite_h3_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "20px",

			),

			array( 

				"label" => __( "H4 headline",'diarjo-lite'),
				"description" => __( "Insert a size, for for H4 elements (For example, 18px) ",'diarjo-lite'),
				"id" => "diarjolite_h4_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "18px",

			),

			array( 

				"label" => __( "H5 headline",'diarjo-lite'),
				"description" => __( "Insert a size, for for H5 elements (For example, 16px) ",'diarjo-lite'),
				"id" => "diarjolite_h5_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "16px",

			),

			array( 

				"label" => __( "H6 headline",'diarjo-lite'),
				"description" => __( "Insert a size, for for H6 elements (For example, 14px) ",'diarjo-lite'),
				"id" => "diarjolite_h6_font_size",
				"type" => "text",
				"section" => "headlines_section",
				"std" => "14px",

			),
		);
		
		new diarjolite_customize($theme_panel);
		
	} 
	
	add_action( 'diarjolite_customize_panel', 'diarjolite_customize_panel_function', 10, 2 );

}

do_action('diarjolite_customize_panel');

?>