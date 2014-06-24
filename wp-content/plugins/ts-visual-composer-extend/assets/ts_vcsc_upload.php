<?php
	global $TS_VCSC_tinymceCustomCount;
	global $TS_VCSC_Icons_Custom;
	
	/* get uploaded file, unzip .zip, store files in appropriate locations, populate page with custom icons
	wp_handle_upload ( http://codex.wordpress.org/Function_Reference/wp_handle_upload )
	** TO DO RENAME UPLOADED FILE TO ts-vcsc-custom-pack.zip ** */
	if (isset($_FILES['custom_icon_pack'])) {
		$uploadedfile 		= $_FILES['custom_icon_pack'];
		$upload_overrides 	= array('test_form' => false);
		// TO DO
		// get filename dynamically so user doesn't need to customize zip name
		// ERROR CHECKING SO ONLY .ZIP's ARE UPLOADED
		// hide ajax loader if no pack is uploaded
		// export json file for importing back to icomoon - spit back out json file 
		// create a 'Download Pack' button and 'Download .json' button  
		/*
		$filename = $uploadedFile
		*/
		// move the file to the custom upload path set above on line 63
		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		// if upload was successful
		if ($movefile) {	
			echo '<script>
				jQuery(document).ready(function() {
					jQuery(".ts-vcsc-custom-pack-preloader").hide();
					jQuery("#uninstall-pack-button").removeAttr("disabled");
					jQuery("#ts_vcsc_custom_pack_field").attr("disabled","disabled");
					jQuery("input[value=Import]").attr("disabled","disabled");
					jQuery(".ts-vcsc-custom-pack-buttons").after("<div class=updated><p class=fontPackUploadedSuccess>Custom Font Pack successfully uploaded!</p></div>");
				});
			</script>';	 
			// unzip the file contents to the same directory
			WP_Filesystem();
			$dest = wp_upload_dir();
			$dest_path = $dest['path'];
			$fileNameNoSpaces = str_replace(' ', '-',$uploadedfile['name']);
			$unzipfile = unzip_file( $dest_path . '/' . $fileNameNoSpaces, $dest_path );
			if ($unzipfile) {
				rename($dest_path . '/' . $fileNameNoSpaces, $dest_path . '/' . 'ts-vcsc-custom-pack.zip');
				rename($dest_path . '/' . 'selection.json', $dest_path . '/' . 'ts-vcsc-custom-pack.json');
				// change path of linked font files in style.css
				$styleCSS = $dest_path . '/style.css';
				if (ini_get('allow_url_fopen') == '1') {
					$currentStyles 						= file_get_contents($styleCSS);
					// for css and js files that are not needed any more
					$newStyles = str_replace("url('fonts/", "url('" . site_url() . "/wp-content/uploads/ts-vcsc-icons/custom-pack/fonts/", $currentStyles);
					// Write the contents back to the file
					$file_put_contents = file_put_contents($styleCSS, $newStyles);
				}
				// Delete unecessary files / add error checking
				if (file_exists( $dest_path . '/demo-files' )) {
					TS_VCSC_RemoveDirectory($dest_path . '/demo-files');
				};
				if (file_exists( $dest_path . '/demo.html' )) {
					unlink($dest_path . '/demo.html'); 
				};
				if (file_exists( $dest_path . '/Read Me.txt' )) {
					unlink($dest_path . '/Read Me.txt'); 
				};
				// Process JSON File to create and store Font Array
				$Custom_JSON_URL 					= site_url() . '/wp-content/uploads/ts-vcsc-icons/custom-pack/ts-vcsc-custom-pack.json';
				if (ini_get('allow_url_fopen') == '1') {
					$Custom_JSON					= file_get_contents($Custom_JSON_URL);
				} else if (function_exists('curl_init')) {
					$ch = curl_init();
					$timeout = 5;
					curl_setopt($ch, CURLOPT_URL, $Custom_JSON_URL);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
					curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
					$Custom_JSON 					= curl_exec($ch);
					curl_close($ch);
				}
				$Custom_Code                        = json_decode($Custom_JSON, true);
				$TS_VCSC_Icons_Custom               = array();
				$Custom_Class_Prefix                = $Custom_Code['preferences']['fontPref']['prefix'];
				$Custom_Font_Name                   = $Custom_Code['metadata']['name'];
				$Custom_Font_Author                 = $Custom_Code['metadata']['designer'];
				foreach ($Custom_Code['icons'] as $item) {
					$Custom_Class_Full = $Custom_Class_Prefix . $item['properties']['name'];
					$Custom_Class_Code = $item['properties']['code'];
					$TS_Custom_User_Font[$Custom_Class_Full] = $Custom_Class_Code;
				}
				$TS_VCSC_Icons_Custom				= $TS_Custom_User_Font;
				$TS_VCSC_tinymceCustomCount			= count(array_unique($TS_VCSC_Icons_Custom));;
				// Export Font Array to PHP file
				$phpArray = $dest_path . '/ts-vcsc-custom-pack.php';
				$file_put_contents = file_put_contents($phpArray, '<?php $this->TS_VCSC_Icons_Custom = ' . var_export($TS_VCSC_Icons_Custom, true) . '; ?>');
				// Store Custom Font Data in WordPress Settings
				update_option('ts_vcsc_extend_settings_tinymceCustom', 			1);
				update_option('ts_vcsc_extend_settings_tinymceCustomJSON', 		site_url() . '/wp-content/uploads/ts-vcsc-icons/custom-pack/ts-vcsc-custom-pack.json');
				update_option('ts_vcsc_extend_settings_tinymceCustomPath', 		site_url() . '/wp-content/uploads/ts-vcsc-icons/custom-pack/style.css');
				update_option('ts_vcsc_extend_settings_tinymceCustomPHP', 		site_url() . '/wp-content/uploads/ts-vcsc-icons/custom-pack/ts-vcsc-custom-pack.php');
				update_option('ts_vcsc_extend_settings_tinymceCustomArray', 	$TS_VCSC_Icons_Custom);
				update_option('ts_vcsc_extend_settings_tinymceCustomName', 		ucwords($Custom_Font_Name));
				update_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 	ucwords($Custom_Font_Author));
				update_option('ts_vcsc_extend_settings_tinymceCustomCount', 	$TS_VCSC_tinymceCustomCount);
				update_option('ts_vcsc_extend_settings_tinymceCustomDate',		date('Y/m/d h:i:s A'));
				// Display success message / disable file upload field
				echo '<script>
					jQuery(document).ready(function() {
						jQuery(".dropDownDownload").removeAttr("disabled");
						jQuery(".fontPackUploadedSuccess").parent("div").after("<div class=updated><p class=fontPackSuccessUnzip>Custom Font Pack successfully unzipped!</p></div>");
					});
				</script>';	 
				echo '<script>
					jQuery(document).ready(function() {
					jQuery(".fontPackSuccessUnzip").parent("div").after("<div class=updated><p>Custom Font Pack successfully installed, enjoy!</p></div>");
						setTimeout(function() {
							jQuery(".updated").fadeOut();
						}, 5000);
					});
				</script>';
				$output = "";
				$output .= "<div id='ts-vcsc-extend-preview' class=''>";
					$output .="<div id='ts-vcsc-extend-preview-name'>Font Name: " . $Custom_Font_Name . "</div>";
					$output .="<div id='ts-vcsc-extend-preview-author'>Font Author: " . 	get_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 'Custom User') . "</div>";
					$output .="<div id='ts-vcsc-extend-preview-count'>Icon Count: " . 		get_option('ts_vcsc_extend_settings_tinymceCustomCount', 0) . "</div>";
					$output .="<div id='ts-vcsc-extend-preview-date'>Uploaded: " . 			get_option('ts_vcsc_extend_settings_tinymceCustomDate', '') . "</div>";
					$output .= "<div id='ts-vcsc-extend-preview-list' class=''>";
					$icon_counter = 0;
					foreach ($this->TS_VCSC_Icons_Custom as $key => $option ) {
						$font = explode('-', $key);
						$output .= "<div class='ts-vcsc-icon-preview' data-name='" . $key . "' data-code='" . $option . "' data-font='" . strtolower($iconfont) . "' data-count='" . $icon_counter . "' rel='" . $key . "'><span class='ts-vcsc-icon-preview-icon'><i class='" . $key . "'></i></span><span class='ts-vcsc-icon-preview-name'>" . $key . "</span></div>";
						$icon_counter = $icon_counter + 1;
					}
					$output .= "</div>";
				$output .= "</div>";
				echo '<script>
					jQuery(document).ready(function() {
						//loadjscssfile("' . site_url() . '/wp-content/uploads/ts-vcsc-icons/custom-pack/style.css", "css");
						//jQuery("#current-font-pack-preview").html("' . $output. '");
						jQuery("#ts_vcsc_icons_upload_custom_pack_form").trigger("reset");
						MessiTitle		= "Visual Composer Extensions";
						MessiContent 	= "Your Custom Font Pack has been successfully installed.";
						MessiCode 		= "anim success";
						new Messi(MessiContent, {
							title:                      MessiTitle,
							titleClass:                 MessiCode,
							modal: 		                true,
							modalOpacity:               0.70,
							viewport:                   {top: "50%", left: "50%"},
							buttons:                    [{id: 0, label: "Close", val: "X"}],
							callback: function(val) {
								location.reload();
							},
							onclose: function(val) {
								location.reload();
							}
						});
					});
				</script>';
			} else {
				update_option('ts_vcsc_extend_settings_tinymceCustom', 			0);
				update_option('ts_vcsc_extend_settings_tinymceCustomJSON', 		'');
				update_option('ts_vcsc_extend_settings_tinymceCustomPath', 		'');
				update_option('ts_vcsc_extend_settings_tinymceCustomArray', 	'');
				update_option('ts_vcsc_extend_settings_tinymceCustomName', 		'Custom User Font');
				update_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 	'Custom User');
				update_option('ts_vcsc_extend_settings_tinymceCustomCount', 	0);
				update_option('ts_vcsc_extend_settings_tinymceCustomDate',		'');
				echo '<script>
					jQuery(document).ready(function() {
						jQuery(".fontPackUploadedSuccess").parent("div").after("<div class=error><p>There was a problem unzipping the file.</p></div>");
					});
				</script>';	 
			}
		} else {
			update_option('ts_vcsc_extend_settings_tinymceCustom', 			0);
			update_option('ts_vcsc_extend_settings_tinymceCustomJSON', 		'');
			update_option('ts_vcsc_extend_settings_tinymceCustomPath', 		'');
			update_option('ts_vcsc_extend_settings_tinymceCustomArray', 	'');
			update_option('ts_vcsc_extend_settings_tinymceCustomName', 		'Custom User Font');
			update_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 	'Custom User');
			update_option('ts_vcsc_extend_settings_tinymceCustomCount', 	0);
			update_option('ts_vcsc_extend_settings_tinymceCustomDate',		'');
			echo '<script>
				jQuery(document).ready(function() {
					jQuery(".ts-vcsc-custom-pack-buttons").after("<div class=error><p class=fontPackUploadedError>There was a problem importing the file.</p></div>");
				});
			</script>';	 
		}
	}
