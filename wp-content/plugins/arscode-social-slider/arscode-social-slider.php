<?php
/*
  Plugin Name: Social Slider by ARScode
  Description:
  Version: 2.9.3
  Author: ARScode
  Author URI: http://www.arscode.pro/
 */
require_once(dirname(__FILE__) . '/common.inc.php');
$fblb_db_version = 2;

function fblb_get_options()
{
	$options = get_option('FBLB_Options');
	return $options;
}

function fblb_options_page()
{
	global $TW_Languages, $GP_Languages, $FB_Locales;
	include 'fblb_options_page.php';
}

function fblb_admin()
{
	add_options_page('Social Slider', 'Social Slider', 'manage_options', 'fblb', 'fblb_options_page');
}

add_action('admin_menu', 'fblb_admin');

function fblb_update_ds_ids($post_ID)
{
	$fblb_pageds = $_POST['fblb_pageds'];
	$fblb_present = $_POST['fblb_present'];
	if (!$fblb_present)
	{
		return;
	}
	$ds_ids = fblb_get_ds_ids();
	if ($fblb_pageds)
	{
		array_push($ds_ids, $post_ID);
		$ds_ids = array_unique((array) $ds_ids);
	}
	if (!$fblb_pageds)
	{
		$in = array_search($post_ID, (array) $ds_ids);
		if ($in !== false)
		{
			unset($ds_ids[$in]);
		}
	}
	update_option('FBLB_Options_dsids', $ds_ids);
}

function fblb_get_ds_ids()
{
	$ds_ids = get_option('FBLB_Options_dsids');
	if (empty($ds_ids))
	{
		return array();
	}
	return $ds_ids;
}

function fblb_is_ds($post_ID)
{
	if (!$post_ID)
	{
		return false;
	}
	$ds_ids = fblb_get_ds_ids();
	if (empty($ds_ids))
	{
		return false;
	}
	return in_array($post_ID, (array) $ds_ids);
}

function fblb_admin_sidebar()
{
	global $post_ID;
	echo '<div id="socialsliderdiv" class="new-admin-wp25">';
	echo '	<div class="outer">';
	echo '		<div class="inner"><p>';
	echo '			<label for="fblb_pageds" class="selectit">';
	echo '				<input type="checkbox" name="fblb_pageds" id="fblb_pageds" ' . ( fblb_is_ds($post_ID) ? 'checked="checked"' : '') . ' /> Don\'t show social slider on this page';
	echo '			</label>';
	echo '			<input type="hidden" name="fblb_present" value="1" />';
	echo '		</p></div>';
	echo '	</div>';
	echo '</div>';
}

function fblb_get_post_types()
{
	$return = array();
	$post_types_excluded = array('attachment', 'revision', 'nav_menu_item', 'mediapage');
	$post_types = get_post_types(array('public' => true));
	foreach ($post_types as $post_type)
	{
		if (!in_array($post_type, $post_types_excluded))
		{
			$return[$post_type] = $post_type;
		}
	}
	return $return;
}

