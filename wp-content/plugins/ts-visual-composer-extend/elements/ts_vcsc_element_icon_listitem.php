<?php
    if (function_exists('vc_map')) {
		vc_map( array(
            "name"                      => __( "TS Icon List Item", "js_composer" ),
            "base"                      => "TS-VCSC-Icon-List",
            "icon" 	                    => "icon-wpb-ts_vcsc_icon_list",
            "class"                     => "",
            "category"                  => __( 'VC Extensions', 'js_composer' ),
            "description"               => __("Place an icon list item", "js_composer"),
            //"admin_enqueue_js"        => array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"       => array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
			"params"					=> array(
				array(
					"type"              => "icons_panel",
					"heading"           => __( "Select Icon", "js_composer" ),
					"param_name"        => "icon",
					"value"             => $this->TS_VCSC_List_Icons_Full,
					"admin_label"       => true,
					"description"       => __( "Select the icon to be used before the list item.", "js_composer" )
				),
				array(
					"type"				=> "colorpicker",
					"class"				=> "",
					"heading"			=> __( "Icon Color", 'js_composer' ),
					"param_name"		=> "color",
					"value"				=> "#7dbd21",
					"description"		=> __( "Select your icon color.", 'js_composer' ),
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Icon Right Margin", "js_composer" ),
					"param_name"        => "margin_right",
					"value"             => "10",
					"min"               => "0",
					"max"               => "100",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Enter a custom right side margin for your icon.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"				=> "colorpicker",
					"class"				=> "",
					"heading"			=> __( "Font Color", 'js_composer' ),
					"param_name"		=> "font_color",
					"value"				=> "#000000",
					"description"		=> __( "Select a custom font color for the list item.", 'js_composer' ),
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Custom Font Size", "js_composer" ),
					"param_name"        => "font_size",
					"value"             => "12",
					"min"               => "6",
					"max"               => "512",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Enter a custom font size in pixels. This will alter the icon and text size.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"				=> "dropdown",
					"class"				=> "",
					"heading"			=> __( "Text Align", 'js_composer' ),
					"param_name"		=> "text_align",
					"value"				=> array(
						__('Left', 'js_composer') 		=> 'left',
						__('Center', 'js_composer')		=> 'center',
						__('Right', 'js_composer') 		=> 'right',
					),
					"description"		=> __( "Select your preferred text alignment.", 'js_composer' )
				),
				array(
					"type"				=> "textfield",
					"class"				=> "",
					"heading"			=> __( "Content", 'js_composer' ),
					"param_name"		=> "content",
					"value"				=> __( 'This is a pretty list item', 'js_composer' ),
					"description"		=> __( "Enter the list item content here.", 'js_composer' )
				),
				// Icon Link Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_2",
					"value"             => "List Item Link Settings",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Link", "js_composer" ),
					"param_name"        => "link",
					"value"             => "",
					"description"       => __( "Enter the link to the page or file here (starting with http://).", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Link Target", "js_composer" ),
					"param_name"        => "link_target",
					"value"             => $this->TS_VCSC_Link_Target,
					"description"       => __( "Select how the link should be opened.", "js_composer" ),
					"dependency"        => array( 'element' => "link", 'not_empty' => true )
				),
				// List Item Tooltip
				array(
					"type"				=> "seperator",
					"heading"			=> __( "", "js_composer" ),
					"param_name"		=> "seperator_3",
					"value"				=> "List Item Tooltip",
					"description"		=> __( "", "js_composer" )
				),
				array(
					"type"              => "switch",
					"heading"			=> __( "Use CSS3 Tooltip", "js_composer" ),
					"param_name"		=> "tooltip_css",
					"value"				=> "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
                    "description"		=> __( "Switch the toggle if you want to apply a CSS3 tooltip to the list item.", "js_composer" ),
                    "dependency"		=> ""
				),
				array(
					"type"				=> "textarea",
					"class"				=> "",
					"heading"			=> __( "Tooltip Content", 'js_composer' ),
					"param_name"		=> "tooltip_content",
					"value"				=> "",
					"description"		=> __( "Enter the tooltip content here (do not use quotation marks).", "js_composer" ),
					"dependency"		=> ""
				),
				array(
					"type"				=> "dropdown",
					"class"				=> "",
					"heading"			=> __( "Tooltip Position", 'js_composer' ),
					"param_name"		=> "tooltip_position",
					"value"				=> $this->TS_VCSC_ImageTooltip_Position,
					"description"		=> __( "Select the tooltip position in relation to the list item.", "js_composer" ),
					"dependency"		=> array( 'element' => "tooltip_css", 'value' => 'true' )
				),
				array(
					"type"				=> "dropdown",
					"class"				=> "",
					"heading"			=> __( "Tooltip Style", 'js_composer' ),
					"param_name"		=> "tooltip_style",
					"value"				=> $this->TS_VCSC_Tooltip_Style,
					"description"		=> __( "Select the tooltip style.", "js_composer" ),
					"dependency"		=> array( 'element' => "tooltip_css", 'value' => 'true' )
				),
				// List Item Animations
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_4",
					"value"             => "Animations",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Viewport Animation", "js_composer" ),
					"param_name"        => "animation_view",
					"value"             => $this->TS_VCSC_CSS_Animations,
					"description"       => __( "Select the viewport animation for the list item.", "js_composer" )
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
			)
		));
    }
?>