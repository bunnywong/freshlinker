<?php
/**
 * The main template file for single company page
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 */

get_header();



/** Post object **/

$post_obj = get_post(get_the_ID());
// get post author
$post_author = $post_obj->post_author;

?>

<div id="page-title-wrapper">
	<div class="container">

		<?php

		// Hidden meta
		$expertise = get_post_meta( get_the_ID(),'_jboard_hidden_expertises', true);

		// Visible meta
		$expertise2 = get_post_meta( get_the_ID(),'_jboard_company_expertises', true);

		$expertise_array = explode(',', $expertise);


		$default = array(
			'post_id'				=> '',
			'company_name'			=> '',
			'company_description' 	=> '',
			'company_overview' 	=> '',
			'company_website'		=> '',
			'company_facebook'		=> '',
			'company_twitter'		=> '',
			'company_google_plus'	=> '',
			'company_image'			=> '',
			'company_expertises' => '',
			'company_expertises_headline' => '',
			'company_service_headline' => '',
			'company_client_headline' => '',
			'company_testimonial_headline' => '',
			'company_testimonial_content' => '',
			'company_testimonial_author' => '',
			'company_testimonial_author_occupation' => '',
			'company_testimonial_author_url' => '',
			'company_testimonial_author_avatar' => '',
			'company_portfolio_headline' => '',
		);

		$company = array(
			'company_name'			=> get_the_title(),
			'company_description' 	=> get_post_meta( get_the_ID(), '_jboard_company_description', true ),
			'company_overview' 	=> get_post_meta( get_the_ID(), '_jboard_company_overview', true ),
			'company_website'		=> get_post_meta( get_the_ID(), '_jboard_company_web_address', true ),
			'company_facebook'		=> get_post_meta( get_the_ID(), '_jboard_company_social_facebook', true ),
			'company_twitter'		=> get_post_meta( get_the_ID(), '_jboard_company_social_twitter', true ),
			'company_google_plus'	=> get_post_meta( get_the_ID(), '_jboard_company_social_googleplus', true ),
			'company_image'			=> get_the_post_thumbnail( get_the_ID() ),
			'company_expertises' => get_post_meta( get_the_ID(), '_jboard_hidden_expertises', true ),
			'company_expertises_headline' => get_post_meta( get_the_ID(), '_jboard_company_expertises_headline', true ),
			'company_service_headline' => get_post_meta( get_the_ID(), '_jboard_company_service_headline', true ),
			'company_client_headline' => get_post_meta( get_the_ID(), '_jboard_company_client_headline', true ),
			'company_testimonial_headline' => get_post_meta( get_the_ID(), '_jboard_company_testimonial_headline', true ),
			'company_testimonial_content' => get_post_meta( get_the_ID(), '_jboard_company_testimonial_content', true),
			'company_testimonial_author' => get_post_meta( get_the_ID(), '_jboard_company_testimonial_author', true),
			'company_testimonial_author_occupation' => get_post_meta( get_the_ID(), '_jboard_company_testimonial_author_occupation', true),
			'company_testimonial_author_url' => get_post_meta( get_the_ID(), '_jboard_company_testimonial_author_url', true),
			'company_testimonial_author_avatar' => get_post_meta( get_the_ID(), '_jboard_company_testimonial_author_avatar', true),
			'company_portfolio_headline' => get_post_meta( get_the_ID(), '_jboard_company_portfolio_headline', true),
		);

		$default = wp_parse_args( $company, $default );
		$company_data = $default;


		function array_outz(){

			$arr = array(
				'value' => 'value_5',
				'label' => __('Label 5', 'jobboard'),
			);
			$arr = array(
				'value' => 'value_6',
				'label' => __('Label 6', 'jobboard'),
			);

			$needle = array('Val 15', 'Val 16', 'Val 17');

			$arrz = array();


			//$a['name'] = array();
			foreach($needle as $val){

				$a[] = array(
					'value' => $val,
					'label' => $val
				);

			}

			// print_r($a);

			return $a;

			/*
			foreach( $a as $key => $val ){

				$d = $val;

				print_r($d);

			}
			*/



		}

		// print_r( array_outz() );





			$page_title = __('Company Profile', 'jobboard');

		?>

		<h1 class="page-title"><?php echo esc_attr( $page_title ); ?></h1>

		<div id="company-header">

			<div id="company-main-logo">

				<?php
				$size = 'jobboard-company-logo';
				$img_attachment = wp_get_attachment_image_src(get_post_thumbnail_id(), $size);
				?>
				<a href="<?php the_permalink(); ?>"><img src="<?php echo $img_attachment[0]; ?>" width="<?php echo $img_attachment[1]; ?>" height="<?php echo $img_attachment[2]; ?>" alt="<?php the_title(); ?>" /></a>

			</div>


			<div id="company-head-menu">

				<?php
					if( $company_data['company_website'] || $company_data['company_twitter'] || $company_data['company_facebook'] || $company_data['company_google_plus'] ) {
				?>

				<ul class="company-head-menu first-menu">

					<?php if($company_data['company_website']){ ?>
					<li class="i-web"><a target="_blank" href="<?php echo esc_url($company_data['company_website']); ?>"><i class="fa fa-link"></i> Website</a></li>
					<?php } ?>

					<?php if($company_data['company_twitter']){ ?>
					<li class="i-twitter"><a target="_blank" href="<?php echo esc_url($company_data['company_twitter']); ?>"><i class="fa fa-twitter"></i> Twitter</a></li>
					<?php } ?>

					<?php if($company_data['company_facebook']){ ?>
					<li class="i-facebook"><a target="_blank" href="<?php echo esc_url($company_data['company_facebook']); ?>"><i class="fa fa-facebook"></i> Facebook</a></li>
					<?php } ?>

					<?php if($company_data['company_google_plus']){ ?>
					<li class="i-googleplus"><a target="_blank" href="<?php echo esc_url($company_data['company_google_plus']); ?>"><i class="fa fa-google-plus"></i> Google +</a></li>
					<?php } ?>

				</ul>

				<?php } ?>

				<ul class="company-head-menu second-menu">
					<li class="i-bar"><a href="#jobs"><i class="fa fa-list"></i> <?php echo _e('More Jobs', 'jobboard'); ?></a></li>
					<?php /*
					<li class="i-label"><a href="#"><i class="fa fa-tag"></i> Store</a></li>
					*/ ?>
				</ul>

				<?php /*
				<ul class="company-head-menu third-menu">
					<li class="i-bar"><a href="#"><i class="fa fa-share-square-o"></i> Share</a></li>
				</ul>
				*/ ?>

			</div>

		</div>


		<div class="row abount-company-content">

			<div class="col-md-6">
				<h2 class="sub-section-title uppercase"><?php echo _e('Overview', 'jobboard') ;?></h2>

				<article>
					<?php echo $company_data['company_overview']; ?>
				</article>
			</div>

			<div class="col-md-6">
				<h2 class="sub-section-title uppercase"><?php echo _e('About', 'jobboard');?> <?php the_title(); ?></h2>

				<article>
					<?php /*
					$default = array(
					'post_id'				=> '',
					'company_name'			=> '',
					'company_description' 	=> '',
					'company_overview' 	=> '',
					'company_website'		=> '',
					'company_facebook'		=> '',
					'company_twitter'		=> '',
					'company_google_plus'	=> '',
					'company_image'			=> '',
					'company_expertises' => '',
					*/ ?>
					<?php echo $company_data['company_description'];  ?>
				</article>
			</div>

		</div>


	</div><!-- /.container -->