function fblb_admin_init()
{
	//wp_enqueue_style(
//			'fblb-css', plugins_url('/fblb.css', __FILE__)
//	);
	wp_enqueue_style(
			'fblb-css-admin', plugins_url('/fblb-admin.css', __FILE__)
	);
	wp_enqueue_style(
			'fblb-colorpicker', plugins_url('/colorpicker.css', __FILE__)
	);
	if ($_GET['page'] == 'fblb')
	{
		wp_enqueue_style(
				'fblb-ui', plugins_url('/ui-smoothness/jquery-ui-1.8.16.custom.css', __FILE__)
		);
	}
	/*
	  wp_enqueue_script(
	  'fblb-js', plugins_url('/js/userscripts.js', __FILE__), array('jquery')
	  );
	 */
	wp_enqueue_script(
			'fblb-colorpicker', plugins_url('/js/colorpicker.js', __FILE__), array('jquery')
	);
	/*
	  wp_enqueue_style(
	  'jquery-lionbars', plugins_url('/lionbars/lionbars.css', __FILE__)
	  );
	  wp_enqueue_script(
	  'jquery-lionbars', plugins_url('/lionbars/jquery.lionbars.0.3.min.js', __FILE__), array('jquery')
	  );
	 */
	//wp_enqueue_script(
	//'fblb-ui', plugins_url('/js/jquery-ui-1.8.16.custom.min.js', __FILE__), array('jquery')
	//);
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_style(
			'fblb-css-ie7', plugins_url('/ie7.css', __FILE__)
	);
	global $wp_styles;
	$wp_styles->add_data('fblb-css-ie7', 'conditional', 'lte IE 7');
	$post_types = fblb_get_post_types();
	foreach ($post_types as $post_type)
	{
		add_meta_box('fblb_admin_meta_box', 'Social Slider', 'fblb_admin_sidebar', $post_type, 'side', 'low');
	}
	add_action('save_post', 'fblb_update_ds_ids');
	fblb_init();
}

add_action('admin_init', 'fblb_admin_init');

// Facebook Widget
class SocialSliderWidget extends WP_Widget
{

	function SocialSliderWidget()
	{
		parent::WP_Widget(false, 'Social Facebook Widget');
	}

	function widget($args, $instance)
	{
		$options = fblb_get_options();
		$options['Width'] = $instance['Width'];
		$options['Height'] = $instance['Height'];
		$options['ShowFaces'] = $instance['ShowFaces'];
		$options['ShowStream'] = $instance['ShowStream'];
		$options['ShowHeader'] = $instance['ShowHeader'];
		$options['ColorScheme'] = $instance['ColorScheme'];
		$options['BorderColor'] = $instance['BorderColor'];
		include 'fblb_slider_widget.php';
	}

	function update($new_instance, $old_instance)
	{
		return $new_instance;
	}

