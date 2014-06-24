<?php
	add_shortcode('TS-VCSC-Font-Icons', 'TS_VCSC_Font_Icons_Function');
	function TS_VCSC_Font_Icons_Function ($atts) {
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
		
		extract(shortcode_atts(array(
			'icon_replace'				=> 'false',
			'icon' 						=> '',
			'icon_image'				=> '',
			'icon_color'				=> '#000000',
			'icon_background'			=> '',
			'icon_size_slide'           => 16,
			'icon_frame_type' 			=> '',
			'icon_frame_thick'			=> 1,
			'icon_frame_radius'			=> '',
			'icon_frame_color'			=> '#000000',
			'padding' 					=> 'false',
			'icon_padding' 				=> 0,
			'icon_align' 				=> '',
			'link' 						=> '',
			'link_target'				=> '_parent',
			'tooltip_css'				=> 'false',
			'tooltip_content'			=> '',
			'tooltip_position'			=> 'ts-simptip-position-top',
			'tooltip_style'				=> '',
			'animation_icon'			=> '',
			'animation_view' 			=> '',
			'el_id' 					=> '',
			'el_class' 					=> '',
		), $atts));
		
		$icon_color = !empty($icon_color) ? ('color:' . $icon_color .';') : '';
		$output = $icon_frame_class = $icon_frame_style = $animation_css = '';
		
		if (!empty($el_id)) {
			$icon_font_id				= $el_id;
		} else {
			$icon_font_id				= 'ts-vcsc-font-icon-' . mt_rand(999999, 9999999);
		}
		
		if (!empty($icon_image)) {
			$icon_image_path 			= wp_get_attachment_image_src($icon_image, 'large');
		}
		
		if ($padding == "true") {
			$icon_frame_padding			= 'padding: ' . $icon_padding . 'px; ';
		} else {
			$icon_frame_padding			= '';
		}
		
		$icon_style                     = '' . $icon_frame_padding . 'background-color:' . $icon_background . '; width:' . $icon_size_slide . 'px; height:' . $icon_size_slide . 'px; font-size:' . $icon_size_slide . 'px; line-height:' . $icon_size_slide . 'px;';
		$icon_image_style				= '' . $icon_frame_padding . 'background-color:' . $icon_background . '; width: ' . $icon_size_slide . 'px; height: ' . $icon_size_slide . 'px; ';
		
		if ($icon_frame_type != '') {
			$icon_frame_class 	        = 'frame-enabled';
			$icon_frame_style 	        = 'border: ' . $icon_frame_thick . 'px ' . $icon_frame_type . ' ' . $icon_frame_color . ';';
		}
		
		if ($animation_view != '') {
			$animation_css				= 'ts-vcsc-font-icon-viewport ' . TS_VCSC_GetCSSAnimation($animation_view);
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
		
		$output .= '<div id="' . $icon_font_id . '" style="" class="ts-vcsc-font-icon ts-font-icons ts-shortcode ts-icon-align-' . $icon_align . ' ' . $animation_css . ' ' . $el_class . '" data-viewport="' . $animation_css . ' wpb_start_animation">';
		
			if ($link) {
				$output .= '<a class="ts-font-icons-link" href="' . $link . '" target="' . $link_target . '">';
			}
			
				$output .= '<span class="' . $icon_tooltipclasses . '" ' . $icon_tooltipcontent . '>';
				
					if ($icon_replace == "false") {
						$output .= '<i class="ts-font-icon ' . $icon . ' ' . $icon_frame_class . ' ' . $animation_icon . ' ' . $icon_frame_radius . '" style="' . $icon_style . $icon_frame_style . $icon_color . '"></i>';
					} else {
						$output .= '<img class="ts-font-icon ' . $icon_frame_class . ' ' . $animation_icon . ' ' . $icon_frame_radius . ' ' . $icon_frame_radius . '" src="' . $icon_image_path[0] . '" style="' . $icon_frame_style . ' ' . $icon_image_style . ' display: inline-block !important; margin-bottom: ' . $icon_margin . 'px;">';
					}
					
				$output .= '</span>';
				
			if ($link) {
				$output .= '</a>';
			}
			
		$output .= '</div>';
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>
