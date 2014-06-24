<?php
	if (function_exists('vc_add_param')) {
		// Row Setting Parameters
		vc_add_param("vc_row", array(
			"type"              			=> "seperator",
			"heading"           			=> __( "", "js_composer" ),
			"param_name"        			=> "seperator_1",
			"value"             			=> "Background Settings",
			"description"       			=> __( "", "js_composer" ),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Background Effects"),
			"param_name" 					=> "ts_row_bg_effects",
			"value" 						=> array(
				"None"						=> "",
				"Simple Image"				=> "image",
				"Fixed Image"				=> "fixed",
				"Parallax Image"			=> "parallax",
				"Gradient Color"			=> "gradient",
				"YouTube Video"				=> "youtube",
				//"Selfhosted Video"		=> "video",
			),
			"admin_label" 					=> true,
			"description" 					=> __("Select the effect you want to apply to the row background.", "js_composer"),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "attach_image",
			"heading"						=> __( "Background Image", "js_composer" ),
			"param_name"					=> "ts_row_bg_image",
			"value"							=> "",
			"description"					=> __( "Select the background image for your row.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		// Full Width Settings
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Full Width Breakout", "js_composer" ),
			"param_name"            		=> "ts_row_break_parents",
			"value"                 		=> "4",
			"min"                   		=> "0",
			"max"                   		=> "99",
			"step"                  		=> "1",
			"unit"                  		=> '',
			"description"           		=> __( "Define the number of Parent Containers the Background should attempt to break away from.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "gradient", "youtube")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		// Z-Index
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Z-Index for Background", "js_composer" ),
			"param_name"            		=> "ts_row_zindex",
			"value"                 		=> "0",
			"min"                   		=> "-100",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> '',
			"description"           		=> __( "Define the z-Index for the background; use only if theme requires an adjustment!", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "gradient", "youtube")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		// Min Height Settings
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Minimum Height", "js_composer" ),
			"param_name"            		=> "ts_row_min_height",
			"value"                 		=> "100",
			"min"                   		=> "0",
			"max"                   		=> "2048",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "Define the minimum height for the row.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax", "gradient", "youtube")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		// Parallax Settings
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __( "Background Parallax"),
			"param_name" 					=> "ts_row_parallax_type",
			"value" 						=> array(
				"Up"			=> "up",
				"Down"			=> "down",
				"Left"			=> "left",
				"Right"			=> "right",
			),
			"description" 					=> __("Select the parallax effect for your background image. You must have a background image to use this.", "js_composer"),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "parallax"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Parallax Speed", "js_composer" ),
			"param_name"            		=> "ts_row_parallax_speed",
			"value"                 		=> "20",
			"min"                   		=> "0",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> '',
			"description"           		=> __( "", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "parallax"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Use On Small Screens", "js_composer" ),
			"param_name"        			=> "enable_mobile",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "js_composer" ),
			"off"							=> __( 'No', "js_composer" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to use Parallax on small screen devices.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "parallax"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Row Padding: Top", "js_composer" ),
			"param_name"            		=> "padding_top",
			"value"                 		=> "30",
			"min"                   		=> "0",
			"max"                   		=> "250",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Row Padding: Bottom", "js_composer" ),
			"param_name"            		=> "padding_bottom",
			"value"                 		=> "30",
			"min"                   		=> "0",
			"max"                   		=> "250",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __("Background Position"),
			"param_name" 					=> "ts_row_bg_position",
			"value" 						=> array(
				"Top" 		=> "top",
				"Middle" 	=> "center",
				"Bottom" 	=> "bottom"
			),
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __("Background Size"),
			"param_name" 					=> "ts_row_bg_size_standard",
			"value" 						=> array(
				"Cover" 		=> "cover",
				"Contain" 		=> "contain",
				"Initial" 		=> "initial",
				"Auto" 			=> "auto",
			),
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __("Background Size"),
			"param_name" 					=> "ts_row_bg_size_parallax",
			"value" 						=> array(
				"150%"			=> "150%",
				"200%"			=> "200%",
				"Cover" 		=> "cover",
				"Contain" 		=> "contain",
				"Initial" 		=> "initial",
				"Auto" 			=> "auto",
			),
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("parallax")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __("Background Repeat"),
			"param_name" 					=> "ts_row_bg_repeat",
			"value" 						=> array(
				"No repeat" 							=> "no-repeat",
				"Repeat (horizontally & vertically)" 	=> "repeat",
				"Repeat horizontally" 					=> "repeat-x",
				"Repeat vertically" 					=> "repeat-y"
			),
			"description" 					=> __(""),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Image Margin: Left", "js_composer" ),
			"param_name"            		=> "margin_left",
			"value"                 		=> "0",
			"min"                   		=> "-50",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Image Margin: Right", "js_composer" ),
			"param_name"            		=> "margin_right",
			"value"                 		=> "0",
			"min"                   		=> "-50",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> 'px',
			"description"           		=> __( "", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("image", "fixed", "parallax")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		// Gradient Color Background
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Gradient Angle", "js_composer" ),
			"param_name"            		=> "gradient_angle",
			"value"                 		=> "0",
			"min"                   		=> "0",
			"max"                   		=> "360",
			"step"                  		=> "1",
			"unit"                  		=> 'deg',
			"description"           		=> __( "Define the angle at which the gradient should spread.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "gradient"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "colorpicker",
			"heading"           			=> __( "Start Color", "js_composer" ),
			"param_name"        			=> "gradient_color_start",
			"value"            	 			=> "#cccccc",
			"description"       			=> __( "Define the start color for the gradient.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "gradient"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Gradient Start", "js_composer" ),
			"param_name"            		=> "gradient_start_offset",
			"value"                 		=> "0",
			"min"                   		=> "0",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> '%',
			"description"           		=> __( "Define the beginning section of the gradient.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "gradient"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "colorpicker",
			"heading"           			=> __( "End Color", "js_composer" ),
			"param_name"        			=> "gradient_color_end",
			"value"            	 			=> "#cccccc",
			"description"       			=> __( "Define the end color for the gradient.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "gradient"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Gradient End", "js_composer" ),
			"param_name"            		=> "gradient_end_offset",
			"value"                 		=> "100",
			"min"                   		=> "0",
			"max"                   		=> "100",
			"step"                  		=> "1",
			"unit"                  		=> '%',
			"description"           		=> __( "Define the end section of the gradient.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "gradient"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		// YouTube Video Background
		vc_add_param("vc_row", array(
			"type"              			=> "textfield",
			"heading"           			=> __( "YouTube Video ID", "js_composer" ),
			"param_name"        			=> "video_youtube",
			"value"             			=> "",
			"description"       			=> __( "Enter the YouTube video ID.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "youtube"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Mute Video", "js_composer" ),
			"param_name"        			=> "video_mute",
			"value"             			=> "true",
			"on"							=> __( 'Yes', "js_composer" ),
			"off"							=> __( 'No', "js_composer" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to mute the video while playing.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "youtube"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Loop Video", "js_composer" ),
			"param_name"        			=> "video_loop",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "js_composer" ),
			"off"							=> __( 'No', "js_composer" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to loop the video after it has finished.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "youtube"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Start Video on Pageload", "js_composer" ),
			"param_name"        			=> "video_start",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "js_composer" ),
			"off"							=> __( 'No', "js_composer" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to if you want to start the video once the page has loaded.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "youtube"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Stop Video once out of View", "js_composer" ),
			"param_name"        			=> "video_stop",
			"value"             			=> "true",
			"on"							=> __( 'Yes', "js_composer" ),
			"off"							=> __( 'No', "js_composer" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to if you want to stop the video once it is out of view and restart when it comes back into view.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "youtube"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Show Video Controls", "js_composer" ),
			"param_name"        			=> "video_controls",
			"value"             			=> "true",
			"on"							=> __( 'Yes', "js_composer" ),
			"off"							=> __( 'No', "js_composer" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to if you want to show basic video controls.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "youtube"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Show Raster over Video", "js_composer" ),
			"param_name"        			=> "video_raster",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "js_composer" ),
			"off"							=> __( 'No', "js_composer" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to if you want to show a raster over the video.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "youtube"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		// Video Background
		vc_add_param("vc_row", array(
			"type"              			=> "textfield",
			"heading"           			=> __( "MP4 Video Path", "js_composer" ),
			"param_name"        			=> "video_mp4",
			"value"             			=> "",
			"description"       			=> __( "Enter the path to the MP4 video version.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "video"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "textfield",
			"heading"           			=> __( "OGV Video Path", "js_composer" ),
			"param_name"        			=> "video_ogv",
			"value"             			=> "",
			"description"       			=> __( "Enter the path to the OGV video version.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "video"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"              			=> "textfield",
			"heading"           			=> __( "WEBM Video Path", "js_composer" ),
			"param_name"        			=> "video_webm",
			"value"             			=> "",
			"description"       			=> __( "Enter the path to the WEBM video version.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "video"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "attach_image",
			"heading"						=> __( "Video Screenshot Image", "js_composer" ),
			"param_name"					=> "video_image",
			"value"							=> "",
			"description"					=> __( "Select the a screenshot image for the video.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> "video"
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		// Viewport Animation
		vc_add_param("vc_row", array(
			"type" 							=> "dropdown",
			"class" 						=> "",
			"heading" 						=> __("Viewport Animation"),
			"admin_label" 					=> true,
			"param_name" 					=> "animation_view",
			"value" 						=> $this->TS_VCSC_CSS_Animations_Classes, //$this->TS_VCSC_CSS_Animations_Classes / $this->TS_VCSC_CSS_Animations
			"description" 					=> __("Select a Viewport Animation for this Row; it is advised not to use with Parallax.", "js_composer"),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("", "image", "gradient")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"							=> "switch",
			"heading"           			=> __( "Repeat Effect", "js_composer" ),
			"param_name"        			=> "animation_scroll",
			"value"             			=> "false",
			"on"							=> __( 'Yes', "js_composer" ),
			"off"							=> __( 'No', "js_composer" ),
			"style"							=> "select",
			"design"						=> "toggle-light",
			"description"       			=> __( "Switch the toggle to repeat the viewport effect when element has come out of view and comes back into viewport.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("", "image", "gradient")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "nouislider",
			"heading"               		=> __( "Animation Speed", "js_composer" ),
			"param_name"            		=> "animation_speed",
			"value"                 		=> "2000",
			"min"                   		=> "1000",
			"max"                   		=> "5000",
			"step"                  		=> "100",
			"unit"                  		=> 'ms',
			"description"           		=> __( "Define the Length of the Viewport Animation in ms.", "js_composer" ),
			"dependency" 					=> array(
				"element" 	=> "ts_row_bg_effects",
				"value" 	=> array("", "image", "gradient")
			),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_row", array(
			"type"                  		=> "load_file",
			"class" 						=> "",
			"heading"               		=> __( "", "js_composer" ),
			"param_name"            		=> "el_file",
			"value"                 		=> "",
			"file_type"             		=> "js",
			"file_path"             		=> "js/ts-visual-composer-extend-element.min.js",
			"description"           		=> __( "", "js_composer" ),
			"group" 						=> __( "VC Extensions", "js_composer"),
		));
	}
	
	add_filter('TS_VCSC_ComposerRowAdditions_Filter',		'TS_VCSC_ComposerRowAdditions', 		10, 2);
	
	function TS_VCSC_ComposerRowAdditions($output, $atts, $content='') {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}

		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			if (get_option('ts_vcsc_extend_settings_loadWaypoints', 1) == 1) {
				wp_enqueue_script('ts-extend-waypoints',                TS_VCSC_GetResourceURL('js/jquery.waypoints.min.js'), array('jquery'), false, false);
			}
			wp_enqueue_style('ts-extend-animations',					TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-animations.min.css'), null, false, 'all');
			wp_enqueue_style('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
			wp_enqueue_script('ts-visual-composer-extend-front',		TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}

		extract(shortcode_atts( array(
			'ts_row_bg_image'			=> '',
			'ts_row_bg_effects'			=> '',
			'ts_row_break_parents'		=> 4,
			'ts_row_zindex'				=> 0,
			'ts_row_min_height'			=> 100,
			
			'ts_row_bg_position'		=> 'top',
			'ts_row_bg_repeat'			=> 'no-repeat',
			'ts_row_bg_size_parallax'	=> '150%',
			'ts_row_bg_size_standard'	=> 'cover',
			'ts_row_parallax_type'		=> '',
			'ts_row_parallax_speed'		=> 20,
			
			'margin_left'				=> 0,
			'margin_right'				=> 0,
			'padding_top'				=> 20,
			'padding_bottom'			=> 20,
			'enable_mobile'				=> 'false',
			
			'gradient_angle'			=> 0,
			'gradient_color_start'		=> '',
			'gradient_start_offset'		=> 0,
			'gradient_color_end'		=> '',
			'gradient_end_offset'		=> 100,
			
			'video_youtube'				=> '',
			'video_mute'				=> 'true',
			'video_loop'				=> 'false',
			'video_start'				=> 'false',
			'video_stop'				=> 'true',
			'video_controls'			=> 'true',
			'video_raster'				=> 'false',
			
			'video_mp4'					=> '',
			'video_ogv'					=> '',
			'video_webm'				=> '',
			'video_image'				=> '',

			'animation_factor'			=> '0.33',
			'animation_scroll'			=> 'false',
			'animation_view'			=> '',
			'animation_speed'			=> 2000,
		), $atts));
		
		$output 					= "";

		// Viewport Animations
		if (!empty($animation_view)) {
			$animation_css				= "ts-viewport-css-" . $animation_view;
			$output						.= '<div class="ts-viewport-row ts-viewport-animation" data-scrollup = "' . $animation_scroll . '" data-factor="' . $animation_factor . '" data-viewport="' . $animation_css . '" data-speed="' . $animation_speed . '"></div>';
		} else {
			$animation_css				= '';
		}

		// Simple Background Image
		if ($ts_row_bg_effects == "image") {
			$ts_row_bg_image_url		= wp_get_attachment_image_src($ts_row_bg_image, 'full');
			$output						.= "<div class='ts-background-image ts-background' data-height='" . $ts_row_min_height . "' data-index='" . $ts_row_zindex . "' data-marginleft='" . $margin_left . "' data-marginright='" . $margin_right . "' data-paddingtop='" . $padding_top . "' data-paddingbottom='" . $padding_bottom . "' data-image='" . $ts_row_bg_image_url[0] . "' data-size='". $ts_row_bg_size_standard . "' data-position='" . esc_attr($ts_row_bg_position) . "' data-repeat='" . $ts_row_bg_repeat . "' data-break-parents='" . esc_attr( $ts_row_break_parents ) . "'></div>";
		}
		
		// Fixed Background Image
		if ($ts_row_bg_effects == "fixed") {
			$ts_row_bg_image_url		= wp_get_attachment_image_src($ts_row_bg_image, 'full');
			$output						.= "<div class='ts-background-fixed ts-background' data-height='" . $ts_row_min_height . "' data-index='" . $ts_row_zindex . "' data-marginleft='" . $margin_left . "' data-marginright='" . $margin_right . "' data-paddingtop='" . $padding_top . "' data-paddingbottom='" . $padding_bottom . "' data-image='" . $ts_row_bg_image_url[0] . "' data-size='". $ts_row_bg_size_standard . "' data-position='" . esc_attr($ts_row_bg_position) . "' data-repeat='" . $ts_row_bg_repeat . "' data-break-parents='" . esc_attr( $ts_row_break_parents ) . "'></div>";
		}

		// Parallax Background
		if ($ts_row_bg_effects == "parallax") {
			$parallaxClass				= ( $ts_row_parallax_type == "none" ) ? "" : "ts-background-parallax";
			$parallaxClass				= in_array( $ts_row_parallax_type, array( "none", "fixed", "up", "down", "left", "right", "ts-background-parallax" ) ) ? $parallaxClass : "";
			if (!empty($parallaxClass)) {
				$ts_row_bg_image_url	= wp_get_attachment_image_src($ts_row_bg_image, 'full');
				$ts_row_parallax_speed	= round(($ts_row_parallax_speed / 100), 2);
				$output					.= "<div class='" . esc_attr($parallaxClass) . " ts-background' data-height='" . $ts_row_min_height . "' data-index='" . $ts_row_zindex . "' data-marginleft='" . $margin_left . "' data-marginright='" . $margin_right . "' data-paddingtop='" . $padding_top . "' data-paddingbottom='" . $padding_bottom . "' data-image='" . $ts_row_bg_image_url[0] . "' data-size='". $ts_row_bg_size_standard_parallax . "' data-position='" . esc_attr($ts_row_bg_position) . "' data-repeat='" . $ts_row_bg_repeat . "' data-direction='" . esc_attr($ts_row_parallax_type) . "' data-velocity='" . esc_attr( (float)$ts_row_parallax_speed * -1 ) . "' data-mobile-enabled='" . esc_attr( $enable_mobile ) . "' data-break-parents='" . esc_attr( $ts_row_break_parents ) . "'></div>";
			}
		}

		// Selfhosted Video Background
		if ($ts_row_bg_effects == "video") {
			if (!empty($video_image)) {
				$video_image_url		= wp_get_attachment_image_src($video_image, 'full');
				$video_image_url		= $video_image_url[0];
			} else {
				$video_image_url		= "";
			}
			$output						.= '<div class="ts-background-video ts-background" data-height="' . $ts_row_min_height . '" data-index="' . $ts_row_zindex . '" data-marginleft="' . $margin_left . '" data-marginright="' . $margin_right . '" data-paddingtop="' . $padding_top . '" data-paddingbottom="' . $padding_bottom . '" data-mp4="' . $video_mp4 . '" data-ogv="' . $video_ogv . '" data-webm="' . $video_webm . '" data-image="' . $video_image_url . '" data-break-parents="' . esc_attr( $ts_row_break_parents ) . '"></div>';
		}
		
		// Youtube Video Background
		if ($ts_row_bg_effects == "youtube") {
			wp_enqueue_script('ts-extend-ytplayer',		TS_VCSC_GetResourceURL('js/jquery.mb.ytplayer.min.js'), array('jquery'), false, $FOOTER);
			wp_enqueue_style('ts-extend-ytplayer',		TS_VCSC_GetResourceURL('css/jquery.mb.ytplayer.css'), null, false, 'all');
			$output						.= '<div class="ts-background-youtube ts-background" data-height="' . $ts_row_min_height . '" data-index="' . $ts_row_zindex . '" data-marginleft="' . $margin_left . '" data-marginright="' . $margin_right . '" data-paddingtop="' . $padding_top . '" data-paddingbottom="' . $padding_bottom . '" data-video="' . $video_youtube . '" data-controls="' . $video_controls . '" data-start="' . $video_start . '" data-stop="' . $video_stop . '" data-raster="' . $video_raster . '" data-mute="' . $video_mute . '" data-loop="' . $video_loop . '" data-break-parents="' . esc_attr( $ts_row_break_parents ) . '">';
			$output						.= '</div>';
		}
		
		// Vimeo Video Background
		if ($ts_row_bg_effects == "vimeo") {
			
		}

		// Gradient Background
		if ($ts_row_bg_effects == "gradient") {
			$gradient_css_attr[] 		= 'background: ' . $gradient_color_start . '';
			$gradient_css_attr[] 		= 'background: -moz-linear-gradient(' . $gradient_angle . 'deg, ' . $gradient_color_start . ' ' . $gradient_start_offset . '%, ' . $gradient_color_end . ' ' . $gradient_end_offset . '%)';
			$gradient_css_attr[] 		= 'background: -webkit-linear-gradient(' . $gradient_angle . 'deg, ' . $gradient_color_start . ' ' . $gradient_start_offset . '%, ' . $gradient_color_end . ' ' . $gradient_end_offset . '%)';
			$gradient_css_attr[] 		= 'background: -o-linear-gradient(' . $gradient_angle . 'deg, ' . $gradient_color_start . ' ' . $gradient_start_offset . '%, ' . $gradient_color_end . ' ' . $gradient_end_offset . '%)';
			$gradient_css_attr[] 		= 'background: -ms-linear-gradient(' . $gradient_angle . 'deg, ' . $gradient_color_start . ' ' . $gradient_start_offset . '%, ' . $gradient_color_end . ' ' . $gradient_end_offset . '%)';
			$gradient_css_attr[] 		= 'background: linear-gradient(' . ($gradient_angle + 90) . 'deg, ' . $gradient_color_start . ' ' . $gradient_start_offset . '%, ' . $gradient_color_end . ' ' . $gradient_end_offset . '%)';
			$gradient_css_attr = 		implode('; ', $gradient_css_attr);
			$output						.= '<div class="ts-background-gradient ts-background" style="display: none; ' . $gradient_css_attr . '" data-height="' . $ts_row_min_height . '" data-index="' . $ts_row_zindex . '" data-marginleft="' . $margin_left . '" data-marginright="' . $margin_right . '" data-paddingtop="' . $padding_top . '" data-paddingbottom="' . $padding_bottom . '" data-break-parents="' . esc_attr( $ts_row_break_parents ) . '"></div>';
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
	
	if (!function_exists('vc_theme_before_vc_row')){
		function vc_theme_before_vc_row($atts, $content = null) {
			return apply_filters( 'TS_VCSC_ComposerRowAdditions_Filter', '', $atts, $content );
		}
	}
	if (!function_exists('vc_theme_before_vc_row_inner')){
		function vc_theme_before_vc_row_inner($atts, $content = null){
			return apply_filters( 'TS_VCSC_ComposerRowAdditions_Filter', '', $atts, $content );
		}
	}
?>