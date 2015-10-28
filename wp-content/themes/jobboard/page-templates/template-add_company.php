<?php
/**
 * Template Name: Add Company
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 *
 */
?><?php
if( !is_user_logged_in() ){
	$login_redirect = urlencode( get_permalink( get_the_id() ) );
	$redirect_args = add_query_arg( 'redirect', $login_redirect, esc_url( jobboard_get_permalink( 'login' ) ) );
	wp_redirect( $redirect_args );
	exit;
}//endif;

if( isset( $_GET['action'] ) && $_GET['action'] == 'edit' ){
	if( !isset( $_GET['jid'] ) || $_GET['jid'] == '' ){
		wp_redirect( get_permalink( get_the_id() ) ); exit;
	}
}//endif;

if( jobboard_get_user_type(get_current_user_id()) == 'job_seeker' ){

	wp_redirect( jobboard_get_permalink('dashboard') );
	exit;

}

require_once( get_template_directory().'/includes/frontend-submission/form-submit.php' ); //Include Frontend Submission functions
get_header();

?>
<div id="page-title-wrapper">
	<div class="container">
		<?php
			$page_title = __( 'ADD COMPANY', 'jobboard' );
			$default = array(
				'post_id'				=> '',
				'company_name'			=> '',
				'company_overview' => '',
				'company_description' 	=> '',
				'company_website'		=> '',
				'company_facebook'		=> '',
				'company_twitter'		=> '',
				'company_google_plus'	=> '',
				'company_image'			=> '',
				'company_expertises_headline' => '',
				'company_expertises' => '',
				'company_service_headline' => '',
				'company_client_headline' => '',
				'company_testimonial_headline' => '',
				'company_testimonial_content' => '',
				'company_testimonial_author' => '',
				'company_testimonial_author_occupation' => '',
				'company_testimonial_author_url' => '',
				'company_testimonial_author_avatar_id' => '',
				'company_testimonial_author_avatar' => '',
				'company_portfolio_headline' => '',
				'company_address_gmap_latitude' => '',
				'company_address_gmap_longitude' => '',
				'company_address' => '',
				'company_phone' => '',
				'company_email' => '',
			);

			if( isset( $_GET['action'] ) && $_GET['action'] == 'edit' ){
				$page_title = __( 'EDIT COMPANY', 'jobboard' );
				$edit = get_post( $_GET['jid'] );

				$company = array(
					'post_id'				=> $_GET['jid']?$_GET['jid']:'',
					'company_name'			=> $edit->post_title,
					'company_description' 	=> get_post_meta( $edit->ID, '_jboard_company_description', true ),
					'company_overview' 	=> get_post_meta( $edit->ID, '_jboard_company_overview', true ),
					'company_website'		=> get_post_meta( $edit->ID, '_jboard_company_web_address', true ),
					'company_facebook'		=> get_post_meta( $edit->ID, '_jboard_company_social_facebook', true ),
					'company_twitter'		=> get_post_meta( $edit->ID, '_jboard_company_social_twitter', true ),
					'company_google_plus'	=> get_post_meta( $edit->ID, '_jboard_company_social_googleplus', true ),
					'company_image'			=> get_the_post_thumbnail( $edit->ID ),
					'company_expertises' => get_post_meta( $edit->ID, '_jboard_hidden_expertises', true ),
					'company_expertises_headline' => get_post_meta( $edit->ID, '_jboard_company_expertises_headline', true ),
					'company_service_headline' => get_post_meta( $edit->ID, '_jboard_company_service_headline', true ),
					'company_client_headline' => get_post_meta( $edit->ID, '_jboard_company_client_headline', true ),
					'company_testimonial_headline' => get_post_meta( $edit->ID, '_jboard_company_testimonial_headline', true),
					'company_testimonial_content' => get_post_meta( $edit->ID, '_jboard_company_testimonial_content', true),
					'company_testimonial_author' => get_post_meta( $edit->ID, '_jboard_company_testimonial_author', true),
					'company_testimonial_author_occupation' => get_post_meta( $edit->ID, '_jboard_company_testimonial_author_occupation', true),
					'company_testimonial_author_url' => get_post_meta( $edit->ID, '_jboard_company_testimonial_author_url', true),
					'company_testimonial_author_avatar_id' => get_post_meta( $edit->ID,'_author_avatar_id_hidden', true),
					'company_testimonial_author_avatar' => get_post_meta( $edit->ID,'_jboard_company_testimonial_author_avatar', true ),
					'company_portfolio_headline' => get_post_meta( $edit->ID,'_jboard_company_portfolio_headline', true ),
					'company_address_gmap_latitude' => get_post_meta( $edit->ID,'_jboard_company_address_gmap_latitude', true ),
					'company_address_gmap_longitude' => get_post_meta( $edit->ID,'_jboard_company_address_gmap_longitude', true ),
					'company_address' => get_post_meta( $edit->ID,'_jboard_company_address', true ),
					'company_phone' => get_post_meta( $edit->ID,'_jboard_company_phone', true ),
					'company_email' => get_post_meta( $edit->ID,'_jboard_company_email', true ),
				);

				$default = wp_parse_args( $company, $default );
			}
		?>
		<h1 class="page-title"><?php echo esc_attr( $page_title ); ?></h1>
	</div><!-- /.container -->
