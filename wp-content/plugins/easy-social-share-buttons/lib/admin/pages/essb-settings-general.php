<?php

$msg = "";

$cmd = isset ( $_POST ['cmd'] ) ? $_POST ['cmd'] : '';



if ($cmd == "update") {
	$options = $_POST ['general_options'];
	
	
	$current_options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	
	// to resort
	//print_r($current_options ['networks']);
	
	foreach ( $current_options ['networks'] as $nw => $v ) {
		//print_r($current_options ['networks'] [$nw] );
		$current_options ['networks'] [$nw] [0] = 0;
	}
	
	$new_networks = array();
	
	foreach ( $options ['sort'] as $nw ) {
		$new_networks[$nw] =$current_options ['networks'] [$nw];
	}
	
	$current_options ['networks'] = $new_networks;
	
	foreach ( $options ['networks'] as $nw ) {
		$current_options ['networks'] [$nw] [0] = 1;
	}
	
	if (!isset($options['facebook_like_button'])) { $options['facebook_like_button'] = 'false'; }
	if (!isset($options['facebook_like_button_api'])) {
		$options['facebook_like_button_api'] = 'false';
	}
	
	if (!isset($options['googleplus'])) {
		$options['googleplus'] = 'false';
	}
	
	if (!isset($options['vklike'])) { $options['vklike'] = 'false'; }
	if (!isset($options['vklikeappid'])) {
		$options['vklikeappid'] = '';
	}

	// @since 1.0.5
	if (!isset($options['customshare'])) {
		$options['customshare'] = 'false';
	}
	if (!isset($options['customshare_text'])) {
		$options['customshare_text'] = '';
	}
	if (!isset($options['customshare_url'])) {
		$options['customshare_url'] = '';
	}
	
	if (!isset($options['customshare_imageurl'])) {
		$options['customshare_imageurl'] = '';
	}
	
	if (!isset($options['customshare_description'])) {
		$options['customshare_description'] = '';
	}
	
	if (!isset($options['pinterest_sniff_disable'])) {
		$options['pinterest_sniff_disable'] = 'false';
	}
	
	if (!isset($options['mail_copyaddress'])) {
		$options['mail_copyaddress'] = '';
	}
	
	if (!isset($options['otherbuttons_sameline'])) {
		$options['otherbuttons_sameline'] = 'false;';
	}
	
	if (!isset($options['twitterfollow'])) {
		$options['twitterfollow'] = 'false';
	}
	if (!isset($options['twitterfollowuser'])) {
		$options['twitterfollowuser'] = '';
	}
	
	if (!isset($options['url_short_native'])) {
		$options['url_short_native'] = 'false';
	}

	if (!isset($options['url_short_google'])) {
		$options['url_short_google'] = 'false';
	}

	if (!isset($options['twitteruser'])) {
		$options['twitteruser'] = '';
	}
	
	if (!isset($options['twitterhashtags'])) {
		$options['twitterhashtags'] = '';
	}
	
	if (!isset($options['twitter_nojspop'])) {
		$options['twitter_nojspop'] = 'false';
	}
	
	
	// @since 1.1.4
	if (!isset($options['custom_url_like'])) { $options['custom_url_like'] = 'false'; }
	if (!isset($options['custom_url_like_address'])) { $options['custom_url_like_address'] = ''; }
	if (!isset($options['custom_url_plusone_address'])) {
		$options['custom_url_plusone_address'] = '';
	}
	
	$current_options ['style'] = $options ['style'];
	$current_options['mail_subject'] = sanitize_text_field( $options['mail_subject'] );
	$current_options['mail_body'] = ( $options['mail_body'] );
	
	$current_options['facebook_like_button'] = $options['facebook_like_button'];
	$current_options['facebook_like_button_api'] = $options['facebook_like_button_api'];
	
	$current_options['googleplus'] = $options['googleplus'];

	$current_options['vklike'] = $options['vklike'];
	$current_options['vklikeappid'] = $options['vklikeappid'];
	
	$current_options['customshare'] = $options['customshare'];
	$current_options['customshare_url'] = $options['customshare_url'];
	$current_options['customshare_text'] = $options['customshare_text'];	

	$current_options['customshare_imageurl'] = $options['customshare_imageurl'];
	$current_options['customshare_description'] = $options['customshare_description'];
	
	$current_options['pinterest_sniff_disable'] = $options['pinterest_sniff_disable'];
	
	// @since 1.1
	$current_options['mail_copyaddress'] = $options['mail_copyaddress'];
	
	// @since 1.1.1
	$current_options['otherbuttons_sameline'] = $options['otherbuttons_sameline'];	
	$current_options['twitterfollow'] = $options['twitterfollow'];
	$current_options['twitterfollowuser'] = $options['twitterfollowuser'];

	$current_options['url_short_native'] = $options['url_short_native'];
	$current_options['url_short_google'] = $options['url_short_google'];	
	
	// @since 1.1.4
	$current_options['custom_url_like'] = $options['custom_url_like'];
	$current_options['custom_url_like_address'] = $options['custom_url_like_address'];
	
	$current_options['twitteruser'] = $options['twitteruser'];
	$current_options['twitterhashtags'] = $options['twitterhashtags'];
	$current_options['twitter_nojspop'] = $options['twitter_nojspop'];
	$current_options['custom_url_plusone_address'] = $options['custom_url_plusone_address'];
	
	update_option ( EasySocialShareButtons::$plugin_settings_name, $current_options );
	
	$msg = __ ( "Settings are saved", ESSB_TEXT_DOMAIN );
}

