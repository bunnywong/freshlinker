<?php

function snp_ajax_purchasecode_check()
{
    global $snp_api_url, $snp_plugin_slug;
    $args		 = array(
	'slug' => $snp_plugin_slug,
    );
    $request_string	 = array(
	'body'		 => array(
	    'action'	 => 'purchasecode_check',
	    'site'		 => get_bloginfo('url'),
	    'purchasecode'	 => $purchasecode	 = preg_replace('/[^a-zA-Z0-9-]/', '', $_POST['purchasecode']),
	    'request'	 => serialize($args),
	),
	'user-agent'	 => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
    );

    // Start checking for an update
    $raw_response = wp_remote_post($snp_api_url, $request_string);

    if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
    {
	$response = unserialize($raw_response['body']);
	echo $response->response;
    }
    else
    {
	echo 'Error occurred during the request!';
    }
    die('');
}

function snp_selftest()
{
    if (snp_get_option('disable_selftest') == 1)
    {
	return;
    }
    $error = '';
    if (WP_DEBUG == true)
    {
	$error.='<b>WP_DEBUG is Enabled!</b><br />Should be Disabled on live website.<br />';
    }
    if (!function_exists('curl_init'))
    {
	$error.='<b>Missing CURL extension!</b><br />You\'ll need to contact your hosting provider and ask them to enable CURL for PHP.<br />';
    }
    if (ini_get('safe_mode'))
    {
	$error.='<b>Safe Mode is ON!</b><br />It can have effects on integrations with autoresponders.<br />';
    }
    global $wp_version;
    if (version_compare($wp_version, '3.5', '<='))
    {
	$error.='<b>Old WordPress version!</b><br />We highly recommend upgrade to the latest version.<br />';
    }
    if ($error)
    {
	echo "<div style=\"padding: 20px; background-color: #ef9999; margin: 40px; border: 1px solid #cc0000; \"><b>Ninja Popups WARNING!</b><br/>" . $error . "<br />You can disable this message in advanced section in plugin settings.</div>";
    }
}

add_action('admin_notices', 'snp_selftest');

function snp_affiliate_message()
{
    if (snp_get_option('disable_affiliate_message') == 1)
    {
	return;
    }
    echo "<div id=\"snp_afm\" style=\"padding: 5px 20px 20px 20px; background-color: #c0f796; margin: 40px; border: 1px solid #7AD03A; \">";
    echo "<h2>Earn with Ninja Popups and Envato Affiliate Program!</h2><br/>";
    echo '<a class="button button-primary" href="edit.php?post_type=snp_popups&page=snp_opt&tab=4">Tell me more</a> ';
    echo '<a class="button" id="snp_afm_d" href="#">Dismiss this notice</a>';
    echo "</div>";
    echo "<script>jQuery(document).ready(function($){ $('#snp_afm_d').click(function(){ jQuery.ajax({type: 'POST',  url: 'admin-ajax.php', data: {  action: 'snp_disable_affiliate_message'}}); $('#snp_afm').hide(); return false;});});</script>";
}

add_action('admin_notices', 'snp_affiliate_message');

function snp_run_camp($POST_META)
{
    global $snp_ignore_cookies, $wp_scripts;
    $snp_ignore_cookies = true;
    
    snp_run_popup($POST_META['snp_camp_popup'], $POST_META['snp_camp_use']);
    echo '<!DOCTYPE html>';
    echo '<html><head>';
    echo '<style> body, html { height: 100%; width: 100%;} ';
    echo 'body { display: block;margin: 0;padding: 0;} </style>';
    snp_init();
    //wp_head();
    wp_enqueue_scripts();
    foreach ($wp_scripts->registered as $k => $v)
    {
	//print_r($v);
	if (!in_array($v->handle, array('jquery', 'jquery-core', 'fancybox2', 'jquery-ui-core', 'jquery-migrate', 'js-ninjapopups', 'jquery-np-cookie', 'jquery-np-placeholder')))
	{
	    wp_deregister_script($v->handle);
	}
    }
    wp_print_styles();
    print_admin_styles();
    wp_print_head_scripts();
    echo '</head><body>';
    echo '<iframe src="' . $POST_META['snp_camp_dest_url'] . '" style="width: 100%; height: 100%; border: 0; padding: 0; margin: 0; line-height: 0; display: block;"></iframe>';
    snp_footer();
    wp_print_footer_scripts();
    echo '</body></html>';
    die('');
}

function snp_page_preview()
{
    global $snp_ignore_cookies, $PREVIEW_POPUP_META;
    global $snp_ignore_cookies;
    $snp_ignore_cookies = true;
    snp_run_popup($POST_META['snp_camp_popup'], $POST_META['snp_camp_use']);
    snp_init();
    if (!empty($_GET['action']) && $_GET['action'] == 'snp_preview_popup' && !$_GET['popup_ID'])
    {
	die('-1');
    }
    elseif (isset($_GET['popup_ID']))
    {
	$POST_META['snp_camp_popup'] = $_GET['popup_ID'];
    }
    if (count($_POST))
    {
	$PREVIEW_POPUP_META = array();
	foreach ((array) $_POST['snp'] as $k => $v)
	{
	    if (strpos($k, 'cf') !== FALSE)
	    {
		$elements = array();
		foreach ($v['fields'] as $k2 => $v2)
		{
		    if ($v2 != 'RAND')
		    {
			$elements[] = $v[$v2];
		    }
		}
		$PREVIEW_POPUP_META['snp_' . $k] = $elements;
	    }
	    else
	    {
		$PREVIEW_POPUP_META['snp_' . $k] = $v;
	    }
	}
	$POST_META['snp_camp_popup'] = -1;
    }
    $POST_META['snp_camp_dest_url']	 = site_url() . '/wp-admin/index.php';
    $POST_META['snp_camp_use']	 = 'welcome';
    add_action('wp_enqueue_scripts', 'snp_enqueue_social_script');
}

function snp_preview_popup()
{
    global $snp_ignore_cookies, $PREVIEW_POPUP_META;
    $snp_ignore_cookies = true;
    if (!empty($_GET['action']) && $_GET['action'] == 'snp_preview_popup' && !$_GET['popup_ID'])
    {
	die('-1');
    }
    elseif (isset($_GET['popup_ID']))
    {
	$POST_META['snp_camp_popup'] = $_GET['popup_ID'];
    }
    if (count($_POST))
    {
	$PREVIEW_POPUP_META = array();
	foreach ((array) $_POST['snp'] as $k => $v)
	{
	    if (strpos($k, 'cf') !== FALSE)
	    {
		$elements = array();
		foreach ($v['fields'] as $k2 => $v2)
		{
		    if ($v2 != 'RAND')
		    {
			$elements[] = $v[$v2];
		    }
		}
		$PREVIEW_POPUP_META['snp_' . $k] = $elements;
	    }
	    else
	    {
		$PREVIEW_POPUP_META['snp_' . $k] = $v;
	    }
	}
	$POST_META['snp_camp_popup'] = -1;
    }
    $POST_META['snp_camp_dest_url']	 = site_url() . '/wp-admin/index.php';
    $POST_META['snp_camp_use']	 = 'welcome';
    add_action('wp_enqueue_scripts', 'snp_enqueue_social_script');
    snp_run_camp($POST_META);
}

/* END PREVIEW */

function snp_activate()
{
    global $wpdb;
    if (!get_option("SNP_DB_VER") || version_compare(get_option("SNP_DB_VER"), SNP_DB_VER, '<'))
    {
	$table_name	 = $wpdb->prefix . "snp_stats";
	$sql		 = "CREATE TABLE IF NOT EXISTS $table_name (
			`date` date NOT NULL,
			`ID` bigint(20) NOT NULL,
			`AB_ID` bigint(20) NOT NULL,
			`imps` int(11) NOT NULL,
			`convs` int(11) NOT NULL,
			UNIQUE KEY `date_ID` (`date`,`ID`,`AB_ID`),
			KEY `ID` (`ID`),
			KEY `date` (`date`),
			KEY `AB_ID` (`AB_ID`)
		       );";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta($sql);
	add_option("SNP_DB_VER", SNP_DB_VER);
    }
}

add_action('plugins_loaded', 'snp_activate');

function snp_icons()
{
    ?>
    <style type="text/css" media="screen">
        #menu-posts-snp_popups .wp-menu-image, #toplevel_page_snp_opt .wp-menu-image {
    	background: url(<?php echo SNP_NHP_OPTIONS_URL; ?>img/star_menu.png) no-repeat 12px -32px !important;
        }
        #menu-posts-snp_popups:hover .wp-menu-image, #menu-posts-snp_popups.wp-has-current-submenu .wp-menu-image,
        #toplevel_page_snp_opt:hover .wp-menu-image, #toplevel_page_snp_opt.wp-has-current-submenu .wp-menu-image
        {
    	background-position: 12px 0px !important;
        }
        #icon-edit.icon32-posts-snp_popups {background: url(<?php echo SNP_NHP_OPTIONS_URL; ?>img/star_32x32.png) no-repeat;}
    </style>
    <?php
}

add_action('admin_head', 'snp_icons');

function snp_stats()
{
    global $wpdb;
    require_once( plugin_dir_path(__FILE__) . '/../include/analytics.php' );
}

