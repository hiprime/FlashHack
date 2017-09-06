<?php
/**
 * kotenhanagara functions and definitions
 *
 * @package kotenhanagara
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'kotenhanagara_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */

function kotenhanagara_pattern_body_class( $classes ) {
	if(get_option('selectcustombg_setting')=="pattern"){
		$classes[] = "pattern_background";
	}
	if($pattern = get_option('pattern_setting')){
		$classes[] = "ptn_".$pattern;
	}
	return $classes;
}
add_filter('body_class', 'kotenhanagara_pattern_body_class');

if(class_exists('WP_Customize_Control')){
	class kotenhanagara_customize_SelectCustomBackground_Control extends WP_Customize_Control {
		public $type = 'radio';
		public function render_content(){
			echo "<div style=\"display: none;\">\n";
			foreach($this->choices as $key=>$val){
				echo "<input type=\"radio\" name=\"_customize-radio-selectcustombg_setting\" data-customize-setting-link=\"selectcustombg_setting\" value=\"".esc_html($key)."\"";
				if($this->value()==$key) echo ' checked="checked"';
				echo ">\n";
			}
			echo "</div>\n";
		}
	}
	class kotenhanagara_customize_SetPattern_Control extends WP_Customize_Control {
		public $type = 'radio';
		public function render_content(){
			$background_color = get_theme_mod('background_color');
			echo <<< EOM
			<style type="text/css">
				<!--
				#patternList > span.customize-control-title {
					padding-top: 15px;
				}
				#patternList > span.customize-control-title:first-child {
					padding-top: 0;
				}
				#patternList label {
					position: relative;
					display: block;
					border: 1px solid #ccc;
					-webkit-border-radius: 3px 0 0 3px;
					border-radius: 3px 0 0 3px;
					margin: 5px 0 2.5em;
					height: 64px;
					line-height: 64px;
					background-color: #{$background_color};
					background-repeat: no-repeat;
					background-position: left top;
					box-sizing: border-box;
				}
				#patternList label input {
					position: absolute;
					bottom: -1.5em;
					line-height: 1;
				}
				#patternList label span {
					position: absolute;
					bottom: -1.5em;
					left: 1.5em;
					display: block;
					line-height: 1;
				}
				.wp-color-result:after{
					line-height: 23px;
				}
				-->
			</style>
			<script type="text/javascript">
			(function($){
				$(window).on('load',function(){
					var bgTab = $('<ul>').appendTo($('<div class="customize-control-image">').prependTo($('#customize-control-background_image').parent())).wrap($('<div class="library">').show());
					var bgTab_image = $('<li>Background Image</li>').appendTo(bgTab);
					var bgTab_pattern = $('<li>Pattern</li>').appendTo(bgTab);

					function selectImage(){
						bgTab_image.addClass('library-selected');
						bgTab_pattern.removeClass('library-selected');
						$('#customize-control-background_image').show();
						if($('#customize-control-background_image').find('.actions').find('a').css('display') != 'none'){
							$('#customize-control-background_repeat').show();
							$('#customize-control-background_position_x').show();
							$('#customize-control-background_attachment').show();
						}
						$('#customize-control-pattern_setting').hide();
					}
					function selectPattern(){
						bgTab_image.removeClass('library-selected');
						bgTab_pattern.addClass('library-selected');
						$('#customize-control-background_image').hide();
						$('#customize-control-background_repeat').hide();
						$('#customize-control-background_position_x').hide();
						$('#customize-control-background_attachment').hide();
						$('#customize-control-pattern_setting').show();
					}

					$('#accordion-section-background_image').on('click',function(){
						var bgcolor = $('#customize-control-background_color').find('input.color-picker-hex').val();
						$('#patternList').find('label').css('background-color',bgcolor);
					});

					if($('#customize-control-selectcustombg_setting').find('input[name="_customize-radio-selectcustombg_setting"]').eq(0).prop('checked')){
						selectImage();
					}else{
						selectPattern();
					}

					bgTab_image.on('click',function(){
						$('#customize-control-selectcustombg_setting').find('input[name="_customize-radio-selectcustombg_setting"]').eq(0).click();
						selectImage();
					});
					bgTab_pattern.on('click',function(){
						$('#customize-control-selectcustombg_setting').find('input[name="_customize-radio-selectcustombg_setting"]').eq(1).click();
						selectPattern();
					});
				});
			})(jQuery);
			</script>
EOM;
			echo "<div id=\"patternList\">\n";
			$pattern_type_b = "";
			$pattern_type_a = "";
			foreach($this->choices as $key=>$val){
				$split = explode("_",$key);
				$pattern_type_a = array_pop($split);
				if(empty($pattern_type_b) || $pattern_type_a != $pattern_type_b){
					if(strpos('bgcolor',$pattern_type_a) !== FALSE){
						echo "<span class=\"customize-control-title\">Custom Background Color</span>\n";
					}else
					if(strpos('colored',$pattern_type_a) !== FALSE){
						echo "<span class=\"customize-control-title\">Fixed Color</span>\n";
					}
					$pattern_type_b = $pattern_type_a;
				}
				echo "<label class=\"ptn_".esc_html($key)."\" style=\"background-image:url('".get_template_directory_uri()."/images/ptn_".esc_html($key).".png')\">";
				echo "<input type=\"radio\" name=\"_customize-radio-pattern_setting\" data-customize-setting-link=\"pattern_setting\" value=\"".esc_html($key)."\"";
				if($this->value()==$key) echo ' checked="checked"';
				echo "><span>".esc_html($val)."</span></label>\n";
			}
			echo "</div>\n";
		}
	}
}

