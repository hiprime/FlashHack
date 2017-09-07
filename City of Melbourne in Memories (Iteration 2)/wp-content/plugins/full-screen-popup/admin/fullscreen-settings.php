<?php
if ( ! defined( 'ABSPATH' ) ) exit;
	// Load the options
$xyz_tinymce=get_option('xyz_fsp_tinymce');
if($xyz_tinymce==1)
{
	require( dirname( __FILE__ ) . '/tinymce_filters.php' );
}
	if (isset($_POST['xyz_fsp_html']))
	{
		if (
				! isset( $_REQUEST['_wpnonce'] )
				|| ! wp_verify_nonce( $_REQUEST['_wpnonce'],'add-setting' )
		) {
			wp_nonce_ays( 'add-setting');
			exit;
		
		}
		$_POST=stripslashes_deep($_POST);
		$xyz_fsp_iframe=intval($_POST['xyz_fsp_iframe']);
		$xyz_fsp_repeat_interval_timing=intval($_POST['xyz_fsp_repeat_interval_timing']);
		$xyz_fsp_html=stripslashes($_POST['xyz_fsp_html']);
	
		$xyz_fsp_showing_option="0,0,0";
		
		
		$xyz_fsp_delay=abs(intval($_POST['xyz_fsp_delay']));
		$xyz_fsp_page_count=abs(intval($_POST['xyz_fsp_page_count']));
		$xyz_fsp_repeat_interval=abs(intval($_POST['xyz_fsp_repeat_interval']));
		$xyz_fsp_mode=sanitize_text_field($_POST['xyz_fsp_mode']); //display logic
		$xyz_fsp_z_index=intval($_POST['xyz_fsp_z_index']);
		
	
		
		$xyz_fsp_bg_color=sanitize_text_field($_POST['xyz_fsp_bg_color']);		
		$xyz_fsp_corner_radius=abs(intval($_POST['xyz_fsp_corner_radius']));
		
		$xyz_fsp_border_color=sanitize_text_field($_POST['xyz_fsp_border_color']);
		$xyz_fsp_border_width=intval($_POST['xyz_fsp_border_width']);
		$xyz_fsp_page_option=intval($_POST['xyz_fsp_page_option']);
		
		
		
		
		if($xyz_fsp_page_option==2)
		{
			$fsp_pgf=0;
			$fsp_pof=0;
			$fsp_hp=0;
			if(isset($_POST['xyz_fsp_pages']))
				$fsp_pgf=1;
			if(isset($_POST['xyz_fsp_posts']))
				$fsp_pof=1;
			if(isset($_POST['xyz_fsp_hp']))
				$fsp_hp=1;
		
			$xyz_fsp_showing_option=$fsp_pgf.",".$fsp_pof.",".$fsp_hp;
		
			update_option('xyz_fsp_showing_option',$xyz_fsp_showing_option);
		
		}
		
$old_page_count=get_option('xyz_fsp_page_count');
$old_repeat_interval=get_option('xyz_fsp_repeat_interval');
if(isset($_POST['xyz_fsp_cookie_resett']))
{
?>	
	<script language="javascript">

 var cookie_date = new Date ( );  // current date & time
 cookie_date.setTime ( cookie_date.getTime() - 1 );

  document.cookie = "_xyz_fsp_pc=; expires=" + cookie_date.toGMTString()+ ";path=/";
  document.cookie = "_xyz_fsp_until=; expires=" + cookie_date.toGMTString()+ ";path=/";


</script>
	
	
<?php 	
}
	
		update_option('xyz_fsp_html',$xyz_fsp_html);
		
		update_option('xyz_fsp_delay',$xyz_fsp_delay);
		update_option('xyz_fsp_page_count',$xyz_fsp_page_count);
		update_option('xyz_fsp_repeat_interval',$xyz_fsp_repeat_interval);
		update_option('xyz_fsp_repeat_interval_timing',$xyz_fsp_repeat_interval_timing);
		update_option('xyz_fsp_mode',$xyz_fsp_mode);
		update_option('xyz_fsp_z_index',$xyz_fsp_z_index);
		
		//update_option('xyz_fsp_color',$xyz_fsp_color);
		update_option('xyz_fsp_corner_radius',$xyz_fsp_corner_radius);
		
		update_option('xyz_fsp_border_color',$xyz_fsp_border_color);
		update_option('xyz_fsp_border_width',$xyz_fsp_border_width);
		update_option('xyz_fsp_bg_color',$xyz_fsp_bg_color);
		update_option('xyz_fsp_page_option',$xyz_fsp_page_option);
	
		update_option('xyz_fsp_iframe',$xyz_fsp_iframe);
	
	
		
		
		?><br>
		
<div  class="system_notice_area_style1" id="system_notice_area">Settings updated successfully.<span id="system_notice_area_dismiss">Dismiss</span></div>
<?php
}