function snp_posttype_admin_css()
{
    global $post_type;
    $post_types = array(
	'snp_popups', 'snp_campaign', 'snp_ab'
    );
    if (in_array($post_type, $post_types))
    {
	echo '<style type="text/css">#the-list .inline, #post-preview, #minor-publishing, #titlediv .inside, #message.updated a{display: none;}.column-snp_ID {width: 70px;}.column-snp_rate,.column-snp_views,.column-snp_conversions,.column-snp_stats,.column-snp_preview{max-width: 130px;}</style>';
	echo '<script>jQuery(document).ready(function(){
			jQuery("#the-list .view a").each(function(){
				jQuery(this).attr("href",jQuery(this).parents("tr").find("a.snp_preview").attr("href")).attr("target","_blank");
			});
			jQuery("#the-list .snp_reset_stats").click(function(){
				return confirm("Are you sure?");
			});
		 });</script>';
	?>
	<style type="text/css" media="screen">
	    @media only screen and (min-width: 1150px) {	
		#side-sortables.fixed { position: fixed; top: 55px; right: 17px; width: 280px; }
	    }	
	</style>
	<script>
	    jQuery(document).ready(function($) {
		if ($('#side-sortables').length > 0)
		{
		    var snpprevPosition = $('#side-sortables').offset();
		    $(window).scroll(function() {
			if ($(window).scrollTop() > snpprevPosition.top)
			{
			    $('#side-sortables').addClass('fixed');
			}
			else
			{
			    $('#side-sortables').removeClass('fixed');
			}
		    });
		}
	    });
	</script>
	<?php
    }
}

function snp_add_columns($columns)
{
    $new_columns['cb']		 = '<input type="checkbox" />';
    $new_columns['title']		 = 'Name';
    $new_columns['snp_theme']	 = 'Theme';
    $new_columns['snp_views']	 = 'Impressions';
    $new_columns['snp_conversions']	 = 'Conversions';
    $new_columns['snp_rate']	 = 'Rate';
    $new_columns['snp_stats']	 = 'Analytics‎';
    $new_columns['snp_ID']		 = 'ID';
    $new_columns['snp_preview']	 = 'Preview';
    return $new_columns;
}

function snp_ab_add_columns($columns)
{
    $new_columns['cb']		 = '<input type="checkbox" />';
    $new_columns['title']		 = 'Name';
    $new_columns['snp_views']	 = 'Impressions';
    $new_columns['snp_conversions']	 = 'Conversions';
    $new_columns['snp_rate']	 = 'Rate';
    $new_columns['snp_stats']	 = 'Analytics‎';
    $new_columns['snp_ID']		 = 'ID';
    return $new_columns;
}

function snp_manage_columns($column_name, $id)
{
    global $SNP_THEMES;
    if ($column_name == 'snp_views')
    {
	$count		 = get_post_meta($id, 'snp_views');
	if (!isset($count[0]))
	    $count[0]	 = 0;
	echo $count[0];
    }
    elseif ($column_name == 'snp_conversions')
    {
	$count		 = get_post_meta($id, 'snp_conversions');
	if (!isset($count[0]))
	    $count[0]	 = 0;
	echo $count[0];
    }
    elseif ($column_name == 'snp_rate')
    {
	$snp_views		 = get_post_meta($id, 'snp_views');
	if (!isset($snp_views[0]))
	    $snp_views[0]		 = 0;
	$snp_conversions	 = get_post_meta($id, 'snp_conversions');
	if (!isset($snp_conversions[0]))
	    $snp_conversions[0]	 = 0;
	if ($snp_views[0] > 0)
	{
	    echo round(($snp_conversions[0] / $snp_views[0]) * 100, 2) . '%';
	}
	else
	{
	    echo '--';
	}
    }
    elseif ($column_name == 'snp_theme')
    {
	$POPUP_THEME = get_post_meta($id, 'snp_theme');
	if (!empty($POPUP_THEME[0]['theme']))
	{
	    echo $SNP_THEMES[$POPUP_THEME[0]['theme']]['NAME'];
	}
	else
	{
	    echo '--';
	}
    }
    elseif ($column_name == 'snp_ID')
    {
	echo $id;
    }
    elseif ($column_name == 'snp_preview')
    {
	echo '<a class="snp_preview" target="_blank" href="admin-ajax.php?action=snp_preview_popup&amp;popup_ID=' . $id . '">Open Preview</a>';
    }
    elseif ($column_name == 'snp_stats')
    {
	if (get_post_type($id) == 'snp_ab')
	{
	    echo '<a href="edit.php?post_type=snp_popups&page=snp_stats&amp;popup_ID=ab_' . $id . '">Analytics‎</a>';
	}
	else
	{
	    echo '<a href="edit.php?post_type=snp_popups&page=snp_stats&amp;popup_ID=' . $id . '">Analytics‎</a>';
	}
    }
}

function snp_add_columns_posts($columns)
{
    $new_columns			 = $columns;
    $new_columns['snp_popup']	 = 'Ninja Popups';
    return $new_columns;
}

function snp_manage_columns_posts_post($column_name, $id)
{
    snp_manage_columns_posts('', $column_name, $id, 'post');
}

function snp_manage_columns_posts_term($content, $column_name, $id)
{
    snp_manage_columns_posts($content, $column_name, $id, 'term');
}

function snp_manage_columns_posts($content, $column_name, $id, $mode)
{
    global $SNP_THEMES;
    if ($column_name == 'snp_popup')
    {
	$POST_META_WELCOME_G	 = 0;
	$POST_META_EXIT_G	 = 0;
	$POST_META_WELCOME_TITLE = '';
	$POST_META_EXIT_TITLE	 = '';
	if ($mode == 'post')
	{
	    $POST_META_WELCOME = get_post_meta($id, 'snp_p_welcome_popup');
	}
	else
	{
	    $snp_term_meta		 = get_option("snp_taxonomy_$id");
	    $POST_META_WELCOME[0]	 = isset($snp_term_meta['welcome']) ? $snp_term_meta['welcome'] : 'global';
	}
	if (!isset($POST_META_WELCOME) || !isset($POST_META_WELCOME[0]))
	{
	    $POST_META_WELCOME	 = array();
	    $POST_META_WELCOME[0]	 = 'global';
	}
	if ($mode == 'post')
	{
	    $POST_META_EXIT = get_post_meta($id, 'snp_p_exit_popup');
	}
	else
	{
	    $snp_term_meta		 = get_option("snp_taxonomy_$id");
	    $POST_META_EXIT[0]	 = isset($snp_term_meta['exit']) ? $snp_term_meta['exit'] : 'global';
	}
	if (!isset($POST_META_EXIT) || !isset($POST_META_EXIT[0]))
	{
	    $POST_META_EXIT		 = array();
	    $POST_META_EXIT[0]	 = 'global';
	}
	if ($POST_META_WELCOME[0] == 'disabled')
	{
	    $POST_META_WELCOME_TITLE = 'Disabled';
	}
	elseif ($POST_META_WELCOME[0] == 'global')
	{
	    $POST_META_WELCOME_TITLE = 'Global settings';
	}
	else
	{
	    $POST_META_WELCOME_ID	 = $POST_META_WELCOME[0];
	    $POST_META_WELCOME_TITLE = get_the_title(str_replace('ab_', '', $POST_META_WELCOME[0]));
	}
	if ($POST_META_EXIT[0] == 'disabled')
	{
	    $POST_META_EXIT_TITLE = 'Disabled';
	}
	elseif ($POST_META_EXIT[0] == 'global')
	{
	    $POST_META_EXIT_TITLE = 'Global settings';
	}
	else
	{
	    $POST_META_EXIT_ID	 = $POST_META_EXIT[0];
	    $POST_META_EXIT_TITLE	 = get_the_title(str_replace('ab_', '', $POST_META_EXIT[0]));
	}


	$content .= '<img style="width: 16px; height: 16px;" src="' . SNP_NHP_OPTIONS_URL . 'img/ico_welcome_settings.png" />';
	$content .= '' . $POST_META_WELCOME_TITLE . '';
	$content .= '<br />';
	$content .= '<img style="width: 16px; height: 16px;" src="' . SNP_NHP_OPTIONS_URL . 'img/ico_exit_settings.png" />';
	$content .= '' . $POST_META_EXIT_TITLE . '';
	if ($mode == 'post')
	{
	    echo $content;
	}
	else
	{
	    echo $content;
	}
    }
}

function snp_register_tinymce_plugin($plugin_array)
{
    $plugin_array['snp_button'] = SNP_NHP_OPTIONS_URL . 'js/snp_button.js';
    return $plugin_array;
}

function snp_add_tinymce_button($buttons)
{
    $buttons[] = "snp_button";
    return $buttons;
}

function snp_ajax_insert_shortcode()
{
    require_once SNP_DIR_PATH . '/include/snp_insert_shortcode.php';
    die('');
}

function snp_ajax_disable_affiliate_message()
{
    global $SNP_NHP_Options;
    $SNP_NHP_Options->set('disable_affiliate_message', 1);
    echo '1';
    die('');
}

function snp_ajax_dismiss_update_message()
{
    global $SNP_NHP_Options;
    delete_transient('snp_update_response');
    echo '1';
    die('');
}

function snp_plugin_menu()
{
    add_submenu_page('edit.php?post_type=snp_popups', 'Analytics', 'Analytics', 'manage_options', 'snp_stats', 'snp_stats');
}

