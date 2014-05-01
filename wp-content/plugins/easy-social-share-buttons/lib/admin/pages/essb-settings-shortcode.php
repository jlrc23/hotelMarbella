<?php
$msg = "";

$cmd = isset($_POST["cmd"]) ? $_POST["cmd"] : '';
$shortcode = "";

if ($cmd == "generate") {
	$options = $_POST ['general_options'];
	
	//print_r($options ['sort']);
	$buttons = "";
	if (isset($options["networks"])) {
	foreach ( $options ['networks'] as $nw ) {
		if ($buttons != '') { $buttons .= ","; }
		$buttons .= $nw;
	}
	}
	
	if ($buttons == "") { $buttons = "no"; }
	
	$counters = isset($_POST["essb_counters"]) ? $_POST["essb_counters"] : "";
	$hide_names = isset($_POST["essb_hide_names"]) ? $_POST["essb_hide_names"] : "";
	$message = isset($_POST["essb_message"]) ? $_POST["essb_message"] : "";
	$counter_pos = isset($_POST["essb_counter_pos"]) ? $_POST["essb_counter_pos"] : "";
	$native = isset($_POST["essb_native"]) ? $_POST["essb_native"] : "";
	$show_fblike = isset($_POST["essb_show_fblike"]) ? $_POST["essb_show_fblike"] : "";
	$show_plusone = isset($_POST["essb_show_plusone"]) ? $_POST["essb_show_plusone"] : "";
	$show_twitter = isset($_POST["essb_show_twitter"]) ? $_POST["essb_show_twitter"] : "";
	$show_vk = isset($_POST["essb_show_vk"]) ? $_POST["essb_show_vk"] : "";
	$sidebar = isset($_POST["essb_sidebar"]) ? $_POST["essb_sidebar"] : "";
	$sidebar_pos = isset($_POST["essb_sidebar_pos"]) ? $_POST["essb_sidebar_pos"] : "";
	$popup = isset($_POST["essb_popup"]) ? $_POST["essb_popup"] : "";
	$popafter = isset($_POST["essb_popafter"]) ? $_POST["essb_popafter"] : "";
	$url = isset($_POST["essb_url"]) ? $_POST["essb_url"] : "";
	$text = isset($_POST["essb_text"]) ? $_POST["essb_text"] : "";
	$image = isset($_POST["essb_image"]) ? $_POST["essb_image"] : "";
	$description = isset($_POST["essb_description"]) ? $_POST["essb_description"] : "";
	$fblike = isset($_POST["essb_fblike"]) ? $_POST["essb_fblike"] : "";
	$plusone = isset($_POST["essb_plusone"]) ? $_POST["essb_plusone"] : "";
	
	$shortcode = "[easy-share";
	
	$shortcode .= ' buttons="'.$buttons.'"';
	if ($counters == "on") { $shortcode .= ' counters=1'; } else {$shortcode .= ' counters=0'; }
	if ($hide_names == "on") { $shortcode .= ' hide_names="yes"'; }
	if ($message == "on") { $shortcode .=  ' message="yes"'; }
	if ($counter_pos != "left") { $shortcode .= ' counter_pos="'.$counter_pos.'"'; }
	if ($native == "on") { $shortcode .= ' native="yes"'; } 
	else {
		if (($show_fblike == "on") ||($show_plusone == "on")  || ($show_twitter == "on")) {
			$shortcode .= ' native="selected"';
		} 
		else {
			$shortcode .= ' native="no"';
		}

	}
	if ($show_fblike == "on") { $shortcode .= ' show_fblike="yes"'; }
	if ($show_plusone == "on") { $shortcode .= ' show_plusone="yes"'; }
	if ($show_twitter == "on") { $shortcode .= ' show_twitter="yes"'; }
	if ($show_vk == "on") { $shortcode .= ' show_vk="yes"'; }
	if ($sidebar == "on") {
		$shortcode .= ' sidebar="yes"';
		$shortcode .=  ' sidebar_pos="'.$sidebar_pos.'"';		
	}
	
	if ($popup == "on") {
		$shortcode .= ' popup="yes"';
		if ($popafter != '') { $shortcode .= ' popafter="'.$popafter.'"'; }
	}
	
	if ($url != '') { $shortcode .= ' url="'.$url.'"'; }
	if ($text != '' ) { $shortcode .= ' text="'.$text.'"'; }
	if ($image != '') { $shortcode .= ' image="'.$image.'"'; }
	if ($description != '') { $shortcode .= ' description="'.$description.'"'; }
	if ($fblike != '') { $shortcode .= ' fblike="'.$fblike.'"'; }
	if ($plusone != '') { $plusone .= ' plusone="'.$plusone. '"'; }
	
	$shortcode .= "]";
}

