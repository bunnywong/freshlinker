<?php
/**
 * Template Part Name : Job Stats
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 *
 */
?>

<div id="job-stats">
	<div class="container">
		<h1 class="job-stats-title"><?php echo apply_filters( 'jobboard_job_stats_title', jobboard_option('job_status_title') ); ?></h1>
		<p class="job-stats-desc">
			<?php echo esc_attr( jobboard_option('job_status_description') ); ?>
		</p>
		<div class="job-stats-wrapper row">

			<div class="col-lg-2 col-lg-offset-2 col-sm-4" style="margin-left:24.667%;">
				<div class="count-box">
				<?php 
					$job_posted = of_get_option('jb_posted_status');
					if ( !empty( $job_posted ) ) {
						echo esc_attr( $job_posted );
					} else {
						$job['jobs'] = wp_count_posts( 'job' );
						echo $job['jobs']->publish;
					}
				?>
				</div><!-- /.count-box -->
				<div class="count-text">
				<?php
					echo apply_filters( 'jobboard_job_posted_text', _n( 'Job Posted', 'Jobs Posted', $job['jobs']->publish, 'jobboard' ) );
				?>
				</div><!-- /.count-text -->
			</div> <!-- /.col-lg-2 col-lg-offset-2 col-md-4" -->
			<div class="col-lg-2 col-sm-4" style="display:none;">
				<div class="count-box">
				<?php 
					$position = of_get_option('jb_position_status');
					if ( !empty( $position ) ) {
						echo esc_attr( $position );
					} else {
						$job['pos'] = wp_count_terms( 'job_category', array( 'hide_empty' => true ) );
						echo esc_attr( $job['pos'] );
					}
				?>
				</div><!-- /.count-box -->
				<div class="count-text">
				<?php
					echo apply_filters( 'jobboard_job_position_text', _n( 'Position Filled', 'Positions Filled', $job['pos'], 'jobboard' ) );
				?>
				</div><!-- /.count-text -->
			</div><!-- /.col-lg-2 col-sm-4 -->
			<div class="col-lg-2 col-sm-4">
				<div class="count-box">
				<?php 
					$cp_count = of_get_option('jb_cp_status');
					if ( !empty( $cp_count ) ) {
						echo esc_attr( $cp_count );
					} else {
						$job['comp'] = wp_count_posts( 'company' );
						echo esc_attr( $job['comp']->publish );
					}
				?>
				</div><!-- /.count-box -->
				<div class="count-text">
				<?php
					echo apply_filters( 'jobboard_job_company_text', _n( 'Company', 'Companies', $job['comp']->publish, 'jobboard' ) );
				?>
				</div><!-- /.count-text -->
			</div><!-- /.col-lg-2 col-sm-4 -->
			<div class="col-lg-2 col-sm-4">
				<div class="count-box">
				<?php 
					$user_count = of_get_option('jb_member_status');
					if ( !empty( $user_count ) ) {
						echo esc_attr( $user_count );
					} else {
						$job_user = count_users();
						echo esc_attr( $job_user['total_users'] );
					}
				?>
				</div><!-- /.count-box -->
				<div class="count-text">
				<?php
					echo apply_filters( 'jobboard_job_member_text', _n( 'Member', 'Members', $job_user['total_users'], 'jobboard' ) );
				?>
				</div><!-- /.count-text -->
			</div><!-- /.col-lg-2 col-sm-4 -->
		</div><!-- /.job-stats-wrapper -->
	</div><!-- /.container -->
</div><!-- /#job-stats -->