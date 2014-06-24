<?php
if (!class_exists('TS_Teammates')){
	class TS_Teammates {
		function __construct() {
            if (function_exists('vc_is_inline')){
                if (vc_is_inline()) {
                    add_action('init',                                  array($this, 'TS_VCSC_Add_Teammate_Elements'), 9999999);
                } else {
                    add_action('admin_init',		                    array($this, 'TS_VCSC_Add_Teammate_Elements'), 9999999);
                }
            } else {
                add_action('admin_init',                                array($this, 'TS_VCSC_Add_Teammate_Elements'), 9999999);
            }
            add_shortcode('TS-VCSC-Team-Mates',                         array($this, 'TS_VCSC_Team_Mates_Standalone'));
            add_shortcode('TS_VCSC_Team_Mates', 			            array($this, 'TS_VCSC_Team_Mates_Standalone'));
            add_shortcode('TS_VCSC_Team_Mates_Standalone',              array($this, 'TS_VCSC_Team_Mates_Standalone'));
            add_shortcode('TS_VCSC_Team_Mates_Single',                  array($this, 'TS_VCSC_Team_Mates_Single'));
            add_shortcode('TS_VCSC_Team_Mates_Slider_Custom',           array($this, 'TS_VCSC_Team_Mates_Slider_Custom'));
            add_shortcode('TS_VCSC_Team_Mates_Slider_Category',         array($this, 'TS_VCSC_Team_Mates_Slider_Category'));
		}
        
        // Standalone Teammate
        function TS_VCSC_Team_Mates_Standalone ($atts, $content = null) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            ob_start();
            
            if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
                $FOOTER = true;
            } else {
                $FOOTER = false;
            }
            wp_enqueue_script('ts-extend-hammer', 								TS_VCSC_GetResourceURL('js/jquery.hammer.min.js'), array('jquery'), false, $FOOTER);
            wp_enqueue_script('ts-extend-nacho', 								TS_VCSC_GetResourceURL('js/jquery.nchlightbox.min.js'), array('jquery'), false, $FOOTER);
            wp_enqueue_style('ts-extend-nacho',									TS_VCSC_GetResourceURL('css/jquery.nchlightbox.min.css'), null, false, 'all');
            if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
                wp_enqueue_style('ts-extend-simptip',                 			TS_VCSC_GetResourceURL('css/jquery.simptip.css'), null, false, 'all');
                wp_enqueue_style('ts-extend-animations',                 		TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-animations.min.css'), null, false, 'all');
                wp_enqueue_style('ts-extend-teammate',                 			TS_VCSC_GetResourceURL('css/ts-font-teammates.css'), null, false, 'all');
                wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
                wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
            }
            
            extract( shortcode_atts( array(
                'team_member'			=> '',
                'team_name'				=> '',
                'style'					=> 'style1',
                'show_image'            => 'true',
                'show_grayscale'        => 'true',
                'show_lightbox'         => 'true',
                'show_title'            => 'true',
                'show_content'          => 'true',
                'show_dedicated'        => 'false',
                'show_download'			=> 'true',
                'show_contact'			=> 'true',
                'show_social'			=> 'true',
                'show_skills'			=> 'true',
                'icon_style' 			=> 'simple',
                'icon_background'		=> '#f5f5f5',
                'icon_frame_color'		=> '#f5f5f5',
                'icon_frame_thick'		=> 1,
                'icon_margin' 			=> 5,
                'icon_align'			=> 'left',
                'icon_hover'			=> '',
                'tooltip_style'			=> '',
                'tooltip_position'		=> 'ts-simptip-position-top',
                'animation_view'		=> '',
                'margin_top'			=> 0,
                'margin_bottom'			=> 0,
                'el_id' 				=> '',
                'el_class'              => '',
            ), $atts ));
            
            $output = '';
            
            // Check for Teammate and End Shortcode if Empty
            if (empty($team_member)) {
                $output .= '<div style="text-align: justify; font-weight: bold; font-size: 14px; color: red;">Please select a teammate in the element settings!</div>';
                echo $output;
                $myvariable = ob_get_clean();
                return $myvariable;
            }
        
            if (!empty($el_id)) {
                $team_block_id					= $el_id;
            } else {
                $team_block_id					= 'ts-vcsc-meet-team-' . mt_rand(999999, 9999999);
            }
        
            if ($animation_view != '') {
                $animation_css              	= TS_VCSC_GetCSSAnimation($animation_view);
            } else {
                $animation_css					= '';
            }
            
            $team_tooltipclasses				= "ts-simptip-multiline " . $tooltip_style . " " . $tooltip_position;
        
            if ((empty($icon_background)) || ($icon_style == 'simple')) {
                $icon_frame_style				= '';
            } else {
                $icon_frame_style				= 'background: ' . $icon_background . ';';
            }
            
            if ($icon_frame_thick > 0) {
                $icon_top_adjust				= 'top: ' . (10 - $icon_frame_thick) . 'px;';
            } else {
                $icon_top_adjust				= '';
            }
            
            if ($icon_style == 'simple') {
                $icon_frame_border				= '';
            } else {
                $icon_frame_border				= ' border: ' . $icon_frame_thick . 'px solid ' . $icon_frame_color . ';';
            }
            
            $icon_horizontal_adjust				= '';
        
            $team_social 						= '';
        
            // Retrieve Team Post Main Content
            $team_array							= array();
            $category_fields 	                = array();
            $args = array(
                'no_found_rows' 				=> 1,
                'ignore_sticky_posts' 			=> 1,
                'posts_per_page' 				=> -1,
                'post_type' 					=> 'ts_team',
                'post_status' 					=> 'publish',
                'orderby' 						=> 'title',
                'order' 						=> 'ASC',
            );
            $team_query = new WP_Query($args);
            if ($team_query->have_posts()) {
                foreach($team_query->posts as $p) {
                    if ($p->ID == $team_member) {
                        $team_data = array(
                            'author'			=> $p->post_author,
                            'name'				=> $p->post_name,
                            'title'				=> $p->post_title,
                            'id'				=> $p->ID,
                            'content'			=> $p->post_content,
                        );
                        $team_array[] = $team_data;
                    }
                }
            }
            wp_reset_postdata();
            
            // Build Team Post Main Content
            foreach ($team_array as $index => $array) {
                $Team_Author					= $team_array[$index]['author'];
                $Team_Name 						= $team_array[$index]['name'];
                $Team_Title 					= $team_array[$index]['title'];
                $Team_ID 						= $team_array[$index]['id'];
                $Team_Content 					= $team_array[$index]['content'];
                $Team_Image						= wp_get_attachment_image_src(get_post_thumbnail_id($Team_ID), 'full');
                if ($Team_Image == false) {
                    $Team_Image          		= TS_VCSC_GetResourceURL('images/Default_person.jpg');
                } else {
                    $Team_Image          		= $Team_Image[0];
                }
            }
            
            // Retrieve Team Post Meta Content
            $custom_fields 						= get_post_custom($Team_ID);
            $custom_fields_array				= array();
            foreach ($custom_fields as $field_key => $field_values) {
                if (!isset($field_values[0])) continue;
                if (in_array($field_key, array("_edit_lock", "_edit_last"))) continue;
                if (strpos($field_key, 'ts_vcsc_team_') !== false) {
                    $field_key_split 			= explode("_", $field_key);
                    $field_key_length 			= count($field_key_split) - 1;
                    $custom_data = array(
                        'group'					=> $field_key_split[$field_key_length - 1],
                        'name'					=> 'Team_' . ucfirst($field_key_split[$field_key_length]),
                        'value'					=> $field_values[0],
                    );
                    $custom_fields_array[] = $custom_data;
                }
            }
            foreach ($custom_fields_array as $index => $array) {
                ${$custom_fields_array[$index]['name']} = $custom_fields_array[$index]['value'];
            }
            if (isset($Team_Position)) {
                $Team_Position 					= $Team_Position;
            } else {
                $Team_Position 					= '';
            }
            if (isset($Team_Buttonlabel)) {
                $Team_Buttonlabel				= $Team_Buttonlabel;
            } else {
                $Team_Buttonlabel				= '';
            }
            
            // Build Dedicated Page Link
            $team_dedicated     = '';
            if ($show_dedicated == "true") {
                if ((isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
                    $Team_Dedicatedpage         = get_page_link($Team_Dedicatedpage);
                    if (isset($Team_Dedicatedtarget)) {
                        $team_dedicated_target  = '_blank';
                    } else {
                        $team_dedicated_target  = '_parent';
                    }
                    $team_dedicated	.= '<div class="ts-teammate-dedicated">';
                    if (isset($Team_Dedicatedtooltip)) {
                        $team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . ' ' . $team_tooltipclasses . '" data-tooltip="' . $Team_Dedicatedtooltip . '" href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '"><img class="ts-teammate-page-image" src="' . TS_VCSC_GetResourceURL('images/TS_VCSC_Demo_Icon_16x16.png') . '"> ' . $Team_Dedicatedlabel . '</a>';
                    } else {
                        $team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . '" href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '"><img class="ts-teammate-page-image" src="' . TS_VCSC_GetResourceURL('images/TS_VCSC_Demo_Icon_16x16.png') . '"> ' . $Team_Dedicatedlabel . '</a>';
                    }
                    $team_dedicated 	.= '</div>';
                    if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
                        wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
                    }
                }
            }
            
            // Build Team Contact Information
            $team_contact		= '';
            $team_contact_count	= 0;
            if ($show_contact == "true") {
                $team_contact		.= '<div class="ts-team-contact">';
                    if (isset($Team_Email)) {
                        $team_contact_count++;
                        if (isset($Team_Emaillabel)) {
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-email2 ts-font-icon ts-teammate-icon" style=""></i><a target="_blank" class="" href="mailto:' . $Team_Email . '">' . $Team_Emaillabel . '</a></div>';
                        } else {
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-email2 ts-font-icon ts-teammate-icon" style=""></i><a target="_blank" class="" href="mailto:' . $Team_Email . '">' . $Team_Email . '</a></div>';
                        }
                    }
                    if (isset($Team_Phone)) {
                        $team_contact_count++;
                        $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-phone2 ts-font-icon ts-teammate-icon" style=""></i>' . $Team_Phone . '</div>';
                    }
                    if (isset($Team_Cell)) {
                        $team_contact_count++;
                        $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-mobile ts-font-icon ts-teammate-icon" style=""></i>' . $Team_Cell . '</div>';
                    }
                    if (isset($Team_Portfolio)) {
                        $team_contact_count++;
                        if (isset($Team_Portfoliolabel)) {
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-portfolio ts-font-icon ts-teammate-icon" style=""></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Portfolio) . '">' . $Team_Portfoliolabel . '</a></div>';
                        } else {
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-portfolio ts-font-icon ts-teammate-icon" style=""></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Portfolio) . '">' . TS_VCSC_makeValidURL($Team_Portfolio) . '</a></div>';
                        }
                    }
                    if (isset($Team_Other)) {
                        $team_contact_count++;
                        if (isset($Team_Otherlabel)) {
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-link ts-font-icon ts-teammate-icon" style=""></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Other) . '">' . $Team_Otherlabel . '</a></div>';
                        } else {
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-link ts-font-icon ts-teammate-icon" style=""></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Other) . '">' . TS_VCSC_makeValidURL($Team_Other) . '</a></div>';
                        }
                    }
                    if (isset($Team_Skype)) {
                        $team_contact_count++;
                        $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-skype ts-font-icon ts-teammate-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i>' . $Team_Skype . '</div>';
                    }
                $team_contact		.= '</div>';
            }
            
            // Build Team Social Links
            $team_social 		= '';
            $team_social_count	= 0;
            if ($show_social == "true") {
                $team_social 		.= '<ul class="ts-teammate-icons ' . $icon_style . ' clearFixMe">';
                    if (isset($Team_Facebook)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Facebook"><a style="" target="_blank" class="ts-teammate-link facebook ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Facebook) . '"><i class="ts-teamicon-facebook1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Google)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Google+"><a style="" target="_blank" class="ts-teammate-link gplus ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Google) . '"><i class="ts-teamicon-googleplus1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Twitter)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Twitter"><a style="" target="_blank" class="ts-teammate-link twitter ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Twitter) . '"><i class="ts-teamicon-twitter1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Linkedin)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="LinkedIn"><a style="" target="_blank" class="ts-teammate-link linkedin ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Linkedin) . '"><i class="ts-teamicon-linkedin ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Xing)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Xing"><a style="" target="_blank" class="ts-teammate-link xing ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Xing) . '"><i class="ts-teamicon-xing3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Envato)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Envato"><a style="" target="_blank" class="ts-teammate-link envato ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Envato) . '"><i class="ts-teamicon-envato ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Rss)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="RSS"><a style="" target="_blank" class="ts-teammate-link rss ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Rss) . '"><i class="ts-teamicon-rss1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Forrst)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Forrst"><a style="" target="_blank" class="ts-teammate-link forrst ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Forrst) . '"><i class="ts-teamicon-forrst1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Flickr)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Flickr"><a style="" target="_blank" class="ts-teammate-link flickr ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Flickr) . '"><i class="ts-teamicon-flickr3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Instagram)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Instagram"><a style="" target="_blank" class="ts-teammate-link instagram ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Instagram) . '"><i class="ts-teamicon-instagram ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Picasa)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Picasa"><a style="" target="_blank" class="ts-teammate-link picasa ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Picasa) . '"><i class="ts-teamicon-picasa1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Pinterest)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Pinterest"><a style="" target="_blank" class="ts-teammate-link pinterest ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Pinterest) . '"><i class="ts-teamicon-pinterest1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Vimeo)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Vimeo"><a style="" target="_blank" class="ts-teammate-link vimeo ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Vimeo) . '"><i class="ts-teamicon-vimeo1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Youtube)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="YouTube"><a style="" target="_blank" class="ts-teammate-link youtube ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Youtube) . '"><i class="ts-teamicon-youtube1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                $team_social 		.= '</ul>';
            }
            
            // Build Team Skills
            $team_skills 		= '';
            $team_skills_count	= 0;
            if ((isset($Team_Skillset)) && ($show_skills == "true")) {
                $skill_entries      = get_post_meta( $Team_ID, 'ts_vcsc_team_skills_skillset', true);
                $skill_background 	= '';
                $team_skills		.= '<div class="ts-member-skills">';
                    foreach ((array) $skill_entries as $key => $entry) {
                        $skill_name = $skill_value = $skill_color = '';
                        if (isset($entry['skillname'])) {
                            $skill_name      = esc_html($entry['skillname']);
                        }
                        if (isset($entry['skillvalue'])) {
                            $skill_value     = esc_html($entry['skillvalue']);
                        }
                        if (isset($entry['skillcolor'])) {
                            $skill_color     = esc_html($entry['skillcolor']);
                        }
                        if ((strlen($skill_name) != 0) && (strlen($skill_value) != 0)) {
                            $team_skills_count++;
                            if ((strlen($skill_color) != 0) && ($skill_color != '#')) {
                                $skill_background = 'background-color: ' . $skill_color . ';';
                            }
                            $team_skills .= '<div class="skill-label">' . $skill_name . '<span>(' . $skill_value . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $skill_color . '" data-level="' . $skill_value . '%" data-appear-animation-delay="400" style="width: ' . $skill_value . '%; ' . $skill_background . '"></div></div>';
                        }
                    }
                $team_skills		.= '</div>';
            } else if ((!isset($Team_Skillset)) && ($show_skills == "true")) {
                $skill_background 	= '';
                $team_skills		.= '<div class="ts-member-skills">';
                    if ((isset($Team_Skillname1)) && (isset($Team_Skillvalue1))) {
                        $team_skills_count++;
                        if (isset($Team_Skillcolor1)) {
                            $skill_background = 'background-color: ' . $Team_Skillcolor1 . ';';
                        }
                        $team_skills .= '<div class="skill-label">' . $Team_Skillname1 . '<span>(' . $Team_Skillvalue1 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor1 . '" data-level="' . $Team_Skillvalue1 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue1 . '%; ' . $skill_background . '"></div></div>';
                    }
                    if ((isset($Team_Skillname2)) && (isset($Team_Skillvalue2))) {
                        $team_skills_count++;
                        if (isset($Team_Skillcolor2)) {
                            $skill_background = 'background-color: ' . $Team_Skillcolor2 . ';';
                        }
                        $team_skills .= '<div class="skill-label">' . $Team_Skillname2 . '<span>(' . $Team_Skillvalue2 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor2 . '" data-level="' . $Team_Skillvalue2 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue2 . '%; ' . $skill_background . '"></div></div>';
                    }
                    if ((isset($Team_Skillname3)) && (isset($Team_Skillvalue3))) {
                        $team_skills_count++;
                        if (isset($Team_Skillcolor3)) {
                            $skill_background = 'background-color: ' . $Team_Skillcolor3 . ';';
                        }
                        $team_skills .= '<div class="skill-label">' . $Team_Skillname3 . '<span>(' . $Team_Skillvalue3 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor3 . '" data-level="' . $Team_Skillvalue3 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue3 . '%; ' . $skill_background . '"></div></div>';
                    }
                    if ((isset($Team_Skillname4)) && (isset($Team_Skillvalue4))) {
                        $team_skills_count++;
                        if (isset($Team_Skillcolor4)) {
                            $skill_background = 'background-color: ' . $Team_Skillcolor4 . ';';
                        }
                        $team_skills .= '<div class="skill-label">' . $Team_Skillname4 . '<span>(' . $Team_Skillvalue4 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor4 . '" data-level="' . $Team_Skillvalue4 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue4 . '%; ' . $skill_background . '"></div></div>';
                    }
                    if ((isset($Team_Skillname5)) && (isset($Team_Skillvalue5))) {
                        $team_skills_count++;
                        if (isset($Team_Skillcolor5)) {
                            $skill_background = 'background-color: ' . $Team_Skillcolor5 . ';';
                        }
                        $team_skills .= '<div class="skill-label">' . $Team_Skillname5 . '<span>(' . $Team_Skillvalue5 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor5 . '" data-level="' . $Team_Skillvalue5 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue5 . '%; ' . $skill_background . '"></div></div>';
                    }
                    if ((isset($Team_Skillname6)) && (isset($Team_Skillvalue6))) {
                        $team_skills_count++;
                        if (isset($Team_Skillcolor6)) {
                            $skill_background = 'background-color: ' . $Team_Skillcolor6 . ';';
                        }
                        $team_skills .= '<div class="skill-label">' . $Team_Skillname6 . '<span>(' . $Team_Skillvalue6 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor6 . '" data-level="' . $Team_Skillvalue6 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue6 . '%; ' . $skill_background . '"></div></div>';
                    }
                $team_skills		.= '</div>';
            }
            
            // Build Download Button
            $team_download 		= '';
            if ($show_download == "true") {
                if ((isset($Team_Buttonfile)) || (isset($Team_Attachment))) {
                    if (isset($Team_Buttonfile)) {
                        $Team_File          = $Team_Buttonfile;
                    } else {
                        $Team_Attachment    = get_post_meta($Team_ID, 'ts_vcsc_team_basic_attachment', true);
                        $Team_Attachment    = wp_get_attachment_url($Team_Attachment['id']);
                        $Team_File          = $Team_Attachment;
                    }
                    $Team_FileFormat        = pathinfo($Team_File, PATHINFO_EXTENSION);
                    if (isset($Team_Buttontype)) {
                        $Team_Buttontype = $Team_Buttontype;
                    } else {
                        $Team_Buttontype = 'ts-button-3d';
                    };
                    if (!empty($Team_File)) {
                        $team_download	.= '<div class="ts-teammate-download">';
                        if (isset($Team_Buttontooltip)) {
                            $team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . ' ' . $team_tooltipclasses . '" data-tooltip="' . $Team_Buttontooltip . '" href="' . $Team_File . '" target="_blank"><img class="ts-teammate-file-image" src="' . TS_VCSC_GetResourceURL('images/filetypes/' . $Team_FileFormat . '.png') . '"> ' . $Team_Buttonlabel . '</a>';
                        } else {
                            $team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . '" href="' . $Team_File . '" target="_blank"><img class="ts-teammate-file-image" src="' . TS_VCSC_GetResourceURL('images/filetypes/' . $Team_FileFormat . '.png') . '"> ' . $Team_Buttonlabel . '</a>';
                        }
                        $team_download 	.= '</div>';
                        if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
                            wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
                        }
                    }
                }
            }
    
            // Create Output
            if ($style == "style1") {
                $output .= '<div id="' . $team_block_id . '" class="ts-team1 ts-teammate ' . $animation_css . ' ' . $el_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
                    if (($show_image == "true") && (!empty($Team_Image))) {
                        $output .= '<div class="team-avatar">';
                            $output .= '<img src="' . $Team_Image . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '">';
                        $output .= '</div>';
                    }
                    $output .= '<div class="team-user">';
                        if (($show_title == "true") && (!empty($Team_Title))) {
                            $output .= '<h4 class="team-title">' . $Team_Title . '</h4>';
                        }
                        if (($show_title == "true") && (!empty($Team_Position))) {
                            $output .= '<div class="team-job">' . $Team_Position . '</div>';
                        }
                        $output .= $team_dedicated;
                        $output .= $team_download;
                    $output .= '</div>';
                    if (($show_content == "true") && (!empty($Team_Content))) {
                        $output .= '<div class="team-information">';
                            if (function_exists('wpb_js_remove_wpautop')){
                                $output .= '' . wpb_js_remove_wpautop(do_shortcode($Team_Content), true) . '';
                            } else {
                                $output .= '' . do_shortcode($Team_Content) . '';
                            }
                        $output .= '</div>';
                    }
                    if ($team_contact_count > 0) {
                        $output .= $team_contact;
                    }
                    if ($team_social_count > 0) {
                        $output .= $team_social;
                    }
                    if ($team_skills_count > 0) {
                        $output .= $team_skills;
                    }
                $output .= '</div>';
            } else if ($style == "style2") {
                $output .= '<div id="' . $team_block_id . '" class="ts-team2 ts-teammate ' . $animation_css . ' ' . $el_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
                    $output .= '<div style="width: 25%; float: left;">';
                        if (($show_image == "true") && (!empty($Team_Image))) {
                            $output .= '<div class="ts-team2-header">';
                                $output .= '<img src="' . $Team_Image . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '">';
                            $output .= '</div>';
                        }
                        if ($team_social_count > 0) {
                            $output .= '<div class="ts-team2-footer" style="' . (($show_image == "false") ? "margin-top: 0px;" : "") . '">';
                                $output .= $team_social;
                            $output .= '</div>';
                        }
                    $output .= '</div>';
                    if (($show_image == "true") || ($team_social_count > 0)) {
                        $output .= '<div class="ts-team2-content" style="">';
                    } else {
                        $output .= '<div class="ts-team2-content" style="width: 100%; margin-left: 0px;">';
                    }
                        $output .= '<div class="ts-team2-line"></div>';
                        if (($show_title == "true") && (!empty($Team_Title))) {
                            $output .= '<h3>' . $Team_Title . '</h3>';
                        }
                        if (($show_title == "true") && (!empty($Team_Position))) {
                            $output .= '<p class="ts-team2-lead">' . $Team_Position . '</p>';
                        }
                        if (($show_content == "true") && (!empty($Team_Content))) {
                            if (function_exists('wpb_js_remove_wpautop')){
                                $output .= '' . wpb_js_remove_wpautop(do_shortcode($Team_Content), true) . '';
                            } else {
                                $output .= '' . do_shortcode($Team_Content) . '';
                            }
                        }
                    $output .= '</div>';
                    $output .= $team_dedicated;
                    $output .= $team_download;
                    if ($team_contact_count > 0) {
                        $output .= $team_contact;
                    }
                    if ($team_skills_count > 0) {
                        $output .= $team_skills;
                    }
                $output .= '</div>';
            } else if ($style == "style3") {
                $output .= '<div id="' . $team_block_id . '" class="ts-team3 ts-teammate ' . $animation_css . ' ' . $el_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
                    if (($show_image == "true") && (!empty($Team_Image))) {
                        $output .= '<img class="ts-team3-person-image ' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" src="' . $Team_Image . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="">';
                    }
                    if (($show_title == "true") && (!empty($Team_Title))) {
                        $output .= '<div class="ts-team3-person-name">' . $Team_Title . '</div>';
                    }
                    if (($show_title == "true") && (!empty($Team_Position))) {
                        $output .= '<div class="ts-team3-person-position">' . $Team_Position . '</div>';
                    }
                    if (($show_content == "true") && (!empty($Team_Content))) {
                        if (function_exists('wpb_js_remove_wpautop')){
                            $output .= '<div class="ts-team3-person-description">' . wpb_js_remove_wpautop(do_shortcode($Team_Content), true) . '</div>';
                        } else {
                            $output .= '<div class="ts-team3-person-description">' . do_shortcode($Team_Content) . '</div>';
                        }
                    }
                        $output .= $team_dedicated;
                        $output .= $team_download;
                        if ($team_contact_count > 0) {
                            $output .= $team_contact;
                        }
                        if ($team_social_count > 0) {
                            $output .= $team_social;
                        }
                        if ($team_skills_count > 0) {
                            $output .= $team_skills;
                        }
                    $output .= '<div class="ts-team3-person-space"></div>';					
                $output .= '</div>';
            }
    
            echo $output;
            
            $myvariable = ob_get_clean();
            return $myvariable;
        }
    
        // Single Teammate for Custom Slider
        function TS_VCSC_Team_Mates_Single ($atts, $content = null) {
            global $VISUAL_COMPOSER_EXTENSIONS;
            ob_start();
            
            if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
                $FOOTER = true;
            } else {
                $FOOTER = false;
            }
            wp_enqueue_script('ts-extend-hammer', 								TS_VCSC_GetResourceURL('js/jquery.hammer.min.js'), array('jquery'), false, $FOOTER);
            wp_enqueue_script('ts-extend-nacho', 								TS_VCSC_GetResourceURL('js/jquery.nchlightbox.min.js'), array('jquery'), false, $FOOTER);
            wp_enqueue_style('ts-extend-nacho',									TS_VCSC_GetResourceURL('css/jquery.nchlightbox.min.css'), null, false, 'all');
            if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
                wp_enqueue_style('ts-extend-simptip',                 			TS_VCSC_GetResourceURL('css/jquery.simptip.css'), null, false, 'all');
                wp_enqueue_style('ts-extend-animations',                 		TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-animations.min.css'), null, false, 'all');
                wp_enqueue_style('ts-extend-teammate',                 			TS_VCSC_GetResourceURL('css/ts-font-teammates.css'), null, false, 'all');
                wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
                wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
            }
            
            extract( shortcode_atts( array(
                'team_member'			=> '',
                'team_name'				=> '',
                'style'					=> 'style1',
                'show_image'            => 'true',
                'show_grayscale'        => 'true',
                'show_lightbox'         => 'true',
                'show_title'            => 'true',
                'show_content'          => 'true',
                'show_dedicated'        => 'false',
                'show_download'			=> 'true',
                'show_contact'			=> 'true',
                'show_social'			=> 'true',
                'show_skills'			=> 'true',
                'icon_style' 			=> 'simple',
                'icon_background'		=> '#f5f5f5',
                'icon_frame_color'		=> '#f5f5f5',
                'icon_frame_thick'		=> 1,
                'icon_margin' 			=> 5,
                'icon_align'			=> 'left',
                'icon_hover'			=> '',
                'tooltip_style'			=> '',
                'tooltip_position'		=> 'ts-simptip-position-top',
            ), $atts ));
            
            $output = '';
            
            // Check for Teammate and End Shortcode if Empty
            if (empty($team_member)) {
                $output .= '<div style="text-align: justify; font-weight: bold; font-size: 14px; color: red;">Please select a teammate in the element settings!</div>';
                echo $output;
                $myvariable = ob_get_clean();
                return $myvariable;
            }
        
            $team_block_id					    = 'ts-vcsc-meet-team-' . mt_rand(999999, 9999999);
        
            $animation_css					    = '';
            
            $team_tooltipclasses				= "ts-simptip-multiline " . $tooltip_style . " " . $tooltip_position;
        
            if ((empty($icon_background)) || ($icon_style == 'simple')) {
                $icon_frame_style				= '';
            } else {
                $icon_frame_style				= 'background: ' . $icon_background . ';';
            }
            
            if ($icon_frame_thick > 0) {
                $icon_top_adjust				= 'top: ' . (10 - $icon_frame_thick) . 'px;';
            } else {
                $icon_top_adjust				= '';
            }
            
            if ($icon_style == 'simple') {
                $icon_frame_border				= '';
            } else {
                $icon_frame_border				= ' border: ' . $icon_frame_thick . 'px solid ' . $icon_frame_color . ';';
            }
            
            $icon_horizontal_adjust				= '';
        
            $team_social 						= '';
        
            // Retrieve Team Post Main Content
            $team_array							= array();
            $args = array(
                'no_found_rows' 				=> 1,
                'ignore_sticky_posts' 			=> 1,
                'posts_per_page' 				=> -1,
                'post_type' 					=> 'ts_team',
                'post_status' 					=> 'publish',
                'orderby' 						=> 'title',
                'order' 						=> 'ASC',
            );
            $team_query = new WP_Query($args);
            if ($team_query->have_posts()) {
                foreach($team_query->posts as $p) {
                    if ($p->ID == $team_member) {
                        $team_data = array(
                            'author'			=> $p->post_author,
                            'name'				=> $p->post_name,
                            'title'				=> $p->post_title,
                            'id'				=> $p->ID,
                            'content'			=> $p->post_content,
                        );
                        $team_array[] = $team_data;
                    }
                }
            }
            wp_reset_postdata();
            
            // Build Team Post Main Content
            foreach ($team_array as $index => $array) {
                $Team_Author					= $team_array[$index]['author'];
                $Team_Name 						= $team_array[$index]['name'];
                $Team_Title 					= $team_array[$index]['title'];
                $Team_ID 						= $team_array[$index]['id'];
                $Team_Content 					= $team_array[$index]['content'];
                $Team_Image						= wp_get_attachment_image_src(get_post_thumbnail_id($Team_ID), 'full');
                if ($Team_Image == false) {
                    $Team_Image          		= TS_VCSC_GetResourceURL('images/Default_person.jpg');
                } else {
                    $Team_Image          		= $Team_Image[0];
                }
            }
            
            // Retrieve Team Post Meta Content
            $custom_fields 						= get_post_custom($Team_ID);
            $custom_fields_array				= array();
            foreach ($custom_fields as $field_key => $field_values) {
                if (!isset($field_values[0])) continue;
                if (in_array($field_key, array("_edit_lock", "_edit_last"))) continue;
                if (strpos($field_key, 'ts_vcsc_team_') !== false) {
                    $field_key_split 			= explode("_", $field_key);
                    $field_key_length 			= count($field_key_split) - 1;
                    $custom_data = array(
                        'group'					=> $field_key_split[$field_key_length - 1],
                        'name'					=> 'Team_' . ucfirst($field_key_split[$field_key_length]),
                        'value'					=> $field_values[0],
                    );
                    $custom_fields_array[] = $custom_data;
                }
            }
            foreach ($custom_fields_array as $index => $array) {
                ${$custom_fields_array[$index]['name']} = $custom_fields_array[$index]['value'];
            }
            if (isset($Team_Position)) {
                $Team_Position 					= $Team_Position;
            } else {
                $Team_Position 					= '';
            }
            if (isset($Team_Buttonlabel)) {
                $Team_Buttonlabel				= $Team_Buttonlabel;
            } else {
                $Team_Buttonlabel				= '';
            }
            
            // Build Dedicated Page Link
            $team_dedicated     = '';
            if ($show_dedicated == "true") {
                if ((isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
                    $Team_Dedicatedpage         = get_page_link($Team_Dedicatedpage);
                    if (isset($Team_Dedicatedtarget)) {
                        $team_dedicated_target  = '_blank';
                    } else {
                        $team_dedicated_target  = '_parent';
                    }
                    $team_dedicated	.= '<div class="ts-teammate-dedicated">';
                    if (isset($Team_Dedicatedtooltip)) {
                        $team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . ' ' . $team_tooltipclasses . '" data-tooltip="' . $Team_Dedicatedtooltip . '" href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '"><img class="ts-teammate-page-image" src="' . TS_VCSC_GetResourceURL('images/TS_VCSC_Demo_Icon_16x16.png') . '"> ' . $Team_Dedicatedlabel . '</a>';
                    } else {
                        $team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . '" href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '"><img class="ts-teammate-page-image" src="' . TS_VCSC_GetResourceURL('images/TS_VCSC_Demo_Icon_16x16.png') . '"> ' . $Team_Dedicatedlabel . '</a>';
                    }
                    $team_dedicated 	.= '</div>';
                    if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
                        wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
                    }
                }
            }
            
            // Build Team Contact Information
            $team_contact		= '';
            $team_contact_count	= 0;
            if ($show_contact == "true") {
                $team_contact		.= '<div class="ts-team-contact">';
                    if (isset($Team_Email)) {
                        $team_contact_count++;
                        if (isset($Team_Emaillabel)) {
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-email2 ts-font-icon ts-teammate-icon" style=""></i><a target="_blank" class="" href="mailto:' . $Team_Email . '">' . $Team_Emaillabel . '</a></div>';
                        } else {
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-email2 ts-font-icon ts-teammate-icon" style=""></i><a target="_blank" class="" href="mailto:' . $Team_Email . '">' . $Team_Email . '</a></div>';
                        }
                    }
                    if (isset($Team_Phone)) {
                        $team_contact_count++;
                        $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-phone2 ts-font-icon ts-teammate-icon" style=""></i>' . $Team_Phone . '</div>';
                    }
                    if (isset($Team_Cell)) {
                        $team_contact_count++;
                        $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-mobile ts-font-icon ts-teammate-icon" style=""></i>' . $Team_Cell . '</div>';
                    }
                    if (isset($Team_Portfolio)) {
                        $team_contact_count++;
                        if (isset($Team_Portfoliolabel)) {
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-portfolio ts-font-icon ts-teammate-icon" style=""></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Portfolio) . '">' . $Team_Portfoliolabel . '</a></div>';
                        } else {
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-portfolio ts-font-icon ts-teammate-icon" style=""></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Portfolio) . '">' . TS_VCSC_makeValidURL($Team_Portfolio) . '</a></div>';
                        }
                    }
                    if (isset($Team_Other)) {
                        $team_contact_count++;
                        if (isset($Team_Otherlabel)) {
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-link ts-font-icon ts-teammate-icon" style=""></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Other) . '">' . $Team_Otherlabel . '</a></div>';
                        } else {
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-link ts-font-icon ts-teammate-icon" style=""></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Other) . '">' . TS_VCSC_makeValidURL($Team_Other) . '</a></div>';
                        }
                    }
                    if (isset($Team_Skype)) {
                        $team_contact_count++;
                        $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-skype ts-font-icon ts-teammate-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i>' . $Team_Skype . '</div>';
                    }
                $team_contact		.= '</div>';
            }
            
            // Build Team Social Links
            $team_social 		= '';
            $team_social_count	= 0;
            if ($show_social == "true") {
                $team_social 		.= '<ul class="ts-teammate-icons ' . $icon_style . ' clearFixMe">';
                    if (isset($Team_Facebook)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Facebook"><a style="" target="_blank" class="ts-teammate-link facebook ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Facebook) . '"><i class="ts-teamicon-facebook1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Google)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Google+"><a style="" target="_blank" class="ts-teammate-link gplus ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Google) . '"><i class="ts-teamicon-googleplus1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Twitter)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Twitter"><a style="" target="_blank" class="ts-teammate-link twitter ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Twitter) . '"><i class="ts-teamicon-twitter1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Linkedin)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="LinkedIn"><a style="" target="_blank" class="ts-teammate-link linkedin ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Linkedin) . '"><i class="ts-teamicon-linkedin ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Xing)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Xing"><a style="" target="_blank" class="ts-teammate-link xing ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Xing) . '"><i class="ts-teamicon-xing3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Envato)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Envato"><a style="" target="_blank" class="ts-teammate-link envato ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Envato) . '"><i class="ts-teamicon-envato ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Rss)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="RSS"><a style="" target="_blank" class="ts-teammate-link rss ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Rss) . '"><i class="ts-teamicon-rss1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Forrst)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Forrst"><a style="" target="_blank" class="ts-teammate-link forrst ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Forrst) . '"><i class="ts-teamicon-forrst1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Flickr)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Flickr"><a style="" target="_blank" class="ts-teammate-link flickr ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Flickr) . '"><i class="ts-teamicon-flickr3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Instagram)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Instagram"><a style="" target="_blank" class="ts-teammate-link instagram ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Instagram) . '"><i class="ts-teamicon-instagram ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Picasa)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Picasa"><a style="" target="_blank" class="ts-teammate-link picasa ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Picasa) . '"><i class="ts-teamicon-picasa1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Pinterest)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Pinterest"><a style="" target="_blank" class="ts-teammate-link pinterest ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Pinterest) . '"><i class="ts-teamicon-pinterest1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Vimeo)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Vimeo"><a style="" target="_blank" class="ts-teammate-link vimeo ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Vimeo) . '"><i class="ts-teamicon-vimeo1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                    if (isset($Team_Youtube)) {
                        $team_social_count++;
                        $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="YouTube"><a style="" target="_blank" class="ts-teammate-link youtube ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Youtube) . '"><i class="ts-teamicon-youtube1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                    }
                $team_social 		.= '</ul>';
            }
            
            // Build Team Skills
            $team_skills 		= '';
            $team_skills_count	= 0;
            if ((isset($Team_Skillset)) && ($show_skills == "true")) {
                $skill_entries      = get_post_meta( $Team_ID, 'ts_vcsc_team_skills_skillset', true);
                $skill_background 	= '';
                $team_skills		.= '<div class="ts-member-skills">';
                    foreach ((array) $skill_entries as $key => $entry) {
                        $skill_name = $skill_value = $skill_color = '';
                        if (isset($entry['skillname'])) {
                            $skill_name      = esc_html($entry['skillname']);
                        }
                        if (isset($entry['skillvalue'])) {
                            $skill_value     = esc_html($entry['skillvalue']);
                        }
                        if (isset($entry['skillcolor'])) {
                            $skill_color     = esc_html($entry['skillcolor']);
                        }
                        if ((strlen($skill_name) != 0) && (strlen($skill_value) != 0)) {
                            $team_skills_count++;
                            if ((strlen($skill_color) != 0) && ($skill_color != '#')) {
                                $skill_background = 'background-color: ' . $skill_color . ';';
                            }
                            $team_skills .= '<div class="skill-label">' . $skill_name . '<span>(' . $skill_value . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $skill_color . '" data-level="' . $skill_value . '%" data-appear-animation-delay="400" style="width: ' . $skill_value . '%; ' . $skill_background . '"></div></div>';
                        }
                    }
                $team_skills		.= '</div>';
            } else if ((!isset($Team_Skillset)) && ($show_skills == "true")) {
                $skill_background 	= '';
                $team_skills		.= '<div class="ts-member-skills">';
                    if ((isset($Team_Skillname1)) && (isset($Team_Skillvalue1))) {
                        $team_skills_count++;
                        if (isset($Team_Skillcolor1)) {
                            $skill_background = 'background-color: ' . $Team_Skillcolor1 . ';';
                        }
                        $team_skills .= '<div class="skill-label">' . $Team_Skillname1 . '<span>(' . $Team_Skillvalue1 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor1 . '" data-level="' . $Team_Skillvalue1 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue1 . '%; ' . $skill_background . '"></div></div>';
                    }
                    if ((isset($Team_Skillname2)) && (isset($Team_Skillvalue2))) {
                        $team_skills_count++;
                        if (isset($Team_Skillcolor2)) {
                            $skill_background = 'background-color: ' . $Team_Skillcolor2 . ';';
                        }
                        $team_skills .= '<div class="skill-label">' . $Team_Skillname2 . '<span>(' . $Team_Skillvalue2 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor2 . '" data-level="' . $Team_Skillvalue2 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue2 . '%; ' . $skill_background . '"></div></div>';
                    }
                    if ((isset($Team_Skillname3)) && (isset($Team_Skillvalue3))) {
                        $team_skills_count++;
                        if (isset($Team_Skillcolor3)) {
                            $skill_background = 'background-color: ' . $Team_Skillcolor3 . ';';
                        }
                        $team_skills .= '<div class="skill-label">' . $Team_Skillname3 . '<span>(' . $Team_Skillvalue3 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor3 . '" data-level="' . $Team_Skillvalue3 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue3 . '%; ' . $skill_background . '"></div></div>';
                    }
                    if ((isset($Team_Skillname4)) && (isset($Team_Skillvalue4))) {
                        $team_skills_count++;
                        if (isset($Team_Skillcolor4)) {
                            $skill_background = 'background-color: ' . $Team_Skillcolor4 . ';';
                        }
                        $team_skills .= '<div class="skill-label">' . $Team_Skillname4 . '<span>(' . $Team_Skillvalue4 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor4 . '" data-level="' . $Team_Skillvalue4 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue4 . '%; ' . $skill_background . '"></div></div>';
                    }
                    if ((isset($Team_Skillname5)) && (isset($Team_Skillvalue5))) {
                        $team_skills_count++;
                        if (isset($Team_Skillcolor5)) {
                            $skill_background = 'background-color: ' . $Team_Skillcolor5 . ';';
                        }
                        $team_skills .= '<div class="skill-label">' . $Team_Skillname5 . '<span>(' . $Team_Skillvalue5 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor5 . '" data-level="' . $Team_Skillvalue5 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue5 . '%; ' . $skill_background . '"></div></div>';
                    }
                    if ((isset($Team_Skillname6)) && (isset($Team_Skillvalue6))) {
                        $team_skills_count++;
                        if (isset($Team_Skillcolor6)) {
                            $skill_background = 'background-color: ' . $Team_Skillcolor6 . ';';
                        }
                        $team_skills .= '<div class="skill-label">' . $Team_Skillname6 . '<span>(' . $Team_Skillvalue6 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor6 . '" data-level="' . $Team_Skillvalue6 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue6 . '%; ' . $skill_background . '"></div></div>';
                    }
                $team_skills		.= '</div>';
            }
            
            // Build Download Button
            $team_download 		= '';
            if ($show_download == "true") {
                if ((isset($Team_Buttonfile)) || (isset($Team_Attachment))) {
                    if (isset($Team_Buttonfile)) {
                        $Team_File          = $Team_Buttonfile;
                    } else {
                        $Team_Attachment    = get_post_meta($Team_ID, 'ts_vcsc_team_basic_attachment', true);
                        $Team_Attachment    = wp_get_attachment_url($Team_Attachment['id']);
                        $Team_File          = $Team_Attachment;
                    }
                    $Team_FileFormat        = pathinfo($Team_File, PATHINFO_EXTENSION);
                    if (isset($Team_Buttontype)) {
                        $Team_Buttontype = $Team_Buttontype;
                    } else {
                        $Team_Buttontype = 'ts-button-3d';
                    };
                    if (!empty($Team_File)) {
                        $team_download	.= '<div class="ts-teammate-download">';
                        if (isset($Team_Buttontooltip)) {
                            $team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . ' ' . $team_tooltipclasses . '" data-tooltip="' . $Team_Buttontooltip . '" href="' . $Team_File . '" target="_blank"><img class="ts-teammate-file-image" src="' . TS_VCSC_GetResourceURL('images/filetypes/' . $Team_FileFormat . '.png') . '"> ' . $Team_Buttonlabel . '</a>';
                        } else {
                            $team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . '" href="' . $Team_File . '" target="_blank"><img class="ts-teammate-file-image" src="' . TS_VCSC_GetResourceURL('images/filetypes/' . $Team_FileFormat . '.png') . '"> ' . $Team_Buttonlabel . '</a>';
                        }
                        $team_download 	.= '</div>';
                        if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
                            wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
                        }
                    }
                }
            }

            // Create Output
            if ($style == "style1") {
                $output .= '<div id="' . $team_block_id . '" class="ts-team1 ts-teammate ' . $animation_css . '" style="">';
                    if (($show_image == "true") && (!empty($Team_Image))) {
                        $output .= '<div class="team-avatar">';
                            $output .= '<img src="' . $Team_Image . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '">';
                        $output .= '</div>';
                    }
                    $output .= '<div class="team-user">';
                        if (!empty($Team_Title)) {
                            $output .= '<h4 class="team-title">' . $Team_Title . '</h4>';
                        }
                        if (!empty($Team_Position)) {
                            $output .= '<div class="team-job">' . $Team_Position . '</div>';
                        }
                        $output .= $team_dedicated;
                        $output .= $team_download;
                    $output .= '</div>';
                    if (($show_content == "true") && (!empty($Team_Content))) {
                        $output .= '<div class="team-information">';
                            if (function_exists('wpb_js_remove_wpautop')){
                                $output .= '' . wpb_js_remove_wpautop(do_shortcode($Team_Content), true) . '';
                            } else {
                                $output .= '' . do_shortcode($Team_Content) . '';
                            }
                        $output .= '</div>';
                    }
                    if ($team_contact_count > 0) {
                        $output .= $team_contact;
                    }
                    if ($team_social_count > 0) {
                        $output .= $team_social;
                    }
                    if ($team_skills_count > 0) {
                        $output .= $team_skills;
                    }
                $output .= '</div>';
            } else if ($style == "style2") {
                $output .= '<div id="' . $team_block_id . '" class="ts-team2 ts-teammate ' . $animation_css . '" style="">';
                    $output .= '<div style="width: 25%; float: left;">';
                        if (($show_image == "true") && (!empty($Team_Image))) {
                            $output .= '<div class="ts-team2-header">';
                                $output .= '<img src="' . $Team_Image . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '">';
                            $output .= '</div>';
                        }
                        if ($team_social_count > 0) {
                            if ($show_image == "true") {
                                $output .= '<div class="ts-team2-footer" style="' . (($show_image == "false") ? "margin-top: 0px;" : "") . '">';
                            } else {
                                $output .= '<div class="ts-team2-footer" style="width: 100%; margin-top: 0px;">';
                            }
                                $output .= $team_social;
                            $output .= '</div>';
                        }
                    $output .= '</div>';
                    if (($show_image == "true") || ($team_social_count > 0)) {
                        $output .= '<div class="ts-team2-content" style="">';
                    } else {
                        $output .= '<div class="ts-team2-content" style="width: 100%; margin-left: 0px;">';
                    }
                        $output .= '<div class="ts-team2-line"></div>';
                        if (!empty($Team_Title)) {
                            $output .= '<h3>' . $Team_Title . '</h3>';
                        }
                        if (!empty($Team_Position)) {
                            $output .= '<p class="ts-team2-lead">' . $Team_Position . '</p>';
                        }
                        if (($show_content == "true") && (!empty($Team_Content))) {
                            if (function_exists('wpb_js_remove_wpautop')){
                                $output .= '' . wpb_js_remove_wpautop(do_shortcode($Team_Content), true) . '';
                            } else {
                                $output .= '' . do_shortcode($Team_Content) . '';
                            }
                        }
                    $output .= '</div>';
                    $output .= $team_dedicated;
                    $output .= $team_download;
                    if ($team_contact_count > 0) {
                        $output .= $team_contact;
                    }
                    if ($team_skills_count > 0) {
                        $output .= $team_skills;
                    }
                $output .= '</div>';
            } else if ($style == "style3") {
                $output .= '<div id="' . $team_block_id . '" class="ts-team3 ts-teammate ' . $animation_css . '" style="">';
                    if (($show_image == "true") && (!empty($Team_Image))) {
                        $output .= '<img class="ts-team3-person-image ' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" src="' . $Team_Image . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="">';
                    }
                    if (!empty($Team_Title)) {
                        $output .= '<div class="ts-team3-person-name">' . $Team_Title . '</div>';
                    }
                    if (!empty($Team_Position)) {
                        $output .= '<div class="ts-team3-person-position">' . $Team_Position . '</div>';
                    }
                    if (($show_content == "true") && (!empty($Team_Content))) {
                        if (function_exists('wpb_js_remove_wpautop')){
                            $output .= '<div class="ts-team3-person-description">' . wpb_js_remove_wpautop(do_shortcode($Team_Content), true) . '</div>';
                        } else {
                            $output .= '<div class="ts-team3-person-description">' . do_shortcode($Team_Content) . '</div>';
                        }
                    }
                        $output .= $team_dedicated;
                        $output .= $team_download;
                        if ($team_contact_count > 0) {
                            $output .= $team_contact;
                        }
                        if ($team_social_count > 0) {
                            $output .= $team_social;
                        }
                        if ($team_skills_count > 0) {
                            $output .= $team_skills;
                        }
                    $output .= '<div class="ts-team3-person-space"></div>';					
                $output .= '</div>';
            }
    
            echo $output;
            
            $myvariable = ob_get_clean();
            return $myvariable;
        }
            
        // Custom Teammate Slider
        function TS_VCSC_Team_Mates_Slider_Custom ($atts, $content = null){
            global $VISUAL_COMPOSER_EXTENSIONS;
            ob_start();
            
            if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
                $FOOTER = true;
            } else {
                $FOOTER = false;
            }
    
            if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
                wp_enqueue_style('ts-extend-owlcarousel',				        TS_VCSC_GetResourceURL('css/jquery.owl.carousel.css'), null, false, 'all');
                wp_enqueue_script('ts-extend-owlcarousel',			            TS_VCSC_GetResourceURL('js/jquery.owl.carousel.min.js'), array('jquery'), false, $FOOTER);
                wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
                wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
            }
            
            extract( shortcode_atts( array(
                'auto_height'                   => 'true',
                'auto_play'                     => 'false',
                'show_bar'                      => 'true',
                'bar_color'                     => '#dd3333',
                'show_speed'                    => 5000,
                'stop_hover'                    => 'true',
                'show_navigation'               => 'true',
                'page_numbers'                  => 'false',
                'transitions'                   => 'backSlide',
                'margin_top'                    => 0,
                'margin_bottom'                 => 0,
                'el_id'                         => '',
                'el_class'                      => '',
            ), $atts ));
            
            $teammate_random                    = mt_rand(999999, 9999999);
            
            if (!empty($el_id)) {
                $teammate_slider_id			    = $el_id;
            } else {
                $teammate_slider_id			    = 'ts-vcsc-teammate-slider-' . $teammate_random;
            }
            
            $output = '';
            
            $output .= '<div id="' . $teammate_slider_id . '" class="ts-teammates-slider owl-carousel" data-id="' . $teammate_random . '" data-navigation="' . $show_navigation . '" data-transitions="' . $transitions . '" data-height="' . $auto_height . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '" data-numbers="' . $page_numbers . '">';
                $output .= do_shortcode($content);
            $output .= '</div>';
            
            echo $output;
            
            $myvariable = ob_get_clean();
            return $myvariable;
        }
        // Category Teammate Slider
        function TS_VCSC_Team_Mates_Slider_Category ($atts, $content = null){
            global $VISUAL_COMPOSER_EXTENSIONS;
            ob_start();
            
            if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
                $FOOTER = true;
            } else {
                $FOOTER = false;
            }
            wp_enqueue_script('ts-extend-hammer', 								TS_VCSC_GetResourceURL('js/jquery.hammer.min.js'), array('jquery'), false, $FOOTER);
            wp_enqueue_script('ts-extend-nacho', 								TS_VCSC_GetResourceURL('js/jquery.nchlightbox.min.js'), array('jquery'), false, $FOOTER);
            wp_enqueue_style('ts-extend-nacho',									TS_VCSC_GetResourceURL('css/jquery.nchlightbox.min.css'), null, false, 'all');
            if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
                wp_enqueue_style('ts-extend-owlcarousel',				        TS_VCSC_GetResourceURL('css/jquery.owl.carousel.css'), null, false, 'all');
                wp_enqueue_script('ts-extend-owlcarousel',			            TS_VCSC_GetResourceURL('js/jquery.owl.carousel.min.js'), array('jquery'), false, $FOOTER);
                wp_enqueue_style('ts-extend-simptip',                 			TS_VCSC_GetResourceURL('css/jquery.simptip.css'), null, false, 'all');
                wp_enqueue_style('ts-extend-animations',                 		TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-animations.min.css'), null, false, 'all');
                wp_enqueue_style('ts-extend-teammate',                 			TS_VCSC_GetResourceURL('css/ts-font-teammates.css'), null, false, 'all');
                wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
                wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
            }
            
            extract( shortcode_atts( array(
                'teammatecat'                   => '',
                'style'							=> 'style1',
                'show_image'                    => 'true',
                'show_grayscale'                => 'true',
                'show_lightbox'                 => 'true',
                'show_title'                    => 'true',
                'show_content'                  => 'true',
                'show_dedicated'                => 'false',
                'show_download'			        => 'true',
                'show_contact'			        => 'true',
                'show_social'			        => 'true',
                'show_skills'			        => 'true',
                'icon_style' 			        => 'simple',
                'icon_background'		        => '#f5f5f5',
                'icon_frame_color'		        => '#f5f5f5',
                'icon_frame_thick'		        => 1,
                'icon_margin' 			        => 5,
                'icon_align'			        => 'left',
                'icon_hover'			        => '',
                'tooltip_style'			        => '',
                'tooltip_position'		        => 'ts-simptip-position-top',
                'auto_height'                   => 'true',
                'auto_play'                     => 'false',
                'show_bar'                      => 'true',
                'bar_color'                     => '#dd3333',
                'show_speed'                    => 5000,
                'stop_hover'                    => 'true',
                'show_navigation'               => 'true',
                'page_numbers'                  => 'false',
                'transitions'                   => 'backSlide',
                'margin_top'                    => 0,
                'margin_bottom'                 => 0,
                'el_id'                         => '',
                'el_class'                      => '',
            ), $atts ));
            
            $teammate_random                    = mt_rand(999999, 9999999);
        
            $animation_css					    = '';
            
            $team_tooltipclasses				= "ts-simptip-multiline " . $tooltip_style . " " . $tooltip_position;

            if (!empty($el_id)) {
                $teammate_slider_id			    = $el_id;
            } else {
                $teammate_slider_id			    = 'ts-vcsc-teammate-slider-' . $teammate_random;
            }
            
            if (!is_array($teammatecat)) {
                $teammatecat 				    = array_map('trim', explode(',', $teammatecat));
            }
            
            if ((empty($icon_background)) || ($icon_style == 'simple')) {
                $icon_frame_style				= '';
            } else {
                $icon_frame_style				= 'background: ' . $icon_background . ';';
            }
            
            if ($icon_frame_thick > 0) {
                $icon_top_adjust				= 'top: ' . (10 - $icon_frame_thick) . 'px;';
            } else {
                $icon_top_adjust				= '';
            }
            
            if ($icon_style == 'simple') {
                $icon_frame_border				= '';
            } else {
                $icon_frame_border				= ' border: ' . $icon_frame_thick . 'px solid ' . $icon_frame_color . ';';
            }
            
            $icon_horizontal_adjust				= '';
        
            $team_social 						= '';
            
            $output = '';
            
            // Retrieve Teammate Post Main Content
            $teammate_array					    = array();
            $category_fields 	                = array();
            $args = array(
                'no_found_rows' 				=> 1,
                'ignore_sticky_posts' 			=> 1,
                'posts_per_page' 				=> -1,
                'post_type' 					=> 'ts_team',
                'post_status' 					=> 'publish',
                'orderby' 						=> 'title',
                'order' 						=> 'ASC',
            );
            $teammate_query = new WP_Query($args);
            if ($teammate_query->have_posts()) {
                foreach($teammate_query->posts as $p) {
                    $categories = TS_VCSC_GetTheCategoryByTax($p->ID, 'ts_team_category');
                    if ($categories && !is_wp_error($categories)) {
                        $category_slugs_arr     = array();
                        $arrayMatch             = 0;
                        foreach ($categories as $category) {
                            if (in_array($category->slug, $teammatecat)) {
                                $arrayMatch++;
                            }
                            $category_slugs_arr[] = $category->slug;
                            $category_data = array(
                                'slug'			=> $category->slug,
                                'name'			=> $category->cat_name,
                                'number'    	=> $category->term_id,
                            );
                            $category_fields[]  = $category_data;
                        }
                        $categories_slug_str    = join(",", $category_slugs_arr);
                    } else {
                        $category_slugs_arr     = array();
                        $arrayMatch             = 0;
                        if (in_array("ts-teammate-none-applied", $teammatecat)) {
                            $arrayMatch++;
                        }
                        $category_slugs_arr[]   = '';
                        $categories_slug_str    = join(",", $category_slugs_arr);
                    }
                    if ($arrayMatch > 0) {
                        $teammate_data = array(
                            'author'			=> $p->post_author,
                            'name'				=> $p->post_name,
                            'title'				=> $p->post_title,
                            'id'				=> $p->ID,
                            'content'			=> $p->post_content,
                            'categories'        => $categories_slug_str,
                        );
                        $teammate_array[]       = $teammate_data;
                    }
                }
            }
            wp_reset_postdata();
            
            $output .= '<div id="' . $teammate_slider_id . '" class="ts-teammates-slider owl-carousel" data-id="' . $teammate_random . '" data-navigation="' . $show_navigation . '" data-transitions="' . $transitions . '" data-height="' . $auto_height . '" data-play="' . $auto_play . '" data-bar="' . $show_bar . '" data-color="' . $bar_color . '" data-speed="' . $show_speed . '" data-hover="' . $stop_hover . '" data-numbers="' . $page_numbers . '">';
            
            // Build Teammate Post Main Content
            foreach ($teammate_array as $index => $array) {
                $Team_Author			    = $teammate_array[$index]['author'];
                $Team_Name 				    = $teammate_array[$index]['name'];
                $Team_Title 			    = $teammate_array[$index]['title'];
                $Team_ID 				    = $teammate_array[$index]['id'];
                $Team_Content 			    = $teammate_array[$index]['content'];
                $Team_Category 			    = $teammate_array[$index]['categories'];
                $Team_Image				    = wp_get_attachment_image_src(get_post_thumbnail_id($Team_ID), 'full');
                if ($Team_Image == false) {
                    $Team_Image             = TS_VCSC_GetResourceURL('images/Default_Person.jpg');
                } else {
                    $Team_Image             = $Team_Image[0];
                }
 
                // Retrieve Teammate Post Meta Content
                $custom_fields 						= get_post_custom($Team_ID);
                $custom_fields_array				= array();
                foreach ($custom_fields as $field_key => $field_values) {
                    if (!isset($field_values[0])) continue;
                    if (in_array($field_key, array("_edit_lock", "_edit_last"))) continue;
                    if (strpos($field_key, 'ts_vcsc_team_') !== false) {
                        $field_key_split 			= explode("_", $field_key);
                        $field_key_length 			= count($field_key_split) - 1;
                        $custom_data = array(
                            'group'					=> $field_key_split[$field_key_length - 1],
                            'name'					=> 'Team_' . ucfirst($field_key_split[$field_key_length]),
                            'value'					=> $field_values[0],
                        );
                        $custom_fields_array[]      = $custom_data;
                    }
                }
                foreach ($custom_fields_array as $index => $array) {
                    ${$custom_fields_array[$index]['name']} = $custom_fields_array[$index]['value'];
                }
                if (isset($Team_Position)) {
                    $Team_Position 					= $Team_Position;
                } else {
                    $Team_Position 					= '';
                }
                if (isset($Team_Buttonlabel)) {
                    $Team_Buttonlabel				= $Team_Buttonlabel;
                } else {
                    $Team_Buttonlabel				= '';
                }
                
                // Build Dedicated Page Link
                $team_dedicated     = '';
                if ($show_dedicated == "true") {
                    if ((isset($Team_Dedicatedpage)) && ($Team_Dedicatedpage != -1)) {
                        $Team_Dedicatedpage         = get_page_link($Team_Dedicatedpage);
                        if (isset($Team_Dedicatedtarget)) {
                            $team_dedicated_target  = '_blank';
                        } else {
                            $team_dedicated_target  = '_parent';
                        }
                        $team_dedicated	.= '<div class="ts-teammate-dedicated">';
                        if (isset($Team_Dedicatedtooltip)) {
                            $team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . ' ' . $team_tooltipclasses . '" data-tooltip="' . $Team_Dedicatedtooltip . '" href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '"><img class="ts-teammate-page-image" src="' . TS_VCSC_GetResourceURL('images/TS_VCSC_Demo_Icon_16x16.png') . '"> ' . $Team_Dedicatedlabel . '</a>';
                        } else {
                            $team_dedicated 	.= '<a class="ts-teammate-page-link ts-button ' . $Team_Dedicatedtype . '" href="' . TS_VCSC_makeValidURL($Team_Dedicatedpage) . '" target="' . $team_dedicated_target . '"><img class="ts-teammate-page-image" src="' . TS_VCSC_GetResourceURL('images/TS_VCSC_Demo_Icon_16x16.png') . '"> ' . $Team_Dedicatedlabel . '</a>';
                        }
                        $team_dedicated 	.= '</div>';
                        if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
                            wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
                        }
                    }
                }
                
                // Build Team Contact Information
                $team_contact		                = '';
                $team_contact_count	                = 0;
                if ($show_contact == "true") {
                    $team_contact		.= '<div class="ts-team-contact">';
                        if (isset($Team_Email)) {
                            $team_contact_count++;
                            if (isset($Team_Emaillabel)) {
                                $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-email2 ts-font-icon ts-teammate-icon" style=""></i><a target="_blank" class="" href="mailto:' . $Team_Email . '">' . $Team_Emaillabel . '</a></div>';
                            } else {
                                $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-email2 ts-font-icon ts-teammate-icon" style=""></i><a target="_blank" class="" href="mailto:' . $Team_Email . '">' . $Team_Email . '</a></div>';
                            }
                        }
                        if (isset($Team_Phone)) {
                            $team_contact_count++;
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-phone2 ts-font-icon ts-teammate-icon" style=""></i>' . $Team_Phone . '</div>';
                        }
                        if (isset($Team_Cell)) {
                            $team_contact_count++;
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-mobile ts-font-icon ts-teammate-icon" style=""></i>' . $Team_Cell . '</div>';
                        }
                        if (isset($Team_Portfolio)) {
                            $team_contact_count++;
                            if (isset($Team_Portfoliolabel)) {
                                $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-portfolio ts-font-icon ts-teammate-icon" style=""></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Portfolio) . '">' . $Team_Portfoliolabel . '</a></div>';
                            } else {
                                $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-portfolio ts-font-icon ts-teammate-icon" style=""></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Portfolio) . '">' . TS_VCSC_makeValidURL($Team_Portfolio) . '</a></div>';
                            }
                        }
                        if (isset($Team_Other)) {
                            $team_contact_count++;
                            if (isset($Team_Otherlabel)) {
                                $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-link ts-font-icon ts-teammate-icon" style=""></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Other) . '">' . $Team_Otherlabel . '</a></div>';
                            } else {
                                $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-link ts-font-icon ts-teammate-icon" style=""></i><a style="" target="_blank" class="" href="' . TS_VCSC_makeValidURL($Team_Other) . '">' . TS_VCSC_makeValidURL($Team_Other) . '</a></div>';
                            }
                        }
                        if (isset($Team_Skype)) {
                            $team_contact_count++;
                            $team_contact .= '<div class="ts-contact-parent"><i class="ts-teamicon-skype ts-font-icon ts-teammate-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i>' . $Team_Skype . '</div>';
                        }
                    $team_contact		.= '</div>';
                }
                
                // Build Team Social Links
                $team_social 		                = '';
                $team_social_count	                = 0;
                if ($show_social == "true") {
                    $team_social 		.= '<ul class="ts-teammate-icons ' . $icon_style . ' clearFixMe">';
                        if (isset($Team_Facebook)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Facebook"><a style="" target="_blank" class="ts-teammate-link facebook ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Facebook) . '"><i class="ts-teamicon-facebook1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                        if (isset($Team_Google)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Google+"><a style="" target="_blank" class="ts-teammate-link gplus ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Google) . '"><i class="ts-teamicon-googleplus1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                        if (isset($Team_Twitter)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Twitter"><a style="" target="_blank" class="ts-teammate-link twitter ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Twitter) . '"><i class="ts-teamicon-twitter1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                        if (isset($Team_Linkedin)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="LinkedIn"><a style="" target="_blank" class="ts-teammate-link linkedin ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Linkedin) . '"><i class="ts-teamicon-linkedin ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                        if (isset($Team_Xing)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Xing"><a style="" target="_blank" class="ts-teammate-link xing ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Xing) . '"><i class="ts-teamicon-xing3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                        if (isset($Team_Envato)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Envato"><a style="" target="_blank" class="ts-teammate-link envato ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Envato) . '"><i class="ts-teamicon-envato ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                        if (isset($Team_Rss)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="RSS"><a style="" target="_blank" class="ts-teammate-link rss ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Rss) . '"><i class="ts-teamicon-rss1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                        if (isset($Team_Forrst)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Forrst"><a style="" target="_blank" class="ts-teammate-link forrst ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Forrst) . '"><i class="ts-teamicon-forrst1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                        if (isset($Team_Flickr)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Flickr"><a style="" target="_blank" class="ts-teammate-link flickr ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Flickr) . '"><i class="ts-teamicon-flickr3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                        if (isset($Team_Instagram)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Instagram"><a style="" target="_blank" class="ts-teammate-link instagram ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Instagram) . '"><i class="ts-teamicon-instagram ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                        if (isset($Team_Picasa)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Picasa"><a style="" target="_blank" class="ts-teammate-link picasa ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Picasa) . '"><i class="ts-teamicon-picasa1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                        if (isset($Team_Pinterest)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Pinterest"><a style="" target="_blank" class="ts-teammate-link pinterest ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Pinterest) . '"><i class="ts-teamicon-pinterest1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                        if (isset($Team_Vimeo)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Vimeo"><a style="" target="_blank" class="ts-teammate-link vimeo ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Vimeo) . '"><i class="ts-teamicon-vimeo1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                        if (isset($Team_Youtube)) {
                            $team_social_count++;
                            $team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="YouTube"><a style="" target="_blank" class="ts-teammate-link youtube ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($Team_Youtube) . '"><i class="ts-teamicon-youtube1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
                        }
                    $team_social 		.= '</ul>';
                }
                
                // Build Team Skills
                $team_skills 		= '';
                $team_skills_count	= 0;
                if ((isset($Team_Skillset)) && ($show_skills == "true")) {
                    $skill_entries      = get_post_meta( $Team_ID, 'ts_vcsc_team_skills_skillset', true);
                    $skill_background 	= '';
                    $team_skills		.= '<div class="ts-member-skills">';
                        foreach ((array) $skill_entries as $key => $entry) {
                            $skill_name = $skill_value = $skill_color = '';
                            if (isset($entry['skillname'])) {
                                $skill_name      = esc_html($entry['skillname']);
                            }
                            if (isset($entry['skillvalue'])) {
                                $skill_value     = esc_html($entry['skillvalue']);
                            }
                            if (isset($entry['skillcolor'])) {
                                $skill_color     = esc_html($entry['skillcolor']);
                            }
                            if ((strlen($skill_name) != 0) && (strlen($skill_value) != 0)) {
                                $team_skills_count++;
                                if ((strlen($skill_color) != 0) && ($skill_color != '#')) {
                                    $skill_background = 'background-color: ' . $skill_color . ';';
                                }
                                $team_skills .= '<div class="skill-label">' . $skill_name . '<span>(' . $skill_value . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $skill_color . '" data-level="' . $skill_value . '%" data-appear-animation-delay="400" style="width: ' . $skill_value . '%; ' . $skill_background . '"></div></div>';
                            }
                        }
                    $team_skills		.= '</div>';
                } else if ((!isset($Team_Skillset)) && ($show_skills == "true")) {
                    $skill_background 	= '';
                    $team_skills		.= '<div class="ts-member-skills">';
                        if ((isset($Team_Skillname1)) && (isset($Team_Skillvalue1))) {
                            $team_skills_count++;
                            if (isset($Team_Skillcolor1)) {
                                $skill_background = 'background-color: ' . $Team_Skillcolor1 . ';';
                            }
                            $team_skills .= '<div class="skill-label">' . $Team_Skillname1 . '<span>(' . $Team_Skillvalue1 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor1 . '" data-level="' . $Team_Skillvalue1 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue1 . '%; ' . $skill_background . '"></div></div>';
                        }
                        if ((isset($Team_Skillname2)) && (isset($Team_Skillvalue2))) {
                            $team_skills_count++;
                            if (isset($Team_Skillcolor2)) {
                                $skill_background = 'background-color: ' . $Team_Skillcolor2 . ';';
                            }
                            $team_skills .= '<div class="skill-label">' . $Team_Skillname2 . '<span>(' . $Team_Skillvalue2 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor2 . '" data-level="' . $Team_Skillvalue2 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue2 . '%; ' . $skill_background . '"></div></div>';
                        }
                        if ((isset($Team_Skillname3)) && (isset($Team_Skillvalue3))) {
                            $team_skills_count++;
                            if (isset($Team_Skillcolor3)) {
                                $skill_background = 'background-color: ' . $Team_Skillcolor3 . ';';
                            }
                            $team_skills .= '<div class="skill-label">' . $Team_Skillname3 . '<span>(' . $Team_Skillvalue3 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor3 . '" data-level="' . $Team_Skillvalue3 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue3 . '%; ' . $skill_background . '"></div></div>';
                        }
                        if ((isset($Team_Skillname4)) && (isset($Team_Skillvalue4))) {
                            $team_skills_count++;
                            if (isset($Team_Skillcolor4)) {
                                $skill_background = 'background-color: ' . $Team_Skillcolor4 . ';';
                            }
                            $team_skills .= '<div class="skill-label">' . $Team_Skillname4 . '<span>(' . $Team_Skillvalue4 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor4 . '" data-level="' . $Team_Skillvalue4 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue4 . '%; ' . $skill_background . '"></div></div>';
                        }
                        if ((isset($Team_Skillname5)) && (isset($Team_Skillvalue5))) {
                            $team_skills_count++;
                            if (isset($Team_Skillcolor5)) {
                                $skill_background = 'background-color: ' . $Team_Skillcolor5 . ';';
                            }
                            $team_skills .= '<div class="skill-label">' . $Team_Skillname5 . '<span>(' . $Team_Skillvalue5 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor5 . '" data-level="' . $Team_Skillvalue5 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue5 . '%; ' . $skill_background . '"></div></div>';
                        }
                        if ((isset($Team_Skillname6)) && (isset($Team_Skillvalue6))) {
                            $team_skills_count++;
                            if (isset($Team_Skillcolor6)) {
                                $skill_background = 'background-color: ' . $Team_Skillcolor6 . ';';
                            }
                            $team_skills .= '<div class="skill-label">' . $Team_Skillname6 . '<span>(' . $Team_Skillvalue6 . '%)</span></div><div class="skill-bar"><div class="level" data-color="' . $Team_Skillcolor6 . '" data-level="' . $Team_Skillvalue6 . '%" data-appear-animation-delay="400" style="width: ' . $Team_Skillvalue6 . '%; ' . $skill_background . '"></div></div>';
                        }
                    $team_skills		.= '</div>';
                }
                
                // Build Download Button
                $team_download 		= '';
                if ($show_download == "true") {
                    if ((isset($Team_Buttonfile)) || (isset($Team_Attachment))) {
                        if (isset($Team_Buttonfile)) {
                            $Team_File          = $Team_Buttonfile;
                        } else {
                            $Team_Attachment    = get_post_meta($Team_ID, 'ts_vcsc_team_basic_attachment', true);
                            $Team_Attachment    = wp_get_attachment_url($Team_Attachment['id']);
                            $Team_File          = $Team_Attachment;
                        }
                        $Team_FileFormat        = pathinfo($Team_File, PATHINFO_EXTENSION);
                        if (isset($Team_Buttontype)) {
                            $Team_Buttontype = $Team_Buttontype;
                        } else {
                            $Team_Buttontype = 'ts-button-3d';
                        };
                        if (!empty($Team_File)) {
                            $team_download	.= '<div class="ts-teammate-download">';
                            if (isset($Team_Buttontooltip)) {
                                $team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . ' ' . $team_tooltipclasses . '" data-tooltip="' . $Team_Buttontooltip . '" href="' . $Team_File . '" target="_blank"><img class="ts-teammate-file-image" src="' . TS_VCSC_GetResourceURL('images/filetypes/' . $Team_FileFormat . '.png') . '"> ' . $Team_Buttonlabel . '</a>';
                            } else {
                                $team_download 	.= '<a class="ts-teammate-file-link ts-button ' . $Team_Buttontype . '" href="' . $Team_File . '" target="_blank"><img class="ts-teammate-file-image" src="' . TS_VCSC_GetResourceURL('images/filetypes/' . $Team_FileFormat . '.png') . '"> ' . $Team_Buttonlabel . '</a>';
                            }
                            $team_download 	.= '</div>';
                            if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
                                wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
                            }
                        }
                    }
                }
        
                // Create Output
                if ($style == "style1") {
                    $output .= '<div class="ts-team1 ts-teammate" style="">';
                        if (($show_image == "true") && (!empty($Team_Image))) {
                            $output .= '<div class="team-avatar">';
                                $output .= '<img src="' . $Team_Image . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '">';
                            $output .= '</div>';
                        }
                        $output .= '<div class="team-user">';
                            if (!empty($Team_Title)) {
                                $output .= '<h4 class="team-title">' . $Team_Title . '</h4>';
                            }
                            if (!empty($Team_Position)) {
                                $output .= '<div class="team-job">' . $Team_Position . '</div>';
                            }
                            $output .= $team_dedicated;
                            $output .= $team_download;
                        $output .= '</div>';
                        if (($show_content == "true") && (!empty($Team_Content))) {
                            $output .= '<div class="team-information">';
                                if (function_exists('wpb_js_remove_wpautop')){
                                    $output .= '' . wpb_js_remove_wpautop(do_shortcode($Team_Content), true) . '';
                                } else {
                                    $output .= '' . do_shortcode($Team_Content) . '';
                                }
                            $output .= '</div>';
                        }
                        if ($team_contact_count > 0) {
                            $output .= $team_contact;
                        }
                        if ($team_social_count > 0) {
                            $output .= $team_social;
                        }
                        if ($team_skills_count > 0) {
                            $output .= $team_skills;
                        }
                    $output .= '</div>';
                } else if ($style == "style2") {
                    $output .= '<div class="ts-team2 ts-teammate" style="">';
                    $output .= '<div style="width: 25%; float: left;">';
                        if (($show_image == "true") && (!empty($Team_Image))) {
                            $output .= '<div class="ts-team2-header">';
                                $output .= '<img src="' . $Team_Image . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '">';
                            $output .= '</div>';
                        }
                        if ($team_social_count > 0) {
                            if ($show_image == "true") {
                                $output .= '<div class="ts-team2-footer" style="' . (($show_image == "false") ? "margin-top: 0px;" : "") . '">';
                            } else {
                                $output .= '<div class="ts-team2-footer" style="width: 100%; margin-top: 0px;">';
                            }
                                $output .= $team_social;
                            $output .= '</div>';
                        }
                    $output .= '</div>';
                        if (($show_image == "true") || ($team_social_count > 0)) {
                            $output .= '<div class="ts-team2-content" style="">';
                        } else {
                            $output .= '<div class="ts-team2-content" style="width: 100%; margin-left: 0px;">';
                        }
                            $output .= '<div class="ts-team2-line"></div>';
                            if (!empty($Team_Title)) {
                                $output .= '<h3>' . $Team_Title . '</h3>';
                            }
                            if (!empty($Team_Position)) {
                                $output .= '<p class="ts-team2-lead">' . $Team_Position . '</p>';
                            }
                            if (($show_content == "true") && (!empty($Team_Content))) {
                                if (function_exists('wpb_js_remove_wpautop')){
                                    $output .= '' . wpb_js_remove_wpautop(do_shortcode($Team_Content), true) . '';
                                } else {
                                    $output .= '' . do_shortcode($Team_Content) . '';
                                }
                            }
                        $output .= '</div>';
                        $output .= $team_dedicated;
                        $output .= $team_download;
                        if ($team_contact_count > 0) {
                            $output .= $team_contact;
                        }
                        if ($team_skills_count > 0) {
                            $output .= $team_skills;
                        }
                    $output .= '</div>';
                } else if ($style == "style3") {
                    $output .= '<div class="ts-team3 ts-teammate" style="">';
                        if (($show_image == "true") && (!empty($Team_Image))) {
                            $output .= '<img class="ts-team3-person-image ' . ($show_lightbox == "true" ? "nch-lightbox" : "") . ' ' . ($show_grayscale == "true" ? "grayscale" : "") . '" rel="' . ($show_lightbox == "true" ? "nachoteam" : "") . '" src="' . $Team_Image . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="">';
                        }
                        if (!empty($Team_Title)) {
                            $output .= '<div class="ts-team3-person-name">' . $Team_Title . '</div>';
                        }
                        if (!empty($Team_Position)) {
                            $output .= '<div class="ts-team3-person-position">' . $Team_Position . '</div>';
                        }
                        if (($show_content == "true") && (!empty($Team_Content))) {
                            if (function_exists('wpb_js_remove_wpautop')){
                                $output .= '<div class="ts-team3-person-description">' . wpb_js_remove_wpautop(do_shortcode($Team_Content), true) . '</div>';
                            } else {
                                $output .= '<div class="ts-team3-person-description">' . do_shortcode($Team_Content) . '</div>';
                            }
                        }
                            $output .= $team_dedicated;
                            $output .= $team_download;
                            if ($team_contact_count > 0) {
                                $output .= $team_contact;
                            }
                            if ($team_social_count > 0) {
                                $output .= $team_social;
                            }
                            if ($team_skills_count > 0) {
                                $output .= $team_skills;
                            }
                        $output .= '<div class="ts-team3-person-space"></div>';					
                    $output .= '</div>';
                }
            
                foreach ($custom_fields_array as $index => $array) {
                    unset(${$custom_fields_array[$index]['name']});
                }
            }
            
            $output .= '</div>';
            
            echo $output;
            
            $myvariable = ob_get_clean();
            return $myvariable;
        }
	
        // Add Teammate Elements
        function TS_VCSC_Add_Teammate_Elements() {
            global $VISUAL_COMPOSER_EXTENSIONS;
            // Deprecated Teammate Elements
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
                            "value"                     => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Hovers,
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
                            "value"                     => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Animations,
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
                            "heading"                   => __( "Show Featured Image", "js_composer" ),
                            "param_name"                => "show_image",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show the featured image for the teammate.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Use Grayscale Effect", "js_composer" ),
                            "param_name"                => "show_grayscale",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to use the hover grayscale effect on the featured image.", "js_composer" ),
                            "dependency"                => array( 'element' => "show_image", 'value' => 'true' )
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Use Lightbox with Image", "js_composer" ),
                            "param_name"                => "show_lightbox",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to apply the lightbox to the featured image.", "js_composer" ),
                            "dependency"                => array( 'element' => "show_image", 'value' => 'true' )
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Show Name / Position", "js_composer" ),
                            "param_name"                => "show_title",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show the name / position for the teammate.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Show Description", "js_composer" ),
                            "param_name"                => "show_content",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show the description section for this teammember.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Show Dedicated Page Link", "js_composer" ),
                            "param_name"                => "show_dedicated",
                            "value"                     => "false",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show the link button to the dedicated page for this teammember.", "js_composer" ),
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
                            "description"               => __( "", "js_composer" ),
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
                            "value"                     => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Hovers,
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
                            "heading"                   => __( "Show Featured Image", "js_composer" ),
                            "param_name"                => "show_image",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show the featured image for the teammate.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Use Grayscale Effect", "js_composer" ),
                            "param_name"                => "show_grayscale",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to use the hover grayscale effect on the featured image.", "js_composer" ),
                            "dependency"                => array( 'element' => "show_image", 'value' => 'true' )
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Use Lightbox with Image", "js_composer" ),
                            "param_name"                => "show_lightbox",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to apply the lightbox to the featured image.", "js_composer" ),
                            "dependency"                => array( 'element' => "show_image", 'value' => 'true' )
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Show Name / Position", "js_composer" ),
                            "param_name"                => "show_title",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show the name / position for the teammate.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Show Description", "js_composer" ),
                            "param_name"                => "show_content",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show the description section for this teammember.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Show Dedicated Page Link", "js_composer" ),
                            "param_name"                => "show_dedicated",
                            "value"                     => "false",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show the link button to the dedicated page for this teammember.", "js_composer" ),
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
                            "value"                     => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Hovers,
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
                            "heading"                   => __( "Show Featured Image", "js_composer" ),
                            "param_name"                => "show_image",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "admin_label"		        => true,
                            "description"               => __( "Switch the toggle if you want to show the featured image for the teammate.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Use Grayscale Effect", "js_composer" ),
                            "param_name"                => "show_grayscale",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to use the hover grayscale effect on the featured image.", "js_composer" ),
                            "dependency"                => array( 'element' => "show_image", 'value' => 'true' )
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Use Lightbox with Image", "js_composer" ),
                            "param_name"                => "show_lightbox",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to apply the lightbox to the featured image.", "js_composer" ),
                            "dependency"                => array( 'element' => "show_image", 'value' => 'true' )
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Show Name / Position", "js_composer" ),
                            "param_name"                => "show_title",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show the name / position for the teammate.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Show Description", "js_composer" ),
                            "param_name"                => "show_content",
                            "value"                     => "true",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show the description section for this teammember.", "js_composer" ),
                            "dependency"                => ""
                        ),
                        array(
                            "type"              	    => "switch",
                            "heading"                   => __( "Show Dedicated Page Link", "js_composer" ),
                            "param_name"                => "show_dedicated",
                            "value"                     => "false",
                            "on"					    => __( 'Yes', "js_composer" ),
                            "off"					    => __( 'No', "js_composer" ),
                            "style"					    => "select",
                            "design"				    => "toggle-light",
                            "description"               => __( "Switch the toggle if you want to show the link button to the dedicated page for this teammember.", "js_composer" ),
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
                            "value"                     => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_CSS_Hovers,
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

		}
	}
}
// Register Container and Child Shortcode with Visual Composer
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_TS_VCSC_Team_Mates_Slider_Custom extends WPBakeryShortCodesContainer {}
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_TS_VCSC_Team_Mates_Single extends WPBakeryShortCode {}
}
// Initialize "TS Teammates" Class
if (class_exists('TS_Teammates')) {
	$TS_Teammates = new TS_Teammates;
}