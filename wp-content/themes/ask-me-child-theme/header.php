<?php ob_start();?>
<!DOCTYPE html>
<!--[if lt IE 7]>     <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>        <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>        <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=9">
<title><?php
	global $page, $paged;
	wp_title('|', true, 'right');
	bloginfo('name');
	$site_description = get_bloginfo('description', 'display');
	if ($site_description && ( is_home() || is_front_page() ))
	echo " | $site_description";
	if ($paged >= 2 || $page >= 2)
	echo ' | ' . sprintf(__('Page %s','vbegy'), max($paged, $page));?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link type="image/x-icon" rel="shortcut icon" href="favicon16.png">
<?php wp_head();?>
</head>





<?php
$site_users_only = vpanel_options("site_users_only");
if ($site_users_only != 1) {
	$site_users_only = "no";
}else {
	$site_users_only = (!is_user_logged_in()?"yes":"no");
}

$vbegy_layout = "";
if (is_single() || is_page()) {
	$vbegy_layout = rwmb_meta('vbegy_layout','radio',$post->ID);
	$vbegy_layout = ($vbegy_layout != ""?$vbegy_layout:"default");
}

$cat_layout = "";
if (is_category()) {
	$category_id = get_query_var('cat');
	$categories = get_option("categories_$category_id");
	$cat_layout = (isset($categories["cat_layout"])?$categories["cat_layout"]:"default");
}else if (is_tax("product_cat")) {
	$tax_id = get_term_by('slug',get_query_var('term'),"product_cat");
	$tax_id = $tax_id->term_id;
	$categories = get_option("categories_$tax_id");
	$cat_layout = (isset($categories["cat_layout"])?$categories["cat_layout"]:"default");
	if ($cat_layout == "" || $cat_layout == "default") {
		$cat_layout = vpanel_options("products_layout");
	}
}else if (is_tax("product_tag") || is_post_type_archive("product")) {
	$products_layout = vpanel_options("products_layout");
}else if (is_tax("question-category")) {
	$tax_id = get_term_by('slug',get_query_var('term'),"question-category");
	$tax_id = $tax_id->term_id;
	$categories = get_option("categories_$tax_id");
	$cat_layout = (isset($categories["cat_layout"])?$categories["cat_layout"]:"default");
	if ($cat_layout == "default") {
		$cat_layout = vpanel_options("questions_layout");
	}
}else if (is_tax("question_tags") || is_post_type_archive("question")) {
	$questions_layout = vpanel_options("questions_layout");
}else if (is_single() || is_page()) {
	if (is_singular("product") && ($vbegy_layout == "" || $vbegy_layout == "default")) {
		$vbegy_layout = vpanel_options("products_layout");
	}
	if (is_singular("question") && ($vbegy_layout == "" || $vbegy_layout == "default")) {
		$vbegy_layout = vpanel_options("questions_layout");
	}
	if ($vbegy_layout == "" || $vbegy_layout == "default") {
		$vbegy_layout = vpanel_options("home_layout");
	}
}
$home_layout = vpanel_options("home_layout");
$top_panel_skin = vpanel_options("top_panel_skin");
$header_skin = vpanel_options("header_skin");
$header_fixed = vpanel_options("header_fixed");
$author_layout = vpanel_options("author_layout");
if (is_author() && $author_layout != "default" && $author_layout != "") {
	$home_layout = $author_layout;
}
if (is_singular("question")) {
	$questions_layout = vpanel_options("questions_layout");
}
if (is_singular("product")) {
	$products_layout = vpanel_options("products_layout");
}

