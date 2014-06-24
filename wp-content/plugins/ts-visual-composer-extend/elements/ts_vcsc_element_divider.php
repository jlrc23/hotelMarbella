<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                      => __( "TS Divider", "js_composer" ),
            "base"                      => "TS-VCSC-Divider",
            "icon" 	                    => "icon-wpb-ts_vcsc_divider",
            "class"                     => "",
            "category"                  => __( 'VC Extensions', 'js_composer' ),
            "description"               => __("Place a divider line element", "js_composer"),
            //"admin_enqueue_js"        => array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"       => array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
            "params"                    => array(
                // Divider Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_1",
                    "value"             => "Divider Settings",
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Divider Type", "js_composer" ),
                    "param_name"        => "divider_type",
                    "width"             => 150,
                    "value"             => array(
                        __( 'Simple Border', "js_composer" )        => "ts-divider-border",
                        __( 'Divider with Text', "js_composer" )    => "ts-divider-lines",
                        __( 'Divider with Image', "js_composer" )   => "ts-divider-images",
                        __( 'Divider with Icon', "js_composer" )    => "ts-divider-icons",
                        __( 'Divider To Top', "js_composer" )       => "ts-divider-top",
                        __( 'Simple Style 1', "js_composer" )		=> "ts-divider-one",
                        __( 'Simple Style 2', "js_composer" )		=> "ts-divider-two",
                        __( 'Simple Style 3', "js_composer" )		=> "ts-divider-three",
                        __( 'Simple Style 4', "js_composer" )		=> "ts-divider-four",
                        __( 'Simple Style 5', "js_composer" )		=> "ts-divider-five",
                        __( 'Simple Style 6', "js_composer" )		=> "ts-divider-six",
                        __( 'Simple Style 7', "js_composer" )		=> "ts-divider-seven",
                    ),
                    "admin_label"       => true,
                    "description"       => __( "Select where the icon should be positioned.", "js_composer" )
                ),
                // Text Divider Settings
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Divider Text Position", "js_composer" ),
                    "param_name"        => "divider_text_position",
                    "width"             => 300,
                    "value"             => $this->TS_VCSC_DividerText_Position,
                    "description"       => __( "Select the position of the text in the divider.", "js_composer" ),
                    "dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-lines' )
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Divider Text", "js_composer" ),
                    "param_name"        => "divider_text_content",
                    "value"             => "",
                    "description"       => __( "Enter the text within the divider.", "js_composer" ),
                    "dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-lines' )
                ),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Divider Color", "js_composer" ),
					"param_name"        => "divider_text_border",
					"value"             => "#eeeeee",
					"description"       => __( "Define the color of the divider line.", "js_composer" ),
					"dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-lines' )
				),
                // Image Divider Settings
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Divider Image / Icon Position", "js_composer" ),
                    "param_name"        => "divider_image_position",
                    "width"             => 300,
                    "value"             => $this->TS_VCSC_DividerText_Position,
                    "description"       => __( "Select the position of the image in the divider.", "js_composer" ),
                    "dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-images' )
                ),
				array(
					"type"              => "attach_image",
					"heading"           => __( "Select Image", "js_composer" ),
					"param_name"        => "divider_image_content",
					"value"             => "",
					"description"       => __( "Image should have equal dimensions for scaling purposes (i.e. 100x100)", "js_composer" ),
					"dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-images' )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Divider Color", "js_composer" ),
					"param_name"        => "divider_image_border",
					"value"             => "#eeeeee",
					"description"       => __( "Define the color of the divider line.", "js_composer" ),
					"dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-images' )
				),
                // Icon Devider Settings
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Divider Icon Position", "js_composer" ),
                    "param_name"        => "divider_icon_position",
                    "width"             => 300,
                    "value"             => $this->TS_VCSC_DividerText_Position,
                    "description"       => __( "Select the position of the icon in the divider.", "js_composer" ),
                    "dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-icons' )
                ),
				array(
					"type"              => "icons_panel",
					"heading"           => __( "Select Icon", "js_composer" ),
					"param_name"        => "divider_icon_content",
					"value"             => $this->TS_VCSC_List_Icons_Full,
					"description"       => __( "Select the icon you want to display.", "js_composer" ),
					"dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-icons' )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon Color", "js_composer" ),
					"param_name"        => "divider_icon_color",
					"value"             => "#cccccc",
					"description"       => __( "Define the color of the icon.", "js_composer" ),
					"dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-icons' )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Divider Color", "js_composer" ),
					"param_name"        => "divider_icon_border",
					"value"             => "#eeeeee",
					"description"       => __( "Define the color of the divider line.", "js_composer" ),
					"dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-icons' )
				),
                // Simple Border Settings
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Divider Border Type", "js_composer" ),
                    "param_name"        => "divider_border_type",
                    "width"             => 300,
                    "value"             => $this->TS_VCSC_DividerBorder_Type,
                    "description"       => __( "Select the type of divider border.", "js_composer" ),
                    "dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-border' )
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Divider Border Thickness", "js_composer" ),
                    "param_name"        => "divider_border_thick",
                    "value"             => "1",
                    "min"               => "1",
                    "max"               => "10",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "Define the thickness of the divider border.", "js_composer" ),
                    "dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-border' )
                ),
                array(
                    "type"              => "colorpicker",
                    "heading"           => __( "Divider Border Color", "js_composer" ),
                    "param_name"        => "divider_border_color",
                    "value"             => "#eeeeee",
                    "description"       => __( "Define the color of the divider border.", "js_composer" ),
                    "dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-border' )
                ),
                // To Top Divider Settings
                array(
                    "type"              => "textfield",
                    "heading"           => __( "To Top Text", "js_composer" ),
                    "param_name"        => "divider_top_content",
                    "value"             => "",
                    "description"       => __( "Enter the text for the divider.", "js_composer" ),
                    "dependency"        => array( 'element' => "divider_type", 'value' => 'ts-divider-top' )
                ),
                // Other Divider Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_2",
                    "value"             => "Other Settings",
                    "description"       => __( "", "js_composer" ),
					"group" 			=> "Other Settings",
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Margin Top", "js_composer" ),
                    "param_name"        => "margin_top",
                    "value"             => "20",
                    "min"               => "-50",
                    "max"               => "500",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "Select the top margin for the divider.", "js_composer" ),
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
                    "description"       => __( "Select the bottom margin for the divider.", "js_composer" ),
					"group" 			=> "Other Settings",
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Define ID Name", "js_composer" ),
                    "param_name"        => "el_id",
                    "value"             => "",
                    "description"       => __( "Enter an unique ID for the divider.", "js_composer" ),
					"group" 			=> "Other Settings",
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Extra Class Name", "js_composer" ),
                    "param_name"        => "el_class",
                    "value"             => "",
                    "description"       => __( "Enter a class name for the divider.", "js_composer" ),
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