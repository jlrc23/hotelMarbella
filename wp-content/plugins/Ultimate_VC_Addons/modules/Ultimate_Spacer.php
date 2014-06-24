<?php/** Add-on Name: Adjustable Spacer for Visual Composer* Add-on URI: http://dev.brainstormforce.com*/if(!class_exists("Ultimate_Spacer")){	class Ultimate_Spacer{		function __construct(){			add_action("admin_init",array($this,"ultimate_spacer_init"));			add_shortcode("ultimate_spacer",array($this,"ultimate_spacer_shortcode"));		}		function ultimate_spacer_init(){			if(function_exists("vc_map")){				vc_map(					array(					   "name" => __("Spacer / Gap"),					   "base" => "ultimate_spacer",					   "class" => "vc_ultimate_spacer",					   "icon" => "vc_ultimate_spacer",					   "category" => __("Ultimate VC Addons",'smile'),					   "description" => __("Adjust space between components.","smile"),					   "params" => array(							array(								"type" => "number",								"class" => "",								"heading" => __("Spacer Height", "smile"),								"param_name" => "height",								"admin_label" => true,								"value" => 10,								"min" => 1,								"max" => 500,								"suffix" => "px",								"description" => __("Enter value in pixels", "smile"),							),						)					)				);			}		}		function ultimate_spacer_shortcode($atts){			wp_enqueue_style('ultimate-style');			$height = $output = '';			extract(shortcode_atts(array(				"height" => "",			),$atts));			$style = 'height:'.$height.'px;';			$style .= 'clear:both;';			$style .= 'display:block;';			$output .= '<div class="ult-spacer" style="'.$style.'"></div>';			return $output;		}	} // end class	new Ultimate_Spacer;}