function essb_setting_checkbox_network_selection() {
	$y = $n = '';
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
		
	if (is_array ( $options )) {
		foreach ( $options ['networks'] as $k => $v ) {
			
			$is_checked = ($v [0] == 1) ? ' checked="checked"' : '';
			$network_name = isset ( $v [1] ) ? $v [1] : $k;		
			
			echo '<li><p style="margin: .2em 5% .2em 0;">
			<input id="network_selection_' . $k . '" value="' . $k . '" name="general_options[networks][]" type="checkbox"
			' . $is_checked . ' /><input name="general_options[sort][]" value="' . $k . '" type="checkbox" checked="checked" style="display: none; " />
			<label for="network_selection_' . $k . '"><span class="essb_icon essb_icon_' . $k . '"></span>' . $network_name . '</label>
			</p></li>';
		}
		
	
	}
}

function essb_facebook_likebutton() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['facebook_like_button']) ? $options ['facebook_like_button'] : 'false';
		
		$is_checked = ($exist == 'true') ? ' checked="checked"' : '';
		echo '<p style="margin: .2em 5% .2em 0;"><input id="fb_like" type="checkbox" name="general_options[facebook_like_button]" value="true" '.$is_checked.' /><label for="fb_like">Include Facebook Like Button</label></p>';
		
		$exist = isset($options ['facebook_like_button_api']) ? $options ['facebook_like_button_api'] : 'false';
		$is_checked = ($exist == 'true') ? ' checked="checked"' : '';
		echo '<p style="margin: .2em 5% .2em 0;"><input id="fb_like" type="checkbox" name="general_options[facebook_like_button_api]" value="true" '.$is_checked.' /><label for="fb_like">My site already uses Facebook Api</label></p>';
		
	}
}

function essb_plusone_button() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['googleplus']) ? $options ['googleplus'] : 'false';

		$is_checked = ($exist == 'true') ? ' checked="checked"' : '';
		echo '<p style="margin: .2em 5% .2em 0;"><input id="plusone" type="checkbox" name="general_options[googleplus]" value="true" '.$is_checked.' /><label for="plusone">Include Default Google+ Button</label></p>';


	}
}

function essb_vklike_button() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['vklike']) ? $options ['vklike'] : 'false';
	
		$is_checked = ($exist == 'true') ? ' checked="checked"' : '';
		echo '<p style="margin: .2em 5% .2em 0;"><input id="vklike" type="checkbox" name="general_options[vklike]" value="true" '.$is_checked.' /><label for="vklike">Include Default VKontakte (vk.com) Like Button</label></p>';
	
	}
	
}
function essb_vklike_button_appid() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['vklikeappid']) ? $options ['vklikeappid'] : '';
		
		echo '<p style="margin: .2em 5% .2em 0;"><input id="vklikeappid" type="text" name="general_options[vklikeappid]" value="'.$exist.'" class="input-element" /></p><span for="vklikeappid" class="small">If you don\'t have application id for your site you need to generate one on VKontakte (vk.com) Dev Site. To do this visit this page <a href="http://vk.com/dev.php?method=Like" target="_blank">http://vk.com/dev.php?method=Like</a> and follow instrunctions on page</span>';

	}

}

