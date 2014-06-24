<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                          => __( "TS Image Adipoli", 'js_composer' ),
            "base"                          => "TS-VCSC-Image-Adipoli",
            "icon"                          => "icon-wpb-ts_vcsc_image_adipoli",
            "class"                         => "",
            "category"                      => __( "VC Extensions", "js_composer" ),
            "description" 		            => __("Place an image with Adipoli effects", "js_composer"),
            "animation"                     => "",
            //"admin_enqueue_js"            => array(ts_fb_get_resource_url('/js/...')),
            //"admin_enqueue_css"           => array(ts_fb_get_resource_url('/css/...')),
            "params"                        => array(
                // Image Selection
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_1",
                    "value"                 => "Image Selection",
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
                // Image Selection
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
                    "description"           => __( "Define the image width.", "js_composer" ),
					"dependency"            => array( 'element' => "image_responsive", 'value' => 'false' )
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
                    "description"           => __( "Define the image height; image will be scaled to prevent distortion so actual height might be less.", "js_composer" ),
                    "dependency"            => array( 'element' => "image_responsive", 'value' => 'false' )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Height Setting", "js_composer" ),
                    "param_name"            => "image_height_r",
                    "width"                 => 150,
                    "value"                 => array(
                        __( '100% Height Setting', "js_composer" )		=> "height: 100%;",
                        __( 'Auto Height Setting', "js_composer" )     	=> "height: auto;",
                    ),
                    "description"           => __( "Select what CSS height setting should be applied to the image (change only if image height does not display correctly).", "js_composer" ),
                    "dependency"            => array( 'element' => "image_responsive", 'value' => 'true' )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Image Position", "js_composer" ),
                    "param_name"            => "image_position",
                    "width"                 => 300,
                    "value"                 => $this->TS_VCSC_ImageFloat_Type,
                    "description"           => __( "Define how to position the image.", "js_composer" )
                ),
                // Image Styles
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_3",
                    "value"                 => "Image Styles",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Start Style", "js_composer" ),
                    "param_name"            => "adipoli_start",
                    "width"                 => 300,
                    "value"                 => $this->TS_VCSC_AdipoliStart_Type,
                    "admin_label"           => true,
                    "description"           => __( "Select the default style for the image.", "js_composer" )
                ),
                array(
                    "type"                  => "textarea",
                    "class"                 => "",
                    "heading"               => __( "Overlay Text", 'js_composer' ),
                    "param_name"            => "adipoli_text",
                    "value"                 => "",
                    "dependency"            => array( 'element' => "adipoli_start", 'value' => 'overlay' )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Hover Style", "js_composer" ),
                    "param_name"            => "adipoli_hover",
                    "width"                 => 300,
                    "value"                 => $this->TS_VCSC_AdipoliHover_Type,
                    "admin_label"           => true,
                    "description"           => __( "Select the hover style for the image.", "js_composer" )
                ),
				array(
					"type"             	 	=> "switch",
                    "heading"               => __( "Show Adipoli Handle", "js_composer" ),
                    "param_name"            => "adipoli_handle_show",
                    "value"                 => "true",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
                    "description"       	=> __( "Use the toggle to show or hide a handle button below the image.", "js_composer" ),
                    "dependency"        	=> ""
				),
                array(
                    "type"                  => "colorpicker",
                    "heading"               => __( "Handle Color", "js_composer" ),
                    "param_name"            => "adipoli_handle_color",
                    "value"                 => "#0094FF",
                    "description"           => __( "Define the color for the Adipoli handle button.", "js_composer" ),
                    "dependency"            => array( 'element' => "adipoli_handle_show", 'value' => 'true' )
                ),
                // Image Link
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_4",
                    "value"                 => "Image Link",
                    "description"           => __( "", "js_composer" )
                ),
				array(
					"type"             	 	=> "switch",
                    "heading"               => __( "Add Link to Image", "js_composer" ),
                    "param_name"            => "link_apply",
                    "value"                 => "false",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
                    "description"       	=> __( "Switch the toggle if you want to apply a link to the image.", "js_composer" ),
                    "dependency"        	=> ""
				),
                array(
                    "type"                  => "textfield",
                    "class"			        => "",
                    "heading"               => __( "Button: URL", 'js_composer' ),
                    "param_name"	        => "link_url",
                    "value"			        => "",
                    "description"	        => __( "Enter the URL for the image link (start with http://).", 'js_composer' ),
                    "dependency"            => array( 'element' => "link_apply", 'value' => 'true' )
                ),
                array(
                    "type"			        => "dropdown",
                    "class"			        => "",
                    "heading"               => __( "Button: Link Target", 'js_composer' ),
                    "param_name"	        => "link_target",
                    "value"			        => $this->TS_VCSC_Link_Target,
                    "description"	        => __( "Select how the image link should be opened.", 'js_composer' ),
                    "dependency"            => array( 'element' => "link_apply", 'value' => 'true' )
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