function kotenhanagara_original_customize( $wp_customize ) {
	$wp_customize->add_setting('pattern_setting',
		array(
			'default'	=> 'botan_colored',
			'sanitize_callback' => 'botan_colored',
			'type'		=> 'option',
		)
	);
	if(class_exists('kotenhanagara_customize_SetPattern_Control')){
		$wp_customize->add_control(
			new kotenhanagara_customize_SetPattern_Control($wp_customize,'pattern_setting',
				array(
					'settings'	=> 'pattern_setting',
					'label'		=> 'Pattern',
					'section'	=> 'background_image',
					'type'		=> 'radio',
					'choices'	=> array(
						'chiyo_bgcolor'		=> 'Chiyo',
						'botan_bgcolor'		=> 'Botan',
						'hinageshi_bgcolor'	=> 'Hinageshi',
						'chiyo_colored'		=> 'Chiyo',
						'botan_colored'		=> 'Botan',
						'hinageshi_colored'	=> 'Hinageshi',
					),
				)
			)
		);
	}
	$wp_customize->add_setting('selectcustombg_setting',
		array(
			'default'	=> 'pattern',
			'sanitize_callback' => 'pattern',
			'type'		=> 'option',
		)
	);
	if(class_exists('kotenhanagara_customize_SelectCustomBackground_Control')){
		$wp_customize->add_control(
			new kotenhanagara_customize_SelectCustomBackground_Control($wp_customize,'selectcustombg_setting',
				array(
					'settings'	=> 'selectcustombg_setting',
					'label'		=> '',
					'section'	=> 'background_image',
					'priority'	=> 1,
					'type'		=> 'radio',
					'choices'	=> array(
						'image'		=> 'image',
						'pattern'	=> 'pattern',
					),
				)
			)
		);
	}

	$wp_customize->add_section( 'kotenhanagara_logo_section',
		array(
			'title'			=> 'Logo',
			'priority'		=> 50,
		)
	);
	$wp_customize->add_setting( 'kotenhanagara_logo_image',
		array(
			'default'		=> get_template_directory_uri().'/images/ico_hanagara.png',
			'sanitize_callback' => get_template_directory_uri().'/images/ico_hanagara.png',
			'type'			=> 'option',
			'capability'	=> 'edit_theme_options',
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize, 'kotenhanagara_logo_image',
		array(
			'section'	=> 'kotenhanagara_logo_section',
			'settings'	=> 'kotenhanagara_logo_image',
		)
	) );
	$control = $wp_customize->get_control( 'kotenhanagara_logo_image' );
	$control->add_tab( 'Default', __('Default', 'kotenhanagara'), 'kotenhanagara_logo_image_tab');

	function kotenhanagara_logo_image_tab(){
		$logos = array(
			'/images/ico_hanagara.png',
		);
		global $wp_customize;
		$control = $wp_customize->get_control( 'kotenhanagara_logo_image' );
		foreach ( (array)$logos as $logo ){
			$control->print_tab_image( esc_url_raw( get_template_directory_uri().'/'.$logo ) );
		}
	}

	$wp_customize->add_section( 'original_section', array(
		'title'          => 'kotenhanagara',
		'priority'       => 10000,
	));
/*
	$wp_customize->add_setting('Social_Link_Color', array(
		'default'           => '#f7f5e7',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
		'type'           => 'option',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'Social_Link_Color', array(
		'label'    => 'Social Link Color',
		'section'  => 'original_section',
		'settings' => 'Social_Link_Color',
	)));
	$wp_customize->add_setting('Social_Link_Hover_Color', array(
		'default'           => '#f7f5e7',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
		'type'           => 'option',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'Social_Link_Hover_Color', array(
		'label'    => 'Social Link Hover Color',
		'section'  => 'original_section',
		'settings' => 'Social_Link_Hover_Color',
	)));
*/
	$wp_customize->add_setting('Main_Link_Color', array(
		'default'           => '#f7f5e7',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
		'type'           => 'option',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'Main_Link_Color', array(
		'label'    => 'Main Link Color',
		'section'  => 'original_section',
		'settings' => 'Main_Link_Color',
	)));
	$wp_customize->add_setting('Main_Link_Hover_Color', array(
		'default'           => '#f7f5e7',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
		'type'           => 'option',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'Main_Link_Hover_Color', array(
		'label'    => 'Main Link Hover Color',
		'section'  => 'original_section',
		'settings' => 'Main_Link_Hover_Color',
	)));
	$wp_customize->add_setting('Main_Text_Color', array(
		'default'           => '#f7f5e7',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
		'type'           => 'option',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'Main_Text_Color', array(
		'label'    => 'Main Text Color',
		'section'  => 'original_section',
		'settings' => 'Main_Text_Color',
	)));
	$wp_customize->add_setting('Sidebar_Text_Color', array(
		'default'           => '#f7f5e7',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
		'type'           => 'option',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'Sidebar_Text_Color', array(
		'label'    => 'Sidebar Text Color',
		'section'  => 'original_section',
		'settings' => 'Sidebar_Text_Color',
	)));
	$wp_customize->add_setting('Sidebar_Link_Color', array(
		'default'           => '#f7f5e7',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
		'type'           => 'option',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'Sidebar_Link_Color', array(
		'label'    => 'Sidebar Link Color',
		'section'  => 'original_section',
		'settings' => 'Sidebar_Link_Color',
	)));
	$wp_customize->add_setting('Sidebar_Link_Hover_Color', array(
		'default'           => '#f7f5e7',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
		'type'           => 'option',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'Sidebar_Link_Hover_Color', array(
		'label'    => 'Sidebar Link Hover Color',
		'section'  => 'original_section',
		'settings' => 'Sidebar_Link_Hover_Color',
	)));
}
add_action('customize_register', 'kotenhanagara_original_customize');

