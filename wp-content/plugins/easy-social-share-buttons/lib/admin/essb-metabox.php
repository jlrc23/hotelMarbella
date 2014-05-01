<?php

function essb_register_settings_metabox() {
	global $post;
	
	$essb_off = "false";
	$essb_position = "";
	$essb_names = "";
	$essb_counter = "";
	$essb_theme = "";
	$essb_hidefb = "no";
	$essb_hideplusone = "no";
	$essb_hidevk = "no";
	$essb_hidetwitter = "no";
	$essb_counter_pos = "";
	$essb_sidebar_pos = "";
	
	if (isset ( $_GET ['action'] )) {
		$custom = get_post_custom ( $post->ID );
		
		// print_r($custom);
		
		$essb_off = isset ( $custom ["essb_off"] ) ? $custom ["essb_off"] [0] : "false";
		$essb_position = isset ( $custom ["essb_position"] ) ? $custom ["essb_position"] [0] : "";
		$essb_theme = isset ( $custom ["essb_theme"] ) ? $custom ["essb_theme"] [0] : "";
		$essb_names = isset ( $custom ["essb_names"] ) ? $custom ["essb_names"] [0] : "";
		$essb_counter = isset ( $custom ["essb_counter"] ) ? $custom ["essb_counter"] [0] : "";
		$essb_hidefb = isset ( $custom ["essb_hidefb"] ) ? $custom ["essb_hidefb"] [0] : "no";
		$essb_hideplusone = isset ( $custom ["essb_hideplusone"] ) ? $custom ["essb_hideplusone"] [0] : "no";
		$essb_hidevk = isset ( $custom ["essb_hidevk"] ) ? $custom ["essb_hidevk"] [0] : "no";
		$essb_hidetwitter = isset($custom["essb_hidetwitter"]) ? $custom["essb_hidetwitter"][0] : "no";
		
		$essb_sidebar_pos = isset($custom["essb_sidebar_pos"]) ? $custom["essb_sidebar_pos"][0] : "";
		$essb_counter_pos = isset($custom["essb_counter_pos"]) ? $custom["essb_counter_pos"][0] : "";
	}
	
	wp_nonce_field ( 'essb_metabox_handler', 'essb_nonce' );
	
	?>

<div class="essb-meta">

	<table border="0" cellpadding="5" cellspacing="0" width="100%">
		<col width="60%" />
		<col width="40%" />
		<tr class="even">
			<td class="bold">Turn off for current post:</td>
			<td><select class="input-element stretched" id="essb_off"
				name="essb_off">
					<option value="true"
						<?php echo (($essb_off == "true") ? " selected=\"selected\"": ""); ?>>Yes</option>
					<option value="false"
						<?php echo (($essb_off == "false") ? " selected=\"selected\"": ""); ?>>No</option>
			</select></td>
		</tr>
		<tr>
			<td class="sub" colspan="2">Visual Settings</td>
		</tr>
		<tr class="even">
			<td>Template:</td>
			<td><select class="input-element stretched" id="essb_theme"
				name="essb_theme">
					<option value="">From Settings</option>
					<option value="1"
						<?php echo (($essb_theme == "1") ? " selected=\"selected\"": ""); ?>>Default</option>
					<option value="2"
						<?php echo (($essb_theme == "2") ? " selected=\"selected\"": ""); ?>>Metro</option>
					<option value="3"
						<?php echo (($essb_theme == "3") ? " selected=\"selected\"": ""); ?>>Modern</option>
					<option value="4"
						<?php echo (($essb_theme == "4") ? " selected=\"selected\"": ""); ?>>Round</option>
					<option value="5"
						<?php echo (($essb_theme == "5") ? " selected=\"selected\"": ""); ?>>Big</option>
					<option value="6"
						<?php echo (($essb_theme == "6") ? " selected=\"selected\"": ""); ?>>Metro (Retina)</option>
					<option value="7"
						<?php echo (($essb_theme == "7") ? " selected=\"selected\"": ""); ?>>Big (Retina)</option>
						
			</select></td>
		</tr>
		<tr class="odd">
			<td>Hide Network Names:</td>
			<td><select class="input-element stretched" id="essb_names"
				name="essb_names">
					<option value="">From Settings</option>
					<option value="1"
						<?php echo (($essb_names == "1") ? " selected=\"selected\"": ""); ?>>Yes</option>
					<option value="0"
						<?php echo (($essb_names == "0") ? " selected=\"selected\"": ""); ?>>No</option>

			</select></td>
		</tr>
		<tr class="even">
			<td>Position of buttons:</td>
			<td><select class="input-element stretched" id="essb_position"
				name="essb_position">
					<option value="">From Settings</option> 
					</option>
					
					
					
					<option value="bottom"
						<?php echo (($essb_position == "bottom") ? " selected=\"selected\"": ""); ?>>Bottom</option>
					
					<option value="top"
						<?php echo (($essb_position == "top") ? " selected=\"selected\"": ""); ?>>Top</option>
					<option value="both"
						<?php echo (($essb_position == "both") ? " selected=\"selected\"": ""); ?>>Both</option>
					<option value="float"
						<?php echo (($essb_position == "float") ? " selected=\"selected\"": ""); ?>>Float</option>
					<option value="sidebar"
						<?php echo (($essb_position == "sidebar") ? " selected=\"selected\"": ""); ?>>Sidebar</option>
					<option value="popup"
						<?php echo (($essb_position == "popup") ? " selected=\"selected\"": ""); ?>>Popup</option>
						</select></td>
		</tr>
		<tr class="odd">
			<td>Display Counters:</td>
			<td><select class="input-element stretched" id="essb_counter"
				name="essb_counter">
					<option value="">From Settings</option>
					<option value="1"
						<?php echo (($essb_counter == "1") ? " selected=\"selected\"": ""); ?>>Yes</option>
					<option value="0"
						<?php echo (($essb_counter == "0") ? " selected=\"selected\"": ""); ?>>No</option>

			</select></td>
		</tr>
		<tr class="even">
			<td>Counters Position:</td>
			<td><select class="input-element stretched" id="essb_counter_pos"
				name="essb_counter_pos">
					<option value="">From Settings</option>
					<option value="left"
						<?php echo (($essb_counter_pos == "left") ? " selected=\"selected\"": ""); ?>>Left</option>
					<option value="right"
						<?php echo (($essb_counter_pos == "right") ? " selected=\"selected\"": ""); ?>>Right</option>

			</select></td>
		</tr>
		<tr class="odd">
			<td>Sidebar Position:</td>
			<td><select class="input-element stretched" id="essb_sidebar_pos"
				name="essb_sidebar_pos">
					<option value="">From Settings</option>
					<option value="left"
						<?php echo (($essb_sidebar_pos == "left") ? " selected=\"selected\"": ""); ?>>Left</option>
					<option value="right"
						<?php echo (($essb_sidebar_pos == "right") ? " selected=\"selected\"": ""); ?>>Right</option>
					<option value="bottom"
						<?php echo (($essb_sidebar_pos == "bottom") ? " selected=\"selected\"": ""); ?>>Bottom</option>
						
			</select></td>
		</tr>
		<tr>
			<td class="sub" colspan="2">Hide Native Social Button</td>
		</tr>
		<tr class="even">
			<td>Facebook Like Button:</td>
			<td><select class="input-element stretched" id="essb_hidefb"
				name="essb_hidefb">
					<option value="yes"
						<?php echo (($essb_hidefb == "yes") ? " selected=\"selected\"": ""); ?>>Yes</option>
					<option value="no"
						<?php echo (($essb_hidefb == "no") ? " selected=\"selected\"": ""); ?>>No</option>

			</select></td>
		</tr>
		<tr class="odd">
			<td>Google Plus One Button:</td>
			<td><select class="input-element stretched" id="essb_hideplusone"
				name="essb_hideplusone">
					<option value="yes"
						<?php echo (($essb_hideplusone == "yes") ? " selected=\"selected\"": ""); ?>>Yes</option>
					<option value="no"
						<?php echo (($essb_hideplusone == "no") ? " selected=\"selected\"": ""); ?>>No</option>

			</select></td>
		</tr>
		<tr class="even">
			<td>VKontakte Like Button:</td>
			<td><select class="input-element stretched" id="essb_hidevk"
				name="essb_hidevk">
					<option value="yes"
						<?php echo (($essb_hidevk == "yes") ? " selected=\"selected\"": ""); ?>>Yes</option>
					<option value="no"
						<?php echo (($essb_hidevk == "no") ? " selected=\"selected\"": ""); ?>>No</option>

			</select></td>
		</tr>
		<tr class="odd">
			<td>Twitter Follow Button:</td>
			<td><select class="input-element stretched" id="essb_hidetwitter"
				name="essb_hidetwitter">
					<option value="yes"
						<?php echo (($essb_hidetwitter == "yes") ? " selected=\"selected\"": ""); ?>>Yes</option>
					<option value="no"
						<?php echo (($essb_hidetwitter == "no") ? " selected=\"selected\"": ""); ?>>No</option>

			</select></td>
		</tr>		
		</table>

</div>
	
	
	<?php
}

