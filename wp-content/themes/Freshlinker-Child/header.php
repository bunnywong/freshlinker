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
       <link href="favicon16.png" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Condensed">
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">

    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <?php //if(is_singular('job')):?>
    <?php
		$company_id = get_post_meta( get_the_ID(), '_jboard_job_company', true );
		$company_img = wp_get_attachment_url(get_post_thumbnail_id($company_id), 'jobboard-job-detail-company' );
		if($company_img):
	?>
        <meta property="og:image" content="<?php echo $company_img?>" />
    <?php endif;?>
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

		<div class="amads-home-widget" style="text-align:center;">
	
	<a title="mysite" target="_blank" href="http://www.aviroy.com/">
	<img alt="mysite" src="http://www.freshlinker.com/wp-content/uploads/2015/05/unnamed3.png">
	</a>
	
	</div>
			<div class="container">
				<div class="row">
					<div class="col-md-2">
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
					</div><!-- /.col-md-2 -->
					<div class="col-md-10">
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
					</div><!-- /.col-md-10 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</header><!-- /#header -->

