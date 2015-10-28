<?php
/**
 * Job Board submit action form
 * Use to proccess submitted form from frontend submission like, "Post Resume", "Post Job" etc.
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 */
?><?php

if( isset( $_POST['form_type'] ) ){
	$form_type = $_POST['form_type'];
	switch($form_type){

		case 'post_resume':
			jobboard_post_resume($_POST, $_FILES);
			break;
		
		case 'edit_post_resume';
			jobboard_post_resume( $_POST, $_FILES, true );
			break;
			
		case 'post_job';
			jobboard_post_job($_POST);	
			break;
		
		case 'edit_post_job';
			jobboard_post_job( $_POST, true );
			break;
			
		case 'post_company';
			jobboard_post_company( $_POST, $_FILES );
			break;
			
		case 'edit_post_company';
			jobboard_post_company( $_POST, $_FILES, true );
			break;
			
	}//endswitch;
}
