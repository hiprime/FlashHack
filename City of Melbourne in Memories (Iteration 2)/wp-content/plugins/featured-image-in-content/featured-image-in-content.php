<?php
/**
 * Plugin Name: Featured Image in Content
 * Plugin URI: http://celloexpressions.com/plugins/featured-image-in-content
 * Description: If you switch to a theme that doesn't show featured images on single posts, activate this plugin to show them in the content area.
 * Version: 1.0
 * Author: Nick Halsey
 * Author URI: http://celloexpressions.com/
 * Tags: featured image, post thumbnail
 * License: GPL

=====================================================================================
Copyright (C) 2015 Nick Halsey

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with WordPress; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
=====================================================================================
*/

add_filter( 'the_content', 'featured_image_in_content_add_to_content' );
function featured_image_in_content_add_to_content( $content ) {
	if ( is_singular() && has_post_thumbnail() ) {
		return get_the_post_thumbnail( null, 'large' ) . $content;
	} else {
		return $content;
	}
}