</div><!-- /#page-title-wrapper -->

<?php

// Service data group
$company_service_data = get_post_meta( get_the_ID(), '_jboard_company_service_group_container', true );

if(isset($company_service_data["_jboard_company_service_group"])) :

if( $company_service_data["_jboard_company_service_group"]) :

?>



<div id="company_ourservice" class="company_page_section">
	<div class="container">

		<h1 class="jobboard-section-title uppercase"><?php echo __('Our Service', 'jobboard'); ?></h1>

		<?php if($company_data['company_service_headline']) { ?>
		<div class="section-subtitle"><?php echo $company_data['company_service_headline']; ?></div>
		<?php } ?>

		<div class="row">

			<?php

			foreach($company_service_data['_jboard_company_service_group'] as $service) :

			$icon = 'fa-star';

			if($service['service_icon'] != ''){
				$icon = $service['service_icon'];
			}

			?>

			<div class="col-md-4 company-service-item">

				<span class="section-icon"><i class="fa <?php echo $icon; ?>"></i></span>

				<h2><?php echo $service['service_name']; ?></h2>

				<?php echo $service['service_detail']; ?>

				</div><!-- /.col-md-4 -->

			<?php
			endforeach;
			?>


		</div>

	</div><!-- /.container -->
</div><!-- /#company_ourservice -->


<?php

endif; // End of $company_service_data["_jboard_company_service_group"] check

