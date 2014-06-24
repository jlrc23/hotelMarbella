<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                      => __( "TS Circle Counter", "js_composer" ),
            "base"                      => "TS-VCSC-Circliful",
            "icon" 	                    => "icon-wpb-ts_vcsc_circliful",
            "class"                     => "",
            "category"                  => __( 'VC Extensions', 'js_composer' ),
            "description"               => __("Place a circle counter element", "js_composer"),
            //"admin_enqueue_js"        => array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"       => array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
            "params"                    => array(
                // Circliful Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_1",
                    "value"             => "Circle Counter Settings",
                    "description"       => __( "", "js_composer" )
                ),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Foreground Color", "js_composer" ),
					"param_name"        => "color_foreground",
					"value"             => "#117d8b",
					"description"       => __( "Define the foreground color of the counter.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Background Color", "js_composer" ),
					"param_name"        => "color_background",
					"value"             => "#eeeeee",
					"description"       => __( "Define the background color of the counter.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"				=> "switch",
                    "heading"           => __( "Add Inner Circle Color", "js_composer" ),
                    "param_name"        => "circle_fill",
                    "value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
                    "description"       => __( "Switch the toggle if you want to add a color to the inner circle area.", "js_composer" ),
                    "dependency"        => ""
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Circle Color", "js_composer" ),
					"param_name"        => "circle_inside",
					"value"             => "#ffffff",
					"description"       => __( "Define the color for the inner circle area.", "js_composer" ),
					"dependency"        => array( 'element' => "circle_fill", 'value' => 'true' )
				),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Maximum Circle Size", "js_composer" ),
                    "param_name"        => "circle_maxsize",
                    "value"             => "250",
                    "min"               => "1",
                    "max"               => "1024",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "Define the maximum allowed size of the circle counter; otherwise maximum available column space will be used.", "js_composer" )
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Circle Thickness in px", "js_composer" ),
                    "param_name"        => "circle_thickness",
                    "value"             => "5",
                    "min"               => "1",
                    "max"               => "25",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "Define the thickness of the circle lines.", "js_composer" )
                ),
				array(
					"type"				=> "switch",
                    "heading"           => __( "Show as Half-Circle", "js_composer" ),
                    "param_name"        => "circle_half",
                    "value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
                    "description"       => __( "Switch the toggle if you want to show the circle counter as half-circle.", "js_composer" ),
                    "dependency"        => ""
				),
                // Circliful Values
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_2",
                    "value"             => "Circle Counter Values",
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Animated Value", "js_composer" ),
                    "param_name"        => "circle_percent",
                    "value"             => "15",
                    "min"               => "1",
                    "max"               => "100",
                    "step"              => "1",
                    "unit"              => '%',
					"admin_label"       => true,
                    "description"       => __( "Define the value in percent the circle should animate to.", "js_composer" )
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Animation Speed", "js_composer" ),
                    "param_name"        => "circle_speed",
                    "value"             => "1",
                    "min"               => "0",
                    "max"               => "10",
                    "step"              => "1",
                    "unit"              => '',
                    "description"       => __( "Define the speed of the circle counter animation.", "js_composer" )
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Main Text", "js_composer" ),
                    "param_name"        => "circle_value_text",
                    "value"             => "",
                    "admin_label"       => true,
                    "description"       => __( "Input integer (numeric) value for circle label. If empty 'Animated Value' will be used.", "js_composer" )
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Main Text - Prefix Unit", "js_composer" ),
                    "param_name"        => "circle_value_pre",
                    "value"             => "",
                    "description"       => __( "Enter a prefix (i.e. $) for circle label.", "js_composer" )
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Main Text - Postfix Unit", "js_composer" ),
                    "param_name"        => "circle_value_post",
                    "value"             => "",
                    "description"       => __( "Enter a postfix (i.e. %) for circle label.", "js_composer" )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Thousand Seperator", "js_composer" ),
                    "param_name"        => "circle_value_group",
                    "width"             => 150,
                    "value"             => array(
                        __( 'Comma', "js_composer" )        => ",",
                        __( 'Dot', "js_composer" )          => ".",
                        __( 'Space', "js_composer" )        => " ",
                    ),
                    "description"       => __( "Select a character to seperate thousands in the circle label number.", "js_composer" )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Decimals Seperator", "js_composer" ),
                    "param_name"        => "circle_value_seperator",
                    "width"             => 150,
                    "value"             => array(
						__( 'Dot', "js_composer" )          => ".",
                        __( 'Comma', "js_composer" )        => ",",
                        __( 'Space', "js_composer" )        => " ",
                    ),
                    "description"       => __( "Select a character to seperate thousands in the circle label number.", "js_composer" )
                ),
                /*array(
                    "type"              => "nouislider",
                    "heading"           => __( "Number of Decimals", "js_composer" ),
                    "param_name"        => "circle_value_decimals",
                    "value"             => "0",
                    "min"               => "0",
                    "max"               => "4",
                    "step"              => "1",
                    "unit"              => '',
                    "description"       => __( "Define the number of decimals for the circle label number.", "js_composer" )
                ),*/
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Info Text", "js_composer" ),
                    "param_name"        => "circle_value_info",
                    "value"             => "",
                    "admin_label"       => true,
                    "description"       => __( "Enter the inner circle info text; usually what the animated value represents.", "js_composer" )
                ),
				// Circliful Icon
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_3",
                    "value"             => "Circle Counter Icon",
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "icons_panel",
                    "heading"           => __( "Select Icon", "js_composer" ),
                    "param_name"        => "circle_icon",
                    "value"             => $this->TS_VCSC_List_Icons_Full,
                    "admin_label"       => true,
                    "description"       => __( "Select the an icon for the circle counter.", "js_composer" ),
                    "dependency"        => ""
                ),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon Color", "js_composer" ),
					"param_name"        => "circle_icon_color",
					"value"             => "#eeeeee",
					"description"       => __( "Define the color for the circle icon.", "js_composer" ),
					"dependency"        => ""
				),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Icon Position", "js_composer" ),
                    "param_name"        => "circle_icon_position",
                    "width"             => 150,
                    "value"             => array(
                        __( 'Left', "js_composer" )     => "left",
                        __( 'Right', "js_composer" )    => "right",
					),
                    "description"       => __( "Select how to position the icon in relation to the main text.", "js_composer" ),
                    "dependency"        => ""
                ),
				// Other Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_4",
					"value"             => "Other Settings",
					"description"       => __( "", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Margin Top", "js_composer" ),
					"param_name"        => "margin_top",
					"value"             => "0",
					"min"               => "-50",
					"max"               => "200",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Select the top margin for the circle counter element.", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Margin Bottom", "js_composer" ),
					"param_name"        => "margin_bottom",
					"value"             => "0",
					"min"               => "-50",
					"max"               => "200",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Select the bottom margin for the circle counter element.", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Define ID Name", "js_composer" ),
					"param_name"        => "el_id",
					"value"             => "",
					"description"       => __( "Enter a unique ID name for the circle counter element.", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Extra Class Name", "js_composer" ),
					"param_name"        => "el_class",
					"value"             => "",
					"description"       => __( "Enter a class name for the circle counter element.", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				// Load Custom CSS/JS File
				array(
					"type"              => "load_file",
					"heading"           => __( "", "js_composer" ),
                    "param_name"        => "el_file",
					"value"             => "",
					"file_type"         => "js",
					"file_path"         => "js/ts-visual-composer-extend-element.min.js",
					"description"       => __( "", "js_composer" )
				),
            ))
        );
    }
?>