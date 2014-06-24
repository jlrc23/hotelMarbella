<?php
	//add_action('wp_enqueue_scripts', 		'TS_VCSC_Google_Maps_Front');
	function TS_VCSC_Google_Maps_Front(){
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}
		global $post;
		$postdata = get_post($post->ID);
		$shortcode_exist = preg_match( '#\[ *TS-VCSC-Google-Maps([^\]])*\]#i', $postdata->post_content );
		if($shortcode_exist){
			wp_enqueue_script('ts-extend-mapapi',		"https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false", "1.0", array(), false);
		}
	}
	
	add_shortcode('TS-VCSC-Google-Maps', 	'TS_VCSC_Google_Maps_Function');
	function TS_VCSC_Google_Maps_Function ($atts, $content = null) {
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
		wp_enqueue_script('ts-extend-mapapi',								"https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false", "1.0", array(), false);
		wp_enqueue_script('ts-extend-infobox', 								TS_VCSC_GetResourceURL('js/jquery.infobox.min.js'), array('jquery'), false, $FOOTER);
		wp_enqueue_script('ts-extend-googlemap', 							TS_VCSC_GetResourceURL('js/jquery.googlemap.min.js'), array('jquery'), false, $FOOTER);
	
		extract( shortcode_atts( array(
			'height'					=> '400',
			'coordinates'				=> '',
			'maptype'					=> 'ROADMAP',
			'mapstyle'					=> '',
			'mapfullwidth'				=> 'false',
			'mapfullwrapper'			=> 'false',
			'breakouts'					=> 6,
			'metric'					=> 'false',
			'controls_pan'				=> 'true',
			'controls_zoom'				=> 'true',
			'controls_scale'			=> 'true',
			'controls_street'			=> 'true',
			'controls_style'			=> 'false',
			'directions'				=> 'true',
			'markerstyle'				=> 'default',
			'markerzoom'				=> 17,
			'markerimage'				=> '',
			'markerinternal'			=> '',
			'markeranimation'			=> 'true',
			'markeranimationtype'		=> 'drop',
			'margin_top'				=> 20,
			'margin_bottom'				=> 20,
			'el_id'						=> '',
			'el_class'					=> '',
		), $atts ));

		$randomizer						= mt_rand(999999, 9999999);
		
		if (!empty($el_id)) {
			$map_id						= $el_id;
		} else {
			$map_id						= 'ts-vcsc-google-map-' . $randomizer;
		}
	
		if ($markerstyle == "image") {
			$marker_image 				= wp_get_attachment_image_src($markerimage, 'full');
			$marker_image				= $marker_image[0];
		} else if ($markerstyle == "marker") {
			$marker_image				= TS_VCSC_GetResourceURL('images/marker/' . $markerinternal);
		} else {
			$marker_image				= '';
		}
	
		$output 						= '';

		if (($mapfullwidth == "true") && ($mapfullwrapper == "true")) {
			$output .= '<div class="ts-map-wrapper" style="width: 100%; height: 100%; position: relative; display: block;">';
		}
		
			$output .= '<div id="' . $map_id . '" class="ts-map-frame" data-break-parents="' . $breakouts . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px; height: ' . $height . 'px;"></div>';
		
		if (($mapfullwidth == "true") && ($mapfullwrapper == "true")) {
			$output .= '</div>';
		}
		
		$output .= '<script type="text/javascript">';
			$output .= 'var $languageTextCalcShow				= "' . get_option('ts_vcsc_extend_settings_languageTextCalcShow',			'Show Address Input')					. '";';
			$output .= 'var $languageTextCalcHide				= "' . get_option('ts_vcsc_extend_settings_languageTextCalcHide',			'Hide Address Input')					. '";';
			$output .= 'var $languageTextDirectionShow			= "' . get_option('ts_vcsc_extend_settings_languageTextDirectionShow',		'Show Directions')						. '";';
			$output .= 'var $languageTextDirectionHide			= "' . get_option('ts_vcsc_extend_settings_languageTextDirectionHide',		'Hide Directions')						. '";';
			$output .= 'var $languageTextResetMap				= "' . get_option('ts_vcsc_extend_settings_languageTextResetMap',			'Reset Map')							. '";';
			$output .= 'var $languagePrintRouteText				= "' . get_option('ts_vcsc_extend_settings_languagePrintRouteText',			'Print Route')							. '";';
			$output .= 'var $languageTextDistance				= "' . get_option('ts_vcsc_extend_settings_languageTextDistance',			'Total Distance:') 						. '";';
			$output .= 'var $languageTextViewOnGoogle			= "' . get_option('ts_vcsc_extend_settings_languageTextViewOnGoogle',		'View on Google')						. '";';
			$output .= 'var $languageTextButtonCalc				= "' . get_option('ts_vcsc_extend_settings_languageTextButtonCalc',			'Show Route')							. '";';
			$output .= 'var $languageTextSetTarget				= "' . get_option('ts_vcsc_extend_settings_languageTextSetTarget',			'Please enter your Start Address:')		. '";';
			$output .= 'var $languageTextTravelMode				= "' . get_option('ts_vcsc_extend_settings_languageTextTravelMode',			'Travel Mode')							. '";';
			$output .= 'var $languageTextDriving				= "' . get_option('ts_vcsc_extend_settings_languageTextDriving',			'Driving')								. '";';
			$output .= 'var $languageTextWalking				= "' . get_option('ts_vcsc_extend_settings_languageTextWalking',			'Walking')								. '";';
			$output .= 'var $languageTextBicy					= "' . get_option('ts_vcsc_extend_settings_languageTextBicy',				'Bicycling')							. '";';
			$output .= 'var $languageTextWP						= "' . get_option('ts_vcsc_extend_settings_languageTextWP',					'Optimize Waypoints')					. '";';
			$output .= 'var $languageTextButtonAdd				= "' . get_option('ts_vcsc_extend_settings_languageTextButtonAdd',			'Add Stop on the Way')					. '";';
			$output .= 'var $languageTextMapHome 				= "' . get_option('ts_vcsc_extend_settings_languageTextMapHome',			'Home')									. '";';
			$output .= 'var $languageTextMapBikes 				= "' . get_option('ts_vcsc_extend_settings_languageTextMapBikes',			'Bicycle Trails')						. '";';
			$output .= 'var $languageTextMapTraffic 			= "' . get_option('ts_vcsc_extend_settings_languageTextMapTraffic',			'Traffic')								. '";';
			$output .= 'var $languageTextMapSpeedMiles 			= "' . get_option('ts_vcsc_extend_settings_languageTextMapSpeedMiles',		'Miles Per Hour')						. '";';
			$output .= 'var $languageTextMapSpeedKM 			= "' . get_option('ts_vcsc_extend_settings_languageTextMapSpeedKM',			'Kilometers Per Hour')					. '";';
			$output .= 'var $languageTextMapNoData 				= "' . get_option('ts_vcsc_extend_settings_languageTextMapNoData',			'No Data Available!')					. '";';
			$output .= 'var $languageTextMapMiles 				= "' . get_option('ts_vcsc_extend_settings_languageTextMapMiles',			'Miles')								. '";';
			$output .= 'var $languageTextMapKilometes 			= "' . get_option('ts_vcsc_extend_settings_languageTextMapKilometes',		'Kilometers')							. '";';
		$output .= '</script>';

		?>
			<script type="text/javascript">
				jQuery(document).ready(function($){
					jQuery('#<?php echo $map_id; ?>').JQMap({
						jqm_Height: 			'<?php echo $height; ?>',
						jqm_Width:				'100',
						jqm_MapFullWidth:		<?php echo $mapfullwidth; ?>,
						jqm_MapType:			'<?php echo $maptype; ?>',
						jqm_MapStyle:			$<?php echo $mapstyle; ?>,
						jqm_PanControl:			<?php echo $controls_pan; ?>,
						jqm_ZoomControl:		<?php echo $controls_zoom; ?>,
						jqm_ScaleControl:		<?php echo $controls_scale; ?>,
						jqm_StreetControl:		<?php echo $controls_street; ?>,
						jqm_StyleControl:		<?php echo $controls_style; ?>,
						jqm_Metric:				<?php echo $metric; ?>,
						jqm_MapIcon:			'<?php echo $marker_image; ?>',
						jqm_MapDirections:		<?php echo $directions; ?>,
						jqm_ZoomStartPoint:		<?php echo $markerzoom; ?>,
						jqm_StartOpacity: 		8,
						jqm_Animation:			<?php echo $markeranimation; ?>,
						jqm_AnimationType:		'<?php echo $markeranimationtype; ?>',
						jqm_ShowTarget:  		false,
						jqm_ShowBouncer:  		true,
						jqm_StartPanel: 		true,
						jqm_TexStartPoint:		'',
						jqm_Fixdestination:		'<?php echo $coordinates; ?>',
						jqm_TooltipContent:		'<div class="ts-map-infobox"><?php echo trim(preg_replace('/\s+/', ' ', do_shortcode($content))); ?></div>',
						jqm_TextResetMap:		$languageTextResetMap,
						jqm_TextCalcShow:		$languageTextCalcShow,
						jqm_TextCalcHide:		$languageTextCalcHide,
						jqm_TextDirectionShow:	$languageTextDirectionShow,
						jqm_TextDirectionHide:	$languageTextDirectionHide,
						jqm_PrintRouteText:		$languagePrintRouteText,
						jqm_TextViewOnGoogle:	$languageTextViewOnGoogle,
						jqm_TextButtonCalc:		$languageTextButtonCalc,
						jqm_TextSetTarget:		$languageTextSetTarget,
						jqm_TextTravelMode:		$languageTextTravelMode,
						jqm_TextDriving:		$languageTextDriving,
						jqm_TextWalking:		$languageTextWalking,
						jqm_TextBicy:			$languageTextBicy,
						jqm_TextWP:				$languageTextWP,
						jqm_TextButtonAdd:		$languageTextButtonAdd,
					});
				});
			</script>
		<?php
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>