endif; // End of $company_service_data check
?>





<?php


if($expertise_array[0]) :

?>


<div id="company_experience" class="company_page_section company_page_odd_section">
	<div class="container">

		<h1 class="jobboard-section-title uppercase">Expertise</h1>

		<?php if($company_data['company_expertises_headline']) { ?>
		<div class="section-subtitle"><?php echo $company_data['company_expertises_headline']; ?></div>
		<?php } ?>

		<ul class="company_experience_group">
			<?php foreach($expertise_array as $expertise) { ?>
				<li><?php echo $expertise; ?></li>
			<?php } ?>
		</ul>

	</div><!-- /.container -->
</div><!-- /#company_experience -->


<?php

endif; // End $expertise_array[0] check

?>






<?php

// Service data group
$company_client_data = get_post_meta( get_the_ID(), '_jboard_company_client_group_container', true );

if(isset($company_client_data["_jboard_company_client_group"])) :

if($company_client_data && $company_client_data["_jboard_company_client_group"]) :

?>


<div id="company_clients" class="company_page_section">
	<div class="container">

		<h1 class="jobboard-section-title uppercase"><?php echo __('Clients', 'jobboard'); ?></h1>

		<?php if($company_data['company_client_headline']) { ?>
		<div class="section-subtitle"><?php echo $company_data['company_client_headline']; ?></div>
		<?php } ?>

		<div class="row">


			<?php


			foreach($company_client_data['_jboard_company_client_group'] as $client) :

			?>

			<div class="col-md-4">

				<h2 class="clinet-name uppercase"><?php echo $client['project_name']; ?></h2>
				<div class="client-date"><?php echo $client['project_year']; ?></div>
				<div class="client-web"><a rel="nofollow" target="_blank" href="<?php echo esc_url($client['project_url']); ?>"><?php echo $client['project_url']; ?></a></div>

				<div class="client-content">
					<p><?php echo $client['project_detail']; ?></p>
				</div>

			</div><!-- /.col-md-4 -->

			<?php

			endforeach;

			?>


		</div><!-- /.row -->



	</div><!-- /.container -->
</div><!-- /#company_clients -->


<?php

endif; // End $company_client_data check
endif; // End isset($company_client_data["_jboard_company_client_group"]) check

?>





<?php

if($company_data['company_testimonial_content']) :

?>


<div id="company_testimonials" class="company_page_section company_page_odd_section">
	<div class="container">

		<h1 class="jobboard-section-title uppercase"><?php echo __('Testimonials', 'jobboard'); ?></h1>

		<?php



		if($company_data['company_testimonial_headline']) { ?>
		<div class="section-subtitle"><?php echo $company_data['company_testimonial_headline']; ?></div>
		<?php } ?>

		<div class="company_testimonials_block">

			<?php if($company_data['company_testimonial_content']) { ?>
			<div class="testimonial-content">
				<blockquote><?php echo $company_data['company_testimonial_content']; ?></blockquote>
			</div>
			<?php } ?>

			<div class="testimonial-author">

				<?php

					$avatar_url = $company_data['company_testimonial_author_avatar'];
					$avatar_id_by_url = jboard_get_image_id_by_url($avatar_url);

					if($avatar_id_by_url) {

						$avatar_id = $avatar_id_by_url;

						$avatar_img_src = wp_get_attachment_image_src( $avatar_id, 'jobboard-company-testimonial-thumbnail' );
						$avatar_img = '<img class="rounded-100 testimonial-avatar" src="'.$avatar_img_src[0].'" width="'.$avatar_img_src[1].'" height="'.$avatar_img_src[1].'" alt="'.$company_data['company_testimonial_author'].'" />';
					}

				?>

				<a href="<?php echo esc_url($company_data['company_testimonial_author_url']); ?>">

					<?php echo $avatar_img; ?>

					<h2 class="testimonial-author-name"><?php echo $company_data['company_testimonial_author']; ?></h2>
					<span><?php echo $company_data['company_testimonial_author_occupation']; ?></span>

				</a>

			</div>

		</div><!-- /.company_testimonials_block -->

	</div><!-- /.container -->
</div><!-- /#company_testimonials -->



<?php

endif; // End $company_data['company_testimonial_content'] check

?>






<?php

$company_portfolio_data_stored_img = get_post_meta( get_the_ID(), '_jboard_company_portfolio_stored_img', true );
$company_portfolio_data = get_post_meta( get_the_ID(), '_jboard_company_portfolio_group_container', true );


/** Create an array to check an item has image
 * Used for checking only
 */

