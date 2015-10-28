<?php

/**
* Job Board "Company Testimonial" metabox template.
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
    'type' => 'textarea',
    'name' => 'company_testimonial_headline',
    'label' => __( 'Headline', 'jobboard' )
  ),
  array(
    'type' => 'textarea',
    'name' => 'company_testimonial_content',
    'label' => __( 'Testimonial Content', 'jobboard' )
  ),
  array(
    'type' => 'textbox',
    'name' => 'company_testimonial_author',
    'label' => __('Author', 'jobboard'),
  ),
  array(
    'type' => 'textbox',
    'name' => 'company_testimonial_author_occupation',
    'label' => __('Author Occupation', 'jobboard'),
  ),
  array(
    'type' => 'textbox',
    'name' => 'company_testimonial_author_url',
    'label' => __('Author URL', 'jobboard'),
  ),
  array(
    'type' => 'upload',
    'name' => 'company_testimonial_author_avatar',
    'label' => __('Avatar', 'jobboard'),
  ),

);
