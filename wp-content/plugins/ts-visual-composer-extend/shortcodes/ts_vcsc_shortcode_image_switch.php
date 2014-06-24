<?php
	add_shortcode('TS-VCSC-Image-Switch', 'TS_VCSC_Image_Switch_Function');
	function TS_VCSC_Image_Switch_Function ($atts) {
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
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
		
		extract( shortcode_atts( array(
			'image_start'					=> '',
			'image_end'						=> '',
			'image_responsive'				=> 'false',
			'image_height'					=> 'height: 100%;',
			'image_width_percent'			=> 100,
			'image_width'					=> 300,
			//'image_height'				=> 200,
			'image_position'				=> 'ts-imagefloat-center',
			'attribute_alt_start'			=> 'false',
			'attribute_alt_value_start'		=> '',
			'attribute_alt_end'				=> 'false',
			'attribute_alt_value_end'		=> '',
			'switch_type'					=> 'ts-imageswitch-flip',
			'switch_trigger_flip'			=> 'ts-trigger-click',
			'switch_trigger_fade'			=> 'ts-trigger-hover',
			'switch_handle_show'			=> 'true',
			'switch_handle_center'			=> 'true',
			'switch_handle_color'			=> '#0094FF',
			'tooltip_css'					=> 'false',
			'tooltip_content'				=> '',
			'tooltip_position'				=> 'ts-simptip-position-top',
			'tooltip_style'					=> '',
			'margin_top'					=> 0,
			'margin_bottom'					=> 0,
			'el_id' 						=> '',
			'el_class'                  	=> '',
		), $atts ));
	
		$switch_image_start 				= wp_get_attachment_image_src($image_start, 'full');
		$switch_image_end 					= wp_get_attachment_image_src($image_end, 'full');
		
		$switch_margin 						= 'margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;';
		
		$output 							= "";
		
		if (!empty($el_id)) {
			$switch_image_id				= $el_id;
		} else {
			$switch_image_id				= 'ts-vcsc-image-switch-' . mt_rand(999999, 9999999);
		}
	
		// Handle Adjust
		if ($switch_type == "ts-imageswitch-slide") {
			$switch_handle_adjust 			= "left: 50%;";
			$switch_image 					= "right: 50%;";
		} else {
			$switch_handle_adjust 			= "";
			$switch_image					= "";
		}
	
		// Tooltip
		if ($tooltip_css == "true") {
			if (strlen($tooltip_content) != 0) {
				$switch_tooltipclasses		= " ts-simptip-multiline " . $tooltip_style . " " . $tooltip_position;
				$switch_tooltipcontent		= ' data-tooltip="' . $tooltip_content . '"';
			} else {
				$switch_tooltipclasses		= "";
				$switch_tooltipcontent		= "";
			}
		} else {
			$switch_tooltipclasses			= "";
			if (strlen($tooltip_content) != 0) {
				$switch_tooltipcontent		= ' title="' . $tooltip_content . '"';
			} else {
				$switch_tooltipcontent		= "";
			}
		}
		
		// Handle Padding
		if ($switch_handle_show == "true") {
			$switch_padding					= "padding-bottom: 16px;";
		} else {
			$switch_padding					= "";
		}
		
		// Trigger
		if ($switch_type == "ts-imageswitch-flip") {
			$switch_trigger 				= $switch_trigger_flip;
		} else if ($switch_type == "ts-imageswitch-slide") {
			$switch_trigger 				= "ts-trigger-slide";
		} else if ($switch_type == "ts-imageswitch-fade") {
			$switch_trigger 				= $switch_trigger_fade;
		}
		
		// Handle Icon
		if ($switch_trigger == "ts-trigger-click") {
			$switch_handle_icon				= 'handle_click';
		} else if ($switch_trigger == "ts-trigger-hover") {
			$switch_handle_icon				= 'handle_hover';
		} else if ($switch_trigger == "ts-trigger-slide") {
			$switch_handle_icon				= 'handle_slide';
		}
		
		$image_extension_start				= pathinfo($switch_image_start[0], PATHINFO_EXTENSION);
		$image_extension_end				= pathinfo($switch_image_end[0], PATHINFO_EXTENSION);
		
		if ($attribute_alt_start == "true") {
			$alt_attribute_start			= $attribute_alt_value_start;
		} else {
			$alt_attribute_start			= basename($switch_image_start[0], "." . $image_extension_start);
		}
		
		if ($attribute_alt_end == "true") {
			$alt_attribute_end				= $attribute_alt_value_end;
		} else {
			$alt_attribute_end				= basename($switch_image_end[0], "." . $image_extension_end);
		}
		
		if ($image_responsive == "true") {
			$output .= '<div id="' . $switch_image_id . '" data-trigger="' . $switch_trigger . '" class="ts-imageswitch ' . $switch_type . ' ' . $switch_trigger . ' ' . $image_position . $switch_tooltipclasses . ' ts-imageswitch-before" ' . $switch_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; width: ' . $image_width_percent . '%;">';
				$output .= '<div id="' . $switch_image_id . '-counter" class="ts-fluid-wrapper " style="width: ' . $image_width_percent . '%; ' . $image_height . '">';
					$output .= '<div style="' . $switch_padding . '">';
						$output .= '<ol class="ts-imageswitch-items" style="padding: 0px;">';
							$output .= '<li class="ts-imageswitch__before ' . ($switch_type == "ts-imageswitch-fade" ? "active" : "") . '" style="' . $image_height . '">';
								$output .= '<img src="' . $switch_image_start[0] . '" alt="' . $alt_attribute_start . '" style="width: ' . $image_width_percent . '%; height: auto;" data-status="Before">';
							$output .= '</li>';
							$output .= '<li class="ts-imageswitch__after" style="' . $switch_handle_adjust . '" style="' . $image_height . '">';
								$output .= '<img src="' . $switch_image_end[0] . '" alt="' . $alt_attribute_end . '" style="width: ' . $image_width_percent . '%; height: auto;" data-status="After" style="' . $switch_image . '">';
							$output .= '</li>';
						$output .= '</ol>';
						if ($switch_handle_show == "true") {
							if ($switch_type == "ts-imageswitch-slide") {
								$output .= '<div class="ts-imageswitch__handle" data-center="' . $switch_handle_center . '" style="' . $switch_handle_adjust . ' background-color: ' . $switch_handle_color . '"><span class="frame_' . $switch_handle_icon . '" style="background-color: ' . $switch_handle_color . '"><i class="' . $switch_handle_icon . '"></i></span>';
							} else {
								$output .= '<div class="ts-imageswitch__handle" style="' . $switch_handle_adjust . '"><span class="frame_' . $switch_handle_icon . '" style="background-color: ' . $switch_handle_color . '"><i class="' . $switch_handle_icon . '"></i></span>';
							}
							$output .= '</div>';
						} else if ($switch_type == "ts-imageswitch-slide") {
							$output .= '<div class="ts-imageswitch__handle" data-center="' . $switch_handle_center . '" style="' . $switch_handle_adjust . ' background-color: ' . $switch_handle_color . '"></div>';
						}
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		} else {
			$output .= '<div id="' . $switch_image_id . '" data-trigger="' . $switch_trigger . '" class="ts-imageswitch ' . $switch_type . ' ' . $switch_trigger . ' ' . $image_position . $switch_tooltipclasses . ' ts-imageswitch-before" ' . $switch_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; width: ' . $image_width . 'px;">';
				$output .= '<div id="' . $switch_image_id . '-counter" class="ts-fluid-wrapper " style="width: ' . $image_width . 'px; ' . $image_height . '">';
					$output .= '<div style="' . $switch_padding . '">';
						$output .= '<ol class="ts-imageswitch-items" style="padding: 0px;">';
							$output .= '<li class="ts-imageswitch__before ' . ($switch_type == "ts-imageswitch-fade" ? "active" : "") . '" style="' . $image_height . '">';
								$output .= '<img src="' . $switch_image_start[0] . '" alt="' . $alt_attribute_start . '" style="width: ' . $image_width . 'px; height: auto;" data-status="Before">';
							$output .= '</li>';
							$output .= '<li class="ts-imageswitch__after" style="' . $switch_handle_adjust . '" style="' . $image_height . '">';
								$output .= '<img src="' . $switch_image_end[0] . '" alt="' . $alt_attribute_end . '" style="width: ' . $image_width . 'px; height: auto;" data-status="After" style="' . $switch_image . '">';
							$output .= '</li>';
						$output .= '</ol>';
						if ($switch_handle_show == "true") {
							if ($switch_type == "ts-imageswitch-slide") {
								$output .= '<div class="ts-imageswitch__handle" data-center="' . $switch_handle_center . '" style="' . $switch_handle_adjust . ' background-color: ' . $switch_handle_color . '"><span class="frame_' . $switch_handle_icon . '" style="background-color: ' . $switch_handle_color . '"><i class="' . $switch_handle_icon . '"></i></span>';
							} else {
								$output .= '<div class="ts-imageswitch__handle" style="' . $switch_handle_adjust . '"><span class="frame_' . $switch_handle_icon . '" style="background-color: ' . $switch_handle_color . '"><i class="' . $switch_handle_icon . '"></i></span>';
							}
							$output .= '</div>';
						} else if ($switch_type == "ts-imageswitch-slide") {
							$output .= '<div class="ts-imageswitch__handle" data-center="' . $switch_handle_center . '" style="' . $switch_handle_adjust . ' background-color: ' . $switch_handle_color . '"></div>';
						}
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>