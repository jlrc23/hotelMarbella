<?php
	add_shortcode('TS-VCSC-Image-Overlay', 'TS_VCSC_Image_Overlay_Function');
	function TS_VCSC_Image_Overlay_Function ($atts) {
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
			'image'						=> '',
			'attribute_alt'				=> 'false',
			'attribute_alt_value'		=> '',
			'title'						=> '',
			'message'					=> '',
			'image_fixed'				=> 'false',
			'image_width'				=> 300,
			'image_height'				=> 200,
			'image_position'			=> 'ts-imagefloat-center',
			'hover_type'           		=> 'ts-view-first',
			'button_text'				=> 'Read More',
			'button_url'				=> '',
			'button_target'				=> '_parent',
			'margin_top'				=> 0,
			'margin_bottom'				=> 0,
			'overlay_trigger'			=> 'ts-trigger-click',
			'overlay_handle_show'		=> 'true',
			'overlay_handle_color'		=> '#0094FF',
			'tooltip_css'				=> 'false',
			'tooltip_content'			=> '',
			'tooltip_position'			=> 'ts-simptip-position-top',
			'tooltip_style'				=> '',
			'el_id' 					=> '',
			'el_class'                  => '',
		), $atts ));
	
		$hover_image = wp_get_attachment_image_src($image, 'large');
		
		$hover_margin = 'margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;';
		
		$output = "";
		
		if (!empty($el_id)) {
			$hover_image_id				= $el_id;
		} else {
			$hover_image_id				= 'ts-vcsc-image-hover-' . mt_rand(999999, 9999999);
		}
	
		// Handle Padding
		if ($overlay_handle_show == "true") {
			$overlay_padding			= "padding-bottom: 25px;";
			$switch_handle_adjust  		= "";
		} else {
			$overlay_padding			= "";
			$switch_handle_adjust  		= "";
		}
	
		// Tooltip
		if ($tooltip_css == "true") {
			if (strlen($tooltip_content) != 0) {
				$hover_tooltipclasses	= " ts-simptip-multiline " . $tooltip_style . " " . $tooltip_position;
				$hover_tooltipcontent	= ' data-tooltip="' . $tooltip_content . '"';
			} else {
				$hover_tooltipclasses	= "";
				$hover_tooltipcontent	= "";
			}
		} else {
			$hover_tooltipclasses		= "";
			if (strlen($tooltip_content) != 0) {
				$hover_tooltipcontent	= ' title="' . $tooltip_content . '"';
			} else {
				$hover_tooltipcontent	= "";
			}
		}
		
		$image_extension 				= pathinfo($hover_image[0], PATHINFO_EXTENSION);
		
		if ($attribute_alt == "true") {
			$alt_attribute				= $attribute_alt_value;
		} else {
			$alt_attribute				= basename($hover_image[0], "." . $image_extension);
		}
		
		if ($image_fixed == "true") {
			$output .= '<div id="' . $hover_image_id . '" class="ts-image-hover-frame ' . $image_position . $hover_tooltipclasses . ' ' . $el_class . '" ' . $hover_tooltipcontent . ' style="width: ' . $image_width . 'px; ' . $hover_margin . '">';
				$output .= '<div id="' . $hover_image_id . '-counter" class="ts-fluid-wrapper " style="width: ' . $image_width . 'px; height: auto;">';
					if ($overlay_handle_show == "true") {
						$output .= '<div style="' . $overlay_padding . '">';
					}
						$output .= '<div class="ts-imagehover ' . $hover_type . '" style="width: ' . $image_width . 'px; height: ' . $image_height . 'px;">';
							$output .= '<img src="' . $hover_image[0] . '" alt="' . $alt_attribute . '" style="width: ' . $image_width . 'px; height: ' . $image_height . 'px;"/>';
							$output .= '<div class="mask" style="width: ' . $image_width . 'px; height: ' . $image_height . 'px;">';
								$output .= '<h2>' . $title . '</h2>';
								$output .= '<p>' . $message . '</p>';
								if (strlen($button_url) != 0) {
									$output .= '<a href="' . $button_url . '" class="info" target="' . $button_target . '">' . $button_text . '</a>';
								}
							$output .= '</div>';
						$output .= '</div>';
						if ($overlay_handle_show == "true") {
							$output .= '<div class="ts-image-hover-handle" style="' . $switch_handle_adjust . '"><span class="frame_handle_hover" style="background-color: ' . $overlay_handle_color . '"><i class="handle-hover"></i></span></div>';
						}
					if ($overlay_handle_show == "true") {
						$output .= '</div>';
					}
				$output .= '</div>';
			$output .= '</div>';
		} else {
			$output .= '<div id="' . $hover_image_id . '" class="ts-image-hover-frame ' . $image_position . $hover_tooltipclasses . ' ' . $el_class . '" ' . $hover_tooltipcontent . ' style="width: 100%; ' . $hover_margin . '">';
				$output .= '<div id="' . $hover_image_id . '-counter" class="ts-fluid-wrapper " style="width: 100%; height: auto;">';
					if ($overlay_handle_show == "true") {
						$output .= '<div style="' . $overlay_padding . '">';
					}
						$output .= '<div class="ts-imagehover ' . $hover_type . '" style="width: 100%; height: auto;">';
							$output .= '<img src="' . $hover_image[0] . '" alt="' . $alt_attribute . '" style="width: 100%; height: auto;"/>';
							$output .= '<div class="mask" style="width: 100%; height: 100%;">';
								$output .= '<h2>' . $title . '</h2>';
								$output .= '<p>' . $message . '</p>';
								if (strlen($button_url) != 0) {
									$output .= '<a href="' . $button_url . '" class="info" target="' . $button_target . '">' . $button_text . '</a>';
								}
							$output .= '</div>';
						$output .= '</div>';
						if ($overlay_handle_show == "true") {
							$output .= '<div class="ts-image-hover-handle" style="' . $switch_handle_adjust . '"><span class="frame_handle_hover" style="background-color: ' . $overlay_handle_color . '"><i class="handle-hover"></i></span></div>';
						}
					if ($overlay_handle_show == "true") {
						$output .= '</div>';
					}
				$output .= '</div>';
			$output .= '</div>';
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>