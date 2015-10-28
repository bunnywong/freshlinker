<?php

/**
 * Job Board "Job Package" metabox template.
 * Define field for "Job" post type metabox
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.7.1
 */


/*-----------------------------------------------------*/
/*	Directly return the template value with array	*/
/*-----------------------------------------------------*/


return jobboard_resume_view_package_settings();


function jobboard_resume_view_package_settings() {

  return array(

  	array(
  		'type' => 'textbox',
  		'name' => 'resume_subscription_limit',
  		'label' => __( 'Maximum Views', 'jobboard' ),
  		'description' => __( 'Enter maximum resume views will be allowed.', 'jobboard' ),
  		'validation' => 'numeric',
  	),
    array(
  		'type'	=> 'toggle',
  		'name'	=> 'resume_subscription_is_unlimited',
  		'label'	=> __( 'Unlimited views?', 'jobboard' ),
  	),    
    array(
  		'type' => 'textbox',
  		'name' => 'resume_subscription_price',
  		'label' => __( 'Price', 'jobboard' ),
  		'description' => __( 'Enter the package price.', 'jobboard' ),
  		'validation' => 'numeric',
  	),
    array(
  		'type' => 'textarea',
  		'name' => 'resume_subscription_notes',
  		'label' => __( 'Notes', 'jobboard' ),
  		'description' => __( 'Write something about the job package.', 'jobboard' ),
  	),

  );


}
