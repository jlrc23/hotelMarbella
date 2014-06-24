<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                      => __( "TS Google Trends", "js_composer" ),
            "base"                      => "TS-VCSC-Google-Trends",
            "icon" 	                    => "icon-wpb-ts_vcsc_google_trends",
            "class"                     => "",
            "category"                  => __( 'VC Extensions', 'js_composer' ),
            "description"               => __("Place a Google Trends element", "js_composer"),
            //"admin_enqueue_js"        => array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"       => array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
            "params"                    => array(
                // Google Trends Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_1",
                    "value"             => "Google Trend Settings",
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Height in px", "js_composer" ),
                    "param_name"        => "trend_height",
                    "value"             => "400",
                    "min"               => "100",
                    "max"               => "2048",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Width in px", "js_composer" ),
                    "param_name"        => "trend_width",
                    "value"             => "1024",
                    "min"               => "100",
                    "max"               => "2048",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "", "js_composer" )
                ),
				array(
					"type"              => "switch",
					"heading"           => __( "Show Trend Averages", "js_composer" ),
					"param_name"        => "trend_average",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
                    "description"		=> __( "Switch the toggle to show or hide trend averages.", "js_composer" ),
                    "dependency"		=> ""
				),
				array(
					"type"              => "textarea",
					"heading"           => __( "Tags", "js_composer" ),
					"param_name"        => "trend_tags",
					"value"             => "",
                    "admin_label"       => true,
					"description"       => __( "Enter the keywords (maximum of 5), seperated by comma.", "js_composer" )
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Geo-Location", "js_composer" ),
					"param_name"        => "trend_geo",
					"value"             => "US",
					"description"       => __( "Enter the Geo Location for your trend (default is US).", "js_composer" )
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