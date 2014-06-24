<?php
	add_shortcode('TS-VCSC-Spacer', 'TS_VCSC_Spacer_Function');
	function TS_VCSC_Spacer_Function ($atts) {
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
			'height'					=> '10'
		), $atts ));
	
		$output = '<div class="ts-spacer clearboth" style="line-height: ' . absint($height) . 'px; height: ' . absint($height) . 'px;"></div>';
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>