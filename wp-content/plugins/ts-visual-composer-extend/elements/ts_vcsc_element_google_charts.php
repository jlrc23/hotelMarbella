<?php
    if (function_exists('vc_map')) {
        vc_map( array(
            "name"                      => __( "TS Google Charts", "js_composer" ),
            "base"                      => "TS-VCSC-Google-Charts",
            "icon" 	                    => "icon-wpb-ts_vcsc_google_charts",
            "class"                     => "",
            "category"                  => __( 'VC Extensions', 'js_composer' ),
            "description"               => __("Place a Google Charts element", "js_composer"),
            //"admin_enqueue_js"        => array(ts_fb_get_resource_url('/Core/JS/jquery.js-composer.fb-album.js')),
            //"admin_enqueue_css"       => array(ts_fb_get_resource_url('/Core/CSS/jquery.js-composer.fb-album.css')),
            "params"                    => array(
                // Chart Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_1",
                    "value"             => "Google Chart Settings",
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Chart Type", "js_composer" ),
                    "param_name"        => "chart_type",
                    "width"             => 150,
                    "value"             => array(
                        __( 'Pie', "" )              => "pie",
                        __( 'Donut', "" )            => "donut",
                        __( 'Bar', "" )              => "bar",
                        __( 'Column', "" )           => "column",
                        __( 'Area', "" )             => "area",
                        __( 'Geo', "" )              => "geo",
                        __( 'Combo', "" )            => "combo",
                        __( 'Organization', "" )     => "org",
                    ),
                    "admin_label"       => true,
                    "description"       => __( "Select the chart type.", "js_composer" )
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Height in px", "js_composer" ),
                    "param_name"        => "chart_height",
                    "value"             => "400",
                    "min"               => "100",
                    "max"               => "2048",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "", "js_composer" )
                ),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Legend Position", "js_composer" ),
                    "param_name"        => "chart_legend",
                    "width"             => 150,
                    "value"             => array(
                        __( 'Top', "js_composer" )              => "top",
                        __( 'Right', "js_composer" )            => "right",
                        __( 'Bottom', "js_composer" )           => "bottom",
                        __( 'Left', "js_composer" )             => "left",
                        __( 'None', "js_composer" )             => "none",
                    ),
                    "description"       => __( "Select where the legend should be positioned.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => array('pie', 'donut', 'bar', 'area', 'combo') )
                ),
				array(
					"type"              => "textfield",
					"heading"           => __( "Title", "js_composer" ),
					"param_name"        => "chart_title",
					"value"             => "",
                    "admin_label"       => true,
					"description"       => __( "Enter a title for your chart.", "js_composer" )
				),
                // Pie + Donut Chart
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Slice Label", "js_composer" ),
                    "param_name"        => "chart_label",
                    "width"             => 150,
                    "value"             => array(
                        __( 'Percentage', "js_composer" )       => "percentage",
                        __( 'Value', "js_composer" )            => "value",
                        __( 'Label', "js_composer" )            => "label",
                        __( 'None', "js_composer" )             => "none",
                    ),
                    "description"       => __( "Select what information should be shown on/for each slice.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => array('pie', 'donut') )
                ),
				array(
					"type"              	=> "switch",
					"heading"           => __( "3D Chart", "js_composer" ),
					"param_name"        => "chart_pie_3d",
					"value"             => "true",
					"on"					=> __( 'Yes', "js_composer" ),
					"off"					=> __( 'No', "js_composer" ),
					"style"					=> "select",
					"design"				=> "toggle-light",
					"description"       => __( "Switch the toggle to show the chart in 3D.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'pie' )
				),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Pie Hole Size", "js_composer" ),
                    "param_name"        => "chart_pie_hole",
                    "value"             => "20",
                    "min"               => "20",
                    "max"               => "60",
                    "step"              => "1",
                    "unit"              => '%',
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'donut' )
                ),
                // Pie Chart
				array(
					"type"              => "textarea",
					"heading"           => __( "Data", "js_composer" ),
					"param_name"        => "chart_pie_data",
					"value"             => "",
					"description"       => __( "Sample: ('Task', 'Hours per Day'), ('Work', 11), ('Sleep', 7), ('Eat', 2), ('Commute', 3)", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'pie' )
				),
                // Donut Chart
				array(
					"type"              => "textarea",
					"heading"           => __( "Data", "js_composer" ),
					"param_name"        => "chart_donut_data",
					"value"             => "",
					"description"       => __( "Sample: ('Task', 'Hours per Day'), ('Work', 11), ('Sleep', 7), ('Eat', 2), ('Commute', 3)", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'donut' )
				),
                // Bar Chart
				array(
					"type"              => "textarea",
					"heading"           => __( "Data", "js_composer" ),
					"param_name"        => "chart_bar_data",
					"value"             => "",
					"description"       => __( "Sample: ('Year', 'Sales', 'Expenses'),('2004', 1000, 400),('2005', 1170, 460),('2006', 660, 1120),('2007', 1030, 540)", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'bar' )
				),
				array(
					"type"              => "switch",
					"heading"           => __( "Stack Values", "js_composer" ),
					"param_name"        => "chart_bar_stack",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle to stack the values into one bar for each category.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'bar' )
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Title Vertical Axis", "js_composer" ),
					"param_name"        => "chart_bar_vertical",
					"value"             => "",
					"description"       => __( "Enter a title for the vertical axis of the chart.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'bar' )
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Title Horizontal Axis", "js_composer" ),
					"param_name"        => "chart_bar_horizontal",
					"value"             => "",
					"description"       => __( "Enter a title for the horizontal axis of the chart.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'bar' )
				),
                // Column Chart
				array(
					"type"              => "textarea",
					"heading"           => __( "Data", "js_composer" ),
					"param_name"        => "chart_column_data",
					"value"             => "",
					"description"       => __( "Sample: ('Year', 'Sales', 'Expenses'),('2004', 1000, 400),('2005', 1170, 460),('2006', 660, 1120),('2007', 1030, 540)", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'column' )
				),
				array(
					"type"              => "switch",
					"heading"           => __( "Stack Values", "js_composer" ),
					"param_name"        => "chart_column_stack",
					"value"             => "false",
					"on"				=> __( 'Yes', "js_composer" ),
					"off"				=> __( 'No', "js_composer" ),
					"style"				=> "select",
					"design"			=> "toggle-light",
					"description"       => __( "Switch the toggle to stack the values into one bar for each category.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'column' )
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Title Vertical Axis", "js_composer" ),
					"param_name"        => "chart_column_vertical",
					"value"             => "",
					"description"       => __( "Enter a title for the vertical axis of the chart.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'column' )
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Title Horizontal Axis", "js_composer" ),
					"param_name"        => "chart_column_horizontal",
					"value"             => "",
					"description"       => __( "Enter a title for the horizontal axis of the chart.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'column' )
				),
                // Area Chart
				array(
					"type"              => "textarea",
					"heading"           => __( "Data", "js_composer" ),
					"param_name"        => "chart_area_data",
					"value"             => "",
					"description"       => __( "Sample: ('Year', 'Sales', 'Expenses'),('2004', 1000, 400),('2005', 1170, 460),('2006', 660, 1120),('2007', 1030, 540)", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'area' )
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Title Vertical Axis", "js_composer" ),
					"param_name"        => "chart_area_vertical",
					"value"             => "",
					"description"       => __( "Enter a title for the vertical axis of the chart.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'area' )
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Title Horizontal Axis", "js_composer" ),
					"param_name"        => "chart_area_horizontal",
					"value"             => "",
					"description"       => __( "Enter a title for the horizontal axis of the chart.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'area' )
				),
                // GeoMap Chart
				array(
					"type"              => "textarea",
					"heading"           => __( "Data", "js_composer" ),
					"param_name"        => "chart_geo_data",
					"value"             => "",
					"description"       => __( "Sample: ('Country', 'Popularity'),('Germany', 200),('United States', 300),('Brazil', 400),('Canada', 500),('France', 600),('Russia', 700)", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'geo' )
				),
                array(
                    "type"              => "dropdown",
                    "heading"           => __( "Map Region", "js_composer" ),
                    "param_name"        => "chart_geo_region",
                    "width"             => 150,
                    "value"             => $this->TS_VCSC_GeoMap_Regions,
                    "description"       => __( "Select the region for the GeoMap Chart.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'geo' )
                ),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "Start Color", "js_composer" ),
					"param_name"        => "chart_geo_colorstart",
					"value"             => "#ffff00",
					"description"       => __( "Define the start color for the geo map chart.", "js_composer" ),
					"dependency"        => array( 'element' => "chart_type", 'value' => 'geo' )
				),
				array(
					"type"              => "colorpicker",
					"heading"           => __( "End Color", "js_composer" ),
					"param_name"        => "chart_geo_colorend",
					"value"             => "#ebe5d8",
					"description"       => __( "Define the end color for the geo map chart.", "js_composer" ),
					"dependency"        => array( 'element' => "chart_type", 'value' => 'geo' )
				),
                // Combo Chart
				array(
					"type"              => "textarea",
					"heading"           => __( "Data", "js_composer" ),
					"param_name"        => "chart_combo_data",
					"value"             => "",
					"description"       => __( "Sample: ('Month','Bolivia','Ecuador','Madagascar','Papua New Guinea','Rwanda','Average'), ('2004/05',165,938,522,998,450,614.6), ('2005/06',135,1120,599,1268,288,682), ('2006/07',157,1167,587,807,397,623), ('2007/08',139,1110,615,968,215,609.4), ('2008/09',136,691,629,1026,366,569.6)", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'combo' )
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Title Vertical Axis", "js_composer" ),
					"param_name"        => "chart_combo_vertical",
					"value"             => "",
					"description"       => __( "Enter a title for the vertical axis of the chart.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'combo' )
				),
				array(
					"type"              => "textfield",
					"heading"           => __( "Title Horizontal Axis", "js_composer" ),
					"param_name"        => "chart_combo_horizontal",
					"value"             => "",
					"description"       => __( "Enter a title for the horizontal axis of the chart.", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'combo' )
				),
                // Organization Chart
				array(
					"type"              => "textarea",
					"heading"           => __( "Data", "js_composer" ),
					"param_name"        => "chart_org_data",
					"value"             => "",
					"description"       => __( "Sample: ('Name','Manager','Tooltip'),('Mike Smith',null,'CEO'),( 'Jim Miller', 'Mike Smith','CFO'),('Alice White', 'Mike Smith','COO'), ('Candice Greer', 'Mike Smith','CAO'),('Robert Evans','Jim Miller',''),('Janet Bergen', 'Robert Evans',''),('Leslie Gray', 'Robert Evans','')", "js_composer" ),
                    "dependency"        => array( 'element' => "chart_type", 'value' => 'org' )
				),
                // Other Google Chart Settings
                array(
                    "type"              => "seperator",
                    "heading"           => __( "", "js_composer" ),
                    "param_name"        => "seperator_2",
                    "value"             => "Other Settings",
                    "description"       => __( "", "js_composer" ),
					"group" 			=> "Other Settings",
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Margin Top", "js_composer" ),
                    "param_name"        => "margin_top",
                    "value"             => "0",
                    "min"               => "-50",
                    "max"               => "500",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "Select the top margin for the Google Chart.", "js_composer" ),
					"group" 			=> "Other Settings",
                ),
                array(
                    "type"              => "nouislider",
                    "heading"           => __( "Margin Bottom", "js_composer" ),
                    "param_name"        => "margin_bottom",
                    "value"             => "0",
                    "min"               => "-50",
                    "max"               => "500",
                    "step"              => "1",
                    "unit"              => 'px',
                    "description"       => __( "Select the bottom margin for the Google Chart.", "js_composer" ),
					"group" 			=> "Other Settings",
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Define ID Name", "js_composer" ),
                    "param_name"        => "el_id",
                    "value"             => "",
                    "description"       => __( "Enter an unique ID for the Google Chart.", "js_composer" ),
					"group" 			=> "Other Settings",
                ),
                array(
                    "type"              => "textfield",
                    "heading"           => __( "Extra Class Name", "js_composer" ),
                    "param_name"        => "el_class",
                    "value"             => "",
                    "description"       => __( "Enter a class name for the Google Chart.", "js_composer" ),
					"group" 			=> "Other Settings",
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