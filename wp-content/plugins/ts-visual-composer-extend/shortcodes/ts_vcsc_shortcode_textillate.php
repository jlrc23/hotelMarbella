<?php
	add_shortcode('TS-VCSC-Textillate', 'TS_VCSC_Textillate_Function');
	function TS_VCSC_Textillate_Function ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
	
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}

		if (get_option('ts_vcsc_extend_settings_loadWaypoints', 1) == 1) {
			wp_enqueue_script('ts-extend-waypoints',						TS_VCSC_GetResourceURL('js/jquery.waypoints.min.js'), array('jquery'), false, $FOOTER);
		}
		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_style('ts-extend-textillate',                 		TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-composer.min.css'), null, false, 'all');
			wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
			wp_enqueue_script('ts-extend-textillate',						TS_VCSC_GetResourceURL('js/jquery.textillate.min.js'), array('jquery'), false, $FOOTER);
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
	
		extract( shortcode_atts( array(
			'textillate'				=> '',
			'font_size'					=> 36,
			'font_color'				=> '#000000',
			'font_weight'				=> 'inherit',
			'font_align'				=> 'left',
			'font_theme'				=> 'true',
			'font_family'				=> '',
			'font_type'					=> '',
			
			'link'						=> '',
			
			'animation_in'				=> '',
			'animation_out'				=> '',
			'animation_loop'			=> 'false',
			'animation_pause'			=> 4000,
			'text_order_in'				=> '',
			'text_order_out'			=> '',
			
			'margin_bottom'				=> '0',
			'margin_top' 				=> '0',
			'el_id' 					=> '',
			'el_class'                  => '',
		), $atts ));
		
		if (!empty($el_id)) {
			$textillate_id				= $el_id;
		} else {
			$textillate_id				= 'ts-vcsc-textillate-' . mt_rand(999999, 9999999);
		}
		
		/*$link 		= ($link=='||') ? '' : $link;
		$link 		= vc_build_link($link);
		$a_href		= $link['url'];
		$a_title 	= $link['title'];
		$a_target 	= $link['target'];
		echo $a_href . ' / ' . $a_title . ' / ' . $a_target;*/
		
		$output 						= '';
		
		if ($font_theme == "false") {
			$output 					.= TS_VCSC_GetFontFamily($textillate_id, $font_family, $font_type);
		}
		
		$style_setting					= 'color: ' . $font_color . ';font-size: ' . $font_size . 'px; line-height: ' . $font_size . 'px; font-weight: ' . $font_weight . '; text-align: ' . $font_align . '; margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;';
		
		$animation_in_string			= 'data-in-effect="ts-composer-css-' . $animation_in . '" data-in-sync="' . ($text_order_in == "sync" ? "true" : "false") . '" data-in-shuffle="' . ($text_order_in == "shuffle" ? "true" : "false") . '" data-in-reverse="' . ($text_order_in == "reverse" ? "true" : "false") . '"';
		if ($animation_loop == "true") {
			$animation_out_string		= 'data-pause="' . $animation_pause . '" data-out-effect="ts-composer-css-' . $animation_out . '" data-out-sync="' . ($text_order_out == "sync" ? "true" : "false") . '" data-out-shuffle="' . ($text_order_out == "shuffle" ? "true" : "false") . '" data-out-reverse="' . ($text_order_out == "reverse" ? "true" : "false") . '"';
		} else {
			$animation_out_string		= '';
		}
		
		$output 						.= '<div id="' . $textillate_id . '" class="ts-textillate ' . $el_class . '" data-loop="' . $animation_loop . '" ' . $animation_in_string . ' ' . $animation_out_string . ' style="' . $style_setting . '">' . $textillate . '</div>';
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>