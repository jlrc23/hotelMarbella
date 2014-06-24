<?php
	add_shortcode('TS-VCSC-IFrame', 'TS_VCSC_IFrame_Function');
	function TS_VCSC_IFrame_Function ($atts, $content = null) {
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
		wp_enqueue_script('ts-extend-hammer', 								TS_VCSC_GetResourceURL('js/jquery.hammer.min.js'), array('jquery'), false, $FOOTER);
		wp_enqueue_script('ts-extend-nacho', 								TS_VCSC_GetResourceURL('js/jquery.nchlightbox.min.js'), array('jquery'), false, $FOOTER);
		wp_enqueue_style('ts-extend-nacho',									TS_VCSC_GetResourceURL('css/jquery.nchlightbox.min.css'), null, false, 'all');
		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
		
		extract( shortcode_atts( array(
			'content_image_responsive'		=> 'true',
			'content_image_width_r'			=> 100,
			'content_image_width_f'			=> 300,
			'content_image_size'			=> 'large',
			
			'iframe_width'					=> 'auto',
			'iframe_width_percent'			=> 100,
			'iframe_width_pixel'			=> 1024,
			'iframe_height'					=> 'auto',
			'iframe_height_pixel'			=> 400,
			'iframe_transparency'			=> 'true',

			'lightbox_group_name'			=> 'nachogroup',
			'lightbox_size'					=> 'full',
			'lightbox_effect'				=> 'random',
			'lightbox_speed'				=> 5000,
			'lightbox_social'				=> 'true',
			'lightbox_backlight_auto'		=> 'true',
			'lightbox_backlight_color'		=> '#ffffff',
			
			'content_lightbox'				=> 'true',
			'content_iframe'				=> '',
			'content_iframe_trigger'		=> 'preview',
			'content_iframe_title'			=> '',
			'content_iframe_subtitle'		=> '',
			'content_iframe_image'			=> '',
			'content_iframe_image_simple'	=> 'false',
			'content_iframe_icon'			=> '',
			'content_iframe_iconsize'		=> 30,
			'content_iframe_iconcolor' 		=> '#cccccc',
			'content_iframe_button'			=> '',
			'content_iframe_buttonstyle'	=> 'style1',
			'content_iframe_buttontext'		=> '',
			'content_iframe_text'			=> '',
			'content_raw'					=> '',
			
			'content_tooltip_css'			=> 'false',
			'content_tooltip_content'		=> '',
			'content_tooltip_position'		=> 'ts-simptip-position-top',
			'content_tooltip_style'			=> '',
			
			'margin_top'					=> 0,
			'margin_bottom'					=> 0,
			'el_id'							=> '',
			'el_class'						=> '',
		), $atts ));
	
		if (!empty($el_id)) {
			$modal_id						= $el_id;
		} else {
			$modal_id						= 'ts-vcsc-iframe-' . mt_rand(999999, 9999999);
		}

		// Tooltip
		if ($content_tooltip_css == "true") {
			if (strlen($content_tooltip_content) != 0) {
				$iframe_tooltipclasses		= " ts-simptip-multiline " . $content_tooltip_style . " " . $content_tooltip_position;
				$iframe_tooltipcontent		= ' data-tooltip="' . $content_tooltip_content . '"';
			} else {
				$iframe_tooltipclasses		= "";
				$iframe_tooltipcontent		= "";
			}
		} else {
			$iframe_tooltipclasses			= "";
			if (strlen($content_tooltip_content) != 0) {
				$iframe_tooltipcontent		= ' title="' . $content_tooltip_content . '"';
			} else {
				$iframe_tooltipcontent		= "";
			}
		}
		
		if ($lightbox_backlight_auto == "false") {
			$nacho_color			= 'data-backlight="' . $lightbox_backlight_color . '"';
		} else {
			$nacho_color			= '';
		}
		
		if ($content_image_responsive == "true") {
			$image_dimensions		= 'width: 100%; height: auto;';
			$parent_dimensions		= 'width: ' . $content_image_width_r . '%; height: 100%;';
		} else {
			$image_dimensions		= 'width: 100%; height: auto;';
			$parent_dimensions		= 'width: ' . $content_image_width_f . 'px; height: 100%;';
		}
		
		$output						= '';

		if ($content_lightbox == "true") {
			
			$iframe_dimensions 		= ' ';
			if ($iframe_width == "widthpercent") {
				$iframe_dimensions 		.= 'data-width="' . $iframe_width_percent . '%" ';
			} else if ($iframe_width == "widthpixel") {
				$iframe_dimensions 		.= 'data-width="' . $iframe_width_pixel . '" ';
			}
			if ($iframe_height == "heightpixel") {
				$iframe_dimensions 		.= 'data-height="' . $iframe_height_pixel . '" ';
			}
			
			if ($content_iframe_trigger == "default") {
				$modal_image = TS_VCSC_GetResourceURL('images/Default_IFrame.jpg');
				if ($iframe_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $iframe_tooltipclasses . '" ' . $iframe_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-iframe" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-iframe" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_iframe . '" class="nch-lightbox" ' . $iframe_dimensions . ' data-title="' . $content_iframe_title . '" data-type="iframe" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="nchgrid-caption"></div>';
							if (!empty($content_iframe_title)) {
								$output .= '<div class="nchgrid-caption-text">' . $content_iframe_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($iframe_tooltipcontent != '') {
					$output .= '</div>';
				}
			} else if ($content_iframe_trigger == "image") {
				$modal_image = wp_get_attachment_image_src($content_iframe_image, 'large');
				$modal_image = $modal_image[0];
				if ($content_iframe_image_simple == "false") {
					if ($iframe_tooltipcontent != '') {
						$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $iframe_tooltipclasses . '" ' . $iframe_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
							$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-iframe" style="width: 100%; height: 100%;">';
					} else {
							$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-iframe" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
					}
							$output .= '<a href="' . $content_iframe . '" class="nch-lightbox" ' . $iframe_dimensions . ' data-title="' . $content_iframe_title . '" data-type="iframe" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
								$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
								$output .= '<div class="nchgrid-caption"></div>';
								if (!empty($content_iframe_title)) {
									$output .= '<div class="nchgrid-caption-text">' . $content_iframe_title . '</div>';
								}
							$output .= '</a>';
						$output .= '</div>';
					if ($iframe_tooltipcontent != '') {
						$output .= '</div>';
					}
				} else {
					$output .= '<a href="' . $content_iframe . '" class="' . $modal_id . '-parent nch-holder nch-lightbox ' . $iframe_tooltipclasses . '" ' . $iframe_tooltipcontent . ' style="' . $parent_dimensions . '" ' . $iframe_dimensions . ' data-title="' . $content_iframe_title . '" data-type="iframe" rel="' . ($lightbox_group == "true" ? "nachogroup" : $lightbox_group) . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
						$output .= '<img class="" src="' . $modal_image . '" style="display: block; ' . $image_dimensions . '">';
					$output .= '</a>';
				}
			} else if ($content_iframe_trigger == "icon") {
				$icon_style = 'color: ' . $content_iframe_iconcolor . '; width:' . $content_iframe_iconsize . 'px; height:' . $content_iframe_iconsize . 'px; font-size:' . $content_iframe_iconsize . 'px; line-height:' . $content_iframe_iconsize . 'px;';
				$output .= '<div id="' . $modal_id . '" style="" class="' . $modal_id . '-parent nch-holder ts-vcsc-font-icon ts-font-icons ts-shortcode ts-icon-align-center ' . $el_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a class="ts-font-icons-link nch-lightbox" href="' . $content_iframe . '" target="_blank" ' . $iframe_dimensions . ' data-title="' . $content_iframe_title . '" data-type="iframe" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
						$output .= '<span class="' . $iframe_tooltipclasses . '" ' . $iframe_tooltipcontent . '>';
							$output .= '<i class="ts-font-icon ' . $content_iframe_icon . '" style="' . $icon_style . '"></i>';
						$output .= '</span>';
					$output .= '</a>';
				$output .= '</div>';
			} else if ($content_iframe_trigger == "winged") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . '" style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<div class="ts-lightbox-button-1 clearFixMe">';
						$output .= '<div class="top">' . $content_iframe_title . '</div>';
						$output .= '<div class="bottom">' . $content_iframe_subtitle . '</div>';
						$output .= '<a href="' . $content_iframe . '" class="nch-lightbox icon" ' . $iframe_dimensions . ' data-title="' . $content_iframe_title . '" data-type="iframe" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '><span class="iframe">' . $content_iframe_buttontext . '</span></a>';
					$output .= '</div>';
				$output .= '</div>';
			} else if ($content_iframe_trigger == "simple") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder' . $el_class . ' ' . $iframe_tooltipclasses . '" ' . $iframe_tooltipcontent . ' style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a href="' . $content_iframe . '" class="ts-lightbox-button-2 icon nch-lightbox" ' . $iframe_dimensions . ' data-title="' . $content_iframe_title . '" data-type="iframe" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '><span class="iframe">' . $content_iframe_buttontext . '</span></a>';
				$output .= '</div>';
			} else if ($content_iframe_trigger == "text") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a href="' . $content_iframe . '" class="nch-lightbox ' . $iframe_tooltipclasses . '" ' . $iframe_tooltipcontent . ' ' . $iframe_dimensions . ' data-title="' . $content_iframe_title . '" data-type="iframe" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . ' target="_blank">' . $content_iframe_text . '</a>';
				$output .= '</div>';
			} else if ($content_iframe_trigger == "custom") {
				if ($content_raw != "") {
					$content_raw =  rawurldecode(base64_decode(strip_tags($content_raw)));
					$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						$output .= '<a href="' . $content_iframe . '" class="nch-lightbox' . $iframe_tooltipclasses . '" ' . $iframe_tooltipcontent . ' ' . $iframe_dimensions . ' data-title="' . $content_iframe_title . '" data-type="iframe" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . 'style="" target="_blank">';
							$output .= $content_raw;
						$output .= '</a>';
					$output .= '</div>';
				}
			}
		} else {
			$iframe_dimensions 		= '';
			if ($iframe_width == "auto") {
				$iframe_dimensions 		.= '';
				$iframe_width_set		= '100%';
			} else if ($iframe_width == "widthpercent") {
				$iframe_dimensions 		.= 'width: ' . $iframe_width_percent . '%; ';
				$iframe_width_set		= '' . $iframe_width_percent . '%';
			} else if ($iframe_width == "widthpixel") {
				$iframe_dimensions 		.= 'width: ' . $iframe_width_pixel . 'px; ';
				$iframe_width_set		= '' . $iframe_width_pixel . '';
			}
			
			if ($iframe_height == "auto") {
				$iframe_dimensions 		.= '';
				$iframe_height_set		= 'auto';
			} else if ($iframe_height == "heightpixel") {
				$iframe_dimensions 		.= 'height: ' . $iframe_height_pixel . 'px; ';
				$iframe_height_set		= '' . $iframe_height_pixel . 'px';
			}
			
			if ($iframe_transparency == "true") {
				$iframe_transparent		= 'transparent';
			} else {
				$iframe_transparent		= '';
			}
			
			$output .= '<div id="' . $modal_id . '-parent" class="ts-video-container">';
				$output .= '<iframe id="' . $modal_id . '" class="' . $iframe_transparent . ' ' . $el_class . '" src="' . $content_iframe . '" style="' . $iframe_dimensions . '" width="' . $iframe_width_set . '" height="' . $iframe_height_set . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			$output .= '</div>';
		}

		echo $output;
	
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>