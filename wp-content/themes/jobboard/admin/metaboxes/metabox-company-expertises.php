<?php

/**
* Job Board "Company Expertise" metabox template.
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
    'name' => 'company_expertises_headline',
    'label' => __( 'Headline', 'jobboard' )
  ),

  array(
    'type' => 'multiselect',
    'name' => 'company_expertises',
    'label' => __('Expertises', 'vp_textdomain'),
    // 'validation' => 'minselected[2]|maxselected[3]',
    'items' => jboard_company_expertises_meta_lists(),
    'default' => jboard_company_expertises_meta_lists_selected()

  ),


);
