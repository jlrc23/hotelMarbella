<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                          => __( "TS Meet The Team (Deprecated)", "js_composer" ),
            "base"                          => "TS-VCSC-Meet-Team",
            "icon" 	                        => "icon-wpb-ts_vcsc_meet_team",
            "class"                         => "",
            "category"                      => __( 'VC Extensions (Deprecated)', 'js_composer' ),
            "description"                   => __("Place a meet the team element", "js_composer"),
            //"admin_enqueue_js"            => array(ts_fb_get_resource_url('/js/...')),
            //"admin_enqueue_css"           => array(ts_fb_get_resource_url('/css/...')),
            "params"                        => array(
                // Meet The Team Content
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_1",
                    "value"                 => "Main Content",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Design", "js_composer" ),
                    "param_name"            => "style",
                    "value"                 => $this->TS_VCSC_MeetTeam_Styles,
                    "description"           => __( "", "js_composer" ),
                    "admin_label"           => true,
                    "dependency"            => ""
                ),
                array(
                    "type"                  => "attach_image",
                    "heading"               => __( "Image", "js_composer" ),
                    "param_name"            => "image",
                    "value"                 => "false",
                    "admin_label"           => true,
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_1",
                    "value"                 => "Team Member Content",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Name", "js_composer" ),
                    "param_name"            => "name",
                    "value"                 => "",
                    "admin_label"           => true,
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Title", "js_composer" ),
                    "param_name"            => "title",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textarea",
                    "class"                 => "",
                    "heading"               => __( "Description", 'js_composer' ),
                    "param_name"            => "description",
                    "value"                 => "",
                    "dependency"            => ""
                ),
                // Social Icon Style
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_2",
                    "value"                 => "Icon Settings",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Style", "js_composer" ),
                    "param_name"            => "icon_style",
                    "admin_label"           => true,
                    "value"                 => array(
                        "Simple"            => "simple",
                        "Square"            => "square",
                        "Rounded"           => "rounded",
                        "Circle"            => "circle",
                    ),
                ),
                array(
                    "type"                  => "colorpicker",
                    "heading"               => __( "Icon Background Color", "js_composer" ),
                    "param_name"            => "icon_background",
                    "value"                 => "#f5f5f5",
                    "description"           => __( "", "js_composer" ),
                    "dependency"            => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                  => "colorpicker",
                    "heading"               => __( "Icon Border Color", "js_composer" ),
                    "param_name"            => "icon_frame_color",
                    "value"                 => "#f5f5f5",
                    "description"           => __( "", "js_composer" ),
                    "dependency"            => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Icon Frame Border Thickness", "js_composer" ),
                    "param_name"            => "icon_frame_thick",
                    "value"                 => "1",
                    "min"                   => "1",
                    "max"                   => "10",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "", "js_composer" ),
                    "dependency"            => array( 'element' => "icon_style", 'value' => array('square', 'rounded', 'circle') )
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Icon Margin", "js_composer" ),
                    "param_name"            => "icon_margin",
                    "value"                 => "5",
                    "min"                   => "0",
                    "max"                   => "50",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Icons Align", "js_composer" ),
                    "param_name"            => "icon_align",
                    "width"                 => 150,
                    "value"                 => array(
                        __( 'Left', "js_composer" )     => "left",
                        __( 'Right', "js_composer" )    => "right",
                        __( 'Center', "js_composer" )   => "center" ),
                    "admin_label"           => true,
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Icons Hover Animation", "js_composer" ),
                    "param_name"            => "icon_hover",
                    "width"                 => 150,
                    "value"                 => $this->TS_VCSC_CSS_Hovers,
                    "description"           => __( "", "js_composer" )
                ),
                // Social Icon Links
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_3",
                    "value"                 => "Social Links",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-email'></i> Email Address", "js_composer" ),
                    "param_name"            => "email",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-phone'></i> Phone Number", "js_composer" ),
                    "param_name"            => "phone",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-cell'></i> Cell Number", "js_composer" ),
                    "param_name"            => "cell",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-portfolio'></i> Portfolio URL", "js_composer" ),
                    "param_name"            => "portfolio",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-link'></i> Other Link URL", "js_composer" ),
                    "param_name"            => "link",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-facebook'></i> Facebook URL", "js_composer" ),
                    "param_name"            => "facebook",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-gplus'></i> Google+ URL", "js_composer" ),
                    "param_name"            => "gplus",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-twitter'></i> Twitter URL", "js_composer" ),
                    "param_name"            => "twitter",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-linkedin'></i> Linkedin URL", "js_composer" ),
                    "param_name"            => "linkedin",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-xing'></i> Xing URL", "js_composer" ),
                    "param_name"            => "xing",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-skype'></i> Skype URL", "js_composer" ),
                    "param_name"            => "skype",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-flickr'></i> Flickr URL", "js_composer" ),
                    "param_name"            => "flickr",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-instagram'></i> Instagram URL", "js_composer" ),
                    "param_name"            => "instagram",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-picasa'></i> Picasa URL", "js_composer" ),
                    "param_name"            => "picasa",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-vimeo'></i> Vimeo URL", "js_composer" ),
                    "param_name"            => "vimeo",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "<i class='ts-social-icon ts-social-youtube'></i> Youtube URL", "js_composer" ),
                    "param_name"            => "youtube",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" )
                ),
                // Other Meet the Team Settings
                array(
                    "type"                  => "seperator",
                    "heading"               => __( "", "js_composer" ),
                    "param_name"            => "seperator_4",
                    "value"                 => "Other Settings",
                    "description"           => __( "", "js_composer" ),
					"group" 				=> "Other Settings",
                ),
                array(
                    "type"                  => "dropdown",
                    "heading"               => __( "Viewport Animation", "js_composer" ),
                    "param_name"            => "animation_view",
                    "value"                 => $this->TS_VCSC_CSS_Animations,
                    "description"           => __( "Select the viewport animation for the element.", "js_composer" ),
                    "dependency"            => array( 'element' => "animations", 'value' => 'true' ),
					"group" 				=> "Other Settings",
                ),
                array(
                    "type"                  => "nouislider",
                    "heading"               => __( "Margin Top", "js_composer" ),
                    "param_name"            => "margin_top",
                    "value"                 => "0",
                    "min"                   => "-50",
                    "max"                   => "500",
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
                    "min"                   => "-50",
                    "max"                   => "500",
                    "step"                  => "1",
                    "unit"                  => 'px',
                    "description"           => __( "", "js_composer" ),
					"group" 				=> "Other Settings",
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Define ID Name", "js_composer" ),
                    "param_name"            => "el_id",
                    "value"                 => "",
                    "description"           => __( "", "js_composer" ),
					"group" 				=> "Other Settings",
                ),
                array(
                    "type"                  => "textfield",
                    "heading"               => __( "Extra Class Name", "js_composer" ),
                    "param_name"            => "el_class",
                    "value"                 => "",
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
            ))
        );
    }
?>