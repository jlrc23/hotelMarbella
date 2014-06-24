<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                      => __( "TS Icon Title", "js_composer" ),
            "base"                      => "TS-VCSC-Icon-Title",
            "icon" 	                    => "icon-wpb-ts_vcsc_icon_title",
            "class"                     => "",
            "category"                  => __( 'VC Extensions', 'js_composer' ),
            "description"               => __("Place an icon or image title", "js_composer"),
            //"admin_enqueue_js"        => array(ts_fb_get_resource_url('/js/...')),
            //"admin_enqueue_css"       => array(ts_fb_get_resource_url('/css/...')),
            "params"                    => array(
                // Icon Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_3",
                    "value"             => "Icon Settings",
                    "description"       => __( "", "js_composer" )
                ),
				array(
					"type"              => "switch",
                    "heading"           => __( "Use Normal Image", "js_composer" ),
                    "param_name"        => "icon_replace",
                    "value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle to either use a font icon or a normal image.", "js_composer" ),
                    "dependency"        => ""
				),
                array(
                    "type"              => "icons_panel",
                    "heading"           => __( "Select Icon", "js_composer" ),
                    "param_name"        => "icon",
                    "value"             => $this->TS_VCSC_List_Icons_Full,
                    "admin_label"       => true,
                    "description"       => __( "Select the icon for your icon title.", "js_composer" ),
                    "dependency"        => array( 'element' => "icon_replace", 'value' => 'false' )
                ),
                array(
                    "type"              => "attach_image",
                    "heading"           => __( "Select Image", "js_composer" ),
                    "param_name"        => "icon_image",
                    "value"             => "false",
                    "description"       => __( "Image should have equal dimensions for scaling purposes (i.e. 100x100)", "js_composer" ),
                    "dependency"        => array( 'element' => "icon_replace", 'value' => 'true' )
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Icon / Image Size", "js_composer" ),
                    "param_name"        => "icon_size_slide",
                    "value"             => "30",
                    "min"               => "16",
                    "max"               => "512",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "Select the icon / image size", "js_composer" ),
                    "dependency"        => ""
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Icon / Image Location", "js_composer" ),
                    "param_name"        => "icon_location",
                    "width"             => 150,
                    "value"             => array(
                        __( 'Left', "js_composer" )     => "left",
                        __( 'Right', "js_composer" )    => "right",
                        __( 'Top', "js_composer" )      => "top",
                        __( 'Bottom', "js_composer" )   => "bottom"),
                    "description"       => __( "Select how to position the icon / image in relation to the title wording.", "js_composer" ),
                    "admin_label"       => true,
                    "dependency"        => ""
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Icon / Image to Text Spacing", "js_composer" ),
                    "param_name"        => "icon_margin",
                    "value"             => "10",
                    "min"               => "0",
                    "max"               => "50",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "Define the space between the icon / image and the icon title content.", "js_composer" ),
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
                // Icon Title Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_1",
                    "value"             => "Title Content",
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Title", "js_composer" ),
                    "param_name"        => "title",
                    "value"             => "",
                    "admin_label"       => true,
                    "description"       => __( "Enter the icon title text.", "js_composer" )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Align", "js_composer" ),
                    "param_name"        => "align",
                    "width"             => 150,
                    "value"             => $this->TS_VCSC_Title_Align,
                    "description"       => __( "Select how to align the icon title text.", "js_composer" ),
                    "dependency"        => array( 'element' => "icon_location", 'value' => array('left', 'right') )
                ),
                array(
                    "type"              => "colorpicker",
                    "heading"           => __( "Font Color", "js_composer" ),
                    "param_name"        => "color",
                    "value"             => "#393836",
                    "description"       => __( "Define the color for the icon title text.", "js_composer" )
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Font Size", "js_composer" ),
                    "param_name"        => "size",
                    "value"             => "30",
                    "min"               => "12",
                    "max"               => "70",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "Select the font size for the icon title text.", "js_composer" )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Font Weight", "js_composer" ),
                    "param_name"        => "font_weight",
                    "width"             => 150,
                    "value"             => array(
                        __( 'Default', "js_composer" )  => "inherit",
                        __( 'Bold', "js_composer" )     => "bold",
                        __( 'Bolder', "js_composer" )   => "bolder",
                        __( 'Normal', "js_composer" )   => "normal",
                        __( 'Light', "js_composer" )    => "300",
                    ),
                    "description"       => __( "Select the font weight for the icon title text.", "js_composer" )
                ),
				array(
					"type"              => "switch",
                    "heading"           => __( "Use Theme Defined Font", "js_composer" ),
                    "param_name"        => "font_theme",
                    "value"             => "true",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle to either use the theme default font or a custom font.", "js_composer" ),
                    "dependency"        => ""
				),
                array(
                    "type"              => "fonts",
                    "heading"           => __( "Font Family", "js_composer" ),
                    "param_name"        => "font_family",
                    "value"             => "",
                    "description"       => __( "Select the font to be used for the icon title text.", "js_composer" ),
                    "dependency"        => array( 'element' => "font_theme", 'value' => 'false' )
                ),
                array(
                    "type"              => "hidden_input",
                    "param_name"        => "font_type",
                    "value"             => "",
                    "description"       => __( "", "js_composer" )
                ),
                // Title Design Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_2",
                    "value"             => "Title Design",
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Title Background Style", "js_composer" ),
                    "param_name"        => "title_background_type",
                    "width"             => 300,
                    "value"             => $this->TS_VCSC_Background_Type,
                    "description"       => __( "Select the type of background to be applied to the icon title.", "js_composer" )
                ),
                array(
                    "type"              => "colorpicker",
                    "heading"           => __( "Title Background Color", "js_composer" ),
                    "param_name"        => "title_background_color",
                    "value"             => "#ffffff",
                    "description"       => __( "Define the background color for the icon title.", "js_composer" ),
                    "dependency"        => array( 'element' => "title_background_type", 'value' => 'color' )
                ),
				array(
					"type"              => "switch",
                    "heading"           => __( "Strikethrough Pattern?", "js_composer" ),
                    "param_name"        => "style",
                    "value"             => "true",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
                    "description"       => __( "Switch the toggle to show or hide a strikethrough pattern with the icon title.", "js_composer" ),
                    "dependency"        => array( 'element' => "title_background_type", 'value' => 'color' )
				),
                array(
                    "type"              => "background",
                    "heading"           => __( "Background Pattern", "js_composer" ),
                    "param_name"        => "title_background_pattern",
                    "width"             => 200,
                    "value"             => $this->TS_VCSC_Background_List,
                    "encoding"          => "false",
                    "description"       => __( "Select the background pattern for your icon title.", "js_composer" ),
                    "dependency"        => array( 'element' => "title_background_type", 'value' => 'pattern' )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Title Border Style", "js_composer" ),
                    "param_name"        => "title_border_type",
                    "width"             => 300,
                    "value"             => $this->TS_VCSC_TitleBorder_Type,
                    "description"       => __( "Select the type of border for the icon title.", "js_composer" )
                ),
				array(
					"type"              => "switch",
                    "heading"           => __( "Bottom Border Only?", "js_composer" ),
                    "param_name"        => "title_border_bottom",
                    "value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
                    "description"       => __( "Switch the toggle if the border should be applied to the bottom of the icon title only.", "js_composer" ),
                    "dependency"        => array( 'element' => "title_border_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
                array(
                    "type"              => "colorpicker",
                    "heading"           => __( "Title Border Color", "js_composer" ),
                    "param_name"        => "title_border_color",
                    "value"             => "#cccccc",
                    "description"       => __( "Define the color of the icon title border.", "js_composer" ),
                    "dependency"        => array( 'element' => "title_border_type", 'value' => $this->TS_VCSC_Border_Type_Values )
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Title Border Thickness", "js_composer" ),
                    "param_name"        => "title_border_thick",
                    "value"             => "1",
                    "min"               => "1",
                    "max"               => "10",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "Define the thickness of the icon title border.", "js_composer" ),
                    "dependency"        => array( 'element' => "title_border_type", 'value' => $this->TS_VCSC_Border_Type_Values )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Title Border Radius", "js_composer" ),
                    "param_name"        => "title_border_radius",
                    "value"             => $this->TS_VCSC_Box_Border_Radius,
                    "description"       => __( "Select the radius for the icon title border.", "js_composer" ),
                    "dependency"        => array( 'element' => "title_border_type", 'value' => $this->TS_VCSC_Border_Type_Values )
                ),
                // Animation Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_4",
                    "value"             => "Animations",
                    "description"       => __( "", "js_composer" )
                ),
				array(
					"type"              => "switch",
                    "heading"           => __( "Add Animations / Shadow", "js_composer" ),
                    "param_name"        => "animations",
                    "value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
                    "description"       => __( "Switch the toggle if you want to apply animations or a shadow to the icon box.", "js_composer" ),
                    "dependency"        => ""
				),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Icon / Image Hover Animation", "js_composer" ),
                    "param_name"        => "animation_icon",
                    "width"             => 150,
                    "value"             => $this->TS_VCSC_CSS_Hovers,
                    "description"       => __( "Select the hover animation for the icon / image.", "js_composer" ),
                    "dependency"        => array( 'element' => "animations", 'value' => 'true' )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Title Hover Effect", "js_composer" ),
                    "param_name"        => "animation_title",
                    "width"             => 300,
                    "value"             => $this->TS_VCSC_IconTitle_Effect,
                    "description"       => __( "Select the hover animation for the icon title.", "js_composer" ),
                    "dependency"        => array( 'element' => "animations", 'value' => 'true' )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Title Shadow Effect", "js_composer" ),
                    "param_name"        => "animation_shadow",
                    "width"             => 300,
                    "value"             => $this->TS_VCSC_Shadow_Type,
                    "description"       => __( "Select the shadow effect for the icon title.", "js_composer" ),
                    "dependency"        => array( 'element' => "animations", 'value' => 'true' )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Viewport Animation", "js_composer" ),
                    "param_name"        => "animation_view",
                    "value"             => $this->TS_VCSC_CSS_Animations,
                    "description"       => __( "Select the viewport animation for the icon title.", "js_composer" ),
                    "dependency"        => array( 'element' => "animations", 'value' => 'true' )
                ),
                // Other Icon Title Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_5",
                    "value"             => "Other Settings",
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
                    "description"       => __( "Select the top margin for the icon title.", "js_composer" ),
					"group" 			=> "Other Settings",
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Margin Bottom", "js_composer" ),
                    "param_name"        => "margin_bottom",
                    "value"             => "20",
                    "min"               => "-50",
                    "max"               => "500",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "Select the bottom margin for the icon title.", "js_composer" ),
					"group" 			=> "Other Settings",
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Define ID Name", "js_composer" ),
                    "param_name"        => "el_id",
                    "value"             => "",
                    "description"       => __( "Enter an unique ID for the icon title.", "js_composer" ),
					"group" 			=> "Other Settings",
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Extra Class Name", "js_composer" ),
                    "param_name"        => "el_class",
                    "value"             => "",
                    "description"       => __( "Enter a class name for the icon title.", "js_composer" ),
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