add_action('admin_menu', 'snp_plugin_menu');

function snp_setup_admin()
{
    $args				 = array();
    $args['dev_mode']		 = false;
    $args['intro_text']		 = __('<p></p>', 'nhp-opts');
    $args['share_icons']['facebook'] = array(
	'link'	 => 'https://www.facebook.com/arscode',
	'title'	 => 'Find us on Facebook',
	'img'	 => SNP_NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_320_facebook.png'
    );
    $args['show_import_export']	 = false;
    $args['opt_name']		 = SNP_OPTIONS;
    $args['page_type']		 = 'submenu';
    $args['page_parent']		 = 'edit.php?post_type=snp_popups';
    $args['menu_title']		 = __('Settings', 'nhp-opts');
    $args['page_title']		 = __('Ninja Popups', 'nhp-opts');
    $args['page_slug']		 = 'snp_opt';
    //if (is_admin())
    {
	snp_init();
	//add_submenu_page( 'admin.php?page=snp_opt', 'Preview', 'Preview', 'manage_options', 'snp_preview', 'snp_page_preview' );
	add_filter("mce_external_plugins", "snp_register_tinymce_plugin");
	add_filter('mce_buttons', 'snp_add_tinymce_button');
	add_filter('manage_edit-snp_popups_columns', 'snp_add_columns');
	add_filter('manage_edit-snp_ab_columns', 'snp_ab_add_columns');
	add_action('manage_snp_popups_posts_custom_column', 'snp_manage_columns', 10, 2);
	add_action('manage_snp_ab_posts_custom_column', 'snp_manage_columns', 10, 2);
	if (!snp_get_option('disable_np_columns'))
	{
	    add_filter('manage_edit-post_columns', 'snp_add_columns_posts');
	    add_filter('manage_edit-page_columns', 'snp_add_columns_posts');
	    add_filter('manage_edit-product_columns', 'snp_add_columns_posts');
	    //add_filter('manage_edit-category_columns', 'snp_add_columns_posts');
	    //add_filter('manage_edit-product_cat_columns', 'snp_add_columns_posts');
	    add_action('manage_posts_custom_column', 'snp_manage_columns_posts_post', 10, 2);
	    add_action('manage_page_posts_custom_column', 'snp_manage_columns_posts_post', 10, 2);
	    add_action('manage_product_custom_column', 'snp_manage_columns_posts_post', 10, 2);
	    //add_action('manage_category_custom_column', 'snp_manage_columns_posts_term', 10, 3);
	    //add_action('manage_product_cat_custom_column', 'snp_manage_columns_posts_term', 10, 3);
	    $enable_taxs=snp_get_option('enable_taxs');
	    if(is_array($enable_taxs))
	    {
		foreach((array)$enable_taxs as $k => $v)
		{
		    add_filter('manage_edit-'.$k.'_columns', 'snp_add_columns_posts');
		    add_action('manage_'.$k.'_custom_column', 'snp_manage_columns_posts_term', 10, 3);
		}
	    }
	}
	add_action('wp_ajax_snp_preview_popup', 'snp_preview_popup');
	add_action('wp_ajax_snp_insert_shortcode', 'snp_ajax_insert_shortcode');
	add_action('wp_ajax_snp_ml_list', 'snp_ml_list');
	add_action('wp_ajax_snp_popup_fields', 'snp_popup_fields');
	add_action('wp_ajax_snp_popup_colors', 'snp_popup_colors');
	add_action('wp_ajax_snp_popup_types', 'snp_popup_types');
	add_action('wp_ajax_snp_disable_affiliate_message', 'snp_ajax_disable_affiliate_message');
	add_action('wp_ajax_snp_dismiss_update_message', 'snp_ajax_dismiss_update_message');
	add_action('wp_ajax_snp_purchasecode_check', 'snp_ajax_purchasecode_check');
	add_action('admin_head-post-new.php', 'snp_posttype_admin_css');
	add_action('admin_head-post.php', 'snp_posttype_admin_css');
	add_action('admin_head-edit.php', 'snp_posttype_admin_css');
	$Popups			 = snp_get_popups();
	$ABTesting		 = snp_get_ab();
	$customfields[]		 = array(
	    'id'		 => 'snp-cf-gsp',
	    'post_type'	 => array('snp_ab'),
	    'title'		 => __('Popups', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'forms',
		    'type'		 => 'multi_checkbox',
		    'title'		 => __('Select', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'options'	 => $Popups
		),
	    )
	);
	$Popups			 = (array) $Popups + (array) $ABTesting;
	$Popups['disabled']	 = 'Disabled';
	$sections		 = array();
	global $FB_Locales;
	$sections[]		 = array(
	    'icon'	 => SNP_NHP_OPTIONS_URL . 'img/ico_gen_settings.png',
	    'title'	 => __('General Settings', 'nhp-opts'),
	    'fields' => array(
		array(
		    'id'		 => 'enable',
		    'type'		 => 'select',
		    'title'		 => __('Enable Plugin', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'enabled',
		    'options'	 => array(
			'enabled'	 => 'Enabled',
			'disabled'	 => 'Disabled',
		    )
		),
		array(
		    'id'		 => 'enable_mobile',
		    'type'		 => 'select',
		    'title'		 => __('Enable Plugin on Mobile Devices', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'enabled',
		    'options'	 => array(
			'enabled'	 => 'Enabled',
			'disabled'	 => 'Disabled',
		    )
		),
		array(
		    'id'		 => 'enable_analytics_events',
		    'type'		 => 'select',
		    'title'		 => __('Enable Google Analytics Event Tracking', 'nhp-opts'),
		    'desc'		 => __('<b>Google Universal Analytics</b> should be installed on the site.', 'nhp-opts'),
		    'std'		 => 'no',
		    'options'	 => array(
			'no'	 => 'No',
			'yes'	 => 'Yes',
		    )
		),
	    )
	);
	$sections_welcome = array(
	    array(
		    'id'		 => 'welcome_popup',
		    'type'		 => 'select',
		    'title'		 => __('Default Welcome Popup', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'disabled',
		    'options'	 => $Popups,
		)
	    );
	$sections_exit = array(
	    array(
		    'id'		 => 'exit_popup',
		    'type'		 => 'select',
		    'title'		 => __('Default Exit Popup', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'disabled',
		    'options'	 => $Popups,
		)
	    );
	if (function_exists('icl_get_languages'))
	{
	    $Popups['global']	 = 'Use global settings';
	    $langs = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
	    foreach ($langs as $language)
	    {
		$sections_welcome[] = array(
		    'id'		 => 'welcome_popup_'.$language['language_code'],
		    'type'		 => 'select',
		    'title'		 => __('Default Welcome Popup ['.$language['native_name'].']', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'global',
		    'options'	 => $Popups,
		);
		 $sections_exit[] = array(
		    'id'		 => 'exit_popup_'.$language['language_code'],
		    'type'		 => 'select',
		    'title'		 => __('Default Exit Popup ['.$language['native_name'].']', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'global',
		    'options'	 => $Popups,
		);
	    }
	}
	$sections[]		 = array(
	    'icon'	 => SNP_NHP_OPTIONS_URL . 'img/ico_welcome_settings.png',
	    'title'	 => __('Welcome', 'nhp-opts'),
	    'fields' => array_merge($sections_welcome, array(
		    array(
			'id'		 => 'welcome_display_in',
			'type'		 => 'multi_checkbox',
			'title'		 => __('Display in:', 'nhp-opts'),
			'desc'		 => __('', 'nhp-opts'),
			'std'		 => array('home' => 1, 'pages' => 1, 'posts' => 1, 'others' => 1),
			'options'	 => array(
			    'home'	 => 'Home',
			    'pages'	 => 'Pages',
			    'posts'	 => 'Posts',
			    'others' => 'Categories, Archive and other'
			)
		    ),
		    array(
			'id'		 => 'welcome_disable_for_logged',
			'type'		 => 'checkbox',
			'title'		 => __('Disable for logged users', 'nhp-opts'),
			'sub_desc'	 => __('', 'nhp-opts'),
			'std'		 => ''
		    ),
		)
	    )
	);
	$sections[]		 = array(
	    'icon'	 => SNP_NHP_OPTIONS_URL . 'img/ico_exit_settings.png',
	    'title'	 => __('Exit', 'nhp-opts'),
	    'fields' => array_merge($sections_exit, array(
		array(
		    'id'		 => 'exit_display_in',
		    'type'		 => 'multi_checkbox',
		    'title'		 => __('Display in:', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => array('home' => 1, 'pages' => 1, 'posts' => 1, 'others' => 1),
		    'options'	 => array(
			'home'	 => 'Home',
			'pages'	 => 'Pages',
			'posts'	 => 'Posts',
			'others' => 'Categories, Archive and other'
		    )
		),
		array(
		    'id'		 => 'use_in',
		    'type'		 => 'multi_checkbox',
		    'title'		 => __('Use popup external for links in:', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => array('the_content' => 1, 'the_excerpt' => 1, 'widget_text' => 1, 'comment_text' => 1),
		    'options'	 => array(
			'the_content'	 => 'Content',
			'the_excerpt'	 => 'Excerpts',
			'widget_text'	 => 'Widgets Text',
			'comment_text'	 => 'Comments',
			'all'		 => 'All links (Menu, sidebars, footer, etc.)'
		    )
		),
		array(
		    'id'	 => 'exit_excluded_urls',
		    'type'	 => 'multi_text',
		    'title'	 => __('Excluded URLs', 'nhp-opts'),
		    'desc'	 => __('Add external URLs for which you want to disable/skip exit popup.', 'nhp-opts'),
		),
		array(
		    'id'		 => 'exit_disable_for_logged',
		    'type'		 => 'checkbox',
		    'title'		 => __('Disable for logged users', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
	    ))
	);
	$ml_managers		 = array(
	    '0'			 => array('name' => '--'),
	    'email'			 => array('name' => 'Send Optins to E-mail', 'fieldsgroup' => 'fg_email'),
	    'aweber'		 => array('name' => 'AWeber', 'fieldsgroup' => 'fg_aweber'),
	    'mailchimp'		 => array('name' => 'MailChimp', 'fieldsgroup' => 'fg_mailchimp'),
	    'getresponse'		 => array('name' => 'GetResponse', 'fieldsgroup' => 'fg_getresponse'),
	    'campaignmonitor'	 => array('name' => 'CampaignMonitor', 'fieldsgroup' => 'fg_campaignmonitor'),
	    'icontact'		 => array('name' => 'iContact', 'fieldsgroup' => 'fg_icontact'),
	    'constantcontact'	 => array('name' => 'Constant Contact', 'fieldsgroup' => 'fg_constantcontact'),
	    'madmimi'		 => array('name' => 'Mad Mimi', 'fieldsgroup' => 'fg_madmimi'),
	    'infusionsoft'		 => array('name' => 'Infusionsoft', 'fieldsgroup' => 'fg_inf'),
	    'directmail'		 => array('name' => 'Direct Mail for OS X', 'fieldsgroup' => 'fg_directmail'),
	    'sendy'			 => array('name' => 'Sendy', 'fieldsgroup' => 'fg_sendy'),
	    'egoi'			 => array('name' => 'e-goi', 'fieldsgroup' => 'fg_egoi'),
	    'csv'			 => array('name' => 'Store in CSV File', 'fieldsgroup' => 'fg_csv'),
	    'html'			 => array('name' => 'HTML Form', 'fieldsgroup' => 'fg_html'),
	);
	if (class_exists('WYSIJA'))
	{
	    $ml_managers['wysija'] = array('name' => 'Wysija', 'fieldsgroup' => 'fg_wysija');
	}
	if (defined('MYMAIL_VERSION') && version_compare(MYMAIL_VERSION, '1.3.1.2') >= 0)
	{
	    $ml_managers['mymail'] = array('name' => 'MyMail', 'fieldsgroup' => 'fg_mymail');
	}
	if (defined('SENDPRESS_VERSION'))
	{
	    $ml_managers['sendpress'] = array('name' => 'SendPress', 'fieldsgroup' => 'fg_sendpress');
	}
	$sections[]		 = array(
	    'icon'	 => SNP_NHP_OPTIONS_URL . 'img/ico_ml_settings.png',
	    'title'	 => __('Mailing List Manager', 'nhp-opts'),
	    'fields' => array(
		array(
		    'id'		 => 'ml_manager',
		    'type'		 => 'select_show_fieldsgroup',
		    'title'		 => __('Mailing List Manager', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'email',
		    'options'	 => $ml_managers
		),
		array(
		    'id'		 => 'ml_aw_auth',
		    'type'		 => 'aweber_auth',
		    'class'		 => 'fg_ml_manager fg_aweber large-text',
		    'title'		 => __('AWeber Connection', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => '',
		),
		array(
		    'id'		 => 'ml_aw_lists',
		    'type'		 => 'aweber_lists',
		    'class'		 => 'fg_ml_manager fg_aweber',
		    'title'		 => __('Default Mailing List', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => '',
		),
		array(
		    'id'		 => 'ml_htmlform_exp',
		    'type'		 => 'htmlform_exp',
		    'class'		 => 'fg_ml_manager fg_html',
		    'title'		 => __('HTML Opt-in Code:', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => __('Enter your html opt-in code.', 'nhp-opts'),
		    'std'		 => '',
		),
		array(
		    'id'		 => 'ml_html_url',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_html regular-text',
		    'title'		 => __('Form URL', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => '',
		),
		array(
		    'id'		 => 'ml_html_blank',
		    'type'		 => 'checkbox',
		    'class'		 => 'fg_ml_manager fg_html',
		    'title'		 => __('Submit Form to New Window', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => '',
		),
		array(
		    'id'		 => 'ml_html_name',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_html regular-text',
		    'title'		 => __('Name Input Name', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => 'name'
		),
		array(
		    'id'		 => 'ml_html_email',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_html regular-text',
		    'title'		 => __('E-mail Input Name', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => 'email'
		),
		array(
		    'id'		 => 'ml_html_hidden',
		    'type'		 => 'textarea',
		    'class'		 => 'fg_ml_manager fg_html regular-text',
		    'title'		 => __('Additional HTML Code:', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => __('Enter additional form HTML, like hidden inputs etc.', 'nhp-opts'),
		    'std'		 => '',
		),
		array(
		    'id'		 => 'ml_csv_file',
		    'type'		 => 'csv_file',
		    'class'		 => 'fg_ml_manager fg_csv regular-text',
		    'title'		 => __('CSV File Name', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => '',
		),
		array(
		    'id'		 => 'ml_mc_apikey',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_mailchimp regular-text',
		    'title'		 => __('MailChimp API Key', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => __('<a href="http://kb.mailchimp.com/article/where-can-i-find-my-api-key" target="_blank">Where can I find my API Key?</a>', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_mc_list',
		    'type'		 => 'mailchimp_lists',
		    'class'		 => 'fg_ml_manager fg_mailchimp regular-text',
		    'title'		 => __('Default Mailing List', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_mc_double_optin',
		    'type'		 => 'select',
		    'class'		 => 'fg_ml_manager fg_mailchimp regular-text',
		    'title'		 => __('Double Opt-in?', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => 0,
		    'options'	 => array(
			0	 => 'No',
			1	 => 'Yes'
		    )
		),
		array(
		    'id'		 => 'ml_mc_send_welcome',
		    'type'		 => 'select',
		    'class'		 => 'fg_ml_manager fg_mailchimp regular-text',
		    'title'		 => __('Send Welcome Message?', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => 1,
		    'options'	 => array(
			0	 => 'No',
			1	 => 'Yes'
		    )
		),
		array(
		    'id'		 => 'ml_gr_apikey',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_getresponse regular-text',
		    'title'		 => __('GetResponse API Key', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => __('<a href="http://www.getresponse.com/learning-center/glossary/api-key.html" target="_blank">Where can I find my API Key?</a>', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_gr_list',
		    'type'		 => 'getresponse_lists',
		    'class'		 => 'fg_ml_manager fg_getresponse regular-text',
		    'title'		 => __('Default Mailing List', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_sendy_url',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_sendy regular-text',
		    'title'		 => __('Sendy Url', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => '',
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_sendy_list',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_sendy regular-text',
		    'title'		 => __('Sendy List ID', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => __('This encrypted & hashed id can be found under View all lists section named ID', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_egoi_apikey',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_egoi regular-text',
		    'title'		 => __('e-goi API Key', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => '',
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_egoi_list',
		    'type'		 => 'egoi_lists',
		    'class'		 => 'fg_ml_manager fg_egoi regular-text',
		    'title'		 => __('Default Mailing List', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		
		array(
		    'id'		 => 'ml_dm_form_id',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_directmail regular-text',
		    'title'		 => __('Direct Mail Subscribe Form ID', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => __('<a href="http://directmailmac.com/support/article/327" target="_blank">Where do I find my form ID?</a>', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_cm_clientid',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_campaignmonitor regular-text',
		    'title'		 => __('CampaignMonitor Client ID', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => __('<a href="http://www.campaignmonitor.com/api/getting-started/#clientid" target="_blank">Where can I find my Client ID?</a>', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_cm_apikey',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_campaignmonitor regular-text',
		    'title'		 => __('CampaignMonitor API Key', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => __('<a href="http://www.campaignmonitor.com/api/getting-started/#apikey" target="_blank">Where can I find my API Key?</a>', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_cm_list',
		    'type'		 => 'campaignmonitor_lists',
		    'class'		 => 'fg_ml_manager fg_campaignmonitor regular-text',
		    'title'		 => __('Default Mailing List', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_ic_username',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_icontact regular-text',
		    'title'		 => __('iContact Username', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_ic_addid',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_icontact regular-text',
		    'title'		 => __('iContact App ID', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => __('<a href="http://developer.icontact.com/documentation/register-your-app/" target="_blank">Where can I get my App ID?</a>', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_ic_apppass',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_icontact regular-text',
		    'title'		 => __('iContact App Password', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_ic_list',
		    'type'		 => 'icontact_lists',
		    'class'		 => 'fg_ml_manager fg_icontact regular-text',
		    'title'		 => __('Default Mailing List', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_cc_username',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_constantcontact regular-text',
		    'title'		 => __('Constant Contact Username', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_cc_pass',
		    'type'		 => 'text',
		    'input_type'	 => 'password',
		    'class'		 => 'fg_ml_manager fg_constantcontact regular-text',
		    'title'		 => __('Constant Contact Password', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_cc_list',
		    'type'		 => 'constantcontact_lists',
		    'class'		 => 'fg_ml_manager fg_constantcontact regular-text',
		    'title'		 => __('Default Mailing List', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_cc_send_welcome',
		    'type'		 => 'select',
		    'class'		 => 'fg_ml_manager fg_constantcontact regular-text',
		    'title'		 => __('Send Welcome Message?', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => 1,
		    'options'	 => array(
			0	 => 'No',
			1	 => 'Yes'
		    )
		),
		array(
		    'id'		 => 'ml_email',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_email regular-text',
		    'title'		 => __('E-mail Address', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_wy_list',
		    'type'		 => 'wysija_lists',
		    'class'		 => 'fg_ml_manager fg_wysija regular-text',
		    'title'		 => __('Default Mailing List', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_mm_list',
		    'type'		 => 'mymail_lists',
		    'class'		 => 'fg_ml_manager fg_mymail regular-text',
		    'title'		 => __('Default Mailing List', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_mm_double_optin',
		    'type'		 => 'select',
		    'class'		 => 'fg_ml_manager fg_mymail regular-text',
		    'title'		 => __('Double Opt-in?', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => 0,
		    'options'	 => array(
			0	 => 'No',
			1	 => 'Yes'
		    )
		),
		array(
		    'id'		 => 'ml_sp_list',
		    'type'		 => 'sendpress_lists',
		    'class'		 => 'fg_ml_manager fg_sendpress regular-text',
		    'title'		 => __('Default Mailing List', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_madm_username',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_madmimi regular-text',
		    'title'		 => __('Mad Mimi Username', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_madm_apikey',
		    'type'		 => 'text',
		    'input_type'	 => 'text',
		    'class'		 => 'fg_ml_manager fg_madmimi regular-text',
		    'title'		 => __('Mad Mimi API Key', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_madm_list',
		    'type'		 => 'madmimi_lists',
		    'class'		 => 'fg_ml_manager fg_madmimi regular-text',
		    'title'		 => __('Default Mailing List', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_inf_subdomain',
		    'type'		 => 'text',
		    'class'		 => 'fg_ml_manager fg_inf regular-text',
		    'title'		 => __('Infusionsoft subdomain', 'nhp-opts'),
		    'desc'		 => __('.infusionsoft.com', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_inf_apikey',
		    'type'		 => 'text',
		    'input_type'	 => 'text',
		    'class'		 => 'fg_ml_manager fg_inf regular-text',
		    'title'		 => __('Infusionsoft API Key', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'		 => 'ml_inf_list',
		    'type'		 => 'infusionsoft_lists',
		    'class'		 => 'fg_ml_manager fg_inf regular-text',
		    'title'		 => __('Default Group', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
	    )
	);
	$sections[]		 = array(
	    'icon'	 => SNP_NHP_OPTIONS_URL . 'img/ico_updates.png',
	    'title'	 => __('Auto Updates', 'nhp-opts'),
	    'fields' => array(
		array(
		    'id'		 => 'autoupdates',
		    'type'		 => 'checkbox',
		    'title'		 => __('Enable Auto Updates', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'	 => 'purchasecode',
		    'type'	 => 'purchasecode',
		    'title'	 => __('Purchase Code', 'nhp-opts'),
		    'desc'	 => __('<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-can-I-find-my-Purchase-Code-" target="_blank">Where can I find my Purchase Code?</a>', 'nhp-opts'),
		    'std'	 => ''
		),
	    )
	);
	$sections[]		 = array(
	    'icon'	 => SNP_NHP_OPTIONS_URL . 'img/ico_promote.png',
	    'title'	 => __('Promote', 'nhp-opts'),
	    'fields' => array(
		array(
		    'id'	 => 'promo_header',
		    'type'	 => 'info',
		    'title'	 => __('Earn with Envato Affiliate Program!', 'nhp-opts'),
		    'desc'	 => __('<a href="http://codecanyon.net/make_money/affiliate_program" target="_blank">Click here for more info</a>', 'nhp-opts'),
		),
		array(
		    'id'		 => 'PROMO_ON',
		    'type'		 => 'checkbox',
		    'title'		 => __('Promote Ninja Popups with Your Affiliate link?', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => ''
		),
		array(
		    'id'	 => 'PROMO_REF',
		    'type'	 => 'text',
		    'title'	 => __('Your Envato Username', 'nhp-opts'),
		    'desc'	 => __('', 'nhp-opts'),
		    'std'	 => ''
		),
		array(
		    'id'	 => 'promo_img',
		    'type'	 => 'info2',
		    'desc'	 => __('<p style="text-align: center;"><img src="' . SNP_URL . '/admin/img/promote.png" /></p>', 'nhp-opts'),
		    'std'	 => ''
		),
	    )
	);
	$sections[]		 = array(
	    'icon'	 => SNP_NHP_OPTIONS_URL . 'img/ico_adv_settings.png',
	    'title'	 => __('Advanced Settings', 'nhp-opts'),
	    'fields' => array(
		array(
		    'id'	 => 'enable_taxs',
		    'type'	 => 'tax_checkboxes',
		    'title'	 => __('Enable Ninja Popups Settings for Taxonomies', 'nhp-opts'),
		),
		array(
		    'id'	 => 'class_popup',
		    'type'	 => 'text',
		    'title'	 => __('CSS class used in links', 'nhp-opts'),
		    'desc'	 => __('(default: snppopup)', 'nhp-opts'),
		    'std'	 => 'snppopup'
		),
		array(
		    'id'	 => 'class_no_popup',
		    'type'	 => 'text',
		    'title'	 => __('CSS class used in links for disable popup', 'nhp-opts'),
		    'desc'	 => __('(default: nosnppopup)', 'nhp-opts'),
		    'std'	 => 'nosnppopup'
		),
		array(
		    'id'		 => 'fb_locale',
		    'type'		 => 'select',
		    'title'		 => __('Facebook Locale', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'en_GB',
		    'options'	 => $FB_Locales
		),
		array(
		    'id'	 => 'disable_selftest',
		    'type'	 => 'checkbox',
		    'title'	 => __('Disable Self Test Warning', 'nhp-opts'),
		),
		array(
		    'id'	 => 'disable_affiliate_message',
		    'type'	 => 'checkbox',
		    'title'	 => __('Disable Afilliate Program Notice', 'nhp-opts'),
		),
		array(
		    'id'	 => 'disable_np_columns',
		    'type'	 => 'checkbox',
		    'title'	 => __('Don\'t show Ninja Popups column in Posts/Pages Lists', 'nhp-opts'),
		),
		array(
		    'id'		 => 'run_hook',
		    'type'		 => 'select',
		    'title'		 => __('Plugin Run Hook', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'get_header',
		    'options'	 => array(
			'get_header'	 => 'get_header',
			'wp'		 => 'wp',
		    )
		),
		array(
		    'id'	 => 'conflict_header',
		    'type'	 => 'info',
		    'title'	 => 'JavaScripts',
		    'desc'	 => __('If Theme or another Plugin is loading any of these scripts, you can turn it off to avoid conflict.
					', 'nhp-opts'),
		),
		array(
		    'id'		 => 'js_disable_fancybox',
		    'type'		 => 'checkbox',
		    'title'		 => __('Disable Fancybox 2 Loading', 'nhp-opts'),
		    'sub_desc'	 => 'jquery.fancybox.pack.js',
		),
		array(
		    'id'		 => 'js_disable_jq_cookie',
		    'type'		 => 'checkbox',
		    'title'		 => __('Disable jQuery Cookie', 'nhp-opts'),
		    'sub_desc'	 => 'jquery.ck.js<br />(<a href="https://github.com/carhartl/jquery-cookie" target="_blank">https://github.com/carhartl/jquery-cookie</a>)',
		),
		array(
		    'id'		 => 'js_disable_jq_placeholder',
		    'type'		 => 'checkbox',
		    'title'		 => __('Disable jQuery PlaceHolder', 'nhp-opts'),
		    'sub_desc'	 => 'jquery.placeholder.js',
		),
		array(
		    'id'		 => 'js_disable_fb',
		    'type'		 => 'checkbox',
		    'title'		 => __('Disable Facebook JS Loading', 'nhp-opts'),
		    'sub_desc'	 => 'https://connect.facebook.net/en_GB/all.js#xfbml=1',
		),
		array(
		    'id'		 => 'js_disable_gp',
		    'type'		 => 'checkbox',
		    'title'		 => __('Disable Google Plus JS Loading', 'nhp-opts'),
		    'sub_desc'	 => 'https://apis.google.com/js/plusone.js',
		),
		array(
		    'id'		 => 'js_disable_tw',
		    'type'		 => 'checkbox',
		    'title'		 => __('Disable Twitter JS Loading', 'nhp-opts'),
		    'sub_desc'	 => 'https://platform.twitter.com/widgets.js',
		),
		array(
		    'id'		 => 'js_disable_pi',
		    'type'		 => 'checkbox',
		    'title'		 => __('Disable Pinterest JS Loading', 'nhp-opts'),
		    'sub_desc'	 => 'https://assets.pinterest.com/js/pinit.js',
		),
		array(
		    'id'		 => 'js_disable_li',
		    'type'		 => 'checkbox',
		    'title'		 => __('Disable LinkedIn JS Loading', 'nhp-opts'),
		    'sub_desc'	 => 'https://platform.linkedin.com/in.js',
		),
	    )
	);
	$Popups['global']	 = 'Use global settings';
	$Popups['disabled']	 = 'Disabled';
	$all_post_type		 = snp_get_post_types();
	$customfields[]		 = array(
	    'id'		 => 'snp-cf-gsp',
	    'post_type'	 => $all_post_type,
	    'title'		 => __('Ninja Popups', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'p_welcome_popup',
		    'type'		 => 'select',
		    'title'		 => __('Welcome', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'global',
		    'options'	 => $Popups
		),
		array(
		    'id'		 => 'p_exit_popup',
		    'type'		 => 'select',
		    'title'		 => __('Exit', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'global',
		    'options'	 => $Popups
		),
	    )
	);

	// POPUP FILEDS
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-lf',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Look & Feel', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'theme',
		    'type'		 => 'select_theme',
		    'title'		 => __('Theme', 'nhp-opts'),
		    'desc'		 => __('Please save content data before change.', 'nhp-opts'),
		    'std'		 => 'theme1',
		    'options'	 => snp_get_themes_list()
		),
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-cnt',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Content', 'nhp-opts'),
	    'fields'	 => array(
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-preview',
	    'context'	 => 'side',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Preview', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'popup_preview_popup',
		    'type'		 => 'preview_popup',
		    'title'		 => __('Preview', 'nhp-opts'),
		    'disable_title'	 => 1,
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		),
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-overlay',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Overlay', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'popup_overlay',
		    'type'		 => 'select_show_fieldsgroup',
		    'title'		 => __('Overlay', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'default',
		    'options'	 => array(
			'default'	 => array('name' => 'Default (60% opacity)', 'fieldsgroup' => 'fg_overlay_default'),
			'disabled'	 => array('name' => 'Disabled', 'fieldsgroup' => 'fg_overlay_disabled'),
			'image'		 => array('name' => 'Image', 'fieldsgroup' => 'fg_overlay_image'),
		    )
		),
		array(
		    'id'	 => 'overlay_image',
		    'type'	 => 'upload',
		    'class'	 => 'fg_overlay fg_overlay_image regular-text',
		    'title'	 => __('Overlay Image', 'nhp-opts')
		)
	    )
	);


	$customfields[]	 = array(
	    'id'		 => 'snp-cf-gs',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Display Settings', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'start_date',
		    'type'		 => 'date',
		    'title'		 => __('Start Date', 'nhp-opts'),
		    'sub_desc'	 => __('Leave empty to enable popup all the time.', 'nhp-opts')
		),
		array(
		    'id'		 => 'end_date',
		    'type'		 => 'date',
		    'title'		 => __('End Date', 'nhp-opts'),
		    'sub_desc'	 => __('Leave empty to enable popup all the time.', 'nhp-opts')
		),
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-op',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Welcome Settings', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'open',
		    'type'		 => 'select_show_fieldsgroup',
		    'title'		 => __('When Popup should appear?', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'default',
		    'options'	 => array(
			'load'		 => array('name' => 'On page load', 'fieldsgroup' => 'open_load'),
			'inactivity'	 => array('name' => 'After X seconds of inactivity', 'fieldsgroup' => 'open_inactivity'),
			'scroll'	 => array('name' => 'When user scroll page', 'fieldsgroup' => 'open_scroll')
		    )
		),
		array(
		    'id'	 => 'open_inactivity',
		    'type'	 => 'text',
		    'class'	 => 'fg_open open_inactivity',
		    'title'	 => __('Open after X seconds of inactivity', 'nhp-opts'),
		    'desc'	 => __('', 'nhp-opts')
		),
		array(
		    'id'	 => 'open_after',
		    'type'	 => 'text',
		    'class'	 => 'fg_open open_load',
		    'title'	 => __('Open Delay', 'nhp-opts'),
		    'desc'	 => __('(in seconds)', 'nhp-opts')
		),
		array(
		    'id'	 => 'open_scroll',
		    'type'	 => 'slider',
		    'class'	 => 'fg_open open_scroll mini',
		    'title'	 => __('Open when user scroll % of page', 'nhp-opts'),
		    'desc'	 => __('% (100% - end of page)', 'nhp-opts'),
		    'std'	 => '10',
		    'min'	 => '0',
		    'max'	 => '100',
		    'step'	 => '1'
		),
	    /* array(
	      'id' => 'show_welcome',
	      'type' => 'select_hide_below',
	      'title' => __('Show Exit Popup', 'nhp-opts'),
	      'sub_desc' => __('Only for exit popups.', 'nhp-opts'),
	      'desc' => __('', 'nhp-opts'),
	      'std' => 2,
	      'options' => array(
	      2 => array('name' => 'When user try to leave page (need JS Alert)', 'allow' => 'true'),
	      3 => array('name' => 'When mouse leaves the browser viewport (Exit Intent)', 'allow' => 'false'),
	      1 => array('name' => 'When user click external link', 'allow' => 'false'),
	      )
	      ),
	      array(
	      'id' => 'open_after',
	      'type' => 'text',
	      'class' => 'mini',
	      'title' => __('Open Popup Delay', 'nhp-opts'),
	      'desc' => __('(in seconds)', 'nhp-opts')
	      ), */
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-ex',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Exit Settings', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'show_on_exit',
		    'type'		 => 'select_hide_below',
		    'title'		 => __('Show Exit Popup', 'nhp-opts'),
		    'sub_desc'	 => __('Only for exit popups.', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 2,
		    'options'	 => array(
			2	 => array('name' => 'When user try to leave page (need JS Alert)', 'allow' => 'true'),
			3	 => array('name' => 'When mouse leaves the browser viewport (Exit Intent)', 'allow' => 'false'),
			1	 => array('name' => 'When user click external link', 'allow' => 'false'),
		    )
		),
		array(
		    'id'		 => 'exit_js_alert_text',
		    'type'		 => 'textarea',
		    'title'		 => __('JavaScript Alert Box Text', 'nhp-opts'),
		    'sub_desc'	 => __('Only for exit popups.', 'nhp-opts'),
		    'desc'		 => __('<p style="text-align: center;"><img src="' . SNP_URL . '/admin/img/js_alert.png" /></p>', 'nhp-opts')
		),
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-cb',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Close Button & Delay', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'cb_close_after',
		    'type'		 => 'text',
		    'class'		 => 'mini',
		    'title'		 => __('Auto Close Popup', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => __('(in seconds)', 'nhp-opts')
		),
		array(
		    'id'		 => 'show_cb_button',
		    'type'		 => 'select',
		    'title'		 => __('Show Close Link and Button', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'yes',
		    'options'	 => array(
			'yes'	 => 'Yes',
			'no'	 => 'No',
		    )
		),
		array(
		    'id'	 => 'cb_text',
		    'type'	 => 'text',
		    'title'	 => __('Close Link Text', 'nhp-opts'),
		    'std'	 => __('Close this popup', 'nhp-opts'),
		    'desc'	 => __('', 'nhp-opts')
		),
		array(
		    'id'		 => 'cb_img',
		    'type'		 => 'radio_img',
		    'title'		 => __('Close Button', 'nhp-opts'),
		    'sub_desc'	 => '',
		    'desc'		 => '',
		    'options'	 => array(
			'close_default'	 => array('title' => '', 'img' => SNP_URL . 'img/close_default.png'),
			'close_1'	 => array('title' => '', 'img' => SNP_URL . 'img/close_1.png'),
			'close_2'	 => array('title' => '', 'img' => SNP_URL . 'img/close_2.png'),
			'close_3'	 => array('title' => '', 'img' => SNP_URL . 'img/close_3.png'),
			'close_4'	 => array('title' => '', 'img' => SNP_URL . 'img/close_4.png'),
			'close_5'	 => array('title' => '', 'img' => SNP_URL . 'img/close_5.png'),
			'close_6'	 => array('title' => '', 'img' => SNP_URL . 'img/close_6.png'),
		    ),
		    'std'		 => 'close_default'
		),
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-cookies',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Cookies', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'cookie_conversion',
		    'type'		 => 'text',
		    'class'		 => 'mini',
		    'title'		 => __('Cookie Time on Conversion (Opt-in/Share)', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => '30',
		    'desc'		 => __('days (0 for cookie just for current session, -2 to disable cookie and open popup every time)<br />When user opt-in/share, how long should it be before the popup is shown again?', 'nhp-opts')
		),
		array(
		    'id'		 => 'cookie_close',
		    'type'		 => 'text',
		    'class'		 => 'mini',
		    'title'		 => __('Cookie Time on Close', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'std'		 => '0',
		    'desc'		 => __('days (0 for cookie just for current session, -2 to disable cookie and open popup every time)<br />When user click close button, how long should it be before the popup is shown again?', 'nhp-opts')
		),
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-redirect',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Redirect', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'optin_redirect',
		    'type'		 => 'select',
		    'title'		 => __('Redirect after opt-in/like', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'no',
		    'options'	 => array(
			'yes'	 => 'Yes',
			'no'	 => 'No',
		    )
		),
		array(
		    'id'	 => 'optin_redirect_url',
		    'type'	 => 'text',
		    'title'	 => __('Redirect URL', 'nhp-opts'),
		    'desc'	 => __('(start with http://)', 'nhp-opts')
		),
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-fb',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Facebook', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'show_like_button',
		    'type'		 => 'select',
		    'title'		 => __('Show Like Button', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'yes',
		    'options'	 => array(
			'yes'	 => 'Yes',
			'no'	 => 'No',
		    )
		),
		array(
		    'id'		 => 'fb_url',
		    'type'		 => 'text',
		    'title'		 => __('URL to Like', 'nhp-opts'),
		    'sub_desc'	 => __('Leave empty to use current URL.', 'nhp-opts'),
		    'desc'		 => __('(start with http://)', 'nhp-opts')
		),
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-tw',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Twitter', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'show_tweet_button',
		    'type'		 => 'select',
		    'title'		 => __('Show Tweet Button', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'yes',
		    'options'	 => array(
			'yes'	 => 'Yes',
			'no'	 => 'No',
		    )
		),
		array(
		    'id'		 => 'tweet_url',
		    'type'		 => 'text',
		    'title'		 => __('URL to Tweet', 'nhp-opts'),
		    'sub_desc'	 => __('Leave empty to use current URL.', 'nhp-opts'),
		    'desc'		 => __('(start with http://)', 'nhp-opts')
		),
		array(
		    'id'		 => 'tweet_text',
		    'type'		 => 'textarea',
		    'title'		 => __('Tweet Text', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts')
		),
		array(
		    'id'		 => 'show_follow_button',
		    'type'		 => 'select',
		    'title'		 => __('Show Follow Button', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'no',
		    'options'	 => array(
			'yes'	 => 'Yes',
			'no'	 => 'No',
		    )
		),
		array(
		    'id'	 => 'twitter_username',
		    'type'	 => 'text',
		    'title'	 => __('Twitter Username', 'nhp-opts')
		),
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-gp',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Google Plus', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'show_gp_button',
		    'type'		 => 'select',
		    'title'		 => __('Show +1 Button', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'yes',
		    'options'	 => array(
			'yes'	 => 'Yes',
			'no'	 => 'No',
		    )
		),
		array(
		    'id'		 => 'gp_url',
		    'type'		 => 'text',
		    'title'		 => __('URL to +1', 'nhp-opts'),
		    'sub_desc'	 => __('Leave empty to use current URL.', 'nhp-opts'),
		    'desc'		 => __('(start with http://)', 'nhp-opts')
		),
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-li',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('LinkedIn', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'show_li_button',
		    'type'		 => 'select',
		    'title'		 => __('Show InShare Button', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'yes',
		    'options'	 => array(
			'yes'	 => 'Yes',
			'no'	 => 'No',
		    )
		),
		array(
		    'id'		 => 'li_url',
		    'type'		 => 'text',
		    'title'		 => __('URL to share', 'nhp-opts'),
		    'sub_desc'	 => __('Leave empty to use current URL.', 'nhp-opts'),
		    'desc'		 => __('(start with http://)', 'nhp-opts')
		),
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-pi',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Pinterest', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'		 => 'show_pi_button',
		    'type'		 => 'select',
		    'title'		 => __('Show Pin It Button', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts'),
		    'std'		 => 'yes',
		    'options'	 => array(
			'yes'	 => 'Yes',
			'no'	 => 'No',
		    )
		),
		array(
		    'id'		 => 'pi_url',
		    'type'		 => 'text',
		    'title'		 => __('URL of the page to pin', 'nhp-opts'),
		    'sub_desc'	 => __('Leave empty to use current URL.', 'nhp-opts'),
		    'desc'		 => __('(start with http://)', 'nhp-opts')
		),
		array(
		    'id'	 => 'pi_image_url',
		    'type'	 => 'upload',
		    'title'	 => __('URL of the image to pin', 'nhp-opts'),
		    'desc'	 => __('(start with http://)', 'nhp-opts')
		),
		array(
		    'id'		 => 'pi_description',
		    'type'		 => 'textarea',
		    'title'		 => __('Description ', 'nhp-opts'),
		    'sub_desc'	 => __('', 'nhp-opts'),
		    'desc'		 => __('', 'nhp-opts')
		),
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-customcss',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Custom CSS', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'	 => 'custom_css',
		    'type'	 => 'textarea',
		    'title'	 => __('Custom CSS', 'nhp-opts')
		),
	    )
	);
	$customfields[]	 = array(
	    'id'		 => 'snp-cf-customjs',
	    'post_type'	 => array('snp_popups'),
	    'title'		 => __('Custom JS', 'nhp-opts'),
	    'fields'	 => array(
		array(
		    'id'	 => 'custom_js',
		    'type'	 => 'textarea',
		    'title'	 => __('Custom JS', 'nhp-opts')
		),
	    )
	);
	/* == */
	$ml_fields	 = array();
	if (snp_get_option('ml_manager') == 'email')
	{
	    $ml_fields[] = array(
		'id'		 => 'ml_email',
		'type'		 => 'text',
		'class'		 => 'fg_ml_manager fg_email regular-text',
		'title'		 => __('E-mail Address', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	elseif (snp_get_option('ml_manager') == 'aweber')
	{
	    $ml_fields[] = array(
		'id'		 => 'ml_aw_lists',
		'type'		 => 'aweber_lists',
		'class'		 => 'fg_ml_manager fg_aweber',
		'title'		 => __('Select Mailing List', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	elseif (snp_get_option('ml_manager') == 'mailchimp')
	{
	    $ml_fields[] = array(
		'id'		 => 'ml_mc_list',
		'type'		 => 'mailchimp_lists',
		'class'		 => 'fg_ml_manager fg_mailchimp regular-text',
		'title'		 => __('Select Mailing List', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	elseif (snp_get_option('ml_manager') == 'getresponse')
	{
	    $ml_fields[] = array(
		'id'		 => 'ml_gr_list',
		'type'		 => 'getresponse_lists',
		'class'		 => 'fg_ml_manager fg_getresponse regular-text',
		'title'		 => __('Select Mailing List', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	elseif (snp_get_option('ml_manager') == 'campaignmonitor')
	{
	    $ml_fields[] = array(
		'id'		 => 'ml_cm_list',
		'type'		 => 'campaignmonitor_lists',
		'class'		 => 'fg_ml_manager fg_campaignmonitor regular-text',
		'title'		 => __('Select Mailing List', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	elseif (snp_get_option('ml_manager') == 'icontact')
	{
	    $ml_fields[] = array(
		'id'		 => 'ml_ic_list',
		'type'		 => 'icontact_lists',
		'class'		 => 'fg_ml_manager fg_icontact regular-text',
		'title'		 => __('Select Mailing List', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	elseif (snp_get_option('ml_manager') == 'constantcontact')
	{
	    $ml_fields[] = array(
		'id'		 => 'ml_cc_list',
		'type'		 => 'constantcontact_lists',
		'class'		 => 'fg_ml_manager fg_constantcontact regular-text',
		'title'		 => __('Select Mailing List', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	elseif (snp_get_option('ml_manager') == 'wysija')
	{
	    $ml_fields[] = array(
		'id'		 => 'ml_wy_list',
		'type'		 => 'wysija_lists',
		'class'		 => 'fg_ml_manager fg_wysija regular-text',
		'title'		 => __('Select Mailing List', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	elseif (snp_get_option('ml_manager') == 'mymail')
	{
	    $ml_fields[] = array(
		'id'		 => 'ml_mm_list',
		'type'		 => 'mymail_lists',
		'class'		 => 'fg_ml_manager fg_mymail regular-text',
		'title'		 => __('Select Mailing List', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	elseif (snp_get_option('ml_manager') == 'sendpress')
	{
	    $ml_fields[] = array(
		'id'		 => 'ml_sp_list',
		'type'		 => 'sendpress_lists',
		'class'		 => 'fg_ml_manager fg_sendpress regular-text',
		'title'		 => __('Select Mailing List', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	elseif (snp_get_option('ml_manager') == 'madmimi')
	{
	    $ml_fields[] = array(
		'id'		 => 'ml_madm_list',
		'type'		 => 'madmimi_lists',
		'class'		 => 'fg_ml_manager fg_madmimi regular-text',
		'title'		 => __('Select Mailing List', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	elseif (snp_get_option('ml_manager') == 'infusionsoft')
	{
	    $ml_fields[] = array(
		'id'		 => 'ml_inf_list',
		'type'		 => 'infusionsoft_lists',
		'class'		 => 'fg_ml_manager fg_inf regular-text',
		'title'		 => __('Select Group', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	elseif (snp_get_option('ml_manager') == 'sendy')
	{
	    $ml_fields[] = array(
		'id'		 => 'ml_sendy_list',
		'type'		 => 'text',
		'class'		 => 'fg_ml_manager fg_sendy regular-text',
		'title'		 => __('Sendy List ID', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'desc'		 => __('This encrypted & hashed id can be found under View all lists section named ID', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	elseif (snp_get_option('ml_manager') == 'egoi')
	{
	     $ml_fields[] = array(
		'id'		 => 'ml_egoi_list',
		'type'		 => 'egoi_lists',
		'class'		 => 'fg_ml_manager fg_egoi regular-text',
		'title'		 => __('Select Mailing List', 'nhp-opts'),
		'sub_desc'	 => __('', 'nhp-opts'),
		'std'		 => '',
		'meta'		 => 1
	    );
	}
	if (count($ml_fields) > 0)
	{
	    $customfields[] = array(
		'id'		 => 'snp-cf-ml',
		'post_type'	 => array('snp_popups'),
		'title'		 => __('Mailing List', 'nhp-opts'),
		'fields'	 => $ml_fields
	    );
	}

	/* == */
	global $SNP_NHP_Options;
	$tabs		 = array();
	$SNP_NHP_Options = new SNP_NHP_Options($sections, $args, $tabs, $customfields, array(), array());
    }
}
function snp_get_post_types()
{
    $return = array();
    $post_types_excluded = array('snp_popups', 'snp_ab', 'attachment', 'revision', 'nav_menu_item', 'mediapage');
    $post_types = get_post_types(array('public' => true));
    foreach ($post_types as $post_type)
    {
	if (!in_array($post_type, $post_types_excluded))
	{
	    $return[$post_type] = $post_type;
	}
    }
	$return['portfolio'] = 'portfolio';
    return $return;
}
function snp_get_popups()
{
	$Return = array();
	$args = array(
		'numberposts' => 1000,
		'offset' => 0,
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'snp_popups',
		'post_status' => 'publish',
		'suppress_filters' => true);
	$posts_array = get_posts($args);
	foreach ((array) $posts_array as $post)
	{
		$Return[$post->ID] = $post->post_title;
	}
	return $Return;
}
function snp_get_ab()
{
    $Return = array();
    $args = array(
	'numberposts'		 => 1000,
	'offset'		 => 0,
	'orderby'		 => 'title',
	'order'			 => 'ASC',
	'post_type'		 => 'snp_ab',
	'post_status'		 => 'publish',
	'suppress_filters'	 => true);
    $posts_array		 = get_posts($args);
    foreach ((array) $posts_array as $post)
    {
	$Return['ab_' . $post->ID] = 'A/B Testing: ' . $post->post_title;
    }
    return $Return;
}

function snp_clone_form_link($actions, $post)
{
    // If the post_type is 'post', and the Quick Edit row action is set
    if (('snp_popups' == $post->post_type || 'snp_ab' == $post->post_type) && isset($actions['inline hide-if-no-js']))
    {
	unset($actions['inline hide-if-no-js']);
    }
    if ('snp_popups' == $post->post_type)
    {
	$snp_nonce		 = wp_create_nonce('snp_nonce');
	$actions['clone']	 = '<a href="' . admin_url("admin-ajax.php?action=snp_clone_form&nonce=" . $snp_nonce . "&post_id=" . $post->ID) . '" title="'
		. esc_attr(__("Clone this item", 'arscode'))
		. '">' . __('Clone', 'arscode') . '</a>';
	$actions['reset']	 = '<a href="' . admin_url("admin-ajax.php?action=snp_reset_stats&nonce=" . $snp_nonce . "&post_id=" . $post->ID) . '" class="snp_reset_stats" title="'
		. esc_attr(__("Reset stats", 'arscode'))
		. '">' . __('Reset stats', 'arscode') . '</a>';
    }
    return $actions;
}

add_filter('post_row_actions', 'snp_clone_form_link', 10, 2);
add_action('wp_ajax_snp_clone_form', 'snp_clone_form');
add_action('wp_ajax_snp_reset_stats', 'snp_reset_stats');

function snp_reset_stats()
{
    if (isset($_GET['nonce']) && isset($_GET['post_id']))
    {
	$nonce	 = $_GET['nonce'];
	$post_id = $_GET['post_id'];
    }
    else
    {
	$nonce	 = $_POST['nonce'];
	$post_id = $_POST['post_id'];
    }
    if (!isset($nonce) || !wp_verify_nonce($nonce, 'snp_nonce'))
    {
	return;
    }
    if (!current_user_can('edit_post', $post_id) || !current_user_can('edit_page', $post_id))
    {
	return;
    }
    update_post_meta($post_id, 'snp_views', 0);
    update_post_meta($post_id, 'snp_conversions', 0);
    global $wpdb;
    $table_name	 = $wpdb->prefix . "snp_stats";
    $wpdb->query("DELETE FROM $table_name WHERE `ID`='".intval($post_id)."'"); 
    $redirect	 = add_query_arg(array('post_type' => 'snp_popups'), 'edit.php');
    wp_redirect($redirect);
    exit();
}

function snp_clone_form()
{
    if (isset($_GET['nonce']) && isset($_GET['post_id']))
    {
	$nonce	 = $_GET['nonce'];
	$post_id = $_GET['post_id'];
    }
    else
    {
	$nonce	 = $_POST['nonce'];
	$post_id = $_POST['post_id'];
    }
    if (!isset($nonce) || !wp_verify_nonce($nonce, 'snp_nonce'))
    {
	return;
    }
    if (!current_user_can('edit_post', $post_id) || !current_user_can('edit_page', $post_id))
    {
	return;
    }
    $old_post	 = get_post($post_id);
    $new_post	 = array(
	'post_status'	 => 'draft',
	'menu_order'	 => $old_post->menu_order,
	'post_type'	 => $old_post->post_type,
	'comment_status' => $old_post->comment_status,
	'ping_status'	 => $old_post->ping_status,
	'pinged'	 => $old_post->pinged,
	'post_author'	 => $old_post->post_author,
	'post_category'	 => $old_post->post_category,
	'post_content'	 => $old_post->post_content,
	'post_excerpt'	 => $old_post->post_excerpt,
	'post_name'	 => $old_post->post_name,
	'post_parent'	 => $old_post->post_parent,
	'post_password'	 => $old_post->post_password,
	'post_title'	 => $old_post->post_title . ' - ' . __('Copy', 'arscode') . '',
	'post_type'	 => $old_post->post_type,
	'tags_input'	 => $old_post->tags_input,
	'to_ping'	 => $old_post->to_ping,
	'tax_input'	 => $old_post->tax_input,
    );
    $new_post_id	 = wp_insert_post($new_post);
    $post_meta_keys	 = get_post_custom_keys($post_id);
    if (empty($post_meta_keys))
    {
	return;
    }

    foreach ($post_meta_keys as $meta_key)
    {
	$meta_values = get_post_custom_values($meta_key, $post_id);
	foreach ($meta_values as $meta_value)
	{
	    if (!in_array($meta_key, array('snp_views', 'snp_conversions')))
	    {
		$meta_value	 = maybe_unserialize($meta_value);
		add_post_meta($new_post_id, $meta_key, $meta_value);
	    }
	}
    }
    $redirect	 = add_query_arg(array('action' => 'edit', 'post'	 => $new_post_id, 'nonce'	 => null), 'post.php');
    wp_redirect($redirect);
    exit();
}
/*
// post category
add_action('category_edit_form_fields', 'snp_cat_meta_fields_edit', 10, 2);
add_action('category_add_form_fields',  'snp_cat_meta_fields_add', 10, 2);
add_action('edited_category', 'save_snp_taxonomy_custom_meta', 10, 2);
add_action('create_category', 'save_snp_taxonomy_custom_meta', 10, 2);
//woocommerce category
add_action('product_cat_edit_form_fields', 'snp_cat_meta_fields_edit', 10, 2);
add_action('product_cat_add_form_fields',  'snp_cat_meta_fields_add', 10, 2);
add_action('edited_product_cat', 'save_snp_taxonomy_custom_meta', 10, 2);
add_action('create_product_cat', 'save_snp_taxonomy_custom_meta', 10, 2);
 */
// tax
$enable_taxs=snp_get_option('enable_taxs');
if(is_array($enable_taxs))
{
    foreach((array)$enable_taxs as $k => $v)
    {
	add_action($k.'_edit_form_fields', 'snp_cat_meta_fields_edit', 10, 2);
	add_action($k.'_add_form_fields',  'snp_cat_meta_fields_add', 10, 2);
	add_action('edited_'.$k, 'save_snp_taxonomy_custom_meta', 10, 2);
	add_action('create_'.$k, 'save_snp_taxonomy_custom_meta', 10, 2);
    }
}

function snp_cat_meta_fields_edit($term)
{
    snp_cat_meta_fields($term, 'edit');
}
function snp_cat_meta_fields_add($term)
{
    snp_cat_meta_fields($term, 'add');
}
function snp_cat_meta_fields($term, $mode)
{
    wp_enqueue_media();
    $t_id		 = $term->term_id;
    $snp_term_meta	 = get_option("snp_taxonomy_$t_id");
    require_once(SNP_DIR_PATH . 'include/cat_meta_fields.php');
}

function save_snp_taxonomy_custom_meta($term_id)
{
    if (isset($_POST['snp_term_meta']))
    {
	$t_id		 = $term_id;
	$snp_term_meta	 = get_option("snp_taxonomy_$t_id");
	$cat_keys	 = array_keys($_POST['snp_term_meta']);
	foreach ($cat_keys as $key)
	{
	    if (isset($_POST['snp_term_meta'][$key]))
	    {
		$snp_term_meta[$key] = $_POST['snp_term_meta'][$key];
	    }
	}
	update_option("snp_taxonomy_$t_id", $snp_term_meta);
    }
}

