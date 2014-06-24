<?php
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
            "name"                           => __("TS Testimonial Slide", 'js_composer'),
            "base"                           => "TS_VCSC_Testimonial_Single",
            "class"                          => "",
            "icon"                           => "icon-wpb-ts_vcsc_testimonial",
            "category"                       => __("VC Extensions", 'js_composer'),
            "content_element"                => true,
            "as_child"                       => array('only' => 'TS_VCSC_Testimonial_Slider_Custom'),
            "description"                    => __("Add a testimonial slide element", "js_composer"),
            "params"                         => array(
                // Testimonial Select
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_1",
                    "value"                 => "Selections",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "testimonial",
                    "heading"               => __( "Testimonial", "js_composer" ),
                    "param_name"            => "testimonial",
                    "posttype"              => "ts_testimonials",
                    "taxonomy"              => "ts_testimonials_category",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "hidden_input",
                    "heading"               => __( "Testimonial", "js_composer" ),
                    "param_name"            => "testimonial_name",
                    "value"                 => "",
                    "admin_label"		    => true,
                    "description"           => __( "", "js_composer" )
                ),
                // Testimonial Design
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_2",
                    "value"                 => "Testimonial Style",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Design", "js_composer" ),
                    "param_name"            => "style",
                    "value"             => array(
                        __( 'Style 1', "js_composer" )          => "style1",
                        __( 'Style 2', "js_composer" )          => "style2",
                        __( 'Style 3', "js_composer" )          => "style3",
                    ),
                    "description"           => __( "", "js_composer" ),
                    "admin_label"           => true,
                    "dependency"            => ""
                ),
                // Load Custom CSS/JS File
                array(
                    "type"                  => "load_file",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "el_file",
                    "value"                 => "",
                    "file_type"             => "js",
                    "file_path"             => "js/ts-visual-composer-extend-element.min.js",
                    "description"           => __( "", "js_composer" )
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
                    "group" 			        => "Other Settings",,
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
?>