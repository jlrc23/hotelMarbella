<?php
	add_shortcode('TS-VCSC-Content-Flip', 'TS_VCSC_Content_Flip_Function');
	function TS_VCSC_Content_Flip_Function ($atts) {
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
			'flip_style'				=> 'style1',
			'flip_effect_style1'		=> 'vertical',
			'flip_effect_style2'		=> 'flip-up',
			'flip_effect_speed'			=> 'medium',
			'flip_size_auto'			=> 'true',
			'flip_size'					=> 200,
			'flip_border_type'			=> '',
			'flip_border_thick'			=> 1,
			'flip_border_radius'		=> '',
			'flip_border_color_front'	=> '#dddddd',
			'flip_border_color_back'	=> '#dddddd',
			'front_icon_replace'		=> 'true',
			'front_icon'				=> '',
			'front_image'				=> '',
			'front_image_full'			=> 'false',
			'front_icon_size'			=> 70,
			'front_icon_color'			=> '#000000',
			'front_icon_background'		=> '',
			'front_padding'				=> 'false',
			'front_icon_padding'		=> 0,
			'front_icon_frame_type'		=> '',
			'front_icon_frame_thick'	=> 1,
			'front_icon_frame_radius'	=> '',
			'front_icon_frame_color'	=> '',
			'front_title'				=> '',
			'front_html'				=> 'false',
			'front_content'				=> '',
			'front_content_html'		=> '',
			'front_color'				=> '#000000',
			'front_color_title'			=> '#000000',
			'front_background'			=> '#ffffff',
			'back_icon'					=> '',
			'back_image'				=> '',
			'back_title'				=> '',
			'back_html'					=> 'false',
			'back_content'				=> '',
			'back_content_html'			=> '',
			'back_color'				=> '#000000',
			'back_color_title'			=> '#000000',
			'back_background'			=> '#ffffff',
			'read_more_link'			=> 'false',
			'read_more_url'				=> '',
			'read_more_txt'				=> 'Read More',
			'read_more_target'			=> '_parent',
			'read_more_color'			=> '#000000',
			'read_more_background'		=> '#dddddd',
			'animation_icon'			=> '',
			'animation_view'            => '',
			'margin_bottom'				=> '20',
			'margin_top' 				=> '0',
			'el_id' 					=> '',
			'el_class'                  => '',
		), $atts ));
	
		if (!empty($el_id)) {
			$flip_box_id				= $el_id;
		} else {
			$flip_box_id				= 'ts-vcsc-flip-box-' . mt_rand(999999, 9999999);
		}
		
		if (!empty($front_image)) {
			$front_image_path 			= wp_get_attachment_image_src($front_image, 'large');
		}
	
		if ($flip_border_type != '') {
			$flip_border_style_front	= 'border: ' . $flip_border_thick . 'px ' . $flip_border_type . ' ' . $flip_border_color_front . ';';
			$flip_border_style_back		= 'border: ' . $flip_border_thick . 'px ' . $flip_border_type . ' ' . $flip_border_color_back . ';';
		} else {
			$flip_border_style_front	= '';
			$flip_border_style_back		= '';
		}
	
		if ($front_icon_frame_type != '') {
			$front_icon_frame_style		= 'border: ' . $front_icon_frame_thick . 'px ' . $front_icon_frame_type . ' ' . $front_icon_frame_color . ';';
			$front_icon_frame_class		= '';
		} else {
			$front_icon_frame_style		= '';
			$front_icon_frame_class		= '';
		}
		
		if ($front_padding == "true") {
			$front_icon_size_adjust		= ($front_icon_size - 2*$front_icon_padding - 2*$front_icon_frame_thick);
		} else {
			$front_icon_size_adjust		= ($front_icon_size - 2*$front_icon_frame_thick);
		}
		
		$front_icon_style				= 'background-color:' . $front_icon_background . '; width: ' . $front_icon_size . 'px; height: ' . $front_icon_size . 'px; font-size: ' . $front_icon_size_adjust . 'px; line-height: ' . $front_icon_size . 'px;';
		
		if ($front_image_full == "true") {
			$front_image_style			= 'width: 100%; height: auto; margin: 0px;';
			$front_panel_adjust			= 'padding: 0px;';
		} else {
			$front_image_style			= 'padding: ' . $front_icon_padding . 'px; background-color:' . $front_icon_background . '; width: ' . $front_icon_size . 'px; height: auto; ';
			$front_panel_adjust			= '';
		}
		
		if ($animation_view != '') {
			$animation_css              = TS_VCSC_GetCSSAnimation($animation_view);
		} else {
			$animation_css 				= '';
		}
		
		$output = '';
		
		if ($flip_style == "style1") {
			$output .= '<div id="' . $flip_box_id . '" class="flip-container-frame ' . $el_class . ' ' . $animation_css . ' ' . ($flip_size_auto == "true" ? "auto" : "fixed") . '" style="' . ($flip_size_auto == "false" ? "height: " . $flip_size . "px; " : "") . ' width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
				$output .= '<div class="flip-container-main ' . $flip_effect_style1 . ' ' . $flip_effect_speed . '">';
					$output .= '<div class="flip-container-flipper">';
						$output .= '<div class="flip-container-flipper-front ' . $flip_effect_speed . '" style="' . ($flip_size_auto == "true" ? "" : "height: 100%;") . 'width: 100%; background-color: ' . $front_background . '; ' . $flip_border_style_front . '">';
							$output .= '<div class="ts-flip-content" style="color: ' . $front_color . '; ' . $front_panel_adjust . '">';
								if ($front_image_full == "true") {
									$output .= '<img src="' . $front_image_path[0] . '" style="' . $front_image_style . '" class="' . $animation_icon . '">';
								} else {
									if ($front_icon_replace == "false") {
										$output .= '<i style="color:' . $front_icon_color . ';' . $front_icon_style . ' ' . $front_icon_frame_style . ' text-align: center; display: inline-block !important; margin: 10px auto;" class="ts-font-icon ' . $front_icon . ' ' . $front_icon_frame_class . ' ' . $animation_icon . ' ' . $front_icon_frame_radius . '"></i>';
									} else {
										$output .= '<img src="' . $front_image_path[0] . '" style="' . $front_image_style . ' ' . $front_icon_frame_style . '" class="ts-font-icon ' . $front_icon_frame_class . ' ' . $front_icon_frame_radius . ' ' . $animation_icon . '">';
									}
									$output .= '<h3 style="color: ' . $front_color_title . '">' . $front_title . '</h3>';
									if ($back_html == "true") {
										$output .= '<p class="ts-flip-text">' . rawurldecode(base64_decode(strip_tags($front_content_html))) . '</p>';
									} else {
										$output .= '<p class="ts-flip-text">' . strip_tags($front_content) . '</p>';
									}
								}
							$output .= '</div>';
						$output .= '</div>';
						$output .= '<div class="flip-container-flipper-back ' . $flip_effect_speed . '" style="' . ($flip_size_auto == "true" ? "" : "height: 100%;") . 'width: 100%; background-color: ' . $back_background . '; ' . $flip_border_style_back . '">';
							$output .= '<div class="ts-flip-content" style="color: ' . $back_color . ';">';
								$output .= '<h3 style="color: ' . $back_color_title . '">' . $back_title . '</h3>';
								if ($back_html == "true") {
									$output .= '<p class="ts-flip-text">' . rawurldecode(base64_decode(strip_tags($back_content_html))) . '</p>';
								} else {
									$output .= '<p class="ts-flip-text">' . strip_tags($back_content) . '</p>';
								}
								if ((!empty($read_more_url)) && ($read_more_link == "true")) {
									$output .= '<p class="ts-flip-link"><a href="' . $read_more_url . '" target="' . $read_more_target . '" style="color: ' . $read_more_color . '; background: ' . $read_more_background . '">' . $read_more_txt . '</a></p>';
								}
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		} else if ($flip_style == "style2") {
			$output .= '<div class="clearfix">';
				$output .= '<div id="' . $flip_box_id . '" class="ts-flip-cube ' . $flip_effect_style2 . ' ' . $el_class . ' ' . $animation_css . ' ' . ($flip_size_auto == "true" ? "auto" : "fixed") . '" style="' . ($flip_size_auto == "false" ? "height: " . $flip_size . "px; " : "") . 'width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<div class="ts-object" style="height: 100%; width: 100%;">';
						$output .= '<div class="ts-front" style="height: 100%; width: 100%; background-color: ' . $front_background . '; ' . $flip_border_style_front . '">';
							$output .= '<div class="ts-flip-content" style="color: ' . $front_color . '; ' . $front_panel_adjust . '">';
								if ($front_image_full == "true") {
									$output .= '<img src="' . $front_image_path[0] . '" style="' . $front_image_style . '" class="' . $animation_icon . '">';
								} else {
									if ($front_icon_replace == "false") {
										$output .= '<i style="color:' . $front_icon_color . ';' . $front_icon_style . ' ' . $front_icon_frame_style . ' text-align: center; display: inline-block !important; margin: 10px auto;" class="ts-font-icon ' . $front_icon . ' ' . $front_icon_frame_class . ' ' . $animation_icon . ' ' . $front_icon_frame_radius . '"></i>';
									} else {
										$output .= '<img src="' . $front_image_path[0] . '" style="' . $front_image_style . ' ' . $front_icon_frame_style . '" class="ts-font-icon ' . $front_icon_frame_class . ' ' . $front_icon_frame_radius . ' ' . $animation_icon . '">';
									}
									$output .= '<h3 style="color: ' . $front_color_title . '">' . $front_title . '</h3>';
									if ($back_html == "true") {
										$output .= '<p class="ts-flip-text">' . rawurldecode(base64_decode(strip_tags($front_content_html))) . '</p>';
									} else {
										$output .= '<p class="ts-flip-text">' . strip_tags($front_content) . '</p>';
									}
								}
							$output .= '</div>';
						$output .= '</div>';
						$output .= '<div class="ts-back" style="height: 100%; width: 100%; background-color: ' . $back_background . '; ' . $flip_border_style_back . '">';
							$output .= '<div class="ts-flip-content" style="color: ' . $back_color . ';">';
								$output .= '<h3 style="color: ' . $back_color_title . '">' . $back_title . '</h3>';
								if ($back_html == "true") {
									$output .= '<p class="ts-flip-text">' . rawurldecode(base64_decode(strip_tags($back_content_html))) . '</p>';
								} else {
									$output .= '<p class="ts-flip-text">' . strip_tags($back_content) . '</p>';
								}
								if ((!empty($read_more_url)) && ($read_more_link == "true")) {
									$output .= '<p class="ts-flip-link"><a href="' . $read_more_url . '" target="' . $read_more_target . '" style="color: ' . $read_more_color . '; background: ' . $read_more_background . '">' . $read_more_txt . '</a></p>';
								}
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>