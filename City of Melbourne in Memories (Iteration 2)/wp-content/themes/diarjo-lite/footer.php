<div id="back-to-top"> <i class="fa fa-chevron-up"></i> </div>

<footer id="footer">
	
    <div class="container">

		<?php if ( is_active_sidebar('bottom-sidebar-area') ) : ?>
        
			<section class="row widgets">
                    
				<?php dynamic_sidebar('bottom-sidebar-area') ?>
                    
            </section>
                
        <?php endif; ?>

        <div class="row" >
             
			<div class="col-md-12" >

                <div class="copyright">

                    <p>
                        
						<?php 
						
							if (diarjolite_setting('diarjolite_copyright_text')):
							
								echo esc_html(diarjolite_setting('diarjolite_copyright_text')) . " | ";
								
							else: 
							
								echo __('Copyright','diarjo-lite') . ' ' . get_bloginfo("name") . ' ' . date("Y") . " | ";
								echo __('Theme by','diarjo-lite').' <a href="'.esc_url('https://www.themeinprogress.com/').'" target="_blank">Theme in Progress</a> | ';
                       
							endif; 
						
						?> 
                        
                        	<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'diarjo-lite' ) ); ?>" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'diarjo-lite' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'diarjo-lite' ), 'WordPress' ); ?></a>
                    
                    </p>

				</div>
                
                <?php do_action('diarjolite_socials'); ?>

                <div class="clear"></div>
                
			</div>
                
		</div>
        
	</div>
    
</footer>

<?php wp_footer() ?>  
 
</body>

</html>