<?php
	$output = '';
?>

<div id="ts-settings-generator" style="display: block;">
    <p>Here you can generate a preview of all items included per enabled Font</p>

    <hr class='style-six' style='margin-top: 20px;'>

	<div id="ts_vcsc_fonts_container" style="display: none;">
		<?php
			// Create Hidden List with all Icons per enabled Font
			foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
				if ((get_option('ts_vcsc_iconfonts_settings_tinymce' . $iconfont, 1) == 1) && ($iconfont != "Custom")){
					$output = '';
					$output .= '<div id="ts-vcsc-icons-' . strtolower($iconfont) . '" data-font="' . $Icon_Font . '" class="">';
						$icon_counter = 0;
						foreach ($this->{'TS_VCSC_List_Icons_' . $iconfont . ''} as $key => $option ) {
							$output .= '<div class="ts-vcsc-icon-preview" data-name="ts-' . $key . '" data-code="' . $option . '" data-font="' . strtolower($iconfont) . '" data-count="' . $icon_counter . '" rel="' . $key . '"><span class="ts-vcsc-icon-preview-icon"><i class="ts-' . $key . '"></i></span><span class="ts-vcsc-icon-preview-name">' . str_replace((strtolower($iconfont) . "-"), "", $key) . '</span></div>';
							$icon_counter = $icon_counter + 1;
						}
					$output .= '</div>';
					echo $output;
				} else if ((get_option('ts_vcsc_iconfonts_settings_tinymce' . $iconfont, 1) == 1) && ($iconfont == "Custom")){
					$output = '';
					$output .= '<div id="ts-vcsc-icons-' . strtolower($iconfont) . '" data-font="' . $Icon_Font . '" class="">';
						$icon_counter = 0;
						foreach ($this->{'TS_VCSC_List_Icons_' . $iconfont . ''} as $key => $option ) {
							$output .= '<div class="ts-vcsc-icon-preview" data-name="' . $key . '" data-code="' . $option . '" data-font="' . strtolower($iconfont) . '" data-count="' . $icon_counter . '" rel="' . $key . '"><span class="ts-vcsc-icon-preview-icon"><i class="' . $key . '"></i></span><span class="ts-vcsc-icon-preview-name">' . str_replace((strtolower($iconfont) . "-"), "", $key) . '</span></div>';
							$icon_counter = $icon_counter + 1;
						}
					$output .= '</div>';
					echo $output;
				}
			}
		?>
	</div>
	
	<div id="ts_vcsc_preview_container">
		<div style="width: 100%; display: inline-block; margin-bottom: 20px; border-bottom: 1px solid #DDDDDD; padding-bottom: 20px;">
			<div style="float: left; margin-right: 20px;">
				<img src="<?php echo TS_VCSC_GetResourceURL('images/Icon_Fonts_02.png'); ?>" style="width: 200px; height: 71px;">
			</div>
		
			<div style="float: left; width: 100%;">
				<button style="height:28px; <?php echo ($TS_VCSC_Active_Icon_Fonts > 1 ? "display: block;" : "display: none;"); ?>" type="button" value="Dropdown" data-dropdown="#dropdown-fonts" class="dropDownFont button-secondary">Switch Icon Font</button>
				<div id="dropdown-fonts" class="dropdown dropdown-anchor-left dropdown-tip dropdown-relative">
					<ul class="dropdown-menu">
						<?php
							$activeFonts = 0;
							foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
								if (get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 1) == 1) {
									if ($iconfont != "Custom") {
										$output = '';
										$activeFonts++;
										foreach ($this->TS_VCSC_Author_Icon_Fonts as $Font => $author) {
											if ($Font == $iconfont) {
												$output .= '<li class="ts-font-dropdown-item' . ($activeFonts == 1 ? " active" : "") . '" data-name="' . $Icon_Font . '" data-author="' . $author . '" data-count="' . $this->{'TS_VCSC_tinymce' . $iconfont . 'Count'} . '" data-code="' . strtolower($iconfont) . '" title="' . $Icon_Font . '"><a href="#">' . $Icon_Font . ' (' . $this->{'TS_VCSC_tinymce' . $iconfont . 'Count'} . ' Icons)</a></li>';
												break;
											}
										}
										if ($activeFonts < $this->TS_VCSC_Active_Icon_Fonts) {
											$output .= '<li class="dropdown-divider"></li>';
										}
									} else {
										$output = '';
										$activeFonts++;
										foreach ($this->TS_VCSC_Author_Icon_Fonts as $Font => $author) {
											if ($Font == $iconfont) {
												$output .= '<li class="ts-font-dropdown-item' . ($activeFonts == 1 ? " active" : "") . '" data-name="' . get_option('ts_vcsc_extend_settings_tinymceCustomName', 'Custom User Font') . ' (Upload)" data-author="' . get_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 'Custom User') . ' (Upload)" data-count="' . $this->{'TS_VCSC_tinymce' . $iconfont . 'Count'} . '" data-code="' . strtolower($iconfont) . '" title="' . $Icon_Font . '"><a href="#">' . $Icon_Font . ' (' . $this->{'TS_VCSC_tinymce' . $iconfont . 'Count'} . ' Icons)</a></li>';
												break;
											}
										}
										if ($activeFonts < $this->TS_VCSC_Active_Icon_Fonts) {
											$output .= '<li class="dropdown-divider"></li>';
										}
									}
									echo $output;
								}
							}
						?>
					</ul>
				</div>
			</div>

			<div id="ts-vcsc-extend-preview-syntax" style="width: 100%; display: inline-block; float: left; margin-top: 20px;">
				Click on an icon to view the full class name for that icon.
			</div>
			
			<div style="width: 100%; display: inline-block; float: left; margin-top: 20px;"><span style="float: left;">Icon Class Name:</span><span id="ts-vcsc-extend-preview-code">...</span></div>
		</div>


		<?php
			$output = '';
			$output .= '<div id="ts-vcsc-extend-preview" class="">';
				foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
					if (get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 1) == 1) {
						if ($iconfont != "Custom") {
							$output .= '<div id="ts-vcsc-extend-preview-name" class="">Font Name: ' . $Icon_Font . '</div>';
							foreach ($this->TS_VCSC_Author_Icon_Fonts as $Font => $author) {
								if ($Font == $iconfont) {
									$output .= '<div id="ts-vcsc-extend-preview-author" class="">Font Author: ' . $author . '</div>';
									break;
								}
							}
							$output .= '<div id="ts-vcsc-extend-preview-count" class="">Icon Count: ' . $this->{'TS_VCSC_tinymce' . $iconfont . 'Count'} . '</div>';
							break;
						} else {
							$output .= '<div id="ts-vcsc-extend-preview-name" class="">Font Name: ' . get_option('ts_vcsc_extend_settings_tinymceCustomName', 'Custom User Font') . ' (Upload)</div>';
							$output .= '<div id="ts-vcsc-extend-preview-author" class="">Font Author: ' . get_option('ts_vcsc_extend_settings_tinymceCustomAuthor', 'Custom User') . ' (Upload)</div>';
							$output .= '<div id="ts-vcsc-extend-preview-count" class="">Icon Count: ' . $this->{'TS_VCSC_tinymce' . $iconfont . 'Count'} . '</div>';
							break;
						}
					}
				}
				$output .= '<div id="ts-vcsc-extend-preview-divider" class=""></div>';
				$output .= '<div id="ts-vcsc-extend-preview-list" class="">';
					foreach ($this->TS_VCSC_Installed_Icon_Fonts as $Icon_Font => $iconfont) {
						if (get_option('ts_vcsc_extend_settings_tinymce' . $iconfont, 1) == 1) {
							if ($iconfont != "Custom") {
								$icon_counter = 0;
								foreach ($this->{'TS_VCSC_List_Icons_' . $iconfont . ''} as $key => $option ) {
									$output .= '<div class="ts-vcsc-icon-preview" data-name="ts-' . $key . '" data-code="' . $option . '" data-font="' . strtolower($iconfont) . '" data-count="' . $icon_counter . '" rel="' . $key . '"><span class="ts-vcsc-icon-preview-icon"><i class="ts-' . $key . '"></i></span><span class="ts-vcsc-icon-preview-name">' . str_replace((strtolower($iconfont) . "-"), "", $key) . '</span></div>';
									$icon_counter = $icon_counter + 1;
								}
								break;
							} else {
								$icon_counter = 0;
								foreach ($this->{'TS_VCSC_List_Icons_' . $iconfont . ''} as $key => $option ) {
									$output .= '<div class="ts-vcsc-icon-preview" data-name="' . $key . '" data-code="' . $option . '" data-font="' . strtolower($iconfont) . '" data-count="' . $icon_counter . '" rel="' . $key . '"><span class="ts-vcsc-icon-preview-icon"><i class="' . $key . '"></i></span><span class="ts-vcsc-icon-preview-name">' . str_replace((strtolower($iconfont) . "-"), "", $key) . '</span></div>';
									$icon_counter = $icon_counter + 1;
								}
								break;
							}
						}
					}
				$output .= '</div>';
			$output .= '</div>';
			echo $output;
		?>
	</div>
</div>
