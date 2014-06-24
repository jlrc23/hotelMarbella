<?php
	add_shortcode('TS-VCSC-Circliful', 'TS_VCSC_Circliful_Function');
	function TS_VCSC_Circliful_Function ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}
		
		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_style('ts-extend-simptip',                 			TS_VCSC_GetResourceURL('css/jquery.simptip.css'), null, false, 'all');
			wp_enqueue_style('ts-extend-animations',                 		TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-animations.min.css'), null, false, 'all');
			wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
		}
		if (get_option('ts_vcsc_extend_settings_loadWaypoints', 1) == 1) {
			wp_enqueue_script('ts-extend-waypoints',						TS_VCSC_GetResourceURL('js/jquery.waypoints.min.js'), array('jquery'), false, $FOOTER);
		}
		if (get_option('ts_vcsc_extend_settings_loadCountUp', 1) == 1) {
			wp_enqueue_script('ts-extend-countup',							TS_VCSC_GetResourceURL('js/jquery.countUp.min.js'), array('jquery'), false, $FOOTER);
		}
		wp_enqueue_script('ts-extend-circliful', 							TS_VCSC_GetResourceURL('js/jquery.circliful.min.js'), array('jquery'), false, $FOOTER);
		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
		
		extract( shortcode_atts( array(
			'color_foreground'			=> '#117d8b',
			'color_background'			=> '#eeeeee',
			'circle_fill'				=> 'false',
			'circle_inside'				=> '#ffffff',
			'circle_half'				=> 'false',
			'circle_maxsize'			=> 250,
			'circle_thickness'			=> 15,
			'circle_percent'			=> 15,
			'circle_speed'				=> 0.5,
			'circle_value_text'			=> '',
			'circle_value_pre'			=> '',
			'circle_value_post'			=> '',
			'circle_value_info'			=> '',
			'circle_value_group'		=> ',',
			'circle_value_seperator'	=> '.',
			'circle_value_decimals'		=> 0,
			'circle_icon'				=> '',
			'circle_icon_position'		=> 'left',
			'circle_icon_color'			=> '#dddddd',
			'margin_top'				=> 0,
			'margin_bottom'				=> 0,
			'el_id' 					=> '',
			'el_class' 					=> '',
		), $atts ));
		
		if (!empty($el_id)) {
			$circliful_id				= $el_id;
		} else {
			$circliful_id				= 'ts-vcsc-circliful-' . mt_rand(999999, 9999999);
		}
		
		$output = '';

		if ($circle_fill == "true") {
			$circliful_colors			= 'data-fgcolor="' . $color_foreground . '" data-bgcolor="' . $color_background . '" data-fill="' . $circle_inside . '"';
		} else {
			$circliful_colors			= 'data-fgcolor="' . $color_foreground . '" data-bgcolor="' . $color_background . '"';
		}

		if (!empty($circle_value_text)) {
			$circle_value_text			= floatval($circle_value_text);
		} else {
			$circle_value_text			= floatval($circle_percent);
		}
		
		if (!empty($circle_value_info)) {
			$circliful_content			= 'data-animation-step="' . $circle_speed . '" data-text="' . $circle_value_text . '" data-seperator="' . $circle_value_seperator . '" data-decimals="' . TS_VCSC_numberOfDecimals(floatval($circle_value_text)) . '" data-prefix="' . $circle_value_pre . '" data-postfix="' . $circle_value_post . '" data-group="' . $circle_value_group . '" data-info="' . $circle_value_info . '"';
		} else {
			$circliful_content			= 'data-animation-step="' . $circle_speed . '" data-text="' . $circle_value_text . '" data-seperator="' . $circle_value_seperator . '" data-decimals="' . TS_VCSC_numberOfDecimals(floatval($circle_value_text)) . '" data-prefix="' . $circle_value_pre . '" data-postfix="' . $circle_value_post . '" data-group="' . $circle_value_group . '"';
		}
		
		if ($circle_half == "false") {
			$circliful_half				= 'data-type=""';
		} else {
			$circliful_half				= 'data-type="half"';
		}
		
		if (!empty($circle_icon)) {
			$circliful_icon				= 'data-icon="' . $circle_icon . '" data-icon-position="' . $circle_icon_position . '" data-icon-color="' . $circle_icon_color . '"';
		} else {
			$circliful_icon				= '';
		}
	
		$output .= '<div id="' . $circliful_id . '-parent" class="ts-circliful-counter-parent" style="width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
			$output .= '<div id="' . $circliful_id . '" data-id="' . $circliful_id . '" class="ts-circliful-counter ' . $el_class . '" ' . $circliful_colors . ' ' . $circliful_content . ' ' . $circliful_half . ' ' . $circliful_icon . ' data-view="false" data-width="' . $circle_thickness . '" data-percent="' . $circle_percent . '" data-percent-view="' . $circle_percent . '"></div>';
		$output .= '</div>';
	
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>