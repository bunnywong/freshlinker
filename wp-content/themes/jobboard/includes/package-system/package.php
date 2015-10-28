<?php


/**
 * Job Package Board custom post type and taxonomy function.
 * Build package system.
 *
 * @package WordPress
 * @subpackage Job Package_Board
 * @since Job Package Board 1.7.1
 */


/*------------------------------------------------------------*/
/*	Register "Job Package" Post Type	*/
/*------------------------------------------------------------*/
if ( ! function_exists('jobboard_register_package_post_type') ) {

// Register Job Package Post Type
function jobboard_register_package_post_type() {

	$labels = array(
		'name'                => _x( 'Job Package', 'Post Type General Name', 'jobboard' ),
		'singular_name'       => _x( 'Job Package', 'Post Type Singular Name', 'jobboard' ),
		'menu_name'           => __( 'Job Package', 'jobboard' ),
		'parent_item_colon'   => __( 'Parent Job Package:', 'jobboard' ),
		'all_items'           => __( 'All Job Package', 'jobboard' ),
		'view_item'           => __( 'View Job Package', 'jobboard' ),
		'add_new_item'        => __( 'Add New Job Package', 'jobboard' ),
		'add_new'             => __( 'Add New', 'jobboard' ),
		'edit_item'           => __( 'Edit Job Package', 'jobboard' ),
		'update_item'         => __( 'Update Job Package', 'jobboard' ),
		'search_items'        => __( 'Search Job Package', 'jobboard' ),
		'not_found'           => __( 'Not found', 'jobboard' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'jobboard' ),
	);
	$args = array(
		'label'               => __( '_package_job', 'jobboard' ),
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
	register_post_type( '_package_job', $args );

}

// Hook into the 'init' action
add_action( 'init', 'jobboard_register_package_post_type', 0 );

}



/*------------------------------------------------------------*/
/*	Register "Resume Package" Post Type	*/
/*------------------------------------------------------------*/
if ( ! function_exists('jobboard_register_package_post_type_resume') ) {

// Register Resume Package Post Type
function jobboard_register_package_post_type_resume() {

	$labels = array(
		'name'                => _x( 'Resume Package', 'Post Type General Name', 'jobboard' ),
		'singular_name'       => _x( 'Resume Package', 'Post Type Singular Name', 'jobboard' ),
		'menu_name'           => __( 'Resume Package', 'jobboard' ),
		'parent_item_colon'   => __( 'Parent Resume Package:', 'jobboard' ),
		'all_items'           => __( 'All Resume Package', 'jobboard' ),
		'view_item'           => __( 'View Resume Package', 'jobboard' ),
		'add_new_item'        => __( 'Add New Resume Package', 'jobboard' ),
		'add_new'             => __( 'Add New', 'jobboard' ),
		'edit_item'           => __( 'Edit Resume Package', 'jobboard' ),
		'update_item'         => __( 'Update Resume Package', 'jobboard' ),
		'search_items'        => __( 'Search Resume Package', 'jobboard' ),
		'not_found'           => __( 'Not found', 'jobboard' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'jobboard' ),
	);
	$args = array(
		'label'               => __( '_package_resume', 'jobboard' ),
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
	register_post_type( '_package_resume', $args );

}

// Hook into the 'init' action
add_action( 'init', 'jobboard_register_package_post_type_resume', 0 );

}




/*--------------------------------------------------------*/
/*	Register "Job Package" Metabox	*/
/*--------------------------------------------------------*/
if( !function_exists( 'jobboard_job_package_metaboxes' ) ){

function jobboard_job_package_metaboxes(){
    // Built path to metabox template array file
    $mb_path  = get_template_directory() . '/includes/package-system/package-job-setting.php';
    // Initialize the Metabox's object
    // We can use array or file path to the array specification file.
    $mb = new VP_Metabox(array(
        'id'          => 'jobboard_job_package_mb',
        'types'       => array('_package_job'),
        'title'       => __('Settings', 'jobboard'),
        'priority'    => 'high',
        'is_dev_mode' => false,
        'template'    => $mb_path,
        'prefix'	  => '_jboard_',
        'mode' => WPALCHEMY_MODE_EXTRACT
    ));
}
// the safest hook to use, since Vafpress Framework may exists in Theme or Plugin
add_action( 'after_setup_theme', 'jobboard_job_package_metaboxes' );

}



/*--------------------------------------------------------*/
/*	Register "Resume Package" Metabox	*/
/*--------------------------------------------------------*/
if( !function_exists( 'jobboard_resume_package_metaboxes' ) ){

function jobboard_resume_package_metaboxes(){
    // Built path to metabox template array file
    $mb_path  = get_template_directory() . '/includes/package-system/package-resume-setting.php';
    // Initialize the Metabox's object
    // We can use array or file path to the array specification file.
    $mb = new VP_Metabox(array(
        'id'          => 'jobboard_resume_package_mb',
        'types'       => array('_package_resume'),
        'title'       => __('Settings', 'jobboard'),
        'priority'    => 'high',
        'is_dev_mode' => false,
        'template'    => $mb_path,
        'prefix'	  => '_jboard_',
        'mode' => WPALCHEMY_MODE_EXTRACT
    ));
}
// the safest hook to use, since Vafpress Framework may exists in Theme or Plugin
add_action( 'after_setup_theme', 'jobboard_resume_package_metaboxes' );

}





/**
 * Check if package enabled
*/

function jobboard_package_is_enabled($cpt){

	$option = jobboard_option( 'enable'.$cpt );

	if($option == '1'){
		return true;
	} else {
		return false;
	}

}



/**
 * Get job packages object
 * $cpt = Package CPT slug
 */


function jobboard_get_packages_obj($cpt){

  $args = array(
    'post_type'		=> $cpt,
    'post_status' => 'publish',
    'posts_per_page' => -1
  );

  $posts_array = get_posts( $args );

  return $posts_array;

}


/**
 * Get number of job posted by user (user ID)
 * $user_id = User ID
 * $cpt = Package CPT slug
 */

function jobboard_get_number_entries_by_user($user_id, $cpt){

	$the_cpt = '';
	if($cpt == '_package_job'){
		$the_cpt = 'job';
	}
	if($cpt == '_package_resume'){
		$the_cpt = 'resume';
	}

  $args = array(
    'post_type'		=> $the_cpt,
    'author' => $user_id,
    'post_status' => 'publish',
    'posts_per_page' => -1
  );

  $posts_array = get_posts( $args );


	$args_feature = array(
		'post_type'		=> $the_cpt,
    'author' => $user_id,
    'post_status' => 'publish',
    'posts_per_page' => -1,
		'meta_key' => '_jboard_job_featured',
		'meta_value' => '1'
	);

	$posts_array_feature = get_posts( $args_feature );

	// return $posts_array;

	// Exclude feature post
  return count($posts_array)-count($posts_array_feature);


}


/**
 * Get user job package
 * $user_id = User ID
 * $cpt = Package CPT slug
 */

function jobboard_get_user_package($user_id, $cpt){

  $meta_key = 'jobboard_user'.$cpt;

  return get_user_meta( $user_id, $meta_key, true );

}

/**
 * Get active package data.
 * $user_id = User ID
 * $cpt = Package CPT slug
 */

function jobboard_get_user_active_package_data($user_id, $cpt){

  $pack_id = jobboard_get_user_package($user_id, $cpt);

  $package_data = get_post($pack_id);

  return $package_data;

}

/**
 * Get limit entry of user
 * $user_id = User ID
 * $cpt = Package CPT slug
 */

function jobboard_get_user_limit_entry($user_id, $cpt){

  $active_pack = jobboard_get_user_active_package_data($user_id, $cpt);
  $pack_id = $active_pack->ID;

  $meta_key = '_jboard'.$cpt.'_limit';

  $limit = get_post_meta($pack_id, $meta_key, true);


	$limit_user_entry = get_user_meta($user_id, 'jobboard_user'.$cpt.'_max_entry', true);

  // return (int)$limit;

	return (int)$limit_user_entry;

}


/**
 * Show remaning posts to publish
 * $user_id = User ID
 * $cpt = Package CPT slug
 */

function jobboard_get_remaining_entry($user_id, $cpt){

	$posted_entries = jobboard_get_number_entries_by_user($user_id, $cpt);
	$maximum_entries = jobboard_get_user_limit_entry($user_id, $cpt);

	$remaining_entries = $maximum_entries - $posted_entries;

	return $remaining_entries;

}

/**
 * Show remaning jobs to publish
 * $user_id = User ID
 * $cpt = Package CPT slug
 */

function jobboard_get_remaining_jobs($user_id){

	return jobboard_get_remaining_entry($user_id, '_package_job');

}

/**
 * Show remaning jobs to publish
 * $user_id = User ID
 * $cpt = Package CPT slug
 */

function jobboard_get_remaining_resumes($user_id){

	return jobboard_get_remaining_entry($user_id, '_package_resume');

}


/**
 * Get reach limit
 * Returning data type boelan
 * $user_id = User ID
 * $cpt = Package CPT slug
 */

function jobboard_package_is_limit($user_id, $cpt){

	$option = jobboard_option( 'enable'.$cpt );

  $user_entry_count = jobboard_get_number_entries_by_user($user_id, $cpt);
  $user_pack_limit = jobboard_get_user_limit_entry($user_id, $cpt);
	$remaining = jobboard_get_remaining_entry($user_id, $cpt);

  if( $cpt == '_resume_subscription' ) {

		$user_views_count = jobboard_get_user_view_count( $user_id, 'resume' );
		$user_views_max = jobboard_get_user_limit_entry( $user_id, $cpt);

		if( $user_views_count > $user_views_max ){
			return true;
		} else {
			return false;
		}

	} else {

		if( ($user_entry_count == $user_pack_limit && $option == '1' && current_user_can( 'edit_user' ) == false) || ( $remaining < 0 && $option == '1' && current_user_can( 'edit_user' ) == false) ){
	    return true;
	  } else {
	    return false;
	  }

	}

}



/**
 * Payment
 */

function jobboard_active_package_html($user_id, $cpt_args){

	$cpt = '';
	$package_heading = '';

	if( !empty($cpt_args) && $cpt_args = array('resume_view') ) {

		if( jobboard_get_user_type($user_id) == 'job_lister' ){
			$cpt = '_resume_subscription';
			$package_heading = __('Resume View Packages:', 'jobboard');
		}

	} else {

		if( jobboard_get_user_type($user_id) == 'job_lister' ){
			$cpt = '_package_job';
			$package_heading = __('Job Packages:', 'jobboard');
		}
		if( jobboard_get_user_type($user_id) == 'job_seeker' ){
			$cpt = '_package_resume';
			$package_heading = __('Resume Packages:', 'jobboard');
		}

	}

	$package_data = jobboard_get_packages_obj( $cpt );

	$active_pack = jobboard_get_user_active_package_data($user_id, $cpt);
	$active_pack_id = $active_pack->ID;

	/**
	 * Form processing
	*/

	if(isset($_POST['update-package-frontend'])):

		update_user_meta( $user_id, 'jobboard_user'.$cpt, $_POST['jobboard_user'.$cpt] );

		wp_redirect( get_permalink() );
		exit;

	endif;

/**
 * Paypal payment starts
*/


$action = '';
if( '1' == jobboard_option( 'activate_payment' ) ){

		$action = jobboard_get_payment_mode();
		$custom = $cpt;
		$listener_url = add_query_arg( 'action', 'payment_success', esc_url( home_url( '/' ) ) );

		$args = array(
			'action' => 'payment_success',
			'do' => 'update_package'
		);

		$return_url = add_query_arg( $args, esc_url( jobboard_get_permalink('dashboard') ) );


		?>
			<div class="package-tabs">

			<?php

			/** Tab Menu **/

			echo '<ul>';

			echo '<h4 class="package-heading">'.$package_heading.'</h4>';

			$user_package = jobboard_get_user_package($user_id, $cpt);

			if(!$user_package){
				echo '<p class="active-note innactive">'.__('You don\'t have an active package. Please, select one of these available packages!', 'jobboard').'</p>';
			}

			foreach($package_data as $post):

				setup_postdata($post);

				$checked = '';

				if($post->ID == $active_pack_id){
					$checked = 'checked="checked"';
				}

				$fieldname = 'jobboard_user'.$cpt;

				$package_info = array(
					'ID' 		=> $post->ID,
					'name' 	=> $post->post_title,
					'price' => get_post_meta($post->ID, '_jboard'.$cpt.'_price', true)
				);


				$active = '';

				if($post->ID == $active_pack_id){
					$active = 'class="ui-tabs-active ui-state-active"';
				}

			?>


				<li <?php echo $active; ?>><a href="#package-<?php echo $package_info['ID']; ?>"><?php echo $package_info['name']; ?></a></li>


			<?php

		endforeach; wp_reset_postdata($post);

			echo '</ul><!-- /.package-menu -->';

			/** Tab Menu Ends **/

			?>

			<?php

			/** Tab Content **/

			foreach($package_data as $post):

				setup_postdata($post);

				$package_info = array(
					'ID' 		=> $post->ID,
					'name' 	=> $post->post_title,
					'price' => get_post_meta($post->ID, '_jboard'.$cpt.'_price', true),
					'notes' => get_post_meta($post->ID, '_jboard'.$cpt.'_notes', true),
					'limit' => get_post_meta($post->ID, '_jboard'.$cpt.'_limit', true),
				);

				// Unlimited is set

				$unlimited = get_post_meta($post->ID, '_jboard'.$cpt.'_is_unlimited', true);

				if( $unlimited  == '1'  ){

					$package_info['limit'] = 'unlimited';

				}


				$button_text = __('Buy Package', 'jobboard');


				if( $cpt_args != '' ){

					$subscription_id = get_user_meta( $user_id, 'jobboard_user'.$cpt );

					if(empty($subscription_id)){
						$subscription_id = null;
					}

					$subscription_limit = get_user_meta( $user_id, 'jobboard_user'.$cpt.'_max_entry' );

					$disabled_view_pack = 'disabled';

					$active_note = '';
					$active_note_pack = '';

					if( empty($subscription_limit) || jobboard_get_user_view_remaining($user_id, 'resume') == '0'  ){

						$disabled_view_pack = '';

						$active_note_pack = '<span class="active-note innactive">'.__('Status: Innactive', 'jobboard').'</span>';

					} else {

						$active_note_pack = '<span class="active-note">'.__('Status: Active', 'jobboard').'</span>';

					}

				} else {

					$subscription_id = null;
					$subscription_limit = '';

					$is_limit = jobboard_package_is_limit($user_id, $cpt);

					$disabled = 'disabled';
					if($is_limit){
						$disabled = '';
					}

					$active_note = '';

					if($post->ID == $active_pack_id && !$is_limit){
						$active_note = '<span class="active-note">'.__('Status: Active', 'jobboard').'</span>';
					}

					if($post->ID == $active_pack_id && $is_limit){
						$active_note = '<span class="active-note innactive">'.__('Status: Innactive', 'jobboard').'</span>';
						// $disabled = 'disabled';
					}

				}



			?>


				<div id="package-<?php echo $package_info['ID']; ?>" class="package-details">


					<?php



					if((int)$subscription_id[0] == $package_info['ID']){

						echo $active_note_pack;

					} else {

						echo $active_note;

					}


					?>


					<div class="package-notes">
						<?php echo $package_info['notes']; ?>
					</div><!-- /.package-notes -->

					<!-- Payment form -->

						<form id="paypal_approval" name="paypal_approval" action="<?php echo esc_url($action); ?>" method="POST" class="payment-button">
							<input type="hidden" name="cmd" value="_xclick" />
							<input class="package-price" type="hidden" name="amount" value="<?php echo $package_info['price']; ?>" />
							<input type="hidden" name="business" value="<?php echo jobboard_option( 'paypal_email' );  ?>" />
							<input class="package-name" type="hidden" name="item_name" value="<?php echo $package_info['name']; ?>" />
							<input class="package-id" type="hidden" name="item_number" value="<?php echo $package_info['ID']; ?>" />
							<input type="hidden" name="no_shipping" value="1" />
							<input type="hidden" name="no_note" value="1" />
							<input type="hidden" name="currency_code" value="<?php echo jobboard_option( 'payment_currency' ); ?>" />
							<input type="hidden" name="charset" value="UTF-8" />
							<input type="hidden" name="custom" value="<?php echo esc_attr( $custom .', '.$package_info['limit'] ); ?>" />
							<input type="hidden" name="rm" value="2" />
							<input type="hidden" name="cbt" value="<?php echo sprintf( __( 'Click here to complete the purchase on %s', 'jobboard' ), esc_attr( get_bloginfo( 'name' ) ) ) ?>" />
							<input type="hidden" name="return" value="<?php echo esc_url( $return_url ); ?>" />
							<input type="hidden" name="notify_url" value="<?php echo esc_url( $listener_url ); ?>" />

							<?php if( $cpt_args != '' ){ ?>

								<button <?php echo $disabled_view_pack; ?> type="submit" name="paynow" class="btn btn-paypal"><?php echo $button_text; ?></button>

							<?php } else { ?>

							<button <?php echo $disabled; ?> type="submit" name="paynow" class="btn btn-paypal"><?php echo $button_text; ?></button>

							<?php } ?>

					</form>

					<!-- Payment form ends -->


				</div><!-- /.package-details -->


			<?php

			endforeach;

			/** Tab Content Ends **/

			echo '</div><!-- /.package-tabs -->';

			?>


<?php

/**
 * Paypal payment ends
*/

}



}
