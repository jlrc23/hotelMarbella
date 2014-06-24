<?php

class EasySocialShareButtons {
	
	protected $version = ESSB_VERSION;
	protected $plugin_name = "Easy Social Share Buttons for WordPress";
	protected $plugin_slug = "easy-social-share-buttons";
	
	protected $update_notify_address = "http://fb.creoworx.com/u/";
	
	public static $plugin_settings_name = "easy-social-share-buttons";
	
	public static $instance = null;
	
	public function __construct() {
		// register admin page
		add_action ( 'admin_menu', array ($this, 'init_menu' ) );
		
		add_filter('cron_schedules', array($this, 'addCronSchedule'));
				
		$this->essb_updater_setup_schedule();
		add_action('essb_update', array($this, 'checkForUpdates'));
		
		if (is_admin ()) {
			add_action ( 'admin_enqueue_scripts', array ($this, 'register_admin_assets' ), 1 );
		} else {
			add_action ( 'wp_enqueue_scripts', array ($this, 'register_front_assets' ), 1 );
		}
		
		// update notify
		if(is_admin()){
			$info = get_option($this->plugin_slug . '_update', null);
			if(is_array($info) and $info['update']){
				add_action('admin_notices', array($this, 'addAdminNotice'));
			}
		}
		
		// @since 1.0.1 - Facebook Like Button
		$option = get_option ( self::$plugin_settings_name );
		
		add_action ( 'the_content', array ($this, 'print_share_links' ), 10, 1 );
		$is_excerpt_active = isset($option['display_excerpt']) ? $option['display_excerpt'] : 'false';
		
		// @since 1.1.9
		if ($is_excerpt_active == "true") {
			add_action ( 'the_excerpt', array ($this, 'print_share_links' ), 10, 1 );
		}
		add_shortcode ( 'essb', array ($this, 'handle_essb_shortcode' ) );
		add_shortcode ( 'easy-share', array ($this, 'handle_essb_shortcode' ) );
		add_shortcode ( 'easy-social-share-buttons', array ($this, 'handle_essb_shortcode' ) );
		
		add_action('add_meta_boxes', array ($this, 'handle_essb_metabox' ) );
		
		add_action('save_post',  array ($this, 'handle_essb_save_metabox'));
		//add_filter( 'plugin_action_links', array( $this, 'action_links' ) );
				
		$included_fb_api = isset($option['facebook_like_button_api']) ? $option['facebook_like_button_api'] : '';
		
		/*if ($included_fb_api != 'true') {
			add_action ( 'wp_footer', array ($this, 'init_fb_script' ) );
		}*/
		
		// @since 1.0.4
		$include_vk_api = isset($option['vklike']) ? $option['vklike'] : '';
		
		if ($include_vk_api == 'true') {
			add_action('wp_footer', array($this, 'init_vk_script'));
		}		
			
		// @since 1.0.7 fix for mobile devices don't to pop network names
		$hidden_network_names = (isset($option['hide_social_name']) && $option['hide_social_name']==1) ? true : false;
		if ($hidden_network_names && $this->isMobile()){
			add_action('wp_head', array($this, 'fix_css_mobile_hidden_network_names'));
		}
		
		if ($hidden_network_names && !$this->isMobile()){
			$force_hide = isset($option['force_hide_social_name']) ? $option['force_hide_social_name'] : 'false';
			
			if ($force_hide == 'true') {
				add_action('wp_head', array($this, 'fix_css_mobile_hidden_network_names'));
			} 
		}
		
		// @since 1.1.6
		$custom_float_top = isset($option['float_top']) ? $option['float_top'] : '';
		$custom_float_bg = isset($option['float_bg']) ? $option['float_bg'] : '';
		if ($custom_float_top != '' || $custom_float_bg != '') {
			add_action('wp_head', array($this, 'fix_css_float_from_top'));
		}
		
		// @since 1.1
		add_action ( 'wp_ajax_nopriv_essb_action', array ($this, 'send_email' ) );
		add_action ( 'wp_ajax_essb_action', array ($this, 'send_email' ) );
		
		$woocommerce_share = isset($option['woocommece_share']) ? $option['woocommece_share'] : 'false';
		
		if ($woocommerce_share == "true") {
			add_action('woocommerce_share', array($this, 'handle_woocommerce_share'));
		}
		
		// @since 1.1.7 - wp e-commerce
		//add_action('wpsc_product_before_description',array($this,'handle_wp_ecommerce'));
		
	}
	
	public static function get_instance() {
		
		// If the single instance hasn't been set, set it now.
		if (null == self::$instance)
			self::$instance = new self ();
		
		return self::$instance;
	
	}
	
	/**
	 * Activate plugin
	 */
	public static function activate() {
		$option = get_option ( self::$plugin_settings_name );
		if (! $option || empty ( $option ))
			update_option ( self::$plugin_settings_name, self::default_options () );
	}
	
	public static function deactivate() {
		delete_option ( self::$plugin_settings_name );
		// remove schedule update check
		wp_clear_scheduled_hook('essb_update');
		
	}
	
	public static function default_options() {
		return array ('style' => 1, 'networks' => array ("facebook" => array (1, "Facebook" ), "twitter" => array (1, "Twitter" ), "google" => array (0, "Google+" ), "pinterest" => array (0, "Pinterest" ), "linkedin" => array (0, "LinkedIn" ), "digg" => array (0, "Digg" ), "stumbleupon" => array (0, "StumbleUpon" ), "vk" => array (0, "VKontakte" ), "tumblr" => array(0, "Tumblr"), "print" => array(0, "Print"), "mail" => array (1, "E-mail" ) ), 'show_counter' => 0, 'hide_social_name' => 0, 'target_link' => 1, 'twitter_user' => '', 'display_in_types' => array ('post' ), 'display_where' => 'bottom', 'mail_subject' => __ ( 'Visit this site %%siteurl%%', ESSB_TEXT_DOMAIN ), 'mail_body' => __ ( 'Hi, this may be intersting you: "%%title%%"! This is the link: %%permalink%%', ESSB_TEXT_DOMAIN ), 'colors' => array ("bg_color" => '', "txt_color" => '', 'facebook_like_button' => 'false' ) );
	}
	
	
	public function action_links( $links ) {
	
		$plugin_links = array(
				'<a href="' . admin_url( 'admin.php?page=essb_settings' ) . '">' . __( 'Settings', ESSB_TEXT_DOMAIN ) . '</a>',
		);
	
		return array_merge( $plugin_links, $links );
	}
	
	public function init_menu() {
		add_menu_page ( "Easy Social Share Buttons", "Easy Social Share Buttons", 'edit_pages', "essb_settings", array ($this, 'essb_settings_load' ), ESSB_PLUGIN_URL . '/assets/images/essb_16.png', 113 );
	
	}
	
	public function essb_settings_load() {
		include (ESSB_PLUGIN_ROOT . 'lib/admin/essb-settings.php');
	}
	
	public function register_admin_assets() {
		wp_register_style ( 'essb-admin', ESSB_PLUGIN_URL . '/assets/css/essb-admin.css', array (), $this->version );
		wp_enqueue_style ( 'essb-admin' );

		wp_register_style ( 'essb-fontawsome', ESSB_PLUGIN_URL . '/assets/css/font-awesome.min.css', array (), $this->version );
		wp_enqueue_style ( 'essb-fontawsome' );
		
		wp_enqueue_script( 'jquery-ui-sortable' );
	}
	
