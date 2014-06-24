<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                          => __( "TS Lightbox Image", "js_composer" ),
            "base"                          => "TS-VCSC-Lightbox-Image",
            "icon" 	                        => "icon-wpb-ts_vcsc_lightbox_image",
            "class"                         => "",
            "category"                      => __( 'VC Extensions', 'js_composer' ),
            "description"                   => __("Place an image in a lightbox element", "js_composer"),
            "admin_enqueue_js"              => "",
            "admin_enqueue_css"             => "",
            "params"                        => array(
                // Single Image Content
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_1",
                    "value"                 => "Lightbox Image",
                    "description"           => __( "", "js_composer" )
                ),
				array(
					"type"                  => "attach_image",
					"heading"               => __( "Select Image", "js_composer" ),
					"param_name"            => "content_image",
					"value"                 => "",
                    "admin_label"           => true,
					"description"           => __( "Select the image for your lightbox.", "js_composer" ),
					"dependency"            => array( 'element' => "content_type", 'value' => 'image' )
				),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Enter TITLE Attribute", "js_composer" ),
                    "param_name"            => "content_title",
                    "value"                 => "",
                    "admin_label"           => true,
                    "description"           => __( "Enter a title for the lightbox image.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_type", 'value' => 'image' )
                ),
				array(
					"type"              	=> "switch",
					"heading"			    => __( "Add Custom ALT Attribute", "js_composer" ),
					"param_name"		    => "attribute_alt",
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
                    "heading"               => __( "Enter ALT Attribute", "js_composer" ),
                    "param_name"            => "attribute_alt_value",
                    "value"                 => "",
                    "description"           => __( "Enter a custom value for the ALT attribute for this image.", "js_composer" ),
                    "dependency"            => array( 'element' => "attribute_alt", 'value' => 'true' )
                ),
				array(
					"type"              	=> "switch",
					"heading"			    => __( "Responsive Image", "js_composer" ),
					"param_name"		    => "content_image_responsive",
					"value"				    => "true",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"		    => __( "Switch the toggle if you want to use a responsive image size.", "js_composer" ),
					"dependency"        	=> ""
				),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Auto Height Setting", "js_composer" ),
                    "param_name"            => "content_image_height",
                    "width"                 => 150,
                    "value"                 => array(
                        __( '100% Height Setting', "js_composer" )		=> "height: 100%;",
                        __( 'Auto Height Setting', "js_composer" )     	=> "height: auto;",
                    ),
                    "description"           => __( "Select what CSS height setting should be applied to the image (change only if image height does not display correctly).", "js_composer" ),
                    "dependency"            => ""
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Image Width", "js_composer" ),
                    "param_name"            => "content_image_width_r",
                    "value"                 => "100",
                    "min"                   => "1",
                    "max"                   => "100",
                    "step"                  => "1",
                    "unit"                  => '%',
                    "description"           => __( "Define the image width in percent (%).", "js_composer" ),
                    "dependency"            => array( 'element' => "content_image_responsive", 'value' => 'true' )
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Image Width", "js_composer" ),
                    "param_name"            => "content_image_width_f",
                    "value"                 => "300",
                    "min"                   => "1",
                    "max"                   => "1980",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "Define the image width in pixel (px).", "js_composer" ),
                    "dependency"            => array( 'element' => "content_image_responsive", 'value' => 'false' )
                ),
                // Lightbox Settings
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_2",
                    "value"                 => "Lightbox Settings",
                    "description"           => __( "", "js_composer" )
                ),
				array(
					"type"              	=> "switch",
					"heading"			    => __( "Create AutoGroup", "js_composer" ),
					"param_name"		    => "lightbox_group",
					"value"				    => "true",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"		    => __( "Switch the toggle if you want the plugin to group this image with all other non-gallery images on the page.", "js_composer" ),
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
				// Other Settings
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_3",
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
                    "description"           => __( "", "js_composer" ),
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
                    "description"           => __( "", "js_composer" ),
					"group" 				=> "Other Settings",
                ),
				array(
					"type"                  => "textfield",
					"heading"               => __( "Define ID Name", "js_composer" ),
					"param_name"            => "el_id",
					"value"                 => "",
					"description"           => __( "Enter a unique ID name for the icon element.", "js_composer" ),
					"group" 				=> "Other Settings",
				),
				array(
					"type"                  => "textfield",
					"heading"               => __( "Extra Class Name", "js_composer" ),
					"param_name"            => "el_class",
					"value"                 => "",
					"description"           => __( "Enter a class name for the icon element.", "js_composer" ),
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
            ))
        );
    }
?>