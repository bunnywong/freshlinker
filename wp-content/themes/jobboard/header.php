<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '-', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="wrapper">
		<header id="header">
		<?php
			if( jobboard_option('enable_admin_menu') || jobboard_option('enable_social_media_url') ){
				get_template_part( 'template-parts/header', 'bar' );
			}//endif;
		?>
			<div class="container">
				<div class="row">
					<div class="col-md-3">
					<?php
						$custom_logo = jobboard_option( 'custom_header_logo' );
						$logo = '';
						if( empty($custom_logo) ){
							$logo = 'custom-logo-inactive';
						}
					?>
						<div class="logo-wrapper <?php echo esc_attr( $logo ) ?>">
							<a href="<?php echo esc_url( home_url() ); ?>" class="header-logo" title="<?php echo esc_attr( get_bloginfo('name') ); ?>">
						<?php
							if($custom_logo){
								echo '<img src="'.esc_url( $custom_logo ).'" alt="'.esc_attr( get_bloginfo('name') ).'" /></a>';
							}else{
								echo '<h1 class="site-name">'.get_bloginfo('name').'</h1>';
								echo '<span class="site-description">'.get_bloginfo('description').'</span>';
							}
						?>
							</a>
						</div><!-- /.logo-wrapper -->
					</div><!-- /.col-md-3 -->
					<div class="col-md-9">
						<div id="menu-wrapper">
							<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#main-menu">
    							<span class="sr-only"><?php _e( 'Toggle navigation', 'jobboard' ); ?></span>
    							<span class="icon-bar"></span>
    							<span class="icon-bar"></span>
    							<span class="icon-bar"></span>
    						</button>
    						<nav id="main-menu" class="clearfix collapse navbar-collapse" role="navigation">
    						<?php
    							$menu_args = array(
    								'theme_location' => 'primary_menu',
    								'container' => false,
    								'menu_class' => 'nav-menu',
    								'fallback_cb' => '__return_false',
    							);
    							wp_nav_menu($menu_args);
    						?>
    						</nav><!-- /#main-menu -->
						</div><!-- /#menu-wrapper -->
					</div><!-- /.col-md-9 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</header><!-- /#header -->
