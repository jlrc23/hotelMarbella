<?php
	add_shortcode('TS-VCSC-Google-Trends', 'TS_VCSC_Google_Trends_Function');
	function TS_VCSC_Google_Trends_Function ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}

		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
		}
		
		extract( shortcode_atts( array(
			'trend_height'				=> '400',
			'trend_width'				=> '1024',
			'trend_average'				=> 'false',
			'trend_tags'				=> '',
			'trend_geo'					=> 'US'
		), $atts ));
	
		//format input
		$trend_height	=	(int)$trend_height;
		$trend_width	=	(int)$trend_width;
		$trend_tags		=	esc_attr($trend_tags);
		$trend_geo		=	esc_attr($trend_geo);
		
		$Trends_Array = explode(',', $trend_tags);
		$Trends_Count = count($Trends_Array);
		
		$output = '';
		
		$output .= '<div id="" class="ts-google-trend" style="width: ' . $trend_width . 'px; height: auto; overflow: hidden;">';
			if ($trend_average == "true"){
				$output .= '<script type="text/javascript" src="//www.google.com/trends/embed.js?hl=en-US&q=' . $trend_tags . '&geo=' . $trend_geo . '&cmpt=q&content=1&cid=TIMESERIES_GRAPH_AVERAGES_CHART&export=5&w=' . $trend_width . '&h=' . $trend_height . '"></script>';
			} else {
				$output .= '<script type="text/javascript" src="http://www.google.com/trends/embed.js?hl=en-US&q=' . $trend_tags . '&geo=' . $trend_geo . '&cmpt=q&content=1&cid=TIMESERIES_GRAPH_0&export=5&w=' . $trend_width . '&h=' . $trend_height . '"></script>';
			}
		$output .= '</div>';
			
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>