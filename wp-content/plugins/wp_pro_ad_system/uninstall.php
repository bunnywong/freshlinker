<?php
/**
 * WP PRO Advertising System Uninstall
 *
 * Uninstalling WP PRO Advertising deletes advertisers, campaigns, banners, adzones, statistics and all advertising settings.
 *
 * @author 		Tunafish
 * @category 	Core
 * @package 	Wp_Pro_Ad_System/Uninstaller
 * @version     4.2.4
 */
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit();

global $wpdb, $wp_roles;

$wpproads_uninstall = get_option('wpproads_uninstall', 0);

if( $wpproads_uninstall )
{		
	// Tables
	$wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->prefix . "pro_ad_system_stats" );
	$wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->prefix . "wpproads_user_stats" );
	
	// Delete options
	$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'wpproads_%';");
	
	// Delete posts + data
	$wpdb->query( "DELETE FROM {$wpdb->posts} WHERE post_type IN ( 'advertisers', 'campaigns', 'banners', 'adzones' );" );
	$wpdb->query( "DELETE FROM {$wpdb->postmeta} meta LEFT JOIN {$wpdb->posts} posts ON posts.ID = meta.post_id WHERE wp.ID IS NULL;" );
}