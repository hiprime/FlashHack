<?php

function ctl_google_fonts(){
        
            $ctl_options_arr = get_option('cool_timeline_options');
            $post_content_face = $ctl_options_arr['post_content_typo']['face'];
            $post_title = $ctl_options_arr['post_title_typo']['face'];
            $main_title = $ctl_options_arr['main_title_typo']['face'];
            $date_typo =isset($ctl_options_arr['ctl_date_typo']['face']);
            $selected_fonts = array($post_content_face, $post_title, $main_title,$date_typo);

            /*
            * google fonts
            */
            // Remove any duplicates in the list
            $selected_fonts = array_unique($selected_fonts);
            // If it is a Google font, go ahead and call the function to enqueue it
            $gfont_arr=array();

        if(is_array($selected_fonts)){
          foreach ($selected_fonts as $font) {
                if ($font && $font != 'inherit') {
                    if ($font == 'Raleway')
                        $font = 'Raleway:100';
                    $font = str_replace(" ", "+", $font);
                     $gfont_arr[]=$font;
                }
            }
           if(is_array($gfont_arr)&& !empty($gfont_arr)){
             $allfonts=implode("|",$gfont_arr);   
           wp_register_style("ctl_gfonts", "https://fonts.googleapis.com/css?family=$allfonts", false, null, 'all');
            }
          }
            wp_register_style("ctl_default_fonts", "https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800", false, null, 'all');

}
    
function ctl_common_assets(){

    wp_register_script('ctl_prettyPhoto', CTP_PLUGIN_URL . 'js/jquery.prettyPhoto.js', array('jquery'), null, true);
            wp_register_script('ctl_scripts', CTP_PLUGIN_URL . 'js/ctl_scripts.js', array('jquery'), null, true);
            wp_register_script('ctl_jquery_flexslider', CTP_PLUGIN_URL . 'js/jquery.flexslider-min.js', array('jquery'), null, true);
            wp_register_script('section-scroll-js', CTP_PLUGIN_URL . 'js/jquery.section-scroll.js', array('jquery'), null, true);
           
            wp_register_style('ctl_pp_css', CTP_PLUGIN_URL . 'css/prettyPhoto.css', null, null, 'all');
           
           wp_register_style('ctl_styles', CTP_PLUGIN_URL . 'css/ctl_styles.css', null, null, 'all');
           
            wp_register_style('section-scroll', CTP_PLUGIN_URL . 'css/section-scroll.css', null, null, 'all');
            wp_register_style('ctl_flexslider_style', CTP_PLUGIN_URL . 'css/flexslider.css', null, null, 'all');

            wp_register_style('ctl_animate', CTP_PLUGIN_URL . 'css/animate.min.css', null, null, 'all');
            wp_register_script('ctl_viewportchecker', CTP_PLUGIN_URL . 'js/jquery.viewportchecker.js', array('jquery'), null, true);

          wp_register_script('c_masonry', CTP_PLUGIN_URL . 'js/masonry.pkgd.min.js', array('jquery'), null, true);
            /*
             * Horizontal timeline
             */

            wp_register_script('ctl_horizontal_scripts', CTP_PLUGIN_URL . 'js/ctl_horizontal_scripts.js', array('jquery'), null, true);
            wp_register_script('ctl-slick-js','https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js', array('jquery'), null, true);
            wp_register_style('ctl-styles-horizontal', CTP_PLUGIN_URL . 'css/ctl-styles-horizontal.css', null, null, 'all');
            wp_register_style('ctl-styles-slick', CTP_PLUGIN_URL . 'css/slick.css', null, null, 'all');


             wp_register_style('ctl-compact-tm', CTP_PLUGIN_URL . 'css/ctl-compact-tm.css',array('ctl_styles'), null, 'all');

            ctl_google_fonts();
}
    /*
        Date format settings for stories
     */

