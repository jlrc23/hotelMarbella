<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                      => __( "TS Google Docs", "js_composer" ),
            "base"                      => "TS-VCSC-Google-Docs",
            "icon" 	                    => "icon-wpb-ts_vcsc_google_docs",
            "class"                     => "",
            "category"                  => __( 'VC Extensions', 'js_composer' ),
            "description"               => __("Place a Google Doc element", "js_composer"),
            //"admin_enqueue_js"        => array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"       => array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
            "params"                    => array(
                // Google Doc Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_1",
                    "value"             => "Google Document",
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Doc Type", "js_composer" ),
                    "param_name"        => "doc_type",
                    "width"             => 150,
                    "value"             => array(
                        __( 'Document', "js_composer" )         => "document",
                        __( 'Presentation', "js_composer" )     => "presentation",
                        __( 'Spreadsheet', "js_composer" )      => "spreadsheet",
                        __( 'Drawing', "js_composer" )          => "drawing",
                        __( 'Form', "js_composer" )             => "form",
                    ),
                    "admin_label"       => true,
                    "description"       => __( "Select the type of Google Doc file you want to embed.", "js_composer" )
                ),
				array(
					"type"              => "textfield",
					"heading"           => __( "Doc Key", "js_composer" ),
					"param_name"        => "doc_key",
					"value"             => "",
                    "admin_label"       => true,
					"description"       => __( "Enter the key number for the Google Doc file.", "js_composer" )
				),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Height in px", "js_composer" ),
                    "param_name"        => "doc_height",
                    "value"             => "500",
                    "min"               => "100",
                    "max"               => "2048",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "Define the height for the Google Doc file.", "js_composer" )
                ),
				array(
					"type"              => "switch",
					"heading"           => __( "Editable Share Document", "js_composer" ),
					"param_name"        => "doc_share",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle if the document will be shared as editable.", "js_composer" ),
                    "dependency"        => ""
				),
				array(
					"type"              => "switch",
					"heading"           => __( "Slide Auto Start", "js_composer" ),
					"param_name"        => "doc_presentation_auto",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle if the slides should auto start.", "js_composer" ),
                    "dependency"        => array( 'element' => "doc_type", 'value' => 'presentation' )
				),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Slide Speed", "js_composer" ),
                    "param_name"        => "doc_presentation_speed",
                    "value"             => "10000",
                    "min"               => "1000",
                    "max"               => "50000",
                    "step"              => "100",
                    "unit"              => 'ms',
                    "description"       => __( "Define the speed in which slides should auto rotate.", "js_composer" ),
                    "dependency"        => array( 'element' => "doc_type", 'value' => 'presentation' )
                ),
				array(
					"type"              => "switch",
					"heading"           => __( "Slide Auto Loop", "js_composer" ),
					"param_name"        => "doc_presentation_loop",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle if the slides loop and automatically start a new cycle.", "js_composer" ),
                    "dependency"        => array( 'element' => "doc_type", 'value' => 'presentation' )
				),
				// Icon Border Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_2",
					"value"             => "Icon / Image Border Settings",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Google Document Border Type", "js_composer" ),
					"param_name"        => "doc_frame_type",
					"width"             => 300,
					"value"             => $this->TS_VCSC_Border_Type,
					"description"       => __( "Select the type of border around the Google Document.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Google Document Border Thickness", "js_composer" ),
					"param_name"        => "doc_frame_thick",
					"value"             => "1",
					"min"               => "1",
					"max"               => "10",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Define the thickness of the border around the Google Document.", "js_composer" ),
					"dependency"        => array( 'element' => "doc_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Google Document Frame Border Color", "js_composer" ),
					"param_name"        => "doc_frame_color",
					"value"             => "#dddddd",
					"description"       => __( "Define the color the border around the Google Document.", "js_composer" ),
					"dependency"        => array( 'element' => "doc_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				// Other Google Docs Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_3",
					"value"             => "Other Google Doc Settings",
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