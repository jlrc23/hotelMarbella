<?php
    // Add Deprecated Teammate
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                              => __( "TS Single Teammate (Deprecated)", "js_composer" ),
            "base"                              => "TS-VCSC-Team-Mates",
            "icon" 	                            => "icon-wpb-ts_vcsc_team_mates",
            "class"                             => "",
            "category"                          => __( 'VC Extensions (Deprecated)', 'js_composer' ),
            "description"                       => __("Place a single teammate element", "js_composer"),
            //"admin_enqueue_js"                => array(ts_fb_get_resource_url('/js/...')),
            //"admin_enqueue_css"               => array(ts_fb_get_resource_url('/css/...')),
            "params"                            => array(
                // Teammate Selection
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_1",
                    "value"                     => "Main Content",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "teammate",
                    "heading"                   => __( "Team Member", "js_composer" ),
                    "param_name"                => "team_member",
                    "posttype"                  => "ts_team",
                    "taxonomy"                  => "ts_team_category",
                    "value"                     => "",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "hidden_input",
                    "heading"                   => __( "Member Name", "js_composer" ),
                    "param_name"                => "team_name",
                    "value"                     => "",
					"admin_label"		        => true,
                    "description"               => __( "", "js_composer" )
                ),
                // Style + Output Settings
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_2",
                    "value"                     => "Style and Output",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Design", "js_composer" ),
                    "param_name"                => "style",
                    "value"                     => array(
                        __( 'Style 1', "js_composer" )          => "style1",
                        __( 'Style 2', "js_composer" )          => "style2",
                        __( 'Style 3', "js_composer" )          => "style3",
                    ),
                    "description"               => __( "", "js_composer" ),
                    "admin_label"               => true,
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Download Button", "js_composer" ),
                    "param_name"                => "show_download",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "admin_label"		        => true,
                    "description"               => __( "Switch the toggle if you want to show the download button for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Contact Information", "js_composer" ),
                    "param_name"                => "show_contact",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "admin_label"		        => true,
                    "description"               => __( "Switch the toggle if you want to show the contact information for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Social Links", "js_composer" ),
                    "param_name"                => "show_social",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "admin_label"		        => true,
                    "description"               => __( "Switch the toggle if you want to show the social links for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Skill Bars", "js_composer" ),
                    "param_name"                => "show_skills",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "admin_label"		        => true,
                    "description"               => __( "Switch the toggle if you want to show the skill bars for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                // Social Icon Style
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_3",
                    "value"                     => "Social Icon Settings",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Style", "js_composer" ),
                    "param_name"                => "icon_style",
                    "value"                     => array(
                        "Simple"                => "simple",
                        "Square"                => "square",
                        "Rounded"               => "rounded",
                        "Circle"                => "circle",
                    ),
                ),
                array(
                    "type"                      => "colorpicker",
                    "heading"                   => __( "Icon Background Color", "js_composer" ),
                    "param_name"                => "icon_background",
                    "value"                     => "#f5f5f5",
                    "description"               => __( "", "js_composer" ),
                    "dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                      => "colorpicker",
                    "heading"                   => __( "Icon Border Color", "js_composer" ),
                    "param_name"                => "icon_frame_color",
                    "value"                     => "#f5f5f5",
                    "description"               => __( "", "js_composer" ),
                    "dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Icon Frame Border Thickness", "js_composer" ),
                    "param_name"                => "icon_frame_thick",
                    "value"                     => "1",
                    "min"                       => "1",
                    "max"                       => "10",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" ),
                    "dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Icon Margin", "js_composer" ),
                    "param_name"                => "icon_margin",
                    "value"                     => "5",
                    "min"                       => "0",
                    "max"                       => "50",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Icons Align", "js_composer" ),
                    "param_name"                => "icon_align",
                    "width"                     => 150,
                    "value"                     => array(
                        __( 'Left', "js_composer" )         => "left",
                        __( 'Right', "js_composer" )        => "right",
                        __( 'Center', "js_composer" )       => "center" ),
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Icons Hover Animation", "js_composer" ),
                    "param_name"                => "icon_hover",
                    "width"                     => 150,
                    "value"                     => $this->TS_VCSC_CSS_Hovers,
                    "description"               => __( "", "js_composer" )
                ),
                // Other Teammate Settings
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_4",
                    "value"                     => "Other Settings",
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Viewport Animation", "js_composer" ),
                    "param_name"                => "animation_view",
                    "value"                     => $this->TS_VCSC_CSS_Animations,
                    "description"               => __( "Select the viewport animation for the element.", "js_composer" ),
                    "dependency"                => array( 'element' => "animations", 'value' => 'true' ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Margin Top", "js_composer" ),
                    "param_name"                => "margin_top",
                    "value"                     => "0",
                    "min"                       => "-50",
                    "max"                       => "500",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Margin Bottom", "js_composer" ),
                    "param_name"                => "margin_bottom",
                    "value"                     => "0",
                    "min"                       => "-50",
                    "max"                       => "500",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "textfield",
                    "heading"                   => __( "Define ID Name", "js_composer" ),
                    "param_name"                => "el_id",
                    "value"                     => "",
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "textfield",
                    "heading"                   => __( "Extra Class Name", "js_composer" ),
                    "param_name"                => "el_class",
                    "value"                     => "",
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
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
    // Add Standalone Teammate
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                              => __( "TS Single Teammate", "js_composer" ),
            "base"                              => "TS_VCSC_Team_Mates_Standalone",
            "icon" 	                            => "icon-wpb-ts_vcsc_teammate_standalone",
            "class"                             => "",
            "category"                          => __( 'VC Extensions', 'js_composer' ),
            "description"                       => __("Place a single teammate element", "js_composer"),
            //"admin_enqueue_js"                => array(ts_fb_get_resource_url('/js/...')),
            //"admin_enqueue_css"               => array(ts_fb_get_resource_url('/css/...')),
            "params"                            => array(
                // Teammate Selection
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_1",
                    "value"                     => "Main Content",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "teammate",
                    "heading"                   => __( "Team Member", "js_composer" ),
                    "param_name"                => "team_member",
                    "posttype"                  => "ts_team",
                    "taxonomy"                  => "ts_team_category",
                    "value"                     => "",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "hidden_input",
                    "heading"                   => __( "Member Name", "js_composer" ),
                    "param_name"                => "team_name",
                    "value"                     => "",
                    "admin_label"		        => true,
                    "description"               => __( "", "js_composer" )
                ),
                // Style + Output Settings
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_2",
                    "value"                     => "Style and Output",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Design", "js_composer" ),
                    "param_name"                => "style",
                    "value"                     => array(
                        __( 'Style 1', "js_composer" )          => "style1",
                        __( 'Style 2', "js_composer" )          => "style2",
                        __( 'Style 3', "js_composer" )          => "style3",
                    ),
                    "description"               => __( "", "js_composer" ),
                    "admin_label"               => true,
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Download Button", "js_composer" ),
                    "param_name"                => "show_download",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "admin_label"		        => true,
                    "description"               => __( "Switch the toggle if you want to show the download button for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Contact Information", "js_composer" ),
                    "param_name"                => "show_contact",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "admin_label"		        => true,
                    "description"               => __( "Switch the toggle if you want to show the contact information for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Social Links", "js_composer" ),
                    "param_name"                => "show_social",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "admin_label"		        => true,
                    "description"               => __( "Switch the toggle if you want to show the social links for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Skill Bars", "js_composer" ),
                    "param_name"                => "show_skills",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "admin_label"		        => true,
                    "description"               => __( "Switch the toggle if you want to show the skill bars for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                // Social Icon Style
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_3",
                    "value"                     => "Social Icon Settings",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Style", "js_composer" ),
                    "param_name"                => "icon_style",
                    "value"                     => array(
                        "Simple"                => "simple",
                        "Square"                => "square",
                        "Rounded"               => "rounded",
                        "Circle"                => "circle",
                    ),
                ),
                array(
                    "type"                      => "colorpicker",
                    "heading"                   => __( "Icon Background Color", "js_composer" ),
                    "param_name"                => "icon_background",
                    "value"                     => "#f5f5f5",
                    "description"               => __( "", "js_composer" ),
                    "dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                      => "colorpicker",
                    "heading"                   => __( "Icon Border Color", "js_composer" ),
                    "param_name"                => "icon_frame_color",
                    "value"                     => "#f5f5f5",
                    "description"               => __( "", "js_composer" ),
                    "dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Icon Frame Border Thickness", "js_composer" ),
                    "param_name"                => "icon_frame_thick",
                    "value"                     => "1",
                    "min"                       => "1",
                    "max"                       => "10",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" ),
                    "dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Icon Margin", "js_composer" ),
                    "param_name"                => "icon_margin",
                    "value"                     => "5",
                    "min"                       => "0",
                    "max"                       => "50",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Icons Align", "js_composer" ),
                    "param_name"                => "icon_align",
                    "width"                     => 150,
                    "value"                     => array(
                        __( 'Left', "js_composer" )         => "left",
                        __( 'Right', "js_composer" )        => "right",
                        __( 'Center', "js_composer" )       => "center" ),
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Icons Hover Animation", "js_composer" ),
                    "param_name"                => "icon_hover",
                    "width"                     => 150,
                    "value"                     => $this->TS_VCSC_CSS_Hovers,
                    "description"               => __( "", "js_composer" )
                ),
                // Other Teammate Settings
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_4",
                    "value"                     => "Other Settings",
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Viewport Animation", "js_composer" ),
                    "param_name"                => "animation_view",
                    "value"                     => array(
                        "None"                              => "",
                        "Top to Bottom"                     => "top-to-bottom",
                        "Bottom to Top"                     => "bottom-to-top",
                        "Left to Right"                     => "left-to-right",
                        "Right to Left"                     => "right-to-left",
                        "Appear from Center"                => "appear",
                    ),
                    "description"               => __( "Select the viewport animation for the element.", "js_composer" ),
                    "dependency"                => array( 'element' => "animations", 'value' => 'true' ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Margin Top", "js_composer" ),
                    "param_name"                => "margin_top",
                    "value"                     => "0",
                    "min"                       => "-50",
                    "max"                       => "500",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Margin Bottom", "js_composer" ),
                    "param_name"                => "margin_bottom",
                    "value"                     => "0",
                    "min"                       => "-50",
                    "max"                       => "500",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "textfield",
                    "heading"                   => __( "Define ID Name", "js_composer" ),
                    "param_name"                => "el_id",
                    "value"                     => "",
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "textfield",
                    "heading"                   => __( "Extra Class Name", "js_composer" ),
                    "param_name"                => "el_class",
                    "value"                     => "",
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
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
    // Add Single Teammate (for Custom Slider)
    if (function_exists('vc_map')) {
        vc_map(array(
            "name"                           	=> __("TS Teammate Slide", 'js_composer'),
            "base"                           	=> "TS_VCSC_Team_Mates_Single",
            "class"                          	=> "",
            "icon"                           	=> "icon-wpb-ts_vcsc_teammate_single",
            "category"                       	=> __("VC Extensions", 'js_composer'),
            "content_element"                	=> true,
            "as_child"                       	=> array('only' => 'TS_VCSC_Team_Mates_Slider_Custom'),
            "description"                    	=> __("Add a teammate slide element", "js_composer"),
            "params"                         	=> array(
                // Teammate Selection
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_1",
                    "value"                     => "Main Content",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "teammate",
                    "heading"                   => __( "Team Member", "js_composer" ),
                    "param_name"                => "team_member",
                    "posttype"                  => "ts_team",
                    "taxonomy"                  => "ts_team_category",
                    "value"                     => "",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "hidden_input",
                    "heading"                   => __( "Member Name", "js_composer" ),
                    "param_name"                => "team_name",
                    "value"                     => "",
                    "admin_label"		        => true,
                    "description"               => __( "", "js_composer" )
                ),
                // Style + Output Settings
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_2",
                    "value"                     => "Style and Output",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Design", "js_composer" ),
                    "param_name"                => "style",
                    "value"                     => array(
                        __( 'Style 1', "js_composer" )          => "style1",
                        __( 'Style 2', "js_composer" )          => "style2",
                        __( 'Style 3', "js_composer" )          => "style3",
                    ),
                    "description"               => __( "", "js_composer" ),
                    "admin_label"               => true,
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Download Button", "js_composer" ),
                    "param_name"                => "show_download",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want to show the download button for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Contact Information", "js_composer" ),
                    "param_name"                => "show_contact",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want to show the contact information for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Social Links", "js_composer" ),
                    "param_name"                => "show_social",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want to show the social links for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Skill Bars", "js_composer" ),
                    "param_name"                => "show_skills",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want to show the skill bars for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                // Social Icon Style
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_3",
                    "value"                     => "Social Icon Settings",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Style", "js_composer" ),
                    "param_name"                => "icon_style",
                    "value"                     => array(
                        "Simple"                => "simple",
                        "Square"                => "square",
                        "Rounded"               => "rounded",
                        "Circle"                => "circle",
                    ),
                ),
                array(
                    "type"                      => "colorpicker",
                    "heading"                   => __( "Icon Background Color", "js_composer" ),
                    "param_name"                => "icon_background",
                    "value"                     => "#f5f5f5",
                    "description"               => __( "", "js_composer" ),
                    "dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                      => "colorpicker",
                    "heading"                   => __( "Icon Border Color", "js_composer" ),
                    "param_name"                => "icon_frame_color",
                    "value"                     => "#f5f5f5",
                    "description"               => __( "", "js_composer" ),
                    "dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Icon Frame Border Thickness", "js_composer" ),
                    "param_name"                => "icon_frame_thick",
                    "value"                     => "1",
                    "min"                       => "1",
                    "max"                       => "10",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" ),
                    "dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Icon Margin", "js_composer" ),
                    "param_name"                => "icon_margin",
                    "value"                     => "5",
                    "min"                       => "0",
                    "max"                       => "50",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Icons Align", "js_composer" ),
                    "param_name"                => "icon_align",
                    "width"                     => 150,
                    "value"                     => array(
                        __( 'Left', "js_composer" )         => "left",
                        __( 'Right', "js_composer" )        => "right",
                        __( 'Center', "js_composer" )       => "center" ),
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Icons Hover Animation", "js_composer" ),
                    "param_name"                => "icon_hover",
                    "width"                     => 150,
                    "value"                     => $this->TS_VCSC_CSS_Hovers,
                    "description"               => __( "", "js_composer" )
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
    // Add Teammates Slider 1 (Custom Build)
    if (function_exists('vc_map')) {
        vc_map(array(
           "name"                               => __("TS Teammates Slider 1", "js_composer"),
           "base"                               => "TS_VCSC_Team_Mates_Slider_Custom",
           "class"                              => "",
           "icon"                               => "icon-wpb-ts_vcsc_teammate_slider_custom",
           "category"                           => __("VC Extensions", "js_composer"),
           "as_parent"                          => array('only' => 'TS_VCSC_Team_Mates_Single'),
           "description"                        => __("Build a custom Teammate Slider", "js_composer"),
           "content_element"                    => true,
           "show_settings_on_create"            => false,
           "params"                             => array(
                // Slider Settings
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_1",
                    "value"                     => "Slider Settings",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Auto-Height", "js_composer" ),
                    "param_name"                => "auto_height",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "admin_label"		        => true,
                    "description"               => __( "Switch the toggle if you want the slider to auto-adjust its height.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Auto-Play", "js_composer" ),
                    "param_name"                => "auto_play",
                    "value"                     => "false",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "admin_label"		        => true,
                    "description"               => __( "Switch the toggle if you want the auto-play the slider on page load.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Progressbar", "js_composer" ),
                    "param_name"                => "show_bar",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want to show a progressbar during auto-play.", "js_composer" ),
                    "dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
                ),
                array(
                    "type"                      => "colorpicker",
                    "heading"                   => __( "Progressbar Color", "js_composer" ),
                    "param_name"                => "bar_color",
                    "value"                     => "#dd3333",
                    "description"               => __( "Define the color of the animated progressbar.", "js_composer" ),
                    "dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Auto-Play Speed", "js_composer" ),
                    "param_name"                => "show_speed",
                    "value"                     => "5000",
                    "min"                       => "1000",
                    "max"                       => "20000",
                    "step"                      => "100",
                    "unit"                      => 'ms',
                    "description"               => __( "Define the speed used to auto-play the slider.", "js_composer" ),
                    "dependency" 				=> array("element" 	=> "auto_play","value" 	=> "true"),
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Stop on Hover", "js_composer" ),
                    "param_name"                => "stop_hover",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want the stop the auto-play while hovering over the slider.", "js_composer" ),
                    "dependency"                => array( 'element' => "auto_play", 'value' => 'true' )
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Navigation", "js_composer" ),
                    "param_name"                => "show_navigation",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want to show left/right navigation buttons for the slider.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Transition", "js_composer" ),
                    "param_name"                => "transitions",
                    "width"                     => 150,
                    "value"                     => array(
                        __( 'Back Slide', "js_composer" )		    => "backSlide",
                        __( 'Go Down', "js_composer" )		        => "goDown",
                        __( 'Fade Up', "js_composer" )		        => "fadeUp",
                        __( 'Simple Fade', "js_composer" )		    => "fade",
                    ),
                    "description"               => __( "Select how to transition between the individual slides.", "js_composer" ),
                    "admin_label"		        => true,
                ),
                // Other Settings
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_2",
                    "value"                     => "Other Settings",
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Margin Top", "js_composer" ),
                    "param_name"                => "margin_top",
                    "value"                     => "0",
                    "min"                       => "0",
                    "max"                       => "200",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Margin Bottom", "js_composer" ),
                    "param_name"                => "margin_bottom",
                    "value"                     => "0",
                    "min"                       => "0",
                    "max"                       => "200",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "textfield",
                    "heading"                   => __( "Define ID Name", "js_composer" ),
                    "param_name"                => "el_id",
                    "value"                     => "",
                    "description"               => __( "Enter an unique ID for the Teammate Slider.", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "textfield",
                    "heading"                   => __( "Extra Class Name", "js_composer" ),
                    "param_name"                => "el_class",
                    "value"                     => "",
                    "description"               => __( "Enter a class name for the Teammate Slider.", "js_composer" ),
					"group" 			        => "Other Settings",
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
            ),
            "js_view"                           => 'VcColumnView'
        ));
    }
    // Add Teammates Slider 2 (by Categories)
    if (function_exists('vc_map')) {
        vc_map( array(
           "name"                               => __("TS Teammates Slider 2", "js_composer"),
           "base"                               => "TS_VCSC_Team_Mates_Slider_Category",
           "class"                              => "",
           "icon"                               => "icon-wpb-ts_vcsc_teammate_slider_category",
           "category"                           => __("VC Extensions", "js_composer"),
           "description"                        => __("Place a Teammate Slider (by Category)", "js_composer"),
           "params"                             => array(
                // Slider Settings
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_1",
                    "value"                     => "Slider Settings",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "teammatecat",
                    "heading"                   => __( "Teammate Categories", "js_composer" ),
                    "param_name"                => "teammatecat",
                    "posttype"                  => "ts_team",
                    "taxonomy"                  => "ts_team_category",
                    "value"                     => "",
                    "description"               => __( "Please select the teammate categories you want to use for the slider.", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Design", "js_composer" ),
                    "param_name"                => "style",
                    "value"                     => array(
                        __( 'Style 1', "js_composer" )          => "style1",
                        __( 'Style 2', "js_composer" )          => "style2",
                        __( 'Style 3', "js_composer" )          => "style3",
                    ),
                    "description"               => __( "", "js_composer" ),
                    "admin_label"               => true,
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Auto-Height", "js_composer" ),
                    "param_name"                => "auto_height",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "admin_label"		        => true,
                    "description"               => __( "Switch the toggle if you want the slider to auto-adjust its height.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Auto-Play", "js_composer" ),
                    "param_name"                => "auto_play",
                    "value"                     => "false",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "admin_label"		        => true,
                    "description"               => __( "Switch the toggle if you want the auto-play the slider on page load.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Progressbar", "js_composer" ),
                    "param_name"                => "show_bar",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want to show a progressbar during auto-play.", "js_composer" ),
                    "dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
                ),
                array(
                    "type"                      => "colorpicker",
                    "heading"                   => __( "Progressbar Color", "js_composer" ),
                    "param_name"                => "bar_color",
                    "value"                     => "#dd3333",
                    "description"               => __( "Define the color of the animated progressbar.", "js_composer" ),
                    "dependency" 				=> array("element" 	=> "auto_play", "value" 	=> "true"),
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Auto-Play Speed", "js_composer" ),
                    "param_name"                => "show_speed",
                    "value"                     => "5000",
                    "min"                       => "1000",
                    "max"                       => "20000",
                    "step"                      => "100",
                    "unit"                      => 'ms',
                    "description"               => __( "Define the speed used to auto-play the slider.", "js_composer" ),
                    "dependency" 				=> array("element" 	=> "auto_play","value" 	=> "true"),
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Stop on Hover", "js_composer" ),
                    "param_name"                => "stop_hover",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want the stop the auto-play while hovering over the slider.", "js_composer" ),
                    "dependency"                => array( 'element' => "auto_play", 'value' => 'true' )
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Navigation", "js_composer" ),
                    "param_name"                => "show_navigation",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want to show left/right navigation buttons for the slider.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Transition", "js_composer" ),
                    "param_name"                => "transitions",
                    "width"                     => 150,
                    "value"                     => array(
                        __( 'Back Slide', "js_composer" )		    => "backSlide",
                        __( 'Go Down', "js_composer" )		        => "goDown",
                        __( 'Fade Up', "js_composer" )		        => "fadeUp",
                        __( 'Simple Fade', "js_composer" )		    => "fade",
                    ),
                    "description"               => __( "Select how to transition between the individual slides.", "js_composer" ),
                    "admin_label"		        => true,
                ),
                // Teammate Settings
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_2",
                    "value"                     => "Teammate Settings",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Design", "js_composer" ),
                    "param_name"                => "style",
                    "value"                     => array(
                        __( 'Style 1', "js_composer" )          => "style1",
                        __( 'Style 2', "js_composer" )          => "style2",
                        __( 'Style 3', "js_composer" )          => "style3",
                    ),
                    "description"               => __( "", "js_composer" ),
                    "admin_label"               => true,
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Download Button", "js_composer" ),
                    "param_name"                => "show_download",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want to show the download button for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Contact Information", "js_composer" ),
                    "param_name"                => "show_contact",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want to show the contact information for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Social Links", "js_composer" ),
                    "param_name"                => "show_social",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want to show the social links for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                array(
                    "type"              	    => "switch",
                    "heading"                   => __( "Show Skill Bars", "js_composer" ),
                    "param_name"                => "show_skills",
                    "value"                     => "true",
                    "on"					    => __( 'Yes', "js_composer" ),
                    "off"					    => __( 'No', "js_composer" ),
                    "style"					    => "select",
                    "design"				    => "toggle-light",
                    "description"               => __( "Switch the toggle if you want to show the skill bars for this teammember.", "js_composer" ),
                    "dependency"                => ""
                ),
                // Social Icon Style
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_3",
                    "value"                     => "Social Icon Settings",
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Style", "js_composer" ),
                    "param_name"                => "icon_style",
                    "value"                     => array(
                        "Simple"                            => "simple",
                        "Square"                            => "square",
                        "Rounded"                           => "rounded",
                        "Circle"                            => "circle",
                    ),
                ),
                array(
                    "type"                      => "colorpicker",
                    "heading"                   => __( "Icon Background Color", "js_composer" ),
                    "param_name"                => "icon_background",
                    "value"                     => "#f5f5f5",
                    "description"               => __( "", "js_composer" ),
                    "dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                      => "colorpicker",
                    "heading"                   => __( "Icon Border Color", "js_composer" ),
                    "param_name"                => "icon_frame_color",
                    "value"                     => "#f5f5f5",
                    "description"               => __( "", "js_composer" ),
                    "dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Icon Frame Border Thickness", "js_composer" ),
                    "param_name"                => "icon_frame_thick",
                    "value"                     => "1",
                    "min"                       => "1",
                    "max"                       => "10",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" ),
                    "dependency"                => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Icon Margin", "js_composer" ),
                    "param_name"                => "icon_margin",
                    "value"                     => "5",
                    "min"                       => "0",
                    "max"                       => "50",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Icons Align", "js_composer" ),
                    "param_name"                => "icon_align",
                    "width"                     => 150,
                    "value"                     => array(
                        __( 'Left', "js_composer" )         => "left",
                        __( 'Right', "js_composer" )        => "right",
                        __( 'Center', "js_composer" )       => "center" ),
                    "description"               => __( "", "js_composer" )
                ),
                array(
                    "type"                      => "dropdown",
                    "heading"                   => __( "Icons Hover Animation", "js_composer" ),
                    "param_name"                => "icon_hover",
                    "width"                     => 150,
                    "value"                     => $this->TS_VCSC_CSS_Hovers,
                    "description"               => __( "", "js_composer" )
                ),
                // Other Settings
                array(
                    "type"                      => "seperator",
                    "heading"                   => __( "", "js_composer" ),
                    "param_name"                => "seperator_4",
                    "value"                     => "Other Settings",
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Margin Top", "js_composer" ),
                    "param_name"                => "margin_top",
                    "value"                     => "0",
                    "min"                       => "0",
                    "max"                       => "200",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "nouislider",
                    "heading"                   => __( "Margin Bottom", "js_composer" ),
                    "param_name"                => "margin_bottom",
                    "value"                     => "0",
                    "min"                       => "0",
                    "max"                       => "200",
                    "step"                      => "1",
                    "unit"                      => 'px',
                    "description"               => __( "", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "textfield",
                    "heading"                   => __( "Define ID Name", "js_composer" ),
                    "param_name"                => "el_id",
                    "value"                     => "",
                    "description"               => __( "Enter an unique ID for the Teammate Slider.", "js_composer" ),
					"group" 			        => "Other Settings",
                ),
                array(
                    "type"                      => "textfield",
                    "heading"                   => __( "Extra Class Name", "js_composer" ),
                    "param_name"                => "el_class",
                    "value"                     => "",
                    "description"               => __( "Enter a class name for the Teammate Slider.", "js_composer" ),
					"group" 			        => "Other Settings",
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
            ),
        ));
    }
?>