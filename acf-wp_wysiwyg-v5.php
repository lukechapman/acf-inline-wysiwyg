<?php

/*
*  ACF Inline WYSIWYG Field Class
*
*  All the logic for this field type
*
*  @class 		acf_field_inline_wysiwyg
*  @extends		acf_field
*  @package		ACF
*  @subpackage	Fields
*  @version		1.0.1
*/

if( ! class_exists('acf_field_inline_wysiwyg') ) :

class acf_field_inline_wysiwyg extends acf_field {
	
	/*
	* __construct
	*
	* This function will setup the field type data
	*
	* @type function
	* @date 5/03/2014
	* @since 5.0.0
	*
	* @param n/a
	* @return n/a
	*/
	
	function __construct() {
		
		// vars
		$this->name = 'inline_wysiwyg';
		$this->label = __('Inline Wysiwyg Editor');
		$this->category = 'content';
		$this->defaults = array(
			'default_value'	=> '',
		);
		
		
		// do not delete!
    	parent::__construct();

	}
	

	/*
	* render_field_settings()
	*
	* Create extra settings for your field. These are visible when editing a field
	*
	* @type action
	* @since 3.6
	* @date 23/01/13
	*
	* @param $field (array) the $field being edited
	* @return n/a
	*/
	
	function render_field_settings( $field ) {
		
		// default_value
		acf_render_field_setting( $field, array(
			'label'			=> __('Default Value', 'inline_wysiwyg'),
			'instructions'	=> __('Appears when creating a new post', 'inline_wysiwyg'),
			'type'			=> 'text',
			'name'			=> 'default_value',
		));
	
	}
		
	
	/*
	* render_field()
	*
	* Create the HTML interface for your field
	*
	* @param $field (array) the $field being rendered
	*
	* @type action
	* @since 3.6
	* @date 23/01/13
	*
	* @param $field (array) the $field being edited
	* @return n/a
	*/
	
	function render_field( $field ) {
		
		// unique id
		$id = 'inline-wysiwyg-' . $field['id'] . '-' . uniqid();
		
		// textarea field that initialises Medium Editor
		echo '<textarea id="'.$id.'" class="inline-wysiwyg" name="'.$field['name'].'">'.$field['value'].'</textarea>';
		
	}

	/*
	*  update_value()
	*
	*  This filter is applied to the $value before it is saved in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	
	function update_value( $value, $post_id, $field ) {
		
		return htmlentities($value);
		
	}
	
	
	/*
	* format_value()
	*
	* This filter is appied to the $value after it is loaded from the db and before it is returned to the template
	*
	* @type filter
	* @since 3.6
	* @date 23/01/13
	*
	* @param $value (mixed) the value which was loaded from the database
	* @param $post_id (mixed) the $post_id from which the value was loaded
	* @param $field (array) the field array holding all the field options
	*
	* @return $value (mixed) the modified value
	*/
	
	function format_value( $value, $post_id, $field ) {
		
		// bail early if no value
		if( empty($value) ) {
			
			return $value;
		
		}
		
		
		// apply filters
		//$value = apply_filters( 'acf_the_content', $value );
		
		// follow the_content function in /wp-includes/post-template.php
		//$value = str_replace(']]>', ']]&gt;', $value);
		
	
		return html_entity_decode($value);
		
	}
	
	
}

new acf_field_inline_wysiwyg();

endif;

?>