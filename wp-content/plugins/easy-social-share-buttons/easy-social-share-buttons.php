<?php

/*
 * Plugin Name: Easy Social Share Buttons for WordPress
* Description: Easy Social Share Buttons automatically adds share bar to your post or pages with support of Facebook, Twitter, Google+, LinkedIn, Pinterest, Digg, StumbleUpon, VKontakte, Tumblr, Print, E-mail. 
* Plugin URI: http://codecanyon.net/item/easy-social-share-buttons-for-wordpress/6394476?ref=appscreo
* Version: 1.2.1
* Author: CreoApps
* Author URI: http://codecanyon.net/user/appscreo/portfolio?ref=appscreo
*/
if (! defined ( 'WPINC' ))
	die ();

//error_reporting( E_ALL | E_STRICT );

define ( 'ESSB_VERSION', '1.2.1' );
define ( 'ESSB_PLUGIN_ROOT', dirname ( __FILE__ ) . '/' );
define ( 'ESSB_PLUGIN_URL', plugins_url () . '/' . basename ( dirname ( __FILE__ ) ) );
define (' ESSB_PLUGIN_BASE_NAME', plugin_basename( __FILE__ ));

define ( 'ESSB_TEXT_DOMAIN', 'essb' );

include (ESSB_PLUGIN_ROOT . 'lib/essb.php');
include (ESSB_PLUGIN_ROOT . 'lib/admin/essb-metabox.php');
register_activation_hook ( __FILE__, array ('EasySocialShareButtons', 'activate' ) );
register_deactivation_hook ( __FILE__, array ('EasySocialShareButtons', 'deactivate' ) );



add_action( 'init', 'essb_load_translations' );
function essb_load_translations() {
	load_plugin_textdomain( ESSB_TEXT_DOMAIN, false, ESSB_PLUGIN_ROOT.'/languages' );
}


global $essb;
$essb = new EasySocialShareButtons();

add_action( "init", "ESSBAdminMenuInit" );
function ESSBAdminMenuInit() {
    global $essb_adminmenu;
    $essb_adminmenu = new EasySocialShareButtons_AdminMenu();
}

?>