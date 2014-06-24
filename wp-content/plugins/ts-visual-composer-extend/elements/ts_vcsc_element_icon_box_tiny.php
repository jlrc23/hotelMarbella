<?php
	if (function_exists('vc_map')) {
		vc_map( array(
			"name"                      => __( "TS Icon Box", "js_composer" ),
			"base"                      => "TS-VCSC-Icon-Box-Tiny",
			"icon" 	                    => "icon-wpb-ts_vcsc_icon_box",
			"class"                     => "",
			"category"                  => __('VC Extensions', 'js_composer'),
			"description" 		    	=> __("Place an icon or image box", "js_composer"),
			//"admin_enqueue_js"		=> array(ts_fb_get_resource_url('/js/...')),
			//"admin_enqueue_css"		=> array(ts_fb_get_resource_url('/css/...')),
			"params"                    => array(
				// Icon Box Design
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_1",
					"value"             => "Box Design",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon Box Style", "js_composer" ),
					"param_name"        => "style",
					"width"             => 300,
					"value"             => array(
						__( 'Icon Inside - Left', "js_composer" )       => "icon_left",
						__( 'Icon Inside - Top', "js_composer" )        => "icon_top",
						__( 'Icon Outside - Left', "js_composer" )      => "boxed_left",
						__( 'Icon Outside - Top', "js_composer" )       => "boxed_top",
					),
					"description"       => __( "Select the general layout of your icon box.", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Box Background Style", "js_composer" ),
					"param_name"        => "box_background_type",
					"width"             => 300,
					"value"             => $this->TS_VCSC_Background_Type,
					"description"       => __( "Select the background type for your icon box.", "js_composer" )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Box Background Color", "js_composer" ),
					"param_name"        => "box_background_color",
					"value"             => "#ffffff",
					"description"       => __( "Select the background color for your icon box.", "js_composer" ),
					"dependency"        => array( 'element' => "box_background_type", 'value' => 'color' )
				),
				array(
					"type"              => "background",
					"heading"           => __( "Box Background Pattern", "js_composer" ),
					"param_name"        => "box_background_pattern",
					"width"             => 200,
					"value"             => $this->TS_VCSC_Background_List,
					"encoding"          => "false",
					"description"       => __( "Select the background pattern for your icon box.", "js_composer" ),
					"dependency"        => array( 'element' => "box_background_type", 'value' => 'pattern' )
				),
				// Box Title Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_2",
					"value"             => "Box Title",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Title", "js_composer" ),
					"param_name"        => "title",
					"value"             => "",
					"description"       => __( "Enter the title for your icon box.", "js_composer" )
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Title Font Size", "js_composer" ),
					"param_name"        => "title_size",
					"value"             => "24",
					"min"               => "10",
					"max"               => "50",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Select the title size for your icon box.", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Title Font Weight", "js_composer" ),
					"param_name"        => "title_weight",
					"width"             => 200,
					"value"             => array(
						__( 'Default', "js_composer" )      => "inhert",
						__( 'Bold', "js_composer" )         => "bold",
						__( 'Bolder', "js_composer" )       => "bolder",
						__( 'Normal', "js_composer" )       => "normal",
						__( 'Light', "js_composer" )        => "300",
					),
					"description"       => __( "Select the title weight for your icon box.", "js_composer" )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Title Color", "js_composer" ),
					"param_name"        => "title_color",
					"value"             => "#000000",
					"description"       => __( "Select the title color for your icon box.", "js_composer" ),
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Title Text Align", "js_composer" ),
					"param_name"        => "title_align",
					"width"             => 150,
					"value"             => $this->TS_VCSC_Title_Align,
					"description"       => __( "Select the title alignment for your icon box.", "js_composer" ),
					"dependency"        => array( 'element' => "style", 'value' => array( 'boxed_top', 'boxed_left' ) )
				),
				// Box Content Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_3",
					"value"             => "Box Content",
					"description"       => __( "", "js_composer" )
				),
                array(
                    "type"				=> "textarea_html",
                    "holder"			=> "div",
                    "class"				=> "",
                    "heading"			=> __( "Gallery Description", 'js_composer' ),
                    "param_name"		=> "content",
                    "value"				=> "",
                    "admin_label"		=> false,
                    "description"		=> __( "Create a detailed description / summary for the gallery.", "js_composer" ),
                    "dependency"		=> ""
                ),
				// Box Icon Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_5",
					"value"             => "Box Icon / Image",
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
					"description"       => __( "Switch the toggle to either use and icon or a normal image.", "js_composer" ),
                    "dependency"		=> ""
				),
				array(
					"type"              => "icons_panel",
					"heading"           => __( "Select Icon", "js_composer" ),
					"param_name"        => "icon",
					"value"             => $this->TS_VCSC_List_Icons_Full,
					"admin_label"       => true,
					"description"       => __( "Select the icon for your icon box.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_replace", 'value' => 'false' )
				),
				array(
					"type"              => "attach_image",
					"heading"           => __( "Select Image", "js_composer" ),
					"param_name"        => "icon_image",
					"value"             => "false",
					"description"       => __( "Image should have equal dimensions for scaling purposes (i.e. 100x100).", "js_composer" ),
					"dependency"        => array( 'element' => "icon_replace", 'value' => 'true' )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon Color", "js_composer" ),
					"param_name"        => "icon_color",
					"value"             => "#000000",
					"description"       => __( "Select the color of the icon for your icon box.", "js_composer" ),
			"dependency"        => array( 'element' => "icon_replace", 'value' => 'false' )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon / Image Background Color", "js_composer" ),
					"param_name"        => "icon_background",
					"value"             => "",
					"description"       => __( "Select the background color of the icon or transparent image.", "js_composer" )
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Icon / Image Size", "js_composer" ),
					"param_name"        => "icon_size_slide",
					"value"             => "36",
					"min"               => "16",
					"max"               => "512",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Select the size of the icon.", "js_composer" )
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Icon / Image to Text Spacing", "js_composer" ),
					"param_name"        => "icon_margin",
					"value"             => "10",
					"min"               => "0",
					"max"               => "50",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Define the space between the icon / image and the icon box content.", "js_composer" ),
					"dependency"        => ""
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Border Type", "js_composer" ),
					"param_name"        => "icon_frame_type",
					"width"             => 300,
					"value"             => $this->TS_VCSC_Border_Type,
					"description"       => __( "Select the border type for the icon or image.", "js_composer" )
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
					"description"       => __( "Select the thickness for the icon / image border.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Frame Border Radius", "js_composer" ),
					"param_name"        => "icon_frame_radius",
					"value"             => $this->TS_VCSC_Icon_Border_Radius,
					"description"       => __( "Select the radius for your icon border.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Icon / Image Frame Border Color", "js_composer" ),
					"param_name"        => "icon_frame_color",
					"value"             => "#000000",
					"description"       => __( "Select the color for your icon border.", "js_composer" ),
					"dependency"        => array( 'element' => "icon_frame_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Icon / Image Padding", "js_composer" ),
					"param_name"        => "icon_padding",
					"value"             => "5",
					"min"               => "0",
					"max"               => "50",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Define a padding for your icon / image.", "js_composer" )
				),
				// Box Border Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_6",
					"value"             => "Box Border",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Box Border Style", "js_composer" ),
					"param_name"        => "box_border_type",
					"width"             => 300,
					"value"             => $this->TS_VCSC_Border_Type,
					"description"       => __( "Select the border type for the icon box.", "js_composer" )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Box Border Color", "js_composer" ),
					"param_name"        => "box_border_color",
					"value"             => "#000000",
					"description"       => __( "Select the color for the icon box border.", "js_composer" ),
					"dependency"        => array( 'element' => "box_border_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Box Border Thickness", "js_composer" ),
					"param_name"        => "box_border_thick",
					"value"             => "1",
					"min"               => "1",
					"max"               => "10",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Select the thickness for the icon box border.", "js_composer" ),
					"dependency"        => array( 'element' => "box_border_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Box Frame Border Radius", "js_composer" ),
					"param_name"        => "box_border_radius",
					"value"             => $this->TS_VCSC_Box_Border_Radius,
					"description"       => __( "Select the radius for the icon box border.", "js_composer" ),
					"dependency"        => array( 'element' => "box_border_type", 'value' => $this->TS_VCSC_Border_Type_Values )
				),
				// Read More Button Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_4",
					"value"             => "Read More Link",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Add Link", "js_composer" ),
					"param_name"        => "read_more_link",
					"width"             => 300,
					"value"             => array(
						__( 'None', "js_composer" )             => "false",
						__( 'Link Button', "js_composer" )      => "button",
						__( 'Link Entire Box', "js_composer" )  => "box",
					),
					"description"       => __( "Select the type of link to be applied to the icon box.", "js_composer" ),
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Read More Button Text", "js_composer" ),
					"param_name"        => "read_more_txt",
					"value"             => "",
					"description"       => __( "Enter the text to be shown in the link button.", "js_composer" ),
					"dependency"        => array( 'element' => "read_more_link", 'value' => 'button' )
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Read More URL", "js_composer" ),
					"param_name"        => "read_more_url",
					"value"             => "",
					"description"       => __( "Enter the URL for the link (starting with http://).", "js_composer" ),
					"dependency"        => array( 'element' => "read_more_link", 'value' => array('button', 'box') )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Button Design", "js_composer" ),
					"param_name"        => "read_more_style",
					"width"             => 300,
					"value"             => array(
						__( 'Style 1', "js_composer" )          => "1",
						__( 'Style 2', "js_composer" )          => "2",
						__( 'Style 3', "js_composer" )          => "3",
						__( 'Style 4', "js_composer" )          => "4",
						__( 'Style 5', "js_composer" )          => "5"
					),
					"description"       => __( "Select the button style for the link.", "js_composer" ),
					"dependency"        => array( 'element' => "read_more_link", 'value' => 'button' )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Link Target", "js_composer" ),
					"param_name"        => "read_more_target",
					"value"             => $this->TS_VCSC_Link_Target,
					"description"       => __( "Define how the link should be opened.", "js_composer" ),
					"dependency"        => array( 'element' => "read_more_url", 'not_empty' => true )
				),
				// Animation Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_7",
					"value"             => "Animations",
					"description"       => __( "", "js_composer" )
				),
				array(
					"type"				=> "switch",
					"heading"           => __( "Add Animations / Shadow", "js_composer" ),
					"param_name"        => "animations",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle if you want to apply animations or a shadow to the icon box.", "js_composer" ),
                    "dependency"		=> ""
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Animation Style", "js_composer" ),
					"param_name"        => "animation_effect",
					"width"             => 150,
					"value"             => $this->TS_VCSC_CSS_Animations_Effects,
					"description"       => __( "Select the animation style for the icon / image.", "js_composer" ),
					"dependency"        => array( 'element' => "animations", 'value' => 'true' )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Icon / Image Animation Effect", "js_composer" ),
					"param_name"        => "animation_class",
					"width"             => 150,
					"value"             => $this->TS_VCSC_CSS_Animations_Classes,
					"description"       => __( "Select the animation effect for the icon / image.", "js_composer" ),
					"dependency"        => array( 'element' => "animations", 'value' => 'true' )
				),
				
				array(
					"type"              => "dropdown",
					"heading"           => __( "Box Hover Effect", "js_composer" ),
					"param_name"        => "animation_box",
					"width"             => 300,
					"value"             => $this->TS_VCSC_IconBox_Effect,
					"description"       => __( "Select the hover animation for the icon box.", "js_composer" ),
					"dependency"        => array( 'element' => "animations", 'value' => 'true' )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Box Shadow Effect", "js_composer" ),
					"param_name"        => "animation_shadow",
					"width"             => 300,
					"value"             => $this->TS_VCSC_Shadow_Type,
					"description"       => __( "Select the shadow effect for the icon box.", "js_composer" ),
					"dependency"        => array( 'element' => "animations", 'value' => 'true' )
				),
				array(
					"type"              => "dropdown",
					"heading"           => __( "Viewport Animation", "js_composer" ),
					"param_name"        => "animation_view",
					"value"             => $this->TS_VCSC_CSS_Animations,
					"description"       => __( "Select the viewport animation for the icon box.", "js_composer" ),
					"dependency"        => array( 'element' => "animations", 'value' => 'true' )
				),
				// Other Icon Box Settings
				array(
					"type"              => "seperator",
					"heading"           => __( "", "js_composer" ),
					"param_name"        => "seperator_8",
					"value"             => "Other Box Settings",
					"description"       => __( "", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Margin Top", "js_composer" ),
					"param_name"        => "margin_top",
					"value"             => "0",
					"min"               => "-50",
					"max"               => "200",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Select the top margin for the icon box.", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "nouislider",
					"heading"           => __( "Margin Bottom", "js_composer" ),
					"param_name"        => "margin_bottom",
					"value"             => "0",
					"min"               => "-50",
					"max"               => "200",
					"step"              => "1",
					"unit"              => 'px',
					"description"       => __( "Select the bottom margin for the icon box.", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Define ID Name", "js_composer" ),
					"param_name"        => "el_id",
					"value"             => "",
					"description"       => __( "Enter an unique ID for the icon box.", "js_composer" ),
					"group" 			=> "Other Settings",
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Extra Class Name", "js_composer" ),
					"param_name"        => "el_class",
					"value"             => "",
					"description"       => __( "Enter a class name for the icon box.", "js_composer" ),
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
			))
		);
	}
?>