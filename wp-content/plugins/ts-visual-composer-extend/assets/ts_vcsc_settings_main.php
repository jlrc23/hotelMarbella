<?php
	if (isset($_POST['Submit'])) {
		if (trim ($_POST['ts_vcsc_extend_settings_true']) == 1) {
			// Form Data Sent
			// --------------------------------------------------------------------------------------------------
			update_option('ts_vcsc_extend_settings_loadForcable',					$_POST['ts_vcsc_extend_settings_loadForcable']);
			update_option('ts_vcsc_extend_settings_loadLightbox', 					$_POST['ts_vcsc_extend_settings_loadLightbox']);
			update_option('ts_vcsc_extend_settings_loadTooltip', 					$_POST['ts_vcsc_extend_settings_loadTooltip']);
			update_option('ts_vcsc_extend_settings_loadFonts',						$_POST['ts_vcsc_extend_settings_loadFonts']);
			update_option('ts_vcsc_extend_settings_loadHeader', 					$_POST['ts_vcsc_extend_settings_loadHeader']);
			update_option('ts_vcsc_extend_settings_loadModernizr',					$_POST['ts_vcsc_extend_settings_loadModernizr']);
			update_option('ts_vcsc_extend_settings_loadWaypoints',					$_POST['ts_vcsc_extend_settings_loadWaypoints']);
			update_option('ts_vcsc_extend_settings_loadjQuery',						$_POST['ts_vcsc_extend_settings_loadjQuery']);
			update_option('ts_vcsc_extend_settings_loadEnqueue',					$_POST['ts_vcsc_extend_settings_loadEnqueue']);
			update_option('ts_vcsc_extend_settings_loadCountTo',					$_POST['ts_vcsc_extend_settings_loadCountTo']);
			update_option('ts_vcsc_extend_settings_loadDetector',					$_POST['ts_vcsc_extend_settings_loadDetector']);
			update_option('ts_vcsc_extend_settings_additionsRows',					$_POST['ts_vcsc_extend_settings_additionsRows']);
			update_option('ts_vcsc_extend_settings_additionsColumns',				$_POST['ts_vcsc_extend_settings_additionsColumns']);
			update_option('ts_vcsc_extend_settings_customTeam',						$_POST['ts_vcsc_extend_settings_customTeam']);
			update_option('ts_vcsc_extend_settings_customTestimonial',				$_POST['ts_vcsc_extend_settings_customTestimonial']);
			update_option('ts_vcsc_extend_settings_customSkillset',					$_POST['ts_vcsc_extend_settings_customSkillset']);
			update_option('ts_vcsc_extend_settings_languageDayPlural',				trim ($_POST['ts_vcsc_extend_settings_languageDayPlural']));
			update_option('ts_vcsc_extend_settings_languageDaySingular',			trim ($_POST['ts_vcsc_extend_settings_languageDaySingular']));
			update_option('ts_vcsc_extend_settings_languageHourPlural',				trim ($_POST['ts_vcsc_extend_settings_languageHourPlural']));
			update_option('ts_vcsc_extend_settings_languageHourSingular',			trim ($_POST['ts_vcsc_extend_settings_languageHourSingular']));
			update_option('ts_vcsc_extend_settings_languageMinutePlural',			trim ($_POST['ts_vcsc_extend_settings_languageMinutePlural']));
			update_option('ts_vcsc_extend_settings_languageMinuteSingular',			trim ($_POST['ts_vcsc_extend_settings_languageMinuteSingular']));
			update_option('ts_vcsc_extend_settings_languageSecondPlural',			trim ($_POST['ts_vcsc_extend_settings_languageSecondPlural']));
			update_option('ts_vcsc_extend_settings_languageSecondSingular',			trim ($_POST['ts_vcsc_extend_settings_languageSecondSingular']));
			update_option('ts_vcsc_extend_settings_languageTextCalcShow', 			trim ($_POST['ts_vcsc_extend_settings_languageTextCalcShow']));
			update_option('ts_vcsc_extend_settings_languageTextCalcHide', 			trim ($_POST['ts_vcsc_extend_settings_languageTextCalcHide']));
			update_option('ts_vcsc_extend_settings_languageTextDirectionShow', 		trim ($_POST['ts_vcsc_extend_settings_languageTextDirectionShow']));
			update_option('ts_vcsc_extend_settings_languageTextDirectionHide', 		trim ($_POST['ts_vcsc_extend_settings_languageTextDirectionHide']));
			update_option('ts_vcsc_extend_settings_languageTextViewOnGoogle',		trim ($_POST['ts_vcsc_extend_settings_languageTextViewOnGoogle']));
			update_option('ts_vcsc_extend_settings_languageTextResetMap', 			trim ($_POST['ts_vcsc_extend_settings_languageTextResetMap']));
			update_option('ts_vcsc_extend_settings_languagePrintRouteText', 		trim ($_POST['ts_vcsc_extend_settings_languagePrintRouteText']));
			update_option('ts_vcsc_extend_settings_languageTextButtonCalc', 		trim ($_POST['ts_vcsc_extend_settings_languageTextButtonCalc']));
			update_option('ts_vcsc_extend_settings_languageTextSetTarget', 			trim ($_POST['ts_vcsc_extend_settings_languageTextSetTarget']));
			update_option('ts_vcsc_extend_settings_languageTextTravelMode', 		trim ($_POST['ts_vcsc_extend_settings_languageTextTravelMode']));
			update_option('ts_vcsc_extend_settings_languageTextDriving', 			trim ($_POST['ts_vcsc_extend_settings_languageTextDriving']));
			update_option('ts_vcsc_extend_settings_languageTextWalking', 			trim ($_POST['ts_vcsc_extend_settings_languageTextWalking']));
			update_option('ts_vcsc_extend_settings_languageTextBicy', 				trim ($_POST['ts_vcsc_extend_settings_languageTextBicy']));
			update_option('ts_vcsc_extend_settings_languageTextWP', 				trim ($_POST['ts_vcsc_extend_settings_languageTextWP']));
			update_option('ts_vcsc_extend_settings_languageTextButtonAdd', 			trim ($_POST['ts_vcsc_extend_settings_languageTextButtonAdd']));
			update_option('ts_vcsc_extend_settings_languageTextDistance', 			trim ($_POST['ts_vcsc_extend_settings_languageTextDistance']));
			update_option('ts_vcsc_extend_settings_languageTextMapHome',			trim ($_POST['ts_vcsc_extend_settings_languageTextMapHome']));
			update_option('ts_vcsc_extend_settings_languageTextMapBikes',			trim ($_POST['ts_vcsc_extend_settings_languageTextMapBikes']));
			update_option('ts_vcsc_extend_settings_languageTextMapTraffic',			trim ($_POST['ts_vcsc_extend_settings_languageTextMapTraffic']));
			update_option('ts_vcsc_extend_settings_languageTextMapSpeedMiles',		trim ($_POST['ts_vcsc_extend_settings_languageTextMapSpeedMiles']));
			update_option('ts_vcsc_extend_settings_languageTextMapSpeedKM',			trim ($_POST['ts_vcsc_extend_settings_languageTextMapSpeedKM']));
			update_option('ts_vcsc_extend_settings_languageTextMapNoData',			trim ($_POST['ts_vcsc_extend_settings_languageTextMapNoData']));
			update_option('ts_vcsc_extend_settings_languageTextMapMiles',			trim ($_POST['ts_vcsc_extend_settings_languageTextMapMiles']));
			update_option('ts_vcsc_extend_settings_languageTextMapKilometes',		trim ($_POST['ts_vcsc_extend_settings_languageTextMapKilometes']));
			
			// Save Setting for each Installed Icon Font
			foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
				if (($iconfont == 'Custom') && (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') != '')) {
					update_option('ts_vcsc_extend_settings_tinymce' . $iconfont,		$_POST['ts_vcsc_extend_settings_tinymce' . $iconfont]);
					update_option('ts_vcsc_extend_settings_load' . $iconfont,			$_POST['ts_vcsc_extend_settings_load' . $iconfont]);
				} else if ($iconfont != 'Custom'){
					update_option('ts_vcsc_extend_settings_tinymce' . $iconfont,		$_POST['ts_vcsc_extend_settings_tinymce' . $iconfont]);
					update_option('ts_vcsc_extend_settings_load' . $iconfont,			$_POST['ts_vcsc_extend_settings_load' . $iconfont]);
				}
			}
			
			// Save Setting for activate VC Extensions Elements
			foreach ($this->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
				if ($element['type'] != 'demos') {
					update_option('ts_vcsc_extend_settings_custom' . $element['setting'],	$_POST['ts_vcsc_extend_settings_custom' . $element['setting']]);
				}
			}
			
			foreach ($this->TS_VCSC_Social_Networks_Array as $Social_Network => $social) {
				if ((get_option('ts_vcsc_extend_settings_demo', 1) == 0) || (get_option('ts_vcsc_extend_settings_extended', 0) == 1)) {
					update_option('ts_vcsc_social_link_' . $Social_Network,				trim ($_POST['ts_vcsc_social_link_' . $Social_Network]));
					update_option('ts_vcsc_social_order_' . $Social_Network,			trim ($_POST['ts_vcsc_social_order_' . $Social_Network]));
				}
			}

			update_option('ts_vcsc_extend_settings_updated',							1);

			echo '<script>';
				echo 'window.location="' . $_SERVER['REQUEST_URI'] . '";';
			echo '</script>';
			//Header('Location: '.$_SERVER['REQUEST_URI']);
			Exit();
		}
	} else {
		// Display a Normal Page
		// --------------------------------------------------------------------------------------------------
		$ts_vcsc_extend_settings_tinymceIcon 						= get_option('ts_vcsc_extend_settings_tinymceIcon',					1);
		$ts_vcsc_extend_settings_loadForcable						= get_option('ts_vcsc_extend_settings_loadForcable', 				0);
		$ts_vcsc_extend_settings_loadLightbox						= get_option('ts_vcsc_extend_settings_loadLightbox', 				0);
		$ts_vcsc_extend_settings_loadFonts							= get_option('ts_vcsc_extend_settings_loadFonts', 					0);
		$ts_vcsc_extend_settings_loadTooltip						= get_option('ts_vcsc_extend_settings_loadTooltip', 				0);
		$ts_vcsc_extend_settings_loadHeader							= get_option('ts_vcsc_extend_settings_loadHeader',					0);
		$ts_vcsc_extend_settings_loadModernizr						= get_option('ts_vcsc_extend_settings_loadModernizr',				1);
		$ts_vcsc_extend_settings_loadWaypoints						= get_option('ts_vcsc_extend_settings_loadWaypoints',				1);
		$ts_vcsc_extend_settings_loadMagnific						= get_option('ts_vcsc_extend_settings_loadMagnific',				1);
		$ts_vcsc_extend_settings_loadjQuery							= get_option('ts_vcsc_extend_settings_loadjQuery',					0);
		$ts_vcsc_extend_settings_loadEnqueue						= get_option('ts_vcsc_extend_settings_loadEnqueue',					1);
		$ts_vcsc_extend_settings_loadCountTo						= get_option('ts_vcsc_extend_settings_loadCountTo', 				1);
		$ts_vcsc_extend_settings_loadDetector						= get_option('ts_vcsc_extend_settings_loadDetector', 				1);
		$ts_vcsc_extend_settings_additionsRows						= get_option('ts_vcsc_extend_settings_additionsRows',				1);
		$ts_vcsc_extend_settings_additionsColumns					= get_option('ts_vcsc_extend_settings_additionsColumns',			1);
		$ts_vcsc_extend_settings_customTeam							= get_option('ts_vcsc_extend_settings_customTeam',					1);
		$ts_vcsc_extend_settings_customTestimonial					= get_option('ts_vcsc_extend_settings_customTestimonial',			1);
		$ts_vcsc_extend_settings_customSkillset						= get_option('ts_vcsc_extend_settings_customSkillset',				1);
		$ts_vcsc_extend_settings_languageDayPlural					= get_option('ts_vcsc_extend_settings_languageDayPlural',			'Days');
		$ts_vcsc_extend_settings_languageDaySingular				= get_option('ts_vcsc_extend_settings_languageDaySingular',			'Day');
		$ts_vcsc_extend_settings_languageHourPlural					= get_option('ts_vcsc_extend_settings_languageHourPlural',			'Hours');
		$ts_vcsc_extend_settings_languageHourSingular				= get_option('ts_vcsc_extend_settings_languageHourSingular',		'Hour');
		$ts_vcsc_extend_settings_languageMinutePlural				= get_option('ts_vcsc_extend_settings_languageMinutePlural',		'Minutes');
		$ts_vcsc_extend_settings_languageMinuteSingular				= get_option('ts_vcsc_extend_settings_languageMinuteSingular',		'Minute');
		$ts_vcsc_extend_settings_languageSecondPlural				= get_option('ts_vcsc_extend_settings_languageSecondPlural',		'Seconds');
		$ts_vcsc_extend_settings_languageSecondSingular				= get_option('ts_vcsc_extend_settings_languageSecondSingular',		'Second');
		$ts_vcsc_extend_settings_languageTextCalcShow				= get_option('ts_vcsc_extend_settings_languageTextCalcShow',		'Show Address Input');
		$ts_vcsc_extend_settings_languageTextCalcHide				= get_option('ts_vcsc_extend_settings_languageTextCalcHide',		'Hide Address Input');
		$ts_vcsc_extend_settings_languageTextDirectionShow			= get_option('ts_vcsc_extend_settings_languageTextDirectionShow',	'Show Directions');
		$ts_vcsc_extend_settings_languageTextDirectionHide			= get_option('ts_vcsc_extend_settings_languageTextDirectionHide',	'Hide Directions');
		$ts_vcsc_extend_settings_languageTextResetMap				= get_option('ts_vcsc_extend_settings_languageTextResetMap',		'Reset Map');
		$ts_vcsc_extend_settings_languagePrintRouteText				= get_option('ts_vcsc_extend_settings_languagePrintRouteText',		'Print Route');
		$ts_vcsc_extend_settings_languageTextViewOnGoogle			= get_option('ts_vcsc_extend_settings_languageTextViewOnGoogle',	'View on Google');
		$ts_vcsc_extend_settings_languageTextButtonCalc				= get_option('ts_vcsc_extend_settings_languageTextButtonCalc',		'Show Route');
		$ts_vcsc_extend_settings_languageTextSetTarget				= get_option('ts_vcsc_extend_settings_languageTextSetTarget',		'Please enter your Start Address:');
		$ts_vcsc_extend_settings_languageTextTravelMode				= get_option('ts_vcsc_extend_settings_languageTextTravelMode',		'Travel Mode');
		$ts_vcsc_extend_settings_languageTextDriving				= get_option('ts_vcsc_extend_settings_languageTextDriving',			'Driving');
		$ts_vcsc_extend_settings_languageTextWalking				= get_option('ts_vcsc_extend_settings_languageTextWalking',			'Walking');
		$ts_vcsc_extend_settings_languageTextBicy					= get_option('ts_vcsc_extend_settings_languageTextBicy',			'Bicycling');
		$ts_vcsc_extend_settings_languageTextWP						= get_option('ts_vcsc_extend_settings_languageTextWP',				'Optimize Waypoints');
		$ts_vcsc_extend_settings_languageTextButtonAdd				= get_option('ts_vcsc_extend_settings_languageTextButtonAdd',		'Add Stop on the Way');
		$ts_vcsc_extend_settings_languageTextDistance				= get_option('ts_vcsc_extend_settings_languageTextDistance', 		'Total Distance:');
		$ts_vcsc_extend_settings_languageTextMapHome 				= get_option('ts_vcsc_extend_settings_languageTextMapHome',			'Home');
		$ts_vcsc_extend_settings_languageTextMapBikes 				= get_option('ts_vcsc_extend_settings_languageTextMapBikes',		'Bicycle Trails');
		$ts_vcsc_extend_settings_languageTextMapTraffic 			= get_option('ts_vcsc_extend_settings_languageTextMapTraffic',		'Traffic');
		$ts_vcsc_extend_settings_languageTextMapSpeedMiles 			= get_option('ts_vcsc_extend_settings_languageTextMapSpeedMiles',	'Miles Per Hour');
		$ts_vcsc_extend_settings_languageTextMapSpeedKM 			= get_option('ts_vcsc_extend_settings_languageTextMapSpeedKM',		'Kilometers Per Hour');
		$ts_vcsc_extend_settings_languageTextMapNoData 				= get_option('ts_vcsc_extend_settings_languageTextMapNoData',		'No Data Available!');
		$ts_vcsc_extend_settings_languageTextMapMiles 				= get_option('ts_vcsc_extend_settings_languageTextMapMiles',		'Miles');
		$ts_vcsc_extend_settings_languageTextMapKilometes 			= get_option('ts_vcsc_extend_settings_languageTextMapKilometes',	'Kilometers');
		
		// Retrieve Setting for each Installed Icon Font
		foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
			${'ts_vcsc_extend_settings_tinymce' . $iconfont . ''}			= get_option('ts_vcsc_extend_settings_tinymce' . $iconfont,				1);
			${'ts_vcsc_extend_settings_load' . $iconfont . ''}				= get_option('ts_vcsc_extend_settings_load' . $iconfont,				0);
		}
		
		// Retrieve Setting for activate VC Extensions Elements
		foreach ($this->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
			if ($element['type'] != 'demos') {
				${'ts_vcsc_extend_settings_custom' . $element['setting'] . ''}	= get_option('ts_vcsc_extend_settings_custom' . $element['setting'],	1);
			}
		}
		
		if (get_option('ts_vcsc_extend_settings_popups', 1) == 0) {
			$ToolTipClass = "TS_Helper_Off";
		} else {
			$ToolTipClass = "TS_Helper";
		}

		// Basic Form Validation
		if (get_option('ts_vcsc_extend_settings_updated') == 1) {
			echo "\n";
			echo "<script type='text/javascript'>" . "\n";
			if ((get_option('ts_vcsc_extend_settings_licenseValid', 0) == 1) || (get_option('ts_vcsc_extend_settings_extended', 0) == 1)) {
				echo 'VC_Extension_Demo = false;' . "\n";
			} else {
				echo 'VC_Extension_Demo = true;' . "\n";
			}
			echo "SettingsSaved = true;" . "\n";
			echo "</script>" . "\n";
		} else {
			echo "\n";
			echo "<script type='text/javascript'>" . "\n";
			echo "SettingsSaved = false;" . "\n";
			echo "</script>" . "\n";
		}
		update_option('ts_vcsc_extend_settings_updated',	0);
	}
