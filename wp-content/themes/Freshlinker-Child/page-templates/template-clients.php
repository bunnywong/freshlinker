<?php



/**

 * Template Name: Clients

 *

 * @package WordPress

 * @subpackage Job_Board

 * @since Job Board 1.0

 *

 */

 

get_header(); ?>


<style>

.col-sm-4 {
	padding: 0px;
}

</style>



<div id="content" <?php post_class(); ?> style="padding: 0px;">


		<article id="page-<?php the_ID(); ?>">

		<?php

			while( have_posts() ){

				the_post();



				the_content();



			}//endwhile;

		?>

		</article>


</div><!-- /#content -->



<?php

get_footer();