</div><!-- /#page-title -->

<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<form id="post-company-form" class="frontend-form" action="" method="post" enctype="multipart/form-data" role="form">
					<?php
						if( isset( $_GET['message'] ) ){
							jobboard_set_post_message( $_GET['message'] );
						}
					?>

					<div class="form-group">
						<label for="company_name"><?php _e( 'Company Name', 'jobboard' ); ?></label>
						<input type="text" id="company_name" name="company_name" class="form-control" value="<?php echo esc_attr( $default['company_name'] ); ?>" required="required" />
					</div><!-- /.form-group -->

					<div class="form-group">
						<label for="company_image"><?php _e( 'Company Image', 'jobboard' ); ?></label>
						<?php
						echo $default['company_image'];
						?>
						<input class="" type="file" name="company_image" id="company_image" accept="image/*" />
					</div><!-- /.form-group -->

					<div class="form-group">
						<label for="company_website"><?php _e( 'Website URL', 'jobboard' ); ?></label>
						<input type="text" id="company_website" name="company_website" class="form-control" value="<?php echo esc_attr( $default['company_website'] ); ?>" />
					</div><!-- /.form-group -->

					<div class="form-group">
						<label for="company_facebook"><?php _e( 'Facebook', 'jobboard' ); ?></label>
						<input type="text" id="company_facebook" name="company_facebook" class="form-control" value="<?php echo esc_attr( $default['company_facebook'] ); ?>" />
					</div><!-- /.form-group -->

					<div class="form-group">
						<label for="company_twitter"><?php _e( 'Twitter', 'jobboard' ); ?></label>
						<input type="text" id="company_twitter" name="company_twitter" class="form-control" value="<?php echo esc_attr( $default['company_twitter'] ); ?>" />
					</div><!-- /.form-group -->

					<div class="form-group">
						<label for="company_google_plus"><?php _e( 'Google Plus', 'jobboard' ); ?></label>
						<input type="text" id="company_google_plus" name="company_google_plus" class="form-control" value="<?php echo esc_attr( $default['company_google_plus'] ); ?>" />
					</div><!-- /.form-group -->


					<div class="form-group">
						<label for="company_description"><?php _e( 'Company Overview', 'jobboard' ); ?></label>
						<span class="form-desc"><?php _e( 'Write an overview about you company.', 'jobboard' ); ?></span>
						<textarea name="company_overview" id="company_overview" class="form-control" rows="7" required="required"><?php echo esc_attr( $default['company_overview'] ); ?></textarea>
					</div><!-- /.form-group -->

					<div class="form-group">
						<label for="company_description"><?php _e( 'Company Description', 'jobboard' ); ?></label>
						<span class="form-desc"><?php _e( 'Write your company description.', 'jobboard' ); ?></span>
						<textarea name="company_description" id="company_description" class="form-control" rows="7" required="required"><?php echo esc_attr( $default['company_description'] ); ?></textarea>
					</div><!-- /.form-group -->


					<div class="company_part_data">

						<h4><?php echo __('Company Expertises', 'jobboard'); ?></h4>

						<div class="form-group">
							<label for="company_expertises_headline"><?php _e( 'Headline', 'jobboard' ); ?></label>
							<input type="text" id="company_expertises_headline" name="company_expertises_headline" class="form-control" value="<?php echo esc_attr( $default['company_expertises_headline'] ); ?>" />
						</div><!-- /.form-group -->

						<div class="form-group">
							<label for="company_expertises"><?php _e( 'Company Expertises', 'jobboard' ); ?></label>
							<span class="form-desc"><?php _e( 'Write expertises with comma as separator.', 'jobboard' ); ?></span>
							<input type="text" id="company_expertises" name="company_expertises" class="form-control" value="<?php echo esc_attr( $default['company_expertises'] ); ?>" />
						</div><!-- /.form-group -->

					</div><!-- /.company_part_data -->

					<div class="company_part_data data_service">

					<h4><?php echo __('Company Service', 'jobboard'); ?></h4>

					<div class="form-group">
						<label for="company_service_headline"><?php _e( 'Headline', 'jobboard' ); ?></label>
						<input type="text" id="company_service_headline" name="company_service_headline" class="form-control" value="<?php echo esc_attr( $default['company_service_headline'] ); ?>" />
					</div><!-- /.form-group -->

					<?php
					// Service form, only executed if edit mode is active
					if( isset( $_GET['action']) && $_GET['action'] == 'edit' ){

						$company_service_data = get_post_meta( $edit->ID, '_jboard_company_service_group_container', true );

						foreach($company_service_data['_jboard_company_service_group'] as $service){ ?>

							<div class="repeated-form" style="display:block">
								<div class="close-form" data-button-limit="6" data-button-name="#add_url_button"><i class="fa fa-times"></i></div>

								<div class="row">
									<div class="col-md-5 form-group">
										<label for="service_icon"><?php _e( 'Service Icon', 'jobboard' ); ?></label>
										<input id="service_icon" class="form-control" type="text" name="service_icon[]" value="<?php echo $service['service_icon']; ?>" />
									</div>
									<div class="col-md-7 form-group">
										<label for="service_name"><?php _e( 'Service Name', 'jobboard' ); ?></label>
										<input id="service_name" class="form-control" type="text" name="service_name[]" value="<?php echo $service['service_name']; ?>" />
									</div>
								</div><!-- /.row -->

								<label for="url_address"><?php _e( 'Service Detail', 'jobboard' ); ?></label>
								<textarea id="url_address" class="form-control service-detail" name="service_detail[]"><?php echo $service['service_detail']; ?></textarea>

							</div><!-- /.repeated-form -->


						<?php }

					}
					?>

					<div id="service_form" class="repeated-form">
						<div class="close-form" data-button-limit="6" data-button-name="#add_url_button"><i class="fa fa-times"></i></div>

						<div class="row">
							<div class="col-md-4 form-group">
								<label for="service_icon"><a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" rel="nofollow" target="_blank"><?php _e('Icon', 'jobboard'); ?></a>, <i><?php _e('example:', 'jobboard'); ?> fa-adjust</i></label>
								<input id="service_icon" class="form-control" type="text" name="service_icon[]" />
							</div>
							<div class="col-md-8 form-group">
								<label for="service_name"><?php _e( 'Service Name', 'jobboard' ); ?></label>
								<input id="service_name" class="form-control" type="text" name="service_name[]" />
							</div>
						</div><!-- /.row -->

						<label for="url_address"><?php _e( 'Service Detail', 'jobboard' ); ?></label>
						<textarea id="url_address" class="form-control textarea-detail" name="service_detail[]"></textarea>

					</div><!-- /.repeated-form -->


					<div class="form-group">
						<label for="url"><?php _e( 'Service(s)', 'jobboard' ); ?></label>
						<button type="button" id="add_service_button" class="btn btn-add-service" data-limit="5" data-form-id="#service_form" ><?php _e( '+ Add Service', 'jobboard' ); ?></button>
					</div><!-- /.form-group -->

					</div><!-- /.company_part_data -->


					<div class="company_part_data data_service">

						<h4><?php echo __('Company Clients', 'jobboard'); ?></h4>

						<div class="form-group">
							<label for="company_client_headline"><?php _e( 'Headline', 'jobboard' ); ?></label>
							<input type="text" id="company_client_headline" name="company_client_headline" class="form-control" value="<?php echo esc_attr( $default['company_client_headline'] ); ?>" />
						</div><!-- /.form-group -->

						<?php

						// Client form, only executed if edit mode is active
						if( isset( $_GET['action']) && $_GET['action'] == 'edit' ){

							$company_client_data = get_post_meta( $edit->ID, '_jboard_company_client_group_container', true );

							foreach($company_client_data['_jboard_company_client_group'] as $client){ ?>

								<div class="repeated-form" style="display:block">
									<div class="close-form" data-button-limit="6" data-button-name="#add_url_button"><i class="fa fa-times"></i></div>

									<div class="row">
										<div class="col-md-6 form-group">
											<label for="project_name"><?php _e('Project Name', 'jobboard'); ?></label>
											<input id="project_name" class="form-control" type="text" name="project_name[]" value="<?php echo $client['project_name']; ?>" />
										</div>
										<div class="col-md-6 form-group">
											<label for="project_year"><?php _e( 'Project Year', 'jobboard' ); ?></label>
											<input id="project_year" class="form-control" type="text" name="project_year[]" value="<?php echo $client['project_year']; ?>" />
										</div>
									</div><!-- /.row -->

									<div class="row">
										<div class="col-md-12 form-group">
											<label for="project_url"><?php _e('Project URL', 'jobboard'); ?></label>
											<input id="project_url" class="form-control" type="text" name="project_url[]" value="<?php echo $client['project_url']; ?>" />
										</div>
									</div><!-- /.row -->

									<label for="project_detail"><?php _e( 'Project Detail', 'jobboard' ); ?></label>
									<textarea id="project_detail" class="form-control textarea-detail" name="project_detail[]"><?php echo $client['project_detail']; ?></textarea>

								</div><!-- /.repeated-form -->

						<?php
							}

						}

						?>

						<div id="client_form" class="repeated-form">
							<div class="close-form" data-button-limit="6" data-button-name="#add_url_button"><i class="fa fa-times"></i></div>

							<div class="row">
								<div class="col-md-6 form-group">
									<label for="project_name"><?php _e('Project Name', 'jobboard'); ?></label>
									<input id="project_name" class="form-control" type="text" name="project_name[]" />
								</div>
								<div class="col-md-6 form-group">
									<label for="project_year"><?php _e( 'Project Year', 'jobboard' ); ?></label>
									<input id="project_year" class="form-control" type="text" name="project_year[]" />
								</div>
							</div><!-- /.row -->

							<div class="row">
								<div class="col-md-12 form-group">
									<label for="project_url"><?php _e('Project URL', 'jobboard'); ?></label>
									<input id="project_url" class="form-control" type="text" name="project_url[]" />
								</div>
							</div><!-- /.row -->

							<label for="project_detail"><?php _e( 'Project Detail', 'jobboard' ); ?></label>
							<textarea id="project_detail" class="form-control textarea-detail" name="project_detail[]"></textarea>

						</div><!-- /.repeated-form -->


						<div class="form-group">
							<label for="url"><?php _e( 'Client(s)', 'jobboard' ); ?></label>
							<button type="button" id="add_client_button" class="btn btn-add-client" data-limit="5" data-form-id="#client_form" ><?php _e( '+ Add Client', 'jobboard' ); ?></button>
						</div><!-- /.form-group -->

					</div><!-- /.company_part_data -->


					<div class="company_part_data">

						<h4><?php echo __('Company Testimonial', 'jobboard'); ?></h4>

						<div class="form-group">
							<label for="company_testimonial_headline"><?php _e( 'Headline', 'jobboard' ); ?></label>
							<input type="text" id="company_testimonial_headline" name="company_testimonial_headline" class="form-control" value="<?php echo esc_attr( $default['company_testimonial_headline'] ); ?>" />
							<p></p>
							<label for="testimonial_content"><?php _e( 'Testimonial Content', 'jobboard' ); ?></label>
							<textarea id="testimonial_content" class="form-control textarea-detail" name="testimonial_content"><?php echo esc_attr( $default['company_testimonial_content'] ); ?></textarea>

							<div class="row">
								<div class="col-md-6 form-group">
									<label for="testimonial_author"><?php _e('Author', 'jobboard'); ?></label>
									<input id="testimonial_author" class="form-control" type="text" name="testimonial_author" value="<?php echo $default['company_testimonial_author']; ?>" />
								</div>
								<div class="col-md-6 form-group">
									<label for="testimonial_author_occupation"><?php _e( 'Author Occupation', 'jobboard' ); ?></label>
									<input id="testimonial_author_occupation" class="form-control" type="text" name="testimonial_author_occupation" value="<?php echo $default['company_testimonial_author_occupation']; ?>" />
								</div>
							</div><!-- /.row -->

							<div class="row">


								<div class="upload-image-field-container">

									<label for="testimonial_author_avatar"><?php _e( 'Author Avatar', 'jobboard' ); ?></label>
									<?php
										$avatar_id = $default['company_testimonial_author_avatar_id']; // From hidden field
										$avatar_url = $default['company_testimonial_author_avatar'];
										$avatar_id_by_url = jboard_get_image_id_by_url($avatar_url);

										if($avatar_id_by_url) {

											$avatar_id = $avatar_id_by_url;

											$avatar_img_src = wp_get_attachment_image_src( $avatar_id, 'jobboard-company-testimonial-thumbnail' );
											echo '<img class="front-end-img testimonial-avatar" src="'.$avatar_img_src[0].'" width="'.$avatar_img_src[1].'" height="'.$avatar_img_src[1].'" alt="" />';
										}

									?>
									<input class="" type="file" name="testimonial_author_avatar" id="testimonial_author_avatar_1" accept="image/*" />

								</div><!-- /.upload-image-field-container -->

								<div class="col-md-12 form-group">
									<label for="testimonial_author_url"><?php _e('Author URL', 'jobboard'); ?></label>
									<input id="testimonial_author_url" class="form-control" type="text" name="testimonial_author_url" value="<?php echo $default['company_testimonial_author_url']; ?>" />
								</div>
							</div><!-- /.row -->

						</div><!-- /.form-group -->

					</div><!-- /.company_part_data -->





					<div class="company_part_data">

						<h4><?php echo __('Portfolio', 'jobboard'); ?></h4>


						<div class="clearfix"></div>

						<div class="form-group">
							<label for="company_portfolio_headline"><?php _e( 'Headline', 'jobboard' ); ?></label>
							<input type="text" id="company_portfolio_headline" name="company_portfolio_headline" class="form-control" value="<?php echo esc_attr( $default['company_portfolio_headline'] ); ?>" />
							<p></p>


