<?php
	add_shortcode('TS-VCSC-Lightbox-Gallery', 'TS_VCSC_Lightbox_Gallery_Function');
	function TS_VCSC_Lightbox_Gallery_Function ($atts, $content = null) {
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
			wp_enqueue_style('ts-visual-composer-extend-front',				TS_VCSC_GetResourceURL('css/ts-visual-composer-extend-front.min.css'), null, false, 'all');
			wp_enqueue_script('ts-visual-composer-extend-front',			TS_VCSC_GetResourceURL('js/ts-visual-composer-extend-front.min.js'), array('jquery'), false, $FOOTER);
		}
		
		extract( shortcode_atts( array(
			'content_style'				=> 'grid',
			'content_title'				=> '',
			'content_trigger_image'		=> '',
			'content_trigger_title'		=> '',

			'content_images'			=> '',
			'content_images_titles'		=> '',
			'content_images_size'		=> 'medium',
			
			'thumbnail_position'		=> 'bottom',
			'thumbnail_height'			=> 100,
			
			'lightbox_size'				=> 'full',
			'lightbox_effect'			=> 'random',
			'lightbox_pageload'			=> 'false',
			'lightbox_autoplay'			=> 'false',
			'lightbox_speed'			=> 5000,
			'lightbox_social'			=> 'true',
			
			'lightbox_backlight'		=> 'auto',
			'lightbox_backlight_auto'	=> 'true',
			'lightbox_backlight_color'	=> '#ffffff',
			
			'data_grid_breaks'			=> '240,480,720,960',
			'data_grid_space'			=> 2,
			'data_grid_order'			=> 'false',
			
			'margin_top'				=> 0,
			'margin_bottom'				=> 0,
			'el_id'						=> '',
			'el_class'					=> '',
		), $atts ));

		$randomizer						= mt_rand(999999, 9999999);
	
		if (!empty($el_id)) {
			$modal_id					= $el_id;
			$nacho_group				= 'nachogroup' . $randomizer;
		} else {
			$modal_id					= 'ts-vcsc-image-gallery-' . $randomizer;
			$nacho_group				= 'nachogroup' . $randomizer;
		}
		
		// Content: Gallery
		$modal_gallery					= '';
		$content_images 				= explode(',', $content_images);
		$content_images_titles			= explode(',', $content_images_titles);
		$i 								= -1;
		$output 						= '';

		$nachoLength 					= count($content_images) - 1;
		if (!empty($content)) {
			$nacho_info 				= 'data-info="' . $nacho_group . '-info"';
		} else {
			$nacho_info					= '';
		}
		if ($lightbox_backlight != "auto") {
			if ($lightbox_backlight == "custom") {
				$nacho_color			= 'data-color="' . $lightbox_backlight_color . '"';
			} else if ($lightbox_backlight == "hideit") {
				$nacho_color			= 'data-color="#000000"';
			}
		} else {
			$nacho_color			= '';
		}
		
		// Auto-Grid Layout
		if ($content_style == "grid") {
			foreach ($content_images as $single_image) {
				$i++;
				$modal_image			= wp_get_attachment_image_src($single_image, $lightbox_size);
				$image_extension		= pathinfo($modal_image[0], PATHINFO_EXTENSION);
				$modal_thumb			= preg_replace('/[^\d]/', '', $single_image);
				$modal_thumb			= wpb_getImageBySize(array( 'attach_id' => $modal_thumb, 'thumb_size' => $content_images_size, 'class' => '' ));
				if ($i == $nachoLength) {
					$data_grid_breaks 	= str_replace(' ', '', $data_grid_breaks);
					$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox ts-hover-image ' . $nacho_group . '" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . ' data-grid="' . $data_grid_breaks . '" data-gridspace="' . $data_grid_space . '">';
						$modal_gallery .= $modal_thumb['thumbnail'];
					$modal_gallery .= '</a>';
				} else {
					$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox ts-hover-image ' . $nacho_group . '" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
						$modal_gallery .= $modal_thumb['thumbnail'];
					$modal_gallery .= '</a>';
				}
			}

			?>
				<script type="text/javascript">
					jQuery(window).load(function(){
						jQuery('#<?php echo $modal_id; ?>-frame a').nchgrid({
							order:		<?php echo $data_grid_order; ?>,
						});
						<?php if ($lightbox_pageload == "true") { ?>
							jQuery('.<?php echo $nacho_group; ?>').nchlightbox('open');
						<?php } ?>
					});
				</script>
			<?php
		}
		// First Image Only Layout
		if ($content_style == "first") {
			foreach ($content_images as $single_image) {
				$i++;
				$modal_image			= wp_get_attachment_image_src($single_image, $lightbox_size);
				$image_extension		= pathinfo($modal_image[0], PATHINFO_EXTENSION);
				$modal_thumb			= preg_replace('/[^\d]/', '', $single_image);
				if ($i == 0) {
					$modal_thumb		= wpb_getImageBySize(array( 'attach_id' => $modal_thumb, 'thumb_size' => $content_images_size, 'class' => 'nachocover' ));
				} else {
					$modal_thumb		= wpb_getImageBySize(array( 'attach_id' => $modal_thumb, 'thumb_size' => $content_images_size, 'class' => 'nachohidden' ));
				}
				if (($i == 0) || ($nachoLength == 0)) {
					$modal_gallery .= '<div class="nchgrid-item nchgrid-tile nch-lightbox-trigger" style="">';
						$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" href="' . $modal_image[0] . '" class="nch-lightbox" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '">';
							$modal_gallery .= $modal_thumb['thumbnail'];
							$modal_gallery .= '<div class="nchgrid-caption"></div>';
							if (!empty($content_images_titles[$i])) {
								$modal_gallery .= '<div class="nchgrid-caption-text">' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '</div>';
							}
						$modal_gallery .= '</a>';
					$modal_gallery .= '</div>';
				} else if ($i == $nachoLength) {
					$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" style="display: none;" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox ts-hover-image ' . $nacho_group . '" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
						if ($thumbnail_position != "0") {
							$modal_gallery .= $modal_thumb['thumbnail'];
						} else {
							$modal_gallery .= 'Lightbox Image #' . ($i + 1);
						}
					$modal_gallery .= '</a>';
				} else {
					$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" style="display: none;" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox ts-hover-image ' . $nacho_group . '" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
						if ($thumbnail_position != "0") {
							$modal_gallery .= $modal_thumb['thumbnail'];
						} else {
							$modal_gallery .= 'Lightbox Image #' . ($i + 1);
						}
					$modal_gallery .= '</a>';
				}
			}
			
			?>
				<script type="text/javascript">
					jQuery(window).load(function(){
						<?php if ($lightbox_pageload == "true") { ?>
							jQuery('.<?php echo $nacho_group; ?>').nchlightbox('open');
						<?php } ?>
					});
				</script>
			<?php
		}
		// Custom Image Layout
		if ($content_style == "image") {
			if (!empty($content_trigger_image)) {
				$trigger_thumb 					= wp_get_attachment_image_src($content_trigger_image, 'large');
				$modal_gallery .= '<div class="nchgrid-item nchgrid-tile nch-lightbox-trigger" style="">';
					$modal_gallery .= '<a href="#" class="nch-lightbox-trigger" data-title="' . (!empty($content_trigger_title) ? $content_trigger_title : "") . '" data-group="' . $nacho_group . '">';
						$modal_gallery .= '<img src="' . $trigger_thumb[0] . '" alt="" title="" style="">';
						$modal_gallery .= '<div class="nchgrid-caption"></div>';
						if (!empty($content_trigger_title)) {
							$modal_gallery .= '<div class="nchgrid-caption-text">' . (!empty($content_trigger_title) ? $content_trigger_title : "") . '</div>';
						}
					$modal_gallery .= '</a>';
				$modal_gallery .= '</div>';
				
				foreach ($content_images as $single_image) {
					$i++;
					$modal_image			= wp_get_attachment_image_src($single_image, $lightbox_size);
					$image_extension		= pathinfo($modal_image[0], PATHINFO_EXTENSION);
					$modal_thumb			= preg_replace('/[^\d]/', '', $single_image);
					$modal_thumb			= wpb_getImageBySize(array( 'attach_id' => $modal_thumb, 'thumb_size' => $content_images_size, 'class' => 'nachohidden' ));
					if ($i == $nachoLength) {
						$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" style="display: none;" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox ts-hover-image ' . $nacho_group . '" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" data-share="' . ($lightbox_social == "true" ? 1 : 0) . '" data-autoplay="' . ($lightbox_autoplay == "true" ? 1 : 0) . '" data-duration="' . $lightbox_speed . '" data-thumbsize="' . $thumbnail_height . '" data-thumbs="' . $thumbnail_position . '" ' . $nacho_info . ' ' . $nacho_color . '>';
							if ($thumbnail_position != "0") {
								$modal_gallery .= $modal_thumb['thumbnail'];
							} else {
								$modal_gallery .= 'Lightbox Image #' . ($i + 1);
							}
						$modal_gallery .= '</a>';
					} else {
						$modal_gallery .= '<a id="' . $nacho_group . '-' . $i .'" style="display: none;" href="' . $modal_image[0] . '" data-title="' . (!empty($content_images_titles[$i]) ? $content_images_titles[$i] : "") . '" class="nch-lightbox ts-hover-image ' . $nacho_group . '" rel="' . $nacho_group . '" data-effect="' . $lightbox_effect . '" ' . $nacho_color . '>';
							if ($thumbnail_position != "0") {
								$modal_gallery .= $modal_thumb['thumbnail'];
							} else {
								$modal_gallery .= 'Lightbox Image #' . ($i + 1);
							}
						$modal_gallery .= '</a>';
					}
				}
				
				?>
					<script type="text/javascript">
						jQuery(window).load(function(){
							<?php if ($lightbox_pageload == "true") { ?>
								jQuery('.<?php echo $nacho_group; ?>').nchlightbox('open');
							<?php } ?>
						});
					</script>
				<?php
			}
		}
		
		$output .= '<div id="' . $modal_id . '-frame" class="ts-lightbox-nacho-frame" style="margin-top: '  . $margin_top . 'px; margin-bottom: ' . $margin_bottom . 'px;">';
			if (!empty($content_title)) {
				$output .= '<div id="' . $nacho_group . '-title" class="ts-lightbox-nacho-title">' . $content_title. '</div>';
			}
			if (!empty($content)) {
				$output .= '<div id="' . $nacho_group . '-info" class="ts-lightbox-nacho-info nch-hide-if-javascript">';
					if (function_exists('wpb_js_remove_wpautop')){
						$output .= wpb_js_remove_wpautop(do_shortcode($content), true);
					} else {
						$output .= do_shortcode($content);
					}
				$output .= '</div>';
			}
			$output .= $modal_gallery;
		$output .= '</div>';

		echo $output;
	
		$myvariable = ob_get_clean();
		return $myvariable;
	}
?>