if($company_portfolio_data && isset($company_portfolio_data['_jboard_company_portfolio_group'])) {
	$attachment_ids = array();
	foreach($company_portfolio_data['_jboard_company_portfolio_group'] as $portfolio){

		$attachment_ids[] = $portfolio['portfolio_image'];

	}


// Check if one item has image
if(isset($company_portfolio_data_stored_img) || $attachment_ids) :
if($attachment_ids || $company_portfolio_data_stored_img) :

?>


<div id="company_portfolio" class="company_page_section">
	<div class="container">

		<h1 class="jobboard-section-title uppercase"><?php echo __('Portfolio', 'jobboard'); ?></h1>

		<?php if($company_data['company_portfolio_headline']) { ?>
		<div class="section-subtitle"><?php echo $company_data['company_portfolio_headline']; ?></div>
		<?php } ?>

		<ul class="company_portfolio_items">


			<?php


			/** Stored data starts
			*======================================= */

			/** Get stored data, starts **/
			$company_portfolio_data_stored_img = get_post_meta( get_the_ID(), '_jboard_company_portfolio_stored_img', true );
			$stored_url_meta = get_post_meta( get_the_ID(), '_jboard_company_portfolio_stored_url', true );

			if($stored_url_meta) {
				$stored_url = array();
				foreach($stored_url_meta as $key => $value){

					$stored_url[$key] = $stored_url_meta[$key];

				}
			}

			if($company_portfolio_data_stored_img) {

			$n = 0;
			foreach($company_portfolio_data_stored_img as $attachment_id0) :


				$portfolio_img_src0 = wp_get_attachment_image_src( $attachment_id0, 'jobboard-company-portfolio' );
				$get_stored_url = ($stored_url[$n]) ? $stored_url[$n] : '#';
				$portfolio_img0 = '<img src="'.$portfolio_img_src0[0].'" width="'.$portfolio_img_src0[1].'" height="'.$portfolio_img_src0[2].'" alt="'.esc_url($get_stored_url).'" />';


				if($attachment_id0 != '') { // Check if attachment id is not empty string


					echo '<li class="slider-item"><a href="'.esc_url($get_stored_url).'" target="_blank" rel="nofollow">'. $portfolio_img0 . '</a></li>';


				}

				$n++;

			endforeach;

			}

			/** Stored data ends
			*======================================= */








			/** Newest data starts
			*======================================= */

			$company_portfolio_data = get_post_meta( get_the_ID(), '_jboard_company_portfolio_group_container', true );

			foreach($company_portfolio_data['_jboard_company_portfolio_group'] as $portfolio) :


			$attachment_id = $portfolio['portfolio_image'];
			$portfolio_img_src = wp_get_attachment_image_src( $attachment_id, 'jobboard-company-portfolio' );
			$portfolio_url = $portfolio['portfolio_url'];
			$portfolio_img = '<img src="'.$portfolio_img_src[0].'" width="'.$portfolio_img_src[1].'" height="'.$portfolio_img_src[2].'" alt="'.esc_url($portfolio_url).'" />';


			echo '<li class="slider-item"><a href="'.esc_url($portfolio_url).'" target="_blank" rel="nofollow">'.$portfolio_img.'</a></li>';


			endforeach;


			/** Newest data ends
			*======================================= */





			?>


		</ul>


	</div><!-- /.container -->
</div><!-- /#company_portfolio -->



<?php

endif; // End $attachment_ids || $company_portfolio_data_stored_img check
endif;
}

?>