?>

<?php
	if ((get_option('ts_vcsc_extend_settings_demo', 1) == 1) && (get_option('ts_vcsc_extend_settings_extended', 0) == 0)) {
		echo "<hr class='style-two' style='margin-top: 25px;'>" . "\n";
		echo '<div class="clearFixMe" style="font-weight: bold; text-align: justify; color: red; padding-top: 20px;">This is a Demoversion of the Visual Composer Extension Plugin. You will not be able to save any changes to the Global Settings. Please enter your License Key to unlock all Features!</div>';
	}
?>

<div id="ts_vcsc_extend_errors" style="display: none;"></div>

<form id="ts_vcsc_extend_settings" data-type="settings" class="ts_vcsc_extend_global_settings" name="oscimp_form" style="margin-top: 20px; width: 100%;" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">

	<span id="gallery_settings_true" style="display: none !important; margin-bottom: 20px;">
		<input type="text" style="width: 20%;" id="ts_vcsc_extend_settings_true" name="ts_vcsc_extend_settings_true" value="0" size="100">
		<input type="text" style="width: 20%;" id="ts_vcsc_extend_settings_count" name="ts_vcsc_extend_settings_count" value="0" size="100">
	</span>

	<div class="wrapper">
		<div id="v-nav">
			<ul id="v-nav-main" data-type="settings">
				<li id="link-ts-settings-submit" class="first" style="border-bottom: 1px solid #DDD;">
					<div class="submit" style="width: 150px; margin: 0px auto;">
						<input id="ts_vcsc_extend_settings_validate_1" title="Click here to validate your global Settings." style="margin: 10px auto;" class="ts_vcsc_extend_settings_validate button-primary ButtonSubmit TS_Tooltip" type="submit" name="Submit" value="<?php _e('Save Settings', 'oscimp_trdom' ) ?>" />
						<input id="ts_vcsc_extend_settings_submit_1" title="Click here to save global Settings" style="margin: 10px auto; display: none;" class=" ts_vcsc_extend_settings_submit button-primary ButtonSubmit TS_Tooltip" type="submit" name="Submit" value="<?php _e('Save Settings', 'oscimp_trdom' ) ?>" />
					</div>
				</li>
				<li id="link-ts-settings-general" 		data-tab="ts-settings-general" 			data-order="1"		data-name="General Settings"		class="link-data current"><img style="width: 16px; height: 15px; margin-right: 5px;" src="<?php echo TS_VCSC_GetResourceURL('css/images/settings-composer.png'); ?>">General Settings<span id="errorTab1" class="errorMarker"></span></li>
				<li id="link-ts-settings-language" 		data-tab="ts-settings-language" 		data-order="2"		data-name="Language Settings"		class="link-data"><img style="width: 16px; height: 15px; margin-right: 5px;" src="<?php echo TS_VCSC_GetResourceURL('css/images/settings-translate.png'); ?>">Language Settings<span id="errorTab2" class="errorMarker"></span></li>
				<li id="link-ts-settings-iconfont" 		data-tab="ts-settings-iconfont" 		data-order="3"		data-name="Icon Font Settings"		class="link-data"><img style="width: 16px; height: 15px; margin-right: 5px;" src="<?php echo TS_VCSC_GetResourceURL('css/images/settings-tinymce.png'); ?>">Font Manager<span id="errorTab3" class="errorMarker"></span></li>
				<a href="admin.php?page=TS_VCSC_Uploader" target="_parent" style="color: #000000;">
					<li id="link-ts-settings-import" 					data-tab="ts-settings-import" 			data-order="4"		data-name="Import Font"				class="link-url"><img style="width: 16px; height: 15px; margin-right: 5px;" src="<?php echo TS_VCSC_GetResourceURL('css/images/settings-import.png'); ?>">Import Font<span id="errorTab4" class="errorMarker"></span></li>
				</a>
				<li id="link-ts-settings-social" 		data-tab="ts-settings-social" 			data-order="5"		data-name="Social Defaults"			class="link-data"><img style="width: 16px; height: 15px; margin-right: 5px;" src="<?php echo TS_VCSC_GetResourceURL('css/images/settings-share.png'); ?>">Social Networks<span id="errorTab5" class="errorMarker"></span></li>
				<li id="link-ts-settings-files" 		data-tab="ts-settings-files" 			data-order="6"		data-name="External Files"			class="link-data"><img style="width: 16px; height: 15px; margin-right: 5px;" src="<?php echo TS_VCSC_GetResourceURL('css/images/settings-external.png'); ?>">External Files<span id="errorTab6" class="errorMarker"></span></li>
				
				<a href="admin.php?page=TS_VCSC_Previews" target="_parent" style="color: #000000;">
					<li id="link-ts-settings-iconview" 					data-tab="ts-settings-iconview" 		data-order="7"		data-name="Icon Preview"			class="link-url"><img style="width: 16px; height: 15px; margin-right: 5px;" src="<?php echo TS_VCSC_GetResourceURL('css/images/settings-preview.png'); ?>">Icon Previews<span id="errorTab7" class="errorMarker"></span></li>
				</a>
				<?php
					if (current_user_can('manage_options')) {
						echo '<a href="admin.php?page=TS_VCSC_CSS" target="_parent" style="color: #000000;">';
							echo '<li id="link-ts-settings-customcss" 	data-tab="ts-settings-customcss"		data-order="8"		data-name="Add Custom CSS"			class="link-url"><img style="width: 16px; height: 15px; margin-right: 5px;" src="' . TS_VCSC_GetResourceURL('css/images/settings-css.png') . '">Add Custom CSS<span id="errorTab8" class="errorMarker"></span></li>';
						echo '</a>';
						echo '<a href="admin.php?page=TS_VCSC_JS" target="_parent" style="color: #000000;">';
							echo '<li id="link-ts-settings-customjs" 	data-tab="ts-settings-customjs" 		data-order="9"		data-name="Add Custom JS"			class="link-url"><img style="width: 16px; height: 15px; margin-right: 5px;" src="' . TS_VCSC_GetResourceURL('css/images/settings-js.png') . '">Add Custom JS<span id="errorTab9" class="errorMarker"></span></li>';
						echo '</a>';
						if (get_option('ts_vcsc_extend_settings_extended', 0) == 0) {
							echo '<a href="admin.php?page=TS_VCSC_License" target="_parent" style="color: #000000;">';
								echo '<li id="link-ts-settings-license" 	data-tab="ts-settings-license"		data-order="10"		data-name="Licence Key"				class="link-url last"><img style="width: 16px; height: 15px; margin-right: 5px;" src="' . TS_VCSC_GetResourceURL('css/images/settings-license.png') . '">License Key<span id="errorTab10" class="errorMarker"></span></li>';
							echo '</a>';
						}
					}
				?>
			</ul>

			<?php
				include('ts_vcsc_settings_general.php');
				include('ts_vcsc_settings_language.php');
				include('ts_vcsc_settings_iconfont.php');
				include('ts_vcsc_settings_social.php');
				include('ts_vcsc_settings_external.php');
			?>
        </div>
    </div>

</form>
