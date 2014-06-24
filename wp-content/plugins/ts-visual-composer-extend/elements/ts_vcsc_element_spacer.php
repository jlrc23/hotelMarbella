<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                      => __( "TS Spacer / Clear", "js_composer" ),
            "base"                      => "TS-VCSC-Spacer",
            "icon" 	                    => "icon-wpb-ts_vcsc_spacer",
            "class"                     => "",
            "category"                  => __( 'VC Extensions', 'js_composer' ),
            "description"               => __("Place a spacer / clear element", "js_composer"),
            //"admin_enqueue_js"        => array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"       => array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
            "params"                    => array(
                // Spacer Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_1",
                    "value"             => "Spacer Dimensions",
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Height in px", "js_composer" ),
                    "param_name"        => "height",
                    "value"             => "10",
                    "min"               => "0",
                    "max"               => "500",
                    "step"              => "1",
                    "unit"              => 'px',
                    "admin_label"           => true,
                    "description"       => __( "", "js_composer" )
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