function essb_customshare_message () {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['customshare']) ? $options ['customshare'] : 'false';
	
		$is_checked = ($exist == 'true') ? ' checked="checked"' : '';
		echo '<input id="customshare" type="checkbox" name="general_options[customshare]" value="true" '.$is_checked.' />';
	
	}
	
}

function essb_customshare_message_text () {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {

		$exist = isset($options ['customshare_text']) ? $options ['customshare_text'] : '';
		
		echo '<input id="customshare_text" type="text" name="general_options[customshare_text]" value="'.$exist.'" class="input-element stretched" />';
		
	}

}

function essb_customshare_message_url () {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {

		$exist = isset($options ['customshare_url']) ? $options ['customshare_url'] : '';
		
		echo '<input id="customshare_url" type="text" name="general_options[customshare_url]" value="'.$exist.'" class="input-element stretched" />';
		
	}

}

function essb_customshare_message_imageurl () {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {

		$exist = isset($options ['customshare_imageurl']) ? $options ['customshare_imageurl'] : '';

		echo '<input id="customshare_imageurl" type="text" name="general_options[customshare_imageurl]" value="'.$exist.'" class="input-element stretched" />';

	}

}

function essb_customshare_message_description () {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {

		$exist = isset($options ['customshare_description']) ? $options ['customshare_description'] : '';

		echo '<textarea id="customshare_description" type="text" name="general_options[customshare_description]" class="input-element stretched" rows="5">' .$exist . "</textarea>";

	}

}

function essb_pinterest_sniff_disable() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['pinterest_sniff_disable']) ? $options ['pinterest_sniff_disable'] : 'false';

		$is_checked = ($exist == 'true') ? ' checked="checked"' : '';
		echo '<p style="margin: .2em 5% .2em 0;"><input id="pinterest_sniff_disable" type="checkbox" name="general_options[pinterest_sniff_disable]" value="true" '.$is_checked.' /></p>';
	}
}

function essb_template_select_radio() {
	
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$n1 = $n2 = $n3 = $n4 = $n5 = $n6 = $n7 = "";
		${'n' . $options ['style']} = " checked='checked'";
		
		echo '
			<input id="essb_style_1" value="1" name="general_options[style]" type="radio" ' . $n1 . ' />&nbsp;&nbsp;' . __ ( 'Default', ESSB_TEXT_DOMAIN ) . '<br /><img src="' . ESSB_PLUGIN_URL . '/assets/images/demo-style-default.png"/>
			<br/><br/>
			<input id="essb_style_2" value="2" name="general_options[style]" type="radio" ' . $n2 . ' />&nbsp;&nbsp;' . __ ( 'Metro', ESSB_TEXT_DOMAIN ) . '<br /><img src="' . ESSB_PLUGIN_URL . '/assets/images/demo-style-metro.png"/>
			<br/><br/>
			<input id="essb_style_3" value="3" name="general_options[style]" type="radio" ' . $n3 . ' />&nbsp;&nbsp;' . __ ( 'Modern', ESSB_TEXT_DOMAIN ) . '<br /><img src="' . ESSB_PLUGIN_URL . '/assets/images/demo-style-modern.png"/>
			<br/><br/>
			<input id="essb_style_4" value="4" name="general_options[style]" type="radio" ' . $n4 . ' />&nbsp;&nbsp;' . __ ( 'Round', ESSB_TEXT_DOMAIN ) . '<br /><img src="' . ESSB_PLUGIN_URL . '/assets/images/demo-style-round.png"/><br/><span class="small">Round style works correct only with Hide Social Network Names: <strong>Yes</strong>. If this option is not set to Yes please change its value or template will not render correct.</span>
			<br/><br/>
			<input id="essb_style_5" value="5" name="general_options[style]" type="radio" ' . $n5 . ' />&nbsp;&nbsp;' . __ ( 'Big', ESSB_TEXT_DOMAIN ) . '<br /><img src="' . ESSB_PLUGIN_URL . '/assets/images/demo-style-big.png"/>
			<br/><br/>
			<input id="essb_style_6" value="6" name="general_options[style]" type="radio" ' . $n6 . ' />&nbsp;&nbsp;' . __ ( 'Metro (Retina)', ESSB_TEXT_DOMAIN ) . '<br /><img src="' . ESSB_PLUGIN_URL . '/assets/images/demo-style-metro2.png"/>
			<br/><br/>
			<input id="essb_style_7" value="7" name="general_options[style]" type="radio" ' . $n7 . ' />&nbsp;&nbsp;' . __ ( 'Big (Retina)', ESSB_TEXT_DOMAIN ) . '<br /><img src="' . ESSB_PLUGIN_URL . '/assets/images/demo-style-big-retina.png"/>
			';
	}
}

