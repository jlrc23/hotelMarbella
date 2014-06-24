<?php
if (!class_exists('TS_Testimonials')){
	class TS_Testimonials {
		function __construct() {
            if (function_exists('vc_is_inline')){
                if (vc_is_inline()) {
                    add_action('init',                              	array($this, 'TS_VCSC_Add_Testimonial_Elements'), 9999999);
                } else {
                    add_action('admin_init',		                	array($this, 'TS_VCSC_Add_Testimonial_Elements'), 9999999);
                }
            } else {
                add_action('admin_init',								array($this, 'TS_VCSC_Add_Testimonial_Elements'), 9999999);
            }
            add_shortcode('TS_VCSC_Testimonial_Standalone', 			array($this, 'TS_VCSC_Testimonial_Standalone'));
            add_shortcode('TS_VCSC_Testimonial_Single',                	array($this, 'TS_VCSC_Testimonial_Single'));
            add_shortcode('TS_VCSC_Testimonial_Slider_Custom',         	array($this, 'TS_VCSC_Testimonial_Slider_Custom'));
            add_shortcode('TS_VCSC_Testimonial_Slider_Category',        array($this, 'TS_VCSC_Testimonial_Slider_Category'));
		}
        
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
    
            // Check for Testimonial and End Shortcode if Empty
            if (empty($testimonial)) {
                $output .= '<div style="text-align: justify; font-weight: bold; font-size: 14px; color: red;">Please select a testimonial in the element settings!</div>';
                echo $output;
                $myvariable = ob_get_clean();
                return $myvariable;
            }
	
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
                            if (function_exists('wpb_js_remove_wpautop')){
                                $output .= '' . wpb_js_remove_wpautop(do_shortcode($Testimonial_Content), true) . '';
                            } else {
                                $output .= '' . do_shortcode($Testimonial_Content) . '';
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
                                if (function_exists('wpb_js_remove_wpautop')){
                                    $output .= '' . wpb_js_remove_wpautop(do_shortcode($Testimonial_Content), true) . '';
                                } else {
                                    $output .= '' . do_shortcode($Testimonial_Content) . '';
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
                                if (function_exists('wpb_js_remove_wpautop')){
                                    $output .= '' . wpb_js_remove_wpautop(do_shortcode($Testimonial_Content), true) . '';
                                } else {
                                    $output .= '' . do_shortcode($Testimonial_Content) . '';
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

            // Check for Testimonial and End Shortcode if Empty
            if (empty($testimonial)) {
                $output .= '<div style="text-align: justify; font-weight: bold; font-size: 14px; color: red;">Please select a testimonial in the element settings!</div>';
                echo $output;
                $myvariable = ob_get_clean();
                return $myvariable;
            }
			
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
						if (function_exists('wpb_js_remove_wpautop')){
							$output .= '' . wpb_js_remove_wpautop(do_shortcode($Testimonial_Content), true) . '';
						} else {
							$output .= '' . do_shortcode($Testimonial_Content) . '';
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
							if (function_exists('wpb_js_remove_wpautop')){
								$output .= '' . wpb_js_remove_wpautop(do_shortcode($Testimonial_Content), true) . '';
							} else {
								$output .= '' . do_shortcode($Testimonial_Content) . '';
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
							if (function_exists('wpb_js_remove_wpautop')){
								$output .= '' . wpb_js_remove_wpautop(do_shortcode($Testimonial_Content), true) . '';
							} else {
								$output .= '' . do_shortcode($Testimonial_Content) . '';
							}
						$output .= '<span class="raquo"></span>';
					$output .= '</div>';
					$output .= '<div class="sign">';
						$output .= '<span class="author">' . $Testimonial_Author . '</span>';
						$output .= '<span class="metadata">' . $Testimonial_Position . '</span>';
					$output .= '</div>';
				$output .= '</div>';
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
                            $category_fields[] 	= $category_data;
                        }
                        $categories_slug_str 	= join(",", $category_slugs_arr);
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
                        $testimonial_array[] 	= $testimonial_data;
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
                    //$Testimonial_Category 			= $testimonial_array[$index]['categories'];
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
                                if (function_exists('wpb_js_remove_wpautop')){
                                    $output .= '' . wpb_js_remove_wpautop(do_shortcode($Testimonial_Content), true) . '';
                                } else {
                                    $output .= '' . do_shortcode($Testimonial_Content) . '';
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
                                    if (function_exists('wpb_js_remove_wpautop')){
                                        $output .= '' . wpb_js_remove_wpautop(do_shortcode($Testimonial_Content), true) . '';
                                    } else {
                                        $output .= '' . do_shortcode($Testimonial_Content) . '';
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
                                    if (function_exists('wpb_js_remove_wpautop')){
                                        $output .= '' . wpb_js_remove_wpautop(do_shortcode($Testimonial_Content), true) . '';
                                    } else {
                                        $output .= '' . do_shortcode($Testimonial_Content) . '';
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
	
        // Add Testimonial Elements
        function TS_VCSC_Add_Testimonial_Elements() {
			global $VISUAL_COMPOSER_EXTENSIONS;
            // Add Standalone Testimonial
            if (function_exists('vc_map')) {
                vc_map( array(
                    "name"                              => __( "TS Single Testimonial", "js_composer" ),
                    "base"                              => "TS_VCSC_Testimonial_Standalone",
                    "icon" 	                            => "icon-wpb-ts_vcsc_testimonial_standalone",
                    "class"                             => "",
                    "category"                          => __( 'VC Extensions', 'js_composer' ),
                    "description"                       => __("Place a single testimonial element", "js_composer"),
                    //"admin_enqueue_js"                => array(ts_fb_get_resource_url('/js/...')),
                    //"admin_enqueue_css"               => array(ts_fb_get_resource_url('/css/...')),
                    "params"                            => array(
                        // Testimonial Settings
                        array(
                            "type"                      => "seperator",
                            "heading"                   => __( "", "js_composer" ),
                            "param_name"                => "seperator_1",
                            "value"                     => "Main Content",
                            "description"               => __( "", "js_composer" )
                        ),
                        array(
                            "type"                      => "testimonial",
                            "heading"                   => __( "Testimonial", "js_composer" ),
                            "param_name"                => "testimonial",
                            "posttype"                  => "ts_testimonials",
                            "taxonomy"                  => "ts_testimonials_category",
                            "value"                     => "",
                            "admin_label"		        => true,
                            "description"               => __( "", "js_composer" )
                        ),
                        array(
                            "type"                      => "hidden_input",
                            "heading"                   => __( "Testimonial Name", "js_composer" ),
                            "param_name"                => "testimonial_name",
                            "value"                     => "",
                            "admin_label"		        => true,
                            "description"               => __( "", "js_composer" )
                        ),
                        // Testimonial Design
                        array(
                            "type"                      => "seperator",
                            "heading"                   => __( "", "js_composer" ),
                            "param_name"                => "seperator_2",
                            "value"                     => "Testimonial Style",
                            "description"               => __( "", "js_composer" )
                        ),
                        array(
                            "type"                      => "dropdown",
                            "heading"                   => __( "Design", "js_composer" ),
                            "param_name"                => "style",
                            "value"                     => array(
                                __( 'Style 1', "js_composer" )          => "style1",
                                __( 'Style 2', "js_composer" )          => "style2",
                                __( 'Style 3', "js_composer" )          => "style3",
                            ),
                            "description"               => __( "", "js_composer" ),
                            "admin_label"               => true,
                            "dependency"                => ""
                        ),
                        // Other Settings
                        array(
                            "type"                      => "seperator",
                            "heading"                   => __( "", "js_composer" ),
                            "param_name"                => "seperator_3",
                            "value"                     => "Other Settings",
                            "description"               => __( "", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "nouislider",
                            "heading"                   => __( "Margin Top", "js_composer" ),
                            "param_name"                => "margin_top",
                            "value"                     => "0",
                            "min"                       => "0",
                            "max"                       => "200",
                            "step"                      => "1",
                            "unit"                      => 'px',
                            "description"               => __( "", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "nouislider",
                            "heading"                   => __( "Margin Bottom", "js_composer" ),
                            "param_name"                => "margin_bottom",
                            "value"                     => "0",
                            "min"                       => "0",
                            "max"                       => "200",
                            "step"                      => "1",
                            "unit"                      => 'px',
                            "description"               => __( "", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "textfield",
                            "heading"                   => __( "Define ID Name", "js_composer" ),
                            "param_name"                => "el_id",
                            "value"                     => "",
                            "description"               => __( "Enter an unique ID for the Testimonial element.", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "textfield",
                            "heading"                   => __( "Extra Class Name", "js_composer" ),
                            "param_name"                => "el_class",
                            "value"                     => "",
                            "description"               => __( "Enter a class name for the Testimonial element.", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        // Load Custom CSS/JS File
                        array(
                            "type"                      => "load_file",
                            "heading"                   => __( "", "js_composer" ),
                            "param_name"                => "el_file",
                            "value"                     => "",
                            "file_type"                 => "js",
                            "file_path"                 => "js/ts-visual-composer-extend-element.min.js",
                            "description"               => __( "", "js_composer" )
                        ),
                    ))
                );
            }
            // Add Single Testimonial (for Custom Slider)
            if (function_exists('vc_map')) {
                vc_map(array(
                    "name"                           	=> __("TS Testimonial Slide", 'js_composer'),
                    "base"                           	=> "TS_VCSC_Testimonial_Single",
                    "class"                          	=> "",
                    "icon"                           	=> "icon-wpb-ts_vcsc_testimonial",
                    "category"                       	=> __("VC Extensions", 'js_composer'),
                    "content_element"                	=> true,
                    "as_child"                       	=> array('only' => 'TS_VCSC_Testimonial_Slider_Custom'),
                    "description"                    	=> __("Add a testimonial slide element", "js_composer"),
                    "params"                         	=> array(
                        // Testimonial Select
                        array(
                            "type"                  	=> "seperator",
                            "heading"               	=> __( "", "js_composer" ),
                            "param_name"            	=> "seperator_1",
                            "value"                 	=> "Selections",
                            "description"           	=> __( "", "js_composer" )
                        ),
                        array(
                            "type"                  	=> "testimonial",
                            "heading"               	=> __( "Testimonial", "js_composer" ),
                            "param_name"            	=> "testimonial",
                            "posttype"              	=> "ts_testimonials",
                            "taxonomy"              	=> "ts_testimonials_category",
                            "value"                 	=> "",
                            "description"           	=> __( "", "js_composer" )
                        ),
                        array(
                            "type"                  	=> "hidden_input",
                            "heading"               	=> __( "Testimonial", "js_composer" ),
                            "param_name"            	=> "testimonial_name",
                            "value"                 	=> "",
                            "admin_label"		    	=> true,
                            "description"           	=> __( "", "js_composer" )
                        ),
                        // Testimonial Design
                        array(
                            "type"                  	=> "seperator",
                            "heading"               	=> __( "", "js_composer" ),
                            "param_name"            	=> "seperator_2",
                            "value"                 	=> "Testimonial Style",
                            "description"           	=> __( "", "js_composer" )
                        ),
                        array(
                            "type"                  	=> "dropdown",
                            "heading"               	=> __( "Design", "js_composer" ),
                            "param_name"            	=> "style",
                            "value"             => array(
                                __( 'Style 1', "js_composer" )          => "style1",
                                __( 'Style 2', "js_composer" )          => "style2",
                                __( 'Style 3', "js_composer" )          => "style3",
                            ),
                            "description"           	=> __( "", "js_composer" ),
                            "admin_label"           	=> true,
                            "dependency"            	=> ""
                        ),
                        // Load Custom CSS/JS File
                        array(
                            "type"                  	=> "load_file",
                            "heading"               	=> __( "", "js_composer" ),
                            "param_name"            	=> "el_file",
                            "value"                 	=> "",
                            "file_type"             	=> "js",
                            "file_path"             	=> "js/ts-visual-composer-extend-element.min.js",
                            "description"           	=> __( "", "js_composer" )
                        ),
                    ))
                );
            }
            // Add Testimonials Slider 1 (Custom Build)
            if (function_exists('vc_map')) {
                vc_map(array(
                   "name"                               => __("TS Testimonials Slider 1", "js_composer"),
                   "base"                               => "TS_VCSC_Testimonial_Slider_Custom",
                   "class"                              => "",
                   "icon"                               => "icon-wpb-ts_vcsc_testimonial_slider_custom",
                   "category"                           => __("VC Extensions", "js_composer"),
                   "as_parent"                          => array('only' => 'TS_VCSC_Testimonial_Single'),
                   "description"                        => __("Build a custom Testimonial Slider", "js_composer"),
                   "content_element"                    => true,
                   "show_settings_on_create"            => false,
                   "params"                             => array(
                        // Slider Settings
                        array(
                            "type"                      => "seperator",
                            "heading"                   => __( "", "js_composer" ),
                            "param_name"                => "seperator_1",
                            "value"                     => "Slider Settings",
                            "description"               => __( "", "js_composer" )
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Auto-Height", "js_composer" ),
                            "param_name"                => "auto_height",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "admin_label"		        => true,
                            "description"               => __( "Switch the toggle if you want the slider to auto-adjust its height.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Auto-Play", "js_composer" ),
                            "param_name"                => "auto_play",
                            "value"                     => "false",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "admin_label"		        => true,
                            "description"               => __( "Switch the toggle if you want the auto-play the slider on page load.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Show Progressbar", "js_composer" ),
                            "param_name"                => "show_bar",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show a progressbar during auto-play.", "js_composer" ),
                            "dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
                        ),
                        array(
                            "type"                      => "colorpicker",
                            "heading"                   => __( "Progressbar Color", "js_composer" ),
                            "param_name"                => "bar_color",
                            "value"                     => "#dd3333",
                            "description"               => __( "Define the color of the animated progressbar.", "js_composer" ),
                            "dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
                        ),
                        array(
                            "type"                      => "nouislider",
                            "heading"                   => __( "Auto-Play Speed", "js_composer" ),
                            "param_name"                => "show_speed",
                            "value"                     => "5000",
                            "min"                       => "1000",
                            "max"                       => "20000",
                            "step"                      => "100",
                            "unit"                      => 'ms',
                            "description"               => __( "Define the speed used to auto-play the slider.", "js_composer" ),
                            "dependency" 				=> array("element" 	=> "auto_play","value" 	=> "true"),
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Stop on Hover", "js_composer" ),
                            "param_name"                => "stop_hover",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want the stop the auto-play while hovering over the slider.", "js_composer" ),
                            "dependency"                => array( 'element' => "auto_play", 'value' => 'true' )
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Show Navigation", "js_composer" ),
                            "param_name"                => "show_navigation",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show left/right navigation buttons for the slider.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"                      => "dropdown",
                            "heading"                   => __( "Transition", "js_composer" ),
                            "param_name"                => "transitions",
                            "width"                     => 150,
                            "value"                     => array(
                                __( 'Back Slide', "js_composer" )		    => "backSlide",
                                __( 'Go Down', "js_composer" )		        => "goDown",
                                __( 'Fade Up', "js_composer" )		        => "fadeUp",
                                __( 'Simple Fade', "js_composer" )		    => "fade",
                            ),
                            "description"               => __( "Select how to transition between the individual slides.", "js_composer" ),
                            "admin_label"		        => true,
                        ),
                        // Other Settings
                        array(
                            "type"                      => "seperator",
                            "heading"                   => __( "", "js_composer" ),
                            "param_name"                => "seperator_2",
                            "value"                     => "Other Settings",
                            "description"               => __( "", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "nouislider",
                            "heading"                   => __( "Margin Top", "js_composer" ),
                            "param_name"                => "margin_top",
                            "value"                     => "0",
                            "min"                       => "0",
                            "max"                       => "200",
                            "step"                      => "1",
                            "unit"                      => 'px',
                            "description"               => __( "", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "nouislider",
                            "heading"                   => __( "Margin Bottom", "js_composer" ),
                            "param_name"                => "margin_bottom",
                            "value"                     => "0",
                            "min"                       => "0",
                            "max"                       => "200",
                            "step"                      => "1",
                            "unit"                      => 'px',
                            "description"               => __( "", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "textfield",
                            "heading"                   => __( "Define ID Name", "js_composer" ),
                            "param_name"                => "el_id",
                            "value"                     => "",
                            "description"               => __( "Enter an unique ID for the Testimonial Slider.", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "textfield",
                            "heading"                   => __( "Extra Class Name", "js_composer" ),
                            "param_name"                => "el_class",
                            "value"                     => "",
                            "description"               => __( "Enter a class name for the Testimonial Slider.", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        // Load Custom CSS/JS File
                        array(
                            "type"                      => "load_file",
                            "heading"                   => __( "", "js_composer" ),
                            "param_name"                => "el_file",
                            "value"                     => "",
                            "file_type"                 => "js",
                            "file_path"                 => "js/ts-visual-composer-extend-element.min.js",
                            "description"               => __( "", "js_composer" )
                        ),
                    ),
                    "js_view"                           => 'VcColumnView'
                ));
            }
            // Add Testimonials Slider 2 (by Categroies)
            if (function_exists('vc_map')) {
                vc_map( array(
                   "name"                               => __("TS Testimonials Slider 2", "js_composer"),
                   "base"                               => "TS_VCSC_Testimonial_Slider_Category",
                   "class"                              => "",
                   "icon"                               => "icon-wpb-ts_vcsc_testimonial_slider_category",
                   "category"                           => __("VC Extensions", "js_composer"),
                   "description"                        => __("Place a Testimonial Slider (by Category)", "js_composer"),
                   "params"                             => array(
                        // Slider Settings
                        array(
                            "type"                      => "seperator",
                            "heading"                   => __( "", "js_composer" ),
                            "param_name"                => "seperator_1",
                            "value"                     => "Slider Settings",
                            "description"               => __( "", "js_composer" )
                        ),
                        array(
                            "type"                      => "testimonialcat",
                            "heading"                   => __( "Testimonial Categories", "js_composer" ),
                            "param_name"                => "testimonialcat",
                            "posttype"                  => "ts_testimonials",
                            "taxonomy"                  => "ts_testimonials_category",
                            "value"                     => "",
                            "description"               => __( "Please select the testimonial categories you want to use for the slider.", "js_composer" )
                        ),
                        array(
                            "type"                      => "dropdown",
                            "heading"                   => __( "Design", "js_composer" ),
                            "param_name"                => "style",
                            "value"                     => array(
                                __( 'Style 1', "js_composer" )          => "style1",
                                __( 'Style 2', "js_composer" )          => "style2",
                                __( 'Style 3', "js_composer" )          => "style3",
                            ),
                            "description"               => __( "", "js_composer" ),
                            "admin_label"               => true,
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Auto-Height", "js_composer" ),
                            "param_name"                => "auto_height",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "admin_label"		        => true,
                            "description"               => __( "Switch the toggle if you want the slider to auto-adjust its height.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Auto-Play", "js_composer" ),
                            "param_name"                => "auto_play",
                            "value"                     => "false",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "admin_label"		        => true,
                            "description"               => __( "Switch the toggle if you want the auto-play the slider on page load.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Show Progressbar", "js_composer" ),
                            "param_name"                => "show_bar",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show a progressbar during auto-play.", "js_composer" ),
                            "dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
                        ),
                        array(
                            "type"                      => "colorpicker",
                            "heading"                   => __( "Progressbar Color", "js_composer" ),
                            "param_name"                => "bar_color",
                            "value"                     => "#dd3333",
                            "description"               => __( "Define the color of the animated progressbar.", "js_composer" ),
                            "dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
                        ),
                        array(
                            "type"                      => "nouislider",
                            "heading"                   => __( "Auto-Play Speed", "js_composer" ),
                            "param_name"                => "show_speed",
                            "value"                     => "5000",
                            "min"                       => "1000",
                            "max"                       => "20000",
                            "step"                      => "100",
                            "unit"                      => 'ms',
                            "description"               => __( "Define the speed used to auto-play the slider.", "js_composer" ),
                            "dependency" 				=> array("element" 	=> "auto_play","value" 	=> "true"),
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Stop on Hover", "js_composer" ),
                            "param_name"                => "stop_hover",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want the stop the auto-play while hovering over the slider.", "js_composer" ),
                            "dependency"                => array( 'element' => "auto_play", 'value' => 'true' )
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Show Navigation", "js_composer" ),
                            "param_name"                => "show_navigation",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show left/right navigation buttons for the slider.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"                      => "dropdown",
                            "heading"                   => __( "Transition", "js_composer" ),
                            "param_name"                => "transitions",
                            "width"                     => 150,
                            "value"                     => array(
                                __( 'Back Slide', "js_composer" )		    => "backSlide",
                                __( 'Go Down', "js_composer" )		        => "goDown",
                                __( 'Fade Up', "js_composer" )		        => "fadeUp",
                                __( 'Simple Fade', "js_composer" )		    => "fade",
                            ),
                            "description"               => __( "Select how to transition between the individual slides.", "js_composer" ),
                            "admin_label"		        => true,
                        ),
                        // Other Settings
                        array(
                            "type"                      => "seperator",
                            "heading"                   => __( "", "js_composer" ),
                            "param_name"                => "seperator_2",
                            "value"                     => "Other Settings",
                            "description"               => __( "", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "nouislider",
                            "heading"                   => __( "Margin Top", "js_composer" ),
                            "param_name"                => "margin_top",
                            "value"                     => "0",
                            "min"                       => "0",
                            "max"                       => "200",
                            "step"                      => "1",
                            "unit"                      => 'px',
                            "description"               => __( "", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "nouislider",
                            "heading"                   => __( "Margin Bottom", "js_composer" ),
                            "param_name"                => "margin_bottom",
                            "value"                     => "0",
                            "min"                       => "0",
                            "max"                       => "200",
                            "step"                      => "1",
                            "unit"                      => 'px',
                            "description"               => __( "", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "textfield",
                            "heading"                   => __( "Define ID Name", "js_composer" ),
                            "param_name"                => "el_id",
                            "value"                     => "",
                            "description"               => __( "Enter an unique ID for the Testimonial Slider.", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        array(
                            "type"                      => "textfield",
                            "heading"                   => __( "Extra Class Name", "js_composer" ),
                            "param_name"                => "el_class",
                            "value"                     => "",
                            "description"               => __( "Enter a class name for the Testimonial Slider.", "js_composer" ),
							"group" 			        => "Other Settings",
                        ),
                        // Load Custom CSS/JS File
                        array(
                            "type"                      => "load_file",
                            "heading"                   => __( "", "js_composer" ),
                            "param_name"                => "el_file",
                            "value"                     => "",
                            "file_type"                 => "js",
                            "file_path"                 => "js/ts-visual-composer-extend-element.min.js",
                            "description"               => __( "", "js_composer" )
                        ),
                    ),
                ));
            }

		}
	}
}
// Register Container and Child Shortcode with Visual Composer
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_TS_VCSC_Testimonial_Slider_Custom extends WPBakeryShortCodesContainer {}
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_TS_VCSC_Testimonial_Single extends WPBakeryShortCode {}
}
// Initialize "TS Testimonials" Class
if (class_exists('TS_Testimonials')) {
	$TS_Testimonials = new TS_Testimonials;
}