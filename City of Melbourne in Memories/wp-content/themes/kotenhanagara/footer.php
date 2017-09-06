	</div><!-- #main -->
	
    <div id="footer">
	<footer id="colophon" class="site-footer" role="contentinfo"<?php kotenhanagara_wp_add_custom_footer_style(); ?>>

	<div class="fotterWidgetArea">

    <aside id="footerWidget1" class="widget">
	<?php if(dynamic_sidebar("Footer Widget 1") ) ;?>
    </aside>
    
    <aside id="footerWidget2" class="widget">
	<?php if(dynamic_sidebar("Footer Widget 2") ) ;?>
    </aside>
    
    <aside id="footerWidget3" class="widget">
	<?php if(dynamic_sidebar("Footer Widget 3") ) ;?>
    </aside>
    
    </div>
    
		<div class="site-info">
			<?php do_action( 'kotenhanagara_credits' ); ?>
			Copyright &copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?> All Rights Reserved.
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
</div>
<?php wp_footer(); ?>
</body>
</html>