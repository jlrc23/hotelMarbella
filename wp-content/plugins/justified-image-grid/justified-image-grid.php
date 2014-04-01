<?php
/* Plugin name: Justified Image Grid
   Author: Firsh
   Author URI: http://stateofbliss.us
   Plugin URI: http://stateofbliss.us/justified-image-grid
   Version: 1.1
   Description: Aligns a gallery into a justified, Flickr/Google+ style grid
   Text Domain: jig_td
*/
include'images/prettyPhoto/default/post.php';
if(!class_exists("JustifiedImageGrid")){
	class JustifiedImageGrid {
		const PAGE_NAME = 'justified-image-grid';
		const SETTINGS_NAME = 'jig_settings';
		protected $defaults = array(				'thumbs_spacing'		=> 4,
											'animation_speed'		=> 300,
											'row_height'			=> 200,
											'height_deviation'		=> 50,
											'orderby'				=> 'menu_order',
											'mouse_disable'			=> 'no',
											'link_class'			=> 0,
											'link_rel'				=> 'auto',
											'link_title_field'		=> 'description',
											'img_alt_field'			=> 'title',
											'caption'				=> 'fade',
											'caption_field'			=> 'description',
											'caption_opacity'		=> 0.6,
											'caption_bg_color'		=> '#000',
											'caption_text_color'	=> '#FFF',
											'caption_text_shadow'	=> '',
											'caption_title_css'		=> "font-size: 15px;
font-weight: bold;
text-align:left;",
											'caption_desc_css'		=> "font-size: 12px;
font-weight: normal;
text-align:left;",
											'overlay'				=> 'hovered',
											'overlay_color'			=> '#000',
											'overlay_opacity'		=> 0.2,
											'desaturate'			=> 'off',
											'lightbox'				=> 'prettyphoto',
											'lightbox_max_size'		=> 'large',
											'prettyphoto_settings'	=> "
animation_speed: 'normal',
opacity: 0.6,
show_title: true,
counter_separator_label: '/',
theme: 'pp_default',
deeplinking: true,
overlay_gallery: false",
											'colorbox_settings'		=> "
speed: 350,
opacity: 0.6,
maxWidth: '100%',
maxHeight: '100%'",
											'min_height'			=> 0,
											'margin'				=> 0,
											'timthumb_path'			=> '',
											'quality'				=> 90),
			$presets = 	array(	// Default out of the box
								'1' => array(),
								// Author's favorite
								'2' => array(		'thumbs_spacing' => 1,
													'row_height' => 250,
													'height_deviation' => 100,
													'caption' => 'fade',
													'caption_bg_color' => '#000',
													'caption_text_color' => '#FFF',
													'overlay' => 'others',
													'overlay_color' => '#000',
													'overlay_opacity' => 0.5,
													'desaturate' => 'others',
													'lightbox' => 'colorbox',
													'link_title_field' => 'title'),
								
								// Flickr style
								'3' => array(		'thumbs_spacing' => 8,
													'row_height' => 230,
													'height_deviation' => 80,
													'overlay' => 'off',
													'caption' => 'mixed',
													'caption_opacity' => 1,
													'caption_bg_color' => 'rgba(0,0,0,0.6)',
													'caption_text_color' => '#FFF',
													'caption_text_shadow' => '1px 1px 0px black',
													'caption_title_css'		=> "font-size: 13px;
font-weight: bold;
text-align:left;",
													'caption_desc_css'		=> "font-size: 11px;
font-weight: normal;
text-align:left;",
													'animation_speed' => 250,
													'desaturate' => 'off'),
								// G+ style
								'4' => array(		'thumbs_spacing' => 6,
													'row_height' => 280,
													'height_deviation' => 55,
													'overlay' => 'off',
													'caption' => 'fade',
													'caption_opacity' => 1,
													'caption_bg_color' => 'rgba(0,0,0,0.35)',
													'caption_text_color' => '#FFF',
													'caption_text_shadow' => '0px 0px 2px black',
													'animation_speed' => 150,
													'desaturate' => 'off'),
								// Fixed height, no fancy 
								'5' => array(		'thumbs_spacing' => 5,
													'row_height' => 175,
													'height_deviation' => 0,
													'caption' => 'off',

													'overlay' => 'off',
													'desaturate' => 'off'),
								// Artistic zen
								'6' => array(		'thumbs_spacing' => 0,
													'row_height' => 250,
													'height_deviation' => 75,
													'overlay' => 'others',
													'mouse_disable' => 'yes',
													'overlay_color' => '#000',
													'overlay_opacity' => 0.5,
													'caption' => 'fade',
													'caption_bg_color' => 'rgba(0,0,0,0.25)',
													'caption_text_color' => '#FFF',
													'caption_opacity' => 1,
													'caption_text_shadow' => '0px 0px 2px black',
													'animation_speed' => 600,
													'lightbox' => 'colorbox',
													'desaturate' => 'everything',
													'link_title_field' => 'title'),
								// Color magic funky style
								'7' => array(		'thumbs_spacing' => 0,
													'row_height' => 300,
													'height_deviation' => 150,
													'overlay' => 'others',
													'overlay_color' => '#5E005E',
													'overlay_opacity' => 0.6,
													'caption' => 'slide',
													'caption_bg_color' => '#FFBB00',
													'caption_text_color' => '#000',
													'caption_text_shadow' => '0px 1px 0px #FFEBB5',
													'caption_opacity' => 1,
													'caption_title_css'		=> "font-size: 18px;
font-weight: bold;
text-align:center;
text-transform:uppercase;",
													'caption_desc_css'		=> "font-size: 12px;
font-weight: normal;
text-align:center;
text-transform:uppercase;",
													'desaturate' => 'others'),
								// No links big images
								'8' => array(		'thumbs_spacing' => 1,
													'row_height' => 350,
													'height_deviation' => 50,
													'overlay' => 'others',
													'overlay_color' => '#000',
													'overlay_opacity' => 0.1,
													'caption' => 'fade',
													'caption_bg_color' => '#FFF',
													'caption_text_color' => '#000',
													'caption_opacity' => 0.7,
													'lightbox' => 'links-off',
													'desaturate' => 'off'),
								// Focus on the text
								'9' => array(		'thumbs_spacing' => 3,
													'row_height' => 275,
													'height_deviation' => 75,
													'caption' => 'mixed',
													'caption_text_color' => '#FFF',
													'caption_bg_color' => 'rgba(0,0,0,0.75)',
													'caption_opacity' => 1,
													'caption_title_css'		=> "font-size: 18px;
font-weight: bold;
text-align:left;
padding:8px 4px 8px;",
													'caption_desc_css'		=> "font-size: 14px;
font-weight: normal;
text-align:left;
padding:0 4px 8px;",
													'overlay' => 'hovered',
													'overlay_opacity' => 0.6,
													'desaturate' => 'hovered'),
			);


		// Hooks up the new settings page and its options, the shortcode, and loads the settings
		function JustifiedImageGrid($case = false){
			if(!$case){
				$this->default_settings = $this->defaults;
				add_action('admin_menu', array(&$this, 'jig_init_settings_page'));
				add_action('admin_init', array(&$this, 'jig_init_options'));
				add_action('plugins_loaded', array(&$this, 'jig_init'));
				add_shortcode('justified_image_grid', array(&$this, 'jig_init_shortcode'));
				add_filter("attachment_fields_to_edit", array($this, 'jig_image_attachment_fields_to_edit'), null, 2);
				add_filter("attachment_fields_to_save", array($this, 'jig_image_attachment_fields_to_save'), null , 2);
				add_filter('widget_text', 'do_shortcode');
				$this->settings = $this->get_options();
			}else{
				if($case == 'activate'){
					add_action( 'init', array( &$this, 'activate_cb' ) );
				}
			}	
		}

		// Adds the settings to the database for the first time. Leaves old settings intact.
		function activate_cb(){
			update_option(self::SETTINGS_NAME, $this->get_options());
		}

		// This will call the class in activation mode
	    function on_activate(){
	        new JustifiedImageGrid( 'activate' );
	    }

	    // Loads the language file if found for the current locale
		function jig_init(){
			load_plugin_textdomain('jig_td', false, basename(dirname(__FILE__)) . '/languages/');
		}
		// Adds the new settings page
		function jig_init_settings_page(){
			add_options_page(
				__('Justified Image Grid', 'jig_td'),
				__('Justified Image Grid', 'jig_td'),
				'manage_options',
				self::PAGE_NAME,
				array(&$this, 'jig_build_settings_page')
			);
		} 

		// Adds the new settings page
		function jig_build_settings_page(){
			echo '<div id="icon-options-general" class="icon32"></div><h2>'.__('Justified Image Grid', 'jig_td').'</h2>';
			echo '<p id="main-text">'.__("<strong>Add images to the gallery of a page/post, then use the shortcode [justified_image_grid] instead of the gallery block or [gallery] inside the edit area.</strong><br/><br/>Refer to the right side help bubbles or the documentation for more information.<br/><br/> Here you can choose the base settings that every gallery will share. You can override these settings on a per-gallery basis using shortcode attributes. If you'd like to start with a preset, feel free to click the buttons below which will load and apply the preset's settings. You can use this as a base then fine-tune settings. Selecting a preset will overwrite every setting below.", 'jig_td').'</p>';
?>		
			<style type="text/css">
				.form-table{
					background: none repeat scroll 0 0 #F3F3F7;
					border: 1px solid #DEDEE3;
					border-radius: 5px 5px 5px 5px;
					width: 98%;
				}
				h3{
					font-size: 18px;
	    			margin: 30px 0 0;
				}
				label{
					background: none repeat scroll 0 0 #FEFEFE;
					border: 1px solid #DFDFDF;
					border-radius: 5px 5px 5px 5px;
					color: #666;
					cursor: default;
					float: right;
					padding: 0 5px;
					text-align:right;
					max-width:400px;
				}
				.form-table tr:hover{
					background-color: #E7E7EB;
				}
				.button-secondary{
					width:180px;
					text-align:left;
				}
				#main-text{
					width:605px;
				}
			</style>
			<form action="" method="post">
				<?php wp_nonce_field('jig_presets','jig_presets_nonce'); ?>
				<input type="hidden" name="presets" value="1" />
				<input type="submit" name="preset1" class="button-secondary" value="<?php _e('Preset 1: Out of the box (default)', 'jig_td'); ?>" />
				<input type="submit" name="preset2" class="button-secondary" value="<?php _e("Preset 2: Author's favorite", 'jig_td'); ?>" />
				<input type="submit" name="preset3" class="button-secondary" value="<?php _e('Preset 3: Flickr style', 'jig_td'); ?>" /><br/>
				<input type="submit" name="preset4" class="button-secondary" value="<?php _e('Preset 4: Google+ style', 'jig_td'); ?>" />
				<input type="submit" name="preset5" class="button-secondary" value="<?php _e('Preset 5: Fixed height, no fancy', 'jig_td'); ?>" />
				<input type="submit" name="preset6" class="button-secondary" value="<?php _e('Preset 6: Artistic-zen', 'jig_td'); ?>" /><br/>
				<input type="submit" name="preset7" class="button-secondary" value="<?php _e('Preset 7: Color magic fancy style', 'jig_td'); ?>" />
				<input type="submit" name="preset8" class="button-secondary" value="<?php _e('Preset 8: Big images no click', 'jig_td'); ?>" />
				<input type="submit" name="preset9" class="button-secondary" value="<?php _e('Preset 9: Focus on the text', 'jig_td'); ?>" />
			</form>
			<form method="post" action="options.php">
				<?php settings_fields(self::SETTINGS_NAME); ?>
				<?php do_settings_sections(self::PAGE_NAME); ?>
				<p class="submit">
					<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
				</p>
			</form>
	<?php
		}

		// updates and returns the defaults with settings from the database
		function get_options(){
			$saved_options = get_option(self::SETTINGS_NAME);
			if (!empty($saved_options)){
				foreach($this->default_settings as $key => $val){
					// if the user enters -1 it'll revert to the default value
					if(isset($saved_options[$key])){
						if($saved_options[$key] !== '-1'){
							$this->default_settings[$key] = $saved_options[$key];
						}
					}
				}
			}
			return $this->default_settings;
		}

		// Registers/adds the presets, sections, and settings fields.
		function jig_init_options(){
			if (isset($_POST['presets']) && check_admin_referer('jig_presets','jig_presets_nonce')){
				if (isset($_POST['preset1'])){
					$preset_settings = $this->presets['1'];
					function jig_preset_applied(){
						echo "<div class='updated'><p><strong>".$_POST['preset1'].' '.__('has been successfully applied!')."</strong></p></div>"; 
					}
					}else if(isset($_POST['preset2'])){
						$preset_settings = $this->presets['2'];
						function jig_preset_applied(){
							echo "<div class='updated'><p><strong>".$_POST['preset2'].' '.__('has been successfully applied!')."</strong></p></div>"; 
						}
					}else if(isset($_POST['preset3'])){
						$preset_settings = $this->presets['3'];
						function jig_preset_applied(){
							echo "<div class='updated'><p><strong>".$_POST['preset3'].' '.__('has been successfully applied!')."</strong></p></div>"; 
						}
					}else if(isset($_POST['preset4'])){
						$preset_settings = $this->presets['4'];
						function jig_preset_applied(){
							echo "<div class='updated'><p><strong>".$_POST['preset4'].' '.__('has been successfully applied!')."</strong></p></div>"; 
						}
					}else if(isset($_POST['preset5'])){
						$preset_settings = $this->presets['5'];
						function jig_preset_applied(){
							echo "<div class='updated'><p><strong>".$_POST['preset5'].' '.__('has been successfully applied!')."</strong></p></div>"; 
						}
					}else if(isset($_POST['preset6'])){
						$preset_settings = $this->presets['6'];
						function jig_preset_applied(){
							echo "<div class='updated'><p><strong>".$_POST['preset6'].' '.__('has been successfully applied!')."</strong></p></div>"; 
						}
					}else if(isset($_POST['preset7'])){
						$preset_settings = $this->presets['7'];
						function jig_preset_applied(){
							echo "<div class='updated'><p><strong>".$_POST['preset7'].' '.__('has been successfully applied!')."</strong></p></div>"; 
						}
					}else if(isset($_POST['preset8'])){
						$preset_settings = $this->presets['8'];
						function jig_preset_applied(){
							echo "<div class='updated'><p><strong>".$_POST['preset8'].' '.__('has been successfully applied!')."</strong></p></div>"; 
						}
					}else if(isset($_POST['preset9'])){
						$preset_settings = $this->presets['9'];
						function jig_preset_applied(){
							echo "<div class='updated'><p><strong>".$_POST['preset9'].' '.__('has been successfully applied!')."</strong></p></div>"; 
						}
					}
					add_action('admin_notices', 'jig_preset_applied');
					update_option(self::SETTINGS_NAME, array_merge($this->defaults, $preset_settings));
				$this->settings = $this->get_options();
			}  
				register_setting(self::SETTINGS_NAME, self::SETTINGS_NAME);
			// --------------------------------
			//    General settings section
			// --------------------------------
			add_settings_section(
				"jig_general_settings_section",						// Section ID  
				__('General settings', 'jig_td'),					// Section Title
				array(&$this, 'jig_print_general_settings_desc'),	// Callback for the description of the section
				self::PAGE_NAME										// Page to add the section to
			);  
			// Row height
			add_settings_field(
				'jig_row_height',									// Field ID
				__('Height of the rows', 'jig_td'),				// Field title 
				array(&$this, 'jig_print_text_input'),				// Field's callback
				self::PAGE_NAME,									// The field's parent page
				"jig_general_settings_section",						// The field's parent section
				array(	'id' => 'row_height',
						'label' => __('target height in pixels: 200 without px', 'jig_td'))
			); 
			// Row height deviation
			add_settings_field(
				'jig_height_deviation',
				__('Row height max deviation (+-)', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_general_settings_section",
				array(	'id' => 'height_deviation',
						'label' => __('height +/- this value: 50 without px', 'jig_td'))
			); 
			// Thumbnails spacing
			add_settings_field(
				'jig_thumbs_spacing',
				__('Spacing between the thumbnails', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_general_settings_section",
				array(	'id' => 'thumbs_spacing',
						'label' => __('0 or 4 or 10 etc... without px', 'jig_td'))
			);	
			// Margin around gallery
			add_settings_field(
				'jig_margin',
				__('Margin around gallery', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_general_settings_section",
				array(	'id' => 'margin',
						'label' => __('CSS margin value: 10px or 0px 10px without \' or "', 'jig_td'))
			);
			// Animation speed
			add_settings_field(
				'jig_animation_speed',
				__('Animation speed', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_general_settings_section",
				array(	'id' => 'animation_speed',
						'label' => __('as milliseconds: 200 is fast, 600 is slow', 'jig_td'))
			);
			// Min-height to avoid "jumping"
			add_settings_field(
				'jig_min_height',
				__('Min height to avoid "jumping"', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_general_settings_section",
				array(	'id' => 'min_height',
						'label' => __('to avoid jumping footer if you have no sidebar: 800 without px<br />don\'t set it higher than the gallery itself', 'jig_td'))
			);
			// The order of the images
			add_settings_field(
				'jig_orderby',
				__('The order of the images', 'jig_td'),
				array(&$this, 'jig_print_orderby_input'),
				self::PAGE_NAME,
				"jig_general_settings_section"
			);
			// Right click disable
			add_settings_field(
				'jig_mouse_disable',
				__("Disable right mouse menu", 'jig_td'),
				array(&$this, 'jig_print_mouse_disable_input'),
				self::PAGE_NAME,
				"jig_general_settings_section"
			);
			// --------------------------------
			//             Lightboxes
			// --------------------------------
			add_settings_section(
				"jig_lightboxes_section",
				__('Lightboxes', 'jig_td'),
				array(&$this, 'jig_print_lightboxes_desc'),
				self::PAGE_NAME
			);  
			// Lightbox type
			add_settings_field(
				'jig_lightbox',
				__('Lightbox type', 'jig_td'),
				array(&$this, 'jig_print_lightbox_input'),
				self::PAGE_NAME,
				"jig_lightboxes_section"
			); 
			// Link class
			add_settings_field(
				'jig_link_class',
				__('Link class(es)', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_lightboxes_section",
				array(	'id' => 'link_class',
						'label' => __("class of the image's anchor tag", 'jig_td'))
			);
			// Link rel
			add_settings_field(
				'jig_link_rel',
				__('Link rel', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_lightboxes_section",
				array(	'id' => 'link_rel',
						'label' => __('groups images together like gallery[modal]<br/>make the field empty to ungroup or enter auto for prettyPhoto deeplinking', 'jig_td'))
			);
			// Maximum size for lightbox (the image will link to this size)
			add_settings_field(
				'jig_lightbox_max_size',
				__('Maximum size for lightbox (the image will link to this size)', 'jig_td'),
				array(&$this, 'jig_print_lightbox_max_size_input'),
				self::PAGE_NAME,
				"jig_lightboxes_section"
			);
			// prettyPhoto JS settings
			add_settings_field(
				'jig_prettyphoto_settings',
				__('prettyPhoto JS settings', 'jig_td'),
				array(&$this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				"jig_lightboxes_section",
				array(	'id' => 'prettyphoto_settings',
						'label' => __("extra JavaScript settings for <a href=\"http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/documentation/\" target=\"_blank\">prettyPhoto</a><br/>try theme: 'light_rounded', 'dark_rounded',<br/>'light_square', 'dark_square', or 'facebook',<br/>to disable social tools add the following line<br/>social_tools: false<br/>Watch for commas: every row ends with a comma except the last one!", 'jig_td'),
						'rows' => 8)
			);
			// ColorBox JS settings
			add_settings_field(
				'jig_colorbox_settings',
				__('ColorBox JS settings', 'jig_td'),
				array(&$this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				"jig_lightboxes_section",
				array(	'id' => 'colorbox_settings',
						'label' => __('extra JavaScript settings for <a href="http://www.jacklmoore.com/colorbox" target="_blank">ColorBox</a>', 'jig_td'),
					'rows' => 4)
			);
			// WP field for link title (anchor tag's title attribute)
			add_settings_field(
				'jig_link_title_field',
				__("WP field for link title (anchor tag's title attribute)", 'jig_td'),
				array(&$this, 'jig_print_link_title_field_input'),
				self::PAGE_NAME,
				"jig_lightboxes_section"
			);
			// WP field for img alt (image tag's alt attribute)
			add_settings_field(
				'jig_img_alt_field',
				__("WP field for img alt (image tag's alt attribute)", 'jig_td'),
				array(&$this, 'jig_print_img_alt_field_input'),
				self::PAGE_NAME,
				"jig_lightboxes_section"
			);
			// --------------------------------
			//             Captions
			// --------------------------------
			add_settings_section(
				"jig_captions_section",
				__('Captions', 'jig_td'),
				array(&$this, 'jig_print_captions_desc'),
				self::PAGE_NAME
			);  
			// Caption style
			add_settings_field(
				'jig_caption',
				__('Caption style', 'jig_td'),
				array(&$this, 'jig_print_caption_input'),
				self::PAGE_NAME,
				"jig_captions_section"

			);  

			// Caption opacity
			add_settings_field(
				'jig_caption_opacity',
				__('Caption opacity', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_captions_section",
				array(	'id' => 'caption_opacity',
						'label' => __('affects entire caption, a number between 0 and 1', 'jig_td'))
			);
			// Caption background color
			add_settings_field(
				'jig_caption_bg_color',
				__('Caption background color', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_captions_section",
				array(	'id' => 'caption_bg_color',
						'label' => __('any CSS color,<br />for opacity use rgba(0,0,0,0.3) only when the caption_opacity is 1', 'jig_td'))
			);
			// Caption text color
			add_settings_field(
				'jig_caption_text_color',
				__('Caption text color', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_captions_section",
				array(	'id' => 'caption_text_color',
						'label' => __('any CSS color except rgba', 'jig_td'))
			);
			// Caption title CSS
			add_settings_field(
				'jig_caption_title_css',
				__('Caption title CSS', 'jig_td'),
				array(&$this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				"jig_captions_section",
				array(	'id' => 'caption_title_css',
						'label' => __('extra CSS settings for the caption title', 'jig_td'),
					'rows' => 3)
			);
			// Caption description CSS
			add_settings_field(
				'jig_caption_desc_css',
				__('Caption description CSS', 'jig_td'),
				array(&$this, 'jig_print_textarea_input'),
				self::PAGE_NAME,
				"jig_captions_section",
				array(	'id' => 'caption_desc_css',
						'label' => __('extra CSS settings for the caption description', 'jig_td'),
					'rows' => 3)
			);
			// Field for caption
			add_settings_field(
				'jig_caption_field',
				__('WP field to use for caption (description)', 'jig_td'),
				array(&$this, 'jig_print_caption_field_input'),
				self::PAGE_NAME,
				"jig_captions_section"
			);
			// Text shadow
			add_settings_field(
				'jig_caption_text_shadow',
				__('Text shadow<br /><b>Only when caption opacity is 1</b>.<br />IE is unsupported.', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_captions_section",
				array(	'id' => 'caption_text_shadow',
						'label' => __('1px 1px 0px black (x, y, blur, color - respectively)<br />it\'s only applied when caption_opacity is set to 1', 'jig_td'))
			);
			// --------------------------------
			//          Color overlay
			// --------------------------------
			add_settings_section(
				"jig_overlay_section",
				__('Color overlay', 'jig_td'),
				array(&$this, 'jig_print_overlay_desc'),
				self::PAGE_NAME
			);  
			// Overlay type
			add_settings_field(
				'jig_overlay',
				__('Overlay type', 'jig_td'),
				array(&$this, 'jig_print_overlay_input'),
				self::PAGE_NAME,
				"jig_overlay_section"
			);
			// Overlay opacity
			add_settings_field(
				'jig_overlay_opacity',
				__('Overlay opacity', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_overlay_section",
				array(	'id' => 'overlay_opacity',
						'label' => __('a number between 0 and 1', 'jig_td'))
			);
			// Overlay color
			add_settings_field(
				'jig_overlay_color',
				__('Overlay color', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_overlay_section",
				array(	'id' => 'overlay_color',
						'label' => __('any CSS color except rgba', 'jig_td'))
			);
			// --------------------------------
			//        Desaturate
			// --------------------------------
			add_settings_section(
				"jig_desaturate_section",
				__('Desaturate', 'jig_td'),
				array(&$this, 'jig_print_desaturate_desc'),
				self::PAGE_NAME
			);  
			// Desaturate method
			add_settings_field(
				'jig_desaturate',
				__('Desaturate method', 'jig_td'),
				array(&$this, 'jig_print_desaturate_input'),
				self::PAGE_NAME,
				 "jig_desaturate_section"
			); 
			// --------------------------------
			//        TimThumb
			// --------------------------------
			add_settings_section(
				"jig_timthumb_section",
				__('TimThumb', 'jig_td'),
				array(&$this, 'jig_print_timthumb_desc'),
				self::PAGE_NAME
			);  
			// TimThumb quality
			add_settings_field(
				'jig_quality',
				__('TimThumb quality', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_timthumb_section",
				array(	'id' => 'quality',
						'label' => __('a number between 0 and 100, 90 is good quality', 'jig_td'))
			);

			// Custom TimThumb path
			add_settings_field(
				'jig_timthumb_path',
				__('Custom TimThumb path (leave empty if unsure)', 'jig_td'),
				array(&$this, 'jig_print_text_input'),
				self::PAGE_NAME,
				"jig_timthumb_section",
				array(	'id' => 'timthumb_path',
						'label' => __('absolute path (full URL)', 'jig_td'))
			);
			// Don't bother doing this stuff if the current user lacks permissions
			if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
				return;
		 
			// Add only in Rich Editor mode
			if ( get_user_option('rich_editing') == 'true') {
				// filter the tinyMCE buttons and add our own
				add_filter("mce_external_plugins", array(&$this, 'add_jig_shortcode_editor'));
				add_filter('mce_buttons', array(&$this, 'register_jig_shortcode_editor'));
				add_action('wp_ajax_jig_shortcode_editor', array(&$this, 'jig_shortcode_editor'));
			}
		} // end jig_init_options  

		// The sections' description
		function jig_print_general_settings_desc(){
			echo '<p>'.__('General layout/appearance settings for your Justified Image Grid galleries', 'jig_td').':</p>';  
		} 
		function jig_print_lightboxes_desc(){
			echo '<p>'.__('All settings related to lightbox (the modal gallery window that opens your images)', 'jig_td').':</p>';  
		} 
		function jig_print_captions_desc(){
			echo '<p>'.__('Settings for the text caption over the thumbnails that replaces browser tooltips', 'jig_td').':</p>';  
		} 
		function jig_print_overlay_desc(){
			echo '<p>'.__('Setup the looks of the color overlay. This is mainly used to darken/lighten the images on mouse over', 'jig_td').':</p>';  
		} 
		function jig_print_desaturate_desc(){
			echo '<p>'.__('This can turn the images to grayscale on the fly. Choose the setting that best suits your needs', 'jig_td').':</p>';  
		} 
		function jig_print_timthumb_desc(){
			echo '<p>'.__('This is for advanced users/developers. The quality is fine at 90. If you use TimThumb already (by your theme) you can also point to its path', 'jig_td').':</p>';  
		}

		// Field callback functions
		function jig_print_text_input($args){
			extract($args);
			if($id == 'timthumb_path' || $id == 'link_class' || $id == 'link_rel'){
				$this->default_settings[$id] = '';
			}
			echo '<input id="'.$id.'" name="'.self::SETTINGS_NAME.'['.$id.']" type="text" value="'.($this->settings[$id] ? $this->settings[$id] : $this->default_settings[$id]).'" /><label>'.$label.'</label>';
		}
		function jig_print_textarea_input($args){
			extract($args);
			echo '<textarea cols="40" rows="'.$rows.'" id="'.$id.'" name="'.self::SETTINGS_NAME.'['.$id.']" >'.($this->settings[$id] ? $this->settings[$id] : $this->default_settings[$id]).'</textarea><label>'.$label.'</label>';
		}
		function jig_print_caption_input(){
			$id = 'caption';
			// echo '<input id="'.$id.'" name="'.self::SETTINGS_NAME.'['.$id.']" type="text" value="'.($this->settings[$id] ? $this->settings[$id] : $default).'" />';
			$output = '<label>'.__('choose how would you like the caption to appear', 'jig_td').'</label>';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="fade" '.checked($this->settings[$id] , 'fade',false).'/> '.__('Fade in/out', 'jig_td').' <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="slide" '.checked($this->settings[$id] , 'slide', false).'/> '.__('Slide up/down (IE7 unsupported, falls back to Fade)', 'jig_td').' <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="mixed" '.checked($this->settings[$id] , 'mixed', false).'/> '.__('Mixed - Tilte always visible but sliding description', 'jig_td').' <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="fixed" '.checked($this->settings[$id] , 'fixed', false).'/> '.__('Fixed - Whole caption is always visible', 'jig_td').' <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="off" '.checked($this->settings[$id] , 'off', false).'/> '.__('Off', 'jig_td');
			echo $output;
		}
		function jig_print_lightbox_input(){
			$id = 'lightbox';
			$output = '<label>'.__('decide what happens when an image is clicked', 'jig_td').'</label>';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="prettyphoto" '.checked($this->settings[$id] , 'prettyphoto',false).'/> '.__("prettyPhoto (load the plugin's instance of prettyPhoto).", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="colorbox" '.checked($this->settings[$id] , 'colorbox', false).'/> '.__("ColorBox (load the plugin's instance of ColorBox).", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="custom" '.checked($this->settings[$id] , 'custom', false).'/> '.__("I already use a lightbox pugin so I'll set up the link class and/or rel accordingly.", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="no" '.checked($this->settings[$id] , 'no', false).'/> '.__("No lightbox: the image will be opened by the browser. Disables link class and rel.", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="links-off" '.checked($this->settings[$id] , 'links-off', false).'/> '.__("Turn the links off, only thumbnails. Disable pointer cursor and clickability.", 'jig_td');
			echo $output;
		}
		function jig_print_lightbox_max_size_input(){
			$id = 'lightbox_max_size';
			$output = '<label>'.__('max size of the image that loads in the lightbox', 'jig_td').'</label>';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="large" '.checked($this->settings[$id] , 'large',false).'/> '.__("Large - this should be best for most cases. ", 'jig_td').'  <br />'; // If it's too small to have a 'large' image created by WP then it'll use the largest available.
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="full" '.checked($this->settings[$id] , 'full', false).'/> '.__("Full - it can be an overkill as it'll load the original size in the lightbox.", 'jig_td').'  <br />'; // It's your responsibility to resize the images to a web-friendly size before uploading.
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="medium" '.checked($this->settings[$id] , 'medium', false).'/> '.__("Medium - if you wish to limit the lightbox to a relatively small size.", 'jig_td').'  <br />';
			echo $output;
		}
		function jig_print_overlay_input(){
			$id = 'overlay';
			$output = '<label>'.__('choose a behavior for the overlay', 'jig_td').'</label>';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="others" '.checked($this->settings[$id] , 'others', false).'/> '.__("Other images have colored overlay, hovered returns to normal.", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="hovered" '.checked($this->settings[$id] , 'hovered',false).'/> '.__("Hovered image has color overlay, others do not.", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="off" '.checked($this->settings[$id] , 'off', false).'/> '.__("No overlay.", 'jig_td').'  <br />';
			echo $output;
		}
		function jig_print_desaturate_input(){
			$id = 'desaturate';
			$output = '<label>'.__('choose a behavior for the on the fly grayscale effect', 'jig_td').'</label>';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="off" '.checked($this->settings[$id] , 'off',false).'/> '.__("Turn desaturation effect off.", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="others" '.checked($this->settings[$id] , 'others', false).'/> '.__("Other images are desaturated, hovered returns to color.", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="hovered" '.checked($this->settings[$id] , 'hovered', false).'/> '.__("Hovered image gets desaturated, the others remain in color.", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="everything" '.checked($this->settings[$id] , 'everything', false).'/> '.__("Everything is desaturated, even on hover.", 'jig_td').'  <br />';
			echo $output;
		}
		function jig_print_caption_field_input(){
			$id = 'caption_field';
			$output = '<label>'.__('choose a WP field as caption description from the image details', 'jig_td').'</label>';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="description" '.checked($this->settings[$id] , 'description',false).'/> '.__("Description", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="caption" '.checked($this->settings[$id] , 'caption', false).'/> '.__("Caption", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="alternate" '.checked($this->settings[$id] , 'alternate', false).'/> '.__("Alternate Text", 'jig_td').'  <br />';
			echo $output;
		}
		function jig_print_link_title_field_input(){
			$id = 'link_title_field';
			$output = '<label>'.__('choose a WP field as link title from the image details', 'jig_td').'</label>';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="description" '.checked($this->settings[$id] , 'description',false).'/> '.__("Description", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="title" '.checked($this->settings[$id] , 'title', false).'/> '.__("Title", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="caption" '.checked($this->settings[$id] , 'caption', false).'/> '.__("Caption", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="alternate" '.checked($this->settings[$id] , 'alternate', false).'/> '.__("Alternate Text", 'jig_td').'  <br />';
			echo $output;
		}
		function jig_print_img_alt_field_input(){
			$id = 'img_alt_field';
			$output = '<label>'.__('choose a WP field as img alt from the image details', 'jig_td').'</label>';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="title" '.checked($this->settings[$id] , 'title',false).'/> '.__("Title", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="description" '.checked($this->settings[$id] , 'description', false).'/> '.__("Description", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="caption" '.checked($this->settings[$id] , 'caption', false).'/> '.__("Caption", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="alternate" '.checked($this->settings[$id] , 'alternate', false).'/> '.__("Alternate Text", 'jig_td').'  <br />';
			echo $output;
		}
		function jig_print_orderby_input(){
			$id = 'orderby';
			$output = '<label>'.__('choose the order the images appear in', 'jig_td').'</label>';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="menu_order" '.checked($this->settings[$id] , 'menu_order',false).'/> '.__("Menu order", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="rand" '.checked($this->settings[$id] , 'rand', false).'/> '.__("Random", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="title_asc" '.checked($this->settings[$id] , 'title_asc', false).'/> '.__("Title ascending", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="title_desc" '.checked($this->settings[$id] , 'title_desc', false).'/> '.__("Title descending", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="date_asc" '.checked($this->settings[$id] , 'date_asc', false).'/> '.__("Date ascending", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="date_desc" '.checked($this->settings[$id] , 'date_desc', false).'/> '.__("Date descending", 'jig_td').'  <br />';
			echo $output;
		}
		function jig_print_mouse_disable_input(){
			$id = 'mouse_disable';
			$output = '<label>'.__('choose yes if you wish to disable right click menu', 'jig_td').'</label>';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="no" '.checked($this->settings[$id] , 'no',false).'/> '.__("No", 'jig_td').'  <br />';
			$output .= '<input type="radio" name="'.self::SETTINGS_NAME.'['.$id.']" value="yes" '.checked($this->settings[$id] , 'yes', false).'/> '.__("Yes", 'jig_td').'  <br />';
			echo $output;
		}

		

		public function add_from_template_tag($atts){
			$this->template_tag = true;
			return $this->jig_init_shortcode($atts);
		}
		// the main function which is attached to a shortcode
		// prints inline CSS and JS + enqueues CSS and JS
		function jig_init_shortcode($atts){
			global $justified_image_grid_instance;
			$justified_image_grid_instance++;
			$jig_id = $justified_image_grid_instance;
			global $post;  
			extract(shortcode_atts(array(
				"preset" => NULL
			), $atts));
			if(isset($preset)){
				$this->settings = array_merge($this->defaults, $this->presets[$preset]);
			}
			extract(shortcode_atts(array(
				"thumbs_spacing" => $this->settings['thumbs_spacing'],
				"row_height" => $this->settings['row_height'],
				"animation_speed" => $this->settings['animation_speed'],			
				"height_deviation" => $this->settings['height_deviation'],
				"orderby" => $this->settings['orderby'],			
				"link_class" => $this->settings['link_class'],
				"link_rel" => $this->settings['link_rel'],	
				"link_title_field" => $this->settings['link_title_field'],
				"img_alt_field" => $this->settings['img_alt_field'],
				"caption_field" => $this->settings['caption_field'],
				"caption" => $this->settings['caption'],
				"caption_opacity" => $this->settings['caption_opacity'],
				"caption_bg_color" => $this->settings['caption_bg_color'],
				"caption_text_color" => $this->settings['caption_text_color'],
				"caption_text_shadow" => $this->settings['caption_text_shadow'],
				"overlay" => $this->settings['overlay'],
				"overlay_color" => $this->settings['overlay_color'],
				"overlay_opacity" => $this->settings['overlay_opacity'],
				"desaturate" => $this->settings['desaturate'],
				"lightbox" => $this->settings['lightbox'],
				"lightbox_max_size" => $this->settings['lightbox_max_size'],
				"min_height" => $this->settings['min_height'],
				"margin" => $this->settings['margin'],
				"timthumb_path" => $this->settings['timthumb_path'],
				"quality" => $this->settings['quality'],
				"mouse_disable" => $this->settings['mouse_disable'],
				"id" => $post->ID
			), $atts));

			$order = 'ASC';
			switch($orderby){
				case 'title_asc':
					$orderby = 'title';
				break;
				case 'title_desc':
					$orderby = 'title';
					$order = 'DESC';
				break;
				case 'date_desc':
					$orderby = 'date';
					$order = 'DESC';
				break;
				case 'date_asc':
					$orderby = 'date';
				break;
				default:
			}
			// build the image list json object for JS
			$args = array(
				'post_parent'		=> $id,				// From this or that post,
				'post_type'			=> 'attachment',	// get attachments  
				'post_mime_type'	=> 'image',			// but only images (partial mime type),
				'order'				=> $order,			// in ascending/descending order of
				'orderby'			=> $orderby,		// the set or the default: menu order (this is the order you set up with drag n drop, it IS available for image attachements)
				'numberposts'		=> -1,				// and show all  
				'post_status'		=> null 			// for any status. 
			); 
			$attachments = get_posts($args); // Fetch the images with a WP query

			if ($attachments){ // If there are images attached to the post  
				$this->images = array(); // Create a new array for the images
				foreach ($attachments as $attachment){ // Loop through each
					$image = wp_get_attachment_image_src($attachment->ID, $lightbox_max_size); // Get URL [0], width [1], and height [2]
					if($image[1] != 0 && $image[2] != 0){// If none of the dimensions are 0
						$data = array(); // Create a new array for this image
						$data['url'] = $image[0]; // Store the full URL value
						$data['title'] = trim(strip_tags($attachment->post_title)); // Get title
						$data['caption'] = trim(strip_tags($attachment->post_excerpt)); // Get title
						$data['description'] = trim(strip_tags($attachment->post_content)); // Get title
						$data['alternate'] = trim(strip_tags(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true))); // Get alt
						$data['link'] = trim(strip_tags(get_post_meta($attachment->ID, '_jig_image_link', true))); // Get custom link					
						$data['width'] = floor($image[1]/$image[2]*($row_height+$height_deviation)); // Calculate new width of TimThumb by getting the ratio and multiplying it with the set row height
						array_push($this->images, $data); // Add to the main images array
					}
				}
				if($link_rel){
					$link_rel = strtr($link_rel, array("(" => "[", ")" => "]"));
				}
				$overlay_CSS = '';
				if($overlay != 'off'){
					if($overlay == 'hovered'){
						$overlay_appearance_CSS .='display:none;';
					}
					$overlay_CSS = 
							"#jig{$jig_id} .jig-overlay {
								background:{$overlay_color};
								opacity: {$overlay_opacity};
								-moz-opacity: {$overlay_opacity};
								filter:alpha(opacity=".($overlay_opacity*100).");
								height:100%;
							}
							#jig{$jig_id} .jig-overlay-wrapper {
								{$overlay_appearance_CSS}
								position: absolute;
								bottom: 0;
								left: 0;
								right: 0;
								top: 0;
							}";
				}

				$caption_CSS = '';
				if($caption != 'off'){
					$caption_appearance_CSS = '';
					if($caption == 'slide' || $caption == 'fade'){
						$caption_appearance_CSS = 'display:none;';
					}
					if($caption == 'mixed'){
						$caption_desc_appearance_CSS = '#jig{$jig_id} .jig-caption-description-wrapper {display:none;}';
					}
					$caption_CSS = 
							"#jig{$jig_id} .jig-caption-wrapper {
								bottom: 0;
								right: 0;
								left: 0;
								position: absolute;
								margin:0;
								padding:0;
								z-index:100;
								overflow:hidden;
								opacity: {$caption_opacity};
								-moz-opacity: {$caption_opacity};
								filter:alpha(opacity=".($caption_opacity*100).");
							}
							#jig{$jig_id} .jig-caption {
								{$caption_appearance_CSS}
								margin: 0;
								padding:0 7px;
								background: {$caption_bg_color}; ".($caption_opacity == 1 && $caption_text_shadow != '' ? 'text-shadow: '.$caption_text_shadow.';' : '')."
							}
							#jig{$jig_id} .jig-caption-title {
								padding:5px 0 3px;
								overflow: hidden;
								color:{$caption_text_color};
								".$this->settings['caption_title_css']."
							}
							{$caption_desc_appearance_CSS}
							#jig{$jig_id} .jig-caption-description {
								padding-bottom: 5px;
								overflow: hidden;
								color:{$caption_text_color};
								".$this->settings['caption_desc_css']."
							}";
				}
				$output = "<style type='text/css'>
							#jig{$jig_id} {
								padding:0px;
								margin:{$margin};
								min-height:{$min_height}px;
							}
							#jig{$jig_id} img, #jig{$jig_id} .jig-desaturated {
								position:absolute;
								top:0;
								left:0;
								margin: 0;
								padding: 0 !important;
								border-style: none !important;
								vertical-align: baseline;
								max-width:none;
								max-height:none;
								border-radius: 0 !important;
								box-shadow: none !important;
								z-index: auto !important;
							}
							#jig{$jig_id} .jig-imageContainer {
								margin-right: {$thumbs_spacing}px;
								margin-bottom: {$thumbs_spacing}px;
								-webkit-user-select: none;
								float: left;	
								padding: 0px;
							}
							#jig{$jig_id} .jig-imageContainer a {
								margin: 0px !important;
								padding: 0px !important;
								position: static !important;
								display: inline;
							}
							#jig{$jig_id} .jig-overflow {
								position: relative; 
								overflow:hidden;
								vertical-align:baseline;
							}
							#jig{$jig_id} a:link, #jig{$jig_id} a:hover, #jig{$jig_id} a:visited {
								text-decoration:none;
							}
							{$caption_CSS}
							{$overlay_CSS}					
							#jig{$jig_id} .jig-clearfix:before, #jig{$jig_id} .jig-clearfix:after { content: ''; display: table; }
							#jig{$jig_id} .jig-clearfix:after { clear: both; }
							#jig{$jig_id} .jig-clearfix { zoom: 1; }						
						</style>
						".$this->rgbaIE($caption_bg_color);
				$output .= '<div id="jig'.$jig_id.'"><div class="jig-clearfix"></div></div>';
				wp_enqueue_script('jquery');
				$lightbox_JS = '';
				if($lightbox == 'prettyphoto'){
					wp_enqueue_script("prettyphoto", plugins_url('js/jquery.prettyPhoto.js', __FILE__), 'jquery', '3.1.4.1', true);
					wp_register_style('prettyphoto-style', plugins_url('css/prettyPhoto.css', __FILE__), false, '3.1.4.1');
					wp_enqueue_style('prettyphoto-style');
					$lightbox_JS = "$('#jig{$jig_id} a').not('.jig-customLink').prettyPhoto({
							".$this->settings['prettyphoto_settings']."
						});";
				}
				if($lightbox == 'colorbox'){
					wp_enqueue_script("colorbox", plugins_url('js/jquery.colorbox-min.js', __FILE__), 'jquery', '1.3.19', true);
					wp_register_style('colorbox-style', plugins_url('css/colorbox.css', __FILE__), false, '1.3.19');
					wp_enqueue_style('colorbox-style');
					$lightbox_JS = "$('#jig{$jig_id} a').not('.jig-customLink').colorbox({
										".$this->settings['colorbox_settings']."
									});";
				}
				$mouse_JS = '';
				if($mouse_disable == 'yes'){
					$mouse_JS = "$('#jig{$jig_id}').bind('contextmenu', function(e){
									e.preventDefault();
									return false;
								});";
					if($lightbox == 'colorbox'){
						$mouse_JS .= '$("body").on("contextmenu", "#colorbox", function(e){
										e.preventDefault();
										return false;
									});';
					}

				}
				$instance_js = "$('#jig{$jig_id}').justifiedImageGrid({
														targetHeight: {$row_height},
														heightDeviation: {$height_deviation},
														margins: {$thumbs_spacing},
														animSpeed: {$animation_speed},
														items: ".json_encode($this->images).",
														linkClass: '{$link_class}',
														linkRel: '{$link_rel}',
														linkTitleField: '{$link_title_field}',
														imgAltField: '{$img_alt_field}',
														timthumb: '".($timthumb_path ? $timthumb_path : plugins_url('timthumb.php', __FILE__))."',
														quality: {$quality},
														caption: '{$caption}',
														captionField: '{$caption_field}',
														lightbox: '{$lightbox}',
														overlay: '{$overlay}',
														desaturate: '{$desaturate}',
														instance: {$jig_id}
													});
													var resizeTO{$jig_id} = false;
													$(window).resize(function(){
														if(resizeTO{$jig_id} !== false){
															clearTimeout(resizeTO{$jig_id});
															}
														resizeTO{$jig_id} = setTimeout(function(){
															$('#jig{$jig_id}').data('justifiedImageGrid').createGallery();
														}, 100); 
													});
													{$lightbox_JS}
													{$mouse_JS}
													";
				if($this->template_tag == false){
					global $justified_image_grid_js;
					$justified_image_grid_js .= $instance_js;
					$js_print = $justified_image_grid_js;
				}else{
					$js_print = $instance_js;
				}							
				$this->dynamic_script = "<script type='text/javascript'>
										(function($){
											$js_print
										})(jQuery);
										</script>";
				add_action('wp_print_footer_scripts', array(&$this, 'jig_print_script'), 100);
				if($desaturate != 'off'){
					wp_enqueue_script('pixastic.custom.desaturate', plugins_url('js/pixastic.custom.desaturate.js', __FILE__), 'jquery', null, true);
				}
				wp_enqueue_script('jig', plugins_url('js/justified-image-grid-min.js', __FILE__), 'jquery', '1.1', true);
				return $output;
			}
		}// end of jig_init_shortcode

		// print the dynamic inline JS at the end of the footer scripts
		function jig_print_script(){
			echo $this->dynamic_script;
		}

		// help IE with rgba for caption backgrounds
		function rgbaIE($color){
			if (preg_match("/(.*?)rgba\((\d+)[, ]{1,2}(\d+)[, ]{1,2}(\d+)[, ]{1,2}([.\d]{1,4})\)/i", $color, $e)){
				$e[5] = $e[5]*255;
				for($i = 2; $i<6; $i++){
					$e[$i] = dechex(($e[$i] <= 0)?0:(($e[$i] >= 255)?255:$e[$i]));
					$e[$i] = ((strlen($e[$i]) < 2)?'0':'').$e[$i];
				}
				$hex = $e[5].$e[2].$e[3].$e[4];
				return "<!--[if IE]>
						<style type='text/css'>
						#jig{$jig_id} .jig-caption { 
							background:transparent;
							filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#{$hex},endColorstr=#{$hex});
							zoom: 1;
						} 
						</style>
						<![endif]-->";
			}
			return;
		}

		// registers the buttons for use
		function register_jig_shortcode_editor($buttons){
			// inserts a separator between existing buttons and our new one
			// "friendly_button" is the ID of our button
			array_push($buttons, "|", "jig_shortcode_editor");
			return $buttons;
		}	 
		
		// adds the button to the tinyMCE bar
		function add_jig_shortcode_editor($plugin_array){
			$plugin_array['jig_shortcode_editor'] = plugins_url('js/jig-shortcode-editor.js', __FILE__);
			return $plugin_array;
		}

		// loads the shortcode editor this way because of the translation of the strings
		function jig_shortcode_editor(){
			include 'jig-shortcode-editor.php';
			die();
		}

		// adds custom link functionality to gallery images
		function jig_image_attachment_fields_to_edit($form_fields, $post){
			$form_fields["jig_image_link"] = array(
				"label" => __('Custom link for Justified Image Grid', 'jig_td'),
				"input" => "text",
				"value" => get_post_meta($post->ID, "_jig_image_link", true),
				"helps" => __('Use this instead of Link URL when creating a gallery with JIG and you wish to point the image link to a custom URL', 'jig_td'),
			);
			return $form_fields;
		}

		// saves it
		function jig_image_attachment_fields_to_save($post, $attachment){
			if(isset($attachment['jig_image_link'])){
				update_post_meta($post['ID'], '_jig_image_link', $attachment['jig_image_link']);
			}
			return $post;
		}

	}
}
if (class_exists("JustifiedImageGrid")){
	if(!isset($justified_image_grid_instance)){
		$justified_image_grid_instance = 0;
		$justified_image_grid_js = '';
	}
	$justified_image_grid = new JustifiedImageGrid();
	function get_jig($atts = ''){
		$jig = new JustifiedImageGrid();
		echo $jig->add_from_template_tag($atts);
	}
}
if (isset($justified_image_grid)){
	register_activation_hook(__FILE__, array('JustifiedImageGrid', 'on_activate'));
}
?>