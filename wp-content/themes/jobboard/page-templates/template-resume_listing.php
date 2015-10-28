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

<?php get_template_part( 'template-parts/listing', 'resume_search' ); ?>

<?php get_template_part( 'template-parts/listing', 'resume_listing' ); ?>

<?php get_footer(); ?>
