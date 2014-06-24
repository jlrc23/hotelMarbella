<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                      => __( "TS Icon Counter", "js_composer" ),
            "base"                      => "TS-VCSC-Icon-Counter",
            "icon" 	                    => "icon-wpb-ts_vcsc_icon_counter",
            "class"                     => "",
            "category"                  => __( 'VC Extensions', 'js_composer' ),
            "description"               => __("Place an icon counter element", "js_composer"),
            //"admin_enqueue_js"        => array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"       => array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
            "params"                    => array(
                // Counter Icon / Image
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_1",
					"value"             => "Counter Icon / Image",
					"description"       => __( "", "js_composer" )
				),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Icon / Image Positions", "js_composer" ),
                    "param_name"        => "icon_position",
                    "width"             => 150,
                    "value"             => array(
                        __( 'Top', "js_composer" )          => "top",
                        __( 'Left', "js_composer" )         => "left",
                        __( 'Right', "js_composer" )        => "right",
                    ),
                    "description"       => __( "Select where the icon should be positioned.", "js_composer" )
                ),
				array(
					"type"				=> "switch",
					"heading"           => __( "Use Normal Image", "js_composer" ),
					"param_name"        => "icon_replace",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle to either use and icon or a normal image.", "js_composer" ),
                    "dependency"        => ""
				),
				array(
					"type"              => "icons_panel",
					"heading"           => __( "Select Icon", "js_composer" ),
					"param_name"        => "icon",
					"value"             => $this->TS_VCSC_List_Icons_Full,
					"description"       => __( "Select the icon you want to display.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_replace", 'value' => 'false' )
				),
				array(
					"type"              => "attach_image",
					"heading"           => __( "Select Image", "js_composer" ),
					"param_name"        => "icon_image",
					"value"             => "false",
					"admin_label"       => true,
					"description"       => __( "Image should have equal dimensions for scaling purposes (i.e. 100x100)", "js_composer" ),
					"dependency"        => array( 'element' => "icon_replace", 'value' => 'true' )
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Icon / Image Size", "js_composer" ),
					"param_name"        => "icon_size_slide",
					"value"             => "75",
					"min"               => "16",
					"max"               => "512",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Select the icon / image size", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon Color", "js_composer" ),
					"param_name"        => "icon_color",
					"value"             => "#cccccc",
					"description"       => __( "Define the color of the icon.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_replace", 'value' => 'false' )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon / Image Background Color", "js_composer" ),
					"param_name"        => "icon_background",
					"value"             => "",
					"description"       => __( "Define the background color for the icon / transparent image.", "js_composer" ),
					"dependency"        => ""
				),
				// Icon Border Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_3",
					"value"             => "Icon / Image Border Settings",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Border Type", "js_composer" ),
					"param_name"        => "icon_frame_type",
					"width"             => 300,
					"value"             => $this->TS_VCSC_Border_Type,
					"description"       => __( "Select the type of border around the icon / image.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Icon / Image Border Thickness", "js_composer" ),
					"param_name"        => "icon_frame_thick",
					"value"             => "1",
					"min"               => "1",
					"max"               => "10",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Define the thickness of the icon / image border.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Border Radius", "js_composer" ),
					"param_name"        => "icon_frame_radius",
					"value"             => $this->TS_VCSC_Icon_Border_Radius,
					"description"       => __( "Define the radius of the icon / image border.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon / Image Frame Border Color", "js_composer" ),
					"param_name"        => "icon_frame_color",
					"value"             => "#000000",
					"description"       => __( "Define the color of the icon / image border.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"				=> "switch",
					"heading"           => __( "Apply Padding to Icon / Image", "js_composer" ),
					"param_name"        => "padding",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle if you want to apply a padding to the icon / image.", "js_composer" ),
                    "dependency"        => ""
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Icon / Image Padding", "js_composer" ),
					"param_name"        => "icon_padding",
					"value"             => "0",
					"min"               => "0",
					"max"               => "50",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "If image instead of icon, increase the image size by padding value.", "js_composer" ),
					"dependency"        => array( 'element' => "padding", 'value' => 'true' )
				),
                // Main Counter Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_2",
					"value"             => "Counter Values",
					"description"       => __( "", "js_composer" )
				),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Counter Start Number", "js_composer" ),
                    "param_name"        => "counter_value_start",
                    "value"             => 0,
                    "admin_label"       => true,
                    "description"       => __( "Enter the number to start counting from.", "js_composer" )
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Counter End Number", "js_composer" ),
                    "param_name"        => "counter_value_end",
                    "value"             => "",
                    "admin_label"       => true,
                    "description"       => __( "Enter the number to count up to.", "js_composer" )
                ),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Counter Number Font Size", "js_composer" ),
					"param_name"        => "counter_value_size",
					"value"             => "30",
					"min"               => "12",
					"max"               => "200",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Select the font size for the counter number.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Counter Number Font Color", "js_composer" ),
					"param_name"        => "counter_value_color",
					"value"             => "#000000",
					"description"       => __( "Define the font color for counter number.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"				=> "switch",
					"heading"           => __( "Format Finished Number", "js_composer" ),
					"param_name"        => "counter_value_format",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle to add some formatting to the number once the count has finished.", "js_composer" ),
                    "dependency"        => ""
				),
				array(
					"type"				=> "switch",
					"heading"           => __( "Add '+' Sign to Number", "js_composer" ),
					"param_name"        => "counter_value_plus",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle to either show or hide a '+' sign after the number once the count has finished.", "js_composer" ),
                    "dependency"		=> array( 'element' => "counter_value_format", 'value' => 'true' )
				),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Thousand Seperator", "js_composer" ),
                    "param_name"        => "counter_value_seperator",
                    "width"             => 150,
                    "value"             => array(
                        __( 'None', "js_composer" )         => "",
                        __( 'Comma', "js_composer" )        => ",",
                        __( 'Dot', "js_composer" )          => ".",
                        __( 'Space', "js_composer" )        => " ",
                    ),
                    "description"       => __( "Select a character to seperate thousands in the end number.", "js_composer" ),
                    "dependency"		=> array( 'element' => "counter_value_format", 'value' => 'true' )
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Character(s) before Number", "js_composer" ),
                    "param_name"        => "counter_value_before",
                    "value"             => "",
                    "description"       => __( "Enter any character to be shown before the nunber (i.e. $).", "js_composer" ),
                    "dependency"		=> array( 'element' => "counter_value_format", 'value' => 'true' )
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Character(s) after Number", "js_composer" ),
                    "param_name"        => "counter_value_after",
                    "value"             => "",
                    "description"       => __( "Enter any character to be shown after the nunber (i.e. %).", "js_composer" ),
                    "dependency"		=> array( 'element' => "counter_value_format", 'value' => 'true' )
                ),
				array(
					"type"				=> "switch",
					"heading"           => __( "Seperator Line", "js_composer" ),
					"param_name"        => "counter_seperator",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle to either show or hide a seperator.", "js_composer" ),
                    "dependency"		=> ""
				),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Counter Note", "js_composer" ),
                    "param_name"        => "counter_note",
                    "value"             => "",
                    "admin_label"       => true,
                    "description"       => __( "Enter a note about what you are counting.", "js_composer" )
                ),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Counter Note Font Size", "js_composer" ),
					"param_name"        => "counter_note_size",
					"value"             => "15",
					"min"               => "12",
					"max"               => "200",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Select the font size for the counter note.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Counter Note Font Color", "js_composer" ),
					"param_name"        => "counter_note_color",
					"value"             => "#000000",
					"description"       => __( "Define the font color for counter note.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Counter Speed", "js_composer" ),
					"param_name"        => "counter_speed",
					"value"             => "2000",
					"min"               => "500",
					"max"               => "10000",
					"step"              => "100",
					"unit"              => 'ms',
					"description"       => __( "Select the speed in ms for the counter to finish.", "js_composer" ),
					"dependency"        => ""
				),
				// Counter Tooltip
				array(
					"type"				=> "seperator",
					"heading"			=> __( "", "js_composer" ),
					"param_name"		=> "seperator_4",
					"value"				=> "Icon Tooltip",
					"description"		=> __( "", "js_composer" )
				),
				array(
					"type"				=> "switch",
					"heading"			=> __( "Use CSS3 Tooltip", "js_composer" ),
					"param_name"		=> "tooltip_css",
					"value"				=> "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle if you want to apply a CSS3 tooltip to the image.", "js_composer" ),
                    "dependency"		=> ""
				),
				array(
					"type"				=> "textarea",
					"class"				=> "",
					"heading"			=> __( "Tooltip Content", 'js_composer' ),
					"param_name"		=> "tooltip_content",
					"value"				=> "",
					"description"		=> __( "Enter the tooltip content here (do not use quotation marks).", "js_composer" ),
					"dependency"		=> ""
				),
				array(
					"type"				=> "dropdown",
					"class"				=> "",
					"heading"			=> __( "Tooltip Position", 'js_composer' ),
					"param_name"		=> "tooltip_position",
					"value"				=> $this->TS_VCSC_ImageTooltip_Position,
					"description"		=> __( "Select the tooltip position in relation to the image.", "js_composer" ),
					"dependency"		=> array( 'element' => "tooltip_css", 'value' => 'true' )
				),
				array(
					"type"				=> "dropdown",
					"class"				=> "",
					"heading"			=> __( "Tooltip Style", 'js_composer' ),
					"param_name"		=> "tooltip_style",
					"value"				=> $this->TS_VCSC_Tooltip_Style,
					"description"		=> __( "Select the tooltip style.", "js_composer" ),
					"dependency"		=> array( 'element' => "tooltip_css", 'value' => 'true' )
				),
                // Animation
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_5",
					"value"             => "Icon / Image Animation",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Animation", "js_composer" ),
					"param_name"        => "animation_icon",
					"width"             => 150,
					"value"             => $this->TS_VCSC_CSS_Animations_Classes,
					"description"       => __( "Select the animation for the icon / image.", "js_composer" ),
					"dependency"        => array( 'element' => "animations", 'value' => 'true' )
				),
				// Other Icon Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_6",
					"value"             => "Other Icon Settings",
					"description"       => __( "", "js_composer" ),
					"group" 			=> "Other Settings",
				),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Margin Top", "js_composer" ),
                    "param_name"        => "margin_top",
                    "value"             => "0",
                    "min"               => "-50",
                    "max"               => "500",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "", "js_composer" ),
					"group" 			=> "Other Settings",
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Margin Bottom", "js_composer" ),
                    "param_name"        => "margin_bottom",
                    "value"             => "0",
                    "min"               => "-50",
                    "max"               => "500",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "", "js_composer" ),
					"group" 			=> "Other Settings",
                ),
				array(
					"type"              => "textfield",
					"heading"           => __( "Define ID Name", "js_composer" ),
					"param_name"        => "el_id",
					"value"             => "",
					"description"       => __( "Enter a unique ID name for the icon element.", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Extra Class Name", "js_composer" ),
					"param_name"        => "el_class",
					"value"             => "",
					"description"       => __( "Enter a class name for the icon element.", "js_composer" ),
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