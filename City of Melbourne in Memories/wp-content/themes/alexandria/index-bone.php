<// Homepage modifying //
// Changed By Xinyu Hu. //
// 30-08-2017 //>
<div class="biz0ne">

           
<div class="timelinehomepage">
<?php echo do_shortcode( '[content_timeline id="6"]' ); ?>
<// Timeline is added on homepage! There is no this part before in the theme.//
// Changed By Kevin. //
// 27-08-2017 //>
</div>
            
            
        
        </div><!-- .biz0ne-products-services -->
        
        <?php if( !of_get_option('show_alexandria_quote_bizone') || of_get_option('show_alexandria_quote_bizone') == 'true' ) : ?>

        <div class="biz0ne-quote">
        
            <div class="biz0ne-quote-text">
                
                <p>
                    <?php 
                         if( of_get_option('quote_section_text') ){
                              echo esc_html( of_get_option('quote_section_text') );
                         }else {
                              _e('You can change this text in quote box of quote section block in Biz one tab of theme options page. You can change this text in quote box of quote section block in Biz one tab of theme options page.',  'alexandria');
                         }
                    ?>
                </p> 
                    
            </div><!-- .biz0ne-quote-text -->
            
            <p class="biz0ne-quote-name">
            
                <span>
                    <?php 
                        if( of_get_option('quote_section_name') ){
                             echo esc_attr( of_get_option('quote_section_name') );
                        }else {
                             _e('Mac Taylor',  'alexandria');
                        }
                    ?>
                </span>   
            </p>    
        
        </div><!-- .biz0ne-quote -->
        <?php endif; ?>
	






</div><!-- .biz0ne -->  

<?php if( !of_get_option('show_bizone_posts') || of_get_option('show_bizone_posts') == 'true' ) : ?>


<div class="biz0ne">
	
		<?php 
			
			if( 'page' == get_option( 'show_on_front' ) ){	
				get_template_part('index', 'page');
			}else {
				get_template_part('index', 'standard');
			}			 
			
		?>
		
</div><!-- .biz0ne -->
<?php endif; ?>  