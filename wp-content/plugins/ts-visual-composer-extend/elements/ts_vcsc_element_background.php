<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                              => __( "TS YouTube Background", "js_composer" ),
            "base"                              => "TS-VCSC-YouTube-Background",
            "icon" 	                            => "icon-wpb-ts_vcsc_background_youtube",
            "class"                             => "",
            "category"                          => __( 'VC Extensions', 'js_composer' ),
            "description"                       => __("Place a YouTube Video as page background.", "js_composer"),
            //"admin_enqueue_js"                => array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"               => array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
            "params"                            => array(
                // Divider Settings
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_1",
                    "value"                     => "YouTube Background Settings",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"              		=> "textfield",
                    "heading"           		=> __( "YouTube Video ID", "js_composer" ),
                    "param_name"        		=> "video_youtube",
                    "value"             		=> "",
                    "admin_label" 				=> true,
                    "description"       		=> __( "Enter the YouTube video ID.", "js_composer" )
                ),
				array(
					"type"              		=> "switch",
                    "heading"           		=> __( "Mute Video", "js_composer" ),
                    "param_name"        		=> "video_mute",
                    "value"             		=> "true",
					"on"						=> __( 'Yes', "js_composer" ),
					"off"						=> __( 'No', "js_composer" ),
					"style"						=> "select",
					"design"					=> "toggle-light",
                    "description"           	=> __( "Switch the toggle to mute the video while playing.", "js_composer" ),
                    "dependency"            	=> ""
				),
				array(
					"type"              		=> "switch",
                    "heading"           		=> __( "Loop Video", "js_composer" ),
                    "param_name"        		=> "video_loop",
                    "value"             		=> "false",
					"on"						=> __( 'Yes', "js_composer" ),
					"off"						=> __( 'No', "js_composer" ),
					"style"						=> "select",
					"design"					=> "toggle-light",
                    "description"           	=> __( "Switch the toggle to loop the video after it has finished.", "js_composer" ),
                    "dependency"            	=> ""
				),
				array(
					"type"              		=> "switch",
                    "heading"           		=> __( "Start Video on Pageload", "js_composer" ),
                    "param_name"        		=> "video_start",
                    "value"             		=> "false",
					"on"						=> __( 'Yes', "js_composer" ),
					"off"						=> __( 'No', "js_composer" ),
					"style"						=> "select",
					"design"					=> "toggle-light",
                    "description"           	=> __( "Switch the toggle to if you want to start the video once the page has loaded.", "js_composer" ),
                    "dependency"            	=> ""
				),
				array(
					"type"              		=> "switch",
                    "heading"           		=> __( "Show Video Controls", "js_composer" ),
                    "param_name"        		=> "video_controls",
                    "value"             		=> "true",
					"on"						=> __( 'Yes', "js_composer" ),
					"off"						=> __( 'No', "js_composer" ),
					"style"						=> "select",
					"design"					=> "toggle-light",
                    "description"           	=> __( "Switch the toggle to if you want to show basic video controls.", "js_composer" ),
                    "dependency"            	=> ""
				),
				array(
					"type"              		=> "switch",
                    "heading"           		=> __( "Show Raster over Video", "js_composer" ),
                    "param_name"        		=> "video_raster",
                    "value"             		=> "false",
					"on"						=> __( 'Yes', "js_composer" ),
					"off"						=> __( 'No', "js_composer" ),
					"style"						=> "select",
					"design"					=> "toggle-light",
                    "description"           	=> __( "Switch the toggle to if you want to show a raster over the video.", "js_composer" ),
                    "dependency"            	=> ""
				),
				// Load Custom CSS/JS File
				array(
					"type"                      => "load_file",
					"heading"                   => __( "", "js_composer" ),
                    "param_name"                => "el_file",
					"value"                     => "",
					"file_type"                 => "js",
					"file_path"                 => "js/ts-visual-composer-extend-element.min.js",
					"description"               => __( "", "js_composer" )
				),
            ))
        );
    }
?>