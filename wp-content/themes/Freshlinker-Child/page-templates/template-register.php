<?php
/**
 * Template Name: Register Page
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 *
 */

// $error = false;
if( isset( $_POST['user_submit'] ) ){

	$creds = array(
		'username'	=> $_POST['register_name'],
		'email'		=> $_POST['register_email'],
		'password'	=> $_POST['register_password'],
	);

	$user = wp_create_user( $creds['username'], $creds['password'], $creds['email'] );

	if( isset($user->errors) ){
		$wp_error = $user;
		$error = true;
		$login_class = 'animated shake';
	}else{
		update_user_meta( $user, 'jobboard_user_role', $_POST['register_role'] );
		// wp_redirect( get_permalink( jobboard_option( 'login' ) ) ); exit;
	}
}


if( is_user_logged_in() ){
	wp_redirect( get_permalink( jobboard_option( 'dashboard_page' ) ) ); exit;
}


get_header(); ?>

<div id="page-title-wrapper" class="register-page-wrapper">
	<div class="container">
		<h1 class="page-title"><?php the_title(); ?></h1>
		<div class="row">
			<div class="col-md-0" style="display:none;">
				<?php
				if ( $error ) {
					echo '<div id="login-error-box" class="alert alert-danger">';
					$errors = '';
					$messages = '';
					foreach ( $wp_error->get_error_codes() as $code ) {
						$severity = $wp_error->get_error_data($code);
						foreach ( $wp_error->get_error_messages($code) as $error ) {
							if ( 'message' == $severity )
								$messages .= '	' . $error . "<br />\n";
							else
								$errors .= '	' . $error . "<br />\n";
						}
					}
					if ( ! empty( $errors ) ) {
						/**
						 * Filter the error messages displayed above the login form.
						 *
						 * @since 2.1.0
						 *
						 * @param string $errors Login error message.
						 */
						echo '<div id="login_error">' . apply_filters( 'login_errors', $errors ) . "</div>\n";
					}
					if ( ! empty( $messages ) ) {
						/**
						 * Filter instructional messages displayed above the login form.
						 *
						 * @since 2.5.0
						 *
						 * @param string $messages Login messages.
						 */
						echo '<p class="message">' . apply_filters( 'login_messages', $messages ) . "</p>\n";
					}
					echo '</div><!-- /#login-error-box -->';
				}//endif;
				?>


				<?php
				if( isset( $_POST['user_submit'] ) && empty($error) ){
					jobboard_set_post_message('13');
				}
				?>
				<div id="register-form-wrapper" class="<?php echo $login_class; ?>">

					<?php
					/**
					* Show success message if registration complete
					*/

					if( isset( $_POST['user_submit'] ) ){

						if( empty($errors) ){



							/* Send email to user */

							$email_to = ( isset($_POST['register_email']) ) ? $_POST['register_email'] : '' ;
							$username = (isset($_POST['register_name'])) ? $_POST['register_name'] : '';
							$password = (isset($_POST['register_password'])) ? $_POST['register_password'] : '';
							$role = __('Undefined', 'jobboard');
							$register_role = (isset($_POST['register_role'])) ? $_POST['register_role'] : '';

							if($register_role == 'job_lister'){
								$role = __('Job Lister', 'jobboard');
							}
							if($register_role == 'job_seeker'){
								$role = __('Job Seeker', 'jobboard');
							}

							$login_url = jobboard_get_permalink( 'login' );
							$subject = __( 'Registration success from : ', 'jobboard' ).get_bloginfo('name');
							$body = "Thank you for registering to ".get_bloginfo('name')." Here is your login details: \n\nUsername : ".$username." \n\nPassword : ".$password." \n\nRole: ".$role." \n\nLogin here: ".$login_url;
							$headers = 'From: '.get_bloginfo('name').' <'.get_bloginfo('admin_email').'>';

							wp_mail( $email_to, $subject, $body, $headers );

							/* Send email to site admin */

							$admin_email = get_bloginfo('admin_email');
							$user_email = ( isset($_POST['register_email']) ) ? $_POST['register_email'] : '' ;
							$username = (isset($_POST['register_name'])) ? $_POST['register_name'] : '';
							$password = (isset($_POST['register_password'])) ? $_POST['register_password'] : '';
							$user_obj = get_user_by( 'slug', $username );
							$user_url = get_admin_url() . 'user-edit.php?user_id='.$user_obj->ID;
							$subject = __( 'A new user registered to ', 'jobboard' ).get_bloginfo('name');
							$body = "Congratulation, a new user just registered to your site. Here is the details: \n\nEmail: ".$user_email." \n\nUsername : ".$username." \n\nPassword : ".$password." \n\nRole: ".$role." \n\nAdmin user: ".$user_url;
							$headers = 'From: '.get_bloginfo('name').' <'.get_bloginfo('admin_email').'>';

							wp_mail( $admin_email, $subject, $body, $headers );



							// wp_redirect( jobboard_get_permalink( 'login') ); exit;

						}

					}

					?>

					<form id="register-form" action="<?php echo esc_url( get_permalink( get_the_id() ) ); ?>" method="post">
						<div class="form-group">
							<input class="form-control" type="text" name="register_name" id="register_name" placeholder="<?php _e( 'Username', 'jobboard' ); ?>" required="required" />
						</div><!-- /.form-group -->
						<div class="form-group">
							<input class="form-control" type="email" name="register_email" id="register_email" placeholder="<?php _e( 'Email', 'jobboard' ); ?>" required="required" />
						</div><!-- /.form-group -->
						<div class="form-group">
							<input class="form-control" type="password" name="register_password" id="register_password" placeholder="<?php _e( 'Password', 'jobboard' ); ?>" required="required" />
						</div><!-- /.form-group -->
						<div class="row">
							<div class="col-sm-6">
								<div class="form-radio-group">
									<input type="radio" name="register_role" id="register_role_job_lister" value="job_lister" /><label for="register_role_job_lister"><?php _e( 'Job Lister', 'jobboard' ); ?></label>
								</div><!-- /.form-radio-group -->
							</div><!-- /.col-sm-6 -->
							<div class="col-sm-6">
								<div class="form-radio-group">
									<input type="radio" name="register_role" id="register_role_job_seeker" value="job_seeker" checked /><label for="register_role_job_seeker"><?php _e( 'Job Seeker', 'jobboard' ); ?></label>
								</div><!-- /.form-radio-group -->
							</div><!-- /.col-sm-6 -->
						</div><!-- /.row -->
						<input type="hidden" name="action" value="jobboard_proccess_login_form" />
						<button type="submit" name="user_submit" id="user_submit" value="1" class="btn btn-register"><?php _e( 'Register', 'jobboard' ); ?></button>
					</form>
				</div><!-- /.login-form-wrapper -->
			</div><!-- /.col-md-0 -->
			<div class="col-md-12">
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
			</div><!-- /.col-md-12 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /#page-title -->

<?php get_footer(); ?>