<?php

if( isset( $_GET['action']) && $_GET['action'] == 'edit' ){
	/** Get submitted image **/

	$company_portfolio_data = get_post_meta( $edit->ID, '_jboard_company_portfolio_group_container', true );


	/** Get stored data, starts **/
	$company_portfolio_data_stored_img = get_post_meta( $edit->ID, '_jboard_company_portfolio_stored_img', true );
	$stored_url_meta = get_post_meta( $edit->ID, '_jboard_company_portfolio_stored_url', true );


	if($stored_url_meta) {

		$stored_url = array();
		foreach($stored_url_meta as $key => $value){

			$stored_url[$key] = $stored_url_meta[$key];

		}

	}

	$n = 0;

	if($company_portfolio_data_stored_img) {

	foreach($company_portfolio_data_stored_img as $attachment_id0) :


		$portfolio_img_src0 = wp_get_attachment_image_src( $attachment_id0, 'jobboard-company-testimonial-thumbnail' );
		$portfolio_img0 = '<img class="front-end-img testimonial-avatar" src="'.$portfolio_img_src0[0].'" width="'.$portfolio_img_src0[1].'" height="'.$portfolio_img_src0[1].'" alt="" />';
		$get_stored_url = $stored_url[$n];

		if($attachment_id0 != '') { // Check if attachment id is not empty string

		?>

		<div class="repeated-form" style="display:block">
			<div class="close-form" data-button-limit="6" data-button-name="#add_url_button"><i class="fa fa-times"></i></div>

			<div class="row">

				<div class="col-md-12 form-group">

					<?php echo $portfolio_img0; ?>

					<label for="portfolio_image"><?php _e('Portfolio Image', 'jobboard'); ?></label>
					<input class="" type="file" name="portfolio_image[]" id="portfolio_image" accept="image/*" />
					<input type="hidden" name="portfolio_stored_image_id[]" value="<?php echo $attachment_id0; ?>" />

				</div>

				<div class="col-md-12 form-group">
					<label for="portfolio_url"><?php _e('Portfolio URL', 'jobboard'); ?></label>
					<input id="portfolio_url" class="form-control" type="text" name="portfolio_url2[]" value="<?php echo $get_stored_url; ?>" />
				</div>

			</div><!-- /.row -->

		</div><!-- /.repeated-form -->

	<?php

	} // Check if attachment id is not empty string ends

	$n++;

	endforeach;
	}


	/** Get stored data, ends **/



	/** New data, starts **/
	foreach($company_portfolio_data['_jboard_company_portfolio_group'] as $portfolio) :

		$attachment_id = $portfolio['portfolio_image'];
		$portfolio_img_src = wp_get_attachment_image_src( $attachment_id, 'jobboard-company-testimonial-thumbnail' );
		$portfolio_img = '<img class="front-end-img testimonial-avatar" src="'.$portfolio_img_src[0].'" width="'.$portfolio_img_src[1].'" height="'.$portfolio_img_src[1].'" alt="" />';
		$portfolio_url = $portfolio['portfolio_url']; ?>

		<div class="repeated-form" style="display:block">
			<div class="close-form" data-button-limit="6" data-button-name="#add_url_button"><i class="fa fa-times"></i></div>

			<div class="row">

				<div class="col-md-12 form-group">

					<?php
						echo $portfolio_img . '<br />';
					?>

					<label for="portfolio_image"><?php _e('Portfolio Image', 'jobboard'); ?></label>
					<input class="" type="file" name="portfolio_image[]" id="portfolio_image" accept="image/*" />
					<input type="hidden" name="portfolio_stored_image_id[]" value="<?php echo $attachment_id; ?>" />

				</div>

				<div class="col-md-12 form-group">
					<label for="portfolio_url"><?php _e('Portfolio URL', 'jobboard'); ?></label>
					<input id="portfolio_url" class="form-control" type="text" name="portfolio_url2[]" value="<?php echo $portfolio_url; ?>" />
				</div>

			</div><!-- /.row -->

		</div><!-- /.repeated-form -->

	<?php

	endforeach;
	/** New data, ends **/

	/** Get submitted image ends **/
}

