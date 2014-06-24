<?php
	add_shortcode('TS-VCSC-Icon-List', 'TS_VCSC_Icon_List_Function');
	function TS_VCSC_Icon_List_Function ($atts, $content = '') {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}
		
		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_style('ts-extend-simptip',							TS_VCSC_GetResourceURL('css/jquery.simptip.css'), null, false, 'all');
			wp_enqueue_style('ts-extend-animations',                 		TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-animations.min.css'), null, false, 'all');
			wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
		}
		
		extract( shortcode_atts( array(
			'icon'						=> '',
			'color'						=> '#7dbd21',
			'font_color'				=> '#000000',
			'text_align'				=> 'left',
			'margin_right'				=> 10,
			'font_size'					=> 12,
			'link'						=> '',
			'link_target'				=> '_parent',
			'tooltip_css'				=> 'false',
			'tooltip_content'			=> '',
			'tooltip_position'			=> 'ts-simptip-position-top',
			'tooltip_style'				=> '',
			'animation_view' 			=> '',
		),
		$atts ) );
		
		// Main Styles
		$add_style = array();
		
			$add_style[] = 'text-align:' . $text_align . ';';
		if( $font_size ) {
			$add_style[] = 'font-size:' . $font_size . 'px;';
			$add_style[] = 'line-height:' . $font_size . 'px;';
		}
		
		if ( $font_color ) {
			$add_style[] = 'color: ' . $font_color . ';';
		}
		
		$add_style = implode('', $add_style);
	
		if ( $add_style ) {
			$add_style = wp_kses( $add_style, array() );
			$add_style = ' style="' . esc_attr($add_style) . '"';
		}
		
		// CSS Animations
		if ( $animation_view !== '' ) {
			$css_animation_classes =  TS_VCSC_GetCSSAnimation($animation_view);
		} else {
			$css_animation_classes = '';
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
		
		$icon_style = 'display: inline; margin-right: '. intval($margin_right) .'px; color: ' . $color . '; width: ' . $font_size . 'px; height: ' . $font_size . 'px; font-size: ' . $font_size . 'px; line-height: ' . $font_size . 'px;';
		
		$output ='<div class="ts-list-item ' . $css_animation_classes . '" '. $add_style .'>';
			if ($link) {
				$output .= '<a href="'. esc_url($link) .'" target="'. $link_target .'">';
			}
				$output .= '<span class="' . $icon_tooltipclasses . '" ' . $icon_tooltipcontent . '><i class="ts-font-icon '. $icon .'" style="' . $icon_style . '"></i>' . do_shortcode($content) . '</span>';
			if ($link) {
				$output .= '</a>';
			}
		$output .= '</div>';
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>