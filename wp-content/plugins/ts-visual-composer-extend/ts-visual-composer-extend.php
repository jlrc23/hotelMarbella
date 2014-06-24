<?php
/*
Plugin Name:    Visual Composer Extensions
Plugin URI:     http://codecanyon.net/item/visual-composer-extensions/7190695
Description:    A plugin to add new content elements, custom post types and icon fonts to Visual Composer
Author:         Tekanewa Scripts
Author URI:     https://www.tekanewascripts.info
Version:        2.2.5
Text Domain:    ts-visual-composer-extend
*/
if (!defined('ABSPATH')) exit;

// Check for Visual Composer
// -------------------------
if (!defined('__VC_EXTENSIONS__')){
	define('__VC_EXTENSIONS__', dirname(__FILE__));
}


// Main Class for Visual Composer Extensions
// -----------------------------------------

if (!class_exists('VISUAL_COMPOSER_EXTENSIONS')) {
	add_action('admin_init', 		'TS_VCSC_Init_Addon');
	function TS_VCSC_Init_Addon() {
		$required_vc = '3.7';
		if(defined('WPB_VC_VERSION')){
			if( version_compare( $required_vc, WPB_VC_VERSION, '>' )){
				add_action('admin_notices', 	'TS_VCSC_Admin_Notice_Version');
			}
		} else {
			add_action('admin_notices', 		'TS_VCSC_Admin_Notice_Activation');
		}
	}
	function TS_VCSC_Admin_Notice_Version() {
		echo '<div class="updated"><p>The <strong>Visual Composer Extensions</strong> plugin requires <strong>Visual Composer</strong> version 3.7.2 or greater.</p></div>';	
	}
	function TS_VCSC_Admin_Notice_Activation() {
		echo '<div class="updated"><p>The <strong>Visual Composer Extensions</strong> plugin requires <strong>Visual Composer</strong> Plugin installed and activated.</p></div>';
	}

	
	// WordPres Register Hooks
	// -----------------------
	register_activation_hook(__FILE__, 		array('VISUAL_COMPOSER_EXTENSIONS', 	'TS_VCSC_On_Activation'));
	register_deactivation_hook(__FILE__, 	array('VISUAL_COMPOSER_EXTENSIONS', 	'TS_VCSC_On_Deactivation'));
	register_uninstall_hook(__FILE__, 		array('VISUAL_COMPOSER_EXTENSIONS', 	'TS_VCSC_On_Uninstall'));
	
	
	// Create Plugin Class
	// -------------------
	class VISUAL_COMPOSER_EXTENSIONS {
		// Functions for Plugin Activation / Deactivation / Uninstall
		// ----------------------------------------------------------
		public static function TS_VCSC_On_Activation() {
			if (!current_user_can('activate_plugins')) {
				return;
			}
			$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
			check_admin_referer( "activate-plugin_{$plugin}" );
			// Options for License Data
			add_option('ts_vcsc_extend_settings_demo', 					            1);
			add_option('ts_vcsc_extend_settings_updated', 				            0);
			add_option('ts_vcsc_extend_settings_created', 				            0);
			add_option('ts_vcsc_extend_settings_deleted', 				            0);
			add_option('ts_vcsc_extend_settings_extended', 				            0);
			add_option('ts_vcsc_extend_settings_license', 				            '');
			add_option('ts_vcsc_extend_settings_licenseUpdate',						0);
			add_option('ts_vcsc_extend_settings_licenseInfo',						'');
			add_option('ts_vcsc_extend_settings_licenseKeyed',						'');
			add_option('ts_vcsc_extend_settings_licenseValid',						0);
			// Options for Update Data
			add_option('ts_vcsc_extend_settings_versionCurrent', 				    '');
			add_option('ts_vcsc_extend_settings_versionLatest', 				    '');
			add_option('ts_vcsc_extend_settings_updateAvailable', 				    0);
			// Options for Custom CSS/JS Editor
			add_option('ts_vcsc_extend_settings_customCSS',							'/* Welcome to the Custom CSS Editor! Please add all your Custom CSS here. */');
			add_option('ts_vcsc_extend_settings_customJS', 				            '/* Welcome to the Custom JS Editor! Please add all your Custom JS here. */');
			// Other Options
			add_option('ts_vcsc_extend_settings_popups',							1);
			add_option('ts_vcsc_extend_settings_buffering', 						1);
			// Font Active / Inactive
			add_option('ts_vcsc_extend_settings_tinymceMedia',						1);
			add_option('ts_vcsc_extend_settings_tinymceIcon',						1);
			add_option('ts_vcsc_extend_settings_tinymceAwesome',					1);
			add_option('ts_vcsc_extend_settings_tinymceBrankic',					0);
			add_option('ts_vcsc_extend_settings_tinymceCountricons',				0);
			add_option('ts_vcsc_extend_settings_tinymceCurrencies',					0);
			add_option('ts_vcsc_extend_settings_tinymceElegant',					0);
			add_option('ts_vcsc_extend_settings_tinymceEntypo',						0);
			add_option('ts_vcsc_extend_settings_tinymceFoundation',					0);
			add_option('ts_vcsc_extend_settings_tinymceGenericons',					0);
			add_option('ts_vcsc_extend_settings_tinymceIcoMoon',					0);
			add_option('ts_vcsc_extend_settings_tinymceMonuments',					0);
			add_option('ts_vcsc_extend_settings_tinymceSocialMedia',				0);
			add_option('ts_vcsc_extend_settings_tinymceTypicons',					0);
			// Custom Font Data
			add_option('ts_vcsc_extend_settings_tinymceCustom',						0);
			add_option('ts_vcsc_extend_settings_tinymceCustomArray',				'');
			add_option('ts_vcsc_extend_settings_tinymceCustomJSON',					'');
			add_option('ts_vcsc_extend_settings_tinymceCustomPath',					'');
			add_option('ts_vcsc_extend_settings_tinymceCustomPHP', 					'');
			add_option('ts_vcsc_extend_settings_tinymceCustomName',					'Custom User Font');
			add_option('ts_vcsc_extend_settings_tinymceCustomAuthor',				'Custom User');
			add_option('ts_vcsc_extend_settings_tinymceCustomCount',				0);
			add_option('ts_vcsc_extend_settings_tinymceCustomDate',					'');
			// Row + Column Extensions
			add_option('ts_vcsc_extend_settings_additionsRows',						1);
			add_option('ts_vcsc_extend_settings_additionsColumns',					1);
			// Custom Post Types
			add_option('ts_vcsc_extend_settings_customTeam',						1);
			add_option('ts_vcsc_extend_settings_customTestimonial',					1);
			add_option('ts_vcsc_extend_settings_customSkillset',					1);
			// Options for Active/Inactive Elements
			/*foreach ($this->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
				add_option('ts_vcsc_extend_settings_custom' . $element,				1);
			}*/
			// Options for External Files
			add_option('ts_vcsc_extend_settings_loadForcable',						0);
			add_option('ts_vcsc_extend_settings_loadLightbox', 						0);
			add_option('ts_vcsc_extend_settings_loadTooltip', 						0);
			add_option('ts_vcsc_extend_settings_loadFonts', 						0);
			add_option('ts_vcsc_extend_settings_loadEnqueue',						1);
			add_option('ts_vcsc_extend_settings_loadHeader',						0);
			add_option('ts_vcsc_extend_settings_loadjQuery', 						0);
			add_option('ts_vcsc_extend_settings_loadModernizr',						1);
			add_option('ts_vcsc_extend_settings_loadWaypoints', 					1);
			add_option('ts_vcsc_extend_settings_loadCountTo', 						1);
			add_option('ts_vcsc_extend_settings_loadDetector', 						1);
			// Language Settings
			add_option('ts_vcsc_extend_settings_languageDayPlural',					'Days');
			add_option('ts_vcsc_extend_settings_languageDaySingular',				'Day');
			add_option('ts_vcsc_extend_settings_languageHourPlural',				'Hours');
			add_option('ts_vcsc_extend_settings_languageHourSingular',				'Hour');
			add_option('ts_vcsc_extend_settings_languageMinutePlural',				'Minutes');
			add_option('ts_vcsc_extend_settings_languageMinuteSingular',			'Minute');
			add_option('ts_vcsc_extend_settings_languageSecondPlural',				'Seconds');
			add_option('ts_vcsc_extend_settings_languageSecondSingular',			'Second');
			add_option('ts_vcsc_extend_settings_languageTextCalcShow', 				'Show Address Input');
			add_option('ts_vcsc_extend_settings_languageTextCalcHide', 				'Hide Address Input');
			add_option('ts_vcsc_extend_settings_languageTextDirectionShow', 		'Show Directions');
			add_option('ts_vcsc_extend_settings_languageTextDirectionHide', 		'Hide Directions');
			add_option('ts_vcsc_extend_settings_languageTextResetMap', 				'Reset Map');
			add_option('ts_vcsc_extend_settings_languagePrintRouteText', 			'Print Route');
			add_option('ts_vcsc_extend_settings_languageTextViewOnGoogle',			'View on Google');
			add_option('ts_vcsc_extend_settings_languageTextButtonCalc', 			'Show Route');
			add_option('ts_vcsc_extend_settings_languageTextSetTarget', 			'Please enter your Start Address:');
			add_option('ts_vcsc_extend_settings_languageTextTravelMode', 			'Travel Mode');
			add_option('ts_vcsc_extend_settings_languageTextDriving', 				'Driving');
			add_option('ts_vcsc_extend_settings_languageTextWalking', 				'Walking');
			add_option('ts_vcsc_extend_settings_languageTextBicy', 					'Bicycling');
			add_option('ts_vcsc_extend_settings_languageTextWP', 					'Optimize Waypoints');
			add_option('ts_vcsc_extend_settings_languageTextButtonAdd', 			'Add Stop on the Way');
			add_option('ts_vcsc_extend_settings_languageTextDistance', 				'Total Distance:');
			add_option('ts_vcsc_extend_settings_languageTextMapHome', 				'Home');
			add_option('ts_vcsc_extend_settings_languageTextMapBikes', 				'Bicycle Trails');
			add_option('ts_vcsc_extend_settings_languageTextMapTraffic', 			'Traffic');
			add_option('ts_vcsc_extend_settings_languageTextMapSpeedMiles', 		'Miles Per Hour');
			add_option('ts_vcsc_extend_settings_languageTextMapSpeedKM', 			'Kilometers Per Hour');
			add_option('ts_vcsc_extend_settings_languageTextMapNoData', 			'No Data Available!');
			add_option('ts_vcsc_extend_settings_languageTextMapMiles', 				'Miles');
			add_option('ts_vcsc_extend_settings_languageTextMapKilometes', 			'Kilometers');
			// Options for Envato Sales Data
			add_option('ts_vcsc_extend_settings_envatoInfo', 					    '');
			add_option('ts_vcsc_extend_settings_envatoLink', 					    '');
			add_option('ts_vcsc_extend_settings_envatoPrice', 					    '');
			add_option('ts_vcsc_extend_settings_envatoRating', 					    '');
			add_option('ts_vcsc_extend_settings_envatoSales', 					    '');
			$roles = get_editable_roles();
			foreach ($GLOBALS['wp_roles']->role_objects as $key => $role) {
				if (isset($roles[$key]) && $role->has_cap('edit_pages') && !$role->has_cap('ts_vcsc_extend')) {
					$role->add_cap('ts_vcsc_extend');
				}
			}
		}
		public static function TS_VCSC_On_Deactivation() {
			if (!current_user_can( 'activate_plugins')) {
				return;
			}
			$plugin = isset($_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
			check_admin_referer("deactivate-plugin_{$plugin}");
			$roles = get_editable_roles();
			foreach ($GLOBALS['wp_roles']->role_objects as $key => $role) {
				if (isset($roles[$key]) && $role->has_cap('ts_vcsc_extend')) {
					$role->remove_cap('ts_vcsc_extend');
				}
			}
		}
		public static function TS_VCSC_On_Uninstall() {
			if (!current_user_can( 'activate_plugins')) {
				return;
			}
			check_admin_referer('bulk-plugins');
			if ( __FILE__ != WP_UNINSTALL_PLUGIN) {
				return;
			}
			TS_VCSC_DeleteOptionsPrefixed('ts_vcsc_extend_settings_');
			unregister_setting('ts_vcsc_extend_custom_css', 	'ts_vcsc_extend_custom_css', 		'TS_VCSC_CustomCSS_Validation');
			unregister_setting('ts_vcsc_extend_custom_js', 		'ts_vcsc_extend_custom_js', 		'TS_VCSC_CustomJS_Validation');
			delete_option("ts_vcsc_extend_custom_css");
			delete_option("ts_vcsc_extend_custom_js");
			$roles = get_editable_roles();
			foreach ($GLOBALS['wp_roles']->role_objects as $key => $role) {
				if (isset($roles[$key]) && $role->has_cap('ts_vcsc_extend')) {
					$role->remove_cap('ts_vcsc_extend');
				}
			}
		}
		
		
		// Create Public / Global Variables
		// --------------------------------
		public $TS_VCSC_Installed_Icon_Fonts = array(
			"Font Awesome"                  		=> "Awesome",
			"Brankic 1979 Font"            		 	=> "Brankic",
			"Countricons Font"              		=> "Countricons",
			"Currencies Font"               		=> "Currencies",
			"Elegant Icons Font"            		=> "Elegant",
			"Entypo Font"                   		=> "Entypo",
			"Foundation Font"               		=> "Foundation",
			"Genericons Font"               		=> "Genericons",
			"IcoMoon Font"                  		=> "IcoMoon",
			"Monuments Font"                		=> "Monuments",
			"Social Media Font"             		=> "SocialMedia",
			"Typicons Font"                 		=> "Typicons",
			"Custom User Font"              		=> "Custom",
		);
		public $TS_VCSC_Author_Icon_Fonts = array(
			"Awesome"                       		=> "Dave Gandy",
			"Brankic"                       		=> "Brankic1979",
			"Countricons"                   		=> "Freepik",
			"Currencies"                    		=> "Freepik",
			"Elegant"                       		=> "Elegant Themes",
			"Entypo"                        		=> "Entypo",
			"Foundation"                    		=> "ZURB University",
			"Genericons"                    		=> "Automatic",
			"IcoMoon"                       		=> "Keyamoon",
			"Monuments"                     		=> "Freepik",
			"SocialMedia"                   		=> "SimpleIcon",
			"Typicons"                      		=> "Stephen Hutchings",
			"Custom"                        		=> "Custom User Font",
		);
		public $TS_VCSC_Visual_Composer_Elements = array(
			"TS Google Charts"						=> array("setting" => "GoogleCharts",       "file" => "google_charts",     	"type" => "internal",		"active" => "true"),
			"TS Google Maps"						=> array("setting" => "GoogleMaps",         "file" => "google_maps",       	"type" => "internal",		"active" => "true"),
			"TS Google Docs"						=> array("setting" => "GoogleDocs",         "file" => "google_docs",       	"type" => "internal",		"active" => "true"),
			"TS Google Trends"						=> array("setting" => "GoogleTrends",       "file" => "google_trends",     	"type" => "internal",		"active" => "true"),
			"TS Font Icons"							=> array("setting" => "FontIcons",          "file" => "icon",              	"type" => "internal",		"active" => "true"),
			"TS Icon Box"							=> array("setting" => "IconBox",            "file" => "icon_box_tiny",     	"type" => "internal",		"active" => "true"),
			"TS Icon Box (Deprecated)"				=> array("setting" => "IconBoxOld",         "file" => "icon_box",          	"type" => "internal",		"active" => "true"),
			"TS Icon List Item"						=> array("setting" => "IconList",           "file" => "icon_listitem",     	"type" => "internal",		"active" => "true"),
			"TS Icon Title"							=> array("setting" => "IconTitle",          "file" => "icon_title",        	"type" => "internal",		"active" => "true"),
			"TS Icon Counter"						=> array("setting" => "IconCounter",        "file" => "icon_counter",      	"type" => "internal",		"active" => "true"),
			"TS Circle Counter"						=> array("setting" => "CircleCounter",      "file" => "circliful",         	"type" => "internal",		"active" => "true"),
			"TS Countdown"							=> array("setting" => "Countdown",          "file" => "countdown",         	"type" => "internal",		"active" => "true"),
			"TS Content Flip"						=> array("setting" => "ContentFlip",        "file" => "content_flip",      	"type" => "internal",		"active" => "true"),
			"TS Meet The Team (Deprecated)"			=> array("setting" => "MeetTeamOld",        "file" => "meet_team",         	"type" => "internal",		"active" => "true"),
			"TS Pricing Table"						=> array("setting" => "PricingTable",       "file" => "pricing_table",     	"type" => "internal",		"active" => "true"),
			"TS Social Networks"					=> array("setting" => "SocialNetworks",     "file" => "social_networks",   	"type" => "internal",		"active" => "true"),
			"TS Timeline / Process"					=> array("setting" => "Timeline",           "file" => "timeline",          	"type" => "internal",		"active" => "true"),
			"TS Divider"							=> array("setting" => "Divider",            "file" => "divider",           	"type" => "internal",		"active" => "true"),
			"TS Shortcode"							=> array("setting" => "Shortcode",          "file" => "shortcode",         	"type" => "internal",		"active" => "true"),
			"TS QR-Code"							=> array("setting" => "QRCode",             "file" => "qrcode",            	"type" => "internal",		"active" => "true"),
			"TS Textillate"							=> array("setting" => "Textillate",         "file" => "textillate",        	"type" => "internal",		"active" => "true"),
			"TS Image Overlay"						=> array("setting" => "ImageOverlay",       "file" => "image_overlay",     	"type" => "internal",		"active" => "true"),
			"TS Image Adipoli"						=> array("setting" => "ImageAdipoli",       "file" => "image_adipoli",     	"type" => "internal",		"active" => "true"),
			"TS Image Picstrips"					=> array("setting" => "ImagePicstrips",     "file" => "image_picstrips",   	"type" => "internal",		"active" => "true"),
			"TS Image Caman"						=> array("setting" => "ImageCaman",         "file" => "image_caman",       	"type" => "internal",		"active" => "true"),
			"TS Image Switch"						=> array("setting" => "ImageSwitch",        "file" => "image_switch",      	"type" => "internal",		"active" => "true"),
			"TS Lightbox Image"						=> array("setting" => "LightboxImage",      "file" => "lightbox_image",    	"type" => "internal",		"active" => "true"),
			"TS Lightbox Gallery"					=> array("setting" => "LightboxGallery",    "file" => "lightbox_gallery",  	"type" => "internal",		"active" => "true"),
			"TS Modal Popup"						=> array("setting" => "ModalPopup",         "file" => "modal",             	"type" => "internal",		"active" => "true"),
			"TS IFrame Embed"						=> array("setting" => "IFrame",             "file" => "iframe",            	"type" => "internal",		"active" => "true"),
			"TS Vimeo Video"						=> array("setting" => "Vimeo",              "file" => "vimeo",             	"type" => "internal",		"active" => "true"),
			"TS DailyMotion Video"					=> array("setting" => "DailyMotion",        "file" => "dailymotion",       	"type" => "internal",		"active" => "true"),
			"TS YouTube Video"						=> array("setting" => "YouTube",            "file" => "youtube",           	"type" => "internal",		"active" => "true"),
			"TS YouTube Background"					=> array("setting" => "Background",         "file" => "background",        	"type" => "internal",		"active" => "true"),
			"TS Spacer / Clear"						=> array("setting" => "Spacer",             "file" => "spacer",            	"type" => "internal",		"active" => "true"),
			"GoPricing Table"						=> array("setting" => "GoPricing",          "file" => "gopricing",			"type" => "external",		"active" => "true"),
			"QuForm"								=> array("setting" => "Quform",             "file" => "quform",             "type" => "external",		"active" => "true"),
			"Demos"									=> array("setting" => "Demos",             	"file" => "demos",             	"type" => "demos",			"active" => "true"),
		);

		public $TS_VCSC_List_Icons_Awesome			= array();
		public $TS_VCSC_List_Icons_Brankic			= array();
		public $TS_VCSC_List_Icons_Countricons		= array();
		public $TS_VCSC_List_Icons_Currencies		= array();
		public $TS_VCSC_List_Icons_Elegant			= array();
		public $TS_VCSC_List_Icons_Entypo			= array();
		public $TS_VCSC_List_Icons_Foundation		= array();
		public $TS_VCSC_List_Icons_Genericons		= array();
		public $TS_VCSC_List_Icons_IcoMoon			= array();
		public $TS_VCSC_List_Icons_Monuments		= array();
		public $TS_VCSC_List_Icons_SocialMedia		= array();
		public $TS_VCSC_List_Icons_Typicons			= array();
		public $TS_VCSC_List_Icons_Custom			= array();
		
		public $TS_VCSC_tinymceAwesomeCount			= '';
		public $TS_VCSC_tinymceBrankicCount			= '';
		public $TS_VCSC_tinymceCountriconsCount		= '';
		public $TS_VCSC_tinymceCurrenciesCount		= '';
		public $TS_VCSC_tinymceElegantCount			= '';
		public $TS_VCSC_tinymceEntypoCount			= '';
		public $TS_VCSC_tinymceFoundationCount		= '';
		public $TS_VCSC_tinymceGenericonsCount		= '';
		public $TS_VCSC_tinymceIcoMoonCount			= '';
		public $TS_VCSC_tinymceMonumentsCount		= '';
		public $TS_VCSC_tinymceSocialMediaCount		= '';
		public $TS_VCSC_tinymceTypiconsCount		= '';
		public $TS_VCSC_tinymceCustomCount			= '';
		
		public $TS_VCSC_UserDeviceType				= 'Desktop';
		public $TS_VCSC_tinymceFontsAll				= false;

		function __construct() {
			$this->assets_js 		= plugin_dir_path( __FILE__ ).'js/';
			$this->assets_css 		= plugin_dir_path( __FILE__ ).'css/';
			$this->assets_dir 		= plugin_dir_path( __FILE__ ).'assets/';
			$this->elements_dir 	= plugin_dir_path( __FILE__ ).'elements/';
			$this->shortcode_dir 	= plugin_dir_path( __FILE__ ).'shortcodes/';
			$this->plugins_dir 		= plugin_dir_path( __FILE__ ).'plugins/';
			$this->posttypes_dir 	= plugin_dir_path( __FILE__ ).'posttypes/';
			$this->templates_dir 	= plugin_dir_path( __FILE__ ).'templates/';
			$this->images_dir 		= plugin_dir_path( __FILE__ ).'images/';
			$this->fonts_dir 		= plugin_dir_path( __FILE__ ).'fonts/';
			$this->widgets_dir 		= plugin_dir_path( __FILE__ ).'widgets/';
			$this->detector_dir 	= plugin_dir_path( __FILE__ ).'detector/';
			
			// Load Class for Mobile / Desktop Detection
			// -----------------------------------------
			if ((!class_exists('TS_Mobile_Detect')) && (get_option('ts_vcsc_extend_settings_loadDetector', 1) == 1)) {
				require_once($this->detector_dir.'/Mobile_Detect.php');
			}
			if (class_exists('TS_Mobile_Detect')) {
				$TS_VCSC_Detector_Class         		= new TS_Mobile_Detect;
				$this->TS_VCSC_UserDeviceType 			= ($TS_VCSC_Detector_Class->isMobile() ? ($TS_VCSC_Detector_Class->isTablet() ? 'Tablet' : 'Mobile') : 'Desktop');
				unset($TS_VCSC_Detector_Class);
			}
			
			// Load and Initialize the Auto-Update Class
			// -----------------------------------------
			if ((get_option('ts_vcsc_extend_settings_demo', 1) == 0) && (get_option('ts_vcsc_extend_settings_extended', 0) == 0)) {
				add_action('admin_init', 				array($this, 'TS_VCSC_ActivateAutoUpdate'));
			}

			// Load Arrays of Font Settings
			// ----------------------------
			add_action('init', 							array($this, 	'TS_VCSC_IconFontArrays'), 1);
			
			// Load Arrays of Selection Items
			// ------------------------------
			require_once($this->assets_dir.'/ts_vcsc_arrays_other.php');
			
			$plugin = plugin_basename( __FILE__ );
			add_filter("plugin_action_links_$plugin", 	array($this, 	"TS_VCSC_PluginAddSettingsLink"));
			
			// Register Custom CSS and JS Inputs
			// ---------------------------------
			add_action('admin_init', 					array($this, 	'TS_VCSC_RegisterCustomCSS_Setting'));
			add_action('admin_init', 					array($this, 	'TS_VCSC_RegisterCustomJS_Setting'));
			
			// Create Custom Admin Menu for Plugin
			add_action('admin_menu', 					array($this, 	'TS_VCSC_SyncMenu'));
			
			// Function to load External Files on Back-End
			// -------------------------------------------
			add_action('admin_enqueue_scripts', 		array($this, 	'TS_VCSC_Extensions_Admin'));
			
			// Function to load External Files on Front-End
			// --------------------------------------------
			add_action('wp_enqueue_scripts', 			array($this, 	'TS_VCSC_Extensions_Front_Main'), 		999999999999999999999999999);
			add_action('wp_head', 						array($this, 	'TS_VCSC_Extensions_Front_Head'), 		8888);
			add_action('wp_footer', 					array($this, 	'TS_VCSC_Extensions_Front_Footer'), 	8888);
			
			// Add Dashboard Widget
			// --------------------
			if (get_option('ts_vcsc_extend_settings_extended', 0) == 0) {
				add_action('wp_dashboard_setup', 		array($this, 	'TS_VCSC_DashboardHelpWidget'));
			}
			
			// Create Custom Post Types
			// ------------------------
			if ((get_option('ts_vcsc_extend_settings_customTeam', 1) == 1) || (get_option('ts_vcsc_extend_settings_customTestimonial', 1) == 1) || (get_option('ts_vcsc_extend_settings_customSkillset', 1) == 1)) {
				require_once($this->posttypes_dir.'/ts_vcsc_custom_post_registration.php');
				add_action('init', 'TS_VCSC_CMBMetaBoxes', 9999);
				//require_once("meta-box-master/meta-box.php");
				if (get_option('ts_vcsc_extend_settings_customTeam', 1) == 1) {
					require_once($this->posttypes_dir.'/ts_vcsc_custom_post_team.php');
					add_action('admin_menu', 				array($this, 'TS_VCSC_Remove_MetaBoxes_Team'));
				}
				if (get_option('ts_vcsc_extend_settings_customTestimonial', 1) == 1) {
					require_once($this->posttypes_dir.'/ts_vcsc_custom_post_testimonials.php');
					add_action('admin_menu', 				array($this, 'TS_VCSC_Remove_MetaBoxes_Testimonial'));
				}
				if (get_option('ts_vcsc_extend_settings_customSkillset', 1) == 1) {
					require_once($this->posttypes_dir.'/ts_vcsc_custom_post_skillsets.php');
					add_action('admin_menu', 				array($this, 'TS_VCSC_Remove_MetaBoxes_Skillset'));
				}
			}
			
			// Load Shortcode Definitions
			// --------------------------
			foreach ($this->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
				if ($element['type'] == 'demos') {
					$this->TS_VCSC_Visual_Composer_Elements[$ElementName]['active'] = "true";
					require_once($this->shortcode_dir.'/ts_vcsc_shortcode_' . $element['file'] . '.php');
				} else if (get_option('ts_vcsc_extend_settings_custom' . $element['setting'],	1) == 1) {
					$this->TS_VCSC_Visual_Composer_Elements[$ElementName]['active'] = "true";
					if ($element['type'] == 'internal') {
						require_once($this->shortcode_dir.'/ts_vcsc_shortcode_' . $element['file'] . '.php');
					}
				} else {
					$this->TS_VCSC_Visual_Composer_Elements[$ElementName]['active'] = "false";
				}
			}
			// Load Composer Elements
			// ----------------------
			if (((get_option('ts_vcsc_extend_settings_demo', 1) == 0) && (get_option('ts_vcsc_extend_settings_licenseValid', 0) == 1)) || (get_option('ts_vcsc_extend_settings_extended', 0) == 1)) {
				add_action('init', 							array($this, 'TS_VCSC_RegisterWithComposer'), 999999999);
			}
			
			// Get Item Information from Envato
			// --------------------------------
			if (get_option('ts_vcsc_extend_settings_extended', 0) == 0) {
				add_action('init', 						'TS_VCSC_ShowInformation');
			}
			
			add_action('admin_init', 					array($this, 'TS_VCSC_ChangeDownloadsUploadDirectory'), 999);
			add_action('admin_notices', 				array($this, 'TS_VCSC_CustomPackInstalledError'));
			add_action('wp_ajax_ts_delete_custom_pack', array($this, 'TS_VCSC_DeleteCustomPack_Ajax'));
		}
		
		// Remove Metaboxes from Custom Post Types
		// ---------------------------------------
		function TS_VCSC_Remove_MetaBoxes_Team() {
			remove_meta_box('commentstatusdiv', 	'ts_team', 				'normal');
			remove_meta_box('commentsdiv', 			'ts_team', 				'normal');
		}
		function TS_VCSC_Remove_MetaBoxes_Testimonial() {
			remove_meta_box('commentstatusdiv', 	'ts_testimonials', 		'normal');
			remove_meta_box('commentsdiv', 			'ts_testimonials', 		'normal');
		}
		function TS_VCSC_Remove_MetaBoxes_Skillset() {
			remove_meta_box('commentstatusdiv', 	'ts_skillsets', 		'normal');
			remove_meta_box('commentsdiv', 			'ts_skillsets', 		'normal');
		}
		

		// Load and Initialize the Auto-Update Class
		// -----------------------------------------
		function TS_VCSC_ActivateAutoUpdate() {
			if (is_admin() && (strlen(get_option('ts_vcsc_extend_settings_license')) != 0) && (function_exists('get_plugin_data'))) {
				if ((get_option('ts_vcsc_extend_settings_licenseValid', 0) == 1) && (get_option('ts_vcsc_extend_settings_extended', 0) == 0)) {
					if (!class_exists('ts_vcsc_autoupdate')) {
						require_once ('assets/ts_vcsc_autoupdate.php');
					}
					// Define Path and Base File for Plugin
					$ts_vcsc_extend_plugin_slug 					= plugin_basename(__FILE__);
					// Get the current version
					$ts_vcsc_extend_plugin_current_version	        = TS_VCSC_GetPluginVersion();
					// Define Path to Remote Update File
					$ts_vcsc_extend_plugin_remote_path 		        = '#';
					// Initialize Update Check
					$ts_vcsc_extend_plugin_class 					= new ts_vcsc_autoupdate($ts_vcsc_extend_plugin_current_version, $ts_vcsc_extend_plugin_remote_path, $ts_vcsc_extend_plugin_slug);
					// Retrieve Newest Plugin Version Number
					$ts_vcsc_extend_plugin_latest_version 	        = $ts_vcsc_extend_plugin_class->getRemote_version();
					// Save Current and Latest Version in WordPress Options
					update_option('ts_vcsc_extend_settings_versionCurrent', 		$ts_vcsc_extend_plugin_current_version);
					update_option('ts_vcsc_extend_settings_versionLatest', 			$ts_vcsc_extend_plugin_latest_version);
				}
			}
		}

		
		// Declare Arrays with Icon Font Data
		// ----------------------------------
		function TS_VCSC_IconFontArrays() {
			// Define Arrays for Font Icons
			// ----------------------------
			$this->TS_VCSC_Active_Icon_Fonts          = 0;
			$this->TS_VCSC_Active_Icon_Count          = 0;
			$this->TS_VCSC_Total_Icon_Count           = 0;
			$this->TS_VCSC_Default_Icon_Fonts         = "";

			// Define Global Font Arrays
			$this->TS_VCSC_Icons_Blank = array(
				''                              => '',
			);
			$this->TS_VCSC_Fonts_Blank = array(
				'All Fonts'                     => '',
			);

			$this->TS_VCSC_List_Icons_Full            = $this->TS_VCSC_Icons_Blank;
			
			$this->TS_VCSC_List_Active_Fonts          = array();
			$this->TS_VCSC_List_Select_Fonts          = $this->TS_VCSC_Fonts_Blank;
			
			$this->TS_VCSC_List_Initial_Icons         = $this->TS_VCSC_Icons_Blank;
			
			$this->TS_VCSC_Name_Initial_Font          = "";
			$this->TS_VCSC_Class_Initial_Font         = "";
			
			foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
				if ($iconfont != 'Custom') {
					// Check if Font is enabled
					$this->{'TS_VCSC_tinymce' . $iconfont . ''}               = get_option('ts_vcsc_extend_settings_tinymce' . $iconfont,    1);
					//echo $Icon_Font . ' / ' . $this->{'TS_VCSC_tinymce' . $iconfont . ''};
					
					// Load Font Arrays
					if (!isset($this->{'TS_VCSC_Icons_' . $iconfont . ''})) {
						require_once($this->assets_dir.('ts_vcsc_font_' . strtolower($iconfont) . '.php'));
					}
					
					// Count Icons in Font
					$this->{'TS_VCSC_tinymce' . $iconfont . 'Count'}          = count(array_unique($this->{'TS_VCSC_Icons_' . $iconfont . ''}));
					//echo $Icon_Font . ' / ' . count(array_unique($this->{'TS_VCSC_Icons_' . $iconfont . ''}));
					
					// Add Font Icons to Global Arrays
					if (($this->{'TS_VCSC_tinymce' . $iconfont . ''} == 0) && ($this->TS_VCSC_tinymceFontsAll == false)) {
						$this->{'TS_VCSC_List_Icons_' . $iconfont . ''}       = array();
					} else {
						$this->TS_VCSC_Active_Icon_Fonts++;
						$this->TS_VCSC_List_Active_Fonts[$Icon_Font] = $iconfont;
						$this->{'TS_VCSC_List_Icons_' . $iconfont . ''}       = $this->{'TS_VCSC_Icons_' . $iconfont . ''};
						uksort($this->{'TS_VCSC_List_Icons_' . $iconfont . ''}, "TS_VCSC_CaseInsensitiveSort");
						$this->TS_VCSC_Active_Icon_Count  = $this->TS_VCSC_Active_Icon_Count + $this->{'TS_VCSC_tinymce' . $iconfont . 'Count'};
						if ($this->TS_VCSC_Active_Icon_Fonts == 1) {
							$this->TS_VCSC_List_Initial_Icons 	= $this->TS_VCSC_List_Initial_Icons + $this->{'TS_VCSC_List_Icons_' . $iconfont . ''};
							$this->TS_VCSC_Name_Initial_Font 	= $Icon_Font;
							$this->TS_VCSC_Class_Initial_Font 	= $iconfont;
						}
					}
					
					$this->TS_VCSC_List_Icons_Full        		= $this->TS_VCSC_List_Icons_Full + $this->{'TS_VCSC_List_Icons_' . $iconfont . ''};
					$this->TS_VCSC_Total_Icon_Count       		= $this->TS_VCSC_Total_Icon_Count + $this->{'TS_VCSC_tinymce' . $iconfont . 'Count'};
				}
			}
			
			// Add Custom Font Icons to Global Arrays (if enabled)
			if (get_option('ts_vcsc_extend_settings_tinymceCustom', 0) == 1) {
				$this->TS_VCSC_Icons_Custom           			= get_option('ts_vcsc_extend_settings_tinymceCustomArray');
			} else {
				$this->TS_VCSC_Icons_Custom          			= array();
			}
			if (get_option('ts_vcsc_extend_settings_tinymceCustom', 0) == 1) {
				$this->TS_VCSC_Active_Icon_Fonts++;
				$this->TS_VCSC_List_Active_Fonts['Custom User Font'] = 'Custom';
				$this->TS_VCSC_List_Icons_Custom          		= $this->TS_VCSC_Icons_Custom;
				$this->TS_VCSC_tinymceCustomCount         		= count(array_unique($this->TS_VCSC_Icons_Custom));
				$this->TS_VCSC_Total_Icon_Count           		= $this->TS_VCSC_Total_Icon_Count + $this->TS_VCSC_tinymceCustomCount;
				$this->TS_VCSC_Active_Icon_Count          		= $this->TS_VCSC_Active_Icon_Count + $this->TS_VCSC_tinymceCustomCount;
				if ($this->TS_VCSC_Active_Icon_Fonts == 1) {
					$this->TS_VCSC_List_Initial_Icons     		= $this->TS_VCSC_List_Initial_Icons + $this->TS_VCSC_List_Icons_Custom;
					$this->TS_VCSC_Name_Initial_Font      		= 'Custom User Font';
					$this->TS_VCSC_Class_Initial_Font     		= 'Custom';
				}
			}
			
			$this->TS_VCSC_List_Select_Fonts          			= $this->TS_VCSC_List_Select_Fonts + $this->TS_VCSC_List_Active_Fonts;
		}
		
		
		// Add additional "Settings" Link to Plugin Listing Page
		// -----------------------------------------------------
		function TS_VCSC_PluginAddSettingsLink($links) {
			$settings_link = '<a href="admin.php?page=TS_VCSC_Extender">Settings</a>';
			array_push($links, $settings_link);
			return $links;
		}
		
		
		// Register Custom CSS and JS Inputs
		// ---------------------------------
		function TS_VCSC_RegisterCustomCSS_Setting() {
			register_setting('ts_vcsc_extend_custom_css', 	'ts_vcsc_extend_custom_css', 	    	array($this, 'TS_VCSC_CustomCSS_Validation'));
		}
		function TS_VCSC_RegisterCustomJS_Setting() {
			register_setting('ts_vcsc_extend_custom_js', 	'ts_vcsc_extend_custom_js',          	array($this, 'TS_VCSC_CustomJS_Validation'));
		}
		function TS_VCSC_CustomCSS_Validation($input) {
			if (!empty($input['ts_vcsc_extend_custom_css'])) {
				$input['ts_vcsc_extend_custom_css'] = trim( $input['ts_vcsc_extend_custom_css'] );
			}
			return $input;
		}
		function TS_VCSC_CustomJS_Validation($input) {
			if (!empty($input['ts_vcsc_extend_custom_js'])) {
				$input['ts_vcsc_extend_custom_js'] = trim( $input['ts_vcsc_extend_custom_js'] );
			}
			return $input;
		}
		function TS_VCSC_DisplayCustomCSS() {
			if ((get_option('ts_vcsc_extend_settings_demo', 1) == 0) || (get_option('ts_vcsc_extend_settings_extended', 0) == 1)) {
				$ts_vcsc_extend_custom_css = 				get_option('ts_vcsc_extend_custom_css');
				$ts_vcsc_extend_custom_css_default =		get_option('ts_vcsc_extend_settings_customCSS');
				if ((!empty($ts_vcsc_extend_custom_css)) && ($ts_vcsc_extend_custom_css != $ts_vcsc_extend_custom_css_default)) {
					echo '<style type="text/css" media="all">' . "\n";
					echo '/* Custom CSS for Visual Composer Extensions WP */' . "\n";
					echo $ts_vcsc_extend_custom_css . "\n";
					echo '</style>' . "\n";
				}
			}
		}
		function TS_VCSC_DisplayCustomJS() {
			if ((get_option('ts_vcsc_extend_settings_demo', 1) == 0) || (get_option('ts_vcsc_extend_settings_extended', 0) == 1)) {
				$ts_vcsc_extend_custom_js = 				get_option('ts_vcsc_extend_custom_js');
				$ts_vcsc_extend_custom_js_default = 		get_option('ts_vcsc_extend_settings_customJS');
				if ((!empty($ts_vcsc_extend_custom_js)) && ($ts_vcsc_extend_custom_js != $ts_vcsc_extend_custom_js_default)) {
					echo '<script type="text/javascript">' . "\n";
					echo '(function ($) {' . "\n";
					echo '/* Custom JS for Visual Composer Extensions WP */' . "\n";
					echo $ts_vcsc_extend_custom_js . "\n";
					echo '})(jQuery);' . "\n";
					echo '</script>' . "\n";
				}
			}
		}
		
		
		// Create Custom Admin Menu for Plugin
		function TS_VCSC_SyncMenu() {
			if ((get_option('ts_vcsc_extend_settings_licenseValid', 0) == 1) || (get_option('ts_vcsc_extend_settings_extended', 0) == 1)) {
				update_option('ts_vcsc_extend_settings_demo', 0);
			} else {
				update_option('ts_vcsc_extend_settings_demo', 1);
			}
			global $ts_vcsc_main_page;
			global $ts_vcsc_settings_page;
			global $ts_vcsc_upload_page;
			global $ts_vcsc_preview_page;
			global $ts_vcsc_customCSS_page;
			global $ts_vcsc_customJS_page;
			global $ts_vcsc_license_page;
			global $ts_vcsc_team_page;
			add_action('admin_enqueue_scripts', array($this, 'TS_VCSC_AdminScripts'));
			$ts_vcsc_main_page = 		        	add_menu_page( 		                        "VC Extensions",    "VC Extensions",    'ts_vcsc_extend', 	'TS_VCSC_Extender', 	array($this, 'TS_VCSC_PageExtend'), 	    TS_VCSC_GetResourceURL('images/TS_VCSC_Menu_Icon_16x16.png'));
			$ts_vcsc_settings_page = 				add_submenu_page( 	'TS_VCSC_Extender', 	"Settings",         "Settings",         'ts_vcsc_extend', 	'TS_VCSC_Extender', 	array($this, 'TS_VCSC_PageExtend'));
			$ts_vcsc_upload_page = 					add_submenu_page( 	'TS_VCSC_Extender', 	"Import Font",      "Import Font",      'ts_vcsc_extend', 	'TS_VCSC_Uploader', 	array($this, 'TS_VCSC_PageUpload'));
			$ts_vcsc_preview_page = 				add_submenu_page( 	'TS_VCSC_Extender', 	"Icon Previews",    "Icon Previews",    'ts_vcsc_extend', 	'TS_VCSC_Previews', 	array($this, 'TS_VCSC_PagePreview'));
			if (current_user_can('manage_options')) {
				$ts_vcsc_customCSS_page =			add_submenu_page( 	'TS_VCSC_Extender', 	"Custom CSS", 	    "Custom CSS",       'ts_vcsc_extend', 	'TS_VCSC_CSS', 			array($this, 'TS_VCSC_PageCustomCSS'));
				$ts_vcsc_customJS_page =			add_submenu_page( 	'TS_VCSC_Extender', 	"Custom JS", 	    "Custom JS",        'ts_vcsc_extend', 	'TS_VCSC_JS', 			array($this, 'TS_VCSC_PageCustomJS'));
				if (get_option('ts_vcsc_extend_settings_extended', 0) == 0) {
					$ts_vcsc_license_page =			add_submenu_page( 	'TS_VCSC_Extender', 	"License Key", 	    "License Key",      'ts_vcsc_extend', 	'TS_VCSC_License', 		array($this, 'TS_VCSC_PageLicense'));
				}
			}
		}
		function TS_VCSC_AdminScripts($hook_suffix) {  
			global $ts_vcsc_main_page;
			global $ts_vcsc_settings_page;
			global $ts_vcsc_upload_page;
			global $ts_vcsc_preview_page;
			global $ts_vcsc_customCSS_page;
			global $ts_vcsc_customJS_page;
			global $ts_vcsc_license_page;
			$url = plugin_dir_url( __FILE__ );
			if (( $ts_vcsc_main_page == $hook_suffix ) || ( $ts_vcsc_settings_page == $hook_suffix ) || ( $ts_vcsc_upload_page == $hook_suffix ) || ( $ts_vcsc_preview_page == $hook_suffix ) || ( $ts_vcsc_customCSS_page == $hook_suffix ) || ( $ts_vcsc_customJS_page == $hook_suffix ) || ( $ts_vcsc_license_page == $hook_suffix )) {
				if (!wp_script_is('jquery')) {
					wp_enqueue_script('jquery');
				}
				if (get_option('ts_vcsc_extend_settings_popups') == 1) {
					wp_enqueue_style('ts-extend-qtip',							$url.'css/jquery.qtip.css', null, false, 'all');
					wp_enqueue_script('ts-extend-qtip',							$url.'js/jquery.qtip.min.js', array('jquery'), false, true);
				}
				if ($ts_vcsc_settings_page == $hook_suffix) {
					wp_enqueue_script('ts-extend-dragsort',						$url.'js/jquery.dragsort.js', array('jquery'), false, true);
					wp_enqueue_style('ts-visual-composer-extend-admin',			$url.'css/ts-visual-composer-extend-admin.min.css', null, false, 'all');
				}
				if ($ts_vcsc_upload_page == $hook_suffix) {
					if (get_option('ts_vcsc_extend_settings_tinymceCustomPath', '') != '') {
						$Custom_Font_CSS = get_option('ts_vcsc_extend_settings_tinymceCustomPath', '');
						wp_enqueue_style('ts-font-customvcsc', $Custom_Font_CSS, null, false, 'all');
					}
					wp_enqueue_style('ts-visual-composer-extend-admin',			$url.'css/ts-visual-composer-extend-admin.min.css', null, false, 'all');
					wp_enqueue_script('ts-visual-composer-extend-admin',		$url.'js/ts-visual-composer-extend-admin.min.js', array('jquery'), false, true);
				}
				if (($ts_vcsc_upload_page == $hook_suffix) || ($ts_vcsc_preview_page == $hook_suffix)) {
					wp_enqueue_style('ts-extend-dropdown', 						$url.'css/jquery.dropdown.css', null, false, 'all');
					wp_enqueue_script('ts-extend-dropdown', 					$url.'js/jquery.dropdown.min.js', array('jquery'), '3.8', true);
					wp_enqueue_script('ts-extend-freewall', 					$url.'js/jquery.freewall.min.js', array('jquery'), '3.8', true);
				}
				wp_enqueue_style('ts-vcsc-extend',                              $url.'css/ts-visual-composer-extend-settings.min.css', null, false, 'all');
				wp_enqueue_style('ts-extend-messi', 				        	$url.'css/jquery.messi.css', null, false, 'all');
				wp_enqueue_script('ts-extend-messi',                            $url.'js/jquery.messi.min.js', array('jquery'), false, true);
				wp_enqueue_style('ts-extend-uitotop', 							$url.'css/jquery.ui.totop.css', null, false, 'all');
				wp_enqueue_script('ts-extend-uitotop', 							$url.'js/jquery.ui.totop.min.js', array('jquery'), '3.8', true);
				wp_enqueue_script('jquery-easing', 								$url.'js/jquery.easing.js', array('jquery'), '3.8', true);
				wp_enqueue_script('ts-vcsc-extend', 							$url.'js/ts-visual-composer-extend-settings.min.js', array('jquery'), '3.8', true);
				wp_enqueue_script('validation-engine', 							$url.'js/jquery.validationEngine.min.js', array('jquery'), '3.6', true);
				wp_enqueue_style('validation-engine',							$url.'css/jquery.validationEngine.css', null, '3.6', 'all');
				wp_enqueue_script('validation-engine-en', 						$url.'js/jquery.validationEngine-en.js', array('jquery'), '3.6', true);
			}
			if (($ts_vcsc_preview_page == $hook_suffix)) {
				foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
					if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 0) == 1) && ($iconfont != "Custom")) {
						wp_enqueue_style('ts-font-' . strtolower($iconfont),		$url.'css/ts-font-' . strtolower($iconfont) . '.css', null, false, 'all');
					} else if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 0) == 1) && ($iconfont == "Custom")) {
						$Custom_Font_CSS = get_option('ts_vcsc_extend_settings_tinymceCustomPath', '');
						wp_enqueue_style('ts-font-' . strtolower($iconfont) . 'vcsc', $Custom_Font_CSS, null, false, 'all');
					}
				}
				wp_enqueue_style('ts-visual-composer-extend-admin',				$url.'css/ts-visual-composer-extend-admin.min.css', null, false, 'all');
				wp_enqueue_script('ts-visual-composer-extend-admin',			$url.'js/ts-visual-composer-extend-admin.min.js', array('jquery'), false, true);
			}
			if (($ts_vcsc_customCSS_page == $hook_suffix) || ($ts_vcsc_customJS_page == $hook_suffix)) {
				wp_enqueue_script('ace_code_highlighter_js', 	                $url.'assets/ACE/ace.js', '', false, true );
			}
			if ($ts_vcsc_customCSS_page == $hook_suffix) {
				wp_enqueue_script('ace_mode_css',                               $url.'assets/ACE/mode-css.js', array('ace_code_highlighter_js'), false, true );
				wp_enqueue_script('custom_css_js', 		                		$url.'assets/ACE/custom-css.js', array( 'jquery', 'ace_code_highlighter_js' ), false, true );
			}
			if ($ts_vcsc_customJS_page == $hook_suffix) {
				wp_enqueue_script('ace_mode_js',                                $url.'assets/ACE/mode-javascript.js', array('ace_code_highlighter_js'), false, true );
				wp_enqueue_script('custom_js_js',                               $url.'assets/ACE/custom-js.js', array( 'jquery', 'ace_code_highlighter_js' ), false, true );
			}
		}
		// Function to load External Files on Back-End when Editing
		// --------------------------------------------------------
		function TS_VCSC_Extensions_Admin() {
			global $pagenow, $typenow;
			$screen = get_current_screen();
			if (empty($typenow) && !empty($_GET['post'])) {
				$post 		= get_post($_GET['post']);
				$typenow 	= $post->post_type;
			}
			$url = plugin_dir_url( __FILE__ );
			if (TS_VCSC_IsEditPagePost()) {
				foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
					if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 0) == 1) && ($iconfont != "Custom")) {
						wp_enqueue_style('ts-font-' . strtolower($iconfont),		$url.'css/ts-font-' . strtolower($iconfont) . '.css', null, false, 'all');
					} else if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 0) == 1) && ($iconfont == "Custom")) {
						$Custom_Font_CSS = get_option('ts_vcsc_extend_settings_tinymceCustomPath', '');
						wp_enqueue_style('ts-font-' . strtolower($iconfont) . 'vcsc', $Custom_Font_CSS, null, false, 'all');
					}
				}
				wp_enqueue_style('ts-extend-nouislider',							$url.'css/jquery.nouislider.css', null, false, 'all');
				wp_enqueue_style('ts-extend-multiselect',							$url.'css/jquery.multi.select.css', null, false, 'all');
				wp_enqueue_style('ts-visual-composer-extend-admin',             	$url.'css/ts-visual-composer-extend-admin.min.css', null, false, 'all');
				wp_enqueue_script('ts-extend-nouislider',							$url.'js/jquery.nouislider.min.js', array('jquery'), false, true);
				wp_enqueue_script('ts-extend-multiselect',							$url.'js/jquery.multi.select.min.js', array('jquery'), false, true);
				wp_enqueue_script('ts-extend-switch',								$url.'js/jquery.toggles.min.js', array('jquery'), false, true);
				wp_enqueue_script('ts-extend-picker',								$url.'js/jquery.datetimepicker.min.js', array('jquery'), false, true);
				wp_enqueue_script('ts-visual-composer-extend-admin',            	$url.'js/ts-visual-composer-extend-admin.min.js', array('jquery'), false, true);
			} else {
				wp_enqueue_style('ts-visual-composer-extend-admin',             	$url.'css/ts-visual-composer-extend-admin.min.css', null, false, 'all');
			}
		}
		function TS_VCSC_PageExtend() {
			if ((current_user_can('ts_vcsc_extend')) || (current_user_can('manage_options'))) {
				echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame">' . "\n";
				echo '<div id="ts_vcsc_extend_icon_settings" class="ts_vcsc_extend_icon"></div><h2>Visual Composer Extensions - Settings</h2>' . "\n";
				include('assets/ts_vcsc_settings_main.php');
				echo '</div>' . "\n";
				echo '</div>' . "\n";
			} else {
				wp_die('You do not have sufficient permissions to access this page.');
			}
		}
		function TS_VCSC_PageUpload() {
			if ((current_user_can('ts_vcsc_extend')) || (current_user_can('manage_options'))) {
				echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame">' . "\n";
				echo '<div id="ts_vcsc_extend_icon_settings" class="ts_vcsc_extend_icon"></div><h2>Visual Composer Extensions - Upload Font</h2>' . "\n";
				include('assets/ts_vcsc_upload.php');
				echo '</div>' . "\n";
				echo '</div>' . "\n";
			} else {
				wp_die('You do not have sufficient permissions to access this page.');
			}
		}
		function TS_VCSC_PagePreview() {
			if ((current_user_can('ts_vcsc_extend')) || (current_user_can('manage_options'))) {
				echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame">' . "\n";
				echo '<div id="ts_vcsc_extend_icon_settings" class="ts_vcsc_extend_icon"></div><h2>Visual Composer Extensions - Icon Previews</h2>' . "\n";
				include('assets/ts_vcsc_previews.php');
				echo '</div>' . "\n";
				echo '</div>' . "\n";
			} else {
				wp_die('You do not have sufficient permissions to access this page.');
			}
		}
		function TS_VCSC_PageCustomCSS() {
			if ((current_user_can('ts_vcsc_extend')) || (current_user_can('manage_options'))) {
				// Get Stored Custom CSS; otherwise assign Default Message
				$ts_vcsc_extend_custom_css_default = get_option('ts_vcsc_extend_settings_customCSS');
				if ((get_option('ts_vcsc_extend_settings_demo', 1) == 1) && (get_option('ts_vcsc_extend_settings_extended', 0) == 0)) {
					$ts_vcsc_extend_custom_css 	= $ts_vcsc_extend_custom_css_default;
				} else {
					$ts_vcsc_extend_custom_css 	= get_option('ts_vcsc_extend_custom_css', $ts_vcsc_extend_custom_css_default);
				}
				if (empty($ts_vcsc_extend_custom_css)) {
					$ts_vcsc_extend_custom_css	= $ts_vcsc_extend_custom_css_default;
				}
				if (isset($_GET['settings-updated']) && $_GET['settings-updated']) {
					echo "\n";
					echo "<script type='text/javascript'>" . "\n";
						if ((get_option('ts_vcsc_extend_settings_demo', 1) == 1) && (get_option('ts_vcsc_extend_settings_extended', 0) == 0)) {
							echo 'var VC_Extension_Demo = true;' . "\n";
						} else {
							echo 'var VC_Extension_Demo = false;' . "\n";
						}
						echo "var CustomCSSAdded = true;" . "\n";
					echo "</script>" . "\n";
				} else {
					echo '<script type="text/javascript">' . "\n";
						if ((get_option('ts_vcsc_extend_settings_demo', 1) == 1) && (get_option('ts_vcsc_extend_settings_extended', 0) == 0)) {
								echo 'var VC_Extension_Demo = true;' . "\n";
						} else {
								echo 'var VC_Extension_Demo = false;' . "\n";
						}
						echo 'var CustomCSSAdded = false;' . "\n";
					echo '</script>' . "\n";
				}
				?>
				<div class="wrap ts-settings" id="ts_vcsc_extend_frame">
					<div id="ts_vcsc_extend_icon_css" class="ts_vcsc_extend_icon"></div><h2>Visual Composer Extensions - Custom CSS</h2>
					<table>
						<tr style="height: 75px; width: 100%;">
							<td>
								<p style="text-align: justify;">In order to adjust the Gallery CSS to your Theme, please use the Custom CSS Editor below and do not change the CSS file that comes with the
								plugin. Direct changes to the CSS file will be lost after each update but the Custom CSS entered here will be stored in the WordPress Database and will remain after each
								update.</p>
								<p style="text-align: justify; font-weight: bold;">While the Editor will do some basic checking, you are responsible to ensure that all code has been entered correctly.</p>
							</td>
						</tr>
					</table>
					<table>
						<tr>
							<td colspan="2"><p style="margin-top: 0px;">The plugin will automatically wrap the code in ...<br/></td>
						</tr>
						<tr>
							<td style="width: 80px;"><img style='float: left; width: 75px; height: 75px;' src='<?php echo TS_VCSC_GetResourceURL('images/settings-custom-css.png'); ?>' height='75' width='75'></td>
							<td>
								<p>
									<code style="text-align: left;">
										&#60;style&#62;<br/>
											<span style="margin-left: 20px;">... Your Custom CSS ...</span><br/>
										&#60;/style&#62;
									</code>
								</p>
							</td>
						</tr>
						<tr>
							<td colspan="2"><p style="margin-top: 0px;">... so please don't add these lines to the editor; otherwise your code will fail.</td>
						</tr>
					</table>
			
					<?php
						if ((get_option('ts_vcsc_extend_settings_demo', 1) == 1) && (get_option('ts_vcsc_extend_settings_extended', 0) == 0)) {
							echo '<div class="clearFixMe" style="font-weight: bold; text-align: justify; color: red; padding-bottom: 10px;">This is a Demoversion of the Visual Composer Extensions Plugin. Changes to the Custom CSS will not be reflected on the Frontend.</div>';
						}
						if (isset($_GET['settings-updated']) && $_GET['settings-updated']) {
							//echo '<div id="message" class="updated"><p><strong>Custom CSS has been updated.</strong></p></div>';
							//ts_fb_showMessage("Custom CSS has been successfully saved.", false, true);
						}
					?>
			
					<hr class='style-two' style='margin: 0px auto;'>
			
					<form id="ts_vcsc_extend_custom_css_form" method="post" action="options.php" style="margin-top: 15px;">
						<span class="submit">
							<input style="margin: 0px;" title="Click here to save Custom CSS Settings" class="button-primary ButtonSubmit <?php ((get_option('ts_vcsc_extend_settings_popups') == 1) ? "TS_Tooltip" : "") ?>" type="submit" name="Submit" value="<?php _e('Save Custom CSS', 'oscimp_trdom') ?>" />
						</span>
						<?php settings_fields('ts_vcsc_extend_custom_css'); ?>
						<div id="ts_fb_custom_css_container">
							<div id="ts_vcsc_extend_custom_css" name="ts_vcsc_extend_custom_css"></div>
						</div>
						<textarea id="ts_vcsc_extend_custom_css_textarea" name="ts_vcsc_extend_custom_css" style="display: none;"><?php echo $ts_vcsc_extend_custom_css; ?></textarea>
						<span class="submit">
							<input style="margin: 0px;" title="Click here to save Custom CSS Settings" class="button-primary ButtonSubmit <?php ((get_option('ts_vcsc_extend_settings_popups') == 1) ? "TS_Tooltip" : "") ?>"" type="submit" name="Submit" value="<?php _e('Save Custom CSS', 'oscimp_trdom') ?>" />
						</span>
					</form>
				</div>
				<?php
			} else {
				wp_die('You do not have sufficient permissions to access this page.');
			}
		}
		function TS_VCSC_PageCustomJS() {
			if ((current_user_can('ts_vcsc_extend')) || (current_user_can('manage_options'))) {
				// Get Stored Custom JS; otherwise assign Default Message
				$ts_vcsc_extend_custom_js_default = get_option('ts_vcsc_extend_settings_customJS');
				if ((get_option('ts_vcsc_extend_settings_demo', 1) == 1) && (get_option('ts_vcsc_extend_settings_extended', 0) == 0)) {
					$ts_vcsc_extend_custom_js = $ts_vcsc_extend_custom_js_default;
				} else {
					$ts_vcsc_extend_custom_js = get_option('ts_vcsc_extend_custom_js', $ts_vcsc_extend_custom_js_default);
				}
				if (empty($ts_vcsc_extend_custom_js)) {
					$ts_vcsc_extend_custom_js	= $ts_vcsc_extend_custom_js_default;
				}
				if (isset($_GET['settings-updated']) && $_GET['settings-updated']) {
					echo "\n";
					echo "<script type='text/javascript'>" . "\n";
						if ((get_option('ts_vcsc_extend_settings_demo', 1) == 1) && (get_option('ts_vcsc_extend_settings_extended', 0) == 0)) {
							echo 'var VC_Extension_Demo = true;' . "\n";
						} else {
							echo 'var VC_Extension_Demo = false;' . "\n";
						}
						echo "var CustomJSAdded = true;" . "\n";
					echo "</script>" . "\n";
				} else {
					echo '<script type="text/javascript">' . "\n";
						if ((get_option('ts_vcsc_extend_settings_demo', 1) == 1) && (get_option('ts_vcsc_extend_settings_extended', 0) == 0)) {
								echo 'var VC_Extension_Demo = true;' . "\n";
						} else {
								echo 'var VC_Extension_Demo = false;' . "\n";
						}
						echo 'var CustomJSAdded = false;' . "\n";
					echo '</script>' . "\n";
				}
				?>
				<div class="wrap ts-settings" id="ts_vcsc_extend_frame">
					<div id="ts_vcsc_extend_icon_js" class="ts_vcsc_extend_icon"></div><h2>Visual Composer Extensions - Custom JS</h2>
						<table>
							<tr>
								<td style="height: 75px; width: 100%;">
									<p style="text-align: justify;">In order to add some custom JavaScript Code to the Gallery (i.e. for custom lightbox, etc.), please use the Custom JS Editor below and do not
									change the JS files that comes with the plugin. Direct changes to the JS files will be lost after each update but the Custom JS entered here will be stored in the WordPress
									Database and will remain after each update.</p>
									<p style="text-align: justify; font-weight: bold;">While the Editor will do some basic checking, you are responsible to ensure that all code has been entered correctly.</p>
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<td colspan="2"><p style="margin-top: 0px;">The plugin will automatically wrap the code in ...<br/></td>
							</tr>
							<tr>
								<td style="width: 80px;"><img style='float: left; width: 75px; height: 75px;' src='<?php echo TS_VCSC_GetResourceURL('images/settings-custom-js.png'); ?>' height='75' width='75'></td>
								<td>
									<p>
										<code style="text-align: left;">
											&#60;script type="text/javascript"&#62;<br/>
											<span style="margin-left: 20px;">(function ($) {</span><br/>
												<span style="margin-left: 40px;">... Your Custom JS ...</span><br/>
											<span style="margin-left: 20px;">})(jQuery);</span><br/>
											&#60;/script&#62;
										</code>
									</p>
								</td>
							</tr>
							<tr>
								<td colspan="2"><p style="margin-top: 0px;">... so please don't add these lines to the editor; otherwise your code will fail. You can also use jQuery for your custom code.</td>
							</tr>
						</table>
			
					<?php
						if ((get_option('ts_vcsc_extend_settings_demo', 1) == 1) && (get_option('ts_vcsc_extend_settings_extended', 0) == 0)) {
							echo '<div class="clearFixMe" style="font-weight: bold; text-align: justify; color: red; padding-bottom: 10px;">This is a Demoversion of the Visual Composer Extensions WP Plugin. Changes to the Custom JS will not be reflected on the Frontend.</div>';
						}
						if (isset($_GET['settings-updated']) && $_GET['settings-updated']) {
							//echo '<div id="message" class="updated"><p><strong>Custom JS has been updated.</strong></p></div>';
							//ts_fb_showMessage("Custom JS has been successfully saved.", false, true);
						}
					?>
			
					<hr class='style-two' style='margin: 0px auto;'>
			
					<form id="ts_vcsc_extend_custom_js_form" method="post" action="options.php" style="margin-top: 15px;">
						<span class="submit">
							<input style="margin: 0px;" title="Click here to save Custom JS Settings" class="button-primary ButtonSubmit <?php ((get_option('ts_vcsc_extend_settings_popups') == 1) ? "TS_Tooltip" : "") ?>"" type="submit" name="Submit" value="<?php _e('Save Custom JS', 'oscimp_trdom') ?>" />
						</span>
						<?php settings_fields('ts_vcsc_extend_custom_js'); ?>
						<div id="ts_vcsc_extend_custom_js_container">
							<div id="ts_vcsc_extend_custom_js" name="ts_vcsc_extend_custom_js"></div>
						</div>
						<textarea id="ts_vcsc_extend_custom_js_textarea" name="ts_vcsc_extend_custom_js" style="display: none;"><?php echo $ts_vcsc_extend_custom_js; ?></textarea>
						<span class="submit">
							<input style="margin: 0px;" title="Click here to save Custom JS Settings" class="button-primary ButtonSubmit <?php ((get_option('ts_vcsc_extend_settings_popups') == 1) ? "TS_Tooltip" : "") ?>"" type="submit" name="Submit" value="<?php _e('Save Custom JS', 'oscimp_trdom') ?>" />
						</span>
					</form>
				</div>
				<?php
			} else {
				wp_die('You do not have sufficient permissions to access this page.');
			}
		}
		function TS_VCSC_PageLicense() {
			if ((current_user_can('ts_vcsc_extend')) || (current_user_can('manage_options'))) {
				echo '<div class="wrap ts-settings" id="ts_vcsc_extend_frame">' . "\n";
				echo '<div id="ts_vcsc_extend_icon_license" class="ts_vcsc_extend_icon"></div><h2 style="margin-bottom: 20px;">Visual Composer Extensions - Envato License Status</h2>' . "\n";
				include('assets/ts_vcsc_license.php');
				echo '</div>' . "\n";
			} else {
				wp_die('You do not have sufficient permissions to access this page.');
			}
		}
		
		
		// Function to load External Files on Front-End
		// --------------------------------------------
		function TS_VCSC_Extensions_Front_Main() {
			global $post;
			$url = plugin_dir_url( __FILE__ );
			if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
				$FOOTER = true;
			} else {
				$FOOTER = false;
			}
			// Register Scripts with WordPress
			/*wp_register_style('ts-extend-simptip', 							$url.'css/jquery.simptip.css', null, false, 'all');
			wp_register_style('ts-extend-animations', 							$url.'css/ts-visual-composer-extend-animations.min.css', null, false, 'all');
			wp_register_style('ts-visual-composer-extend-front', 				$url.'css/ts-visual-composer-extend-front.min.css', null, false, 'all');
			wp_register_script('ts-extend-modernizr',                			$url.'js/jquery.modernizr.min.js', array('jquery'), false, false);
			wp_register_script('ts-visual-composer-extend-front',				$url.'js/ts-visual-composer-extend-front.min.js', array('jquery'), false, $FOOTER);*/
			// Load Scripts As Needed
			if (!empty($post)){
				if (get_option('ts_vcsc_extend_settings_loadLightbox', 0) == 1) {
					wp_enqueue_script('ts-extend-hammer', 								$url.'js/jquery.hammer.min.js', array('jquery'), false, $FOOTER);
					wp_enqueue_script('ts-extend-nacho', 								$url.'js/jquery.nchlightbox.min.js', array('jquery'), false, $FOOTER);
					wp_enqueue_style('ts-extend-nacho',									$url.'css/jquery.nchlightbox.min.css', null, false, 'all');
				}
				if (get_option('ts_vcsc_extend_settings_loadTooltip', 0) == 1) {
					wp_enqueue_style('ts-extend-simptip',                 				$url.'css/jquery.simptip.css', null, false, 'all');
				}
				if (get_option('ts_vcsc_extend_settings_loadFonts', 0) == 1) {
					// Add CSS for each enabled Font to WordPress Admin BackEnd
					foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
						if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 0) == 1) && (get_option('ts_vcsc_extend_settings_load' . $iconfont, 0) == 1) && ($iconfont != "Custom")) {
							wp_enqueue_style('ts-font-' . strtolower($iconfont),		$url.'css/ts-font-' . strtolower($iconfont) . '.css', null, false, 'all');
						} else if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 0) == 1) && (get_option('ts_vcsc_extend_settings_load' . $iconfont, 0) == 1) && ($iconfont == "Custom")) {
							$Custom_Font_CSS = get_option('ts_vcsc_extend_settings_tinymceCustomPath', '');
							wp_enqueue_style('ts-font-' . strtolower($iconfont) . 'vcsc', $Custom_Font_CSS, null, false, 'all');
						}
					}
				}
				if ((stripos($post->post_content, '[TS-VCSC-') !== FALSE) && (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0)) { 
					// Load jQuery (if not already loaded)
					if ((get_option('ts_vcsc_extend_settings_loadjQuery', 0) == 0) && (!wp_script_is('jquery'))) {
						wp_enqueue_script('jquery');
					}
					// Load Google Charts API
					if (TS_VCSC_CheckShortcode('TS-VCSC-Google-Charts') == "true") {
						wp_enqueue_script('ts-extend-google-charts',					'https://www.google.com/jsapi', array('jquery'), false, false);
					}
					// Add CSS for each enabled Icon Font to Page
					foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
						if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 0) == 1)  && ($iconfont != "Custom")) {
							wp_enqueue_style('ts-font-' . strtolower($iconfont),		$url.'css/ts-font-' . strtolower($iconfont) . '.css', null, false, 'all');
						} else if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 0) == 1) && ($iconfont == "Custom")) {
							$Custom_Font_CSS = get_option('ts_vcsc_extend_settings_tinymceCustomPath', '');
							wp_enqueue_style('ts-font-' . strtolower($iconfont) . 'vcsc', $Custom_Font_CSS, null, false, 'all');
						}
					}
					// Load Modernizr
					if (get_option('ts_vcsc_extend_settings_loadModernizr', 1) == 1) {
						wp_enqueue_script('ts-extend-modernizr',                		$url.'js/jquery.modernizr.min.js', array('jquery'), false, false);
					}
					// Load Waypoints
					if (get_option('ts_vcsc_extend_settings_loadWaypoints', 1) == 1) {
						wp_enqueue_script('ts-extend-waypoints',                		$url.'js/jquery.waypoints.min.js', array('jquery'), false, false);
					}
					// Add Custom CSS / JS to Page
					add_action('wp_head', 		array($this, 'TS_VCSC_DisplayCustomCSS'));
					add_action('wp_footer', 	array($this, 'TS_VCSC_DisplayCustomJS'), 9999);
				} else if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 1) {
					// Load Google Charts API
					if (TS_VCSC_CheckShortcode('TS-VCSC-Google-Charts') == "true") {
						wp_enqueue_script('ts-extend-google-charts',					'https://www.google.com/jsapi', array('jquery'), false, false);
					}
					// Load Modernizr
					if (get_option('ts_vcsc_extend_settings_loadModernizr', 1) == 1) {
						wp_enqueue_script('ts-extend-modernizr',                		$url.'js/jquery.modernizr.min.js', array('jquery'), false, false);
					}
					// Load Waypoints
					if (get_option('ts_vcsc_extend_settings_loadWaypoints', 1) == 1) {
						wp_enqueue_script('ts-extend-waypoints',                		$url.'js/jquery.waypoints.min.js', array('jquery'), false, false);
					}
					// Add CSS for each enabled Icon Font to Page
					foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
						if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 0) == 1)  && ($iconfont != "Custom")) {
							wp_enqueue_style('ts-font-' . strtolower($iconfont),		$url.'css/ts-font-' . strtolower($iconfont) . '.css', null, false, 'all');
						} else if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 0) == 1) && ($iconfont == "Custom")) {
							$Custom_Font_CSS = get_option('ts_vcsc_extend_settings_tinymceCustomPath', '');
							wp_enqueue_style('ts-font-' . strtolower($iconfont) . 'vcsc', $Custom_Font_CSS, null, false, 'all');
						}
					}
					wp_enqueue_style('ts-extend-simptip',                 				$url.'css/jquery.simptip.css', null, false, 'all');
					wp_enqueue_style('ts-extend-animations',                 			$url.'css/ts-visual-composer-extend-animations.min.css', null, false, 'all');
					wp_enqueue_style('ts-visual-composer-extend-front',               	$url.'css/ts-visual-composer-extend-front.min.css', null, false, 'all');
					if (get_option('ts_vcsc_extend_settings_loadCountUp', 1) == 1) {
						wp_enqueue_script('ts-extend-countup',							$url.'js/jquery.countUp.min.js', array('jquery'), false, $FOOTER);
					}
					wp_enqueue_script('ts-extend-hammer', 								$url.'js/jquery.hammer.min.js', array('jquery'), false, $FOOTER);
					wp_enqueue_script('ts-extend-nacho', 								$url.'js/jquery.nchlightbox.min.js', array('jquery'), false, $FOOTER);
					wp_enqueue_style('ts-extend-nacho',									$url.'css/jquery.nchlightbox.min.css', null, false, 'all');
					wp_enqueue_style('ts-extend-teammate',                 				$url.'css/ts-font-teammates.css', null, false, 'all');
					wp_enqueue_script('ts-extend-circliful', 							$url.'js/jquery.circliful.min.js', array('jquery'), false, $FOOTER);
					wp_enqueue_style('ts-extend-countdown',								$url.'css/jquery.counteverest.min.css', null, false, 'all');
					wp_enqueue_script('ts-extend-countdown',							$url.'js/jquery.counteverest.min.js', array('jquery'), false, $FOOTER);
					wp_enqueue_script('ts-extend-qrcode',								$url.'js/jquery.qrcode.min.js', array('jquery'), false, $FOOTER);
					wp_enqueue_script('ts-visual-composer-extend-front',              	$url.'js/ts-visual-composer-extend-front.min.js', array('jquery'), false, $FOOTER);
					// Add custom CSS / JS to Page
					add_action('wp_head', 		array($this, 'TS_VCSC_DisplayCustomCSS'));
					add_action('wp_footer', 	array($this, 'TS_VCSC_DisplayCustomJS'), 9999);
				} else {
					// Add CSS for each enabled Font to WordPress Admin BackEnd
					foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
						if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 0) == 1) && (get_option('ts_vcsc_extend_settings_load' . $iconfont, 0) == 1) && ($iconfont != "Custom")) {
							wp_enqueue_style('ts-font-' . strtolower($iconfont),		$url.'css/ts-font-' . strtolower($iconfont) . '.css', null, false, 'all');
						} else if ((get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 0) == 1) && (get_option('ts_vcsc_extend_settings_load' . $iconfont, 0) == 1) && ($iconfont == "Custom")) {
							$Custom_Font_CSS = get_option('ts_vcsc_extend_settings_tinymceCustomPath', '');
							wp_enqueue_style('ts-font-' . strtolower($iconfont) . 'vcsc', $Custom_Font_CSS, null, false, 'all');
						}
					}
				}
			}
		}
		function TS_VCSC_Extensions_Front_Head() {
			global $post;
			if ((!empty($post)) || (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 1)){
				if ((stripos($post->post_content, '[TS-VCSC-') !== FALSE) || (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 1)) { 
					$url 		= plugin_dir_url( __FILE__ );
					$includes 	= includes_url();
					if (get_option('ts_vcsc_extend_settings_loadjQuery', 0) == 1) {
						echo '<script data-cfasync="false" type="text/javascript" src="' . $includes . 'js/jquery/jquery.js"></script>';
						echo '<script data-cfasync="false" type="text/javascript" src="' . $includes . 'js/jquery/jquery-migrate.min.js"></script>';
					}
					if (get_option('ts_vcsc_extend_settings_loadEnqueue', 1) == 0) {
						echo '<link rel="stylesheet" id="ts-extend-simptip"  href="' .							$url . 'css/jquery.simptip.css" type="text/css" media="all" />';
						echo '<link rel="stylesheet" id="ts-extend-animations"  href="' .						$url . 'css/ts-visual-composer-extend-animations.min.css" type="text/css" media="all" />';
						echo '<link rel="stylesheet" id="ts-visual-composer-extend-front"  href="' .			$url . 'css/ts-visual-composer-extend-front.min.css" type="text/css" media="all" />';
						if (get_option('ts_vcsc_extend_settings_loadHeader', 0) == 1) {
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/jquery.adipoli.min.js"></script>';
							if (get_option('ts_vcsc_extend_settings_loadModernizr', 1) == 1) {
								echo '<script data-cfasync="false" type="text/javascript" src="' .				$url . 'js/jquery.modernizr.min.js"></script>';
							}
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/ts-visual-composer-extend-front.min.js"></script>';
						}
					}
				}
			}
		}
		function TS_VCSC_Extensions_Front_Footer() {
			global $post;
			if ((!empty($post)) || (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 1)){
				if ((stripos($post->post_content, '[TS-VCSC-') !== FALSE) || (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 1)) { 
					$url 		= plugin_dir_url( __FILE__ );
					$includes 	= includes_url();
					if (get_option('ts_vcsc_extend_settings_loadEnqueue', 1) == 0) {
						if (get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0) {
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/jquery.adipoli.min.js"></script>';
							if (get_option('ts_vcsc_extend_settings_loadModernizr', 1) == 1) {
								echo '<script data-cfasync="false" type="text/javascript" src="' .				$url . 'js/jquery.modernizr.min.js"></script>';
							}
							echo '<script data-cfasync="false" type="text/javascript" src="' .					$url . 'js/ts-visual-composer-extend-front.min.js"></script>';
						}
					}
				}
			}
		}
		
		
		// Add Dashboard Widget
		// --------------------
		function TS_VCSC_DashboardHelpWidget() {
			global $wp_meta_boxes;
			wp_add_dashboard_widget('TS_VCSC_DashboardHelp', 'Visual Composer Extensions', array($this, 'TS_VCSC_DashboardHelpContent'));
		}
		function TS_VCSC_DashboardHelpContent() {
			$output = '';
			$output .= '<p><strong>Welcome to "Visual Composer Extensions"!</strong></p>';
			if ((function_exists('get_plugin_data'))) {
				$output .= '<p>Current Version: ' . TS_VCSC_GetPluginVersion();
			}
			if (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') != '') {
				$output .= '<p>Installed Fonts: ' . count($this->TS_VCSC_Installed_Icon_Fonts) . ' / Active Fonts: ' . $this->TS_VCSC_Active_Icon_Fonts . '</p>';
			} else {
				$output .= '<p>Installed Fonts: ' . (count($this->TS_VCSC_Installed_Icon_Fonts) - 1) . ' / Active Fonts: ' . $this->TS_VCSC_Active_Icon_Fonts . '</p>';
			}
			$output .= '<p>Installed Icons: ' . $this->TS_VCSC_Total_Icon_Count . ' / Active Icons: ' . $this->TS_VCSC_Active_Icon_Count . '</p>';
			$output .= '<p style="text-align: justify;">Need help? Contact the developer <a href="mailto:tekanewascripts@yahoo.com">here</a>. For the manual click <a href="http://composer.tekanewascripts.info/manual/" target="_blank">here</a>.</p>';
			echo $output;
		}

		
		// Create custom Paramater Types for Visual Composer
		// -------------------------------------------------
		
		// Function to generate param type "skillset"
		function skillset_settings_field($settings, $value) {
			$dependency     	= vc_generate_dependencies_attributes($settings);
			$param_name     	= isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           	= isset($settings['type']) ? $settings['type'] : '';
			$url            	= plugin_dir_url( __FILE__ );
			$output         	= '';
			$posts_fields 		= array();
			$categories			= '';
			$category_fields 	= array();
			$categories_count	= 0;
			$terms_slugs 		= array();
			$value_arr 			= $value;
			if (!is_array($value_arr)) {
				$value_arr = array_map('trim', explode(',', $value_arr));
			}
			if (!empty($settings['posttype']) ) {
				$args = array(
					'no_found_rows' 		=> 1,
					'ignore_sticky_posts' 	=> 1,
					'posts_per_page' 		=> -1,
					'post_type' 			=> $settings['posttype'],
					'post_status' 			=> 'publish',
					'orderby' 				=> 'title',
					'order' 				=> 'ASC',
				);
				$team_nocategory			= 0;
				$team_query = new WP_Query($args);
				if ($team_query->have_posts()) {
					foreach($team_query->posts as $p) {
						$categories = TS_VCSC_GetTheCategoryByTax($p->ID, 'ts_skillsets_category');
						if ($categories && !is_wp_error($categories)) {
							$category_slugs_arr = array();
							foreach ($categories as $category) {
								$category_slugs_arr[] = $category->slug;
								$category_data = array(
									'slug'		=> $category->slug,
									'name'		=> $category->cat_name,
									'count'		=> $category->count,
								);
								$category_fields[] = $category_data;
							}
							$categories_slug_str = join(",", $category_slugs_arr);
						} else {
							$team_nocategory++;
							$categories_slug_str = '';
						};
						$posts_fields[] = sprintf(
							'<option id="%s" class="%s" name="%s" value="%s" data-filter="false" data-id="%s" data-categories="%s" %s>%s</option>',
							$settings['param_name'] . '-' . $p->ID,
							$settings['param_name'] . ' ' . $settings['type'],
							$settings['param_name'] . '-' . $p->ID,
							$p->ID,
							$p->post_title,
							$categories_slug_str,
							selected(in_array($p->ID, $value_arr), true, false),
							$p->post_title
						);
					}
				}
				wp_reset_postdata();
			}
			
			$category_fields = array_map("unserialize", array_unique(array_map("serialize", $category_fields)));
			if (count($category_fields) > 1) {
				$output .= '<span style="font-size: 12px; margin-bottom: 10px; width: 100%; display: block;">Filter by Category:</span>';
				$output .= '<select multiple="multiple" id="' . $param_name . '_filter" data-selector="' . $param_name . '" class="ts-skillset-selector-filter">';
					if ($team_nocategory > 0) {
						$output .= '<option id="" class="" name="" data-id="" data-author="" data-category="ts-skillset-none-applied" value="ts-skillset-none-applied">No Category (' . $team_nocategory . ')</option>';
					}
					foreach ($category_fields as $index => $array) {
						$output .= '<option id="" class="" name="" data-id="" data-author="" data-category="' . $category_fields[$index]['slug'] . '" value="' . $category_fields[$index]['slug'] . '">' . $category_fields[$index]['name'] . ' (' . $category_fields[$index]['count'] . ')</option>';
					}
				$output .= '</select>';
				$output .= '<span style="font-size: 10px; margin-bottom: 20px; width: 100%; display: block;">Click on "Available Categories" to filter by category; click on "Flitered By" to remove from filter.</span>';
			}
			
			$output .= '<span style="font-size: 12px; margin-bottom: 10px; width: 100%; display: block;">Select Skillset:</span>';
			$output .= '<select name="' . $param_name . '" id="' . $param_name . '" class="ts-skillset-selector wpb-input wpb-select dropdown wpb_vc_param_value ' . $param_name . ' ' . $type . '" value=" ' . $value . '" style="margin-bottom: 20px;">';
				$output .= '<option id="" class="" name="" value="" data-filter="false" data-id="" data-categories="">Select a Skillset</option>';
				$output .= implode( $posts_fields );
			$output .= '</select>';
			return $output;
		}
		// Function to generate param type "teammate"
		function teammate_settings_field($settings, $value) {
			$dependency     	= vc_generate_dependencies_attributes($settings);
			$param_name     	= isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           	= isset($settings['type']) ? $settings['type'] : '';
			$url            	= plugin_dir_url( __FILE__ );
			$output         	= '';
			$posts_fields 		= array();
			$categories			= '';
			$category_fields 	= array();
			$categories_count	= 0;
			$terms_slugs 		= array();
			$value_arr 			= $value;
			if (!is_array($value_arr)) {
				$value_arr = array_map('trim', explode(',', $value_arr));
			}
			if (!empty($settings['posttype']) ) {
				$args = array(
					'no_found_rows' 		=> 1,
					'ignore_sticky_posts' 	=> 1,
					'posts_per_page' 		=> -1,
					'post_type' 			=> $settings['posttype'],
					'post_status' 			=> 'publish',
					'orderby' 				=> 'title',
					'order' 				=> 'ASC',
				);
				$team_nocategory			= 0;
				$team_query = new WP_Query($args);
				if ($team_query->have_posts()) {
					foreach($team_query->posts as $p) {
						$categories = TS_VCSC_GetTheCategoryByTax($p->ID, 'ts_team_category');
						if ($categories && !is_wp_error($categories)) {
							$category_slugs_arr = array();
							foreach ($categories as $category) {
								$category_slugs_arr[] = $category->slug;
								$category_data = array(
									'slug'		=> $category->slug,
									'name'		=> $category->cat_name,
									'count'		=> $category->count,
								);
								$category_fields[] = $category_data;
							}
							$categories_slug_str = join(",", $category_slugs_arr);
						} else {
							$team_nocategory++;
							$categories_slug_str = '';
						};
						$posts_fields[] = sprintf(
							'<option id="%s" class="%s" name="%s" value="%s" data-filter="false" data-id="%s" data-categories="%s" %s>%s</option>',
							$settings['param_name'] . '-' . $p->ID,
							$settings['param_name'] . ' ' . $settings['type'],
							$settings['param_name'] . '-' . $p->ID,
							$p->ID,
							$p->post_title,
							$categories_slug_str,
							selected(in_array($p->ID, $value_arr), true, false),
							$p->post_title
						);
					}
				}
				wp_reset_postdata();
			}
			
			$category_fields = array_map("unserialize", array_unique(array_map("serialize", $category_fields)));
			if (count($category_fields) > 1) {
				$output .= '<span style="font-size: 12px; margin-bottom: 10px; width: 100%; display: block;">Filter by Category:</span>';
				$output .= '<select multiple="multiple" id="' . $param_name . '_filter" data-selector="' . $param_name . '" class="ts-teammate-selector-filter">';
					if ($team_nocategory > 0) {
						$output .= '<option id="" class="" name="" data-id="" data-author="" data-category="ts-teammate-none-applied" value="ts-teammate-none-applied">No Category (' . $team_nocategory . ')</option>';
					}
					foreach ($category_fields as $index => $array) {
						$output .= '<option id="" class="" name="" data-id="" data-author="" data-category="' . $category_fields[$index]['slug'] . '" value="' . $category_fields[$index]['slug'] . '">' . $category_fields[$index]['name'] . ' (' . $category_fields[$index]['count'] . ')</option>';
					}
				$output .= '</select>';
				$output .= '<span style="font-size: 10px; margin-bottom: 20px; width: 100%; display: block;">Click on "Available Categories" to filter by category; click on "Flitered By" to remove from filter.</span>';
			}
			
			$output .= '<span style="font-size: 12px; margin-bottom: 10px; width: 100%; display: block;">Select Teammember:</span>';
			$output .= '<select name="' . $param_name . '" id="' . $param_name . '" class="ts-teammate-selector wpb-input wpb-select dropdown wpb_vc_param_value ' . $param_name . ' ' . $type . '" value=" ' . $value . '" style="margin-bottom: 20px;">';
				$output .= '<option id="" class="" name="" value="" data-filter="false" data-id="" data-categories="">Select a Teammember</option>';
				$output .= implode( $posts_fields );
			$output .= '</select>';
			return $output;
		}
		// Function to generate param type "teammatecat"
		function teammatecat_settings_field($settings, $value) {
			$dependency     	= vc_generate_dependencies_attributes($settings);
			$param_name     	= isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           	= isset($settings['type']) ? $settings['type'] : '';
			$url            	= plugin_dir_url( __FILE__ );
			$output         	= '';
			$posts_fields 		= array();
			$categories			= '';
			$category_fields 	= array();
			$categories_count	= 0;
			$terms_slugs 		= array();
			$value_arr 			= $value;
			if (!is_array($value_arr)) {
				$value_arr = array_map('trim', explode(',', $value_arr));
			}
			if (!empty($settings['posttype']) ) {
				$args = array(
					'no_found_rows' 		=> 1,
					'ignore_sticky_posts' 	=> 1,
					'posts_per_page' 		=> -1,
					'post_type' 			=> $settings['posttype'],
					'post_status' 			=> 'publish',
					'orderby' 				=> 'title',
					'order' 				=> 'ASC',
				);
				$team_nocategory			= 0;
				$team_query = new WP_Query($args);
				if ($team_query->have_posts()) {
					foreach($team_query->posts as $p) {
						$categories = TS_VCSC_GetTheCategoryByTax($p->ID, 'ts_team_category');
						if ($categories && !is_wp_error($categories)) {
							$category_slugs_arr = array();
							foreach ($categories as $category) {
								$category_slugs_arr[] = $category->slug;
								$category_data = array(
									'slug'		=> $category->slug,
									'name'		=> $category->cat_name,
									'count'		=> $category->count,
								);
								$category_fields[] = $category_data;
							}
							$categories_slug_str = join(",", $category_slugs_arr);
						} else {
							$team_nocategory++;
						}
					}
				}
				wp_reset_postdata();
			}
			
			$category_fields = array_map("unserialize", array_unique(array_map("serialize", $category_fields)));
			
			$output .= '<div class="ts-teammate-categories-holder">';
				$output .= '<textarea name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="display: none;">' . $value . '</textarea >';
				$output .= '<select multiple="multiple" name="' . $param_name . '_multiple" id="' . $param_name . '_multiple" data-holder="' . $param_name . '" class="ts-teammate-categories-selector wpb-input wpb-select dropdown ' . $param_name . '_multiple" value=" ' . $value . '" style="margin-bottom: 20px;">';
					if ($team_nocategory > 0) {
						$output .= '<option id="" class="" name="" data-id="" data-author="" value="ts-teammate-none-applied" ' . selected(in_array("ts-teammate-none-applied", $value_arr), true, false) . '>No Category (' . $team_nocategory . ')</option>';
					}
					foreach ($category_fields as $index => $array) {
						$output .= '<option id="" class="" name="" data-id="" data-author="" value="' . $category_fields[$index]['slug'] . '" ' . selected(in_array($category_fields[$index]['slug'], $value_arr), true, false) . '>' . $category_fields[$index]['name'] . ' (' . $category_fields[$index]['count'] . ')</option>';
					}
				$output .= '</select>';
				$output .= '<span style="font-size: 10px; margin-bottom: 20px; width: 100%; display: block;">Click on a name in "Available Categories" to add category to slider; click on a name in "Applied Categories" to remove from slider.</span>';
			$output .= '</div>';

			return $output;
		}
		
		// Function to generate param type "testimonial"
		function testimonial_settings_field($settings, $value) {
			$dependency     	= vc_generate_dependencies_attributes($settings);
			$param_name     	= isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           	= isset($settings['type']) ? $settings['type'] : '';
			$url            	= plugin_dir_url( __FILE__ );
			$output         	= '';
			$posts_fields 		= array();
			$categories			= '';
			$category_fields 	= array();
			$categories_count	= 0;
			$terms_slugs 		= array();
			$value_arr 			= $value;
			if (!is_array($value_arr)) {
				$value_arr = array_map('trim', explode(',', $value_arr));
			}
			if (!empty($settings['posttype']) ) {
				$args = array(
					'no_found_rows' 		=> 1,
					'ignore_sticky_posts' 	=> 1,
					'posts_per_page' 		=> -1,
					'post_type' 			=> $settings['posttype'],
					'post_status' 			=> 'publish',
					'orderby' 				=> 'title',
					'order' 				=> 'ASC',
				);
				$testimonial_nocategory		= 0;
				$testimonial_query = new WP_Query($args);
				if ($testimonial_query->have_posts()) {
					foreach($testimonial_query->posts as $p) {
						$categories = TS_VCSC_GetTheCategoryByTax($p->ID, 'ts_testimonials_category');
						if ($categories && !is_wp_error($categories)) {
							$category_slugs_arr = array();
							foreach ($categories as $category) {
								$category_slugs_arr[] = $category->slug;
								$category_data = array(
									'slug'		=> $category->slug,
									'name'		=> $category->cat_name,
									'count'		=> $category->count,
								);
								$category_fields[] = $category_data;
							}
							$categories_slug_str = join(",", $category_slugs_arr);
						} else {
							$testimonial_nocategory++;
							$categories_slug_str = '';
						};
						$posts_fields[] = sprintf(
							'<option id="%s" class="%s" name="%s" value="%s" data-filter="false" data-id="%s" data-categories="%s" %s>%s</option>',
							$settings['param_name'] . '-' . $p->ID,
							$settings['param_name'] . ' ' . $settings['type'],
							$settings['param_name'] . '-' . $p->ID,
							$p->ID,
							$p->post_title,
							$categories_slug_str,
							selected(in_array($p->ID, $value_arr), true, false),
							$p->post_title
						);
					}
				}
				wp_reset_postdata();
			}
			
			$category_fields = array_map("unserialize", array_unique(array_map("serialize", $category_fields)));
			if (count($category_fields) > 1) {
				$output .= '<span style="font-size: 12px; margin-bottom: 10px; width: 100%; display: block;">Filter by Category:</span>';
				$output .= '<select multiple="multiple" id="' . $param_name . '_filter" data-selector="' . $param_name . '" class="ts-testimonial-selector-filter">';
					if ($testimonial_nocategory > 0) {
						$output .= '<option id="" class="" name="" data-id="" data-author="" data-category="ts-testimonial-none-applied" value="ts-testimonial-none-applied">No Category (' . $testimonial_nocategory . ')</option>';
					}
					foreach ($category_fields as $index => $array) {
						$output .= '<option id="" class="" name="" data-id="" data-author="" data-category="' . $category_fields[$index]['slug'] . '" value="' . $category_fields[$index]['slug'] . '">' . $category_fields[$index]['name'] . ' (' . $category_fields[$index]['count'] . ')</option>';
					}
				$output .= '</select>';
				$output .= '<span style="font-size: 10px; margin-bottom: 20px; width: 100%; display: block;">Click on "Available Categories" to filter by category; click on "Flitered By" to remove from filter.</span>';
			}
			
			$output .= '<span style="font-size: 12px; margin-bottom: 10px; width: 100%; display: block;">Select Testimonial:</span>';
			$output .= '<select name="' . $param_name . '" id="' . $param_name . '" class="ts-testimonial-selector wpb-input wpb-select dropdown wpb_vc_param_value ' . $param_name . ' ' . $type . '" value=" ' . $value . '" style="margin-bottom: 20px;">';
				$output .= '<option id="" class="" name="" value="" data-filter="false" data-id="" data-categories="">Select a Testimonial</option>';
				$output .= implode( $posts_fields );
			$output .= '</select>';
			return $output;
		}
		
		// Function to generate param type "testimonialcat"
		function testimonialcat_settings_field($settings, $value) {
			$dependency     	= vc_generate_dependencies_attributes($settings);
			$param_name     	= isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           	= isset($settings['type']) ? $settings['type'] : '';
			$url            	= plugin_dir_url( __FILE__ );
			$output         	= '';
			$posts_fields 		= array();
			$posts_count		= 0;
			$categories			= '';
			$category_fields 	= array();
			$categories_count	= 0;
			$terms_slugs 		= array();
			$value_arr 			= $value;
			if (!is_array($value_arr)) {
				$value_arr = array_map('trim', explode(',', $value_arr));
			}
			if (!empty($settings['posttype']) ) {
				$args = array(
					'no_found_rows' 		=> 1,
					'ignore_sticky_posts' 	=> 1,
					'posts_per_page' 		=> -1,
					'post_type' 			=> $settings['posttype'],
					'post_status' 			=> 'publish',
					'orderby' 				=> 'title',
					'order' 				=> 'ASC',
				);
				$testimonial_nocategory		= 0;
				$testimonial_query = new WP_Query($args);
				if ($testimonial_query->have_posts()) {
					foreach($testimonial_query->posts as $p) {
						$posts_count++;
						$categories = TS_VCSC_GetTheCategoryByTax($p->ID, 'ts_testimonials_category');
						if ($categories && !is_wp_error($categories)) {
							$category_slugs_arr = array();
							foreach ($categories as $category) {
								$category_slugs_arr[] = $category->slug;
								$category_data = array(
									'slug'		=> $category->slug,
									'name'		=> $category->cat_name,
									'count'		=> $category->count,
								);
								$category_fields[] = $category_data;
							}
							$categories_slug_str = join(",", $category_slugs_arr);
						} else {
							$testimonial_nocategory++;
						}
					}
				}
				wp_reset_postdata();
			}
			
			$category_fields = array_map("unserialize", array_unique(array_map("serialize", $category_fields)));
			
			$output .= $posts_count . ' Post(s)';
			
			$output .= '<div class="ts-testimonial-categories-holder">';
				$output .= '<textarea name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="display: none;">' . $value . '</textarea >';
				$output .= '<select multiple="multiple" name="' . $param_name . '_multiple" id="' . $param_name . '_multiple" data-holder="' . $param_name . '" class="ts-testimonial-categories-selector wpb-input wpb-select dropdown ' . $param_name . '_multiple" value=" ' . $value . '" style="margin-bottom: 20px;">';
					if ($testimonial_nocategory > 0) {
						$output .= '<option id="" class="" name="" data-id="" data-author="" value="ts-testimonial-none-applied" ' . selected(in_array("ts-testimonial-none-applied", $value_arr), true, false) . '>No Category (' . $testimonial_nocategory . ')</option>';
					}
					foreach ($category_fields as $index => $array) {
						$output .= '<option id="" class="" name="" data-id="" data-author="" value="' . $category_fields[$index]['slug'] . '" ' . selected(in_array($category_fields[$index]['slug'], $value_arr), true, false) . '>' . $category_fields[$index]['name'] . ' (' . $category_fields[$index]['count'] . ')</option>';
					}
				$output .= '</select>';
				$output .= '<span style="font-size: 10px; margin-bottom: 20px; width: 100%; display: block;">Click on a name in "Available Categories" to add category to slider; click on a name in "Applied Categories" to remove from slider.</span>';
			$output .= '</div>';

			return $output;
		}
		// Function to generate param type "gopricing"
		function gopricing_settings_field($settings, $value) {
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$radios         = isset($settings['options']) ? $settings['options'] : '';
			$url            = plugin_dir_url( __FILE__ );
			$output         = '';
			$pricing_tables = get_option('go_pricing_tables');
			if (!empty($pricing_tables)) {
				$output .= '<select name="' . $param_name . '" id="' . $param_name . '" class="ts-go-pricing-tables wpb-input wpb-select dropdown wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="margin-bottom: 20px;">';
					foreach ($pricing_tables as $pricing_table) {
						$tableID 	= $pricing_table['table-id'];
						$tableName	= $pricing_table['table-name'];
						if ($value == $tableID) {
							$output 	.= '<option class="" value="' . $tableID . '" selected>' . $tableName . '</option>';
						} else {
							$output 	.= '<option class="" value="' . $tableID . '">' . $tableName . '</option>';
						}
					}
				$output .= '</select>';
			} else {
				$output .= '<select name="' . $param_name . '" id="' . $param_name . '" class="ts-go-pricing-tables wpb-input wpb-select dropdown wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="margin-bottom: 20px;">';
					$output 	.= '<option class="" value="None">No Tables could be found!</option>';
				$output .= '</select>';
			}
			return $output;
		}
		// Function to generate param type "quform"
		function quform_settings_field($settings, $value) {
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$radios         = isset($settings['options']) ? $settings['options'] : '';
			$url            = plugin_dir_url( __FILE__ );
			$output         = '';
			if (function_exists('iphorm_get_all_forms')) {
				$quforms_forms 	= iphorm_get_all_forms();
				if (count($quforms_forms)) {
					$output .= '<select name="' . $param_name . '" id="' . $param_name . '" class="ts-quform-selector wpb-input wpb-select dropdown wpb_vc_param_value ' . $param_name . ' ' . $type . '" style="margin-bottom: 20px;">';
					foreach ($quforms_forms as $form) {
						$formID 	= $form['id'];
						$formName	= $form['name'];
						$formStatus	= $form['active'];
						if ($formStatus == 0) {
							if ($value == $formID) {
								$output .= '<option data-name="' . $formName . '" class="" value="' . $formID . '" selected>' . $formName . ' (inactive)</option>';
							} else {
								$output .= '<option data-name="' . $formName . '" class="" value="' . $formID . '">' . $formName . ' (inactive)</option>';
							}
						} else {
							if ($value == $formID) {
								$output .= '<option data-name="' . $formName . '" class="" value="' . $formID . '" selected>' . $formName . '</option>';
							} else {
								$output .= '<option data-name="' . $formName . '" class="" value="' . $formID . '">' . $formName . '</option>';
							}
						}
					}
					$output .= '</select>';
				} else {
					printf(esc_html__('No forms found, %sclick here to create one%s.', 'iphorm'), '<a href="' . admin_url('admin.php?page=iphorm_form_builder') . '">', '</a>');
				}
			}
			return $output;
		}
		// Function to generate param type "seperator"
		function seperator_settings_field($settings, $value) {
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$suffix         = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class          = isset($settings['class']) ? $settings['class'] : '';
			$url            = plugin_dir_url( __FILE__ );
			$output         = '';
			$output 		.= '<div class="' . $param_name . ' ' . $type . '" name="' . $param_name . '" style="border-bottom: 2px solid #DDDDDD; margin-bottom: 10px; margin-top: 10px; padding-bottom: 10px; font-size: 20px; font-weight: bold; color: #BFBFBF;">' . $value . '</div>';
			return $output;
		}
		// Function to generate param type "messenger"
		function messenger_settings_field($settings, $value) {
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$suffix         = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class          = isset($settings['class']) ? $settings['class'] : '';
			$color			= isset($settings['color']) ? $settings['color'] : '#000000';
			$weight			= isset($settings['weight']) ? $settings['weight'] : 'normal';
			$size			= isset($settings['size']) ? $settings['size'] : '12';
			$url            = plugin_dir_url( __FILE__ );
			$output         = '';
			$output 		.= '<div class="' . $param_name . ' ' . $type . '" name="' . $param_name . '" style="color: ' . $color . ';margin-bottom: 10px; margin-top: 10px; padding-bottom: 10px; font-size: ' . $size . 'px; font-weight: ' . $weight . ';">' . $value . '</div>';
			return $output;
		}
		// Function to generate param type "icons panel"
		function iconspanel_settings_field($settings, $value) {
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$icon_select    = isset($settings['value']) ? $settings['value'] : '';
			$url            = plugin_dir_url( __FILE__ );
			$output         = '';
			
			if ($this->TS_VCSC_Active_Icon_Fonts > 1 ) {
				$output .= 'Filter by Font:';
			}
			$output .= '<select name="ts-font-icons-fonts" id="ts-font-icons-fonts" class="ts-font-icons-fonts wpb_vc_param_value wpb-input wpb-select dropdown" style="margin-bottom: 20px; ' . ($this->TS_VCSC_Active_Icon_Fonts > 1 ? "display: block;" : "display: none;") . '">';
				foreach ($this->TS_VCSC_List_Select_Fonts as $Icon_Font => $iconfont) {
					if (strlen($iconfont) != 0) {
						$font = explode('-', $iconfont);
						$output .= '<option class="" value="font-' . $font[0] . '">' . $Icon_Font . '</option>';
					} else {
						$output .= '<option class="" value="">' . $Icon_Font . '</option>';
					}
				}
			$output .= '</select>';
			
			$output .= 'Filter by Icon:';
			$output .= '<input name="ts-font-icons-search" id="ts-font-icons-search" class="ts-font-icons-search" type="text" placeholder="Search ..." />';
			
			$output .= '<div id="ts-font-icons-count" class="ts-font-icons-count" data-count="' . $this->TS_VCSC_Active_Icon_Count . '" style="margin-top: 10px; font-size: 10px;">Icons Found: <span id="ts-font-icons-found" class="ts-font-icons-found">' . $this->TS_VCSC_Active_Icon_Count . '</span> of ' . $this->TS_VCSC_Active_Icon_Count . '</div>';
			
			$output .= '<div class="ts-visual-selector ts-font-icons-wrapper">';
			$output .= '<input name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
		
			foreach ($icon_select as $key => $option) {
				$font = explode('-', $key);
				if ($key) {
					$output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link" href="#" title="Icon Name: ts-' . $key . '" data-filter="false" data-font="font-' . $font[0] . '" data-icon="ts-' . $key . '" rel="ts-' . $key . '"><i style="" class="ts-' . $key . '"></i><span style="display: none !important;">ts-' . $key . '</span></a>';
				} else {
					$output .= '<a class="TS_VCSC_Icon_Empty TS_VCSC_Icon_Link ts-no-icon" href="#" title="Icon Name: No Icon" rel="transparent">r</a>';
				}
			}
			
			if (get_option('ts_vcsc_extend_settings_tinymceCustom', 0) == 1) {
				foreach ($this->TS_VCSC_Icons_Custom as $key => $option) {
					$font = explode('-', $key);
					$output .= '<a class="TS_VCSC_Icon_Taken TS_VCSC_Icon_Link" href="#" title="Icon Name: ' . $key . '" data-filter="false" data-font="font-custom" data-icon="' . $key . '" rel="' . $key . '"><i style="" class="' . $key . '"></i><span style="display: none !important;">' . $key . '</span></a>';
				}
			}
		
			$output .= '</div>'; 
			return $output;
		}
		// Function to generate param type "backgrounds panel"
		function background_settings_field($settings, $value) {
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$pattern_select	= isset($settings['value']) ? $settings['value'] : '';
			$encoding       = isset($settings['encoding']) ? $settings['encoding'] : '';
			$url            = plugin_dir_url( __FILE__ );
			$output         = '';
			$output .= '<div class="ts-visual-selector ts-font-background-wrapper">';
			$output .= '<input name="'.$param_name.'" id="'.$param_name.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
			if ($encoding == 'true') {
				foreach ($pattern_select as $key => $option ) {
					if ($key) {
						$output .= '<a class="TS_VCSC_Back_Link" href="#" title="Background Name : ts-vcsc-' . $key . '" rel="' . $key . '"><img src="' . $url.$option . '" style="width: 34px; height: 34px;"></a>';
					} else {
						$output .= '<a class="TS_VCSC_Back_Link ts-no-background" href="#" title="Background Name : ts-vcsc-transparent" rel="transparent">r</a>';
					}
				}
			} else {
				foreach ($pattern_select as $key => $option) {
					if ($key) {
						$output .= '<a class="TS_VCSC_Back_Link" href="#" title="Background Name : ts-vcsc-' . $key . '" rel="' . $url.$option . '"><img src="' . $url.$option . '" style="width: 34px; height: 34px;"></a>';
					} else {
						$output .= '<a class="TS_VCSC_Back_Link ts-no-background" href="#" title="Background Name : ts-vcsc-transparent" rel="' . $url.$option . '">r</a>';
					}
				}
			}
			$output .= '</div>'; 
			return $output;
		}
		// Function to generate param type "map marker panel"
		function mapmarker_settings_field($settings, $value) {
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$pattern_select	= isset($settings['value']) ? $settings['value'] : '';
			$encoding       = isset($settings['encoding']) ? $settings['encoding'] : '';
			$url            = plugin_dir_url( __FILE__ );
			$dir 			= plugin_dir_path( __FILE__ );
			$output         = '';
			
			$output 		.= 'Search for Marker:';
			$output 		.= '<input name="ts-font-marker-search" id="ts-font-marker-search" class="ts-font-marker-search" type="text" placeholder="Search ..." />';
			
			$output 		.= '<div class="ts-visual-selector ts-font-marker-wrapper">';
				$output		.= '<input name="'.$param_name.'" id="'.$param_name.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
				
				$markerpath 	= $dir . 'images/marker/';
				$images 		= glob($markerpath . "*.png");
				
				foreach($images as $img)     {
					$markername	= basename($img);
					$output 	.= '<a class="TS_VCSC_Marker_Link" href="#" title="Marker Name : ' . $markername . '" rel="' . $markername . '"><img src="' . TS_VCSC_GetResourceURL('images/marker/') . $markername . '" style="height: 37px; width: 32px;"><span style="display: none !important;"' . $markername . '</span></a>';
				}
			
			$output .= '</div>'; 
			return $output;
		}
		// Function to generate param type "toggle"
		function toggle_settings_field($settings, $value) {
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$min            = isset($settings['min']) ? $settings['min'] : '';
			$max            = isset($settings['max']) ? $settings['max'] : '';
			$suffix         = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class          = isset($settings['class']) ? $settings['class'] : '';
			$url            = plugin_dir_url( __FILE__ );
			$output         = '';
			$output 		.= '<span class="ts-toggle-button ts-composer-toggle">';
			$output 		.= '<span class="toggle-handle"></span>';
			$output 		.= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" value="' . $value . '" name="' . $param_name . '"/>';
			$output 		.= '</span>';
			return $output;
		}
		// Function to generate param type "switch"
		function switch_settings_field($settings, $value) {
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$on            	= isset($settings['on']) ? $settings['on'] : 'On';
			$off            = isset($settings['off']) ? $settings['off'] : 'Off';
			$style			= isset($settings['style']) ? $settings['style'] : 'select'; 			// 'compact' or 'select'
			$design			= isset($settings['design']) ? $settings['design'] : 'toggle-light'; 	// 'toggle-light', 'toggle-modern' or 'toggle'soft'
			$width			= isset($settings['width']) ? $settings['width'] : '80';
			$suffix         = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class          = isset($settings['class']) ? $settings['class'] : '';
			$url            = plugin_dir_url( __FILE__ );
			$output         = '';
			$output .= '<div class="ts-switch-button ts-composer-switch" data-value="' . $value . '" data-width="' . $width . '" data-style="' . $style . '" data-on="' . $on . '" data-off="' . $off . '">';
				$output .= '<input type="hidden" style="display: none; " class="toggle-input wpb_vc_param_value ' . $param_name . ' ' . $type . '" value="' . $value . '" name="' . $param_name . '"/>';
				$output .= '<div class="toggle ' . $design . '" style="width: ' . $width . 'px; height: 20px;">';
					$output .= '<div class="toggle-slide">';
						$output .= '<div class="toggle-inner">';
							$output .= '<div class="toggle-on" ' . ($value == 'true' ? 'active' : '') . '>' . $on . '</div>';
							$output .= '<div class="toggle-blob"></div>';
							$output .= '<div class="toggle-off" ' . ($value == 'false' ? 'active' : '') . '>' . $off . '</div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			return $output;
		}
		// Function to generate param type "nouislider"
		function nouislider_settings_field($settings, $value) {
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$min            = isset($settings['min']) ? $settings['min'] : '';
			$max            = isset($settings['max']) ? $settings['max'] : '';
			$step           = isset($settings['step']) ? $settings['step'] : '';
			$unit           = isset($settings['unit']) ? $settings['unit'] : '';
			$suffix         = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class          = isset($settings['class']) ? $settings['class'] : '';
			$url            = plugin_dir_url( __FILE__ );
			$output         = '';
			$output 		.= '<div class="ts-nouislider-input-slider">';
			$output 		.= '<input style="width: 100px; float: left; margin-left: 0px; margin-right: 10px;" name="' . $param_name . '"  class="ts-nouislider-serial nouislider-input-selector nouislider-input-composer wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="text" value="' . $value . '"/>';
			$output 		.= '<span style="float: left; margin-right: 20px; margin-top: 10px;" class="unit">' . $unit . '</span>';
			$output 		.= '<div class="ts-nouislider-input ts-nouislider-input-element" data-value="' . $value . '" data-min="' . $min . '" data-max="' . $max . '" data-step="' . $step . '" style="width: 250px; float: left; margin-top: 10px;"></div>';
			$output 		.= '</div>';
			return $output;
		}
		// Function to generate param type "fonts"
		function fonts_setting_field($settings, $value){
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$radios         = isset($settings['options']) ? $settings['options'] : '';
			$url            = plugin_dir_url( __FILE__ );
			$output = '';
			$output .= '<select name="' . $param_name . '" id="' . $param_name . '" class="ts-chosen ts-shortcode-fonts-list wpb-select wpb_vc_param_value ' . $param_name . ' ' . $type . '">';
			// Define 600 Google Fonts List
			$google_webfonts = array('Abel', 'Abril+Fatface', 'Acid', 'Aclonica', 'Acme', 'Actor', 'Adamina', 'Advent+Pro', 'Aguafina+Script', 'Aladin', 'Aldrich', 'Alegreya', 'Alegreya+SC', 'Alex+Brush', 'Alfa+Slab+One', 'Alice', 'Alike', 'Alike+Angular', 'Allan', 'Allan:bold', 'Allerta', 'Allerta+Stencil', 'Allura', 'Almendra', 'Almendra+SC', 'Amaranth', 'Amatic+SC', 'Amethysta', 'Andada', 'Andika', 'Annie+Use+Your+Telescope', 'Anonymous+Pro', 'Antic', 'Antic+Didone', 'Antic+Slab', 'Anton', 'Arapey', 'Arbutus', 'Architects+Daughter', 'Arimo', 'Arizonia', 'Armata', 'Artifika', 'Arvo', 'Asap', 'Asset', 'Astloch', 'Asul', 'Atomic+Age', 'Aubrey', 'Audiowide', 'Average', 'Averia+Gruesa+Libre', 'Averia+Libre', 'Averia+Sans+Libre', 'Averia+Serif+Libre', 'Bad+Script', 'Balthazar', 'Bangers', 'Basic', 'Baumans', 'Belgrano', 'Belleza', 'Bentham', 'Berkshire+Swash', 'Bevan', 'Bigshot+One', 'Bilbo', 'Bilbo+Swash+Caps', 'Bitter', 'Black+Ops+One', 'Bonbon', 'Boogaloo', 'Bowlby+One', 'Bowlby+One+SC', 'Brawler', 'Bree+Serif', 'Bubblegum+Sans', 'Buda', 'Buda:light', 'Buenard', 'Butcherman', 'Butcherman+Caps', 'Butterfly+Kids', 'Cabin', 'Cabin+Condensed', 'Cabin+Sketch', 'Cabin+Sketch:bold', 'Cabin:bold', 'Caesar+Dressing', 'Cagliostro', 'Calligraffitti', 'Cambo', 'Candal', 'Cantarell', 'Cantata+One', 'Cardo', 'Carme', 'Carter+One', 'Caudex', 'Cedarville+Cursive', 'Ceviche+One', 'Changa+One', 'Chango', 'Chau+Philomene+One', 'Chelsea+Market', 'Cherry+Cream+Soda', 'Chewy', 'Chicle', 'Chivo', 'Coda', 'Coda:800', 'Codystar', 'Comfortaa', 'Coming+Soon', 'Concert+One', 'Condiment', 'Contrail+One', 'Convergence', 'Cookie', 'Copse', 'Corben', 'Corben:bold', 'Cousine', 'Coustard', 'Covered+By+Your+Grace', 'Crafty+Girls', 'Creepster', 'Creepster+Caps', 'Crete+Round', 'Crimson', 'Crushed', 'Cuprum', 'Cutive', 'Damion', 'Dancing+Script', 'Dawning+of+a+New+Day', 'Days+One', 'Delius', 'Delius+Swash+Caps', 'Delius+Unicase', 'Della+Respira', 'Devonshire', 'Didact+Gothic', 'Diplomata', 'Diplomata+SC', 'Doppio+One', 'Dorsa', 'Dosis', 'Dr+Sugiyama', 'Droid+Sans', 'Droid+Sans+Mono', 'Droid+Serif', 'Duru+Sans', 'Dynalight', 'EB+Garamond', 'Eater', 'Eater+Caps', 'Economica', 'Electrolize', 'Emblema+One', 'Emilys+Candy', 'Engagement', 'Enriqueta', 'Erica+One', 'Esteban', 'Euphoria+Script', 'Ewert', 'Exo', 'Expletus+Sans', 'Fanwood+Text', 'Fascinate', 'Fascinate+Inline', 'Federant', 'Federo', 'Felipa', 'Fjord+One', 'Flamenco', 'Flavors', 'Fondamento', 'Fontdiner+Swanky', 'Forum', 'Francois+One', 'Fredericka+the+Great', 'Fredoka+One', 'Fresca', 'Frijole', 'Fugaz+One', 'Galdeano', 'Gentium+Basic', 'Gentium+Book+Basic', 'Geo', 'Geostar', 'Geostar+Fill', 'Germania+One', 'Give+You+Glory', 'Glass+Antiqua', 'Glegoo', 'Gloria+Hallelujah', 'Goblin+One', 'Gochi+Hand', 'Gorditas', 'Goudy+Bookletter+1911', 'Graduate', 'Gravitas+One', 'Great+Vibes', 'Gruppo', 'Gudea', 'Habibi', 'Hammersmith+One', 'Handlee', 'Happy+Monkey', 'Henny+Penny', 'Herr+Von+Muellerhoff', 'Holtwood+One+SC', 'Homemade+Apple', 'Homenaje', 'IM+Fell', 'Iceberg', 'Iceland', 'Imprima', 'Inconsolata', 'Inder', 'Indie+Flower', 'Inika', 'Irish+Grover', 'Irish+Growler', 'Istok+Web', 'Italiana', 'Italianno', 'Jim+Nightshade', 'Jockey+One', 'Jolly+Lodger', 'Josefin+Sans', 'Josefin+Slab', 'Judson', 'Julee', 'Junge', 'Jura', 'Just+Another+Hand', 'Just+Me+Again+Down+Here', 'Kameron', 'Karla', 'Kaushan+Script', 'Kelly+Slab', 'Kenia', 'Knewave', 'Kotta+One', 'Kranky', 'Kreon', 'Kristi', 'Krona+One', 'La+Belle+Aurore', 'Lancelot', 'Lato', 'League+Script', 'Leckerli+One', 'Ledger', 'Lekton', 'Lemon', 'Lilita+One', 'Limelight', 'Linden+Hill', 'Lobster', 'Lobster+Two', 'Londrina+Shadow', 'Londrina+Sketch', 'Londrina+Solid', 'LondrinaOutline', 'Lora', 'Love+Ya+Like+A+Sister', 'Loved+by+the+King', 'Lovers+Quarrel', 'Luckiest+Guy', 'Lusitana', 'Lustria', 'Macondo', 'Macondo+Swash+Caps', 'Magra', 'Maiden+Orange', 'Mako', 'Marck+Script', 'Marko+One', 'Marmelad', 'Marvel', 'Mate', 'Mate+SC', 'Maven+Pro', 'Meddon', 'MedievalSharp', 'Medula+One', 'Megrim', 'Merienda+One', 'Merriweather', 'Metamorphous', 'Metrophobic', 'Michroma', 'Miltonian', 'Miltonian+Tattoo', 'Miniver', 'Miss+Fajardose', 'Miss+Saint+Delafield', 'Modern+Antiqua', 'Molengo', 'Monofett', 'Monoton', 'Monsieur+La+Doulaise', 'Montaga', 'Montez', 'Montserrat', 'Mountains+of+Christmas', 'Mr+Bedford', 'Mr+Bedfort', 'Mr+Dafoe', 'Mr+De+Haviland', 'Mrs+Saint+Delafield', 'Mrs+Sheppards', 'Muli', 'Mystery+Quest', 'Neucha', 'Neuton', 'News+Cycle', 'Niconne', 'Nixie+One', 'Nobile:400,700', 'Norican', 'Nosifer', 'Nosifer+Caps', 'Noticia+Text:400,700', 'Nova+Flat', 'Nova+Mono', 'Nova+Oval', 'Nova+Round', 'Nova+Script', 'Nova+Slim', 'Numans', 'Nunito', 'Old+Standard+TT', 'Oldenburg', 'Oleo+Script', 'Open+Sans:400,600,700,800', 'Orbitron', 'Original+Surfer', 'Oswald', 'Over+the+Rainbow', 'Overlock', 'Overlock+SC', 'Ovo', 'Oxygen', 'PT+Mono', 'PT+Sans:400,700', 'PT+Sans+Narrow', 'PT+Serif', 'PT+Serif+Caption', 'Pacifico', 'Parisienne', 'Passero+One', 'Passion+One', 'Patrick+Hand', 'Patua+One', 'Paytone+One', 'Permanent+Marker', 'Petrona', 'Philosopher', 'Piedra', 'Pinyon+Script', 'Plaster', 'Play', 'Playball', 'Playfair+Display', 'Podkova', 'Poiret+One', 'Poller+One', 'Poly', 'Pompiere', 'Pontano+Sans', 'Port+Lligat+Sans', 'Port+Lligat+Slab', 'Prata', 'Press+Start+2P', 'Princess+Sofia', 'Prociono', 'Prosto+One', 'Puritan', 'Quantico', 'Quattrocento', 'Quattrocento+Sans', 'Questrial', 'Quicksand:300,400,700', 'Qwigley', 'Radley', 'Raleway', 'Raleway:100', 'Rammetto+One', 'Rancho', 'Rationale', 'Redressed', 'Reenie+Beanie', 'Revalia', 'Ribeye', 'Ribeye+Marrow', 'Righteous', 'Rochester', 'Rock+Salt', 'Rokkitt', 'Ropa+Sans', 'Rosario', 'Rosarivo', 'Rouge+Script', 'Ruda', 'Ruge+Boogie', 'Ruluko', 'Ruslan+Display', 'Russo One', 'Ruthie', 'Sail', 'Salsa', 'Sancreek', 'Sansita+One', 'Sarina', 'Satisfy', 'Schoolbell', 'Seaweed+Script', 'Sevillana', 'Shadows+Into+Light', 'Shadows+Into+Light+Two', 'Shanti', 'Share', 'Shojumaru', 'Short+Stack', 'Sigmar+One', 'Signika', 'Signika+Negative', 'Simonetta', 'Sirin+Stencil', 'Six+Caps', 'Slackey', 'Smokum', 'Smythe', 'Sniglet', 'Sniglet:800', 'Snippet', 'Sofia', 'Sonsie+One', 'Sorts+Mill+Goudy', 'Special+Elite', 'Spicy+Rice', 'Spinnaker', 'Spirax', 'Squada+One', 'Stardos+Stencil', 'Stint+Ultra+Condensed', 'Stint+Ultra+Expanded', 'Stoke', 'Sue+Ellen+Francisco', 'Sunshiney', 'Supermercado+One', 'Swanky+and+Moo+Moo', 'Syncopate', 'Tangerine', 'Telex', 'Tenor+Sans', 'Terminal+Dosis', 'Terminal+Dosis+Light', 'The+Girl+Next+Door', 'Tienne', 'Tinos', 'Titillium+Web:400,300,600,700,900', 'Titan+One', 'Trade+Winds', 'Trocchi', 'Trochut', 'Trykker', 'Tulpen+One', 'Ubuntu', 'Ubuntu+Condensed', 'Ubuntu+Mono', 'Ultra', 'Uncial+Antiqua', 'UnifrakturCook', 'UnifrakturCook:bold', 'UnifrakturMaguntia', 'Unkempt', 'Unlock', 'Unna', 'VT323', 'Varela', 'Varela+Round', 'Vast+Shadow', 'Vibur', 'Vidaloka', 'Viga', 'Voces', 'Volkhov', 'Vollkorn', 'Voltaire', 'Waiting+for+the+Sunrise', 'Wallpoet', 'Walter+Turncoat', 'Wellfleet', 'Wire+One', 'Yanone+Kaffeesatz', 'Yellowtail', 'Yeseva+One', 'Yesteryear', 'Zeyada' );
			// Define Safe Fonts List
			$safe_fonts = array('Arial, Helvetica, sans-serif', 'Arial Black, Gadget, sans-serif', 'Bookman Old Style, serif', 'Comic Sans MS, cursive', 'Courier, monospace', 'Courier New, Courier, monospace', 'Garamond, serif', 'Georgia, serif', 'Impact, Charcoal, sans-serif', 'Lucida Console, Monaco, monospace', 'Lucida Grande, Lucida Sans Unicode, sans-serif', 'MS Sans Serif, Geneva, sans-serif', 'MS Serif, New York, sans-serif', 'Palatino Linotype, Book Antiqua, Palatino, serif', 'Tahoma, Geneva, sans-serif', 'Times New Roman, Times, serif', 'Trebuchet MS, Helvetica, sans-serif', 'Verdana, Geneva, sans-serif');
			$output .= '<option data-type="" value="none">Select Font</option>';
			// List Safe Fonts
			foreach ($safe_fonts as $safe_font) {
				$output .= '<option data-type="safefont" ';
				if ($value == $safe_font) {
					$output .= ' selected="selected"';
				}
				$output .= " value='" . $safe_font . "' >- Safe Font - " . $safe_font . "</option>";
			}
			// List Google Fonts
			foreach ($google_webfonts as $google_webfont) {
				$output .= '<option data-type="google" ';
				if ($value == $google_webfont) {
					$output .= ' selected="selected"';
				}
				$output .= 'value="' . $google_webfont . '" >- Google Fonts - ' . str_replace( '+', ' ', $google_webfont ) . '</option>';
			}
			$fontface = array();
			$stylesheet = $url . 'assets/fontface/fontface_stylesheet.css';
			if (file_exists($stylesheet)) {
				$file_content = file_get_contents($stylesheet);
				if (preg_match_all("/@font-face\s*{.*?font-family\s*:\s*('|\")(.*?)\\1.*?}/is", $file_content, $matchs)) {
					foreach ($matchs[0] as $index => $css) {
						$fontface[$matchs[2][$index]] = array(
							'name'  => $matchs[2][$index],
							'css'   => $css,
						);
					}
				}
			}
			$count = 1;
			foreach ($fontface as $value => $font) {
				$output .=  '<option data-type="fontface" ';
				if ($param_value == $value) {
					$output .= ' selected="selected"';
				}
				$output .=  ' value="' . $value . '" >- Fontface - ' . $font['name'] . '</option>';
				$count++;
			}
			$output .= '</select>';
			return $output;
		}
		// Function to generate param type "hidden_input"
		function hiddeninput_setting_field($settings, $value){
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$radios         = isset($settings['options']) ? $settings['options'] : '';
			$output 		= '';
			$output .= '<input name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ts_shortcode_hidden ' . $param_name . ' '.$type.'" type="hidden" value="' . $value . '"/>';
			return $output;
		}
		// Function to generate param type "hidden_textarea"
		function hiddentextarea_setting_field($settings, $value){
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$radios         = isset($settings['options']) ? $settings['options'] : '';
			$output 		= '';
			$output .= '<textarea name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ts_shortcode_hidden ' . $param_name . ' '.$type.'" style="display: none !important;">' . $value . '</textarea>';
			return $output;
		}
		// Function to generate param type "load JS file"
		function loadfile_setting_field($settings, $value){
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$file_type      = isset($settings['file_type']) ? $settings['file_type'] : '';
			$file_path      = isset($settings['file_path']) ? $settings['file_path'] : '';
			$url            = plugin_dir_url( __FILE__ );
			$output         = '';
			if (!empty($file_path)) {
				$output .= '<script type="text/javascript" src="' . $url.$file_path . '"></script>';
			}
			return $output;
		}
		// Function to generate param type "datetime_input"
		function datetimeinput_setting_field($settings, $value){
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$radios         = isset($settings['options']) ? $settings['options'] : '';
			$output 		= '';
			$output 		.= '<div class="ts-datetime-picker-element">';
				$output 	.= '<input name="' . $param_name . '" id="' . $param_name . '" class="ts-datetimepicker-value wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
				$output		.= '<input class="ts-datetimepicker-clear" type="button" value="Clear" style="width: 150px; text-align: center; display: block; height: 30px; padding: 5px; font-size: 12px; line-height: 12px; margin-bottom: 10px;">';
				$output 	.= '<input class="ts-datetimepicker" type="text" placeholder="Select Date and Time&hellip;" value="' . $value . '"/>';
			$output 		.= '</div>';
			return $output;
		}
		// Function to generate param type "date_input"
		function dateinput_setting_field($settings, $value){
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$radios         = isset($settings['options']) ? $settings['options'] : '';
			$output 		= '';
			$output 		.= '<div class="ts-date-picker-element">';
				$output 	.= '<input name="' . $param_name . '" id="' . $param_name . '" class="ts-datepicker-value wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
				$output		.= '<input class="ts-datetimepicker-clear" type="button" value="Clear" style="width: 150px; text-align: center; display: block; height: 30px; padding: 5px; font-size: 12px; line-height: 12px; margin-bottom: 10px;">';
				$output 	.= '<input class="ts-datepicker" type="text" placeholder="Select Date&hellip;" value="' . $value . '"/>';
			$output 		.= '</div>';
			return $output;
		}
		// Function to generate param type "time_input"
		function timeinput_setting_field($settings, $value){
			$dependency     = vc_generate_dependencies_attributes($settings);
			$param_name     = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type           = isset($settings['type']) ? $settings['type'] : '';
			$radios         = isset($settings['options']) ? $settings['options'] : '';
			$output 		= '';
			$output 		.= '<div class="ts-time-picker-element">';
				$output 	.= '<input name="' . $param_name . '" id="' . $param_name . '" class="ts-timepicker-value wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
				$output		.= '<input class="ts-datetimepicker-clear" type="button" value="Clear" style="width: 150px; text-align: center; display: block; height: 30px; padding: 5px; font-size: 12px; line-height: 12px; margin-bottom: 10px;">';
				$output 	.= '<input class="ts-timepicker" type="text" placeholder="Select Time&hellip;" value="' . $value . '"/>';
			$output 		.= '</div>';
			return $output;
		}
		// Load Composer Elements + Add Custom Parameters
		function TS_VCSC_RegisterWithComposer() {
			if (function_exists('vc_is_inline')){
				if ((vc_is_inline()) || (is_admin())) {
					$this->TS_VCSC_AddParametersToComposer();
					$this->TS_VCSC_AddElementsToComposer();
				} else {
					$this->TS_VCSC_LoadClassElements();
				}
			} else if (is_admin()) {
				$this->TS_VCSC_AddParametersToComposer();
				$this->TS_VCSC_AddElementsToComposer();
			} else {
				$this->TS_VCSC_LoadClassElements();
			}
		}
		function TS_VCSC_AddParametersToComposer() {
			if (function_exists('add_shortcode_param')) {
				// Generate param type "teammate"
				if (get_option('ts_vcsc_extend_settings_customTeam', 1) == 1) {
					add_shortcode_param('teammate',			array($this, 'teammate_settings_field'));
				}
				// Generate param type "teammatecat"
				if (get_option('ts_vcsc_extend_settings_customTeam', 1) == 1) {
					add_shortcode_param('teammatecat',		array($this, 'teammatecat_settings_field'));
				}
				// Generate param type "testimonial"
				if (get_option('ts_vcsc_extend_settings_customTestimonial', 1) == 1) {
					add_shortcode_param('testimonial',		array($this, 'testimonial_settings_field'));
				}
				// Generate param type "testimonialcat"
				if (get_option('ts_vcsc_extend_settings_customTestimonial', 1) == 1) {
					add_shortcode_param('testimonialcat',	array($this, 'testimonialcat_settings_field'));
				}
				// Generate param type "skillset"
				if (get_option('ts_vcsc_extend_settings_customSkillset', 1) == 1) {
					add_shortcode_param('skillset',			array($this, 'skillset_settings_field'));
				}
				// Generate param type "seperator"
				add_shortcode_param('seperator',        	array($this, 'seperator_settings_field'));
				// Generate param type "messenger"
				add_shortcode_param('messenger',        	array($this, 'messenger_settings_field'));
				// Generate param type "icon-panel"
				add_shortcode_param('icons_panel',      	array($this, 'iconspanel_settings_field'));
				// Generate param type "background-panel"
				add_shortcode_param('background',       	array($this, 'background_settings_field'));
				// Generate param type "mapmarker-panel"
				add_shortcode_param('mapmarker',       		array($this, 'mapmarker_settings_field'));
				// Generate param type "toggle"
				add_shortcode_param('toggle',           	array($this, 'toggle_settings_field'));
				// Generate param type "switch"
				add_shortcode_param('switch',           	array($this, 'switch_settings_field'));
				// Generate param type "nouislider"
				add_shortcode_param('nouislider',       	array($this, 'nouislider_settings_field'));
				// Generate param type "fonts"
				add_shortcode_param('fonts',            	array($this, 'fonts_setting_field'));
				// Generate param type "hidden_input"
				add_shortcode_param('hidden_input',     	array($this, 'hiddeninput_setting_field'));
				// Generate param type "hidden_textarea"
				add_shortcode_param('hidden_textarea',		array($this, 'hiddentextarea_setting_field'));
				// Generate param type "load_file"
				add_shortcode_param('load_file',        	array($this, 'loadfile_setting_field'));
				// Generate param type "datetime_input"
				add_shortcode_param('datetime_input',		array($this, 'datetimeinput_setting_field'));
				// Generate param type "date_input"
				add_shortcode_param('date_input',			array($this, 'dateinput_setting_field'));
				// Generate param type "time_input"
				add_shortcode_param('time_input',			array($this, 'timeinput_setting_field'));
				// Generate param type "gopricing"
				add_shortcode_param('gopricing',			array($this, 'gopricing_settings_field'));
				// Generate param type "quform"
				add_shortcode_param('quform',				array($this, 'quform_settings_field'));
			}
		}
		function TS_VCSC_AddElementsToComposer() {
			foreach ($this->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
				if ($element['active'] == "true") {
					if ($element['type'] == 'internal') {
						require_once($this->elements_dir.'/ts_vcsc_element_' . $element['file'] . '.php');
					} else if ($element['type'] == 'external') {
						require_once($this->plugins_dir.'/ts_vcsc_element_' . $element['file'] . '.php');
					}
				}
			}
			// Load Teammate Settings
			if (get_option('ts_vcsc_extend_settings_customTeam', 1) == 1) {
				require_once($this->elements_dir.'/ts_vcsc_element_teammates_class.php');
			}
			// Load Testimonial Settings
			if (get_option('ts_vcsc_extend_settings_customTestimonial', 1) == 1) {
				require_once($this->elements_dir.'/ts_vcsc_element_testimonials_class.php');
			}
			// Load Skillset Settings
			if (get_option('ts_vcsc_extend_settings_customSkillset', 1) == 1) {
				require_once($this->elements_dir.'/ts_vcsc_element_skillsets_class.php');
			}
			// Load Extended Row Settings
			if (get_option('ts_vcsc_extend_settings_additionsRows', 1) == 1) {
				require_once($this->elements_dir.'/ts_vcsc_element_row.php');
			}
			// Load Extended Column Settings
			if (get_option('ts_vcsc_extend_settings_additionsColumns', 1) == 1) {
				require_once($this->elements_dir.'/ts_vcsc_element_column.php');
			}
		}
		function TS_VCSC_LoadClassElements() {
			// Load Teammate Settings
			if (get_option('ts_vcsc_extend_settings_customTeam', 1) == 1) {
				require_once('elements/ts_vcsc_element_teammates_class.php');
			}
			// Load Testimonial Settings
			if (get_option('ts_vcsc_extend_settings_customTestimonial', 1) == 1) {
				require_once('elements/ts_vcsc_element_testimonials_class.php');
			}
			// Load Skillset Settings
			if (get_option('ts_vcsc_extend_settings_customSkillset', 1) == 1) {
				require_once('elements/ts_vcsc_element_skillsets_class.php');
			}
			// Load Extended Row Settings
			if (get_option('ts_vcsc_extend_settings_additionsRows', 1) == 1) {
				require_once($this->elements_dir.'/ts_vcsc_element_row.php');
			}
			// Load Extended Column Settings
			if (get_option('ts_vcsc_extend_settings_additionsColumns', 1) == 1) {
				require_once($this->elements_dir.'/ts_vcsc_element_column.php');
			}
		}
		
		
		/* Functions for Custom Font Upload */
		/* -------------------------------- */
		
		// Sets path to wp-content/uploads/ts-vcsc-icons/custom-pack
		function TS_VCSC_SetUploadDirectory($upload) {
			$upload['subdir'] 	= '/ts-vcsc-icons/custom-pack';
			$upload['path'] 	= $upload['basedir'] . $upload['subdir'];
			$upload['url']   	= $upload['baseurl'] . $upload['subdir'];
			return $upload;
		}
		// If you are on the Upload a Custom Icon Pack Page => set custom path for all uploads to wp-content/uploads/ts-vcsc-icons/custom-pack
		function TS_VCSC_ChangeDownloadsUploadDirectory() {
			$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$actual_link = explode('/', $actual_link);
			$urlBasename = array_pop($actual_link);
			if ($urlBasename == 'admin.php?page=TS_VCSC_Uploader') {
				add_filter('upload_dir', array($this, 'TS_VCSC_SetUploadDirectory'));
			} 
		}
		// Register custom pack already installed error
		function TS_VCSC_CustomPackInstalledError(){
			$TS_VCSC_Icons_Custom 			= get_option('ts_vcsc_extend_settings_tinymceCustomArray', '');
			$TS_VCSC_tinymceCustomCount		= get_option('ts_vcsc_extend_settings_tinymceCustomCount', 0);
			if ((ini_get('allow_url_fopen') == '1') || (TS_VCSC_cURLcheckBasicFunctions() == true)) {
				$RemoteFileAccess = true;
			} else {
				$RemoteFileAccess = false;
			}
			$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$actual_link = explode('/', $actual_link);
			$urlBasename = array_pop($actual_link);
			if ($urlBasename == 'admin.php?page=TS_VCSC_Uploader' ) {
				$dest = wp_upload_dir();
				$dest_path = $dest['path'];
				// If a file exists display included icons
				if ((file_exists( $dest_path.'/ts-vcsc-custom-pack.zip' )) && ($RemoteFileAccess == true)) {
					// Disable file upload field if custom font pack exists or system requirements are not met
					echo '<script>
						jQuery(document).ready(function() {
							jQuery(".ts-vcsc-custom-pack-preloader").hide();
							jQuery(".preview-icon-code-box").show();
							jQuery(".dropDownDownload").removeAttr("disabled");
							jQuery("#ts_vcsc_custom_pack_field").attr("disabled", "disabled");
							jQuery("input[value=Import]").attr("disabled", "disabled");
						});
					</script>';
				} else if ($RemoteFileAccess == false) {
					update_option('ts_vcsc_extend_settings_tinymceCustom', 			0);
					update_option('ts_vcsc_extend_settings_tinymceCustomJSON', 		'');
					update_option('ts_vcsc_extend_settings_tinymceCustomPath', 		'');
					update_option('ts_vcsc_extend_settings_tinymceCustomArray', 	'');
					update_option('ts_vcsc_extend_settings_tinymceCustomName', 		'Custom User Font');
					update_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 	'Custom User');
					update_option('ts_vcsc_extend_settings_tinymceCustomCount', 	0);
					update_option('ts_vcsc_extend_settings_tinymceCustomDate',		'');
					echo '<script>
						jQuery(document).ready(function() {
							jQuery(".ts-vcsc-custom-pack-preloader").hide();
							jQuery(".preview-icon-code-box").hide();
							jQuery("#ts_vcsc_custom_pack_field").attr("disabled", "disabled");
							jQuery("#uninstall-pack-button").attr("disabled", "disabled");
							jQuery(".dropDownDownload").attr("disabled", "disabled");
							jQuery("input[value=Import]").attr("disabled", "disabled");
							jQuery(".ts-vcsc-custom-pack-buttons").after("<div class=error><p class=fontPackUploadedError>Your system does not fulfill the requirements to import a custom font.</p></div>");
						});
					</script>';	
				}
				if ((file_exists( $dest_path.'/ts-vcsc-custom-pack.zip' )) && ($RemoteFileAccess == true)) {
					// Create Preview of imported Icons
					$output = "";
					$output .= "<div id='ts-vcsc-extend-preview' class=''>";
						$output .="<div id='ts-vcsc-extend-preview-name'>Font Name: " . 		get_option('ts_vcsc_extend_settings_tinymceCustomName', 'Custom User Font') . "</div>";
						$output .="<div id='ts-vcsc-extend-preview-author'>Font Author: " . 	get_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 'Custom User') . "</div>";
						$output .="<div id='ts-vcsc-extend-preview-count'>Icon Count: " . 		get_option('ts_vcsc_extend_settings_tinymceCustomCount', 0) . "</div>";
						$output .="<div id='ts-vcsc-extend-preview-date'>Uploaded: " . 			get_option('ts_vcsc_extend_settings_tinymceCustomDate', '') . "</div>";
						$output .= "<div id='ts-vcsc-extend-preview-list' class=''>";
						$icon_counter = 0;
						foreach ($TS_VCSC_Icons_Custom as $key => $option ) {
							$font = explode('-', $key);
							$output .= "<div class='ts-vcsc-icon-preview' data-name='" . $key . "' data-code='" . $option . "' data-font='Custom' data-count='" . $icon_counter . "' rel='" . $key . "'><span class='ts-vcsc-icon-preview-icon'><i class='" . $key . "'></i></span><span class='ts-vcsc-icon-preview-name'>" . $key . "</span></div>";
							$icon_counter = $icon_counter + 1;
						}
						$output .= "</div>";
					$output .= "</div>";
					echo '<script>
						jQuery(document).ready(function() {
							jQuery("#current-font-pack-preview").html("' . $output. '");
						});
					</script>';
				} else if ($RemoteFileAccess == true) {
					update_option('ts_vcsc_extend_settings_tinymceCustom', 			0);
					update_option('ts_vcsc_extend_settings_tinymceCustomJSON', 		'');
					update_option('ts_vcsc_extend_settings_tinymceCustomPath', 		'');
					update_option('ts_vcsc_extend_settings_tinymceCustomArray', 	'');
					update_option('ts_vcsc_extend_settings_tinymceCustomName', 		'Custom User Font');
					update_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 	'Custom User');
					update_option('ts_vcsc_extend_settings_tinymceCustomCount', 	0);
					update_option('ts_vcsc_extend_settings_tinymceCustomDate',		'');
					echo '<script>
						jQuery(document).ready(function() {
							jQuery(".ts-vcsc-custom-pack-preloader").hide();
							jQuery(".preview-icon-code-box").hide();
							jQuery("#uninstall-pack-button").attr("disabled", "disabled");
							jQuery("#ts_vcsc_custom_pack_field").removeAttr("disabled");
							jQuery("#dropDownDownload").attr("disabled", "disabled");
						});
					</script>';
				}
			}	
		}
		// Function that handles the ajax request of deleting files
		function TS_VCSC_DeleteCustomPack_Ajax() {
			$dest 					= wp_upload_dir();
			$dest_path 				= $dest['path'];	
			$this_year 				= date('Y');
			$this_month 			= date('m');
			$the_date_string 		= $this_year . '/' . $this_month.'/';
			$customFontPackPath 	= $dest_path . '/ts-vcsc-icons/custom-pack/';
			$newCustomFontPackPath 	= str_replace($the_date_string, '', $customFontPackPath);
			$fileName = 'ts-vcsc-custom-pack.zip';
			$deleteZip = TS_VCSC_RemoveDirectory($newCustomFontPackPath);
			TS_VCSC_RemoveDirectory($newCustomFontPackPath);
			update_option('ts_vcsc_extend_settings_tinymceCustom', 			0);
			update_option('ts_vcsc_extend_settings_tinymceCustomJSON', 		'');
			update_option('ts_vcsc_extend_settings_tinymceCustomPath', 		'');
			update_option('ts_vcsc_extend_settings_tinymceCustomArray', 	'');
			update_option('ts_vcsc_extend_settings_tinymceCustomName', 		'Custom User Font');
			update_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 	'Custom User');
			update_option('ts_vcsc_extend_settings_tinymceCustomCount', 	0);
			update_option('ts_vcsc_extend_settings_tinymceCustomDate',		'');
			$this->TS_VCSC_tinymceCustomCount 	= 0;
			$this->TS_VCSC_Icons_Custom 		= array();
		}
	}
}
if (class_exists('VISUAL_COMPOSER_EXTENSIONS')) {
	$VISUAL_COMPOSER_EXTENSIONS = new VISUAL_COMPOSER_EXTENSIONS;
}

