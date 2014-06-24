<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                      => __( "TS Content Flip", "js_composer" ),
            "base"                      => "TS-VCSC-Content-Flip",
            "icon" 	                    => "icon-wpb-ts_vcsc_content_flip",
            "class"                     => "",
            "category"                  => __( 'VC Extensions', 'js_composer' ),
            "description"               => __("Place a content flip element", "js_composer"),
            //"admin_enqueue_js"        => array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"       => array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
            "params"                    => array(
                // Effect Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_1",
                    "value"             => "Flip Effect",
                    "description"       => __( "", "js_composer" )
                ),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Flip Style", "js_composer" ),
					"param_name"        => "flip_style",
					"width"             => 300,
					"value"             => array(
						__( 'Standard', "js_composer" )     => "style1",
                        __( 'Cube', "js_composer" )         => "style2",
					),
                    "admin_label"       => true,
					"description"       => __( "Select the type of flip effect.", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Flip Effect Style", "js_composer" ),
					"param_name"        => "flip_effect_style1",
					"width"             => 300,
					"value"             => array(
						__( 'Horizontal Flip', "js_composer" )      => "horizontal",
                        __( 'Vertical Flip', "js_composer" )        => "vertical",
					),
					"description"       => __( "Select the type of flip effect.", "js_composer" ),
                    "dependency"        => array( 'element' => "flip_style", 'value' => 'style1' )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Flip Effect Style", "js_composer" ),
					"param_name"        => "flip_effect_style2",
					"width"             => 300,
					"value"             => array(
						__( 'Flip Right', "js_composer" )   => "ts-flip-right",
                        __( 'Flip Up', "js_composer" )      => "ts-flip-up",
					),
					"description"       => __( "Select the type of flip effect.", "js_composer" ),
                    "dependency"        => array( 'element' => "flip_style", 'value' => 'style2' )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Flip Effect Speed", "js_composer" ),
					"param_name"        => "flip_effect_speed",
					"width"             => 300,
					"value"             => array(
						__( 'Very Slow', "js_composer" )    => "veryslow",
                        __( 'Slow', "js_composer" )         => "slow",
                        __( 'Medium', "js_composer" )       => "medium",
                        __( 'Fast', "js_composer" )         => "fast",
                        __( 'Very Fast', "js_composer" )    => "veryfast",
					),
					"description"       => __( "Select the speed for the flip effect.", "js_composer" ),
                    "dependency"        => array( 'element' => "flip_style", 'value' => 'style1' )
				),
				array(
					"type"             	 	=> "switch",
                    "heading"           => __( "Auto-Size Flip Box Height", "js_composer" ),
                    "param_name"        => "flip_size_auto",
                    "value"             => "true",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
                    "description"       => __( "Switch the toggle if you want to auto-size the height of the content flip box.", "js_composer" ),
                    "dependency"        => ""
				),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Fixed Height", "js_composer" ),
                    "param_name"        => "flip_size",
                    "value"             => "100",
                    "min"               => "200",
                    "max"               => "800",
                    "step"              => "1",
                    "unit"              => 'px',
                    "admin_label"       => true,
                    "description"       => __( "Select the fixed height for the content flip element.", "js_composer" ),
                    "dependency"        => array( 'element' => "flip_size_auto", 'value' => 'false' )
                ),
                // Flip Box Border
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_2",
                    "value"             => "Flip Box Border",
                    "description"       => __( "", "js_composer" )
                ),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Border Type", "js_composer" ),
					"param_name"        => "flip_border_type",
					"width"             => 300,
					"value"             => $this->TS_VCSC_Border_Type,
					"description"       => __( "Select the type of border around the icon / image.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Border Thickness", "js_composer" ),
					"param_name"        => "flip_border_thick",
					"value"             => "1",
					"min"               => "1",
					"max"               => "10",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Define the thickness of the icon / image border.", "js_composer" ),
					"dependency"        => array( 'element' => "flip_border_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Border Radius", "js_composer" ),
					"param_name"        => "flip_border_radius",
					"value"             => $this->TS_VCSC_Icon_Border_Radius,
					"description"       => __( "Define the radius of the icon / image border.", "js_composer" ),
					"dependency"        => array( 'element' => "flip_border_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
                // Main Color Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_3",
                    "value"             => "Main Color Settings",
                    "description"       => __( "", "js_composer" )
                ),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Front Panel Font Color", "js_composer" ),
					"param_name"        => "front_color",
					"value"             => "#000000",
					"description"       => __( "Define the font color for the front panel.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Front Panel - Title Color", "js_composer" ),
					"param_name"        => "front_color_title",
					"value"             => "#000000",
					"description"       => __( "Define the title color for the front panel.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Front Panel - Background Color", "js_composer" ),
					"param_name"        => "front_background",
					"value"             => "#ffffff",
					"description"       => __( "Define the background color for the front panel.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Front Panel - Border Color", "js_composer" ),
					"param_name"        => "flip_border_color_front",
					"value"             => "#dddddd",
					"description"       => __( "Define the border for the front panel.", "js_composer" ),
					"dependency"        => array( 'element' => "flip_border_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Back Panel - Font Color", "js_composer" ),
					"param_name"        => "back_color",
					"value"             => "#000000",
					"description"       => __( "Define the font color for the back panel.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Back Panel - Title Color", "js_composer" ),
					"param_name"        => "back_color_title",
					"value"             => "#000000",
					"description"       => __( "Define the title color for the back panel.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Back Panel - Background Color", "js_composer" ),
					"param_name"        => "back_background",
					"value"             => "#ffffff",
					"description"       => __( "Define the background color for the back panel.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Back Panel Border Color", "js_composer" ),
					"param_name"        => "flip_border_color_back",
					"value"             => "#dddddd",
					"description"       => __( "Define the border for the back panel.", "js_composer" ),
					"dependency"        => array( 'element' => "flip_border_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
                // Icon / Image Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_4",
                    "value"             => "Flip Box Icon / Image",
                    "description"       => __( "", "js_composer" )
                ),
				array(
					"type"				=> "switch",
                    "heading"           => __( "Use Normal Image", "js_composer" ),
                    "param_name"        => "front_icon_replace",
                    "value"             => "true",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
                    "description"       => __( "Switch the toggle to either use a font icon or a normal image on the front panel.", "js_composer" ),
                    "dependency"        => ""
				),
                array(
                    "type"              => "icons_panel",
                    "heading"           => __( "Select Icon", "js_composer" ),
                    "param_name"        => "front_icon",
                    "value"             => $this->TS_VCSC_List_Icons_Full,
                    "description"       => __( "Select the icon for the front panel.", "js_composer" ),
                    "dependency"        => array( 'element' => "front_icon_replace", 'value' => 'false' )
                ),
                array(
                    "type"              => "attach_image",
                    "heading"           => __( "Select Image", "js_composer" ),
                    "param_name"        => "front_image",
                    "value"             => "false",
                    "description"       => __( "If not used as full size, image should have equal dimensions for scaling purposes (i.e. 100x100)", "js_composer" ),
                    "dependency"        => array( 'element' => "front_icon_replace", 'value' => 'true' )
                ),
				array(
					"type"				=> "switch",
                    "heading"           => __( "Use as Full Size Image", "js_composer" ),
                    "param_name"        => "front_image_full",
                    "value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
                    "description"       => __( "Switch the toggle if you want to use the image as full-size image on the front without any other elements.", "js_composer" ),
                    "dependency"        => array( 'element' => "front_icon_replace", 'value' => 'true' )
				),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Icon / Image Size", "js_composer" ),
                    "param_name"        => "front_icon_size",
                    "value"             => "70",
                    "min"               => "16",
                    "max"               => "512",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "Select the icon / image size for the front panel.", "js_composer" ),
                    "dependency"        => array( 'element' => "front_image_full", 'value' => 'false' )
                ),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon Color", "js_composer" ),
					"param_name"        => "front_icon_color",
					"value"             => "#cccccc",
					"description"       => __( "Define the color of the icon.", "js_composer" ),
					"dependency"        => array( 'element' => "front_icon_replace", 'value' => 'false' )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon / Image Background Color", "js_composer" ),
					"param_name"        => "front_icon_background",
					"value"             => "",
					"description"       => __( "Define the background color for the icon / transparent image.", "js_composer" ),
					"dependency"        => array( 'element' => "front_image_full", 'value' => 'false' )
				),
				// Icon / Image Border Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_5",
                    "value"             => "Icon / Image Border",
                    "description"       => __( "", "js_composer" )
                ),
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_2",
					"value"             => "Icon / Image Border Settings",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Border Type", "js_composer" ),
					"param_name"        => "front_icon_frame_type",
					"width"             => 300,
					"value"             => $this->TS_VCSC_Border_Type,
					"description"       => __( "Select the type of border around the icon / image.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Icon / Image Border Thickness", "js_composer" ),
					"param_name"        => "front_icon_frame_thick",
					"value"             => "1",
					"min"               => "1",
					"max"               => "10",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Define the thickness of the icon / image border.", "js_composer" ),
					"dependency"        => array( 'element' => "front_icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Border Radius", "js_composer" ),
					"param_name"        => "front_icon_frame_radius",
					"value"             => $this->TS_VCSC_Icon_Border_Radius,
					"description"       => __( "Define the radius of the icon / image border.", "js_composer" ),
					"dependency"        => array( 'element' => "front_icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon / Image Frame Border Color", "js_composer" ),
					"param_name"        => "front_icon_frame_color",
					"value"             => "#000000",
					"description"       => __( "Define the color of the icon / image border.", "js_composer" ),
					"dependency"        => array( 'element' => "front_icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"				=> "switch",
					"heading"           => __( "Apply Padding to Icon / Image", "js_composer" ),
					"param_name"        => "front_padding",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle if you want to apply a padding to the icon / image.", "js_composer" ),
                    "dependency"        => array( 'element' => "front_icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Icon / Image Padding", "js_composer" ),
					"param_name"        => "front_icon_padding",
					"value"             => "0",
					"min"               => "0",
					"max"               => "50",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "If image instead of icon, increase the image size by padding value.", "js_composer" ),
					"dependency"        => array( 'element' => "front_padding", 'value' => 'true' )
				),
                // Content Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_6",
                    "value"             => "Flip Box Content",
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Front Panel Title", "js_composer" ),
                    "param_name"        => "front_title",
                    "value"             => "",
                    "description"       => __( "Enter the title for the front panel.", "js_composer" )
                ),
				array(
					"type"				=> "switch",
                    "heading"           => __( "Allow HTML Code", "js_composer" ),
                    "param_name"        => "front_html",
                    "value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle to allow for HTML code to create the front panel content.", "js_composer" ),
                    "dependency"        => ""
				),
                array(
                    "type"              => "textarea",
                    "class"             => "",
                    "heading"           => __( "Front Panel Message", 'js_composer' ),
                    "param_name"        => "front_content",
                    "value"             => "",
                    "description"       => __( "Enter the content for the front panel; HTML code can NOT be used.", 'js_composer' ),
                    "dependency"        => array( 'element' => "front_html", 'value' => 'false' )
                ),
                array(
                    "type"              => "textarea_raw_html",
                    "class"             => "",
                    "heading"           => __( "Front Panel Message", 'js_composer' ),
                    "param_name"        => "front_content_html",
                    "value"             => base64_encode(""),
                    "description"       => __( "Enter the content for front panel; HTML code can be used.", 'js_composer' ),
                    "dependency"        => array( 'element' => "front_html", 'value' => 'true' )
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Back Panel Title", "js_composer" ),
                    "param_name"        => "back_title",
                    "value"             => "",
                    "description"       => __( "Enter the title for the back panel.", "js_composer" )
                ),
				array(
					"type"				=> "switch",
                    "heading"           => __( "Allow HTML Code", "js_composer" ),
                    "param_name"        => "back_html",
                    "value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle to allow for HTML code to create the back panel content.", "js_composer" ),
                    "dependency"        => ""
				),
                array(
                    "type"              => "textarea",
                    "class"             => "",
                    "heading"           => __( "Back Panel Message", 'js_composer' ),
                    "param_name"        => "back_content",
                    "value"             => "",
                    "description"       => __( "Enter the content for the back panel; HTML code can NOT be used.", 'js_composer' ),
                    "dependency"        => array( 'element' => "back_html", 'value' => 'false' )
                ),
                array(
                    "type"              => "textarea_raw_html",
                    "class"             => "",
                    "heading"           => __( "Back Panel Message", 'js_composer' ),
                    "param_name"        => "back_content_html",
                    "value"             => base64_encode(""),
                    "description"       => __( "Enter the content for the back panel; HTML code can be used.", 'js_composer' ),
                    "dependency"        => array( 'element' => "back_html", 'value' => 'true' )
                ),
				// Read More Button Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_7",
					"value"             => "Read More Link",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"				=> "switch",
                    "heading"           => __( "Add Link", "js_composer" ),
                    "param_name"        => "read_more_link",
                    "value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle to add a link to the back panel.", "js_composer" ),
                    "dependency"        => ""
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Read More Button Text", "js_composer" ),
					"param_name"        => "read_more_txt",
					"value"             => "Read More",
					"description"       => __( "Enter the text to be shown in the link button.", "js_composer" ),
					"dependency"        => array( 'element' => "read_more_link", 'value' => 'true' )
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Read More URL", "js_composer" ),
					"param_name"        => "read_more_url",
					"value"             => "",
					"description"       => __( "Enter the URL for the link (starting with http://).", "js_composer" ),
					"dependency"        => array( 'element' => "read_more_link", 'value' => "true" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Link Target", "js_composer" ),
					"param_name"        => "read_more_target",
					"value"             => $this->TS_VCSC_Link_Target,
					"description"       => __( "Define how the link should be opened.", "js_composer" ),
					"dependency"        => array( 'element' => "read_more_link", 'value' => "true" )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Link Font Color", "js_composer" ),
					"param_name"        => "read_more_color",
					"value"             => "#000000",
					"description"       => __( "Define the font color for the back panel link.", "js_composer" ),
					"dependency"        => array( 'element' => "read_more_link", 'value' => "true" )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Link Background Color", "js_composer" ),
					"param_name"        => "read_more_background",
					"value"             => "#dddddd",
					"description"       => __( "Define the background color for back panel link.", "js_composer" ),
					"dependency"        => array( 'element' => "read_more_link", 'value' => "true" )
				),
				// Animation Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_8",
					"value"             => "Animations",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"				=> "switch",
					"heading"           => __( "Add Animations", "js_composer" ),
					"param_name"        => "animations",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle if you want to apply animations or a shadow to the flip box element.", "js_composer" ),
                    "dependency"        => ""
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Animation", "js_composer" ),
					"param_name"        => "animation_icon",
					"width"             => 150,
					"value"             => $this->TS_VCSC_Infinite_Effects,
					"description"       => __( "Select the animation for the icon / image.", "js_composer" ),
					"dependency"        => array( 'element' => "animations", 'value' => 'true' )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Viewport Animation", "js_composer" ),
					"param_name"        => "animation_view",
					"value"             => $this->TS_VCSC_CSS_Animations,
					"description"       => __( "Select the viewport animation for the flip box element.", "js_composer" ),
					"dependency"        => array( 'element' => "animations", 'value' => 'true' )
				),
				// Other Flip Box Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_9",
					"value"             => "Other Flip Box Settings",
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
					"description"       => __( "Select the top margin for the flip box element.", "js_composer" ),
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
					"description"       => __( "Select the bottom margin for the flip box element.", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Define ID Name", "js_composer" ),
					"param_name"        => "el_id",
					"value"             => "",
					"description"       => __( "Enter a unique ID name for the flip box element.", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Extra Class Name", "js_composer" ),
					"param_name"        => "el_class",
					"value"             => "",
					"description"       => __( "Enter a class name for the flip box element.", "js_composer" ),
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