?>
	<div class="ts-vcsc-custom-upload-wrap wrap" style="width: 100%;">
		<h1><span style="color:#FF8000;">Import a Custom Icon Pack</span></h1>
		<p>Welcome to the Visual Composer Extensions - Custom Font Pack section! Use the importer below to import a custom icon pack downloaded from <a href="http://icomoon.io/app/#/select" target="_blank">IcoMoon</a>.</p>
		<script>				
		jQuery(document).ready(function() {
			setTimeout(function() {	
				var fontNameString = jQuery(".mhmm").text();
				var newfontNameString = fontNameString.replace("Font Name:","");
				var customPackFontName = newfontNameString.split("(")[0];
				var customPackFontName = jQuery.trim(customPackFontName);
				jQuery('.downloadFontZipLink').parent('li').find('img').remove();
				jQuery('.downloadFontZipLink').text('Download ' + customPackFontName + '.zip');
				jQuery('.downloadFontjSonLink').parent('li').find('img').remove();
				jQuery('.downloadFontjSonLink').text('Download ' + customPackFontName + '.json');
			}, 2000);
		});
		</script>
		<!-- Handling Custom Font Pack Uploads -->
		<form id="ts_vcsc_icons_upload_custom_pack_form" enctype="multipart/form-data" action="" method="POST">
			<p id="async-upload-wrap" style="margin-bottom:0;">
				<label for="async-upload" style="font-weight: bold;">Import a Custom Font Pack :</label><br />
				<input type="file" id="ts_vcsc_custom_pack_field" name="custom_icon_pack"> 
				<p style="margin:0;"> 
					<span class="custom-icons-file-upload-note">Note: File must be the original .zip downloaded from IcoMoon</span>
				</p>	
				<span class="ts-vcsc-custom-pack-buttons">
					<p>
						<?php
							// print form submission button
							echo submit_button( 'Import', 'primary', '', false, '' ); 
						?>
					</p>
					<p style="margin-left: 2em;">
						<?php
							$other_attributes = array( 'onclick' => 'TS_VCSC_UninstallFontPack(); return false;' );
							echo submit_button( '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Uninstall Pack', 'delete', 'uninstall-pack-button', false, $other_attributes );
							$dest = wp_upload_dir();
							$dest_url = $dest['url'];
							$dest_path = $dest['path'];
						?>
					</p> 
					<p>
						<button style="height:28px; margin-left:2em;" type="button" disabled value="Dropdown" data-dropdown="#dropdown-1" class="dropDownDownload button-secondary">Download</button>
					</p>
					<!-- jquery download dropdown menu -->
					<div id="dropdown-1" style="" class="dropdown dropdown-anchor-left dropdown-tip dropdown-relative">
						<ul class="dropdown-menu">
							<li><a title="This .zip file contains the original files you uploaded with your icon pack." class="downloadFontZipLink" href="<?php echo $dest_url.'/ts-vcsc-custom-pack.zip'; ?>"></a><img src="<?php echo site_url().'/wp-admin/images/wpspin_light.gif'?>" alt="preloader"></li>
							<li class="dropdown-divider"></li>
							<li><a title="You can use this .json file to export your custom pack back into IcoMoon and then add or remove icons as you please." class="downloadFontjSonLink" download="ts-vcsc-custom-pack.json" href="<?php echo $dest_url.'/ts-vcsc-custom-pack.json'; ?>"></a><img src="<?php echo site_url().'/wp-admin/images/wpspin_light.gif'?>" alt="preloader"></li>
						</ul>
					</div>
				</span>
				<!-- display success or error message after font pack deletion -->
				<p id="delete_succes_and_error_message"></p>
				<p id="unzip_succes_and_error_message"></p>
			</p>
		</form>
		
		<!-- Package Path -->
		<div style="width:100%; display: block;">
			<?php
				if (file_exists($dest_path . '/ts-vcsc-custom-pack.zip')) {
					$fontPackLocationString = 'Your Custom Icon Pack is located in: '; 
				} else {
					$fontPackLocationString = 'Your Custom Icon Pack will be installed to: ';
				}
			?>
			<p style="font-size: 10px; display: block;"><?php echo $fontPackLocationString.'<b>' . $dest_path . '</b>'; ?></p>
			<hr class="style-six" style="margin-top: 20px; margin-bottom: 20px;">
		</div>
		
		<div class="current-font-pack" style="float:left; width: 100%; display: block;">
			<img style="display: none;" class="ts-vcsc-custom-pack-preloader" src="<?php echo site_url().'/wp-admin/images/wpspin_light.gif'?>" alt="preloader">
			<div id="current-font-pack-preview" class="current-font-pack-preview"></div>
		</div>
<?php

?>