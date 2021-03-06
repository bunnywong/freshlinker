<?php
/**
 * WP_Job_Manager_Applications_Post_Types class.
 */
class WP_Job_Manager_Applications_Post_Types {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_filter( 'the_title', array( $this, 'already_applied_title' ), 10, 2 );
		add_action( 'single_job_listing_meta_after', array( $this, 'already_applied_message' ) );
		add_action( 'init', array( $this, 'register_post_types' ), 20 );
		if ( get_option( 'job_application_delete_with_job', 0 ) ) {
			add_action( 'delete_post', array( $this, 'delete_post' ) );
		}
	}

	public function already_applied_title( $title, $post_id = '' ) {
		if ( $post_id && 'job_listing' === get_post_type( $post_id ) && ! is_single() && is_user_logged_in() && user_has_applied_for_job( get_current_user_id(), $post_id ) ) {
			$title .= ' <span class="job-manager-applications-applied-notice">' . __( 'Applied', 'wp-job-manager-applications' ) . '</span>';
		}
		return $title;
	}

	/**
	 * Show message if already applied
	 */
	public function already_applied_message() {
		global $post;

		if ( is_user_logged_in() && user_has_applied_for_job( get_current_user_id(), $post->ID ) ) {
			 get_job_manager_template( 'applied-notice.php', array(), 'wp-job-manager-applications', JOB_MANAGER_APPLICATIONS_PLUGIN_DIR . '/templates/' );
		}
	}

	/**
	 * register_post_types function.
	 */
	public function register_post_types() {
		if ( post_type_exists( "job_application" ) ) {
			return;
		}

		$plural   = __( 'Job Applications', 'wp-job-manager-applications' );
		$singular = __( 'Application', 'wp-job-manager-applications' );

		register_post_type( "job_application",
			apply_filters( "register_post_type_job_application", array(
				'labels' => array(
					'name' 					=> $plural,
					'singular_name' 		=> $singular,
					'menu_name'             => $plural,
					'all_items'             => sprintf( __( 'All %s', 'wp-job-manager-applications' ), $plural ),
					'add_new' 				=> __( 'Add New', 'wp-job-manager-applications' ),
					'add_new_item' 			=> sprintf( __( 'Add %s', 'wp-job-manager-applications' ), $singular ),
					'edit' 					=> __( 'Edit', 'wp-job-manager-applications' ),
					'edit_item' 			=> sprintf( __( 'Edit %s', 'wp-job-manager-applications' ), $singular ),
					'new_item' 				=> sprintf( __( 'New %s', 'wp-job-manager-applications' ), $singular ),
					'view' 					=> sprintf( __( 'View %s', 'wp-job-manager-applications' ), $singular ),
					'view_item' 			=> sprintf( __( 'View %s', 'wp-job-manager-applications' ), $singular ),
					'search_items' 			=> sprintf( __( 'Search %s', 'wp-job-manager-applications' ), $plural ),
					'not_found' 			=> sprintf( __( 'No %s found', 'wp-job-manager-applications' ), $plural ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', 'wp-job-manager-applications' ), $plural ),
					'parent' 				=> sprintf( __( 'Parent %s', 'wp-job-manager-applications' ), $singular )
				),
				'description'         => __( 'This is where you can edit and view applications.', 'wp-job-manager-applications' ),
				'public'              => false,
				'show_ui'             => true,
				'capability_type'     => 'job_application',
				'map_meta_cap'        => true,
				'publicly_queryable'  => false,
				'exclude_from_search' => true,
				'hierarchical'        => false,
				'rewrite'             => false,
				'query_var'           => false,
				'supports'            => array( 'title', 'custom-fields', 'editor' ),
				'has_archive'         => false,
				'show_in_nav_menus'   => false
			) )
		);

		$applicaton_statuses = get_job_application_statuses();

		foreach ( $applicaton_statuses as $name => $label ) {
			register_post_status( $name, apply_filters( 'register_job_application_status', array(
				'label'                     => $label,
				'public'                    => true,
				'exclude_from_search'       => 'archived' === $name ? true : false,
				'show_in_admin_all_list'    => 'archived' === $name ? false : true,
				'show_in_admin_status_list' => true,
				'label_count'               => _n_noop( $label . ' <span class="count">(%s)</span>', $label . ' <span class="count">(%s)</span>', 'wp-job-manager' )
			), $name ) );
		}
	}

	/**
	 * Delete applications when deleting a job
	 */
	public function delete_post( $id ) {
		global $wpdb;

		if ( $id > 0 ) {

			$post_type = get_post_type( $id );

			if ( 'job_listing' === $post_type ) {
				$applications = get_children( 'post_parent=' . $id . '&post_type=job_application' );

				if ( $applications ) {
					foreach ( $applications as $application ) {
						wp_delete_post( $application->ID, true );
					}
				}
			}
		}
	}
}