<?php
	add_shortcode('TS-VCSC-QRCode', 'TS_VCSC_QRCode_Function');
	function TS_VCSC_QRCode_Function ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
	
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}

		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
			wp_enqueue_script('ts-extend-qrcode',							TS_VCSC_GetResourceURL('js/jquery.qrcode.min.js'), array('jquery'), false, $FOOTER);
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
	
		extract( shortcode_atts( array(
			'render'					=> 'canvas',
			'color'						=> '#000000',
			'responsive'				=> 'false',
			'size_min'					=> 100,
			'size_max'					=> 400,
			'size_r'					=> 100,
			'size_f'					=> 100,
			'value'						=> '',
			'margin_top'				=> 0,
			'margin_bottom'				=> 0,
			'el_id' 					=> '',
			'el_class' 					=> '',
		), $atts ));

		if (!empty($el_id)) {
			$qrcode_id					= $el_id;
		} else {
			$qrcode_id					= 'ts-vcsc-qrcode-' . mt_rand(999999, 9999999);
		}

		$output = '';
		
		if ($responsive == "true") {
			$width						= $size_r;
			$class						= "responsive";
		} else {
			$width						= $size_f;
			$class						= "fixed";
		}
		
		$output .= '<div id="' . $qrcode_id . '" class="ts-qrcode-parent ' . $class . ' ' . $el_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;" data-responsive="' . $responsive . '" data-qrcode="' . $value . '" data-size="' . $width . '" data-min="' . $size_min . '" data-max="' . $size_max . '" data-color="' . $color . '" data-render="' . $render . '"></div>';
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>