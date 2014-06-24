<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                          => __( "TS Vimeo Video", "js_composer" ),
            "base"                          => "TS-VCSC-Vimeo",
            "icon" 	                        => "icon-wpb-ts_vcsc_vimeo",
            "class"                         => "",
            "category"                      => __( 'VC Extensions', 'js_composer' ),
            "description"                   => __("Place a Vimeo Video", "js_composer"),
            "admin_enqueue_js"              => "",
            "admin_enqueue_css"             => "",
            "params"                        => array(
                // Vimeo Video
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_1",
                    "value"                 => "Vimeo Video",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Vimeo Video URL", "js_composer" ),
                    "param_name"            => "content_vimeo",
                    "value"                 => "",
                    "admin_label"           => true,
                    "description"           => __( "Enter the URL for the Vimeo video.", "js_composer" ),
                    "dependency"            => ""
                ),
				array(
					"type"              	=> "switch",
					"heading"           	=> __( "Open in Lightbox", "js_composer" ),
					"param_name"        	=> "content_lightbox",
					"value"             	=> "true",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"       	=> __( "Switch the toggle to show the video in a lightbox.", "js_composer" ),
					"dependency"        	=> ""
				),
                // Triggger Type
				array(
					"type"                  => "dropdown",
					"heading"               => __( "Trigger Type", "js_composer" ),
					"param_name"            => "content_vimeo_trigger",
                    "value"                 => array(
                        __("Vimeo Cover", "js_composer")            => "preview",
                        __("Default Image", "js_composer")          => "default",
                        __("Custom Image", "js_composer")           => "image",
                        __("Font Icon", "js_composer")              => "icon",
                        __("Winged Button", "js_composer")          => "winged",
                        __("Simple Button", "js_composer")          => "simple",
                        __("Text", "js_composer")                   => "text",
                        __("Custom HTML", "js_composer")            => "custom",
                    ),
					"description"           => __( "Select the type of trigger to click on in order to show the lightbox.", "js_composer" ),
					"dependency"            => array( 'element' => "content_lightbox", 'value' => 'true' )
				),
                // Custom Image
				array(
					"type"                  => "attach_image",
					"heading"               => __( "Select Image", "js_composer" ),
					"param_name"            => "content_vimeo_image",
					"value"                 => "",
					"description"           => __( "Select the preview image for the lightbox content.", "js_composer" ),
					"dependency"            => array( 'element' => "content_vimeo_trigger", 'value' => 'image' )
				),
				array(
					"type"              	=> "switch",
					"heading"			    => __( "Simple Image Only", "js_composer" ),
					"param_name"		    => "content_vimeo_image_simple",
					"value"             	=> "false",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"		    => __( "Switch the toggle if you want display just the image without any styling.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_vimeo_trigger", 'value' => 'image' )
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
                    "dependency"            => array( 'element' => "content_vimeo_trigger", 'value' => array('preview', 'default', 'image') )
                ),
                // Font Icon
				array(
					"type"                  => "icons_panel",
					"heading"               => __( "Select Icon", "js_composer" ),
					"param_name"            => "content_vimeo_icon",
					"value"                 => $this->TS_VCSC_List_Icons_Full,
					"description"           => __( "Select the icon you want to display.", "js_composer" ),
					"dependency"            => array( 'element' => "content_vimeo_trigger", 'value' => 'icon' )
				),
				array(
					"type"                  => "nouislider",
					"heading"               => __( "Icon Size", "js_composer" ),
					"param_name"            => "content_vimeo_iconsize",
					"value"                 => "30",
					"min"                   => "16",
					"max"                   => "512",
					"step"                  => "1",
					"unit"                  => 'px',
					"description"           => __( "Select the icon / image size", "js_composer" ),
					"dependency"            => array( 'element' => "content_vimeo_trigger", 'value' => 'icon' )
				),
				array(
					"type"                  => "colorpicker",
					"heading"               => __( "Icon Color", "js_composer" ),
					"param_name"            => "content_vimeo_iconcolor",
					"value"                 => "#cccccc",
					"description"           => __( "Define the color of the icon.", "js_composer" ),
					"dependency"            => array( 'element' => "content_vimeo_trigger", 'value' => 'icon' )
				),
                // Button
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Button Text", "js_composer" ),
                    "param_name"            => "content_vimeo_buttontext",
                    "value"                 => "View Video",
                    "description"           => __( "Enter the text for the button.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_vimeo_trigger", 'value' => array('winged', 'simple') )
                ),
                // Text Link
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Trigger Text", "js_composer" ),
                    "param_name"            => "content_vimeo_text",
                    "value"                 => "",
                    "description"           => __( "Enter the trigger text for the video.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_vimeo_trigger", 'value' => 'text' )
                ),
                // Custom Code
                array(
                    "type"                  => "textarea_raw_html",
                    "holder"                => "div",
                    "heading"               => __("Raw HTML", "js_composer"),
                    "param_name"            => "content_raw",
                    "value"                 => base64_encode(""),
                    "description"           => __("Enter your custom HTML code; code will be wrapped in appropriate link automatically.", "js_composer"),
                    "dependency"            => array( 'element' => "content_vimeo_trigger", 'value' => 'custom' )
                ),
                // Title + Subtitle
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Title", "js_composer" ),
                    "param_name"            => "content_vimeo_title",
                    "value"                 => "",
                    "description"           => __( "Enter a title for the lightbox content.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_vimeo_trigger", 'value' => array('image', 'default', 'preview', 'winged') )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Subtitle", "js_composer" ),
                    "param_name"            => "content_vimeo_subtitle",
                    "value"                 => "",
                    "description"           => __( "Enter a subtitle for the lightbox content.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_vimeo_trigger", 'value' => array('winged') )
                ),
                // Lightbox Settings
				array(
					"type"				    => "seperator",
					"heading"			    => __( "", "js_composer" ),
					"param_name"		    => "seperator_2",
					"value"				    => "Lightbox Settings",
					"description"		    => __( "", "js_composer" ),
					"dependency"            => array( 'element' => "content_lightbox", 'value' => "true" )
				),
				array(
					"type"              	=> "switch",
					"heading"			    => __( "Autoplay Video", "js_composer" ),
					"param_name"		    => "lightbox_play",
					"value"             	=> "false",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"		    => __( "Switch the toggle if you want to auto-play the video once opened in the lightbox.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_lightbox", 'value' => "true" )
				),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Group Name", "js_composer" ),
                    "param_name"            => "lightbox_group_name",
                    "value"                 => "nachogroup",
                    "description"           => __( "Enter a custom group name to manually build group with other non-gallery items; leave empty for non-grouping", "js_composer" ),
                    "dependency"            => array( 'element' => "content_lightbox", 'value' => "true" )
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
                    "dependency"            => array( 'element' => "content_lightbox", 'value' => "true" )
                ),
                // Tooltip Settings
				array(
					"type"				    => "seperator",
					"heading"			    => __( "", "js_composer" ),
					"param_name"		    => "seperator_3",
					"value"				    => "Tooltip",
					"description"		    => __( "", "js_composer" ),
					"dependency"            => array( 'element' => "content_lightbox", 'value' => "true" )
				),
				array(
					"type"              	=> "switch",
					"heading"           	=> __( "Use CSS3 Tooltip", "js_composer" ),
					"param_name"        	=> "content_tooltip_css",
					"value"             	=> "false",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"		    => __( "Switch the toggle if you want to apply a CSS3 tooltip to the video trigger.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_lightbox", 'value' => "true" )
				),
				array(
					"type"				    => "textarea",
					"class"				    => "",
					"heading"			    => __( "Tooltip Content", 'js_composer' ),
					"param_name"		    => "content_tooltip_content",
					"value"				    => "",
					"description"		    => __( "Enter the tooltip content here (do not use quotation marks).", "js_composer" ),
                    "dependency"            => array( 'element' => "content_lightbox", 'value' => "true" )
				),
				array(
					"type"				    => "dropdown",
					"class"				    => "",
					"heading"			    => __( "Tooltip Position", 'js_composer' ),
					"param_name"		    => "content_tooltip_position",
                    "value"                 => array(
                        __("Top", "js_composer")                    => "ts-simptip-position-top",
                        __("Bottom", "js_composer")                 => "ts-simptip-position-bottom",
                    ),
					"description"		    => __( "Select the tooltip position in relation to the image.", "js_composer" ),
					"dependency"		    => array( 'element' => "content_tooltip_css", 'value' => 'true' )
				),
				array(
					"type"				    => "dropdown",
					"class"				    => "",
					"heading"			    => __( "Tooltip Style", 'js_composer' ),
					"param_name"		    => "content_tooltip_style",
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
					"description"		    => __( "Select the tooltip style.", "js_composer" ),
					"dependency"		    => array( 'element' => "content_tooltip_css", 'value' => 'true' )
				),
				// Other Settings
				array(
					"type"				    => "seperator",
					"heading"			    => __( "", "js_composer" ),
					"param_name"		    => "seperator_4",
					"value"				    => "Other Settings",
					"description"		    => __( "", "js_composer" ),
					"group"					=> "Other Settings",
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
					"group"					=> "Other Settings",
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
					"group"					=> "Other Settings",
                ),
				array(
					"type"                  => "textfield",
					"heading"               => __( "Define ID Name", "js_composer" ),
					"param_name"            => "el_id",
					"value"                 => "",
					"description"           => __( "Enter a unique ID name for the video element.", "js_composer" ),
					"group"					=> "Other Settings",
				),
				array(
					"type"                  => "textfield",
					"heading"               => __( "Extra Class Name", "js_composer" ),
					"param_name"            => "el_class",
					"value"                 => "",
					"description"           => __( "Enter a class name for the video element.", "js_composer" ),
					"group"					=> "Other Settings",
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