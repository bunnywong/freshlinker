<?php

/**
 * Template Name: Homepage
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 *
 */
 
get_header(); ?>



 <?php putRevSlider( "mainhomeslider" ) ?>

<?php
	//get_template_part( 'template-parts/form', 'job_search' );
	get_template_part( 'template-parts/homepage', 'jobs_listing' );
?>

<?php
	if( jobboard_option('enable_job_status') ){
		get_template_part( 'template-parts/homepage', 'job_stats' );
	}//endif;
?>

<div id="testimonials">

	<div class="container">

		<?php the_field('home_page_contant'); ?>

	</div>
</div>

<?php
	if( jobboard_option('enable_job_steps') ){
		get_template_part( 'template-parts/homepage', 'job_step' );
	}//endif;
?>

<?php
	if( jobboard_option('enable_company') ){
		get_template_part( 'template-parts/homepage', 'company' );
	}//endif;
?>


<?php
	if( jobboard_option('enable_testimonial') ){
		get_template_part( 'template-parts/homepage', 'testimonials' );
	}//endif;
?>





<?php
get_footer();