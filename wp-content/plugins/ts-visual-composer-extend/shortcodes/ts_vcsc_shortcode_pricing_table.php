<?php
	add_shortcode('TS-VCSC-Pricing-Table', 'TS_VCSC_Pricing_Table_Function');
	function TS_VCSC_Pricing_Table_Function ($atts, $content = null) {
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
			'style'						=> "1",
			'featured'					=> 'false',
			'featured_text'				=> 'Recommended',
			'plan'						=> 'Basic',
			'plan_color_active'			=> '3b86b0',
			'plan_color_inactive'		=> 'e5e5e5',
			'cost'						=> '$20',
			'per'						=> '',
			'cost_color'				=> 'f7f7f7',
			'content_color'				=> 'ffffff',
			'button_url'				=> '',
			'button_text'				=> 'Purchase',
			'button_target'				=> '_parent',
			'margin_top'				=> 0,
			'margin_bottom'				=> 0,
			'class'						=> '',
		), $atts ) );
		
		$el_class 						= '';
		$featured_pricing 				= ($featured == 'true') ? ' featured' : NULL;
		$border_radius_style 			= '';
		$margin_settings				= 'margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;';
	
		$output 						= '';
		
		if ($style == "1"){
			$output .= '<div class="ts-pricing style1 clearFixMe' . $featured_pricing . ' ' . $class . '" style="' . $margin_settings . '">';
				$output .= '<div class="ts-pricing-header" >';
					$output .= '<h5>' . $plan . '</h5>';
				$output .= '</div>';
				$output .= '<div class="ts-pricing-cost clr">';
					$output .= '<div class="ts-pricing-amount">'. $cost .'</div><div class="ts-pricing-per">'. $per .'</div>';
				$output .= '</div>';
				$output .= '<div class="ts-pricing-content">';
					if (!function_exists('wpb_js_remove_wpautop')){
						$output .= ''. wpb_js_remove_wpautop($content, true). '';
					} else {
						$output .= ''. $content. '';
					}
				$output .= '</div>';
				if( $button_url ) {
					$output .= '<div>';
					$output .= '<a href="'. $button_url .'" target="'. $button_target .'" '. $border_radius_style .' class="ts-pricing-button">'. $button_text .'</a>';
					$output .= '</div>';
				}
			$output .= '</div>';
		} else if ($style == "2"){
			$output .= '<div class="ts-pricing style2 clearFixMe' . $class . '" style="' . $margin_settings . '">';
				$output .= '<div class="plan' . $featured_pricing . '">';
					$output .= '<h3>';
					$output .= '' . $plan . '<span>' . $cost . '</span>';
					$output .= '</h3>';
					$output .= '<div><a class="signup" href="' . $button_url . '" target="'. $button_target .'">' . $button_text . '</a></div>';    
					if (!function_exists('wpb_js_remove_wpautop')){
						$output .= ''. wpb_js_remove_wpautop($content, true). '';
					} else {
						$output .= ''. $content. '';
					}
				$output .= '</div>';
			$output .= '</div>';
		} else if ($style == "3"){
			$output .= '<div class="ts-pricing style3 clearFixMe' . $class . '" style="' . $margin_settings . '">';
				$output .= '<div class="plan' . ($featured == "true" ? " plan-highlight" : "") . '">';
					if ($featured == "true") {
						$output .= '<div class="plan-recommended">' . $featured_text . '</div>';
					}
					$output .= '<h3 class="plan-title">' . $plan . '</h3>';
					$output .= '<div class="plan-price">'. $cost .'<span class="plan-unit">'. $per .'</span></div>';
					if (!function_exists('wpb_js_remove_wpautop')){
						$output .= ''. wpb_js_remove_wpautop($content, true). '';
					} else {
						$output .= ''. $content. '';
					}
					$output .= '<div><a href="' . $button_url . '" class="plan-button" target="'. $button_target .'">' . $button_text . '</a></div>';
				$output .= '</div>';
			$output .= '</div>';
		} else if ($style == "4"){
			$output .= '<div class="ts-pricing style4 clearFixMe' . $class . '" style="' . $margin_settings . '">';
				$output .= '<div class="plan ' . ($featured == "true" ? "plan-tall" : "") . '">';
					$output .= '<h2 class="plan-title">' . $plan . '</h2>';
					$output .= '<div class="plan-price">'. $cost .'<span>'. $per .'</span></div>';
					if (!function_exists('wpb_js_remove_wpautop')){
						$output .= ''. wpb_js_remove_wpautop($content, true). '';
					} else {
						$output .= ''. $content. '';
					}
					$output .= '<div><a href="' . $button_url . '" class="plan-button" target="'. $button_target .'">' . $button_text . '</a></div>';
				$output .= '</div>';
			$output .= '</div>';
		} else if ($style == "5"){
			$output .= '<div class="ts-pricing style5 clearFixMe' . $class . '" style="' . $margin_settings . '">';
				$output .= '<div class="pricing-table' . $featured_pricing . '">';
					$output .= '<div class="pricing-table-header">';
						$output .= '<h1>' . $plan . '</h1>';
					$output .= '</div>';
					$output .= '<div class="pricing-table-content">';
						if (!function_exists('wpb_js_remove_wpautop')){
							$output .= ''. wpb_js_remove_wpautop($content, true). '';
						} else {
							$output .= ''. $content. '';
						}
					$output .= '</div>';
					$output .= '<div class="pricing-table-footer">';
						$output .= '<h2>'. $cost .'</h2>';
						$output .= '<p>'. $per .'</p>';
						$output .= '<a href="' . $button_url . '" class="plan-button" target="'. $button_target .'">' . $button_text . '</a>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>