	function form($instance)
	{
		if (!$instance['Width'])
		{
			$instance['Width'] = 300;
		}
		if (!$instance['Height'])
		{
			$instance['Height'] = 500;
		}
		if (!$instance['BorderColor'])
		{
			$instance['BorderColor'] = '#3b5998';
		}
		if (!$instance['ColorScheme'])
		{
			$instance['ColorScheme'] = 'light';
		}
		?>
		<table>
			<tr valign="top">
				<th scope="row"><label for="<?php echo $this->get_field_id('Width') ?>">Width</label></th>
				<td><input name="<?php echo $this->get_field_name('Width') ?>" type="text" id="<?php echo $this->get_field_id('Width') ?>" value="<?php echo $instance['Width'] ?>" class="small-text" /> px</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php echo $this->get_field_id('Height') ?>">Height</label></th>
				<td><input name="<?php echo $this->get_field_name('Height') ?>" type="text" id="<?php echo $this->get_field_id('Height') ?>" value="<?php echo $instance['Height'] ?>" class="small-text" /> px</td>
			</tr>
			<tr valign="top">
				<th scope="row">Show faces</th>
				<td> 
					<fieldset>
						<legend class="screen-reader-text"><span>Show faces</span></legend>
						<label for="<?php echo $this->get_field_id('ShowFaces') ?>">
							<input name="<?php echo $this->get_field_name('ShowFaces') ?>" <?php echo ($instance['ShowFaces'] ? 'checked' : '' ) ?> type="checkbox" id="<?php echo $this->get_field_id('ShowFaces') ?>" value="1" />
						</label>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Show stream</th>
				<td> 
					<fieldset>
						<legend class="screen-reader-text"><span>Show stream</span></legend>
						<label for="<?php echo $this->get_field_id('ShowStream') ?>">
							<input name="<?php echo $this->get_field_name('ShowStream') ?>" <?php echo ($instance['ShowStream'] ? 'checked' : '' ) ?> type="checkbox" id="<?php echo $this->get_field_id('ShowStream') ?>" value="1" />
						</label>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Show header</th>
				<td> 
					<fieldset>
						<legend class="screen-reader-text"><span>Show header</span></legend>
						<label for="<?php echo $this->get_field_id('ShowHeader') ?>">
							<input name="<?php echo $this->get_field_name('ShowHeader') ?>" <?php echo ($instance['ShowHeader'] ? 'checked' : '' ) ?> type="checkbox" id="<?php echo $this->get_field_id('ShowHeader') ?>" value="1" />
						</label>
					</fieldset>
				</td>
			</tr>


			<tr valign="top">
				<th scope="row"><label for="<?php echo $this->get_field_id('BorderColor') ?>">Border color</label></th>
				<td>
					<input maxlength="7" name="<?php echo $this->get_field_name('BorderColor') ?>" type="text" id="<?php echo $this->get_field_id('BorderColor') ?>" value="<?php echo $instance['BorderColor'] ?>" style="width: 70px;" class="small-text" /></div>

				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Color Scheme</th>
				<td> 
					<fieldset>
						<label for="<?php echo $this->get_field_id('ColorSchemelight') ?>">
							<input name="<?php echo $this->get_field_name('ColorScheme') ?>" <?php echo ($instance['ColorScheme'] == 'light' ? 'checked' : '' ) ?> type="radio" id="<?php echo $this->get_field_id('ColorSchemelight') ?>" value="light" />
							light
						</label>
						<label for="<?php echo $this->get_field_id('ColorSchemedark') ?>">
							<input name="<?php echo $this->get_field_name('ColorScheme') ?>" <?php echo ($instance['ColorScheme'] == 'dark' ? 'checked' : '' ) ?> type="radio" id="<?php echo $this->get_field_id('ColorSchemedark') ?>" value="dark" />
							dark
						</label>
					</fieldset>
				</td>
			</tr>
		</table>
		<?php
	}

}

