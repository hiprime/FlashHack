<?php

if (!class_exists('CoolTimeline_Shortcode')) {

    class CoolTimeline_Shortcode {

        /**
         * The Constructor
         */
        public $tmStyles="";
        public function __construct() {
            // register actions
            add_action('init', array($this, 'cooltimeline_register_shortcode'));
            add_action('wp_enqueue_scripts', array($this, 'ctl_load_scripts_styles'));
            $this->tmStyles=new Cooltimeline_Styles();

            // Call actions and filters in after_setup_theme hook
            add_action('after_setup_theme', array($this, 'ctl_pro_read_more'));
            add_filter('excerpt_length', array($this, 'ctl_ex_len'), 999);
            add_filter( 'body_class', array($this, 'ctl_body_class') );
        }
      
        /*
          Register Shortcode for cooltimeline 
         */
        function cooltimeline_register_shortcode() {
            add_shortcode('cool-timeline', array($this, 'cooltimeline_view'));

        }
        /*
          Timeline Views
         */
        function cooltimeline_view($atts, $content = null) {
            $design_cls='';
            $attribute = shortcode_atts(array(
                'show-posts' => '',
                'order' => '',
                'post-type'=>'',
                'category' => 0,
                'taxonomy'=>'',
                'post-category'=>'',
                'tags'=>'',
                'layout' => 'compact',
                'designs'=>'',
                'items'=>'',
                'skin' =>'',
                'type'=>'',
                'icons' =>'',
                'animations'=>'',
                'animation'=>'',
                'date-format'=>'',
                'based'=>'default',
                'story-content'=>'',
                //new
                'compact-ele-pos'=>'main-date'
               ), $atts);

         
            //  Enqueue common required assets
             wp_enqueue_style('ctl_gfonts');
             wp_enqueue_style('ctl_default_fonts');
             wp_enqueue_script('ctl_prettyPhoto');
             wp_enqueue_style('ctl_pp_css');
             wp_enqueue_style('ctl-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
            
             $layout=$attribute['layout'] ?$attribute['layout']:'default';
             require('common-query.php');
          
           if( $attribute['type'] &&  $attribute['type']=="horizontal"){
               
               // Enqueue required assets for horizontal timeline
                wp_enqueue_style('ctl-styles-horizontal');
                wp_enqueue_script('ctl-slick-js');
                wp_enqueue_script('ctl_horizontal_scripts');
                wp_enqueue_style('ctl-styles-slick');
                 $ctl_options_arr = get_option('cool_timeline_options');
              if($attribute['designs'])
              {
                  $design_cls='ht-'.$attribute['designs'];
                  $design=$attribute['designs'];
                  }else{
                 $design_cls='ht-default';
                  $design='default';
              }
               $r_more= $ctl_options_arr['display_readmore']?$ctl_options_arr['display_readmore']:"yes";
                $clt_hori_view='';
            
              require('views/horizontal-timeline.php');

                return $clt_hori_view;

            }else {
                   // Enqueue required assets for vertical timeline
                wp_enqueue_style('ctl_styles');
                wp_enqueue_style('ctl_flexslider_style');
                wp_enqueue_style('section-scroll');
                wp_enqueue_script('ctl_scripts');
                wp_enqueue_script('ctl_jquery_flexslider');
                wp_enqueue_script('section-scroll-js');
                wp_enqueue_script('ctl_viewportchecker');
                wp_enqueue_style('ctl_animate');

               // Enqueue required assets for compact timeline    
          if($attribute['layout'] == "compact"){
                  wp_dequeue_script( 'masonry' );
                  wp_enqueue_style('ctl-compact-tm');
             if (! wp_script_is('c_masonry','enqueued' )) { 
                  wp_enqueue_script('c_masonry');
                 wp_add_inline_script( 'c_masonry',"
                  ( function($) {
                  $(window).load(function(){ 
                 // masonry plugin call
              $('.compact-wrapper .clt-compact-cont').each(function(index){
               
               $(this).masonry({itemSelector : '.timeline-mansory'});
              });
         $('.compact-wrapper .clt-compact-cont').find('.timeline-mansory').each(function(index){
                var firstPos=$(this).position();
                if($(this).next('.timeline-post').length>0){
                    var secondPos=$(this).next().position();
                    var gap=secondPos.top-firstPos.top;
                     new_pos=secondPos.top+70;
                      if(gap<=35){
                    $(this).next().css({'top':new_pos+'px','margin-top':'0'});
                      }
                  }
             var leftPos=$(this).position();
               var id=$(this).attr('id');
                if(leftPos.left<=0){
                $(this).addClass('ctl-left');
                }else{
                  $(this).addClass('ctl-right');  
                }
             });
        $('.clt-compact-preloader').each(function(index){
            $(this).fadeOut('slow',function(){
            $(this).hide();});
              });
          });

        })(jQuery);
          ");
          }
        }

           if($attribute['designs'])
                {
                    $design_cls='main-'.$attribute['designs'];
                    $design=$attribute['designs'];
                   }else{
                    $design_cls='main-default';
                    $design='default';
                  }
                $output = '';
                $ctl_html = '';
                $ctl_format_html = '';
               

                $ctl_animation='';

                if (isset($attribute['animations'])) {
                    $ctl_animation=$attribute['animations'];
                }else if($attribute['animation']){
                  $ctl_animation=$attribute['animation'];
                 }else{
                  $ctl_animation ='bounceInUp';
                     }
      
             
                /*
                 * images sizes
                 */
                $ctl_post_per_page = $ctl_post_per_page ? $ctl_post_per_page : 10;
                $ctl_avtar_html = '';
                $timeline_id = '';
                    $clt_icons='';

                if (isset($attribute['icons']) && $attribute['icons']=="YES"){
                    $clt_icons='icons_yes';
                }else{
                    $clt_icons='icons_no';
                }

                if ($attribute['category']) {
                  if(is_numeric($attribute['category'])){
                         $ctl_term = get_term_by('id', $attribute['category'], 'ctl-stories');
                        }else{
                    $ctl_term = get_term_by('slug', $attribute['category'], 'ctl-stories');
                      }
                
                    if ($ctl_term->name == "Timeline Stories") {
                        $ctl_title_text =$ctl_options_arr['title_text'] ? $ctl_options_arr['title_text'] : 'Timeline';
                    } else {
                        $ctl_title_text = $ctl_term->name;
                    }
                    $catId = $attribute['category'];
                    $timeline_id = "timeline-$catId";
                } else {
                    $ctl_title_text = $ctl_options_arr['title_text'] ? $ctl_options_arr['title_text'] : 'Timeline';
                    $timeline_id = "timeline-".rand(1,10);
                }
                 
              
             $ctl_html_no_cont = '';
             $ctl_content_length ? $ctl_content_length : 100;
             $layout_wrp = '';
              $r_more= $ctl_options_arr['display_readmore']?$ctl_options_arr['display_readmore']:"yes";
                require("views/default.php");
              
      $main_wrp_id='tm-'.$attribute['layout'].'-'.$attribute['designs'].'-'.rand(1,20);
       $main_wrp_cls=array();
        $main_wrp_cls[]="cool_timeline";
        $main_wrp_cls[]="cool-timeline-wrapper";
        $main_wrp_cls[]=$layout_wrp;
        $main_wrp_cls[]=$wrapper_cls;
        $main_wrp_cls[]=$design_cls;
        $main_wrp_cls=apply_filters('ctl_wrapper_clasess',$main_wrp_cls);     
    $output .='<! ========= Cool Timeline PRO '.CTLPV.' =========>';
    
     $output .= '<div class="'.implode(" ",$main_wrp_cls).'" id="'. $main_wrp_id.'"  data-pagination="' . $enable_navigation . '"  data-pagination-position="' . $navigation_position . '">';
              $output .=ctl_main_title($ctl_options_arr,$ctl_title_text,$ttype='default_timeline');
               
                 $output .= '<div class="cool-timeline ultimate-style ' . $layout_cls . ' ' . $wrp_cls . '">';
                    $output .= '<div data-animations="'.$ctl_animation.'"  id="' . $timeline_id . '" class="cooltimeline_cont  clearfix '.$clt_icons.'">';
              $output .= $ctl_html;
                $output .= $ctl_html_no_cont;
                $output .= '</div>
			</div>

    </div>  <!-- end
 ================================================== -->';
    $stories_styles='<style type="text/css">'.$story_styles.'</style>';
                return $output.$stories_styles;

            }

        }

        /*
          Read more button for timeline stories
         */

        function ctl_pro_read_more() {

            // add more link to excerpt
            function ctl_p_excerpt_more($more) {
                global $post;
                $ctl_options_arr = get_option('cool_timeline_options');
                $r_more= $ctl_options_arr['display_readmore']?$ctl_options_arr['display_readmore']:"yes";

                    $read_more='';
                    if(isset($ctl_options_arr['read_more_lbl'])&& !empty($ctl_options_arr['read_more_lbl']))
                        {
                    $read_more=__($ctl_options_arr['read_more_lbl'],'cool-timeline');
                         } else{
                         $read_more=__('Read More', 'cool-timeline');
                         }  
                
                if ($post->post_type == 'cool_timeline' && !is_single()) {

                     $custom_link = get_post_meta($post->ID, 'story_custom_link', true);
                    if ($r_more == 'yes') {

                    
                    if($custom_link){
                        return '..<a  target="_blank" class="read_more ctl_read_more" href="' . $custom_link. '">' .$read_more. '</a>';
                         }else{
                        return '..<a class="read_more ctl_read_more" href="' . get_permalink($post->ID) . '">' .$read_more. '</a>';
                        }
                    }
                } else {
                    return $more;
                }
            }

            add_filter('excerpt_more', 'ctl_p_excerpt_more', 999);
        }

        function ctl_ex_len($length) {
            global $post;
            $ctl_options_arr = get_option('cool_timeline_options');
            $ctl_content_length = $ctl_options_arr['content_length'] ? $ctl_options_arr['content_length'] : 100;
            if ($post->post_type == 'cool_timeline' && !is_single()) {
                return $ctl_content_length;
            }
            return $length;
        }


        /*
         * Include this plugin's public JS & CSS files on posts.
         */

        function ctl_load_scripts_styles() {
             ctl_common_assets();
           }

       
       function safe_strtotime($string, $format) {
            if ($string) {
                $date = date_create($string);
                if (!$date) {
                    $e = date_get_last_errors();
                    foreach ($e['errors'] as $error) {
                        return "$error\n";
                    }
                    exit(1);
                }
               return date_format($date, __("$format", 'cool-timeline'));

            } else {
                return false;
            }
        }

        // add dyanmic classes on page body tag
        function ctl_body_class( $c ) {
            global $post;
            if( isset($post->post_content) && has_shortcode( $post->post_content, 'cool-timeline' ) ) {
                $c[] = 'cool-timeline-page';
            }
            return $c;
        }

    }

} // end class