	public function register_front_assets() {
		global $post;		
		
		$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
		if (is_array ( $options )) {
			if (is_numeric ( $options ['style'] )) {
				
				$post_theme =  get_post_meta($post->ID,'essb_theme',true);
				if ($post_theme != "" && is_numeric($post_theme)) {
					$options['style'] = intval($post_theme);
				}
				
				$folder = "default";
				
				if ($options ['style'] == 1) { $folder = "default"; }
				if ($options ['style'] == 2) { $folder = "metro"; }
				if ($options ['style'] == 3) { $folder = "modern"; }
				if ($options ['style'] == 4) {
					$folder = "round";
				}
				if ($options ['style'] == 5) {
					$folder = "big";
				}
				if ($options ['style'] == 6) {
					$folder = "metro-retina";
				}
				if ($options ['style'] == 7) {
					$folder = "big-retina";
				}
				
				wp_enqueue_style ( 'easy-social-share-buttons', ESSB_PLUGIN_URL . '/assets/css/' . $folder . '/' . 'easy-social-share-buttons.css', false, $this->version, 'all' );
			}
			
			$post_counters =  get_post_meta($post->ID,'essb_counter',true);
			
			if ($post_counters != '') {
				$options ['show_counter'] = intval($post_counters);
			}
			
			if (is_numeric ( $options ['show_counter'] ) && $options ['show_counter'] == 1) {
				wp_enqueue_script ( 'essb-counter-script', ESSB_PLUGIN_URL . '/assets/js/easy-social-share-buttons.js', array ( 'jquery' ), $this->version, true );
			}
			
			$display_where = isset($options['display_where']) ? $options['display_where'] : '';
			$post_display_where = get_post_meta($post->ID,'essb_position',true);
			if ($post_display_where != "") { $display_where = $post_display_where; }			
			
			if ($display_where == "float") {
				wp_enqueue_script ( 'essb-float-script', ESSB_PLUGIN_URL . '/assets/js/essb-float.js', array ('jquery' ), $this->version, true );
			}
			
			if ($display_where == "sidebar") {
				wp_enqueue_style ( 'easy-social-share-buttons-sidebar', ESSB_PLUGIN_URL . '/assets/css/essb-sidebar.css', false, $this->version, 'all' );
			}

			if ($display_where == "popup") {
				wp_enqueue_style ( 'easy-social-share-buttons-popup', ESSB_PLUGIN_URL . '/assets/css/essb-popup.css', false, $this->version, 'all' );
				wp_enqueue_script ( 'essb-popup-script', ESSB_PLUGIN_URL . '/assets/js/essb-popup.js', array ('jquery' ), $this->version, true );
			}
				
			$plusbutton = isset($options['googleplus']) ? $options['googleplus'] : 'false';
			
			if ($plusbutton == 'true') {
				wp_enqueue_script ( 'essb-google-plusone', 'https://apis.google.com/js/plusone.js', array ('jquery' ), $this->version, true );
			}
			
			// @since 1.1 mail contact form
			wp_enqueue_style ( 'easy-social-share-buttons-mailform', ESSB_PLUGIN_URL . '/assets/css/essb-mailform.css', false, $this->version, 'all' );
			wp_enqueue_script ( 'easy-social-share-buttons-mailform', ESSB_PLUGIN_URL . '/assets/js/essb-mailform.js', array ('jquery' ), $this->version, true );		

			$include_twitter = isset($options['twitterfollow']) ? $options['twitterfollow'] : 'false';
			if ($include_twitter == 'true') {
				//wp_enqueue_script ( 'twitter-essb', 'http://platform.twitter.com/widgets.js', array ('jquery' ) );
			}
			
		}
		
	}
	
	public function get_current_url($mode = 'base') {
		
		$url = 'http' . (is_ssl () ? 's' : '') . '://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'];
		
