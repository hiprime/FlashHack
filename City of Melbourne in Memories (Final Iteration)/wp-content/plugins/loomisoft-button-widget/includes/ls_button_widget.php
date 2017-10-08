<?php
/**
 * Button Widget Plugin by Loomisoft - ls_button_widget Class
 * Author: Loomisoft
 * Date: 28/10/2016
 * Time: 17:00
 */

defined( 'LS_BW_PLUGIN_PATH' ) or die();

class ls_button_widget extends WP_Widget {

	var $form_fields = array(
		'button-text'            => array(
			'type'    => 'text',
			'label'   => 'Button Text',
			'default' => ''
		),
		'link-address'           => array(
			'type'    => 'text',
			'label'   => 'Link URL',
			'default' => ''
		),
		'new-window'             => array(
			'type'    => 'checkbox',
			'label'   => 'Open in New Window',
			'default' => ''
		),
		'alignment'              => array(
			'type'    => 'select',
			'label'   => 'Button Alignment',
			'note'    => 'Within containing area',
			'options' => array(
				'full'   => 'Full Width',
				'center' => 'Center',
				'left'   => 'Left',
				'right'  => 'Right'
			),
			'default' => 'center',
		),
		'font-family'            => array(
			'type'    => 'select',
			'label'   => 'Text Font Family',
			'note'    => 'Leave blank for theme default',
			'options' => array(),
			'default' => ''
		),
		'font-size'              => array(
			'type'    => 'pixels',
			'label'   => 'Text Font Size',
			'note'    => 'In pixels (no "px" needed) / leave blank for theme default',
			'default' => ''
		),
		'line-height'            => array(
			'type'    => 'pixels',
			'label'   => 'Text Line Height',
			'note'    => 'In pixels (no "px" needed) / leave blank for 1.3em',
			'default' => ''
		),
		'color'                  => array(
			'type'    => 'color',
			'label'   => 'Text Color',
			'note'    => 'Leave blank for white',
			'default' => ''
			// #ffffff
		),
		'hover-color'            => array(
			'type'    => 'color',
			'label'   => 'Text Hover Color',
			'note'    => 'Leave blank for white',
			'default' => ''
			// #ffffff
		),
		'bold'                   => array(
			'type'    => 'checkbox',
			'label'   => 'Text Bold',
			'default' => ''
		),
		'hover-bold'             => array(
			'type'    => 'checkbox',
			'label'   => 'Text Hover Bold',
			'default' => ''
		),
		'italic'                 => array(
			'type'    => 'checkbox',
			'label'   => 'Text Italic',
			'default' => ''
		),
		'hover-italic'           => array(
			'type'    => 'checkbox',
			'label'   => 'Text Hover Italic',
			'default' => ''
		),
		'underline'              => array(
			'type'    => 'checkbox',
			'label'   => 'Text Underline',
			'default' => ''
		),
		'hover-underline'        => array(
			'type'    => 'checkbox',
			'label'   => 'Text Hover Underline',
			'default' => ''
		),
		'background-color'       => array(
			'type'    => 'color',
			'label'   => 'Background Color',
			'note'    => 'Leave blank for light blue',
			'default' => ''
			// #3ebcc2
		),
		'background-hover-color' => array(
			'type'    => 'color',
			'label'   => 'Background Hover Color',
			'note'    => 'Leave blank for dark blue',
			'default' => ''
			// #17675a
		),
		'border-width'           => array(
			'type'    => 'pixels',
			'label'   => 'Border Width',
			'note'    => 'In pixels (no "px" needed) / leave blank for none',
			'default' => ''
		),
		'border-color'           => array(
			'type'    => 'color',
			'label'   => 'Border Color',
			'note'    => 'Applied when width set / leave blank for dark blue',
			'default' => ''
			// #17675a
		),
		'border-hover-color'     => array(
			'type'    => 'color',
			'label'   => 'Border Hover Color',
			'note'    => 'Applied when width set / leave blank for dark blue',
			'default' => ''
			// #17675a
		),
		'border-radius'          => array(
			'type'    => 'pixels',
			'label'   => 'Corner (Border) Radius',
			'note'    => 'In pixels (no "px" needed) / leave blank or 0 for square borders',
			'default' => ''
		),
		'vertical-padding'       => array(
			'type'    => 'pixels',
			'label'   => 'Top/Bottom Padding',
			'note'    => 'In pixels (no "px" needed) / leave blank for 10 pixels',
			'default' => ''
		),
		'horizontal-padding'     => array(
			'type'    => 'pixels',
			'label'   => 'Left/Right Padding',
			'note'    => 'In pixels (no "px" needed) / leave blank for 5 pixels',
			'default' => ''
		),
		'top-margin'             => array(
			'type'           => 'pixels',
			'allow-negative' => true,
			'label'          => 'Top Margin',
			'note'           => 'In pixels (no "px" needed) / may be negative / leave blank for 10 pixels',
			'default'        => ''
		),
		'bottom-margin'          => array(
			'type'           => 'pixels',
			'allow-negative' => true,
			'label'          => 'Bottom Margin',
			'note'           => 'In pixels (no "px" needed) / may be negative / leave blank for 10 pixels',
			'default'        => ''
		),
		'horizontal-margin'      => array(
			'type'    => 'pixels',
			'label'   => 'Left/Right Margin',
			'note'    => 'In pixels (no "px" needed) / leave blank for 0 pixels',
			'default' => ''
		)
	);

