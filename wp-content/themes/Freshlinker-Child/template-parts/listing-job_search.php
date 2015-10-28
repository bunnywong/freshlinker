<?php
/**
 * Template Part Name : Search Result Job Listing
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 *
 */
?>
<div id="jobs-listing" class="related-job-listing featured-job">
	<div class="container">
		<div class="jobs-listing-title">
			<h3>
				<i class="fa fa-briefcase"></i>
				<?php _e( 'Jobs Search Result', 'jobboard' ); ?>
			</h3>
		</div>
		<div class="jobs-search-wrapper">
			<div id="all_jobs">
				<?php
					//Protect against arbitrary paged values
					$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

					if( is_page_template( 'page-templates/template-job_search.php' ) ){
						$keyword = isset($_GET['keyword'])?$_GET['keyword']:'';
						$sallary = array(
							'min'	=> isset($_GET['sallary_min'])?$_GET['sallary_min']:'',
							'max'	=> isset($_GET['sallary_min'])?$_GET['sallary_max']:'',
						);
						$experience = array(
							'min'	=> isset($_GET['experience_min'])?$_GET['experience_min']:'',
							'max'	=> isset($_GET['experience_max'])?$_GET['experience_max']:'',
						);
						$job_args = array(
							's'				=> $keyword,
							'post_type'		=> 'job',

							/*
							'meta_query'	=> array(
								'relation'	=> 'AND',
								array(
									'key'		=> '_jboard_job_sallary',
									'value'		=> array( $sallary['min'], $sallary['max'] ),
									'type'		=> 'numeric',
									'compare'	=> 'BETWEEN',
								),
								array(
									'key'		=> '_jboard_job_experiences',
									'value'		=> array( $experience['min'], $experience['max'] ),
									'type'		=> 'numeric',
									'compare'	=> 'BETWEEN',
								),
							),
							*/

						);
						
						// Taxonomy query for job nature
						$job_nature_array = array();
						if( isset( $_GET['job_nature']) && $_GET['job_nature'] != '' ){

							$job_nature_array = array(
								'taxonomy'	=> 'job_nature',
								'field'		=> 'slug',
								'terms'		=> sanitize_title($_GET['job_nature']),
							);

							$job_args['tax_query']	= array(
								$job_nature_array
							);

						}

						// Taxonomy query for job category
						$job_category_array = array();
						if( isset( $_GET['job_category']) && $_GET['job_category'] != '' ){

							$job_category_array = array(
								'taxonomy'	=> 'job_category',
								'field'		=> 'slug',
								'terms'		=> sanitize_title($_GET['job_category']),
							);

							$job_args['tax_query']	= array(
								$job_category_array
							);

						}

						// Taxonomy query for job type
						$job_type_array = array();
						if( isset( $_GET['job_type']) && $_GET['job_type'] != '' ){

							$job_type_array = array(
								'taxonomy'	=> 'job_type',
								'field'		=> 'slug',
								'terms'		=> sanitize_title($_GET['job_type']),
							);

							$job_args['tax_query']	= array(
								$job_type_array
							);

						}

						// Taxonomy query for job location
						$job_location_array = array();
						if( isset( $_GET['location']) && $_GET['location'] != '' ){

							$job_location_array = array(
								'taxonomy'	=> 'job_region',
								'field'		=> 'slug',
								'terms'		=> sanitize_title($_GET['location']),
							);

							$job_args['tax_query']	= array(
								$job_location_array
							);

						}

						$job_nature_array = (!empty($job_nature_array)) ? $job_nature_array : null;
						$job_category_query = (!empty($job_category_array)) ? $job_category_array : null;
						$job_type_query = (!empty($job_type_array)) ? $job_type_array : null;
						$job_location_query = (!empty($job_location_array)) ? $job_location_array : null;

						// Taxonomy query for job location, job category, and job type
						if( (isset( $_GET['location']) && $_GET['location'] != '') || (isset( $_GET['job_nature']) && $_GET['job_nature'] != '') || (isset( $_GET['job_category']) && $_GET['job_category'] != '') || (isset( $_GET['job_type']) && $_GET['job_type'] != '') ){

							$job_args['tax_query']	= array(
								'relation' => 'AND',
								$job_nature_array,
								$job_category_query,
								$job_type_query,
								$job_location_query
							);

						}



					}else{
						$job_args = array(
							'post_type' => 'job',
						);
					}
					$job_args['posts_per_page'] = 10;
					$job_args['paged'] = $paged;

					$jobs = new WP_Query($job_args);

					if( $jobs->have_posts() ){
						while( $jobs-> have_posts() ){
							$jobs->the_post();
						?>
						<div class="job-listing-row clearfix">
							<div class="job-company-logo hidden-sm hidden-xs">
							<?php
								$comp_id = get_post_meta( get_the_id(), '_jboard_job_company', true );
								echo get_the_post_thumbnail( $comp_id , 'jobboard-related-company-logo-thumbnail' );
							?>
							</div><!-- /.job-company-logo -->
							<div class="job-listing-name">
								<h4><?php echo esc_attr( get_the_title() ); ?></h4>
								<p class="job-listing-summary"><?php echo get_post_meta( get_the_id(), '_jboard_job_summary', true ); ?></p>
							</div><!-- /.job-listing-name -->
							<div class="job-listing-region">
								<?php
									$job_taxs = get_the_terms( get_the_id(), 'job_nature' );
									if($job_taxs){
										foreach( $job_taxs as $job_tax ){
											echo '<span>' . esc_attr( $job_tax->name ) . '</span>';
										}
									}
								?>
							</div><!-- /.job-listing-region -->
							<div class="job-listing-type hidden-sm hidden-xs">
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
								<a href="<?php echo esc_url( get_permalink(get_the_id()) ); ?>" class="btn btn-view-job"><?php _e( 'View Job', 'jobboard' ) ?></a>
							</div><!-- /.job-listing-view -->
						</div><!-- /#job-listing-<?php echo esc_attr( get_the_id() ); ?> -->
					<?php
						} //endwhile;

						$big = 999999999; // need an unlikely integer

						echo '<div class="dashboard-pagination">';

						echo paginate_links( array(
							'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format'	=> '?paged=%#%',
							'current'	=> max( 1, get_query_var('paged') ),
							'total'		=> $jobs->max_num_pages,
							'prev_text'	=> __( 'Previous', 'jobboard' ),
							'next_text' => __( 'Next', 'jobboard' ),
						) );

			            echo '</div><!-- /.dashboard-pagination -->';
						wp_reset_postdata();
					}else{
						jobboard_not_found( 'job_search' );
					}//endif;
					?>
				</div><!-- /#all_jobs -->
		</div><!-- /.jobs-listing-wrapper -->
	</div><!-- /.container -->
</div><!-- /#jobs-listings -->
