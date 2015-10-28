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
    'type' => 'textarea',
    'name' => 'company_portfolio_headline',
    'label' => __( 'Headline', 'jobboard' )
  ),

  array(
    'type' => 'group',
    'repeating' => false,
    'name' => 'company_portfolio_group_container',
    'title' => __('Company\'s Portfolios', 'jobboard'),
    'fields' => array(

      array(
        'type'      => 'group',
        'repeating' => true,
        'length'    => 10,
        'name'      => 'company_portfolio_group',
        'title'     => __('Client', 'jobboard'),
        'fields'    => array(

          array(
            'type' => 'upload',
            'name' => 'portfolio_image',
            'label' => __('Portfolio Image', 'jobboard'),
          ),
          array(
            'type' => 'textbox',
            'name' => 'portfolio_stored_image_id',
            'label' => __('Previously stored image id', 'jobboard'),
          ),
          array(
            'type' => 'textbox',
            'name' => 'portfolio_url',
            'label' => __('Portfolio URL', 'jobboard'),
          ),


        ),
      ),


    ),
  ),

);
