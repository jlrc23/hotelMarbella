<?php
	add_shortcode('TS-VCSC-Icon-Counter', 'TS_VCSC_Icon_Counter_Function');
	function TS_VCSC_Icon_Counter_Function ($atts) {
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
		if (get_option('ts_vcsc_extend_settings_loadCountTo', 1) == 1) {
			wp_enqueue_script('ts-extend-countto',							TS_VCSC_GetResourceURL('js/jquery.countTo.min.js'), array('jquery'), false, $FOOTER);
		}
		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
		
		extract( shortcode_atts( array(
			'icon'                      => '',
			'icon_position'             => 'top',
			'icon_size_slide'           => 75,
			'icon_margin'				=> 10,
			'icon_color'                => '#000000',
			'icon_background'		    => '',
			'icon_frame_type' 			=> '',
			'icon_frame_thick'			=> 1,
			'icon_frame_radius'			=> '',
			'icon_frame_color'			=> '#000000',
			'icon_replace'				=> 'false',
			'icon_image'				=> '',
			'padding'					=> 'false',
			'icon_padding'				=> 5,
			'counter_value_start'		=> 0,
			'counter_value_end'			=> '',
			'counter_value_size'		=> 30,
			'counter_value_color'		=> '#000000',
			'counter_value_format'		=> 'false',
			'counter_value_plus'		=> 'false',
			'counter_value_seperator'	=> '',
			
			'counter_value_before'		=> '',
			'counter_value_after'		=> '',
			
			'counter_seperator'			=> 'false',
			'counter_note'				=> '',
			'counter_note_size'			=> 15,
			'counter_note_color'		=> '#000000',
			'counter_speed'				=> 2000,
			'tooltip_css'				=> 'false',
			'tooltip_content'			=> '',
			'tooltip_position'			=> 'ts-simptip-position-top',
			'tooltip_style'				=> '',
			'animation_icon'			=> '',
			'margin_top'                => 0,
			'margin_bottom'             => 0,
			'el_id' 					=> '',
			'el_class'                  => '',
		), $atts ));
	
		if (!empty($el_id)) {
			$icon_counter_id			= $el_id;
		} else {
			$icon_counter_id			= 'ts-vcsc-icon-counter-' . mt_rand(999999, 9999999);
		}
		
		if (!empty($icon_image)) {
			$icon_image_path 			= wp_get_attachment_image_src($icon_image, 'large');
		}
		
		$icon_counter_animation			= "ts-viewport-css-" . $animation_icon;
		$icon_hover_animation			= "ts-hover-css-" . $animation_icon;
	
		if ($padding == "true") {
			$icon_frame_padding			= 'padding: ' . $icon_padding . 'px; ';
		} else {
			$icon_frame_padding			= '';
		}	
		
		$icon_style                     = '' . $icon_frame_padding . 'color: ' . $icon_color . '; background-color:' . $icon_background . '; width:' . $icon_size_slide . 'px; height:' . $icon_size_slide . 'px; font-size:' . $icon_size_slide . 'px; line-height:' . $icon_size_slide . 'px;';
		$icon_image_style				= '' . $icon_frame_padding . 'background-color:' . $icon_background . '; width: ' . $icon_size_slide . 'px; height: ' . $icon_size_slide . 'px; ';
	
		if ($icon_frame_type != '') {
			$icon_frame_class 	        = 'frame-enabled';
			$icon_frame_style 	        = 'border: ' . $icon_frame_thick . 'px ' . $icon_frame_type . ' ' . $icon_frame_color . ';';
		} else {
			$icon_frame_class			= '';
			$icon_frame_style			= '';
		}
		
		if ($counter_seperator == "true") {
			$icon_seperator				= ' seperator';
		} else {
			$icon_seperator				= '';
		}
		
		// Number Formatting
		if ($counter_value_format == "true") {
			$format_value_plus			= $counter_value_plus;
			$format_value_seperator		= $counter_value_seperator;
		} else {
			$format_value_plus			= '';
			$format_value_seperator		= '';
		}
		
		// Tooltip
		if ($tooltip_css == "true") {
			if (strlen($tooltip_content) != 0) {
				$icon_tooltipclasses	= " ts-simptip-multiline " . $tooltip_style . " " . $tooltip_position;
				$icon_tooltipcontent	= ' data-tooltip="' . $tooltip_content . '"';
			} else {
				$icon_tooltipclasses	= "";
				$icon_tooltipcontent	= "";
			}
		} else {
			$icon_tooltipclasses		= "";
			if (strlen($tooltip_content) != 0) {
				$icon_tooltipcontent	= ' title="' . $tooltip_content . '"';
			} else {
				$icon_tooltipcontent	= "";
			}
		}	
		
		$output = '';
		
		if ($icon_position == 'top') {
			$output .= '<div id="' . $icon_counter_id . '" class="ts-icon-counter ' . $el_class . ' ts-counter-top ' . $icon_seperator . '' . $icon_tooltipclasses . '" ' . $icon_tooltipcontent . ' style="margiin-bottom: ' . $margin_bottom . 'px; margin-top: ' . $margin_top . 'px;">';
				$output .= '<table class="ts-counter-icon-holder" border="0" style="border: none !important; border-color: transparent !important;">';
					$output .= '<tr>';
						$output .= '<td style="text-align: center;">';
							$output .= '<div class="ts-counter-icon-top">';
								if ($icon_replace == "false") {
									$output .= '<div class="ts-counter-icon">';
										$output .= '<i class="ts-font-icon ' . $icon . ' ' . $icon_frame_radius . ' ' . $icon_hover_animation . '" style="' . $icon_style . ' ' . $icon_frame_style . '"></i>';
									$output .= '</div>';
								} else {
									$output .= '<div class="ts-counter-image" style="' . $icon_image_style . ';">';
										$output .= '<img class="ts-font-icon ' . $icon_frame_radius . ' ' . $icon_hover_animation . '" src="' . $icon_image_path[0] .'">';
									$output .= '</div>';
								}
							$output .= '</div>';
						$output .= '</td>';
					$output .= '</tr>';
					$output .= '<tr>';
						$output .= '<td style="text-align: center;">';
							$output .= '<div class="ts-counter-content ' . $icon_tooltipclasses . '">';
								$output .= '<div class="ts-counter-value" style="font-size: ' . $counter_value_size . 'px; color: ' . $counter_value_color . ';" data-before="' . $counter_value_before . '" data-after="' . $counter_value_after . '" data-format="' . $counter_value_format . '" data-seperator="' . $format_value_seperator . '" data-plus="' . $format_value_plus . '" data-animation="' . $icon_counter_animation . '" data-start="' . $counter_value_start . '" data-end="' . $counter_value_end . '" data-speed="' . $counter_speed . '">' . $counter_value_before . '' . $counter_value_start . '' . $counter_value_after . '</div>';
								$output .= '<div class="ts-counter-note" style="font-size: ' . $counter_note_size . 'px; color: ' . $counter_note_color . ';">' . $counter_note . '</div>';
							$output .= '</div>';
						$output .= '</td>';
					$output .= '</tr>';
				$output .= '</table>';
			$output .= '</div>';
		} else if ($icon_position == 'left') {
			$output .= '<div id="' . $icon_counter_id . '" class="ts-icon-counter ' . $el_class . ' ts-counter-left ' . $icon_seperator . '' . $icon_tooltipclasses . '" ' . $icon_tooltipcontent . ' style="margiin-bottom: ' . $margin_bottom . 'px; margin-top: ' . $margin_top . 'px;">';
				$output .= '<table class="ts-counter-icon-holder" border="0" style="border: none !important; border-color: transparent !important;">';
					$output .= '<tr>';
						$output .= '<td style="padding-right: 15px; text-align: left;">';
							$output .= '<div class="ts-counter-icon-left">';
								if ($icon_replace == "false") {
									$output .= '<div class="ts-counter-icon">';
										$output .= '<i class="ts-font-icon ' . $icon . ' ' . $icon_frame_radius . ' ' . $icon_hover_animation . '" style="' . $icon_style . ' ' . $icon_frame_style . '"></i>';
									$output .= '</div>';
								} else {
									$output .= '<div class="ts-counter-image" style="' . $icon_image_style . ';">';
										$output .= '<img class="ts-font-icon ' . $icon_frame_radius . ' ' . $icon_hover_animation . '" src="' . $icon_image_path[0] .'">';
									$output .= '</div>';
								}
							$output .= '</div>';
						$output .= '</td>';
						$output .= '<td>';
							$output .= '<div class="ts-counter-content ' . $icon_tooltipclasses . '">';
								$output .= '<div class="ts-counter-value" style="font-size: ' . $counter_value_size . 'px; color: ' . $counter_value_color . ';" data-before="' . $counter_value_before . '" data-after="' . $counter_value_after . '" data-format="' . $counter_value_format . '" data-seperator="' . $format_value_seperator . '" data-plus="' . $format_value_plus . '" data-animation="' . $icon_counter_animation . '" data-start="' . $counter_value_start . '" data-end="' . $counter_value_end . '" data-speed="' . $counter_speed . '">' . $counter_value_before . '' . $counter_value_start . '' . $counter_value_after . '</div>';
								$output .= '<div class="ts-counter-note" style="font-size: ' . $counter_note_size . 'px; color: ' . $counter_note_color . ';">' . $counter_note . '</div>';
							$output .= '</div>';
						$output .= '</td>';
					$output .= '</tr>';
				$output .= '</table>';
			$output .= '</div>';
		} else {
			$output .= '<div id="' . $icon_counter_id . '" class="ts-icon-counter ' . $el_class . ' ts-counter-right ' . $icon_seperator . '' . $icon_tooltipclasses . '" ' . $icon_tooltipcontent . ' style="margiin-bottom: ' . $margin_bottom . 'px; margin-top: ' . $margin_top . 'px;">';
				$output .= '<table class="ts-counter-icon-holder" border="0" style="border: none !important; border-color: transparent !important;">';
					$output .= '<tr>';
						$output .= '<td style="padding-right: 15px; text-align: right;">';
							$output .= '<div class="ts-counter-content">';
								$output .= '<div class="ts-counter-value" style="font-size: ' . $counter_value_size . 'px; color: ' . $counter_value_color . ';" data-before="' . $counter_value_before . '" data-after="' . $counter_value_after . '" data-format="' . $counter_value_format . '" data-seperator="' . $format_value_seperator . '" data-plus="' . $format_value_plus . '" data-animation="' . $icon_counter_animation . '" data-start="' . $counter_value_start . '" data-end="' . $counter_value_end . '" data-speed="' . $counter_speed . '">' . $counter_value_before . '' . $counter_value_start . '' . $counter_value_after . '</div>';
								$output .= '<div class="ts-counter-note" style="font-size: ' . $counter_note_size . 'px; color: ' . $counter_note_color . ';">' . $counter_note . '</div>';
							$output .= '</div>';
						$output .= '</td>';
						$output .= '<td>';
							$output .= '<div class="ts-counter-icon-right">';
								if ($icon_replace == "false") {
									$output .= '<div class="ts-counter-icon">';
										$output .= '<i class="ts-font-icon ' . $icon . ' ' . $icon_frame_radius . ' ' . $icon_hover_animation . '" style="' . $icon_style . ' ' . $icon_frame_style . '"></i>';
									$output .= '</div>';
								} else {
									$output .= '<div class="ts-counter-image" style="' . $icon_image_style . '">';
										$output .= '<img class="ts-font-icon ' . $icon_frame_radius . ' ' . $icon_hover_animation . '" src="' . $icon_image_path[0] .'">';
									$output .= '</div>';
								}
							$output .= '</div>';
						$output .= '</td>';
					$output .= '</tr>';
				$output .= '</table>';
			$output .= '</div>';
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>