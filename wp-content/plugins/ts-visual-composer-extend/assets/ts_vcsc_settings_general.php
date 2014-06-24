<div id="ts-settings-general" class="tab-content">
    <h2>General Information</h2>

	<div style="margin-top: 0px; font-size: 13px; text-align: justify;">
		In order to use this plugin, you MUST have the Visual Composer Plugin installed; either as a normal plugin or as part of your theme. If Visual Composer is part of your theme, please ensure that it has not been modified;
		some theme developers heavily modify Visual Composer in order to allow for certain theme functions. Unfortunately, some of these modification prevent this extension pack from working correctly.
	</div>
	
	<div style="margin-top: 20px;">
		<h4>Visual Composer Plugin</h4>
		<div style="font-size: 10px;">The following links refer to the actual Visual Composer Plugin.</div>
		<div style="margin-top: 20px;">
			<a class="button-secondary" style="width: 140px; margin: 0px auto; text-align: center;" href="http://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?ref=Tekanewa" target="_blank"><img src="<?php echo TS_VCSC_GetResourceURL('images/TS_VCSC_Menu_Icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Buy Plugin</a>
			<a class="button-secondary" style="width: 140px; margin: 0px auto; text-align: center;" href="options-general.php?page=wpb_vc_settings" target="_parent"><img src="<?php echo TS_VCSC_GetResourceURL('images/TS_VCSC_Settings_Icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Settings</a>
			<a class="button-secondary" style="width: 140px; margin: 0px auto; text-align: center;" href="http://support.wpbakery.com/" target="_blank"><img src="<?php echo TS_VCSC_GetResourceURL('images/TS_VCSC_Support_Icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Support</a>
			<a class="button-secondary" style="width: 140px; margin: 0px auto; text-align: center;" href="http://demo.wpbakery.com/?theme=visual-composer" target="_blank"><img src="<?php echo TS_VCSC_GetResourceURL('images/TS_VCSC_Demo_Icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Demo</a>
		</div>
		<div style="margin-top: 10px;">In order to use the Visual Composer Extensions, you MUST enable them in the <a href="options-general.php?page=wpb_vc_settings" target="_parent">settings</a> for the actual Visual Composer Plugin.</div>
	</div>
	
	<div style="margin-top: 20px;">
		<h4>Visual Composer Extensions</h4>
		<div style="font-size: 10px;">The following links refer to the Visual Composer Extensions Plugin.</div>
		<div style="margin-top: 20px;">
			<a class="button-secondary" style="width: 140px; margin: 0px auto; text-align: center;" href="http://codecanyon.net/user/Tekanewa/portfolio" target="_blank"><img src="<?php echo TS_VCSC_GetResourceURL('images/TS_VCSC_Menu_Icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Buy Extensions</a>
			<a class="button-secondary" style="width: 140px; margin: 0px auto; text-align: center;" href="admin.php?page=TS_VCSC_CSS" target="_parent"><img src="<?php echo TS_VCSC_GetResourceURL('images/TS_VCSC_CustomCSS_Icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Custom CSS</a>
			<a class="button-secondary" style="width: 140px; margin: 0px auto; text-align: center;" href="admin.php?page=TS_VCSC_JS" target="_parent"><img src="<?php echo TS_VCSC_GetResourceURL('images/TS_VCSC_CustomJS_Icon_16x16.png'); ?>" style="width: 16px; height: 16px; margin-right: 10px;">Custom JS</a>
			<?php
				if (get_option('ts_vcsc_extend_settings_extended', 0) == 0) {
					echo '<a class="button-secondary" style="width: 140px; margin: 0px auto; text-align: center;" href="admin.php?page=TS_VCSC_License" target="_parent"><img src="' . TS_VCSC_GetResourceURL('images/TS_VCSC_License_Icon_16x16.png') . '" style="width: 16px; height: 16px; margin-right: 10px;">License</a>';
				}
			?>
		</div>
	</div>
	
	<h2 style="margin-top: 40px;">Rows & Columns</h2>
	
	<div style="margin-top: 20px; font-size: 13px; text-align: justify;">
		Visual Composer Extensions allows you to extend the available options for Row and Column settings, adding features such as viewport animations (row + column) and a variety of background effects (row). If you already use other
		plugins that provide the same or similiar options you should decide for either one but not use both at the same time as they can cause contradicting settings. Also, if your theme incorporates Visual Composer by itself, some
		themes already provide you with similiar options. In these cases, you should disable the settings below in order to avoid any conflicts.
	</div>
	
	<div style="margin-top: 20px; font-weight: bold;">The extended Row and Column Options require a Visual Composer version of 4.1 or higher, in order to function correctly!</div>
	
    <div style="margin-top: 20px;">
        <h4>Extend Options for Visual Composer Rows:</h4>
        <p style="font-size: 10px;">Extend Row Options with Background Effects and Viewport Animation Settings:</p>
        <input type="hidden" name="ts_vcsc_extend_settings_additionsRows" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_additionsRows" id="ts_vcsc_extend_settings_additionsRows" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_additionsRows); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_additionsRows">Extend Row Options<span title="If checked, the plugin will extend the available options for row settings." class="<?php echo $ToolTipClass; ?>"></span></label>
    </div>
	
    <div style="margin-top: 20px;">
        <h4>Extend Options for Visual Composer Columns:</h4>
        <p style="font-size: 10px;">Extend Column Options with Viewport Animation Settings:</p>
        <input type="hidden" name="ts_vcsc_extend_settings_additionsColumns" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_additionsColumns" id="ts_vcsc_extend_settings_additionsColumns" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_additionsColumns); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_additionsColumns">Extend Column Options<span title="If checked, the plugin will extend the available options for columns settings." class="<?php echo $ToolTipClass; ?>"></span></label>
    </div>
	
	<h2 style="margin-top: 40px;">Custom Post Types</h2>
	
	<div style="margin-top: 20px; font-size: 13px; text-align: justify;">
		Starting with version 2.0, Visual Composer Extensions introduced custom post types, to be used for some of the elements and for more complex layouts. If your theme or another plugin already provides a similiar post
		type (i.e. a post type for "teams"), you can disable the corresponding custom post type that comes with Visual Composer Extensions. Disabling a custom post type will also disable the corresponding Visual Composer elements
		and shortcodes associated with the post type.
	</div>
	
    <div style="margin-top: 20px;">
        <h4>Visual Composer Team:</h4>
        <p style="font-size: 10px;">Enable or disable the custom post type "VC Team":</p>
        <input type="hidden" name="ts_vcsc_extend_settings_customTeam" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_customTeam" id="ts_vcsc_extend_settings_customTeam" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_customTeam); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_customTeam">Enable "VC Team" Post Type<span title="If checked, the plugin will enable a custom post type to be used for the element(s) 'TS Teammates'." class="<?php echo $ToolTipClass; ?>"></span></label>
    </div>
	
    <div style="margin-top: 20px;">
        <h4>Visual Composer Testimonials:</h4>
        <p style="font-size: 10px;">Enable or disable the custom post type "VC Testimonials":</p>
        <input type="hidden" name="ts_vcsc_extend_settings_customTestimonial" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_customTestimonial" id="ts_vcsc_extend_settings_customTestimonial" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_customTestimonial); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_customTestimonial">Enable "VC Testimonials" Post Type<span title="If checked, the plugin will enable a custom post type to be used for the element(s) 'TS Testimonials'." class="<?php echo $ToolTipClass; ?>"></span></label>
    </div>
	
    <div style="margin-top: 20px;">
        <h4>Visual Composer Skillsets:</h4>
        <p style="font-size: 10px;">Enable or disable the custom post type "VC Skillsets":</p>
        <input type="hidden" name="ts_vcsc_extend_settings_customSkillset" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_customSkillset" id="ts_vcsc_extend_settings_customSkillset" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_customSkillset); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_customSkillset">Enable "VC Skillsets" Post Type<span title="If checked, the plugin will enable a custom post type to be used for the element(s) 'TS Skillsets'." class="<?php echo $ToolTipClass; ?>"></span></label>
    </div>
	
	<h2 style="margin-top: 40px;">Composer Elements</h2>
	
	<div style="margin-top: 20px; font-size: 13px; text-align: justify;">
		While you can prevent individual elements from becoming available to certain user groups (using the "User Group Access Rules" in the settings for the original Visual Composer Plugin), the elements are technically still
		loaded in the background. In order to allow for an improved overall site performance, you can completely disable unwanted elements that are part of Visual Composer Extensions here. Once disabled, the element and its
		associated shortcode will not be loaded anymore.
	</div>
	
	<div style="margin-top: 20px; margin-bottom: 20px; font-size: 11px; font-weight: bold; color: red; text-align: justify;">
		The original Visual Composer Plugin still requires you to enable the elements based on available user roles using the <a href="options-general.php?page=wpb_vc_settings">settings panel</a> for Visual Composer. That settings panel controls
		which users have access to which Visual Composer elements but doesn't stop them from being loaded.
	</div>
	
	<?php
		foreach ($this->TS_VCSC_Visual_Composer_Elements as $ElementName => $element) {
			if ($element['type'] != 'demos') {
				echo '<div style="margin: 6px 0px;">';
					echo '<input type="hidden" name="ts_vcsc_extend_settings_custom' . $element['setting'] . '" value="0" />';
					echo '<input type="checkbox" name="ts_vcsc_extend_settings_custom' . $element['setting'] . '" id="ts_vcsc_extend_settings_custom' . $element['setting'] .'" value="1" ' . (${'ts_vcsc_extend_settings_custom' . $element['setting'] . ''} == 1 ? ' checked="checked"' : '') . '/>';
					echo '<label class="labelCheckBox" for="ts_vcsc_extend_settings_custom' . $element['setting'] . '">Enable "' . $ElementName . '" Element<span title="If checked, the plugin will enable a the element ' . $ElementName . '." class="' . $ToolTipClass . '"></span></label>';
				echo '</div>';
			}
		}
	?>
	
    <h2 style="margin-top: 40px; display: none;">Other Settings</h2>
    
    <div style="margin-top: 20px; display: none;">
        <h4>Viewing Device Detection:</h4>
        <p style="font-size: 10px;">Enable or disable the use of the Device Detection:</p>
        <input type="hidden" name="ts_vcsc_extend_settings_loadDetector" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_loadDetector" id="ts_vcsc_extend_settings_loadDetector" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_loadDetector); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_loadDetector">Use Device Detection<span title="If checked, the plugin will attempt to detect what kind of device is used to view the site." class="<?php echo $ToolTipClass; ?>"></span></label>
    </div>
</div>