	var $fonts = array(
		'---group-1---'                 => 'Standard Fonts',
		'standard-font-arial'           => array(
			'family'   => 'Arial, Helvetica, sans-serif',
			'category' => ''
		),
		'standard-font-verdana'         => array(
			'family'   => 'Verdana, Geneva, sans-serif',
			'category' => ''
		),
		'standard-font-tahoma'          => array(
			'family'   => 'Tahoma, Geneva, sans-serif',
			'category' => ''
		),
		'standard-font-trebuchet-ms'    => array(
			'family'   => '"Trebuchet MS", Helvetica, sans-serif',
			'category' => ''
		),
		'standard-font-times-new-roman' => array(
			'family'   => '"Times New Roman", Times, serif',
			'category' => ''
		),
		'standard-font-georgia'         => array(
			'family'   => 'Georgia, serif',
			'category' => ''
		),
		'---group-2---'                 => 'Google Fonts',
		'abeezee'                       => array(
			'family'   => 'ABeeZee',
			'category' => 'sans-serif'
		),
		'abel'                          => array(
			'family'   => 'Abel',
			'category' => 'sans-serif'
		),
		'abhaya-libre'                  => array(
			'family'   => 'Abhaya Libre',
			'category' => 'serif'
		),
		'abril-fatface'                 => array(
			'family'   => 'Abril Fatface',
			'category' => 'display'
		),
		'aclonica'                      => array(
			'family'   => 'Aclonica',
			'category' => 'sans-serif'
		),
		'acme'                          => array(
			'family'   => 'Acme',
			'category' => 'sans-serif'
		),
		'actor'                         => array(
			'family'   => 'Actor',
			'category' => 'sans-serif'
		),
		'adamina'                       => array(
			'family'   => 'Adamina',
			'category' => 'serif'
		),
		'advent-pro'                    => array(
			'family'   => 'Advent Pro',
			'category' => 'sans-serif'
		),
		'aguafina-script'               => array(
			'family'   => 'Aguafina Script',
			'category' => 'handwriting'
		),
		'akronim'                       => array(
			'family'   => 'Akronim',
			'category' => 'display'
		),
		'aladin'                        => array(
			'family'   => 'Aladin',
			'category' => 'handwriting'
		),
		'aldrich'                       => array(
			'family'   => 'Aldrich',
			'category' => 'sans-serif'
		),
		'alef'                          => array(
			'family'   => 'Alef',
			'category' => 'sans-serif'
		),
		'alegreya'                      => array(
			'family'   => 'Alegreya',
			'category' => 'serif'
		),
		'alegreya-sc'                   => array(
			'family'   => 'Alegreya SC',
			'category' => 'serif'
		),
		'alegreya-sans'                 => array(
			'family'   => 'Alegreya Sans',
			'category' => 'sans-serif'
		),
		'alegreya-sans-sc'              => array(
			'family'   => 'Alegreya Sans SC',
			'category' => 'sans-serif'
		),
		'alex-brush'                    => array(
			'family'   => 'Alex Brush',
			'category' => 'handwriting'
		),
		'alfa-slab-one'                 => array(
			'family'   => 'Alfa Slab One',
			'category' => 'display'
		),
		'alice'                         => array(
			'family'   => 'Alice',
			'category' => 'serif'
		),
		'alike'                         => array(
			'family'   => 'Alike',
			'category' => 'serif'
		),
		'alike-angular'                 => array(
			'family'   => 'Alike Angular',
			'category' => 'serif'
		),
		'allan'                         => array(
			'family'   => 'Allan',
			'category' => 'display'
		),
		'allerta'                       => array(
			'family'   => 'Allerta',
			'category' => 'sans-serif'
		),
		'allerta-stencil'               => array(
			'family'   => 'Allerta Stencil',
			'category' => 'sans-serif'
		),
		'allura'                        => array(
			'family'   => 'Allura',
			'category' => 'handwriting'
		),
		'almendra'                      => array(
			'family'   => 'Almendra',
			'category' => 'serif'
		),
		'almendra-display'              => array(
			'family'   => 'Almendra Display',
			'category' => 'display'
		),
		'almendra-sc'                   => array(
			'family'   => 'Almendra SC',
			'category' => 'serif'
		),
		'amarante'                      => array(
			'family'   => 'Amarante',
			'category' => 'display'
		),
		'amaranth'                      => array(
			'family'   => 'Amaranth',
			'category' => 'sans-serif'
		),
		'amatic-sc'                     => array(
			'family'   => 'Amatic SC',
			'category' => 'handwriting'
		),
		'amatica-sc'                    => array(
			'family'   => 'Amatica SC',
			'category' => 'display'
		),
		'amethysta'                     => array(
			'family'   => 'Amethysta',
			'category' => 'serif'
		),
		'amiko'                         => array(
			'family'   => 'Amiko',
			'category' => 'sans-serif'
		),
		'amiri'                         => array(
			'family'   => 'Amiri',
			'category' => 'serif'
		),
		'amita'                         => array(
			'family'   => 'Amita',
			'category' => 'handwriting'
		),
		'anaheim'                       => array(
			'family'   => 'Anaheim',
			'category' => 'sans-serif'
		),
		'andada'                        => array(
			'family'   => 'Andada',
			'category' => 'serif'
		),
		'andika'                        => array(
			'family'   => 'Andika',
			'category' => 'sans-serif'
		),
		'angkor'                        => array(
			'family'   => 'Angkor',
			'category' => 'display'
		),
		'annie-use-your-telescope'      => array(
			'family'   => 'Annie Use Your Telescope',
			'category' => 'handwriting'
		),
		'anonymous-pro'                 => array(
			'family'   => 'Anonymous Pro',
			'category' => 'monospace'
		),
		'antic'                         => array(
			'family'   => 'Antic',
			'category' => 'sans-serif'
		),
		'antic-didone'                  => array(
			'family'   => 'Antic Didone',
			'category' => 'serif'
		),
		'antic-slab'                    => array(
			'family'   => 'Antic Slab',
			'category' => 'serif'
		),
		'anton'                         => array(
			'family'   => 'Anton',
			'category' => 'sans-serif'
		),
		'arapey'                        => array(
			'family'   => 'Arapey',
			'category' => 'serif'
		),
		'arbutus'                       => array(
			'family'   => 'Arbutus',
			'category' => 'display'
		),
		'arbutus-slab'                  => array(
			'family'   => 'Arbutus Slab',
			'category' => 'serif'
		),
		'architects-daughter'           => array(
			'family'   => 'Architects Daughter',
			'category' => 'handwriting'
		),
		'archivo-black'                 => array(
			'family'   => 'Archivo Black',
			'category' => 'sans-serif'
		),
		'archivo-narrow'                => array(
			'family'   => 'Archivo Narrow',
			'category' => 'sans-serif'
		),
		'aref-ruqaa'                    => array(
			'family'   => 'Aref Ruqaa',
			'category' => 'serif'
		),
		'arima-madurai'                 => array(
			'family'   => 'Arima Madurai',
			'category' => 'display'
		),
		'arimo'                         => array(
			'family'   => 'Arimo',
			'category' => 'sans-serif'
		),
		'arizonia'                      => array(
			'family'   => 'Arizonia',
			'category' => 'handwriting'
		),
		'armata'                        => array(
			'family'   => 'Armata',
			'category' => 'sans-serif'
		),
		'artifika'                      => array(
			'family'   => 'Artifika',
			'category' => 'serif'
		),
		'arvo'                          => array(
			'family'   => 'Arvo',
			'category' => 'serif'
		),
		'arya'                          => array(
			'family'   => 'Arya',
			'category' => 'sans-serif'
		),
		'asap'                          => array(
			'family'   => 'Asap',
			'category' => 'sans-serif'
		),
		'asar'                          => array(
			'family'   => 'Asar',
			'category' => 'serif'
		),
		'asset'                         => array(
			'family'   => 'Asset',
			'category' => 'display'
		),
		'assistant'                     => array(
			'family'   => 'Assistant',
			'category' => 'sans-serif'
		),
		'astloch'                       => array(
			'family'   => 'Astloch',
			'category' => 'display'
		),
		'asul'                          => array(
			'family'   => 'Asul',
			'category' => 'sans-serif'
		),
		'athiti'                        => array(
			'family'   => 'Athiti',
			'category' => 'sans-serif'
		),
		'atma'                          => array(
			'family'   => 'Atma',
			'category' => 'display'
		),
		'atomic-age'                    => array(
			'family'   => 'Atomic Age',
			'category' => 'display'
		),
		'aubrey'                        => array(
			'family'   => 'Aubrey',
			'category' => 'display'
		),
		'audiowide'                     => array(
			'family'   => 'Audiowide',
			'category' => 'display'
		),
		'autour-one'                    => array(
			'family'   => 'Autour One',
			'category' => 'display'
		),
		'average'                       => array(
			'family'   => 'Average',
			'category' => 'serif'
		),
		'average-sans'                  => array(
			'family'   => 'Average Sans',
			'category' => 'sans-serif'
		),
		'averia-gruesa-libre'           => array(
			'family'   => 'Averia Gruesa Libre',
			'category' => 'display'
		),
		'averia-libre'                  => array(
			'family'   => 'Averia Libre',
			'category' => 'display'
		),
		'averia-sans-libre'             => array(
			'family'   => 'Averia Sans Libre',
			'category' => 'display'
		),
		'averia-serif-libre'            => array(
			'family'   => 'Averia Serif Libre',
			'category' => 'display'
		),
		'bad-script'                    => array(
			'family'   => 'Bad Script',
			'category' => 'handwriting'
		),
		'baloo'                         => array(
			'family'   => 'Baloo',
			'category' => 'display'
		),
		'baloo-bhai'                    => array(
			'family'   => 'Baloo Bhai',
			'category' => 'display'
		),
		'baloo-bhaina'                  => array(
			'family'   => 'Baloo Bhaina',
			'category' => 'display'
		),
		'baloo-chettan'                 => array(
			'family'   => 'Baloo Chettan',
			'category' => 'display'
		),
		'baloo-da'                      => array(
			'family'   => 'Baloo Da',
			'category' => 'display'
		),
		'baloo-paaji'                   => array(
			'family'   => 'Baloo Paaji',
			'category' => 'display'
		),
		'baloo-tamma'                   => array(
			'family'   => 'Baloo Tamma',
			'category' => 'display'
		),
		'baloo-thambi'                  => array(
			'family'   => 'Baloo Thambi',
			'category' => 'display'
		),
		'balthazar'                     => array(
			'family'   => 'Balthazar',
			'category' => 'serif'
		),
		'bangers'                       => array(
			'family'   => 'Bangers',
			'category' => 'display'
		),
		'basic'                         => array(
			'family'   => 'Basic',
			'category' => 'sans-serif'
		),
		'battambang'                    => array(
			'family'   => 'Battambang',
			'category' => 'display'
		),
		'baumans'                       => array(
			'family'   => 'Baumans',
			'category' => 'display'
		),
		'bayon'                         => array(
			'family'   => 'Bayon',
			'category' => 'display'
		),
		'belgrano'                      => array(
			'family'   => 'Belgrano',
			'category' => 'serif'
		),
		'belleza'                       => array(
			'family'   => 'Belleza',
			'category' => 'sans-serif'
		),
		'benchnine'                     => array(
			'family'   => 'BenchNine',
			'category' => 'sans-serif'
		),
		'bentham'                       => array(
			'family'   => 'Bentham',
			'category' => 'serif'
		),
		'berkshire-swash'               => array(
			'family'   => 'Berkshire Swash',
			'category' => 'handwriting'
		),
		'bevan'                         => array(
			'family'   => 'Bevan',
			'category' => 'display'
		),
		'bigelow-rules'                 => array(
			'family'   => 'Bigelow Rules',
			'category' => 'display'
		),
		'bigshot-one'                   => array(
			'family'   => 'Bigshot One',
			'category' => 'display'
		),
		'bilbo'                         => array(
			'family'   => 'Bilbo',
			'category' => 'handwriting'
		),
		'bilbo-swash-caps'              => array(
			'family'   => 'Bilbo Swash Caps',
			'category' => 'handwriting'
		),
		'biorhyme'                      => array(
			'family'   => 'BioRhyme',
			'category' => 'serif'
		),
		'biorhyme-expanded'             => array(
			'family'   => 'BioRhyme Expanded',
			'category' => 'serif'
		),
		'biryani'                       => array(
			'family'   => 'Biryani',
			'category' => 'sans-serif'
		),
		'bitter'                        => array(
			'family'   => 'Bitter',
			'category' => 'serif'
		),
		'black-ops-one'                 => array(
			'family'   => 'Black Ops One',
			'category' => 'display'
		),
		'bokor'                         => array(
			'family'   => 'Bokor',
			'category' => 'display'
		),
		'bonbon'                        => array(
			'family'   => 'Bonbon',
			'category' => 'handwriting'
		),
		'boogaloo'                      => array(
			'family'   => 'Boogaloo',
			'category' => 'display'
		),
		'bowlby-one'                    => array(
			'family'   => 'Bowlby One',
			'category' => 'display'
		),
		'bowlby-one-sc'                 => array(
			'family'   => 'Bowlby One SC',
			'category' => 'display'
		),
		'brawler'                       => array(
			'family'   => 'Brawler',
			'category' => 'serif'
		),
		'bree-serif'                    => array(
			'family'   => 'Bree Serif',
			'category' => 'serif'
		),
		'bubblegum-sans'                => array(
			'family'   => 'Bubblegum Sans',
			'category' => 'display'
		),
		'bubbler-one'                   => array(
			'family'   => 'Bubbler One',
			'category' => 'sans-serif'
		),
		'buda'                          => array(
			'family'   => 'Buda',
			'category' => 'display'
		),
		'buenard'                       => array(
			'family'   => 'Buenard',
			'category' => 'serif'
		),
		'bungee'                        => array(
			'family'   => 'Bungee',
			'category' => 'display'
		),
		'bungee-hairline'               => array(
			'family'   => 'Bungee Hairline',
			'category' => 'display'
		),
		'bungee-inline'                 => array(
			'family'   => 'Bungee Inline',
			'category' => 'display'
		),
		'bungee-outline'                => array(
			'family'   => 'Bungee Outline',
			'category' => 'display'
		),
		'bungee-shade'                  => array(
			'family'   => 'Bungee Shade',
			'category' => 'display'
		),
		'butcherman'                    => array(
			'family'   => 'Butcherman',
			'category' => 'display'
		),
		'butterfly-kids'                => array(
			'family'   => 'Butterfly Kids',
			'category' => 'handwriting'
		),
		'cabin'                         => array(
			'family'   => 'Cabin',
			'category' => 'sans-serif'
		),
		'cabin-condensed'               => array(
			'family'   => 'Cabin Condensed',
			'category' => 'sans-serif'
		),
		'cabin-sketch'                  => array(
			'family'   => 'Cabin Sketch',
			'category' => 'display'
		),
		'caesar-dressing'               => array(
			'family'   => 'Caesar Dressing',
			'category' => 'display'
		),
		'cagliostro'                    => array(
			'family'   => 'Cagliostro',
			'category' => 'sans-serif'
		),
		'cairo'                         => array(
			'family'   => 'Cairo',
			'category' => 'sans-serif'
		),
		'calligraffitti'                => array(
			'family'   => 'Calligraffitti',
			'category' => 'handwriting'
		),
		'cambay'                        => array(
			'family'   => 'Cambay',
			'category' => 'sans-serif'
		),
		'cambo'                         => array(
			'family'   => 'Cambo',
			'category' => 'serif'
		),
		'candal'                        => array(
			'family'   => 'Candal',
			'category' => 'sans-serif'
		),
		'cantarell'                     => array(
			'family'   => 'Cantarell',
			'category' => 'sans-serif'
		),
		'cantata-one'                   => array(
			'family'   => 'Cantata One',
			'category' => 'serif'
		),
		'cantora-one'                   => array(
			'family'   => 'Cantora One',
			'category' => 'sans-serif'
		),
		'capriola'                      => array(
			'family'   => 'Capriola',
			'category' => 'sans-serif'
		),
		'cardo'                         => array(
			'family'   => 'Cardo',
			'category' => 'serif'
		),
		'carme'                         => array(
			'family'   => 'Carme',
			'category' => 'sans-serif'
		),
		'carrois-gothic'                => array(
			'family'   => 'Carrois Gothic',
			'category' => 'sans-serif'
		),
		'carrois-gothic-sc'             => array(
			'family'   => 'Carrois Gothic SC',
			'category' => 'sans-serif'
		),
		'carter-one'                    => array(
			'family'   => 'Carter One',
			'category' => 'display'
		),
		'catamaran'                     => array(
			'family'   => 'Catamaran',
			'category' => 'sans-serif'
		),
		'caudex'                        => array(
			'family'   => 'Caudex',
			'category' => 'serif'
		),
		'caveat'                        => array(
			'family'   => 'Caveat',
			'category' => 'handwriting'
		),
		'caveat-brush'                  => array(
			'family'   => 'Caveat Brush',
			'category' => 'handwriting'
		),
		'cedarville-cursive'            => array(
			'family'   => 'Cedarville Cursive',
			'category' => 'handwriting'
		),
		'ceviche-one'                   => array(
			'family'   => 'Ceviche One',
			'category' => 'display'
		),
		'changa'                        => array(
			'family'   => 'Changa',
			'category' => 'sans-serif'
		),
		'changa-one'                    => array(
			'family'   => 'Changa One',
			'category' => 'display'
		),
		'chango'                        => array(
			'family'   => 'Chango',
			'category' => 'display'
		),
		'chathura'                      => array(
			'family'   => 'Chathura',
			'category' => 'sans-serif'
		),
		'chau-philomene-one'            => array(
			'family'   => 'Chau Philomene One',
			'category' => 'sans-serif'
		),
		'chela-one'                     => array(
			'family'   => 'Chela One',
			'category' => 'display'
		),
		'chelsea-market'                => array(
			'family'   => 'Chelsea Market',
			'category' => 'display'
		),
		'chenla'                        => array(
			'family'   => 'Chenla',
			'category' => 'display'
		),
		'cherry-cream-soda'             => array(
			'family'   => 'Cherry Cream Soda',
			'category' => 'display'
		),
		'cherry-swash'                  => array(
			'family'   => 'Cherry Swash',
			'category' => 'display'
		),
		'chewy'                         => array(
			'family'   => 'Chewy',
			'category' => 'display'
		),
		'chicle'                        => array(
			'family'   => 'Chicle',
			'category' => 'display'
		),
		'chivo'                         => array(
			'family'   => 'Chivo',
			'category' => 'sans-serif'
		),
		'chonburi'                      => array(
			'family'   => 'Chonburi',
			'category' => 'display'
		),
		'cinzel'                        => array(
			'family'   => 'Cinzel',
			'category' => 'serif'
		),
		'cinzel-decorative'             => array(
			'family'   => 'Cinzel Decorative',
			'category' => 'display'
		),
		'clicker-script'                => array(
			'family'   => 'Clicker Script',
			'category' => 'handwriting'
		),
		'coda'                          => array(
			'family'   => 'Coda',
			'category' => 'display'
		),
		'coda-caption'                  => array(
			'family'   => 'Coda Caption',
			'category' => 'sans-serif'
		),
		'codystar'                      => array(
			'family'   => 'Codystar',
			'category' => 'display'
		),
		'coiny'                         => array(
			'family'   => 'Coiny',
			'category' => 'display'
		),
		'combo'                         => array(
			'family'   => 'Combo',
			'category' => 'display'
		),
		'comfortaa'                     => array(
			'family'   => 'Comfortaa',
			'category' => 'display'
		),
		'coming-soon'                   => array(
			'family'   => 'Coming Soon',
			'category' => 'handwriting'
		),
		'concert-one'                   => array(
			'family'   => 'Concert One',
			'category' => 'display'
		),
		'condiment'                     => array(
			'family'   => 'Condiment',
			'category' => 'handwriting'
		),
		'content'                       => array(
			'family'   => 'Content',
			'category' => 'display'
		),
		'contrail-one'                  => array(
			'family'   => 'Contrail One',
			'category' => 'display'
		),
		'convergence'                   => array(
			'family'   => 'Convergence',
			'category' => 'sans-serif'
		),
		'cookie'                        => array(
			'family'   => 'Cookie',
			'category' => 'handwriting'
		),
		'copse'                         => array(
			'family'   => 'Copse',
			'category' => 'serif'
		),
		'corben'                        => array(
			'family'   => 'Corben',
			'category' => 'display'
		),
		'cormorant'                     => array(
			'family'   => 'Cormorant',
			'category' => 'serif'
		),
		'cormorant-garamond'            => array(
			'family'   => 'Cormorant Garamond',
			'category' => 'serif'
		),
		'cormorant-infant'              => array(
			'family'   => 'Cormorant Infant',
			'category' => 'serif'
		),
		'cormorant-sc'                  => array(
			'family'   => 'Cormorant SC',
			'category' => 'serif'
		),
		'cormorant-unicase'             => array(
			'family'   => 'Cormorant Unicase',
			'category' => 'serif'
		),
		'cormorant-upright'             => array(
			'family'   => 'Cormorant Upright',
			'category' => 'serif'
		),
		'courgette'                     => array(
			'family'   => 'Courgette',
			'category' => 'handwriting'
		),
		'cousine'                       => array(
			'family'   => 'Cousine',
			'category' => 'monospace'
		),
		'coustard'                      => array(
			'family'   => 'Coustard',
			'category' => 'serif'
		),
		'covered-by-your-grace'         => array(
			'family'   => 'Covered By Your Grace',
			'category' => 'handwriting'
		),
		'crafty-girls'                  => array(
			'family'   => 'Crafty Girls',
			'category' => 'handwriting'
		),
		'creepster'                     => array(
			'family'   => 'Creepster',
			'category' => 'display'
		),
		'crete-round'                   => array(
			'family'   => 'Crete Round',
			'category' => 'serif'
		),
		'crimson-text'                  => array(
			'family'   => 'Crimson Text',
			'category' => 'serif'
		),
		'croissant-one'                 => array(
			'family'   => 'Croissant One',
			'category' => 'display'
		),
		'crushed'                       => array(
			'family'   => 'Crushed',
			'category' => 'display'
		),
		'cuprum'                        => array(
			'family'   => 'Cuprum',
			'category' => 'sans-serif'
		),
		'cutive'                        => array(
			'family'   => 'Cutive',
			'category' => 'serif'
		),
		'cutive-mono'                   => array(
			'family'   => 'Cutive Mono',
			'category' => 'monospace'
		),
		'damion'                        => array(
			'family'   => 'Damion',
			'category' => 'handwriting'
		),
		'dancing-script'                => array(
			'family'   => 'Dancing Script',
			'category' => 'handwriting'
		),
		'dangrek'                       => array(
			'family'   => 'Dangrek',
			'category' => 'display'
		),
		'david-libre'                   => array(
			'family'   => 'David Libre',
			'category' => 'serif'
		),
		'dawning-of-a-new-day'          => array(
			'family'   => 'Dawning of a New Day',
			'category' => 'handwriting'
		),
		'days-one'                      => array(
			'family'   => 'Days One',
			'category' => 'sans-serif'
		),
		'dekko'                         => array(
			'family'   => 'Dekko',
			'category' => 'handwriting'
		),
		'delius'                        => array(
			'family'   => 'Delius',
			'category' => 'handwriting'
		),
		'delius-swash-caps'             => array(
			'family'   => 'Delius Swash Caps',
			'category' => 'handwriting'
		),
		'delius-unicase'                => array(
			'family'   => 'Delius Unicase',
			'category' => 'handwriting'
		),
		'della-respira'                 => array(
			'family'   => 'Della Respira',
			'category' => 'serif'
		),
		'denk-one'                      => array(
			'family'   => 'Denk One',
			'category' => 'sans-serif'
		),
		'devonshire'                    => array(
			'family'   => 'Devonshire',
			'category' => 'handwriting'
		),
		'dhurjati'                      => array(
			'family'   => 'Dhurjati',
			'category' => 'sans-serif'
		),
		'didact-gothic'                 => array(
			'family'   => 'Didact Gothic',
			'category' => 'sans-serif'
		),
		'diplomata'                     => array(
			'family'   => 'Diplomata',
			'category' => 'display'
		),
		'diplomata-sc'                  => array(
			'family'   => 'Diplomata SC',
			'category' => 'display'
		),
		'domine'                        => array(
			'family'   => 'Domine',
			'category' => 'serif'
		),
		'donegal-one'                   => array(
			'family'   => 'Donegal One',
			'category' => 'serif'
		),
		'doppio-one'                    => array(
			'family'   => 'Doppio One',
			'category' => 'sans-serif'
		),
		'dorsa'                         => array(
			'family'   => 'Dorsa',
			'category' => 'sans-serif'
		),
		'dosis'                         => array(
			'family'   => 'Dosis',
			'category' => 'sans-serif'
		),
		'dr-sugiyama'                   => array(
			'family'   => 'Dr Sugiyama',
			'category' => 'handwriting'
		),
		'droid-sans'                    => array(
			'family'   => 'Droid Sans',
			'category' => 'sans-serif'
		),
		'droid-sans-mono'               => array(
			'family'   => 'Droid Sans Mono',
			'category' => 'monospace'
		),
		'droid-serif'                   => array(
			'family'   => 'Droid Serif',
			'category' => 'serif'
		),
		'duru-sans'                     => array(
			'family'   => 'Duru Sans',
			'category' => 'sans-serif'
		),
		'dynalight'                     => array(
			'family'   => 'Dynalight',
			'category' => 'display'
		),
		'eb-garamond'                   => array(
			'family'   => 'EB Garamond',
			'category' => 'serif'
		),
		'eagle-lake'                    => array(
			'family'   => 'Eagle Lake',
			'category' => 'handwriting'
		),
		'eater'                         => array(
			'family'   => 'Eater',
			'category' => 'display'
		),
		'economica'                     => array(
			'family'   => 'Economica',
			'category' => 'sans-serif'
		),
		'eczar'                         => array(
			'family'   => 'Eczar',
			'category' => 'serif'
		),
		'ek-mukta'                      => array(
			'family'   => 'Ek Mukta',
			'category' => 'sans-serif'
		),
		'el-messiri'                    => array(
			'family'   => 'El Messiri',
			'category' => 'sans-serif'
		),
		'electrolize'                   => array(
			'family'   => 'Electrolize',
			'category' => 'sans-serif'
		),
		'elsie'                         => array(
			'family'   => 'Elsie',
			'category' => 'display'
		),
		'elsie-swash-caps'              => array(
			'family'   => 'Elsie Swash Caps',
			'category' => 'display'
		),
		'emblema-one'                   => array(
			'family'   => 'Emblema One',
			'category' => 'display'
		),
		'emilys-candy'                  => array(
			'family'   => 'Emilys Candy',
			'category' => 'display'
		),
		'engagement'                    => array(
			'family'   => 'Engagement',
			'category' => 'handwriting'
		),
		'englebert'                     => array(
			'family'   => 'Englebert',
			'category' => 'sans-serif'
		),
		'enriqueta'                     => array(
			'family'   => 'Enriqueta',
			'category' => 'serif'
		),
		'erica-one'                     => array(
			'family'   => 'Erica One',
			'category' => 'display'
		),
		'esteban'                       => array(
			'family'   => 'Esteban',
			'category' => 'serif'
		),
		'euphoria-script'               => array(
			'family'   => 'Euphoria Script',
			'category' => 'handwriting'
		),
		'ewert'                         => array(
			'family'   => 'Ewert',
			'category' => 'display'
		),
		'exo'                           => array(
			'family'   => 'Exo',
			'category' => 'sans-serif'
		),
		'exo-2'                         => array(
			'family'   => 'Exo 2',
			'category' => 'sans-serif'
		),
		'expletus-sans'                 => array(
			'family'   => 'Expletus Sans',
			'category' => 'display'
		),
		'fanwood-text'                  => array(
			'family'   => 'Fanwood Text',
			'category' => 'serif'
		),
		'farsan'                        => array(
			'family'   => 'Farsan',
			'category' => 'display'
		),
		'fascinate'                     => array(
			'family'   => 'Fascinate',
			'category' => 'display'
		),
		'fascinate-inline'              => array(
			'family'   => 'Fascinate Inline',
			'category' => 'display'
		),
		'faster-one'                    => array(
			'family'   => 'Faster One',
			'category' => 'display'
		),
		'fasthand'                      => array(
			'family'   => 'Fasthand',
			'category' => 'serif'
		),
		'fauna-one'                     => array(
			'family'   => 'Fauna One',
			'category' => 'serif'
		),
		'federant'                      => array(
			'family'   => 'Federant',
			'category' => 'display'
		),
		'federo'                        => array(
			'family'   => 'Federo',
			'category' => 'sans-serif'
		),
		'felipa'                        => array(
			'family'   => 'Felipa',
			'category' => 'handwriting'
		),
		'fenix'                         => array(
			'family'   => 'Fenix',
			'category' => 'serif'
		),
		'finger-paint'                  => array(
			'family'   => 'Finger Paint',
			'category' => 'display'
		),
		'fira-mono'                     => array(
			'family'   => 'Fira Mono',
			'category' => 'monospace'
		),
		'fira-sans'                     => array(
			'family'   => 'Fira Sans',
			'category' => 'sans-serif'
		),
		'fjalla-one'                    => array(
			'family'   => 'Fjalla One',
			'category' => 'sans-serif'
		),
		'fjord-one'                     => array(
			'family'   => 'Fjord One',
			'category' => 'serif'
		),
		'flamenco'                      => array(
			'family'   => 'Flamenco',
			'category' => 'display'
		),
		'flavors'                       => array(
			'family'   => 'Flavors',
			'category' => 'display'
		),
		'fondamento'                    => array(
			'family'   => 'Fondamento',
			'category' => 'handwriting'
		),
		'fontdiner-swanky'              => array(
			'family'   => 'Fontdiner Swanky',
			'category' => 'display'
		),
		'forum'                         => array(
			'family'   => 'Forum',
			'category' => 'display'
		),
		'francois-one'                  => array(
			'family'   => 'Francois One',
			'category' => 'sans-serif'
		),
		'frank-ruhl-libre'              => array(
			'family'   => 'Frank Ruhl Libre',
			'category' => 'sans-serif'
		),
		'freckle-face'                  => array(
			'family'   => 'Freckle Face',
			'category' => 'display'
		),
		'fredericka-the-great'          => array(
			'family'   => 'Fredericka the Great',
			'category' => 'display'
		),
		'fredoka-one'                   => array(
			'family'   => 'Fredoka One',
			'category' => 'display'
		),
		'freehand'                      => array(
			'family'   => 'Freehand',
			'category' => 'display'
		),
		'fresca'                        => array(
			'family'   => 'Fresca',
			'category' => 'sans-serif'
		),
		'frijole'                       => array(
			'family'   => 'Frijole',
			'category' => 'display'
		),
		'fruktur'                       => array(
			'family'   => 'Fruktur',
			'category' => 'display'
		),
		'fugaz-one'                     => array(
			'family'   => 'Fugaz One',
			'category' => 'display'
		),
		'gfs-didot'                     => array(
			'family'   => 'GFS Didot',
			'category' => 'serif'
		),
		'gfs-neohellenic'               => array(
			'family'   => 'GFS Neohellenic',
			'category' => 'sans-serif'
		),
		'gabriela'                      => array(
			'family'   => 'Gabriela',
			'category' => 'serif'
		),
		'gafata'                        => array(
			'family'   => 'Gafata',
			'category' => 'sans-serif'
		),
		'galada'                        => array(
			'family'   => 'Galada',
			'category' => 'display'
		),
		'galdeano'                      => array(
			'family'   => 'Galdeano',
			'category' => 'sans-serif'
		),
		'galindo'                       => array(
			'family'   => 'Galindo',
			'category' => 'display'
		),
		'gentium-basic'                 => array(
			'family'   => 'Gentium Basic',
			'category' => 'serif'
		),
		'gentium-book-basic'            => array(
			'family'   => 'Gentium Book Basic',
			'category' => 'serif'
		),
		'geo'                           => array(
			'family'   => 'Geo',
			'category' => 'sans-serif'
		),
		'geostar'                       => array(
			'family'   => 'Geostar',
			'category' => 'display'
		),
		'geostar-fill'                  => array(
			'family'   => 'Geostar Fill',
			'category' => 'display'
		),
		'germania-one'                  => array(
			'family'   => 'Germania One',
			'category' => 'display'
		),
		'gidugu'                        => array(
			'family'   => 'Gidugu',
			'category' => 'sans-serif'
		),
		'gilda-display'                 => array(
			'family'   => 'Gilda Display',
			'category' => 'serif'
		),
		'give-you-glory'                => array(
			'family'   => 'Give You Glory',
			'category' => 'handwriting'
		),
		'glass-antiqua'                 => array(
			'family'   => 'Glass Antiqua',
			'category' => 'display'
		),
		'glegoo'                        => array(
			'family'   => 'Glegoo',
			'category' => 'serif'
		),
		'gloria-hallelujah'             => array(
			'family'   => 'Gloria Hallelujah',
			'category' => 'handwriting'
		),
		'goblin-one'                    => array(
			'family'   => 'Goblin One',
			'category' => 'display'
		),
		'gochi-hand'                    => array(
			'family'   => 'Gochi Hand',
			'category' => 'handwriting'
		),
		'gorditas'                      => array(
			'family'   => 'Gorditas',
			'category' => 'display'
		),
		'goudy-bookletter-1911'         => array(
			'family'   => 'Goudy Bookletter 1911',
			'category' => 'serif'
		),
		'graduate'                      => array(
			'family'   => 'Graduate',
			'category' => 'display'
		),
		'grand-hotel'                   => array(
			'family'   => 'Grand Hotel',
			'category' => 'handwriting'
		),
		'gravitas-one'                  => array(
			'family'   => 'Gravitas One',
			'category' => 'display'
		),
		'great-vibes'                   => array(
			'family'   => 'Great Vibes',
			'category' => 'handwriting'
		),
		'griffy'                        => array(
			'family'   => 'Griffy',
			'category' => 'display'
		),
		'gruppo'                        => array(
			'family'   => 'Gruppo',
			'category' => 'display'
		),
		'gudea'                         => array(
			'family'   => 'Gudea',
			'category' => 'sans-serif'
		),
		'gurajada'                      => array(
			'family'   => 'Gurajada',
			'category' => 'serif'
		),
		'habibi'                        => array(
			'family'   => 'Habibi',
			'category' => 'serif'
		),
		'halant'                        => array(
			'family'   => 'Halant',
			'category' => 'serif'
		),
		'hammersmith-one'               => array(
			'family'   => 'Hammersmith One',
			'category' => 'sans-serif'
		),
		'hanalei'                       => array(
			'family'   => 'Hanalei',
			'category' => 'display'
		),
		'hanalei-fill'                  => array(
			'family'   => 'Hanalei Fill',
			'category' => 'display'
		),
		'handlee'                       => array(
			'family'   => 'Handlee',
			'category' => 'handwriting'
		),
		'hanuman'                       => array(
			'family'   => 'Hanuman',
			'category' => 'serif'
		),
		'happy-monkey'                  => array(
			'family'   => 'Happy Monkey',
			'category' => 'display'
		),
		'harmattan'                     => array(
			'family'   => 'Harmattan',
			'category' => 'sans-serif'
		),
		'headland-one'                  => array(
			'family'   => 'Headland One',
			'category' => 'serif'
		),
		'heebo'                         => array(
			'family'   => 'Heebo',
			'category' => 'sans-serif'
		),
		'henny-penny'                   => array(
			'family'   => 'Henny Penny',
			'category' => 'display'
		),
		'herr-von-muellerhoff'          => array(
			'family'   => 'Herr Von Muellerhoff',
			'category' => 'handwriting'
		),
		'hind'                          => array(
			'family'   => 'Hind',
			'category' => 'sans-serif'
		),
		'hind-guntur'                   => array(
			'family'   => 'Hind Guntur',
			'category' => 'sans-serif'
		),
		'hind-madurai'                  => array(
			'family'   => 'Hind Madurai',
			'category' => 'sans-serif'
		),
		'hind-siliguri'                 => array(
			'family'   => 'Hind Siliguri',
			'category' => 'sans-serif'
		),
		'hind-vadodara'                 => array(
			'family'   => 'Hind Vadodara',
			'category' => 'sans-serif'
		),
		'holtwood-one-sc'               => array(
			'family'   => 'Holtwood One SC',
			'category' => 'serif'
		),
		'homemade-apple'                => array(
			'family'   => 'Homemade Apple',
			'category' => 'handwriting'
		),
		'homenaje'                      => array(
			'family'   => 'Homenaje',
			'category' => 'sans-serif'
		),
		'im-fell-dw-pica'               => array(
			'family'   => 'IM Fell DW Pica',
			'category' => 'serif'
		),
		'im-fell-dw-pica-sc'            => array(
			'family'   => 'IM Fell DW Pica SC',
			'category' => 'serif'
		),
		'im-fell-double-pica'           => array(
			'family'   => 'IM Fell Double Pica',
			'category' => 'serif'
		),
		'im-fell-double-pica-sc'        => array(
			'family'   => 'IM Fell Double Pica SC',
			'category' => 'serif'
		),
		'im-fell-english'               => array(
			'family'   => 'IM Fell English',
			'category' => 'serif'
		),
		'im-fell-english-sc'            => array(
			'family'   => 'IM Fell English SC',
			'category' => 'serif'
		),
		'im-fell-french-canon'          => array(
			'family'   => 'IM Fell French Canon',
			'category' => 'serif'
		),
		'im-fell-french-canon-sc'       => array(
			'family'   => 'IM Fell French Canon SC',
			'category' => 'serif'
		),
		'im-fell-great-primer'          => array(
			'family'   => 'IM Fell Great Primer',
			'category' => 'serif'
		),
		'im-fell-great-primer-sc'       => array(
			'family'   => 'IM Fell Great Primer SC',
			'category' => 'serif'
		),
		'iceberg'                       => array(
			'family'   => 'Iceberg',
			'category' => 'display'
		),
		'iceland'                       => array(
			'family'   => 'Iceland',
			'category' => 'display'
		),
		'imprima'                       => array(
			'family'   => 'Imprima',
			'category' => 'sans-serif'
		),
		'inconsolata'                   => array(
			'family'   => 'Inconsolata',
			'category' => 'monospace'
		),
		'inder'                         => array(
			'family'   => 'Inder',
			'category' => 'sans-serif'
		),
		'indie-flower'                  => array(
			'family'   => 'Indie Flower',
			'category' => 'handwriting'
		),
		'inika'                         => array(
			'family'   => 'Inika',
			'category' => 'serif'
		),
		'inknut-antiqua'                => array(
			'family'   => 'Inknut Antiqua',
			'category' => 'serif'
		),
		'irish-grover'                  => array(
			'family'   => 'Irish Grover',
			'category' => 'display'
		),
		'istok-web'                     => array(
			'family'   => 'Istok Web',
			'category' => 'sans-serif'
		),
		'italiana'                      => array(
			'family'   => 'Italiana',
			'category' => 'serif'
		),
		'italianno'                     => array(
			'family'   => 'Italianno',
			'category' => 'handwriting'
		),
		'itim'                          => array(
			'family'   => 'Itim',
			'category' => 'handwriting'
		),
		'jacques-francois'              => array(
			'family'   => 'Jacques Francois',
			'category' => 'serif'
		),
		'jacques-francois-shadow'       => array(
			'family'   => 'Jacques Francois Shadow',
			'category' => 'display'
		),
		'jaldi'                         => array(
			'family'   => 'Jaldi',
			'category' => 'sans-serif'
		),
		'jim-nightshade'                => array(
			'family'   => 'Jim Nightshade',
			'category' => 'handwriting'
		),
		'jockey-one'                    => array(
			'family'   => 'Jockey One',
			'category' => 'sans-serif'
		),
		'jolly-lodger'                  => array(
			'family'   => 'Jolly Lodger',
			'category' => 'display'
		),
		'jomhuria'                      => array(
			'family'   => 'Jomhuria',
			'category' => 'display'
		),
		'josefin-sans'                  => array(
			'family'   => 'Josefin Sans',
			'category' => 'sans-serif'
		),
		'josefin-slab'                  => array(
			'family'   => 'Josefin Slab',
			'category' => 'serif'
		),
		'joti-one'                      => array(
			'family'   => 'Joti One',
			'category' => 'display'
		),
		'judson'                        => array(
			'family'   => 'Judson',
			'category' => 'serif'
		),
		'julee'                         => array(
			'family'   => 'Julee',
			'category' => 'handwriting'
		),
		'julius-sans-one'               => array(
			'family'   => 'Julius Sans One',
			'category' => 'sans-serif'
		),
		'junge'                         => array(
			'family'   => 'Junge',
			'category' => 'serif'
		),
		'jura'                          => array(
			'family'   => 'Jura',
			'category' => 'sans-serif'
		),
		'just-another-hand'             => array(
			'family'   => 'Just Another Hand',
			'category' => 'handwriting'
		),
		'just-me-again-down-here'       => array(
			'family'   => 'Just Me Again Down Here',
			'category' => 'handwriting'
		),
		'kadwa'                         => array(
			'family'   => 'Kadwa',
			'category' => 'serif'
		),
		'kalam'                         => array(
			'family'   => 'Kalam',
			'category' => 'handwriting'
		),
		'kameron'                       => array(
			'family'   => 'Kameron',
			'category' => 'serif'
		),
		'kanit'                         => array(
			'family'   => 'Kanit',
			'category' => 'sans-serif'
		),
		'kantumruy'                     => array(
			'family'   => 'Kantumruy',
			'category' => 'sans-serif'
		),
		'karla'                         => array(
			'family'   => 'Karla',
			'category' => 'sans-serif'
		),
		'karma'                         => array(
			'family'   => 'Karma',
			'category' => 'serif'
		),
		'katibeh'                       => array(
			'family'   => 'Katibeh',
			'category' => 'display'
		),
		'kaushan-script'                => array(
			'family'   => 'Kaushan Script',
			'category' => 'handwriting'
		),
		'kavivanar'                     => array(
			'family'   => 'Kavivanar',
			'category' => 'handwriting'
		),
		'kavoon'                        => array(
			'family'   => 'Kavoon',
			'category' => 'display'
		),
		'kdam-thmor'                    => array(
			'family'   => 'Kdam Thmor',
			'category' => 'display'
		),
		'keania-one'                    => array(
			'family'   => 'Keania One',
			'category' => 'display'
		),
		'kelly-slab'                    => array(
			'family'   => 'Kelly Slab',
			'category' => 'display'
		),
		'kenia'                         => array(
			'family'   => 'Kenia',
			'category' => 'display'
		),
		'khand'                         => array(
			'family'   => 'Khand',
			'category' => 'sans-serif'
		),
		'khmer'                         => array(
			'family'   => 'Khmer',
			'category' => 'display'
		),
		'khula'                         => array(
			'family'   => 'Khula',
			'category' => 'sans-serif'
		),
		'kite-one'                      => array(
			'family'   => 'Kite One',
			'category' => 'sans-serif'
		),
		'knewave'                       => array(
			'family'   => 'Knewave',
			'category' => 'display'
		),
		'kotta-one'                     => array(
			'family'   => 'Kotta One',
			'category' => 'serif'
		),
		'koulen'                        => array(
			'family'   => 'Koulen',
			'category' => 'display'
		),
		'kranky'                        => array(
			'family'   => 'Kranky',
			'category' => 'display'
		),
		'kreon'                         => array(
			'family'   => 'Kreon',
			'category' => 'serif'
		),
		'kristi'                        => array(
			'family'   => 'Kristi',
			'category' => 'handwriting'
		),
		'krona-one'                     => array(
			'family'   => 'Krona One',
			'category' => 'sans-serif'
		),
		'kumar-one'                     => array(
			'family'   => 'Kumar One',
			'category' => 'display'
		),
		'kumar-one-outline'             => array(
			'family'   => 'Kumar One Outline',
			'category' => 'display'
		),
		'kurale'                        => array(
			'family'   => 'Kurale',
			'category' => 'serif'
		),
		'la-belle-aurore'               => array(
			'family'   => 'La Belle Aurore',
			'category' => 'handwriting'
		),
		'laila'                         => array(
			'family'   => 'Laila',
			'category' => 'serif'
		),
		'lakki-reddy'                   => array(
			'family'   => 'Lakki Reddy',
			'category' => 'handwriting'
		),
		'lalezar'                       => array(
			'family'   => 'Lalezar',
			'category' => 'display'
		),
		'lancelot'                      => array(
			'family'   => 'Lancelot',
			'category' => 'display'
		),
		'lateef'                        => array(
			'family'   => 'Lateef',
			'category' => 'handwriting'
		),
		'lato'                          => array(
			'family'   => 'Lato',
			'category' => 'sans-serif'
		),
		'league-script'                 => array(
			'family'   => 'League Script',
			'category' => 'handwriting'
		),
		'leckerli-one'                  => array(
			'family'   => 'Leckerli One',
			'category' => 'handwriting'
		),
		'ledger'                        => array(
			'family'   => 'Ledger',
			'category' => 'serif'
		),
		'lekton'                        => array(
			'family'   => 'Lekton',
			'category' => 'sans-serif'
		),
		'lemon'                         => array(
			'family'   => 'Lemon',
			'category' => 'display'
		),
		'lemonada'                      => array(
			'family'   => 'Lemonada',
			'category' => 'display'
		),
		'libre-baskerville'             => array(
			'family'   => 'Libre Baskerville',
			'category' => 'serif'
		),
		'libre-franklin'                => array(
			'family'   => 'Libre Franklin',
			'category' => 'sans-serif'
		),
		'life-savers'                   => array(
			'family'   => 'Life Savers',
			'category' => 'display'
		),
		'lilita-one'                    => array(
			'family'   => 'Lilita One',
			'category' => 'display'
		),
		'lily-script-one'               => array(
			'family'   => 'Lily Script One',
			'category' => 'display'
		),
		'limelight'                     => array(
			'family'   => 'Limelight',
			'category' => 'display'
		),
		'linden-hill'                   => array(
			'family'   => 'Linden Hill',
			'category' => 'serif'
		),
		'lobster'                       => array(
			'family'   => 'Lobster',
			'category' => 'display'
		),
		'lobster-two'                   => array(
			'family'   => 'Lobster Two',
			'category' => 'display'
		),
		'londrina-outline'              => array(
			'family'   => 'Londrina Outline',
			'category' => 'display'
		),
		'londrina-shadow'               => array(
			'family'   => 'Londrina Shadow',
			'category' => 'display'
		),
		'londrina-sketch'               => array(
			'family'   => 'Londrina Sketch',
			'category' => 'display'
		),
		'londrina-solid'                => array(
			'family'   => 'Londrina Solid',
			'category' => 'display'
		),
		'lora'                          => array(
			'family'   => 'Lora',
			'category' => 'serif'
		),
		'love-ya-like-a-sister'         => array(
			'family'   => 'Love Ya Like A Sister',
			'category' => 'display'
		),
		'loved-by-the-king'             => array(
			'family'   => 'Loved by the King',
			'category' => 'handwriting'
		),
		'lovers-quarrel'                => array(
			'family'   => 'Lovers Quarrel',
			'category' => 'handwriting'
		),
		'luckiest-guy'                  => array(
			'family'   => 'Luckiest Guy',
			'category' => 'display'
		),
		'lusitana'                      => array(
			'family'   => 'Lusitana',
			'category' => 'serif'
		),
		'lustria'                       => array(
			'family'   => 'Lustria',
			'category' => 'serif'
		),
		'macondo'                       => array(
			'family'   => 'Macondo',
			'category' => 'display'
		),
		'macondo-swash-caps'            => array(
			'family'   => 'Macondo Swash Caps',
			'category' => 'display'
		),
		'mada'                          => array(
			'family'   => 'Mada',
			'category' => 'sans-serif'
		),
		'magra'                         => array(
			'family'   => 'Magra',
			'category' => 'sans-serif'
		),
		'maiden-orange'                 => array(
			'family'   => 'Maiden Orange',
			'category' => 'display'
		),
		'maitree'                       => array(
			'family'   => 'Maitree',
			'category' => 'serif'
		),
		'mako'                          => array(
			'family'   => 'Mako',
			'category' => 'sans-serif'
		),
		'mallanna'                      => array(
			'family'   => 'Mallanna',
			'category' => 'sans-serif'
		),
		'mandali'                       => array(
			'family'   => 'Mandali',
			'category' => 'sans-serif'
		),
		'marcellus'                     => array(
			'family'   => 'Marcellus',
			'category' => 'serif'
		),
		'marcellus-sc'                  => array(
			'family'   => 'Marcellus SC',
			'category' => 'serif'
		),
		'marck-script'                  => array(
			'family'   => 'Marck Script',
			'category' => 'handwriting'
		),
		'margarine'                     => array(
			'family'   => 'Margarine',
			'category' => 'display'
		),
		'marko-one'                     => array(
			'family'   => 'Marko One',
			'category' => 'serif'
		),
		'marmelad'                      => array(
			'family'   => 'Marmelad',
			'category' => 'sans-serif'
		),
		'martel'                        => array(
			'family'   => 'Martel',
			'category' => 'serif'
		),
		'martel-sans'                   => array(
			'family'   => 'Martel Sans',
			'category' => 'sans-serif'
		),
		'marvel'                        => array(
			'family'   => 'Marvel',
			'category' => 'sans-serif'
		),
		'mate'                          => array(
			'family'   => 'Mate',
			'category' => 'serif'
		),
		'mate-sc'                       => array(
			'family'   => 'Mate SC',
			'category' => 'serif'
		),
		'maven-pro'                     => array(
			'family'   => 'Maven Pro',
			'category' => 'sans-serif'
		),
		'mclaren'                       => array(
			'family'   => 'McLaren',
			'category' => 'display'
		),
		'meddon'                        => array(
			'family'   => 'Meddon',
			'category' => 'handwriting'
		),
		'medievalsharp'                 => array(
			'family'   => 'MedievalSharp',
			'category' => 'display'
		),
		'medula-one'                    => array(
			'family'   => 'Medula One',
			'category' => 'display'
		),
		'meera-inimai'                  => array(
			'family'   => 'Meera Inimai',
			'category' => 'sans-serif'
		),
		'megrim'                        => array(
			'family'   => 'Megrim',
			'category' => 'display'
		),
		'meie-script'                   => array(
			'family'   => 'Meie Script',
			'category' => 'handwriting'
		),
		'merienda'                      => array(
			'family'   => 'Merienda',
			'category' => 'handwriting'
		),
		'merienda-one'                  => array(
			'family'   => 'Merienda One',
			'category' => 'handwriting'
		),
		'merriweather'                  => array(
			'family'   => 'Merriweather',
			'category' => 'serif'
		),
		'merriweather-sans'             => array(
			'family'   => 'Merriweather Sans',
			'category' => 'sans-serif'
		),
		'metal'                         => array(
			'family'   => 'Metal',
			'category' => 'display'
		),
		'metal-mania'                   => array(
			'family'   => 'Metal Mania',
			'category' => 'display'
		),
		'metamorphous'                  => array(
			'family'   => 'Metamorphous',
			'category' => 'display'
		),
		'metrophobic'                   => array(
			'family'   => 'Metrophobic',
			'category' => 'sans-serif'
		),
		'michroma'                      => array(
			'family'   => 'Michroma',
			'category' => 'sans-serif'
		),
		'milonga'                       => array(
			'family'   => 'Milonga',
			'category' => 'display'
		),
		'miltonian'                     => array(
			'family'   => 'Miltonian',
			'category' => 'display'
		),
		'miltonian-tattoo'              => array(
			'family'   => 'Miltonian Tattoo',
			'category' => 'display'
		),
		'miniver'                       => array(
			'family'   => 'Miniver',
			'category' => 'display'
		),
		'miriam-libre'                  => array(
			'family'   => 'Miriam Libre',
			'category' => 'sans-serif'
		),
		'mirza'                         => array(
			'family'   => 'Mirza',
			'category' => 'display'
		),
		'miss-fajardose'                => array(
			'family'   => 'Miss Fajardose',
			'category' => 'handwriting'
		),
		'mitr'                          => array(
			'family'   => 'Mitr',
			'category' => 'sans-serif'
		),
		'modak'                         => array(
			'family'   => 'Modak',
			'category' => 'display'
		),
		'modern-antiqua'                => array(
			'family'   => 'Modern Antiqua',
			'category' => 'display'
		),
		'mogra'                         => array(
			'family'   => 'Mogra',
			'category' => 'display'
		),
		'molengo'                       => array(
			'family'   => 'Molengo',
			'category' => 'sans-serif'
		),
		'molle'                         => array(
			'family'   => 'Molle',
			'category' => 'handwriting'
		),
		'monda'                         => array(
			'family'   => 'Monda',
			'category' => 'sans-serif'
		),
		'monofett'                      => array(
			'family'   => 'Monofett',
			'category' => 'display'
		),
		'monoton'                       => array(
			'family'   => 'Monoton',
			'category' => 'display'
		),
		'monsieur-la-doulaise'          => array(
			'family'   => 'Monsieur La Doulaise',
			'category' => 'handwriting'
		),
		'montaga'                       => array(
			'family'   => 'Montaga',
			'category' => 'serif'
		),
		'montez'                        => array(
			'family'   => 'Montez',
			'category' => 'handwriting'
		),
		'montserrat'                    => array(
			'family'   => 'Montserrat',
			'category' => 'sans-serif'
		),
		'montserrat-alternates'         => array(
			'family'   => 'Montserrat Alternates',
			'category' => 'sans-serif'
		),
		'montserrat-subrayada'          => array(
			'family'   => 'Montserrat Subrayada',
			'category' => 'sans-serif'
		),
		'moul'                          => array(
			'family'   => 'Moul',
			'category' => 'display'
		),
		'moulpali'                      => array(
			'family'   => 'Moulpali',
			'category' => 'display'
		),
		'mountains-of-christmas'        => array(
			'family'   => 'Mountains of Christmas',
			'category' => 'display'
		),
		'mouse-memoirs'                 => array(
			'family'   => 'Mouse Memoirs',
			'category' => 'sans-serif'
		),
		'mr-bedfort'                    => array(
			'family'   => 'Mr Bedfort',
			'category' => 'handwriting'
		),
		'mr-dafoe'                      => array(
			'family'   => 'Mr Dafoe',
			'category' => 'handwriting'
		),
		'mr-de-haviland'                => array(
			'family'   => 'Mr De Haviland',
			'category' => 'handwriting'
		),
		'mrs-saint-delafield'           => array(
			'family'   => 'Mrs Saint Delafield',
			'category' => 'handwriting'
		),
		'mrs-sheppards'                 => array(
			'family'   => 'Mrs Sheppards',
			'category' => 'handwriting'
		),
		'mukta-vaani'                   => array(
			'family'   => 'Mukta Vaani',
			'category' => 'sans-serif'
		),
		'muli'                          => array(
			'family'   => 'Muli',
			'category' => 'sans-serif'
		),
		'mystery-quest'                 => array(
			'family'   => 'Mystery Quest',
			'category' => 'display'
		),
		'ntr'                           => array(
			'family'   => 'NTR',
			'category' => 'sans-serif'
		),
		'neucha'                        => array(
			'family'   => 'Neucha',
			'category' => 'handwriting'
		),
		'neuton'                        => array(
			'family'   => 'Neuton',
			'category' => 'serif'
		),
		'new-rocker'                    => array(
			'family'   => 'New Rocker',
			'category' => 'display'
		),
		'news-cycle'                    => array(
			'family'   => 'News Cycle',
			'category' => 'sans-serif'
		),
		'niconne'                       => array(
			'family'   => 'Niconne',
			'category' => 'handwriting'
		),
		'nixie-one'                     => array(
			'family'   => 'Nixie One',
			'category' => 'display'
		),
		'nobile'                        => array(
			'family'   => 'Nobile',
			'category' => 'sans-serif'
		),
		'nokora'                        => array(
			'family'   => 'Nokora',
			'category' => 'serif'
		),
		'norican'                       => array(
			'family'   => 'Norican',
			'category' => 'handwriting'
		),
		'nosifer'                       => array(
			'family'   => 'Nosifer',
			'category' => 'display'
		),
		'nothing-you-could-do'          => array(
			'family'   => 'Nothing You Could Do',
			'category' => 'handwriting'
		),
		'noticia-text'                  => array(
			'family'   => 'Noticia Text',
			'category' => 'serif'
		),
		'noto-sans'                     => array(
			'family'   => 'Noto Sans',
			'category' => 'sans-serif'
		),
		'noto-serif'                    => array(
			'family'   => 'Noto Serif',
			'category' => 'serif'
		),
		'nova-cut'                      => array(
			'family'   => 'Nova Cut',
			'category' => 'display'
		),
		'nova-flat'                     => array(
			'family'   => 'Nova Flat',
			'category' => 'display'
		),
		'nova-mono'                     => array(
			'family'   => 'Nova Mono',
			'category' => 'monospace'
		),
		'nova-oval'                     => array(
			'family'   => 'Nova Oval',
			'category' => 'display'
		),
		'nova-round'                    => array(
			'family'   => 'Nova Round',
			'category' => 'display'
		),
		'nova-script'                   => array(
			'family'   => 'Nova Script',
			'category' => 'display'
		),
		'nova-slim'                     => array(
			'family'   => 'Nova Slim',
			'category' => 'display'
		),
		'nova-square'                   => array(
			'family'   => 'Nova Square',
			'category' => 'display'
		),
		'numans'                        => array(
			'family'   => 'Numans',
			'category' => 'sans-serif'
		),
		'nunito'                        => array(
			'family'   => 'Nunito',
			'category' => 'sans-serif'
		),
		'odor-mean-chey'                => array(
			'family'   => 'Odor Mean Chey',
			'category' => 'display'
		),
		'offside'                       => array(
			'family'   => 'Offside',
			'category' => 'display'
		),
		'old-standard-tt'               => array(
			'family'   => 'Old Standard TT',
			'category' => 'serif'
		),
		'oldenburg'                     => array(
			'family'   => 'Oldenburg',
			'category' => 'display'
		),
		'oleo-script'                   => array(
			'family'   => 'Oleo Script',
			'category' => 'display'
		),
		'oleo-script-swash-caps'        => array(
			'family'   => 'Oleo Script Swash Caps',
			'category' => 'display'
		),
		'open-sans'                     => array(
			'family'   => 'Open Sans',
			'category' => 'sans-serif'
		),
		'open-sans-condensed'           => array(
			'family'   => 'Open Sans Condensed',
			'category' => 'sans-serif'
		),
		'oranienbaum'                   => array(
			'family'   => 'Oranienbaum',
			'category' => 'serif'
		),
		'orbitron'                      => array(
			'family'   => 'Orbitron',
			'category' => 'sans-serif'
		),
		'oregano'                       => array(
			'family'   => 'Oregano',
			'category' => 'display'
		),
		'orienta'                       => array(
			'family'   => 'Orienta',
			'category' => 'sans-serif'
		),
		'original-surfer'               => array(
			'family'   => 'Original Surfer',
			'category' => 'display'
		),
		'oswald'                        => array(
			'family'   => 'Oswald',
			'category' => 'sans-serif'
		),
		'over-the-rainbow'              => array(
			'family'   => 'Over the Rainbow',
			'category' => 'handwriting'
		),
		'overlock'                      => array(
			'family'   => 'Overlock',
			'category' => 'display'
		),
		'overlock-sc'                   => array(
			'family'   => 'Overlock SC',
			'category' => 'display'
		),
		'ovo'                           => array(
			'family'   => 'Ovo',
			'category' => 'serif'
		),
		'oxygen'                        => array(
			'family'   => 'Oxygen',
			'category' => 'sans-serif'
		),
		'oxygen-mono'                   => array(
			'family'   => 'Oxygen Mono',
			'category' => 'monospace'
		),
		'pt-mono'                       => array(
			'family'   => 'PT Mono',
			'category' => 'monospace'
		),
		'pt-sans'                       => array(
			'family'   => 'PT Sans',
			'category' => 'sans-serif'
		),
		'pt-sans-caption'               => array(
			'family'   => 'PT Sans Caption',
			'category' => 'sans-serif'
		),
		'pt-sans-narrow'                => array(
			'family'   => 'PT Sans Narrow',
			'category' => 'sans-serif'
		),
		'pt-serif'                      => array(
			'family'   => 'PT Serif',
			'category' => 'serif'
		),
		'pt-serif-caption'              => array(
			'family'   => 'PT Serif Caption',
			'category' => 'serif'
		),
		'pacifico'                      => array(
			'family'   => 'Pacifico',
			'category' => 'handwriting'
		),
		'palanquin'                     => array(
			'family'   => 'Palanquin',
			'category' => 'sans-serif'
		),
		'palanquin-dark'                => array(
			'family'   => 'Palanquin Dark',
			'category' => 'sans-serif'
		),
		'paprika'                       => array(
			'family'   => 'Paprika',
			'category' => 'display'
		),
		'parisienne'                    => array(
			'family'   => 'Parisienne',
			'category' => 'handwriting'
		),
		'passero-one'                   => array(
			'family'   => 'Passero One',
			'category' => 'display'
		),
		'passion-one'                   => array(
			'family'   => 'Passion One',
			'category' => 'display'
		),
		'pathway-gothic-one'            => array(
			'family'   => 'Pathway Gothic One',
			'category' => 'sans-serif'
		),
		'patrick-hand'                  => array(
			'family'   => 'Patrick Hand',
			'category' => 'handwriting'
		),
		'patrick-hand-sc'               => array(
			'family'   => 'Patrick Hand SC',
			'category' => 'handwriting'
		),
		'pattaya'                       => array(
			'family'   => 'Pattaya',
			'category' => 'sans-serif'
		),
		'patua-one'                     => array(
			'family'   => 'Patua One',
			'category' => 'display'
		),
		'pavanam'                       => array(
			'family'   => 'Pavanam',
			'category' => 'sans-serif'
		),
		'paytone-one'                   => array(
			'family'   => 'Paytone One',
			'category' => 'sans-serif'
		),
		'peddana'                       => array(
			'family'   => 'Peddana',
			'category' => 'serif'
		),
		'peralta'                       => array(
			'family'   => 'Peralta',
			'category' => 'display'
		),
		'permanent-marker'              => array(
			'family'   => 'Permanent Marker',
			'category' => 'handwriting'
		),
		'petit-formal-script'           => array(
			'family'   => 'Petit Formal Script',
			'category' => 'handwriting'
		),
		'petrona'                       => array(
			'family'   => 'Petrona',
			'category' => 'serif'
		),
		'philosopher'                   => array(
			'family'   => 'Philosopher',
			'category' => 'sans-serif'
		),
		'piedra'                        => array(
			'family'   => 'Piedra',
			'category' => 'display'
		),
		'pinyon-script'                 => array(
			'family'   => 'Pinyon Script',
			'category' => 'handwriting'
		),
		'pirata-one'                    => array(
			'family'   => 'Pirata One',
			'category' => 'display'
		),
		'plaster'                       => array(
			'family'   => 'Plaster',
			'category' => 'display'
		),
		'play'                          => array(
			'family'   => 'Play',
			'category' => 'sans-serif'
		),
		'playball'                      => array(
			'family'   => 'Playball',
			'category' => 'display'
		),
		'playfair-display'              => array(
			'family'   => 'Playfair Display',
			'category' => 'serif'
		),
		'playfair-display-sc'           => array(
			'family'   => 'Playfair Display SC',
			'category' => 'serif'
		),
		'podkova'                       => array(
			'family'   => 'Podkova',
			'category' => 'serif'
		),
		'poiret-one'                    => array(
			'family'   => 'Poiret One',
			'category' => 'display'
		),
		'poller-one'                    => array(
			'family'   => 'Poller One',
			'category' => 'display'
		),
		'poly'                          => array(
			'family'   => 'Poly',
			'category' => 'serif'
		),
		'pompiere'                      => array(
			'family'   => 'Pompiere',
			'category' => 'display'
		),
		'pontano-sans'                  => array(
			'family'   => 'Pontano Sans',
			'category' => 'sans-serif'
		),
		'poppins'                       => array(
			'family'   => 'Poppins',
			'category' => 'sans-serif'
		),
		'port-lligat-sans'              => array(
			'family'   => 'Port Lligat Sans',
			'category' => 'sans-serif'
		),
		'port-lligat-slab'              => array(
			'family'   => 'Port Lligat Slab',
			'category' => 'serif'
		),
		'pragati-narrow'                => array(
			'family'   => 'Pragati Narrow',
			'category' => 'sans-serif'
		),
		'prata'                         => array(
			'family'   => 'Prata',
			'category' => 'serif'
		),
		'preahvihear'                   => array(
			'family'   => 'Preahvihear',
			'category' => 'display'
		),
		'press-start-2p'                => array(
			'family'   => 'Press Start 2P',
			'category' => 'display'
		),
		'pridi'                         => array(
			'family'   => 'Pridi',
			'category' => 'serif'
		),
		'princess-sofia'                => array(
			'family'   => 'Princess Sofia',
			'category' => 'handwriting'
		),
		'prociono'                      => array(
			'family'   => 'Prociono',
			'category' => 'serif'
		),
		'prompt'                        => array(
			'family'   => 'Prompt',
			'category' => 'sans-serif'
		),
		'prosto-one'                    => array(
			'family'   => 'Prosto One',
			'category' => 'display'
		),
		'proza-libre'                   => array(
			'family'   => 'Proza Libre',
			'category' => 'sans-serif'
		),
		'puritan'                       => array(
			'family'   => 'Puritan',
			'category' => 'sans-serif'
		),
		'purple-purse'                  => array(
			'family'   => 'Purple Purse',
			'category' => 'display'
		),
		'quando'                        => array(
			'family'   => 'Quando',
			'category' => 'serif'
		),
		'quantico'                      => array(
			'family'   => 'Quantico',
			'category' => 'sans-serif'
		),
		'quattrocento'                  => array(
			'family'   => 'Quattrocento',
			'category' => 'serif'
		),
		'quattrocento-sans'             => array(
			'family'   => 'Quattrocento Sans',
			'category' => 'sans-serif'
		),
		'questrial'                     => array(
			'family'   => 'Questrial',
			'category' => 'sans-serif'
		),
		'quicksand'                     => array(
			'family'   => 'Quicksand',
			'category' => 'sans-serif'
		),
		'quintessential'                => array(
			'family'   => 'Quintessential',
			'category' => 'handwriting'
		),
		'qwigley'                       => array(
			'family'   => 'Qwigley',
			'category' => 'handwriting'
		),
		'racing-sans-one'               => array(
			'family'   => 'Racing Sans One',
			'category' => 'display'
		),
		'radley'                        => array(
			'family'   => 'Radley',
			'category' => 'serif'
		),
		'rajdhani'                      => array(
			'family'   => 'Rajdhani',
			'category' => 'sans-serif'
		),
		'rakkas'                        => array(
			'family'   => 'Rakkas',
			'category' => 'display'
		),
		'raleway'                       => array(
			'family'   => 'Raleway',
			'category' => 'sans-serif'
		),
		'raleway-dots'                  => array(
			'family'   => 'Raleway Dots',
			'category' => 'display'
		),
		'ramabhadra'                    => array(
			'family'   => 'Ramabhadra',
			'category' => 'sans-serif'
		),
		'ramaraja'                      => array(
			'family'   => 'Ramaraja',
			'category' => 'serif'
		),
		'rambla'                        => array(
			'family'   => 'Rambla',
			'category' => 'sans-serif'
		),
		'rammetto-one'                  => array(
			'family'   => 'Rammetto One',
			'category' => 'display'
		),
		'ranchers'                      => array(
			'family'   => 'Ranchers',
			'category' => 'display'
		),
		'rancho'                        => array(
			'family'   => 'Rancho',
			'category' => 'handwriting'
		),
		'ranga'                         => array(
			'family'   => 'Ranga',
			'category' => 'display'
		),
		'rasa'                          => array(
			'family'   => 'Rasa',
			'category' => 'serif'
		),
		'rationale'                     => array(
			'family'   => 'Rationale',
			'category' => 'sans-serif'
		),
		'ravi-prakash'                  => array(
			'family'   => 'Ravi Prakash',
			'category' => 'display'
		),
		'redressed'                     => array(
			'family'   => 'Redressed',
			'category' => 'handwriting'
		),
		'reem-kufi'                     => array(
			'family'   => 'Reem Kufi',
			'category' => 'sans-serif'
		),
		'reenie-beanie'                 => array(
			'family'   => 'Reenie Beanie',
			'category' => 'handwriting'
		),
		'revalia'                       => array(
			'family'   => 'Revalia',
			'category' => 'display'
		),
		'rhodium-libre'                 => array(
			'family'   => 'Rhodium Libre',
			'category' => 'serif'
		),
		'ribeye'                        => array(
			'family'   => 'Ribeye',
			'category' => 'display'
		),
		'ribeye-marrow'                 => array(
			'family'   => 'Ribeye Marrow',
			'category' => 'display'
		),
		'righteous'                     => array(
			'family'   => 'Righteous',
			'category' => 'display'
		),
		'risque'                        => array(
			'family'   => 'Risque',
			'category' => 'display'
		),
		'roboto'                        => array(
			'family'   => 'Roboto',
			'category' => 'sans-serif'
		),
		'roboto-condensed'              => array(
			'family'   => 'Roboto Condensed',
			'category' => 'sans-serif'
		),
		'roboto-mono'                   => array(
			'family'   => 'Roboto Mono',
			'category' => 'monospace'
		),
		'roboto-slab'                   => array(
			'family'   => 'Roboto Slab',
			'category' => 'serif'
		),
		'rochester'                     => array(
			'family'   => 'Rochester',
			'category' => 'handwriting'
		),
		'rock-salt'                     => array(
			'family'   => 'Rock Salt',
			'category' => 'handwriting'
		),
		'rokkitt'                       => array(
			'family'   => 'Rokkitt',
			'category' => 'serif'
		),
		'romanesco'                     => array(
			'family'   => 'Romanesco',
			'category' => 'handwriting'
		),
		'ropa-sans'                     => array(
			'family'   => 'Ropa Sans',
			'category' => 'sans-serif'
		),
		'rosario'                       => array(
			'family'   => 'Rosario',
			'category' => 'sans-serif'
		),
		'rosarivo'                      => array(
			'family'   => 'Rosarivo',
			'category' => 'serif'
		),
		'rouge-script'                  => array(
			'family'   => 'Rouge Script',
			'category' => 'handwriting'
		),
		'rozha-one'                     => array(
			'family'   => 'Rozha One',
			'category' => 'serif'
		),
		'rubik'                         => array(
			'family'   => 'Rubik',
			'category' => 'sans-serif'
		),
		'rubik-mono-one'                => array(
			'family'   => 'Rubik Mono One',
			'category' => 'sans-serif'
		),
		'rubik-one'                     => array(
			'family'   => 'Rubik One',
			'category' => 'sans-serif'
		),
		'ruda'                          => array(
			'family'   => 'Ruda',
			'category' => 'sans-serif'
		),
		'rufina'                        => array(
			'family'   => 'Rufina',
			'category' => 'serif'
		),
		'ruge-boogie'                   => array(
			'family'   => 'Ruge Boogie',
			'category' => 'handwriting'
		),
		'ruluko'                        => array(
			'family'   => 'Ruluko',
			'category' => 'sans-serif'
		),
		'rum-raisin'                    => array(
			'family'   => 'Rum Raisin',
			'category' => 'sans-serif'
		),
		'ruslan-display'                => array(
			'family'   => 'Ruslan Display',
			'category' => 'display'
		),
		'russo-one'                     => array(
			'family'   => 'Russo One',
			'category' => 'sans-serif'
		),
		'ruthie'                        => array(
			'family'   => 'Ruthie',
			'category' => 'handwriting'
		),
		'rye'                           => array(
			'family'   => 'Rye',
			'category' => 'display'
		),
		'sacramento'                    => array(
			'family'   => 'Sacramento',
			'category' => 'handwriting'
		),
		'sahitya'                       => array(
			'family'   => 'Sahitya',
			'category' => 'serif'
		),
		'sail'                          => array(
			'family'   => 'Sail',
			'category' => 'display'
		),
		'salsa'                         => array(
			'family'   => 'Salsa',
			'category' => 'display'
		),
		'sanchez'                       => array(
			'family'   => 'Sanchez',
			'category' => 'serif'
		),
		'sancreek'                      => array(
			'family'   => 'Sancreek',
			'category' => 'display'
		),
		'sansita-one'                   => array(
			'family'   => 'Sansita One',
			'category' => 'display'
		),
		'sarala'                        => array(
			'family'   => 'Sarala',
			'category' => 'sans-serif'
		),
		'sarina'                        => array(
			'family'   => 'Sarina',
			'category' => 'display'
		),
		'sarpanch'                      => array(
			'family'   => 'Sarpanch',
			'category' => 'sans-serif'
		),
		'satisfy'                       => array(
			'family'   => 'Satisfy',
			'category' => 'handwriting'
		),
		'scada'                         => array(
			'family'   => 'Scada',
			'category' => 'sans-serif'
		),
		'scheherazade'                  => array(
			'family'   => 'Scheherazade',
			'category' => 'serif'
		),
		'schoolbell'                    => array(
			'family'   => 'Schoolbell',
			'category' => 'handwriting'
		),
		'scope-one'                     => array(
			'family'   => 'Scope One',
			'category' => 'serif'
		),
		'seaweed-script'                => array(
			'family'   => 'Seaweed Script',
			'category' => 'display'
		),
		'secular-one'                   => array(
			'family'   => 'Secular One',
			'category' => 'sans-serif'
		),
		'sevillana'                     => array(
			'family'   => 'Sevillana',
			'category' => 'display'
		),
		'seymour-one'                   => array(
			'family'   => 'Seymour One',
			'category' => 'sans-serif'
		),
		'shadows-into-light'            => array(
			'family'   => 'Shadows Into Light',
			'category' => 'handwriting'
		),
		'shadows-into-light-two'        => array(
			'family'   => 'Shadows Into Light Two',
			'category' => 'handwriting'
		),
		'shanti'                        => array(
			'family'   => 'Shanti',
			'category' => 'sans-serif'
		),
		'share'                         => array(
			'family'   => 'Share',
			'category' => 'display'
		),
		'share-tech'                    => array(
			'family'   => 'Share Tech',
			'category' => 'sans-serif'
		),
		'share-tech-mono'               => array(
			'family'   => 'Share Tech Mono',
			'category' => 'monospace'
		),
		'shojumaru'                     => array(
			'family'   => 'Shojumaru',
			'category' => 'display'
		),
		'short-stack'                   => array(
			'family'   => 'Short Stack',
			'category' => 'handwriting'
		),
		'shrikhand'                     => array(
			'family'   => 'Shrikhand',
			'category' => 'display'
		),
		'siemreap'                      => array(
			'family'   => 'Siemreap',
			'category' => 'display'
		),
		'sigmar-one'                    => array(
			'family'   => 'Sigmar One',
			'category' => 'display'
		),
		'signika'                       => array(
			'family'   => 'Signika',
			'category' => 'sans-serif'
		),
		'signika-negative'              => array(
			'family'   => 'Signika Negative',
			'category' => 'sans-serif'
		),
		'simonetta'                     => array(
			'family'   => 'Simonetta',
			'category' => 'display'
		),
		'sintony'                       => array(
			'family'   => 'Sintony',
			'category' => 'sans-serif'
		),
		'sirin-stencil'                 => array(
			'family'   => 'Sirin Stencil',
			'category' => 'display'
		),
		'six-caps'                      => array(
			'family'   => 'Six Caps',
			'category' => 'sans-serif'
		),
		'skranji'                       => array(
			'family'   => 'Skranji',
			'category' => 'display'
		),
		'slabo-13px'                    => array(
			'family'   => 'Slabo 13px',
			'category' => 'serif'
		),
		'slabo-27px'                    => array(
			'family'   => 'Slabo 27px',
			'category' => 'serif'
		),
		'slackey'                       => array(
			'family'   => 'Slackey',
			'category' => 'display'
		),
		'smokum'                        => array(
			'family'   => 'Smokum',
			'category' => 'display'
		),
		'smythe'                        => array(
			'family'   => 'Smythe',
			'category' => 'display'
		),
		'sniglet'                       => array(
			'family'   => 'Sniglet',
			'category' => 'display'
		),
		'snippet'                       => array(
			'family'   => 'Snippet',
			'category' => 'sans-serif'
		),
		'snowburst-one'                 => array(
			'family'   => 'Snowburst One',
			'category' => 'display'
		),
		'sofadi-one'                    => array(
			'family'   => 'Sofadi One',
			'category' => 'display'
		),
		'sofia'                         => array(
			'family'   => 'Sofia',
			'category' => 'handwriting'
		),
		'sonsie-one'                    => array(
			'family'   => 'Sonsie One',
			'category' => 'display'
		),
		'sorts-mill-goudy'              => array(
			'family'   => 'Sorts Mill Goudy',
			'category' => 'serif'
		),
		'source-code-pro'               => array(
			'family'   => 'Source Code Pro',
			'category' => 'monospace'
		),
		'source-sans-pro'               => array(
			'family'   => 'Source Sans Pro',
			'category' => 'sans-serif'
		),
		'source-serif-pro'              => array(
			'family'   => 'Source Serif Pro',
			'category' => 'serif'
		),
		'space-mono'                    => array(
			'family'   => 'Space Mono',
			'category' => 'monospace'
		),
		'special-elite'                 => array(
			'family'   => 'Special Elite',
			'category' => 'display'
		),
		'spicy-rice'                    => array(
			'family'   => 'Spicy Rice',
			'category' => 'display'
		),
		'spinnaker'                     => array(
			'family'   => 'Spinnaker',
			'category' => 'sans-serif'
		),
		'spirax'                        => array(
			'family'   => 'Spirax',
			'category' => 'display'
		),
		'squada-one'                    => array(
			'family'   => 'Squada One',
			'category' => 'display'
		),
		'sree-krushnadevaraya'          => array(
			'family'   => 'Sree Krushnadevaraya',
			'category' => 'serif'
		),
		'sriracha'                      => array(
			'family'   => 'Sriracha',
			'category' => 'handwriting'
		),
		'stalemate'                     => array(
			'family'   => 'Stalemate',
			'category' => 'handwriting'
		),
		'stalinist-one'                 => array(
			'family'   => 'Stalinist One',
			'category' => 'display'
		),
		'stardos-stencil'               => array(
			'family'   => 'Stardos Stencil',
			'category' => 'display'
		),
		'stint-ultra-condensed'         => array(
			'family'   => 'Stint Ultra Condensed',
			'category' => 'display'
		),
		'stint-ultra-expanded'          => array(
			'family'   => 'Stint Ultra Expanded',
			'category' => 'display'
		),
		'stoke'                         => array(
			'family'   => 'Stoke',
			'category' => 'serif'
		),
		'strait'                        => array(
			'family'   => 'Strait',
			'category' => 'sans-serif'
		),
		'sue-ellen-francisco'           => array(
			'family'   => 'Sue Ellen Francisco',
			'category' => 'handwriting'
		),
		'suez-one'                      => array(
			'family'   => 'Suez One',
			'category' => 'serif'
		),
		'sumana'                        => array(
			'family'   => 'Sumana',
			'category' => 'serif'
		),
		'sunshiney'                     => array(
			'family'   => 'Sunshiney',
			'category' => 'handwriting'
		),
		'supermercado-one'              => array(
			'family'   => 'Supermercado One',
			'category' => 'display'
		),
		'sura'                          => array(
			'family'   => 'Sura',
			'category' => 'serif'
		),
		'suranna'                       => array(
			'family'   => 'Suranna',
			'category' => 'serif'
		),
		'suravaram'                     => array(
			'family'   => 'Suravaram',
			'category' => 'serif'
		),
		'suwannaphum'                   => array(
			'family'   => 'Suwannaphum',
			'category' => 'display'
		),
		'swanky-and-moo-moo'            => array(
			'family'   => 'Swanky and Moo Moo',
			'category' => 'handwriting'
		),
		'syncopate'                     => array(
			'family'   => 'Syncopate',
			'category' => 'sans-serif'
		),
		'tangerine'                     => array(
			'family'   => 'Tangerine',
			'category' => 'handwriting'
		),
		'taprom'                        => array(
			'family'   => 'Taprom',
			'category' => 'display'
		),
		'tauri'                         => array(
			'family'   => 'Tauri',
			'category' => 'sans-serif'
		),
		'taviraj'                       => array(
			'family'   => 'Taviraj',
			'category' => 'serif'
		),
		'teko'                          => array(
			'family'   => 'Teko',
			'category' => 'sans-serif'
		),
		'telex'                         => array(
			'family'   => 'Telex',
			'category' => 'sans-serif'
		),
		'tenali-ramakrishna'            => array(
			'family'   => 'Tenali Ramakrishna',
			'category' => 'sans-serif'
		),
		'tenor-sans'                    => array(
			'family'   => 'Tenor Sans',
			'category' => 'sans-serif'
		),
		'text-me-one'                   => array(
			'family'   => 'Text Me One',
			'category' => 'sans-serif'
		),
		'the-girl-next-door'            => array(
			'family'   => 'The Girl Next Door',
			'category' => 'handwriting'
		),
		'tienne'                        => array(
			'family'   => 'Tienne',
			'category' => 'serif'
		),
		'tillana'                       => array(
			'family'   => 'Tillana',
			'category' => 'handwriting'
		),
		'timmana'                       => array(
			'family'   => 'Timmana',
			'category' => 'sans-serif'
		),
		'tinos'                         => array(
			'family'   => 'Tinos',
			'category' => 'serif'
		),
		'titan-one'                     => array(
			'family'   => 'Titan One',
			'category' => 'display'
		),
		'titillium-web'                 => array(
			'family'   => 'Titillium Web',
			'category' => 'sans-serif'
		),
		'trade-winds'                   => array(
			'family'   => 'Trade Winds',
			'category' => 'display'
		),
		'trirong'                       => array(
			'family'   => 'Trirong',
			'category' => 'serif'
		),
		'trocchi'                       => array(
			'family'   => 'Trocchi',
			'category' => 'serif'
		),
		'trochut'                       => array(
			'family'   => 'Trochut',
			'category' => 'display'
		),
		'trykker'                       => array(
			'family'   => 'Trykker',
			'category' => 'serif'
		),
		'tulpen-one'                    => array(
			'family'   => 'Tulpen One',
			'category' => 'display'
		),
		'ubuntu'                        => array(
			'family'   => 'Ubuntu',
			'category' => 'sans-serif'
		),
		'ubuntu-condensed'              => array(
			'family'   => 'Ubuntu Condensed',
			'category' => 'sans-serif'
		),
		'ubuntu-mono'                   => array(
			'family'   => 'Ubuntu Mono',
			'category' => 'monospace'
		),
		'ultra'                         => array(
			'family'   => 'Ultra',
			'category' => 'serif'
		),
		'uncial-antiqua'                => array(
			'family'   => 'Uncial Antiqua',
			'category' => 'display'
		),
		'underdog'                      => array(
			'family'   => 'Underdog',
			'category' => 'display'
		),
		'unica-one'                     => array(
			'family'   => 'Unica One',
			'category' => 'display'
		),
		'unifrakturcook'                => array(
			'family'   => 'UnifrakturCook',
			'category' => 'display'
		),
		'unifrakturmaguntia'            => array(
			'family'   => 'UnifrakturMaguntia',
			'category' => 'display'
		),
		'unkempt'                       => array(
			'family'   => 'Unkempt',
			'category' => 'display'
		),
		'unlock'                        => array(
			'family'   => 'Unlock',
			'category' => 'display'
		),
		'unna'                          => array(
			'family'   => 'Unna',
			'category' => 'serif'
		),
		'vt323'                         => array(
			'family'   => 'VT323',
			'category' => 'monospace'
		),
		'vampiro-one'                   => array(
			'family'   => 'Vampiro One',
			'category' => 'display'
		),
		'varela'                        => array(
			'family'   => 'Varela',
			'category' => 'sans-serif'
		),
		'varela-round'                  => array(
			'family'   => 'Varela Round',
			'category' => 'sans-serif'
		),
		'vast-shadow'                   => array(
			'family'   => 'Vast Shadow',
			'category' => 'display'
		),
		'vesper-libre'                  => array(
			'family'   => 'Vesper Libre',
			'category' => 'serif'
		),
		'vibur'                         => array(
			'family'   => 'Vibur',
			'category' => 'handwriting'
		),
		'vidaloka'                      => array(
			'family'   => 'Vidaloka',
			'category' => 'serif'
		),
		'viga'                          => array(
			'family'   => 'Viga',
			'category' => 'sans-serif'
		),
		'voces'                         => array(
			'family'   => 'Voces',
			'category' => 'display'
		),
		'volkhov'                       => array(
			'family'   => 'Volkhov',
			'category' => 'serif'
		),
		'vollkorn'                      => array(
			'family'   => 'Vollkorn',
			'category' => 'serif'
		),
		'voltaire'                      => array(
			'family'   => 'Voltaire',
			'category' => 'sans-serif'
		),
		'waiting-for-the-sunrise'       => array(
			'family'   => 'Waiting for the Sunrise',
			'category' => 'handwriting'
		),
		'wallpoet'                      => array(
			'family'   => 'Wallpoet',
			'category' => 'display'
		),
		'walter-turncoat'               => array(
			'family'   => 'Walter Turncoat',
			'category' => 'handwriting'
		),
		'warnes'                        => array(
			'family'   => 'Warnes',
			'category' => 'display'
		),
		'wellfleet'                     => array(
			'family'   => 'Wellfleet',
			'category' => 'display'
		),
		'wendy-one'                     => array(
			'family'   => 'Wendy One',
			'category' => 'sans-serif'
		),
		'wire-one'                      => array(
			'family'   => 'Wire One',
			'category' => 'sans-serif'
		),
		'work-sans'                     => array(
			'family'   => 'Work Sans',
			'category' => 'sans-serif'
		),
		'yanone-kaffeesatz'             => array(
			'family'   => 'Yanone Kaffeesatz',
			'category' => 'sans-serif'
		),
		'yantramanav'                   => array(
			'family'   => 'Yantramanav',
			'category' => 'sans-serif'
		),
		'yatra-one'                     => array(
			'family'   => 'Yatra One',
			'category' => 'display'
		),
		'yellowtail'                    => array(
			'family'   => 'Yellowtail',
			'category' => 'handwriting'
		),
		'yeseva-one'                    => array(
			'family'   => 'Yeseva One',
			'category' => 'display'
		),
		'yesteryear'                    => array(
			'family'   => 'Yesteryear',
			'category' => 'handwriting'
		),
		'yrsa'                          => array(
			'family'   => 'Yrsa',
			'category' => 'serif'
		),
		'zeyada'                        => array(
			'family'   => 'Zeyada',
			'category' => 'handwriting'
		)
	);