// END Facebook Widget
// Twitter Widget
/*
class SocialSliderTwWidget extends WP_Widget
{

	function SocialSliderTwWidget()
	{
		parent::WP_Widget(false, 'Social Twitter Widget');
	}

	function widget($args, $instance)
	{
		$options = fblb_get_options();
		$options['TW_Width'] = $instance['TW_Width'];
		$options['TW_Height'] = $instance['TW_Height'];
		$options['TW_ShellBackground'] = $instance['TW_ShellBackground'];
		$options['TW_ShellText'] = $instance['TW_ShellText'];
		$options['TW_TweetBackground'] = $instance['TW_TweetBackground'];
		$options['TW_TweetText'] = $instance['TW_TweetText'];
		$options['TW_Links'] = $instance['TW_Links'];
		$options['TW_live'] = $instance['TW_live'];
		$options['TW_scrollbar'] = $instance['TW_scrollbar'];
		$options['TW_behavior'] = $instance['TW_behavior'];
		$options['TW_interval'] = $instance['TW_interval'];
		$options['TW_loop'] = $instance['TW_loop'];
		$options['TW_rpp'] = $instance['TW_rpp'];
		include 'fblb_tw_slider_widget.php';
	}

	function update($new_instance, $old_instance)
	{
		return $new_instance;
	}

	function form($instance)
	{
		if (!$instance['TW_Width'])
		{
			$instance['TW_Width'] = 300;
		}
		if (!$instance['TW_Height'])
		{
			$instance['TW_Height'] = 450;
		}
		if (!$instance['TW_ShellBackground'])
		{
			$instance['TW_ShellBackground'] = '#33ccff';
		}
		if (!$instance['TW_ShellText'])
		{
			$instance['TW_ShellText'] = '#ffffff';
		}
		if (!$instance['TW_TweetBackground'])
		{
			$instance['TW_TweetBackground'] = '#ffffff';
		}
		if (!$instance['TW_TweetText'])
		{
			$instance['TW_TweetText'] = '#000000';
		}
		if (!$instance['TW_Links'])
		{
			$instance['TW_Links'] = '#47a61e';
		}

		if (!$instance['TW_behavior'])
		{
			$instance['TW_behavior'] = 'all';
		}
		if (!$instance['TW_interval'])
		{
			$instance['TW_interval'] = 30;
		}

		if (!$instance['TW_rpp'])
		{
			$instance['TW_rpp'] = 5;
		}
		?>
		<table>
			<tr valign="top">
				<th scope="row"><label for="<?php echo $this->get_field_id('TW_Width') ?>">Width</label></th>
				<td><input name="<?php echo $this->get_field_name('TW_Width') ?>" type="text" id="<?php echo $this->get_field_id('TW_Width') ?>" value="<?php echo $instance['TW_Width'] ?>" class="small-text" /> px</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php echo $this->get_field_id('TW_Height') ?>">Height</label></th>
				<td><input name="<?php echo $this->get_field_name('TW_Height') ?>" type="text" id="<?php echo $this->get_field_id('TW_Height') ?>" value="<?php echo $instance['TW_Height'] ?>" class="small-text" /> px</td>
			</tr>

			<tr valign="top">
				<th scope="row">Poll for new results</th>
				<td> 
					<fieldset>
						<legend class="screen-reader-text"><span>Poll for new results</span></legend>
						<label for="<?php echo $this->get_field_id('TW_live') ?>">
							<input name="<?php echo $this->get_field_name('TW_live') ?>" <?php echo ($instance['TW_live'] ? 'checked' : '' ) ?> type="checkbox" id="<?php echo $this->get_field_id('TW_live') ?>" value="1" />
						</label>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Include scrollbar</th>
				<td> 
					<fieldset>
						<legend class="screen-reader-text"><span>Include scrollbar</span></legend>
						<label for="<?php echo $this->get_field_id('TW_scrollbar') ?>">
							<input name="<?php echo $this->get_field_name('TW_scrollbar') ?>" <?php echo ($instance['TW_scrollbar'] ? 'checked' : '' ) ?> type="checkbox" id="<?php echo $this->get_field_id('TW_scrollbar') ?>" value="1" />
						</label>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Behavior</th>
				<td> 
					<fieldset>
						<label for="<?php echo $this->get_field_id('TW_behaviordefaultall') ?>">
							<input name="<?php echo $this->get_field_name('TW_behavior') ?>" <?php echo ($instance['TW_behavior'] == 'all' ? 'checked' : '' ) ?> type="radio" id="<?php echo $this->get_field_id('TW_behaviordefaultall') ?>" value="all" />
							Load all tweets
						</label>
						<br />
						<label for="<?php echo $this->get_field_id('TW_behaviordefault') ?>">
							<input name="<?php echo $this->get_field_name('TW_behavior') ?>" <?php echo ($instance['TW_behavior'] == 'default' ? 'checked' : '' ) ?> type="radio" id="<?php echo $this->get_field_id('TW_behaviordefault') ?>" value="default" />
							Timed Interval:
						</label>
						<div style="margin-left: 10px;">
							Tweet Interval <input name="<?php echo $this->get_field_name('TW_interval') ?>" type="text" id="<?php echo $this->get_field_id('TW_interval') ?>" value="<?php echo $instance['TW_interval'] ?>" class="small-text" />
							<br />
							Loop results <input name="<?php echo $this->get_field_name('TW_loop') ?>" <?php echo ($instance['TW_loop'] ? 'checked' : '' ) ?> type="checkbox" id="<?php echo $this->get_field_id('TW_loop') ?>" value="1" />
						</div>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php echo $this->get_field_id('TW_rpp') ?>">Number of Tweets</label></th>
				<td><input name="<?php echo $this->get_field_name('TW_rpp') ?>" type="text" id="<?php echo $this->get_field_id('TW_rpp') ?>" value="<?php echo $instance['TW_rpp'] ?>" class="small-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php echo $this->get_field_id('TW_ShellBackground') ?>">Shell background</label></th>
				<td>
					<input maxlength="7" name="<?php echo $this->get_field_name('TW_ShellBackground') ?>" type="text" id="<?php echo $this->get_field_id('TW_ShellBackground') ?>" value="<?php echo $instance['TW_ShellBackground'] ?>" style="float: left; width: 70px;" class="small-text" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php echo $this->get_field_id('TW_ShellText') ?>">Shell text</label></th>
				<td>
					<input maxlength="7" name="<?php echo $this->get_field_name('TW_ShellText') ?>" type="text" id="<?php echo $this->get_field_id('TW_ShellText') ?>" value="<?php echo $instance['TW_ShellText'] ?>" style="float: left; width: 70px;" class="small-text" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php echo $this->get_field_id('TW_TweetBackground') ?>">Tweet background</label></th>
				<td>
					<input maxlength="7" name="<?php echo $this->get_field_name('TW_TweetBackground') ?>" type="text" id="<?php echo $this->get_field_id('TW_TweetBackground') ?>" value="<?php echo $instance['TW_TweetBackground'] ?>" style="float: left; width: 70px;" class="small-text" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php echo $this->get_field_id('TW_TweetText') ?>">Tweet text</label></th>
				<td>
					<input maxlength="7" name="<?php echo $this->get_field_name('TW_TweetText') ?>" type="text" id="<?php echo $this->get_field_id('TW_TweetText') ?>" value="<?php echo $instance['TW_TweetText'] ?>" style="float: left; width: 70px;" class="small-text" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="<?php echo $this->get_field_id('TW_Links') ?>">Links</label></th>
				<td>
					<input maxlength="7" name="<?php echo $this->get_field_name('TW_Links') ?>" type="text" id="<?php echo $this->get_field_id('TW_Links') ?>" value="<?php echo $instance['TW_Links'] ?>" style="float: left; width: 70px;" class="small-text" />
				</td>
			</tr>	
		</table>
		<?php
	}

}

// END Twitter Widget
*/

