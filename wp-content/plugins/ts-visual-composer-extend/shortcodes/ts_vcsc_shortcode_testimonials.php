<?php
	add_shortcode('TS_VCSC_Testimonial_Standalone', 			'TS_VCSC_Testimonial_Standalone');
	add_shortcode('TS_VCSC_Testimonial_Single',                	'TS_VCSC_Testimonial_Single');
	add_shortcode('TS_VCSC_Testimonial_Slider_Custom',         	'TS_VCSC_Testimonial_Slider_Custom');
    add_shortcode('TS_VCSC_Testimonial_Slider_Category',        'TS_VCSC_Testimonial_Slider_Category');
	
	// Standalone Testimonial
	function TS_VCSC_Testimonial_Standalone ($atts, $content = null) {
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
			'testimonial'					=> '',
			'style'							=> 'style1',
			'margin_top'                    => 0,
			'margin_bottom'                 => 0,
			'el_id'                         => '',
			'el_class'                      => '',
		), $atts ));
		
		$output								= '';

		if (!empty($el_id)) {
			$testimonial_block_id			= $el_id;
		} else {
			$testimonial_block_id			= 'ts-vcsc-testimonial-' . mt_rand(999999, 9999999);
		}
		
		// Retrieve Testimonial Post Main Content
		$testimonial_array					= array();
		$args = array(
			'no_found_rows' 				=> 1,
			'ignore_sticky_posts' 			=> 1,
			'posts_per_page' 				=> -1,
			'post_type' 					=> 'ts_testimonials',
			'post_status' 					=> 'publish',
			'orderby' 						=> 'title',
			'order' 						=> 'ASC',
		);
		$testimonial_query = new WP_Query($args);
		if ($testimonial_query->have_posts()) {
			foreach($testimonial_query->posts as $p) {
				if ($p->ID == $testimonial) {
					$testimonial_data = array(
						'author'			=> $p->post_author,
						'name'				=> $p->post_name,
						'title'				=> $p->post_title,
						'id'				=> $p->ID,
						'content'			=> $p->post_content,
					);
					$testimonial_array[] = $testimonial_data;
				}
			}
		}
		wp_reset_postdata();
		
		// Build Testimonial Post Main Content
		foreach ($testimonial_array as $index => $array) {
			$Testimonial_Author				= $testimonial_array[$index]['author'];
			$Testimonial_Name 				= $testimonial_array[$index]['name'];
			$Testimonial_Title 				= $testimonial_array[$index]['title'];
			$Testimonial_ID 				= $testimonial_array[$index]['id'];
			$Testimonial_Content 			= $testimonial_array[$index]['content'];
			$Testimonial_Image				= wp_get_attachment_image_src(get_post_thumbnail_id($Testimonial_ID), 'full');
			if ($Testimonial_Image == false) {
				$Testimonial_Image          = TS_VCSC_GetResourceURL('images/Default_Person.jpg');
			} else {
				$Testimonial_Image          = $Testimonial_Image[0];
			}

			// Retrieve Testimonial Post Meta Content
			$custom_fields 						= get_post_custom($Testimonial_ID);
			$custom_fields_array				= array();
			foreach ($custom_fields as $field_key => $field_values) {
				if (!isset($field_values[0])) continue;
				if (in_array($field_key, array("_edit_lock", "_edit_last"))) continue;
				if (strpos($field_key, 'ts_vcsc_testimonial_') !== false) {
					$field_key_split 			= explode("_", $field_key);
					$field_key_length 			= count($field_key_split) - 1;
					$custom_data = array(
						'group'					=> $field_key_split[$field_key_length - 1],
						'name'					=> 'Testimonial_' . ucfirst($field_key_split[$field_key_length]),
						'value'					=> $field_values[0],
					);
					$custom_fields_array[] = $custom_data;
				}
			}
			foreach ($custom_fields_array as $index => $array) {
				${$custom_fields_array[$index]['name']} = $custom_fields_array[$index]['value'];
			}
			if (isset($Testimonial_Position)) {
				$Testimonial_Position 			= $Testimonial_Position;
			} else {
				$Testimonial_Position 			= '';
			}
			if (isset($Testimonial_Author)) {
				$Testimonial_Author 			= $Testimonial_Author;
			} else {
				$Testimonial_Author 			= '';
			}
	
			// Create Output
			if ($style == "style1") {
				$output .= '<div id="' . $testimonial_block_id . '" class="ts-testimonial-main style1 clearFixMe ' . $el_class . '">';
					$output .= '<div class="ts-testimonial-content">';
						$output .= '<span class="ts-testimonial-arrow"></span>';
						if (!function_exists('wpb_js_remove_wpautop')){
							$output .= '' . wpb_js_remove_wpautop($Testimonial_Content, true) . '';
						} else {
							$output .= '' . $Testimonial_Content . '';
						}
					$output .= '</div>';
					$output .= '<div class="ts-testimonial-user">';
						$output .= '<div class="ts-testimonial-user-thumb"><img src="' . $Testimonial_Image . '" alt=""></div>';
						$output .= '<div class="ts-testimonial-user-name">' . $Testimonial_Author . '</div>';
						$output .= '<div class="ts-testimonial-user-meta">' . $Testimonial_Position . '</div>';
					$output .= '</div>';
				$output .= '</div>';
			} else if ($style == "style2") {
				$output .= '<div id="' . $testimonial_block_id . '" class="ts-testimonial-main style2 clearFixMe ' . $el_class . '">';
					$output .= '<div class="blockquote">';
						$output .= '<span class="leftq quotes"></span>';
							if (!function_exists('wpb_js_remove_wpautop')){
								$output .= '' . wpb_js_remove_wpautop($Testimonial_Content, true) . '';
							} else {
								$output .= '' . $Testimonial_Content . '';
							}
						$output .= '<span class="rightq quotes"></span>';
					$output .= '</div>';
					$output .= '<div class="information">';
						$output .= '<img src="' . $Testimonial_Image . '" width="170" height="auto" />';
						$output .= '<div class="author">' . $Testimonial_Author . '</div>';
						$output .= '<div class="metadata">' . $Testimonial_Position . '</div>';
					$output .= '</div>';
				$output .= '</div>';
			} else if ($style == "style3") {
				$output .= '<div id="' . $testimonial_block_id . '" class="ts-testimonial-main style3 clearFixMe ' . $el_class . '">';
					$output .= '<div class="photo">';
						$output .= '<img src="' . $Testimonial_Image . '" alt=""/>';
					$output .= '</div>';
					$output .= '<div class="content">';
						$output .= '<span class="laquo"></span>';
							if (!function_exists('wpb_js_remove_wpautop')){
								$output .= '' . wpb_js_remove_wpautop($Testimonial_Content, true) . '';
							} else {
								$output .= '' . $Testimonial_Content . '';
							}
						$output .= '<span class="raquo"></span>';
					$output .= '</div>';
					$output .= '<div class="sign">';
						$output .= '<span class="author">' . $Testimonial_Author . '</span>';
						$output .= '<span class="metadata">' . $Testimonial_Position . '</span>';
					$output .= '</div>';
				$output .= '</div>';
			}
		
			break;
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}

	// Single Testimonial for Custom Slider
	function TS_VCSC_Testimonial_Single($atts, $content = null) {
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
			'testimonial'					=> '',
			'style'							=> 'style1',
		), $atts ));
		
		$output								= '';

		$testimonial_item_id				= 'ts-vcsc-testimonial-item-' . mt_rand(999999, 9999999);
		
		// Retrieve Testimonial Post Main Content
		$testimonial_array					= array();
		$category_fields 	                = array();
		$args = array(
			'no_found_rows' 				=> 1,
			'ignore_sticky_posts' 			=> 1,
			'posts_per_page' 				=> -1,
			'post_type' 					=> 'ts_testimonials',
			'post_status' 					=> 'publish',
			'orderby' 						=> 'title',
			'order' 						=> 'ASC',
		);
		$testimonial_query = new WP_Query($args);
		if ($testimonial_query->have_posts()) {
			foreach($testimonial_query->posts as $p) {
				$categories = TS_VCSC_GetTheCategoryByTax($p->ID, 'ts_testimonials_category');
				if ($categories && !is_wp_error($categories)) {
					$category_slugs_arr = array();
					foreach ($categories as $category) {
						$category_slugs_arr[] = $category->slug;
						$category_data = array(
							'slug'		=> $category->slug,
							'name'		=> $category->cat_name
						);
						$category_fields[] = $category_data;
					}
					$categories_slug_str = join(",", $category_slugs_arr);
				};
				if ($p->ID == $testimonial) {
					$testimonial_data = array(
						'author'			=> $p->post_author,
						'name'				=> $p->post_name,
						'title'				=> $p->post_title,
						'id'				=> $p->ID,
						'content'			=> $p->post_content,
						'categories'        => $categories_slug_str,
					);
					$testimonial_array[] = $testimonial_data;
				}
			}
		}
		wp_reset_postdata();
		
		// Build Testimonial Post Main Content
		foreach ($testimonial_array as $index => $array) {
			$Testimonial_Author				= $testimonial_array[$index]['author'];
			$Testimonial_Name 				= $testimonial_array[$index]['name'];
			$Testimonial_Title 				= $testimonial_array[$index]['title'];
			$Testimonial_ID 				= $testimonial_array[$index]['id'];
			$Testimonial_Content 			= $testimonial_array[$index]['content'];
			$Testimonial_Category 			= $testimonial_array[$index]['categories'];
			$Testimonial_Image				= wp_get_attachment_image_src(get_post_thumbnail_id($Testimonial_ID), 'full');
			if ($Testimonial_Image == false) {
				$Testimonial_Image          = TS_VCSC_GetResourceURL('images/Default_Person.jpg');
			} else {
				$Testimonial_Image          = $Testimonial_Image[0];
			}
		
			// Retrieve Testimonial Post Meta Content
			$custom_fields 						= get_post_custom($Testimonial_ID);
			$custom_fields_array				= array();
			foreach ($custom_fields as $field_key => $field_values) {
				if (!isset($field_values[0])) continue;
				if (in_array($field_key, array("_edit_lock", "_edit_last"))) continue;
				if (strpos($field_key, 'ts_vcsc_testimonial_') !== false) {
					$field_key_split 			= explode("_", $field_key);
					$field_key_length 			= count($field_key_split) - 1;
					$custom_data = array(
						'group'					=> $field_key_split[$field_key_length - 1],
						'name'					=> 'Testimonial_' . ucfirst($field_key_split[$field_key_length]),
						'value'					=> $field_values[0],
					);
					$custom_fields_array[] = $custom_data;
				}
			}
			foreach ($custom_fields_array as $index => $array) {
				${$custom_fields_array[$index]['name']} = $custom_fields_array[$index]['value'];
			}
			if (isset($Testimonial_Position)) {
				$Testimonial_Position 			= $Testimonial_Position;
			} else {
				$Testimonial_Position 			= '';
			}
			if (isset($Testimonial_Author)) {
				$Testimonial_Author 			= $Testimonial_Author;
			} else {
				$Testimonial_Author 			= '';
			}
	
			// Create Output
			if ($style == "style1") {
				$output .= '<div id="' . $testimonial_item_id . '" class="ts-testimonial-main style1 clearFixMe">';
					$output .= '<div class="ts-testimonial-content">';
						$output .= '<span class="ts-testimonial-arrow"></span>';
						if (!function_exists('wpb_js_remove_wpautop')){
							$output .= '' . wpb_js_remove_wpautop($Testimonial_Content, true) . '';
						} else {
							$output .= '' . $Testimonial_Content . '';
						}
					$output .= '</div>';
					$output .= '<div class="ts-testimonial-user">';
						$output .= '<div class="ts-testimonial-user-thumb"><img src="' . $Testimonial_Image . '" alt=""></div>';
						$output .= '<div class="ts-testimonial-user-name">' . $Testimonial_Author . '</div>';
						$output .= '<div class="ts-testimonial-user-meta">' . $Testimonial_Position . '</div>';
					$output .= '</div>';
				$output .= '</div>';
			} else if ($style == "style2") {
				$output .= '<div id="' . $testimonial_item_id . '" class="ts-testimonial-main style2 clearFixMe">';
					$output .= '<div class="blockquote">';
						$output .= '<span class="leftq quotes"></span>';
							if (!function_exists('wpb_js_remove_wpautop')){
								$output .= '' . wpb_js_remove_wpautop($Testimonial_Content, true) . '';
							} else {
								$output .= '' . $Testimonial_Content . '';
							}
						$output .= '<span class="rightq quotes"></span>';
					$output .= '</div>';
					$output .= '<div class="information">';
						$output .= '<img src="' . $Testimonial_Image . '" width="170" height="auto" />';
						$output .= '<div class="author">' . $Testimonial_Author . '</div>';
						$output .= '<div class="metadata">' . $Testimonial_Position . '</div>';
					$output .= '</div>';
				$output .= '</div>';
			} else if ($style == "style3") {
				$output .= '<div id="' . $testimonial_item_id . '" class="ts-testimonial-main style3 clearFixMe">';
					$output .= '<div class="photo">';
						$output .= '<img src="' . $Testimonial_Image . '" alt="" />';
					$output .= '</div>';
					$output .= '<div class="content">';
						$output .= '<span class="laquo"></span>';
							if (!function_exists('wpb_js_remove_wpautop')){
								$output .= '' . wpb_js_remove_wpautop($Testimonial_Content, true) . '';
							} else {
								$output .= '' . $Testimonial_Content . '';
							}
						$output .= '<span class="raquo"></span>';
					$output .= '</div>';
					$output .= '<div class="sign">';
						$output .= '<span class="author">' . $Testimonial_Author . '</span>';
						$output .= '<span class="metadata">' . $Testimonial_Position . '</span>';
					$output .= '</div>';
				$output .= '</div>';
			}
			break;
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
		
	// Custom Testimonial Slider
	function TS_VCSC_Testimonial_Slider_Custom($atts, $content = null){
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}

		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_style('ts-extend-owlcarousel',				        TS_VCSC_GetResourceURL('css/jquery.owl.carousel.css'), null, false, 'all');
			wp_enqueue_script('ts-extend-owlcarousel',			            TS_VCSC_GetResourceURL('js/jquery.owl.carousel.min.js'), array('jquery'), false, $FOOTER);
			wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
		
		extract( shortcode_atts( array(
			'auto_height'                   => 'true',
			'auto_play'                     => 'false',
			'show_bar'                      => 'true',
			'bar_color'                     => '#dd3333',
			'show_speed'                    => 5000,
			'stop_hover'                    => 'true',
			'show_navigation'               => 'true',
			'page_numbers'                  => 'false',
			'transitions'                   => 'backSlide',
			'margin_top'                    => 0,
			'margin_bottom'                 => 0,
			'el_id'                         => '',
			'el_class'                      => '',
		), $atts ));
		
		$testimonial_random                 = mt_rand(999999, 9999999);
		
		if (!empty($el_id)) {
			$testimonial_slider_id			= $el_id;
		} else {
			$testimonial_slider_id			= 'ts-vcsc-testimonial-slider-' . $testimonial_random;
		}
		
		$output = '';
		
		$output .= '<div id="' . $testimonial_slider_id . '" class="ts-testimonials-slider owl-carousel" data-id="' . $testimonial_random . '" data-navigation="' . $show_navigation . '" data-transitions="' . $transitions . '" data-height="' . $auto_height . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '" data-numbers="' . $page_numbers . '">';
			$output .= do_shortcode($content);
		$output .= '</div>';
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
	// Category Testimonial Slider
	function TS_VCSC_Testimonial_Slider_Category($atts, $content = null){
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}

		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_style('ts-extend-owlcarousel',				        TS_VCSC_GetResourceURL('css/jquery.owl.carousel.css'), null, false, 'all');
			wp_enqueue_script('ts-extend-owlcarousel',			            TS_VCSC_GetResourceURL('js/jquery.owl.carousel.min.js'), array('jquery'), false, $FOOTER);
			wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
		
		extract( shortcode_atts( array(
			'testimonialcat'                => '',
			'style'							=> 'style1',
			'auto_height'                   => 'true',
			'auto_play'                     => 'false',
			'show_bar'                      => 'true',
			'bar_color'                     => '#dd3333',
			'show_speed'                    => 5000,
			'stop_hover'                    => 'true',
			'show_navigation'               => 'true',
			'page_numbers'                  => 'false',
			'transitions'                   => 'backSlide',
			'margin_top'                    => 0,
			'margin_bottom'                 => 0,
			'el_id'                         => '',
			'el_class'                      => '',
		), $atts ));
		
		$testimonial_random                 = mt_rand(999999, 9999999);
		
		if (!empty($el_id)) {
			$testimonial_slider_id			= $el_id;
		} else {
			$testimonial_slider_id			= 'ts-vcsc-testimonial-slider-' . $testimonial_random;
		}
		
		if (!is_array($testimonialcat)) {
			$testimonialcat 				= array_map('trim', explode(',', $testimonialcat));
		}
		
		$output = '';
		
		// Retrieve Testimonial Post Main Content
		$testimonial_array					= array();
		$category_fields 	                = array();
		$args = array(
			'no_found_rows' 				=> 1,
			'ignore_sticky_posts' 			=> 1,
			'posts_per_page' 				=> -1,
			'post_type' 					=> 'ts_testimonials',
			'post_status' 					=> 'publish',
			'orderby' 						=> 'title',
			'order' 						=> 'ASC',
		);
		$testimonial_query = new WP_Query($args);
		if ($testimonial_query->have_posts()) {
			foreach($testimonial_query->posts as $p) {
				$categories = TS_VCSC_GetTheCategoryByTax($p->ID, 'ts_testimonials_category');
				if ($categories && !is_wp_error($categories)) {
					$category_slugs_arr     = array();
					$arrayMatch             = 0;
					foreach ($categories as $category) {
						if (in_array($category->slug, $testimonialcat)) {
							$arrayMatch++;
						}
						$category_slugs_arr[] = $category->slug;
						$category_data = array(
							'slug'			=> $category->slug,
							'name'			=> $category->cat_name,
							'number'    	=> $category->term_id,
						);
						$category_fields[] = $category_data;
					}
					$categories_slug_str = join(",", $category_slugs_arr);
					
				} else {
					$category_slugs_arr     = array();
					$arrayMatch             = 0;
					if (in_array("ts-testimonial-none-applied", $testimonialcat)) {
						$arrayMatch++;
					}
					$category_slugs_arr[]   = '';
					$categories_slug_str    = join(",", $category_slugs_arr);
				}
				if ($arrayMatch > 0) {
					$testimonial_data = array(
						'author'			=> $p->post_author,
						'name'				=> $p->post_name,
						'title'				=> $p->post_title,
						'id'				=> $p->ID,
						'content'			=> $p->post_content,
						'categories'        => $categories_slug_str,
					);
					$testimonial_array[] = $testimonial_data;
				}
			}
		}
		wp_reset_postdata();
		
		$output .= '<div id="' . $testimonial_slider_id . '" class="ts-testimonials-slider owl-carousel" data-id="' . $testimonial_random . '" data-navigation="' . $show_navigation . '" data-transitions="' . $transitions . '" data-height="' . $auto_height . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '" data-numbers="' . $page_numbers . '">';
		
			// Build Testimonial Post Main Content
			foreach ($testimonial_array as $index => $array) {
				$Testimonial_Author				= $testimonial_array[$index]['author'];
				$Testimonial_Name 				= $testimonial_array[$index]['name'];
				$Testimonial_Title 				= $testimonial_array[$index]['title'];
				$Testimonial_ID 				= $testimonial_array[$index]['id'];
				$Testimonial_Content 			= $testimonial_array[$index]['content'];
				$Testimonial_Category 			= $testimonial_array[$index]['categories'];
				$Testimonial_Image				= wp_get_attachment_image_src(get_post_thumbnail_id($Testimonial_ID), 'full');
				if ($Testimonial_Image == false) {
					$Testimonial_Image          = TS_VCSC_GetResourceURL('images/Default_Person.jpg');
				} else {
					$Testimonial_Image          = $Testimonial_Image[0];
				}
				
				// Retrieve Testimonial Post Meta Content
				$custom_fields 						= get_post_custom($Testimonial_ID);
				$custom_fields_array				= array();
				foreach ($custom_fields as $field_key => $field_values) {
					if (!isset($field_values[0])) continue;
					if (in_array($field_key, array("_edit_lock", "_edit_last"))) continue;
					if (strpos($field_key, 'ts_vcsc_testimonial_') !== false) {
						$field_key_split 			= explode("_", $field_key);
						$field_key_length 			= count($field_key_split) - 1;
						$custom_data = array(
							'group'					=> $field_key_split[$field_key_length - 1],
							'name'					=> 'Testimonial_' . ucfirst($field_key_split[$field_key_length]),
							'value'					=> $field_values[0],
						);
						$custom_fields_array[] = $custom_data;
					}
				}
				foreach ($custom_fields_array as $index => $array) {
					${$custom_fields_array[$index]['name']} = $custom_fields_array[$index]['value'];
				}
				if (isset($Testimonial_Position)) {
					$Testimonial_Position 			= $Testimonial_Position;
				} else {
					$Testimonial_Position 			= '';
				}
				if (isset($Testimonial_Author)) {
					$Testimonial_Author 			= $Testimonial_Author;
				} else {
					$Testimonial_Author 			= '';
				}
				
				if ($style == "style1") {
					$output .= '<div class="ts-testimonial-main style1 clearFixMe">';
						$output .= '<div class="ts-testimonial-content">';
							$output .= '<span class="ts-testimonial-arrow"></span>';
							if (!function_exists('wpb_js_remove_wpautop')){
								$output .= '' . wpb_js_remove_wpautop($Testimonial_Content, true) . '';
							} else {
								$output .= '' . $Testimonial_Content . '';
							}
						$output .= '</div>';
						$output .= '<div class="ts-testimonial-user">';
							$output .= '<div class="ts-testimonial-user-thumb"><img src="' . $Testimonial_Image . '" alt=""></div>';
							$output .= '<div class="ts-testimonial-user-name">' . $Testimonial_Author . '</div>';
							$output .= '<div class="ts-testimonial-user-meta">' . $Testimonial_Position . '</div>';
						$output .= '</div>';
					$output .= '</div>';
				} else if ($style == "style2") {
					$output .= '<div class="ts-testimonial-main style2 clearFixMe">';
						$output .= '<div class="blockquote">';
							$output .= '<span class="leftq quotes"></span>';
								if (!function_exists('wpb_js_remove_wpautop')){
									$output .= '' . wpb_js_remove_wpautop($Testimonial_Content, true) . '';
								} else {
									$output .= '' . $Testimonial_Content . '';
								}
							$output .= '<span class="rightq quotes"></span>';
						$output .= '</div>';
						$output .= '<div class="information">';
							$output .= '<img src="' . $Testimonial_Image . '" width="170" height="auto" />';
							$output .= '<div class="author">' . $Testimonial_Author . '</div>';
							$output .= '<div class="metadata">' . $Testimonial_Position . '</div>';
						$output .= '</div>';
					$output .= '</div>';
				} else if ($style == "style3") {
					$output .= '<div class="ts-testimonial-main style3 clearFixMe">';
						$output .= '<div class="photo">';
							$output .= '<img src="' . $Testimonial_Image . '" alt="" />';
						$output .= '</div>';
						$output .= '<div class="content">';
							$output .= '<span class="laquo"></span>';
								if (!function_exists('wpb_js_remove_wpautop')){
									$output .= '' . wpb_js_remove_wpautop($Testimonial_Content, true) . '';
								} else {
									$output .= '' . $Testimonial_Content . '';
								}
							$output .= '<span class="raquo"></span>';
						$output .= '</div>';
						$output .= '<div class="sign">';
							$output .= '<span class="author">' . $Testimonial_Author . '</span>';
							$output .= '<span class="metadata">' . $Testimonial_Position . '</span>';
						$output .= '</div>';
					$output .= '</div>';
				}
				
				foreach ($custom_fields_array as $index => $array) {
					unset(${$custom_fields_array[$index]['name']});
				}
			}
		
		$output .= '</div>';
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
	// Register Container and Child Shortcode with Visual Composer
    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_TS_VCSC_Testimonial_Slider_Custom extends WPBakeryShortCodesContainer {}
    }
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_TS_VCSC_Testimonial_Single extends WPBakeryShortCode {}
    }
?>