	public function __construct() {
		parent::__construct( LS_BW_PLUGIN_WIDGET_SLUG, 'Loomisoft Button', array( 'description' => 'Place a button in the selected area.' ) );

		add_action( 'admin_enqueue_scripts', array(
			$this,
			'admin_enqueue_scripts'
		) );

		add_action( 'wp_enqueue_scripts', array(
			$this,
			'enqueue_scripts'
		) );

		add_action( 'admin_menu', array(
			$this,
			'plugin_admin_page_add'
		) );

		add_filter( 'plugin_action_links_' . LS_BW_PLUGIN_BASENAME, array(
			$this,
			'add_action_links'
		) );

		$this->form_fields[ 'font-family' ][ 'options' ][ '' ] = '';

		foreach ( $this->fonts as $key => $font ) {
			if ( substr( $key, 0, strlen( '---group-' ) ) == '---group-' ) {
				$this->form_fields[ 'font-family' ][ 'options' ][ $key ] = $font;
			} else {
				$this->form_fields[ 'font-family' ][ 'options' ][ $key ] = $font[ 'family' ];
			}
		}
	}

	function admin_enqueue_scripts() {

		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'ls_bw_admin_script', LS_BW_PLUGIN_URL . 'js/admin.js' );
		wp_enqueue_style( 'ls_bw_admin_style', LS_BW_PLUGIN_URL . 'css/admin.css' );

	}

	function enqueue_scripts() {

		wp_enqueue_style( 'ls_bw_wp_style', LS_BW_PLUGIN_URL . 'css/style.css' );

	}

	function add_action_links( $links ) {
		$mylinks = array(
			'<a href="' . admin_url( 'admin.php?page=' . LS_BW_PLUGIN_PAGE_SLUG ) . '">Usage & About</a>',
		);

		return array_merge( $links, $mylinks );
	}

	public function widget( $args, $instance ) {

		extract( $args );

		$instance = $this->get_clean_instance_values( $instance );

		$html = '<div class="ls-button-widget-container ls-button-widget-clearfix"><div id="ls-button-widget-' . esc_attr( $this->id ) . '" class="ls-button-widget-outer"><div class="ls-button-widget-inner ls-button-widget-inner-' . esc_attr( str_replace( ' ', '-', strtolower( $instance[ 'alignment' ] ) ) ) . '"><a id="ls-button-widget-link-' . esc_attr( $this->id ) . '" class="ls-button-widget-link"';

		if ( $instance[ 'link-address' ] != '' ) {
			$html .= ' href="' . esc_html( $instance[ 'link-address' ] ) . '"';
		} else {
			$html .= ' href="#" onclick="return false"';
		}

		if ( $instance[ 'new-window' ] != '' ) {
			$html .= ' target="_blank"';
		}

		$html .= '>' . esc_html( $instance[ 'button-text' ] ) . '</a></div></div></div>';

		if ( $html != '' ) {
			//$html = $before_widget . $html . $after_widget;
		}

		echo $html;
	}

	function validate_pixels( &$value, $allow_negative = false ) {
		if ( trim( $value ) == '' ) {
			$value = '';

			return true;
		} elseif ( ( preg_match( '/^([0-9]*)(px){0,1}$/i', $value, $matches ) ) || ( ( preg_match( '/^(-{0,1}[0-9]*)(px){0,1}$/i', $value, $matches ) ) && ( $allow_negative ) ) ) {
			$value = (string) intval( $matches[ 1 ] );

			return true;
		}

		return false;
	}

	function validate_color( &$value ) {
		if ( trim( $value ) == '' ) {
			$value = '';

			return true;
		} elseif ( preg_match( '/^(#{1}[0-9a-f]{6})$/i', $value, $matches ) ) {
			$value = strtolower( $matches[ 1 ] );

			return true;
		} elseif ( preg_match( '/^([0-9a-f]{6})$/i', $value, $matches ) ) {
			$value = '#' . strtolower( $matches[ 1 ] );

			return true;
		}

		return false;
	}

	public function form( $instance ) {
		foreach ( $this->form_fields as $key => $value ) {
			switch ( $value[ 'type' ] ) {
				case 'text':
					if ( ! isset( $instance[ $key ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} else {
						$instance[ $key ] = trim( $instance[ $key ] );
					}
					?>
					<p>
						<label for="<?php echo $this->get_field_id( $key ); ?>"><?php _e( $value[ 'label' ] ); ?>:</label>
						<input class="widefat" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text" value="<?php echo esc_attr( $instance[ $key ] ); ?>"/><?php if ( isset( $value[ 'note' ] ) ) { ?>
							<br/>
							<small><?php _e( $value[ 'note' ] ); ?></small><?php } ?>
					</p>
					<?php
					break;
				case 'checkbox':
					if ( ! isset( $instance[ $key ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} elseif ( ( $instance[ $key ] !== '' ) && ( $instance[ $key ] !== 'yes' ) ) {
						$instance[ $key ] = $value[ 'default' ];
					}
					?>
					<p>
						<input class="widefat" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="checkbox" value="yes"<?php checked( $instance[ $key ], 'yes' ); ?> /><label for="<?php echo $this->get_field_id( $key ); ?>"><?php _e( $value[ 'label' ] ); ?>:</label><?php if ( isset( $value[ 'note' ] ) ) { ?>
							<br/>
							<small><?php _e( $value[ 'note' ] ); ?></small><?php } ?>
					</p>
					<?php
					break;
				case 'select':
					if ( ! isset( $value[ 'options' ][ $value[ 'default' ] ] ) ) {
						reset( $value[ 'options' ] );
						$value[ 'default' ] = key( $value[ 'options' ] );
					}
					if ( ! isset( $instance[ $key ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} elseif ( substr( $instance[ $key ], 0, strlen( '---group-' ) ) == '---group-' ) {
						$instance[ $key ] = $value[ 'default' ];
					} elseif ( ! isset( $value[ 'options' ][ $instance[ $key ] ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					}
					?>
					<p>
						<label for="<?php echo $this->get_field_id( $key ); ?>"><?php _e( $value[ 'label' ] ); ?>:</label>
						<select class='widefat' id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text">
							<?php
							$optgroup_open = false;
							foreach ( $value[ 'options' ] as $option_value => $option ) {
							if ( substr( $option_value, 0, strlen( '---group-' ) ) == '---group-' ) {
							if ( $optgroup_open ) {
								?>
								</optgroup>
								<?php
							}
							?>
							<optgroup label="<?php echo esc_attr( $option ); ?>">
								<?php
								$optgroup_open = true;
								} else {
									?>
									<option value="<?php echo esc_attr( $option_value ); ?>"<?php echo ( $instance[ $key ] == $option_value ) ? ' selected="selected"' : ''; ?>><?php echo esc_attr( $option ); ?></option>
									<?php
								}
								}
								if ( $optgroup_open ) {
								?>
							</optgroup>
						<?php
						}
						?>
						</select><?php if ( isset( $value[ 'note' ] ) ) { ?>
							<br/>
							<small><?php _e( $value[ 'note' ] ); ?></small><?php } ?>
					</p>
					<?php
					break;
				case 'pixels':
					$allow_negative = false;
					if ( isset( $value[ 'allow-negative' ] ) ) {
						$allow_negative = $value[ 'allow-negative' ];
					}
					if ( ! isset( $instance[ $key ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} elseif ( ! $this->validate_pixels( $instance[ $key ], $allow_negative ) ) {
						$instance[ $key ] = $value[ 'default' ];
					}
					?>
					<p>
						<label for="<?php echo $this->get_field_id( $key ); ?>"><?php _e( $value[ 'label' ] ); ?>:</label>
						<input class="widefat" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text" value="<?php echo esc_attr( $instance[ $key ] ); ?>"/><?php if ( isset( $value[ 'note' ] ) ) { ?>
							<br/>
							<small><?php _e( $value[ 'note' ] ); ?></small><?php } ?>
					</p>
					<?php
					break;
				case 'color':
					if ( ! isset( $instance[ $key ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} elseif ( ! $this->validate_color( $instance[ $key ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					}
					?>
					<p>
						<label for="<?php echo $this->get_field_id( $key ); ?>"><?php _e( $value[ 'label' ] ); ?>:</label>
						<input class="wp-color-picker" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text" value="<?php echo esc_attr( $instance[ $key ] ); ?>"/><?php if ( isset( $value[ 'note' ] ) ) { ?>
							<br/>
							<small><?php _e( $value[ 'note' ] ); ?></small><?php } ?>
					</p>
					<?php
					break;
			}
		}
	}

	function get_clean_instance_values( $source_instance ) {
		$instance = array();

		foreach ( $this->form_fields as $key => $value ) {
			switch ( $value[ 'type' ] ) {
				case 'text':
					if ( ! isset( $source_instance[ $key ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} else {
						$instance[ $key ] = trim( $source_instance[ $key ] );
					}
					break;
				case 'checkbox':
					if ( ! isset( $source_instance[ $key ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} elseif ( ( $source_instance[ $key ] !== '' ) && ( $source_instance[ $key ] !== 'yes' ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} else {
						$instance[ $key ] = trim( $source_instance[ $key ] );
					}
					break;
				case 'select':
					if ( ! isset( $value[ 'options' ][ $value[ 'default' ] ] ) ) {
						reset( $value[ 'options' ] );
						$value[ 'default' ] = key( $value[ 'options' ] );
					}
					if ( ! isset( $source_instance[ $key ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} elseif ( substr( $source_instance[ $key ], 0, strlen( '---group-' ) ) == '---group-' ) {
						$instance[ $key ] = $value[ 'default' ];
					} elseif ( ! isset( $value[ 'options' ][ $source_instance[ $key ] ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} else {
						$instance[ $key ] = trim( $source_instance[ $key ] );
					}
					break;
				case 'pixels':
					$allow_negative = false;
					if ( isset( $value[ 'allow-negative' ] ) ) {
						$allow_negative = $value[ 'allow-negative' ];
					}
					if ( ! isset( $source_instance[ $key ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} elseif ( ! $this->validate_pixels( $source_instance[ $key ], $allow_negative ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} else {
						$instance[ $key ] = trim( $source_instance[ $key ] );
					}
					break;
				case 'color':
					if ( ! isset( $source_instance[ $key ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} elseif ( ! $this->validate_color( $source_instance[ $key ] ) ) {
						$instance[ $key ] = $value[ 'default' ];
					} else {
						$instance[ $key ] = trim( $source_instance[ $key ] );
					}
					break;
			}
		}

		return $instance;
	}

	public function update( $new_instance, $old_instance ) {
		return $this->get_clean_instance_values( $new_instance );
	}

	function plugin_admin_page_add() {
		add_menu_page( LS_BW_PLUGIN_PAGE_TITLE, LS_BW_PLUGIN_PAGE_MENU_NAME, LS_BW_PLUGIN_PAGE_CAPABILITY, LS_BW_PLUGIN_PAGE_SLUG, array(
			$this,
			'plugin_admin_page'
		), LS_BW_PLUGIN_PAGE_MENU_IMAGE );
	}

	function plugin_admin_page() {
		?>
		<div class="wrap">
			<div class="ls-bw-admin-info-page-row ls-bw-clearfix">
				<div class="ls-bw-admin-info-page-half">
					<div class="ls-bw-admin-info-page-half-inner">
						<div class="postbox">
							<div class="inside">
								<h1>Welcome to <?php echo esc_html( LS_BW_PLUGIN_NAME ); ?> Version <?php echo esc_html( LS_BW_PLUGIN_VERSION ); ?></h1>
								<p>Loomisoft's Button Widget plugin provides a widget that allows you to place highly customisable link buttons in your sidebars, footers and other widgetised areas. Designed to be intuitive, the widget provides great flexibility and versatility in defining the button's text, background, borders, paddings and hover characteristics.</p>
								<h2>Usage</h2>
								<p>You can access the widget in the normal WordPress admin area - Appearance >
									<a href="<?php get_admin_url(); ?>widgets.php">Widgets</a>. Once you move the widget into the relevant widget area, you can customise the specific button to suit your needs.
								</p>
								<h2>Features</h2>
								<p>Each button provides the following elements that can be managed from within the widget, allowing it to be fully customised:</p>
								<ul class="ul-disc">
									<li>Button Text</li>
									<li>Link URL</li>
									<li>Open in New Window</li>
									<li>Button Alignment - options are Full Width (within containing area), Center, Left and Right</li>
									<li>Text Font Family - The font for the button text / includes Google Fonts / leave blank for theme default</li>
									<li>Text Font Size - in pixels (no "px" needed) / leave blank for theme default</li>
									<li>Text Line Height - in pixels (no "px" needed) / leave blank for 1.3em</li>
									<li>Text Color - leave blank for white (for colors you can use the color picker or enter its value in RGB HEX)</li>
									<li>Text Hover Color - leave blank for white</li>
									<li>Text Bold</li>
									<li>Text Hover Bold</li>
									<li>Text Italic</li>
									<li>Text Hover Italic</li>
									<li>Text Underline</li>
									<li>Text Hover Underline</li>
									<li>Background Color - leave blank for light blue</li>
									<li>Background Hover Color - leave blank for dark blue</li>
									<li>Border Width - in pixels (no "px" needed) / leave blank for none</li>
									<li>Border Color - applied when width set / leave blank for dark blue</li>
									<li>Border Hover Color - applied when width set / leave blank for dark blue</li>
									<li>Corner (Border) Radius - in pixels (no "px" needed) / leave blank or 0 for square borders</li>
									<li>Top/Bottom Padding - in pixels (no "px" needed) / leave blank for 10 pixels</li>
									<li>Left/Right Padding - in pixels (no "px" needed) / leave blank for 5 pixels</li>
									<li>Top Margin - in pixels (no "px" needed) / leave blank for 10 pixels</li>
									<li>Bottom Margin - in pixels (no "px" needed) / leave blank for 10 pixels</li>
									<li>Left/Right Margin - in pixels (no "px" needed) / leave blank for 0 pixels</li>
								</ul>
								<h2>Notes</h2>
								<ul class="ul-disc">
									<li>"Padding" is the space between the text and the border/edge of the button.</li>
									<li>"Margin" is the space between the button and elements above/below and the edge of the containing element either side. Do be aware that elements and below may also have margins set. The top and bottom margins may be set to negative values, but do be aware that the website's theme may have defined containing blocks with "overflow" hidden.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="ls-bw-admin-info-page-half">
					<div class="ls-bw-admin-info-page-half-inner">
						<div class="postbox">
							<div class="inside">
								<div id="ls-bw-admin-branding">
									<img src="<?php echo LS_BW_PLUGIN_URL; ?>images/ls-wp-admin-branding.png"/>
								</div>
								<h3>Questions &amp; Comments</h3>
								<p>We hope you find this plugin useful and valuable in delivering the functionality you are looking for and help you achieve what you intend on your website(s).</p>
								<p>If you have any comments and suggestions to make this plugin even better, if you have any questions or even if you just need a little help, do contact. We&rsquo;d like to hear from you.</p>
								<div class="ls-bw-admin-button-container">
									<a href="http://www.loomisoft.com/contact/" target="_blank" class="ls-bw-admin-button-link">Contact</a>
								</div>
							</div>
						</div>
						<div class="postbox">
							<div class="inside">
								<h3>Rate this plugin</h3>
								<p>If you like this plugin and you think it deserves some stars ... the more the merrier ... please take a moment to rate it with WordPress.org.</p>
								<div class="ls-bw-admin-button-container">
									<a href="<?php echo esc_html( LS_BW_PLUGIN_WP_URL ); ?>" target="_blank" class="ls-bw-admin-button-link">Give us Some Stars</a>
								</div>
							</div>
						</div>
						<div class="postbox">
							<div class="inside">
								<h3>Make a financial contribution</h3>
								<p>This plugin is provided free of charge. However, if you like it, feel free to make a financial contribution. Your contributions allow us to provide support, upgrades and bug-fixes for this plugin and of course they help with the development of other useful plugins.</p>
								<div class="ls-bw-admin-button-container">
									<a href="http://www.loomisoft.com/make-a-contribution/" target="_blank" class="ls-bw-admin-button-link">Make a Contribution</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