		switch ($mode) {
			case 'raw' :
				return $url;
				break;
			case 'base' :
				return reset ( explode ( '?', $url ) );
				break;
			case 'uri' :
				$exp = explode ( '?', $url );
				return trim ( str_replace ( home_url (), '', reset ( $exp ) ), '/' );
				break;
			default :
				return false;
		}
	}
	
	public function generate_share_snippet($networks = array(), $counters = 0, $is_current_page_url = 0, $is_shortcode = 0, $custom_share_text = '', $custom_share_address = '', 
			$shortcode_native = 'yes', $shortcode_sidebar = 'no', $shortcode_messages = 'no', $shortcode_popup = 'no', $shortcode_popafter = '', 
			$shortcode_custom_shareimage = '', $shortcode_custom_sharemessage = '', $shortcode_custom_fblike_url = '', $shortcode_custom_pluson_url = '',
			$shortcode_native_show_fblike = 'no', $shortcode_native_show_twitter = 'no', $shortcode_native_show_plusone = 'no', $shortcode_native_show_vk = 'no',
			$shortcode_hide_network_names = 'no', $shortcode_counter_pos = '', $shortcode_sidebar_pos = '') {
	
		global $post;
		$essb_off = get_post_meta($post->ID,'essb_off',true);
		
		if ($essb_off == "true") { $show_me = false; } else {$show_me = true;}
		//		$show_me =  (get_post_meta($post->ID,'essb_off',true)== 1) ? false : true;			
		$show_me = 	$is_shortcode ? true : $show_me;
		//print $show_me;
		$post_display_where = get_post_meta($post->ID,'essb_position',true);
		$post_hide_network_names = get_post_meta($post->ID,'essb_names',true);
		
		$post_hide_fb = get_post_meta($post->ID,'essb_hidefb',true);
		$post_hide_plusone = get_post_meta($post->ID,'essb_hideplusone',true);
		$post_hide_vk = get_post_meta($post->ID,'essb_hidevk',true);
		$post_hide_twitter = get_post_meta($post->ID, 'essb_hidetwitter', true);
		
		// @since 1.2.1
		$shortcode_force_fblike = false;
		$shortcode_force_twitter = false;
		$shortcode_force_vk = false;
		$shortcode_force_plusone = false;
		if ($is_shortcode) {
			if ($shortcode_native_show_fblike == "yes") { $post_hide_fb = "no"; $shortcode_force_fblike = true; }
			if ($shortcode_native_show_plusone == "yes") { $post_hide_plusone = "no"; $shortcode_force_plusone = true; }
			if ($shortcode_native_show_twitter == "yes") { $post_hide_twitter = "no"; $shortcode_force_twitter = true; }
			if ($shortcode_native_show_vk == "yes") { $post_hide_vk = "no"; $shortcode_force_vk = true; }
			
			if ($shortcode_hide_network_names == "yes") { $post_hide_network_names = '1'; }
		}
		
		$post_sidebar_pos = get_post_meta($post->ID, 'essb_sidebar_pos', true);
		$post_counter_pos = get_post_meta($post->ID, 'essb_counter_pos', true);
		
		// @since 1.2.1
		if ($is_shortcode && $shortcode_counter_pos != '' ) {
			$post_counter_pos = $shortcode_counter_pos;
		}
		
		if ($is_shortcode && $shortcode_sidebar_pos != '') {
			$post_sidebar_pos = $shortcode_sidebar_pos;
		}
		
		// custom_share_message_address		
		$post_essb_post_share_message = get_post_meta($post->ID, 'essb_post_share_message', true);
		$post_essb_post_share_url = get_post_meta($post->ID, 'essb_post_share_url', true);
		$post_essb_post_share_image = get_post_meta($post->ID, 'essb_post_share_image', true);
		$post_essb_post_share_text = get_post_meta($post->ID, 'essb_post_share_text', true);
		$post_essb_post_fb_url = get_post_meta($post->ID, 'essb_post_fb_url', true);
		$post_essb_post_plusone_url = get_post_meta($post->ID, 'essb_sidebar_pos', true);
		
		$salt = mt_rand ();
		
		// show buttons only if post meta don't ask to hide it, and if it's not a shortcode.
		if ( $show_me ) {
	
			// texts, URL and image to share
			$text = esc_attr(urlencode($post->post_title));
			$url = $post ? get_permalink() : $this->get_current_url( 'raw' );
			//$url = urlencode(get_permalink());
			if ( $is_current_page_url ) {
				$url = $this->get_current_url( 'raw' );
			}
			$url = apply_filters('essb_the_shared_permalink', $url);
			$image = has_post_thumbnail( $post->ID ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ) : '';
	
			$pinterest_image = ($image != '') ? $image[0] : '';
			$pinterest_desc = $post->post_excerpt;
			$post_image = ($image != '') ? $image[0] : '';
			$post_desc = $post->post_excerpt;
			
			// some markup filters
			$hide_intro_phrase 			= apply_filters('eesb_network_name', false);
			$share_the_post_sentence 	= apply_filters('eesb_intro_phrase_text', __('Share the post',ESSB_TEXT_DOMAIN) );
			$before_the_sps_content 	= apply_filters('eesb_before_the_snippet', '');
			$after_the_sps_content 		= apply_filters('eesb_after_the_snippet', '');
			$before_the_list 			= apply_filters('eesb_before_the_list', '');
			$after_the_list 			= apply_filters('eesb_after_the_list', '');
			$before_first_i 			= apply_filters('eesb_before_first_item', '');
			$after_last_i 				= apply_filters('eesb_after_last_item', '');
			$container_classes 			= apply_filters('eesb_container_classes', '');
			$rel_nofollow 				= apply_filters('eesb_links_nofollow', 'rel="nofollow"');
	
			// markup filters
			$div 	= apply_filters('eesb_container_tag', 'div');
			$p 		= apply_filters('eesb_phrase_tag', 'p');
			$ul 	= apply_filters('eesb_list_container_tag', 'ul');
			$li 	= apply_filters('eesb_list_of_item_tag', 'li');
	
	
			// get the plugin options
			$options = get_option(  EasySocialShareButtons::$plugin_settings_name );
	
			// classes and attributes options
			$target_link = (isset($options['target_link']) && $options['target_link']==1) ? ' target="_blank"' : '';
			$hidden_name_class = (isset($options['hide_social_name']) && $options['hide_social_name']==1) ? ' essb_hide_name' : '';
			$container_classes .= (intval($counters)==1) ? ' essb_counters' : '';
			$counter_pos = isset($options['counter_pos']) ? $options['counter_pos'] : '';
			
			if ($post_counter_pos != '') { $counter_pos = $post_counter_pos; }
			
			$url_short_native = isset($options['url_short_native']) ? $options['url_short_native'] : 'false';
			$url_short_google = isset($options['url_short_google']) ? $options['url_short_google'] : 'false';
			
			$custom_like_url_active = (isset($options['custom_url_like'])) ? $options['custom_url_like'] : 'false'; 
			$custom_like_url = (isset($options['custom_url_like_address'])) ? $options['custom_url_like_address'] : '';
			$custom_plusone_address = (isset($options['custom_url_plusone_address'])) ? $options['custom_url_plusone_address'] : '';//custom_url_plusone_address

			$native_counters = (isset($options['native_social_counters'])) ? $options['native_social_counters'] : 'false'; 
			$native_counters_fb = (isset($options['native_social_counters_fb'])) ? $options['native_social_counters_fb'] : 'false';
			$native_counters_g = (isset($options['native_social_counters_g'])) ? $options['native_social_counters_g'] : 'false';
			$native_counters_t = (isset($options['native_social_counters_t'])) ? $options['native_social_counters_t'] : 'false';
			
			$force_hide_total_count = isset($options['force_hide_total_count']) ? $options['force_hide_total_count'] : 'false';
			
			$native_lang = isset($options['native_social_language']) ? $options['native_social_language'] : "en";
				
			// @since 1.1.5 popup
			$popup_window_title = (isset($options['popup_window_title'])) ? $options['popup_window_title'] : '';
			$popup_window_close = (isset($options['popup_window_close_after'])) ? $options['popup_window_close_after'] : '';
			
			// @since 1.1.7
			$custom_sidebar_pos = (isset($options['sidebar_pos'])) ? $options['sidebar_pos'] : '';
			if ($post_sidebar_pos != '') { $custom_sidebar_pos = $post_sidebar_pos; }
			if ($custom_sidebar_pos == "left") { $custom_sidebar_pos = ""; }
			
			// @since 1.1.6 popafter
			$popup_popafter = (isset($options['popup_window_popafter'])) ? $options['popup_window_popafter'] : '';
 			if ($is_shortcode && $shortcode_popafter != '') {
				$popup_popafter = $shortcode_popafter;
			}

			// @since 1.2.1
			
			if ($post_essb_post_fb_url != '' || $post_essb_post_plusone_url != '') { 
				$custom_like_url_active = "true";
				if ($post_essb_post_fb_url != '') { $custom_like_url = $post_essb_post_fb_url; }
				if ($post_essb_post_plusone_url != '' ) { $custom_plusone_address = $post_essb_post_plusone_url; }
			}
			
			if ($is_shortcode && ($shortcode_custom_fblike_url != '' || $shortcode_custom_pluson_url != '')) { $custom_like_url_active = "true"; }
			if ($is_shortcode && $shortcode_custom_fblike_url != '') { $custom_like_url = $shortcode_custom_fblike_url; }
			if ($is_shortcode && $shortcode_custom_pluson_url != '') {
				$custom_plusone_address = $shortcode_custom_pluson_url;
			}
			
			if ($custom_like_url_active == 'false') { $custom_like_url = ""; $custom_plusone_address = ""; }
			
			if ($url_short_native == 'true') {
				$short_url = wp_get_shortlink();
				if ($short_url != '') { $url = $short_url;}
			}
			
			if ($url_short_google == 'true') { 
				$url = $this->google_shorten($url);
			}
	
			// custom share message
			$active_custom_message =isset($options['customshare']) ? $options['customshare'] : 'false';
			$is_from_customshare = false;
			
			$custom_share_imageurl = isset($options['customshare_imageurl']) ? $options['customshare_imageurl'] : '';
			$custom_share_description = isset($options['customshare_description']) ? $options['customshare_description'] : '';
				
			// @since 1.2.1
			if ($post_essb_post_share_image != '' || $post_essb_post_share_message != '' || $post_essb_post_share_text != '' || $post_essb_post_share_url != '') {
				$active_custom_message = "true";
				
				if ($post_essb_post_share_image != '') { $custom_share_imageurl = $post_essb_post_share_image; }
				if ($post_essb_post_share_message != '') { $custom_share_text = $post_essb_post_share_message; }
				if ($post_essb_post_share_text != '') { $custom_share_description = $post_essb_post_share_text; }
				if ($post_essb_post_share_url != '') { $custom_share_address = $post_essb_post_share_url; }
			}
			
			
			if ($is_shortcode && $shortcode_custom_sharemessage != '') {
				$custom_share_description = $shortcode_custom_sharemessage;
			}
			if ($is_shortcode && $shortcode_custom_sharemessage != '') {
				$custom_share_imageurl = $shortcode_custom_shareimage;
			}
			
			$pinterest_sniff_disable = isset($options['pinterest_sniff_disable']) ? $options['pinterest_sniff_disable'] : 'false';
			
			$include_twitter = isset($options['twitterfollow']) ? $options['twitterfollow'] : 'false';
			$include_twitter_user = isset($options['twitterfollowuser']) ? $options['twitterfollowuser'] : '';
			
			$append_twitter_user_to_message = isset($options['twitteruser']) ? $options['twitteruser'] : '';
			$append_twitter_hashtags = isset($options['twitterhashtags']) ? $options['twitterhashtags'] : '';
			$twitter_nojspop = isset($options['twitter_nojspop']) ? $options['twitter_nojspop'] : 'false';
				
			// @since 1.1.1
			$otherbuttons_sameline = isset($options['otherbuttons_sameline']) ? $options['otherbuttons_sameline'] : 'false';
			
			if ($custom_share_text == '' && $active_custom_message == 'true') {
				$custom_share_text = isset($options['customshare_text']) ? $options['customshare_text'] : '';
				
			}
			if ($custom_share_text != '') {
				$text = $custom_share_text;
				$is_from_customshare = true;
			}
				
			if ($custom_share_address == '' && $active_custom_message == 'true') {
				$custom_share_address = isset($options['customshare_url']) ? $options['customshare_url'] : '';
				
			}
			if ($custom_share_address != '') {
				$url = $custom_share_address;
			}
			
			if ($custom_share_description != '' && $active_custom_message == 'true') {
				$pinterest_desc = $custom_share_description;
			}
				
			if ($custom_share_imageurl != '' && $active_custom_message == 'true') {
				$pinterest_image = $custom_share_imageurl;
			}
			
			// other options
			$display_where = isset($options['display_where']) ? $options['display_where'] : '';
			
			if ($post_display_where != '') { $display_where = $post_display_where; }
			if ($post_hide_network_names == '1') {
				$hidden_name_class = ' essb_hide_name';
			}
			
			// @since 1.1.3
			if ($is_shortcode) { $display_where = "shortcode"; }
			if ($is_shortcode && $shortcode_sidebar == 'yes') { $display_where = "sidebar"; }
			if ($is_shortcode && $shortcode_popup == 'yes') { $display_where = "popup"; }
			
			if ($display_where == "popup") {
				$container_classes = "essb_popup_counters";
			}
			
			if ($display_where != "sidebar") {
				$custom_sidebar_pos = "";
			}
			else {
				if ($custom_sidebar_pos != '') {
					$custom_sidebar_pos = "_".$custom_sidebar_pos;
				}
			}
			
			//print "display where = " . $display_where;
			//print $native_counters_g;
			
			$force_pinterest_snif = 1;
			if ($pinterest_sniff_disable == 'true') { $force_pinterest_snif = 0; }

			if ($custom_like_url == "") { $custom_like_url = $url; }
			if ($custom_plusone_address == "") { $custom_plusone_address = $url; }
			
			$user_network_messages = isset($options['network_message']) ? $options['network_message'] : '';
			
			$message_above_share = isset($options['message_share_buttons']) ? $options['message_share_buttons'] : '';
			$message_above_like = isset($options['message_like_buttons']) ? $options['message_like_buttons'] : '';
			
			if ($message_above_share != "" && !$is_shortcode) { $before_the_list .= '<div class="essb_message_above_share">'.$message_above_share."</div>";}
			if ($message_above_share != "" && $is_shortcode && $shortcode_messages == "yes") {  $before_the_list .= '<div class="essb_message_above_share">'.$message_above_share."</div>"; }
			
			// @developer fix to attach class for template
			$loaded_template_id = isset($options ['style']) ? $options ['style']  : '';
				
			$post_theme =  get_post_meta($post->ID,'essb_theme',true);
			if ($post_theme != "" && is_numeric($post_theme)) {
				$loaded_template_id = intval($post_theme);
			}
				
			$loaded_template_id = intval($loaded_template_id);
			$loaded_template = "default";
				
			if ($loaded_template_id == 1) {
				$loaded_template = "default";
			}
			if ($loaded_template_id == 2) {
				$loaded_template = "metro";
			}
			if ($loaded_template_id == 3) {
				$loaded_template = "modern";
			}
			if ($loaded_template_id == 4) {
				$loaded_template = "round";
			}
			if ($loaded_template_id == 5) {
				$loaded_template = "big";
			}
			if ($loaded_template_id == 6) {
				$loaded_template = "metro-retina";
			}
			if ($loaded_template_id == 6) {
				$loaded_template = "big-retina";
			}
				
			// beginning markup
			$block_content = $before_the_sps_content;
			$block_content .= "\n".'<'.$div.' class="essb_links '.$container_classes.' essb_displayed_'.$display_where.$custom_sidebar_pos.' essb_template_'.$loaded_template.'" id="essb_displayed_'.$display_where.'">';
			$block_content .= $hide_intro_phrase ? '' : "\n".'<'.$p.' class="screen-reader-text essb_maybe_hidden_text">'.$share_the_post_sentence.' "'.get_the_title().'"</'.$p.'>'."\n";
			$block_content .= $before_the_list;
			$block_content .= "\n\t".'<'.$ul.' class="essb_links_list'.$hidden_name_class.'">';
			$block_content .= $before_first_i;
	
			// networks to display
			// 2 differents results by :
			// -- using hook (options from admin panel)
			// -- using shortcode/template-function (the array $networks in parameter of this function)
			$essb_networks = array();
	
			if ( count($networks) > 0 ) {
				$essb_networks = array();
				foreach($options['networks'] as $k => $v) {
					if(in_array($k, $networks)) {
						$essb_networks[$k]=$v;
						$essb_networks[$k][0]=1; //set its visible value to 1 (visible)
					}
				}
	
			}
			else {
				$essb_networks = $options['networks'];
			}
	
	
			$active_fb = false;		
			$active_pinsniff = false;		
			$active_mail = false;	
			$message_body = "";
			$message_subject = "";		

			// each links (come from options or manual array)
			foreach($essb_networks as $k => $v) {
				if( $v[0] == 1 ) {
					$api_link = $api_text = '';
					$url = apply_filters('essb_the_shared_permalink_for_'.$k, $url);
	
					$twitter_user = '';

					if ($append_twitter_user_to_message != '' ) { $twitter_user .= '&amp;related='.$append_twitter_user_to_message.'&amp;via='.$append_twitter_user_to_message; }
					//$twitter_user .= '&amp;hashtags=demo,demo1,demo2';
					if ($append_twitter_hashtags != '') {
						$twitter_user .= '&amp;hashtags='.$append_twitter_hashtags;
					}
					
					switch ($k) {
						case "twitter" :
							$api_link = 'https://twitter.com/intent/tweet?source=webclient&amp;original_referer='.$url.'&amp;text='.$text.'&amp;url='.$url.$twitter_user;
							$api_text = apply_filters('essb_share_text_for_'.$k, __('Share this article on Twitter',ESSB_TEXT_DOMAIN));
							
							if ($user_network_messages != '') {
								$custom_text = isset($user_network_messages[$k]) ? $user_network_messages[$k] : '';
								if ($custom_text != "") { $api_text = $custom_text; }
							}
							
							break;
	
						case "facebook" :
							$api_link = 'https://www.facebook.com/sharer/sharer.php?s=100&p[url]='.$url.'&p[title]='.$text;
							if ($post_image != '') {
								$api_link .= '&p[images][0]='.$post_image;
							}
							if (!$post_desc != '') {
								$api_link .= '&p[summary]='.$post_desc;
							}
							
							if ($is_from_customshare) {
								$api_link = 'https://www.facebook.com/sharer/sharer.php?s=100&p[url]='.$url.'&p[title]='.$text;
								
								if ($custom_share_description != '') {
									$api_link .= '&p[summary]='.$custom_share_description; 
								}
								// @ fix in 1.0.8
								if ($custom_share_imageurl != '') {
									$api_link .= '&p[images][0]='.$custom_share_imageurl;
								}	

								$api_link = preg_replace(array('#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#'), array(get_the_title(), get_site_url(), get_permalink()), $api_link);
								
							}
							
							$api_text = apply_filters('essb_share_text_for_'.$k, __('Share this article on Facebook',ESSB_TEXT_DOMAIN));
							break;
	
						case "google" :
							$api_link = 'https://plus.google.com/share?url='.$url;
							$api_text = apply_filters('essb_share_text_for_'.$k, __('Share this article on Google+',ESSB_TEXT_DOMAIN));
							break;
	
						case "pinterest" :
							if ( $pinterest_image != '' && $force_pinterest_snif==0 ) {
								$api_link = 'http://pinterest.com/pin/create/bookmarklet/?media='.$pinterest_image.'&amp;url='.$url.'&amp;title='.$text.'&amp;description='.$pinterest_desc;
								$api_link = preg_replace(array('#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#'), array(get_the_title(), get_site_url(), get_permalink()), $api_link);								
							}
							else {
								//$api_link = "javascript:void((function(){var%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());";
								$api_link = "javascript:essb_pinterenst();";
								$target_link = "";
								$active_pinsniff = true;
							}
							$api_text = apply_filters('essb_share_text_for_'.$k, __('Share an image of this article on Pinterest',ESSB_TEXT_DOMAIN));
							break;
	
	
						case 'linkedin':
							$api_link = "http://www.linkedin.com/shareArticle?mini=true&amp;ro=true&amp;trk=EasySocialShareButtons&amp;title=".$text."&amp;url=".$url;
							$api_text = apply_filters('essb_share_text_for_'.$k, __('Share this article on LinkedIn',ESSB_TEXT_DOMAIN));
							break;
	
						case 'digg':
							$api_link = "http://digg.com/submit?phase=2%20&amp;url=".$url."&amp;title=".$text;
							$api_text = apply_filters('essb_share_text_for_'.$k, __('Share this article on Digg',ESSB_TEXT_DOMAIN));
							break;
	
						case 'stumbleupon':
							$api_link = "http://www.stumbleupon.com/badge/?url=".$url;
							$api_text = apply_filters('essb_share_text_for_'.$k, __('Share this article on StumbleUpon',ESSB_TEXT_DOMAIN));
							break;
	
							case 'tumblr':
							$api_link = "http://tumblr.com/share?s=&v=3&t=".$text."&u=".urlencode($url);
							$api_text = apply_filters('essb_share_text_for_'.$k, __('Share this article on Tumblr',ESSB_TEXT_DOMAIN));
							break;
									
	
						case 'vk':
							$api_link = "http://vkontakte.ru/share.php?url=".$url;
							$api_text = apply_filters('essb_share_text_for_'.$k, __('Share this article on VKontakte',ESSB_TEXT_DOMAIN));
							break;
	
						case 'print':
							$api_link = "javascript:window.print();";
							$api_text = apply_filters('essb_share_text_for_'.$k, __('Print this article',ESSB_TEXT_DOMAIN));
							break;	
							
						case 'mail' :
							if (strpos($options['mail_body'], '%%') || strpos($options['mail_subject'], '%%') ) {
								$api_link = esc_attr('mailto:?subject='.$options['mail_subject'].'&amp;body='.$options['mail_body']);
								$api_link = preg_replace(array('#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#'), array(get_the_title(), get_site_url(), get_permalink()), $api_link);
								
							}
							else {
								$api_link = 'mailto:?subject='.$options['mail_subject'].'&amp;body='.$options['mail_body']." : ".$url;
							}
							$message_subject = $options['mail_subject'];
							$message_body = $options['mail_body'];
							$message_subject = preg_replace(array('#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#'), array(get_the_title(), get_site_url(), get_permalink()), $message_subject);
							$message_body = preg_replace(array('#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#'), array(get_the_title(), get_site_url(), get_permalink()), $message_body);
							
							$api_link = "#";
							
							$api_text = apply_filters('essb_share_text_for_'.$k, __('Share this article with a friend (email)',ESSB_TEXT_DOMAIN));
							$active_mail = true;
							break;
					}
	
					$network_name = isset($v[1]) ? $v[1] : $k;
					
					if ($k != 'mail' && $k != 'pinterest') {
						if ($k == "print") {
							$block_content .= '<'.$li.' class="essb_item essb_link_'.$k.'"><a href="'.$api_link.'" '.$rel_nofollow.' title="'.$api_text.'"'.$target_link.' return false;"><span class="essb_icon"></span><span class="essb_network_name">'.$network_name.'</span></a></'.$li.'>';								
						}
						else {
							
							if ($k == "twitter") {
								if ($twitter_nojspop == 'true') {
									$block_content .= '<'.$li.' class="essb_item essb_link_'.$k.'"><a href="'.$api_link.'" '.$rel_nofollow.' title="'.$api_text.'"'.$target_link.'><span class="essb_icon"></span><span class="essb_network_name">'.$network_name.'</span></a></'.$li.'>';
								}
								else {
									$block_content .= '<'.$li.' class="essb_item essb_link_'.$k.'"><a href="'.'#'.'" '.$rel_nofollow.' title="'.$api_text.'"'.$target_link.' onclick="essb_window'.$salt.'(\''.$api_link.'\'); return false;"><span class="essb_icon"></span><span class="essb_network_name">'.$network_name.'</span></a></'.$li.'>';
								}
							}
							else {
								$block_content .= '<'.$li.' class="essb_item essb_link_'.$k.'"><a href="'.$api_link.'" '.$rel_nofollow.' title="'.$api_text.'"'.$target_link.' onclick="essb_window'.$salt.'(\''.$api_link.'\'); return false;"><span class="essb_icon"></span><span class="essb_network_name">'.$network_name.'</span></a></'.$li.'>';
							}
						}						
					}
					else {
						if ($k == 'pinterest') {
							if (! $active_pinsniff) {
								$block_content .= '<' . $li . ' class="essb_item essb_link_' . $k . '"><a href="' . $api_link . '" ' . $rel_nofollow . ' title="' . $api_text . '"' . $target_link . ' onclick="essb_window'.$salt.'(\'' . $api_link . '\'); return false;"><span class="essb_icon"></span><span class="essb_network_name">' . $network_name . '</span></a></' . $li . '>';
							} else {
								$block_content .= '<' . $li . ' class="essb_item essb_link_' . $k . '"><a href="' . $api_link . '" ' . $rel_nofollow . ' title="' . $api_text . '"' . $target_link . '><span class="essb_icon"></span><span class="essb_network_name">' . $network_name . '</span></a></' . $li . '>';
							}
						} else {
							$block_content .= '<' . $li . ' class="essb_item essb_link_' . $k . '"><a id="essb-mailform" href="' . $api_link . '" ' . $rel_nofollow . ' title="' . $api_text . '"><span class="essb_icon"></span><span class="essb_network_name">' . $network_name . '</span></a></' . $li . '>';
						}
					}
	
				}
			}
			
			
			$post_counters =  get_post_meta($post->ID,'essb_counter',true);
				
			if ($post_counters != '') {
				$options ['show_counter'] = $post_counters;
			}

			$include_plusone_button = isset($options['googleplus']) ? $options['googleplus'] : 'false';
			$include_fb_likebutton = isset($options['facebook_like_button']) ? $options['facebook_like_button'] : '';
			$include_vklike = isset($options['vklike']) ? $options['vklike'] : '';
		
			// @since 1.2.1
			if ($shortcode_force_fblike) { $include_fb_likebutton = "true"; }
			if ($shortcode_force_plusone) { $include_plusone_button = "true"; }
			if ($shortcode_force_twitter) { $include_twitter = "true"; }
			if ($shortcode_force_vk) { $include_vklike = "true"; }
			
			if ($post_hide_fb == 'yes') {
				$include_fb_likebutton = 'false';
			}
			if ($post_hide_plusone == 'yes') {
				$include_plusone_button = 'false';
			}
			if ($post_hide_vk == 'yes') {
				$include_vklike = 'false';
			}
			
			if ($post_hide_twitter == 'yes') { $include_twitter = 'false'; $include_twitter_user = ''; }
				
			if ($shortcode_native == 'no') {
				
				$include_fb_likebutton = 'false';
				$include_plusone_button = 'false';
				$include_vklike = 'false';
				$include_twitter = 'false'; $include_twitter_user = '';
			}
			
			if ($shortcode_native == "selected") {
				if (!$shortcode_force_fblike) { $include_fb_likebutton = 'false'; }
				if (!$shortcode_force_plusone) { $include_plusone_button = 'false'; }
				if (!$shortcode_force_vk) { $include_vklike = 'false'; }
				if (!$shortcode_force_twitter) { $include_twitter = 'false'; $include_twitter_user = ''; }
			}
			
			$general_counters = (isset($options['show_counter']) && $options['show_counter']==1) ? 1 : 0;
			$hidden_info = '<input type="hidden" class="essb_info_plugin_url" value="'.ESSB_PLUGIN_URL.'" /><input type="hidden" class="essb_info_permalink" value="'.$url.'" />';
			// counter_pos
			if (($general_counters==1 && intval($counters)==1) || ($general_counters==0 && intval($counters)==1)) {
				$hidden_info .= '<input type="hidden" class="essb_info_counter_pos" value="'.$counter_pos.'" />';
			}
			
			$block_content .= $after_last_i;
			$block_content .= (($general_counters==1 && intval($counters)==1) || ($general_counters==0 && intval($counters)==1)) ? '<li class="essb_item essb_totalcount_item" '.($force_hide_total_count == 'true' ? 'style="display: none !important;"' : '').'><span class="essb_totalcount" title="'.__('Total: ', ESSB_TEXT_DOMAIN).'"><span class="essb_t_nb"></span></span></li>' : '';
			
			// @since 1.1.1
			if ($otherbuttons_sameline == 'true') {

				if ($include_plusone_button == 'true') {
					$block_content .= '<li class="essb_item essb_native_item essb_native_plusone_item"><div>'.$this->print_plusone_button($custom_plusone_address, $native_counters_g, $native_lang).'</div></li>';
				}
				
				if ($include_twitter == 'true') {
					$block_content .= '<li class="essb_item essb_native_item essb_native_twitter_item"><div>'.$this->print_twitter_follow_button($include_twitter_user, $native_counters_t, $native_lang).'</div></li>';
				}
				
				
				if ($include_vklike == 'true') {
					$block_content .= '<li class="essb_item essb_native_item essb_native_vk_item"><div>'.$this->print_vklike_button($custom_like_url, $native_counters).'</div></li>';
				}
				
				if ($include_fb_likebutton == 'true') {
					$block_content .= '<li class="essb_item essb_native_item essb_native_facebook_item"><div>'.$this->print_fb_likebutton($custom_like_url, $native_counters_fb).'</div></li>';
				}
				
			}
			
			$block_content .= '</'.$ul.'>'."\n\t";
			$block_content .= $after_the_list;
			$block_content .= ( ($general_counters==1 && intval($counters)==1) || ($general_counters==0 && intval($counters)==1))  ? $hidden_info : '';
							
			if ($otherbuttons_sameline != 'true') {
				if ($include_fb_likebutton == 'true' || $include_plusone_button == 'true' || $include_vklike == 'true' || $include_twitter == 'true') {
					
					if ($message_above_like != "" && !$is_shortcode) {
						$block_content .= '<div class="essb_message_above_like">'.$message_above_like."</div>";
					}
					
					if ($message_above_like != "" && $is_shortcode && $shortcode_messages == "yes") {
						$block_content .= '<div class="essb_message_above_share">'.$message_above_like."</div>";
					}
						
						
					
					$block_content .= '<div style="display: block; width: 100%; padding-top: 3px !important; overflow: hidden; padding-right: 10px;" class="essb_native">';				
				}
				
				if ($include_plusone_button == 'true') {
					//$block_content .= '<'.$div.' class="" style="position: relative; float: left;">'.$this->print_plusone_button($url).'</'.$div.'>';		
					$block_content .= $this->print_plusone_button($custom_plusone_address, $native_counters_g, $native_lang);		
				}

				if ($include_twitter == 'true') {
					$block_content .= $this->print_twitter_follow_button($include_twitter_user, $native_counters_t, $native_lang);
				}
				
				if ($include_vklike == 'true') {
					$block_content .= $this->print_vklike_button($custom_like_url, $native_counters);
				}
				
				if ($include_fb_likebutton == 'true') {
					//$block_content .= '<'.$div.' class="" style="postion: relative; float: left; padding-top:3px !important;">'.$this->print_fb_likebutton($url).'</'.$div.'>';
					$block_content .= $this->print_fb_likebutton($custom_like_url, $native_counters_fb);
				}
				
				// @since 1.1.1 added vklike
				if ($include_fb_likebutton == 'true' || $include_plusone_button == 'true' || $include_vklike == 'true' || $include_twitter == 'true') {
					$block_content .= '</div>';
				}
			}
				
			$block_content .= '</'.$div.'>'."\n\n";
			$block_content .= $after_the_sps_content;
	
			$block_content .= '<script type="text/javascript">';
			$block_content .= 'function essb_window'.$salt.'(oUrl) { window.open( oUrl, "essb_share_window", "height=300,width=550,resizable=1" );  }';
			$block_content .= "function essb_pinterenst() { var e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)};";
			//$block_content .= 'jQuery(document).ready(function() {
            //jQuery(\'.essb_link_facebook\').tooltipster({interactive: true});
			//jQuery(\'.essb_link_facebook\').tooltipster(\'update\', jQuery(\'#essb_fb_commands\').html());
			//
			//});';
			
			$block_content .= '</script>';
			
			if ($active_mail) {
				$block_content .= $this->print_popup_mailform($message_subject, $message_body);
			}
			
			$block_content .= '<input type="hidden" name="essb_settings_popup_title" id="essb_settings_popup_title" value="'.stripslashes($popup_window_title).'"/>';
			$block_content .= '<input type="hidden" name="essb_settings_popup_close" id="essb_settings_popup_close" value="'.$popup_window_close.'"/>';
			$block_content .= '<input type="hidden" name="essb_settings_popup_template" id="essb_settings_popup_template" value="'.$loaded_template.'"/>';
			if ($popup_popafter != "") {
				$block_content .= '<input type="hidden" name="essb_settings_popup_popafter" id="essb_settings_popup_popafter" value="'.$popup_popafter.'"/>';
				$block_content .= '<div style="display: none;" id="essb_settings_popafter_counter"></div>';
			}
			
			if ((intval($counters)==1)) {
				$block_content .= '<input type="hidden" name="essb_settings_popup_counters" id="essb_settings_popup_counters" value="yes"/>';
			}
							
			//$block_content .= '<div id="essb_fb_commands" style="display: block;">'.$this->print_fb_sharebutton($url).$this->print_fb_likebutton($url). '</div>';
	
			// final markup
	
			return $block_content;
	
		} // end of if post meta hide sharing buttons
	
	} 
	
	public function print_vklike_button($address, $native_counters) {
		$output = '<div class="essb-vk" style="display: inline-block;vertical-align: top;overflow: hidden;height: 20px;width: 100px !important;"><div id="vk_like" style="float: left; poistion: relative;"></div></div>';
		
		return $output;
	}
	
	function print_plusone_button($address, $native_counters, $native_lang) {
		if ($native_counters == "false") {
		$output = '<div style="float: left; overflow: hidden; height: 24px; max-height: 24px; margin-left: 5px; margin-right: 10px;"><div class="g-plusone" data-size="medium" data-href="'.$address.'" data-annotation="none"></div></div>';
		}
		else {
			$output = '<div style="float: left; overflow: hidden; height: 24px; max-height: 24px; margin-left: 5px;"><div class="g-plusone" data-size="medium" data-href="'.$address.'"></div></div>';				
		}
		
		return $output;
	}
	
	function print_fb_likebutton($address, $native_counters) {
		if ($native_counters == "false") {
			$output = '<div style="float: left; overflow: hidden; height: 24px; max-height: 24px; padding-right: 20px; width: 30px !important;"><div class="fb-like" data-href="'.$address.'" data-layout="button" data-action="like" data-show-faces="false" data-share="false" data-width="292"></div></div>';				
		}
		else {
		$output = '<div style="float: left; overflow: hidden; height: 24px; max-height: 24px; padding-right: 20px;"><div class="fb-like" data-href="'.$address.'" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false" data-width="292"></div></div>';
		}
		
		return $output;
	}
	
	function print_twitter_follow_button($user, $native_counters, $native_lang) {
		//$output = '<a href="https://twitter.com/'.$user.'" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false" data-size="small">Follow @'.$user.'</a>';
		// data counter false = 65
		if ($native_counters == "false") {
		$output = '<div style="float: left; overflow: hidden; height: 24px; max-height: 24px; margin-left: 5px;"><iframe allowtransparency="true" frameborder="0" scrolling="no" src="//platform.twitter.com/widgets/follow_button.html?screen_name='.$user.'&show_count=false&show_screen_name=false&lang='.$native_lang.'" style="width:65px; height:20px;"></iframe></div>';
		}
		else {
			$output = '<div style="float: left; overflow: hidden; height: 24px; max-height: 24px; margin-left: 5px;"><iframe allowtransparency="true" frameborder="0" scrolling="no" src="//platform.twitter.com/widgets/follow_button.html?screen_name='.$user.'&show_count=true&show_screen_name=false&lang='.$native_lang.'" style="width:155px; height:20px;"></iframe></div>';				
		}
	
		return $output;
	}
	
	function print_fb_sharebutton($address) {
		$output = '<div class="fb-share-button" data-href="'.$address.'" data-type="button"></div>';
		
		return $output;
	}
	
	public function print_popup_mailform($title, $text) {
		$salt = mt_rand ();
		$mailform_id = 'essb_mail_from_'.$salt;
		
		$text =nl2br($text);
		$text = str_replace("\r", "", $text);
		$text = str_replace("\n", "", $text);
		$siteurl = ESSB_PLUGIN_URL. '/';
		//$open = 'javascript:PopupContact_OpenForm("PopupContact_BoxContainer","PopupContact_BoxContainerBody","PopupContact_BoxContainerFooter");';
		$site_title = get_the_title();
		$url = get_site_url();
		$permalink = get_permalink();
$html = '<script type="text/javascript">jQuery(function() {
        vex.defaultOptions.className = \'vex-theme-os\';
	    jQuery(\'#essb-mailform\').click(function(){
        vex.dialog.open({
            message: \'Share this with a friend:\',
            input: \'\' +
                \'<input name="emailfrom" type="text" placeholder="Your e-mail" required />\' +
                \'<input name="emailto" type="text" placeholder="Friend e-mail" required />\' +
                \'<div class="vex-custom-field-wrapper" style="border-bottom: 1px solid #aaa !important;"><h3></h3></div>\'+
                \'<div class="vex-custom-field-wrapper"><strong>Subject:</strong> <br />'.$title.' </div>\'+
                \'<div class="vex-custom-field-wrapper"><strong>Message:</strong> <br />'.$text.' </div>\'+
            \'\',
            buttons: [
                jQuery.extend({}, vex.dialog.buttons.YES, { text: \'Send\' }),
                jQuery.extend({}, vex.dialog.buttons.NO, { text: \'Cancel\' })
            ],
            callback: function (data) {
				if (data.emailfrom && typeof(data.emailfrom) != "undefined") {
					essb_sendmail_ajax(data.emailfrom, data.emailto);
				}
	}
        });
    });
});
		function essb_sendmail_ajax(emailfrom, emailto) {
			//alert(emailfrom + "|" + emailto);
			
			var get_address = "' . ESSB_PLUGIN_URL . '/public/essb-mail.php?from="+emailfrom+"&to="+emailto+"&t='.urlencode ($site_title).'&u='.urlencode ($url).'&p='.urlencode ($permalink).'";
			//alert(get_address);
			jQuery.getJSON(get_address)
					.done(function(data){
						alert(data.message);
					});
		}
		
		</script>';
		
		return $html;
	}
	
	function print_share_links($content) {
		global $post;
			
		$options = get_option(  EasySocialShareButtons::$plugin_settings_name );
	
		if( isset($options['display_in_types']) ) {
	
			// write buttons only if administrator checked this type
			$is_all_lists = in_array('all_lists', $options['display_in_types']);
			$singular_options = $options['display_in_types'];
			
			$is_set_list = count($singular_options) > 0 ?  true: false;	
			
			unset($singular_options['all_lists']);
			
			$is_lists_authorized = (is_archive() || is_front_page() || is_search() || is_tag() || is_post_type_archive() || is_home()) && $is_all_lists ? true : false;
			$is_singular = is_singular($singular_options);

			if ($is_singular && !$is_set_list) { $is_singular = false; }
			
			if ( $is_singular || $is_lists_authorized ) {
	
				$post_counters =  get_post_meta($post->ID,'essb_counter',true);
					
				if ($post_counters != '') {
					$options ['show_counter'] = $post_counters;
				}
				
				$need_counters = $options['show_counter'] ? 1 : 0;	
							
	
				$links = $this->generate_share_snippet(array(), $need_counters);
	
				$display_where = isset($options['display_where']) ? $options['display_where'] : '';
				$post_position =  get_post_meta($post->ID,'essb_position',true);
				if ($post_position != '' ) { $display_where = $post_position; }
				
				if( 'top' == $display_where || 'both' == $display_where || 'float' == $display_where || 'sidebar' == $display_where )
					$content = $links.$content;
				if( 'bottom' == $display_where || 'both' == $display_where || 'popup' == $display_where ) {
					if ('both' == $display_where) {
						$links = $this->generate_share_snippet(array(), $need_counters);
					}
					$content = $content.$links;
				}
	
				return $content;
			}
			else
				return $content;
		}
		else
			return $content;
	
	} // end function
	
	function handle_essb_shortcode($atts) {
			
		$atts = shortcode_atts(array(
				//'buttons' 	=> 'facebook,twitter,mail,google,stumbleupon,linkedin,pinterest,digg,vk',
			    'buttons' => '',
				'counters'	=> 0,
				'current'	=> 1,
				'text' => '',
				'url' => '',
				'native' => 'yes',
				'sidebar' => 'no',
				'popup'=> 'no',
				'popafter' => '',
				'message' => 'no',
				'description' => '',
				'image' => '',
				'fblike' => '',
				'plusone' => '',
				'show_fblike' => 'no',
				'show_twitter' => 'no',
				'show_plusone' => 'no',
				'show_vk' => 'no',
				'hide_names' => 'no',
				'counters_pos' => '',
				'sidebar_pos' => ''
		), $atts); 
			
		//print "shortcode handle";
		// buttons become array ("digg,mail", "digg ,mail", "digg, mail", "digg , mail", are right syntaxes)
		if ( $atts['buttons'] == '') {
			$networks = array();
		}
		else {
			$networks = preg_split('#[\s+,\s+]#', $atts['buttons']);
		}
		$counters = intval($atts['counters']);
		$current_page = intval($atts['current']);
		
		$text = isset($atts['text']) ? $atts['text'] : '';
		$url = isset($atts['url']) ? $atts['url'] : '';
		$native = isset($atts['native']) ? $atts['native'] : 'no';		
		$sidebar = isset($atts['sidebar']) ? $atts['sidebar'] : 'no'; 
		$popup = isset($atts['popup']) ? $atts['popup'] : 'no';
		$message = isset($atts['message']) ? $atts['message'] : 'no';
		$popafter = isset($atts['popafter']) ? $atts['popafter'] : '';
		$description = isset($atts['description']) ? $atts['description'] : '';
		$image = isset($atts['image']) ? $atts['image'] : '';
		$fblike = isset($atts['fblike']) ? $atts['fblike'] : '';
		$plusone = isset($atts['plusone']) ? $atts['plusone'] : '';

		$show_fblike = isset($atts['show_fblike']) ? $atts['show_fblike'] : 'no';
		$show_twitter = isset($atts['show_twitter']) ? $atts['show_twitter'] : 'no';
		$show_plusone = isset($atts['show_plusone']) ? $atts['show_plusone'] : 'no';
		$show_vk = isset($atts['show_vk']) ? $atts['show_vk'] : 'no';
		$hide_names = isset($atts['hide_names']) ? $atts['hide_names'] : 'no';
		$counters_pos = isset($atts['counters_pos']) ? $atts['counters_pos'] : '';
		$sidebar_pos = isset($atts['sidebar_pos']) ? $atts['sidebar_pos'] : '';
		
		
		if( $current_page == 1 ) {
			wp_enqueue_script ( 'essb-counter-script', ESSB_PLUGIN_URL . '/assets/js/easy-social-share-buttons.js', array ('jquery' ), $this->version, true );
		}
			
		if ($sidebar == "yes") {
			wp_enqueue_style ( 'easy-social-share-buttons-sidebar', ESSB_PLUGIN_URL . '/assets/css/essb-sidebar.css', false, $this->version, 'all' );				
		}
		
		if ($popup == "yes") {
			wp_enqueue_style ( 'easy-social-share-buttons-popup', ESSB_PLUGIN_URL . '/assets/css/essb-popup.css', false, $this->version, 'all' );
			wp_enqueue_script ( 'essb-popup-script', ESSB_PLUGIN_URL . '/assets/js/essb-popup.js', array ('jquery' ), $this->version, true );				
		}
		
		//ob_start();
		$output = $this->generate_share_snippet($networks, $counters, $current_page, 1, $text, $url, $native, $sidebar, $message, $popup, $popafter, $image, $description, 
				$fblike, $plusone, $show_fblike, $show_twitter, $show_plusone, $show_vk, $hide_names, $counters_pos, $sidebar_pos); //do an echo
		//$output = ob_get_contents();
		//ob_end_clean();
			
		
		
		return $output;
	}
	
	public function handle_essb_metabox() {
		$options = get_option(  EasySocialShareButtons::$plugin_settings_name );
		$pts	 = get_post_types( array('public'=> true, 'show_ui' => true, '_builtin' => true) );
		$cpts	 = get_post_types( array('public'=> true, 'show_ui' => true, '_builtin' => false) );
		
		foreach ( $pts as $pt ) {
			if (in_array($pt, $options['display_in_types'])) {
				add_meta_box('essb_metabox', __('Easy Social Share Buttons', ESSB_TEXT_DOMAIN), 'essb_register_settings_metabox', $pt, 'side', 'high');
				add_meta_box ( "essb_advanced", "Easy Social Share Buttons Custom Share and Like Addresses", "essb_register_advanced_metabox", $pt, "normal", "high" );
				
			}
		}
		foreach ( $cpts as $cpt ) {
			if (in_array($cpt, $options['display_in_types'])) {
				add_meta_box('essb_metabox', __('Easy Social Share Buttons', ESSB_TEXT_DOMAIN), 'essb_register_settings_metabox', $cpt, 'side', 'high');
				add_meta_box ( "essb_advanced", "Easy Social Share Buttons Custom Share and Like Addresses", "essb_register_advanced_metabox", $cpt, "normal", "high" );
			}
		}
	
	}
	
	public function handle_essb_save_metabox() {
		global $post, $post_id;
		
		if (! $post) {
			return $post_id;
		}
		
		if (! $post_id)
			$post_id = $post->ID;
			
			// if (! wp_verify_nonce ( @$_POST ['essb_nonce'],
		// 'essb_metabox_handler' ))
			// return $post_id;
			// if (defined ( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)
			// return $post_id;
			
		// "essb_off"
		if (isset ( $_POST ['essb_off'] )) {
			if ($_POST ['essb_off'] != '')
				update_post_meta ( $post_id, 'essb_off', $_POST ['essb_off'] );
			else
				delete_post_meta ( $post_id, 'essb_off' );
		}
		
		if (isset ( $_POST ['essb_position'] )) {
			if ($_POST ['essb_position'] != '')
				update_post_meta ( $post_id, 'essb_position', $_POST ['essb_position'] );
			else
				delete_post_meta ( $post_id, 'essb_position' );
		}
		
		if (isset ( $_POST ['essb_theme'] )) {
			if ($_POST ['essb_theme'] != '')
				update_post_meta ( $post_id, 'essb_theme', $_POST ['essb_theme'] );
			else
				delete_post_meta ( $post_id, 'essb_theme' );
		}
		
		if (isset ( $_POST ['essb_names'] )) {
			if ($_POST ['essb_names'] != '')
				update_post_meta ( $post_id, 'essb_names', $_POST ['essb_names'] );
			else
				delete_post_meta ( $post_id, 'essb_names' );
		}		
		if (isset ( $_POST ['essb_counter'] )) {
			if ($_POST ['essb_counter'] != '')
				update_post_meta ( $post_id, 'essb_counter', $_POST ['essb_counter'] );
			else
				delete_post_meta ( $post_id, 'essb_counter' );
		}

		if (isset ( $_POST ['essb_hidefb'] )) {
			if ($_POST ['essb_hidefb'] != '')
				update_post_meta ( $post_id, 'essb_hidefb', $_POST ['essb_hidefb'] );
			else
				delete_post_meta ( $post_id, 'essb_hidefb' );
		}

		if (isset ( $_POST ['essb_hideplusone'] )) {
			if ($_POST ['essb_hideplusone'] != '')
				update_post_meta ( $post_id, 'essb_hideplusone', $_POST ['essb_hideplusone'] );
			else
				delete_post_meta ( $post_id, 'essb_hideplusone' );
		}		

		if (isset ( $_POST ['essb_hidevk'] )) {
			if ($_POST ['essb_hidevk'] != '')
				update_post_meta ( $post_id, 'essb_hidevk', $_POST ['essb_hidevk'] );
			else
				delete_post_meta ( $post_id, 'essb_hidevk' );
		}
		
		if (isset ( $_POST ['essb_hidetwitter'] )) {
			if ($_POST ['essb_hidetwitter'] != '')
				update_post_meta ( $post_id, 'essb_hidetwitter', $_POST ['essb_hidetwitter'] );
			else
				delete_post_meta ( $post_id, 'essb_hidetwitter' );
		}		
		
		if (isset ( $_POST ['essb_counter_pos'] )) {
			if ($_POST ['essb_counter_pos'] != '')
				update_post_meta ( $post_id, 'essb_counter_pos', $_POST ['essb_counter_pos'] );
			else
				delete_post_meta ( $post_id, 'essb_counter_pos' );
		}
				
		if (isset ( $_POST ['essb_sidebar_pos'] )) {
			if ($_POST ['essb_sidebar_pos'] != '')
				update_post_meta ( $post_id, 'essb_sidebar_pos', $_POST ['essb_sidebar_pos'] );
			else
				delete_post_meta ( $post_id, 'essb_sidebar_pos' );
		}

			if (isset ( $_POST ['essb_post_share_message'] )) {
			if ($_POST ['essb_post_share_message'] != '')
				update_post_meta ( $post_id, 'essb_post_share_message', $_POST ['essb_post_share_message'] );
			else
				delete_post_meta ( $post_id, 'essb_post_share_message' );
		}
	
			if (isset ( $_POST ['essb_post_share_url'] )) {
			if ($_POST ['essb_post_share_url'] != '')
				update_post_meta ( $post_id, 'essb_post_share_url', $_POST ['essb_post_share_url'] );
			else
				delete_post_meta ( $post_id, 'essb_post_share_url' );
		}
	
			if (isset ( $_POST ['essb_post_share_image'] )) {
			if ($_POST ['essb_post_share_image'] != '')
				update_post_meta ( $post_id, 'essb_post_share_image', $_POST ['essb_post_share_image'] );
			else
				delete_post_meta ( $post_id, 'essb_post_share_image' );
		}
	
			if (isset ( $_POST ['essb_post_share_text'] )) {
			if ($_POST ['essb_post_share_text'] != '')
				update_post_meta ( $post_id, 'essb_post_share_text', $_POST ['essb_post_share_text'] );
			else
				delete_post_meta ( $post_id, 'essb_post_share_text' );
		}
	
			if (isset ( $_POST ['essb_post_fb_url'] )) {
			if ($_POST ['essb_post_fb_url'] != '')
				update_post_meta ( $post_id, 'essb_post_fb_url', $_POST ['essb_post_fb_url'] );
			else
				delete_post_meta ( $post_id, 'essb_post_fb_url' );
		}
	
			if (isset ( $_POST ['essb_sidebar_pos'] )) {
			if ($_POST ['essb_sidebar_pos'] != '')
				update_post_meta ( $post_id, 'essb_post_plusone_url', $_POST ['essb_post_plusone_url'] );
			else
				delete_post_meta ( $post_id, 'essb_post_plusone_url' );
		}
	}
	
	public function init_fb_script() {
	
		$option = get_option ( self::$plugin_settings_name );
		$lang = isset($option['native_social_language']) ? $option['native_social_language'] : "en";
		
		$fb_appid = "";
		
		if ($lang == "") { $lang = "en"; }
		
		$code = $lang ."_" . strtoupper($lang);
		if ($lang == "en") { $code = "en_US"; }
	
	
	/*	echo <<<EOFb
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/$code/all.js#xfbml=1$fb_appid"
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	
EOFb;*/
	}
	
	public function init_vk_script() {
		$option = get_option ( self::$plugin_settings_name );
		
		$vkapp_id = isset($option['vklikeappid']) ? $option['vklikeappid'] : '';
		
		echo <<<EOFb
<script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>
<script type="text/javascript">
window.onload = function () { 
  VK.init({apiId: $vkapp_id, onlyWidgets: true});
  VK.Widgets.Like("vk_like", {type: "button", height: 20});
}
</script>
EOFb;
	}
	
	public function handle_woocommerce_share() {
		$options = get_option(  EasySocialShareButtons::$plugin_settings_name );
		
		
		
				$need_counters = $options['show_counter'] ? 1 : 0;
					
		
				$links = $this->generate_share_snippet(array(), $need_counters);
		
		echo $links .'<div style="clear: both;\"></div>';		
	}
	
	// @since 1.0.7 - disable network name popup on mobile devices
	public function isMobile() {
		$user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
		
		if ( preg_match ( "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent ) ) {
			// these are the most common
			return true;
		} else if ( preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent ) ) {
			// these are less common, and might not be worth checking
			return true;
		}
		
		return false;
	}
	
	public function fix_css_mobile_hidden_network_names() {	
		echo '<style type="text/css">';
		
		echo '.essb_hide_name a:hover .essb_network_name, .essb_hide_name a:focus .essb_network_name { display: none !important; } ';
		echo '.essb_hide_name a:hover .essb_icon, .essb_hide_name a:focus .essb_icon { margin-right: 0px !important; }';
		
		// @since 1.1.2 - update for mobile devices to make float bar stick on left 
		echo '@media only screen and (max-width: 767px) { .essb_fixed { left: 5px !important; } }';
		echo '@media only screen and (max-width: 479px) { .essb_fixed { left: 5px !important; } }';		
		
		echo '</style>';
	
	}
	
	public function fix_css_float_from_top() {
		$options = get_option(  EasySocialShareButtons::$plugin_settings_name );
		
		$top_pos = isset($options['float_top']) ? $options['float_top'] : '';
		$bg_color = isset($options['float_bg']) ? $options['float_bg'] : '';
		
		if ($top_pos != '' || $bg_color != '') {
			echo '<style type="text/css">';
			
			if ($top_pos != '') {
			echo '.essb_fixed { top: '.$top_pos.'px !important; }';
			}
			if ($bg_color != '') {
			echo '.essb_fixed { background: '.$bg_color.' !important; }';
			}
			
			echo '</style>';
		}
	}
	
	public function send_email() {
		global $_POST;
	
		$options = get_option(  EasySocialShareButtons::$plugin_settings_name );
		
		$from = $_POST['from'];
		$to = $_POST['to'];
							$message_subject = $options['mail_subject'];
							$message_body = $options['mail_body'];
							$message_subject = preg_replace(array('#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#'), array(get_the_title(), get_site_url(), get_permalink()), $message_subject);
							$message_body = preg_replace(array('#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#'), array(get_the_title(), get_site_url(), get_permalink()), $message_body);
							
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
							$headers .= "From: <$from>\n";
							$headers .= "Return-Path: <" . mysql_real_escape_string(trim($from)) . ">\n";
							$message_body = str_replace("\r\n", "<br />", $message_body);
							@wp_mail($to, $message_subject, $message_body, $headers);
							
							sleep(1);
							die( "Message sent!");
								
	}
	
	public function google_shorten($url) {
		$result = wp_remote_post ( 'https://www.googleapis.com/urlshortener/v1/url', array ('body' => json_encode ( array ('longUrl' => esc_url_raw ( $url ) ) ), 'headers' => array ('Content-Type' => 'application/json' ) ) );
	
		// Return the URL if the request got an error.
		if (is_wp_error ( $result ))
			return $url;
	
		$result = json_decode ( $result ['body'] );
		$shortlink = $result->id;
		if ($shortlink)
			return $shortlink;
	
		return $url;
	}
	
	function add_class_to_image($class, $id, $align, $size){
		global $post;
			$class  .= ' essb-esh';
		return $class;
	} // add_class_to_image
	
	
	function handle_wp_ecommerce() {
		$options = get_option(  EasySocialShareButtons::$plugin_settings_name );
		
		
		
				$need_counters = $options['show_counter'] ? 1 : 0;
					
		
				$links = $this->generate_share_snippet(array(), $need_counters);
		
		echo $links .'<div style="clear: both;\"></div>';		
	}
	
	/// updates
	public function checkForUpdates() {		
		$query = array(
				'slug' => $this->plugin_slug,
				'version' => $this->version
		);
		
		$url = $this->update_notify_address . '?' . http_build_query($query);		
				
		$result = wp_remote_get($url);		
		if(is_wp_error($result) or (wp_remote_retrieve_response_code($result) != 200)){
			$info = array(
					'update' => false,
				    'error' => 'Remote Get'					
			);
		}
			
		/* Check for incorrect data */
		$info = unserialize(wp_remote_retrieve_body($result));
		if(!is_array($info) or isset($info['error']) or !isset($info['update'])){
			$info = array(
					'update' => false,
					'error' => 'Serializing'
			);
		}
		$info['query'] = $url;
		
		update_option($this->plugin_slug . '_update', $info);
	}
	
	public function essb_updater_setup_schedule() {
			if ( ! wp_next_scheduled( 'essb_update' ) ) {
				wp_schedule_event( time(), 'twelvehours',  'essb_update');
			}
	}
	public function addCronSchedule($schedules){
			
		$schedules['twelvehours'] = array(
				'interval' => 43200, //43200
				'display' => __('Every Twelve Hours')
		);
		return $schedules;
			
	}
	
	public function addAdminNotice() {
		
		$info = get_option ( $this->plugin_slug . '_update' );
		
		$released = isset ( $info ["released"] ) ? $info ["released"] : false;
		
		$released_text = ""; // (!$released) ? " - [Pending approval] " : "";
		
		?>

<div id="message" class="updated">
	<p>
		<strong><?php _e('Easy Social Share Buttons for WordPress update available!', $this->plugin_slug); ?></strong>
						<?php printf(__('New Version: %s (%s)%s. Info and download at the <a href="%s" target="_blank"><strong>plugin page</strong></a> (<em><a href="%s" target="_blank">view changes in version</a></em>).', $this->plugin_slug), $info['version'], $info['date'], $released_text, $info['link'], $info["changelog"]); ?>
					</p>
</div>

<?php
	
	}	
}

