<?php

/**
* Job Board "Company Portfolio" metabox template.
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
    'name' => 'company_address_gmap_latitude',
    'label' => __( 'Google Map Latiude', 'jobboard' )
  ),
  array(
    'type' => 'textbox',
    'name' => 'company_address_gmap_longitude',
    'label' => __( 'Google Map Longitude', 'jobboard' )
  ),
  array(
    'type' => 'textbox',
    'name' => 'company_address',
    'label' => __( 'Address', 'jobboard' )
  ),
  array(
    'type' => 'textbox',
    'name' => 'company_phone',
    'label' => __( 'Phone', 'jobboard' )
  ),
  array(
    'type' => 'textbox',
    'name' => 'company_email',
    'label' => __( 'Email', 'jobboard' )
  ),

);