// Add Category Filters to Custom Post Types
// -----------------------------------------
if (!class_exists('TS_VCSC_Tax_CTP_Filter')){
    class TS_VCSC_Tax_CTP_Filter {
        /**
         * __construct 
         * @author Ohad Raz <admin@bainternet.info>
         * @since 0.1
         * @param array $cpt [description]
         */
        function __construct($cpt = array()){
            $this->cpt = $cpt;
            // Adding a Taxonomy Filter to Admin List for a Custom Post Type
            add_action( 'restrict_manage_posts', array($this, 'TS_VCSC_My_Restrict_Manage_Posts' ));
        }
        /**
         * TS_VCSC_My_Restrict_Manage_Posts  add the slelect dropdown per taxonomy
         * @author Ohad Raz <admin@bainternet.info>
         * @since 0.1
         * @return void
         */
        public function TS_VCSC_My_Restrict_Manage_Posts() {
            // only display these taxonomy filters on desired custom post_type listings
            global $typenow;
            $types = array_keys($this->cpt);
            if (in_array($typenow, $types)) {
                // create an array of taxonomy slugs you want to filter by - if you want to retrieve all taxonomies, could use get_taxonomies() to build the list
                $filters = $this->cpt[$typenow];
                foreach ($filters as $tax_slug) {
                    // retrieve the taxonomy object
                    $tax_obj = get_taxonomy($tax_slug);
                    $tax_name = $tax_obj->labels->name;
                    // output html for taxonomy dropdown filter
                    echo "<select name='".strtolower($tax_slug)."' id='".strtolower($tax_slug)."' class='postform'>";
                    echo "<option value=''>Show All $tax_name</option>";
                    $this->TS_VCSC_Generate_Taxonomy_Options($tax_slug,0,0,(isset($_GET[strtolower($tax_slug)])? $_GET[strtolower($tax_slug)] : null));
                    echo "</select>";
                }
            }
        }
        /**
         * TS_VCSC_Generate_Taxonomy_Options generate dropdown
         * @author Ohad Raz <admin@bainternet.info>
         * @since 0.1
         * @param  string  $tax_slug 
         * @param  string  $parent   
         * @param  integer $level    
         * @param  string  $selected 
         * @return void            
         */
        public function TS_VCSC_Generate_Taxonomy_Options($tax_slug, $parent = '', $level = 0,$selected = null) {
            $args = array('show_empty' => 1);
            if(!is_null($parent)) {
                $args = array('parent' => $parent);
            }
            $terms = get_terms($tax_slug,$args);
            $tab='';
            for($i=0;$i<$level;$i++){
                $tab.='--';
            }
            foreach ($terms as $term) {
                // output each select option line, check against the last $_GET to show the current option selected
                echo '<option value='. $term->slug, $selected == $term->slug ? ' selected="selected"' : '','>' .$tab. $term->name .' (' . $term->count .')</option>';
                $this->TS_VCSC_Generate_Taxonomy_Options($tax_slug, $term->term_id, $level+1,$selected);
            }
        }
    }
}