$boxed_1 = "boxed";
$boxed_2 = "boxed2";
$boxed_end = "";
if (is_category() && $cat_layout != "default" && $cat_layout != "") {
	if ($cat_layout == "fixed") {
		$boxed_end = $boxed_1;
	}else if ($cat_layout == "fixed_2") {
		$boxed_end = $boxed_2;
	}
}else if (is_tax("question-category") && $cat_layout != "default" && $cat_layout != "") {
	if ($cat_layout == "fixed") {
		$boxed_end = $boxed_1." ";
	}else if ($cat_layout == "fixed_2") {
		$boxed_end = $boxed_2." ";
	}
}else if (is_tax("question_tags") && $questions_layout != "default" && $questions_layout != "") {
	if ($questions_layout == "fixed") {
		$boxed_end = $boxed_1." ";
	}else if ($questions_layout == "fixed_2") {
		$boxed_end = $boxed_2." ";
	}
}else if (is_post_type_archive("question") && $questions_layout != "default" && $questions_layout != "") {
	if ($questions_layout == "fixed") {
		$boxed_end = $boxed_1." ";
	}else if ($questions_layout == "fixed_2") {
		$boxed_end = $boxed_2." ";
	}
}else if (is_tax("product_cat") && $cat_layout != "default" && $cat_layout != "") {
	if ($cat_layout == "fixed") {
		$boxed_end = $boxed_1." ";
	}else if ($cat_layout == "fixed_2") {
		$boxed_end = $boxed_2." ";
	}
}else if (is_tax("product_tag") && $products_layout != "default" && $products_layout != "") {
	if ($products_layout == "fixed") {
		$boxed_end = $boxed_1." ";
	}else if ($products_layout == "fixed_2") {
		$boxed_end = $boxed_2." ";
	}
}else if ((is_post_type_archive("product")) && $products_layout != "default" && $products_layout != "") {
	if ($products_layout == "fixed") {
		$boxed_end = $boxed_1." ";
	}else if ($products_layout == "fixed_2") {
		$boxed_end = $boxed_2." ";
	}
}else {
	if ((is_single() || is_page()) && $vbegy_layout != "default" && $vbegy_layout != "") {
		if ($vbegy_layout == "fixed") {
			$boxed_end = $boxed_1;
		}else if ($vbegy_layout == "fixed_2") {
			$boxed_end = $boxed_2;
		}else if ($vbegy_layout == "full") {
			$boxed_end = "";
		}
	}else {
		if (is_singular("product") && $products_layout != "default" && $products_layout != "") {
			if ($products_layout == "fixed") {
				$boxed_end = $boxed_1;
			}else if ($products_layout == "fixed_2") {
				$boxed_end = $boxed_2;
			}else if ($products_layout == "full") {
				$boxed_end = "";
			}
		}else if (is_singular("question") && $questions_layout != "default" && $questions_layout != "") {
			if ($questions_layout == "fixed") {
				$boxed_end = $boxed_1;
			}else if ($questions_layout == "fixed_2") {
				$boxed_end = $boxed_2;
			}else if ($questions_layout == "full") {
				$boxed_end = "";
			}
		}else {
			if ($home_layout == "fixed") {
				$boxed_end = $boxed_1;
			}else if ($home_layout == "fixed_2") {
				$boxed_end = $boxed_2;
			}else if ($home_layout == "full") {
				$boxed_end = "";
			}
		}
	}
}
?>
<body <?php echo (isset($boxed_end) && $boxed_end != ""?"id='body_".$boxed_end."'":"")?> <?php body_class();?>>
	<div class="background-cover"></div>
	<?php
	$loader_option = vpanel_options("loader");
	if ($loader_option == 1) {?>
		<div class="loader"><div class="loader_html"></div></div>
	<?php }
	
	if (!is_user_logged_in()) {
		if (isset($_POST["form_type"]) && ($_POST["form_type"] == "ask-signup" || $_POST["form_type"] == "ask-login" || $_POST["form_type"] == "ask-forget")) {?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					jQuery(".panel-pop").animate({"top":"-100%"},10).hide();
					<?php if ($_POST["form_type"] == "ask-signup") {?>
						jQuery("#signup").show().animate({"top":"2%"},500);
					<?php }else if ($_POST["form_type"] == "ask-login") {?>
						jQuery("#login-comments").show().animate({"top":"2%"},500);
					<?php }else if ($_POST["form_type"] == "ask-forget") {?>
						jQuery("#lost-password").show().animate({"top":"2%"},500);
					<?php }?>
					jQuery("html,body").animate({scrollTop:0},500);
					jQuery("body").prepend("<div class='wrap-pop'></div>");
					wrap_pop();
				});
			</script>
		<?php }?>
		<div class="panel-pop" id="signup">
			<h2><?php _e("Register Now","vbegy");?><i class="icon-remove"></i></h2>
			<div class="form-style form-style-3">
				<?php echo do_shortcode("[ask_signup]");?>
			</div>
		</div><!-- End signup -->
		
		<div class="panel-pop" id="login-comments">
			<h2><?php _e("Login","vbegy");?><i class="icon-remove"></i></h2>
			<div class="form-style form-style-3">
				<?php echo do_shortcode("[ask_login]");?>
			</div>
		</div><!-- End login-comments -->
		
		<div class="panel-pop" id="lost-password">
			<h2><?php _e("Lost Password","vbegy");?><i class="icon-remove"></i></h2>
			<div class="form-style form-style-3">
				<p><?php _e("Lost your password? Please enter your username and email address. You will receive a link to create a new password via email.","vbegy");?></p>
				<?php echo do_shortcode("[ask_lost_pass]");?>
				<div class="clearfix"></div>
			</div>
		</div><!-- End lost-password -->
	<?php }
	
	if (is_tax("question_tags")) {
		$grid_template_q = vpanel_options("questions_template");
		$grid_template_q = ($grid_template_q != ""?$grid_template_q:"default");
	}
	if (is_author()) {
		$grid_template_a = vpanel_options("author_template");
		$grid_template = $grid_template_a;
	}else if (is_category()) {
		$grid_template_c = (isset($categories["cat_template"])?$categories["cat_template"]:"default");
		$grid_template = $grid_template_c;
	}else if (is_tax("question-category")) {
		$grid_template_c = (isset($categories["cat_template"])?$categories["cat_template"]:"default");
		$grid_template = $grid_template_c;
		if ($grid_template == "default") {
			$grid_template_c = vpanel_options("questions_template");
			$grid_template = $grid_template_c;
		}
	}else if (is_tax("question_tags") || is_post_type_archive("question")) {
		$grid_template = vpanel_options("questions_template");
		$grid_template = ($grid_template != ""?$grid_template:"default");
	}else if (is_tax("product_cat")) {
		$grid_template_c = (isset($categories["cat_template"])?$categories["cat_template"]:"default");
		$grid_template = $grid_template_c;
		if ($grid_template == "" || $grid_template == "default") {
			$grid_template_c = vpanel_options("products_template");
			$grid_template = $grid_template_c;
		}
	}else if (is_tax("product_tag") || is_post_type_archive("product")) {
		$grid_template = vpanel_options("products_template");
		$grid_template = ($grid_template != ""?$grid_template:"default");
	}else {
		if (is_single() || is_page()) {
			$grid_template_s = rwmb_meta('vbegy_home_template','radio',$post->ID);
			if (is_singular("question")) {
				$grid_template_q = vpanel_options("questions_template");
				$grid_template_q = ($grid_template_q != ""?$grid_template_q:"default");
			}
			if (is_singular("product")) {
				$grid_template_p = vpanel_options("products_template");
				$grid_template_p = ($grid_template_p != ""?$grid_template_p:"default");
			}
		}
		if ((is_single() || is_page()) && ($grid_template_s != "default" && $grid_template_s != "")) {
			$grid_template = $grid_template_s;
		}else {
			if ((is_singular("question") && $grid_template_q != "default" && $grid_template_q != "")) {
				$grid_template = $grid_template_q;
			}else if ((is_singular("product") && $grid_template_p != "default" && $grid_template_p != "")) {
				$grid_template = $grid_template_p;
			}else {
				$grid_template = vpanel_options("home_template");
			}
		}
	}
	
	if ((is_author() && $grid_template_a == "default") || ((is_single() || is_page()) && $grid_template == "default") || (is_category() && $grid_template_c == "default") || (is_tax("product_cat") && ($grid_template_c == "" || $grid_template_c == "default")) || (is_tax("product_tag") && ($grid_template == "" || $grid_template == "default")) || ((is_post_type_archive("product")) && ($grid_template == "" || $grid_template == "default")) || (is_tax("question-category") && ($grid_template_c == "" || $grid_template_c == "default")) || (is_tax("question_tags") && ($grid_template == "" || $grid_template == "default")) || ((is_post_type_archive("question")) && ($grid_template == "" || $grid_template == "default"))) {
		$grid_template = vpanel_options("home_template");
	}
	
	$nicescroll = vpanel_options("nicescroll");?>
	<div id="wrap" class="<?php echo $grid_template." ";if ($header_fixed == 1) {echo "fixed-enabled ";}echo $boxed_end;if ($nicescroll == 1) {echo " wrap-nicescroll";}?>">
		
		<?php $login_panel = vpanel_options("login_panel");
		$top_menu = vpanel_options("top_menu");
		if ($login_panel == 1 && $top_menu == 1) {?>
			<div class="login-panel <?php if ($top_panel_skin == "panel_light") {echo "panel_light";}else {echo "panel_dark";}?>">
				<section class="container">
					<div class="row">
						<?php if (is_user_logged_in()) {?>
							<div class="col-md-12">
								<div class="page-content">
									<?php echo is_user_logged_in_data()?>
								</div><!-- End page-content -->
							</div><!-- End col-md-12 -->
						<?php }else {?>
							<div class="col-md-6">
								<div class="page-content">
									<h2><?php _e("Login","vbegy")?></h2>
									<div class="form-style form-style-3">
										<?php echo do_shortcode("[ask_login]");?>
									</div>
								</div><!-- End page-content -->
							</div><!-- End col-md-6 -->
							<div class="col-md-6">
								<div class="page-content Register">
									<h2><?php _e("Register Now","vbegy")?></h2>
									<p><?php echo vpanel_options("register_content")?></p>
									<a class="button color small signup"><?php _e("Create an account","vbegy")?></a>
								</div><!-- End page-content -->
							</div><!-- End col-md-6 -->
						<?php }?>
					</div>
				</section>
			</div><!-- End login-panel -->
		<?php }
		
		if ($top_menu) {?>
			<div id="header-top">
				<section class="container clearfix">
					<div class="row">
						<div class="col-md-6">
						
						
							<?php }
							
							$header_search = vpanel_options("header_search");
							if ($header_search == 1) {?>
								<div class="header-search">
									<form method="get" action="<?php echo home_url('/'); ?>">
									    <input id="form_control" type="text" value="<?php if (get_search_query() != "") {echo the_search_query();}else {_e("Search here ...","vbegy");}?>" onfocus="if(this.value=='<?php _e("Search here ...","vbegy");?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e("Search here ...","vbegy");?>';" name="s">
									    <button type="submit" class="search-submit"></button>
									</form>
								</div>
							<?php }
							
							$header_cart = vpanel_options("header_cart");
							if (class_exists('woocommerce') && $header_cart == 1) {
								echo "<div class='cart-wrapper'>";
									global $woocommerce;
									$cart_url = $woocommerce->cart->get_cart_url();
									$num = $woocommerce->cart->cart_contents_count;
									echo '<a href="'.$cart_url.'" class="cart_control nav-button nav-cart"><i class="enotype-icon-cart"></i>';
										echo '<span class="numofitems" data-num="'.$num.'">'.$num.'</span>';
									echo '</a>';
									echo '<div class="cart_wrapper'.(sizeof($woocommerce->cart->get_cart()) < 1?" cart_wrapper_empty":"").'"><div class="widget_shopping_cart_content"></div></div>';
								echo "</div>";
							}?>
							
							<div class="clearfix"></div>
						</div><!-- End col-md-6 -->
						<div class="col-md-6">
                       
                           <nav class="header-top-nav">
								<?php 
								if (is_user_logged_in()) {
									wp_nav_menu(array('container_class' => 'header-top','menu_class' => '','theme_location' => 'top_bar_login','fallback_cb' => 'vpanel_nav_fallback'));
								}else {
									wp_nav_menu(array('container_class' => 'header-top','menu_class' => '','theme_location' => 'top_bar','fallback_cb' => 'vpanel_nav_fallback'));
								}?>
							</nav>
                        
                        	<?php do_action('icl_language_selector'); ?>
                        
							<?php $social_icon_h = vpanel_options("social_icon_h");
							if ($social_icon_h == 1) {
								$twitter_icon_f = vpanel_options("twitter_icon_f");
								$facebook_icon_f = vpanel_options("facebook_icon_f");
								$gplus_icon_f = vpanel_options("gplus_icon_f");
								$youtube_icon_f = vpanel_options("youtube_icon_f");
								$skype_icon_f = vpanel_options("skype_icon_f");
								$flickr_icon_f = vpanel_options("flickr_icon_f");
								$linkedin_icon_f = vpanel_options("linkedin_icon_f");
								$rss_icon_f = vpanel_options("rss_icon_f");
								?>
								<div class="social_icons f_right">
									<ul>
										<?php
										
										if ($facebook_icon_f) {?>
											<li class="facebook"><a target="_blank" original-title="<?php _e("Facebook","vbegy")?>" class="tooltip-s" href="<?php echo $facebook_icon_f?>"><i class="social_icon-facebook font17"></i></a></li>
										
										<?php }
										
										 if ($twitter_icon_f) {?>
										<li class="twitter"><a target="_blank" original-title="<?php _e("Twitter","vbegy")?>" class="tooltip-s" href="<?php echo $twitter_icon_f?>"><i class="social_icon-twitter font17"></i></a></li>
										<?php }
										
										if ($gplus_icon_f) {?>
											<li class="gplus"><a target="_blank" original-title="<?php _e("Google plus","vbegy")?>" class="tooltip-s" href="<?php echo $gplus_icon_f?>"><i class="social_icon-gplus font17"></i></a></li>
										<?php }
										if ($youtube_icon_f) {?>
											<li class="youtube"><a target="_blank" original-title="<?php _e("Youtube","vbegy")?>" class="tooltip-s" href="<?php echo $youtube_icon_f?>"><i class="social_icon-youtube font17"></i></a></li>
										<?php }
										if ($skype_icon_f) {?>
											<li class="skype"><a target="_blank" original-title="<?php _e("Skype","vbegy")?>" class="tooltip-s" href="skype:<?php echo $skype_icon_f?>?call"><i class="social_icon-skype font17"></i></a></li>
										<?php }
										if ($flickr_icon_f) {?>
											<li class="flickr"><a target="_blank" original-title="<?php _e("Flickr","vbegy")?>" class="tooltip-s" href="<?php echo $flickr_icon_f?>"><i class="social_icon-flickr font17"></i></a></li>
										<?php }
										if ($linkedin_icon_f) {?>
											<li class="linkedin"><a target="_blank" original-title="<?php _e("Linkedin","vbegy")?>" class="tooltip-s" href="<?php echo $linkedin_icon_f?>"><i class="social_icon-linkedin font17"></i></a></li>
										<?php }
										if ($rss_icon_f == 1) {?>
											<li class="rss"><a original-title="<?php _e("Rss","vbegy")?>" class="tooltip-s" href="<?php echo (vpanel_options("rss_icon_f_other") != ""?vpanel_options("rss_icon_f_other"):bloginfo('rss2_url'));?>"><i class="social_icon-rss font17"></i></a></li>
										<?php }?>
									</ul>
								</div><!-- End social_icons -->
							
							<div class="clearfix"></div>

							
						<div class="clearfix"></div>
						</div><!-- End col-md-6 -->
					</div><!-- End row -->
				</section><!-- End container -->
			</div><!-- End header-top -->

		<div class="amads-home-widget" style="text-align:center;background:#fff;padding:10px 0; display:none;">
	
	<a title="mysite" target="_blank" href="http://www.aviroy.com/">
	<img alt="mysite" src="http://freshlinker-ask-a-question.wphostify.com/wp-content/uploads/2015/05/unnamed3.png">
	</a>
	
	</div>

		<?php }
		
		if (is_page_template("template-home.php")) {
			$index_top_box = rwmb_meta('vbegy_index_top_box','checkbox',$post->ID);
		}else {
			$index_top_box = vpanel_options('index_top_box');
		}
		$breadcrumbs = vpanel_options("breadcrumbs");
		$logo_position = vpanel_options("logo_position");
		$logo_display = vpanel_options("logo_display");
		$logo_img = vpanel_options("logo_img");
		$retina_logo = vpanel_options("retina_logo");
		
		if (is_tax("product_cat") || is_tax("product_tag") || is_post_type_archive("product") || is_singular("product")) {
			$products_custom_header = vpanel_options("products_custom_header");
			if ($products_custom_header == 1) {
				$logo_position = vpanel_options("products_logo_position");
				$header_skin = vpanel_options("products_header_skin");
				$logo_display = vpanel_options("products_logo_display");
				$logo_img = vpanel_options("products_logo_img");
				$retina_logo = vpanel_options("products_retina_logo");
			}
		}else if (is_tax("question-category") || is_tax("question_tags") || is_post_type_archive("question") || is_singular("question")) {
			$questions_custom_header = vpanel_options("questions_custom_header");
			if ($questions_custom_header == 1) {
				$logo_position = vpanel_options("questions_logo_position");
				$header_skin = vpanel_options("questions_header_skin");
				$logo_display = vpanel_options("questions_logo_display");
				$logo_img = vpanel_options("questions_logo_img");
				$retina_logo = vpanel_options("questions_retina_logo");
			}
		}
		?>
		<header id="header" class='<?php if ($header_skin == "header_light") {echo "header_light ";}
		if (is_front_page() || is_home()) {
			if ($index_top_box != 1) {
				echo "index-no-box ";
			}
		}else {
			if ($breadcrumbs != 1) {
				echo "index-no-box ";
			}
		}
		if ($logo_position == "right_logo") {echo "header_2 ";}else if ($logo_position == "center_logo") {echo "header_3 ";}?>'>
			<section class="container clearfix">
				<div class="logo">
					<?php
					if ($logo_display == "custom_image") {?>
					    <a class="logo-img" href="http://www.freshlinker.com/" itemprop="url" title="<?php echo esc_attr(get_bloginfo('name','display'))?>">
					    	<?php if (isset($logo_img) && $logo_img != "") {?>
					    		<img style="  margin-top: -15px; " class="default_logo" itemprop="logo" alt="" src="<?php echo $logo_img?>">
                              
					    	<?php }
					    	if (isset($retina_logo) && $retina_logo != "") {?>
					    		<img style="  margin-top: -15px; " class="retina_logo" itemprop="logo" alt="" src="<?php echo $retina_logo?>">
                                 
					    	<?php }?>
					    </a> <br> <span  style="  margin-top: -60px; display: block; "><?php bloginfo('description'); ?>  </span>
					<?php }else {?>
						<h2><a href="<?php echo esc_url(home_url('/'));?>" itemprop="url" title="<?php echo esc_attr(get_bloginfo('name','display'))?>"><?php bloginfo('name');?></a></h2>
					<?php }?>
					<meta  itemprop="name" content="<?php bloginfo('name'); ?>">
				</div>
				<nav class="navigation">
					<?php wp_nav_menu(array('container_class' => 'header-menu','menu_class' => '','theme_location' => 'header_menu','fallback_cb' => 'vpanel_nav_fallback'));?>
				</nav>
			</section><!-- End container -->
		</header><!-- End header -->
		
		<?php if ($site_users_only != "yes") {
			if (is_page_template("template-home.php") || is_front_page()) {
				if (is_page_template("template-home.php")) {
					$index_top_box_layout = rwmb_meta('vbegy_index_top_box_layout','radio',$post->ID);
					$index_about = rwmb_meta('vbegy_index_about','text',$post->ID);
					$index_about_h = rwmb_meta('vbegy_index_about_h','text',$post->ID);
					$index_join = rwmb_meta('vbegy_index_join','text',$post->ID);
					$index_join_h = rwmb_meta('vbegy_index_join_h','text',$post->ID);
					$index_about_login = rwmb_meta('vbegy_index_about_login','text',$post->ID);
					$index_about_h_login = rwmb_meta('vbegy_index_about_h_login','text',$post->ID);
					$index_join_login = rwmb_meta('vbegy_index_join_login','text',$post->ID);
					$index_join_h_login = rwmb_meta('vbegy_index_join_h_login','text',$post->ID);
					$index_title = rwmb_meta('vbegy_index_title','text',$post->ID);
					$index_content = rwmb_meta('vbegy_index_content','textarea',$post->ID);
					$index_top_box_background = rwmb_meta('vbegy_index_top_box_background','radio',$post->ID);
					$upload_images_home = rwmb_meta('vbegy_upload_images_home','image_advanced',$post->ID);
					$background_color_home = rwmb_meta('vbegy_background_color_home','color',$post->ID);
					$background_img_home = rwmb_meta('vbegy_background_img_home','upload',$post->ID);
					$background_repeat_home = rwmb_meta('vbegy_background_repeat_home','select',$post->ID);
					$background_fixed_home = rwmb_meta('vbegy_background_fixed_home','select',$post->ID);
					$background_position_x_home = rwmb_meta('vbegy_background_position_x_home','select',$post->ID);
					$background_position_y_home = rwmb_meta('vbegy_background_position_y_home','select',$post->ID);
					$background_full_home = rwmb_meta('vbegy_background_full_home','checkbox',$post->ID);
					$background_color_home = (isset($background_color_home) && $background_color_home != ""?"background-color:".$background_color_home.";":"");
					$background_img_home = (isset($background_img_home) && $background_img_home != ""?"background-image:url(".$background_img_home.");":"");
					$background_repeat_home = (isset($background_repeat_home) && $background_repeat_home != ""?"background-repeat:".$background_repeat_home.";":"");
					$background_fixed_home = (isset($background_fixed_home) && $background_fixed_home != ""?"background-attachment:".$background_fixed_home.";":"");
					$background_position_x_home = (isset($background_position_x_home) && $background_position_x_home != ""?"background-position-x:".$background_position_x_home.";":"");
					$background_position_y_home = (isset($background_position_y_home) && $background_position_y_home != ""?"background-position-y:".$background_position_y_home.";":"");
					$background_full_home = ($background_full_home == 1?"-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;":"");
					if ($index_top_box_background == "background") {
						$index_top_box_style = "style='".$background_color_home.$background_img_home.$background_repeat_home.$background_fixed_home.$background_position_x_home.$background_position_y_home.$background_full_home."'";
					}else {
						$index_top_box_style = "";
					}
					$remove_index_content = rwmb_meta('vbegy_remove_index_content','checkbox',$post->ID);
				}else {
					$index_top_box_layout = vpanel_options('index_top_box_layout');
					$index_about = vpanel_options('index_about');
					$index_about_h = vpanel_options('index_about_h');
					$index_join = vpanel_options('index_join');
					$index_join_h = vpanel_options('index_join_h');
					$index_about_login = vpanel_options('index_about_login');
					$index_about_h_login = vpanel_options('index_about_h_login');
					$index_join_login = vpanel_options('index_join_login');
					$index_join_h_login = vpanel_options('index_join_h_login');
					$index_title = vpanel_options("index_title");
					$index_content = vpanel_options("index_content");
					$index_top_box_style = "";
					$index_top_box_background = "";
					$remove_index_content = "";
				}
				$ask_a_new_question = __("Ask any question and you be sure find your answer ?","vbegy");
				if ($index_top_box == 1) {?>
					<div class="section-warp ask-me<?php echo (isset($remove_index_content) && $remove_index_content == 1?" remove-index-content":"")?>"<?php echo $index_top_box_style?>>
						<?php
						if ($index_top_box_background == "slideshow") {
							$result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key = 'vbegy_upload_images_home' AND post_id = {$post->ID}");?>
							<div class="flexslider blog_silder margin_b_20 post-img">
							    <ul class="slides">
							    	<?php
							    	foreach ($result as $results) {
							    	    $slideshow_imgs = $results->meta_value.',';
							    	    $slideshow_imgs = explode(",",$slideshow_imgs);
							    	    $images = $wpdb->get_col("
							    	    SELECT ID FROM $wpdb->posts
							    	    WHERE post_type = 'attachment'
							    	    AND ID IN ('".implode("','",$slideshow_imgs)."')
							    	    ORDER BY menu_order ASC");
							    	    foreach ($images as $att) {
							    	    $src = wp_get_attachment_image_src($att,'full');
							    	    $src = $src[0];?>
							    	    <li><img alt="" src="<?php echo $src;?>"></li>
							    	<?php
							    	    }
							    	}?>
							    </ul>
							</div><!-- End flexslider -->
							<?php
						}?>
						<div class="container clearfix">
							<div class="box_icon box_warp box_no_border box_no_background">
								<div class="row">
									<?php if ($remove_index_content != 1) {
										if ($index_top_box_layout == 2) {?>
											<div class="col-md-12">
												<h2><?php echo $index_title;?></h2>
												<p><?php echo $index_content;?></p>
												<div class="clearfix"></div>
												<?php if (is_user_logged_in()) {
													if ($index_about_login != "") {?>
														<a class="color button dark_button medium" href="<?php echo $index_about_h_login?>"><?php echo $index_about_login?></a>
													<?php }
													if ($index_join_login != "") {?>
														<a class="color button dark_button medium join-button" href="<?php echo $index_join_h_login?>"><?php echo $index_join_login?></a>
													<?php }
												}else {
													if ($index_about != "") {?>
														<a class="color button dark_button medium" href="<?php echo $index_about_h?>"><?php echo $index_about?></a>
													<?php }
													if ($index_join != "") {?>
														<a class="color button dark_button medium join-button fwefew" href="<?php echo $index_join_h?>"><?php echo $index_join?></a>
													<?php }
												}?>
                                                
                                                
                                                <script>
												
												jQuery(".join-button").click(function () {
													jQuery(".panel-pop").animate({"top":"-100%"},10).hide();
													jQuery("#signup").show().animate({"top":"2%"},500);
													jQuery("html,body").animate({scrollTop:0},500);
													jQuery("body").prepend("<div class='wrap-pop'></div>");
													wrap_pop();
													return false;
												});

												
												</script>
                                                
												<div class="clearfix"></div>
												<form class="form-style form-style-2">
													<p>
														<input type="text" id="question_title" value="<?php echo $ask_a_new_question;?>" onfocus="if(this.value=='<?php echo $ask_a_new_question;?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo $ask_a_new_question;?>';">
														<i class="icon-pencil"></i>
														<span class="color button small publish-question"><?php _e("Ask Now","vbegy");?></span>
													</p>
												</form>
											</div>
										<?php }else {?>
											<div class="col-md-3">
												<h2><?php echo $index_title;?></h2>
												<p><?php echo $index_content;?></p>
												<div class="clearfix"></div>
												<?php if (is_user_logged_in()) {
													if ($index_about_login != "") {?>
														<a class="color button dark_button medium" href="<?php echo $index_about_h_login?>"><?php echo $index_about_login?></a>
													<?php }
													if ($index_join_login != "") {?>
														<a class="color button dark_button medium join-button" href="<?php echo $index_join_h_login?>"><?php echo $index_join_login?></a>
													<?php }
												}else {
													if ($index_about != "") {?>
														<a class="color button dark_button medium" href="<?php echo $index_about_h?>"><?php echo $index_about?></a>
													<?php }
													if ($index_join != "") {?>
														<a class="color button dark_button medium join-button" href="<?php echo $index_join_h?>"><?php echo $index_join?></a>
													<?php }
												}?>
											</div>
											<div class="col-md-9">
												<form class="form-style form-style-2">
													<p>
														<textarea rows="4" id="question_title" onfocus="if(this.value=='<?php echo $ask_a_new_question;?>')this.value='';" onblur="if(this.value=='')this.value='<?php echo $ask_a_new_question;?>';"><?php echo $ask_a_new_question;?></textarea>
														<i class="icon-pencil"></i>
														<span class="color button small publish-question"><?php _e("Ask Now","vbegy");?></span>
													</p>
												</form>
											</div>
										<?php }
									}?>
								</div><!-- End row -->
							</div><!-- End box_icon -->
						</div><!-- End container -->
					</div><!-- End section-warp -->
				<?php
				}
			}else {
				if ($breadcrumbs == 1) {
					breadcrumbs();
				}
			}
		}// End if site_users_only
		
		$cat_sidebar_layout = "";
		$sidebar_width = vpanel_options("sidebar_width");
		$sidebar_width = (isset($sidebar_width) && $sidebar_width != ""?$sidebar_width:"col-md-3");
		if (isset($sidebar_width) && $sidebar_width == "col-md-3") {
			$container_span = "col-md-9";
		}else {
			$container_span = "col-md-8";
		}
		$full_span = "col-md-12";
		
		if (is_single() || is_page()) {
			$sidebar_post = rwmb_meta('vbegy_sidebar','radio',$post->ID);
			$sidebar_dir = '';
			if (isset($sidebar_post) && $sidebar_post != "default" && $sidebar_post != "") {
				if ($sidebar_post == 'left') {
					$sidebar_dir = 'page-left-sidebar';
					$homepage_content_span = $container_span;
				}elseif ($sidebar_post == 'full') {
					$sidebar_dir = 'page-full-width';
					$homepage_content_span = $full_span;
				}else {
					$sidebar_dir = 'page-right-sidebar';
					$homepage_content_span = $container_span;
				}
			}else {
				if (is_singular("question")) {
					$sidebar_layout_q = vpanel_options('questions_sidebar_layout');
					if ($sidebar_layout_q == 'left') {
						$sidebar_dir = 'page-left-sidebar';
						$homepage_content_span = $container_span;
					}elseif ($sidebar_layout_q == 'full') {
						$sidebar_dir = 'page-full-width';
						$homepage_content_span = $full_span;
					}else {
						$sidebar_dir = 'page-right-sidebar';
						$homepage_content_span = $container_span;
					}
				}else if (is_singular("product")) {
					$sidebar_layout_p = vpanel_options('products_sidebar_layout');
					if ($sidebar_layout_p == 'left') {
						$sidebar_dir = 'page-left-sidebar';
						$homepage_content_span = $container_span;
					}elseif ($sidebar_layout_p == 'full') {
						$sidebar_dir = 'page-full-width';
						$homepage_content_span = $full_span;
					}else {
						$sidebar_dir = 'page-right-sidebar';
						$homepage_content_span = $container_span;
					}
				}else {
					$sidebar_dir = 'page-right-sidebar';
					$homepage_content_span = $container_span;
				}
			}
		}else if (is_author()) {
			$sidebar_layout = vpanel_options('author_sidebar_layout');
			if ($sidebar_layout == 'left') {
				$sidebar_dir = 'page-left-sidebar';
				$homepage_content_span = $container_span;
			}elseif ($sidebar_layout == 'full') {
				$sidebar_dir = 'page-full-width';
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = 'page-right-sidebar';
				$homepage_content_span = $container_span;
			}
		}else if (is_category()) {
			$cat_sidebar_layout = (isset($categories["cat_sidebar_layout"])?$categories["cat_sidebar_layout"]:"default");
			if ($cat_sidebar_layout == 'left') {
				$sidebar_dir = 'page-left-sidebar';
				$homepage_content_span = $container_span;
			}elseif ($cat_sidebar_layout == 'full') {
				$sidebar_dir = 'page-full-width';
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = 'page-right-sidebar';
				$homepage_content_span = $container_span;
			}
		}else if (is_tax("question-category")) {
			$cat_sidebar_layout = (isset($categories["cat_sidebar_layout"])?$categories["cat_sidebar_layout"]:"default");
			if ($cat_sidebar_layout == "default") {
				$cat_sidebar_layout = vpanel_options("questions_sidebar_layout");
			}
			if ($cat_sidebar_layout == 'left') {
				$sidebar_dir = 'page-left-sidebar';
				$homepage_content_span = $container_span;
			}elseif ($cat_sidebar_layout == 'full') {
				$sidebar_dir = 'page-full-width';
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = 'page-right-sidebar';
				$homepage_content_span = $container_span;
			}
		}else if (is_tax("question_tags") || is_post_type_archive("question")) {
			$questions_sidebar_layout = vpanel_options('questions_sidebar_layout');
			if ($questions_sidebar_layout == 'left') {
				$sidebar_dir = 'page-left-sidebar';
				$homepage_content_span = $container_span;
			}elseif ($questions_sidebar_layout == 'full') {
				$sidebar_dir = 'page-full-width';
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = 'page-right-sidebar';
				$homepage_content_span = $container_span;
			}
		}else if (is_tax("product_cat")) {
			$cat_sidebar_layout = (isset($categories["cat_sidebar_layout"])?$categories["cat_sidebar_layout"]:"default");
			if ($cat_sidebar_layout == "" || $cat_sidebar_layout == "default") {
				$cat_sidebar_layout = vpanel_options("products_sidebar_layout");
			}
			if ($cat_sidebar_layout == 'left') {
				$sidebar_dir = 'page-left-sidebar';
				$homepage_content_span = $container_span;
			}elseif ($cat_sidebar_layout == 'full') {
				$sidebar_dir = 'page-full-width';
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = 'page-right-sidebar';
				$homepage_content_span = $container_span;
			}
		}else if (is_tax("product_tag") || is_post_type_archive("product")) {
			$products_sidebar_layout = vpanel_options('products_sidebar_layout');
			if ($products_sidebar_layout == 'left') {
				$sidebar_dir = 'page-left-sidebar';
				$homepage_content_span = $container_span;
			}elseif ($products_sidebar_layout == 'full') {
				$sidebar_dir = 'page-full-width';
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = 'page-right-sidebar';
				$homepage_content_span = $container_span;
			}
		}else if (is_category()) {
			$cat_sidebar_layout = (isset($categories["cat_sidebar_layout"])?$categories["cat_sidebar_layout"]:"default");
			if ($cat_sidebar_layout == 'left') {
				$sidebar_dir = 'page-left-sidebar';
				$homepage_content_span = $container_span;
			}elseif ($cat_sidebar_layout == 'full') {
				$sidebar_dir = 'page-full-width';
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = 'page-right-sidebar';
				$homepage_content_span = $container_span;
			}
		}else {
			if ((is_single() || is_page()) && $sidebar_post != "default" && $sidebar_post != "") {
				if ($sidebar_post == 'left') {
					$sidebar_dir = 'page-left-sidebar';
					$homepage_content_span = $container_span;
				}elseif ($sidebar_post == 'full') {
					$sidebar_dir = 'page-full-width';
					$homepage_content_span = $full_span;
				}else {
					$sidebar_dir = 'page-right-sidebar';
					$homepage_content_span = $container_span;
				}
			}else {
				if ((is_singular("product") && $sidebar_layout_p != "default" && $sidebar_layout_p != "")) {
					$sidebar_layout_p = vpanel_options('products_sidebar_layout');
					if ($sidebar_layout_p == 'left') {
						$sidebar_dir = 'page-left-sidebar';
						$homepage_content_span = $container_span;
					}elseif ($sidebar_layout_p == 'full') {
						$sidebar_dir = 'page-full-width';
						$homepage_content_span = $full_span;
					}else {
						$sidebar_dir = 'page-right-sidebar';
						$homepage_content_span = $container_span;
					}
				}else if ((is_singular("question") && $sidebar_layout_q != "default" && $sidebar_layout_q != "")) {
					$sidebar_layout_q = vpanel_options('questions_sidebar_layout');
					if ($sidebar_layout_q == 'left') {
						$sidebar_dir = 'page-left-sidebar';
						$homepage_content_span = $container_span;
					}elseif ($sidebar_layout_q == 'full') {
						$sidebar_dir = 'page-full-width';
						$homepage_content_span = $full_span;
					}else {
						$sidebar_dir = 'page-right-sidebar';
						$homepage_content_span = $container_span;
					}
				}else {
					$sidebar_layout = vpanel_options('sidebar_layout');
					if ($sidebar_layout == 'left') {
						$sidebar_dir = 'page-left-sidebar';
						$homepage_content_span = $container_span;
					}elseif ($sidebar_layout == 'full') {
						$sidebar_dir = 'page-full-width';
						$homepage_content_span = $full_span;
					}else {
						$sidebar_dir = 'page-right-sidebar';
						$homepage_content_span = $container_span;
					}
				}
			}
		}
		
		if ((is_author() && $sidebar_layout == "default") || (is_category() && $cat_sidebar_layout == "default") || (is_tax("question-category") && $cat_sidebar_layout == "default") || (is_tax("question_tags") && $questions_sidebar_layout == "default") || (is_post_type_archive("question") && $questions_sidebar_layout == "default") || (is_tax("product_cat") && $cat_sidebar_layout == "default") || (is_tax("product_tag") && $products_sidebar_layout == "default") || (is_post_type_archive("product") && $products_sidebar_layout == "default")) {
			$sidebar_layout = vpanel_options('sidebar_layout');
			if ($sidebar_layout == 'left') {
				$sidebar_dir = 'page-left-sidebar';
				$homepage_content_span = $container_span;
			}elseif ($sidebar_layout == 'full') {
				$sidebar_dir = 'page-full-width';
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = 'page-right-sidebar';
				$homepage_content_span = $container_span;
			}
		}
		
		if ($site_users_only != "yes") {
			if (is_single() || is_page()) {
				$vbegy_header_adv_type = rwmb_meta('vbegy_header_adv_type','radio',$post->ID);
				$vbegy_header_adv_code = rwmb_meta('vbegy_header_adv_code','textarea',$post->ID);
				$vbegy_header_adv_href = rwmb_meta('vbegy_header_adv_href','text',$post->ID);
				$vbegy_header_adv_img = rwmb_meta('vbegy_header_adv_img','upload',$post->ID);
			}
			
			if ((is_single() || is_page()) && (($vbegy_header_adv_type == "display_code" && $vbegy_header_adv_code != "") || ($vbegy_header_adv_type == "custom_image" && $vbegy_header_adv_img != ""))) {
				$header_adv_type = $vbegy_header_adv_type;
				$header_adv_code = $vbegy_header_adv_code;
				$header_adv_href = $vbegy_header_adv_href;
				$header_adv_img = $vbegy_header_adv_img;
			}else {
				$header_adv_type = vpanel_options("header_adv_type");
				$header_adv_code = vpanel_options("header_adv_code");
				$header_adv_href = vpanel_options("header_adv_href");
				$header_adv_img = vpanel_options("header_adv_img");
			}
			if (($header_adv_type == "display_code" && $header_adv_code != "") || ($header_adv_type == "custom_image" && $header_adv_img != "")) {
				echo '<div class="clearfix"></div>
				<div class="advertising">';
				if ($header_adv_type == "display_code") {
					echo stripcslashes($header_adv_code);
				}else {
					if ($header_adv_href != "") {
						echo '<a target="_blank" href="'.$header_adv_href.'">';
					}
					echo '<img alt="" src="'.$header_adv_img.'">';
					if ($header_adv_href != "") {
						echo '</a>';
					}
				}
				echo '</div><!-- End advertising -->
				<div class="clearfix"></div>';
			}
		}
		?>
		<section class="container main-content <?php echo (!is_404() && $site_users_only != "yes"?$sidebar_dir:"page-full-width");?>">
			<?php
			$question_publish = vpanel_options("question_publish");
			$post_publish = vpanel_options("post_publish");
			if ($question_publish == "draft") {
				vbegy_session();
			}
			if ($post_publish == "draft") {
				vbegy_session_post();
			}
			vbegy_session_edit();
			vbegy_session_activate();?>
			<div class="row">
				<div class="with-sidebar-container">
					<div class="<?php echo (!is_404() && $site_users_only != "yes"?$homepage_content_span:$full_span);?>">
					<?php $confirm_email = vpanel_options("confirm_email");
					if (is_user_logged_in() && $confirm_email == 1) {
						$if_user_id = get_user_by("id",get_current_user_id());
						if (isset($if_user_id->caps["activation"]) && $if_user_id->caps["activation"] == 1) {
							$get_user_a = (isset($_GET['u'])?esc_attr($_GET['u']):"");
							$get_activate = (isset($_GET['activate'])?esc_attr($_GET['activate']):"");
							if (isset($_GET['u']) && isset($_GET['activate'])) {
								$activation = get_user_meta(get_current_user_id(),"activation",true);
								if ($activation == $get_activate) {
									wp_update_user( array ('ID' => get_current_user_id(), 'role' => 'subscriber') ) ;
									delete_user_meta(get_current_user_id(),"activation");
									if(!session_id()) session_start();
									$_SESSION['vbegy_session_a'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Activate the membership","vbegy").'</span><br>'.__("Your membership is activate now .","vbegy").'</p></div>';
									wp_safe_redirect(esc_url(home_url('/')));
								}else {
									echo '<div class="alert-message error"><i class="icon-ok"></i><p><span>'.sprintf(__("Activate the membership","vbegy").'</span><br>'.__("Please activate your membership, Click on the link has been sent to email <a href='%s'>Click here</a> to send it again .","vbegy"),add_query_arg(array("get_activate" => "do"),esc_url(home_url('/')))).'</p></div>';
								}
							}else if (!isset($_GET['u']) && !isset($_GET['activate']) && !isset($_SESSION['vbegy_session_a'])) {
								if (isset($_GET['get_activate']) && $_GET['get_activate'] == "do") {
									$user_data = get_user_by("id",get_current_user_id());
									$rand_a = rand(1,1000000000000);
									update_user_meta(get_current_user_id(),"activation",$rand_a);
									$post_mail = "
									".__("Hi there","vbegy")."<br />
									
									".__("This is the link to activate your membership","vbegy")."<br />
									
									<a href=".add_query_arg(array("u" => get_current_user_id(),"activate" => $rand_a),esc_url(home_url('/'))).">".__("Activate","vbegy")."</a><br />
									
									";
									sendEmail(get_bloginfo("admin_email"),get_bloginfo('name'),esc_html($user_data->user_email),esc_html($user_data->display_name),__("Hi there","vbegy"),$post_mail);
									$_SESSION['vbegy_session_a'] = '<div class="alert-message success"><i class="icon-ok"></i><p><span>'.__("Activate the membership","vbegy").'</span><br>'.__("Check your email again .","vbegy").'</p></div>';
									wp_safe_redirect(esc_url(home_url('/')));
								}else {
									echo '<div class="alert-message error"><i class="icon-ok"></i><p><span>'.sprintf(__("Activate the membership","vbegy").'</span><br>'.__("Please activate your membership, Click on the link has been sent to email, If you lost it <a href='%s'>Click here</a> to send it again .","vbegy"),add_query_arg(array("get_activate" => "do"),esc_url(home_url('/')))).'</p></div>';
								}
							}
							get_footer();
							die();
						}
					}
					if ($site_users_only == "yes") {?>
						<div class="login login-login<?php if (is_front_page() || is_home()) {
							if ($index_top_box != 1) {die();
								echo " index-no-box-login";
							}
						}else {
							if ($breadcrumbs != 1) {
								echo " index-no-box-login";
							}
						}?>">
							<div class="row">
								<div class="col-md-6">
									<div class="page-content">
										<h2><?php _e("Login","vbegy")?></h2>
										<div class="form-style form-style-3">
											<?php echo do_shortcode("[ask_login]");?>
										</div>
									</div><!-- End page-content -->
								</div><!-- End col-md-6 -->
								<?php if (!is_user_logged_in()) {?>
									<div class="col-md-6">
										<div class="page-content">
											<h2><?php _e("Register Now","vbegy")?></h2>
											<p><?php echo vpanel_options("register_content")?></p>
											<a class="button small color signup"><?php _e("Create an account","vbegy")?></a>
										</div><!-- End page-content -->
									</div><!-- End col-md-6 -->
								<?php }?>
							</div><!-- End row -->
						</div><!-- End login -->
						<?php get_footer();
						die();
					}