?>


							<div id="portfolio_form" class="repeated-form">
								<div class="close-form" data-button-limit="6" data-button-name="#add_url_button"><i class="fa fa-times"></i></div>

								<div class="row">

									<div class="col-md-12 form-group">
										<label for="portfolio_image"><?php _e('Portfolio Image', 'jobboard'); ?></label>
										<input class="" type="file" name="portfolio_image[]" id="portfolio_image" accept="image/*" />
									</div>

									<div class="col-md-12 form-group">
										<label for="portfolio_url"><?php _e('Portfolio URL', 'jobboard'); ?></label>
										<input id="portfolio_url" class="form-control" type="text" name="portfolio_url[]" />
									</div>

								</div><!-- /.row -->

							</div><!-- /.repeated-form -->


							<div class="form-group">
								<label for="add_portfolio_button"><?php _e( 'Portfolio(s)', 'jobboard' ); ?></label>
								<button type="button" id="add_portfolio_button" class="btn btn-add-portfolio" data-limit="5" data-form-id="#portfolio_form" ><?php _e( '+ Add Portfolio', 'jobboard' ); ?></button>
							</div><!-- /.form-group -->


						</div><!-- /.form-group -->

					</div><!-- /.company_part_data -->




			<div class="company_part_data">

				<h4><?php echo __('Company Address', 'jobboard'); ?></h4>

				<h5><?php echo _e('Map Coordinate', 'jobboard'); ?></h5>

				<div class="row">
						<div class="col-md-6 form-group">
							<label for="gmap_latitude"><?php _e('Google Map Latitude', 'jobboard'); ?></label>
							<input value="<?php echo $default['company_address_gmap_latitude']; ?>" id="gmap_latitude" type="text" class="form-control" name="gmap_latitude" />
						</div>
						<div class="col-md-6 form-group">
							<label for="gmap_longitude"><?php _e('Google Map Longitude', 'jobboard'); ?></label>
							<input value="<?php echo $default['company_address_gmap_longitude']; ?>" id="gmap_longitude" type="text" class="form-control" name="gmap_longitude" />
						</div>
				</div><!-- /.row -->

				<div class="row">
					<div class="col-md-12 form-group">
						<label for="company_address"><?php _e('Address', 'jobboard'); ?></label>
						<input value="<?php echo $default['company_address']; ?>" id="company_address" type="text" class="form-control" name="company_address" />
					</div>
				</div><!-- /.row -->

				<div class="row">
					<div class="col-md-6 form-group">
						<label for="company_phone"><?php _e('Phone', 'jobboard'); ?></label>
						<input value="<?php echo $default['company_phone']; ?>" id="company_phone" type="text" class="form-control" name="company_phone" />
					</div>
					<div class="col-md-6 form-group">
						<label for="company_email"><?php _e('Email', 'jobboard'); ?></label>
						<input value="<?php echo $default['company_email']; ?>" id="company_email" type="text" class="form-control" name="company_email" />
					</div>
				</div><!-- /.row -->


			</div><!-- /.company_part_data -->



					<?php
						if( isset( $_GET['action'] ) && $_GET['action'] == 'edit' ){
							$button_text = __( 'Update Company', 'jobboard' );
					?>
						<input type="hidden" name="form_type" id="form_type" value="edit_post_company" />
						<input type="hidden" name="post_id" id="post_id" value="<?php echo $default['post_id']; ?>" />
					<?php
						}else{
							$button_text = __( 'Add Company', 'jobboard' );
					?>
						<input type="hidden" name="form_type" id="form_type" value="post_company" />
					<?php
						}
					?>
					<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( get_current_user_id() ); ?>" />
					<button type="submit" name="submit" class="btn btn-post-resume" value="1"><?php echo esc_attr( $button_text ); ?></button>

				</form>
			</div><!-- /.col-md-8 -->

			<?php get_sidebar(); ?>

		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /#content -->

<?php
get_footer();
