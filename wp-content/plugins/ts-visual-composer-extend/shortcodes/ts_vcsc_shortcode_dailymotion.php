<?php
	add_shortcode('TS-VCSC-Motion', 'TS_VCSC_Motion_Function');
	function TS_VCSC_Motion_Function ($atts, $content = null) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}
		
		wp_enqueue_script('ts-extend-hammer', 								TS_VCSC_GetResourceURL('js/jquery.hammer.min.js'), array('jquery'), false, $FOOTER);
		wp_enqueue_script('ts-extend-nacho', 								TS_VCSC_GetResourceURL('js/jquery.nchlightbox.min.js'), array('jquery'), false, $FOOTER);
		wp_enqueue_style('ts-extend-nacho',									TS_VCSC_GetResourceURL('css/jquery.nchlightbox.min.css'), null, false, 'all');
		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_style('ts-extend-simptip',                 			TS_VCSC_GetResourceURL('css/jquery.simptip.css'), null, false, 'all');
			wp_enqueue_style('ts-extend-animations',                 		TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-animations.min.css'), null, false, 'all');
			wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
		
		extract( shortcode_atts( array(
			'content_image_responsive'		=> 'true',
			'content_image_height'			=> 'height: 100%;',
			'content_image_width_r'			=> 100,
			'content_image_width_f'			=> 300,
			'content_image_size'			=> 'large',

			'lightbox_group_name'			=> 'nachogroup',
			'lightbox_size'					=> 'full',
			'lightbox_effect'				=> 'random',
			'lightbox_speed'				=> 5000,
			'lightbox_social'				=> 'true',
			'lightbox_play'					=> 'false',
			'lightbox_backlight_auto'		=> 'true',
			'lightbox_backlight_color'		=> '#ffffff',
			
			'content_lightbox'				=> 'true',
			'content_motion'				=> '',
			'content_motion_trigger'		=> 'preview',
			'content_motion_title'			=> '',
			'content_motion_subtitle'		=> '',
			'content_motion_image'			=> '',
			'content_motion_image_simple'	=> 'false',
			'content_motion_icon'			=> '',
			'content_motion_iconsize'		=> 30,
			'content_motion_iconcolor' 		=> '#cccccc',
			'content_motion_button'			=> '',
			'content_motion_buttonstyle'		=> 'style1',
			'content_motion_buttontext'		=> '',
			'content_motion_text'			=> '',
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
			$modal_id						= 'ts-vcsc-motion-' . mt_rand(999999, 9999999);
		}

		// Tooltip
		if ($content_tooltip_css == "true") {
			if (strlen($content_tooltip_content) != 0) {
				$motion_tooltipclasses		= " ts-simptip-multiline " . $content_tooltip_style . " " . $content_tooltip_position;
				$motion_tooltipcontent		= ' data-tooltip="' . $content_tooltip_content . '"';
			} else {
				$motion_tooltipclasses		= "";
				$motion_tooltipcontent		= "";
			}
		} else {
			$motion_tooltipclasses			= "";
			if (strlen($content_tooltip_content) != 0) {
				$motion_tooltipcontent		= ' title="' . $content_tooltip_content . '"';
			} else {
				$motion_tooltipcontent		= "";
			}
		}
		
		if ($lightbox_backlight_auto == "false") {
			$nacho_color			= 'data-backlight="' . $lightbox_backlight_color . '"';
		} else {
			$nacho_color			= '';
		}
		
		if ($content_image_responsive == "true") {
			$image_dimensions		= 'width: 100%; height: auto;';
			$parent_dimensions		= 'width: ' . $content_image_width_r . '%; ' . $content_image_height . '';
		} else {
			$image_dimensions		= 'width: 100%; height: auto;';
			$parent_dimensions		= 'width: ' . $content_image_width_f . 'px; ' . $content_image_height . '';
		}
		
		if (preg_match('~((http|https|ftp|ftps)://|www.)(.+?)~', $content_motion)) {
			$content_motion			= $content_motion;
		} else {			
			$content_motion			= $content_motion;
		}
		
		$output						= '';

		if ($content_lightbox == "true") {
			if ($content_motion_trigger == "preview") {
				$modal_image = TS_VCSC_VideoImage_Motion($content_motion);
				if ($motion_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $motion_tooltipclasses . '" ' . $motion_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-motion" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-motion" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_motion . '" class="nch-lightbox" data-title="' . $content_motion_title . '" data-play="' . $lightbox_play . '" data-type="dailymotion" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="nchgrid-caption"></div>';
							if (!empty($content_motion_title)) {
								$output .= '<div class="nchgrid-caption-text">' . $content_motion_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($motion_tooltipcontent != '') {
					$output .= '</div>';
				}
			} else if ($content_motion_trigger == "default") {
				$modal_image = TS_VCSC_GetResourceURL('images/Default_Motion.jpg');
				if ($motion_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $motion_tooltipclasses . '" ' . $motion_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-motion" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-motion" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_motion . '" class="nch-lightbox" data-title="' . $content_motion_title . '" data-play="' . $lightbox_play . '" data-type="dailymotion" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="nchgrid-caption"></div>';
							if (!empty($content_motion_title)) {
								$output .= '<div class="nchgrid-caption-text">' . $content_motion_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($motion_tooltipcontent != '') {
					$output .= '</div>';
				}
			} else if ($content_motion_trigger == "image") {
				$modal_image = wp_get_attachment_image_src($content_motion_image, 'large');
				$modal_image = $modal_image[0];
				if ($content_motion_image_simple == "false") {
					if ($motion_tooltipcontent != '') {
						$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $motion_tooltipclasses . '" ' . $motion_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
							$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-motion" style="width: 100%; height: 100%;">';
					} else {
							$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-motion" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
					}
							$output .= '<a href="' . $content_motion . '" class="nch-lightbox" data-title="' . $content_motion_title . '" data-play="' . $lightbox_play . '" data-type="dailymotion" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
								$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
								$output .= '<div class="nchgrid-caption"></div>';
								if (!empty($content_motion_title)) {
									$output .= '<div class="nchgrid-caption-text">' . $content_motion_title . '</div>';
								}
							$output .= '</a>';
						$output .= '</div>';
					if ($motion_tooltipcontent != '') {
						$output .= '</div>';
					}
				} else {
					$output .= '<a href="' . $content_motion . '" class="' . $modal_id . '-parent nch-holder nch-lightbox ' . $motion_tooltipclasses . '" ' . $motion_tooltipcontent . ' style="' . $parent_dimensions . '" data-title="' . $content_motion_title . '" data-play="' . $lightbox_play . '" data-type="dailymotion" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
						$output .= '<img class="" src="' . $modal_image . '" style="display: block; ' . $image_dimensions . '">';
					$output .= '</a>';
				}
			} else if ($content_motion_trigger == "icon") {
				$icon_style = 'color: ' . $content_motion_iconcolor . '; width:' . $content_motion_iconsize . 'px; height:' . $content_motion_iconsize . 'px; font-size:' . $content_motion_iconsize . 'px; line-height:' . $content_motion_iconsize . 'px;';
				$output .= '<div id="' . $modal_id . '" style="" class="' . $modal_id . '-parent nch-holder ts-vcsc-font-icon ts-font-icons ts-shortcode ts-icon-align-center ' . $el_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a class="ts-font-icons-link nch-lightbox" href="' . $content_motion . '" target="_blank" data-title="' . $content_motion_title . '" data-play="' . $lightbox_play . '" data-type="dailymotion" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
						$output .= '<span class="' . $motion_tooltipclasses . '" ' . $motion_tooltipcontent . '>';
							$output .= '<i class="ts-font-icon ' . $content_motion_icon . '" style="' . $icon_style . '"></i>';
						$output .= '</span>';
					$output .= '</a>';
				$output .= '</div>';
			} else if ($content_motion_trigger == "winged") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . '" style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<div class="ts-lightbox-button-1 clearFixMe">';
						$output .= '<div class="top">' . $content_motion_title . '</div>';
						$output .= '<div class="bottom">' . $content_motion_subtitle . '</div>';
						$output .= '<a href="' . $content_motion . '" class="nch-lightbox icon" data-title="' . $content_motion_title . '" data-play="' . $lightbox_play . '" data-type="dailymotion" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '><span class="motion">' . $content_motion_buttontext . '</span></a>';
					$output .= '</div>';
				$output .= '</div>';
			} else if ($content_motion_trigger == "simple") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder' . $el_class . ' ' . $motion_tooltipclasses . '" ' . $motion_tooltipcontent . ' style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a href="' . $content_motion . '" class="ts-lightbox-button-2 icon nch-lightbox" data-title="' . $content_motion_title . '" data-play="' . $lightbox_play . '" data-type="dailymotion" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '><span class="motion">' . $content_motion_buttontext . '</span></a>';
				$output .= '</div>';
			} else if ($content_motion_trigger == "text") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a href="' . $content_motion . '" class="nch-lightbox ' . $motion_tooltipclasses . '" ' . $motion_tooltipcontent . ' data-title="' . $content_motion_title . '" data-play="' . $lightbox_play . '" data-type="dailymotion" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . ' target="_blank">' . $content_motion_text . '</a>';
				$output .= '</div>';
			} else if ($content_motion_trigger == "custom") {
				if ($content_raw != "") {
					$content_raw =  rawurldecode(base64_decode(strip_tags($content_raw)));
					$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						$output .= '<a href="' . $content_motion . '" class="nch-lightbox' . $motion_tooltipclasses . '" ' . $motion_tooltipcontent . ' data-title="' . $content_motion_title . '" data-play="' . $lightbox_play . '" data-type="dailymotion" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . 'style="" target="_blank">';
							$output .= $content_raw;
						$output .= '</a>';
					$output .= '</div>';
				}
			}
		} else {
			$modal_image = TS_VCSC_VideoID_Motion($content_motion);
			$output .= '<div id="' . $modal_id . '" class="ts-video-container">';
				$output .= '<iframe src="http://www.dailymotion.com/embed/video/' . $modal_image . '?forcedQuality=hq" width="100%" height="auto" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			$output .= '</div>';
		}

		echo $output;
	
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>