function ctl_date_formats($date_format,$ctl_options_arr){
    if(!empty($date_format)){
              if($date_format=="default"){
                  $date_formats = $ctl_options_arr['ctl_date_formats'] ? $ctl_options_arr['ctl_date_formats'] : "M d";
                }else if($date_format=="custom"){
                 
                 if ($ctl_options_arr['custom_date_style']=="yes" && !empty($ctl_options_arr['custom_date_formats'])) {
                        $date_formats =$ctl_options_arr['custom_date_formats'];
                    }else{
                       $date_formats = "M d";
                    }
                }
                else{
                     $df=$date_format;
                     $date_formats =__("$df",'cool_timeline');     
                     }  
            }else{
            $defaut_df = $ctl_options_arr['ctl_date_formats'] ? $ctl_options_arr['ctl_date_formats'] : "M d";
            $date_formats =__("$defaut_df",'cool_timeline'); 
            }
            return $date_formats;
}
    
   // getting story date 
function ctl_get_story_date($post_id,$date_formats) {

    $ctl_story_date = get_post_meta($post_id, 'ctl_story_date', true);

    if ($ctl_story_date) {

        if (preg_match("/\d{4}/", $ctl_story_date,$match)) {

            $year = intval($match[0]); //converting the year to integer
            if ($year >= 1970) {

                $posted_date = date_i18n(__("$date_formats", 'cool-timeline'), strtotime("$ctl_story_date"));

            } else {

                $date = date_create($ctl_story_date);

                if (!$date) {
                   $e = date_get_last_errors();
                 foreach ($e['errors'] as $error) {
                        return "$error\n";
                     }
                  exit(1);
                }
         $posted_date = date_format($date, __("$date_formats", 'cool-timeline'));

            }

        }
   
      return  $posted_date;
       }
}

function ctl_pagination($numpages = '', $pagerange = '', $paged='') {
 if (empty($pagerange)) {
    $pagerange = 2;
    }

 if ( get_query_var('paged') ) { 
            $paged = get_query_var('paged'); 
            } elseif ( get_query_var('page') ) { 
            $paged = get_query_var('page'); 
            } else { 
            $paged = 1; 
            }
     if ($numpages == '') {

        global $wp_query;

        $numpages = $wp_query->max_num_pages;

        if(!$numpages) {
             $numpages = 1;
            }
        }

     $big = 999999999; 
     $of_lbl = __( ' of ', 'cool-timeline' ); 
    $page_lbl = __( ' Page ', 'cool-timeline' ); 
 $pagination_args = array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
     'format' => '?paged=%#%',
    'total'           => $numpages,
     'current'         => $paged,
     'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
     'add_args'        => false,
    'add_fragment'    => '' );
 $paginate_links = paginate_links($pagination_args);
 $ctl_pagi='';
    if ($paginate_links) {
        $ctl_pagi .= "<nav class='custom-pagination'>";
     $ctl_pagi .= "<span class='page-numbers page-num'> ".$page_lbl . $paged . $of_lbl . $numpages . "</span> ";
        $ctl_pagi .= $paginate_links;
         $ctl_pagi .= "</nav>";
        return $ctl_pagi;
 }

}


function ctl_get_ctp() {
    global $post, $typenow, $current_screen;
 if ( $post && $post->post_type )
        return $post->post_type;
  elseif( $typenow )
        return $typenow;
 elseif( $current_screen && $current_screen->post_type )
        return $current_screen->post_type;
 elseif( isset( $_REQUEST['post_type'] ) )
        return sanitize_key( $_REQUEST['post_type'] );
  return null;
}


if ( ! function_exists( 'ctl_entry_taxonomies' ) ) :
  
    function ctl_entry_taxonomies() {
        $categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'cool-timeline' ) );
        $cat_meta='';
        if ( $categories_list) {
            $cat_meta .= sprintf( '<i class="fa fa-folder-open" aria-hidden="true"></i><span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                _x( 'Categories', 'Used before category names.', 'cool-timeline' ),
                $categories_list
            );
        }
        return $cat_meta;
    }
