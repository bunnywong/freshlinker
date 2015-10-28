<?php 

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';

// Loads options.php from child or parent theme
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );

function prefix_options_menu_filter( $menu ) {
	$menu['mode'] = 'menu';
	$menu['page_title'] = __( 'Custom Options', 'textdomain');
	$menu['menu_title'] = __( 'Custom Options', 'textdomain');
	$menu['menu_slug'] = 'custom-options';
	return $menu;
}

add_filter( 'optionsframework_menu', 'prefix_options_menu_filter' );

add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);
function enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'parent-responsive-style', get_template_directory_uri().'/style-responsive.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array('parent-style', 'parent-responsive-style')  );
    wp_enqueue_script( 'child-script', get_stylesheet_directory_uri().'/script.js', true  );
}


function pippin_rcp_terms_of_use_field() {

        ob_start(); ?>
	
		

                

        <?php

        echo ob_get_clean();

}

add_action('rcp_after_register_form_fields', 'pippin_rcp_terms_of_use_field');


function pippin_rcp_check_for_agreement( $posted ) {

        if( ! isset( $posted['rcp_terms_agreement'] ) ) {

                rcp_errors()->add('agree_to_terms', __('You must agree to our terms of use', 'rcp'), 

'register' );

        }

}

add_action('rcp_form_errors', 'pippin_rcp_check_for_agreement');

function jobboard_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="jobboard-searchform" action="' . home_url( '/' ) . '" >
	<div class="form-group">
		<div class="input-group">
			<input class="form-control" type="text" id="s" name="s" />
			<button type="submit" id="searchsubmit" class="form-sumit" /><i class="fa fa-search"></i></button>
		</div>
	</div>
	</form>';

	return $form;
}
add_filter( 'get_search_form', 'jobboard_search_form' );

