<?php


/*------------------------------------------------------------*/
/*	Register "Resume Subscription" Post Type	*/
/*------------------------------------------------------------*/
if ( ! function_exists('jobboard_register_resume_subscription_post_type') ) {

// Register Resume Subscription Post Type
function jobboard_register_resume_subscription_post_type() {

	$labels = array(
		'name'                => _x( 'Resume Subscription', 'Post Type General Name', 'jobboard' ),
		'singular_name'       => _x( 'Resume Subscription', 'Post Type Singular Name', 'jobboard' ),
		'menu_name'           => __( 'Resume Subscription', 'jobboard' ),
		'parent_item_colon'   => __( 'Parent Resume Subscription:', 'jobboard' ),
		'all_items'           => __( 'All Resume Subscription', 'jobboard' ),
		'view_item'           => __( 'View Resume Subscription', 'jobboard' ),
		'add_new_item'        => __( 'Add New Resume Subscription', 'jobboard' ),
		'add_new'             => __( 'Add New', 'jobboard' ),
		'edit_item'           => __( 'Edit Resume Subscription', 'jobboard' ),
		'update_item'         => __( 'Update Resume Subscription', 'jobboard' ),
		'search_items'        => __( 'Search Resume Subscription', 'jobboard' ),
		'not_found'           => __( 'Not found', 'jobboard' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'jobboard' ),
	);
	$args = array(
		'label'               => __( '_resume_subscription_job', 'jobboard' ),
		'description'         => __( 'Post Type Description', 'jobboard' ),
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 57.11,
		'menu_icon'           => 'dashicons-star-filled',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( '_resume_subscription', $args );

}

// Hook into the 'init' action
add_action( 'init', 'jobboard_register_resume_subscription_post_type', 0 );

}




/*--------------------------------------------------------*/
/*	Register "Resume Subscription" Metabox	*/
/*--------------------------------------------------------*/
if( !function_exists( 'jobboard_resume_subscription_metaboxes' ) ){

function jobboard_resume_subscription_metaboxes(){
    // Built path to metabox template array file
    $mb_path  = get_template_directory() . '/includes/resume-subscription/resume-subscription-setting.php';
    // Initialize the Metabox's object
    // We can use array or file path to the array specification file.
    $mb = new VP_Metabox(array(
        'id'          => 'jobboard_resume_subscription_mb',
        'types'       => array('_resume_subscription'),
        'title'       => __('Settings', 'jobboard'),
        'priority'    => 'high',
        'is_dev_mode' => false,
        'template'    => $mb_path,
        'prefix'	  => '_jboard_',
        'mode' => WPALCHEMY_MODE_EXTRACT
    ));
}
// the safest hook to use, since Vafpress Framework may exists in Theme or Plugin
add_action( 'after_setup_theme', 'jobboard_resume_subscription_metaboxes' );

}


/**
 * Set count single resume visit
 */

if( !function_exists( 'jobboard_single_post_visit' ) ){

	function jobboard_set_single_post_visit($post_id){

		if( !jobboard_package_is_enabled('_package_resume_view') ){
			return;
		}

		$count_key = 'single_post_visit';

		$single_count_meta = get_post_meta($post_id, $count_key, true);

		if( $single_count_meta == '' ){

			$count = 0;
			delete_post_meta($post_id, $count_key);
			add_post_meta($post_id, $count_key, '0');

		}else{
				$count = $single_count_meta;
			  $count++;
				update_post_meta($post_id, $count_key, $count);
		}

	}

}

/**
 * Get count single resume visit
 */

if( !function_exists( 'jobboard_get_single_post_visit_count' ) ){

	function jobboard_get_single_post_visit_count($post_id){

		$count_key = 'single_post_visit';
		return get_post_meta($post_id, $count_key, true);

	}

}



/**
 * Set count of visited resume for current user
 */

function jobboard_set_user_view_count($user_id, $cpt){

	if( !is_user_logged_in() && !jobboard_package_is_enabled('_package_resume_view') ){
		return;
	} else {

		$count_key = 'single_visit_'.$cpt.'_'.$user_id;

		$user_count_meta = get_user_meta($user_id, $count_key, true);

		if( $user_count_meta == '' ){

			$count = 0;
			delete_user_meta($user_id, $count_key);
			add_user_meta($user_id, $count_key, '0');

		}else{
				$count = $user_count_meta;
			  $count++;
				update_user_meta($user_id, $count_key, $count);
		}

	}


}



/**
 * Get count user visit count
 */

function jobboard_get_user_view_count($user_id, $cpt){

	if( !is_user_logged_in() ){
		return;
	} else {

		$count_key = 'single_visit_'.$cpt.'_'.$user_id;
		return get_user_meta($user_id, $count_key, true);

	}

}



/**
 * Check if resume view is limited
 */

function jobboard_is_user_view_limit($user_id, $cpt){

	$unlimited = get_user_meta( $user_id, 'jobboard_user_'.$cpt.'_subscription_max_entry', true);

	if($unlimited == 'unlimited'){
		return false;
	}

	$user_views_count = jobboard_get_user_view_count( $user_id, $cpt );
	$user_views_max = jobboard_get_user_limit_entry( $user_id, '_'.$cpt.'_subscription');

	$count_key = 'single_visit_'.$cpt.'_'.$user_id;
	$user_single_visit_count = get_user_meta($user_id, $count_key, true);

	if( $user_views_count == '0' ){

		delete_user_meta( $user_id, 'jobboard_user'.$cpt.'_subscription_max_entry' );
		
	}

	if( $user_views_count > $user_views_max || $user_views_count == $user_views_max || $user_views_count == '0' && !empty($user_views_count) ){

		return true;

	} else {

		return false;

	}

}



/**
 * Get remaining views
 */

function jobboard_get_user_view_remaining($user_id, $cpt){

	$user_views_count = jobboard_get_user_view_count( $user_id, $cpt );
	$user_views_max = jobboard_get_user_limit_entry( $user_id, '_'.$cpt.'_subscription');


	$unlimited = get_user_meta( $user_id, 'jobboard_user_'.$cpt.'_subscription_max_entry', true );

	if($unlimited == 'unlimited'){
		return 'unlimited';
	}

	if( empty($user_views_max) ){
		return 0;
	} else {
		return 	$user_views_max - $user_views_count;
	}

	/*
	if( $unlimited == 'unlimited' ){

		return 'unlimited';

	} else {

		return 	$user_views_max - $user_views_count;

	}
	*/

}
