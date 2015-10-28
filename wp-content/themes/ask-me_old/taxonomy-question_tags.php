<?php get_header();
	global $vbegy_sidebar;
	$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	get_template_part("loop-question","category");
	vpanel_pagination();
get_footer();?>