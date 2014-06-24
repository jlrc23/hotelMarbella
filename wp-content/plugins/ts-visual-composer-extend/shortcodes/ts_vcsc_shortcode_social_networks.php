<?php
	add_shortcode('TS-VCSC-Social-Icons', 'TS_VCSC_Icons_Social_Function');
	function TS_VCSC_Icons_Social_Function ($atts) {
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

		extract( shortcode_atts( array(
			'icon_style' 				=> 'simple',
			'icon_background'			=> '#f5f5f5',
			'icon_frame_color'			=> '#f5f5f5',
			'icon_frame_thick'			=> 1,
			'icon_margin' 				=> 5,
			'icon_align'				=> 'left',
			'icon_hover'				=> '',
			'tooltip_show'				=> 'true',
			'tooltip_text'				=> 'Click here to view our profile on ',
			'tooltip_css'				=> 'false',
			'tooltip_style'				=> '',
			'tooltip_position'			=> 'ts-simptip-position-top',
			'email'						=> '',
			'phone'						=> '',
			'cell'						=> '',
			'portfolio'					=> '',
			'link'						=> '',
			'behance'					=> '',
			'digg'						=> '',
			'dribbble'					=> '',
			'dropbox'					=> '',
			'envato'					=> '',
			'evernote'					=> '',
			'facebook'					=> '',
			'flickr'					=> '',
			'github'					=> '',
			'gplus'						=> '',
			'instagram'					=> '',
			'lastfm'					=> '',
			'linkedin'					=> '',
			'paypal'					=> '',
			'picasa'					=> '',
			'pinterest'					=> '',
			'rss'						=> '',
			'skype'						=> '',
			'soundcloud'				=> '',
			'spotify'					=> '',
			'stumbleupon'				=> '',
			'twitter'					=> '',
			'tumblr'					=> '',
			'vimeo'						=> '',
			'xing'						=> '',
			'youtube'					=> '',
			'el_id'						=> '',
			'el_class' 					=> ''
		), $atts ) );
		
		if (!empty($el_id)) {
			$social_icon_id				= $el_id;
		} else {
			$social_icon_id				= 'ts-vcsc-social-icons-' . mt_rand(999999, 9999999);
		}
	
		if ((empty($icon_background)) || ($icon_style == 'simple')) {
			$icon_frame_style			= 'padding: 0px;';
		} else {
			$icon_frame_style			= 'padding: 0px; background: ' . $icon_background . ';';
		}
		
		if ($icon_frame_thick > 0) {
			$icon_top_adjust			= 'top: ' . (10 - $icon_frame_thick) . 'px;';
		} else {
			$icon_top_adjust			= '';
		}
		
		if ($icon_style == 'simple') {
			$icon_frame_border			= '';
		} else {
			$icon_frame_border			= ' border: ' . $icon_frame_thick . 'px solid ' . $icon_frame_color . ';';
		}
		
		if ($icon_align == "left") {
			$icon_margin_adjust 		= "margin-left: -" . $icon_margin . "px;";
			$icon_horizontal_adjust		= "";
		} else if ($icon_align == "right") {
			$icon_margin_adjust 		= "margin-right: -" . $icon_margin . "px;";
			$icon_horizontal_adjust		= "";
		} else {
			$icon_margin_adjust 		= "";
			$icon_horizontal_adjust		= "";
		}
	
		// Tooltip
		if (($tooltip_css == "true") && ($tooltip_show == "true")) {
			$icon_tooltipclasses		= "ts-simptip-multiline " . $tooltip_style . " " . $tooltip_position;
		} else {
			$icon_tooltipclasses		= "";
		}
	
		$output = '';
		$output .= '<div class="ts-social-icon-links ' . $el_class . '" style="' . $icon_margin_adjust . '">';
			$output .= '<div id="social-networks-' . $social_icon_id . '" class="ts-social-network-shortcode ts-shortcode social-align-' . $icon_align . '">';
				$output .= '<ul class="ts-social-icons ' . $icon_style . '">';
					$social_array = array();
					$social_count = 0;
					foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Social_Networks_Array as $Social_Network => $social) {
						if (($social['class'] == "ts-social-email") || ($social['class'] == "ts-social-phone") || ($social['class'] == "ts-social-cell") || ($social['class'] == "ts-social-skype")) {
							$social_lines = array(
								'network' 				=> $Social_Network,
								'class'					=> $social['class'],
								'link'					=> ${$social['string']},
								'order' 				=> get_option('ts_vcsc_social_order_' . $Social_Network, 	$social),
								'title'					=> '' . ${$social['string']} . ''
							);
						} else if (($social['class'] == "ts-social-portfolio") || ($social['class'] == "ts-social-link")) {
							$social_lines = array(
								'network' 				=> $Social_Network,
								'class'					=> $social['class'],
								'link'					=> ${$social['string']},
								'order' 				=> get_option('ts_vcsc_social_order_' . $Social_Network, 	$social),
								'title'					=> '' . ucfirst($Social_Network) . ''
							);
						} else {
							$social_lines = array(
								'network' 				=> $Social_Network,
								'class'					=> $social['class'],
								'link'					=> ${$social['string']},
								'order' 				=> get_option('ts_vcsc_social_order_' . $Social_Network, 	$social),
								'title'					=> '' . $tooltip_text . ucfirst($Social_Network) . ''
							);
						}
						$social_array[] = $social_lines;
						$social_count = $social_count + 1;
					}
					TS_VCSC_SortMultiArray($social_array, 'order');
					if ($icon_align == "right") {
						$social_array = array_reverse($social_array);
					}
					foreach ($social_array as $index => $array) {
						$Social_Network 				= $social_array[$index]['network'];
						$Social_Class					= $social_array[$index]['class'];
						$Social_Order					= $social_array[$index]['order'];
						$Social_Link					= $social_array[$index]['link'];
						if ($tooltip_show == 'true') {
							if ($tooltip_css == "false") {
								$Social_Title			= 'title="' . $social_array[$index]['title'] . '"';
							} else {
								$Social_Title			= 'data-tooltip="' . $social_array[$index]['title'] . '"';
							}
						} else {
							$Social_Title				= '';
						}
						if (!empty($Social_Link)) {
							if ($Social_Class == "ts-social-email") {
								$output .= '<li class="ts-social-icon ' . $icon_hover . ' ' . $icon_align . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="' . $Social_Class . ' ' . $icon_tooltipclasses . '" href="mailto:' . $Social_Link . '" ' . $Social_Title . '><i class="' . $Social_Class . '" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
							} else if ($Social_Class == "ts-social-phone") {
								$output .= '<li class="ts-social-icon ' . $icon_hover . ' ' . $icon_align . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="' . $Social_Class . ' ' . $icon_tooltipclasses . '" href="#" ' . $Social_Title . '" onclick="return false"><i class="' . $Social_Class . ' style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
							} else if ($Social_Class == "ts-social-cell") {
								$output .= '<li class="ts-social-icon ' . $icon_hover . ' ' . $icon_align . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="' . $Social_Class . ' ' . $icon_tooltipclasses . '" href="#" ' . $Social_Title . '" onclick="return false"><i class="' . $Social_Class . ' style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
							} else if ($Social_Class == "ts-social-skype") {
								$output .= '<li class="ts-social-icon ' . $icon_hover . ' ' . $icon_align . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="' . $Social_Class . ' ' . $icon_tooltipclasses . '" href="#" ' . $Social_Title . '" onclick="return false"><i class="' . $Social_Class . ' style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
							} else {
								$output .= '<li class="ts-social-icon ' . $icon_hover . ' ' . $icon_align . '" style="margin: ' . $icon_margin . 'px; ' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="' . $Social_Class . ' ' . $icon_tooltipclasses . '" href="' . TS_VCSC_makeValidURL($Social_Link) . '" ' . $Social_Title . '><i class="' . $Social_Class . '" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
							}
						}
					}
			
				$output .= '</ul>';
			$output .= '</div>';
		$output .= '</div>';
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>
