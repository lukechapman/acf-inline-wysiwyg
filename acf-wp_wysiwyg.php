<?php

/*
Plugin Name: Advanced Custom Fields: Inline WYSIWYG Field
Plugin URI: https://github.com/lukechapman/acf-inline-wysiwyg
Description: Adds an inline WYSIWYG field (using Medium Editor) to the Advanced Custom Fields plugin.
Version: 1.0.2
Author: Luke Chapman
Author URI: http://github.com/lukechapman
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function inline_wysiwyg_enqueue_scripts() {
	wp_enqueue_style( 'medium-editor-css', plugin_dir_url( __FILE__ ) . 'includes/css/medium-editor.css', array(), '5.21.0', null);
	wp_enqueue_style( 'medium-editor-css-theme', plugin_dir_url( __FILE__ ) . 'includes/css/themes/beagle.css', array(), '5.21.0', null);
	wp_enqueue_style( 'inline-wysiwyg-css', plugin_dir_url( __FILE__ ) . 'includes/css/inline-wysiwyg.css', array(), '5.21.0', null);
	wp_enqueue_script( 'medium-editor-js', plugin_dir_url( __FILE__ ) . 'includes/js/medium-editor.min.js', array(), '5.21.0', true );
	wp_enqueue_script( 'inline-wysiwyg-js', plugin_dir_url( __FILE__ ) . 'includes/js/inline-wysiwyg.js', array('jquery', 'medium-editor-js'), '1.0.2', true );
}

add_action( 'acf/input/admin_enqueue_scripts', 'inline_wysiwyg_enqueue_scripts', 10, 1 );

// Include field type for ACF5
// $version = 5 and can be ignored until ACF6 exists
function include_field_types_wp_wysiwyg( $version ) {
	include_once('acf-wp_wysiwyg-v5.php');
}

add_action('acf/include_field_types', 'include_field_types_wp_wysiwyg');	

?>