function essb_setting_input_mail_subject() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (isset ( $options ['mail_subject'] ))
		echo '<input id="mail_subject" value="' . esc_attr ( $options ['mail_subject'] ) . '" name="general_options[mail_subject]" type="text"  class="input-element stretched"/>';
}
function essb_setting_textarea_mail_body() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (isset ( $options ['mail_body'] ))
		echo '<textarea id="mail_body" name="general_options[mail_body]" class="input-element stretched" rows="5">' . esc_textarea (stripslashes ( $options ['mail_body'] ) ) . '</textarea>';
}

function essb_setting_textarea_mail_copyaddress() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$value = isset ( $options ['mail_copyaddress'] ) ? $options ['mail_copyaddress'] : '';
		
			echo '<input id="mail_copyaddress" value="' . esc_attr ( $value ) . '" name="general_options[mail_copyaddress]" type="text"  class="input-element stretched"/>';
	}
}

function essb_display_other_onsame() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['otherbuttons_sameline']) ? $options ['otherbuttons_sameline'] : 'false';

		$is_checked = ($exist == 'true') ? ' checked="checked"' : '';
		echo '<p style="margin: .2em 5% .2em 0;"><input id="otherbuttons_sameline" type="checkbox" name="general_options[otherbuttons_sameline]" value="true" '.$is_checked.' /></p>';
	}
}

function essb_twitter_follow_button() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['twitterfollow']) ? $options ['twitterfollow'] : 'false';

		$is_checked = ($exist == 'true') ? ' checked="checked"' : '';
		echo '<p style="margin: .2em 5% .2em 0;"><input id="twitterfollow" type="checkbox" name="general_options[twitterfollow]" value="true" '.$is_checked.' /><label for="twitterfollow"></label></p>';

	}

}

function essb_custom_like_address() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['custom_url_like']) ? $options ['custom_url_like'] : 'false';

		$is_checked = ($exist == 'true') ? ' checked="checked"' : '';
		echo '<input id="custom_url_like" type="checkbox" name="general_options[custom_url_like]" value="true" '.$is_checked.' />';

	}

}

function essb_custom_like_address_url() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['custom_url_like_address']) ? $options ['custom_url_like_address'] : '';

		echo '<p style="margin: .2em 5% .2em 0;"><input id="custom_url_like_address" type="text" name="general_options[custom_url_like_address]" value="'.$exist.'" class="input-element stretched" /></p>';

	}

}

function essb_custom_plusone_address_url() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['custom_url_plusone_address']) ? $options ['custom_url_plusone_address'] : '';

		echo '<p style="margin: .2em 5% .2em 0;"><input id="custom_url_plusone_address" type="text" name="general_options[custom_url_plusone_address]" value="'.$exist.'" class="input-element stretched" /></p>';

	}

}


function essb_twitter_follow_button_user() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['twitterfollowuser']) ? $options ['twitterfollowuser'] : '';

		echo '<p style="margin: .2em 5% .2em 0;"><input id="twitterfollowuser" type="text" name="general_options[twitterfollowuser]" value="'.$exist.'" class="input-element" /></p>';

	}

}

function essb_url_short_native() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['url_short_native']) ? $options ['url_short_native'] : 'false';

		$is_checked = ($exist == 'true') ? ' checked="checked"' : '';
		echo '<p style="margin: .2em 5% .2em 0;"><input id="url_short_native" type="checkbox" name="general_options[url_short_native]" value="true" '.$is_checked.' /><label for="url_short_native"></label></p>';

	}

}

