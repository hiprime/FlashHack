<?php
/*
Plugin Name: Button Widget by Loomisoft
Plugin URI:  http://www.loomisoft.com/button-widget-wordpress-plugin/
Description: The Button Widget plugin by Loomisoft provides a widget that allows you to place link buttons in your sidebars, footers and other widgetised areas. Designed to be intuitive, the widget provides great flexibility in defining the button's text, background, borders, paddings and hover characteristics.
Version:     1.1.2
Author:      Loomisoft
Author URI:  http://www.loomisoft.com/
License:     GNU General Public License v3.0
*/

/*
Copyright (c) 2016 Loomisoft (www.loomisoft.com). All rights reserved.

The Loomisoft Button Widget plugin is distributed under the GNU General Public License, Version 3.
You should have received a copy of the GNU General Public License along with the Loomisoft Button Widget
plugin files. If not, see <http://www.gnu.org/licenses/>.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED
WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A
PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR
TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

defined( 'ABSPATH' ) or die();

define( 'LS_BW_PLUGIN_FILE', __FILE__ );
define( 'LS_BW_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'LS_BW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'LS_BW_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'LS_BW_PLUGIN_NAME', 'Button Widget by Loomisoft' );
define( 'LS_BW_PLUGIN_VERSION', '1.1.2' );
define( 'LS_BW_PLUGIN_WIDGET_SLUG', 'ls_button_widget' );
define( 'LS_BW_PLUGIN_PAGE_TITLE', 'Button Widget Usage & About' );
define( 'LS_BW_PLUGIN_PAGE_MENU_NAME', 'Button Widget' );
define( 'LS_BW_PLUGIN_PAGE_CAPABILITY', 'manage_options' );
define( 'LS_BW_PLUGIN_PAGE_SLUG', 'ls_bw_page' );
define( 'LS_BW_PLUGIN_PAGE_MENU_IMAGE', LS_BW_PLUGIN_URL . 'images/ls-wp-menu-icon.png' );
define( 'LS_BW_PLUGIN_WP_URL', 'https://wordpress.org/plugins/loomisoft-button-widget/' );

require_once( LS_BW_PLUGIN_PATH . 'includes/ls_button_widget.php' );

function ls_bw_register_widget() {

	register_widget( 'ls_button_widget' );

}

add_action( 'widgets_init', 'ls_bw_register_widget' );

function ls_bw_do_header() {

	$ls_button_widget = new ls_button_widget;

	$import_style = '';
	$style = '';

	$fonts_to_import = array();

	$widget_instances = get_option( 'widget_' . LS_BW_PLUGIN_WIDGET_SLUG );

	//echo '<!--' . print_r( $widgets, true ) . '-->';

	foreach ( $widget_instances as $id => $instance ) {
		if ( is_array( $instance ) ) {
			$instance = $ls_button_widget->get_clean_instance_values( $instance );

			$div_style = '';
			$link_style = '';
			$link_hover_style = '';

			if ( $instance[ 'top-margin' ] != '' ) {
				$div_style .= 'margin-top: ' . $instance[ 'top-margin' ] . 'px !important; ';
			}

			if ( $instance[ 'bottom-margin' ] != '' ) {
				$div_style .= 'margin-bottom: ' . $instance[ 'bottom-margin' ] . 'px !important; ';
			}

			if ( $instance[ 'horizontal-margin' ] != '' ) {
				$div_style .= 'margin-left: ' . $instance[ 'horizontal-margin' ] . 'px !important; margin-right: ' . $instance[ 'horizontal-margin' ] . 'px !important; ';
			}

			if ( $instance[ 'font-family' ] != '' ) {
				if ( $ls_button_widget->fonts[ $instance[ 'font-family' ] ][ 'category' ] == '' ) {
					$link_style .= 'font-family: ' . $ls_button_widget->fonts[ $instance[ 'font-family' ] ][ 'family' ] . ' !important; ';
					$link_hover_style .= 'font-family: ' . $ls_button_widget->fonts[ $instance[ 'font-family' ] ][ 'family' ] . ' !important; ';
				} else {
					$link_style .= 'font-family: "' . $ls_button_widget->fonts[ $instance[ 'font-family' ] ][ 'family' ] . '", ' . $ls_button_widget->fonts[ $instance[ 'font-family' ] ][ 'category' ] . ' !important; ';
					$link_hover_style .= 'font-family: "' . $ls_button_widget->fonts[ $instance[ 'font-family' ] ][ 'family' ] . '", ' . $ls_button_widget->fonts[ $instance[ 'font-family' ] ][ 'category' ] . ' !important; ';
					$fonts_to_import[] = $ls_button_widget->fonts[ $instance[ 'font-family' ] ][ 'family' ];
				}
			}

			if ( $instance[ 'font-size' ] != '' ) {
				$link_style .= 'font-size: ' . $instance[ 'font-size' ] . 'px !important; ';
				$link_hover_style .= 'font-size: ' . $instance[ 'font-size' ] . 'px !important; ';
			}

			if ( $instance[ 'line-height' ] != '' ) {
				$link_style .= 'line-height: ' . $instance[ 'line-height' ] . 'px !important; ';
				$link_hover_style .= 'line-height: ' . $instance[ 'line-height' ] . 'px !important; ';
			} elseif ( $instance[ 'font-size' ] != '' ) {
				$link_style .= 'line-height: 1.5em !important; ';
				$link_hover_style .= 'line-height: 1.5em !important; ';
			}

			if ( $instance[ 'color' ] != '' ) {
				$link_style .= 'color: ' . $instance[ 'color' ] . ' !important; ';
			}

			if ( $instance[ 'hover-color' ] != '' ) {
				$link_hover_style .= 'color: ' . $instance[ 'hover-color' ] . ' !important; ';
			}

			if ( $instance[ 'bold' ] != '' ) {
				$link_style .= 'font-weight: bold !important; ';
			}

			if ( $instance[ 'hover-bold' ] != '' ) {
				$link_hover_style .= 'font-weight: bold !important; ';
			} elseif ( $instance[ 'bold' ] != '' ) {
				$link_hover_style .= 'font-weight: normal !important; ';
			}

			if ( $instance[ 'italic' ] != '' ) {
				$link_style .= 'font-style: italic !important; ';
			}

			if ( $instance[ 'hover-italic' ] != '' ) {
				$link_hover_style .= 'font-style: italic !important; ';
			} elseif ( $instance[ 'italic' ] != '' ) {
				$link_hover_style .= 'font-style: normal !important; ';
			}

			if ( $instance[ 'underline' ] != '' ) {
				$link_style .= 'text-decoration: underline !important; ';
			}

			if ( $instance[ 'hover-underline' ] != '' ) {
				$link_hover_style .= 'text-decoration: underline !important; ';
			} elseif ( $instance[ 'underline' ] != '' ) {
				$link_hover_style .= 'text-decoration: none !important; ';
			}

			if ( $instance[ 'background-color' ] != '' ) {
				$link_style .= 'background-color: ' . $instance[ 'background-color' ] . ' !important; ';
			}

			if ( $instance[ 'background-hover-color' ] != '' ) {
				$link_hover_style .= 'background-color: ' . $instance[ 'background-hover-color' ] . ' !important; ';
			}

			if ( $instance[ 'border-width' ] != '' ) {
				$link_style .= 'border-width: ' . $instance[ 'border-width' ] . 'px !important; border-style: solid; ';

				if ( $instance[ 'border-color' ] != '' ) {
					$link_style .= 'border-color: ' . $instance[ 'border-color' ] . ' !important; ';
				}

				if ( $instance[ 'border-hover-color' ] != '' ) {
					$link_hover_style .= 'border-color: ' . $instance[ 'border-hover-color' ] . ' !important; ';
				}
			}

			if ( $instance[ 'border-radius' ] != '' ) {
				$link_style .= 'border-radius: ' . $instance[ 'border-radius' ] . 'px !important; -webkit-border-radius: ' . $instance[ 'border-radius' ] . 'px !important; -moz-border-radius: ' . $instance[ 'border-radius' ] . 'px !important; ';
			}

			if ( $instance[ 'vertical-padding' ] != '' ) {
				$link_style .= 'padding-top: ' . $instance[ 'vertical-padding' ] . 'px !important; padding-bottom: ' . $instance[ 'vertical-padding' ] . 'px !important; ';
			}

			if ( $instance[ 'horizontal-padding' ] != '' ) {
				$link_style .= 'padding-left: ' . $instance[ 'horizontal-padding' ] . 'px !important; padding-right: ' . $instance[ 'horizontal-padding' ] . 'px !important; ';
			}

			if ( $div_style != '' ) {
				$div_style = '#ls-button-widget-' . esc_attr( LS_BW_PLUGIN_WIDGET_SLUG ) . '-' . esc_attr( $id ) . ' { ' . $div_style . '} ';
			}

			if ( $link_style != '' ) {
				$link_style = '#ls-button-widget-link-' . esc_attr( LS_BW_PLUGIN_WIDGET_SLUG ) . '-' . esc_attr( $id ) . ', #ls-button-widget-link-' . esc_attr( LS_BW_PLUGIN_WIDGET_SLUG ) . '-' . esc_attr( $id ) . ':link, #ls-button-widget-link-' . esc_attr( LS_BW_PLUGIN_WIDGET_SLUG ) . '-' . esc_attr( $id ) . ':active, #ls-button-widget-link-' . esc_attr( LS_BW_PLUGIN_WIDGET_SLUG ) . '-' . esc_attr( $id ) . ':visited { ' . $link_style . '} ';
			}

			if ( $link_hover_style != '' ) {
				$link_hover_style = '#ls-button-widget-link-' . esc_attr( LS_BW_PLUGIN_WIDGET_SLUG ) . '-' . esc_attr( $id ) . ':hover { ' . $link_hover_style . '} ';
			}

			$style .= $div_style . $link_style . $link_hover_style;
		}
	}

	$fonts_to_import = array_unique( $fonts_to_import );

	foreach ( $fonts_to_import as $font_to_import ) {
		$import_style .= '@import url("https://fonts.googleapis.com/css?family=' . urlencode( $font_to_import ) . '"); ';
	}

	$style = $import_style . $style;

	if ( $style != '' ) {
		echo '<style type="text/css"> ' . $style . '</style>';
	}
}

add_action( 'wp_head', 'ls_bw_do_header' );