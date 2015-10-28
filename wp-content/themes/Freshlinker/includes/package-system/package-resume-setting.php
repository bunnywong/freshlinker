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


return jobboard_resume_package_settings();

function jobboard_resume_package_settings() {

  return array(

  	array(
  		'type' => 'textbox',
  		'name' => 'package_resume_limit',
  		'label' => __( 'Maximum Resumes', 'jobboard' ),
  		'description' => __( 'Enter maximum number of allowed jobs will be posted.', 'jobboard' ),
  		'validation' => 'numeric',
  	),
    array(
  		'type' => 'textbox',
  		'name' => 'package_resume_price',
  		'label' => __( 'Price', 'jobboard' ),
  		'description' => __( 'Enter the package price.', 'jobboard' ),
  		'validation' => 'numeric',
  	),
    array(
  		'type' => 'textarea',
  		'name' => 'package_resume_notes',
  		'label' => __( 'Notes', 'jobboard' ),
  		'description' => __( 'Write something about the resume package.', 'jobboard' ),
  	),

  );


}