?>
<style type="text/css">
label{
cursor:default;


}
</style>
<script type="text/javascript">
 
  jQuery(document).ready(function() {
    
    jQuery('#fspbordercolorpicker').hide();
    jQuery('#fspbordercolorpicker').farbtastic("#xyz_fsp_border_color");
    jQuery("#xyz_fsp_border_color").click(function(){jQuery('#fspbordercolorpicker').slideToggle();});
    
    jQuery('#fspbgcolorpicker').hide();
    jQuery('#fspbgcolorpicker').farbtastic("#xyz_fsp_bg_color");
    jQuery("#xyz_fsp_bg_color").click(function(){jQuery('#fspbgcolorpicker').slideToggle();});
  
    
  });
  function bgchange()
  {
	  var v;
v=document.getElementById('xyz_fsp_page_option').value;
if(v==1)
{
	document.getElementById('automatic').style.display='block';
	document.getElementById('shopt').style.display='none';
	document.getElementById('shortcode').style.display='none';		
}
if(v==2)
{
	document.getElementById('shopt').style.display='block';
	document.getElementById('shortcode').style.display='none';
	document.getElementById('automatic').style.display='none';	
}
if(v==3)

{
	document.getElementById('shortcode').style.display='block';	
	document.getElementById('shopt').style.display='none';
	document.getElementById('automatic').style.display='none';
}
  }
  function cdcheck()
  {

	 var display_mech;
	 display_mech=document.getElementById('xyz_fsp_mode').value;
	 if(display_mech=="delay_only")
	 {
		 
		 document.getElementById('xyz_fsp_delaysec').style.display='';
		 document.getElementById('xyz_fsp_pages').style.display='none';
	 }
	 if(display_mech=="page_count_only")
	 {
		 
		 document.getElementById('xyz_fsp_delaysec').style.display='none';
		 document.getElementById('xyz_fsp_pages').style.display='';
	 }
	 if(display_mech=="both")
	 {
		 
		 document.getElementById('xyz_fsp_delaysec').style.display='';
		 document.getElementById('xyz_fsp_pages').style.display='';
	 }


  }

  
</script>
<div >
<?php 


$xyz_fsp_cookie_resett=get_option('xyz_fsp_cookie_resett');
$xyz_fsp_iframe=get_option('xyz_fsp_iframe');


?>
<h2>Full Screen Popup  Settings</h2>
<form method="post" >
<?php wp_nonce_field( 'add-setting' );?>
<?php 
$xyz_fsp_showing_option=get_option('xyz_fsp_showing_option');
$xyz_fsp_sh_arr=explode(",", $xyz_fsp_showing_option);
?>
<table  class="widefat" style="width:98%">

<tr valign="top" >
<td  scope="row" style="width: 50%" ><h3>Content</h3></td>
<td></td>
</tr>
<tr valign="top" >
<td colspan="2" >

<?php wp_editor(get_option('xyz_fsp_html'),'xyz_fsp_html');?></td>
</tr>



<?php
$xyz_fsp_mode=get_option('xyz_fsp_mode');
$xyz_fsp_page_option=get_option('xyz_fsp_page_option');
$xyz_fsp_repeat_interval_timing=get_option('xyz_fsp_repeat_interval_timing');
?>
<tr valign="top"><td scope="row" colspan="2"><h3> Display Logic Settings</h3></td></tr>
<tr valign="top">
<td scope="row"><label for="xyz_fsp_mode"> Display logic </label></td>
<td><select  name="xyz_fsp_mode"   id="xyz_fsp_mode"  onchange="cdcheck()">
<option value ="delay_only" <?php if($xyz_fsp_mode=='delay_only') echo 'selected'; ?>>Based on delay </option>
<option value ="page_count_only" <?php if($xyz_fsp_mode=='page_count_only') echo 'selected'; ?>>Based on  number of pages browsed </option>
<option value ="both" <?php if($xyz_fsp_mode=='both') echo 'selected'; ?>>Based on both </option>
</select></td>
</tr>
<tr valign="top" id="xyz_fsp_delaysec">
<td scope="row"><label for="xyz_fsp_delay"> Delay in seconds before  popup appears </label></td>
<td><input name="xyz_fsp_delay" type="text" id="xyz_fsp_delay"  value="<?php print(get_option('xyz_fsp_delay')); ?>" size="40" /> sec</td>
</tr>

<tr valign="top" id="xyz_fsp_pages">
<td scope="row"><label for="xyz_fsp_page_count">Number of pages to browse before  popup appears</label></td>
<td><input name="xyz_fsp_page_count" type="text" id="xyz_fsp_page_count"  value="<?php print(get_option('xyz_fsp_page_count')); ?>" size="40" /> pages</td>
</tr>
<tr valign="top">
<td scope="row"><label for="xyz_fsp_repeat_interval"> Repeat interval for a user </label></td>
<td ><input name="xyz_fsp_repeat_interval" type="text" id="xyz_fsp_repeat_interval"  value="<?php print(get_option('xyz_fsp_repeat_interval')); ?>" size="40" /> 

<select name="xyz_fsp_repeat_interval_timing" id="xyz_fsp_repeat_interval_timing" >
<option value ="1" <?php if($xyz_fsp_repeat_interval_timing=='1') echo 'selected'; ?> >Hrs </option>

