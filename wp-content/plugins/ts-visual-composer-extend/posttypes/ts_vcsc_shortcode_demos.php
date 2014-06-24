<?php
	add_shortcode('TS_VCSC_Icon_Preview', 'TS_VCSC_Icon_Font_Preview');
	function TS_VCSC_Icon_Font_Preview ($atts) {
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
		
		extract(shortcode_atts(array(
			'font' 						=> '',
			'size'           			=> 16,
			
			'color'						=> '#000000',
			'background'				=> '',
	
			'animation'					=> '',
		), $atts));
		
		// Load CSS for Selected Font
		foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
			if (($iconfont != "Custom") && ($iconfont == $font)) {
				wp_enqueue_style('ts-font-' . strtolower($iconfont),		TS_VCSC_GetResourceURL('css/ts-font-' . strtolower($iconfont) . '.css'), null, false, 'all');
			}
		}
		
		// Rebuild Font Data Array in Case Font is Disabled
		$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_tinymceFontsAll = true;
		$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconFontArrays();
		$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_tinymceFontsAll = false;
		
		// Define Size for Element
		if ($size != 16) {
			$icon_size					= "height:" . $size . "px; width:" . $size . "px; line-height:" . $size . "px; font-size:" . $size . "px; ";
		} else {
			$icon_size					= "";
		}
		
		// Define Color for Element
		if ($color != "#000000") {
			$icon_color					= "color: " . $color . "; ";
		} else {
			$icon_color					= "";
		}
		
		// Define Background for Element
		if (strlen($background) > 0) {
			$icon_background 			= " background-color: " . $background . "; ";
		} else {
			$icon_background			= "";
		}
	
		// Define Class for Animation
		if (strlen($animation) > 0) {
			$icon_animation				= $animation;
		} else {
			$icon_animation				= "";
		}
		
		foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
			if (($iconfont != "Custom") && ($iconfont == $font)){
				$output = '';
				$output .= '<div id="ts-vcsc-extend-preview-' . $iconfont . '" class="ts-vcsc-extend-preview" data-font="' . $Icon_Font . '">';
					$output .= '<div id="ts-vcsc-extend-preview-list-' . $Icon_Font . '" class="ts-vcsc-extend-preview-list" data-font="' . $Icon_Font . '">';
						$icon_counter = 0;
						foreach ($VISUAL_COMPOSER_EXTENSIONS->{'TS_VCSC_List_Icons_' . $iconfont . ''} as $key => $option ) {
							$output .= '<div class="ts-vcsc-icon-preview ts-simptip-multiline ts-simptip-position-top" data-tooltip="ts-' . $key . '" data-name="ts-' . $key . '" data-code="' . $option . '" data-font="' . strtolower($font) . '" data-count="' . $icon_counter . '" rel="' . $key . '"><span class="ts-vcsc-icon-preview-icon"><i class="ts-font-icon ts-font-icon ts-' . $key . ' ' . $icon_animation . '" style="' . $icon_size . $icon_color . $icon_background . ' "></i></span></div>';
							$icon_counter = $icon_counter + 1;
						}
					$output .= '</div>';
				$output .= '</div>';
			}
		}

		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
	
	
	add_shortcode('TS_VCSC_Icon_Animations', 'TS_VCSC_Icon_Font_Animations');
	function TS_VCSC_Icon_Font_Animations ($atts) {
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
			'font' 						=> '',
			'size'           			=> 16,
			
			'color'						=> '#000000',
			'background'				=> '',
	
			'animationtype'				=> '',
		), $atts));
		
		// Load CSS for Selected Font
		foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
			if (($iconfont != "Custom") && ($iconfont == $font)) {
				wp_enqueue_style('ts-font-' . strtolower($iconfont),		TS_VCSC_GetResourceURL('css/ts-font-' . strtolower($iconfont) . '.css'), null, false, 'all');
			}
		}
		
		// Rebuild Font Data Array in Case Font is Disabled
		$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_tinymceFontsAll = true;
		$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconFontArrays();
		$VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_tinymceFontsAll = false;
		
		// Define Size for Element
		if ($size != 16) {
			$icon_size					= "height:" . $size . "px; width:" . $size . "px; line-height:" . $size . "px; font-size:" . $size . "px; ";
		} else {
			$icon_size					= "";
		}
		
		// Define Color for Element
		if ($color != "#000000") {
			$icon_color					= "color: " . $color . "; ";
		} else {
			$icon_color					= "";
		}
		
		// Define Background for Element
		if (strlen($background) > 0) {
			$icon_background 			= " background-color: " . $background . "; ";
		} else {
			$icon_background			= "";
		}
	
		// Define Animation Array
		$animationloop = array();
		$animationname = array();
		if (strlen($animationtype) > 0) {
			if ($animationtype == "Hover") {
				foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Hovers as $key => $option ) {
					if ($key) {
						$animationloop[] = $option;
						$animationname[] = $key;
					}
				}
			} else if ($animationtype == "Default") {
				foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Infinite_Effects as $key => $option ) {
					if ($key) {
						$animationloop[] = $option;
						$animationname[] = $key;
					}
				}
			} else if ($animationtype == "Viewport") {
				foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Viewport as $key => $option ) {
					if ($key) {
						$animationloop[] = $option;
						$animationname[] = $key;
					}
				}
			}
		}
		$animationcount = count($animationloop) - 1;
		
		$output = '';
		$output .= '<div id="ts-vcsc-extend-preview-' . $font . '" class="ts-vcsc-extend-preview" data-font="' . $font . '">';
			$output .= '<div id="ts-vcsc-extend-preview-list-' . $font . '" class="ts-vcsc-extend-preview-list" data-font="' . $font . '">';
				$outputcount = 1;
				$output .= '<table class="ts-vcsc-icon-animations" style="width: 100%;">';
				$output .= '<thead>';
				$output .= '<tr><th>#</th><th>Animation Name</th><th>Default (Class Name)</th><th>Hover (Class Name)</th><th>Viewport (Class Name)</th><th>Animation Effect</th></tr>';
				$output .= '</thead>';
				$output .= '<tbody>';
					foreach ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
						foreach ($VISUAL_COMPOSER_EXTENSIONS->{'TS_VCSC_List_Icons_' . $iconfont . ''} as $key => $option ) {
							if (($iconfont != "Custom") && ($iconfont == $font)){
								if ($outputcount <= $animationcount) {
									$output .= '<tr>';
									$output .= '<td>' . $outputcount . '</td>';
									$output .= '<td style="font-size: 14px; font-weight: bold;">' . $animationname[$outputcount] . '</td>';
									if ($animationtype == "Hover") {
										$output .= '<td>' . str_replace("hover", "infinite", $animationloop[$outputcount]) . '</td>';
										$output .= '<td>' . $animationloop[$outputcount] . '</td>';
										$output .= '<td>' . str_replace("hover", "viewport", $animationloop[$outputcount]) . '</td>';
									} else if ($animationtype == "Default") {
										$output .= '<td>' . $animationloop[$outputcount] . '</td>';
										$output .= '<td>' . str_replace("infinite", "hover", $animationloop[$outputcount]) . '</td>';
										$output .= '<td>' . str_replace("infinite", "viewport", $animationloop[$outputcount]) . '</td>';
									} else if ($animationtype == "Viewport") {
										$output .= '<td>' . str_replace("viewport", "infinite", $animationloop[$outputcount]) . '</td>';
										$output .= '<td>' . str_replace("viewport", "hover", $animationloop[$outputcount]) . '</td>';
										$output .= '<td>' . $animationloop[$outputcount] . '</td>';
									}
									if ($animationtype == "Viewport") {
										$output .= '<td><div class="ts-vcsc-icon-preview" data-name="ts-' . $key . '" data-code="' . $option . '" data-font="' . strtolower($font) . '" data-count="' . $outputcount . '" rel="' . $key . '"><span class="ts-vcsc-icon-preview-icon"><i data-viewport="' . $animationloop[$outputcount] . '" class="ts-font-icon ts-' . $key . '" style="' . $icon_size . $icon_color . $icon_background . ' " title="' . $key . '"></i></span></div></td>';
									} else if ($animationtype == "Default") {
										$output .= '<td><div class="ts-vcsc-icon-preview" data-name="ts-' . $key . '" data-code="' . $option . '" data-font="' . strtolower($font) . '" data-count="' . $outputcount . '" rel="' . $key . '"><span class="ts-vcsc-icon-preview-icon"><i data-viewport="" class="ts-font-icon ts-' . $key . ' ' . $animationloop[$outputcount] . '" style="' . $icon_size . $icon_color . $icon_background . ' " title="' . $key . '"></i></span></div></td>';
									} else if ($animationtype == "Hover") {
										$output .= '<td><div class="ts-vcsc-icon-preview" data-name="ts-' . $key . '" data-code="' . $option . '" data-font="' . strtolower($font) . '" data-count="' . $outputcount . '" rel="' . $key . '"><span class="ts-vcsc-icon-preview-icon"><i data-viewport="" class="ts-font-icon ts-' . $key . ' ' . $animationloop[$outputcount] . '" style="' . $icon_size . $icon_color . $icon_background . ' " title="' . $key . '"></i></span></div></td>';
									}
									$output .= '</tr>';
								} else {
									break;
								}
								$outputcount = $outputcount + 1;
							}
						}
					}
				$output .= '</tbody>';
				$output .= '</table>';
			$output .= '</div>';
		$output .= '</div>';

		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>