<?php

/**
 * Template Name: Login Page
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 *
 */

$error = false;
if( isset( $_GET['action'] ) && $_GET['action'] == 'logout' ){
	wp_logout();
	wp_redirect( home_url() ); exit;
}//endif;

$login_class='no-animated';
if( isset( $_POST['user_submit'] ) && isset($_POST['action']) && $_POST['action'] == 'jobboard_proccess_login_form' ){
	$cred = array(
		'user_login' => $_POST['the_user_login'],
		'user_password' => $_POST['the_user_password'],
		'remember' => false,
	);

	$user = wp_signon( $cred, false );
	if( isset($user->errors) ){
		$wp_error = $user;
		$error = true;
		$login_class = 'animated shake';
	}else{
		if( isset( $_GET['redirect'] ) ){
			wp_redirect( $_GET['redirect'] ); exit;
		}else{
			wp_redirect( get_permalink( jobboard_option( 'dashboard_page' ) ) ); exit;
		}
	}
}//endif;



// Forgot password
$not_match_password_msg = '';
if( isset( $_POST['user_submit'] ) && isset($_POST['action']) && $_POST['action'] == 'jobboard_proccess_lost_password_form' ){

	$user_name = $_POST['user_login'];
	$new_password = $_POST['pass1'];
	$new_password_repeat = $_POST['pass2'];

	if($new_password == $new_password_repeat) {

		$user = get_user_by( 'slug', $user_name );
		$user_id = $user->ID;
		$password = $new_password;
		wp_set_password( $password, $user_id );

		$email_to = $user->user_email;
		$username = $user_name;
		$login_url = get_permalink( jobboard_option( 'login' ) );
		$subject = __( 'Reset password success from : ', 'jobboard' ).get_bloginfo('name');
		$body = "Here is your new login details: \n\nUsername : ".$username." \n\nNew password : ".$new_password." \n\nLogin here : ".$login_url;
		$headers = 'From: '.get_bloginfo('name').' <'.get_bloginfo('admin_email').'>';

		$sent = wp_mail( $email_to, $subject, $body, $headers );

		wp_redirect( get_permalink( jobboard_option( 'login' ) ) . '?passwordreset="success"' ); exit;


	} else {
		$login_class = 'animated shake';
		$not_match_password_msg = __('New password missmatch. Please try again!', 'jobboard');
	}

} // endif;



if( is_user_logged_in() ){
	wp_redirect( get_permalink( jobboard_option( 'dashboard_page' ) ) ); exit;
}


get_header(); ?>

