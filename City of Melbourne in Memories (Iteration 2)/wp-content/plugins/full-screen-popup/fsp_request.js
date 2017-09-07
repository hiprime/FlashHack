jQuery(document).ready(function($) {
	
	var xyz_fsp_shortcode=0;
	
	if(jQuery("#xyz_fsp_shortcode").length>0)
	{	
		 xyz_fsp_shortcode=1;
		
	}   
		
	var data = {
		action: 'xyz_fsp_action',
		xyz_fsp_shortcd:xyz_fsp_shortcode,
		xyz_fsp_pg:xyz_fsp_ajax_object.ispage,
		xyz_fsp_ps:xyz_fsp_ajax_object.ispost,
		xyz_fsp_hm:xyz_fsp_ajax_object.ishome
	};
	// Pass the url value separately from ajaxurl for front end AJAX implementations
	jQuery.post(xyz_fsp_ajax_object.ajax_url, data, function(response) {
		if(xyz_fsp_shortcode==1)
		{
			if(response!=0)
			    jQuery("#xyz_fsp_shortcode").append(response);
		}	
		else
		{
			if(response!=0)
		        jQuery("#xyz_fsp_container").append(response);
		}
	});
});