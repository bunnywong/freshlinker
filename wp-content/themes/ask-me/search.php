<?php get_header();
	global $vbegy_sidebar;
	$blog_style = vpanel_options("home_display");
	$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	if ($post->post_type == "question") {
		get_template_part("loop-question","search");
	}else {
		get_template_part("loop","search");
	}
	vpanel_pagination();
get_footer();?>