<?php
    add_shortcode('TS-VCSC-Team-Mates',                     'TS_VCSC_Team_Mates_Standalone');
    add_shortcode('TS_VCSC_Team_Mates', 			        'TS_VCSC_Team_Mates_Standalone');
    add_shortcode('TS_VCSC_Team_Mates_Standalone',          'TS_VCSC_Team_Mates_Standalone');
    add_shortcode('TS_VCSC_Team_Mates_Single',              'TS_VCSC_Team_Mates_Single');
    add_shortcode('TS_VCSC_Team_Mates_Slider_Custom',       'TS_VCSC_Team_Mates_Slider_Custom');
    add_shortcode('TS_VCSC_Team_Mates_Slider_Category',     'TS_VCSC_Team_Mates_Slider_Category');
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
		if ($show_skills == "true") {
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
			if (isset($Team_Attachment)) {
				$Team_Attachment = get_post_meta($Team_ID, 'ts_vcsc_team_basic_attachment', true);
				$Team_Attachment = wp_get_attachment_url($Team_Attachment['id']);
				$Team_FileFormat = pathinfo($Team_Attachment, PATHINFO_EXTENSION);
				$team_download	.= '<div class="ts-teammate-download">';
				if (isset($Team_Buttontooltip)) {
					$team_download 	.= '<a class="ts-teammate-file-link ts-button ts-button-3d ' . $team_tooltipclasses . '" data-tooltip="' . $Team_Buttontooltip . '" href="' . $Team_Attachment . '" target="_blank"><img class="ts-teammate-file-image" src="' . TS_VCSC_GetResourceURL('images/filetypes/' . $Team_FileFormat . '.png') . '"> ' . $Team_Buttonlabel . '</a>';
				} else {
					$team_download 	.= '<a class="ts-teammate-file-link ts-button ts-button-3d" href="' . $Team_Attachment . '" target="_blank"><img class="ts-teammate-file-image" src="' . TS_VCSC_GetResourceURL('images/filetypes/' . $Team_FileFormat . '.png') . '"> ' . $Team_Buttonlabel . '</a>';
				}
				$team_download 	.= '</div>';
				if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
					wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
				}
			}
		}

		// Create Output
		if ($style == "style1") {
			$output .= '<div id="' . $team_block_id . '" class="ts-team1 ts-teammate ' . $animation_css . ' ' . $el_class . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
				if (!empty($Team_Image)) {
					$output .= '<div class="team-avatar">';
						$output .= '<img src="' . $Team_Image . '" rel="nachoteam" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="nch-lightbox">';
					$output .= '</div>';
				}
				$output .= '<div class="team-user">';
					if (!empty($Team_Title)) {
						$output .= '<h4 class="team-title">' . $Team_Title . '</h4>';
					}
					if (!empty($Team_Position)) {
						$output .= '<div class="team-job">' . $Team_Position . '</div>';
					}
					$output .= $team_download;
				$output .= '</div>';
				if (!empty($Team_Content)) {
					$output .= '<div class="team-information">';
						if (!function_exists('wpb_js_remove_wpautop')){
							$output .= '' . wpb_js_remove_wpautop($Team_Content, true) . '';
						} else {
							$output .= '' . $Team_Content . '';
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
					if (!empty($Team_Image)) {
						$output .= '<div class="ts-team2-header">';
							$output .= '<img src="' . $Team_Image . '" rel="nachoteam" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="nch-lightbox">';
						$output .= '</div>';
					}
					if ($team_social_count > 0) {
						$output .= '<div class="ts-team2-footer">';
							$output .= $team_social;
						$output .= '</div>';
					}
				$output .= '</div>';
				$output .= '<div class="ts-team2-content">';
					$output .= '<div class="ts-team2-line"></div>';
					if (!empty($Team_Title)) {
						$output .= '<h3>' . $Team_Title . '</h3>';
					}
					if (!empty($Team_Position)) {
						$output .= '<p class="ts-team2-lead">' . $Team_Position . '</p>';
					}
					if (!empty($Team_Content)) {
						if (!function_exists('wpb_js_remove_wpautop')){
							$output .= '' . wpb_js_remove_wpautop($Team_Content, true) . '';
						} else {
							$output .= '' . $Team_Content . '';
						}
					}
				$output .= '</div>';
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
				if (!empty($Team_Image)) {
					$output .= '<img class="ts-team3-person-image nch-lightbox" rel="nachoteam" src="' . $Team_Image . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="">';
				}
				if (!empty($Team_Title)) {
					$output .= '<div class="ts-team3-person-name">' . $Team_Title . '</div>';
				}
				if (!empty($Team_Position)) {
					$output .= '<div class="ts-team3-person-position">' . $Team_Position . '</div>';
				}
				if (!empty($Team_Content)) {
					if (!function_exists('wpb_js_remove_wpautop')){
						$output .= '<div class="ts-team3-person-description">' . wpb_js_remove_wpautop($Team_Content, true) . '</div>';
					} else {
						$output .= '<div class="ts-team3-person-description">' . $Team_Content . '</div>';
					}
				}
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
		if ($show_skills == "true") {
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
			if (isset($Team_Attachment)) {
				$Team_Attachment = get_post_meta($Team_ID, 'ts_vcsc_team_basic_attachment', true);
				$Team_Attachment = wp_get_attachment_url($Team_Attachment['id']);
				$Team_FileFormat = pathinfo($Team_Attachment, PATHINFO_EXTENSION);
				$team_download	.= '<div class="ts-teammate-download">';
				if (isset($Team_Buttontooltip)) {
					$team_download 	.= '<a class="ts-teammate-file-link ts-button ts-button-3d ' . $team_tooltipclasses . '" data-tooltip="' . $Team_Buttontooltip . '" href="' . $Team_Attachment . '" target="_blank"><img class="ts-teammate-file-image" src="' . TS_VCSC_GetResourceURL('images/filetypes/' . $Team_FileFormat . '.png') . '"> ' . $Team_Buttonlabel . '</a>';
				} else {
					$team_download 	.= '<a class="ts-teammate-file-link ts-button ts-button-3d" href="' . $Team_Attachment . '" target="_blank"><img class="ts-teammate-file-image" src="' . TS_VCSC_GetResourceURL('images/filetypes/' . $Team_FileFormat . '.png') . '"> ' . $Team_Buttonlabel . '</a>';
				}
				$team_download 	.= '</div>';
				if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
					wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
				}
			}
		}

		// Create Output
		if ($style == "style1") {
			$output .= '<div id="' . $team_block_id . '" class="ts-team1 ts-teammate ' . $animation_css . '" style="">';
				if (!empty($Team_Image)) {
					$output .= '<div class="team-avatar">';
						$output .= '<img src="' . $Team_Image . '" rel="nachoteam" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="nch-lightbox">';
					$output .= '</div>';
				}
				$output .= '<div class="team-user">';
					if (!empty($Team_Title)) {
						$output .= '<h4 class="team-title">' . $Team_Title . '</h4>';
					}
					if (!empty($Team_Position)) {
						$output .= '<div class="team-job">' . $Team_Position . '</div>';
					}
					$output .= $team_download;
				$output .= '</div>';
				if (!empty($Team_Content)) {
					$output .= '<div class="team-information">';
						if (!function_exists('wpb_js_remove_wpautop')){
							$output .= '' . wpb_js_remove_wpautop($Team_Content, true) . '';
						} else {
							$output .= '' . $Team_Content . '';
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
					if (!empty($Team_Image)) {
						$output .= '<div class="ts-team2-header">';
							$output .= '<img src="' . $Team_Image . '" rel="nachoteam" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="nch-lightbox">';
						$output .= '</div>';
					}
					if ($team_social_count > 0) {
						$output .= '<div class="ts-team2-footer">';
							$output .= $team_social;
						$output .= '</div>';
					}
				$output .= '</div>';
				$output .= '<div class="ts-team2-content">';
					$output .= '<div class="ts-team2-line"></div>';
					if (!empty($Team_Title)) {
						$output .= '<h3>' . $Team_Title . '</h3>';
					}
					if (!empty($Team_Position)) {
						$output .= '<p class="ts-team2-lead">' . $Team_Position . '</p>';
					}
					if (!empty($Team_Content)) {
						if (!function_exists('wpb_js_remove_wpautop')){
							$output .= '' . wpb_js_remove_wpautop($Team_Content, true) . '';
						} else {
							$output .= '' . $Team_Content . '';
						}
					}
				$output .= '</div>';
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
				if (!empty($Team_Image)) {
					$output .= '<img class="ts-team3-person-image nch-lightbox" rel="nachoteam" src="' . $Team_Image . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="">';
				}
				if (!empty($Team_Title)) {
					$output .= '<div class="ts-team3-person-name">' . $Team_Title . '</div>';
				}
				if (!empty($Team_Position)) {
					$output .= '<div class="ts-team3-person-position">' . $Team_Position . '</div>';
				}
				if (!empty($Team_Content)) {
					if (!function_exists('wpb_js_remove_wpautop')){
						$output .= '<div class="ts-team3-person-description">' . wpb_js_remove_wpautop($Team_Content, true) . '</div>';
					} else {
						$output .= '<div class="ts-team3-person-description">' . $Team_Content . '</div>';
					}
				}
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
			$team_skills 		                = '';
			$team_skills_count	                = 0;
			if ($show_skills == "true") {
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
			$team_download 		                = '';
			if ($show_download == "true") {
				if (isset($Team_Attachment)) {
					$Team_Attachment = get_post_meta($Team_ID, 'ts_vcsc_team_basic_attachment', true);
					$Team_Attachment = wp_get_attachment_url($Team_Attachment['id']);
					$Team_FileFormat = pathinfo($Team_Attachment, PATHINFO_EXTENSION);
					$team_download	.= '<div class="ts-teammate-download">';
					if (isset($Team_Buttontooltip)) {
						$team_download 	.= '<a class="ts-teammate-file-link ts-button ts-button-3d ' . $team_tooltipclasses . '" data-tooltip="' . $Team_Buttontooltip . '" href="' . $Team_Attachment . '" target="_blank"><img class="ts-teammate-file-image" src="' . TS_VCSC_GetResourceURL('images/filetypes/' . $Team_FileFormat . '.png') . '"> ' . $Team_Buttonlabel . '</a>';
					} else {
						$team_download 	.= '<a class="ts-teammate-file-link ts-button ts-button-3d" href="' . $Team_Attachment . '" target="_blank"><img class="ts-teammate-file-image" src="' . TS_VCSC_GetResourceURL('images/filetypes/' . $Team_FileFormat . '.png') . '"> ' . $Team_Buttonlabel . '</a>';
					}
					$team_download 	.= '</div>';
					if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
						wp_enqueue_style('ts-extend-buttons',                 		TS_VCSC_GetResourceURL('css/jquery.buttons.css'), null, false, 'all');
					}
				}
			}
	
			// Create Output
			if ($style == "style1") {
				$output .= '<div class="ts-team1 ts-teammate" style="">';
					if (!empty($Team_Image)) {
						$output .= '<div class="team-avatar">';
							$output .= '<img src="' . $Team_Image . '" rel="nachoteam" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="nch-lightbox">';
						$output .= '</div>';
					}
					$output .= '<div class="team-user">';
						if (!empty($Team_Title)) {
							$output .= '<h4 class="team-title">' . $Team_Title . '</h4>';
						}
						if (!empty($Team_Position)) {
							$output .= '<div class="team-job">' . $Team_Position . '</div>';
						}
						$output .= $team_download;
					$output .= '</div>';
					if (!empty($Team_Content)) {
						$output .= '<div class="team-information">';
							if (!function_exists('wpb_js_remove_wpautop')){
								$output .= '' . wpb_js_remove_wpautop($Team_Content, true) . '';
							} else {
								$output .= '' . $Team_Content . '';
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
					if (!empty($Team_Image)) {
						$output .= '<div class="ts-team2-header">';
							$output .= '<img src="' . $Team_Image . '" rel="nachoteam" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="" class="nch-lightbox">';
						$output .= '</div>';
					}
					if ($team_social_count > 0) {
						$output .= '<div class="ts-team2-footer">';
							$output .= $team_social;
						$output .= '</div>';
					}
				$output .= '</div>';
					$output .= '<div class="ts-team2-content">';
						$output .= '<div class="ts-team2-line"></div>';
						if (!empty($Team_Title)) {
							$output .= '<h3>' . $Team_Title . '</h3>';
						}
						if (!empty($Team_Position)) {
							$output .= '<p class="ts-team2-lead">' . $Team_Position . '</p>';
						}
						if (!empty($Team_Content)) {
							if (!function_exists('wpb_js_remove_wpautop')){
								$output .= '' . wpb_js_remove_wpautop($Team_Content, true) . '';
							} else {
								$output .= '' . $Team_Content . '';
							}
						}
					$output .= '</div>';
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
					if (!empty($Team_Image)) {
						$output .= '<img class="ts-team3-person-image nch-lightbox" rel="nachoteam" src="' . $Team_Image . '" title="' . $Team_Title . ' / ' . $Team_Position . '" alt="">';
					}
					if (!empty($Team_Title)) {
						$output .= '<div class="ts-team3-person-name">' . $Team_Title . '</div>';
					}
					if (!empty($Team_Position)) {
						$output .= '<div class="ts-team3-person-position">' . $Team_Position . '</div>';
					}
					if (!empty($Team_Content)) {
						if (!function_exists('wpb_js_remove_wpautop')){
							$output .= '<div class="ts-team3-person-description">' . wpb_js_remove_wpautop($Team_Content, true) . '</div>';
						} else {
							$output .= '<div class="ts-team3-person-description">' . $Team_Content . '</div>';
						}
					}
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
	// Register Container and Child Shortcode with Visual Composer
	if (class_exists('WPBakeryShortCodesContainer')) {
		class WPBakeryShortCode_TS_VCSC_Team_Mates_Slider_Custom extends WPBakeryShortCodesContainer {}
	}
	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_TS_VCSC_Team_Mates_Single extends WPBakeryShortCode {}
	}
?>