endif;

function ctl_post_tags() {
    $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'cool-timeline' ) );
    if ( $tags_list ) {
        return sprintf( '<span class="tags-links"><i class="fa fa-bookmark"></i><span class="screen-reader-text">%1$s </span>%2$s</span>',
            _x( 'Tags', 'Used before tag names.', 'cool-timeline' ),
            $tags_list
        );
    }
}


function clt_story_video($post_id){
  $ctl_video = get_post_meta($post_id, 'ctl_video', true);
  if ($ctl_video) {
      preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $ctl_video, $matches);
     $id = $matches[1];
      
      if ($id) {
        return '<div class="full-width"><iframe width="100%" height="100%" src="https://www.youtube.com/embed/' . $id . '" frameborder="0" allowfullscreen></iframe></div>';
         }  
     } 
}

function clt_story_slideshow($post_id,$timeline_type,$ctl_options_arr){

      $img_ids_arr= get_post_meta($post_id, 're_', false);
      $ctl_slides = array();
      $slides_html='';$story_slides='';
    $stories_images_link = $ctl_options_arr['stories_images'];
     $slider_animation = $ctl_options_arr['slider_animation'] ? $ctl_options_arr['slider_animation'] : "slide";
     $ctl_slideshow = $ctl_options_arr['ctl_slideshow'] ? $ctl_options_arr['ctl_slideshow'] : true;
    $animation_speed = isset($ctl_options_arr['animation_speed']) ? $ctl_options_arr['animation_speed'] : 7000;


      if ($img_ids_arr && is_array($img_ids_arr[0])) {
         foreach ($img_ids_arr[0] as $key => $value) {
                $ctl_slides[] = $value['ctl_slide']['id'];
           }
       }

        if (array_filter($ctl_slides)) {
        foreach ($ctl_slides as $key => $att_index) {

           if($timeline_type=="horizontal"){
             $slides = wp_get_attachment_image_src($att_index, 'medium');
             $s_img_cls='gallery_images';
             }else{
            $slides = wp_get_attachment_image_src($att_index, 'large');
             $s_img_cls='';
             }      
            if ($slides[0]) {
                if($stories_images_link == "popup") {
                      $story_slides .= '<li><a  class="ctl_prettyPhoto" rel="ctl_prettyPhoto[pp_gallery-'.$post_id.']" href="'.$slides[0].'"><img class="'.$s_img_cls.'" src="' . $slides[0] . '"></a></li>';
                  }else{
                    $story_slides .= '<li><img class="'.$s_img_cls.'" src="' . $slides[0]. '"></li>';
                     }
            }
          }   
       }   
       if($timeline_type=="horizontal"){
         $slides_html .= '<div class="clt_gallery"><ul class="story-gallery">';
         $slides_html .= $story_slides . '</ul><div style="clear:both"></div></div>';
       }else{
         $slides_html .= '<div class="full-width  ctl_slideshow">';
         $slides_html .= '<div data-animationSpeed="' . $animation_speed . '"  data-slideshow="' . $ctl_slideshow . '" data-animation="' . $slider_animation . '" class="ctl_flexslider"><ul class="slides">';
         $slides_html .= $story_slides . '</ul></div></div>';
              
       }    
       return  $slides_html;
}