/*------------------------------------------------------------*/
/*	Register "Job Nature" Taxonomy	*/
/*------------------------------------------------------------*/
if ( ! function_exists( 'jobboard_register_job_nature' ) ) {

// Register Job Nature Taxonomy
function jobboard_register_job_nature() {

	$labels = array(
		'name'                       => _x( 'Job Nature', 'Taxonomy General Name', 'jobboard' ),
		'singular_name'              => _x( 'Job Nature', 'Taxonomy Singular Name', 'jobboard' ),
		'menu_name'                  => __( 'Job Natures', 'jobboard' ),
		'all_items'                  => __( 'All Job Natures', 'jobboard' ),
		'parent_item'                => __( 'Parent Job Nature', 'jobboard' ),
		'parent_item_colon'          => __( 'Parent Job Nature:', 'jobboard' ),
		'new_item_name'              => __( 'New Job Nature Name', 'jobboard' ),
		'add_new_item'               => __( 'Add New Job Nature', 'jobboard' ),
		'edit_item'                  => __( 'Edit Job Nature', 'jobboard' ),
		'update_item'                => __( 'Update Job Nature', 'jobboard' ),
		'separate_items_with_commas' => __( 'Separate job Natures with commas', 'jobboard' ),
		'search_items'               => __( 'Search Job Natures', 'jobboard' ),
		'add_or_remove_items'        => __( 'Add or remove job natures', 'jobboard' ),
		'choose_from_most_used'      => __( 'Choose from the most used job natures', 'jobboard' ),
		'not_found'                  => __( 'Not Found', 'jobboard' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'job_nature', array( 'job' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'jobboard_register_job_nature', 0 );

}

/*------------------------------------------------------------------*/
/*	Function to handle frontend Post Job	*/
/*------------------------------------------------------------------*/
if( !function_exists( 'jobboard_post_job' ) ){

	function jobboard_post_job( $data = array(), $update = false ){

		$post_status = 'pending';

		if(jobboard_option('enable_package_job') == '1'){
			$post_status ='publish';
		}

		$job_args = array(
			'post_content'		=> $data['job_description'],
			'post_title'		=> $data['job_title'],
			'post_status'		=> $post_status,
			'post_type'			=> 'job',
			'post_author'		=> $data['user_id'],
		);

		$message = '1';

		$job_id = '';
		if( $update ){
			$job_args['ID'] = $data['post_id'];
			$job_args['post_status'] = get_post_status( $data['post_id'] );
			$message = '2';
		}

		$job_id = wp_insert_post( $job_args );

		if($job_id){
			if( isset( $data['job_region'] ) ){
				wp_set_object_terms( $job_id, $data['job_region'], 'job_region' );
			}
			if( isset( $data['job_type'] ) ){
				wp_set_object_terms( $job_id, $data['job_type'], 'job_type' );
			}
			if( isset( $data['job_category'] ) ){
				wp_set_object_terms( $job_id, $data['job_category'], 'job_category' );
			}
			if( isset( $data['job_nature'] ) ){
				wp_set_object_terms( $job_id, $data['job_nature'], 'job_nature' );
			}


			// Job Company Metabox
			update_post_meta( $job_id, '_jboard_job_company', $data['job_company'] );

			// Job Experience Metabox
			update_post_meta( $job_id, '_jboard_job_experiences', $data['job_experience'] );

			// Job Salary Metabox
			update_post_meta( $job_id, '_jboard_job_sallary', $data['job_sallary'] );

			// Job Summary Metabox
			update_post_meta( $job_id, '_jboard_job_summary', $data['job_summary'] );

			// Job Overview Metabox
			update_post_meta( $job_id, '_jboard_job_overview', $data['job_overview'] );

			// Job metabox data set
			$job_meta = array(
				'_jboard_job_company',
				'_jboard_job_experiences',
				'_jboard_job_sallary',
				'_jboard_job_summary',
				'_jboard_job_overview',
			);
			update_post_meta( $job_id, 'jobboard_job_mb_fields', $job_meta );

			wp_redirect( add_query_arg( array( 'action' => 'edit', 'jid' => $job_id, 'message' => $message ) ) );
			exit;
		}
	}

}//endif;


/*------------------------------------------------------------------*/
/*	Function to handle frontend Post Resume	*/
/*------------------------------------------------------------------*/
if( !function_exists( 'jobboard_post_resume' ) ){

function jobboard_post_resume($data = array(), $files = array(), $update = false ){

	$post_status = 'pending';

	if('1' == jobboard_option( 'auto_publish_resume' )){
		$post_status = 'publish';
	}

	$resume_args = array(
		'post_content'		=> $data['resume_content'],
		'post_title'		=> $data['title'],
		'post_status'		=> $post_status,
		'post_type'			=> 'resume',
		'post_author'		=> $data['user_id'],
	);
	$message = '10';
	if($update){
		$resume_args['post_status'] = get_post_status( $_POST['resume_id'] );
		$resume_args['ID'] = $_POST['resume_id'];
		$message = '11';
	}//endif;

	$resume_url = array();
	$i = 0;
	foreach($data['url_address'] as $url){
		if( $url != '' ){
			$resume_url[] = array(
				'url_name' => $data['url_name'][$i],
				'url_address' => $url,
			);
		}
		$i++;
	}

	$resume_education = array();
	$i = 0;
	foreach( $data['education_name'] as $edu ){
		if( $edu != '' ){
			$resume_education[] = array(
				'education_period' => $data['education_period'][$i],
				'institution_name' => $edu,
				'qualification' => $data['education_qualification'][$i],
				'study_field' => $data['education_study'][$i],
				'grade' => $data['education_grade'][$i],
			);
		}
		$i++;
	}

	$resume_experience = array();
	$i = 0;
	foreach( $data['experience_company'] as $exp ){
		if( $exp != '' ){
			$resume_experience[] = array(
				'employment_period' => $data['experience_period'][$i],
				'company_name' => $data['experience_company'][$i],
				'position' => $data['experience_position'][$i],
				'sallary' => $data['experience_sallary'][$i],
				'job_duties' => $data['experience_job'][$i],
			);
		}
		$i++;
	}

	$meta_input = array(
		'resume_professional_title' => $data['job_title'],
		'year_experience' => $data['year_experience'],
		'proposed_monthly_sallary' => $data['proposed_monthly_sallary'],
		'resume_location' => $data['location'],
		'skills_group' => array(
			array(
				'resume_skills' => $data['skills'],
			),
		),
		'url_group_container' => array(
			array(
				'url_group' => $resume_url,
			),
		),
		'education_group_container' => array(
			array(
				'education_group' => $resume_education,
			),
		),
		'experience_group_container' => array(
			array(
				'experience_group' => $resume_experience,
			),
		),
	);


	$resume_id = wp_insert_post( $resume_args );
	if( isset($resume_id) ){
		if( isset($data['category']) ){
			wp_set_object_terms( $resume_id, $data['category'], 'resume_category' );
		}

		$old_post_meta = get_post_meta( $resume_id, 'jobboard_resume_mb', true );
		update_post_meta( $resume_id, 'jobboard_resume_mb', $meta_input, $old_post_meta );


		// Location
		update_post_meta( $resume_id, '_resume_location', $data['location'] );

		// Monthly salary
		update_post_meta( $resume_id, '_resume_monthly_salary', (int)$data['proposed_monthly_sallary'] );

		// Experience
		update_post_meta( $resume_id, '_resume_experience', (int)$data['year_experience'] );


		// Upload  photo file
		if( !empty( $files['photo']['name'] ) ){
			$attach_id = jobboard_file_upload( $files['photo'], 'image', $resume_id );
			if( $attach_id ){
				set_post_thumbnail( $resume_id, $attach_id );
			}
		}


		// Upload resume file
		if( !empty( $files['resume_file']['name'] ) ){
			$resume_file = jobboard_file_upload( $files['resume_file'], 'file' );
			$old_resume_file = get_post_meta( $resume_id, 'jobboard_resume_file', true );
			if($resume_file){
				update_post_meta( $resume_id, 'jobboard_resume_file', $resume_file['url'], $old_resume_file  );
			}
		}
		
		$acc_page = jobboard_option( 'dashboard_page' );
		wp_redirect( esc_url( get_permalink( $acc_page ) ) );
		exit;

	}//endif $resume_id
}

}//endif;


/*--------------------------------------------------------*/
/*	Register CP Person Detail Metabox	*/
/*--------------------------------------------------------*/

if( !function_exists( 'jobboard_cp_person_metabox' ) ){

	function jobboard_cp_person_metabox(){
    // Built path to metabox template array file
    $mb_path  = get_stylesheet_directory() . '/metaboxes/metabox-cp-person.php';
    // Initialize the Metabox's object
    // We can use array or file path to the array specification file.
    $mb = new VP_Metabox(array(
        'id'          => 'jobboard_cp_person_mb',
        'types'       => array('company'),
        'title'       => __('Contact Person Details', 'jobboard'),
        'priority'    => 'high',
        'is_dev_mode' => false,
        'template'    => $mb_path,
        'mode' => WPALCHEMY_MODE_EXTRACT

    ));
}
// the safest hook to use, since Vafpress Framework may exists in Theme or Plugin
add_action( 'after_setup_theme', 'jobboard_cp_person_metabox' );

}//endif;

/*------------------------------------------------------------------*/
/*	Function to handle frontend Post Company	*/
/*------------------------------------------------------------------*/
if( !function_exists( 'jobboard_post_company' ) ){

	function jobboard_post_company( $data = array(), $files = array(), $update = false ){

		$message = '3';
		$company_args = array(
			'post_type'		=> 'company',
			'post_title'	=> $data['company_name'],
			'author'		=> get_current_user_id(),
			'post_status'	=> 'publish',
		);

		if( $update ){
			$company_args['ID'] = $data['post_id'];
			$company_args['post_status'] = get_post_status( $data['post_id'] );
			$message = '4';
		}

		// Service repeatable meta data
		$company_service = array();
		$i = 0;
		foreach($data['service_name'] as $service_name){
			if( $service_name != '' ){
				$company_service[] = array(
					'service_icon' => $data['service_icon'][$i],
					'service_name' => $service_name,
					'service_detail' => $data['service_detail'][$i]
				);
			}
			$i++;
		}

		// Client repeeatable meta data
		$company_client = array();
		$i = 0;
		foreach($data['project_name'] as $project_name){
			if( $project_name != '' ){
				$company_client[] = array(
					'project_name' => $project_name,
					'project_year' => $data['project_year'][$i],
					'project_url' => $data['project_url'][$i],
					'project_detail' => $data['project_detail'][$i]
				);
			}
			$i++;
		}



		// sinii starts
		$meta_input = array(
			'company_description' => $data['company_description'],
			'company_overview' => $data['company_overview'],
			'company_web_address' => $data['company_website'],
			'company_social_facebook' => $data['company_facebook'],
			'company_social_twitter' => $data['company_twitter'],
			'company_social_googleplus' => $data['company_google_plus'],
			'company_expertises_headline' => $data['company_expertises_headline'],
			'hidden_expertises' => $data['company_expertises'],
			'company_expertises'	=> $expertise_array,
			'cp_ldin_address' => $data['cp_ldin_address'],
			'cp_ldin_user' => $data['cp_ldin_user'],
			'cp_person' => $data['cp_person'],
			'cp_person_title' => $data['cp_person_title'],
			'cp_email' => $data['cp_email'],
			'cp_phone' => $data['cp_phone'],
			'company_service_group_container' => array(
				'company_service_group' => $company_service
			)
		);


		$company_service_group = array(
			'_jboard_company_service_group' => $company_service
		);

		$company_client_group = array(
			'_jboard_company_client_group' => $company_client
		);


		// sinii ends

		$comp_id = wp_insert_post($company_args);

		if($comp_id){


			// Company Description Metabox
			update_post_meta( $comp_id, '_jboard_company_description', $data['company_description'] );

			// Company Overview Metabox
			update_post_meta( $comp_id, '_jboard_company_overview', $data['company_overview'] );

			// Company Website URL
			update_post_meta( $comp_id, '_jboard_company_web_address', $data['company_website'] );

			// Company Facebook URL
			update_post_meta( $comp_id, '_jboard_company_social_facebook', $data['company_facebook'] );

			// Company Twitter URL
			update_post_meta( $comp_id, '_jboard_company_social_twitter', $data['company_twitter'] );

			// Company Google Plus
			update_post_meta( $comp_id, '_jboard_company_social_googleplus', $data['company_google_plus'] );
			
			// Company Contact Person
			update_post_meta( $comp_id, 'cp_ldin_address', $data['cp_ldin_address'] );
			update_post_meta( $comp_id, 'cp_ldin_user', $data['cp_ldin_user'] );
			update_post_meta( $comp_id, 'cp_person', $data['cp_person'] );
			update_post_meta( $comp_id, 'cp_person_title', $data['cp_person_title'] );
			update_post_meta( $comp_id, 'cp_email', $data['cp_email'] );
			update_post_meta( $comp_id, 'cp_phone', $data['cp_phone'] );

			// Company Expertises
			update_post_meta( $comp_id, '_jboard_hidden_expertises', $data['company_expertises']);

			// Company Service
			update_post_meta( $comp_id, '_jboard_company_service_headline', $data['company_service_headline'] );
			update_post_meta( $comp_id, '_jboard_company_service_group_container', $company_service_group );

			// Company Client
			update_post_meta( $comp_id, '_jboard_company_client_headline', $data['company_client_headline'] );
			update_post_meta( $comp_id, '_jboard_company_client_group_container', $company_client_group );


			// Expertises
			update_post_meta( $comp_id, '_jboard_company_expertises_headline', $data['company_expertises_headline'] );

			/**
			 * Multiple select company expertises
			 */

			$expertise_array = explode(',', $data['company_expertises']);
			update_post_meta($comp_id, '_jboard_company_expertises', $expertise_array);

			// Testimonial
			update_post_meta($comp_id, '_jboard_company_testimonial_headline', $data['company_testimonial_headline']);
			update_post_meta($comp_id, '_jboard_company_testimonial_content', $data['testimonial_content']);
			update_post_meta($comp_id, '_jboard_company_testimonial_author', $data['testimonial_author']);
			update_post_meta($comp_id, '_jboard_company_testimonial_author_occupation', $data['testimonial_author_occupation']);
			update_post_meta($comp_id, '_jboard_company_testimonial_author_url', $data['testimonial_author_url']);

			// Testimonial author avatar
			// Upload  Company Image
			if( !empty( $files['testimonial_author_avatar']['name'] ) ){
				$attach_id = jobboard_file_upload( $files['testimonial_author_avatar'], 'image', $comp_id );
				if( $attach_id ){

					update_post_meta($comp_id, '_author_avatar_id_hidden', $attach_id);

					$attachment_url = wp_get_attachment_url($attach_id);

					update_post_meta($comp_id, '_jboard_company_testimonial_author_avatar', $attachment_url);

				}
			}

			$company_meta = array(
				'_jboard_company_description',
				'_jboard_company_overview',
				'_jboard_company_web_address',
				'_jboard_company_social_facebook',
				'_jboard_company_social_twitter',
				'_jboard_company_social_googleplus',
			);

			update_post_meta( $comp_id, 'jobboard_company_mb_fields', $company_meta );

			/*
			$old_post_meta = get_post_meta( $comp_id, 'jobboard_company_mb_fields', true );
			update_post_meta( $comp_id, 'jobboard_company_mb_fields', $meta_input, $old_post_meta );
			*/

			// Upload  Company Image
			if( !empty( $files['company_image']['name'] ) ){
				$attach_id = jobboard_file_upload( $files['company_image'], 'image', $comp_id );
				if( $attach_id ){
					if( has_post_thumbnail( $comp_id ) ){
						delete_post_thumbnail($comp_id);
					}
					set_post_thumbnail( $comp_id, $attach_id );
				}
			}



			// Portfolio repeatable meta data

			$multiple_images = $_FILES['portfolio_image'];

			$n = 0;
			$single_img_group = array();
			foreach($multiple_images as $key => $val_array) :

				$single_img_group[] = array(

					'name' => $multiple_images['name'][$n],
					'type' => $multiple_images['type'][$n],
					'tmp_name' => $multiple_images['tmp_name'][$n],
					'error' => $multiple_images['error'][$n],
					'size' => $multiple_images['size'][$n]

				);

				$n++;
			endforeach;

			$portfolio_attachments = array();
			foreach($single_img_group as $single_img ) :

				// Push upload here
				if($single_img['name'] != '' || $single_img['name'] != NULL) {

					// Push upload
					$attach_id = jobboard_file_upload( $single_img, 'image', $comp_id );

					$portfolio_attachments[] = $attach_id;

				}

			endforeach;

			// Service repeatable meta data
			$company_portfolio = array();
			$i = 0;
			foreach($portfolio_attachments as $portfolio_attachment){
				if( $portfolio_attachment != '' ){

					$stored_id = ($data['portfolio_stored_image_id'][$i]) ? $data['portfolio_stored_image_id'][$i] : $portfolio_attachment;

					$company_portfolio[] = array(
						'portfolio_image' => $portfolio_attachment,
						'portfolio_url' => $data['portfolio_url'][$i]
					);
				}
				$i++;
			}

			$company_portfolio_group = array(
				'_jboard_company_portfolio_group' => $company_portfolio
			);

			// Update portfolio meta
			update_post_meta( $comp_id, '_jboard_company_portfolio_headline', $data['company_portfolio_headline'] );
			update_post_meta( $comp_id, '_jboard_company_portfolio_group_container', $company_portfolio_group );

			// stored images
			update_post_meta( $comp_id, '_jboard_company_portfolio_stored_img', $data['portfolio_stored_image_id'] );
			// stored urls
			update_post_meta( $comp_id, '_jboard_company_portfolio_stored_url', $data['portfolio_url2'] );



			// Company address
			update_post_meta( $comp_id, '_jboard_company_address_gmap_latitude', $data['gmap_latitude'] );
			update_post_meta( $comp_id, '_jboard_company_address_gmap_longitude', $data['gmap_longitude'] );
			update_post_meta( $comp_id, '_jboard_company_address', $data['company_address'] );
			update_post_meta( $comp_id, '_jboard_company_phone', $data['company_phone'] );
			update_post_meta( $comp_id, '_jboard_company_email', $data['company_email'] );



			//wp_redirect( esc_url( add_query_arg( array( 'action' => 'edit', 'jid' => $comp_id, 'message' => $message ) ) ) );
			$acc_page = jobboard_option( 'dashboard_page' );
			wp_redirect( esc_url( get_permalink( $acc_page ) ) );
			exit; 
		}//endif;
	}

}//endif;


/* Pagination */
if ( !function_exists( 'nmedia_pagination' ) ) {

	function nmedia_pagination( $args = array(), $query = '' ) {

		global $wp_rewrite, $wp_query;
		do_action( 'nmedia_pagination_start' );

		if ( $query ) {
			$wp_query = $query;
		} // End IF Statement

		/* If there's not more than one page, return nothing. */
		if ( 1 >= $wp_query->max_num_pages ) {

			return;
		}	

		/* Get the current page. */
		$current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );

		/* Get the max number of pages. */
		$max_num_pages = intval( $wp_query->max_num_pages );

		/* Set up some default arguments for the paginate_links() function. */
		$defaults = array(
			'base' => add_query_arg( 'paged', '%#%' ),
			'format' => '',
			'total' => $max_num_pages,
			'current' => $current,
			'prev_next' => true,
			'show_all' => false,
			'end_size' => 1,
			'mid_size' => 2,
			'add_fragment' => '',
			'type' => 'plain',
			'before' => '<div class="pagination nmedia-pagination">', // Begin nmedia_pagination() arguments.
			'after' => '</div>',
			'echo' => true, 
			'use_search_permastruct' => true,
            'index' => false

		);

		/* Allow themes/plugins to filter the default arguments. */
		$defaults = apply_filters( 'nmedia_pagination_args_defaults', $defaults );

		/* Add the $base argument to the array if the user is using permalinks. */
		if( $wp_rewrite->using_permalinks() )
			$defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

		/* If we're on a search results page, we need to change this up a bit. */
		if ( is_search() ) {

		/* If we're in BuddyPress, or the user has selected to do so, use the default "unpretty" URL structure. */
			if ( class_exists( 'BP_Core_User' ) || $defaults['use_search_permastruct'] ) {
				$search_query = get_query_var( 's' );
				$paged = get_query_var( 'paged' );
				$base = user_trailingslashit( home_url() ) . '?s=' . urlencode( $search_query ) . '&paged=%#%';
				$defaults['base'] = $base;

			} else {

				$search_permastruct = $wp_rewrite->get_search_permastruct();
				if ( !empty( $search_permastruct ) )
					$defaults['base'] = user_trailingslashit( trailingslashit( urldecode( get_search_link() ) ) . 'page/%#%' );
			}

		}


		/* Merge the arguments input with the defaults. */
		$args = wp_parse_args( $args, $defaults );

		/* Allow developers to overwrite the arguments with a filter. */
		$args = apply_filters( 'nmedia_pagination_args', $args );

		/* Don't allow the user to set this to an array. */
		if ( 'array' == $args['type'] )
			$args['type'] = 'plain';

		/* Make sure raw querystrings are displayed at the end of the URL, if using pretty permalinks. */
		$pattern = '/\?(.*?)\//i';

		preg_match( $pattern, $args['base'], $raw_querystring );
		if( $wp_rewrite->using_permalinks() && $raw_querystring ) {
			$raw_querystring[0] = str_replace( '', '', $raw_querystring[0] );
			$args['base'] = str_replace( $raw_querystring[0], '', $args['base'] );
			$args['base'] .= substr( $raw_querystring[0], 0, -1 );
		}	

		/* Get the paginated links. */
		$page_links = paginate_links( $args );

		/* Remove 'page/1' from the entire output since it's not needed. */
		$page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );

                if($args['index']) {
                    $args['before'] = $args['before'] . '<span class="pages">Page '.$args['current'].' of '.$args['total'].'</span>';
				}	

		/* Wrap the paginated links with the $before and $after elements. */
		$page_links = $args['before'] . $page_links . $args['after'];

		/* Allow devs to completely overwrite the output. */
		$page_links = apply_filters( 'nmedia_pagination', $page_links );

		do_action( 'nmedia_pagination_end' );

		/* Return the paginated links for use in themes. */
		if ( $args['echo'] ) {
			echo $page_links;
		}

		else {

			return $page_links;
		}

	} // End pagination()

} // End IF Statement


add_filter( 'manage_edit-job_columns', 'jobboard_child_set_custom_edit_application_columns' );
add_action( 'manage_job_posts_custom_column' , 'jobboard_child_custom_application_column', 10, 3 );

function jobboard_child_set_custom_edit_application_columns($columns){

	$columns['featured'] = __( 'Featured', 'jobboard' );

	return $columns;
}

function jobboard_child_custom_application_column( $column, $post_id ){
    switch ( $column ){

    	case 'featured':
    		$featured = get_post_meta($post_id, '_jboard_job_featured', true);
    		if ( $featured == 1 ) {
    			echo __('Yes', 'jobboard');
    		} else {
    			echo __('No', 'jobboard');
    		}
    	break;

    }
}