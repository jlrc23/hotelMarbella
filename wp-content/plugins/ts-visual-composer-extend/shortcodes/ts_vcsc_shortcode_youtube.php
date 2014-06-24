<?php
	add_shortcode('TS-VCSC-Youtube', 'TS_VCSC_Youtube_Function');
	function TS_VCSC_Youtube_Function ($atts, $content = null) {
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
			'content_youtube'				=> '',
			'content_youtube_trigger'		=> 'preview',
			'content_youtube_title'			=> '',
			'content_youtube_subtitle'		=> '',
			'content_youtube_image'			=> '',
			'content_youtube_image_simple'	=> 'false',
			'content_youtube_icon'			=> '',
			'content_youtube_iconsize'		=> 30,
			'content_youtube_iconcolor' 	=> '#cccccc',
			'content_youtube_button'		=> '',
			'content_youtube_buttonstyle'	=> 'style1',
			'content_youtube_buttontext'	=> '',
			'content_youtube_text'			=> '',
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
			$modal_id						= 'ts-vcsc-youtube-' . mt_rand(999999, 9999999);
		}

		// Tooltip
		if ($content_tooltip_css == "true") {
			if (strlen($content_tooltip_content) != 0) {
				$youtube_tooltipclasses		= " ts-simptip-multiline " . $content_tooltip_style . " " . $content_tooltip_position;
				$youtube_tooltipcontent		= ' data-tooltip="' . $content_tooltip_content . '"';
			} else {
				$youtube_tooltipclasses		= "";
				$youtube_tooltipcontent		= "";
			}
		} else {
			$youtube_tooltipclasses			= "";
			if (strlen($content_tooltip_content) != 0) {
				$youtube_tooltipcontent		= ' title="' . $content_tooltip_content . '"';
			} else {
				$youtube_tooltipcontent		= "";
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
		
		$output						= '';
		
		if (preg_match('~((http|https|ftp|ftps)://|www.)(.+?)~', $content_youtube)) {
			$content_youtube		= $content_youtube;
		} else {
			$content_youtube		= 'https://www.youtube.com/watch?v=' . $content_youtube;
		}

		if ($content_lightbox == "true") {
			if ($content_youtube_trigger == "preview") {
				$modal_image = TS_VCSC_VideoImage_Youtube($content_youtube);
				if ($youtube_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_youtube . '" class="nch-lightbox" data-title="' . $content_youtube_title . '" data-play="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="nchgrid-caption"></div>';
							if (!empty($content_youtube_title)) {
								$output .= '<div class="nchgrid-caption-text">' . $content_youtube_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($youtube_tooltipcontent != '') {
					$output .= '</div>';
				}
			} else if ($content_youtube_trigger == "default") {
				$modal_image = TS_VCSC_GetResourceURL('images/Default_Youtube.jpg');
				if ($youtube_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="' . $content_youtube . '" class="nch-lightbox" data-title="' . $content_youtube_title . '" data-play="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
							$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="nchgrid-caption"></div>';
							if (!empty($content_youtube_title)) {
								$output .= '<div class="nchgrid-caption-text">' . $content_youtube_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($youtube_tooltipcontent != '') {
					$output .= '</div>';
				}
			} else if ($content_youtube_trigger == "image") {
				$modal_image = wp_get_attachment_image_src($content_youtube_image, 'large');
				$modal_image = $modal_image[0];
				if ($content_youtube_image_simple == "false") {
					if ($youtube_tooltipcontent != '') {
						$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
							$output .= '<div id="' . $modal_id . '" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube" style="width: 100%; height: 100%;">';
					} else {
							$output .= '<div id="' . $modal_id . '" class="' . $modal_id . '-parent nch-holder ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-youtube" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
					}
							$output .= '<a href="' . $content_youtube . '" class="nch-lightbox" data-title="' . $content_youtube_title . '" data-play="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
								$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
								$output .= '<div class="nchgrid-caption"></div>';
								if (!empty($content_youtube_title)) {
									$output .= '<div class="nchgrid-caption-text">' . $content_youtube_title . '</div>';
								}
							$output .= '</a>';
						$output .= '</div>';
					if ($youtube_tooltipcontent != '') {
						$output .= '</div>';
					}
				} else {
					$output .= '<a href="' . $content_youtube . '" class="' . $modal_id . '-parent nch-holder nch-lightbox ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="' . $parent_dimensions . '" data-play="' . $lightbox_play . '" data-title="' . $content_youtube_title . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
						$output .= '<img class="" src="' . $modal_image . '" style="display: block; ' . $image_dimensions . '">';
					$output .= '</a>';
				}
			} else if ($content_youtube_trigger == "icon") {
				$icon_style = 'color: ' . $content_youtube_iconcolor . '; width:' . $content_youtube_iconsize . 'px; height:' . $content_youtube_iconsize . 'px; font-size:' . $content_youtube_iconsize . 'px; line-height:' . $content_youtube_iconsize . 'px;';
				$output .= '<div id="' . $modal_id . '" style="" class="' . $modal_id . '-parent nch-holder ts-vcsc-font-icon ts-font-icons ts-shortcode ts-icon-align-center ' . $el_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a class="ts-font-icons-link nch-lightbox" href="' . $content_youtube . '" target="_blank" data-title="' . $content_youtube_title . '" data-play="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
						$output .= '<span class="' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . '>';
							$output .= '<i class="ts-font-icon ' . $content_youtube_icon . '" style="' . $icon_style . '"></i>';
						$output .= '</span>';
					$output .= '</a>';
				$output .= '</div>';
			} else if ($content_youtube_trigger == "winged") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $el_class . '" style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<div class="ts-lightbox-button-1 clearFixMe">';
						$output .= '<div class="top">' . $content_youtube_title . '</div>';
						$output .= '<div class="bottom">' . $content_youtube_subtitle . '</div>';
						$output .= '<a href="' . $content_youtube . '" class="nch-lightbox icon" data-title="' . $content_youtube_title . '" data-play="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '><span class="youtube">' . $content_youtube_buttontext . '</span></a>';
					$output .= '</div>';
				$output .= '</div>';
			} else if ($content_youtube_trigger == "simple") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder' . $el_class . ' ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a href="' . $content_youtube . '" class="ts-lightbox-button-2 icon nch-lightbox" data-title="' . $content_youtube_title . '" data-play="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '><span class="youtube">' . $content_youtube_buttontext . '</span></a>';
				$output .= '</div>';
			} else if ($content_youtube_trigger == "text") {
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a href="' . $content_youtube . '" class="nch-lightbox ' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' data-title="' . $content_youtube_title . '" data-play="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . ' target="_blank">' . $content_youtube_text . '</a>';
				$output .= '</div>';
			} else if ($content_youtube_trigger == "custom") {
				if ($content_raw != "") {
					$content_raw =  rawurldecode(base64_decode(strip_tags($content_raw)));
					$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
						$output .= '<a href="' . $content_youtube . '" class="nch-lightbox' . $youtube_tooltipclasses . '" ' . $youtube_tooltipcontent . ' data-title="' . $content_youtube_title . '" data-play="' . $lightbox_play . '" data-type="youtube" rel="' . $lightbox_group_name . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . 'style="" target="_blank">';
							$output .= $content_raw;
						$output .= '</a>';
					$output .= '</div>';
				}
			}
		} else {
			$modal_image = TS_VCSC_VideoID_Youtube($content_youtube);
			$output .= '<div id="' . $modal_id . '" class="ts-video-container">';
				$output .= '<iframe width="100%" height="auto" src="//www.youtube.com/embed/' . $modal_image . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			$output .= '</div>';
		}

		echo $output;
	
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>