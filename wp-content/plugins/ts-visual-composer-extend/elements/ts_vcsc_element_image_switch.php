<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                          => __( "TS Image Switch", 'js_composer' ),
            "base"                          => "TS-VCSC-Image-Switch",
            "icon"                          => "icon-wpb-ts_vcsc_image_switch",
            "class"                         => "",
            "category"                      => __( "VC Extensions", "js_composer" ),
            "description" 		        => __("Place two images with switch effect", "js_composer"),
            "animation"                     => "",
            //"admin_enqueue_js"            => array(ts_fb_get_resource_url('/js/...')),
            //"admin_enqueue_css"           => array(ts_fb_get_resource_url('/css/...')),
            "params"                        => array(
                // Image Selections
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_1",
                    "value"                 => "Image Selections",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "attach_image",
                    "heading"               => __( "Front Image", "js_composer" ),
                    "param_name"            => "image_start",
                    "value"                 => "false",
                    "admin_label"           => true,
                    "description"           => __( "Select the front image you want to use.", "js_composer" )
                ),
				array(
					"type"              	=> "switch",
					"heading"			    => __( "Add Custom ALT Attribute to Start Image", "js_composer" ),
					"param_name"		    => "attribute_alt_start",
					"value"				    => "false",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"		    => __( "Switch the toggle if you want add a custom ALT attribute value, otherwise file name will be set.", "js_composer" ),
					"dependency"        	=> ""
				),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Enter ALT Value", "js_composer" ),
                    "param_name"            => "attribute_alt_value_start",
                    "value"                 => "",
                    "description"           => __( "Enter a custom value for the ALT attribute for the start image.", "js_composer" ),
                    "dependency"            => array( 'element' => "attribute_alt_start", 'value' => 'true' )
                ),
                array(
                    "type"                  => "attach_image",
                    "heading"               => __( "Back Image", "js_composer" ),
                    "param_name"            => "image_end",
                    "value"                 => "false",
                    "admin_label"           => true,
                    "description"           => __( "Select the back image you want to use.", "js_composer" )
                ),
				array(
					"type"              	=> "switch",
					"heading"			    => __( "Add Custom ALT Attribute to End Image", "js_composer" ),
					"param_name"		    => "attribute_alt_end",
					"value"				    => "false",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"		    => __( "Switch the toggle if you want add a custom ALT attribute value, otherwise file name will be set.", "js_composer" ),
					"dependency"        	=> ""
				),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Enter ALT Value", "js_composer" ),
                    "param_name"            => "attribute_alt_value_end",
                    "value"                 => "",
                    "description"           => __( "Enter a custom value for the ALT attribute for the end image.", "js_composer" ),
                    "dependency"            => array( 'element' => "attribute_alt_end", 'value' => 'true' )
                ),
                // Image Dimensions
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_2",
                    "value"                 => "Image Dimensions",
                    "description"           => __( "", "js_composer" )
                ),
				array(
					"type"              	=> "switch",
                    "heading"               => __( "Responsive Width", "js_composer" ),
                    "param_name"            => "image_responsive",
                    "value"                 => "false",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"           => __( "Use the toggle if you want to use images with a responsive width (in %).", "js_composer" ),
					"dependency"        	=> ""
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
                    "dependency"            => array( 'element' => "image_responsive", 'value' => 'true' )
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
                    "description"           => __( "Define the image width in px.", "js_composer" ),
                    "dependency"            => array( 'element' => "image_responsive", 'value' => 'false' )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Height Setting", "js_composer" ),
                    "param_name"            => "image_height",
                    "width"                 => 150,
                    "value"                 => array(
                        __( '100% Height Setting', "js_composer" )		=> "height: 100%;",
                        __( 'Auto Height Setting', "js_composer" )     	=> "height: auto;",
                    ),
                    "description"           => __( "Select what CSS height setting should be applied to the image (change only if image height does not display correctly).", "js_composer" ),
                    "dependency"            => ""
                ),
                /*array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Image Height", "js_composer" ),
                    "param_name"            => "image_height",
                    "value"                 => "200",
                    "min"                   => "75",
                    "max"                   => "750",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "Define the image height in px.", "js_composer" ),
                    "dependency"            => array( 'element' => "image_responsive", 'value' => 'false' )
                ),*/
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Image Position", "js_composer" ),
                    "param_name"            => "image_position",
                    "width"                 => 300,
                    "value"                 => $this->TS_VCSC_ImageFloat_Type,
                    "description"           => __( "Define how to position the image.", "js_composer" )
                ),
                // Image Switch Style
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_3",
                    "value"                 => "Image Switch Style",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Switch Style", "js_composer" ),
                    "param_name"            => "switch_type",
                    "width"                 => 300,
                    "value"                 => $this->TS_VCSC_ImageSwitch_Type,
                    "admin_label"           => true,
                    "description"           => __( "Define how the two images should be switched out.", "js_composer" )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Trigger Type", "js_composer" ),
                    "param_name"            => "switch_trigger_flip",
                    "width"                 => 300,
                    "value"                 => $this->TS_VCSC_Trigger_Type,
                    "description"           => __( "Define how to trigger the image switch.", "js_composer" ),
                    "dependency"            => array( 'element' => "switch_type", 'value' => 'ts-imageswitch-flip' )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Trigger Type", "js_composer" ),
                    "param_name"            => "switch_trigger_fade",
                    "width"                 => 300,
                    "value"                 => $this->TS_VCSC_Trigger_Type,
                    "description"           => __( "Define how to trigger the image switch.", "js_composer" ),
                    "dependency"            => array( 'element' => "switch_type", 'value' => 'ts-imageswitch-fade' )
                ),
				array(
					"type"              	=> "switch",
					"heading"			    => __( "Return to Center at Mouse-Out", "js_composer" ),
					"param_name"		    => "switch_handle_center",
					"value"				    => "true",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"		    => __( "Switch the toggle if you want the slide control bar to center itself after mouse-out event.", "js_composer" ),
					"dependency"            => array( 'element' => "switch_type", 'value' => 'ts-imageswitch-slide' )
				),
				array(
					"type"              	=> "switch",
                    "heading"               => __( "Show Switch Handle", "js_composer" ),
                    "param_name"            => "switch_handle_show",
                    "value"                 => "true",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"           => __( "Use the toggle to show or hide a handle button below the image.", "js_composer" ),
					"dependency"        	=> ""
				),
                array(
                    "type"                  => "colorpicker",
                    "heading"               => __( "Handle Color", "js_composer" ),
                    "param_name"            => "switch_handle_color",
                    "value"                 => "#0094FF",
                    "description"           => __( "Define the color for the overlay handle button.", "js_composer" ),
                    "dependency"            => array( 'element' => "switch_handle_show", 'value' => 'true' )
                ),
                // Image Tooltip
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_4",
                    "value"                 => "Image Tooltip",
                    "description"           => __( "", "js_composer" )
                ),
				array(
					"type"              	=> "switch",
                    "heading"               => __( "Use CSS3 Tooltip", "js_composer" ),
                    "param_name"            => "tooltip_css",
                    "value"                 => "false",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"           => __( "Switch the toggle if you want to apply a CSS3 tooltip to the image.", "js_composer" ),
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
                    "type"                  => "dropdown",
                    "class"                 => "",
                    "heading"               => __( "Tooltip Position", 'js_composer' ),
                    "param_name"            => "tooltip_position",
                    "value"                 => $this->TS_VCSC_ImageTooltip_Position,
                    "description"           => __( "Select the tooltip position in relation to the image.", "js_composer" ),
                    "dependency"            => array( 'element' => "tooltip_css", 'value' => 'true' )
                ),*/
                array(
                    "type"					=> "dropdown",
                    "class"					=> "",
                    "heading"               => __( "Tooltip Style", 'js_composer' ),
                    "param_name"	        => "tooltip_style",
                    "value"					=> $this->TS_VCSC_Tooltip_Style,
                    "description"           => __( "Select the tooltip style.", "js_composer" ),
                    "dependency"            => array( 'element' => "tooltip_css", 'value' => 'true' )
                ),
                // Other Settings
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_5",
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