<div id="company_related_jobs" class="company_page_section">


	<div class="container">

		<div id="jobs-listing" class="jobboard_related_jobs_tabs related-job-listing">





			<div class="col-lg-12">
				<div class="jobs-listing-title">
					<h3 id="jobs" class="uppercase"><i class="fa fa-briefcase"></i><?php _e( 'Related Jobs', 'jobboard' ); ?></h3>
				</div>
				<div class="jobs-listing-wrapper">
					<div id="job-listing-tabs">

					<?php

						$this_comp_id = (string)$post_obj->ID;

						$job_args = array(
						'post_type' => 'job',
						'meta_key'   => '_jboard_job_company',
						'meta_value' => $this_comp_id
						);
						$jobs = new WP_Query($job_args);

					if(!$jobs->have_posts()) {
						echo __('No job offered by this company', 'jobboard');
					} else { ?>

						<ul>
							<?php

							$company_thumbnail_id = get_post_thumbnail_id();
							$company_id = get_the_ID();

							echo '<li><a href="#all_jobs">'.__( 'All', 'jobboard' ).'</a></li>';
							$job_types = get_terms('job_type');
							foreach( $job_types as $job_type ){
								echo '<li><a href="#'.$job_type->slug.'-'.$job_type->term_id.'">'.esc_attr( $job_type->name ).'</a></li>';
							}
							?>
						</ul>
						<div id="all_jobs">
							<?php
							$this_comp_id = (string)$post_obj->ID;
							$job_args = array(
								'post_type' => 'job',
								'meta_key'   => '_jboard_job_company',
								'meta_value' => $this_comp_id
							);
							$jobs = new WP_Query($job_args);

							$counter = array();
							$count = 0;

							while( $jobs->have_posts() ){
								$jobs->the_post();

								?>
									<div class="job-listing-row clearfix">
										<div class="job-company-logo">

											<?php
											$size = 'jobboard-company-logo-thumbnail';
											$img_attachment = wp_get_attachment_image_src($company_thumbnail_id, $size);

											// var_dump($img_attachment);

											?>
											<img src="<?php echo $img_attachment[0]; ?>" width="<?php echo $img_attachment[1]; ?>" height="<?php echo $img_attachment[2]; ?>" alt="<?php the_title(); ?>" />


										</div><!-- /.job-company-logo -->
										<div class="job-listing-name">
											<h4><?php echo esc_attr( get_the_title() ); ?></h4>
											<p class="job-listing-summary"><?php echo get_post_meta( get_the_id(), '_jboard_job_summary', true ); ?></p>
										</div><!-- /.job-listing-name -->
										<div class="job-listing-region">
											<i class="fa fa-fw fa-map-marker"></i>
											<?php
											$job_taxs = get_the_terms( get_the_id(), 'job_region' );
											if($job_taxs){
												foreach( $job_taxs as $job_tax ){
													echo esc_attr( $job_tax->name );
												}
											}
											?>
										</div><!-- /.job-listing-region -->
										<div class="job-listing-type">
											<i class="fa fa-fw fa-user"></i>
											<?php
											$job_taxs = get_the_terms( get_the_id(), 'job_type' );
											if($job_taxs){
												foreach( $job_taxs as $job_tax ){
													echo esc_attr( $job_tax->name );
												}
											}
											?>
										</div><!-- /.job-listing-type -->

										<div class="job-listing-view">

											<a class="btn btn-view-job" target="_blank" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo __('View Job', 'jobboard'); ?></a>

										</div><!-- /.view-job-button -->

									</div><!-- /#job-listing-<?php echo get_the_id(); ?> -->

								<?php

							} // endwhile



							wp_reset_query();
							?>
						</div><!-- /#all_jobs -->
						<?php
						foreach( $job_types as $job_type ){
							?>
							<div id="<?php echo $job_type->slug.'-'.$job_type->term_id; ?>">
								<?php

								$this_comp_id = (string)$post_obj->ID;

								$job_args['tax_query'] = array(
								array(
								'taxonomy' => 'job_type',
								'terms' => $job_type->term_id,
								'meta_key'   => '_jboard_job_company',
								'meta_value' => $this_comp_id
								),
								);
								$jobs = new WP_Query($job_args);

								if(!$jobs->have_posts()) {

									echo '<div class="job-listing-row clearfix"><div class="job-listing-type">';
									echo __('No job in this criteria.', 'jobboard');
									echo '</div></div>';

								} else {

								while( $jobs-> have_posts() ){

									$jobs->the_post();

									?>
										<div class="job-listing-row clearfix">
											<div class="job-company-logo">
												<?php
												$comp_id = get_post_meta( get_the_id(), '_jboard_job_company', true );
												echo get_the_post_thumbnail( $company_id , 'jobboard-company-logo-thumbnail' );
												?>
											</div><!-- /.job-company-logo -->
											<div class="job-listing-name">
												<h4><?php echo esc_attr( get_the_title() ); ?></h4>
												<p class="job-listing-summary"><?php echo get_post_meta( get_the_id(), '_jboard_job_summary', true ); ?></p>
											</div><!-- /.job-listing-name -->
											<div class="job-listing-region">
												<i class="fa fa-fw fa-map-marker"></i>
												<?php
												$job_taxs = get_the_terms( get_the_id(), 'job_region' );
												if($job_taxs){
													foreach( $job_taxs as $job_tax ){
														echo esc_attr( $job_tax->name );
													}//endforeach;
												}//endif;
												?>
											</div><!-- /.job-listing-region -->
											<div class="job-listing-type">
												<i class="fa fa-fw fa-user"></i>
												<?php
												$job_taxs = get_the_terms( get_the_id(), 'job_type' );
												if($job_taxs){
													foreach( $job_taxs as $job_tax ){
														echo esc_attr( $job_tax->name );
													}//endforeach;
												}//endif;
												?>
											</div><!-- /.job-listing-type -->

											<div class="job-listing-view">

												<a class="btn btn-view-job" target="_blank" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo __('View Job', 'jobboard'); ?></a>

											</div><!-- /.view-job-button -->

										</div><!-- /#job-listing-<?php echo get_the_id(); ?> -->

									<?php

								} // endwhile
								} // end has not post check


								wp_reset_query();
								?>
							</div><!-- /#<?php echo esc_attr( $job_type->slug ).'-'.esc_attr( $job_type->term_id ); ?> -->
							<?php
						}


						} // End of if check !$job

						?>
					</div><!-- /#job-listing-tabs -->
				</div><!-- /.jobs-listing-wrapper -->
			</div><!-- /.col-md-12 -->


		</div><!-- /.jobboard_related_jobs_tabs -->

	</div>
