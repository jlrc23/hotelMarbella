<?php
require_once(dirname(__FILE__) . '/config.inc.php');
global $fblb_db_version;
if (get_option("fblb_db_version") < $fblb_db_version)
{
	fblb_install_db();
}
global $FBLB_Presets;
if ((isset($_POST['Config']) || (isset($_GET['Preset']) && isset($_GET['submit']))))
{
	if (isset($_GET['Preset']) && isset($_GET['submit']))
	{
		$_POST = array_merge((array)$_POST,(array)fblb_get_options(),(array)$FBLB_Presets[$_GET['Preset']]['Options']);
	}
	$OptionsList=array(
	'DisableHome','DisableCategory','DisableArchive',
	'Behavior','MobileDevices','DisableByGetParamN','DisableByGetParamV',
	'Enable','Load','FacebookPageURL','Width','Height','ShowFaces','ShowStream','ForceWall','ShowHeader','Position','TabPosition','TabPositionPx','TabDesign','Border','BorderColor','BackgroundColor','Locale','ColorScheme','VPosition','VPositionPx','ZIndex',
	'TW_Enable','TW_Load','TW_ColorScheme','TW_Username','TW_Width','TW_Height','TW_ShowFollowButton','TW_Position','TW_TabPosition','TW_TabPositionPx','TW_TabDesign','TW_Border','TW_BorderColor','TW_ShellBackground','TW_ShellText','TW_TweetBackground','TW_TweetText','TW_Links','TW_VPosition','TW_VPositionPx','TW_ZIndex','TW_live','TW_behavior','TW_loop','TW_interval','TW_rpp','TW_Language',
	'GP_Enable','GP_Load','GP_PageID','GP_ShowFeed','GP_ShowBadge','GP_NumberofPosts','GP_Width','GP_Height','GP_Position','GP_TabPosition','GP_TabPositionPx','GP_TabDesign','GP_Border','GP_BorderColor','GP_BackgroundColor','GP_VPosition','GP_VPositionPx','GP_ZIndex','GP_Language',
	'YT_Enable','YT_Load','YT_Channel','YT_Stream','YT_StreamID','YT_ShowVideos','YT_NumberofVideos','YT_ShowBadge','YT_Position','YT_TabPosition','YT_TabPositionPx','YT_TabDesign','YT_Width','YT_Height','YT_Border','YT_BorderColor','YT_BackgroundColor','YT_VPosition','YT_VPositionPx','YT_ZIndex',
	'VI_Enable','VI_Profile','VI_Position','VI_TabPosition','VI_TabPositionPx','VI_TabDesign','VI_Width','VI_Height','VI_Border','VI_BorderColor','VI_BackgroundColor','VI_VPosition','VI_VPositionPx','VI_ZIndex','VI_ThumbnailSize','VI_NumberofVideos','VI_ShowTitles','VI_TitlesHeight','VI_TitlesColor','VI_TitlesColorHover','VI_Stream','VI_StreamID',
	'LI_Enable','LI_Load','LI_ShowPublicProfile','LI_ShowCompanyProfile','LI_PublicProfile','LI_CompanyID','LI_Order','LI_Position','LI_TabPosition','LI_TabPositionPx','LI_TabDesign','LI_Width','LI_Height','LI_Border','LI_BorderColor','LI_BackgroundColor','LI_VPosition','LI_VPositionPx','LI_ZIndex',
	'PI_Enable','PI_Username','PI_NumberofPosts','PI_Width','PI_Height','PI_Position','PI_TabPosition','PI_TabPositionPx','PI_TabDesign','PI_Border','PI_BorderColor','PI_BackgroundColor','PI_VPosition','PI_VPositionPx','PI_ZIndex',
    'INST_Enable','INST_client_id','INST_client_secret','INST_size','INST_access_token','INST_username','INST_picture','INST_hashtag','INST_fullname','INST_NumberofPosts','INST_Width','INST_Height','INST_Position','INST_TabPosition','INST_TabPositionPx','INST_TabDesign','INST_Border','INST_BorderColor','INST_BackgroundColor','INST_VPosition','INST_VPositionPx','INST_ZIndex'
	);
	foreach($OptionsList as $o)
	{
		if (isset($_POST[$o]))
		{
			$options[$o] = trim($_POST[$o]);
		}
	}
	if ($_POST['submit'] || $_GET['submit'])
	{
		update_option('FBLB_Options', $options);
		echo '
		<div id="setting-error-settings_updated" class="updated settings-error">
			<p><strong>Settings Saved</strong></p>
		</div>';
	}
}
if ($_GET['preview'] && $_GET['Preset'])
{
	if ($FBLB_Presets[$_GET['Preset']])
	{
		global $fblb_preview_options;
		$fblb_preview_options = fblb_get_options();
		if (!$fblb_preview_options['FacebookPageURL'])
			$fblb_preview_options['FacebookPageURL'] = 'http://www.facebook.com/facebook';
		if (!$fblb_preview_options['TW_Username'])
			$fblb_preview_options['TW_Username'] = '';
		if (!$fblb_preview_options['GP_PageID'])
			$fblb_preview_options['GP_PageID'] = '104629412415657030658';
		if (!$fblb_preview_options['YT_Channel'])
			$fblb_preview_options['YT_Channel'] = 'LadyGagaVEVO';
		if (!$fblb_preview_options['LI_PublicProfile'])
			$fblb_preview_options['LI_PublicProfile'] = 'http://www.linkedin.com/in/collis';
		if (!$fblb_preview_options['LI_CompanyID'])
			$fblb_preview_options['LI_CompanyID'] = '589883';
		if (!$fblb_preview_options['Locale'])
			$fblb_preview_options['Locale'] = 'en_US';
		if (!$fblb_preview_options['ZIndex'])
			$fblb_preview_options['ZIndex'] = 1000;
		if (!$fblb_preview_options['TW_ZIndex'])
			$fblb_preview_options['TW_ZIndex'] = 1000;
		if (!$fblb_preview_options['TW_Language'])
			$fblb_preview_options['TW_Language'] = 'en';
		if (!$fblb_preview_options['GP_ZIndex'])
			$fblb_preview_options['GP_ZIndex'] = 1000;
		if (!$fblb_preview_options['GP_Language'])
			$fblb_preview_options['GP_Language'] = 'en-US';
		$fblb_preview_options = array_merge((array) $fblb_preview_options, (array) $FBLB_Presets[$_GET['Preset']]['Options']);
		add_action('admin_footer', 'fblb_slider');
	}
}
if (isset($_POST['preview']) && isset($_POST['Config']))
{
	global $fblb_preview_options;
	$fblb_preview_options = $options;
	add_action('admin_footer', 'fblb_slider');
}
else
{
	$options = fblb_get_options();
}
$DefaultsList=array(
// Advanced
'Behavior' => 1,
'MobileDevices' => 1,
// Facebook
'Position' => 'Left',
'TabPosition' => 'Top',
'TabDesign' => 7,
'Width' => 300,
'Height' => 450,
'Border' => 5,
'BorderColor' => '#3b5998',
'BackgroundColor' => '#ffffff',
'ColorScheme' => 'light',
'VPosition' => 'Middle',
'Locale' => 'en_US',
'ZIndex' => 1000,
'Load' => 1,
// Twitter
'TW_Position' => 'Left',
'TW_TabPosition' => 'Middle',
'TW_TabDesign' => 7,
'TW_Width' => 300,
'TW_Height' => 450,
'TW_Border' => 5,
'TW_BorderColor' => '#33ccff',
'TW_ShellBackground' => '#33ccff',
'TW_ShellText' => '#ffffff',
'TW_TweetBackground' => '#ffffff',
'TW_TweetText' => '#000000',
'TW_Links' => '#47a61e',
'TW_VPosition' => 'Middle',
'TW_behavior' => 'all',
'TW_interval' => 30,
'TW_rpp' => 4,
'TW_ZIndex' => 1000,
'TW_Language' => 'en',
'TW_Load' => 1,
// Google Plus
'GP_Position' => 'Left',
'GP_TabPosition' => 'Bottom',
'GP_TabDesign' => 7,
'GP_Width' => 300,
'GP_Height' => 450,
'GP_Border' => 5,
'GP_BorderColor' => '#a8291b',
'GP_BackgroundColor' => '#ffffff',
'GP_VPosition' => 'Middle',
'GP_ZIndex' => 1000,
'GP_Language' => 'en-US',
'GP_NumberofPosts' => 10,
'GP_Load' => 1,
// YouTube
'YT_Position' => 'Left',
'YT_TabPosition' => 'Bottom',
'YT_TabDesign' => 7,
'YT_Width' => 300,
'YT_Height' => 450,
'YT_Border' => 5,
'YT_BorderColor' => '#9b9b9b',
'YT_BackgroundColor' => '#ffffff',
'YT_VPosition' => 'Middle',
'YT_ZIndex' => 1000,
'YT_Stream' => 'uploads',
'YT_NumberofVideos' => 10,
'YT_Load' => 1,
// Vimeo 
'VI_ThumbnailSize' => '80',
'VI_NumberofVideos' => '12',
'VI_Position' => 'Left',
'VI_TabPosition' => 'Bottom',
'VI_TabDesign' => 7,
'VI_Width' => 300,
'VI_Height' => 450,
'VI_Border' => 5,
'VI_BorderColor' => '#00aeef',
'VI_BackgroundColor' => '#ffffff',
'VI_VPosition' => 'Middle',
'VI_ZIndex' => 1000,
'VI_TitlesColor' => '#3A75C4',
'VI_TitlesColorHover' => '#00CCFF',
'VI_TitlesHeight' => '30',
'VI_Stream' => 'all',
// LinkedIn
'LI_Order' => 1,
'LI_Position' => 'Left',
'LI_TabPosition' => 'Bottom',
'LI_TabDesign' => 1,
'LI_Width' => 300,
'LI_Height' => 450,
'LI_Border' => 5,
'LI_BorderColor' => '#007fb1',
'LI_BackgroundColor' => '#ffffff',
'LI_VPosition' => 'Middle',
'LI_ZIndex' => 1000,
'LI_Load' => 1,
// Pinterest
'PI_Position' => 'Left',
'PI_TabPosition' => 'Bottom',
'PI_TabDesign' => 7,
'PI_Width' => 300,
'PI_Height' => 450,
'PI_Border' => 5,
'PI_BorderColor' => '#cb2027',
'PI_BackgroundColor' => '#ffffff',
'PI_VPosition' => 'Middle',
'PI_ZIndex' => 1000,
'PI_NumberofPosts' => 10,
// INSTAGRAM
'INST_Position' => 'Left',
'INST_TabPosition' => 'Bottom',
'INST_TabDesign' => 7,
'INST_Width' => 300,
'INST_Height' => 450,
'INST_Border' => 5,
'INST_BorderColor' => '#352820',
'INST_BackgroundColor' => '#ffffff',
'INST_VPosition' => 'Middle',
'INST_ZIndex' => 1000,
'INST_NumberofPosts' => 10,
);
foreach($DefaultsList as $k => $v)
{
	if (!$options[$k])
		$options[$k] = $v;
}
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2>Social Slider</h2>
	<br />
	<form id="SSForm" method="post" action="options-general.php?page=fblb">
		<input type="hidden" name="Config" value="1" />
		<div id="STabs">
			<ul>
				<li><a href="#STabsFb"><span class="ui-icon-my ui-icon-fb"></span></a></li>
				<li><a href="#STabsTw"><span class="ui-icon-my ui-icon-tw"></span></a></li>
				<li><a href="#STabsGp"><span class="ui-icon-my ui-icon-gp"></span></a></li>
				<li><a href="#STabsYt"><span class="ui-icon-my ui-icon-yt"></span></a></li>
				<li><a href="#STabsVi"><span class="ui-icon-my ui-icon-vi"></span></a></li>
				<li><a href="#STabsPi"><span class="ui-icon-my ui-icon-pi"></span></a></li>
				<li><a href="#STabsLi"><span class="ui-icon-my ui-icon-li"></span></a></li>
                <li><a href="#STabsIn"><span class="ui-icon-my ui-icon-inst"></span></a></li>
				<li><a href="#STabsAdw"><strong>Advanced</strong></a></li>
				<li style="float: right;"><a href="#STabsPresets"><strong>Settings Examples</strong></a></li>
			</ul>

			<div id="STabsFb">
				<h3>Facebook</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Enable</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Enable Likebox</span></legend>
									<label for="Enable">
										<input name="Enable" <?php echo ($options['Enable'] ? 'checked' : '' ) ?> type="checkbox" id="Enable" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="FacebookPageURL">Facebook Page URL</label></th>
							<td><input name="FacebookPageURL" type="text" id="FacebookPageURL" value="<?php echo  $options['FacebookPageURL'] ?>" class="regular-text" /></td>
						</tr>

						<tr valign="top">
							<th scope="row"><label for="Width">Width</label></th>
							<td><input name="Width" type="text" id="Width" value="<?php echo  $options['Width'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="Height">Height</label></th>
							<td><input name="Height" type="text" id="Height" value="<?php echo  $options['Height'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show faces</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show faces</span></legend>
									<label for="ShowFaces">
										<input name="ShowFaces" <?php echo  ($options['ShowFaces'] ? 'checked' : '' ) ?> type="checkbox" id="ShowFaces" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show stream</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show stream</span></legend>
									<label for="ShowStream">
										<input name="ShowStream" <?php echo  ($options['ShowStream'] ? 'checked' : '' ) ?> type="checkbox" id="ShowStream" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Force wall</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Force wall</span></legend>
									<label for="ForceWall">
										<input name="ForceWall" <?php echo  ($options['ForceWall'] ? 'checked' : '' ) ?> type="checkbox" id="ForceWall" value="1" />
									</label>
								</fieldset>
								(for Places, specifies whether the stream contains posts from the Place's wall or just checkins from friends)
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show header</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show header</span></legend>
									<label for="ShowHeader">
										<input name="ShowHeader" <?php echo  ($options['ShowHeader'] ? 'checked' : '' ) ?> type="checkbox" id="ShowHeader" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Position</th>
							<td> 
								<fieldset>
									<label for="PositionLeft">
										<input name="Position" <?php echo  ($options['Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="PositionLeft" value="Left" />
										left
									</label>
									<label for="PositionRight">
										<input name="Position" <?php echo  ($options['Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="PositionRight" value="Right" />
										right
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Vertical position</th>
							<td> 
								<fieldset>
									<label for="VPositionMiddle">
										<input name="VPosition" <?php echo  ($options['VPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="VPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="VPositionFixed">
										<input name="VPosition" <?php echo  ($options['VPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="VPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="VPositionPx" type="text" id="VPositionPx" value="<?php echo  $options['VPositionPx'] ?>" class="small-text" /> px from top
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button position</th>
							<td> 
								<fieldset>
									<label for="TabPositionTop">
										<input name="TabPosition" <?php echo  ($options['TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="TabPositionTop" value="Top" />
										top
									</label>
									<label for="TabPositionMiddle">
										<input name="TabPosition" <?php echo  ($options['TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="TabPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="TabPositionBottom">
										<input name="TabPosition" <?php echo  ($options['TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="TabPositionBottom" value="Bottom" />
										bottom
									</label>
									<label for="TabPositionFixed">
										<input name="TabPosition" <?php echo  ($options['TabPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="TabPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="TabPositionPx" type="text" id="TabPositionPx" value="<?php echo  $options['TabPositionPx'] ?>" class="small-text" /> px from top of slider
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button design</th>
							<td> 
								<fieldset>
									<label for="TabDesign1">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="TabDesign1" value="1" />
										<img src="<?php echo  plugins_url('/img/fb1-left.png', __FILE__) ?>" />
									</label>
									<label for="TabDesign2">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 2 ? 'checked' : '' ) ?> type="radio" id="TabDesign2" value="2" />
										<img src="<?php echo  plugins_url('/img/fb2-left.png', __FILE__) ?>" />
									</label>
									<label for="TabDesign3">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="TabDesign3" value="3" />
										<img src="<?php echo  plugins_url('/img/fb3-left.png', __FILE__) ?>" />
									</label>
									<label for="TabDesign4">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 4 ? 'checked' : '' ) ?> type="radio" id="TabDesign4" value="4" />
										<img src="<?php echo  plugins_url('/img/fb4-left.png', __FILE__) ?>" />
									</label>
									<label for="TabDesign5">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 5 ? 'checked' : '' ) ?> type="radio" id="TabDesign5" value="5" />
										<img src="<?php echo  plugins_url('/img/fb5-left.png', __FILE__) ?>" />
									</label>
									<label for="TabDesign6">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 6 ? 'checked' : '' ) ?> type="radio" id="TabDesign6" value="6" />
										<img src="<?php echo  plugins_url('/img/fb6-left.png', __FILE__) ?>" />
									</label>

									<label for="TabDesign7">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 7 ? 'checked' : '' ) ?> type="radio" id="TabDesign7" value="7" />
										<img src="<?php echo  plugins_url('/img/fb7-left.png', __FILE__) ?>" />
									</label>
									<label for="TabDesign8">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 8 ? 'checked' : '' ) ?> type="radio" id="TabDesign8" value="8" />
										<img src="<?php echo  plugins_url('/img/fb8-left.png', __FILE__) ?>" />
									</label>
									<label for="TabDesign9">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 9 ? 'checked' : '' ) ?> type="radio" id="TabDesign9" value="9" />
										<img src="<?php echo  plugins_url('/img/fb9-left.png', __FILE__) ?>" />
									</label>
									<label for="TabDesign11">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 11 ? 'checked' : '' ) ?> type="radio" id="TabDesign11" value="11" />
										<img src="<?php echo  plugins_url('/img/fb11-left.png', __FILE__) ?>" />
									</label>
									<label for="TabDesign12">
										<input name="TabDesign" <?php echo  ($options['TabDesign'] == 12 ? 'checked' : '' ) ?> type="radio" id="TabDesign12" value="12" />
										<img src="<?php echo  plugins_url('/img/fb12-left.png', __FILE__) ?>" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="Border">Border width</label></th>
							<td><input name="Border" type="text" id="Border" value="<?php echo  $options['Border'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="BorderColor">Border color</label></th>
							<td>
								<input maxlength="7" name="BorderColor" type="text" id="BorderColor" value="<?php echo  $options['BorderColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #3b5998)
								<div id="BorderColorPreview" style="background-color: <?php echo  $options['BorderColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="BackgroundColor">Background color</label></th>
							<td>
								<input maxlength="7" name="BackgroundColor" type="text" id="BackgroundColor" value="<?php echo  $options['BackgroundColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #ffffff for light color scheme, #333333 for dark color scheme)
								<div id="BackgroundColorPreview" style="background-color: <?php echo  $options['BackgroundColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Color Scheme</th>
							<td> 
								<fieldset>
									<label for="ColorSchemelight">
										<input name="ColorScheme" <?php echo  ($options['ColorScheme'] == 'light' ? 'checked' : '' ) ?> type="radio" id="ColorSchemelight" value="light" />
										light
									</label>
									<label for="ColorSchemedark">
										<input name="ColorScheme" <?php echo  ($options['ColorScheme'] == 'dark' ? 'checked' : '' ) ?> type="radio" id="ColorSchemedark" value="dark" />
										dark
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Load widget</th>
							<td> 
								<fieldset>
									<label for="Load1">
										<input name="Load" <?php echo  ($options['Load'] == 1 ? 'checked' : '' ) ?> type="radio" id="Load1" value="1" />
										on page load
									</label>
									<label for="Load2">
										<input name="Load" <?php echo  ($options['Load'] == 2 ? 'checked' : '' ) ?> type="radio" id="Load2" value="2" />
										on slideout
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="ZIndex">CSS z-index</label></th>
							<td><input name="ZIndex" type="text" id="ZIndex" value="<?php echo  $options['ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="Locale">Locale</label></th>
							<td>
								<select name="Locale" id="Locale">
								<?php
								foreach ($FB_Locales as $k => $v)
								{
									echo '<option ' . ($options['Locale'] == $k ? 'selected' : '') . ' value="' . $k . '">' . $v . '</option>';
								}
								?>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="STabsTw">
				<h3>Twitter</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Enable</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Enable</span></legend>
									<label for="TW_Enable">
										<input name="TW_Enable" <?php echo  ($options['TW_Enable'] ? 'checked' : '' ) ?> type="checkbox" id="TW_Enable" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_Username">Twitter Widget ID</label></th>
							<td><input name="TW_Username" type="text" id="TW_Username" value="<?php echo  $options['TW_Username'] ?>" class="regular-text" />
							    <a href="http://www.youtube.com/watch?v=Ypsib-Nx4VQ" target="_blank">How to get Twitter Widget ID</a>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_Width">Width</label></th>
							<td><input name="TW_Width" type="text" id="TW_Width" value="<?php echo  $options['TW_Width'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_Height">Height</label></th>
							<td><input name="TW_Height" type="text" id="TW_Height" value="<?php echo  $options['TW_Height'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row">Position</th>
							<td> 
								<fieldset>
									<label for="TW_PositionLeft">
										<input name="TW_Position" <?php echo  ($options['TW_Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="TW_PositionLeft" value="Left" />
										left
									</label>
									<label for="TW_PositionRight">
										<input name="TW_Position" <?php echo  ($options['TW_Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="TW_PositionRight" value="Right" />
										right
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Vertical position</th>
							<td> 
								<fieldset>
									<label for="TW_VPositionMiddle">
										<input name="TW_VPosition" <?php echo  ($options['TW_VPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="TW_VPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="TW_VPositionFixed">
										<input name="TW_VPosition" <?php echo  ($options['TW_VPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="TW_VPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="TW_VPositionPx" type="text" id="TW_VPositionPx" value="<?php echo  $options['TW_VPositionPx'] ?>" class="small-text" /> px from top
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button position</th>
							<td> 
								<fieldset>
									<label for="TW_TabPositionTop">
										<input name="TW_TabPosition" <?php echo  ($options['TW_TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="TW_TabPositionTop" value="Top" />
										top
									</label>
									<label for="TW_TabPositionMiddle">
										<input name="TW_TabPosition" <?php echo  ($options['TW_TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="TW_TabPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="TW_TabPositionBottom">
										<input name="TW_TabPosition" <?php echo  ($options['TW_TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="TW_TabPositionBottom" value="Bottom" />
										bottom
									</label>
									<label for="TW_TabPositionFixed">
										<input name="TW_TabPosition" <?php echo  ($options['TW_TabPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="TW_TabPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="TW_TabPositionPx" type="text" id="TW_TabPositionPx" value="<?php echo  $options['TW_TabPositionPx'] ?>" class="small-text" /> px from top of slider
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button design</th>
							<td> 
								<fieldset>
									<label for="TW_TabDesign1">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign1" value="1" />
										<img src="<?php echo  plugins_url('/img/tw1-left.png', __FILE__) ?>" />
									</label>
									<label for="TW_TabDesign2">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 2 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign2" value="2" />
										<img src="<?php echo  plugins_url('/img/tw2-left.png', __FILE__) ?>" />
									</label>
									<label for="TW_TabDesign3">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign3" value="3" />
										<img src="<?php echo  plugins_url('/img/tw3-left.png', __FILE__) ?>" />
									</label>
									<label for="TW_TabDesign7">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 7 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign7" value="7" />
										<img src="<?php echo  plugins_url('/img/tw7-left.png', __FILE__) ?>" />
									</label>
									<label for="TW_TabDesign8">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 8 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign8" value="8" />
										<img src="<?php echo  plugins_url('/img/tw8-left.png', __FILE__) ?>" />
									</label>
									<label for="TW_TabDesign9">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 9 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign9" value="9" />
										<img src="<?php echo  plugins_url('/img/tw9-left.png', __FILE__) ?>" />
									</label>
									<label for="TW_TabDesign11">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 11 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign11" value="11" />
										<img src="<?php echo  plugins_url('/img/tw11-left.png', __FILE__) ?>" />
									</label>
									<label for="TW_TabDesign12">
										<input name="TW_TabDesign" <?php echo  ($options['TW_TabDesign'] == 12 ? 'checked' : '' ) ?> type="radio" id="TW_TabDesign12" value="12" />
										<img src="<?php echo  plugins_url('/img/tw12-left.png', __FILE__) ?>" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Color Scheme</th>
							<td> 
								<fieldset>
									<label for="TW_ColorSchemelight">
										<input name="TW_ColorScheme" <?php echo  ($options['TW_ColorScheme'] == 'light' ? 'checked' : '' ) ?> type="radio" id="TW_ColorSchemelight" value="light" />
										light
									</label>
									<label for="TW_ColorSchemedark">
										<input name="TW_ColorScheme" <?php echo  ($options['TW_ColorScheme'] == 'dark' ? 'checked' : '' ) ?> type="radio" id="TW_ColorSchemedark" value="dark" />
										dark
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_Border">Border width</label></th>
							<td><input name="TW_Border" type="text" id="TW_Border" value="<?php echo  $options['TW_Border'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_BorderColor">Border color</label></th>
							<td>
								<input maxlength="7" name="TW_BorderColor" type="text" id="TW_BorderColor" value="<?php echo  $options['TW_BorderColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #33ccff)
								<div id="TW_BorderColorPreview" style="background-color: <?php echo  $options['TW_BorderColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="TW_Links">Links color</label></th>
							<td>
								<input maxlength="7" name="TW_Links" type="text" id="TW_Links" value="<?php echo  $options['TW_Links'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #47a61e)
								<div id="TW_LinksPreview" style="background-color: <?php echo  $options['TW_Links'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>		
						<tr valign="top">
							<th scope="row"><label for="TW_ZIndex">CSS z-index</label></th>
							<td><input name="TW_ZIndex" type="text" id="TW_ZIndex" value="<?php echo  $options['TW_ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="STabsGp">
				<h3>Google Plus</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Enable</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Enable</span></legend>
									<label for="GP_Enable">
										<input name="GP_Enable" <?php echo  ($options['GP_Enable'] ? 'checked' : '' ) ?> type="checkbox" id="GP_Enable" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_PageID">Google+ Page ID</label></th>
							<td>
								<input name="GP_PageID" maxlength="30" type="text" id="GP_PageID" value="<?php echo  $options['GP_PageID'] ?>" class="regular-text" /> 
								<?php
								echo '<input class="button-primary" type="button" onclick="window.open(\''. plugins_url('', __FILE__) . '/cron.php\');" value="RELOAD POSTS">';
								?>
								<br />
								<b>ID of Google Plus Page (like Facebook fanpage) not Private Profile</b>
								<br />
								(ex: 104629412415657030658 get from https://plus.google.com/<strong>104629412415657030658</strong>/posts)
								
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_Width">Width</label></th>
							<td><input name="GP_Width" type="text" id="GP_Width" value="<?php echo  $options['GP_Width'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_Height">Height</label></th>
							<td><input name="GP_Height" type="text" id="GP_Height" value="<?php echo  $options['GP_Height'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show badge</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show badge</span></legend>
									<label for="GP_ShowBadge">
										<input name="GP_ShowBadge" <?php echo  ($options['GP_ShowBadge'] ? 'checked' : '' ) ?> type="checkbox" id="GP_ShowBadge" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show feed</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show feed</span></legend>
									<label for="GP_ShowFeed">
										<input name="GP_ShowFeed" <?php echo  ($options['GP_ShowFeed'] ? 'checked' : '' ) ?> type="checkbox" id="GP_ShowFeed" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_NumberofPosts">Number of posts</label></th>
							<td>
								<input name="GP_NumberofPosts" type="text" id="GP_NumberofPosts" value="<?php echo  $options['GP_NumberofPosts'] ?>" class="small-text" />
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row">Position</th>
							<td> 
								<fieldset>
									<label for="GP_PositionLeft">
										<input name="GP_Position" <?php echo  ($options['GP_Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="GP_PositionLeft" value="Left" />
										left
									</label>
									<label for="GP_PositionRight">
										<input name="GP_Position" <?php echo  ($options['GP_Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="GP_PositionRight" value="Right" />
										right
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Vertical position</th>
							<td> 
								<fieldset>
									<label for="GP_VPositionMiddle">
										<input name="GP_VPosition" <?php echo  ($options['GP_VPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="GP_VPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="GP_VPositionFixed">
										<input name="GP_VPosition" <?php echo  ($options['GP_VPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="GP_VPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="GP_VPositionPx" type="text" id="GP_VPositionPx" value="<?php echo  $options['GP_VPositionPx'] ?>" class="small-text" /> px from top
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button position</th>
							<td> 
								<fieldset>
									<label for="GP_TabPositionTop">
										<input name="GP_TabPosition" <?php echo  ($options['GP_TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="GP_TabPositionTop" value="Top" />
										top
									</label>
									<label for="GP_TabPositionMiddle">
										<input name="GP_TabPosition" <?php echo  ($options['GP_TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="GP_TabPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="GP_TabPositionBottom">
										<input name="GP_TabPosition" <?php echo  ($options['GP_TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="GP_TabPositionBottom" value="Bottom" />
										bottom
									</label>
									<label for="GP_TabPositionFixed">
										<input name="GP_TabPosition" <?php echo  ($options['GP_TabPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="GP_TabPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="GP_TabPositionPx" type="text" id="GP_TabPositionPx" value="<?php echo  $options['GP_TabPositionPx'] ?>" class="small-text" /> px from top of slider
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button design</th>
							<td> 
								<fieldset>
									<label for="GP_TabDesign1">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign1" value="1" />
										<img src="<?php echo  plugins_url('/img/gp1-left.png', __FILE__) ?>" />
									</label>
									<label for="GP_TabDesign2">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 2 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign2" value="2" />
										<img src="<?php echo  plugins_url('/img/gp2-left.png', __FILE__) ?>" />
									</label>
									<label for="GP_TabDesign3">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign3" value="3" />
										<img src="<?php echo  plugins_url('/img/gp3-left.png', __FILE__) ?>" />
									</label>

									<label for="GP_TabDesign7">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 7 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign7" value="7" />
										<img src="<?php echo  plugins_url('/img/gp7-left.png', __FILE__) ?>" />
									</label>
									<label for="GP_TabDesign8">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 8 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign8" value="8" />
										<img src="<?php echo  plugins_url('/img/gp8-left.png', __FILE__) ?>" />
									</label>
									<label for="GP_TabDesign9">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 9 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign9" value="9" />
										<img src="<?php echo plugins_url('/img/gp9-left.png', __FILE__) ?>" />
									</label>
									
									<label for="GP_TabDesign11">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 11 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign11" value="11" />
										<img src="<?php echo plugins_url('/img/gp11-left.png', __FILE__) ?>" />
									</label>
									<label for="GP_TabDesign12">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 12 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign12" value="12" />
										<img src="<?php echo plugins_url('/img/gp12-left.png', __FILE__) ?>" />
									</label>
									<label for="GP_TabDesign13">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 13 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign13" value="13" />
										<img src="<?php echo plugins_url('/img/gp13-left.png', __FILE__) ?>" />
									</label>
									<label for="GP_TabDesign14">
										<input name="GP_TabDesign" <?php echo  ($options['GP_TabDesign'] == 14 ? 'checked' : '' ) ?> type="radio" id="GP_TabDesign14" value="14" />
										<img src="<?php echo plugins_url('/img/gp14-left.png', __FILE__) ?>" />
									</label>

								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_Border">Border width</label></th>
							<td><input name="GP_Border" type="text" id="GP_Border" value="<?php echo  $options['GP_Border'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_BorderColor">Border color</label></th>
							<td>
								<input maxlength="7" name="GP_BorderColor" type="text" id="GP_BorderColor" value="<?php echo  $options['GP_BorderColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #a8291b)
								<div id="GP_BorderColorPreview" style="background-color: <?php echo  $options['GP_BorderColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_BackgroundColor">Background color</label></th>
							<td>
								<input maxlength="7" name="GP_BackgroundColor" type="text" id="GP_BackgroundColor" value="<?php echo  $options['GP_BackgroundColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #ffffff)
								<div id="GP_BackgroundColorPreview" style="background-color: <?php echo  $options['GP_BackgroundColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Load widget</th>
							<td> 
								<fieldset>
									<label for="GP_Load1">
										<input name="GP_Load" <?php echo  ($options['GP_Load'] == 1 ? 'checked' : '' ) ?> type="radio" id="GP_Load1" value="1" />
										on page load
									</label>
									<label for="GP_Load2">
										<input name="GP_Load" <?php echo  ($options['GP_Load'] == 2 ? 'checked' : '' ) ?> type="radio" id="GP_Load2" value="2" />
										on slideout
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_ZIndex">CSS z-index</label></th>
							<td><input name="GP_ZIndex" type="text" id="GP_ZIndex" value="<?php echo  $options['GP_ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="GP_Language">Language</label></th>
							<td>
								<select name="GP_Language" id="GP_Language">
								<?php
								foreach ($GP_Languages as $k => $v)
								{
									echo '<option ' . ($options['GP_Language'] == $k ? 'selected' : '') . ' value="' . $k . '">' . $v . '</option>';
								}
								?>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			
			<div id="STabsYt">
				<h3>YouTube</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Enable</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Enable</span></legend>
									<label for="YT_Enable">
										<input name="YT_Enable" <?php echo  ($options['YT_Enable'] ? 'checked' : '' ) ?> type="checkbox" id="YT_Enable" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_Channel">Channel</label></th>
							<td>
								<input name="YT_Channel" type="text" id="YT_Channel" value="<?php echo  $options['YT_Channel'] ?>" class="regular-text" />
								(ex: LadyGagaVEVO)
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_Width">Width</label></th>
							<td><input name="YT_Width" type="text" id="YT_Width" value="<?php echo  $options['YT_Width'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_Height">Height</label></th>
							<td><input name="YT_Height" type="text" id="YT_Height" value="<?php echo  $options['YT_Height'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show badge</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show badge</span></legend>
									<label for="YT_ShowBadge">
										<input name="YT_ShowBadge" <?php echo  ($options['YT_ShowBadge'] ? 'checked' : '' ) ?> type="checkbox" id="YT_ShowBadge" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show videos</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show Videos</span></legend>
									<label for="YT_ShowVideos">
										<input name="YT_ShowVideos" <?php echo  ($options['YT_ShowVideos'] ? 'checked' : '' ) ?> type="checkbox" id="YT_ShowVideos" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_NumberofVideos">Number of videos</label></th>
							<td>
								<input name="YT_NumberofVideos" type="text" id="YT_NumberofVideos" value="<?php echo  $options['YT_NumberofVideos'] ?>" class="small-text" /> (max: 50)
							</td>
						</tr>	
						<tr valign="top">
							<th scope="row">Video stream</th>
							<td> 
								<fieldset>
									<label for="YT_Streamuploads">
										<input name="YT_Stream" <?php echo  ($options['YT_Stream'] == 'uploads' ? 'checked' : '' ) ?> type="radio" id="YT_Streamuploads" value="uploads" />
										Uploads
									</label>
									<br />
									<label for="YT_Streamfavorites">
										<input name="YT_Stream" <?php echo  ($options['YT_Stream'] == 'favorites' ? 'checked' : '' ) ?> type="radio" id="YT_Streamfavorites" value="favorites" />
										Favorites
									</label>
									<br />
									<label for="YT_Streamplaylist">
										<input name="YT_Stream" <?php echo  ($options['YT_Stream'] == 'playlist' ? 'checked' : '' ) ?> type="radio" id="YT_Streamplaylist" value="playlist" />
										Playlist
									</label>
								</fieldset>
								<div id="YT_PlaylistsDiv" style="display: none; width: 400px;">
									Playlist ID:<input name="YT_StreamID" type="text" id="YT_StreamID" value="<?php echo  $options['YT_StreamID'] ?>" class="medium-text" />
									<input type="button" value="Fetch playlists" onclick="fblb_fetchPlaylists(jQuery('#YT_Channel').val())" />
									<br />
									<ul id="YT_PlaylistsUl" class="fblbList" style="max-height: 300px; overflow: auto;">
										<li>Please insert "Channel" and click "Fetch playlists".</li>
									</ul>
								</div>
								<script type="text/javascript">
									function __fblb_YTGetPlaylists(data) 
									{
										jQuery('#YT_PlaylistsUl').html('');
										jQuery.each(data.feed.entry, function(i,e) {
											jQuery('#YT_PlaylistsUl').append('<li>' +
											'<a href="javascript:fblb_selectPlaylist(\'' + e.yt$playlistId.$t +'\');" class="fblbtitle">' + (i+1) +'. '+ e.title.$t + ' (' + e.yt$playlistId.$t +') ' + (e.yt$playlistId.$t == jQuery('#YT_StreamID').val() ? '(SELECTED)': '') +'</a>' +
											'</li>');
										});
									}
									function fblb_selectPlaylist(YT_StreamID)
									{
										if(!YT_StreamID)
										{
											return false;
										}
										jQuery('#YT_StreamID').val(YT_StreamID);
										return false;
									}
									function fblb_fetchPlaylists(YT_Channel)
									{
										if(!YT_Channel)
										{
											return false;
										}
										jQuery('#YT_PlaylistsUl').html('<li>Loading...</li>');
										jQuery.getScript("http://gdata.youtube.com/feeds/users/"+YT_Channel+"/playlists?alt=json-in-script&max-results=50&format=5&callback=__fblb_YTGetPlaylists");
									}
									function fblb_showPlaylists()
									{
										if(jQuery('#YT_Streamplaylist').attr('checked'))
										{
											fblb_fetchPlaylists(jQuery('#YT_Channel').val());
											jQuery('#YT_PlaylistsDiv').show();
										}
										else
										{
											jQuery('#YT_PlaylistsDiv').hide();
										}
									}
									jQuery(function(){
										fblb_showPlaylists();
									});
									jQuery('#YT_Streamuploads, #YT_Streamfavorites, #YT_Streamplaylist').click(function(){
										fblb_showPlaylists();
									});
								</script>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Position</th>
							<td> 
								<fieldset>
									<label for="YT_PositionLeft">
										<input name="YT_Position" <?php echo  ($options['YT_Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="YT_PositionLeft" value="Left" />
										left
									</label>
									<label for="YT_PositionRight">
										<input name="YT_Position" <?php echo  ($options['YT_Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="YT_PositionRight" value="Right" />
										right
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Vertical position</th>
							<td> 
								<fieldset>
									<label for="YT_VPositionMiddle">
										<input name="YT_VPosition" <?php echo  ($options['YT_VPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="YT_VPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="YT_VPositionFixed">
										<input name="YT_VPosition" <?php echo  ($options['YT_VPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="YT_VPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="YT_VPositionPx" type="text" id="YT_VPositionPx" value="<?php echo  $options['YT_VPositionPx'] ?>" class="small-text" /> px from top
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button position</th>
							<td> 
								<fieldset>
									<label for="YT_TabPositionTop">
										<input name="YT_TabPosition" <?php echo  ($options['YT_TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="YT_TabPositionTop" value="Top" />
										top
									</label>
									<label for="YT_TabPositionMiddle">
										<input name="YT_TabPosition" <?php echo  ($options['YT_TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="YT_TabPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="YT_TabPositionBottom">
										<input name="YT_TabPosition" <?php echo  ($options['YT_TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="YT_TabPositionBottom" value="Bottom" />
										bottom
									</label>
									<label for="YT_TabPositionFixed">
										<input name="YT_TabPosition" <?php echo  ($options['YT_TabPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="YT_TabPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="YT_TabPositionPx" type="text" id="YT_TabPositionPx" value="<?php echo  $options['YT_TabPositionPx'] ?>" class="small-text" /> px from top of slider
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button design</th>
							<td> 
								<fieldset>
									<label for="YT_TabDesign1">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign1" value="1" />
										<img src="<?php echo  plugins_url('/img/yt1-left.png', __FILE__) ?>" />
									</label>
									<?php /*
									<label for="YT_TabDesign2">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 2 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign2" value="2" />
										<img src="<?php echo  plugins_url('/img/yt2-left.png', __FILE__) ?>" />
									</label>*/?>
									<label for="YT_TabDesign3">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign3" value="3" />
										<img src="<?php echo  plugins_url('/img/yt3-left.png', __FILE__) ?>" />
									</label>

									<label for="YT_TabDesign7">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 7 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign7" value="7" />
										<img src="<?php echo  plugins_url('/img/yt7-left.png', __FILE__) ?>" />
									</label>
									<?php /*
									<label for="YT_TabDesign8">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 8 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign8" value="8" />
										<img src="<?php echo  plugins_url('/img/yt8-left.png', __FILE__) ?>" />
									</label> */?>
									<label for="YT_TabDesign9">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 9 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign9" value="9" />
										<img src="<?php echo plugins_url('/img/yt9-left.png', __FILE__) ?>" />
									</label>

									<label for="YT_TabDesign11">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 11 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign11" value="11" />
										<img src="<?php echo plugins_url('/img/yt11-left.png', __FILE__) ?>" />
									</label>
									<label for="YT_TabDesign12">
										<input name="YT_TabDesign" <?php echo  ($options['YT_TabDesign'] == 12 ? 'checked' : '' ) ?> type="radio" id="YT_TabDesign12" value="12" />
										<img src="<?php echo plugins_url('/img/yt12-left.png', __FILE__) ?>" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_Border">Border width</label></th>
							<td><input name="YT_Border" type="text" id="YT_Border" value="<?php echo  $options['YT_Border'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_BorderColor">Border color</label></th>
							<td>
								<input maxlength="7" name="YT_BorderColor" type="text" id="YT_BorderColor" value="<?php echo  $options['YT_BorderColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #e0e0e0)
								<div id="YT_BorderColorPreview" style="background-color: <?php echo  $options['YT_BorderColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_BackgroundColor">Background color</label></th>
							<td>
								<input maxlength="7" name="YT_BackgroundColor" type="text" id="YT_BackgroundColor" value="<?php echo  $options['YT_BackgroundColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #000000)
								<div id="YT_BackgroundColorPreview" style="background-color: <?php echo  $options['YT_BackgroundColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Load widget</th>
							<td> 
								<fieldset>
									<label for="YT_Load1">
										<input name="YT_Load" <?php echo  ($options['YT_Load'] == 1 ? 'checked' : '' ) ?> type="radio" id="YT_Load1" value="1" />
										on page load
									</label>
									<label for="YT_Load2">
										<input name="YT_Load" <?php echo  ($options['YT_Load'] == 2 ? 'checked' : '' ) ?> type="radio" id="YT_Load2" value="2" />
										on slideout
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="YT_ZIndex">CSS z-index</label></th>
							<td><input name="YT_ZIndex" type="text" id="YT_ZIndex" value="<?php echo  $options['YT_ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			
			<div id="STabsVi">
				<h3>Vimeo</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Enable</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Enable</span></legend>
									<label for="VI_Enable">
										<input name="VI_Enable" <?php echo  ($options['VI_Enable'] ? 'checked' : '' ) ?> type="checkbox" id="VI_Enable" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="VI_Profile">Profile page URL:</label></th>
							<td>
								vimeo.com/<input name="VI_Profile" type="text" id="VI_Channel" value="<?php echo  $options['VI_Profile'] ?>" class="regular-text" />
							</td>
						</tr>	
						<tr valign="top">
							<th scope="row"><label for="VI_Width">Width</label></th>
							<td><input name="VI_Width" type="text" id="VI_Width" value="<?php echo  $options['VI_Width'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="VI_Height">Height</label></th>
							<td><input name="VI_Height" type="text" id="VI_Height" value="<?php echo  $options['VI_Height'] ?>" class="small-text" /> px</td>
						</tr>			
						
						<tr valign="top">
							<th scope="row">Video stream</th>
							<td> 
								<fieldset>
									<label for="VI_Streamuploaded">
										<input name="VI_Stream" <?php echo  ($options['VI_Stream'] == 'uploaded' ? 'checked' : '' ) ?> type="radio" id="VI_Streamuploaded" value="uploaded" />
										My videos (uploaded videos only)
									</label>
									<br />
									<label for="VI_Streamall">
										<input name="VI_Stream" <?php echo  ($options['VI_Stream'] == 'all' ? 'checked' : '' ) ?> type="radio" id="VI_Streamall" value="all" />
										My videos
									</label>
									<br />
									<label for="VI_Streamchannel">
										<input name="VI_Stream" <?php echo  ($options['VI_Stream'] == 'channel' ? 'checked' : '' ) ?> type="radio" id="VI_Streamchannel" value="channel" />
										My channels
									</label>
									<br />
									<label for="VI_Streamalbum">
										<input name="VI_Stream" <?php echo  ($options['VI_Stream'] == 'album' ? 'checked' : '' ) ?> type="radio" id="VI_Streamalbum" value="album" />
										My albums
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="VI_StreamID">Stream ID (only for channels or albums):</label></th>
							<td>
								<input name="VI_StreamID" type="text" id="VI_Channel" value="<?php echo  $options['VI_StreamID'] ?>" class="regular-text" />
							</td>
						</tr>	
						<tr valign="top">
							<th scope="row"><label for="VI_NumberofVideos">Number of videos</label></th>
							<td><input name="VI_NumberofVideos" type="text" id="VI_NumberofVideos" value="<?php echo  $options['VI_NumberofVideos'] ?>" class="small-text" /></td>
						</tr>	
						<tr valign="top">
							<th scope="row">Show video titles</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show video titles</span></legend>
									<label for="VI_ShowTitles">
										<input name="VI_ShowTitles" <?php echo  ($options['VI_ShowTitles'] ? 'checked' : '' ) ?> type="checkbox" id="VI_ShowTitles" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="VI_TitlesColor">Titles color</label></th>
							<td>
								<input maxlength="7" name="VI_TitlesColor" type="text" id="VI_TitlesColor" value="<?php echo  $options['VI_TitlesColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #3a75c4)
								<div id="VI_TitlesColorPreview" style="background-color: <?php echo  $options['VI_TitlesColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="VI_TitlesColorHover">Titles color hover</label></th>
							<td>
								<input maxlength="7" name="VI_TitlesColorHover" type="text" id="VI_TitlesColorHover" value="<?php echo  $options['VI_TitlesColorHover'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #00ccff)
								<div id="VI_TitlesColorHoverPreview" style="background-color: <?php echo  $options['VI_TitlesColorHover'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><label for="VI_TitlesHeight">Titles height</label></th>
							<td><input name="VI_TitlesHeight" type="text" id="VI_TitlesHeight" value="<?php echo  $options['VI_TitlesHeight'] ?>" class="small-text" /> px (default: 30)</td>
						</tr>			
						
						<tr valign="top">
							<th scope="row">Thumbnail size</th>
							<td> 
								<fieldset>
									<label for="VI_ThumbnailSize80">
										<input name="VI_ThumbnailSize" <?php echo  ($options['VI_ThumbnailSize'] == 80 ? 'checked' : '' ) ?> type="radio" id="VI_ThumbnailSize80" value="80" />
										Small (80 x 60)
									</label>
									<label for="VI_ThumbnailSize100">
										<input name="VI_ThumbnailSize" <?php echo  ($options['VI_ThumbnailSize'] == 100 ? 'checked' : '' ) ?> type="radio" id="VI_ThumbnailSize100" value="100" />
										Medium (100 x 75)
									</label>
									<label for="VI_ThumbnailSize160">
										<input name="VI_ThumbnailSize" <?php echo  ($options['VI_ThumbnailSize'] == 160 ? 'checked' : '' ) ?> type="radio" id="VI_ThumbnailSize160" value="160" />
										Large (160 x 120)
									</label>
									<label for="VI_ThumbnailSize200">
										<input name="VI_ThumbnailSize" <?php echo  ($options['VI_ThumbnailSize'] == 200 ? 'checked' : '' ) ?> type="radio" id="VI_ThumbnailSize200" value="200" />
										Huge (200 x 150)
									</label>
								</fieldset>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row">Position</th>
							<td> 
								<fieldset>
									<label for="VI_PositionLeft">
										<input name="VI_Position" <?php echo  ($options['VI_Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="VI_PositionLeft" value="Left" />
										left
									</label>
									<label for="VI_PositionRight">
										<input name="VI_Position" <?php echo  ($options['VI_Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="VI_PositionRight" value="Right" />
										right
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Vertical position</th>
							<td> 
								<fieldset>
									<label for="VI_VPositionMiddle">
										<input name="VI_VPosition" <?php echo  ($options['VI_VPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="VI_VPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="VI_VPositionFixed">
										<input name="VI_VPosition" <?php echo  ($options['VI_VPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="VI_VPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="VI_VPositionPx" type="text" id="VI_VPositionPx" value="<?php echo  $options['VI_VPositionPx'] ?>" class="small-text" /> px from top
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button position</th>
							<td> 
								<fieldset>
									<label for="VI_TabPositionTop">
										<input name="VI_TabPosition" <?php echo  ($options['VI_TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="VI_TabPositionTop" value="Top" />
										top
									</label>
									<label for="VI_TabPositionMiddle">
										<input name="VI_TabPosition" <?php echo  ($options['VI_TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="VI_TabPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="VI_TabPositionBottom">
										<input name="VI_TabPosition" <?php echo  ($options['VI_TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="VI_TabPositionBottom" value="Bottom" />
										bottom
									</label>
									<label for="VI_TabPositionFixed">
										<input name="VI_TabPosition" <?php echo  ($options['VI_TabPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="VI_TabPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="VI_TabPositionPx" type="text" id="VI_TabPositionPx" value="<?php echo  $options['VI_TabPositionPx'] ?>" class="small-text" /> px from top of slider
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button design</th>
							<td> 
								<fieldset>
									<label for="VI_TabDesign1">
										<input name="VI_TabDesign" <?php echo  ($options['VI_TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="VI_TabDesign1" value="1" />
										<img src="<?php echo  plugins_url('/img/vi1-left.png', __FILE__) ?>" />
									</label>
									<?php /*
									<label for="VI_TabDesign2">
										<input name="VI_TabDesign" <?php echo  ($options['VI_TabDesign'] == 2 ? 'checked' : '' ) ?> type="radio" id="VI_TabDesign2" value="2" />
										<img src="<?php echo  plugins_url('/img/yt2-left.png', __FILE__) ?>" />
									</label>*/?>
									<label for="VI_TabDesign3">
										<input name="VI_TabDesign" <?php echo  ($options['VI_TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="VI_TabDesign3" value="3" />
										<img src="<?php echo  plugins_url('/img/vi3-left.png', __FILE__) ?>" />
									</label>

									<label for="VI_TabDesign7">
										<input name="VI_TabDesign" <?php echo  ($options['VI_TabDesign'] == 7 ? 'checked' : '' ) ?> type="radio" id="VI_TabDesign7" value="7" />
										<img src="<?php echo  plugins_url('/img/vi7-left.png', __FILE__) ?>" />
									</label>
									<?php /*
									<label for="VI_TabDesign8">
										<input name="VI_TabDesign" <?php echo  ($options['VI_TabDesign'] == 8 ? 'checked' : '' ) ?> type="radio" id="VI_TabDesign8" value="8" />
										<img src="<?php echo  plugins_url('/img/yt8-left.png', __FILE__) ?>" />
									</label> */?>
									<label for="VI_TabDesign9">
										<input name="VI_TabDesign" <?php echo  ($options['VI_TabDesign'] == 9 ? 'checked' : '' ) ?> type="radio" id="VI_TabDesign9" value="9" />
										<img src="<?php echo plugins_url('/img/vi9-left.png', __FILE__) ?>" />
									</label>

									<label for="VI_TabDesign11">
										<input name="VI_TabDesign" <?php echo  ($options['VI_TabDesign'] == 11 ? 'checked' : '' ) ?> type="radio" id="VI_TabDesign11" value="11" />
										<img src="<?php echo plugins_url('/img/vi11-left.png', __FILE__) ?>" />
									</label>
									<label for="VI_TabDesign12">
										<input name="VI_TabDesign" <?php echo  ($options['VI_TabDesign'] == 12 ? 'checked' : '' ) ?> type="radio" id="VI_TabDesign12" value="12" />
										<img src="<?php echo plugins_url('/img/vi12-left.png', __FILE__) ?>" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="VI_Border">Border width</label></th>
							<td><input name="VI_Border" type="text" id="VI_Border" value="<?php echo  $options['VI_Border'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="VI_BorderColor">Border color</label></th>
							<td>
								<input maxlength="7" name="VI_BorderColor" type="text" id="VI_BorderColor" value="<?php echo  $options['VI_BorderColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #00aeef)
								<div id="VI_BorderColorPreview" style="background-color: <?php echo  $options['VI_BorderColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="VI_BackgroundColor">Background color</label></th>
							<td>
								<input maxlength="7" name="VI_BackgroundColor" type="text" id="VI_BackgroundColor" value="<?php echo  $options['VI_BackgroundColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #000000)
								<div id="VI_BackgroundColorPreview" style="background-color: <?php echo  $options['VI_BackgroundColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="VI_ZIndex">CSS z-index</label></th>
							<td><input name="VI_ZIndex" type="text" id="VI_ZIndex" value="<?php echo  $options['VI_ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<div id="STabsPi">
				<h3>Pinterest</h3>
				<?php
				/*echo '
				<div>
					<p style="color: #CC0000;"><strong>To get Google+ or Pinterest feed you have to setup cronjob. Url to run:</strong>
					<a target="_blank" href="'. plugins_url('', __FILE__)  . '/cron.php">'. plugins_url('', __FILE__)  . '/cron.php</a>
					</p>
				</div>';*/
				?>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Enable</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Enable</span></legend>
									<label for="PI_Enable">
										<input name="PI_Enable" <?php echo  ($options['PI_Enable'] ? 'checked' : '' ) ?> type="checkbox" id="PI_Enable" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="PI_Username">Pinterest Username</label></th>
							<td>
								<input name="PI_Username" type="text" id="PI_PageID" value="<?php echo  $options['PI_Username'] ?>" class="regular-text" />
								<?php
								echo '<input class="button-primary" type="button" onclick="window.open(\''. plugins_url('', __FILE__) . '/cron.php\');" value="RELOAD PINS">';
								?>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="PI_Width">Width</label></th>
							<td><input name="PI_Width" type="text" id="PI_Width" value="<?php echo  $options['PI_Width'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="PI_Height">Height</label></th>
							<td><input name="PI_Height" type="text" id="PI_Height" value="<?php echo  $options['PI_Height'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="PI_NumberofPosts">Number of posts</label></th>
							<td>
								<input name="PI_NumberofPosts" type="text" id="PI_NumberofPosts" value="<?php echo  $options['PI_NumberofPosts'] ?>" class="small-text" />
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row">Position</th>
							<td> 
								<fieldset>
									<label for="PI_PositionLeft">
										<input name="PI_Position" <?php echo  ($options['PI_Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="PI_PositionLeft" value="Left" />
										left
									</label>
									<label for="PI_PositionRight">
										<input name="PI_Position" <?php echo  ($options['PI_Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="PI_PositionRight" value="Right" />
										right
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Vertical position</th>
							<td> 
								<fieldset>
									<label for="PI_VPositionMiddle">
										<input name="PI_VPosition" <?php echo  ($options['PI_VPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="PI_VPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="PI_VPositionFixed">
										<input name="PI_VPosition" <?php echo  ($options['PI_VPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="PI_VPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="PI_VPositionPx" type="text" id="PI_VPositionPx" value="<?php echo  $options['PI_VPositionPx'] ?>" class="small-text" /> px from top
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button position</th>
							<td> 
								<fieldset>
									<label for="PI_TabPositionTop">
										<input name="PI_TabPosition" <?php echo  ($options['PI_TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="PI_TabPositionTop" value="Top" />
										top
									</label>
									<label for="PI_TabPositionMiddle">
										<input name="PI_TabPosition" <?php echo  ($options['PI_TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="PI_TabPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="PI_TabPositionBottom">
										<input name="PI_TabPosition" <?php echo  ($options['PI_TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="PI_TabPositionBottom" value="Bottom" />
										bottom
									</label>
									<label for="PI_TabPositionFixed">
										<input name="PI_TabPosition" <?php echo  ($options['PI_TabPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="PI_TabPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="PI_TabPositionPx" type="text" id="PI_TabPositionPx" value="<?php echo  $options['PI_TabPositionPx'] ?>" class="small-text" /> px from top of slider
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button design</th>
							<td> 
								<fieldset>
									<label for="PI_TabDesign1">
										<input name="PI_TabDesign" <?php echo  ($options['PI_TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="PI_TabDesign1" value="1" />
										<img src="<?php echo  plugins_url('/img/pi1-left.png', __FILE__) ?>" />
									</label>
									<label for="PI_TabDesign3">
										<input name="PI_TabDesign" <?php echo  ($options['PI_TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="PI_TabDesign3" value="3" />
										<img src="<?php echo  plugins_url('/img/pi3-left.png', __FILE__) ?>" />
									</label>

									<label for="PI_TabDesign7">
										<input name="PI_TabDesign" <?php echo  ($options['PI_TabDesign'] == 7 ? 'checked' : '' ) ?> type="radio" id="PI_TabDesign7" value="7" />
										<img src="<?php echo  plugins_url('/img/pi7-left.png', __FILE__) ?>" />
									</label>
									<label for="PI_TabDesign9">
										<input name="PI_TabDesign" <?php echo  ($options['PI_TabDesign'] == 9 ? 'checked' : '' ) ?> type="radio" id="PI_TabDesign9" value="9" />
										<img src="<?php echo plugins_url('/img/pi9-left.png', __FILE__) ?>" />
									</label>
									
									<label for="PI_TabDesign11">
										<input name="PI_TabDesign" <?php echo  ($options['PI_TabDesign'] == 11 ? 'checked' : '' ) ?> type="radio" id="PI_TabDesign11" value="11" />
										<img src="<?php echo plugins_url('/img/pi11-left.png', __FILE__) ?>" />
									</label>
									<label for="PI_TabDesign12">
										<input name="PI_TabDesign" <?php echo  ($options['PI_TabDesign'] == 12 ? 'checked' : '' ) ?> type="radio" id="PI_TabDesign12" value="12" />
										<img src="<?php echo plugins_url('/img/pi12-left.png', __FILE__) ?>" />
									</label>

								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="PI_Border">Border width</label></th>
							<td><input name="PI_Border" type="text" id="PI_Border" value="<?php echo  $options['PI_Border'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="PI_BorderColor">Border color</label></th>
							<td>
								<input maxlength="7" name="PI_BorderColor" type="text" id="PI_BorderColor" value="<?php echo  $options['PI_BorderColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #cb2027)
								<div id="PI_BorderColorPreview" style="background-color: <?php echo  $options['PI_BorderColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="PI_BackgroundColor">Background color</label></th>
							<td>
								<input maxlength="7" name="PI_BackgroundColor" type="text" id="PI_BackgroundColor" value="<?php echo  $options['PI_BackgroundColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #ffffff)
								<div id="PI_BackgroundColorPreview" style="background-color: <?php echo  $options['PI_BackgroundColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="PI_ZIndex">CSS z-index</label></th>
							<td><input name="PI_ZIndex" type="text" id="PI_ZIndex" value="<?php echo  $options['PI_ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			
			<div id="STabsLi">
				<h3>LinkedIn</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Enable</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Enable</span></legend>
									<label for="LI_Enable">
										<input name="LI_Enable" <?php echo  ($options['LI_Enable'] ? 'checked' : '' ) ?> type="checkbox" id="LI_Enable" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show Member Public Profile</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show Member Public Profile</span></legend>
									<label for="LI_ShowPublicProfile">
										<input name="LI_ShowPublicProfile" <?php echo  ($options['LI_ShowPublicProfile'] ? 'checked' : '' ) ?> type="checkbox" id="LI_ShowPublicProfile" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_PublicProfile">Public Profile URL</label></th>
							<td>
								<input name="LI_PublicProfile" type="text" id="LI_PublicProfile" value="<?php echo  $options['LI_PublicProfile'] ?>" class="regular-text" />
								(ex: http://www.linkedin.com/in/collis)
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Show Company Profile</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Show Company Profile</span></legend>
									<label for="LI_ShowCompanyProfile">
										<input name="LI_ShowCompanyProfile" <?php echo  ($options['LI_ShowCompanyProfile'] ? 'checked' : '' ) ?> type="checkbox" id="LI_ShowCompanyProfile" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_CompanyID">Company ID</label></th>
							<td>
								<input name="LI_CompanyID" type="text" id="LI_CompanyID" value="<?php echo  $options['LI_CompanyID'] ?>" class="regular-text" />
								(ex: 589883)
								<a href="http://arscode.pro/linkedin/" target="_blank"><b>Company ID lookup</b></a>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Order</th>
							<td> 
								<fieldset>
									<label style="width: 100%" for="LI_Order1">
										<input name="LI_Order" <?php echo  ($options['LI_Order'] == '1' ? 'checked' : '' ) ?> type="radio" id="LI_Order1" value="1" />
										<br />
										1. Member Public Profile<br />
										2. Company Profile
				
									</label>
									<br /><br />
									<label style="width: 100%" for="LI_Order2">
										<input name="LI_Order" <?php echo  ($options['LI_Order'] == '2' ? 'checked' : '' ) ?> type="radio" id="LI_Order2" value="2" />
										<br />
										1. Company Profile<br />
										2. Member Public Profile
									</label>
								</fieldset>
							</td>
						</tr>
						
						
						<tr valign="top">
							<th scope="row"><label for="LI_Width">Width</label></th>
							<td><input name="LI_Width" type="text" id="LI_Width" value="<?php echo  $options['LI_Width'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_Height">Height</label></th>
							<td><input name="LI_Height" type="text" id="LI_Height" value="<?php echo  $options['LI_Height'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row">Position</th>
							<td> 
								<fieldset>
									<label for="LI_PositionLeft">
										<input name="LI_Position" <?php echo  ($options['LI_Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="LI_PositionLeft" value="Left" />
										left
									</label>
									<label for="LI_PositionRight">
										<input name="LI_Position" <?php echo  ($options['LI_Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="LI_PositionRight" value="Right" />
										right
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Vertical position</th>
							<td> 
								<fieldset>
									<label for="LI_VPositionMiddle">
										<input name="LI_VPosition" <?php echo  ($options['LI_VPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="LI_VPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="LI_VPositionFixed">
										<input name="LI_VPosition" <?php echo  ($options['LI_VPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="LI_VPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="LI_VPositionPx" type="text" id="LI_VPositionPx" value="<?php echo  $options['LI_VPositionPx'] ?>" class="small-text" /> px from top
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button position</th>
							<td> 
								<fieldset>
									<label for="LI_TabPositionTop">
										<input name="LI_TabPosition" <?php echo  ($options['LI_TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="LI_TabPositionTop" value="Top" />
										top
									</label>
									<label for="LI_TabPositionMiddle">
										<input name="LI_TabPosition" <?php echo  ($options['LI_TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="LI_TabPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="LI_TabPositionBottom">
										<input name="LI_TabPosition" <?php echo  ($options['LI_TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="LI_TabPositionBottom" value="Bottom" />
										bottom
									</label>
									<label for="LI_TabPositionFixed">
										<input name="LI_TabPosition" <?php echo  ($options['LI_TabPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="LI_TabPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="LI_TabPositionPx" type="text" id="LI_TabPositionPx" value="<?php echo  $options['LI_TabPositionPx'] ?>" class="small-text" /> px from top of slider
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button design</th>
							<td> 
								<fieldset>
									<label for="LI_TabDesign1">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign1" value="1" />
										<img src="<?php echo  plugins_url('/img/li1-left.png', __FILE__) ?>" />
									</label>
									<label for="LI_TabDesign2">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 2 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign2" value="2" />
										<img src="<?php echo  plugins_url('/img/li2-left.png', __FILE__) ?>" />
									</label>
									<label for="LI_TabDesign3">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign3" value="3" />
										<img src="<?php echo  plugins_url('/img/li3-left.png', __FILE__) ?>" />
									</label>
									<label for="LI_TabDesign6">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 6 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign6" value="6" />
										<img src="<?php echo  plugins_url('/img/li6-left.png', __FILE__) ?>" />
									</label>
									<label for="LI_TabDesign7">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 7 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign7" value="7" />
										<img src="<?php echo  plugins_url('/img/li7-left.png', __FILE__) ?>" />
									</label>
									<label for="LI_TabDesign8">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 8 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign8" value="8" />
										<img src="<?php echo  plugins_url('/img/li8-left.png', __FILE__) ?>" />
									</label> 
									<label for="LI_TabDesign9">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 9 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign9" value="9" />
										<img src="<?php echo plugins_url('/img/li9-left.png', __FILE__) ?>" />
									</label>
									<label for="LI_TabDesign10">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 10 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign10" value="10" />
										<img src="<?php echo plugins_url('/img/li10-left.png', __FILE__) ?>" />
									</label>
									<label for="LI_TabDesign11">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 11 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign11" value="11" />
										<img src="<?php echo plugins_url('/img/li11-left.png', __FILE__) ?>" />
									</label>
									<label for="LI_TabDesign12">
										<input name="LI_TabDesign" <?php echo  ($options['LI_TabDesign'] == 12 ? 'checked' : '' ) ?> type="radio" id="LI_TabDesign12" value="12" />
										<img src="<?php echo plugins_url('/img/li12-left.png', __FILE__) ?>" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_Border">Border width</label></th>
							<td><input name="LI_Border" type="text" id="LI_Border" value="<?php echo  $options['LI_Border'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_BorderColor">Border color</label></th>
							<td>
								<input maxlength="7" name="LI_BorderColor" type="text" id="LI_BorderColor" value="<?php echo  $options['LI_BorderColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #e0e0e0)
								<div id="LI_BorderColorPreview" style="background-color: <?php echo  $options['LI_BorderColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_BackgroundColor">Background color</label></th>
							<td>
								<input maxlength="7" name="LI_BackgroundColor" type="text" id="LI_BackgroundColor" value="<?php echo  $options['LI_BackgroundColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #000000)
								<div id="LI_BackgroundColorPreview" style="background-color: <?php echo  $options['LI_BackgroundColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Load widget</th>
							<td> 
								<fieldset>
									<label for="LI_Load1">
										<input name="LI_Load" <?php echo  ($options['LI_Load'] == 1 ? 'checked' : '' ) ?> type="radio" id="LI_Load1" value="1" />
										on page load
									</label>
									<label for="LI_Load2">
										<input name="LI_Load" <?php echo  ($options['LI_Load'] == 2 ? 'checked' : '' ) ?> type="radio" id="LI_Load2" value="2" />
										on slideout
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="LI_ZIndex">CSS z-index</label></th>
							<td><input name="LI_ZIndex" type="text" id="LI_ZIndex" value="<?php echo  $options['LI_ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
						</tr>
					</tbody>
				</table>
			</div>
            
            <div id="STabsIn">
				<h3>Instagram</h3>
				<?php if(!isset($options['INST_access_token']) || strlen($options['INST_access_token']) == 0) { ?>
                <p>
        			Need help registering an instagram client? Follow the instructions below.
        		</p>
        
        		<div id="instagram-plugin-instructions">
        			<h3>How to get your Instagram Client ID</h3>
        
        			<ol>
        				<li>
        					Visit <a href="http://instagram.com/developer" target="_blank">http://instagram.com/developer</a>
        					and click on Manage Clients (top right hand corner)
        					<br>
        					<br>
        					<img src="<?php echo plugins_url('img/1.png', __FILE__); ?>" width="280">
        				</li>
        
        				<li>
        					Click on the Register a New Client button (top right hand corner again)
        					<br>
        					<br>
        					<img src="<?php echo plugins_url('img/2.png', __FILE__); ?>">
        				</li>
        
        				<li>
        					Fill in the register new OAuth Client form with:
        
        					<dl>
        						<dt>Application name</dt>
        						<dd>Name of your website</dd>
        						
        						<dt>Description</dt>
        						<dd>Instagram wordpress plugin</dd>
        						
        						<dt>Website</dt>
        						<dd>Your website url</dd>
        						
        						<dt>OAuth redirect_url</dt>
        						<dd><textarea><?php echo plugins_url('authenticationhandler.php', __FILE__); ?></textarea></dd>
        
        					</dl>
        
        					<br>
        					<br>
        					<img src="<?php echo plugins_url('img/3.png', __FILE__); ?>">
        				</li>
        			</ol>
        		</div>
				<?php } ?>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Enable</th>
							<td> 
								<fieldset>
									<legend class="screen-reader-text"><span>Enable</span></legend>
									<label for="INST_Enable">
										<input name="INST_Enable" <?php echo  ($options['INST_Enable'] ? 'checked' : '' ) ?> type="checkbox" id="INST_Enable" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
                        <?php if(!isset($options['INST_access_token']) || strlen($options['INST_access_token']) == 0) { ?>
						<tr valign="top">
							<th scope="row"><label for="INST_client_id">Client ID</label></th>
							<td>
                                <input name="INST_username" type="hidden" id="INST_username" value="<?php echo  $options['INST_username'] ?>" />
                                <input name="INST_picture" type="hidden" id="INST_picture" value="<?php echo  $options['INST_picture'] ?>" />
                                <input name="INST_fullname" type="hidden" id="INST_fullname" value="<?php echo  $options['INST_fullname'] ?>" />
                                <input name="INST_access_token" type="hidden" id="INST_access_token" value="<?php echo  $options['INST_access_token'] ?>" />
								<input name="INST_client_id" type="text" id="INST_client_id" value="<?php echo  $options['INST_client_id'] ?>" class="regular-text" />
							</td>
						</tr>
                        <tr valign="top">
							<th scope="row"><label for="INST_client_secret">Client Secret</label></th>
							<td>
								<input name="INST_client_secret" type="text" id="INST_client_secret" value="<?php echo  $options['INST_client_secret'] ?>" class="regular-text" />
							</td>
						</tr>
                        <tr valign="top">
							<th scope="row">
			                    <input type="button" name="instagram_login" id="instagram_login" value="Log in" class="button-secondary" onclick="javascript:auth_instagramforwordpress();" />
                            </th>
						</tr>
                        <?php } else { ?>
                        <tr valign="top">
							<th scope="row"><label for="INST_access_token">Access token</label></th>
							<td>
                                <input name="INST_client_id" type="hidden" id="INST_client_id" value="<?php echo  $options['INST_client_id'] ?>" />
                                <input name="INST_client_secret" type="hidden" id="INST_client_secret" value="<?php echo  $options['INST_client_secret'] ?>" />
                                <input name="INST_username" type="hidden" id="INST_username" value="<?php echo  $options['INST_username'] ?>" />
                                <input name="INST_picture" type="hidden" id="INST_picture" value="<?php echo  $options['INST_picture'] ?>" />
                                <input name="INST_fullname" type="hidden" id="INST_fullname" value="<?php echo  $options['INST_fullname'] ?>" />
                                <input name="INST_access_token" type="hidden" id="INST_access_token" value="<?php echo  $options['INST_access_token'] ?>" />
								<?php echo  $options['INST_access_token'] ?>
							</td>
						</tr>
                        <tr valign="top">
							<th scope="row"><label for="INST_username">Login</label></th>
							<td>
								<?php echo  $options['INST_username'] ?>
							</td>
						</tr>
                        <tr valign="top">
							<th scope="row">
			                    <input type="button" name="instagram_logout" id="instagram_logout" value="Logout" class="button-secondary" />
                            </th>
						</tr>
                        <?php } ?>
                        <tr valign="top">
							<th scope="row"><label for="INST_size">Picture size:</label></th>
							<td>
								<select id="INST_size" name="INST_size">
                    				<option value="small" <?php echo ($options['INST_size'] == 'small' ? 'selected' : '' ) ?>>small (150x150px)</option>
                    				<option value="middle" <?php echo ($options['INST_size'] == 'middle' ? 'selected' : '' ) ?>>middle (306x306px)</option>
                    				<option value="large" <?php echo ($options['INST_size'] == 'large' ? 'selected' : '' ) ?>>large (612x612px)</option>
                    			</select>
							</td>
						</tr>
                        <tr valign="top">
							<th scope="row"><label for="INST_hashtag">Hashtag</label></th>
							<td>
								<input name="INST_hashtag" type="text" id="INST_hashtag" value="<?php echo  $options['INST_hashtag'] ?>" class="regular-text" />
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="INST_Width">Width</label></th>
							<td><input name="INST_Width" type="text" id="INST_Width" value="<?php echo  $options['INST_Width'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="INST_Height">Height</label></th>
							<td><input name="INST_Height" type="text" id="INST_Height" value="<?php echo  $options['INST_Height'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="INST_NumberofPosts">Number of posts</label></th>
							<td>
								<input name="INST_NumberofPosts" type="text" id="INST_NumberofPosts" value="<?php echo  $options['INST_NumberofPosts'] ?>" class="small-text" />
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row">Position</th>
							<td> 
								<fieldset>
									<label for="INST_PositionLeft">
										<input name="INST_Position" <?php echo  ($options['INST_Position'] == 'Left' ? 'checked' : '' ) ?> type="radio" id="INST_PositionLeft" value="Left" />
										left
									</label>
									<label for="INST_PositionRight">
										<input name="INST_Position" <?php echo  ($options['INST_Position'] == 'Right' ? 'checked' : '' ) ?> type="radio" id="INST_PositionRight" value="Right" />
										right
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Vertical position</th>
							<td> 
								<fieldset>
									<label for="INST_VPositionMiddle">
										<input name="INST_VPosition" <?php echo  ($options['INST_VPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="INST_VPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="INST_VPositionFixed">
										<input name="INST_VPosition" <?php echo  ($options['INST_VPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="INST_VPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="INST_VPositionPx" type="text" id="INST_VPositionPx" value="<?php echo  $options['INST_VPositionPx'] ?>" class="small-text" /> px from top
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button position</th>
							<td> 
								<fieldset>
									<label for="INST_TabPositionTop">
										<input name="INST_TabPosition" <?php echo  ($options['INST_TabPosition'] == 'Top' ? 'checked' : '' ) ?> type="radio" id="INST_TabPositionTop" value="Top" />
										top
									</label>
									<label for="INST_TabPositionMiddle">
										<input name="INST_TabPosition" <?php echo  ($options['INST_TabPosition'] == 'Middle' ? 'checked' : '' ) ?> type="radio" id="INST_TabPositionMiddle" value="Middle" />
										middle
									</label>
									<label for="INST_TabPositionBottom">
										<input name="INST_TabPosition" <?php echo  ($options['INST_TabPosition'] == 'Bottom' ? 'checked' : '' ) ?> type="radio" id="INST_TabPositionBottom" value="Bottom" />
										bottom
									</label>
									<label for="INST_TabPositionFixed">
										<input name="INST_TabPosition" <?php echo  ($options['INST_TabPosition'] == 'Fixed' ? 'checked' : '' ) ?> type="radio" id="INST_TabPositionFixed" value="Fixed" />
										fixed: 
									</label>
									<input name="INST_TabPositionPx" type="text" id="INST_TabPositionPx" value="<?php echo  $options['INST_TabPositionPx'] ?>" class="small-text" /> px from top of slider
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Button design</th>
							<td> 
								<fieldset>
									<label for="INST_TabDesign1">
										<input name="INST_TabDesign" <?php echo  ($options['INST_TabDesign'] == 1 ? 'checked' : '' ) ?> type="radio" id="INST_TabDesign1" value="1" />
										<img src="<?php echo  plugins_url('/img/inst1-left.png', __FILE__) ?>" />
									</label>
									<label for="INST_TabDesign3">
										<input name="INST_TabDesign" <?php echo  ($options['INST_TabDesign'] == 3 ? 'checked' : '' ) ?> type="radio" id="INST_TabDesign3" value="3" />
										<img src="<?php echo  plugins_url('/img/inst3-left.png', __FILE__) ?>" />
									</label>

									<label for="INST_TabDesign7">
										<input name="INST_TabDesign" <?php echo  ($options['INST_TabDesign'] == 7 ? 'checked' : '' ) ?> type="radio" id="INST_TabDesign7" value="7" />
										<img src="<?php echo  plugins_url('/img/inst7-left.png', __FILE__) ?>" />
									</label>
									<label for="INST_TabDesign9">
										<input name="INST_TabDesign" <?php echo  ($options['INST_TabDesign'] == 9 ? 'checked' : '' ) ?> type="radio" id="INST_TabDesign9" value="9" />
										<img src="<?php echo plugins_url('/img/inst9-left.png', __FILE__) ?>" />
									</label>
									
									<label for="INST_TabDesign11">
										<input name="INST_TabDesign" <?php echo  ($options['INST_TabDesign'] == 11 ? 'checked' : '' ) ?> type="radio" id="INST_TabDesign11" value="11" />
										<img src="<?php echo plugins_url('/img/inst11-left.png', __FILE__) ?>" />
									</label>
									<label for="INST_TabDesign12">
										<input name="INST_TabDesign" <?php echo  ($options['INST_TabDesign'] == 12 ? 'checked' : '' ) ?> type="radio" id="INST_TabDesign12" value="12" />
										<img src="<?php echo plugins_url('/img/inst12-left.png', __FILE__) ?>" />
									</label>

								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="INST_Border">Border width</label></th>
							<td><input name="INST_Border" type="text" id="INST_Border" value="<?php echo  $options['INST_Border'] ?>" class="small-text" /> px</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="INST_BorderColor">Border color</label></th>
							<td>
								<input maxlength="7" name="INST_BorderColor" type="text" id="INST_BorderColor" value="<?php echo  $options['INST_BorderColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #352820)
								<div id="INST_BorderColorPreview" style="background-color: <?php echo  $options['INST_BorderColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="INST_BackgroundColor">Background color</label></th>
							<td>
								<input maxlength="7" name="INST_BackgroundColor" type="text" id="INST_BackgroundColor" value="<?php echo  $options['INST_BackgroundColor'] ?>" style="float: left; width: 70px;" class="small-text" /> (default: #ffffff)
								<div id="INST_BackgroundColorPreview" style="background-color: <?php echo  $options['INST_BackgroundColor'] ?>;float: left; margin-top: 3px; margin-left: 5px; margin-right: 5px; width: 17px; height: 17px;"></div>

							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="INST_ZIndex">CSS z-index</label></th>
							<td><input name="INST_ZIndex" type="text" id="INST_ZIndex" value="<?php echo  $options['INST_ZIndex'] ?>" class="small-text" /> (default: 1000)</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<div id="STabsAdw">
				<h3>Advanced</h3>
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Disable on Home Page</th>
							<td> 
								<fieldset>
									<label for="DisableHome">
										<input name="DisableHome" <?php echo  ($options['DisableHome'] ? 'checked' : '' ) ?> type="checkbox" id="DisableHome" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Disable on Category Page</th>
							<td> 
								<fieldset>
									<label for="DisableCategory">
										<input name="DisableCategory" <?php echo  ($options['DisableCategory'] ? 'checked' : '' ) ?> type="checkbox" id="DisableCategory" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Disable on Archive Page</th>
							<td> 
								<fieldset>
									<label for="DisableArchive">
										<input name="DisableArchive" <?php echo  ($options['DisableArchive'] ? 'checked' : '' ) ?> type="checkbox" id="DisableArchive" value="1" />
									</label>
								</fieldset>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row">Mobile devices</th>
							<td> 
								<fieldset>
									<label for="MobileDevices1">
										<input name="MobileDevices" <?php echo  ($options['MobileDevices'] == 1 ? 'checked' : '' ) ?> type="radio" id="MobileDevices1" value="1" />
										enable plugin
									</label>
									<label for="MobileDevices2">
										<input name="MobileDevices" <?php echo  ($options['MobileDevices'] == 2 ? 'checked' : '' ) ?> type="radio" id="MobileDevices2" value="2" />
										disable plugin
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Behavior</th>
							<td> 
								<fieldset>
									<label for="Behavior1">
										<input name="Behavior" <?php echo  ($options['Behavior'] == 1 ? 'checked' : '' ) ?> type="radio" id="Behavior1" value="1" />
										hover
									</label>
									<label for="Behavior2">
										<input name="Behavior" <?php echo  ($options['Behavior'] == 2 ? 'checked' : '' ) ?> type="radio" id="Behavior2" value="2" />
										click
									</label>
								</fieldset>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="DisableByGetParamN">Disable by GET param</label></th>
							<td>
								name: <input name="DisableByGetParamN" type="text" id="DisableByGetParamN" value="<?php echo  $options['DisableByGetParamN'] ?>" class="regular-text" /> (ex: iframe)
								<br />
								value: <input name="DisableByGetParamV" type="text" id="DisableByGetParamV" value="<?php echo  $options['DisableByGetParamV'] ?>" class="regular-text" /> (ex: 1)
								<br />
								(ex: if you set this option, slider will be disabled on www.yoursite.com.pl/sampleurl/?iframe=1)
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div id="STabsPresets">
			<?php
			$i=0;
			foreach((array)$FBLB_Presets as $k => $v)
			{
				$i++;
				?>
				<div style="float: left; width: 250px;">	
					<strong><?php echo $i.'. '.$v['Name']; ?></strong><br />
					<img src="<?php echo plugins_url('/presets/'.$v['Thumb'], __FILE__) ?>" />
					<p class="submit">
						<input type="button" onclick="document.location='options-general.php?page=fblb&amp;Preset=<?php echo $k; ?>&amp;submit=1#STabsPresets'" class="button-primary" value="Select this settings" />
						<input type="button" onclick="document.location='options-general.php?page=fblb&amp;Preset=<?php echo $k; ?>&amp;preview=1#STabsPresets'" value="Preview" />
					</p>
				</div>
				<?php
				if($i%4==0)
				{
					echo '<br style="clear: both;" />';
				}
			}
			?>
			<br style="clear: both;" />
			</div>
		</div>
		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button-primary" value="Save settings" />
			<input type="submit" name="preview" id="preview" value="Preview" />
		</p>
	</form>
</div>
<script type="text/javascript">
auth_instagramforwordpress = function() {
    if (jQuery('#INST_client_id').val()) {
        var url = 'https://api.instagram.com/oauth/authorize/' 
        + '?redirect_uri=' + encodeURIComponent("<?php echo plugins_url('authenticationhandler.php', __FILE__); ?>")
        + '&response_type=code' 
        + '&client_id='+jQuery('#INST_client_id').val()
        + '&display=touch';
        
        window.open(url, 'wp-instagram-authentication-' + Math.random(), 'height=500,width=600');
    }
    else {
        alert('You have to enter Instagram client ID');
    }
}

jQuery(function(){
    jQuery("#instagram_logout").click(function(){
        jQuery('#INST_username').val('');
        jQuery('#INST_picture').val('');
        jQuery('#INST_fullname').val('');
        jQuery('#INST_access_token').val('');
        
        jQuery(this).parents("form").find("input[type=submit]").click();
        
        return false;
    });
    
	jQuery('#STabs').tabs();
	jQuery('#BorderColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#BorderColor').val('#' + hex);
			jQuery('#BorderColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#BackgroundColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#BackgroundColor').val('#' + hex);
			jQuery('#BackgroundColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});

	jQuery('#TW_BorderColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#TW_BorderColor').val('#' + hex);
			jQuery('#TW_BorderColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#TW_ShellBackground').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#TW_ShellBackground').val('#' + hex);
			jQuery('#TW_ShellBackgroundPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#TW_ShellText').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#TW_ShellText').val('#' + hex);
			jQuery('#TW_ShellTextPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#TW_TweetBackground').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#TW_TweetBackground').val('#' + hex);
			jQuery('#TW_TweetBackgroundPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#TW_TweetText').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#TW_TweetText').val('#' + hex);
			jQuery('#TW_TweetTextPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#TW_Links').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#TW_Links').val('#' + hex);
			jQuery('#TW_LinksPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});

	jQuery('#GP_BorderColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#GP_BorderColor').val('#' + hex);
			jQuery('#GP_BorderColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#GP_BackgroundColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#GP_BackgroundColor').val('#' + hex);
			jQuery('#GP_BackgroundColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	

	jQuery('#YT_BorderColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#YT_BorderColor').val('#' + hex);
			jQuery('#YT_BorderColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#YT_BackgroundColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#YT_BackgroundColor').val('#' + hex);
			jQuery('#YT_BackgroundColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	
	jQuery('#LI_BorderColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#LI_BorderColor').val('#' + hex);
			jQuery('#LI_BorderColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#LI_BackgroundColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#LI_BackgroundColor').val('#' + hex);
			jQuery('#LI_BackgroundColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#VI_BorderColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#VI_BorderColor').val('#' + hex);
			jQuery('#VI_BorderColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#VI_BackgroundColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#VI_BackgroundColor').val('#' + hex);
			jQuery('#VI_BackgroundColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#VI_TitlesColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#VI_TitlesColor').val('#' + hex);
			jQuery('#VI_TitlesColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#VI_TitlesColorHover').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#VI_TitlesColorHover').val('#' + hex);
			jQuery('#VI_TitlesColorHoverPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#PI_BorderColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#PI_BorderColor').val('#' + hex);
			jQuery('#PI_BorderColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#PI_BackgroundColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#PI_BackgroundColor').val('#' + hex);
			jQuery('#PI_BackgroundColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
    jQuery('#INST_BorderColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#INST_BorderColor').val('#' + hex);
			jQuery('#INST_BorderColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
	jQuery('#INST_BackgroundColor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			jQuery('#INST_BackgroundColor').val('#' + hex);
			jQuery('#INST_BackgroundColorPreview').css('background-color', '#' + hex);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});
});
</script>