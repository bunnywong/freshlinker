<?php

/**
* Job Board "Company Services" metabox template.
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
    'name' => 'company_service_headline',
    'label' => __( 'Headline', 'jobboard' )
    ),


    array(
      'type' => 'group',
      'repeating' => false,
      'length'    => 1,
      'name' => 'company_service_group_container',
      'title' => __('Company Services', 'jobboard'),
      'fields' => array(

          array(
            'type'      => 'group',
            'repeating' => true,
            'length'    => 1,
            'name'      => 'company_service_group',
            'title'     => __('Service', 'jobboard'),
            'fields'    => array(

              array(
                'type' => 'textbox',
                'name' => 'service_icon',
                'label' => __('Service Icon', 'jobboard'),
              ),
              array(
                'type' => 'textbox',
                'name' => 'service_name',
                'label' => __('Service Name', 'jobboard'),
              ),
              array(
                'type' => 'textarea',
                'name' => 'company_service_detail',
                'label' => __( 'Service Detail', 'jobboard' ),
              ),
              /* more controls fields or even nested group ... */

          ),
        ),


      ),
    ),

    );
