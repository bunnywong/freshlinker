<?php
/**
 * Template Part Name : Top Header Bar
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 *
 */
?>
<div id="header-bar">
	<div class="container">
		<ul class="jobboard-social-media">
		<?php
			$enable_social_media = jobboard_option( 'enable_social_media_url' );
			if($enable_social_media){
				$social_medias = jobboard_option( 'social_media_sorter' );
				foreach( $social_medias as $item ){
					echo '
						<li><a href="'.esc_url( jobboard_option( 'social_'.$item ) ).'"><i class="fa fa-'.esc_attr( $item ).'"></i></a></li>
					';
				}//endforeach;
			}//endif;
		?>	
		</ul><!-- /.social-media -->
		<?php
		if( jobboard_option('enable_admin_menu') ){
		?>
			<div class="jobboard-login-register clearfix">
		<?php
			if( is_user_logged_in() ){
		?>
			<div class="user_menu dropdown">
			<?php
				echo '<a data-toggle="dropdown" href="#">';
				echo get_avatar( get_current_user_id(), 35 ).'<span>'.__( 'hi, ', 'jobboard' ).esc_attr( get_userdata( get_current_user_id() )->display_name ).'</span>';
				echo '<i class="fa fa-caret-down"></i></a>';
			?>
				<div class="dropdown-menu clearfix" role="menu">
					<ul>
						<li>
							<a href="<?php echo esc_url( jobboard_get_permalink( 'dashboard' ) ); ?>"><?php _e( 'Dashboard', 'jobboard' ); ?></a>
						</li>
						<li>
							<a href="<?php echo esc_url( jobboard_get_permalink( 'profile' ) );  ?>"><?php _e( 'Profile', 'jobboard' ); ?></a>
						</li>
						<li>
						<a href="<?php echo esc_url( jobboard_get_permalink( 'logout' ) ); ?>"><?php _e( 'Log Out', 'jobboard' ); ?></a>									
						</li>
					</ul>
					<?php echo get_avatar( get_current_user_id(), 70 ); ?>
				</div>
			</div><!-- /.user_menu -->
		<?php
			}else{
		?>
			<a class="btn btn-header-register" href="<?php echo esc_url( jobboard_get_permalink( 'register' ) ); ?>"><?php _e( 'REGISTER', 'jobboard' ); ?></a>
			<a class="btn btn-header-login" href="<?php echo esc_url( jobboard_get_permalink( 'login' ) ); ?>"><?php _e( 'LOG IN', 'jobboard' ); ?></a>
		<?php
			}
		?>
		</div>
		<?php
		}//endif;
		?>
	</div><!-- /.container -->
</div><!-- /#header-bar -->