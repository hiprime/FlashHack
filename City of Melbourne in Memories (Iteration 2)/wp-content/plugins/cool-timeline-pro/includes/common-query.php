<?php
 /*
   Common code for both vertical and horizontal
  */
               $args = array();
               $cat_timeline = array();
               $based=$attribute['based'];
				        $ctl_options_arr = get_option('cool_timeline_options');
                $default_icon = isset($ctl_options_arr['default_icon'])?$ctl_options_arr['default_icon']:'';
                $ctl_post_per_page = $ctl_options_arr['post_per_page'];
                $story_desc_type = $ctl_options_arr['desc_type'];
                // $ctl_no_posts = isset($ctl_options_arr['no_posts']) ? $ctl_options_arr['no_posts'] : "No timeline story found";
                $ctl_content_length =isset($ctl_options_arr['content_length']);
                $ctl_posts_orders =isset( $ctl_options_arr['posts_orders']) ? $ctl_options_arr['posts_orders'] : "DESC";
                $disable_months = isset($ctl_options_arr['disable_months']) ? $ctl_options_arr['disable_months'] : "no";
			         	$enable_navigation = isset($ctl_options_arr['enable_navigation'] )? $ctl_options_arr['enable_navigation'] : 'yes';
                $navigation_position =isset( $ctl_options_arr['navigation_position']) ? $ctl_options_arr['navigation_position'] : 'right';

                $enable_pagination = isset($ctl_options_arr['enable_pagination']) ? $ctl_options_arr['enable_pagination'] : 'no';      
                $timeline_skin = isset($attribute['skin']) ? $attribute['skin'] : 'default';
            $active_design=$attribute['designs']?$attribute['designs']:'default';
            $wrp_cls = '';
            $wrapper_cls = '';
            $post_skin_cls = '';
            if ($timeline_skin == "light") {
              $wrp_cls = 'light-timeline';
              $wrapper_cls = 'light-timeline-wrapper';
                $post_skin_cls = 'white-post';
            } else if ($timeline_skin == "dark") {
              $wrp_cls = 'dark-timeline';
                $wrapper_cls = 'dark-timeline-wrapper';
                $post_skin_cls = 'black-post';
            } else {
               $wrp_cls = 'white-timeline';
                $post_skin_cls = 'light-grey-post';
                $wrapper_cls = 'white-timeline-wrapper';
            }
            $story_content=$attribute['story-content'];
          $stories_images_link =isset($ctl_options_arr['stories_images'])?$ctl_options_arr['stories_images']:'';
           $display_year = '';
            $format = __('d/m/Y', 'cool-timeline');
            $output = '';
            $year_position = 2;
          $date_formats =ctl_date_formats($attribute['date-format'],$ctl_options_arr);
        
         if ($attribute['category']) {
            $category = $attribute['category'];
            if(is_numeric($attribute['category'])){
               $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'ctl-stories',
                        'field' => 'term_id',
                        'terms' => $attribute['category'],
                    ));  
            }else{
             $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'ctl-stories',
                        'field' => 'slug',
                        'terms' => $attribute['category'],
                    ));
                }
        }
            $args['post_type'] = 'cool_timeline';

            if ($attribute['show-posts']) {
                $args['posts_per_page'] = $attribute['show-posts'];
            } else {
                $args['posts_per_page'] = $ctl_post_per_page;
            }
       
            $args['post_status'] = array('publish','future');
            $args['post_type'] = 'cool_timeline';
      
          if ($enable_pagination == "yes") {
             if ( get_query_var('paged') ) { 
                $paged = get_query_var('paged'); 
                } elseif ( get_query_var('page') ) { 
                $paged = get_query_var('page'); 
                } else { 
                $paged = 1; 
                }
                     $args['paged'] = $paged;
              }

            $stories_order = '';
            if ($attribute['order']) {
                $args['order'] = $attribute['order'];
                $stories_order = $attribute['order'];
            } else {
                $args['order'] = $ctl_posts_orders;
                $stories_order = $ctl_posts_orders;
            }

            if($based=="custom"){
                $args['meta_query'] = array(
                     'ctl_story_order' => array(
                        'key' => 'ctl_story_order',
                        'compare' => 'EXISTS',
                        'type'    => 'NUMERIC'
                        ),
                     array(
                        'key'     => 'story_based_on',
                        'value'   => 'custom',
                        'compare' => '=',
                    ));
                $args['orderby'] = array(
                    'ctl_story_order' => $stories_order);
            }else{
             

            $args['meta_query']= array(
                    'relation' => 'OR',
               array('key'     => 'story_based_on',
                        'value'   => 'default',
                        'compare' => '=',
                        'type'    => 'CHAR'
                         ), 
              array('relation'    => 'AND',
              'ctl_story_year' => array(
                  'key'     => 'ctl_story_year',
                  'compare' => 'EXISTS',
                ),
                'ctl_story_date'    => array(
                'key'     => 'ctl_story_date',
                'compare' => 'EXISTS',
                )));

            $args['orderby'] = array(
                'ctl_story_year' => $stories_order,
                'ctl_story_date' => $stories_order );
                }
   
 

 /*---------------end common --------------*/