function fblb_register_widgets()
{
	register_widget('SocialSliderWidget');
	//register_widget('SocialSliderTwWidget');
}

add_action('widgets_init', 'fblb_register_widgets');

function fblb_install_db()
{
	global $wpdb, $fblb_db_version;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$sql = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "arscodess_gp` (
	  `id` varchar(255) NOT NULL,
	  `datetime` datetime NOT NULL,
	  `desc` text NOT NULL,
	  `plus` int(11) NOT NULL,
	  `upd` int(11) NOT NULL,
	   UNIQUE KEY `id` (`id`)
	  ) DEFAULT CHARSET=utf8;";
	dbDelta($sql);
	if (get_option("fblb_db_version") < $fblb_db_version)
	{
		//$sql = "ALTER TABLE `" . $wpdb->prefix . "arscodess_gp` ADD `upd` INT( 11 ) NOT NULL";
		//$wpdb->query($sql);
	}
	$sql = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "arscodess_pi` (
	  `guid` varchar(255) NOT NULL,
	  `datetime` datetime NOT NULL,
	  `description` text NOT NULL,
	  `title` varchar(255) NOT NULL,
	  `link` varchar(255) NOT NULL,
	  `upd` int(11) NOT NULL,
	   UNIQUE KEY `guid` (`guid`)
	  )  DEFAULT CHARSET=utf8;";
	dbDelta($sql);
	add_option("fblb_db_version", $fblb_db_version);
}

register_activation_hook(__FILE__, 'fblb_install_db');

