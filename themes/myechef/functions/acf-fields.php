<?php // functions/acf-fields.php


 //**********
// FUNCTIONS

// various functions, often providing specific, more detailed
// control than the standard advance custom fields functions

if ( ! function_exists('get_field_labels') ) {

	$field_choices = NULL;

	function get_field_labels($field_name = NULL) {

		global $field_choices;

		if ( $field_choices !== NULL ) {
			return $field_choices[$field_name];
		}

		$field_groups = new query_loop(array(
			'post_type' => 'acf',
			'posts_per_page' => -1,
		));

		foreach ( $field_groups as $post ) {

			$fields = apply_filters('acf/field_group/get_fields', array(), get_the_ID());

			foreach ( $fields as $field ) {
				$field_choices[$field['name']] = $field['choices'];
			}

		}

		if ( $field_name !== NULL ) {
			return $field_choices[$field_name];
		}

		return $field_choices;

	}

}

if ( ! function_exists('get_field_label') ) {

	function get_field_label($field_name) {

		$field_objects = get_field_objects();

		$values = get_field($field_name);

		if ( is_array($values) ) {

			foreach ( $values as $key => $value ) {
				$values[$key] = $field_objects[$field_name]['choices'][$value];
			}

		} else {
			$values = $field_objects[$field_name]['choices'][$values];
		}

		return $values;

	}

}

if ( ! function_exists('the_field_label') ) {

	function the_field_label($field_name) {
		echo get_field_label($field_name);
	}

}


// we can turn the ACF plugin(s) into 'lite' mode by
// setting the following constant in the config

// define( 'ACF_LITE', true );