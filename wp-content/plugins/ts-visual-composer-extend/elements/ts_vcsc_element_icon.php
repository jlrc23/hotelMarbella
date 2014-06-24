<?php
	if (function_exists('vc_map')) {
		vc_map(array(
			"name"                      => __( "TS Font Icons", "js_composer" ),
			"base"                      => "TS-VCSC-Font-Icons",
			"icon" 	                    => "icon-wpb-ts_vcsc_icon_font",
			"class"                     => "",
			"category"                  => __('VC Extensions', 'js_composer'),
			"description" 		    	=> __("Place a font (vector) icon or image", "js_composer"),
			//"admin_enqueue_js" 	    => array(TS_VCSC_GetResourceURL('/js/ts_vcsc_icon_font.js')),
			//"admin_enqueue_css"	    => array(TS_VCSC_GetResourceURL('/css/jquery.js-composer.fb-album.css')),
			"params"                    => array(
				// Main Icon Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_1",
					"value"             => "Icon / Image Selection Settings",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"				=> "switch",
					"heading"           => __( "Use Normal Image", "js_composer" ),
					"param_name"        => "icon_replace",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle to either use an icon or a normal image.", "js_composer" ),
                    "dependency"        => ""
				),
				array(
					"type"              => "icons_panel",
					"heading"           => __( "Select Icon", "js_composer" ),
					"param_name"        => "icon",
					"value"             => $this->TS_VCSC_List_Icons_Full,
					"admin_label"       => true,
					"description"       => __( "Select the icon you want to display.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_replace", 'value' => 'false' )
				),
				array(
					"type"              => "attach_image",
					"heading"           => __( "Select Image", "js_composer" ),
					"param_name"        => "icon_image",
					"value"             => "",
					"admin_label"       => true,
					"description"       => __( "Image should have equal dimensions for scaling purposes (i.e. 100x100)", "js_composer" ),
					"dependency"        => array( 'element' => "icon_replace", 'value' => 'true' )
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Icon / Image Size", "js_composer" ),
					"param_name"        => "icon_size_slide",
					"value"             => "30",
					"min"               => "16",
					"max"               => "512",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Select the icon / image size", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon Color", "js_composer" ),
					"param_name"        => "icon_color",
					"value"             => "#cccccc",
					"description"       => __( "Define the color of the icon.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_replace", 'value' => 'false' )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon / Image Background Color", "js_composer" ),
					"param_name"        => "icon_background",
					"value"             => "",
					"description"       => __( "Define the background color for the icon / transparent image.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Align", "js_composer" ),
					"param_name"        => "icon_align",
					"width"             => 150,
					"value"             => $this->TS_VCSC_Element_Align,
					"description"       => __( "Select how to position the icon in the column.", "js_composer" )
				),
				// Icon Border Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_2",
					"value"             => "Icon / Image Border Settings",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Border Type", "js_composer" ),
					"param_name"        => "icon_frame_type",
					"width"             => 300,
					"value"             => $this->TS_VCSC_Border_Type,
					"description"       => __( "Select the type of border around the icon / image.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Icon / Image Border Thickness", "js_composer" ),
					"param_name"        => "icon_frame_thick",
					"value"             => "1",
					"min"               => "1",
					"max"               => "10",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Define the thickness of the icon / image border.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Border Radius", "js_composer" ),
					"param_name"        => "icon_frame_radius",
					"value"             => $this->TS_VCSC_Icon_Border_Radius,
					"description"       => __( "Define the radius of the icon / image border.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon / Image Frame Border Color", "js_composer" ),
					"param_name"        => "icon_frame_color",
					"value"             => "#000000",
					"description"       => __( "Define the color of the icon / image border.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"				=> "switch",
					"heading"           => __( "Apply Padding to Icon / Image", "js_composer" ),
					"param_name"        => "padding",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle if you want to apply a padding to the icon / image.", "js_composer" ),
                    "dependency"        => ""
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Icon / Image Padding", "js_composer" ),
					"param_name"        => "icon_padding",
					"value"             => "0",
					"min"               => "0",
					"max"               => "50",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "If image instead of icon, increase the image size by padding value.", "js_composer" ),
					"dependency"        => array( 'element' => "padding", 'value' => 'true' )
				),
				// Icon Link Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_3",
					"value"             => "Icon Link Settings",
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
				// Icon Tooltip
				array(
					"type"				=> "seperator",
					"heading"			=> __( "", "js_composer" ),
					"param_name"		=> "seperator_4",
					"value"				=> "Icon Tooltip",
					"description"		=> __( "", "js_composer" )
				),
				array(
					"type"				=> "switch",
					"heading"			=> __( "Use CSS3 Tooltip", "js_composer" ),
					"param_name"		=> "tooltip_css",
					"value"				=> "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle if you want to apply a CSS3 tooltip to the image.", "js_composer" ),
                    "dependency"        => ""
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
					"description"		=> __( "Select the tooltip position in relation to the image.", "js_composer" ),
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
				// Animation Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_5",
					"value"             => "Animations",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"				=> "switch",
					"heading"           => __( "Add Animations", "js_composer" ),
					"param_name"        => "animations",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle if you want to apply animations or a shadow to the icon box.", "js_composer" ),
                    "dependency"        => ""
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Hover Animation", "js_composer" ),
					"param_name"        => "animation_icon",
					"width"             => 150,
					"value"             => $this->TS_VCSC_CSS_Hovers,
					"description"       => __( "Select the hover animation for the icon / image.", "js_composer" ),
					"dependency"        => array( 'element' => "animations", 'value' => 'true' )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Viewport Animation", "js_composer" ),
					"param_name"        => "animation_view",
					"value"             => $this->TS_VCSC_CSS_Animations,
					"description"       => __( "Select the viewport animation for the icon title.", "js_composer" ),
					"dependency"        => array( 'element' => "animations", 'value' => 'true' )
				),
				// Other Icon Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_6",
					"value"             => "Other Icon Settings",
					"description"       => __( "", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Define ID Name", "js_composer" ),
					"param_name"        => "el_id",
					"value"             => "",
					"description"       => __( "Enter a unique ID name for the icon element.", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Extra Class Name", "js_composer" ),
					"param_name"        => "el_class",
					"value"             => "",
					"description"       => __( "Enter a class name for the icon element.", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				// Load Custom CSS/JS File
				array(
					"type"              => "load_file",
					"heading"           => __( "", "js_composer" ),
					"param_name"		=> "el_file",
					"value"             => "",
					"file_type"         => "js",
					"file_path"         => "js/ts-visual-composer-extend-element.min.js",
					"description"       => __( "", "js_composer" )
				),
			)
		));
	}
?>