function kotenhanagara_customize_css(){
	echo "<style type=\"text/css\">\n<!--\n";

	echo ".entry-title, .entry-title a { color:".get_option('Main_Link_Color')."; }";
	echo ".entry-title, .entry-title a:hover { color:".get_option('Main_Link_Hover_Color')."; }";
	echo ".entry-content { color:".get_option('Main_Text_Color')."; }";
	echo "#secondary { color:".get_option('Sidebar_Text_Color')."; }";
	echo "#secondary a { color:".get_option('Sidebar_Link_Color')."; }";
	echo "#secondary a:hover { color:".get_option('Sidebar_Link_Hover_Color')."; }";

	echo "-->\n</style>\n";
}
add_action('wp_head', 'kotenhanagara_customize_css');




function kotenhanagara_setup() {

	add_theme_support('custom-background', array('default-color' => '333333'));

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on kotenhanagara, use a find and replace
	 * to change 'kotenhanagara' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'kotenhanagara', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	set_post_thumbnail_size( 190, 190, true );
}
endif; // kotenhanagara_setup
add_action( 'after_setup_theme', 'kotenhanagara_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function kotenhanagara_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'kotenhanagara_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	}
}
add_action( 'after_setup_theme', 'kotenhanagara_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function kotenhanagara_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'kotenhanagara' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar(array(
		'name'          => __( 'Facebook', 'kotenhanagara' ),
		'description' => 'Facebook',
		'before_widget' => '<li><a href="',
		'after_widget'  => '" target="_blank"><img src="'.get_stylesheet_directory_uri().'/images/ico_social01.png" alt="Facebook" /></a></li>',
		));
	register_sidebar(array(
		'name'          => __( 'Twitter', 'kotenhanagara' ),
		'description' => 'Twitter',
		'before_widget' => '<li><a href="',
		'after_widget'  => '" target="_blank"><img src="'.get_stylesheet_directory_uri().'/images/ico_social02.png" alt="Twitter" /></a></li>',
		));
	register_sidebar(array(
		'name'          => __( 'Tumblr', 'kotenhanagara' ),
		'description' => 'Tumblr',
		'before_widget' => '<li><a href="',
		'after_widget'  => '" target="_blank"><img src="'.get_stylesheet_directory_uri().'/images/ico_social03.png" alt="Tumblr" /></a></li>',
		));
	register_sidebar(array(
		'name'          => __( 'Google', 'kotenhanagara' ),
		'description' => 'Google',
		'before_widget' => '<li><a href="',
		'after_widget'  => '" target="_blank"><img src="'.get_stylesheet_directory_uri().'/images/ico_social04.png" alt="Google" /></a></li>',
		));
	register_sidebar(array(
		'name'          => __( 'LinkedIn', 'kotenhanagara' ),
		'description' => 'LinkedIn',
		'before_widget' => '<li><a href="',
		'after_widget'  => '" target="_blank"><img src="'.get_stylesheet_directory_uri().'/images/ico_social05.png" alt="LinkedIn" /></a></li>',
		));
	register_sidebar(array(
		'name'          => __( 'RSS', 'kotenhanagara' ),
		'description' => 'RSS',
		'before_widget' => '<li><a href="',
		'after_widget'  => '" target="_blank"><img src="'.get_stylesheet_directory_uri().'/images/ico_social06.png" alt="RSS" /></a></li>',
		));

	register_sidebar(array(
		'name'          => __( 'Footer Widget 1', 'kotenhanagara' ),
		'description' => 'Footer Widget 1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		));
	register_sidebar(array(
		'name'          => __( 'Footer Widget 2', 'kotenhanagara' ),
		'description' => 'Footer Widget 2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		));
	register_sidebar(array(
		'name'          => __( 'Footer Widget 3', 'kotenhanagara' ),
		'description' => 'Footer Widget 3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		));
}

add_action( 'widgets_init', 'kotenhanagara_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function kotenhanagara_scripts() {

	wp_enqueue_style( 'kotenhanagara-style', get_stylesheet_uri() );
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'html5', get_stylesheet_directory_uri() . '/js/html5.js' );
	wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/script.js' );
	wp_enqueue_script( 'kotenhanagara-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'jquery.ah-placeholder',  get_template_directory_uri() . '/js/jquery.ah-placeholder.js',array('jquery') );
	wp_enqueue_script( 'kotenhanagara-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'kotenhanagara-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'kotenhanagara_scripts' );

function kotenhanagara_new_excerpt_mblength($length) {
	 return 30;
}
add_filter('excerpt_mblength', 'kotenhanagara_new_excerpt_mblength');

function kotenhanagara_new_excerpt_more($post) {

	return ' ...<a class="readmore" href="'. esc_url( get_permalink() ) . '">' . 'read more' . '</a>';
}
add_filter('excerpt_more', 'kotenhanagara_new_excerpt_more');

add_filter( "comment_form_defaults", "kotenhanagara_my_comment_notes_after");

function kotenhanagara_my_comment_notes_after($defaults){
  $defaults['comment_notes_after'] = '';
  return $defaults;
}


add_action('admin_print_styles', 'kotenhanagara_my_admin_print_styles');
function kotenhanagara_my_admin_print_styles() {
  wp_enqueue_style( 'farbtastic' );
}
add_action('admin_print_scripts', 'kotenhanagara_my_admin_print_scripts');
function kotenhanagara_my_admin_print_scripts() {
  wp_enqueue_script( 'farbtastic' );
  wp_enqueue_script( 'quicktags' );
  wp_enqueue_script( 'my-admin-script', get_stylesheet_directory_uri() . '/js/admin-script.js', array( 'farbtastic', 'quicktags' ), false, true );
}

/*** Link widget ***/

class kotenhanagara_MyWidgetItem extends WP_Widget {
	function kotenhanagara_MyWidgetItem() {
		parent::WP_Widget(false, $name = 'Social Link');
	}
	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		?><?php echo $before_widget .$title. $after_widget; ?><?php
	}
	function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	function form($instance) {
		$title = esc_attr($instance['title']);
		?>
		<p>
		  <label for="<?php echo $this->get_field_id('title'); ?>">
		  <?php _e('URL:','kotenhanagara'); ?>
		  </label>
		  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("kotenhanagara_MyWidgetItem");'));


/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );



/* CUSTOM HEADER AND FOOTER */

/* CUSTOM FUNCTIONS */

add_action('init', 'kotenhanagara_user_custom_header_and_footer');
add_action('admin_menu', 'kotenhanagara_admin_custom_header_and_footer');

function kotenhanagara_wp_add_custom_header_style() {
	do_action('kotenhanagara_wp_add_custom_header_style');
}

function kotenhanagara_wp_add_custom_footer_style () {
	do_action('kotenhanagara_wp_add_custom_footer_style');
}

function kotenhanagara_user_custom_header_and_footer() {


	// hook for header
	add_action('kotenhanagara_wp_add_custom_header_style', 'kotenhanagara_fc_header_style');
	remove_filter( 'wp_head', 'strip_tags' );

	// hook for footer
	add_action('kotenhanagara_wp_add_custom_footer_style', 'kotenhanagara_fc_footer_style');
	remove_filter( 'wp_footer', 'strip_tags' );

	add_action( 'wp_head' , 'kotenhanagara_fc_custom_css');


}

function kotenhanagara_admin_custom_header_and_footer() {
	// Hook for adding admin menus
	$theme_page = add_theme_page(
		'Header &amp; Footer',   // Name of page
		'Header &amp; Footer',   // Label in menu
		'edit_theme_options',                    // Capability required
		'custom_handf',                         // Menu slug, used to uniquely identify the page
		'kotenhanagara_fc_settings_page' // Function that renders the options page
	);
	add_action('admin_enqueue_scripts', 'kotenhanagara_fc_farbtastic_script');
}

// Display header
function kotenhanagara_fc_header_style() {
	if(true == get_option('checkboxhf')) {
		$stylestr = '';
		if(get_option('fc_uplo1')) {
			$stylestr .= 'background-image:url(\''.get_option('fc_uplo1').'\');';
		}
		if(get_option('fc_backgroundpick1')) {
			$stylestr .= 'background-color:'.get_option('fc_backgroundpick1').';';
		}
		if(get_option('fc_textpick1')) {
			$stylestr .= 'color:'.get_option('fc_textpick1').';';
		}
		if($stylestr != '') {
			$stylestr = ' style="'.$stylestr.'"';
		}
		echo $stylestr;
	}
}

// Display footer
function kotenhanagara_fc_footer_style() {
	if(true == get_option('checkboxhf')) {
		$stylestr = '';
		if(get_option('fc_uplo2')) {
			$stylestr .= 'background-image:url(\''.get_option('fc_uplo2').'\');';
		}
		if(get_option('fc_backgroundpick2')) {
			$stylestr .= 'background-color:'.get_option('fc_backgroundpick2').';';
		}
		if(get_option('fc_textpick2')) {
			$stylestr .= 'color:'.get_option('fc_textpick2').';';
		}
		if($stylestr != '') {
			$stylestr = ' style="'.$stylestr.'"';
		}
		echo $stylestr;
	}
}

// custom css support
function kotenhanagara_fc_custom_css() {
	if(true == get_option('checkboxhf') && get_option('fc_css_get')) {
		echo '<style type="text/css">'."\n".get_option('fc_css_get')."\n".'</style>'."\n";
	}
}


// kotenhanagara_fc_settings_page() displays the page content for the Header and Footer Commander submenu
function kotenhanagara_fc_settings_page() {
	if (!current_user_can('manage_options')) {
		wp_die('You do not have sufficient permissions to access this page.');
	}

	$hidden_field_name = 'fc_submit_hidden';
	$fc_new_bc2 = 'fc_backgroundpick2';
	$fc_new_bc1 = 'fc_backgroundpick1';
	$hidden_name_bc1 = 'fc_background1';
	$hidden_name_bc2 = 'fc_background2';
	$fc_new_tc2 = 'fc_textpick2';
	$fc_new_tc1 = 'fc_textpick1';
	$hidden_name_tc1 = 'fc_text1';
	$hidden_name_tc2 = 'fc_text2';
	$ad_image1 = 'fc_imade1';
	$ad_image2 = 'fc_imade2';
	$fc_new_up1 = 'fc_uplo1';
	$fc_new_up2 = 'fc_uplo2';
	$cssfc_new_val = 'fc_css_get';
	$cssfc_field_name = '$cssfc_fieldget';

	$fc_bc2 = get_option( $fc_new_bc2 );
	$fc_bc1 = get_option( $fc_new_bc1 );
	$fc_tc2 = get_option( $fc_new_tc2 );
	$fc_tc1 = get_option( $fc_new_tc1 );
	$fc_upload2 = get_option( $fc_new_up2 );
	$fc_upload1 = get_option( $fc_new_up1 );
	$cssfc_field_val = get_option( $cssfc_new_val );

	if ($fc_bc2== '') {
		$fc_bc2 = '#fff';
	}
	if ($fc_bc1== '') {
		$fc_bc1 = '#fff';
	}
	if ($fc_tc2== '') {
		$fc_tc2 = '#fff';
	}
	if ($fc_tc1== '') {
		$fc_tc1 = '#fff';
	}

	if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {

		$fc_bc2 = $_POST[ $hidden_name_bc2 ];
		$fc_bc1 = $_POST[ $hidden_name_bc1 ];
		$fc_tc2 = $_POST[ $hidden_name_tc2 ];
		$fc_tc1 = $_POST[ $hidden_name_tc1 ];
		$fc_upload1 = $_POST[ $ad_image1 ];
		$fc_upload2 = $_POST[ $ad_image2 ];
		$cssfc_field_val = $_POST[ $cssfc_field_name ];
		add_option('checkboxhf', TRUE);

		update_option( $fc_new_bc2, $fc_bc2 );
		update_option( $fc_new_bc1, $fc_bc1 );
		update_option( $fc_new_tc2, $fc_tc2 );
		update_option( $fc_new_tc1, $fc_tc1 );
		update_option( $fc_new_up1, $fc_upload1 );
		update_option( $fc_new_up2, $fc_upload2 );
		update_option( $cssfc_new_val , $cssfc_field_val );
		update_option('checkboxhf', (bool) $_POST["checkboxhf"]);

?>
<div class="updated"><p><strong>settings saved.</strong></p></div>
<?php
	}
?>
<style type="text/css">
#blocx-custom-handf .heading2{ font-size: 17pt; }
#blocx-custom-handf table.widefat{ padding: 10px; }
#blocx-custom-handf table.widefat th, #blocx-custom-handf table.widefat td{ vertical-align: top; }
#blocx-custom-handf #upload_image1, #blocx-custom-handf #upload_image_button1, #blocx-custom-handf #upload_image2, #blocx-custom-handf #upload_image_button2{ vertical-align: middle; }
#blocx-custom-handf input[type=text], #blocx-custom-handf textarea { -moz-border-radius: 3px; -webkit-border-radius: 3px; -o-border-radius: 3px; -ms-border-radius: 3px; border-radius: 3px; -webkit-box-shadow: inset 1px 1px 2px rgba(0,0,0,0.1); -moz-box-shadow: inset 1px 1px 2px rgba(0,0,0,0.1); -webkit-box-shadow: inset 1px 1px 2px rgba(0,0,0,0.1); -o-box-shadow: inset 1px 1px 2px rgba(0,0,0,0.1); -ms-box-shadow: inset 1px 1px 2px rgba(0,0,0,0.1); box-shadow: inset 1px 1px 2px rgba(0,0,0,0.1); }
#blocx-custom-handf table.widefat tr.middle th, #blocx-custom-handf table.widefat tr.middle td{ vertical-align: middle; }
#blocx-custom-handf table.widefat th{ font-size: 11pt; }
#blocx-custom-handf table.widefat th.heading{ border-bottom: 1px solid #555; }
#blocx-custom-handf table.widefat th.heading strong{ font-size: 14pt; }
#blocx-custom-handf table.widefat textarea.custom-style{ height:200px; width:80%; border:1px solid #ddd; }
#blocx-custom-handf .btn-cell{ border-top:1px solid #555; padding: 15px; }
#blocx-custom-handf p.submit{ text-align:center; }
#blocx-custom-handf .colorpicker{ width: 120px; }
</style>
<script type="text/javascript">
(function($) {
	$(document).ready(function() {

		var picker1 = $('#colorpicker1'),
			picker2 = $('#colorpicker2'),
			picker3 = $('#colorpicker3'),
			picker4 = $('#colorpicker4');

		picker1.hide();
		picker1.farbtastic("#color1");
		$("#color1").click(function(){
			picker1.slideToggle()
		});

		picker2.hide();
		picker2.farbtastic("#color2");
		$("#color2").click(function(){
			picker2.slideToggle();
		});

		picker3.hide();
		picker3.farbtastic("#color3");
		$("#color3").click(function(){
			picker3.slideToggle();
		});

		picker4.hide();
		picker4.farbtastic("#color4");
		$("#color4").click(function(){
			picker4.slideToggle();
		});

		var custom_uploader = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			library: {
				type: "image"
			},
			multiple: false
		});

		var clicked = "";

		custom_uploader.on('select', function() {
			var image = custom_uploader.state().get('selection').first().toJSON();
			$(clicked).val(image.url);
		});

		$('#upload_image_button1').click(function(e) {
			e.preventDefault();
			clicked = "#upload_image1";
			custom_uploader.open();
		});

		$('#upload_image_button2').click(function(e) {
			e.preventDefault();
			clicked = "#upload_image2";
			custom_uploader.open();
		});
	});
})(jQuery);

</script>
<div class="wrap">
<div id="icon-plugins" class="icon32"></div>
<div id="blocx-custom-handf">
<h2 class="heading2">Header and Footer Commander Settings</h2>
<h3 class="heading3">Click on each field to display the color picker. Click again to close it.</h3>
<div class="updated"><p>Supports HTML tags such as the ( a, img, blockquote, code, em, ul ) etc... Quotes ( " ) are not allowed and do not leave ( Background color ) field blank.</p></div>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
<table class="widefat" border="0">
<colgroup>
<col width="22%" />
<col width="53%" />
<col width="25%" />
</colgroup>
<tr class="top">
<th scope="col" colspan="3" class="heading"><strong>Header color settings</strong></th>
</tr>
<tr class="middle">
<th scope="row">Background color</th>
<td><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $fc_bc1 ); ?>" name="<?php echo $hidden_name_bc1; ?>" id="color1" class="colorpicker" /></td>
<td><div id="colorpicker1"></div></td>
</tr>
<tr class="middle">
<th scope="row">Text color</th>
<td><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $fc_tc1 ); ?>" name="<?php echo $hidden_name_tc1; ?>" id="color2" class="colorpicker" /></td>
<td><div id="colorpicker2"></div></td>
</tr>
<tr class="top">
<th scope="row">Choose Image</th>
<td>
<input id="upload_image1" type="text" size="36" name="<?php echo $ad_image1; ?>" value="<?php echo $fc_upload1; ?>" />
<input id="upload_image_button1" class="button" type="button" value="Upload Image" /><br />
<label for="upload_image1">Enter an URL, upload or select an existing image for the banner.</label>
</td>
</tr>
<tr>
<td colspan="3">&nbsp;</td>
</tr>
<tr class="top">
<th scope="col" colspan="3" class="heading"><strong>Footer color settings</strong></th>
</tr>
<tr class="middle">
<th scope="row">Background color</th>
<td width="3%"><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $fc_bc2 ); ?>" name="<?php echo $hidden_name_bc2; ?>" id="color3" class="colorpicker" /></td>
<td><div id="colorpicker3"></div></td>
</tr>
<tr class="middle">
<th scope="row">Text color</th>
<td><input type="text" maxlength="7" size="6" value="<?php echo esc_attr( $fc_tc2 ); ?>" name="<?php echo $hidden_name_tc2; ?>" id="color4" class="colorpicker" /></td>
<td><div id="colorpicker4"></div></td>
</tr>
<tr class="top">
<th scope="row">Choose Image</th>
<td colspan="2">
<input id="upload_image2" type="text" size="36" name="<?php echo $ad_image2; ?>" value="<?php echo $fc_upload2; ?>" />
<input id="upload_image_button2" class="button" type="button" value="Upload Image" /><br />
<label for="upload_image2">Enter an URL, upload or select an existing image for the banner.</label>
</td>
</tr>
<tr>
<td colspan="3">&nbsp;</td>
</tr>
<tr class="top">
<th scope="row" colspan="3" class="heading"><strong>Custom Settings</strong></th>
</tr>
<tr class="top">
<th>Custom CSS:</th>
<td colspan="2"><textarea name="<?php echo $cssfc_field_name; ?>" class="custom-style"><?php echo $cssfc_field_val; ?></textarea></td>
</tr>
<tr class="middle">
<td colspan="3" class="btn-cell">
<p class="submit"><span class="check">Check to Enable Both Options: <input type="checkbox" name="checkboxhf" value="checkbox" <?php if (get_option('checkboxhf')) echo "checked='checked'"; ?>/></span> <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  /></p>
</td>
</tr>
</table>
</form>
</div><!-- #blocx-custom-handf -->
</div><!-- .wrap -->
<?php }
// Include WordPress color picker functionality
function kotenhanagara_fc_farbtastic_script($hook) {
	// only enqueue farbtastic on the plugin settings page
	if( $hook != 'appearance_page_custom_handf' ) {
		return;
	}
	// load the style and script for farbtastic
	wp_enqueue_style( 'farbtastic' );
	wp_enqueue_script( 'farbtastic' );

	if(function_exists( 'wp_enqueue_media' )){
		wp_enqueue_media();
	} else {
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}

}

//Dashboard
function example_dashboard_widget_function() {
?>
<a href="http://wpshop.com/themes?=vn_wps_koten" target="_blank"><img src="<?php echo get_template_directory_uri().'/images/300250_wpshop_0001.jpg' ?>" style="width:100%"></a>
<?php
}

require_once(dirname(__FILE__).'/inc/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'kotenhanagara_register_required_plugins' );
function kotenhanagara_register_required_plugins() {

	$plugins = array(

		array(
			'name'                  => 'GMO Font Agent', // The plugin name
			'slug'                  => 'gmo-font-agent', // The plugin slug (typically the folder name)
 //           'source'                => get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source
			'required'              => false, // If false, the plugin is only 'recommended' instead of required
 //           'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
 //           'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
 //           'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
 //           'external_url'          => '', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'      => 'GMO Showtime',
			'slug'      => 'gmo-showtime',
			'required'  => false,
		),

	);

	$theme_text_domain = 'kotenhanagara';

	$config = array(
		'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
		'default_path'      => '',                           // Default absolute path to pre-packaged plugins
		'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
		'parent_url_slug'   => 'themes.php',         // Default parent URL slug
		'menu'              => 'install-required-plugins',   // Menu slug
		'has_notices'       => true,                         // Show admin notices or not
		'is_automatic'      => false,            // Automatically activate plugins after installation or not
		'message'           => '',               // Message to output right before the plugins table
		'strings'           => array(
			'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
			'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'               => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
		)
	);

	tgmpa( $plugins, $config );

}

function kotenhanagara_scriptsMore(){
	// wp_enqueue_script('jquery');
	// wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/more.js' );
}
add_action( 'admin_enqueue_scripts', 'kotenhanagara_scriptsMore' );

add_action('appearance_page_more', 'regist_more_css');
function regist_more_css() { ?>
<link rel='stylesheet' id='kotenhanagara_style-css' href='<?php echo get_stylesheet_directory_uri() .'/css/more.css' ?>' type='text/css' media='all' /><?php }

//More
function kotenhanagara_menu_more() {
	$siteurl = get_option( 'siteurl' );
?>
<div class="moreWrap">
	<h2>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/head_title.png" alt="Internet For Everyone Z.com by GMO" >
	</h2>

	<div class="more_navigation">
		<ul>
			<li><a href="#hosting">WordPress Hosting</a></li>
			<li><a href="#themes">Themes</a></li>
			<li><a href="#plugins">Plugins</a></li>
		</ul>
	</div>

	<a id="hosting" name="hosting"></a>
	<div class="more_contents">

		<h3>Z.com WordPress Hosting</h3>
		<div class="hosting">
			<a href="https://cloud.z.com/jp/en/wp/?utm_source=themes&utm_medium=aboutz&utm_campaign=themes_aboutz" target="_blank">
				<p class="title">Reason for smooth WordPress Experience</p>
				<p>
					You don’t have to care about Speeding up, security and updates, because “Z.com WordPress Hosting” is optimized for WordPress.<br>
					The structure designing for exclusive use of WordPress with high-speed SSD supports WordPress specific mechanism that depends on the database. You can enjoy seamless operation which cannot be provided with the regular HDD.<br>
					Z.com WordPress Hosting features safe and seamless WordPress site building experience to let you focus on site contents and updating.
				</p>
				<p class="btn">View More</p>
			</a>
		</div>

		<a id="themes" name="themes"></a>
		<h3>Z.com WordPress Themes</h3>
		<div class="block-themes">
			<ul class="list-themes">
				<li class="items list1">
					<div class="box-inner">
						<h4 class="titles">waffle</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_waffle.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://waffle.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="https://wordpress.org/themes/waffle" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							waffle is child theme of twenty fifteen base functionality is took over parent has and additional features are installed especially background color and text color on sidebar.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
				<li class="items list2">
					<div class="box-inner">
						<h4 class="titles">Tidy</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_tidy.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://tidy.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="https://wordpress.org/themes/tidy" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							Tidy - The multi-purpose WordPress theme with ultimate simplicity. The theme is fully customizable, responsive and flexible with full of revolutionary functions. Contents can turned on and off as desired, and a wide variety of layout options to help you build a satisfactory website.<br>
							The theme comes standard with the original slider, social media integration, Google advertisement & stats plugins along with the web font support with full color customization for enhanced flexibility.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
				<li class="items list3">
					<div class="box-inner">
						<h4 class="titles">Madeini</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_madeini.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://madeini.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="http://wordpress.org/themes/madeini" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							Madeini is an upgraded version of Twenty-Fourteen WordPress default theme with enhanced custom color and custom background image feature.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
				<li class="items list4">
					<div class="box-inner">
						<h4 class="titles">Kimono</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_kimono.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://kimono.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="http://wordpress.org/themes/kimono" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							Kimono is a simple, and user friendly WordPress theme. Beautiful design inspiration comes from Japanese traditional garment called Kimono.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
				<li class="items list5">
					<div class="box-inner">
						<h4 class="titles">Kotenhanagara</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_kotenhanagara.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://kotenhanagara.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="http://wordpress.org/themes/kotenhanagara" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							Kotenhanagara is a simple, easy-to-use, and highly customizable WordPress theme. Beautiful Japanese design inspiration comes from Urushi coating which is lacquerware decorated and varnished in the Japanese manner.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
				<li class="items list6">
					<div class="box-inner">
						<h4 class="titles">de naani.</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_denaani.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://denaani.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="https://wordpress.org/themes/de-naani" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							'de naani' is an upgraded version of Twenty-Twelve default theme which is designed to work perfectly with 'GMO Show Time' slider plugin and 'GMO Font agent'web font plugin. This theme also allow you to insert logo, and change site title/tagline positions.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
				<li class="items list7">
					<div class="box-inner">
						<h4 class="titles">Azabu Juban</h4>
						<div class="box-links">
							<p class="thumbs"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/themes_azabujuban.jpg" alt=""></p>
							<ul class="list-themes-links" tabindex="0">
								<li class="link-demo"><a href="http://azabujuban.webstarterz.com/" target="_blank" class="btn">Demo</a></li>
								<li class="link-download"><a href="http://wordpress.org/themes/azabu-juban" target="_blank" class="btn">Download</a></li>
							</ul><!-- .list-themes-links -->
						</div><!-- .box-links -->
						<div class="contents">
							Azabu-Juban is a simple, easy-to-use, and highly customizable WordPress theme. Beautiful Japanese design inspiration comes from Urushi coating which is lacquerware decorated and varnished in the Japanese manner.
						</div><!-- .contents -->
					</div><!-- .box-inner -->
				</li><!-- .items -->
			</ul><!-- .list-themes -->
		</div><!-- .block-themes -->



		<a id="plugins" name="plugins"></a>
		<h3>Z.com WordPress Plugins</h3>

		<div class="plugins">

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_showtime.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-showtime/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Showtime</h4>
					<p>GMO Showtime slider plugin gives cool effects to the slider in a snap. The control screen is simple, for anyone to easily use. Express user's originality with fully customizable link and color as well as 16 slider effects in 6 different layouts.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_font_agent.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-font-agent/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Font Agent</h4>
					<p>GMO Font Agent plugin works with Google fonts, gives you a choice to use variety of stylish web fonts. The plugin is genericon and IcoMoon compatible, to enhance its usability. Icons can be inserted from the post editor.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_sahre_connection.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-share-connection/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Share Connection</h4>
					<p>GMO Share Connection plugin is designed for easy social sharing by letting user choose place/pages to use icons. 9 social network services are supported in this plugin including Facebook and Twitter.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_ads_master.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-ads-master/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Ads Master</h4>
					<p>GMO Ads Master is the ad banner plugin which enables you to place ad contents to the desired locations such as inside article, sidebar and footer. In addition to that, using this plugin let you setup Google Analytics tracking code and sitemap tool settings, and sitemap can be easily generated without playing with PHP files.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_go_to_top.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-go-to-top/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Go to Top</h4>
					<p>GMO Go to Top is a simple plugin adds a simple button which allows users to scroll all the way up to the top by 1-click. Button color, style, position can be modified or you can also upload your own button image.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_page_trasitions.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-page-transitions/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Page Transitions</h4>
					<p>GMO Page Transitions adds Page Transitions actions to your site. Click on the link, and page will slide over to left or right. This effect will not apply when "target=_brank" is used.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_tinymce_smiley.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-tinymce-smiley/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO TinyMCE Smiley</h4>
					<p>GMO TinyMCE Smiley is a plugin to let you instantly add smilies into your site from the toolbar..</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_google_map.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-google-map/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Google Map</h4>
					<p>With "GMO Google Map" plugin, you can use Google Maps on your website by simply embedding a shortcode in anywhere you desire. No special coding skill is required. Simply enter information (eg. address) to create a shortcode and paste it to complete.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_showtime.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-widget-custom/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Widget Custom</h4>
					<p>This is a useful widget customizer plugin which enables you to insert images, ad and recommendation banners.</p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_slider.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-slider/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Slider</h4>
					<p>GMO Slider plugin let you insert sliders in posts and pages. The control screen is simple, for anyone to easily use. GMO Slider supports images as well as text and video. </p>
				</div>
			</div>

			<div class="plugins_detail">
				<div class="plugins_detail_l">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/ico_plugin_social_connection.gif">
					<p class="link"><a href="https://wordpress.org/plugins/gmo-social-connection/" class="btn" target="_blank">Download</a></p>
				</div>
				<div class="plugins_detail_r">
					<h4>GMO Social Connection</h4>
					<p>GMO Social Connection let you easily place SNS share buttons on the articles. It also allows you to choose button position from top or bottom. Supported SNS are Facebook, Twitter and Google+.</p>
				</div>
			</div>


		</div>

	</div>


	<div class="quality">
		<h3>Quality Service</h3>
		<p class="lead">“Brought to you by Japan's leading one-stop provider of Internet services”</p>
		<p><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/more/footer_logo_gmo.png" alt="GMO INTERNET GROUP" ></p>
		<p>Z.com WordPress Hosting is operated by GMO Internet group, the number one provider of domain registration, web hosting, security, ecommerce and payment processing solutions in Japan.Under the corporate slogan "Internet for Everyone", GMO Internet Group's trusted service brand represents industry expertise, a proven track record and quality service.</p>
		<p><a href="http://www.gmo.jp/en/" target="_blank">> Visit GMO Internet Group</a></p>
	</div>

</div>

<?php
}
function kotenhanagara_admin_menu() {
	add_theme_page( 'Z.com WordPress Hosting', 'More', 'read','more', 'kotenhanagara_menu_more' );
}

add_action( 'admin_menu', 'kotenhanagara_admin_menu' );

//Dashboard
function kotenhanagara_dashboard_widget_function() {
?>
<a href="https://cloud.z.com/jp/en/wp/?utm_source=themes&utm_medium=dashboard&utm_campaign=themes_dashboard" target="_blank"><img src="<?php echo get_stylesheet_directory_uri() .'/images/zcom_wordpress_hosting.gif' ?>" style="width:100%"></a>
<?php
}
function kotenhanagara_add_dashboard_widgets() {
wp_add_dashboard_widget('kotenhanagara_dashboard_widget', 'Z.com WordPress Hosting', 'kotenhanagara_dashboard_widget_function');
global $wp_meta_boxes;
$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
$example_widget_backup = array('kotenhanagara_dashboard_widget' => $normal_dashboard['kotenhanagara_dashboard_widget']);
unset($normal_dashboard['kotenhanagara_dashboard_widget']);
$sorted_dashboard = array_merge($example_widget_backup, $normal_dashboard);
$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action('wp_dashboard_setup', 'kotenhanagara_add_dashboard_widgets' );