function essb_shortcode_checkbox_network_selection() {
	$y = $n = '';
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );

	if (is_array ( $options )) {
		foreach ( $options ['networks'] as $k => $v ) {
				
			$is_checked = "";
			$network_name = isset ( $v [1] ) ? $v [1] : $k;
				
			echo '<li><p style="margin: .2em 5% .2em 0;">
			<input id="network_selection_' . $k . '" value="' . $k . '" name="general_options[networks][]" type="checkbox"
			' . $is_checked . ' /><input name="general_options[sort][]" value="' . $k . '" type="checkbox" checked="checked" style="display: none; " />
			<label for="network_selection_' . $k . '"><span class="essb_icon essb_icon_' . $k . '"></span>' . $network_name . '</label>
			</p></li>';
		}


	}
}

?>

<div class="essb">
	<div class="wrap">
	<?php
	
	if ($msg != "") {
		echo '<div class="success_message">' . $msg . '</div>';
	}
	
	if ($shortcode != '') {
		print '<div style="width: 100%; display: block; text-align: center;">';
		print '<p class="bold">Your shortcode is:</p>';
		print '<div class="sub" style="width: 60%; text-align: center;  margin: 0 auto; margin-bottom: 20px;">';
		print $shortcode;
		print '</div></div>';
	}
	
	?>
	
		<form name="general_form" method="post"
			action="admin.php?page=essb_settings&tab=shortcode">
			<input type="hidden" id="cmd" name="cmd" value="generate" />
			<table border="0" cellpadding="5" cellspacing="0" width="100%">
				<col width="25%" />
				<col width="75%" />
				<tr class="table-border-bottom">
					<td colspan="2" class="sub"><?php _e('Shortcode Generator', ESSB_TEXT_DOMAIN); ?><div style="position: relative; float: right; margin-top: -5px;"><?php echo '<input type="Submit" name="Submit" value="' . __ ( 'Generate My Shortcode', ESSB_TEXT_DOMAIN ) . '" class="button-primary" />'; ?></div></td>
				</tr>
				<tr class="table-border-bottom">
					<td colspan="2" class="sub2">Share Buttons
					
					</td>
				</tr>
				<tr class="even table-border-bottom">
					<td class="bold" valign="top">Social Networks:<br/><span class="label" style="font-weight: 400">Select and reorder networks that you want to add shortcode. If you wish to include only native social buttons don't select options here.</span></td>
					<td class="essb_general_option"><ul id="networks-sortable"><?php essb_shortcode_checkbox_network_selection(); ?></ul></td>
				</tr>
				<tr class="odd table-border-bottom">
					<td class="bold">Include Share Counters:</td>
					<td class="essb_general_option"><input type="checkbox" name="essb_counters"/></td>
				</tr>
				<tr class="even table-border-bottom">
					<td class="bold">Counter Position:</td>
					<td class="essb_general_option">
						<select class="input-element" name="essb_counter_pos">
							<option value="left">Left</option>
							<option value="right">Right</option>
						</select>
					</td>
				</tr>				<tr class="odd table-border-bottom">
					<td class="bold">Hide Network Names:</td>
					<td class="essb_general_option"><input type="checkbox" name="essb_hide_names"/>
				</tr>
				<tr class="even table-border-bottom">
					<td class="bold">Display Texts Above Share/Like Buttons:</td>
					<td class="essb_general_option"><input type="checkbox" name="essb_message"/></td>
				</tr>
				<tr class="table-border-bottom">
					<td colspan="2" class="sub2">Native Social Buttons</td>
				</tr>
				<tr class="odd table-border-bottom">
					<td class="bold">Include Native Like Buttons:<br/><span class="label" style="font-size:400;">This option will active native socail buttons from configuration. If you wish to show button which is not active in configuration activete its option below.</span></td>
					<td class="essb_general_option"><input type="checkbox" name="essb_native"/></td>
				</tr>
								<tr class="even table-border-bottom">
					<td class="bold">Show Facebook Like:</td>
					<td class="essb_general_option"><input type="checkbox" name="essb_show_fblike"/></td>
				</tr>
								<tr class="odd table-border-bottom">
					<td class="bold">Show Google +1:</td>
					<td class="essb_general_option"><input type="checkbox" name="essb_show_plusone"/></td>
				</tr>
				
												<tr class="even table-border-bottom">
					<td class="bold">Show Twitter Follow:</td>
					<td class="essb_general_option"><input type="checkbox" name="essb_show_twitter"/></td>
				</tr>
				
												<tr class="odd table-border-bottom">
					<td class="bold">Show vk.com Like:</td>
					<td class="essb_general_option"><input type="checkbox" name="essb_show_vk"/></td>
				</tr>
					<tr class="table-border-bottom">
					<td colspan="2" class="sub2">Display Settings</td>
				</tr>
																<tr class="even table-border-bottom">
					<td class="bold">Display As Sidebar:</td>
					<td class="essb_general_option"><input type="checkbox" name="essb_sidebar"/></td>
				</tr>
				<tr class="odd table-border-bottom">
					<td class="bold">Sidebar Position:</td>
					<td class="essb_general_option">
						<select class="input-element" name="essb_sidebar_pos">
							<option value="left">Left</option>
							<option value="right">Right</option>
							<option value="bottom">Bottom</option>
							</select>
					</td>
					</tr>
					<tr class="even table-border-bottom">
					<td class="bold">Display As Popup:</td>
					<td class="essb_general_option"><input type="checkbox" name="essb_popup"/></td>
				</tr>
					<tr class="odd table-border-bottom">
					<td class="bold">Popup display after (sec):</td>
					<td class="essb_general_option"><input type="text" name="essb_popafter" class="input-element"/></td>
				</tr>
									<tr class="table-border-bottom">
					<td colspan="2" class="sub2">Custom Share and Like URL's</td>
				</tr>
	<tr class="even table-border-bottom">
					<td class="bold">Share URL:</td>
					<td class="essb_general_option"><input type="text" name="essb_url" class="input-element stretched"/></td>
				</tr>
	<tr class="odd table-border-bottom">
					<td class="bold">Share Message:</td>
					<td class="essb_general_option"><input type="text" name="essb_text" class="input-element stretched"/></td>
				</tr>
	<tr class="even table-border-bottom">
					<td class="bold">Share Image (Facebook & Pinterest only):</td>
					<td class="essb_general_option"><input type="text" name="essb_image" class="input-element stretched"/></td>
				</tr>
	<tr class="odd table-border-bottom">
					<td class="bold">Share Description (Facebook & Pinterest only):</td>
					<td class="essb_general_option"><input type="text" name="essb_description" class="input-element stretched"/></td>
				</tr>
	<tr class="even table-border-bottom">
					<td class="bold">Facebook Like URL:</td>
					<td class="essb_general_option"><input type="text" name="essb_fblike" class="input-element stretched"/></td>
				</tr>				
	<tr class="odd table-border-bottom">
					<td class="bold">Google +1 URL:</td>
					<td class="essb_general_option"><input type="text" name="essb_plusone" class="input-element stretched"/></td>
				</tr>				
				</table>
		</form>
	</div>
</div>

<script type="text/javascript">

jQuery(document).ready(function(){
    jQuery('#networks-sortable').sortable();
});
</script>
