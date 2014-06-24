<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                          => __( "TS Image Caman", 'js_composer' ),
            "base"                          => "TS-VCSC-Image-Caman",
            "icon"                          => "icon-wpb-ts_vcsc_image_caman",
            "class"                         => "",
            "category"                      => __( "VC Extensions", "js_composer" ),
            "description" 		            => __("Place an image with Caman effects", "js_composer"),
            "animation"                     => "",
            //"admin_enqueue_js"            => array(ts_fb_get_resource_url('/js/...')),
            //"admin_enqueue_css"           => array(ts_fb_get_resource_url('/css/...')),
            "params"                        => array(
                // Image Selection and Dimensions
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_1",
                    "value"                 => "Image Selection / Dimensions",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "attach_image",
                    "heading"               => __( "Image", "js_composer" ),
                    "param_name"            => "image",
                    "value"                 => "false",
                    "admin_label"           => true,
                    "description"           => __( "Select the image you want to use.", "js_composer" )
                ),
				array(
					"type"             	 	=> "switch",
					"heading"			    => __( "Add Custom ALT Attribute", "js_composer" ),
					"param_name"		    => "attribute_alt",
					"value"				    => "false",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
                    "description"       	=> __( "Switch the toggle if you want add a custom ALT attribute value, otherwise file name will be set.", "js_composer" ),
                    "dependency"        	=> ""
				),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Enter ALT Value", "js_composer" ),
                    "param_name"            => "attribute_alt_value",
                    "value"                 => "",
                    "description"           => __( "Enter a custom value for the ALT attribute for this image.", "js_composer" ),
                    "dependency"            => array( 'element' => "attribute_alt", 'value' => 'true' )
                ),
                /*array(
                    "type"                  => "toggle",
                    "heading"               => __( "Use Fixed Image Dimensions", "js_composer" ),
                    "param_name"            => "image_fixed",
                    "value"                 => "true",
                    "description"           => __( "Switch the toggle if you want to use a responsive width in % instead of px.", "js_composer" )
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Image Width", "js_composer" ),
                    "param_name"            => "image_width_percent",
                    "value"                 => "100",
                    "min"                   => "1",
                    "max"                   => "100",
                    "step"                  => "1",
                    "unit"                  => '%',
                    "description"           => __( "Define the image width in %.", "js_composer" ),
                    "dependency"            => array( 'element' => "image_fixed", 'value' => 'false' )
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Image Width", "js_composer" ),
                    "param_name"            => "image_width",
                    "value"                 => "300",
                    "min"                   => "100",
                    "max"                   => "1000",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "Define the image width.", "js_composer" ),
                    "dependency"            => array( 'element' => "image_fixed", 'value' => 'true' )
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Image Height", "js_composer" ),
                    "param_name"            => "image_height",
                    "value"                 => "200",
                    "min"                   => "75",
                    "max"                   => "750",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "Define the image height.", "js_composer" ),
                    "dependency"            => array( 'element' => "image_fixed", 'value' => 'true' )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Image Position", "js_composer" ),
                    "param_name"            => "image_position",
                    "width"                 => 300,
                    "value"                 => $this->TS_VCSC_ImageFloat_Type,
                    "description"           => __( "Define how to position the image.", "js_composer" )
                ),*/
                // Image Styles
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_2",
                    "value"                 => "Image Effect",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Effect", "js_composer" ),
                    "param_name"            => "caman_effect",
                    "width"                 => 150,
                    "admin_label"           => true,
                    "value"                 => array(
                        __( 'Vintage', "js_composer" )          => "vintage",
                        __( 'Lomo', "js_composer" )             => "lomo",
                        __( 'Clarity', "js_composer" )          => "clarity",
                        __( 'Sin City', "js_composer" )         => "sinCity",
                        __( 'Sunrise', "js_composer" )          => "sunrise",
                        __( 'Cross Process', "js_composer" )    => "crossProcess",
                        __( 'Orange Peel', "js_composer" )      => "orangePeel",
                        __( 'Love', "js_composer" )             => "love",
                        __( 'Grungy', "js_composer" )           => "grungy",
                        __( 'Jarques', "js_composer" )          => "jarques",
                        __( 'Pin Hole', "js_composer" )         => "pinhole",
                        __( 'Old Boot', "js_composer" )         => "oldBoot",
                        __( 'Glowing Sun', "js_composer" )      => "glowingSun",
                        __( 'Hazy Days', "js_composer" )        => "hazyDays",
                        __( 'Her Majesty', "js_composer" )      => "herMajesty",
                        __( 'Nostalgia', "js_composer" )        => "nostalgia",
                        __( 'Hemingway', "js_composer" )        => "hemingway",
                        __( 'Concentrate', "js_composer" )      => "concentrate",
                        __( 'Emboss', "js_composer" )           => "emboss",
                        __( 'Grayscale', "js_composer" )        => "greyscale",
                        __( 'Invert', "js_composer" )           => "invert",
                    ),
                    "description"           => __( "Select the effect you want to apply to the image.", "js_composer" )
                ),
				array(
					"type"             	 	=> "switch",
					"heading"			    => __( "Allow for Switch Effekt", "js_composer" ),
					"param_name"		    => "caman_switch_allow",
					"value"				    => "true",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"admin_label"           => true,
                    "description"       	=> __( "Switch the toggle if you want to provide a switch option between the Caman and the Original image.", "js_composer" ),
                    "dependency"        	=> ""
				),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Switch Style", "js_composer" ),
                    "param_name"            => "caman_switch_type",
                    "width"                 => 300,
                    "value"                 => array(
                        __( 'Flip', "js_composer" )             => "ts-imageswitch-flip",
                        __( 'Fade', "js_composer" )             => "ts-imageswitch-fade",
                    ),
                    "description"           => __( "Define how the two images should be switched out.", "js_composer" ),
					"dependency"            => array( 'element' => "caman_switch_allow", 'value' => 'true' )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Trigger Type", "js_composer" ),
                    "param_name"            => "caman_trigger_flip",
                    "width"                 => 300,
                    "value"                 => $this->TS_VCSC_Trigger_Type,
                    "description"           => __( "Define how to trigger the image switch.", "js_composer" ),
                    "dependency"            => array( 'element' => "caman_switch_type", 'value' => 'ts-imageswitch-flip' )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Trigger Type", "js_composer" ),
                    "param_name"            => "caman_trigger_fade",
                    "width"                 => 300,
                    "value"                 => $this->TS_VCSC_Trigger_Type,
                    "description"           => __( "Define how to trigger the image switch.", "js_composer" ),
                    "dependency"            => array( 'element' => "caman_switch_type", 'value' => 'ts-imageswitch-fade' )
                ),
				array(
					"type"             	 	=> "switch",
                    "heading"               => __( "Show Caman Handle", "js_composer" ),
                    "param_name"            => "caman_handle_show",
                    "value"                 => "true",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
                    "description"       	=> __( "Use the toggle to show or hide a handle button below the image.", "js_composer" ),
                    "dependency"            => array( 'element' => "caman_switch_allow", 'value' => 'true' )
				),
                array(
                    "type"                  => "colorpicker",
                    "heading"               => __( "Handle Color", "js_composer" ),
                    "param_name"            => "caman_handle_color",
                    "value"                 => "#0094FF",
                    "description"           => __( "Define the color for the Caman handle button.", "js_composer" ),
                    "dependency"            => array( 'element' => "caman_handle_show", 'value' => 'true' )
                ),
                // Image Tooltip
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_5",
                    "value"                 => "Image Tooltip",
                    "description"           => __( "", "js_composer" )
                ),
				array(
					"type"             	 	=> "switch",
                    "heading"               => __( "Use CSS3 Tooltip", "js_composer" ),
                    "param_name"            => "tooltip_css",
                    "value"                 => "false",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
                    "description"       	=> __( "Switch the toggle if you want to apply a CSS3 tooltip to the image.", "js_composer" ),
                    "dependency"        	=> ""
				),
                array(
                    "type"                  => "textarea",
                    "class"                 => "",
                    "heading"               => __( "Tooltip Content", 'js_composer' ),
                    "param_name"            => "tooltip_content",
                    "value"                 => "",
                    "description"           => __( "Enter the tooltip content here (do not use quotation marks).", "js_composer" ),
                    "dependency"            => ""
                ),
                /*array(
                    "type"			        => "dropdown",
                    "class"			        => "",
                    "heading"               => __( "Tooltip Position", 'js_composer' ),
                    "param_name"	        => "tooltip_position",
                    "value"			        => $this->TS_VCSC_ImageTooltip_Position,
                    "description"           => __( "Select the tooltip position in relation to the image.", "js_composer" ),
                    "dependency"            => array( 'element' => "tooltip_css", 'value' => 'true' )
                ),*/
                array(
                    "type"			        => "dropdown",
                    "class"			        => "",
                    "heading"               => __( "Tooltip Style", 'js_composer' ),
                    "param_name"	        => "tooltip_style",
                    "value"			        => $this->TS_VCSC_Tooltip_Style,
                    "description"           => __( "Select the tooltip style.", "js_composer" ),
                    "dependency"            => array( 'element' => "tooltip_css", 'value' => 'true' )
                ),
                // Other Settings
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_6",
                    "value"                 => "Other Settings",
                    "description"           => __( "", "js_composer" ),
					"group" 				=> "Other Settings",
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Margin Top", "js_composer" ),
                    "param_name"            => "margin_top",
                    "value"                 => "0",
                    "min"                   => "0",
                    "max"                   => "200",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "Select the top margin for your image.", "js_composer" ),
					"group" 				=> "Other Settings",
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Margin Bottom", "js_composer" ),
                    "param_name"            => "margin_bottom",
                    "value"                 => "0",
                    "min"                   => "0",
                    "max"                   => "200",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "Select the bottom margin for your image.", "js_composer" ),
					"group" 				=> "Other Settings",
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Define ID Name", "js_composer" ),
                    "param_name"            => "el_id",
                    "value"                 => "",
                    "description"           => __( "Enter an unique ID for the image.", "js_composer" ),
					"group" 				=> "Other Settings",
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Extra Class Name", "js_composer" ),
                    "param_name"            => "el_class",
                    "value"                 => "",
                    "description"           => __( "Enter a class name for the image.", "js_composer" ),
					"group" 				=> "Other Settings",
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
            )
        ));
    }
?>