function essb_register_advanced_metabox() {
	global $post;
	
	$essb_post_share_message = "";
	$essb_post_share_url = "";
	$essb_post_share_image = "";
	$essb_post_share_text = "";
	$essb_post_fb_url = "";
	$essb_post_plusone_url = "";
	
	if (isset ( $_GET ['action'] )) {
		$custom = get_post_custom ( $post->ID );
	
		// print_r($custom);
	
		$essb_post_share_message = isset ( $custom ["essb_post_share_message"] ) ? $custom ["essb_post_share_message"] [0] : "";
		$essb_post_share_url = isset ( $custom ["essb_post_share_url"] ) ? $custom ["essb_post_share_url"] [0] : "";
		$essb_post_share_image = isset ( $custom ["essb_post_share_image"] ) ? $custom ["essb_post_share_image"] [0] : "";
		$essb_post_share_text = isset ( $custom ["essb_post_share_text"] ) ? $custom ["essb_post_share_text"] [0] : "";
		$essb_post_fb_url = isset ( $custom ["essb_post_fb_url"] ) ? $custom ["essb_post_fb_url"] [0] : "";
		$essb_post_plusone_url = isset ( $custom ["essb_post_plusone_url"] ) ? $custom ["essb_post_plusone_url"] [0] : "";
	
		$essb_post_share_message = stripslashes($essb_post_share_message);
		$essb_post_share_text = stripslashes($essb_post_share_text);
	}
	
	?>
	
	<div class="essb">
	
	<table border="0" cellpadding="3" cellspacing="0" width="100%">
	<col width="30%"/>
	<col width="70%"/>
			<tr><td class="sub2" colspan="2">Share Buttons</td></tr>
				<tr class="even table-border-bottom">
					<td valign="top" class="bold">Custom Share Message:</td>
					<td class="essb_general_options"><input type="text" class="input-element stretched" id="essb_post_share_message" name="essb_post_share_message" value="<?php echo $essb_post_share_message; ?>"/></td>
				</tr>
				<tr class="odd table-border-bottom">
					<td valign="top" class="bold">Custom Share URL:</td>
					<td class="essb_general_options"><input type="text" class="input-element stretched" id="essb_post_share_url" name="essb_post_share_url" value="<?php echo $essb_post_share_url; ?>"/></td>
				</tr>
				<tr class="even table-border-bottom">
					<td valign="top" class="bold">Custom Share Image URL (Facebook, Pinterest only):</td>
					<td class="essb_general_options"><input type="text" class="input-element stretched" id="essb_post_share_image" name="essb_post_share_image" value="<?php echo $essb_post_share_image; ?>"/></td>
				</tr>
								<tr class="odd table-border-bottom">
					<td valign="top" class="bold">Custom Share Description (Facebook, Pinterest only):</td>
					<td class="essb_general_options"><textarea class="input-element stretched" id="essb_post_share_text" name="essb_post_share_text" rows="5"><?php echo $essb_post_share_text; ?></textarea></td>
				</tr>
			<tr><td class="sub2" colspan="2">Facebook Like and Google +1</td></tr>
				<tr class="even table-border-bottom">
					<td valign="top" class="bold">Address for Facebook Like Button:</td>
					<td class="essb_general_options"><input type="text" class="input-element stretched" id="essb_post_fb_url" name="essb_post_fb_url" value="<?php echo $essb_post_fb_url; ?>"/></td>
				</tr>
											<tr class="odd table-border-bottom">
					<td valign="top" class="bold">Address for Google +1 Button:</td>
					<td class="essb_general_options"><input type="text" class="input-element stretched" id="essb_post_plusone_url" name="essb_post_plusone_url" value="<?php echo $essb_post_plusone_url ?>"/></td>
				</tr>
	</table>
	
	</div>
	
	<?php 
}

?>