<div id="ts-settings-iconfont" class="tab-content">
    <h2>Icon Font Settings</h2>
    <p>Here you will find settings that relate to the utilized icon fonts.</p>

    <hr class='style-six' style='margin-top: 20px;'>

    <h4>Include the following Icon Fonts:</h4>
	
    <div id="ts_vcsc_extend_settings_tinymceIconFontError" style="display: none;">
	<span id="ts_vcsc_extend_settings_tinymceIconFontCheck">You must select at least one allowable Icon Font!</span>
    </div>
	
    <div style="margin-top: 20px;" class="clearFixMe">
	<?php
	    foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
		if ($iconfont != "Custom") {
		    $output = '';
		    echo '<div class="ts_vcsc_extend_font_selector">';
			echo '<img id="ts_vcsc_extend_settings_tinymce' . $iconfont . '_image" class="ts_vcsc_check_image' . (${'ts_vcsc_extend_settings_tinymce' . $iconfont . ''} == 1 ? " checked" : "") .'" style="" src=' . TS_VCSC_GetResourceURL('images/Font_' . $iconfont . '.jpg') . '>';
			foreach ($this->TS_VCSC_Author_Icon_Fonts as $Icon_Author => $iconauthor) {
			    if ($iconfont == $Icon_Author) {
				echo '<div class="ts_vcsc_extend_font_summary" style="margin-bottom: 10px;">Created by ' . $iconauthor . '</div>';
			    }
			};
			echo '<input type="hidden" name="ts_vcsc_extend_settings_tinymce' . $iconfont . '" value="0" />';
			echo '<input type="checkbox" data-load="ts_vcsc_extend_settings_load' . $iconfont . '" data-check="ts_vcsc_extend_settings_tinymceIconFont" name="ts_vcsc_extend_settings_tinymce' . $iconfont . '" id="ts_vcsc_extend_settings_tinymce' . $iconfont . '" class="validate[funcCall[checkIconFontSelect]] customRadioCheckFont ts_vcsc_extend_settings_font" data-error="Allowable Icon Fonts Selection" data-order="2" value="1" ' . (${'ts_vcsc_extend_settings_tinymce' . $iconfont . ''} == 1 ? ' checked="checked"' : '') . ' />';
			echo '<label style="font-weight: bold;" class="labelCheckBox" for="ts_vcsc_extend_settings_tinymce' . $iconfont . '">' . $Icon_Font . ' (' . $this->{'TS_VCSC_tinymce' . $iconfont . 'Count'} . ' Icons)<span title="If checked, the Plugin will include the ' . $Icon_Font . ' in the icons selection." class="' . $ToolTipClass .'"></span></label>';
			echo '<span class="ts_tiny_check_load ts_vcsc_extend_settings_load' . $iconfont . '_span" style="width: 100%; display: block; margin-top: 5px; margin-bottom: 10px; margin-left: 25px;">';
				echo '<input type="hidden" name="ts_vcsc_extend_settings_load' . $iconfont . '" value="0" />';
				echo '<input type="checkbox" data-font="ts_vcsc_extend_settings_tinymce' . $iconfont . '" name="ts_vcsc_extend_settings_load' . $iconfont . '" id="ts_vcsc_extend_settings_load' . $iconfont . '" class="customRadioCheckLoad ts_vcsc_extend_settings_load" value="1" ' . (${'ts_vcsc_extend_settings_load' . $iconfont . ''} == 1 ? ' checked="checked"' : '') . ' />';
				echo '<label style="font-weight: normal;" class="labelCheckBox" for="ts_vcsc_extend_settings_load' . $iconfont . '">Always Load ' . $Icon_Font . '<span title="If checked, the Plugin will always load css files for ' . $Icon_Font . '." class="' . $ToolTipClass .'"></span></label>';
			echo '</span>';
		    echo '</div>';
		} else {
		    if (get_option('ts_vcsc_extend_settings_tinymceCustomArray', '') != '') {
			$output = '';
			echo '<hr class="style-six" style="margin-top: 20px; margin-bottom: 20px; float: left; width: 100%;">';
			echo '<div class="ts_vcsc_extend_font_selector">';
			    echo '<img id="ts_vcsc_extend_settings_tinymce' . $iconfont . '_image" class="ts_vcsc_check_image' . (${'ts_vcsc_extend_settings_tinymce' . $iconfont . ''} == 1 ? " checked" : "") .'" style="" src=' . TS_VCSC_GetResourceURL('images/Font_' . $iconfont . '.jpg') . '>';
			    echo '<div class="ts_vcsc_extend_font_summary" style="margin-bottom: 10px;">Created by ' . get_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 'Custom User') . '</div>';
			    echo '<input type="hidden" name="ts_vcsc_extend_settings_tinymce' . $iconfont . '" value="0" />';
			    echo '<input type="checkbox" data-load="ts_vcsc_extend_settings_load' . $iconfont . '" data-check="ts_vcsc_extend_settings_tinymceIconFont" name="ts_vcsc_extend_settings_tinymce' . $iconfont . '" id="ts_vcsc_extend_settings_tinymce' . $iconfont . '" class="validate[funcCall[checkIconFontSelect]] customRadioCheckFont ts_vcsc_extend_settings_font" data-error="Allowable Icon Fonts Selection" data-order="2" value="1" ' . (${'ts_vcsc_extend_settings_tinymce' . $iconfont . ''} == 1 ? ' checked="checked"' : '') . ' />';
			    echo '<label style="font-weight: bold;" class="labelCheckBox" for="ts_vcsc_extend_settings_tinymce' . $iconfont . '">' . get_option('ts_vcsc_extend_settings_tinymceCustomName', 'Custom User Font') . ' (' . $this->{'TS_VCSC_tinymce' . $iconfont . 'Count'} . ' Icons)<span title="If checked, the Plugin will include the ' . get_option('ts_vcsc_extend_settings_tinymceCustomName', 'Custom User Font') . ' in the icons selection." class="' . $ToolTipClass .'"></span></label>';
			    echo '<span class="ts_tiny_check_load ts_vcsc_extend_settings_load' . $iconfont . '_span" style="width: 100%; display: block; margin-top: 5px; margin-bottom: 10px; margin-left: 25px;">';
				    echo '<input type="hidden" name="ts_vcsc_extend_settings_load' . $iconfont . '" value="0" />';
				    echo '<input type="checkbox" data-font="ts_vcsc_extend_settings_tinymce' . $iconfont . '" name="ts_vcsc_extend_settings_load' . $iconfont . '" id="ts_vcsc_extend_settings_load' . $iconfont . '" class="customRadioCheckLoad ts_vcsc_extend_settings_load" value="1" ' . (${'ts_vcsc_extend_settings_load' . $iconfont . ''} == 1 ? ' checked="checked"' : '') . ' />';
				    echo '<label style="font-weight: normal;" class="labelCheckBox" for="ts_vcsc_extend_settings_load' . $iconfont . '">Always Load ' . get_option('ts_vcsc_extend_settings_tinymceCustomName', 'Custom User Font') . '<span title="If checked, the Plugin will always load css files for ' . get_option('ts_vcsc_extend_settings_tinymceCustomName', 'Custom User Font') . '." class="' . $ToolTipClass .'"></span></label>';
			    echo '</span>';
			echo '</div>';
		    }
		}
	    };
	?>
    </div>
</div>
