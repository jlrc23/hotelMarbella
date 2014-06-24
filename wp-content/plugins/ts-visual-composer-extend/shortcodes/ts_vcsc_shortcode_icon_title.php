<?php
	add_shortcode('TS-VCSC-Icon-Title', 'TS_VCSC_Icon_Title_Function');
	function TS_VCSC_Icon_Title_Function ($atts) {
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
			'title'						=> '',
			'style' 					=> 'true',
			'color' 					=> '#3d3d3d',
			"size" 						=> '30',
			'font_weight' 				=> 'normal',
			'align' 					=> 'left',
			'font_theme'				=> 'true',
			'font_family' 				=> '',
			'font_type' 				=> '',
			'title_wrap'				=> 'div',
			'title_background_type'		=> 'color',
			'title_background_color'	=> '#ffffff',
			'title_background_pattern'	=> '',
			'title_border'				=> 'true',
			'title_border_type'			=> '',
			'title_border_bottom'		=> 'false',
			'title_border_color'		=> '#cccccc',
			'title_border_thick'		=> 1,
			'title_border_radius'		=> '',
			'icon'                      => '',
			'icon_location'             => 'left',
			'icon_margin'				=> 10,
			'icon_size_slide'           => 30,
			'icon_color'                => '#000000',
			'icon_background'		    => '',
			'icon_frame_type' 			=> '',
			'icon_frame_thick'			=> 1,
			'icon_frame_radius'			=> '',
			'icon_frame_color'			=> '#cccccc',
			'icon_replace'				=> 'false',
			'icon_image'				=> '',
			'icon_padding'				=> 0,
			'animations'                => 'false',
			'animation_icon'		    => '',
			'animation_title'           => '',
			'animation_shadow'          => '',
			'animation_view'            => '',
			'margin_bottom'				=> '20',
			'margin_top' 				=> '0',
			'el_id' 					=> '',
			'el_class'                  => '',
		), $atts ) );
		
		$divider_css = $title_background_style = $title_frame_style = $icon_style = $icon_frame_class = $icon_frame_style = $animation_css = $span_padding = '';
		
		if (!empty($el_id)) {
			$icon_title_id				= $el_id;
		} else {
			$icon_title_id				= 'ts-vcsc-icon-title-' . mt_rand(999999, 9999999);
		}
		
		if (!empty($icon_image)) {
			$icon_image_path 			= wp_get_attachment_image_src($icon_image, 'large');
		}
		
		$output 						= '';
		$style 							= ($style == 'true') ? 'pattern' : 'simple';
		
		if ($font_theme == "false") {
			$output .= TS_VCSC_GetFontFamily($icon_title_id, $font_family, $font_type);
		}
		
		if ($animation_view != '') {
			$animation_css              = TS_VCSC_GetCSSAnimation($animation_view);
		}
		
		$icon_style                     = 'padding: ' . $icon_padding . 'px; background-color:' . $icon_background . '; width: ' . $icon_size_slide . 'px; height: ' . $icon_size_slide . 'px; font-size: ' . $icon_size_slide . 'px; line-height: ' . $icon_size_slide . 'px;';
		$icon_image_style				= 'padding: ' . $icon_padding . 'px; background-color:' . $icon_background . '; width: ' . $icon_size_slide . 'px; height: ' . $icon_size_slide . 'px; ';
		
		if ($icon_frame_type != '') {
			$icon_frame_class 	        = 'frame-enabled';
			$icon_frame_style 	        = 'border: ' . $icon_frame_thick . 'px ' . $icon_frame_type . ' ' . $icon_frame_color . ';';
		}
		
		if ($title_background_type == "pattern") {
			$title_background_style		= 'background: url(' . $title_background_pattern . ') repeat;';
		} else if ($title_background_type == "color") {
			$title_background_style		= 'background-color: ' . $title_background_color .';';
		}
		
		if ($title_border_type != '') {
			if ($title_border_bottom == "true") {
				$title_frame_style		= 'padding: 10px; ' . $title_background_style . ' border-bottom: ' . $title_border_thick . 'px ' . $title_border_type . ' ' . $title_border_color . ';';
			} else {
				$title_frame_style		= 'padding: 10px; ' . $title_background_style . ' border: ' . $title_border_thick . 'px ' . $title_border_type . ' ' . $title_border_color . ';';
			}
		}
		
		if ($style == 'pattern') {
			/*if ($align == 'left') {
				$span_padding 			= 'padding-right: 8px; ';
			} else if (($align == 'center') || ($align == 'justify')) {*/
				$span_padding 			= 'padding: 0px; ';
			/*} else if ($align == 'right') {
				$span_padding 			= 'padding-left: 8px; ';
			}*/
		} else {
			$span_padding 				= 'padding: 0px; ';
		}
		
		if ($animation_shadow != '') {
			if (!empty($animation_title)) {
				$shadow_class = 'ts-css-shadow ' . $animation_shadow . '';
			} else {
				$shadow_class = 'ts-css-shadow ts-css-shadow-single ' . $animation_shadow . '';
			}
		} else {
			$shadow_class = '';
		}
		
		/*if ($icon_replace == 'false') {
			$table_float = "";
		} else {*/
			if ($align == "left") {
				$table_float = "float: left;";
			} else if ($align == "right") {
				$table_float = "float: right;";
			} else {
				$table_float = "";
			}
		//}
		
		if ((($icon_location == "left") || ($icon_location == "right"))) {
			if ($icon_size_slide > $size) {
				$title_height_holder	= "height: " . ($icon_size_slide + 2*$icon_padding + ($title_border_type != '' ? 20 : 0)) . "px;";
			} else {
				$title_height_holder	= "height: " . ($size + 2*$icon_padding + ($title_border_type != '' ? 20 : 0)) . "px;";
			}
			if ($title_border_type != '') {
				$title_height_sub		= $title_height_holder;
			} else {
				$title_height_sub		= "height: 100%;";
			}
		} else {
			$title_height_holder		= "";
			$title_height_sub			= "";
		}
		
		$output .= '<div id="' . $icon_title_id . '" class="' . $animation_css . ' ' . $el_class . '" style="margin-top:' . $margin_top . 'px; margin-bottom:' . $margin_bottom . 'px; ">';
		
			$output .= (!empty($animation_title) ? '<div class="ts-hover ' . $animation_title . '" style="' . $title_height_holder . '">' : '<div class="' . $shadow_class . '" style="' . $title_height_holder . '">');
			
				$output .= '<div style="' . $title_height_sub . ' ' . $title_frame_style . ' font-size: ' . $size . 'px; text-align: ' . $align . '; color: ' . $color . '; font-weight:' . $font_weight . '; ' . $divider_css . '" class="ts-vcsc-icon-title ts-shortcode ' . $title_border_radius . ' ts-icon-title ' . ($animation_title != "" ? $shadow_class : "") . ' ' . $style . '-style">';
				
					if ($icon_replace == 'false') {
						if ((!empty($icon)) && ($icon_location == "top")) {
							$output .= '<span style="width: 100%; display: block;">';
								$output .= '<i style="color:' . $icon_color . ';' . $icon_style . ' ' . $icon_frame_style . ' text-align: center; display: inline-block !important; margin-bottom: ' . $icon_margin . 'px;" class="ts-font-icon '.$icon.' ' . $icon_frame_class . ' ' . $animation_icon . ' ' . $icon_frame_radius . '"></i>';
							$output .= '</span>';
						}
					} else {
						if ((!empty($icon_image)) && ($icon_location == "top")) {
							$output .= '<span style="width: 100%; display: block;">';
								$output .= '<img class="ts-font-icon ' . $icon_frame_class . ' ' . $animation_icon . ' ' . $icon_frame_radius . '" src="' . $icon_image_path[0] . '" style="' . $icon_frame_style . ' ' . $icon_image_style . ' display: inline-block !important; margin-bottom: ' . $icon_margin . 'px;">';
							$output .= '</span>';
						}
					}
				
				$output .= '<span style="' . $span_padding . '">';
				
					if ($icon_location == "left") {
						if ($icon_replace == 'false') {
							$output .= '<table border="0" style="border: none !important; border-color: transparent !important; ' . $table_float . '">';
								$output .= '<tr>';
									$output .= '<td>';
										if ((!empty($icon)) && ($icon_location == "left")) {
											$output .= '<span style="width: auto !important;">';
												$output .= '<i style="color:' . $icon_color . ';' . $icon_style . ' ' . $icon_frame_style . ' display: inline-block !important; margin-right: ' . $icon_margin . 'px;" class="ts-font-icon '.$icon.' ' . $icon_frame_class . ' ' . $animation_icon . ' ' . $icon_frame_radius . '"></i>';
											$output .= '</span>';
										}
									$output .= '</td>';
									$output .= '<td>';
										$output .= '<span class="ts-icon-title-text" style="width: auto !important;">' . $title . '</span>';
									$output .= '</td>';
								$output .= '</tr>';
							$output .= '</table>';
						} else {
							$output .= '<table border="0" style="border: none !important; border-color: transparent !important; ' . $table_float . '">';
								$output .= '<tr>';
									$output .= '<td>';
										if ((!empty($icon_image)) && ($icon_location == "left")) {
											$output .= '<span style="width: auto !important;">';
												$output .= '<img class="ts-font-icon ' . $icon_frame_class . ' ' . $animation_icon . ' ' . $icon_frame_radius . '" src="' . $icon_image_path[0] . '" style="' . $icon_frame_style . ' ' . $icon_image_style . ' display: inline-block !important; margin-right: ' . $icon_margin . 'px;">';
											$output .= '</span>';
										}
									$output .= '</td>';
									$output .= '<td>';
										$output .= '<span class="ts-icon-title-text" style="width: auto !important;">' . $title . '</span>';
									$output .= '</td>';
								$output .= '</tr>';
							$output .= '</table>';
						}
					} else if ($icon_location == "right") {
						if ($icon_replace == 'false') {
							$output .= '<table border="0" style="border: none !important; border-color: transparent !important; ' . $table_float . '">';
								$output .= '<tr>';
									$output .= '<td>';
										$output .= '<span class="ts-icon-title-text" style="width: auto !important;">' . $title . '</span>';
									$output .= '</td>';
									$output .= '<td>';
										if ((!empty($icon)) && ($icon_location == "right")) {
											$output .= '<span style="width: auto !important;">';
												$output .= '<i style="color:' . $icon_color . ';' . $icon_style . ' ' . $icon_frame_style . ' display: inline-block !important; margin-left: ' . $icon_margin . 'px;" class="ts-font-icon '.$icon.' ' . $icon_frame_class . ' ' . $animation_icon . ' ' . $icon_frame_radius . '"></i>';
											$output .= '</span>';
										}
									$output .= '</td>';
								$output .= '</tr>';
							$output .= '</table>';
						} else {
							$output .= '<table border="0" style="border: none !important; border-color: transparent !important; ' . $table_float . '">';
								$output .= '<tr>';
									$output .= '<td>';
										$output .= '<span class="ts-icon-title-text" style="width: auto !important;">' . $title . '</span>';
									$output .= '</td>';
									$output .= '<td>';
										if ((!empty($icon_image)) && ($icon_location == "right")) {
											$output .= '<span style="width: auto !important;">';
												$output .= '<img class="ts-font-icon ' . $icon_frame_class . ' ' . $animation_icon . ' ' . $icon_frame_radius . '" src="' . $icon_image_path[0] . '" style="' . $icon_frame_style . ' ' . $icon_image_style . ' display: inline-block !important; margin-left: ' . $icon_margin . 'px;">';
											$output .= '</span>';
										}
									$output .= '</td>';
								$output .= '</tr>';
							$output .= '</table>';
						}
					} else {
						$output .= '<span class="ts-icon-title-text" style="width: auto !important;">' . $title . '</span>';
					}
				$output .= '</span>';
				
					if ($icon_replace == 'false') {
						if ((!empty($icon)) && ($icon_location == "bottom")) {
							$output .= '<span style="width: 100%; display: block;">';
								$output .= '<i style="color:' . $icon_color . ';' . $icon_style . ' ' . $icon_frame_style . ' display: inline-block !important; margin-top: ' . $icon_margin . 'px;" class="ts-font-icon '.$icon.' ' . $icon_frame_class . ' ' . $animation_icon . ' ' . $icon_frame_radius . '"></i>';
							$output .= '</span>';
						}
					} else {
						if ((!empty($icon_image)) && ($icon_location == "bottom")) {
							$output .= '<span style="width: 100%; display: block;">';
								$output .= '<img class="ts-font-icon ' . $icon_frame_class . ' ' . $animation_icon . ' ' . $icon_frame_radius . '" src="' . $icon_image_path[0] . '" style="' . $icon_frame_style . ' ' . $icon_image_style . ' display: inline-block !important; margin-top: ' . $icon_margin . 'px;">';
							$output .= '</span>';
						}
					}
				
				$output .= '</div>';
			
			$output .= (!empty($animation_title) ? '</div></div>' : '</div></div>');
		
		$output .= '<div class="clearboth"></div>';
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>