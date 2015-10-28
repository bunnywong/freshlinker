<?php
/**
 * Template Part Name : Homepage Job Listing
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 *
 */
?>
<div id="jobs-listing" class="in-homepage">
	<div class="container">
		<div class="row">

			<div class="col-lg-8">
				<div class="jobs-listing-title">
					<h3><i class="fa fa-briefcase"></i><?php _e( 'Recent Jobs', 'jobboard' ); ?></h3>
				</div>
				<div class="jobs-listing-wrapper">
					<div id="job-listing-tabs">
						<ul>
						<?php
							echo '<li><a href="#all_jobs">'.__( 'All', 'jobboard' ).'</a></li>';
							$job_types = get_terms('job_type');
							foreach( $job_types as $job_type ){
								echo '<li><a href="#'.$job_type->slug.'-'.$job_type->term_id.'">'.esc_attr( $job_type->name ).'</a></li>';
							}
						?>
						</ul>
						<div id="all_jobs">
						<?php
							if ( get_query_var('paged') ) {	$paged = get_query_var('paged'); } 
							elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } 
							else { $paged = 1; }
								
							$job_args = array( 'post_type' => 'job', 'posts_per_page' => 5, 'paged' => $paged );
							$jobs = new WP_Query($job_args);
							while( $jobs-> have_posts() ){
								$jobs->the_post();
						?>
							<a class="job-listing-permalink" href="<?php echo esc_url( get_permalink() ); ?>">
								<div class="job-listing-row clearfix">
									<div class="job-company-logo">
									<?php
										$comp_id = get_post_meta( get_the_id(), '_jboard_job_company', true );
										$company_img = get_the_post_thumbnail( $comp_id, 'jobboard-company-logo-thumbnail' );
										$company_url = get_permalink($comp_id);
										echo $company_img;
										// echo '<a href="'.esc_url($company_url).'">'.$company_img.'</a>';
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
								</div><!-- /#job-listing-<?php echo get_the_id(); ?> -->
							</a>
						<?php
							}
							nmedia_pagination( $args, $jobs ); 
							wp_reset_postdata();
							wp_reset_query();
						?>
						</div><!-- /#all_jobs -->
						<?php
							foreach( $job_types as $job_type ){
						?>
						<div id="<?php echo $job_type->slug.'-'.$job_type->term_id; ?>">
						<?php
							$job_args['tax_query'] = array(
								array(
									'taxonomy' => 'job_type',
									'terms' => $job_type->term_id,
								),
							);
							$jobs = new WP_Query($job_args);
							while( $jobs-> have_posts() ){
								$jobs->the_post();
						?>
							<a class="job-listing-permalink" href="<?php echo esc_url( get_permalink() ); ?>">
								<div class="job-listing-row clearfix">
									<div class="job-company-logo">
									<?php
										$comp_id = get_post_meta( get_the_id(), '_jboard_job_company', true );
										echo get_the_post_thumbnail( $comp_id , 'jobboard-company-logo-thumbnail' );
									?>
									</div><!-- /.job-company-logo -->
									<div class="job-listing-name">
										<h4><?php echo esc_attr( get_the_title() ); ?></h4>
										<p class="job-listing-summary"><?php echo get_post_meta( get_the_id(), '_jboard_job_summary', true ); ?></p>
									</div><!-- /.job-listing-name -->
									<div class="job-listing-region">
										<i class="fa fa-fw fa-map-marker"></i>
										<?php
											$job_taxs = get_the_terms( get_the_id(), 'job_nature' );
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
								</div><!-- /#job-listing-<?php echo get_the_id(); ?> -->
							</a>
						<?php
							}
							nmedia_pagination( $args, $jobs ); 
							wp_reset_postdata();
							wp_reset_query();
						?>
						</div><!-- /#<?php echo esc_attr( $job_type->slug ).'-'.esc_attr( $job_type->term_id ); ?> -->
						<?php
							}
						?>
					</div><!-- /#job-listing-tabs -->
					<div id="loding"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/loding.gif" alt="loding..ing..ing.."></div>
					
				</div><!-- /.jobs-listing-wrapper -->
			</div><!-- /.col-md-8 -->

			<?php get_sidebar('home'); ?>

		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /#jobs-listings -->
