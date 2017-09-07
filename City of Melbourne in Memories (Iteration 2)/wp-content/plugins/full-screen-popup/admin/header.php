<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
if($_POST && isset($_POST['xyz_credit_link']))
{
	if (
			! isset( $_REQUEST['_wpnonce'] )
			|| ! wp_verify_nonce( $_REQUEST['_wpnonce'],'add-basic-setting' )
	) {
		wp_nonce_ays( 'add-basic-setting');
		exit;
	
	}
	$xyz_fsp_tinymce=$_POST['xyz_fsp_tinymce'];
	$xyz_credit_link=$_POST['xyz_credit_link'];
    $xyz_fsp_enable=$_POST['xyz_fsp_enable'];
    $xyz_fsp_adds_enable=$_POST['xyz_fsp_adds_enable'];
    $xyz_fsp_cache_enable=$_POST['xyz_fsp_cache_enable'];
       
	update_option('xyz_fsp_tinymce', $xyz_fsp_tinymce);
	update_option('xyz_credit_link', $xyz_credit_link);
    update_option('xyz_fsp_enable',$xyz_fsp_enable);
    update_option('xyz_fsp_adds_enable',$xyz_fsp_adds_enable);
    update_option('xyz_fsp_cache_enable',$xyz_fsp_cache_enable);
	?>
<div class="system_notice_area_style1" id="system_notice_area">
	Settings updated successfully. &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
</div>
	<?php 
}?>

<div style="width: 98%">
<?php 
$xyz_fsp_adds_enable=get_option('xyz_fsp_adds_enable');
if($xyz_fsp_adds_enable==1)
{
?>
<div id="xyz-wp-popup-premium">

<div style="float: left;padding: 0 5px">
<h2 style="vertical-align: middle;"><a target="_blank" href="http://xyzscripts.com/wordpress-plugins/xyz-wp-popup/features">Fully Featured XYZ WP Popup Premium Plugin</a> 
- Just 39 USD 
</h2>
</div>

<div style="float: left;padding: 5px">
<a target="_blank" href="http://xyzscripts.com/members/product/purchase/XYZWPPOP"><img src="<?php  echo plugins_url("full-screen-popup/images/orange_buynow.png"); ?>"></a>
</div>

<div style="float: left; padding: 0 5px">
	<h2 style="vertical-align: middle;text-shadow: 1px 1px 1px #686868">
			( <a href="<?php echo admin_url('admin.php?page=full-screen-popup-about');?>">Compare Features</a> ) 
	</h2>		
	</div>

 </div>
  <?php 
}
?>
    <div style="clear:both"></div>

<?php 

if(get_option('xyz_credit_link')=="0"){
	?>
<div style="float:left;background-color: #FFECB3;border-radius:5px;padding: 0px 5px;border: 1px solid #E0AB1B" id="xyz_backlink_div">
	
	Please do a favour by enabling backlink to our site. <a class="xyz_fsp_backlink" style="cursor: pointer;" >Okay, Enable</a>.
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('.xyz_fsp_backlink').click(function() {
var backlink_nonce= '<?php echo wp_create_nonce('backlink');?>';
			var dataString = { 
					action: 'ajax_backlink_fullscreen', 
				enable: 1,
					_wpnonce: backlink_nonce
				};
				jQuery.post(ajaxurl, dataString, function(response) {
					if(response==1)
						alert("You do not have sufficient permissions to do this");
					jQuery("#xyz_backlink_div").html('Thank you for enabling backlink !');
					jQuery("#xyz_backlink_div").css('background-color', '#D8E8DA');
					jQuery("#xyz_backlink_div").css('border', '1px solid #0F801C');
					jQuery("select[id=xyz_fsp_credit_link] option[value=fsp]").attr("selected", true);
					if(window.rcheck)
					{
						document.location.reload();
					}
				});	
			});
		

	});
</script>
</div>
	<?php 
}



?>

<style type="text/css">
    #xyz-wp-popup-premium
    {
    border: 1px solid #FCC328;
    margin-bottom: 20px;
    margin-top: 20px;
    background-color: #FFF6D6;
    height: 50px;
    padding: 5px;
    }
    

</style>

 
<div style="margin-top: 10px">
<table style="float:right; ">
<tr>
<td  style="float:right;">
	<a title="Please help us to keep this plugin free forever by donating a dollar"   class="xyz_fsp_link" style="margin-left:8px; font-size: 15px;"  target="_blank" href="http://xyzscripts.com/donate/1"><b>Donate</b></a>
</td>
<td style="float:right;">
	<a class="xyz_fsp_link" style="margin-left:8px; font-size: 15px;" target="_blank" href="http://help.xyzscripts.com/docs/full-screen-popup/faq/"><b>FAQ</b></a> |
</td>
<td style="float:right;">
	<a class="xyz_fsp_link" style="margin-left:8px; font-size: 15px;" target="_blank" href="http://help.xyzscripts.com/docs/full-screen-popup/"><b>Readme</b></a> |
</td>
<td style="float:right;">
	<a class="xyz_fsp_link" style="margin-left:8px; font-size: 15px;" target="_blank" href="https://xyzscripts.com/wordpress-plugins/full-screen-popup/details"><b>About</b></a> |
</td>
<td style="float:right;">
	<a class="xyz_fsp_link" style="font-size: 15px;" target="_blank" href="http://xyzscripts.com"><b>XYZScripts</b></a> |
</td>

</tr>
</table>
</div>

</div>

<div style="clear: both"></div>
