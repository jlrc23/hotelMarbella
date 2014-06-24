<?php
	if (function_exists('vc_add_param')) {
		// Column Setting Parameters
		vc_add_param("vc_column", array(
			"type"              		=> "seperator",
			"heading"           		=> __( "", "js_composer" ),
			"param_name"        		=> "seperator_1",
			"value"             		=> "Viewport Animation",
			"description"       		=> __( "", "js_composer" ),
			"group" 					=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_column", array(
			"type" 						=> "dropdown",
			"class" 					=> "",
			"heading" 					=> __("Viewport Animation"),
			"admin_label" 				=> true,
			"param_name" 				=> "animation_view",
			"value" 					=> $this->TS_VCSC_CSS_Animations_Classes, //$this->TS_VCSC_CSS_Animations_Classes / $this->TS_VCSC_CSS_Animations
			"description" 				=> __("Select a Viewport Animation for this Column.", "js_composer"),
			"group" 					=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_column", array(
			"type"						=> "switch",
			"heading"           		=> __( "Repeat Effect", "js_composer" ),
			"param_name"        		=> "animation_scroll",
			"value"             		=> "false",
			"on"						=> __( 'Yes', "js_composer" ),
			"off"						=> __( 'No', "js_composer" ),
			"style"						=> "select",
			"design"					=> "toggle-light",
			"description"       		=> __( "Switch the toggle to repeat the viewport effect when element has come out of view and comes back into viewport.", "js_composer" ),
			"dependency" 				=> array(
				"element" 		=> "animation_view",
				"not_empty" 	=> true
			),
			"group" 					=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_column", array(
			"type"                  	=> "nouislider",
			"heading"               	=> __( "Animation Speed", "js_composer" ),
			"param_name"            	=> "animation_speed",
			"value"                 	=> "2000",
			"min"                   	=> "1000",
			"max"                   	=> "5000",
			"step"                  	=> "100",
			"unit"                  	=> 'ms',
			"description"           	=> __( "Define the Length of the Viewport Animation in ms.", "js_composer" ),
			"dependency" 				=> array(
				"element" 		=> "animation_view",
				"not_empty" 	=> true
			),
			"group" 					=> __( "VC Extensions", "js_composer"),
		));
		vc_add_param("vc_column", array(
			"type"                  	=> "load_file",
			"class" 					=> "",
			"heading"               	=> __( "", "js_composer" ),
			"param_name"            	=> "el_file",
			"value"                 	=> "",
			"file_type"             	=> "js",
			"file_path"             	=> "js/ts-visual-composer-extend-element.min.js",
			"description"           	=> __( "", "js_composer" ),
			"group" 					=> __( "VC Extensions", "js_composer"),
		));
	}
	
	add_filter('TS_VCSC_ComposerColumnAdditions_Filter',	'TS_VCSC_ComposerColumnAdditions', 		10, 2);

	function TS_VCSC_ComposerColumnAdditions($output, $atts, $content='') {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}
		
		extract( shortcode_atts( array(
			'animation_factor'			=> '0.33',
			'animation_scroll'			=> 'false',
			'animation_view'			=> '',
			'animation_speed'			=> 2000,
		), $atts ) );

		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			if (get_option('ts_vcsc_extend_settings_loadWaypoints', 1) == 1) {
				wp_enqueue_script('ts-extend-waypoints',                	TS_VCSC_GetResourceURL('js/jquery.waypoints.min.js'), array('jquery'), false, false);
			}
			wp_enqueue_style('ts-extend-animations',                 		TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-animations.min.css'), null, false, 'all');
			wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
		
		if ($animation_view != '') {
			$animation_css			= "ts-viewport-css-" . $animation_view;
			echo '<div class="ts-viewport-column ts-viewport-animation" data-scrollup = "' . $animation_scroll . '" data-factor="' . $animation_factor . '" data-viewport="' . $animation_css . '" data-speed="' . $animation_speed . '"></div>';
		} else {
			echo '';
		}
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}

	
	if (!function_exists('vc_theme_before_vc_column')){
		function vc_theme_before_vc_column($atts, $content = null){
			return apply_filters( 'TS_VCSC_ComposerColumnAdditions_Filter', '', $atts, $content );
		}
	}
?>