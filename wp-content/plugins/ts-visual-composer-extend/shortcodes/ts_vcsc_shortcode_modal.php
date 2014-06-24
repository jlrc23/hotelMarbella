<?php
	add_shortcode('TS-VCSC-Modal-Popup', 'TS_VCSC_Modal_Function');
	function TS_VCSC_Modal_Function ($atts, $content = null) {
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
			'lightbox_backlight_color'		=> '#0084E2',
			
			'height'						=> 500,
			'width'							=> 300,
			'content_style'					=> '',
			
			'content_open'					=> 'false',
			'content_open_hide'				=> 'true',
			'content_open_delay'			=> 0,
			
			'content_trigger'				=> '',
			'content_title'					=> '',
			'content_subtitle'				=> '',
			'content_image'					=> '',
			'content_image_simple'			=> 'false',
			'content_icon'					=> '',
			'content_iconsize'				=> 30,
			'content_iconcolor' 			=> '#cccccc',
			'content_button'				=> '',
			'content_buttonstyle'			=> 'style1',
			'content_buttontext'			=> '',
			'content_text'					=> '',
			'content_raw'					=> '',
			
			'content_tooltip_css'			=> 'false',
			'content_tooltip_content'		=> '',
			'content_tooltip_position'		=> 'ts-simptip-position-top',
			'content_tooltip_style'			=> '',
			
			'content_show_title'			=> 'true',
			'title'							=> '',
			'margin_top'					=> 0,
			'margin_bottom'					=> 0,
			'el_id'							=> '',
			'el_class'						=> '',
		), $atts ));
	
		if (!empty($el_id)) {
			$modal_id						= $el_id;
		} else {
			$modal_id						= 'ts-vcsc-modal-' . mt_rand(999999, 9999999);
		}
	
		// Tooltip
		if ($content_tooltip_css == "true") {
			if (strlen($content_tooltip_content) != 0) {
				$popup_tooltipclasses		= " ts-simptip-multiline " . $content_tooltip_style . " " . $content_tooltip_position;
				$popup_tooltipcontent		= ' data-tooltip="' . $content_tooltip_content . '"';
			} else {
				$popup_tooltipclasses		= "";
				$popup_tooltipcontent		= "";
			}
		} else {
			$popup_tooltipclasses			= "";
			if (strlen($content_tooltip_content) != 0) {
				$popup_tooltipcontent		= ' title="' . $content_tooltip_content . '"';
			} else {
				$popup_tooltipcontent		= "";
			}
		}
		
		if ($content_image_responsive == "true") {
			$image_dimensions				= 'width: 100%; height: auto;';
			$parent_dimensions				= 'width: ' . $content_image_width_r . '%; ' . $content_image_height . '';
		} else {
			$image_dimensions				= 'width: 100%; height: auto;';
			$parent_dimensions				= 'width: ' . $content_image_width_f . 'px; ' . $content_image_height . '';
		}
		
		// Auto-Open Class
		if ($content_open == "true") {
			$modal_openclass				= "nch-lightbox-open";
			if ($content_open_hide == "true") {
				$modal_hideclass			= "nch-lightbox-hide";
			} else {
				$modal_hideclass			= "";
			}
		} else {
			$modal_openclass				= "nch-lightbox-modal";
			$modal_hideclass				= "";
		}

		$output 							= '';

		if ($content_trigger == "default") {
			$modal_image = TS_VCSC_GetResourceURL('images/Default_Modal.jpg');
			if ($popup_tooltipcontent != '') {
				$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $modal_hideclass . ' ' . $popup_tooltipclasses . '" ' . $popup_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
					$output .= '<div id="' . $modal_id . '-trigger" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-modal" style="width: 100%; height: 100%;">';
			} else {
					$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $modal_hideclass . ' ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-modal" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
			}
					$output .= '<a href="#' . $modal_id . '" class="nch-lightbox-trigger ' . $modal_openclass . '" data-title="" data-open="' . $content_open . '" data-delay="' . $content_open_delay . '" data-type="html" rel="" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-color="' . $lightbox_backlight_color . '">';
						$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
						$output .= '<div class="nchgrid-caption"></div>';
						if (!empty($content_title)) {
							$output .= '<div class="nchgrid-caption-text">' . $content_title . '</div>';
						}
					$output .= '</a>';
				$output .= '</div>';
			if ($popup_tooltipcontent != '') {
				$output .= '</div>';
			}
		} else if ($content_trigger == "image") {
			$modal_image = wp_get_attachment_image_src($content_image, 'large');
			$modal_image = $modal_image[0];
			if ($content_image_simple == "false") {
				if ($popup_tooltipcontent != '') {
					$output .= '<div class="' . $modal_id . '-parent nch-holder ' . $modal_hideclass . ' ' . $popup_tooltipclasses . '" ' . $popup_tooltipcontent . ' style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
						$output .= '<div id="' . $modal_id . '-trigger" class="' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-modal" style="width: 100%; height: 100%;">';
				} else {
						$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $modal_hideclass . ' ' . $el_class . ' nchgrid-item nchgrid-tile nch-lightbox-modal" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; ' . $parent_dimensions . '">';
				}
						$output .= '<a href="#' . $modal_id . '" class="nch-lightbox-trigger ' . $modal_openclass . '" data-title="" data-open="' . $content_open . '" data-delay="' . $content_open_delay . '" data-type="html" rel="" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-color="' . $lightbox_backlight_color . '">';
							$output .= '<img src="' . $modal_image . '" title="" style="display: block; ' . $image_dimensions . '">';
							$output .= '<div class="nchgrid-caption"></div>';
							if (!empty($content_title)) {
								$output .= '<div class="nchgrid-caption-text">' . $content_title . '</div>';
							}
						$output .= '</a>';
					$output .= '</div>';
				if ($popup_tooltipcontent != '') {
					$output .= '</div>';
				}
			} else {
				$output .= '<a href="#' . $modal_id . '" class="' . $modal_id . '-parent nch-holder nch-lightbox ' . $popup_tooltipclasses . '" ' . $popup_tooltipcontent . ' style="' . $parent_dimensions . '" data-title="' . $content_title . '" data-type="html" rel="' . ($lightbox_group == "true" ? "nachogroup" : $lightbox_group) . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-color="' . $lightbox_backlight_color . '">';
					$output .= '<img class="" src="' . $modal_image . '" style="display: block; ' . $image_dimensions . '">';
				$output .= '</a>';
			}
		} else if ($content_trigger == "icon") {
			$icon_style = 'color: ' . $content_iconcolor . '; width:' . $content_iconsize . 'px; height:' . $content_iconsize . 'px; font-size:' . $content_iconsize . 'px; line-height:' . $content_iconsize . 'px;';
			$output .= '<div id="' . $modal_id . '-trigger" style="" class="' . $modal_id . '-parent nch-holder ts-vcsc-font-icon ts-font-icons ts-shortcode ts-icon-align-center ' . $el_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
				$output .= '<a href="#' . $modal_id . '" class="' . $modal_openclass . '" data-title="" data-open="' . $content_open . '" data-delay="' . $content_open_delay . '" data-type="html" rel="" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-color="' . $lightbox_backlight_color . '">';
					$output .= '<span class="' . $popup_tooltipclasses . '" ' . $popup_tooltipcontent . '>';
						$output .= '<i class="ts-font-icon ' . $content_icon . '" style="' . $icon_style . '"></i>';
					$output .= '</span>';
				$output .= '</a>';
			$output .= '</div>';
		} else if ($content_trigger == "winged") {
			$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $modal_hideclass . ' ' . $el_class . ' ' . $popup_tooltipclasses . '" ' . $popup_tooltipcontent . ' style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
				$output .= '<div class="ts-lightbox-button-1 clearFixMe">';
					$output .= '<div class="top">' . $content_title . '</div>';
					$output .= '<div class="bottom">' . $content_subtitle . '</div>';
					$output .= '<a href="#' . $modal_id . '" class="icon ' . $modal_openclass . '" data-open="' . $content_open . '" data-delay="' . $content_open_delay . '" data-type="html" rel="" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-color="' . $lightbox_backlight_color . '"><span class="popup">' . $content_buttontext . '</span></a>';
				$output .= '</div>';
			$output .= '</div>';
		} else if ($content_trigger == "simple") {
			$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $modal_hideclass . ' ' . $el_class . ' ' . $popup_tooltipclasses . '" ' . $popup_tooltipcontent . ' style="display: block; width: 100%; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
				$output .= '<a href="#' . $modal_id . '" class="ts-lightbox-button-2 icon ' . $modal_openclass . '" data-open="' . $content_open . '" data-delay="' . $content_open_delay . '" data-type="html" rel="" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-color="' . $lightbox_backlight_color . '"><span class="popup">' . $content_buttontext . '</span></a>';
			$output .= '</div>';
		} else if ($content_trigger == "text") {
			$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $modal_hideclass . '" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
				$output .= '<a href="#' . $modal_id . '" class="' . $popup_tooltipclasses . ' ' . $modal_openclass . '" ' . $popup_tooltipcontent . ' data-open="' . $content_open . '" data-delay="' . $content_open_delay . '" data-type="html" rel="" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-color="' . $lightbox_backlight_color . '">' . $content_text . '</a>';
			$output .= '</div>';
		} else if ($content_trigger == "custom") {
			if ($content_raw != "") {
				$content_raw =  rawurldecode(base64_decode(strip_tags($content_raw)));
				$output .= '<div id="' . $modal_id . '-trigger" class="' . $modal_id . '-parent nch-holder ' . $modal_hideclass . '" style="text-align: center; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
					$output .= '<a href="#' . $modal_id . '" class="' . $popup_tooltipclasses . ' ' . $modal_openclass . '" ' . $popup_tooltipcontent . ' data-open="' . $content_open . '" data-delay="' . $content_open_delay . '" data-type="html" rel="" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-color="' . $lightbox_backlight_color . '">';
						$output .= $content_raw;
					$output .= '</a>';
				$output .= '</div>';
			}
		}
		
		// Create hidden DIV with Modal Content
		$output .= '<div id="' . $modal_id . '" class="ts-modal-content nch-hide-if-javascript ' . $el_class . '">';
			$output .= '<div class="ts-modal-white-header ' . $content_style . '"></div>';
			$output .= '<div class="ts-modal-white-frame">';
				$output .= '<div class="ts-modal-white-inner">';
					if ($content_show_title == "true") {
						$output .= '<h2 style="border-bottom: 1px solid #eeeeee; padding-bottom: 10px;">' . $title . '</h2>';
					}
					if (function_exists('wpb_js_remove_wpautop')){
						$output .= wpb_js_remove_wpautop(do_shortcode($content), true);
					} else {
						$output .= do_shortcode($content);
					}
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
		
		echo $output;
	
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>