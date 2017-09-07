<?php 

if ( have_comments() ) : ?>

	<div class='post-container col-md-12 comments-container'>
    	
        <div class='comments-title'>
        	<h3><?php _e('COMMENTS',"diarjo-lite") ?></h3>
        </div>
		
		<?php wp_list_comments('type=comment&callback=diarjolite_comment'); ?>
	
    </div>

<?php

endif; 

function diarjolite_comment ($comment, $args, $depth) {
    
	$GLOBALS['comment'] = $comment; ?>
 
    <section id="comment-<?php comment_ID(); ?>" <?php comment_class('post-article'); ?> >
    
        <div class="comment-avatar">
            <?php echo get_avatar( $comment->comment_author_email, 80 ); ?>
        </div>
         
        <div class="comment-text" style=" padding:15px; border:none">
            
            <header class="comment-author">
                
                <span class="author"><?php printf(__('<cite>%s</cite>',"diarjo-lite"), get_comment_author_link()) ?></span>
                <time datetime="<?php echo get_comment_date("c")?>" class="comment-date">  
                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s',"diarjo-lite"), get_comment_date(),  get_comment_time()) ?></a> - 
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                <?php edit_comment_link(__('(Edit)',"diarjo-lite")) ?>
                </time>
                
            </header>
    
            <?php if ($comment->comment_approved == '0') : ?>
                <br /><em><?php _e('Your comment is awaiting approval.',"diarjo-lite") ?></em>
            <?php endif; ?>
          
            <?php comment_text() ?>
          
        </div>
        
        <div class="clear"></div>
    
    </section>

<?php } ?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>

    <section class="col-md-12">
    
        <div class="wp-pagenavi">
        
             <div class="left"><?php previous_comments_link(__('&laquo;',"diarjo-lite")) ?></div>
             <div class="right"><?php next_comments_link(__('&raquo;',"diarjo-lite")) ?></div>
             
            <div class="clear"></div>
        </div>
        
    </section>

<?php endif;?>

<div class="clear"></div>

<section class="col-md-12">
	
	<?php comment_form(array('label_submit' =>  __('Leave a reply',"diarjo-lite")) ); ?>

</section>