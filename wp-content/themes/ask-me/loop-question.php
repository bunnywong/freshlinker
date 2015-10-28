<?php
global $blog_style,$vbegy_sidebar_all,$authordata,$question_bump_template;
if (have_posts() ) : while (have_posts() ) : the_post();
	include ("question.php");
endwhile;else :
	echo "<div class='page-content page-content-user'><p class='no-item'>".__("No Questions Found.","vbegy")."</p></div>";
endif;