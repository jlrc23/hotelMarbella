<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                          => __( "TS Modal Popup", "js_composer" ),
            "base"                          => "TS-VCSC-Modal-Popup",
            "icon" 	                        => "icon-wpb-ts_vcsc_modal_popup",
            "class"                         => "",
            "category"                      => __( 'VC Extensions', 'js_composer' ),
            "description"                   => __("Place a modal poup element", "js_composer"),
            "admin_enqueue_js"              => "",
            "admin_enqueue_css"             => "",
            "params"                        => array(
                // Modal Settings
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_1",
                    "value"                 => "Modal Popup Settings",
                    "description"           => __( "", "js_composer" )
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
                    "heading"               => __( "Popup Color", "js_composer" ),
                    "param_name"            => "lightbox_backlight_color",
                    "width"                 => 150,
                    "value"                 => array(
                        __( 'Default', "js_composer" )      => "#0084E2",
                        __( 'Neutral', "js_composer" )      => "#FFFFFF",
                        __( 'Success', "js_composer" )      => "#4CFF00",
                        __( 'Warning', "js_composer" )      => "#EA5D00",
                        __( 'Error', "js_composer" )        => "#CC0000",
                        __( 'None', "js_composer" )         => "#000000",
                    ),
                    "description"           => __( "Select the (backlight) color style for the popup box.", "js_composer" ),
                    "dependency"            => ""
                ),
                array(
                    "type"                  => "switch",
					"heading"			    => __( "Show on Page Load", "js_composer" ),
					"param_name"		    => "content_open",
                    "value"                 => "false",
                    "on"				    => __( 'Yes', "js_composer" ),
                    "off"				    => __( 'No', "js_composer" ),
                    "style"				    => "select",
                    "design"			    => "toggle-light",
					"admin_label"           => true,
					"description"		    => __( "Switch the toggle if you want show the popup on page load (limit to one per page).", "js_composer" ),
                    "dependency"            => ""
                ),
                array(
                    "type"                  => "switch",
					"heading"			    => __( "Hide Popup Trigger on Page", "js_composer" ),
					"param_name"		    => "content_open_hide",
                    "value"                 => "false",
                    "on"				    => __( 'Yes', "js_composer" ),
                    "off"				    => __( 'No', "js_composer" ),
                    "style"				    => "select",
                    "design"			    => "toggle-light",
					"description"		    => __( "Switch the toggle if you want show or hide the popup trigger on the page.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_open", 'value' => 'true' )
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Time Delay", "js_composer" ),
                    "param_name"            => "content_open_delay",
                    "value"                 => "0",
                    "min"                   => "0",
                    "max"                   => "10000",
                    "step"                  => "100",
                    "unit"                  => 'ms',
                    "description"           => __( "Define the delay in ms until the modal popup should be shown (starting from 'Document Ready').", "js_composer" ),
                    "dependency"            => array( 'element' => "content_open", 'value' => 'true' )
                ),
                // Modal Triggger
				array(
					"type"				    => "seperator",
					"heading"			    => __( "", "js_composer" ),
					"param_name"		    => "seperator_2",
					"value"				    => "Modal Popup Trigger",
					"description"		    => __( "", "js_composer" ),
                    "dependency"            => ""
				),
				array(
					"type"                  => "dropdown",
					"heading"               => __( "Trigger Type", "js_composer" ),
					"param_name"            => "content_trigger",
                    "value"                 => array(
                        __("Default Image", "js_composer")          => "default",
                        __("Custom Image", "js_composer")           => "image",
                        __("Font Icon", "js_composer")              => "icon",
                        __("Winged Button", "js_composer")          => "winged",
                        __("Simple Button", "js_composer")          => "simple",
                        __("Text", "js_composer")                   => "text",
                        __("Custom HTML", "js_composer")            => "custom",
                    ),
                    "admin_label"           => true,
					"description"           => __( "Select the type of trigger to click on in order to show the lightbox.", "js_composer" ),
					"dependency"            => ""
				),
                // Custom Image
				array(
					"type"                  => "attach_image",
					"heading"               => __( "Select Image", "js_composer" ),
					"param_name"            => "content_image",
					"value"                 => "",
					"description"           => __( "Select the preview image for the modal popup.", "js_composer" ),
					"dependency"            => array( 'element' => "content_trigger", 'value' => 'image' )
				),
                array(
                    "type"                  => "switch",
					"heading"			    => __( "Simple Image Only", "js_composer" ),
					"param_name"		    => "content_image_simple",
                    "value"                 => "false",
                    "on"				    => __( 'Yes', "js_composer" ),
                    "off"				    => __( 'No', "js_composer" ),
                    "style"				    => "select",
                    "design"			    => "toggle-light",
					"description"		    => __( "Switch the toggle if you want display just the image without any styling.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_trigger", 'value' => 'image' )
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
                    "dependency"            => array( 'element' => "content_trigger", 'value' => array('default', 'image') )
                ),
                // Font Icon
				array(
					"type"                  => "icons_panel",
					"heading"               => __( "Select Icon", "js_composer" ),
					"param_name"            => "content_icon",
					"value"                 => $this->TS_VCSC_List_Icons_Full,
					"description"           => __( "Select the icon you want to display.", "js_composer" ),
					"dependency"            => array( 'element' => "content_trigger", 'value' => 'icon' )
				),
				array(
					"type"                  => "nouislider",
					"heading"               => __( "Icon Size", "js_composer" ),
					"param_name"            => "content_iconsize",
					"value"                 => "30",
					"min"                   => "16",
					"max"                   => "512",
					"step"                  => "1",
					"unit"                  => 'px',
					"description"           => __( "Select the icon size", "js_composer" ),
					"dependency"            => array( 'element' => "content_trigger", 'value' => 'icon' )
				),
				array(
					"type"                  => "colorpicker",
					"heading"               => __( "Icon Color", "js_composer" ),
					"param_name"            => "content_iconcolor",
					"value"                 => "#cccccc",
					"description"           => __( "Define the color of the icon.", "js_composer" ),
					"dependency"            => array( 'element' => "content_trigger", 'value' => 'icon' )
				),
                // Button
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Button Text", "js_composer" ),
                    "param_name"            => "content_buttontext",
                    "value"                 => "View Popup",
                    "description"           => __( "Enter the text for the button.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_trigger", 'value' => array('winged', 'simple') )
                ),
                // Text Link
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Trigger Text", "js_composer" ),
                    "param_name"            => "content_text",
                    "value"                 => "",
                    "description"           => __( "Enter the trigger text for the modal popup.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_trigger", 'value' => 'text' )
                ),
                // Custom Code
                array(
                    "type"                  => "textarea_raw_html",
                    "holder"                => "div",
                    "heading"               => __("Raw HTML", "js_composer"),
                    "param_name"            => "content_raw",
                    "value"                 => base64_encode(""),
                    "admin_label"           => false,
                    "description"           => __("Enter your custom HTML code; code will be wrapped in appropriate link automatically.", "js_composer"),
                    "dependency"            => array( 'element' => "content_trigger", 'value' => 'custom' )
                ),
                // Title + Subtitle
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Title", "js_composer" ),
                    "param_name"            => "content_title",
                    "value"                 => "",
                    "description"           => __( "Enter a title for the modal popup trigger.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_trigger", 'value' => array('image', 'default', 'simple', 'winged', 'icon', 'text', 'custom') )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Subtitle", "js_composer" ),
                    "param_name"            => "content_subtitle",
                    "value"                 => "",
                    "description"           => __( "Enter a subtitle for the modal popup trigger.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_trigger", 'value' => array('winged') )
                ),
                // Modal Content
				array(
					"type"				    => "seperator",
					"heading"			    => __( "", "js_composer" ),
					"param_name"		    => "seperator_3",
					"value"				    => "Modal Popup Content",
					"description"		    => __( "", "js_composer" ),
                    "dependency"            => ""
				),
                array(
                    "type"                  => "switch",
					"heading"			    => __( "Show Modal Title", "js_composer" ),
					"param_name"		    => "content_show_title",
                    "value"                 => "true",
                    "on"				    => __( 'Yes', "js_composer" ),
                    "off"				    => __( 'No', "js_composer" ),
                    "style"				    => "select",
                    "design"			    => "toggle-light",
					"description"		    => __( "Switch the toggle if you want show a title in the modal popup.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_trigger", 'value' => 'image' )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Modal Title", "js_composer" ),
                    "param_name"            => "title",
                    "value"                 => "",
                    "description"           => __( "Enter the title for the modal popup.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_show_title", 'value' => 'true' )
                ),
                array(
                    "type"		            => "textarea_html",
                    "holder"                => "div",
                    "class"		            => "",
                    "heading"               => __( "Modal Content", 'js_composer' ),
                    "param_name"            => "content",
                    "value"                 => "",
                    "admin_label"           => false,
                    "description"           => __( "Create the content for the modal popup.", "js_composer" ),
                    "dependency"            => ""
                ),
                // Tooltip Settings
				array(
					"type"				    => "seperator",
					"heading"			    => __( "", "js_composer" ),
					"param_name"		    => "seperator_4",
					"value"				    => "Trigger Tooltip",
					"description"		    => __( "", "js_composer" ),
                    "dependency"            => array( 'element' => "content_trigger", 'value' => array('image', 'default', 'simple', 'icon', 'text', 'custom') )
				),
                array(
                    "type"                  => "switch",
					"heading"			    => __( "Use CSS3 Tooltip", "js_composer" ),
					"param_name"		    => "content_tooltip_css",
                    "value"                 => "false",
                    "on"				    => __( 'Yes', "js_composer" ),
                    "off"				    => __( 'No', "js_composer" ),
                    "style"				    => "select",
                    "design"			    => "toggle-light",
					"description"		    => __( "Switch the toggle if you want to apply a CSS3 tooltip to the image.", "js_composer" ),
                    "dependency"            => array( 'element' => "content_trigger", 'value' => array('image', 'default', 'simple', 'icon', 'text', 'custom') )
                ),
				array(
					"type"				    => "textarea",
					"class"				    => "",
					"heading"			    => __( "Tooltip Content", 'js_composer' ),
					"param_name"		    => "content_tooltip_content",
					"value"				    => "",
					"description"		    => __( "Enter the tooltip content here (do not use quotation marks).", "js_composer" ),
                    "dependency"            => array( 'element' => "content_trigger", 'value' => array('image', 'default', 'simple', 'icon', 'text', 'custom') )
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
					"param_name"		    => "seperator_5",
					"value"				    => "Other Settings",
					"description"		    => __( "", "js_composer" ),
                    "dependency"            => "",
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
					"description"           => __( "Enter a unique ID name for the video element.", "js_composer" ),
					"group" 				=> "Other Settings",
				),
				array(
					"type"                  => "textfield",
					"heading"               => __( "Extra Class Name", "js_composer" ),
					"param_name"            => "el_class",
					"value"                 => "",
					"description"           => __( "Enter a class name for the video element.", "js_composer" ),
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