<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                      => __( "Quform", "js_composer" ),
            "base"                      => "iphorm",
            "icon" 	                    => "icon-wpb-ts_quform_builder",
            "class"                     => "",
            "category"                  => __( '3rd Party Plugins', 'js_composer' ),
            "description"               => __("Place a Quform form element", "js_composer"),
            //"admin_enqueue_js"        => array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"       => array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
            "params"                    => array(
                // Spacer Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_1",
                    "value"             => "Quform Form",
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"				=> "quform",
                    "class"				=> "",
                    "heading"			=> __( "Select Form", 'js_composer' ),
                    "param_name"		=> "id",
                    "value"				=> "",
                    "description"		=> __( "Select the Quform Form you want to insert.", 'js_composer' )
                ),
                array(
                    "type"              => "hidden_input",
                    "heading"           => __( "Form Name", "js_composer" ),
                    "param_name"        => "name",
                    "value"             => "",
					"admin_label"		=> true,
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "messenger",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "messenger",
					"color"				=> "#FF0000",
					"weight"			=> "bold",
                    "value"             => "Please make sure that the QuForm Plugin is installed and activated.",
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