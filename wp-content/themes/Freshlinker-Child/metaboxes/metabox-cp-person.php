<?php

/**
 * Job Board "CP Person" metabox template.
 * Define field for "Company" post type metabox
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 */


/*-----------------------------------------------------*/
/*	Directly return the template value with array	*/
/*-----------------------------------------------------*/
return array(
	array(
		'type' => 'textbox',
		'name' => 'cp_ldin_address',
		'label' => __( 'Company Linkedin URL', 'jobboard' ),
		'validation' => 'url',
	),
	array(
		'type' => 'textbox',
		'name' => 'cp_ldin_user',
		'label' => __( 'Company Linkedin User Name', 'jobboard' ),
	),
	array(
		'type' => 'textbox',
		'name' => 'cp_person',
		'label' => __( 'Contact Person', 'jobboard' ),
	),
	array(
		'type' => 'select',
		'name' => 'cp_person_title',
		'label' => __( 'Contact Person Title', 'jobboard' ),
		'items' => array(
			array(
				'value' => 'mr',
				'label' => __('Mr', 'vp_textdomain'),
			),
			array(
				'value' => 'mrs',
				'label' => __('Mrs', 'vp_textdomain'),
			),
			array(
				'value' => 'ms',
				'label' => __('Ms', 'vp_textdomain'),
			),
        ),
	),
	array(
		'type' => 'textbox',
		'name' => 'cp_email',
		'label' => __( 'Email', 'jobboard' ),
		'validation' => 'email',
	),
	array(
		'type' => 'textbox',
		'name' => 'cp_phone',
		'label' => __( 'Phone', 'jobboard' ),
	),

);
