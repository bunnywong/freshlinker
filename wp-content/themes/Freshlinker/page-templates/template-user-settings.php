<?php

/**
 * Template Name: User Profile Settings
 *
 * @package WordPress
 * @subpackage Job_Board
 * @since Job Board 1.0
 *
 */

get_header(); ?>

<div id="page-title-wrapper">
  <div class="container">
    <h1 class="page-title"><?php the_title(); ?></h1>
  </div><!-- /.container -->
</div><!-- /#page-title -->


<div id="content">
  <div class="container">


<?php


  if( is_user_logged_in() ){


  $user = jobboard_get_user_data();

  $userID = $user['id'];
  $username = $user['username'];
  $firstname = $user['firstName'];
  $lastname = $user['$lastName'];
  $nickname = $user['$nickName'];
  $displayname = $user['displayName'];
  $email = $user['email'];
  $url = $user['website'];
  $twitter = $user['twitter'];
  $facebook = $user['facebook'];
  $linkedin = $user['linkedin'];
  $bio = $user['bio'];
  $password = $user['pass'];


  $newUserlogin = isset($_POST['username']) ? $_POST['username'] : '';
  $web = isset($_POST['website']) ? $_POST['website'] : '';
  $newFirstName = isset($_POST['firstname']) ? $_POST['firstname'] : '';
  $newLastName = isset($_POST['lastname']) ? $_POST['lastname'] : '';


  if( isset($_POST['update_user']) && ($_POST['password'] != $_POST['password_repeat']) ){

    echo 'Sorry! Your new password didn\' match. Your profile isn\'t updated.';

  }


  if( isset($_POST['update_user']) && ($_POST['password'] == $_POST['password_repeat']) ){

    $user_id = wp_update_user( array(
      'ID' => $userID,
      'user_login' => $username,
      'first_name' => $newFirstName,
      'last_name' => $newLastName,
      'user_url' => $web
    ) );

    if(isset($_POST['password']) && $_POST['password'] != ''){

      if($_POST['password'] == $_POST['password_repeat']){
        wp_set_password( $_POST['password'], $_POST['user_id'] );

        // echo sprintf( __('Your new password saved. Please log in <a href="%s">here</a>.', 'jobboard'), esc_url( jobboard_get_permalink('login') ) );
        jobboard_set_post_message('12');

      } else {
        echo '<div class="alert alert-danger" role="alert"><strong>';
        echo __('Your password didn\'t match. Please, try again!', 'jobboard');
        echo '</strong></div>';
      }
    }



    if ( is_wp_error( $user_id ) ) {

      echo $user_id->get_error_message();

      echo '<div class="alert alert-danger" role="alert"><strong>';
      echo __('Sorry! An error occured. Please, try again!', 'jobboard');
      echo '<strong></div>';
    } else {

      if( (isset($_POST['password']) && $_POST['password'] == '') && (isset($_POST['password_repeat']) && $_POST['password_repeat'] == '')  ){
        wp_redirect( get_permalink() );
      }


    }


  }

?>


<form action="#" method="post" class="frontend-form">

  <p>
    <label for="username"><?php _e('Username (cannot be changed):', 'jobboard'); ?></label>
    <input id="username" type="text" disabled="disabled" name="username" value="<?php echo $username; ?>" class="form-control"></input>
  </p>

  <p>
    <label for="firstname"><?php _e('First Name: ', 'jobboard'); ?></label>
    <input id="firstname" type="text" name="firstname" value="<?php echo $firstname; ?>" class="form-control"></input>
  </p>

  <p>
    <label for="lastname"><?php _e('Last Name: ', 'jobboard'); ?></label>
    <input id="lastname" type="text" name="lastname" value="<?php echo $lastname; ?>" class="form-control"></input>
  </p>

  <?php /*
  <p><?php _e('Nice Name: ', 'jobboard'); ?><input name="nickname" value="<?php echo $nickname; ?>"></input></p>

  <p><?php _e('Display Name: ', 'jobboard'); ?><input name="displayname" value="<?php echo $displayname; ?>"></input></p>
  */ ?>

  <p>
    <label for="website"><?php _e('Website: ', 'jobboard') ?></label>
    <input id="website" type="text" name="website" value="<?php echo $url; ?>" class="form-control"/>
  </p>

  <p>
    <label for="email"><?php _e('Email: ', 'jobboard'); ?></label>
    <input id="email" type="text" name="email" value="<?php echo $email; ?>" class="form-control"></input>
  </p>

  <?php /*
  <p><?php _e('Bio: ', 'jobboard'); ?><textarea name="bio"><?php echo $bio; ?></textarea></p>
  */ ?>

  <p>
    <label for="password"><?php _e('New Password: ', 'jobboard'); ?></label>
    <input id="password" type="password" name="password" value="" class="form-control"></input>
  </p>

  <p>
    <label for="password_repeat"><?php _e('Repeat New Password: ', 'jobboard'); ?></label>
    <input id="password_repeat" type="password" name="password_repeat" value="" class="form-control"></input>
  </p>


  <?php /*
  <p><input type="submit" name="update_user" value="Update" /></p>
  */ ?>

  <p><button type="submit" name="update_user" value="1" class="btn btn-send-contact-form" data-loading-text="<?php _e( 'Updating...', 'jobboard' ); ?>"><?php _e( 'Update Profile', 'jobboard' ); ?></button>
  </p>

  <input type="hidden" name="user_id" value="<?php echo $userID; ?>" />


</form>





<?php

} // Check logged in user ends

else {


  // Redirect to homepage if user is not logged in
  wp_redirect( esc_url( home_url()) );


}


?>


</div><!-- /.content -->

</div><!-- /#content -->


<?php
get_footer();