</div><!-- /#company_related_jobs -->





<?php

$address = get_post_meta( get_the_ID(), '_jboard_company_address', true );

if($address) :

?>



<div id="jobboard_company_address_contact">

	<div id="jobboard_map_container"></div>

	<div class="container-outer">
	<div class="container">


		<div class="col-md-6">
			<?php


			$latitude = get_post_meta( get_the_ID(), '_jboard_company_address_gmap_latitude', true );
			$longitude = get_post_meta( get_the_ID(), '_jboard_company_address_gmap_longitude', true );
			$address = get_post_meta( get_the_ID(), '_jboard_company_address', true );
			$phone = get_post_meta( get_the_ID(), '_jboard_company_phone', true );
			$email = get_post_meta( get_the_ID(), '_jboard_company_email', true );

			jobboard_create_gmaps( 'jobboard_map_container', $latitude, $longitude );
			?>

			<div class="jobboard_company_map_locator">

				<div class="inner">

					<h3 class="jb_map_location_name"><?php echo _e('Address:', 'jobboard'); ?></h3>

					<ul>
						<li class="jb_map_address"><i class="fa fa-map-marker"></i> <?php echo $address; ?></li>
						<li class="jb_map_phone"><i class="fa fa-mobile"></i> <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo $phone; ?></a></li>
						<li class="jb_map_contact"><i class="fa fa-globe"></i> <?php echo $email; ?></li>
					</ul>

				</div>

			</div><!-- /.jobboard_company_map_pin -->
		</div><!-- /.col-md-6 -->



		<div class="col-md-6">
			<div class="jobboard_company_contactform">

				<form id="contact-form" class="frontend-form" action="<?php echo esc_url( admin_url('admin-ajax.php') ); ?>" method="post">


					<h3 class="uppercase form-title">Contact Form</h3>

					<div class="inputrow form-group">
						<input type="text" name="contact_name" class="your_name no-border" placeholder="Name" />
						<input type="email" name="contact_email" class="your_email no-border" placeholder="Email" />
					</div>

					<div class="inputrow form-group">
						<textarea name="contact_message" class="your_message form-control no-border" placeholder="Message"></textarea>
					</div>

					<div class="inputrow form-group no-margin-bottom">

						<input type="hidden" name="action" value="jobboard_send_contact_form_company" />
						<input type="hidden" name="contact_mailto" value="<?php echo $email; ?>" />
						<button type="submit" name="contact_submit" value="1" class="btn btn-send-contact-form send_message uppercase btn btn-post-content yellow-bg" data-loading-text="<?php _e( 'Sending...', 'jobboard' ); ?>"><?php _e( 'Send', 'jobboard' ); ?></button>
						<div class="contact-form-status alert alert-success alert-dismissable" role="alert">
							<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true"><i class="fa fa-times"></i></span><span class="sr-only"><?php _e( 'Close', 'jobboard' ); ?></span></button>
							<?php _e( '<strong>Thank you!</strong> Your message was sent successfully', 'jobboard' ); ?>
						</div>

					</div>


				</form>

			</div><!-- /.jobboar_company_contactform -->
		</div><!-- /.col-md-6 -->

	</div>
</div><!-- /.container-outer -->

</div><!-- /#jobboard_company_address_contact -->


<?php

endif; // End $address check

?>



<?php
get_footer();
