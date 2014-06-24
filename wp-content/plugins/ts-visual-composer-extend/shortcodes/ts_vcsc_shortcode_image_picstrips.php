<?php
	add_shortcode('TS-VCSC-Image-Picstrips', 'TS_VCSC_Image_Picstrips_Function');
	function TS_VCSC_Image_Picstrips_Function ($atts) {
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
		wp_enqueue_script('ts-extend-hammer', 								TS_VCSC_GetResourceURL('js/jquery.hammer.min.js'), array('jquery'), false, $FOOTER);
		wp_enqueue_script('ts-extend-nacho', 								TS_VCSC_GetResourceURL('js/jquery.nchlightbox.js'), array('jquery'), false, $FOOTER);
		wp_enqueue_style('ts-extend-nacho',									TS_VCSC_GetResourceURL('css/jquery.nchlightbox.min.css'), null, false, 'all');
		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
		
		extract( shortcode_atts( array(
			'image'						=> '',
			'attribute_alt'				=> 'false',
			'attribute_alt_value'		=> '',
			'image_fixed'				=> 'true',
			"image_width_percent"		=> 100,
			'image_width'				=> 300,
			'image_height'				=> 200,
			'image_position'			=> 'ts-imagefloat-center',
			'splits_number'				=> 8,
			'splits_space'				=> 5,
			'splits_offset'				=> 10,
			'splits_background'			=> '#ffffff',
			
			'lightbox_group'			=> 'true',
			'lightbox_group_name'		=> '',
			'lightbox_size'				=> 'full',
			'lightbox_effect'			=> 'random',
			'lightbox_speed'			=> 5000,
			'lightbox_social'			=> 'true',
			'lightbox_backlight'		=> 'auto',
			'lightbox_backlight_color'	=> '#ffffff',
			
			'tooltip_css'				=> 'false',
			'tooltip_content'			=> '',
			'tooltip_position'			=> 'ts-simptip-position-top',
			'tooltip_style'				=> '',
			'margin_top'				=> 0,
			'margin_bottom'				=> 0,
			'el_id' 					=> '',
			'el_class'                  => '',
		), $atts ));
	
		$picstrips_image = wp_get_attachment_image_src($image, 'large');
		
		$picstrips_margin = 'margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;';
		
		$output = "";
		
		if (!empty($el_id)) {
			$picstrips_image_id			= $el_id;
		} else {
			$picstrips_image_id			= 'ts-vcsc-image-picstrips-' . mt_rand(999999, 9999999);
		}
		
		// Tooltip
		if ($tooltip_css == "true") {
			if (strlen($tooltip_content) != 0) {
				$picstrips_tooltipclasses	= " ts-simptip-multiline " . $tooltip_style . " " . $tooltip_position;
				$picstrips_tooltipcontent	= ' data-tooltip="' . $tooltip_content . '"';
			} else {
				$picstrips_tooltipclasses	= "";
				$picstrips_tooltipcontent	= "";
			}
		} else {
			$picstrips_tooltipclasses		= "";
			if (strlen($tooltip_content) != 0) {
				$picstrips_tooltipcontent	= ' title="' . $tooltip_content . '"';
			} else {
				$picstrips_tooltipcontent	= "";
			}
		}
		
		// Image Size
		if ($image_fixed == "false") {
			$picstrips_dimensions			= "width: " . $image_width_percent . "%; height: auto;";
			$picstrips_frame_size			= "width: " . $image_width_percent . "%;";
			$picstrips_wrapper_size			= "width: " . $image_width_percent . "%; height: auto;";
			$picstrips_tag					= "responsive";
			$picstrips_height				= "auto";
			$picstrips_width				= $image_width_percent;
		} else {
			$picstrips_dimensions			= "width: " . $image_width . "px; height: " . $image_height . "px;";
			$picstrips_frame_size			= "width: " . $image_width . "px;";
			$picstrips_wrapper_size			= "width: " . $image_width . "px; height: auto;";
			$picstrips_tag					= "fixed";
			$picstrips_height				= $image_height;
			$picstrips_width				= $image_width;
		}
		
		if ($lightbox_backlight == "auto") {
			$nacho_color					= '';
		} else if ($lightbox_backlight == "custom") {
			$nacho_color					= 'data-color="' . $lightbox_backlight_color . '"';
		} else if ($lightbox_backlight == "hideit") {
			$nacho_color					= 'data-color="#000000"';
		}
		
		$image_extension 					= pathinfo($picstrips_image[0], PATHINFO_EXTENSION);
		
		if ($attribute_alt == "true") {
			$alt_attribute					= $attribute_alt_value;
		} else {
			$alt_attribute					= basename($picstrips_image[0], "." . $image_extension);
		}
		
		$content_title						= '';
		
		$output .= '<div id="' . $picstrips_image_id . '" class="ts-image-picstrips ' . $picstrips_tooltipclasses . '"' . $picstrips_tooltipcontent . ' data-strips="' . $splits_number . '" data-space="' . $splits_space . '" data-offset="' . $splits_offset . '" data-color="' . $splits_background . '" style="width: 100%; ' . $picstrips_margin . '">';
			$output .= '<a href="' . $picstrips_image[0] . '" class="nch-lightbox" data-title="' . $content_title . '" rel="' . ($lightbox_group == "true" ? "nachogroup" : $lightbox_group_name) . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" ' . $nacho_color . '>';
				$output .= '<img class="ts-imagepicstrips" src="' . $picstrips_image[0] . '" alt="' . $alt_attribute . '" style="width: 100%; height: auto;"/>';
			$output .= '</a>'; 
		$output .= '</div>'; 
	
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>