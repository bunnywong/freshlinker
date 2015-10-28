<?php

/**
 * Job Board "Slider" metabox template.
 * Define field for "Slider" post type metabox
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 */


/*-----------------------------------------------------*/
/*	Directly return the template value with array	*/
/*-----------------------------------------------------*/
/*
return array(
  array(
    'type' => 'textarea',
    'name' => 'company_overview_2',
    'label' => __( 'Company Overview', 'jobboard' ),
    'description' => __( 'Write an overview about your company.', 'jobboard' ),
  ),
  array(
   'type' => 'upload',
   'name' => 'up_1',
   'label' => __('Upload', 'vp_textdomain'),
   'description' => __('Media uploader, using the powerful WP Media Upload', 'vp_textdomain'),
   'default' => 'http://placehold.it/70x70',
 ),
);
*/


return array(

  array(
		'type'		=> 'group',
		'repeating'	=> true,
		'length'	=> 100,
		'name'		=> 'slider_group',
		'title'		=> __( 'Slider Item', 'jobboard' ),
		'fields'	=> array(

      array(
         'type' => 'upload',
         'name' => 'slider_item_img',
         'label' => __('Upload an image', 'jobboard'),
         'description' => __('', 'jobboard'),
         'default' => 'http://placehold.it/70x70',
      ),

      array(
        'type' => 'textbox',
        'name' => 'slider_item_img_url',
        'label' => __('Slider Item URL', 'jobboard'),
        'description' => __('', 'jobboard'),
        'default' => '',
        'validation' => 'url',
      ),

		),
	),

);
