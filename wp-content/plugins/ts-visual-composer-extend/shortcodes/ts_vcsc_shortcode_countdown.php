<?php
	add_shortcode('TS-VCSC-Countdown', 'TS_VCSC_Countdown_Function');
	function TS_VCSC_Countdown_Function ($atts) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
	
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}

		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_style('ts-extend-countdown',							TS_VCSC_GetResourceURL('css/jquery.counteverest.min.css'), null, false, 'all');
			wp_enqueue_script('ts-extend-countdown',						TS_VCSC_GetResourceURL('js/jquery.counteverest.min.js'), array('jquery'), false, $FOOTER);
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
	
		extract( shortcode_atts( array(
			'style'						=> 'minimum',
			
			'counter_scope'				=> '1',
			'counter_interval'			=> '60',
			'counter_datetime'			=> '',
			'counter_date'				=> '',
			'counter_time'				=> '',
			'counter_zone'				=> 'false',

			'date_zeros'				=> 'true',
			'date_days'					=> 'true',
			'date_hours'				=> 'true',
			'date_minutes'				=> 'true',
			'date_seconds'				=> 'true',
			
			'circle_width'				=> 5,
			
			'border_type'				=> '',
			'border_thick'				=> 1,
			'border_radius'				=> '',
			'border_color'				=> '#dddddd',
			
			'column_equal_width'		=> 'true',
			'column_background_color'	=> '#f7f7f7',
			'column_border_type'		=> '',
			'column_border_thick'		=> 1,
			'column_border_radius'		=> '',
			'column_border_color'		=> '#dddddd',
			
			'color_background_basic'	=> '#f7f7f7',
			'color_numbers_basic'		=> '#000000',
			'color_text_basic'			=> '#000000',
			
			'color_background_clock1'	=> '#000000',
			'color_numbers_clock1'		=> '#ffffff',
			
			'color_background_clock2'	=> '#000000',
			'color_numbers_clock2'		=> '#00deff',
			'color_dividers_clock2'		=> '#00deff',
			
			'color_background_bars'		=> '#ffc728',
			'color_numbers_bars'		=> '#ffffff',
			'color_text_bars'			=> '#a76500',
			'color_barback_bars'		=> '#a66600',
			'color_barfore_bars'		=> '#ffffff',
			
			'color_background_circles'	=> '#000000',
			'color_numbers_circles'		=> '#ffffff',
			'color_text_circles'		=> '#929292',
			'color_circleback_all'		=> '#282828',
			'color_circlefore_days'		=> '#117d8b',
			'color_circlefore_hours'	=> '#117d8b',
			'color_circlefore_minutes'	=> '#117d8b',
			'color_circlefore_seconds'	=> '#117d8b',
			
			'margin_top'				=> 0,
			'margin_bottom'				=> 0,
			'el_id' 					=> '',
			'el_class' 					=> '',
		), $atts ));
	
		$countdown_randomizer			= mt_rand(999999, 9999999);
	
		if (!empty($el_id)) {
			$countdown_id				= $el_id;
		} else {
			$countdown_id				= 'ts-vcsc-countdown-' . $countdown_randomizer;
		}

		$output = '';
		
		// Date Settings
		if ((!empty($counter_date)) && ($counter_scope == "1")) {
			$string_date				= strtotime($counter_date);
			$string_date_day			= date("j", $string_date);
			$string_date_month			= date("n", $string_date);
			$string_date_year			= date("Y", $string_date);
		} else if ((!empty($counter_datetime)) && ($counter_scope == "2")) {
			$string_date				= strtotime($counter_datetime);
			$string_date_day			= date("j", $string_date);
			$string_date_month			= date("n", $string_date);
			$string_date_year			= date("Y", $string_date);
		} else if (($counter_scope == "3") || ((empty($counter_date)) && (empty($counter_datetime)))) {
			$string_date				= strtotime(date('m/d/Y'));
			$string_date_day			= date("j", $string_date);
			$string_date_month			= date("n", $string_date);
			$string_date_year			= date("Y", $string_date);
		} else {
			$string_date_day			= '';
			$string_date_month			= '';
			$string_date_year			= '';
		}
		
		// Time Settings
		if ((!empty($counter_datetime)) && ($counter_scope == "2")) {
			$string_time				= strtotime($counter_datetime);
			$string_time_hour			= date("G", $string_time);
			$string_time_minute			= date("i", $string_time);
			$string_time_second			= date("s", $string_time);
		} else if ((!empty($counter_time)) && ($counter_scope == "3")) {
			$string_time				= strtotime($counter_time);
			$string_time_hour			= date("G", $string_time);
			$string_time_minute			= date("i", $string_time);
			$string_time_second			= date("s", $string_time);
		} else {
			$string_time_hour			= '0';
			$string_time_minute			= '0';
			$string_time_second			= '0';
		}

		// Countdown Border Settings
		if (!empty($border_type)) {
			$countdown_border			= 'border: ' . $border_thick . 'px ' . $border_type . ' ' . $border_color . ';';
		} else {
			$countdown_border			= '';
		}

		// Column Border Settings
		if ($style == "columns") {
			if (!empty($column_border_type)) {
				$column_border			= 'border: ' . $column_border_thick . 'px ' . $column_border_type . ' ' . $column_border_color . ';';
			} else {
				$column_border			= '';
			}
		}
		
		// Data Attribute Settings
		$countdown_data_main			= 'data-id="' . $countdown_randomizer . '" data-type="' . $style . '" data-zone="' . $counter_zone . '" data-zeros="' . $date_zeros . '" data-show-days="' . $date_days . '" data-show-hours="' . $date_hours . '" data-show-minutes="' . $date_minutes . '" data-show-seconds="' . $date_seconds . '"';
		$countdown_data_date			= 'data-day="' . $string_date_day . '" data-month="' . $string_date_month . '" data-year="' . $string_date_year . '"';
		$countdown_data_time			= 'data-hour="' . $string_time_hour . '" data-minute="' . $string_time_minute . '" data-second="' . $string_time_second . '"';
		if ($style == "circles") {
			$countdown_data_color		= 'data-color-width="' . $circle_width . '" data-color-back="' . $color_circleback_all . '" data-color-days="' . $color_circlefore_days . '" data-color-hours="' . $color_circlefore_hours . '" data-color-minutes="' . $color_circlefore_minutes . '" data-color-seconds="' . $color_circlefore_seconds . '"';
		} else {
			$countdown_data_color		= '';
		}
		
		
		// Create Countdown Output
		// Minimum Style
		if ($style == "minimum") {
			$output .= '<div id="' . $countdown_id . '" ' . $countdown_data_main . ' ' . $countdown_data_date . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' class="ts-countdown-parent style-0 ' . $el_class . '" style="background: ' . $color_background_basic . '; ' . $countdown_border . '">';
				$output .= '<div id="' . $countdown_id . '_countdown" class="countdown" style="background: ' . $color_background_basic . ';">';
					if ($date_days == "true") {
						$output .= '<span class="ce-days" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-days-label" style="color: ' . $color_text_basic . ';"></span> ';
					}
					if ($date_hours == "true") {
						$output .= '<span class="ce-hours" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-hours-label" style="color: ' . $color_text_basic . ';"></span> ';
					}
					if ($date_minutes == "true") {
						$output .= '<span class="ce-minutes" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-minutes-label" style="color: ' . $color_text_basic . ';"></span> ';
					}
					if ($date_seconds == "true") {
						$output .= '<span class="ce-seconds" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-seconds-label" style="color: ' . $color_text_basic . ';"></span>';
					}
				$output .= '</div>';
			$output .= '</div>';
		}
		// Basic Style with Columns
		if ($style == "columns") {
			$output .= '<div id="' . $countdown_id . '" data-equalize="' . $column_equal_width . '" ' . $countdown_data_main . ' ' . $countdown_data_date . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' class="ts-countdown-parent style-1 ' . $el_class . '" style="background: ' . $color_background_basic . '; ' . $countdown_border . '">';
				$output .= '<div id="' . $countdown_id . '_countdown" class="countdown" style="background: ' . $color_background_basic . ';">';
					if ($date_days == "true") {
						$output .= '<div class="col ' . $column_border_radius . '" style="background: ' . $column_background_color . '; ' . $column_border . '"><span class="ce-days" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-days-label" style="color: ' . $color_text_basic . ';"></span></div>';
					}
					if ($date_hours == "true") {
						$output .= '<div class="col ' . $column_border_radius . '" style="background: ' . $column_background_color . '; ' . $column_border . '"><span class="ce-hours" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-hours-label" style="color: ' . $color_text_basic . ';"></span></div>';
					}
					if ($date_minutes == "true") {
						$output .= '<div class="col ' . $column_border_radius . '" style="background: ' . $column_background_color . '; ' . $column_border . '"><span class="ce-minutes" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-minutes-label" style="color: ' . $color_text_basic . ';"></span></div>';
					}
					if ($date_seconds == "true") {
						$output .= '<div class="col ' . $column_border_radius . '" style="background: ' . $column_background_color . '; ' . $column_border . '"><span class="ce-seconds" style="color: ' . $color_numbers_basic . ';"></span> <span class="ce-seconds-label" style="color: ' . $color_text_basic . ';"></span></div>';
					}
				$output .= '</div>';
			$output .= '</div>';
		}
		// Bars Style
		if ($style == "bars") {
			$output .= '<div id="' . $countdown_id . '" ' . $countdown_data_main . ' ' . $countdown_data_date . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' class="ts-countdown-parent style-2 ' . $el_class . '" style="background: ' . $color_background_bars . '; ' . $countdown_border . '">';
				$output .= '<div id="' . $countdown_id . '_countdown" class="countdown clearfix-float" style="background: ' . $color_background_bars . ';">';
					$output .= '<div class="info clearfix-float" style="">';
						if ($date_days == "true") {
							$output .= '<div style="width: 100%; display: inline-block;">';
								$output .= '<div id="bar-days_' . $countdown_randomizer . '" class="bar bar-days" style="background: ' . $color_barback_bars . ';"><div class="fill" style="background: ' . $color_barfore_bars . ';"></div></div> ';
								$output .= '<span id="ce-days_' . $countdown_randomizer . '" class="ce-days" style="color: ' . $color_numbers_bars . ';"></span> <span class="ce-days-label" style="color: ' . $color_text_bars . ';"></span>';
							$output .= '</div>';
						}
						if ($date_hours == "true") {
							$output .= '<div style="width: 100%; display: inline-block;">';
								$output .= '<div id="bar-hours_' . $countdown_randomizer . '" class="bar bar-hours" style="background: ' . $color_barback_bars . ';"><div class="fill" style="background: ' . $color_barfore_bars . ';"></div></div>';
								$output .= '<span id="ce-hours_' . $countdown_randomizer . '" class="ce-hours" style="color: ' . $color_numbers_bars . ';"></span> <span class="ce-hours-label" style="color: ' . $color_text_bars . ';"></span>';
							$output .= '</div>';
						}
						if ($date_minutes == "true") {
							$output .= '<div style="width: 100%; display: inline-block;">';
								$output .= '<div id="bar-minutes_' . $countdown_randomizer . '" class="bar bar-minutes" style="background: ' . $color_barback_bars . ';"><div class="fill" style="background: ' . $color_barfore_bars . ';"></div></div>';
								$output .= '<span id="ce-minutes_' . $countdown_randomizer . '" class="ce-minutes" style="color: ' . $color_numbers_bars . ';"></span> <span class="ce-minutes-label" style="color: ' . $color_text_bars . ';"></span>';
							$output .= '</div>';
						}
						if ($date_seconds == "true") {
							$output .= '<div style="width: 100%; display: inline-block;">';
								$output .= '<div id="bar-seconds_' . $countdown_randomizer . '" class="bar bar-seconds" style="background: ' . $color_barback_bars . ';"><div class="fill" style="background: ' . $color_barfore_bars . ';"></div></div>';
								$output .= '<span id="ce-seconds_' . $countdown_randomizer . '" class="ce-seconds" style="color: ' . $color_numbers_bars . ';"></span> <span class="ce-seconds-label" style="color: ' . $color_text_bars . ';"></span>';
							$output .= '</div>';
						}
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		}
		// Digital Clock Style 1
		if ($style == "clock1") {
			$output .= '<div id="' . $countdown_id . '" ' . $countdown_data_main . ' ' . $countdown_data_date . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' class="ts-countdown-parent style-3 ' . $el_class . '" style="background: ' . $color_background_clock1 . '; ' . $countdown_border . '">';
				$output .= '<div id="' . $countdown_id . '_countdown" class="countdown" style="background: ' . $color_background_clock1 . ';">';
					if ($date_hours == "true") {
						$output .= '<span class="number ce-hours" style="color: ' . $color_numbers_clock1 . ';"></span>';
					}
					if ($date_minutes == "true") {
						$output .= '<span class="number ce-minutes" style="color: ' . $color_numbers_clock1 . ';"></span>';
					}
					if ($date_seconds == "true") {
						$output .= '<span class="number ce-seconds" style="color: ' . $color_numbers_clock1 . ';"></span>';
					}
				$output .= '</div>';
			$output .= '</div>';
		}
		// Digital Clock Style 2
		if ($style == "clock2") {
			$output .= '<div id="' . $countdown_id . '" ' . $countdown_data_main . ' ' . $countdown_data_date . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' class="ts-countdown-parent style-7 ' . $el_class . '" style="background: ' . $color_background_clock2 . '; ' . $countdown_border . '">';
				$output .= '<div id="' . $countdown_id . '_countdown" class="countdown" style="background: ' . $color_background_clock2 . ';">';
					if ($date_hours == "true") {
						$output .= '<span class="number ce-hours" style="color: ' . $color_numbers_clock2 . ';"></span><span class="ce-separator" style="color: ' . $color_dividers_clock2 . ';">:</span>';
					}
					if ($date_minutes == "true") {
						$output .= '<span class="number ce-minutes" style="color: ' . $color_numbers_clock2 . ';"></span><span class="ce-separator" style="color: ' . $color_dividers_clock2 . ';">:</span>';
					}
					if ($date_seconds == "true") {
						$output .= '<span class="number ce-seconds" style="color: ' . $color_numbers_clock2 . ';"></span>';
					}
				$output .= '</div>';
			$output .= '</div>';
		}
		// Circles Style
		if ($style == "circles") {
			$output .= '<div id="' . $countdown_id . '" ' . $countdown_data_main . ' ' . $countdown_data_date . ' ' . $countdown_data_time . ' ' . $countdown_data_color . ' class="ts-countdown-parent style-9 ' . $el_class . '" style="background: ' . $color_background_circles . '; ' . $countdown_border . '">';
				$output .= '<div class="countdown" style="background: ' . $color_background_circles . ';">';
					if ($date_days == "true") {
						$output .= '<div class="circle">';
							$output .= '<canvas id="days_' . $countdown_randomizer . '" width="300" height="300"></canvas>';
							$output .= '<div class="circle__values">';
								$output .= '<span class="ce-digit ce-days" style="color: ' . $color_numbers_circles . ';"></span>';
								$output .= '<span class="ce-label ce-days-label" style="color: ' . $color_text_circles . ';"></span>';
							$output .= '</div>';
						$output .= '</div>';
					}
					if ($date_hours == "true") {
						$output .= '<div class="circle">';
							$output .= '<canvas id="hours_' . $countdown_randomizer . '" width="300" height="300"></canvas>';
							$output .= '<div class="circle__values">';
								$output .= '<span class="ce-digit ce-hours" style="color: ' . $color_numbers_circles . ';"></span>';
								$output .= '<span class="ce-label ce-hours-label" style="color: ' . $color_text_circles . ';"></span>';
							$output .= '</div>';
						$output .= '</div>';
					}
					if ($date_minutes == "true") {
						$output .= '<div class="circle">';
							$output .= '<canvas id="minutes_' . $countdown_randomizer . '" width="300" height="300"></canvas>';
							$output .= '<div class="circle__values">';
								$output .= '<span class="ce-digit ce-minutes" style="color: ' . $color_numbers_circles . ';"></span>';
								$output .= '<span class="ce-label ce-minutes-label" style="color: ' . $color_text_circles . ';"></span>';
							$output .= '</div>';
						$output .= '</div>';
					}
					if ($date_seconds == "true") {
						$output .= '<div class="circle">';
							$output .= '<canvas id="seconds_' . $countdown_randomizer . '" width="300" height="300"></canvas>';
							$output .= '<div class="circle__values">';
								$output .= '<span class="ce-digit ce-seconds" style="color: ' . $color_numbers_circles . ';"></span>';
								$output .= '<span class="ce-label ce-seconds-label" style="color: ' . $color_text_circles . ';"></span>';
							$output .= '</div>';
						$output .= '</div>';
					}
				$output .= '</div>';
			$output .= '</div>';
		}
		
		$output .= '<script type="text/javascript">';
			$output .= 'var $daysLabel 		= "' . get_option('ts_vcsc_extend_settings_languageDayPlural',				'Days') 	. '";';
			$output .= 'var $dayLabel 		= "' . get_option('ts_vcsc_extend_settings_languageDaySingular',			'Day') 		. '";';
			$output .= 'var $hoursLabel 	= "' . get_option('ts_vcsc_extend_settings_languageHourPlural',				'Hours') 	. '";';
			$output .= 'var $hourLabel 		= "' . get_option('ts_vcsc_extend_settings_languageHourSingular',			'Hour') 	. '";';
			$output .= 'var $minutesLabel 	= "' . get_option('ts_vcsc_extend_settings_languageMinutePlural',			'Minutes') 	. '";';
			$output .= 'var $minuteLabel 	= "' . get_option('ts_vcsc_extend_settings_languageMinuteSingular',			'Minute') 	. '";';
			$output .= 'var $secondsLabel 	= "' . get_option('ts_vcsc_extend_settings_languageSecondPlural',			'Seconds') 	. '";';
			$output .= 'var $secondLabel	= "' . get_option('ts_vcsc_extend_settings_languageSecondSingular',			'Second') 	. '";';
		$output .= '</script>';
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>