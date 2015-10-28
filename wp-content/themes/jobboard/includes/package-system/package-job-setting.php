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


return jobboard_job_package_settings();

function jobboard_job_package_settings() {

  return array(

  	array(
  		'type' => 'textbox',
  		'name' => 'package_job_limit',
  		'label' => __( 'Maximum Jobs', 'jobboard' ),
  		'description' => __( 'Enter maximum number of allowed jobs will be posted.', 'jobboard' ),
  		'validation' => 'numeric',
  	),
    array(
  		'type' => 'textbox',
  		'name' => 'package_job_price',
  		'label' => __( 'Price', 'jobboard' ),
  		'description' => __( 'Enter the package price.', 'jobboard' ),
  		'validation' => 'numeric',
  	),
    array(
  		'type' => 'textarea',
  		'name' => 'package_job_notes',
  		'label' => __( 'Notes', 'jobboard' ),
  		'description' => __( 'Write something about the job package.', 'jobboard' ),
  	),

  );


}
