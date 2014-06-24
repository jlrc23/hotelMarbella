<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                      	=> __( "TS Textillate", "js_composer" ),
            "base"                      	=> "TS-VCSC-Textillate",
            "icon" 	                    	=> "icon-wpb-ts_vcsc_textillate",
            "class"                     	=> "",
            "category"                  	=> __( 'VC Extensions', 'js_composer' ),
            "description"               	=> __("Place a Textillate element", "js_composer"),
            //"admin_enqueue_js"        	=> array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"       	=> array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
            "params"                    	=> array(
                // Content Settings
                array(
                    "type"              	=> "seperator",
                    "heading"           	=> __( "", "js_composer" ),
                    "param_name"        	=> "seperator_1",
                    "value"             	=> "Content Settings",
                    "description"       	=> __( "", "js_composer" )
                ),
				/*array(
					"type" 					=> "vc_link",
					"heading" 				=> __("URL (Link)", "js_composer"),
					"param_name" 			=> "link",
					"description" 			=> __("Button link.", "js_composer")
				),*/
                array(
                    "type"              	=> "textfield",
                    "heading"           	=> __( "Text", "js_composer" ),
                    "param_name"        	=> "textillate",
                    "value"             	=> "",
                    "description"       	=> __( "Enter the text to be animated on viewport entry.", "js_composer" ),
                    "dependency"        	=> ""
                ),
                array(
                    "type"              	=> "nouislider",
                    "heading"           	=> __( "Font Size", "js_composer" ),
                    "param_name"        	=> "font_size",
                    "value"             	=> "36",
                    "min"               	=> "16",
                    "max"               	=> "512",
                    "step"              	=> "1",
                    "unit"              	=> 'px',
                    "description"       	=> __( "Select the font size for the animated text.", "js_composer" ),
                    "dependency"        	=> ""
                ),
                array(
                    "type"              	=> "colorpicker",
                    "heading"           	=> __( "Font Color", "js_composer" ),
                    "param_name"        	=> "font_color",
                    "value"             	=> "#000000",
                    "description"      	 	=> __( "Define the font color for the animated text.", "js_composer" ),
                    "dependency"        	=> ""
                ),
                array(
                    "type"              	=> "dropdown",
                    "heading"           	=> __( "Font Weight", "js_composer" ),
                    "param_name"        	=> "font_weight",
                    "width"             	=> 150,
                    "value"             	=> array(
                        __( 'Default', "js_composer" )  => "inherit",
                        __( 'Bold', "js_composer" )     => "bold",
                        __( 'Bolder', "js_composer" )   => "bolder",
                        __( 'Normal', "js_composer" )   => "normal",
                        __( 'Light', "js_composer" )    => "300",
                    ),
                    "description"       	=> __( "Select the font weight for the animated text.", "js_composer" )
                ),
				array(
					"type"              	=> "dropdown",
					"heading"           	=> __( "Text Align", "js_composer" ),
					"param_name"        	=> "font_align",
					"width"             	=> 150,
                    "value"             	=> array(
                        __( 'Left', "js_composer" )  		=> "left",
                        __( 'Right', "js_composer" )     	=> "right",
                        __( 'Center', "js_composer" )   	=> "center",
                        __( 'Justify', "js_composer" )   	=> "justify",
                    ),
					"description"       	=> __( "Select the alignment for the animated text.", "js_composer" ),
					"dependency"        	=> ""
				),
				array(
					"type"              	=> "switch",
                    "heading"           	=> __( "Use Theme Defined Font", "js_composer" ),
                    "param_name"        	=> "font_theme",
                    "value"             	=> "true",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"       	=> __( "Switch the toggle to either use the theme default font or a custom font.", "js_composer" ),
                    "dependency"        	=> ""
				),
                array(
                    "type"              	=> "fonts",
                    "heading"           	=> __( "Font Family", "js_composer" ),
                    "param_name"        	=> "font_family",
                    "value"             	=> "",
                    "description"       	=> __( "Select the font to be used for the icon title text.", "js_composer" ),
                    "dependency"        	=> array( 'element' => "font_theme", 'value' => 'false' )
                ),
                array(
                    "type"              	=> "hidden_input",
                    "param_name"        	=> "font_type",
                    "value"             	=> "",
                    "description"       	=> __( "", "js_composer" )
                ),
				
                // Content Settings
                array(
                    "type"              	=> "seperator",
                    "heading"           	=> __( "", "js_composer" ),
                    "param_name"        	=> "seperator_2",
                    "value"             	=> "Animation Settings",
                    "description"       	=> __( "", "js_composer" )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "In-Animation Type", "js_composer" ),
                    "param_name"            => "animation_in",
                    "value"                 => array(
						__( 'Bounce', "js_composer" )					=> "bounce",
						__( 'Bounce In', "js_composer" )				=> "bounceIn",
						__( 'Bounce In Down', "js_composer" )			=> "bounceInDown",
						__( 'Bounce In Up', "js_composer" )				=> "bounceInUp",
						__( 'Bounce In Left', "js_composer" )			=> "bounceInLeft",
						__( 'Bounce In Right', "js_composer" )			=> "bounceInRight",
						__( 'Bounce Out', "js_composer" )				=> "bounceOut",
						__( 'Bounce Out Down', "js_composer" )			=> "bounceOutDown",
						__( 'Bounce Out Up', "js_composer" )			=> "bounceOutUp",
						__( 'Bounce Out Left', "js_composer" )			=> "bounceOutLeft",
						__( 'Bounce Out Right', "js_composer" )			=> "bounceOutRight",
						__( 'Fade In', "js_composer" )					=> "fadeIn",
						__( 'Fade In Up', "js_composer" )				=> "fadeInUp",
						__( 'Fade In Down', "js_composer" )				=> "fadeInDown",
						__( 'Fade In Left', "js_composer" )				=> "fadeInLeft",
						__( 'Fade In Right', "js_composer" )			=> "fadeInRight",
						__( 'Fade In Up Big', "js_composer" )			=> "fadeInUpBig",
						__( 'Fade In Down Big', "js_composer" )			=> "fadeInDownBig",
						__( 'Fade In Left Big', "js_composer" )			=> "fadeInLeftBig",
						__( 'Fade In Right Big', "js_composer" )		=> "fadeInRightBig",
						__( 'Fade Out', "js_composer" )					=> "fadeOut",
						__( 'Fade Out Up', "js_composer" )				=> "fadeOutUp",
						__( 'Fade Out Down', "js_composer" )			=> "fadeOutDown",
						__( 'Fade Out Left', "js_composer" )			=> "fadeOutLeft",
						__( 'Fade Out Right', "js_composer" )			=> "fadeOutRight",
						__( 'Fade Out Up Big', "js_composer" )			=> "fadeOutUpBig",
						__( 'Fade Out Down Big', "js_composer" )		=> "fadeOutDownBig",
						__( 'Fade Out Left Big', "js_composer" )		=> "fadeOutLeftBig",
						__( 'Fade Out Right Big', "js_composer" )		=> "fadeOutRightBig",
						__( 'Flash', "js_composer" )					=> "flash",
						__( 'Flip', "js_composer" )						=> "flip",
						__( 'Flip In X', "js_composer" )				=> "flipInX",
						__( 'Flip Out X', "js_composer" )				=> "flipOutX",
						__( 'Flip In Y', "js_composer" )				=> "flipInY",
						__( 'Flip Out Y', "js_composer" )				=> "flipOutY",
						__( 'Hinge', "js_composer" )					=> "hinge",
						__( 'Pulse', "js_composer" )					=> "pulse",
						__( 'Roll In', "js_composer" )					=> "rollIn",
						__( 'Roll Out', "js_composer" )					=> "rollOut",
						__( 'Rotate Full', "js_composer" )				=> "rotateFull",
						__( 'Rotate In', "js_composer" )				=> "rotateIn",
						__( 'Rotate In Down Left', "js_composer" )		=> "rotateInDownLeft",
						__( 'Rotate In Down Right', "js_composer" )		=> "rotateInDownRight",
						__( 'Rotate In Up Left', "js_composer" )		=> "rotateInUpLeft",
						__( 'Rotate In Up Right', "js_composer" )		=> "rotateInUpRight",
						__( 'Rotate Out', "js_composer" )				=> "rotateOut",
						__( 'Rotate Out Down Left', "js_composer" )		=> "rotateOutDownLeft",
						__( 'Rotate Out Down Right', "js_composer" )	=> "rotateOutDownRight",
						__( 'Rotate Out Up Left', "js_composer" )		=> "rotateOutUpLeft",
						__( 'Rotate Out Up Right', "js_composer" )		=> "rotateOutUpRight",
						__( 'Shake', "js_composer" )					=> "shake",
						__( 'Swing', "js_composer" )					=> "swing",
						__( 'Tada', "js_composer" )						=> "tada",
						__( 'Wobble', "js_composer" )					=> "wobble",
					),
                    "description"           => __( "Select the in-animation type for the text string.", "js_composer" ),
					"admin_label"       	=> true,
                    "dependency"            => ""
                ),
                array(
                    "type"              	=> "dropdown",
                    "heading"           	=> __( "In-Animation Order", "js_composer" ),
                    "param_name"        	=> "text_order_in",
                    "width"             	=> 150,
                    "value"             	=> array(
						__( 'Sequence', "js_composer" )			=> "sequence",
                        __( 'Reverse', "js_composer" )			=> "reverse",
                        __( 'Sync', "js_composer" )        		=> "sync",
						__( 'Shuffle', "js_composer" )        	=> "shuffle",
                    ),
                    "description"       	=> __( "Select how the in-animation should animate the individual characters.", "js_composer" )
                ),
				array(
					"type"					=> "switch",
					"heading"           	=> __( "Loop Animation", "js_composer" ),
					"param_name"        	=> "animation_loop",
					"value"             	=> "false",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"admin_label"       	=> true,
					"description"       	=> __( "Switch the toggle if you want to loop (repeat) the text animation.", "js_composer" ),
                    "dependency"        	=> ""
				),
                array(
                    "type"              	=> "nouislider",
                    "heading"           	=> __( "Animation Pause", "js_composer" ),
                    "param_name"        	=> "animation_pause",
                    "value"             	=> "4000",
                    "min"               	=> "1000",
                    "max"               	=> "20000",
                    "step"              	=> "100",
                    "unit"              	=> 'ms',
                    "description"       	=> __( "Select for how long the etxt should be shown until loop starts over.", "js_composer" ),
					"dependency"        	=> array( 'element' => "animation_loop", 'value' => 'true' )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Out-Animation Type", "js_composer" ),
                    "param_name"            => "animation_out",
                    "value"                 => array(
						__( 'Bounce', "js_composer" )					=> "bounce",
						__( 'Bounce In', "js_composer" )				=> "bounceIn",
						__( 'Bounce In Down', "js_composer" )			=> "bounceInDown",
						__( 'Bounce In Up', "js_composer" )				=> "bounceInUp",
						__( 'Bounce In Left', "js_composer" )			=> "bounceInLeft",
						__( 'Bounce In Right', "js_composer" )			=> "bounceInRight",
						__( 'Bounce Out', "js_composer" )				=> "bounceOut",
						__( 'Bounce Out Down', "js_composer" )			=> "bounceOutDown",
						__( 'Bounce Out Up', "js_composer" )			=> "bounceOutUp",
						__( 'Bounce Out Left', "js_composer" )			=> "bounceOutLeft",
						__( 'Bounce Out Right', "js_composer" )			=> "bounceOutRight",
						__( 'Fade In', "js_composer" )					=> "fadeIn",
						__( 'Fade In Up', "js_composer" )				=> "fadeInUp",
						__( 'Fade In Down', "js_composer" )				=> "fadeInDown",
						__( 'Fade In Left', "js_composer" )				=> "fadeInLeft",
						__( 'Fade In Right', "js_composer" )			=> "fadeInRight",
						__( 'Fade In Up Big', "js_composer" )			=> "fadeInUpBig",
						__( 'Fade In Down Big', "js_composer" )			=> "fadeInDownBig",
						__( 'Fade In Left Big', "js_composer" )			=> "fadeInLeftBig",
						__( 'Fade In Right Big', "js_composer" )		=> "fadeInRightBig",
						__( 'Fade Out', "js_composer" )					=> "fadeOut",
						__( 'Fade Out Up', "js_composer" )				=> "fadeOutUp",
						__( 'Fade Out Down', "js_composer" )			=> "fadeOutDown",
						__( 'Fade Out Left', "js_composer" )			=> "fadeOutLeft",
						__( 'Fade Out Right', "js_composer" )			=> "fadeOutRight",
						__( 'Fade Out Up Big', "js_composer" )			=> "fadeOutUpBig",
						__( 'Fade Out Down Big', "js_composer" )		=> "fadeOutDownBig",
						__( 'Fade Out Left Big', "js_composer" )		=> "fadeOutLeftBig",
						__( 'Fade Out Right Big', "js_composer" )		=> "fadeOutRightBig",
						__( 'Flash', "js_composer" )					=> "flash",
						__( 'Flip', "js_composer" )						=> "flip",
						__( 'Flip In X', "js_composer" )				=> "flipInX",
						__( 'Flip Out X', "js_composer" )				=> "flipOutX",
						__( 'Flip In Y', "js_composer" )				=> "flipInY",
						__( 'Flip Out Y', "js_composer" )				=> "flipOutY",
						__( 'Hinge', "js_composer" )					=> "hinge",
						__( 'Pulse', "js_composer" )					=> "pulse",
						__( 'Roll In', "js_composer" )					=> "rollIn",
						__( 'Roll Out', "js_composer" )					=> "rollOut",
						__( 'Rotate Full', "js_composer" )				=> "rotateFull",
						__( 'Rotate In', "js_composer" )				=> "rotateIn",
						__( 'Rotate In Down Left', "js_composer" )		=> "rotateInDownLeft",
						__( 'Rotate In Down Right', "js_composer" )		=> "rotateInDownRight",
						__( 'Rotate In Up Left', "js_composer" )		=> "rotateInUpLeft",
						__( 'Rotate In Up Right', "js_composer" )		=> "rotateInUpRight",
						__( 'Rotate Out', "js_composer" )				=> "rotateOut",
						__( 'Rotate Out Down Left', "js_composer" )		=> "rotateOutDownLeft",
						__( 'Rotate Out Down Right', "js_composer" )	=> "rotateOutDownRight",
						__( 'Rotate Out Up Left', "js_composer" )		=> "rotateOutUpLeft",
						__( 'Rotate Out Up Right', "js_composer" )		=> "rotateOutUpRight",
						__( 'Shake', "js_composer" )					=> "shake",
						__( 'Swing', "js_composer" )					=> "swing",
						__( 'Tada', "js_composer" )						=> "tada",
						__( 'Wobble', "js_composer" )					=> "wobble",
					),
                    "description"           => __( "Select the out-animation type for the text string.", "js_composer" ),
					"dependency"        	=> array( 'element' => "animation_loop", 'value' => 'true' )
                ),
                array(
                    "type"              	=> "dropdown",
                    "heading"           	=> __( "Out-Animation Order", "js_composer" ),
                    "param_name"        	=> "text_order_out",
                    "width"             	=> 150,
                    "value"             	=> array(
						__( 'Sequence', "js_composer" )			=> "sequence",
                        __( 'Reverse', "js_composer" )			=> "reverse",
                        __( 'Sync', "js_composer" )        		=> "sync",
						__( 'Shuffle', "js_composer" )        	=> "shuffle",
                    ),
                    "description"       	=> __( "Select how the in-animation should animate the individual characters.", "js_composer" ),
					"dependency"        	=> array( 'element' => "animation_loop", 'value' => 'true' )
                ),
                // Other Settings
                array(
                    "type"              	=> "seperator",
                    "heading"           	=> __( "", "js_composer" ),
                    "param_name"        	=> "seperator_3",
                    "value"             	=> "Other Settings",
                    "description"       	=> __( "", "js_composer" ),
					"group"					=> "Other Settings",
                ),
                array(
                    "type"              	=> "nouislider",
                    "heading"           	=> __( "Margin Top", "js_composer" ),
                    "param_name"        	=> "margin_top",
                    "value"             	=> "0",
                    "min"               	=> "-50",
                    "max"               	=> "500",
                    "step"              	=> "1",
                    "unit"              	=> 'px',
                    "description"       	=> __( "Select the top margin for the icon title.", "js_composer" ),
					"group"					=> "Other Settings",
                ),
                array(
                    "type"              	=> "nouislider",
                    "heading"           	=> __( "Margin Bottom", "js_composer" ),
                    "param_name"        	=> "margin_bottom",
                    "value"             	=> "0",
                    "min"               	=> "-50",
                    "max"               	=> "500",
                    "step"              	=> "1",
                    "unit"              	=> 'px',
                    "description"       	=> __( "Select the bottom margin for the icon title.", "js_composer" ),
					"group"					=> "Other Settings",
                ),
                array(
                    "type"              	=> "textfield",
                    "heading"           	=> __( "Define ID Name", "js_composer" ),
                    "param_name"        	=> "el_id",
                    "value"             	=> "",
                    "description"       	=> __( "Enter an unique ID for the icon title.", "js_composer" ),
					"group"					=> "Other Settings",
                ),
                array(
                    "type"              	=> "textfield",
                    "heading"           	=> __( "Extra Class Name", "js_composer" ),
                    "param_name"        	=> "el_class",
                    "value"             	=> "",
                    "description"       	=> __( "Enter a class name for the icon title.", "js_composer" ),
					"group"					=> "Other Settings",
                ),
				// Load Custom CSS/JS File
				array(
					"type"              	=> "load_file",
					"heading"           	=> __( "", "js_composer" ),
                    "param_name"        	=> "el_file",
					"value"             	=> "",
					"file_type"         	=> "js",
					"file_path"         	=> "js/ts-visual-composer-extend-element.min.js",
					"description"       	=> __( "", "js_composer" )
				),
            ))
        );
    }
?>