function clt_story_featured_img($post_id,$ctl_options_arr){
 
  $custom_link = get_post_meta($post_id, 'story_custom_link', true);
  $img_cont_size = get_post_meta($post_id, 'img_cont_size', true);
 $img_html='';
 $stories_images_link = $ctl_options_arr['stories_images'];

$imgAlt = get_post_meta(get_post_thumbnail_id($post_id),'_wp_attachment_image_alt', true); 

$alt_text=$imgAlt?$imgAlt:get_the_title($post_id);

  if ($stories_images_link =="popup") {
      $img_f_url = wp_get_attachment_url(get_post_thumbnail_id($post_id));
      $story_img_link = '<a title="' . esc_attr(get_the_title($post_id)). '"  href="' . $img_f_url . '" class="ctl_prettyPhoto">';
      

    } else if ($stories_images_link == "single") {

         if(isset($custom_link)&& !empty($custom_link)){
           $story_img_link = '<a target="_blank" title="' . esc_attr(get_the_title($post_id)) . '"  href="' . $custom_link. '" class="single-page-link">';
            
          }else{
            $story_img_link = '<a title="' . esc_attr(get_the_title($post_id)) . '"  href="' . get_the_permalink($post_id) . '" class="single-page-link">';
         
         }
    } else if ($stories_images_link == "disable_links") {
         $story_img_link = '';
         $s_l_close='';
     }else {
            $s_l_close='';
             $story_img_link = '<a title="' . esc_attr(get_the_title($post_id)) . '"  href="' . get_the_permalink($post_id) . '" class="">';
          }

    if ($img_cont_size == "small") {
    
        if ( has_post_thumbnail($post_id) ) {
         $img_html .= '<div class="pull-left">';
        $img_html.=$story_img_link;
        $img_html.=get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'story-img left_small','alt'=>$alt_text) );
         $img_html.='</a></div>';
         }
         
     
     } else {
         if ( has_post_thumbnail($post_id) ) {
        $img_html .= '<div class="full-width">';
        $img_html.=$story_img_link;
        $img_html.=get_the_post_thumbnail( $post_id, 'large', array( 'class' => 'story-img','alt'=>$alt_text) );
         $img_html.='</a></div>';
         }
      
     }      
     
      return  $img_html;
}


function ctl_post_icon($post_id,$default_icon){

    if ( get_post_type($post_id) == 'cool_timeline' ) {
        $use_img_icon = get_post_meta($post_id, 'use_img_icon', true);
        if(isset($use_img_icon)&& $use_img_icon=="on"){
              $story_img_icon = get_post_meta($post_id, 'story_img_icon', true);    
              if(is_array($story_img_icon)&& isset($story_img_icon['id'])){
            return wp_get_attachment_image($story_img_icon['id'],'thumbnail',true, array( "class" => "ctl-icon-img" ) ); 
              }
        }
    }

     if(function_exists('get_fa')){
        $post_icon=get_fa(true);
        }
     if(isset($post_icon)){
            $icon=$post_icon;
        }else{
            if(isset($default_icon)&& !empty($default_icon)){
                $icon='<i class="fa '.$default_icon.'" aria-hidden="true"></i>';
            }else {
                $icon = '<i class="fa fa-clock-o" aria-hidden="true"></i>';
            }
        }
     return $icon;   
}


function ctl_main_title($ctl_options_arr, $ctl_title_text,$ttype){
    $main_title_html='';
    $ctl_title_tag = $ctl_options_arr['title_tag'] ? $ctl_options_arr['title_tag'] : 'H2';
     $title_visibilty =isset($ctl_options_arr['display_title']) ? $ctl_options_arr['display_title'] : "yes";
     if($ttype=="default_timeline"){
     if (isset($ctl_options_arr['user_avatar']['id'])) {
                    $user_avatar = wp_get_attachment_image_src($ctl_options_arr['user_avatar']['id'], 'ctl_avatar');
             if (isset($user_avatar[0]) && !empty($user_avatar[0])) {
                        $main_title_html.= '<div class="avatar_container row"><span title="' . $ctl_title_text . '"><img  class=" center-block img-responsive img-circle" alt="' . $ctl_title_text . '" src="' . $user_avatar[0] . '"></span></div> ';
                         }   
      }   
      } 
     if ($title_visibilty == "yes") {
                    $main_title_html.= sprintf(__('<%s class="timeline-main-title center-block">%s</%s>', 'cool-timeline'), $ctl_title_tag, $ctl_title_text, $ctl_title_tag);
                }                  
    return $main_title_html;
}

