<?php get_header(); ?>

<section id="subheader">

	<div class="container">
    
    	<div class="row">
        
            <div class="col-md-12">
			
            	<h1><?php _e( 'Content not found',"diarjo-lite"); ?> </h1>
            
            </div>   
                 
		</div>
        
    </div>
    
</section>

<div class="container">

	<div class="row" id="blog" >
		
        <article class="post-container col-md-12">

			<div class="post-article">

                <h2> <?php _e( 'Oops, it is a little bit embarassing...',"diarjo-lite" ) ?> </h2>           
			
				<?php _e( 'The page that you requested, was not found.',"diarjo-lite"); ?> 

                <h3> <?php _e( 'What can i do?',"diarjo-lite" ) ?> </h3>           

                <p> <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name') ?>"> <?php _e( 'Back to the homepage',"diarjo-lite"); ?> </a> </p>
              
                <p> <?php _e( 'Check the typed URL',"diarjo-lite"); ?> </p>

                <p> <?php _e( 'Make a search, from the below form:',"diarjo-lite"); ?> </p>
                
                <section class="contact-form">
                
                    <form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                         <input type="text" value="<?php _e( 'Search', "diarjo-lite" ) ?>" name="s" id="s" onblur="if (this.value == '') {this.value = '<?php _e( 'Search', "diarjo-lite" ) ?>';}" onfocus="if (this.value == '<?php _e( 'Search', "diarjo-lite" ) ?>') {this.value = '';}" class="input-search"/>
                         <input type="submit" id="searchsubmit" class="button-search" value="<?php _e( 'Search', "diarjo-lite" ) ?>" />
                    </form>
                    
                    <div class="clear"></div>
                    
                </section>

			</div>

    	</article>
           
    </div>
    
</div>

<?php get_footer(); ?>