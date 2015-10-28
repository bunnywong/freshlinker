<?php

/**

 * Template Name: Resume Listing

 *

 * @package WordPress

 * @subpackage Job_Board

 * @since Job Board 1.3

 *

 */

?>



<?php get_header(); ?>

<?php if ( is_user_logged_in() ) { ?> 

<?php get_template_part( 'template-parts/listing', 'resume_search' ); ?>



<?php get_template_part( 'template-parts/listing', 'resume_listing' ); ?>

<?php } else { ?>

<?php 
$page = get_page_by_title( 'Register' );
$newURL = get_permalink( $page->ID );
header('Location: '.$newURL);
?>

<?php } ?> 


<?php get_footer(); ?>

