<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                      => __( "TS Shortcode", "js_composer" ),
            "base"                      => "TS-VCSC-Shortcode",
            "icon" 	                    => "icon-wpb-ts_vcsc_shortcode",
            "class"                     => "",
            "category"                  => __( 'VC Extensions', 'js_composer' ),
            "description"               => __("Place any shortcode in your page", "js_composer"),
            //"admin_enqueue_js"        => array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"       => array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
            "params"                    => array(
                // Shortcode Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_1",
                    "value"             => "Shortcode Input",
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "textarea_raw_html",
                    "class"             => "",
                    "heading"           => __( "Shortcode", 'js_composer' ),
                    "param_name"        => "tscode",
                    "value"             => base64_encode(""),
					"description"       => __( "Enter the shortcode with its full syntax here.", "js_composer" ),
                    "dependency"		=> ""
                ),
                array(
                    "type"				=> "hidden_textarea",
                    "class"				=> "",
                    "heading"			=> __( "Shortcode", 'js_composer' ),
                    "param_name"		=> "tscodenormal",
                    "value"				=> "",
					"description"       => __( "", "js_composer" ),
					"admin_label"		=> true,
                    "dependency"		=> ""
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