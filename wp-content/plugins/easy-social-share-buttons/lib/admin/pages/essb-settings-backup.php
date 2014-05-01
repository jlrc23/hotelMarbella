<?php
$msg = "";

$cmd = isset($_POST["cmd"]) ? $_POST["cmd"] : '';
$value = "";

if ($cmd == "generate") {
	$current_options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	$value = json_encode($current_options);
	$msg = "Backup of your current settings is generated. Copy generated configuration string and save it on your computer. You can use it to restore settings or transfer them to other site.";
}
if ($cmd == "restore") {
	$options = isset($_POST["essb_options"]) ? $_POST["essb_options"] : "";
	
	if ($options == "") {
		$msg = "Configuration string is not provided.";
	}
	
	if ($options != '') {
		
		$opt = json_decode($options);
			update_option ( EasySocialShareButtons::$plugin_settings_name, $opt );
			$msg = "Settings are restored!";
	}
}


?>

<div class="essb">
	<div class="wrap">
	<?php
	
	if ($msg != "") {
		echo '<div class="updated optionsframework_setup_nag" style="padding: 10px;">' . $msg . '</div>';
	}
	
	
	?>
	
		
			<table border="0" cellpadding="5" cellspacing="0" width="100%">
				<col width="25%" />
				<col width="75%" />
				<tr class="table-border-bottom">
					<td colspan="2" class="sub"><?php _e('Backup/Restore Configuration', ESSB_TEXT_DOMAIN); ?><div style="position: relative; float: right; margin-top: -5px;"><form name="general_form" method="post"
			action="admin.php?page=essb_settings&tab=backup" style="position: relative; float: left;">
			<input type="hidden" id="cmd" name="cmd" value="generate" /><?php echo '<input type="Submit" name="backup" value="' . __ ( 'Backup', ESSB_TEXT_DOMAIN ) . '" class="button-primary" />'; ?></form>&nbsp;<form name="general_form" method="post"
			action="admin.php?page=essb_settings&tab=backup" style="position: relative; float: left; margin-left: 5px;">
			<input type="hidden" id="cmd" name="cmd" value="restore" /><?php echo '<input type="Submit" name="restore" value="' . __ ( 'Restore', ESSB_TEXT_DOMAIN ) . '" class="button-secondary" />'; ?></div></td>
				</tr>
				<tr class="even table-border-bottom">
					<td class="bold" valign="top" colspan="2">Configuration String:</td>
				</tr>
				<tr class="odd table-border-bottom">
					<td class="essb_general_option" colspan="2">
						<textarea name="essb_options" class="input-element stretched" rows="10"><?php echo $value; ?></textarea>
					</td>
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