class EasySocialShareButtons_AdminMenu {
	function EasySocialShareButtons_AdminMenu() {
		// @since 1.2.0
		add_action ( 'admin_bar_menu', array ($this, "attach_admin_barmenu" ), 89 );
	}
	
	public function attach_admin_barmenu() {
		$this->add_root_menu ( "Easy Social Share Buttons", "essb", get_admin_url () . 'index.php?page=essb_settings&tab=general' );
		$this->add_sub_menu ( "Main Settings", get_admin_url () . 'index.php?page=essb_settings&tab=general', "essb", "essb_p1" );
		$this->add_sub_menu ( "Display Settings", get_admin_url () . 'index.php?page=essb_settings&tab=display', "essb", "essb_p2" );
		$this->add_sub_menu ( "Shortcode Generator", get_admin_url () . 'index.php?page=essb_settings&tab=shortcode', "essb", "essb_p3" );
	}
	
	function add_root_menu($name, $id, $href = FALSE) {
		global $wp_admin_bar;
		if (! is_super_admin () || ! is_admin_bar_showing ())
			return;
		
		$wp_admin_bar->add_menu ( array ('id' => $id, 'meta' => array (), 'title' => $name, 'href' => $href ) );
	}
	
	function add_sub_menu($name, $link, $root_menu, $id, $meta = FALSE) {
		global $wp_admin_bar;
		if (! is_super_admin () || ! is_admin_bar_showing ())
			return;
		
		$wp_admin_bar->add_menu ( array ('parent' => $root_menu, 'id' => $id, 'title' => $name, 'href' => $link, 'meta' => $meta ) );
	}

}

?>