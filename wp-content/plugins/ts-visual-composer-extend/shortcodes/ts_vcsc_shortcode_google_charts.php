<?php
	add_shortcode('TS-VCSC-Google-Charts', 'TS_VCSC_Google_Charts_Function');
	function TS_VCSC_Google_Charts_Function ($atts) {
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
			'chart_height'					=> '400',
			'chart_type'					=> 'pie',
			'chart_legend'					=> 'top',
			'chart_title'					=> '',
			'chart_label'					=> 'percentage',
			'chart_pie_3d'					=> 'true',
			'chart_pie_hole'				=> 20,
			'chart_pie_data'				=> '',
			'chart_donut_data'				=> '',
			'chart_bar_data'				=> '',
			'chart_bar_stack'				=> 'false',
			'chart_bar_vertical'			=> '',
			'chart_bar_horizontal'			=> '',
			'chart_column_data'				=> '',
			'chart_column_stack'			=> 'false',
			'chart_column_vertical'			=> '',
			'chart_column_horizontal'		=> '',
			'chart_area_data'				=> '',
			'chart_area_vertical'			=> '',
			'chart_area_horizontal'			=> '',
			'chart_geo_data'				=> '',
			'chart_geo_region'				=> 'world',
			'chart_geo_colorstart'			=> '#ffff00',
			'chart_geo_colorend'			=> '#ebe5d8',
			'chart_combo_data'				=> '',
			'chart_combo_vertical'			=> '',
			'chart_combo_horizontal'		=> '',
			'chart_org_data'				=> '',
			'margin_top'					=> 0,
			'margin_bottom'					=> 0,
			'el_id'							=> '',
			'el_class'						=> '',
		), $atts ));

		if (!empty($el_id)) {
			$google_chart_id				= $el_id;
		} else {
			$google_chart_id				= 'ts_vcsc_google_chart_' . mt_rand(999999, 9999999);
		}
		
		if ($chart_type == "pie"){
			$chart_pie_data					= trim($chart_pie_data);
			$chart_pie_data					= str_replace("'", '"', $chart_pie_data);
			$chart_pie_data					= str_replace('``', '"', $chart_pie_data);
			$chart_pie_data					= str_replace('(', '[', $chart_pie_data);
			$chart_pie_data					= str_replace(')', ']', $chart_pie_data);
			$chart_data_array				= $chart_pie_data;
		} else if ($chart_type == "donut"){
			$chart_donut_data				= trim($chart_donut_data);
			$chart_donut_data				= str_replace("'", '"', $chart_donut_data);
			$chart_donut_data				= str_replace('``', '"', $chart_donut_data);
			$chart_donut_data				= str_replace('(', '[', $chart_donut_data);
			$chart_donut_data				= str_replace(')', ']', $chart_donut_data);
			$chart_data_array				= $chart_donut_data;
			$chart_pie_hole					= ($chart_pie_hole / 100);
		} else if ($chart_type == "bar"){
			$chart_bar_data					= trim($chart_bar_data);
			$chart_bar_data					= str_replace("'", '"', $chart_bar_data);
			$chart_bar_data					= str_replace('``', '"', $chart_bar_data);
			$chart_bar_data					= str_replace('(', '[', $chart_bar_data);
			$chart_bar_data					= str_replace(')', ']', $chart_bar_data);
			$chart_data_array				= $chart_bar_data;
		} else if ($chart_type == "column"){
			$chart_column_data				= trim($chart_column_data);
			$chart_column_data				= str_replace("'", '"', $chart_column_data);
			$chart_column_data				= str_replace('``', '"', $chart_column_data);
			$chart_column_data				= str_replace('(', '[', $chart_column_data);
			$chart_column_data				= str_replace(')', ']', $chart_column_data);
			$chart_data_array				= $chart_column_data;
		} else if ($chart_type == "area"){
			$chart_area_data				= trim($chart_area_data);
			$chart_area_data				= str_replace("'", '"', $chart_area_data);
			$chart_area_data				= str_replace('``', '"', $chart_area_data);
			$chart_area_data				= str_replace('(', '[', $chart_area_data);
			$chart_area_data				= str_replace(')', ']', $chart_area_data);
			$chart_data_array				= $chart_area_data;
		} else if ($chart_type == "geo"){
			$chart_geo_data					= trim($chart_geo_data);
			$chart_geo_data					= str_replace("'", '"', $chart_geo_data);
			$chart_geo_data					= str_replace('``', '"', $chart_geo_data);
			$chart_geo_data					= str_replace('(', '[', $chart_geo_data);
			$chart_geo_data					= str_replace(')', ']', $chart_geo_data);
			$chart_data_array				= $chart_geo_data;
		} else if ($chart_type == "combo"){
			$chart_combo_data				= trim($chart_combo_data);
			$chart_combo_data				= str_replace("'", '"', $chart_combo_data);
			$chart_combo_data				= str_replace('``', '"', $chart_combo_data);
			$chart_combo_data				= str_replace('(', '[', $chart_combo_data);
			$chart_combo_data				= str_replace(')', ']', $chart_combo_data);
			$chart_data_array				= $chart_combo_data;
		} else if ($chart_type == "org"){
			$chart_org_data					= trim($chart_org_data);
			$chart_org_data					= str_replace("'", '"', $chart_org_data);
			$chart_org_data					= str_replace('``', '"', $chart_org_data);
			$chart_org_data					= str_replace('(', '[', $chart_org_data);
			$chart_org_data					= str_replace(')', ']', $chart_org_data);
			$chart_data_array				= $chart_org_data;
		}
		
		$chart_data_array 					= explode('],', $chart_data_array);
		$chart_data_count 					= count($chart_data_array) - 1;
		
		$output = '';
		
		//$output .= '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
		
		$output .= '<div class="ts-google-chart-holder" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
			if ($chart_type == "pie"){
				?>
					<script type="text/javascript">
						google.load('visualization', '1.0', {'packages':['corechart']});
						google.setOnLoadCallback(drawChart_<?php echo $google_chart_id; ?>);
						function drawChart_<?php echo $google_chart_id; ?>() {
							var data = google.visualization.arrayToDataTable([<?php echo trim ($chart_pie_data); ?>])
							var options = {
								'legend':		{
									'position': 	'<?php echo $chart_legend; ?>',
									'alignment': 	'center'
								},
								'title':    		'',
								'pieSliceText':		'<?php echo $chart_label; ?>', // percentage, value, label, none
								'is3D':				<?php echo $chart_pie_3d; ?>,
								'width':    		'100%',
								'height':   		'<?php echo $chart_height; ?>'
							};
							function resizeChart_<?php echo $google_chart_id; ?>() {
								var chart = new google.visualization.PieChart(document.getElementById('<?php echo $google_chart_id; ?>'));
								chart.draw(data, options);
							}
							window.onload = resizeChart_<?php echo $google_chart_id; ?>();
							jQuery(window).on("debouncedresize", function(event) {
								resizeChart_<?php echo $google_chart_id; ?>();
							});
						}
					</script>
				<?php
			} else if ($chart_type == "donut"){
				?>
					<script type="text/javascript">
						google.load('visualization', '1.0', {'packages':['corechart']});
						google.setOnLoadCallback(drawChart_<?php echo $google_chart_id; ?>);
						function drawChart_<?php echo $google_chart_id; ?>() {
							var data = google.visualization.arrayToDataTable([<?php echo trim ($chart_donut_data); ?>])
							var options = {
								'legend':		{
									'position': 	'<?php echo $chart_legend; ?>',
									'alignment': 	'center'
								},
								'title':    		'',
								'pieSliceText':		'<?php echo $chart_label; ?>',
								'pieHole':			<?php echo $chart_pie_hole; ?>,
								'width':    		'100%',
								'height':   		'<?php echo $chart_height; ?>'
							};
							function resizeChart_<?php echo $google_chart_id; ?>() {
								var chart = new google.visualization.PieChart(document.getElementById('<?php echo $google_chart_id; ?>'));
								chart.draw(data, options);
							}
							window.onload = resizeChart_<?php echo $google_chart_id; ?>();
							jQuery(window).on("debouncedresize", function(event) {
								resizeChart_<?php echo $google_chart_id; ?>();
							});
						}
					</script>
				<?php
			} else if ($chart_type == "bar"){
				?>
					<script type="text/javascript">
						google.load('visualization', '1.0', {'packages':['corechart']});
						google.setOnLoadCallback(drawChart_<?php echo $google_chart_id; ?>);
						function drawChart_<?php echo $google_chart_id; ?>() {
							var data = google.visualization.arrayToDataTable([<?php echo trim ($chart_bar_data); ?>])
							var options = {
								'legend':		{
									'position': 	'<?php echo $chart_legend; ?>',
									'alignment': 	'center'
								},
								'title':    		'',
								'width':    		'100%',
								'height':   		'<?php echo $chart_height; ?>',
								'isStacked':		<?php echo $chart_bar_stack; ?>,
								'orientation':		'vertical',
								'vAxis': {
									'title': 		'<?php echo $chart_bar_vertical; ?>',
								},
								'hAxis': {
									'title':		'<?php echo $chart_bar_horizontal; ?>',
								}
							};
							function resizeChart_<?php echo $google_chart_id; ?>() {
								var chart = new google.visualization.BarChart(document.getElementById('<?php echo $google_chart_id; ?>'));
								chart.draw(data, options);
							}
							window.onload = resizeChart_<?php echo $google_chart_id; ?>();
							jQuery(window).on("debouncedresize", function(event) {
								resizeChart_<?php echo $google_chart_id; ?>();
							});
						}
					</script>
				<?php
			} else if ($chart_type == "column"){
				?>
					<script type="text/javascript">
						google.load('visualization', '1.0', {'packages':['corechart']});
						google.setOnLoadCallback(drawChart_<?php echo $google_chart_id; ?>);
						function drawChart_<?php echo $google_chart_id; ?>() {
							var data = google.visualization.arrayToDataTable([<?php echo trim ($chart_column_data); ?>])
							var options = {
								'legend':		{
									'position': 	'<?php echo $chart_legend; ?>',
									'alignment': 	'center'
								},
								'title':    		'',
								'width':    		'100%',
								'height':   		'<?php echo $chart_height; ?>',
								'isStacked': 		<?php echo $chart_column_stack; ?>,
								'orientation':		'horizontal',
								'vAxis': {
									'title': 		'<?php echo $chart_column_vertical; ?>',
								},
								'hAxis': {
									'title':		'<?php echo $chart_column_horizontal; ?>',
								}
							};
							function resizeChart_<?php echo $google_chart_id; ?>() {
								var chart = new google.visualization.ColumnChart(document.getElementById('<?php echo $google_chart_id; ?>'));
								chart.draw(data, options);
							}
							window.onload = resizeChart_<?php echo $google_chart_id; ?>();
							jQuery(window).on("debouncedresize", function(event) {
								resizeChart_<?php echo $google_chart_id; ?>();
							});
						}
					</script>
				<?php
			} else if ($chart_type == "area"){
				?>
					<script type="text/javascript">
						google.load('visualization', '1.0', {'packages':['corechart']});
						google.setOnLoadCallback(drawChart_<?php echo $google_chart_id; ?>);
						function drawChart_<?php echo $google_chart_id; ?>() {
							var data = google.visualization.arrayToDataTable([<?php echo trim ($chart_area_data); ?>])
							var options = {
								'legend':		{
									'position': 	'<?php echo $chart_legend; ?>',
									'alignment': 	'center'
								},
								'title':    		'',
								'width':    		'100%',
								'height':   		'<?php echo $chart_height; ?>',
								'vAxis': {
									'title': 		'<?php echo $chart_area_vertical; ?>',
								},
								'hAxis': {
									'title':		'<?php echo $chart_area_horizontal; ?>',
								}
							};
							function resizeChart_<?php echo $google_chart_id; ?>() {
								var chart = new google.visualization.AreaChart(document.getElementById('<?php echo $google_chart_id; ?>'));
								chart.draw(data, options);
							}
							window.onload = resizeChart_<?php echo $google_chart_id; ?>();
							jQuery(window).on("debouncedresize", function(event) {
								resizeChart_<?php echo $google_chart_id; ?>();
							});
						}
					</script>
				<?php
			} else if ($chart_type == "geo"){
				?>
					<script type="text/javascript">
						google.load('visualization', '1.0', {'packages':['geochart']});
						google.setOnLoadCallback(drawChart_<?php echo $google_chart_id; ?>);
						function drawChart_<?php echo $google_chart_id; ?>() {
							var data = google.visualization.arrayToDataTable([<?php echo trim ($chart_geo_data); ?>])
							var options = {
								'title':    		'',
								'width':    		'100%',
								'height':   		'<?php echo $chart_height; ?>',
								'region':			'<?php echo $chart_geo_region; ?>',
								'colorAxis': {
									'colors': 		['<?php echo $chart_geo_colorstart; ?>', '<?php echo $chart_geo_colorend; ?>']
								}
							};
							function resizeChart_<?php echo $google_chart_id; ?>() {
								var chart = new google.visualization.GeoChart(document.getElementById('<?php echo $google_chart_id; ?>'));
								chart.draw(data, options);
							}
							window.onload = resizeChart_<?php echo $google_chart_id; ?>();
							jQuery(window).on("debouncedresize", function(event) {
								resizeChart_<?php echo $google_chart_id; ?>();
							});
						}
					</script>
				<?php
			} else if ($chart_type == "combo"){
				?>
					<script type="text/javascript">
						google.load('visualization', '1.0', {'packages':['corechart']});
						google.setOnLoadCallback(drawChart_<?php echo $google_chart_id; ?>);
						function drawChart_<?php echo $google_chart_id; ?>() {
							var data = google.visualization.arrayToDataTable([<?php echo trim ($chart_combo_data); ?>])
							var options = {
								'legend':		{
									'position': 	'<?php echo $chart_legend; ?>',
									'alignment': 	'center'
								},
								'title':    		'',
								'width':    		'100%',
								'height':   		'<?php echo $chart_height; ?>',
								'vAxis': {
									'title': 		'<?php echo $chart_bar_vertical; ?>',
								},
								'hAxis': {
									'title':		'<?php echo $chart_bar_horizontal; ?>',
								},
								'seriesType': 		'bars',
								'series': 			{<?php echo $chart_data_count; ?>: {type: "line"}}
							};
							function resizeChart_<?php echo $google_chart_id; ?>() {
								var chart = new google.visualization.ComboChart(document.getElementById('<?php echo $google_chart_id; ?>'));
								chart.draw(data, options);
							}
							window.onload = resizeChart_<?php echo $google_chart_id; ?>();
							jQuery(window).on("debouncedresize", function(event) {
								resizeChart_<?php echo $google_chart_id; ?>();
							});
						}
					</script>
				<?php
			} else if ($chart_type == "org"){
				?>
					<script type="text/javascript">
						google.load('visualization', '1.0', {'packages':['orgchart']});
						google.setOnLoadCallback(drawChart_<?php echo $google_chart_id; ?>);
						function drawChart_<?php echo $google_chart_id; ?>() {
							var data = google.visualization.arrayToDataTable([<?php echo trim ($chart_org_data); ?>])
							var options = {
								'title':    		'',
								'width':    		'100%',
								'height':   		'<?php echo $chart_height; ?>',
								'allowHtml':		true
							};
							function resizeChart_<?php echo $google_chart_id; ?>() {
								var chart = new google.visualization.OrgChart(document.getElementById('<?php echo $google_chart_id; ?>'));
								chart.draw(data, options);
							}
							window.onload = resizeChart_<?php echo $google_chart_id; ?>();
							jQuery(window).on("debouncedresize", function(event) {
								resizeChart_<?php echo $google_chart_id; ?>();
							});
						}
					</script>
				<?php
			}
			
			$output .= '<div class="ts-google-chart-title">' . $chart_title . '</div>';
			$output .= '<div id="' . $google_chart_id . '" class="' . $el_class . ' ts-google-chart-draw"></div>';
		$output .= '</div>';
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>