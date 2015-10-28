<?php add_action('admin_init', 'no_mo_dashboard');
function no_mo_dashboard() {
  if (!current_user_can('manage_options') && $_SERVER['DOING_AJAX'] != '/wp-admin/admin-ajax.php') {
  wp_redirect(home_url()); exit;
  }
}