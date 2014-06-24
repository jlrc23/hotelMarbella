<?php
	add_shortcode('TS-VCSC-Meet-Team', 'TS_VCSC_Meet_Team_Function');
	function TS_VCSC_Meet_Team_Function ($atts, $content = null) {
		global $VISUAL_COMPOSER_EXTENSIONS;
		ob_start();
		
		if ((get_option('ts_vcsc_extend_settings_loadHeader', 0) == 0)) {
			$FOOTER = true;
		} else {
			$FOOTER = false;
		}
		
		if (get_option('ts_vcsc_extend_settings_loadForcable', 0) == 0) {
			wp_enqueue_style('ts-extend-simptip',                 			TS_VCSC_GetResourceURL('css/jquery.simptip.css'), null, false, 'all');
			wp_enqueue_style('ts-extend-animations',                 		TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-animations.min.css'), null, false, 'all');
			wp_enqueue_style('ts-extend-teammate',                 			TS_VCSC_GetResourceURL('css/ts-font-teammates.css'), null, false, 'all');
			wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
		
		extract( shortcode_atts( array(
			'style'					=> 'style1',
			'image'					=> '',
			'name'					=> '',
			'title'					=> '',
			'description'			=> '',
			'icon_style' 			=> 'simple',
			'icon_background'		=> '#f5f5f5',
			'icon_frame_color'		=> '#f5f5f5',
			'icon_frame_thick'		=> 1,
			'icon_margin' 			=> 5,
			'icon_align'			=> 'left',
			'icon_hover'			=> '',
			'phone'					=> '',
			'cell'					=> '',
			'portfolio'				=> '',
			'link'					=> '',
			'email'					=> '',
			'facebook'				=> '',
			'gplus'					=> '',
			'twitter'				=> '',
			'linkedin'				=> '',
			'xing'					=> '',
			'skype'					=> '',
			'flickr'				=> '',
			'picasa'				=> '',
			'instagram'				=> '',
			'vimeo'					=> '',
			'youtube'				=> '',
			'tooltip_style'			=> '',
			'tooltip_position'		=> 'ts-simptip-position-top',
			'animation_view'		=> '',
			'margin_top'			=> 0,
			'margin_bottom'			=> 0,
			'el_id' 				=> '',
			'el_class'              => '',
		), $atts ));
	
		if (!empty($el_id)) {
			$team_id						= $el_id;
		} else {
			$team_id						= 'ts-vcsc-meet-team-' . mt_rand(999999, 9999999);
		}
		
		$team_image = wp_get_attachment_image_src($image, 'large');
	
		if ($animation_view != '') {
			$animation_css              	= TS_VCSC_GetCSSAnimation($animation_view);
		} else {
			$animation_css					= '';
		}
		
		$output = '';
		
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
	
		$team_social = '';
	
		$team_social .= '<ul class="ts-teammate-icons ' . $icon_style . '">';
			if (strlen($email) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="email ' . $team_tooltipclasses . '" href="mailto:' . $email . '" data-tooltip="' . $email . '"><i class="email" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Email"><a style="" target="_blank" class="ts-teammate-link email ' . $icon_hover . '" href="mailto:' . $email . '"><i class="ts-teamicon-email2 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($phone) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="phone ' . $team_tooltipclasses . '" href="#" data-tooltip="' . $phone . '"><i class="phone" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="' . $phone . '"><a style="" target="_blank" class="ts-teammate-link phone ' . $icon_hover . '" href="#"><i class="ts-teamicon-phone2 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($cell) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="cell ' . $team_tooltipclasses . '" href="#" data-tooltip="' . $cell . '"><i class="cell" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="' . $cell . '"><a style="" target="_blank" class="ts-teammate-link mobile ' . $icon_hover . '" href="#"><i class="ts-teamicon-mobile ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($skype) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="skype ' . $team_tooltipclasses . '" href="#" data-tooltip="' . $skype . '"><i class="skype" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="' . $skype . '"><a style="" target="_blank" class="ts-teammate-link skype ' . $icon_hover . '" href="#"><i class="ts-teamicon-skype ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($portfolio) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="portfolio ' . $team_tooltipclasses . '" href="' . TS_VCSC_makeValidURL($portfolio) . '" data-tooltip="' . $portfolio . '"><i class="portfolio" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Portfolio"><a style="" target="_blank" class="ts-teammate-link portfolio ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($portfolio) . '"><i class="ts-teamicon-portfolio ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($link) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="link ' . $team_tooltipclasses . '" href="' . TS_VCSC_makeValidURL($link) . '" data-tooltip="' . $link . '"><i class="link" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Other"><a style="" target="_blank" class="ts-teammate-link portfolio ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($link) . '"><i class="ts-teamicon-link ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($facebook) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="facebook ' . $team_tooltipclasses . '" href="' . TS_VCSC_makeValidURL($facebook) . '" data-tooltip="' . $facebook . '"><i class="facebook" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Facebook"><a style="" target="_blank" class="ts-teammate-link facebook ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($facebook) . '"><i class="ts-teamicon-facebook1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($gplus) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="gplus ' . $team_tooltipclasses . '" href="' . TS_VCSC_makeValidURL($gplus) . '" data-tooltip="' . $gplus . '"><i class="gplus" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Google+"><a style="" target="_blank" class="ts-teammate-link gplus ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($gplus) . '"><i class="ts-teamicon-googleplus1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($twitter) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="twitter ' . $team_tooltipclasses . '" href="' . TS_VCSC_makeValidURL($twitter) . '" data-tooltip="' . $twitter . '"><i class="twitter" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Twitter"><a style="" target="_blank" class="ts-teammate-link twitter ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($twitter) . '"><i class="ts-teamicon-twitter1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($linkedin) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="linkedin ' . $team_tooltipclasses . '" href="' . TS_VCSC_makeValidURL($linkedin) . '" data-tooltip="' . $linkedin . '"><i class="linkedin" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="LinkedIn"><a style="" target="_blank" class="ts-teammate-link linkedin ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($linkedin) . '"><i class="ts-teamicon-linkedin ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($xing) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="xing ' . $team_tooltipclasses . '" href="' . TS_VCSC_makeValidURL($xing) . '" data-tooltip="' . $xing . '"><i class="xing" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Xing"><a style="" target="_blank" class="ts-teammate-link xing ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($xing) . '"><i class="ts-teamicon-xing3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($flickr) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="flickr ' . $team_tooltipclasses . '" href="' . TS_VCSC_makeValidURL($flickr) . '" data-tooltip="' . $flickr . '"><i class="flickr" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Flickr"><a style="" target="_blank" class="ts-teammate-link flickr ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($flickr) . '"><i class="ts-teamicon-flickr3 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($instagram) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="instagram ' . $team_tooltipclasses . '" href="' . TS_VCSC_makeValidURL($instagram) . '" data-tooltip="' . $instagram . '"><i class="instagram" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Instagram"><a style="" target="_blank" class="ts-teammate-link instagram ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($instagram) . '"><i class="ts-teamicon-instagram ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($picasa) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="picasa ' . $team_tooltipclasses . '" href="' . TS_VCSC_makeValidURL($picasa) . '" data-tooltip="' . $picasa . '"><i class="picasa" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Picasa"><a style="" target="_blank" class="ts-teammate-link picasa ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($picasa) . '"><i class="ts-teamicon-picasa1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($vimeo) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="vimeo ' . $team_tooltipclasses . '" href="' . TS_VCSC_makeValidURL($vimeo) . '" data-tooltip="' . $vimeo . '"><i class="vimeo" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="Vimeo"><a style="" target="_blank" class="ts-teammate-link vimeo ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($vimeo) . '"><i class="ts-teamicon-vimeo1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
			if (strlen($youtube) != 0) {
				//$team_social .= '<li class="ts-social-icon ' . $icon_align . ' ' . $icon_hover . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '"><a style="" target="_blank" class="youtube ' . $team_tooltipclasses . '" href="' . TS_VCSC_makeValidURL($youtube) . '" data-tooltip="' . $youtube . '"><i class="youtube" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
				$team_social .= '<li class="ts-teammate-icon ' . $icon_align . ' ' . $team_tooltipclasses . '" style="' . $icon_frame_border . ' ' . $icon_frame_style . '" data-tooltip="YouTube"><a style="" target="_blank" class="ts-teammate-link youtube ' . $icon_hover . '" href="' . TS_VCSC_makeValidURL($youtube) . '"><i class="ts-teamicon-youtube1 ts-font-icon" style="' . $icon_top_adjust . ' ' . $icon_horizontal_adjust . '"></i></a></li>';
			}
		$team_social .= '</ul>';
	
		if ($style == "style1") {
			$output .= '<div id="' . $team_id . '" class="ts-team1 ts-team-member ' . $animation_css . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
				$output .= '<div class="team-avatar">';
					$output .= '<img src="' . $team_image[0] . '" alt="">';
				$output .= '</div>';
				$output .= '<div class="team-user">';
					$output .= '<h4 class="team-title">' . $name . '</h4>';
					$output .= '<div class="team-job">' . $title . '</div>';
				$output .= '</div>';
				$output .= '<div class="team-information">';
					$output .= '' . $description . '';
				$output .= '<br></div>';
				$output .= $team_social;
			$output .= '</div>';
		} else if ($style == "style2") {
			$output .= '<article id="' . $team_id . '" class="ts-team2 ts-team-member ' . $animation_css . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
				$output .= '<div class="ts-team2-header">';
					$output .= '<img src="' . $team_image[0] . '" class="img-circle">';
				$output .= '</div>';
				$output .= '<div class="ts-team2-content">';
					$output .= '<div class="ts-team2-line"></div>';
					$output .= '<h3>' . $name . '</h3>';
					$output .= '<p class="ts-team2-lead">' . $title . '</p>';
					$output .= '<p>' . $description . '</p>';
				$output .= '</div>';
				$output .= '<div class="ts-team2-footer">';
					$output .= $team_social;
				$output .= '</div>';
			$output .= '</article>';
		} else if ($style == "style3") {
			$output .= '<div id="' . $team_id . '" class="ts-team3 ts-team-member ' . $animation_css . '" style="margin-top: ' . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
				$output .= '<img class="ts-team3-person-image" src="' . $team_image[0] . '" alt="' . $name . '">';
				$output .= '<p class="ts-team3-person-name">' . $name . '</p>';
				$output .= '<p class="ts-team3-person-position">' . $title . '</p>';
				$output .= '<p class="ts-team3-person-description">' . $description . '</p>';
				//$output .= '<div class="ts-team3-person-line"></div>';
				$output .= $team_social;
				$output .= '<div class="ts-team3-person-space"></div>';					
			$output .= '</div>';
		}
		
		echo $output;
		
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>