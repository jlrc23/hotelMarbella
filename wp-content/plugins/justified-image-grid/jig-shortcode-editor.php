<?php
	// this file is loaded in the modal window of tinyMCE
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Justified Image Grid shortcode editor</title>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo includes_url( 'js/tinymce/tiny_mce_popup.js' ); ?>"></script>
		<style type="text/css">
			label, .normalname, .minihelp {
				display: block;
				float: left;
				margin: 3px 0 5px 8px;
			}
			label {
				color: #3B5A99;
				width: 125px;
				text-align: right;
			}
			.normalname {
				width: 185px;
			}
			.minihelp {
				color: #666;
				width: 406px;
			}
			#insert {
				display: block;
				line-height: 24px;
				text-align: center;
				margin: 10px 0;
				width:100%;
				float: right;
				text-decoration:none;
			}
			#templateTagButton {
				color: #666;
				display: block;
				float: left;
				font-weight: normal;
				line-height: 24px;
				margin: 3px 0 5px 8px;
				padding: 0 6px;
				text-align: center;
				text-decoration: none;
				width: auto;
			}
			#templateTagButton:hover {
				color:#000;
			}
			#jig_button_parent{
				height: 40px;
			}
			#hint{
				color: green;
				margin-bottom: 15px;
			}
			select, input, #templateTag { 
				padding: 3px 5px;
				border: 1px solid #D1D1D6;
				border-radius: 3px 3px 3px 3px;
				width: 100px;
				margin: 0 0 0 8px;
				display: block;
				float: left;
			}
			select {
				width:112px;
			}
			#templateTag{
				width:233px;
				background:white;
			}
			#templateTagHelp, #templateTagContainer{
				display:none;
			}
			h3 {
				color: #000000;
				margin: 0;
				padding: 0 0 10px;
				font-size:13px;
			}
			.jig_settings_group {
				background: none repeat scroll 0 0 #E7E7EB;
				border: 1px solid #D1D1D6;
				border-radius: 6px 6px 6px 6px;
				margin-bottom: 15px;
				padding-bottom: 4px;
			}
			.row {
				clear: both;
				padding: 5px 0;
				height: 20px;
			}
			#preset_select {
				width: 220px;
			}
			#preset_minihelp {
				width: 295px;
			}
			.clearfix:after {
				content: ".";
				display: block;
				clear: both;
				visibility: hidden;
				line-height: 0;
				height: 0;
			}
			.clearfix {
				display: inline-block;
			}
			html[xmlns] .clearfix {
				display: block;
			}
			* html .clearfix {
				height: 1%;
			}
		</style>
		<script type="text/javascript">
			var shortcodes = [						"preset",
													"thumbs_spacing",
													"row_height",
													"animation_speed",
													"height_deviation",
													"link_class",
													"link_rel",
													"link_title_field",
													"img_alt_field",
													"caption_field",
													"caption",
													"caption_opacity",
													"caption_bg_color",
													"caption_text_color",
													"caption_text_shadow",
													"overlay",
													"overlay_color",
													"overlay_opacity",
													"desaturate",
													"lightbox",
													"lightbox_max_size",
													"min_height",
													"margin",
													"timthumb_path",
													"quality",
													"orderby",
													"mouse_disable",
													"id"]
			var sc_length = shortcodes.length;
			var JigShortcodeEditor = {
				local_ed : 'ed',
				init : function(ed) {
					JigShortcodeEditor.local_ed = ed;
					tinyMCEPopup.resizeToInnerSize();
					var sc = JigShortcodeEditor.local_ed.selection.getContent();
					var matches = sc.match(/([a-z_]*?)=([\d\sa-zA-Z_'"(),.:\/#\-]*)(?= [a-z_]*?|])/g)
					if(matches){
						var matches_length = matches.length;
						for(var i = 0; i<matches_length; i++){
							var attr = matches[i].split("=");
							jQuery('#jig-sc-editor input[name="'+attr[0]+'"]').val(attr[1])
							jQuery('#jig-sc-editor select[name="'+attr[0]+'"] option[value="'+attr[1]+'"]').attr('selected', true)
						}

					}
					if(sc.indexOf("[justified_image_grid")>-1){
						jQuery('#insert').text("<?php _e('Edit Shortcode', 'jig_td'); ?>")
						jQuery('#hint').remove()	
					}
					if(jQuery.browser.msie){
						jQuery('#insert').text("<?php _e('Edit Shortcode (remove the old shortcode once this is added)', 'jig_td'); ?>")
					}
				},
				insert : function insertButton(ed) {
					tinyMCEPopup.execCommand('mceRemoveNode', false, null);
					var output = '[justified_image_grid';
					for(var i = 0; i<sc_length; i++){
						var val = jQuery('#jig-sc-editor input[name="'+shortcodes[i]+'"]').val();
						if (val == undefined){
							val = jQuery('#jig-sc-editor select[name="'+shortcodes[i]+'"] option:selected').val(); 
						}
						if(val != '' && val != 'default' && val != undefined){
							output += ' '+shortcodes[i]+'='+val;
						}
					}
					output += ']'
					tinyMCEPopup.execCommand('mceReplaceContent', false, output);
					tinyMCEPopup.close();
				},
				templateTag : function (){
					if(jQuery('#jig-sc-editor input[name="id"]').val() != ''){
						var output = 'get_jig(array(';
						for(var i = 0; i<sc_length; i++){
							var val = jQuery('#jig-sc-editor input[name="'+shortcodes[i]+'"]').val();
							if (val == undefined){
								val = jQuery('#jig-sc-editor select[name="'+shortcodes[i]+'"] option:selected').val(); 
							}
							if(val != '' && val != 'default' && val != undefined){
								output += "'"+shortcodes[i]+"' => '"+val+"', ";
							}
						}
						output = output.substring(0,output.length-2);
						output += '));'

						var quotes = {"'\"":"'", "\"'":"'", "''":"'"};
						for (var val in quotes)
						    output = output.replace(new RegExp(val, "g"), quotes[val]);

						jQuery("#templateTagContainer").show().find("#templateTag").text('<'+'?php '+output+' ?'+'>').next().show()
					}else{
						jQuery("#templateTagContainer").show().find("#templateTag").text("<?php _e('Please set an ID in the General settings, otherwise the template tag will not work.', 'jig_td'); ?>").next().hide()
					}

				}
			};
			tinyMCEPopup.onInit.add(JigShortcodeEditor.init, JigShortcodeEditor);
			function getTemplateTag(){

			}
		</script>
	</head>
	<body>
		<div id="jig-sc-editor">
			<div id="hint"><?php _e('Hint: If you already have a shortcode in your post and you wish to edit its attributes instead of starting over:<br />Please close this popup, select the shortcode, then open this again. Your settings will be loaded.',  'jig_td'); ?></div>
			<form action="/" method="get" accept-charset="utf-8">
				<h3>Presets</h3>
				<div class="jig_settings_group clearfix">
					<div class="row">
						<div class="normalname"><?php _e('Preset',  'jig_td'); ?></div>
						<label>preset</label>
						<select name="preset" id="preset_select">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="1"><?php _e('Preset 1: Out of the box', 'jig_td'); ?></option>
							<option value="2"><?php _e("Preset 2: Author's favorite", 'jig_td'); ?></option>
							<option value="3"><?php _e('Preset 3: Flickr style', 'jig_td'); ?></option>
							<option value="4"><?php _e('Preset 4: Google+ style', 'jig_td'); ?></option>
							<option value="5"><?php _e('Preset 5: Fixed height, no fancy', 'jig_td'); ?></option>
							<option value="6"><?php _e('Preset 6: Artistic-zen', 'jig_td'); ?></option>
							<option value="7"><?php _e('Preset 7: Color magic fancy style', 'jig_td'); ?></option>
							<option value="8"><?php _e('Preset 8: Big images no click', 'jig_td'); ?></option>
							<option value="9"><?php _e('Preset 9: Focus on the text', 'jig_td'); ?></option>
						</select>
						<div class="minihelp" id="preset_minihelp"><?php _e("choose one of the 9 presets", 'jig_td'); ?></div>
					</div>
				</div>
				<h3>General settings</h3>
				<div class="jig_settings_group clearfix">
					<div class="row">
						<div class="normalname"><?php _e('Height of the rows',  'jig_td'); ?></div>
						<label>row_height</label>
						<input type="text" name="row_height" value='' />
						<div class="minihelp"><?php _e('target height in pixels: 200 without px', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Row height max deviation (+-)', 'jig_td'); ?></div>
						<label>height_deviation</label>
						<input type="text" name="height_deviation" value='' />
						<div class="minihelp"><?php _e('height +/- this value: 50 without px', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Spacing between the thumbnails',  'jig_td'); ?></div>
						<label>thumbs_spacing</label>
						<input type="text" name="thumbs_spacing" value='' />
						<div class="minihelp"><?php _e('0 or 4 or 10 etc... without px', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Margin around gallery',  'jig_td'); ?></div>
						<label>margin</label>
						<input type="text" name="margin" value='' />
						<div class="minihelp"><?php _e('CSS margin value: 10px or "0px 10px" (wrap shorthand with "")', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Animation speed',  'jig_td'); ?></div>
						<label>animation_speed</label>
						<input type="text" name="animation_speed" value='' />
						<div class="minihelp"><?php _e('as milliseconds: 200 is fast, 600 is slow', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Min height to avoid "jumping"',  'jig_td'); ?></div>
						<label>min_height</label>
						<input type="text" name="min_height" value='' />
						<div class="minihelp"><?php _e('to avoid jumping footer if you have no sidebar: 800 without px<br />don\'t set it higher than the gallery itself', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Order by',  'jig_td'); ?></div>
						<label>orderby</label>
						<select name="orderby">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="menu_order"><?php _e('Menu order', 'jig_td'); ?></option>
							<option value="rand"><?php _e("Random", 'jig_td'); ?></option>
							<option value="title_asc"><?php _e('Title ascending', 'jig_td'); ?></option>
							<option value="title_desc"><?php _e('Title descending', 'jig_td'); ?></option>
							<option value="date_asc"><?php _e('Date ascending', 'jig_td'); ?></option>
							<option value="date_desc"><?php _e('Date descending', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e("the order of the images", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Disable right mouse menu',  'jig_td'); ?></div>
						<label>mouse_disable</label>
						<select name="mouse_disable">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="no"><?php _e('No', 'jig_td'); ?></option>
							<option value="yes"><?php _e('Yes', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('choose yes if you wish to disable right click menu', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Other post/page id',  'jig_td'); ?></div>
						<label>ID</label>
						<input type="text" name="id" value='' />
						<div class="minihelp"><?php _e('to pull a gallery of other page/post: postID (number)', 'jig_td'); ?></div>
					</div>
				</div>
				<h3>Lightboxes</h3>
				<div class="jig_settings_group clearfix">
					<div class="row">
						<div class="normalname"><?php _e('Lightbox type',  'jig_td'); ?></div>
						<label>lightbox</label>
						<select name="lightbox">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="prettyphoto"><?php _e('prettyPhoto', 'jig_td'); ?></option>
							<option value="colorbox"><?php _e('ColorBox', 'jig_td'); ?></option>
							<option value="custom"><?php _e('Custom', 'jig_td'); ?></option>
							<option value="no"><?php _e('No', 'jig_td'); ?></option>
							<option value="links-off"><?php _e('Links-off', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('decide what happens when an image is clicked', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Link class(es)',  'jig_td'); ?></div>
						<label>link_class</label>
						<input type="text" name="link_class" value='' />
						<div class="minihelp"><?php _e("class of the image's anchor tag", 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Link rel',  'jig_td'); ?></div>
						<label>link_rel</label>
						<input type="text" name="link_rel" value='' />
						<div class="minihelp"><?php _e('no [], so format it like this: gallery(modal)<br />can also be set to auto for proper prettyPhoto deeplinking', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Maximum size for lightbox',  'jig_td'); ?></div>
						<label>lightbox_max_size</label>
						<select name="lightbox_max_size">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="large"><?php _e('Large', 'jig_td'); ?></option>
							<option value="full"><?php _e('Full', 'jig_td'); ?></option>
							<option value="medium"><?php _e('Medium', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('max size of the image that loads in the lightbox', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('WP field for link title',  'jig_td'); ?></div>
						<label>link_title_field</label>
						<select name="link_title_field">
							<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
							<option value="description"><?php _e('Description', 'jig_td'); ?></option>
							<option value="title"><?php _e('Title', 'jig_td'); ?></option>
							<option value="caption"><?php _e('Caption', 'jig_td'); ?></option>
							<option value="alternate"><?php _e('Alternate', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('choose a WP field as link title from the image details', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('WP field for img alt ',  'jig_td'); ?></div>
						<label>img_alt_field</label>
						<select name="img_alt_field">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="title"><?php _e('Title', 'jig_td'); ?></option>
								<option value="description"><?php _e('Description', 'jig_td'); ?></option>
								<option value="caption"><?php _e('Caption', 'jig_td'); ?></option>
								<option value="alternate"><?php _e('Alternate', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('choose a WP field as img alt from the image details', 'jig_td'); ?></div>
					</div>
				</div>
				<h3>Captions</h3>
				<div class="jig_settings_group clearfix">
					<div class="row">
						<div class="normalname"><?php _e('Caption style',  'jig_td'); ?></div>
						<label>caption</label>
						<select name="caption">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="fade"><?php _e('Fade', 'jig_td'); ?></option>
								<option value="slide"><?php _e('Slide', 'jig_td'); ?></option>
								<option value="mixed"><?php _e('Mixed', 'jig_td'); ?></option>
								<option value="fixed"><?php _e('Fixed', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('choose how would you like the caption to appear', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Caption opacity',  'jig_td'); ?></div>
						<label>caption_opacity</label>
						<input type="text" name="caption_opacity" value='' />
						<div class="minihelp"><?php _e('affects entire caption, a number between 0 and 1', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Caption background color',  'jig_td'); ?></div>
						<label>caption_bg_color</label>
						<input type="text" name="caption_bg_color" value='' />
						<div class="minihelp"><?php _e('any CSS color,<br />for opacity use rgba(0,0,0,0.3) only when the caption_opacity is 1', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Caption text color',  'jig_td'); ?></div>
						<label>caption_text_color</label>
						<input type="text" name="caption_text_color" value='' />
						<div class="minihelp"><?php _e('any CSS color except rgba', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('WP field to use for caption',  'jig_td'); ?></div>
						<label>caption_field</label>
						<select name="caption_field">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="description"><?php _e('Description', 'jig_td'); ?></option>
								<option value="caption"><?php _e('Caption', 'jig_td'); ?></option>
								<option value="alternate"><?php _e('Alternate', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('choose a WP field as caption description from the image details', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Text shadow',  'jig_td'); ?></div>
						<label>caption_text_shadow</label>
						<input type="text" name="caption_text_shadow" value='' />
						<div class="minihelp"><?php _e('"1px 1px 0px black" ("x, y, blur, color" respectively - wrap it within "")<br />it\'s only applied when caption_opacity is set to 1', 'jig_td'); ?></div>
					</div>
				</div>
				<h3>Color overlay</h3>
				<div class="jig_settings_group clearfix">
					<div class="row">
						<div class="normalname"><?php _e('Overlay type',  'jig_td'); ?></div>
						<label>overlay</label>
						<select name="overlay">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="others"><?php _e('Others', 'jig_td'); ?></option>
								<option value="hovered"><?php _e('Hovered', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('choose a behavior for the overlay', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Overlay opacity',  'jig_td'); ?></div>
						<label>overlay_opacity</label>
						<input type="text" name="overlay_opacity" value='' />
						<div class="minihelp"><?php _e('a number between 0 and 1', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Overlay color',  'jig_td'); ?></div>
						<label>overlay_color</label>
						<input type="text" name="overlay_color" value='' />
						<div class="minihelp"><?php _e('any CSS color except rgba', 'jig_td'); ?></div>
					</div>
				</div>
				<h3>Desaturate</h3>
				<div class="jig_settings_group clearfix">
					<div class="row">
						<div class="normalname"><?php _e('Desaturate method',  'jig_td'); ?></div>
						<label>desaturate</label>
						<select name="desaturate">
								<option value="default" selected="selected"><?php _e('default', 'jig_td'); ?></option>
								<option value="off"><?php _e('Off', 'jig_td'); ?></option>
								<option value="others"><?php _e('Others', 'jig_td'); ?></option>
								<option value="hovered"><?php _e('Hovered', 'jig_td'); ?></option>
								<option value="everything"><?php _e('Everything', 'jig_td'); ?></option>
						</select>
						<div class="minihelp"><?php _e('choose a behavior for the on the fly grayscale effect', 'jig_td'); ?></div>
					</div>
				</div>
				<h3>TimThumb</h3>
				<div class="jig_settings_group clearfix">
					<div class="row">
						<div class="normalname"><?php _e('TimThumb quality',  'jig_td'); ?></div>
						<label>quality</label>
						<input type="text" name="quality" value='' />
						<div class="minihelp"><?php _e('a number between 0 and 100, 90 is good quality', 'jig_td'); ?></div>
					</div>
					<div class="row">
						<div class="normalname"><?php _e('Custom TimThumb path',  'jig_td'); ?></div>
						<label>timthumb_path</label>
						<input type="text" name="timthumb_path" value='' />
						<div class="minihelp"><?php _e('absolute path (full URL)', 'jig_td'); ?></div>
					</div>
				</div>
				
				<h3>Template Tag</h3>
				<div class="jig_settings_group clearfix">
					<div class="row">
						<a href="javascript:JigShortcodeEditor.templateTag()" id="templateTagButton" class="updateButton"><?php _e('Generate template tag (optional / advanced users)',  'jig_td'); ?></a>
					</div>
					<div class="row" id="templateTagContainer">
						<div class="normalname"><?php _e('Template tag',  'jig_td'); ?>:</div>
						<div id="templateTag"></div>
						<div id="templateTagHelp" class="minihelp"><?php _e('add this to a PHP file of your template', 'jig_td'); ?></div>
						
					</div>
				</div>
				<div id="jig_button_parent">	
					<a href="javascript:JigShortcodeEditor.insert(JigShortcodeEditor.local_ed)" id="insert" style="display: block; line-height: 24px"><?php _e('Insert Shortcode', 'jig_td'); ?></a>
				</div>
			</form>
		</div>
	</body>
</html>
<?php
	// end of file
?>