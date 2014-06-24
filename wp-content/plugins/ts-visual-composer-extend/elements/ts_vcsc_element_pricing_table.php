<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                          => __( "TS Pricing Table", 'js_composer' ),
            "base"                          => "TS-VCSC-Pricing-Table",
            "icon"                          => "icon-wpb-ts_vcsc_pricing_table",
            "class"                         => "",
            "category"                      => __( "VC Extensions", "js_composer" ),
            "description" 		            => __("Place a pricing table", "js_composer"),
            //"admin_enqueue_js"            => array(ts_fb_get_resource_url('/js/...')),
            //"admin_enqueue_css"           => array(ts_fb_get_resource_url('/css/...')),
            "params"                        => array(
				// Pricing Table Settings
				array(
					"type"				    => "seperator",
					"heading"			    => __( "", "js_composer" ),
					"param_name"		    => "seperator_1",
					"value"				    => "Pricing Table Settings",
					"description"		    => __( "", "js_composer" ),
                    "dependency"            => "",
				),
                array(
                    "type"			        => "dropdown",
                    "class"			        => "",
                    "heading"               => __( "Design", 'js_composer' ),
                    "param_name"            => "style",
                    "admin_label"           => true,
                    "value"			        => array(
                        __( "Style 1", "")          => "1",
                        __( "Style 2", "" )         => "2",
                        __( "Style 3", "" )         => "3",
                        __( "Style 4", "" )         => "4",
                        __( "Style 5", "" )         => "5",
                    ),
                ),
                array(
                    "type"                  => "switch",
                    "heading"               => __( "Featured Table", "js_composer" ),
                    "param_name"            => "featured",
                    "value"                 => "false",
                    "on"				    => __( 'Yes', "js_composer" ),
                    "off"				    => __( 'No', "js_composer" ),
                    "style"				    => "select",
                    "design"			    => "toggle-light",
                    "description"           => __( "Switch the toggle if this table will be a featured table..", "js_composer" ),
                    "dependency"            => ""
                ),
                array(
                    "type"                  => "textfield",
                    "class"                 => "",
                    "heading"               => __( "Plan", 'js_composer' ),
                    "param_name"            => "featured_text",
                    "value"                 => "Recommended",
                    "dependency"            => array( 'element' => "style", 'value' => "3" )
                ),
                array(
                    "type"                  => "textfield",
                    "class"                 => "",
                    "heading"               => __( "Plan", 'js_composer' ),
                    "param_name"            => "plan",
                    "value"                 => "Basic",
                    "admin_label"           => true,
                ),
                array(
                    "type"                  => "textfield",
                    "class"                 => "",
                    "heading"               => __( "Cost", 'js_composer' ),
                    "param_name"            => "cost",
                    "value"                 => "$20",
                    "admin_label"           => true,
                ),
                array(
                    "type"		            => "textfield",
                    "class"		            => "",
                    "heading"               => __( "Per (optional)", 'js_composer' ),
                    "param_name"            => "per",
                    "value"                 => "/ month",
                ),
                array(
                    "type"		            => "textarea_html",
                    "holder"                => "div",
                    "class"		            => "",
                    "heading"               => __( "Features", 'js_composer' ),
                    "param_name"            => "content",
                    "value"                 => "<ul>
                                                <li>30GB Storage</li>
                                                <li>512MB Ram</li>
                                                <li>10 databases</li>
                                                <li>1,000 Emails</li>
                                                <li>25GB Bandwidth</li>
                                            </ul>",
                ),
                array(
                    "type"			        => "textfield",
                    "class"			        => "",
                    "heading"		        => __( "Button: Text", 'js_composer' ),
                    "param_name"	        => "button_text",
                    "value"			        => "Button Text",
                    "description"	        => __( "Button: Text", 'js_composer' )
                ),
                array(
                    "type"			        => "textfield",
                    "class"			        => "",
                    "heading"		        => __( "Button: URL", 'js_composer' ),
                    "param_name"	        => "button_url",
                    "value"			        => "",
                    "description"	        => __( "Button: URL", 'js_composer' )
                ),
                array(
                    "type"			        => "dropdown",
                    "class"			        => "",
                    "heading"               => __( "Button: Link Target", 'js_composer' ),
                    "param_name"	        => "button_target",
                    "value"			        => $this->TS_VCSC_Link_Target
                ),
				// Other Settings
				array(
					"type"				    => "seperator",
					"heading"			    => __( "", "js_composer" ),
					"param_name"		    => "seperator_2",
					"value"				    => "Other Settings",
					"description"		    => __( "", "js_composer" ),
                    "dependency"            => "",
					"group" 				=> "Other Settings",
				),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Margin Top", "js_composer" ),
                    "param_name"            => "margin_top",
                    "value"                 => "0",
                    "min"                   => "0",
                    "max"                   => "200",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "", "js_composer" ),
					"group" 				=> "Other Settings",
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Margin Bottom", "js_composer" ),
                    "param_name"            => "margin_bottom",
                    "value"                 => "0",
                    "min"                   => "0",
                    "max"                   => "200",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "", "js_composer" ),
					"group" 				=> "Other Settings",
                ),
                // Load Custom CSS/JS File
                array(
                    "type"                  => "load_file",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "el_file",
                    "value"                 => "",
                    "file_type"             => "js",
                    "file_path"             => "js/ts-visual-composer-extend-element.min.js",
                    "description"           => __( "", "js_composer" )
                ),
            )
        ));
    }
?>