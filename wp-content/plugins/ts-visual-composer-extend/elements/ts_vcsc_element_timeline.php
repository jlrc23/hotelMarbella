<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                      => __( "TS Timeline / Process", "js_composer" ),
            "base"                      => "TS-VCSC-Timeline",
            "icon" 	                    => "icon-wpb-ts_vcsc_timeline",
            "class"                     => "",
            "category"                  => __( 'VC Extensions', 'js_composer' ),
            "description"               => __("Place a timeline / process element", "js_composer"),
            //"admin_enqueue_js"        => array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"       => array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
            "params"                    => array(
                // Timeline Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_1",
                    "value"             => "Timeline / Process Settings",
                    "description"       => __( "", "js_composer" )
                ),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Timeline / Process Style", "js_composer" ),
					"param_name"        => "timeline_style",
					"width"             => 300,
					"value"             => array(
						__( 'Style 1', "js_composer" )      => "style1",
                        __( 'Style 2', "js_composer" )      => "style2",
                        __( 'Style 3', "js_composer" )      => "style3",
					),
                    "admin_label"       => true,
					"description"       => __( "Select the timeline / process style.", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Color Pattern", "js_composer" ),
					"param_name"        => "timeline_pattern",
					"width"             => 300,
					"value"             => array(
						__( 'Light', "js_composer" )        => "light",
                        __( 'Dark', "js_composer" )         => "dark",
                        __( 'Blue', "js_composer" )         => "blue",
                        __( 'Red', "js_composer" )          => "red",
					),
					"description"       => __( "Select the color pattern; setting will be applied for top element only.", "js_composer" ),
                    "dependency"        => array( 'element' => "timeline_style", 'value' => array('style2') )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Element Position", "js_composer" ),
					"param_name"        => "timeline_ulwrap",
					"width"             => 300,
					"value"             => array(
						__( 'Default Element', "js_composer" )          => "default",
                        __( 'Top / First Element', "js_composer" )      => "top",
                        __( 'Bottom / Last Element', "js_composer" )    => "bottom",
					),
                    "admin_label"       => true,
					"description"       => __( "Select the element position within the timeline / process.", "js_composer" ),
                    "dependency"        => array( 'element' => "timeline_style", 'value' => array('style2', 'style3') )
				),
				array(
					"type"              => "switch",
					"heading"           => __( "Timeline / Process Bottom", "js_composer" ),
					"param_name"        => "timeline_bottom",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
                    "description"       => __( "Switch the toggle to mark the top element of the timeline / process.", "js_composer" ),
                    "dependency"        => array( 'element' => "timeline_style", 'value' => array('style1') )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Timeline / Process Position", "js_composer" ),
					"param_name"        => "timeline_position",
					"width"             => 300,
					"value"             => array(
						__( 'Left', "js_composer" )         => "direction-l",
                        __( 'Right', "js_composer" )        => "direction-r",
					),
					"description"       => __( "Select the timeline / process element position.", "js_composer" ),
                    "dependency"        => array( 'element' => "timeline_style", 'value' => array('style3') )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Font Color", "js_composer" ),
					"param_name"        => "timeline_color",
					"value"             => "#ffffff",
					"description"       => __( "Define the font color for the timeline / process element.", "js_composer" ),
					"dependency"        => array( 'element' => "timeline_style", 'value' => array('style1') )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Background Color", "js_composer" ),
					"param_name"        => "timeline_background",
					"value"             => "#000000",
					"description"       => __( "Define the background color for the timeline / process element.", "js_composer" ),
					"dependency"        => array( 'element' => "timeline_style", 'value' => array('style1') )
				),
                // Icon / Image Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_2",
                    "value"             => "Timeline / Process Icon or Image",
                    "description"       => __( "", "js_composer" )
                ),
				array(
					"type"              => "switch",
					"heading"           => __( "Use Normal Image", "js_composer" ),
					"param_name"        => "icon_replace",
					"value"             => "true",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
                    "description"       => __( "Switch the toggle to either use and icon or a normal image on the timeline / process section.", "js_composer" ),
                    "dependency"        => ""
				),
                array(
                    "type"              => "icons_panel",
                    "heading"           => __( "Select Icon", "js_composer" ),
                    "param_name"        => "icon",
                    "value"             => $this->TS_VCSC_List_Icons_Full,
                    "description"       => __( "Select the icon for the timeline / process section.", "js_composer" ),
                    "dependency"        => array( 'element' => "icon_replace", 'value' => 'false' )
                ),
                array(
                    "type"              => "attach_image",
                    "heading"           => __( "Select Image", "js_composer" ),
                    "param_name"        => "image",
                    "value"             => "false",
                    "description"       => __( "Image will be displayed in a fixed size of 80x80 px.", "js_composer" ),
                    "dependency"        => array( 'element' => "icon_replace", 'value' => 'true' )
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
				array(
					"type"              => "dropdown",
					"heading"           => __( "Viewport Animation", "js_composer" ),
					"param_name"        => "animation_view",
					"value"             => $this->TS_VCSC_CSS_Animations,
					"description"       => __( "Select the viewport animation for the icon / image.", "js_composer" ),
					"dependency"        => array( 'element' => "animations", 'value' => 'true' )
				),
				// Icon / Image Border Settings
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
					"type"              => "switch",
					"heading"           => __( "Apply Padding to Icon / Image", "js_composer" ),
					"param_name"        => "padding",
					"value"             => "true",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
                    "description"       => __( "Switch the toggle if you want to apply a padding to the icon / image.", "js_composer" ),
                    "dependency"        => array( 'element' => "icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
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
                // Timeline Content
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_4",
                    "value"             => "Timeline / Process Content",
                    "description"       => __( "", "js_composer" )
                ),
				array(
					"type"              => "switch",
                    "heading"           => __( "Show Date / Step", "js_composer" ),
                    "param_name"        => "show_date",
					"value"             => "true",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
                    "description"       => __( "Switch the toggle to either show or hide the section with the date / step.", "js_composer" ),
                    "dependency"        => array( 'element' => "timeline_style", 'value' => array('style2') )
				),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Date / Step", "js_composer" ),
                    "param_name"        => "date",
                    "value"             => "",
                    "description"       => __( "Enter the date for the timeline / process element.", "js_composer" )
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Sub-Date / Step", "js_composer" ),
                    "param_name"        => "sub_date",
                    "value"             => "",
                    "description"       => __( "Enter the text below the date for the timeline / process element.", "js_composer" ),
                    "dependency"        => array( 'element' => "timeline_style", 'value' => array('style2') )
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Title", "js_composer" ),
                    "param_name"        => "title",
                    "value"             => "",
                    "description"       => __( "Enter the title for the timeline / process element.", "js_composer" )
                ),
                array(
                    "type"              => "textarea",
                    "heading"           => __( "Text", "js_composer" ),
                    "param_name"        => "text",
                    "value"             => "",
                    "description"       => __( "Enter the text for the timeline / process element.", "js_composer" )
                ),
				// Other Icon Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_5",
					"value"             => "Other Timeline / Process Settings",
					"description"       => __( "", "js_composer" ),
					"group"				=> "Other Settings",
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
					"description"       => __( "Select the top margin for the timeline / process element.", "js_composer" ),
					"group"				=> "Other Settings",
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
					"description"       => __( "Select the bottom margin for the timeline / process element.", "js_composer" ),
					"group"				=> "Other Settings",
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Define ID Name", "js_composer" ),
					"param_name"        => "el_id",
					"value"             => "",
					"description"       => __( "Enter a unique ID name for the timeline / process element.", "js_composer" ),
					"group"				=> "Other Settings",
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Extra Class Name", "js_composer" ),
					"param_name"        => "el_class",
					"value"             => "",
					"description"       => __( "Enter a class name for the timeline / process element.", "js_composer" ),
					"group"				=> "Other Settings",
				),
                // Load Custom CSS/JS File
                array(
                    "type"              => "load_file",
                    "heading"           => __( "", "js_composer" ),
                    "value"             => "Timeline Files",
                    "param_name"        => "el_file",
                    "file_type"         => "js",
                    "file_path"         => "js/ts-visual-composer-extend-element.min.js",
                    "description"       => __( "", "js_composer" )
                ),
            ))
        );
    }
?>