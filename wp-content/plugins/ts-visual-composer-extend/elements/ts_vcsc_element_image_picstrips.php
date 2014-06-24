<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                          => __( "TS Image PicStrips", 'js_composer' ),
            "base"                          => "TS-VCSC-Image-Picstrips",
            "icon"                          => "icon-wpb-ts_vcsc_image_picstrips",
            "class"                         => "",
            "category"                      => __( "VC Extensions", "js_composer" ),
            "description" 		            => __("Place an image with PicStrips effects", "js_composer"),
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
                    "heading"               => __( "Image", "js_composer" ),
                    "param_name"            => "image",
                    "value"                 => "",
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
                // Image Dimensions
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_2",
                    "value"                 => "Image Dimensions",
                    "description"           => __( "", "js_composer" )
                ),
				
                // Image Styles
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_3",
                    "value"                 => "Image Split Styles",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Number of Splits", "js_composer" ),
                    "param_name"            => "splits_number",
                    "value"                 => "8",
                    "min"                   => "4",
                    "max"                   => "20",
                    "step"                  => "1",
                    "unit"                  => '',
                    "admin_label"           => true,
                    "description"           => __( "Select the number of splits for your image.", "js_composer" )
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Space between Splits", "js_composer" ),
                    "param_name"            => "splits_space",
                    "value"                 => "5",
                    "min"                   => "1",
                    "max"                   => "50",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "Define the space in px between each split for your image.", "js_composer" )
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Offset for Splits", "js_composer" ),
                    "param_name"            => "splits_offset",
                    "value"                 => "10",
                    "min"                   => "0",
                    "max"                   => "100",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "Define the top / bottom offset in px for each split for your image.", "js_composer" )
                ),
				array(
					"type"                  => "colorpicker",
					"heading"               => __( "Splits Background Color", "js_composer" ),
					"param_name"            => "splits_background",
					"value"                 => "#ffffff",
					"description"           => __( "Define the background color for the splits for your image.", "js_composer" ),
					"dependency"            => ""
				),
                // Lightbox Settings
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_4",
                    "value"                 => "Lightbox Settings",
                    "description"           => __( "", "js_composer" )
                ),
				array(
					"type"             	 	=> "switch",
					"heading"			    => __( "Create AutoGroup", "js_composer" ),
					"param_name"		    => "lightbox_group",
					"value"				    => "true",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
                    "description"       	=> __( "Switch the toggle if you want the plugin to group this image with all other non-gallery images on the page.", "js_composer" ),
                    "dependency"        	=> ""
				),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Group Name", "js_composer" ),
                    "param_name"            => "lightbox_group_name",
                    "value"                 => "",
                    "admin_label"           => true,
                    "description"           => __( "Enter a custom group name to manually build group with other non-gallery items.", "js_composer" ),
                    "dependency"            => array( 'element' => "lightbox_group", 'value' => 'false' )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Transition Effect", "js_composer" ),
                    "param_name"            => "lightbox_effect",
                    "width"                 => 150,
                    "value"                 => array(
                        __( 'Random', "js_composer" )       => "random",
                        __( 'Swipe', "js_composer" )        => "swipe",
                        __( 'Fade', "js_composer" )         => "fade",
                        __( 'Scale', "js_composer" )        => "scale",
                        __( 'Slide Up', "js_composer" )     => "slideUp",
                        __( 'Slide Down', "js_composer" )   => "slideDown",
                        __( 'Flip', "js_composer" )         => "flip",
                        __( 'Skew', "js_composer" )         => "skew",
                        __( 'Bounce Up', "js_composer" )    => "bounceUp",
                        __( 'Bounce Down', "js_composer" )  => "bounceDown",
                        __( 'Break In', "js_composer" )     => "breakIn",
                        __( 'Rotate In', "js_composer" )    => "rotateIn",
                        __( 'Rotate Out', "js_composer" )   => "rotateOut",
                        __( 'Hang Left', "js_composer" )    => "hangLeft",
                        __( 'Hang Right', "js_composer" )   => "hangRight",
                        __( 'Cycle Up', "js_composer" )     => "cicleUp",
                        __( 'Cycle Down', "js_composer" )   => "cicleDown",
                        __( 'Zoom In', "js_composer" )      => "zoomIn",
                        __( 'Throw In', "js_composer" )     => "throwIn",
                        __( 'Fall', "js_composer" )         => "fall",
                        __( 'Jump', "js_composer" )         => "jump",
                    ),
                    "admin_label"           => true,
                    "description"           => __( "Select the transition effect to be used for the image in the lightbox.", "js_composer" ),
                    "dependency"            => ""
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Backlight Effect", "js_composer" ),
                    "param_name"            => "lightbox_backlight",
                    "width"                 => 150,
                    "value"                 => array(
                        __( 'Auto Color', "js_composer" )       => "auto",
                        __( 'Custom Color', "js_composer" )     => "custom",
                        __( 'No Backlight', "js_composer" )     => "hideit",
                    ),
                    "admin_label"           => true,
                    "description"           => __( "Select the backlight effect for the image.", "js_composer" ),
                    "dependency"            => ""
                ),
				array(
					"type"                  => "colorpicker",
					"heading"               => __( "Custom Backlight Color", "js_composer" ),
					"param_name"            => "lightbox_backlight_color",
					"value"                 => "#ffffff",
					"description"           => __( "Define the backlight color for the lightbox image.", "js_composer" ),
					"dependency"            => array( 'element' => "lightbox_backlight", 'value' => 'custom' )
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
                array(
                    "type"			        => "dropdown",
                    "class"			        => "",
                    "heading"               => __( "Tooltip Style", 'js_composer' ),
                    "param_name"	        => "tooltip_style",
                    "value"                 => array(
                        __("Black", "js_composer")                  => "",
                        __("Gray", "js_composer")                   => "ts-simptip-style-gray",
                        __("Green", "js_composer")                  => "ts-simptip-style-green",
                        __("Blue", "js_composer")                   => "ts-simptip-style-blue",
                        __("Red", "js_composer")                    => "ts-simptip-style-red",
                        __("Orange", "js_composer")                 => "ts-simptip-style-orange",
                        __("Yellow", "js_composer")                 => "ts-simptip-style-yellow",
                        __("Purple", "js_composer")                 => "ts-simptip-style-purple",
                        __("Pink", "js_composer")                   => "ts-simptip-style-pink",
                        __("White", "js_composer")                  => "ts-simptip-style-white"
                    ),
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