<option value ="2" <?php if($xyz_fsp_repeat_interval_timing=='2') echo 'selected'; ?> >Minutes </option>
</select>
</td>

</tr>

				
<tr valign="top">

<td scope="row" colspan="1"><label for="xyz_fsp_iframe">Display as iframe </label></td><td>


<select name="xyz_fsp_iframe" id="xyz_fsp_iframe"  >

<option value ="1" <?php if($xyz_fsp_iframe=='1') echo 'selected'; ?> >Yes </option>

<option value ="0" <?php if($xyz_fsp_iframe=='0') echo 'selected'; ?> >No </option>
</select>
</td>

</tr>


		

<tr valign="top"><td scope="row" colspan="2"><h3> Style Settings</h3></td></tr>
<tr valign="top">
<td scope="row"><label for="xyz_fsp_z_index"> Z index</label></td>
<td><input name="xyz_fsp_z_index" type="text" id="xyz_fsp_z_index"  value="<?php print(get_option('xyz_fsp_z_index')); ?>" size="40" /> </td>
</tr>


<tr valign="top" >
<td scope="row"><label for="xyz_fsp_bg_color"> Background color</label></td>
<td><input name="xyz_fsp_bg_color" type="text" id="xyz_fsp_bg_color"  value="<?php print(get_option('xyz_fsp_bg_color')); ?>" size="40" /> <div id="fspbgcolorpicker"></div> </td>
</tr>
<tr valign="top">
<td scope="row"><label for="xyz_fsp_border_color"> Border color</label></td>
<td><input name="xyz_fsp_border_color" type="text" id="xyz_fsp_border_color"  value="<?php print(get_option('xyz_fsp_border_color')); ?>" size="40" /> <div id="fspbordercolorpicker"></div> </td>
</tr>
<tr valign="top">
<td scope="row"><label for="xyz_fsp_border_width"> Border  width </label></td>
<td><input name="xyz_fsp_border_width" type="text" id="xyz_fsp_border_width"  value="<?php print(get_option('xyz_fsp_border_width')); ?>" size="40" /> px </td>
</tr>
<tr valign="top" id="xyz_fsp_rad">
<td scope="row"><label for="xyz_fsp_corner_radius">  Border  radius </label></td>
<td><input name="xyz_fsp_corner_radius" type="text" id="xyz_fsp_corner_radius"  value="<?php print(get_option('xyz_fsp_corner_radius')); ?>" size="40" /> px </td>
</tr>

<tr valign="top"><td scope="row" colspan="2"><h3> Placement Settings</h3></td></tr>


<tr valign="top" id="pgopt" ><td scope="row"><label for="xyz_fsp_page_option"> Placement mechanism </label></td>
<td>
<select name="xyz_fsp_page_option" id="xyz_fsp_page_option" onchange="bgchange()">
<option value ="1" <?php if($xyz_fsp_page_option=='1') echo 'selected'; ?> >Automatic </option>
<option value ="2" <?php if($xyz_fsp_page_option=='2') echo 'selected'; ?> >Specific Pages</option>
<option value ="3" <?php if($xyz_fsp_page_option=='3') echo 'selected'; ?> >Manual </option>
</select></td></tr>



<tr valign="top" ><td scope="row" ></td><td>
<span  id="automatic" >Popup will load in all pages</span>
<span  id="shopt" >
<input name="xyz_fsp_pages" value="<?php echo $xyz_fsp_sh_arr[0];?>"<?php if($xyz_fsp_sh_arr[0]==1){?> checked="checked"<?php } ?> type="checkbox"> On Pages 
<input name="xyz_fsp_posts" value="<?php echo $xyz_fsp_sh_arr[1];?>"<?php if($xyz_fsp_sh_arr[1]==1){?> checked="checked"<?php }?>  type="checkbox"> On Posts
<input name="xyz_fsp_hp" value="<?php echo $xyz_fsp_sh_arr[2];?>"<?php if($xyz_fsp_sh_arr[2]==1){?> checked="checked"<?php }?>  type="checkbox"> On Home page 
</span>
<span  id="shortcode" >Use this short code in your pages - [xyz_fsp_default_code]</span>
</td>
</tr>





<!--  <tr valign="top" id="automatic"  style="display: none"><td scope="row" ></td><td >( Popup will load in all pages)</td>

</tr>

<tr valign="top" id="shortcode"  style="display: none"><td scope="row"></td><td>Use this short code in your pages - [xyz_fsp_default_code]</td>
</tr>-->


<tr valign="top">
<td scope="row"><label for="xyz_lcookie_resett"><h3>Reset cookies ? </h3>
 </label></td>
<td><input name="xyz_fsp_cookie_resett" type="checkbox" id="xyz_fsp_cookie_resett"   <?php  echo 'checked'; ?> /> 
(This is just for your testing purpose. If you want to see a  popup  immediately after you make changes in any settings, you have to reset the cookies.)
 </td>
</tr>
<tr>
<td scope="row"> </td>
<td><br>
<input type="submit" value=" Update Settings " /></td>
</tr>

</table>


</form>

</div>

<script type="text/javascript">
bgchange();
cdcheck();

</script>