// Load Library to create Custom Metaboxes
// ---------------------------------------
function TS_VCSC_CMBMetaBoxes() {
	if (!class_exists('cmb_Meta_Box')) {
		require_once('custom-metabox/init.php');
	}
}




// Functions to retrieve Video Thumbnails
// --------------------------------------
if (!function_exists('TS_VCSC_VideoImage_Youtube')){
	function TS_VCSC_VideoImage_Youtube($url){
		// Get image from video URL
		$urls 		= parse_url($url);
		$imgPath 	= '';
		if ((isset($urls['host'])) && ($urls['host'] == 'youtu.be')) {
			//Expect the URL to be http://youtu.be/abcd, where abcd is the video ID
			$imgPath = ltrim($urls['path'],'/');
		} else if ((isset($urls['path'])) && (strpos($urls['path'], 'embed') == 1)) {
			// Expect the URL to be http://www.youtube.com/embed/abcd
			$imgPath = end(explode('/', $urls['path']));
		} else if (strpos($url, '/') === false) { 
			//Expect the URL to be abcd only
			$imgPath = $url;
		} else {
			//Expect the URL to be http://www.youtube.com/watch?v=abcd
			parse_str($urls['query']);
			$imgPath = $v;
		}
		return "http://img.youtube.com/vi/" . $imgPath . "/0.jpg";
	}
}
if (!function_exists('TS_VCSC_VideoID_Youtube')){
	function TS_VCSC_VideoID_Youtube($url){
		// Get image from video URL
		$urls 		= parse_url($url);
		$imgPath 	= '';
		if ((isset($urls['host'])) && ($urls['host'] == 'youtu.be')) {
			//Expect the URL to be http://youtu.be/abcd, where abcd is the video ID
			$imgPath = ltrim($urls['path'],'/');
		} else if ((isset($urls['path'])) && (strpos($urls['path'], 'embed') == 1)) {
			// Expect the URL to be http://www.youtube.com/embed/abcd
			$imgPath = end(explode('/', $urls['path']));
		} else if (strpos($url, '/') === false) { 
			//Expect the URL to be abcd only
			$imgPath = $url;
		} else {
			//Expect the URL to be http://www.youtube.com/watch?v=abcd
			parse_str($urls['query']);
			$imgPath = $v;
		}
		return $imgPath;
	}
}
if (!function_exists('TS_VCSC_VideoImage_Vimeo')){
	function TS_VCSC_VideoImage_Vimeo($url){
		$image_url = parse_url($url);
		if ((isset($image_url['host'])) && ($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com')) {
			$hash = unserialize(TS_VCSC_retrieveExternalData("http://vimeo.com/api/v2/video/" . substr($image_url['path'], 1) . ".php"));
			return $hash[0]["thumbnail_large"];
		} else {
			return '';
		}
	}
}
if (!function_exists('TS_VCSC_VideoID_Vimeo')){
	function TS_VCSC_VideoID_Vimeo($url){
		$image_url = parse_url($url);
		if ((isset($image_url['host'])) && ($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com')) {
			return substr($image_url['path'], 1);
		} else {
			return '';
		}
	}
}
if (!function_exists('TS_VCSC_VideoImage_Motion')){
	function TS_VCSC_VideoImage_Motion($url){
		$image_url 	= parse_url($url);
		if ((isset($image_url['host'])) && ($image_url['host'] == 'www.dailymotion.com' || $image_url['host'] == 'dailymotion.com')) {
			$url	= $image_url['path'];
			$parts 	= explode('/', $url);
			$parts 	= explode('_', $parts[2]);
			return "http://www.dailymotion.com/thumbnail/video/" . $parts[0];
		} else if ((isset($urls['host'])) && ($image_url['host'] == 'dai.ly')) {
			$imgPath = ltrim($image_url['path'],'/');
			return "http://www.dailymotion.com/thumbnail/video/" . $imgPath;
		} else {
			return '';
		}
	}
}
if (!function_exists('TS_VCSC_VideoID_Motion')){
	function TS_VCSC_VideoID_Motion($url){
		$image_url 	= parse_url($url);
		$imgPath 	= '';
		if ((isset($image_url['host'])) && ($image_url['host'] == 'www.dailymotion.com' || $image_url['host'] == 'dailymotion.com')) {
			$url	= $image_url['path'];
			$parts 	= explode('/', $url);
			$parts 	= explode('_', $parts[2]);
			return $parts[0];
		} else if ((isset($urls['host'])) && ($image_url['host'] == 'dai.ly')) {
			$imgPath = ltrim($image_url['path'],'/');
			return $imgPath;
		} else {
			return $imgPath;
		}
	}
}


// Get Item Information from Envato
// --------------------------------
if (!function_exists('TS_VCSC_ShowInformation')){
	function TS_VCSC_ShowInformation($item_id, $item_vc = true) {
		if ($item_vc == true) {
			$item_id = '7190695';
		}
		$item = TS_VCSC_GetItemInfo($item_id);
		if ($item === false) {
			return '<p style="text-align: justify;">Oops... Something went wrong. Could not retrieve item information from Envato.</p>';
		}
		$item = $item['item'];
		extract($item);
		$ts_vcsc_extend_envatoItem_Name     = $item;
		$ts_vcsc_extend_envatoItem_User	= $user;
		$ts_vcsc_extend_envatoItem_Rating	= $rating;
		$ts_vcsc_extend_envatoItem_Sales	= $sales;
		$ts_vcsc_extend_envatoItem_Price	= $cost;
		$ts_vcsc_extend_envatoItem_Thumb	= $thumbnail;
		$ts_vcsc_extend_envatoItem_Image	= $live_preview_url;
		$ts_vcsc_extend_envatoItem_Link	= $url;
		$ts_vcsc_extend_envatoItem_Release	= $uploaded_on;
		$ts_vcsc_extend_envatoItem_Update	= $last_update;
		$ts_vcsc_extend_envatoItem_HTML 	= '';
		$ts_vcsc_extend_envatoItem_HTML .= '
		<div class="ts_vcsc_envato_item">
			<div class="ts_vcsc_title">'.$ts_vcsc_extend_envatoItem_Name.'</div>
			<div class="ts_vcsc_wrap">
				<div class="ts_vcsc_top">
					<div class="ts_vcsc_rating"><span class="ts_vcsc_desc">Rating</span>' . TS_VCSC_GetEnvatoStars($ts_vcsc_extend_envatoItem_Rating) . '</div>
				</div>
				<div class="ts_vcsc_middle">
					<div class="ts_vcsc_sales">
						<span class="ts_vcsc_img_sales"></span>
						<div class="ts_vcsc_text">
							<span class="ts_vcsc_num">'.$ts_vcsc_extend_envatoItem_Sales.'</span>
							<span class="ts_vcsc_desc">Sales</span>
						</div>
					</div>
					<div class="ts_vcsc_thumb">
						<img src="'.$ts_vcsc_extend_envatoItem_Thumb.'" alt="'.$ts_vcsc_extend_envatoItem_Name.'" width="80" height="80"/>
					</div>
					<div class="ts_vcsc_price">
						<span class="ts_vcsc_img_price"></span>
						<div class="ts_vcsc_text">
							<span class="ts_vcsc_num"><span>$</span>'.round($ts_vcsc_extend_envatoItem_Price).'</span>
							<span class="ts_vcsc_desc">only</span>
						</div>
					</div>
				</div>
				<div class="ts_vcsc_bottom">
					<a href="'.$ts_vcsc_extend_envatoItem_Link.'" target="_blank"></a>
				</div>
			</div>
		</div>';
		if ($item_vc == true) {
			update_option('ts_vcsc_extend_settings_envatoInfo', 	$ts_vcsc_extend_envatoItem_HTML);
			update_option('ts_vcsc_extend_settings_envatoLink', 	$ts_vcsc_extend_envatoItem_Link);
			update_option('ts_vcsc_extend_settings_envatoPrice', 	$ts_vcsc_extend_envatoItem_Price);
			update_option('ts_vcsc_extend_settings_envatoRating', 	TS_VCSC_GetEnvatoStars($ts_vcsc_extend_envatoItem_Rating));
			update_option('ts_vcsc_extend_settings_envatoSales', 	$ts_vcsc_extend_envatoItem_Sales);
		} else {
			echo $ts_vcsc_extend_envatoItem_HTML;
		}
	}
}
if (!function_exists('TS_VCSC_GetItemInfo')){
	function TS_VCSC_GetItemInfo($item_id) {
		/* Data cache timeout in seconds - It send a new request each hour instead of each page refresh */
		$CACHE_EXPIRATION = 3600;
		/* Set the transient ID for caching */
		$transient_id = 'TS_VCSC_Extend_Envato_Item_Data';
		/* Get the cached data */
		$cached_item = get_transient($transient_id);
		/* Check if the function has to send a new API request */
		if (!$cached_item || ($cached_item->item_id != $item_id)) {
			/* Set the API URL, %s will be replaced with the item ID  */
			$api_url = "http://marketplace.envato.com/api/edge/item:%s.json"; 
			/* Fetch data using the WordPress function wp_remote_get() */
			if ((function_exists('wp_remote_get')) && (strlen($item_id) != 0)) {
				$response = wp_remote_get(sprintf($api_url, $item_id));
			} else if ((function_exists('wp_remote_post')) && (strlen($item_id) != 0)) {
				$response = wp_remote_post(sprintf($api_url, $item_id));
			}
			/* Check for errors, if there are some errors return false */
			if (is_wp_error($response) or (wp_remote_retrieve_response_code($response) != 200)) {
				return false;
			}
			/* Transform the JSON string into a PHP array */
			$item_data = json_decode(wp_remote_retrieve_body($response), true);
			/* Check for incorrect data */
			if (!is_array($item_data)) {
				return false;
			}
			/* Prepare data for caching */
			$data_to_cache = new stdClass();
			$data_to_cache->item_id 		= $item_id;
			$data_to_cache->item_info 		= $item_data;
			/* Set the transient - cache item data*/
			set_transient($transient_id, $data_to_cache, $CACHE_EXPIRATION);
			/* Return item info array */
			return $item_data;
		}
		/* If the item is already cached return the cached info */
		return $cached_item->item_info;
	}
}
if (!function_exists('TS_VCSC_GetEnvatoStars')){
	function TS_VCSC_GetEnvatoStars($rating) {
		if ((int) $rating == 0) {
			return '<div class="ts_vcsc_not_rating">Not rated yet.</div>';
		}
		$return = '<ul class="ts_vcsc_stars">';
		$i=1;
		while ((--$rating) >= 0) {
			$return .= '<li class="ts_vcsc_full_star"></li>';
			$i++;
		}
		if ($rating == -0.5) {
			$return .= '<li class="ts_vcsc_full_star"></li>';
			$i++;
		}
		while ($i <= 5) {
			$return .= '<li class="ts_vcsc_empty_star"></li>';
			$i++;
		}
		$return .= '</ul>';
		return $return;
	}
}


// Other Utilized Functions
// ------------------------
if (!function_exists('TS_VCSC_IsEditPagePost')){
	function TS_VCSC_IsEditPagePost($new_edit = null){
		global $pagenow, $typenow;
		if (function_exists('vc_is_inline')){
			$vc_is_inline = vc_is_inline();
			if ((!vc_is_inline()) && (!is_admin())) return false;
		} else {
			$vc_is_inline = false;
			if (!is_admin()) return false;
		}
		if ($new_edit == "edit") {
			return in_array($pagenow, array('post.php'));
		} else if ($new_edit == "new") {
			return in_array($pagenow, array('post-new.php'));
		} else if ($vc_is_inline == true) {
			return true;
		} else {
			return in_array($pagenow, array('post.php', 'post-new.php'));
		}
	}
}
if (!function_exists('TS_VCSC_GetPostOptions')){
	function TS_VCSC_GetPostOptions($query_args) {
		$args = wp_parse_args( $query_args, array(
			'post_type' 		=> 'post',
			'posts_per_page'	=> -1,
			'orderby' 			=> 'title',
			'order' 			=> 'ASC',
		) );
		$posts = get_posts( $args );
		$post_options = array();
		if ($posts) {
			foreach ($posts as $post) {
				$post_options[] = array(
					'name' 		=> $post->post_title,
					'value' 	=> $post->ID
				);
			}
		}
		//TS_VCSC_SortMultiArray($post_options, 'name');
		return $post_options;
	}
}
if (!function_exists('TS_VCSC_GetTheCategoryByTax')){
	function TS_VCSC_GetTheCategoryByTax($id = false, $tcat = 'category') {
		$categories = get_the_terms($id, $tcat);
		if ((!$categories) || is_wp_error($categories)) {
			$categories = array();
		}
		$categories = array_values($categories);
		foreach (array_keys($categories) as $key) {
			_make_cat_compat($categories[$key]);
		}
		return apply_filters('get_the_categories', $categories);
	}
}
if (!function_exists('TS_VCSC_GetPluginVersion')){
	function TS_VCSC_GetPluginVersion() {
		$plugin_data 		= get_plugin_data( __FILE__ );
		$plugin_version 	= $plugin_data['Version'];
		return $plugin_version;
	}
}
if (!function_exists('TS_VCSC_VersionCompare')){
	function TS_VCSC_VersionCompare($a, $b) {
		//Compare two sets of versions, where major/minor/etc. releases are separated by dots. 
		//Returns 0 if both are equal, 1 if A > B, and -1 if B < A. 
		$a = explode(".", rtrim($a, ".0")); //Split version into pieces and remove trailing .0 
		$b = explode(".", rtrim($b, ".0")); //Split version into pieces and remove trailing .0 
		//Iterate over each piece of A 
		foreach ($a as $depth => $aVal) {
			if (isset($b[$depth])) {
			//If B matches A to this depth, compare the values 
				if ($aVal > $b[$depth]) {
			return 1; //Return A > B
			//break;
			} else if ($aVal < $b[$depth]) {
			return -1; //Return B > A
			//break;
			}
			//An equal result is inconclusive at this point 
			} else  {
			//If B does not match A to this depth, then A comes after B in sort order 
				return 1; //so return A > B
			//break;
			} 
		} 
		//At this point, we know that to the depth that A and B extend to, they are equivalent. 
		//Either the loop ended because A is shorter than B, or both are equal. 
		return (count($a) < count($b)) ? -1 : 0; 
	}
}
if (!function_exists('TS_VCSC_PluginIsActive')){
	function TS_VCSC_PluginIsActive($plugin_path) {
		$return_var = in_array($plugin_path, apply_filters('active_plugins', get_option('active_plugins')));
		return $return_var;
	}
}
if (!function_exists('TS_VCSC_CheckShortcode')){
	function TS_VCSC_CheckShortcode($shortcode = '') {
		$post_to_check = get_post(get_the_ID());
		// false because we have to search through the post content first
		$found = false;
		// if no short code was provided, return false
		if (!$shortcode) {
			return $found;
		}
		// check the post content for the short code
		if (stripos($post_to_check->post_content, '[' . $shortcode) !== false) {
			// we have found the short code
			$found = true;
		}
		// return our final results
		return $found;
	}
}
if (!function_exists('TS_VCSC_CheckString')){
	function TS_VCSC_CheckString($string = '') {
		$post_to_check = get_post(get_the_ID());
		// false because we have to search through the post content first
		$found = false;
		// if no string was provided, return false
		if (!$string) {
			return $found;
		}
		// check the post content for the short code
		if (stripos($post_to_check->post_content, '' . $string) !== false) {
			// we have found the string
			$found = true;
		}
		// return our final results
		return $found;
	}
}
if (!function_exists('TS_VCSC_GetExtraClass')){
	function TS_VCSC_GetExtraClass($el_class) {
		$output = '';
		if ( $el_class != '' ) {
			$output = " " . str_replace(".", "", $el_class);
		}
		return $output;
	}
}
if (!function_exists('TS_VCSC_endBlockComment')){
	function TS_VCSC_endBlockComment($string) {
		return (!empty($_GET['wpb_debug']) && $_GET['wpb_debug']=='true' ? '<!-- END '.$string.' -->' : '');
	}
}
if (!function_exists('TS_VCSC_GetCSSAnimation')){
	function TS_VCSC_GetCSSAnimation($css_animation) {
		$output = '';
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}
		if ($css_animation != '') {
			if (get_option('ts_vcsc_extend_settings_loadWaypoints', 1) == 1) {
				wp_enqueue_script('ts-extend-waypoints',						TS_VCSC_GetResourceURL('js/jquery.waypoints.min.js'), array('jquery'), false, $FOOTER);
			}
			$output = ' wpb_animate_when_almost_visible wpb_'.$css_animation;
		}
		return $output;
	}
}
if (!function_exists('TS_VCSC_GetFontFamily')){
	function TS_VCSC_GetFontFamily($id, $font_family, $font_type) {
		$url            = plugin_dir_url( __FILE__ );
		$output         = '';
		if ($font_type == 'google') {
			if (!function_exists("my_strstr")) {
				function my_strstr( $haystack, $needle, $before_needle = false ) {
					if ( !$before_needle ) return strstr( $haystack, $needle );
					else return substr( $haystack, 0, strpos( $haystack, $needle ) );
				}
			}
			wp_enqueue_style($font_family, 'http://fonts.googleapis.com/css?family=' .$font_family , null, false, 'all');
			$format_name = strpos($font_family, ':');
			if ($format_name !== false) {
				$google_font =  my_strstr(str_replace( '+', ' ', $font_family), ':', true);
			} else {
				$google_font = str_replace('+', ' ', $font_family);
			}
			//$output .= '<style>#' . $id . ' .ts-icon-title-text {font-family: "' . $google_font . '" !important;}</style>';
			$output .= '<style>#' . $id . ' {font-family: "' . $google_font . '" !important;}</style>';
		} else if ($font_type == 'fontface') {
				$stylesheet = $url . 'assets/fontface/fontface_stylesheet.css';
				$font_dir = FONTFACE_URI;
				if (file_exists( $stylesheet)) {
					$file_content = file_get_contents($stylesheet);
					if (preg_match("/@font-face\s*{[^}]*?font-family\s*:\s*('|\")$font_family\\1.*?}/is", $file_content, $match)) {
						$fontface_style = preg_replace("/url\s*\(\s*['|\"]\s*/is", "\\0$font_dir/", $match[0])."\n";
					}
					$output = "\n<style>" . $fontface_style ."\n";
					$output .= '#' . $id . ' {font-family: "'.$font_family.'" !important;}</style>';
				}
			} else if ($font_type == 'safefont') {
				$output .= '<style>#'.$id.' {font-family: '.$font_family.' !important;}</style>';
			}
		return $output;
	}
}
if (!function_exists('TS_VCSC_GetResourceURL')){
	function TS_VCSC_GetResourceURL($relativePath){
		return plugins_url($relativePath, plugin_basename(__FILE__));
	}
}
if (!function_exists('TS_VCSC_DeleteOptionsPrefixed')){
	function TS_VCSC_DeleteOptionsPrefixed($prefix) {
		global $wpdb;
		$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '{$prefix}%'" );
	}
}
if (!function_exists('TS_VCSC_SortMultiArray')){
	function TS_VCSC_SortMultiArray(&$array, $key) {
		foreach($array as &$value) {
			$value['__________'] = $value[$key];
		}
		/* Note, if your functions are inside of a class, use: 
			usort($array, array("My_Class", 'TS_VCSC_SortByDummyKey'));
		*/
		usort($array, 'TS_VCSC_SortByDummyKey');
		foreach($array as &$value) {   // removes the dummy key from your array
			unset($value['__________']);
		}
		return $array;
	}
}
if (!function_exists('TS_VCSC_SortByDummyKey')){
	function TS_VCSC_SortByDummyKey($a, $b) {
		if($a['__________'] == $b['__________']) return 0;
		if($a['__________'] < $b['__________']) return -1;
		return 1;
	}
}
if (!function_exists('TS_VCSC_CaseInsensitiveSort')){
	function TS_VCSC_CaseInsensitiveSort($a,$b) { 
		return strtolower($b) < strtolower($a); 
	}
}
if (!function_exists('TS_VCSC_getRemoteFile')){
	function TS_VCSC_getRemoteFile($url) {
		// get the host name and url path
		$parsedUrl = parse_url($url);
		$host = $parsedUrl['host'];
		if (isset($parsedUrl['path'])) {
			$path = $parsedUrl['path'];
		} else {
			// the url is pointing to the host like http://www.mysite.com
			$path = '/';
		}
		if (isset($parsedUrl['query'])) {
			$path .= '?' . $parsedUrl['query'];
		}
		if (isset($parsedUrl['port'])) {
			$port = $parsedUrl['port'];
		} else {
			// most sites use port 80
			$port = '80';
		}
		$timeout = 10;
		$response = '';
		// connect to the remote server
		$fp = @fsockopen($host, '80', $errno, $errstr, $timeout );
		if( !$fp ) {
			echo "Cannot retrieve $url";
		} else {
			// send the necessary headers to get the file
			fputs($fp, "GET $path HTTP/1.0\r\n" .
			"Host: $host\r\n" .
			"User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.0.3) Gecko/20060426 Firefox/1.5.0.3\r\n" .
			"Accept: */*\r\n" .
			"Accept-Language: en-us,en;q=0.5\r\n" .
			"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\n" .
			"Keep-Alive: 300\r\n" .
			"Connection: keep-alive\r\n" .
			"Referer: http://$host\r\n\r\n");
			// retrieve the response from the remote server
			while ( $line = fread( $fp, 4096 ) ) {
				$response .= $line;
			}
			fclose( $fp );
			// strip the headers
			$pos = strpos($response, "\r\n\r\n");
			$response = substr($response, $pos + 4);
		}
		// return the file content
		return $response;
	}
}
if (!function_exists('TS_VCSC_retrieveExternalData')){
	function TS_VCSC_retrieveExternalData($url){
		if (ini_get('allow_url_fopen') == '1') {
			//echo 'Using file_get_contents';
			$content = file_get_contents($url);
			if ($content !== false) {}
		} else if (function_exists('curl_init')) {
			//echo 'Using CURL';
			// initialize a new curl resource
			$ch = curl_init();
			$timeout = 5;
			// set the url to fetch
			curl_setopt($ch, CURLOPT_URL, $url);
			// don't give me the headers just the content
			curl_setopt($ch, CURLOPT_HEADER, 0);
			// return the value instead of printing the response to browser
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			// set error timeout
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			// use a user agent to mimic a browser
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
			$content = curl_exec($ch);
			// remember to always close the session and free all resources
			curl_close($ch);
		} else {
			//echo 'Using Others';
			$content = TS_VCSC_getRemoteFile($url);
		}
		return $content;
	}
}
if (!function_exists('TS_VCSC_cURLcheckBasicFunctions')){
	function TS_VCSC_cURLcheckBasicFunctions() {
		if( !function_exists("curl_init") &&
			!function_exists("curl_setopt") &&
			!function_exists("curl_exec") &&
			!function_exists("curl_close") ) return false;
		else return true;
	}
}
if (!function_exists('TS_VCSC_checkValidURL')){
	function TS_VCSC_checkValidURL($url) {
		if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url)) {
			return true;
		} else {
			return false;
		}
	}
}
if (!function_exists('TS_VCSC_makeValidURL')){
	function TS_VCSC_makeValidURL($url) {
		if(strpos($url, 'http://') !== 0) {
			return 'http://' . $url;
		} else {
			return $url;
		}
	}
}
if (!function_exists('TS_VCSC_numberOfDecimals')){
	function TS_VCSC_numberOfDecimals($value) {
		if ((int)$value == $value) {
			return 0;
		} else if (!is_numeric($value)) {
			// throw new Exception('numberOfDecimals: ' . $value . ' is not a number!');
			return false;
		}
		return strlen($value) - strrpos($value, '.') - 1;
	}
}
if (!function_exists('TS_VCSC_RemoveDirectory')){
	function TS_VCSC_RemoveDirectory($dir) { 
		if (is_dir($dir)) { 
			$objects = scandir($dir); 
			foreach ($objects as $object) { 
				if ($object != "." && $object != "..") { 
					if (filetype($dir . "/" . $object) == "dir") {
						TS_VCSC_RemoveDirectory($dir . "/" . $object);
					} else {
						unlink($dir . "/" . $object);
					}
				} 
			} 
			reset($objects); 
			rmdir($dir); 
		}
	}
}
?>