function essb_url_short_google() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['url_short_google']) ? $options ['url_short_google'] : 'false';

		$is_checked = ($exist == 'true') ? ' checked="checked"' : '';
		echo '<p style="margin: .2em 5% .2em 0;"><input id="url_short_google" type="checkbox" name="general_options[url_short_google]" value="true" '.$is_checked.' /><label for="url_short_native"></label></p>';

	}

}

function essb_twitter_username_append() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['twitteruser']) ? $options ['twitteruser'] : '';

		echo '<p style="margin: .2em 5% .2em 0;"><input id="twitteruser" type="text" name="general_options[twitteruser]" value="'.$exist.'" class="input-element" /></p><span for="twitteruser" class="small">If you wish a twitter username to be mentioned in tweet write it here. Enter your username without @ - example <span class="bold">twittername</span>. This text will be appended to tweet message at the end. Please note that if you activate custom share address option this will be added to custom share message.</span>';

	}

}

function essb_twitter_hashtags_append() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['twitterhashtags']) ? $options ['twitterhashtags'] : '';

		echo '<p style="margin: .2em 5% .2em 0;"><input id="twitterhashtags" type="text" name="general_options[twitterhashtags]" value="'.$exist.'" class="input-element" /></p><span for="twitterhashtags" class="small">If you wish hashtags to be added to message write theme here. You can set one or more (if more then one separate them with comma (,)) Example: demotag1,demotag2.</span>';

	}

}

function essb_twitter_dont_popup() {
	$options = get_option ( EasySocialShareButtons::$plugin_settings_name );
	if (is_array ( $options )) {
		$exist = isset($options ['twitter_nojspop']) ? $options ['twitter_nojspop'] : 'false';

		$is_checked = ($exist == 'true') ? ' checked="checked"' : '';
		echo '<p style="margin: .2em 5% .2em 0;"><input id="twitter_nojspop" type="checkbox" name="general_options[twitter_nojspop]" value="true" '.$is_checked.' /></p><span for="twitter_nojspop" class="small">If you have issue with Twitter share button opening same window but not share a tweet window activate this option to fix it.</span>';

	}

}

?>