<div id="page-title-wrapper" class="login-page-wrapper">
	<div class="container">
		<h1 class="page-title">

			<?php
			if( (isset($_GET['mode']) && $_GET['mode'] == 'lost-password') || (isset($_GET['action']) && $_GET['action']=='rp') ) {

				echo __('Forgot Password', 'jobboard');

			} else {
				the_title();
			}
			?>

		</h1>


		<?php
		/** If user not logged in for resume view subscription feature **/
		if( isset($_GET['ups']) && $_GET['ups'] == 'please_login'  ){

			echo '<div id="login-error-box" class="alert alert-danger alert-dismissable" role="alert">';
			echo __('Sorry, that requested page is for member only. Please login or register. It only takes few seconds.', 'jobboard');
			echo '</div>';

		}
		?>


		<div class="row">
			<div class="col-md-5">
				<?php

				if(isset($_POST['action']) && $_POST['action'] == 'jobboard_proccess_login_form') :

				if ( $error ) {
					echo '<div id="login-error-box" class="alert alert-danger">';
					$errors = '';
					$messages = '';
					foreach ( $wp_error->get_error_codes() as $code ) {
						$error_str = '<strong>'.__( 'ERROR', 'jobboard' ).'</strong>: ';
						$lost_password_url = get_permalink( jobboard_option( 'login' ) ) . '?mode="lost-password"';
						$lost_password_str = '<a href="'.esc_url( $lost_password_url ).'" title="'.__( 'Password Lost and Found', 'jobboard' ).'"> '.__( 'Lost your password', 'jobboard' ).'</a>?<br />';

						if( $code == 'empty_password'){
							echo apply_filters( 'jobboard_empty_password_msg', $error_str.__( 'The password field is empty.', 'jobboard' ) );
						}elseif( $code == 'invalid_username' ){
							echo apply_filters( 'jobboard_invalid_username_msg', $error_str.__( 'Invalid username.', 'jobboard' ) );
						}elseif( $code == 'incorrect_password' ){
							echo apply_filters( 'jobboard_incorrect_password_msg', $error_str.__( 'The password you entered for the username <strong>'.$_POST['user_login'].'</strong> is incorrect.', 'jobboard' ).$lost_password_str );
						}

					}

					echo '</div><!-- /#login-error-box -->';
				} // $error ends

				endif;

				if($not_match_password_msg != '') :

					echo '<div id="login-error-box" class="alert alert-danger">';
					echo $not_match_password_msg;
					echo '</div> <!-- /#login-error-box -->';

				endif;


				?>


				<?php

				if( empty($error) && isset($_GET['passwordreset']) && $_GET['passwordreset'] == 'success') {

					echo '<div id="login-error-box" class="alert alert-success alert-dismissable" role="alert">';
					echo __('Your new password successfully saved! Login here', 'jobboard');
					echo '</div>';

				}

				/** Reset password message **/
				if(isset($_GET['reset']) && $_GET['reset'] == 'true') {

					echo '<div id="login-error-box" class="alert alert-success alert-dismissable" role="alert">';
					echo __('Check your e-mail for the confirmation link.', 'jobboard');
					echo '</div>';

				}


				/** Invalid/expired key message **/
				if( isset($_GET['wrong']) && $_GET['wrong'] == 'invalidkey'  ){

					echo '<div id="login-error-box" class="alert alert-danger alert-dismissable" role="alert">';
					echo __('Sorry, that key does not appear to be valid.', 'jobboard');
					echo '</div>';

				}

				if( isset($_GET['wrong']) && $_GET['wrong'] == 'expiredkey'  ){

					echo '<div id="login-error-box" class="alert alert-danger alert-dismissable" role="alert">';
					echo __('Sorry, that key has expired.', 'jobboard');
					echo '</div>';

				}


				if(isset($_GET['action']) && $_GET['action'] == 'rp' ){



					/** Validating user **/

					$login_url =  esc_url( jobboard_get_permalink( 'login' ) );

					list( $rp_path ) = explode( '?', wp_unslash( $_SERVER['REQUEST_URI'] ) );
					$rp_cookie = 'wp-resetpass-' . COOKIEHASH;
					if ( isset( $_GET['key'] ) ) {
						$value = sprintf( '%s:%s', wp_unslash( $_GET['login'] ), wp_unslash( $_GET['key'] ) );
						setcookie( $rp_cookie, $value, 0, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
						wp_safe_redirect( remove_query_arg( array( 'key', 'login' ) ) );
						exit;
					}

					if ( isset( $_COOKIE[ $rp_cookie ] ) && 0 < strpos( $_COOKIE[ $rp_cookie ], ':' ) ) {
						list( $rp_login, $rp_key ) = explode( ':', wp_unslash( $_COOKIE[ $rp_cookie ] ), 2 );
						$user = check_password_reset_key( $rp_key, $rp_login );
					} else {
						$user = false;
					}

					if ( ! $user || is_wp_error( $user ) ) {
						setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
						if ( $user && $user->get_error_code() === 'expired_key' )
							wp_redirect( $login_url .'&error=expiredkey&mode=lost-password&wrong=expiredkey' );
						else
							wp_redirect( $login_url .'&error=invalidkey&mode=lost-password&wrong=invalidkey' );
						exit;
					}

					$errors = new WP_Error();

					if ( isset($_POST['pass1']) && $_POST['pass1'] != $_POST['pass2'] )
						$errors->add( 'password_reset_mismatch', __( 'The passwords do not match.' ) );

					/**
					 * Fires before the password reset procedure is validated.
					 *
					 * @since 3.5.0
					 *
					 * @param object           $errors WP Error object.
					 * @param WP_User|WP_Error $user   WP_User object if the login and reset key match. WP_Error object otherwise.
					 */
					do_action( 'validate_password_reset', $errors, $user );

					if ( ( ! $errors->get_error_code() ) && isset( $_POST['pass1'] ) && !empty( $_POST['pass1'] ) ) {
						reset_password($user, $_POST['pass1']);
						setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
						login_header( __( 'Password Reset' ), '<p class="message reset-pass">' . __( 'Your password has been reset.' ) . ' <a href="' . esc_url( wp_login_url() ) . '">' . __( 'Log in' ) . '</a></p>' );
						login_footer();
						exit;
					}



					echo '<div id="login-error-box" class="alert alert-success alert-dismissable" role="alert">';
					echo __('Enter your password below!', 'jobboard');
					echo '</div>';

					/** Validation user ends **/


				}



				?>


				<div id="login-form-wrapper" class="<?php echo $login_class; ?>">

					<?php if( isset($_GET['mode']) && $_GET['mode'] == 'lost-password' ) { ?>


						<form name="lostpasswordform" id="login-form" action="<?php echo esc_url( network_site_url( 'wp-login.php?action=lostpassword', 'login_post' ) ); ?>" method="post">
							<div class="form-group">
								<input class="form-control" type="text" name="user_login" id="user_login" class="input" value="" placeholder="<?php _e( 'Username or Email', 'jobboard' ); ?>"/></label>
							</div>
							<?php
							/**
							 * Fires inside the lostpassword <form> tags, before the hidden fields.
							 *
							 * @since 2.1.0
							 */

							$current_url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
							$redirect_to = $current_url.'&reset=true';
							do_action( 'lostpassword_form' );

							$btn_label = __('Reset Password', 'jobboard');

							?>
							<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />


							<button type="submit" name="user_submit" id="user_submit" value="1" class="btn btn-login"><?php echo $btn_label; ?></button>


					</form>


					<?php } else if(isset($_GET['action']) && $_GET['action'] == 'rp') {


					/** Reset password form **/

					?>



					<form name="resetpassform" id="login-form" action="#" method="post" autocomplete="off">

						<input name="user_login" type="hidden" id="user_login" value="<?php echo esc_attr( $rp_login ); ?>" autocomplete="off" />

						<div class="form-group">
							<input type="password" name="pass1" id="pass1" class="form-control" value="" autocomplete="off" placeholder="<?php _e('New password', 'jobboard'); ?>" /></label>
						</div>

						<div class="form-group">
							<input type="password" name="pass2" id="pass2" class="form-control" value="" autocomplete="off" placeholder="<?php _e('Confirm new password', 'jobboard'); ?>" /></label>
						</div>

						<?php
						/**
						 * Fires following the 'Strength indicator' meter in the user password reset form.
						 *
						 * @since 3.9.0
						 *
						 * @param WP_User $user User object of the user whose password is being reset.
						 */
						do_action( 'resetpass_form', $user );

						$btn_label = __('Reset Password', 'jobboard');

						?>

						<input type="hidden" name="action" value="jobboard_proccess_lost_password_form" />


						<button type="submit" name="user_submit" id="user_submit" value="1" class="btn btn-login"><?php echo $btn_label; ?></button>


					</form>




					<?php


					/** Reset password form ends **/


					}else { ?>
					<form id="login-form" action="#" method="post">
						<div class="form-group">
							<input class="form-control" type="text" name="the_user_login" id="user_login" placeholder="<?php _e( 'Username', 'jobboard' ); ?>" required="required" />
						</div><!-- /.form-group -->
						<div class="form-group">
							<input class="form-control" type="password" name="the_user_password" id="user_password" placeholder="<?php _e( 'Password', 'jobboard' ); ?>" />
						</div><!-- /.form-group -->
						<input type="hidden" name="action" value="jobboard_proccess_login_form" />
						<?php

						$btn_label = __('Log in', 'jobboard');

						?>

						<div class="clearfix"></div>


						<button type="submit" name="user_submit" id="user_submit" value="1" class="btn btn-login"><?php echo $btn_label; ?></button>
						<a class="lost-password-link" href="<?php echo esc_url( add_query_arg( 'mode', 'lost-password', esc_url( jobboard_get_permalink( 'login' ) ) ) ) ?>"><?php echo __('Lost password?', 'jobboard'); ?></a>



					</form>

					<?php } ?>

				</div><!-- /.login-form-wrapper -->



			</div><!-- /.col-md-5 -->


			<div class="col-md-7">
				<div <?php post_class(); ?>>
					<article id="page-<?php the_ID(); ?>">
					<?php
						while( have_posts() ){
							the_post();

							the_content();

						}//endwhile;
					?>
					</article>
				</div><!-- /#content -->
			</div><!-- /.col-md-7 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /#page-title -->

<?php get_footer(); ?>