function fblb_getgpfeed()
{
	global $wpdb;
	$upd = time();
	$options = fblb_get_options();
	$GPlusID = $options['GP_PageID'];
	if (!$GPlusID)
	{
		return false;
	}
	$UserAgentList = array();
	$UserAgentList[] = "Mozilla/4.0 (compatible; MSIE 6.0; X11; Linux i686; en) Opera 8.01";
	$UserAgentList[] = "Mozilla/5.0 (compatible; Konqueror/3.3; Linux) (KHTML, like Gecko)";
	$UserAgentList[] = "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/15.0.874.121 Safari/535.2";
	$UserAgentList[] = "Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.9.2.25) Gecko/20111212 Firefox/3.6.25";
	$UserAgentList[] = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/534.52.7 (KHTML, like Gecko) Version/5.1.2 Safari/534.52.7";
	$UserAgentList[] = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; Win64; x64; SV1; .NET CLR 2.0.50727)";
	$UserAgentList[] = "Mozilla/5.0 (Windows NT 6.1; rv:8.0.1) Gecko/20100101 Firefox/8.0.1";
	$UserAgentList[] = "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.63 Safari/535.7";
	
	$GPKeys = array();
	$GPKeys[] = "AIzaSyDDShc8_cybhU2boVaPxo0rVN78k2lXmqY"; //- ka
	$GPKeys[] = "IzaSyApPJnHy9T4mmKWrGckIPd2kNk3LmQcQPw"; //- ku
	$GPKeys[] = "AIzaSyCkvKQHLl90TlBmHhMSufH-yvWn8jmMYRI"; //- ar
	$GPKeys[] = "AIzaSyBg2uxs0c9GJDEtWAONPONNB2gp11IRsvE"; // -ku
	$GPKeys[] = "AIzaSyC4VSj7vI5uCre09nz-hCElOVDZtzIDfp8"; //- t2
	$GPKeys[] = "AIzaSyBRp77Yn8XJIRDkavYByUd3tJpJ32-DG_0";
	$Url = 'https://www.googleapis.com/plus/v1/people/' . $GPlusID . '/activities/public?key='.$GPKeys[array_rand($GPKeys)].'&maxResults=' . $options['GP_NumberofPosts'] . '&prettyprint=false&fields=items(id%2Ckind%2Cobject(attachments(displayName%2CfullImage%2Cid%2Cimage%2CobjectType%2Curl)%2Cid%2CobjectType%2Cplusoners%2Creplies%2Cresharers%2Curl)%2Cpublished%2Ctitle%2Curl%2Cverb)';
	$hcurl = curl_init();
	curl_setopt($hcurl, CURLOPT_URL, $Url);
	curl_setopt($hcurl, CURLOPT_USERAGENT, $UserAgentList[array_rand($UserAgentList)]);
	curl_setopt($hcurl, CURLOPT_TIMEOUT, 60);
	curl_setopt($hcurl, CURLOPT_CONNECTTIMEOUT, 1);
	curl_setopt($hcurl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($hcurl, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($hcurl);
	curl_close($hcurl);
	$Aresult = json_decode($result);

	//echo '<pre>';
	if(isset($Aresult->error))
	{
		return;
	}
	foreach ((array) $Aresult->items as $v)
	{
		//print_r($v);
		$desc = '';
		$img = '';
		$title = str_replace("\n\n", "\n", str_replace("\n\n", "\n", $v->title));
		if(!empty($v->object->attachments))
		{
		    foreach ($v->object->attachments as $at)
		    {
			    if ($at->objectType == 'photo')
			    {
				    $img = '<img src="' . $at->image->url . '" />';
			    }
		    }
		}
		$desc = '<a href="' . $v->url . '" rel="nofollow">' . $img . nl2br($title) . '</a>';
		$plus = $v->object->plusoners->totalItems;
		if ($desc)
		{
			$wpdb->query
					("REPLACE INTO `" . $wpdb->prefix . "arscodess_gp` SET 
			`id`='" . addslashes($v->id) . "',
			`datetime`='" . addslashes(date('Y-m-d H:i:s', strtotime($v->published))) . "',
			`desc`='" . addslashes($desc) . "',
			`plus`='" . addslashes($plus) . "',
			`upd`='" . addslashes($upd) . "'
			");
		}
	}
	$wpdb->query("DELETE FROM `" . $wpdb->prefix . "arscodess_gp` WHERE `upd`<>'" . addslashes($upd) . "'");
	//echo 'G+: DONE<br />';
}

function fblb_getpifeed()
{
	global $wpdb;
	$upd = time();
	$options = fblb_get_options();
	$PI_Username = $options['PI_Username'];
	if (!$PI_Username)
	{
		return false;
	}
	$UserAgentList[] = "Mozilla/4.0 (compatible; MSIE 6.0; X11; Linux i686; en) Opera 8.01";
	$UserAgentList[] = "Mozilla/5.0 (compatible; Konqueror/3.3; Linux) (KHTML, like Gecko)";
	$UserAgentList[] = "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/15.0.874.121 Safari/535.2";
	$UserAgentList[] = "Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.9.2.25) Gecko/20111212 Firefox/3.6.25";
	$UserAgentList[] = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/534.52.7 (KHTML, like Gecko) Version/5.1.2 Safari/534.52.7";
	$UserAgentList[] = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; Win64; x64; SV1; .NET CLR 2.0.50727)";
	$UserAgentList[] = "Mozilla/5.0 (Windows NT 6.1; rv:8.0.1) Gecko/20100101 Firefox/8.0.1";
	$UserAgentList[] = "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.63 Safari/535.7";
	$Url = 'http://www.pinterest.com/' . $PI_Username . '/feed.rss';
	$hcurl = curl_init();
	curl_setopt($hcurl, CURLOPT_URL, $Url);
	curl_setopt($hcurl, CURLOPT_USERAGENT, $UserAgentList[array_rand($UserAgentList)]);
	curl_setopt($hcurl, CURLOPT_TIMEOUT, 60);
	curl_setopt($hcurl, CURLOPT_CONNECTTIMEOUT, 1);
	curl_setopt($hcurl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($hcurl, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($hcurl);
	//echo $result;
	curl_close($hcurl);
	$data = new SimpleXMLElement($result);
	foreach ($data->channel->item as $item)
	{
		$item->description = str_replace('<a href="/pin/', '<a href="http://pinterest.com/pin/', $item->description);
		$wpdb->query("REPLACE INTO `" . $wpdb->prefix . "arscodess_pi` SET 
		`guid`='" . addslashes($item->guid) . "',
		`datetime`='" . addslashes(date('Y-m-d H:i:s', strtotime($item->pubDate))) . "',
		`description`='" . addslashes($item->description) . "',
		`title`='" . addslashes($item->title) . "',
		`link`='" . addslashes($item->link) . "',
		`upd`='" . addslashes($upd) . "'
		");
	}
	$wpdb->query("DELETE FROM `" . $wpdb->prefix . "arscodess_pi` WHERE `upd`<>'" . addslashes($upd) . "'");
	//echo 'Pinterest: DONE<br />';
}

DEFINE('FBLB_DEMO', true);

function fblb_slider()
{
	global $is_IE, $wp_query, $fblb_preview_options, $post;

	if ($_REQUEST['Preset'] && FBLB_DEMO === true && !is_admin())
	{
		require(dirname(__FILE__) . '/config.inc.php');
		$fblb_preview_options = array_merge((array) fblb_get_options(), (array) $FBLB_Presets[$_GET['Preset']]['Options']);
	}
	if ($_REQUEST['preview'] && (is_admin() || FBLB_DEMO === true))
	{
		$options = $fblb_preview_options;
	}
	else
	{
		$options = fblb_get_options();
		if (fblb_is_ds($wp_query->post->ID))
		{
			return;
		}
		if ($options['DisableByGetParamN'] && $options['DisableByGetParamV'] && $_GET[$options['DisableByGetParamN']] == $options['DisableByGetParamV'])
		{
			return;
		}
	}
	if ($options['DisableHome'] && is_home())
	{
		return;
	}
	if ($options['DisableCategory'] && is_category())
	{
		return;
	}
	if ($options['DisableArchive'] && is_archive())
	{
		return;
	}
	if ($options['Enable'] == 1 && $options['FacebookPageURL'])
	{
		include 'fblb_slider.php';
	}
	if ($options['TW_Enable'] == 1 && $options['TW_Username'])
	{
		include 'fblb_tw_slider.php';
	}
	if ($options['GP_Enable'] == 1 && $options['GP_PageID'])
	{
		include 'fblb_gp_slider.php';
	}
	if ($options['YT_Enable'] == 1 && $options['YT_Channel'])
	{
		include 'fblb_yt_slider.php';
	}
	if ($options['LI_Enable'] == 1)
	{
		include 'fblb_li_slider.php';
	}
	if ($options['VI_Enable'] == 1)
	{
		include 'fblb_vi_slider.php';
	}
	if ($options['PI_Enable'] == 1)
	{
		include 'fblb_pi_slider.php';
	}
    if ($options['INST_Enable'] == 1)
	{
		include 'fblb_inst_slider.php';
	}
	if ($is_IE)
	{
		echo "<!--[if lte IE 7]>
		<script type='text/javascript' src='" . plugins_url('/js/', __FILE__) . "userscripts-ie7.js'></script>
		<![endif]-->";
	}
}

//function fblb_run_slider()
//{
//add_action('wp_footer', 'fblb_slider');
//}
function fblb_init()
{
	global $wp_styles, $fblb_preview_options;
	wp_enqueue_style(
			'fblb-css', plugins_url('/fblb.css', __FILE__)
	);
	!isset($_REQUEST['preview']) ? $_REQUEST['preview'] = 0 : 0;
	!isset($fblb_preview_options) ? $fblb_preview_options = array() : 1;
	if ($_REQUEST['preview'] && (is_admin() || FBLB_DEMO === true))
	{
		$options = $fblb_preview_options;
	}
	else
	{
		$options = fblb_get_options();
	}
	$DetectMobile = fblb_DetectMobile($_SERVER['HTTP_USER_AGENT']);
	!isset($options['MobileDevices']) ? $options['MobileDevices'] = 1 : 1;
	!isset($options['Behavior']) ? $options['Behavior'] = 1 : 1;
	if ($DetectMobile == true && $options['MobileDevices'] == 2)
	{
		return;
	}
	if ($options['Behavior'] == 2 || $DetectMobile == true)
	{
		wp_enqueue_script(
				'fblb-js-mod', plugins_url('/js/userscripts-mobile.js', __FILE__), array('jquery')
		);
	}
	else
	{
		wp_enqueue_script(
				'fblb-js', plugins_url('/js/userscripts.js', __FILE__), array('jquery')
		);
	}

	wp_enqueue_style(
			'jquery-lionbars', plugins_url('/lionbars/lionbars.css', __FILE__)
	);
	wp_enqueue_script(
			'jquery-lionbars', plugins_url('/lionbars/jquery.lionbars.0.3.min.js', __FILE__), array('jquery')
	);

	wp_enqueue_style(
			'fblb-css-ie7', plugins_url('/ie7.css', __FILE__)
	);
	$wp_styles->add_data('fblb-css-ie7', 'conditional', 'lte IE 7');
	add_action('wp_footer', 'fblb_slider');
}

add_action('init', 'fblb_init');

function fblb_cron_init()
{
	fblb_getgpfeed();
	fblb_getpifeed();
}

add_action('fblb_cron', 'fblb_cron_init');

if (!wp_next_scheduled('fblb_cron'))
{
	wp_schedule_event(current_time('timestamp'), 'hourly', 'fblb_cron');
}
?>