<div class="essb">
	<div class="wrap">
	<?php
	
	if ($msg != "") {
		echo '<div class="success_message">' . $msg . '</div>';
	}
	
	?>
	
		<form name="general_form" method="post"
			action="admin.php?page=essb_settings&tab=general">
			<input type="hidden" id="cmd" name="cmd" value="update" />
			<table border="0" cellpadding="5" cellspacing="0" width="100%">
				<col width="25%" />
				<col width="75%" />
				<tr>
					<td colspan="2" class="sub"><?php _e('Social Network Settings', ESSB_TEXT_DOMAIN); ?></td>
				</tr>

				<tr class="even table-border-bottom">
					<td valign="top" class="bold"><?php _e('Template:', ESSB_TEXT_DOMAIN); ?><br/><span class="label" style="font-weight: 400;">This will be your default theme for site. You are able to select different theme for each post/page.</span></td>
					<td><?php essb_template_select_radio(); ?></td>
				</tr>
				<tr class="odd table-border-bottom">
					<td valign="top" class="bold"><?php _e('Social Networks:', ESSB_TEXT_DOMAIN); ?><br/><span class="label" style="font-weight: 400;">Select networks that you wish to appear in your list. With drag and drop you can rearrange them.</span></td>
					<td class="essb_general_options"><ul id="networks-sortable"><?php essb_setting_checkbox_network_selection(); ?></ul></td>
				</tr>
				<tr class="table-border-bottom">
					<td colspan="2" class="sub2">Twitter Additional Options</td>
				</tr>
				<tr class="even table-border-bottom">
					<td class="bold" valign="top">Twitter username to be mentioned:</td>
					<td class="essb_general_options"><?php essb_twitter_username_append(); ?></td>
				</tr>
				<tr class="odd table-border-bottom">
					<td class="bold" valign="top">Twitter hashtags to be added:</td>
					<td class="essb_general_options"><?php essb_twitter_hashtags_append(); ?></td>
				</tr>
				<tr class="even table-border-bottom">
					<td class="bold" valign="top">Don't use popup window for Tweeter Share:</td>
					<td class="essb_general_options"><?php essb_twitter_dont_popup(); ?></td>
				</tr>
				<tr class="table-border-bottom">
					<td colspan="2" class="sub2">Pinterest Additional Options</td>
				</tr>
				<tr class="odd">
					<td class="bold" valign="top">Disable Pinterest sniff for images:</td>
					<td><?php essb_pinterest_sniff_disable(); ?></td>
				</tr>
				<tr class="odd table-border-bottom">
					<td>&nbsp;</td>
					<td class="small">If you disable Pinterest sniff for images plugin will use for share post featured image or custom share image you provide.</td>
				</tr>
				<tr>
					<td colspan="2" class="sub"><?php _e('Social Network Native Buttons', ESSB_TEXT_DOMAIN); ?></td>					
				</tr>
				<tr class="odd">
					<td class="bold" valign="top">Disaply on same line:</td>
					<td><?php essb_display_other_onsame(); ?></td>
				</tr>
				<tr class="odd table-border-bottom">
					<td></td>
					<td class="small">Activating this option will display native social network buttons on same line with share buttons.</td>
				</tr>
								<tr class="table-border-bottom">
					<td colspan="2" class="sub2">Facebook Like</td>
				</tr>
				<tr class="even">
					<td valign="top" class="bold">Facebook Like Button</td>
					<td class="essb_general_options"><?php essb_facebook_likebutton(); ?></td>
				</tr>
				<tr class="even table-border-bottom">
					<td></td>
					<td class="small">According to Facebook Policy Like button must not be modified! Turning this options will include default Like button from Facebook Social Plugins.
				</tr>
												<tr class="table-border-bottom">
					<td colspan="2" class="sub2">Google +1</td>
				</tr>
				<tr class="odd table-border-bottom">
					<td valign="top" class="bold">Google Plus Button</td>
					<td class="essb_general_options"><?php essb_plusone_button(); ?></td>
				</tr>
												<tr class="table-border-bottom">
					<td colspan="2" class="sub2">VKontankte (vk.com) Like</td>
				</tr>
				<tr class="even table-border-bottom">
					<td valign="top" class="bold">VKontakte (vk.com) Like Button:</td>
					<td class="essb_general_options"><?php essb_vklike_button(); ?></td>
				</tr>
				<tr class="odd table-border-bottom">
					<td valign="top" class="bold">VKontakte (vk.com) Application ID:</td>
					<td class="essb_general_options"><?php essb_vklike_button_appid(); ?></td>
				</tr>
				
												<tr class="table-border-bottom">
					<td colspan="2" class="sub2">Twitter Follow</td>
				</tr>
				<tr class="odd table-border-bottom">
					<td valign="top" class="bold">Twitter Follow Button:</td>
					<td class="essb_general_options"><?php essb_twitter_follow_button(); ?></td>
				</tr>
				<tr class="even table-border-bottom">
					<td valign="top" class="bold">Twitter Follow User:</td>
					<td class="essb_general_options"><?php essb_twitter_follow_button_user(); ?></td>
				</tr>
				<tr class="table-border-bottom">
					<td colspan="2" class="sub2"><?php essb_custom_like_address(); ?>Activate Custom Like Address</td>
				</tr>
				<tr class="odd table-border-bottom">
					<td colspan="2" class="label"><i class="fa fa-info-circle fa-lg"></i><span class="label">&nbsp;This option allows you to send different address for native social network buttons to like. If you have activated custom share message this will overwrite address you send from custom share message options but only for social network native buttons.</span></td>
				</tr>
				<tr class="even table-border-bottom">
					<td class="bold" valign="middle">Address for Facebook Like Button:<br/><span class="label" style="font-weight: 400;">This can be your Facebook Fan Page url or other url address you wish people to like.</span></td>
					<td><?php essb_custom_like_address_url(); ?></td>
				</tr>
				<tr class="odd table-border-bottom">
					<td class="bold" valign="middle">Address for Google +1 Button:<br/><span class="label" style="font-weight: 400;">This can be your Google +1 Page url or other url address you wish people to like.</span></td>
					<td><?php essb_custom_plusone_address_url(); ?></td>
				</tr>
				<tr>
					<td colspan="2" class="sub"><?php _e('URL Shortener', ESSB_TEXT_DOMAIN); ?></td>					
				</tr>	
				<tr class="odd table-border-bottom">
					<td class="label" colspan="2"><i class="fa fa-info-circle fa-lg"></i><span class="label">&nbsp;Using shortlinks will generate unique shortlinks for pages/posts. If you have shared till now full address of you current post/page using shortlink will make counters of sharing to start from 0.</span></td>
				</tr>
				<tr class="even table-border-bottom">
					<td valign="top" class="bold">Use wp_get_shortlink():<br/><span class="label" style="font-weight: 400;">If you wish to share shortlink for your post or pages using build in WordPress shortlink function activate this option.</span></td>
					<td class="essb_general_options"><?php essb_url_short_native(); ?></td>
				</tr>
								<tr class="odd table-border-bottom">
					<td valign="top" class="bold">Use goo.gl to generate short URL:<br/><span class="label" style="font-weight: 400;">If you wish to use goo.gl service to generate shortlinks for your pages or posts activate this option.</span></td>
					<td class="essb_general_options"><?php essb_url_short_google(); ?></td>
				</tr>
				<tr>
					<td colspan="2" class="sub"><?php essb_customshare_message(); _e('Custom Share Message', ESSB_TEXT_DOMAIN); ?></td>					
				</tr>				
				<tr class="even table-border-bottom">
					<td valign="top" class="bold">Custom Share Message:<br/><span class="label" style="font-weight: 400;">This option allows you to pass custom message to share (not all networks support this).</span></td>
					<td class="essb_general_options"><?php essb_customshare_message_text(); ?></td>
				</tr>
				<tr class="odd table-border-bottom">
					<td valign="top" class="bold">Custom Share URL:<br/><span class="label" style="font-weight: 400;">This option allows you to pass custom url to share (all networks support this).</span></td>
					<td class="essb_general_options"><?php essb_customshare_message_url(); ?></td>
				</tr>
				<tr class="even table-border-bottom">
					<td valign="top" class="bold">Custom Share Image URL:<br/><span class="label" style="font-weight: 400;">This option allows you to pass custom image to your share message (only Facebok and Pinterest support this).</span></td>
					<td class="essb_general_options"><?php essb_customshare_message_imageurl(); ?></td>
				</tr>
								<tr class="odd table-border-bottom">
					<td valign="top" class="bold">Custom Share Description:<br/><span class="label" style="font-weight: 400;">This option allows you to pass custom extended description to your share message (only Facebok and Pinterest support this).</span></td>
					<td class="essb_general_options"><?php essb_customshare_message_description(); ?></td>
				</tr>
				<tr>
					<td colspan="2" class="sub"><?php _e('Customize E-mail Message', ESSB_TEXT_DOMAIN); ?></td>
				</tr>
				<tr>			
					<td class="label" colspan="2"><i class="fa fa-info-circle fa-lg"></i><span class="label">&nbsp;<?php _e('You can customize texts to display when visitors share your content by mail button. To perform customization, you can use <span class="bold">%%title%%</span>, <span class="bold">%%siteurl%%</span> or <span class="bold">%%permalink%%</span> variables.', ESSB_TEXT_DOMAIN); ?></span></td>
				</tr>

				</tr>
				<tr class="odd table-border-bottom">
					<td valign="top" class="bold"><?php _e('Message subject:', ESSB_TEXT_DOMAIN); ?></td>
					<td><?php essb_setting_input_mail_subject(); ?></td>
				</tr>
				<tr class="even table-border-bottom">
					<td valign="top" class="bold"><?php _e('Message body:', ESSB_TEXT_DOMAIN); ?></td>
					<td><?php essb_setting_textarea_mail_body(); ?></td>
				</tr>
				<tr class="odd table-border-bottom">
					<td valign="top" class="bold">Send copy of all messages to:</td>
					<td><?php essb_setting_textarea_mail_copyaddress(); ?></td>
				</tr>

			    <tr class="even table-border-bottom">
			      <td colspan="2"><?php echo '<input type="Submit" name="Submit" value="' . __ ( 'Update Settings', ESSB_TEXT_DOMAIN ) . '" class="button-primary" />'; ?></td>
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
