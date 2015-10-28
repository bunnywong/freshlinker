<?php

/**
* Job Board "Company Clients" metabox template.
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
    'name' => 'company_client_headline',
    'label' => __( 'Headline', 'jobboard' )
  ),

  array(
    'type' => 'group',
    'repeating' => false,
    'name' => 'company_client_group_container',
    'title' => __('Company\'s Clients', 'jobboard'),
    'fields' => array(

      array(
        'type'      => 'group',
        'repeating' => true,
        'length'    => 10,
        'name'      => 'company_client_group',
        'title'     => __('Client', 'jobboard'),
        'fields'    => array(

            array(
              'type' => 'textbox',
              'name' => 'project_name',
              'label' => __('Project Name', 'jobboard'),
            ),
            array(
              'type' => 'textbox',
              'name' => 'project_year',
              'label' => __('Project Date', 'jobboard'),
            ),
            array(
              'type' => 'textbox',
              'name' => 'project_url',
              'label' => __('Project URL', 'jobboard'),
            ),
            array(
              'type' => 'textarea',
              'name' => 'project_detail',
              'label' => __( 'Project Detail', 'jobboard' ),
            ),
            /* more controls fields or even nested group ... */
        ),
      ),

    ),
  ),




);
