<?php
/*
Plugin Name: Dynamic Step Process Panels
Plugin URI: http://codecanyon.net/item/dynamic-step-process-panels-for-wordpress/125748?ref=QuanticaLabs
Description: Dynamic Step Process Panels is a lightweight plugin for WordPress. It allows that any content can be represented in any number of tabs / steps.
Author: QuanticaLabs
Author URI: http://codecanyon.net/user/QuanticaLabs/portfolio?ref=QuanticaLabs
Version: 3.1
*/

//settings link
function dspp_settings_link($links) 
{ 
  $settings_link = '<a href="options-general.php?page=dspp_admin" title="Settings">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links;
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'dspp_settings_link' );

//activate plugin
function dspp_activate()
{
	global $wpdb;
	update_option('dspp_shortcode_settings_example1', array('kind' => 'stepByStep','markvisited' => 'false','style' => 'green-blue','firstselected' => 'true','icons' => 'true','imgfolder' => plugins_url("img", __FILE__),'chooseagain' => 'true','nextprevbuttons' => 'true','nextprevbuttonsposition' => 'bottom','nextbuttontitle' => 'Next step','prevbuttontitle' => 'Previous step','fadespeed' => '1000','event' => 'click','packed' => 'true','jquery' => 'true','aspopup' => 'no','beforeload' => 'function(){}','onload' => 'function(){}','onopen' => 'function(event, step, content, stepNumber){}','afteropen' => 'function(event, step, content, stepNumber){}','onhoverin' => 'function(event, step, stepNumber){}','onhoverout' => 'function(event, step, stepNumber){}','onopenpopup' => 'function(event, button, panel){}','onclosepopup' => 'function(event, button, panel){}','paneltag' => 'div','panelid' => 'processPanel_example1','panelclass' => 'dspp_panel dspp_clearfix','panelstyle' => '','panelaction' => '','panelmethod' => 'post','stepscount' => '3','title' => array (  0 => 'Description',  1 => 'Implementation - way 1',  2 => 'Implementation - way 2',),'tag' => array (  0 => 'a',  1 => 'a',  2 => 'a',),'href' => array (  0 => '#content1_example1',  1 => '#content2_example1',  2 => '#content3_example1',),'class' => array (  0 => '',  1 => '',  2 => '',),'label' => array (  0 => '1',  1 => '2',  2 => '3',),'content' => array (  0 => '<div class="title">Step one - description</div>
This example show the simplest way to implement Dynamic Step Process Panels.
<br><br>
Features:<br>
- 3 steps (width configurable in css),<br>
- first step selected,<br>
- step-by-step mode,<br>
- previous and next buttons,<br>
- step labels,<br>
- every step can be choosed again,<br>
- fade effect speed 1 second,<br>
- style green-blue',  1 => '<div class="title">Step two - implementation way 1</div>
All you got to do is insert WordPress shortcode, with specified id (defined in admin panel). For this example looks like this:<br><br><pre>&#91;dspp id=\\\'example1\\\'&#93;</pre>',  2 => '<div class="title">Step two - implementation way 2</div>
You can also use different way of implementation, using &#91;dspp_old&#93;, &#91;dspp_panel&#93;, &#91;dspp_step&#93; and &#91;dspp_content&#93; shortcodes. For this example looks like this:<br><br>
<pre>&#91;dspp_old&#93;
&#91;dspp_panel&#93;
	&#91;dspp_step href=\\\'#content1\\\' label=\\\'1\\\'&#93;Description&#91;/dspp_step&#93;
	&#91;dspp_step href=\\\'#content2\\\' label=\\\'2\\\'&#93;Implementation - way 1&#91;/dspp_step&#93;
	&#91;dspp_step href=\\\'#content3\\\' label=\\\'3\\\'&#93;Implementation - way 2&#91;/dspp_step&#93;
	&#91;dspp_content id=\\\'content1\\\'&#93;content for step 1&#91;/dspp_content&#93;
	&#91;dspp_content id=\\\'content2\\\'&#93;content for step 2&#91;/dspp_content&#93;
	&#91;dspp_content id=\\\'content3\\\'&#93;content for step 3&#91;/dspp_content&#93;
&#91;/dspp_panel&#93;</pre>
',),'contentfromfile' => array (  0 => '',  1 => '',  2 => '',),'contenttag' => array (  0 => 'div',  1 => 'div',  2 => 'div',),'contentid' => array (  0 => 'content1_example1',  1 => 'content2_example1',  2 => 'content3_example1',),'contentclass' => array (  0 => '',  1 => '',  2 => '',)));
	update_option('dspp_shortcode_settings_example2', array('kind' => 'freeChoice','markvisited' => 'true','style' => 'orange-gray','firstselected' => 'true','icons' => 'false','imgfolder' => plugins_url("img", __FILE__),'chooseagain' => 'true','nextprevbuttons' => 'false','nextprevbuttonsposition' => 'bottom','nextbuttontitle' => 'Next step','prevbuttontitle' => 'Previous step','fadespeed' => '1000','event' => 'click','packed' => 'true','jquery' => 'true','aspopup' => 'no','beforeload' => 'function(){}','onload' => 'function(){}','onopen' => 'function(event, step, content, stepNumber){
$(\\\'.message\\\').remove();
	if(stepNumber==2)
	{
		timesOpened++;
		content.prepend(\\"<div class=\\\'message\\\'>You\\\'ve opened this step \\" + timesOpened + \\" time\\" + (timesOpened>1 ? \\"s\\":\\"\\") + \\".</div>\\");
	}
}','afteropen' => 'function(event, step, content, stepNumber){}','onhoverin' => 'function(event, step, stepNumber){}','onhoverout' => 'function(event, step, stepNumber){}','onopenpopup' => 'function(event, button, panel){}','onclosepopup' => 'function(event, button, panel){}','paneltag' => 'div','panelwidth' => '','panelid' => 'processPanel_example2','panelclass' => 'dspp_panel','panelstyle' => '','panelaction' => '','panelmethod' => 'post','stepscount' => '4','title' => array (  0 => 'Description',  1 => 'Implementation-way 1',  2 => 'Implementation-way 2',  3 => 'Enjoy!',),'width' => array (  0 => '',  1 => '',  2 => '',  3 => '',),'tag' => array (  0 => 'a',  1 => 'a',  2 => 'a',  3 => 'a',),'href' => array (  0 => '#content1_example2',  1 => '#content2_example2',  2 => '#content3_example2',  3 => '#content4_example2',),'class' => array (  0 => 'p2Step1',  1 => 'p2Step2',  2 => 'p2Step3',  3 => 'p2Step4',),'label' => array (  0 => '',  1 => '',  2 => '',  3 => '',),'content' => array (  0 => '<div class="title">Step one - description</div>
					This example show Dynamic Step Process Panels without label icons, and next previous buttons. You don\\\'t have to move step-by-step.
<br><br>
Features:<br>
- 4 steps (width configurable in css),<br>
- free choice mode,<br>
- every step can be choosed again,<br>
- first step selected,<br>
- fade effect speed 1 second,<br>
- style orange-gray,<br>
- onOpen event implemented',  1 => '<div class="title">Step two - implementation way 1</div>
<pre>&lt;script type=\\\'text/javascript\\\'&gt;
var timesOpened = 0;
&lt;/script&gt;
&#91;dspp id=\\\'example2\\\'&#93;</pre>',  2 => '<div class="title">Step three - implementation way 2</div>
<pre>&#91;inline&#93;
&lt;script type=\\\'text/javascript\\\'&gt;
var timesOpened = 0;
function customOnOpen(event, step, content, stepNumber)
{
	$(\\\'.message\\\').remove();
	if(stepNumber==2)
	{
		timesOpened++;
		content.prepend(\\\'&lt;div class=\\\'message\\\'&gt;You\\\'ve opened this step \\\' + timesOpened + \\\' time\\\' + (timesOpened&gt;1 ? \\\'s\\\':\\\'\\\') + \\\'.&lt;/div&gt;\\\');
	}
}
&lt;/script&gt;
&#91;/inline&#93;

&#91;dspp_old id=\\\'processPanel2\\\' icons=\\\'false\\\' kind=\\\'freeChoice\\\' style=\\\'orange-gray\\\'
nextPrevButtons=\\\'false\\\' onOpen=\\\'customOnOpen\\\'&#93;
&#91;dspp_panel id=\\\'processPanel2\\\' class=\\\'panel\\\'&#93;
	&#91;dspp_step href=\\\'#p2content1\\\' class=\\\'p2Step1\\\'&#93;Description&#91;/dspp_step&#93;
	&#91;dspp_step href=\\\'#p2content2\\\' class=\\\'p2Step2\\\'&#93;Implementation - way 1&#91;/dspp_step&#93;
	&#91;dspp_step href=\\\'#p2content3\\\' class=\\\'p2Step3\\\'&#93;Implementation - way 2&#91;/dspp_step&#93;
	&#91;dspp_step href=\\\'#p2content4\\\' class=\\\'p2Step4\\\'&#93;Enjoy!&#91;/dspp_step&#93;
	&#91;dspp_content id=\\\'p2content1\\\'&#93;content for step 1&#91;/dspp_content&#93;
	&#91;dspp_content id=\\\'p2content2\\\'&#93;content for step 2&#91;/dspp_content&#93;
	&#91;dspp_content id=\\\'p2content3\\\'&#93;content for step 3&#91;/dspp_content&#93;
	&#91;dspp_content id=\\\'p2content4\\\'&#93;content for step 4&#91;/dspp_content&#93;
&#91;/dspp_panel&#93;</pre>',  3 => '<div class="title">Step four</div>
:)',),'contentfromfile' => array (  0 => '',  1 => '',  2 => '',  3 => '',),'contenttag' => array (  0 => 'div',  1 => 'div',  2 => 'div',  3 => 'div',),'contentid' => array (  0 => 'content1_example2',  1 => 'content2_example2',  2 => 'content3_example2',  3 => 'content4_example2',),'contentclass' => array (  0 => '',  1 => '',  2 => '',  3 => '',)));
	update_option('dspp_shortcode_settings_example3',array ('kind' => 'stepByStep','markvisited' => 'true','style' => 'blue-maroon','firstselected' => 'false','icons' => 'true','imgfolder' => plugins_url("img", __FILE__),'chooseagain' => 'true','nextprevbuttons' => 'true','nextprevbuttonsposition' => 'bottom','nextbuttontitle' => 'Next step','prevbuttontitle' => 'Previous step','fadespeed' => '500','event' => 'mouseover','packed' => 'true','jquery' => 'true','aspopup' => 'no','beforeload' => 'function(){}','onload' => 'function(){}','onopen' => 'function(event, step, content, stepNumber){}','afteropen' => 'function(event, step, content, stepNumber){}','onhoverin' => 'function(event, step, stepNumber){}','onhoverout' => 'function(event, step, stepNumber){}','onopenpopup' => 'function(event, button, panel){}','onclosepopup' => 'function(event, button, panel){}','paneltag' => 'div','panelwidth' => '','panelid' => 'processPanel_example3','panelclass' => 'dspp_panel dspp_clearfix','panelstyle' => '','panelaction' => '','panelmethod' => 'post','stepscount' => '4','title' => array (  0 => 'Description',  1 => 'Implementation',  2 => 'Step three',  3 => 'Step four',),'width' => array (  0 => '',  1 => '',  2 => '',  3 => '',),'tag' => array (  0 => 'a',  1 => 'a',  2 => 'a',  3 => 'a',),'href' => array (  0 => '#content1_example3',  1 => '#content2_example3',  2 => '#content3_example3',  3 => '#content4_example3',),'class' => array (  0 => 'p3Step1',  1 => 'p3Step2',  2 => 'p3Step3',  3 => 'p3Step4',),'label' => array (  0 => '1',  1 => '2',  2 => '3',  3 => '4',),'content' => array (  0 => '<div class="title">Step one - description</div>
This example show Dynamic Step Process Panels without opened the first step at the begin.<br><br>
						Features:<br>
						- 4 steps, <br>
						- first step is not opened at the begin,<br>
						- contents opens on mouseover,<br>
						- step-by-step mode,<br>
						- fade effect speed 0,5 second,<br>
						- style blue-maroon,<br>
						- previous and next buttons,<br>
						- step labels',  1 => '<div class="title">Step two - implementation</div>
<pre>&#91;dspp id=\\\'example3\\\'&#93;</pre>',  2 => '<div class="title">Step three</div>
Some content for step three',  3 => '<div class="title">Step four</div>
Some content for step four',),'contentfromfile' => array (  0 => '',  1 => '',  2 => '',  3 => '',),'contenttag' => array (  0 => 'div',  1 => 'div',  2 => 'div',  3 => 'div',),'contentid' => array (  0 => 'content1_example3',  1 => 'content2_example3',  2 => 'content3_example3',  3 => 'content4_example3',),'contentclass' => array (  0 => '',  1 => '',  2 => '',  3 => '',)));
	update_option('dspp_shortcode_settings_example4', array ('kind' => 'stepByStep','markvisited' => 'true','style' => 'blue-orange','firstselected' => 'true','icons' => 'true','imgfolder' => plugins_url("img", __FILE__),'chooseagain' => 'true','nextprevbuttons' => 'true','nextprevbuttonsposition' => 'bottom','nextbuttontitle' => 'Next step','prevbuttontitle' => 'Previous step','fadespeed' => '1000','event' => 'click','packed' => 'true','jquery' => 'true','aspopup' => 'no','beforeload' => 'function(){}','onload' => 'function(){}','onopen' => 'function(event, step, content, stepNumber){if(stepNumber==2)
						{
							$(\\\'#content1_example4 .alert\\\').remove();
							if($(\\\'[name=name]\\\').val()==\\\'\\\')
							{
								$(\\\'#content1_example4\\\').prepend(\\"<div class=\\\'alert\\\'>Please enter your name!</div>\\");
								return false;
							}
						}
						else if(stepNumber==3)
						{
							$(\\\'#content2_example4 .alert\\\').remove();
							if(!checkEmail($(\\\'[name=email]\\\').val()))
							{
								$(\\\'#content2_example4\\\').prepend(\\"<div class=\\\'alert\\\'>Please enter valid e-mail address!</div>\\");
								return false;
							}
						}
}','afteropen' => 'function(event, step, content, stepNumber){}','onhoverin' => 'function(event, step, stepNumber){}','onhoverout' => 'function(event, step, stepNumber){}','onopenpopup' => 'function(event, button, panel){}','onclosepopup' => 'function(event, button, panel){}','paneltag' => 'form','panelwidth' => '','panelid' => 'processPanel_example4','panelclass' => 'dspp_panel','panelstyle' => '','panelaction' => 'formProcessor.php','panelmethod' => 'post','stepscount' => '3','title' => array (  0 => 'Description',  1 => 'Implementation - way 1',  2 => 'Implementation - way 2',),'width' => array (  0 => '',  1 => '',  2 => '',),'tag' => array (  0 => 'a',  1 => 'a',  2 => 'a',),'href' => array (  0 => '#content1_example4',  1 => '#content2_example4',  2 => '#content3_example4',),'class' => array (  0 => '',  1 => '',  2 => '',),'label' => array (  0 => '1',  1 => '2',  2 => '3',),'content' => array (  0 => '<div class="title">Step one - description</div>
						<div style="width:372px;float:left;margin-right:10px;">
							This example shows how to integrate Dynamic Step Process Panels with form.<br><br>
							Features:<br>
							- 3 steps (width configurable in css), <br>
							- custom form validation, <br>
							- first step selected,<br>
							- step-by-step mode,<br>
							- previous and next buttons,<br>
							- step labels,<br>
							- every step can be choosed again,<br>
							- fade effect speed 1 second,<br>
							- style blue-orange
						</div>
						<div style="width:372px;float:left;">
							Please enter your name before you go to the second step:<br>
							name: <input name="name" type="text">
						</div>',  1 => '<div class="title">Step two - implementation way 1</div>
						<div>
							Please enter your e-mail before you go to the third step:<br>
							e-mail: <input name="email" type="text">
						</div>
						<div>
						Source code available after purchase
						</div>',  2 => '<div class="title">Step three - implementation way 2</div>
						<div>
							2+3= <input name="check" type="text">&nbsp;<input value="Submit" type="submit">
						</div>
						<div style="margin-top: 5px;">
							Source code available after purchase
						</div>',),'contentfromfile' => array (  0 => '',  1 => '',  2 => '',),'contenttag' => array (  0 => 'fieldset',  1 => 'fieldset',  2 => 'fieldset',),'contentid' => array (  0 => 'content1_example4',  1 => 'content2_example4',  2 => 'content3_example4',),'contentclass' => array (  0 => '',  1 => '',  2 => '',)));
	
	update_option('dspp_shortcode_settings_example5', array ('kind' => 'freeChoice','markvisited' => 'true','style' => 'maroon-gray','firstselected' => 'true','icons' => 'false','imgfolder' => plugins_url("img", __FILE__),'chooseagain' => 'true','nextprevbuttons' => 'true','nextprevbuttonsposition' => 'bottom','nextbuttontitle' => 'Next step','prevbuttontitle' => 'Previous step','fadespeed' => '1000','event' => 'click','packed' => 'true','jquery' => 'true','aspopup' => 'yes','beforeload' => 'function(){}','onload' => 'function(){}','onopen' => 'function(event, step, content, stepNumber){}','afteropen' => 'function(event, step, content, stepNumber){}','onhoverin' => 'function(event, step, stepNumber){}','onhoverout' => 'function(event, step, stepNumber){}','onopenpopup' => 'function(event, button, panel){}','onclosepopup' => 'function(event, button, panel){}','paneltag' => 'div','panelwidth' => '','panelid' => 'processPanel_example5','panelclass' => 'dspp_panel dspp_popup','panelstyle' => '','panelaction' => '','panelmethod' => 'post','stepscount' => '5','title' => array (  0 => 'Description',  1 => 'Implementation',  2 => 'Step three',  3 => 'Step four',  4 => 'Step five',),'width' => array (  0 => '',  1 => '',  2 => '',  3 => '',  4 => '',),'tag' => array (  0 => 'a',  1 => 'a',  2 => 'a',  3 => 'a',  4 => 'a',),'href' => array (  0 => '#content1_example5',  1 => '#content2_example5',  2 => '#content3_example5',  3 => '#content4_example5',  4 => '#content5_example5',),'class' => array (  0 => 'p4Step1',  1 => 'p4Step2',  2 => 'p4Step3',  3 => 'p4Step4',  4 => 'p4Step5',),'label' => array (  0 => '',  1 => '',  2 => '',  3 => '',  4 => '',),'content' => array (  0 => '<div class="title">Step one - description</div>
This example show Dynamic Step Process Panels displayed as a popup. To close popup just click somewhere outside it.
<br><br>
Features:<br>
- displayed as a popup,<br>
- 5 steps,<br>
- diffrent steps width,<br>
- free choice mode,<br>
- first step selected,<br>
- every step can be choosed again,<br>
- fade effect speed 1 second,<br>
- style maroon-gray,<br>
- previous and next buttons',  1 => '<div class="title">Step two - Implementation</div>
<pre>&lt;a class=\\\'button_gray buttonPopup\\\' href=\\\'#processPanel_example5-popup\\\'\\\'&gt;&lt;/a&gt;
&#91;dspp id=\\\'example5\\\'&#93;',  2 => '<div class="title">Step three</div>
Some content for step three',  3 => '<div class="title">Step four</div>
Some content for step four',  4 => '<div class="title">Step five</div>
Some content for step five',),'contentfromfile' => array (  0 => '',  1 => '',  2 => '',  3 => '',  4 => '',),'contenttag' => array (  0 => 'div',  1 => 'div',  2 => 'div',  3 => 'div',  4 => 'div',),'contentid' => array (  0 => 'content1_example5',  1 => 'content2_example5',  2 => 'content3_example5',  3 => 'content4_example5',  4 => 'content5_example5',),'contentclass' => array (  0 => '',  1 => '',  2 => '',  3 => '',  4 => '',)));

	update_option('dspp_shortcode_settings_example6', array ('kind' => 'stepByStep','markvisited' => 'true','style' => 'green-orange','firstselected' => 'true','icons' => 'true','imgfolder' => plugins_url("img", __FILE__),'chooseagain' => 'true','nextprevbuttons' => 'true','nextprevbuttonsposition' => 'bottom','nextbuttontitle' => 'show next','prevbuttontitle' => 'show previous','fadespeed' => '1000','event' => 'click','packed' => 'true','jquery' => 'true','aspopup' => 'yes','beforeload' => 'function(){}','onload' => 'function(){}','onopen' => 'function(event, step, content, stepNumber){}','afteropen' => 'function(event, step, content, stepNumber){}','onhoverin' => 'function(event, step, stepNumber){}','onhoverout' => 'function(event, step, stepNumber){}','onopenpopup' => 'function(event, button, panel){}','onclosepopup' => 'function(event, button, panel){}','paneltag' => 'div','panelwidth' => '','panelid' => 'processPanel_example6','panelclass' => 'dspp_panel dspp_popup','panelstyle' => '','panelaction' => '','panelmethod' => 'post','stepscount' => '3','title' => array (  0 => 'Description',  1 => 'Implementation',  2 => 'Step three',),'width' => array (  0 => '',  1 => '',  2 => '',),'tag' => array (  0 => 'a',  1 => 'a',  2 => 'a',),'href' => array (  0 => '#content1_example6',  1 => '#content2_example6',  2 => '#content3_example6',),'class' => array (  0 => '',  1 => '',  2 => '',),'label' => array (  0 => '1',  1 => '2',  2 => '3',),'content' => array (  0 => '&nbsp;',  1 => '&nbsp;',  2 => '<div class="title">Step three</div>
				Static content<br>
				<div style="text-align: center;">
				Some content for step three<br>
				<img src="img/live_preview_img/quantica.jpg">
				</div>',),'contentfromfile' => array (  0 => 'step1Content.html',  1 => 'step2Content.html',  2 => '',),'contenttag' => array (  0 => 'div',  1 => 'div',  2 => 'div',),'contentid' => array (  0 => 'content1_example6',  1 => 'content2_example6',  2 => 'content3_example6',),'contentclass' => array (  0 => '',  1 => '',  2 => '',)));

	update_option('dspp_shortcode_settings_example7', array ('kind' => 'stepByStep','markvisited' => 'true','style' => 'blue-orange','firstselected' => 'true','icons' => 'true','imgfolder' => plugins_url("img", __FILE__),'chooseagain' => 'false','nextprevbuttons' => 'true','nextprevbuttonsposition' => 'bottom','nextbuttontitle' => 'Next step','prevbuttontitle' => 'Previous step','fadespeed' => '0','event' => 'click','packed' => 'true','jquery' => 'true','aspopup' => 'yes','beforeload' => 'function(){}','onload' => 'function(){}','onopen' => 'function(event, step, content, stepNumber){}','afteropen' => 'function(event, step, content, stepNumber){}','onhoverin' => 'function(event, step, stepNumber){}','onhoverout' => 'function(event, step, stepNumber){}','onopenpopup' => 'function(event, button, panel){}','onclosepopup' => 'function(event, button, panel){}','paneltag' => 'div','panelwidth' => '','panelid' => 'processPanel_example7','panelclass' => 'dspp_panel dspp_popup','panelstyle' => '','panelaction' => '','panelmethod' => 'post','stepscount' => '4','title' => array (  0 => 'Description',  1 => 'Implementation',  2 => 'Step three',  3 => 'Step four',),'width' => array (  0 => '',  1 => '',  2 => '',  3 => '',),'tag' => array (  0 => 'a',  1 => 'a',  2 => 'a',  3 => 'a',),'href' => array (  0 => '#content1_example7',  1 => '#content2_example7',  2 => '#content3_example7',  3 => '#content4_example7',),'class' => array (  0 => 'p6Step1',  1 => 'p6Step2',  2 => 'p6Step3',  3 => 'p6Step4',),'label' => array (  0 => '1',  1 => '2',  2 => '3',  3 => '4',),'content' => array (  0 => '<div class="title">Step one - description</div>
					This example show Dynamic Step Process Panels with option that disallow to choose the same step two times.<br><br>
					Features:<br>
					- displayed as a popup, <br>
					- 4 steps, <br>
					- step-by-step mode,<br>
					- steps can\\\'t be choosed again,<br>
					- first step selected,<br>
					- fade effect disabled,<br>
					- style blue-orange,<br>
					- previous and next buttons,<br>
					- step labels',  1 => '<div class="title">Step two - implementation</div>
<pre>&lt;a class=\\\'button_blue buttonPopup\\\' href=\\\'#processPanel_example7-popup\\\'&gt;&lt;/a&gt;
&#91;dspp id=\\\'example7\\\'&#93;</pre>',  2 => '<div class="title">Step three</div>
<div style="text-align: center;">
	Some content for step three<br>
	<img src="img/live_preview_img/quantica.jpg">
</div>',  3 => '<div class="title">Step four</div>
<div style="text-align: center;">
	Some content for step four<br>
	<img src="img/live_preview_img/quantica.jpg">
</div>',),'contentfromfile' => array (  0 => '',  1 => '',  2 => '',  3 => '',),'contenttag' => array (  0 => 'div',  1 => 'div',  2 => 'div',  3 => 'div',),'contentid' => array (  0 => 'content1_example7',  1 => 'content2_example7',  2 => 'content3_example7',  3 => 'content4_example7',),'contentclass' => array (  0 => '',  1 => '',  2 => '',  3 => '',)));

	update_option('dspp_shortcode_settings_example8', array ('kind' => 'freeChoice','markvisited' => 'true','style' => 'maroon-green','firstselected' => 'true','icons' => 'true','imgfolder' => plugins_url("img", __FILE__),'chooseagain' => 'true','nextprevbuttons' => 'true','nextprevbuttonsposition' => 'top','nextbuttontitle' => 'Next step','prevbuttontitle' => 'Previous step','fadespeed' => '1000','event' => 'click','packed' => 'true','jquery' => 'true','aspopup' => 'yes','beforeload' => 'function(){}','onload' => 'function(){}','onopen' => 'function(event, step, content, stepNumber){}','afteropen' => 'function(event, step, content, stepNumber){}','onhoverin' => 'function(event, step, stepNumber){}','onhoverout' => 'function(event, step, stepNumber){}','onopenpopup' => 'function(event, button, panel){}','onclosepopup' => 'function(event, button, panel){}','paneltag' => 'div','panelwidth' => '','panelid' => 'processPanel_example8','panelclass' => 'dspp_panel dspp_popup','panelstyle' => '','panelaction' => '','panelmethod' => 'post','stepscount' => '2','title' => array (  0 => 'Description',  1 => 'Implementation',),'width' => array (  0 => '',  1 => '',),'tag' => array (  0 => 'a',  1 => 'a',),'href' => array (  0 => '#content1_example8',  1 => '#content2_example8',),'class' => array (  0 => 'p7Step1',  1 => 'p7Step2',),'label' => array (  0 => '1',  1 => '2',),'content' => array (  0 => '<div class="title">Step one - description</div>
					Just another example.<br><br>
					Features:<br>
					- displayed as a popup, <br>
					- 2 steps, <br>
					- free choice mode,<br>
					- first step selected,<br>
					- fade effect speed 1 second,<br>
					- previous and next buttons,<br>
					- previous and next buttons placed on the top,<br>
					- style maroon-green,<br>
					- step labels',  1 => '<div class="title">Step two - implementation</div>
<pre>&lt;a class=\\\'button_maroon buttonPopup\\\' href=\\\'#processPanel_example8-popup\\\'&gt;&lt;/a&gt;
&#91;dspp id=\\\'example8\\\'&#93;</pre>',),'contentfromfile' => array (  0 => '',  1 => '',),'contenttag' => array (  0 => 'div',  1 => 'div',),'contentid' => array (  0 => 'content1_example8',  1 => 'content2_example8',),'contentclass' => array (  0 => '',  1 => '',)));

	update_option('dspp_shortcode_settings_example9', array ('kind' => 'freeChoice','markvisited' => 'true','style' => 'orange-blue','firstselected' => 'true','icons' => 'true','imgfolder' => plugins_url("img", __FILE__),'chooseagain' => 'false','nextprevbuttons' => 'true','nextprevbuttonsposition' => 'bottom','nextbuttontitle' => 'Next step','prevbuttontitle' => 'Previous step','fadespeed' => '1000','event' => 'click','packed' => 'true','jquery' => 'true','aspopup' => 'yes','beforeload' => 'function(){}','onload' => 'function(){}','onopen' => 'function(event, step, content, stepNumber){}','afteropen' => 'function(event, step, content, stepNumber){}','onhoverin' => 'function(event, step, stepNumber){}','onhoverout' => 'function(event, step, stepNumber){}','onopenpopup' => 'function(event, button, panel){}','onclosepopup' => 'function(event, button, panel){}','paneltag' => 'div','panelwidth' => '','panelid' => 'processPanel_example9','panelclass' => 'dspp_panel dspp_popup','panelstyle' => '','panelaction' => '','panelmethod' => 'post','stepscount' => '3','title' => array (  0 => 'Description',  1 => 'Implementation',  2 => 'Step three',),'width' => array (  0 => '',  1 => '',  2 => '',),'tag' => array (  0 => 'a',  1 => 'a',  2 => 'a',),'href' => array (  0 => '#content1_example9',  1 => '#content2_example9',  2 => '#content3_example9',),'class' => array (  0 => '',  1 => '',  2 => '',),'label' => array (  0 => '1',  1 => '2',  2 => '3',),'content' => array (  0 => '<div class="title">Step one - description</div>
					Just another example.<br><br>
					Features:<br>
					- displayed as a popup, <br>
					- 3 steps, <br>
					- free choice mode,<br>
					- first step selected,<br>
					- steps can\\\'t be choosed again,<br>
					- fade effect speed 1 second,<br>
					- style orange-blue,<br>
					- step labels',  1 => '<div class="title">Step two - implementation</div>
<pre>&lt;a class=\\\'button_orange buttonPopup\\\' href=\\\'#processPanel_example9-popup\\\'&gt;&lt;/a&gt;
&#91;dspp id=\\\'example9\\\'&#93;',  2 => '<div class="title">Step three</div>
<div style="text-align: center;">
	Some content for step three<br>
	<img src="img/live_preview_img/quantica.jpg">
</div>',),'contentfromfile' => array (  0 => '',  1 => '',  2 => '',),'contenttag' => array (  0 => 'div',  1 => 'div',  2 => 'div',),'contentid' => array (  0 => 'content1_example9',  1 => 'content2_example9',  2 => 'content3_example9',),'contentclass' => array (  0 => '',  1 => '',  2 => '',)));
	
	/*$wpdb->query("INSERT INTO {$wpdb->options}(option_id, option_name, option_value, autoload) VALUES
		(NULL, 'dspp_shortcode_settings_example5', 'a:41:{s:4:\"kind\";s:10:\"freeChoice\";s:11:\"markvisited\";s:4:\"true\";s:5:\"style\";s:11:\"maroon-gray\";s:13:\"firstselected\";s:4:\"true\";s:5:\"icons\";s:5:\"false\";s:9:\"imgfolder\";s:50:\"wp-content/plugins/dynamic_step_process_panels/img\";s:11:\"chooseagain\";s:4:\"true\";s:15:\"nextprevbuttons\";s:4:\"true\";s:23:\"nextprevbuttonsposition\";s:6:\"bottom\";s:15:\"nextbuttontitle\";s:9:\"Next step\";s:15:\"prevbuttontitle\";s:13:\"Previous step\";s:9:\"fadespeed\";s:4:\"1000\";s:5:\"event\";s:5:\"click\";s:6:\"packed\";s:4:\"true\";s:6:\"jquery\";s:4:\"true\";s:7:\"aspopup\";s:3:\"yes\";s:10:\"beforeload\";s:12:\"function(){}\";s:6:\"onload\";s:12:\"function(){}\";s:6:\"onopen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"afteropen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"onhoverin\";s:35:\"function(event, step, stepNumber){}\";s:10:\"onhoverout\";s:35:\"function(event, step, stepNumber){}\";s:11:\"onopenpopup\";s:32:\"function(event, button, panel){}\";s:12:\"onclosepopup\";s:32:\"function(event, button, panel){}\";s:8:\"paneltag\";s:3:\"div\";s:7:\"panelid\";s:21:\"processPanel_example5\";s:10:\"panelclass\";s:21:\"dspp_panel dspp_popup\";s:10:\"panelstyle\";s:0:\"\";s:11:\"panelaction\";s:0:\"\";s:11:\"panelmethod\";s:4:\"post\";s:10:\"stepscount\";s:1:\"5\";s:5:\"title\";a:5:{i:0;s:11:\"Description\";i:1;s:14:\"Implementation\";i:2;s:10:\"Step three\";i:3;s:9:\"Step four\";i:4;s:9:\"Step five\";}s:3:\"tag\";a:5:{i:0;s:1:\"a\";i:1;s:1:\"a\";i:2;s:1:\"a\";i:3;s:1:\"a\";i:4;s:1:\"a\";}s:4:\"href\";a:5:{i:0;s:18:\"#content1_example5\";i:1;s:18:\"#content2_example5\";i:2;s:18:\"#content3_example5\";i:3;s:18:\"#content4_example5\";i:4;s:18:\"#content5_example5\";}s:5:\"class\";a:5:{i:0;s:7:\"p4Step1\";i:1;s:7:\"p4Step2\";i:2;s:7:\"p4Step3\";i:3;s:7:\"p4Step4\";i:4;s:7:\"p4Step5\";}s:5:\"label\";a:5:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";i:4;s:0:\"\";}s:7:\"content\";a:5:{i:0;s:470:\"<div class=\\\\\'title\\\\\'>Step one - description</div>\r\nThis example show Dynamic Step Process Panels displayed as a popup. To close popup just click somewhere outside it.\r\n<br /><br />\r\nFeatures:<br />\r\n- displayed as a popup,<br />\r\n- 5 steps,<br />\r\n- diffrent steps width,<br />\r\n- free choice mode,<br />\r\n- first step selected,<br />\r\n- every step can be choosed again,<br />\r\n- fade effect speed 1 second,<br />\r\n- style maroon-gray,<br />\r\n- previous and next buttons\";i:1;s:184:\"<div class=\\\\\'title\\\\\'>Step two - Implementation</div>\r\n<pre>&lt;a class=\\\\\'button_gray buttonPopup\\\\\' href=\\\\\'#processPanel_example5-popup\\\\\'\\\\\'&gt;&lt;/a&gt;\r\n&#91;dspp id=\\\\\'example5\\\\\'&#93;\";i:2;s:66:\"<div class=\\\\\'title\\\\\'>Step three</div>\r\nSome content for step three\";i:3;s:64:\"<div class=\\\\\'title\\\\\'>Step four</div>\r\nSome content for step four\";i:4;s:64:\"<div class=\\\\\'title\\\\\'>Step five</div>\r\nSome content for step five\";}s:15:\"contentfromfile\";a:5:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";i:4;s:0:\"\";}s:10:\"contenttag\";a:5:{i:0;s:3:\"div\";i:1;s:3:\"div\";i:2;s:3:\"div\";i:3;s:3:\"div\";i:4;s:3:\"div\";}s:9:\"contentid\";a:5:{i:0;s:17:\"content1_example5\";i:1;s:17:\"content2_example5\";i:2;s:17:\"content3_example5\";i:3;s:17:\"content4_example5\";i:4;s:17:\"content5_example5\";}s:12:\"contentclass\";a:5:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";i:4;s:0:\"\";}}', 'yes'),
		(NULL, 'dspp_shortcode_settings_example4', 'a:41:{s:4:\"kind\";s:10:\"stepByStep\";s:11:\"markvisited\";s:4:\"true\";s:5:\"style\";s:11:\"blue-orange\";s:13:\"firstselected\";s:4:\"true\";s:5:\"icons\";s:4:\"true\";s:9:\"imgfolder\";s:50:\"wp-content/plugins/dynamic_step_process_panels/img\";s:11:\"chooseagain\";s:4:\"true\";s:15:\"nextprevbuttons\";s:4:\"true\";s:23:\"nextprevbuttonsposition\";s:6:\"bottom\";s:15:\"nextbuttontitle\";s:9:\"Next step\";s:15:\"prevbuttontitle\";s:13:\"Previous step\";s:9:\"fadespeed\";s:4:\"1000\";s:5:\"event\";s:5:\"click\";s:6:\"packed\";s:4:\"true\";s:6:\"jquery\";s:4:\"true\";s:7:\"aspopup\";s:2:\"no\";s:10:\"beforeload\";s:12:\"function(){}\";s:6:\"onload\";s:12:\"function(){}\";s:6:\"onopen\";s:622:\"function(event, step, content, stepNumber){if(stepNumber==2)\r\n						{\r\n							$(\\\\\'#content1_example4 .alert\\\\\').remove();\r\n							if($(\\\\\'[name=name]\\\\\').val()==\\\\\'\\\\\')\r\n							{\r\n								$(\\\\\'#content1_example4\\\\\').prepend(\\\\\"<div class=\\\\\'alert\\\\\'>Please enter your name!</div>\\\\\");\r\n								return false;\r\n							}\r\n						}\r\n						else if(stepNumber==3)\r\n						{\r\n							$(\\\\\'#content2_example4 .alert\\\\\').remove();\r\n							if(!checkEmail($(\\\\\'[name=email]\\\\\').val()))\r\n							{\r\n								$(\\\\\'#content2_example4\\\\\').prepend(\\\\\"<div class=\\\\\'alert\\\\\'>Please enter valid e-mail address!</div>\\\\\");\r\n								return false;\r\n							}\r\n						}\r\n}\";s:9:\"afteropen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"onhoverin\";s:35:\"function(event, step, stepNumber){}\";s:10:\"onhoverout\";s:35:\"function(event, step, stepNumber){}\";s:11:\"onopenpopup\";s:32:\"function(event, button, panel){}\";s:12:\"onclosepopup\";s:32:\"function(event, button, panel){}\";s:8:\"paneltag\";s:4:\"form\";s:7:\"panelid\";s:21:\"processPanel_example4\";s:10:\"panelclass\";s:10:\"dspp_panel\";s:10:\"panelstyle\";s:0:\"\";s:11:\"panelaction\";s:17:\"formProcessor.php\";s:11:\"panelmethod\";s:4:\"post\";s:10:\"stepscount\";s:1:\"3\";s:5:\"title\";a:3:{i:0;s:11:\"Description\";i:1;s:22:\"Implementation - way 1\";i:2;s:22:\"Implementation - way 2\";}s:3:\"tag\";a:3:{i:0;s:1:\"a\";i:1;s:1:\"a\";i:2;s:1:\"a\";}s:4:\"href\";a:3:{i:0;s:18:\"#content1_example4\";i:1;s:18:\"#content2_example4\";i:2;s:18:\"#content3_example4\";}s:5:\"class\";a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}s:5:\"label\";a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}s:7:\"content\";a:3:{i:0;s:799:\"<div class=\\\\\'title\\\\\'>Step one - description</div>\r\n						<div style=\\\\\'width: 372px; float: left; margin-right: 10px;\\\\\'>\r\n							This example shows how to integrate Dynamic Step Process Panels with form.<br /><br />\r\n							Features:<br />\r\n							- 3 steps (width configurable in css), <br />\r\n							- custom form validation, <br />\r\n							- first step selected,<br />\r\n							- step-by-step mode,<br />\r\n							- previous and next buttons,<br />\r\n							- step labels,<br />\r\n							- every step can be choosed again,<br />\r\n							- fade effect speed 1 second,<br />\r\n							- style blue-orange\r\n						</div>\r\n						<div style=\\\\\'width: 372px; float: left;\\\\\'>\r\n							Please enter your name before you go to the second step:<br />\r\n							name: <input type=\\\\\'text\\\\\' name=\\\\\'name\\\\\' />\r\n						</div>\";i:1;s:283:\"<div class=\\\\\'title\\\\\'>Step two - implementation way 1</div>\r\n						<div>\r\n							Please enter your e-mail before you go to the third step:<br />\r\n							e-mail: <input type=\\\\\'text\\\\\' name=\\\\\'email\\\\\' />\r\n						</div>\r\n						<div>\r\n						Source code available after purchase\r\n						</div>\";i:2;s:291:\"<div class=\\\\\'title\\\\\'>Step three - implementation way 2</div>\r\n						<div>\r\n							2+3= <input type=\\\\\'text\\\\\' name=\\\\\'check\\\\\' />&nbsp;<input type=\\\\\'submit\\\\\' value=\\\\\'Submit form\\\\\' />\r\n						</div>\r\n						<div style=\\\\\'margin-top: 5px;\\\\\'>\r\n							Source code available after purchase\r\n						</div>\";}s:15:\"contentfromfile\";a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}s:10:\"contenttag\";a:3:{i:0;s:8:\"fieldset\";i:1;s:8:\"fieldset\";i:2;s:8:\"fieldset\";}s:9:\"contentid\";a:3:{i:0;s:17:\"content1_example4\";i:1;s:17:\"content2_example4\";i:2;s:17:\"content3_example4\";}s:12:\"contentclass\";a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}}', 'yes'),
		(NULL, 'dspp_shortcode_settings_example3', 'a:41:{s:4:\"kind\";s:10:\"stepByStep\";s:11:\"markvisited\";s:4:\"true\";s:5:\"style\";s:11:\"blue-maroon\";s:13:\"firstselected\";s:5:\"false\";s:5:\"icons\";s:4:\"true\";s:9:\"imgfolder\";s:50:\"wp-content/plugins/dynamic_step_process_panels/img\";s:11:\"chooseagain\";s:4:\"true\";s:15:\"nextprevbuttons\";s:4:\"true\";s:23:\"nextprevbuttonsposition\";s:6:\"bottom\";s:15:\"nextbuttontitle\";s:9:\"Next step\";s:15:\"prevbuttontitle\";s:13:\"Previous step\";s:9:\"fadespeed\";s:3:\"500\";s:5:\"event\";s:9:\"mouseover\";s:6:\"packed\";s:4:\"true\";s:6:\"jquery\";s:4:\"true\";s:7:\"aspopup\";s:2:\"no\";s:10:\"beforeload\";s:12:\"function(){}\";s:6:\"onload\";s:12:\"function(){}\";s:6:\"onopen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"afteropen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"onhoverin\";s:35:\"function(event, step, stepNumber){}\";s:10:\"onhoverout\";s:35:\"function(event, step, stepNumber){}\";s:11:\"onopenpopup\";s:32:\"function(event, button, panel){}\";s:12:\"onclosepopup\";s:32:\"function(event, button, panel){}\";s:8:\"paneltag\";s:3:\"div\";s:7:\"panelid\";s:21:\"processPanel_example3\";s:10:\"panelclass\";s:24:\"dspp_panel dspp_clearfix\";s:10:\"panelstyle\";s:0:\"\";s:11:\"panelaction\";s:0:\"\";s:11:\"panelmethod\";s:4:\"post\";s:10:\"stepscount\";s:1:\"4\";s:5:\"title\";a:4:{i:0;s:11:\"Description\";i:1;s:14:\"Implementation\";i:2;s:10:\"Step three\";i:3;s:9:\"Step four\";}s:3:\"tag\";a:4:{i:0;s:1:\"a\";i:1;s:1:\"a\";i:2;s:1:\"a\";i:3;s:1:\"a\";}s:4:\"href\";a:4:{i:0;s:18:\"#content1_example3\";i:1;s:18:\"#content2_example3\";i:2;s:18:\"#content3_example3\";i:3;s:18:\"#content4_example3\";}s:5:\"class\";a:4:{i:0;s:7:\"p3Step1\";i:1;s:7:\"p3Step2\";i:2;s:7:\"p3Step3\";i:3;s:7:\"p3Step4\";}s:5:\"label\";a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";}s:7:\"content\";a:4:{i:0;s:474:\"<div class=\\\\\'title\\\\\'>Step one - description</div>\r\nThis example show Dynamic Step Process Panels without opened the first step at the begin.<br /><br />\r\n						Features:<br />\r\n						- 4 steps, <br />\r\n						- first step is not opened at the begin,<br />\r\n						- contents opens on mouseover,<br />\r\n						- step-by-step mode,<br />\r\n						- fade effect speed 0,5 second,<br />\r\n						- style blue-maroon,<br />\r\n						- previous and next buttons,<br />\r\n						- step labels\";i:1;s:95:\"<div class=\\\\\'title\\\\\'>Step two - implementation</div>\r\n<pre>&#91;dspp id=\\\\\'example3\\\\\'&#93;</pre>\";i:2;s:66:\"<div class=\\\\\'title\\\\\'>Step three</div>\r\nSome content for step three\";i:3;s:64:\"<div class=\\\\\'title\\\\\'>Step four</div>\r\nSome content for step four\";}s:15:\"contentfromfile\";a:4:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}s:10:\"contenttag\";a:4:{i:0;s:3:\"div\";i:1;s:3:\"div\";i:2;s:3:\"div\";i:3;s:3:\"div\";}s:9:\"contentid\";a:4:{i:0;s:17:\"content1_example3\";i:1;s:17:\"content2_example3\";i:2;s:17:\"content3_example3\";i:3;s:17:\"content4_example2\";}s:12:\"contentclass\";a:4:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}}', 'yes'),
		(NULL, 'dspp_shortcode_settings_example1', 'a:41:{s:4:\"kind\";s:10:\"stepByStep\";s:11:\"markvisited\";s:5:\"false\";s:5:\"style\";s:10:\"green-blue\";s:13:\"firstselected\";s:4:\"true\";s:5:\"icons\";s:4:\"true\";s:9:\"imgfolder\";s:50:\"wp-content/plugins/dynamic_step_process_panels/img\";s:11:\"chooseagain\";s:4:\"true\";s:15:\"nextprevbuttons\";s:4:\"true\";s:23:\"nextprevbuttonsposition\";s:6:\"bottom\";s:15:\"nextbuttontitle\";s:9:\"Next step\";s:15:\"prevbuttontitle\";s:13:\"Previous step\";s:9:\"fadespeed\";s:4:\"1000\";s:5:\"event\";s:5:\"click\";s:6:\"packed\";s:4:\"true\";s:6:\"jquery\";s:4:\"true\";s:7:\"aspopup\";s:2:\"no\";s:10:\"beforeload\";s:12:\"function(){}\";s:6:\"onload\";s:12:\"function(){}\";s:6:\"onopen\";s:92:\"function(event, step, content, stepNumber){window.location.href=\\\\\'#processPanel_example1\\\\\';}\";s:9:\"afteropen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"onhoverin\";s:35:\"function(event, step, stepNumber){}\";s:10:\"onhoverout\";s:35:\"function(event, step, stepNumber){}\";s:11:\"onopenpopup\";s:32:\"function(event, button, panel){}\";s:12:\"onclosepopup\";s:32:\"function(event, button, panel){}\";s:8:\"paneltag\";s:3:\"div\";s:7:\"panelid\";s:21:\"processPanel_example1\";s:10:\"panelclass\";s:10:\"dspp_panel\";s:10:\"panelstyle\";s:0:\"\";s:11:\"panelaction\";s:0:\"\";s:11:\"panelmethod\";s:4:\"post\";s:10:\"stepscount\";s:1:\"3\";s:5:\"title\";a:3:{i:0;s:11:\"Description\";i:1;s:22:\"Implementation - way 1\";i:2;s:22:\"Implementation - way 2\";}s:3:\"tag\";a:3:{i:0;s:1:\"a\";i:1;s:1:\"a\";i:2;s:1:\"a\";}s:4:\"href\";a:3:{i:0;s:18:\"#content1_example1\";i:1;s:18:\"#content2_example1\";i:2;s:18:\"#content3_example1\";}s:5:\"class\";a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}s:5:\"label\";a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}s:7:\"content\";a:3:{i:0;s:419:\"<div class=\\\\\'title\\\\\'>Step one - description</div>\r\nThis example show the simplest way to implement Dynamic Step Process Panels.\r\n<br /><br />\r\nFeatures:<br />\r\n- 3 steps (width configurable in css),<br />\r\n- first step selected,<br />\r\n- step-by-step mode,<br />\r\n- previous and next buttons,<br />\r\n- step labels,<br />\r\n- every step can be choosed again,<br />\r\n- fade effect speed 1 second,<br />\r\n- style green-blue\";i:1;s:239:\"<div class=\\\\\'title\\\\\'>Step two - implementation way 1</div>\r\nAll you got to do is insert WordPress shortcode, with specified id (defined in admin panel). For this example looks like this:<br /><br /><pre>&#91;dspp id=\\\\\'example1\\\\\'&#93;</pre>\";i:2;s:860:\"<div class=\\\\\'title\\\\\'>Step two - implementation way 2</div>\r\nYou can also use different way of implementation, using &#91;dspp_old&#93;, &#91;dspp_panel&#93;, &#91;dspp_step&#93; and &#91;dspp_content&#93; shortcodes. For this example looks like this:<br /><br />\r\n<pre>&#91;dspp_old&#93;\r\n&#91;dspp_panel&#93;\r\n	&#91;dspp_step href=\\\\\'#content1\\\\\' label=\\\\\'1\\\\\'&#93;Description&#91;/dspp_step&#93;\r\n	&#91;dspp_step href=\\\\\'#content2\\\\\' label=\\\\\'2\\\\\'&#93;Implementation - way 1&#91;/dspp_step&#93;\r\n	&#91;dspp_step href=\\\\\'#content3\\\\\' label=\\\\\'3\\\\\'&#93;Implementation - way 2&#91;/dspp_step&#93;\r\n	&#91;dspp_content id=\\\\\'content1\\\\\'&#93;content for step 1&#91;/dspp_content&#93;\r\n	&#91;dspp_content id=\\\\\'content2\\\\\'&#93;content for step 2&#91;/dspp_content&#93;\r\n	&#91;dspp_content id=\\\\\'content3\\\\\'&#93;content for step 3&#91;/dspp_content&#93;\r\n&#91;/dspp_panel&#93;</pre>\r\n\";}s:15:\"contentfromfile\";a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}s:10:\"contenttag\";a:3:{i:0;s:3:\"div\";i:1;s:3:\"div\";i:2;s:3:\"div\";}s:9:\"contentid\";a:3:{i:0;s:17:\"content1_example1\";i:1;s:17:\"content2_example1\";i:2;s:17:\"content3_example1\";}s:12:\"contentclass\";a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}}', 'yes'),
		(NULL, 'dspp_shortcode_settings_example2', 'a:41:{s:4:\"kind\";s:10:\"freeChoice\";s:11:\"markvisited\";s:4:\"true\";s:5:\"style\";s:11:\"orange-gray\";s:13:\"firstselected\";s:4:\"true\";s:5:\"icons\";s:5:\"false\";s:9:\"imgfolder\";s:50:\"wp-content/plugins/dynamic_step_process_panels/img\";s:11:\"chooseagain\";s:4:\"true\";s:15:\"nextprevbuttons\";s:5:\"false\";s:23:\"nextprevbuttonsposition\";s:6:\"bottom\";s:15:\"nextbuttontitle\";s:9:\"Next step\";s:15:\"prevbuttontitle\";s:13:\"Previous step\";s:9:\"fadespeed\";s:4:\"1000\";s:5:\"event\";s:5:\"click\";s:6:\"packed\";s:4:\"true\";s:6:\"jquery\";s:4:\"true\";s:7:\"aspopup\";s:2:\"no\";s:10:\"beforeload\";s:12:\"function(){}\";s:6:\"onload\";s:12:\"function(){}\";s:6:\"onopen\";s:264:\"function(event, step, content, stepNumber){\r\n$(\\\\\'.message\\\\\').remove();\r\n	if(stepNumber==2)\r\n	{\r\n		timesOpened++;\r\n		content.prepend(\\\\\"<div class=\\\\\'message\\\\\'>You\\\\\'ve opened this step \\\\\" + timesOpened + \\\\\" time\\\\\" + (timesOpened>1 ? \\\\\"s\\\\\":\\\\\"\\\\\") + \\\\\".</div>\\\\\");\r\n	}\r\n}\";s:9:\"afteropen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"onhoverin\";s:35:\"function(event, step, stepNumber){}\";s:10:\"onhoverout\";s:35:\"function(event, step, stepNumber){}\";s:11:\"onopenpopup\";s:32:\"function(event, button, panel){}\";s:12:\"onclosepopup\";s:32:\"function(event, button, panel){}\";s:8:\"paneltag\";s:3:\"div\";s:7:\"panelid\";s:21:\"processPanel_example2\";s:10:\"panelclass\";s:10:\"dspp_panel\";s:10:\"panelstyle\";s:0:\"\";s:11:\"panelaction\";s:0:\"\";s:11:\"panelmethod\";s:4:\"post\";s:10:\"stepscount\";s:1:\"4\";s:5:\"title\";a:4:{i:0;s:11:\"Description\";i:1;s:20:\"Implementation-way 1\";i:2;s:20:\"Implementation-way 2\";i:3;s:6:\"Enjoy!\";}s:3:\"tag\";a:4:{i:0;s:1:\"a\";i:1;s:1:\"a\";i:2;s:1:\"a\";i:3;s:1:\"a\";}s:4:\"href\";a:4:{i:0;s:18:\"#content1_example2\";i:1;s:18:\"#content2_example2\";i:2;s:18:\"#content3_example2\";i:3;s:18:\"#content4_example2\";}s:5:\"class\";a:4:{i:0;s:7:\"p2Step1\";i:1;s:7:\"p2Step2\";i:2;s:7:\"p2Step3\";i:3;s:7:\"p2Step4\";}s:5:\"label\";a:4:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}s:7:\"content\";a:4:{i:0;s:456:\"<div class=\\\\\'title\\\\\'>Step one - description</div>\r\n					This example show Dynamic Step Process Panels without label icons, and next previous buttons. You don\\\\\'t have to move step-by-step.\r\n<br /><br />\r\nFeatures:<br />\r\n- 4 steps (width configurable in css),<br />\r\n- free choice mode,<br />\r\n- every step can be choosed again,<br />\r\n- first step selected,<br />\r\n- fade effect speed 1 second,<br />\r\n- style orange-gray,<br />\r\n- onOpen event implemented\";i:1;s:181:\"<div class=\\\\\'title\\\\\'>Step two - implementation way 1</div>\r\n<pre>&lt;script type=\\\\\'text/javascript\\\\\'&gt;\r\nvar timesOpened = 0;\r\n&lt;/script&gt;\r\n&#91;dspp id=\\\\\'example2\\\\\'&#93;</pre>\";i:2;s:1437:\"<div class=\\\\\'title\\\\\'>Step three - implementation way 2</div>\r\n<pre>&#91;inline&#93;\r\n&lt;script type=\\\\\'text/javascript\\\\\'&gt;\r\nvar timesOpened = 0;\r\nfunction customOnOpen(event, step, content, stepNumber)\r\n{\r\n	$(\\\\\'.message\\\\\').remove();\r\n	if(stepNumber==2)\r\n	{\r\n		timesOpened++;\r\n		content.prepend(\\\\\'&lt;div class=\\\\\'message\\\\\'&gt;You\\\\\'ve opened this step \\\\\' \r\n+ timesOpened + \\\\\' time\\\\\' + (timesOpened>1 ? \\\\\'s\\\\\':\\\\\'\\\\\') + \\\\\'.&lt;/div&gt;\\\\\');\r\n	}\r\n}\r\n&lt;/script&gt;\r\n&#91/inline&#93\r\n\r\n&#91;dspp_old id=\\\\\'processPanel2\\\\\' icons=\\\\\'false\\\\\' kind=\\\\\'freeChoice\\\\\' style=\\\\\'orange-gray\\\\\'\r\nnextPrevButtons=\\\\\'false\\\\\' onOpen=\\\\\'customOnOpen\\\\\'&#93;\r\n&#91;dspp_panel id=\\\\\'processPanel2\\\\\' class=\\\\\'panel\\\\\'&#93;\r\n	&#91;dspp_step href=\\\\\'#p2content1\\\\\' class=\\\\\'p2Step1\\\\\'&#93;Description&#91;/dspp_step&#93;\r\n	&#91;dspp_step href=\\\\\'#p2content2\\\\\' class=\\\\\'p2Step2\\\\\'&#93;Implementation - way 1&#91;/dspp_step&#93;\r\n	&#91;dspp_step href=\\\\\'#p2content3\\\\\' class=\\\\\'p2Step3\\\\\'&#93;Implementation - way 2&#91;/dspp_step&#93;\r\n	&#91;dspp_step href=\\\\\'#p2content4\\\\\' class=\\\\\'p2Step4\\\\\'&#93;Enjoy!&#91;/dspp_step&#93;\r\n	&#91;dspp_content id=\\\\\'p2content1\\\\\'&#93;content for step 1&#91;/dspp_content&#93;\r\n	&#91;dspp_content id=\\\\\'p2content2\\\\\'&#93;content for step 2&#91;/dspp_content&#93;\r\n	&#91;dspp_content id=\\\\\'p2content3\\\\\'&#93;content for step 3&#91;/dspp_content&#93;\r\n	&#91;dspp_content id=\\\\\'p2content4\\\\\'&#93;content for step 4&#91;/dspp_content&#93;\r\n&#91;/dspp_panel&#93;</pre>\";i:3;s:40:\"<div class=\\\\\'title\\\\\'>Step four</div>\r\n:)\";}s:15:\"contentfromfile\";a:4:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}s:10:\"contenttag\";a:4:{i:0;s:3:\"div\";i:1;s:3:\"div\";i:2;s:3:\"div\";i:3;s:3:\"div\";}s:9:\"contentid\";a:4:{i:0;s:17:\"content1_example2\";i:1;s:17:\"content2_example2\";i:2;s:17:\"content3_example2\";i:3;s:17:\"content4_example3\";}s:12:\"contentclass\";a:4:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}}', 'yes'),
		(NULL, 'dspp_shortcode_settings_example7', 'a:41:{s:4:\"kind\";s:10:\"stepByStep\";s:11:\"markvisited\";s:4:\"true\";s:5:\"style\";s:11:\"blue-orange\";s:13:\"firstselected\";s:4:\"true\";s:5:\"icons\";s:4:\"true\";s:9:\"imgfolder\";s:50:\"wp-content/plugins/dynamic_step_process_panels/img\";s:11:\"chooseagain\";s:5:\"false\";s:15:\"nextprevbuttons\";s:4:\"true\";s:23:\"nextprevbuttonsposition\";s:6:\"bottom\";s:15:\"nextbuttontitle\";s:9:\"Next step\";s:15:\"prevbuttontitle\";s:13:\"Previous step\";s:9:\"fadespeed\";s:1:\"0\";s:5:\"event\";s:5:\"click\";s:6:\"packed\";s:4:\"true\";s:6:\"jquery\";s:4:\"true\";s:7:\"aspopup\";s:3:\"yes\";s:10:\"beforeload\";s:12:\"function(){}\";s:6:\"onload\";s:12:\"function(){}\";s:6:\"onopen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"afteropen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"onhoverin\";s:35:\"function(event, step, stepNumber){}\";s:10:\"onhoverout\";s:35:\"function(event, step, stepNumber){}\";s:11:\"onopenpopup\";s:32:\"function(event, button, panel){}\";s:12:\"onclosepopup\";s:32:\"function(event, button, panel){}\";s:8:\"paneltag\";s:3:\"div\";s:7:\"panelid\";s:21:\"processPanel_example7\";s:10:\"panelclass\";s:21:\"dspp_panel dspp_popup\";s:10:\"panelstyle\";s:0:\"\";s:11:\"panelaction\";s:0:\"\";s:11:\"panelmethod\";s:4:\"post\";s:10:\"stepscount\";s:1:\"4\";s:5:\"title\";a:4:{i:0;s:11:\"Description\";i:1;s:14:\"Implementation\";i:2;s:10:\"Step three\";i:3;s:9:\"Step four\";}s:3:\"tag\";a:4:{i:0;s:1:\"a\";i:1;s:1:\"a\";i:2;s:1:\"a\";i:3;s:1:\"a\";}s:4:\"href\";a:4:{i:0;s:18:\"#content1_example7\";i:1;s:18:\"#content2_example7\";i:2;s:18:\"#content3_example7\";i:3;s:18:\"#content4_example7\";}s:5:\"class\";a:4:{i:0;s:7:\"p6Step1\";i:1;s:7:\"p6Step2\";i:2;s:7:\"p6Step3\";i:3;s:7:\"p6Step4\";}s:5:\"label\";a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";}s:7:\"content\";a:4:{i:0;s:500:\"<div class=\\\\\'title\\\\\'>Step one - description</div>\r\n					This example show Dynamic Step Process Panels with option that disallow to choose the same step two times.<br /><br />\r\n					Features:<br />\r\n					- displayed as a popup, <br />\r\n					- 4 steps, <br />\r\n					- step-by-step mode,<br />\r\n					- steps can\\\\\'t be choosed again,<br />\r\n					- first step selected,<br />\r\n					- fade effect disabled,<br />\r\n					- style blue-orange,<br />\r\n					- previous and next buttons,<br />\r\n					- step labels\";i:1;s:188:\"<div class=\\\\\'title\\\\\'>Step two - implementation</div>\r\n<pre>&lt;a class=\\\\\'button_blue buttonPopup\\\\\' href=\\\\\'#processPanel_example7-popup\\\\\'&gt;&lt;/a&gt;\r\n&#91;dspp id=\\\\\'example7\\\\\'&#93;</pre>\";i:2;s:170:\"<div class=\\\\\'title\\\\\'>Step three</div>\r\n<div style=\\\\\'text-align: center;\\\\\'>\r\n	Some content for step three<br />\r\n	<img src=\\\\\'img/live_preview_img/quantica.jpg\\\\\' />\r\n</div>\";i:3;s:168:\"<div class=\\\\\'title\\\\\'>Step four</div>\r\n<div style=\\\\\'text-align: center;\\\\\'>\r\n	Some content for step four<br />\r\n	<img src=\\\\\'img/live_preview_img/quantica.jpg\\\\\' />\r\n</div>\";}s:15:\"contentfromfile\";a:4:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}s:10:\"contenttag\";a:4:{i:0;s:3:\"div\";i:1;s:3:\"div\";i:2;s:3:\"div\";i:3;s:3:\"div\";}s:9:\"contentid\";a:4:{i:0;s:17:\"content1_example7\";i:1;s:17:\"content2_example7\";i:2;s:17:\"content3_example7\";i:3;s:17:\"content4_example7\";}s:12:\"contentclass\";a:4:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";}}', 'yes'),
		(NULL, 'dspp_shortcode_settings_example6', 'a:41:{s:4:\"kind\";s:10:\"stepByStep\";s:11:\"markvisited\";s:4:\"true\";s:5:\"style\";s:12:\"green-orange\";s:13:\"firstselected\";s:4:\"true\";s:5:\"icons\";s:4:\"true\";s:9:\"imgfolder\";s:50:\"wp-content/plugins/dynamic_step_process_panels/img\";s:11:\"chooseagain\";s:4:\"true\";s:15:\"nextprevbuttons\";s:4:\"true\";s:23:\"nextprevbuttonsposition\";s:6:\"bottom\";s:15:\"nextbuttontitle\";s:9:\"show next\";s:15:\"prevbuttontitle\";s:13:\"show previous\";s:9:\"fadespeed\";s:4:\"1000\";s:5:\"event\";s:5:\"click\";s:6:\"packed\";s:4:\"true\";s:6:\"jquery\";s:4:\"true\";s:7:\"aspopup\";s:3:\"yes\";s:10:\"beforeload\";s:12:\"function(){}\";s:6:\"onload\";s:12:\"function(){}\";s:6:\"onopen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"afteropen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"onhoverin\";s:35:\"function(event, step, stepNumber){}\";s:10:\"onhoverout\";s:35:\"function(event, step, stepNumber){}\";s:11:\"onopenpopup\";s:32:\"function(event, button, panel){}\";s:12:\"onclosepopup\";s:32:\"function(event, button, panel){}\";s:8:\"paneltag\";s:3:\"div\";s:7:\"panelid\";s:21:\"processPanel_example6\";s:10:\"panelclass\";s:21:\"dspp_panel dspp_popup\";s:10:\"panelstyle\";s:0:\"\";s:11:\"panelaction\";s:0:\"\";s:11:\"panelmethod\";s:4:\"post\";s:10:\"stepscount\";s:1:\"3\";s:5:\"title\";a:3:{i:0;s:11:\"Description\";i:1;s:14:\"Implementation\";i:2;s:10:\"Step three\";}s:3:\"tag\";a:3:{i:0;s:1:\"a\";i:1;s:1:\"a\";i:2;s:1:\"a\";}s:4:\"href\";a:3:{i:0;s:18:\"#content1_example6\";i:1;s:18:\"#content2_example6\";i:2;s:18:\"#content3_example6\";}s:5:\"class\";a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}s:5:\"label\";a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}s:7:\"content\";a:3:{i:0;s:6:\"&nbsp;\";i:1;s:6:\"&nbsp;\";i:2;s:210:\"<div class=\\\\\'title\\\\\'>Step three</div>\r\n				Static content<br />\r\n				<div style=\\\\\'text-align: center;\\\\\'>\r\n				Some content for step three<br />\r\n				<img src=\\\\\'img/live_preview_img/quantica.jpg\\\\\' />\r\n				</div>\";}s:15:\"contentfromfile\";a:3:{i:0;s:17:\"step1Content.html\";i:1;s:17:\"step2Content.html\";i:2;s:0:\"\";}s:10:\"contenttag\";a:3:{i:0;s:3:\"div\";i:1;s:3:\"div\";i:2;s:3:\"div\";}s:9:\"contentid\";a:3:{i:0;s:17:\"content1_example6\";i:1;s:17:\"content2_example6\";i:2;s:17:\"content3_example6\";}s:12:\"contentclass\";a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}}', 'yes'),
		(NULL, 'dspp_shortcode_settings_example8', 'a:41:{s:4:\"kind\";s:10:\"freeChoice\";s:11:\"markvisited\";s:4:\"true\";s:5:\"style\";s:12:\"maroon-green\";s:13:\"firstselected\";s:4:\"true\";s:5:\"icons\";s:4:\"true\";s:9:\"imgfolder\";s:50:\"wp-content/plugins/dynamic_step_process_panels/img\";s:11:\"chooseagain\";s:4:\"true\";s:15:\"nextprevbuttons\";s:4:\"true\";s:23:\"nextprevbuttonsposition\";s:3:\"top\";s:15:\"nextbuttontitle\";s:9:\"Next step\";s:15:\"prevbuttontitle\";s:13:\"Previous step\";s:9:\"fadespeed\";s:4:\"1000\";s:5:\"event\";s:5:\"click\";s:6:\"packed\";s:4:\"true\";s:6:\"jquery\";s:4:\"true\";s:7:\"aspopup\";s:3:\"yes\";s:10:\"beforeload\";s:12:\"function(){}\";s:6:\"onload\";s:12:\"function(){}\";s:6:\"onopen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"afteropen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"onhoverin\";s:35:\"function(event, step, stepNumber){}\";s:10:\"onhoverout\";s:35:\"function(event, step, stepNumber){}\";s:11:\"onopenpopup\";s:32:\"function(event, button, panel){}\";s:12:\"onclosepopup\";s:32:\"function(event, button, panel){}\";s:8:\"paneltag\";s:3:\"div\";s:7:\"panelid\";s:21:\"processPanel_example8\";s:10:\"panelclass\";s:21:\"dspp_panel dspp_popup\";s:10:\"panelstyle\";s:0:\"\";s:11:\"panelaction\";s:0:\"\";s:11:\"panelmethod\";s:4:\"post\";s:10:\"stepscount\";s:1:\"2\";s:5:\"title\";a:2:{i:0;s:11:\"Description\";i:1;s:14:\"Implementation\";}s:3:\"tag\";a:2:{i:0;s:1:\"a\";i:1;s:1:\"a\";}s:4:\"href\";a:2:{i:0;s:18:\"#content1_example8\";i:1;s:18:\"#content2_example8\";}s:5:\"class\";a:2:{i:0;s:7:\"p7Step1\";i:1;s:7:\"p7Step2\";}s:5:\"label\";a:2:{i:0;s:1:\"1\";i:1;s:0:\"\";}s:7:\"content\";a:2:{i:0;s:435:\"<div class=\\\\\'title\\\\\'>Step one - description</div>\r\n					Just another example.<br /><br />\r\n					Features:<br />\r\n					- displayed as a popup, <br />\r\n					- 2 steps, <br />\r\n					- free choice mode,<br />\r\n					- first step selected,<br />\r\n					- fade effect speed 1 second,<br />\r\n					- previous and next buttons,<br />\r\n					- previous and next buttons placed on the top,<br />\r\n					- style maroon-green,<br />\r\n					- step labels\";i:1;s:190:\"<div class=\\\\\'title\\\\\'>Step two - implementation</div>\r\n<pre>&lt;a class=\\\\\'button_maroon buttonPopup\\\\\' href=\\\\\'#processPanel_example8-popup\\\\\'&gt;&lt;/a&gt;\r\n&#91;dspp id=\\\\\'example8\\\\\'&#93;</pre>\";}s:15:\"contentfromfile\";a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}s:10:\"contenttag\";a:2:{i:0;s:3:\"div\";i:1;s:3:\"div\";}s:9:\"contentid\";a:2:{i:0;s:17:\"content1_example8\";i:1;s:17:\"content2_example8\";}s:12:\"contentclass\";a:2:{i:0;s:0:\"\";i:1;s:0:\"\";}}', 'yes'),
		(NULL, 'dspp_shortcode_settings_example9', 'a:41:{s:4:\"kind\";s:10:\"freeChoice\";s:11:\"markvisited\";s:4:\"true\";s:5:\"style\";s:11:\"orange-blue\";s:13:\"firstselected\";s:4:\"true\";s:5:\"icons\";s:4:\"true\";s:9:\"imgfolder\";s:50:\"wp-content/plugins/dynamic_step_process_panels/img\";s:11:\"chooseagain\";s:5:\"false\";s:15:\"nextprevbuttons\";s:4:\"true\";s:23:\"nextprevbuttonsposition\";s:6:\"bottom\";s:15:\"nextbuttontitle\";s:9:\"Next step\";s:15:\"prevbuttontitle\";s:13:\"Previous step\";s:9:\"fadespeed\";s:4:\"1000\";s:5:\"event\";s:5:\"click\";s:6:\"packed\";s:4:\"true\";s:6:\"jquery\";s:4:\"true\";s:7:\"aspopup\";s:3:\"yes\";s:10:\"beforeload\";s:12:\"function(){}\";s:6:\"onload\";s:12:\"function(){}\";s:6:\"onopen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"afteropen\";s:44:\"function(event, step, content, stepNumber){}\";s:9:\"onhoverin\";s:35:\"function(event, step, stepNumber){}\";s:10:\"onhoverout\";s:35:\"function(event, step, stepNumber){}\";s:11:\"onopenpopup\";s:32:\"function(event, button, panel){}\";s:12:\"onclosepopup\";s:32:\"function(event, button, panel){}\";s:8:\"paneltag\";s:3:\"div\";s:7:\"panelid\";s:21:\"processPanel_example9\";s:10:\"panelclass\";s:21:\"dspp_panel dspp_popup\";s:10:\"panelstyle\";s:0:\"\";s:11:\"panelaction\";s:0:\"\";s:11:\"panelmethod\";s:4:\"post\";s:10:\"stepscount\";s:1:\"3\";s:5:\"title\";a:3:{i:0;s:11:\"Description\";i:1;s:14:\"Implementation\";i:2;s:10:\"Step three\";}s:3:\"tag\";a:3:{i:0;s:1:\"a\";i:1;s:1:\"a\";i:2;s:1:\"a\";}s:4:\"href\";a:3:{i:0;s:18:\"#content1_example9\";i:1;s:18:\"#content2_example9\";i:2;s:18:\"#content3_example9\";}s:5:\"class\";a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}s:5:\"label\";a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}s:7:\"content\";a:3:{i:0;s:379:\"<div class=\\\\\'title\\\\\'>Step one - description</div>\r\n					Just another example.<br /><br />\r\n					Features:<br />\r\n					- displayed as a popup, <br />\r\n					- 3 steps, <br />\r\n					- free choice mode,<br />\r\n					- first step selected,<br />\r\n					- steps can\\\\\'t be choosed again,<br />\r\n					- fade effect speed 1 second,<br />\r\n					- style orange-blue,<br />\r\n					- step labels\";i:1;s:184:\"<div class=\\\\\'title\\\\\'>Step two - implementation</div>\r\n<pre>&lt;a class=\\\\\'button_orange buttonPopup\\\\\' href=\\\\\'#processPanel_example9-popup\\\\\'&gt;&lt;/a&gt;\r\n&#91;dspp id=\\\\\'example9\\\\\'&#93;\";i:2;s:170:\"<div class=\\\\\'title\\\\\'>Step three</div>\r\n<div style=\\\\\'text-align: center;\\\\\'>\r\n	Some content for step three<br />\r\n	<img src=\\\\\'img/live_preview_img/quantica.jpg\\\\\' />\r\n</div>\";}s:15:\"contentfromfile\";a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}s:10:\"contenttag\";a:3:{i:0;s:3:\"div\";i:1;s:3:\"div\";i:2;s:3:\"div\";}s:9:\"contentid\";a:3:{i:0;s:17:\"content1_example9\";i:1;s:17:\"content2_example9\";i:2;s:17:\"content3_example9\";}s:12:\"contentclass\";a:3:{i:0;s:0:\"\";i:1;s:0:\"\";i:2;s:0:\"\";}}', 'yes');");
	*/
}
register_activation_hook( __FILE__, 'dspp_activate');
//deactivate plugin
function dspp_deactivate()
{
}
register_deactivation_hook( __FILE__, 'dspp_deactivate');

//admin
if(is_admin())
{
	function dspp_admin_init()
	{
		wp_register_script('dspp_admin', WP_PLUGIN_URL . '/dynamic_step_process_panels/js/dspp_admin.js', array(), "1.0");
	}
	add_action('admin_init', 'dspp_admin_init');

	function dspp_admin_print_scripts()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('dspp_admin');
		//pass data to javascript
		$data = array(
			'selectedShortcodeId' => ($_POST["action"]=="save" ? $_POST["shortcodeId"] : "")
		);
		wp_localize_script('dspp_admin', 'config', $data);
	}
	function dspp_admin_menu()
	{	
		$page = add_options_page('Dynamic Step Process Panels', 'Dynamic Step Process Panels', 'administrator', 'dspp_admin', 'dspp_admin_page');
		add_action('admin_print_scripts-' . $page, 'dspp_admin_print_scripts');
	}
	add_action('admin_menu', 'dspp_admin_menu');
	
	function dspp_stripslashes_deep($value)
	{
		$value = is_array($value) ?
					array_map('stripslashes_deep', $value) :
					stripslashes($value);

		return $value;
	}
	function dspp_ajax_get_settings()
	{
		echo json_encode(dspp_stripslashes_deep(get_option('dspp_shortcode_settings_' . $_POST["id"])));
		exit();
	}
	add_action('wp_ajax_get_settings', 'dspp_ajax_get_settings');
	
	function dspp_ajax_delete()
	{
		echo delete_option($_POST["id"]);
		exit();
	}
	add_action('wp_ajax_dspp_delete', 'dspp_ajax_delete');
	
	function dspp_admin_page()
	{
		$error = "";
		if($_POST["action"]=="save")
		{
			if($_POST["shortcodeId"]!="")
			{
				for($i=0; $i<count($_POST["step_title"]); $i++)
				{
					if($_POST["step_title"][$i]=="")
						$_POST["step_title"][$i] = "&nbsp;";
					if($_POST["step_content"][$i]=="")
						$_POST["step_content"][$i] = "&nbsp;";
				}
				$dspp_options = array(
					"kind" => $_POST["kind"],
					"markvisited" => $_POST["markVisited"],
					"style" => $_POST["style"],
					"firstselected" => $_POST["firstSelected"],
					"icons" => $_POST["icons"],
					"imgfolder" => $_POST["imgFolder"],
					"chooseagain" => $_POST["chooseAgain"],
					"nextprevbuttons" => $_POST["nextPrevButtons"],
					"nextprevbuttonsposition" => $_POST["nextPrevButtonsPosition"],
					"nextbuttontitle" => $_POST["nextButtonTitle"],
					"prevbuttontitle" => $_POST["prevButtonTitle"],
					"fadespeed" => $_POST["fadeSpeed"],
					"event" => $_POST["event"],
					"packed" => $_POST["packed"],
					"jquery" => $_POST["jQuery"],
					"aspopup" => $_POST["asPopup"],
					"beforeload" => $_POST["beforeLoad"],
					"onload" => $_POST["onLoad"],
					"onopen" => $_POST["onOpen"],
					"afteropen" => $_POST["afterOpen"],
					"onhoverin" => $_POST["onHoverIn"],
					"onhoverout" => $_POST["onHoverOut"],
					"onopenpopup" => $_POST["onOpenPopup"],
					"onclosepopup" => $_POST["onClosePopup"],
					"paneltag" => $_POST["panel_tag"],
					"panelwidth" => $_POST["panel_width"],
					"panelid" => $_POST["panel_id"],
					"panelclass" => $_POST["panel_class"],
					"panelstyle" => $_POST["panel_style"],
					"panelaction" => $_POST["panel_action"],
					"panelmethod" => $_POST["panel_method"],
					"stepscount" => $_POST["stepsCount"],
					"title" => $_POST["step_title"],
					"width" => $_POST["step_width"],
					"tag" => $_POST["step_tag"],
					"href" => $_POST["step_href"],
					"class" => $_POST["step_class"],
					"label" => $_POST["step_label"],
					"content" => $_POST["step_content"],
					"contentfromfile" => $_POST["step_content_from_file"],
					"contenttag" => $_POST["step_content_tag"],
					"contentid" => $_POST["step_content_id"],
					"contentclass" => $_POST["step_content_class"]
				);
				//add if not exist or update if exist
				$updated = true;
				if(!get_option('dspp_shortcode_settings_' . $_POST["shortcodeId"]))
					$updated = false;
				/*echo "<pre style='white-space: normal;'>";
				var_export($dspp_options);
				echo "</pre>";*/
				update_option('dspp_shortcode_settings_' . $_POST["shortcodeId"], $dspp_options);
				$message .= "Settings saved!" . ($updated ? " (overwritten)" : "");
				$message .= "<br />Use <pre>[dspp id='" . $_POST["shortcodeId"] . "']</pre> shortcode to put process panel on your page.";
			}
			else
			{
				$error .= "Please fill 'Shortcode id' field!";
			}
		}
		$allOptions = get_alloptions();
		$dsppAllShortcodeIds = array();
		foreach($allOptions as $key => $value)
		{
			if(substr($key, 0, 23)=="dspp_shortcode_settings")
				$dsppAllShortcodeIds[] = $key;
		}
		//sort shortcode ids
		sort($dsppAllShortcodeIds);
		?>
		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br></div>
			<h2>Dynamic Step Process Panels settings</h2>
		</div>
		<?php
		if($error!="" || $message!="")
		{
		?>
		<div class="<?php echo ($message!="" ? "updated" : "error"); ?> settings-error"> 
			<p>
				<strong style="line-height: 150%;">
					<?php echo ($message!="" ? $message : $error); ?>
				</strong>
			</p>
		</div>
		<?php
		}
		?>
		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="dspp_settings">
			<p class="submit">
				<input type="submit" value="Save Options" class="button-primary" name="Submit">
				<input type="hidden" name="action" value="save" />
			</p>
			<table class="form-table">
				<tbody>
					<?php
					if(count($dsppAllShortcodeIds))
					{
					?>
					<tr valign="top">
						<th scope="row">
							<label for="editShortcodeId">Choose shortcode id</label>
						</th>
						<td>
							<select name="editShortcodeId" id="editShortcodeId">
								<option value="-1">choose...</option>
								<?php
									for($i=0; $i<count($dsppAllShortcodeIds); $i++)
										echo "<option value='$dsppAllShortcodeIds[$i]'>" . substr($dsppAllShortcodeIds[$i], 24) . "</option>";
								?>
							</select>
							<img style="display: none; cursor: pointer;" id="deleteButton" src="<?php echo WP_PLUGIN_URL; ?>/dynamic_step_process_panels/img/delete.png" alt="del" title="Delete this process panel" />
							<span id="ajax_loader" style="display: none;"><img style="margin-bottom: -3px;" src="<?php echo WP_PLUGIN_URL; ?>/dynamic_step_process_panels/img/ajax-loader.gif" /></span>
							<span class="description">Choose the shortcode id for editing</span>
						</td>
					</tr>
					<?php
					}
					?>
					<tr valign="top">
						<th scope="row">
							<label for="shortcodeId">Or create new shortcode id</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="" id="shortcodeId" name="shortcodeId">
							<span class="description">Unique identifier for dspp shortcode. Don't use special characters.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="kind">Type</label>
						</th>
						<td>
							<select name="kind" id="kind">
								<option value="stepByStep">stepByStep</option>
								<option value="freeChoice">freeChoice</option>
							</select>
							<span class="description">Specifies the behaviour of the steps panel. Parameter stepByStep forces the user to open steps one after another. Parameter freeChoice allow free choice.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="markVisited">Mark visited</label>
						</th>
						<td>
							<select name="markVisited" id="markvisited">
								<option value="true">true</option>
								<option value="false">false</option>
							</select>
							<span class="description">Specifies if the current step should be unhighlighted/uncolored on go back action.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="style">Style</label>
						</th>
						<td>
							<select name="style" id="style">
								<option value="green-blue">green-blue</option>
								<option value="green-gray">green-gray</option>
								<option value="green-maroon">green-maroon</option>
								<option value="green-orange">green-orange</option>
								<option value="blue-gray">blue-gray</option>
								<option value="blue-green">blue-green</option>
								<option value="blue-maroon">blue-maroon</option>
								<option value="blue-orange">blue-orange</option>
								<option value="maroon-blue">maroon-blue</option>
								<option value="maroon-gray">maroon-gray</option>
								<option value="maroon-green">maroon-green</option>
								<option value="maroon-orange">maroon-orange</option>
								<option value="orange-blue">orange-blue</option>
								<option value="orange-gray">orange-gray</option>
								<option value="orange-green">orange-green</option>
								<option value="orange-maroon">orange-maroon</option>
							</select>
							<span class="description">Specifies the coloristic version of the step panel.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="firstselected">First selected</label>
						</th>
						<td>
							<select name="firstSelected" id="firstselected">
								<option value="true">true</option>
								<option value="false">false</option>
							</select>
							<span class="description">Specifies that the first step is open on start or not.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="icons">Icons</label>
						</th>
						<td>
							<select name="icons" id="icons">
								<option value="true">true</option>
								<option value="false">false</option>
							</select>
							<span class="description">Specifies that the icons under the step labels shows or not.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="imgfolder">Images folder</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo plugins_url('img', __FILE__);?>" id="imgfolder" name="imgFolder">
							<span class="description">Specifies the path to folder which contains the sprite_with_icons.png, sprite_without_icons.png and sprite_buttons.png images.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="chooseagain">Choose again</label>
						</th>
						<td>
							<select name="chooseAgain" id="chooseagain">
								<option value="true">true</option>
								<option value="false">false</option>
							</select>
							<span class="description">Specifies that the step can be chosen again.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="nextprevbuttons">Next and previous buttons</label>
						</th>
						<td>
							<select name="nextPrevButtons" id="nextprevbuttons">
								<option value="true">true</option>
								<option value="false">false</option>
							</select>
							<span class="description">Specifies that the next and previous buttons will show.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="nextprevbuttonsposition">Next and previous buttons position</label>
						</th>
						<td>
							<select name="nextPrevButtonsPosition" id="nextprevbuttonsposition">
								<option value="bottom">bottom</option>
								<option value="top">top</option>
							</select>
							<span class="description">Specifies the next and previous buttons position.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="nextbuttontitle">Next button title</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="Next step" id="nextbuttontitle" name="nextButtonTitle">
							<span class="description">Specifies the next button caption.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="prevbuttontitle">Next button title</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="Previous step" id="prevbuttontitle" name="prevButtonTitle">
							<span class="description">Specifies the previous button caption.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="fadespeed">Fade effect speed</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="1000" id="fadespeed" name="fadeSpeed">
							<span class="description">Specifies the fade effect speed (in miliseconds) when the step is changed. Set to 0 if you want to disable effect.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="event">Event</label>
						</th>
						<td>
							<select name="event" id="event">
								<option value="click">click</option>
								<option value="mouseover">mouseover</option>
							</select>
							<span class="description">Specifies the type of event to be used for open step content.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="beforeload">beforeLoad event</label>
						</th>
						<td>
							<textarea cols="50" rows="5" id="beforeload" class="large-text code" name="beforeLoad">function(){}</textarea>
							<span class="description">This event is triggered before step panel will be initialized.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="onload">onLoad event</label>
						</th>
						<td>
							<textarea cols="50" rows="5" id="onload" class="large-text code" name="onLoad">function(){}</textarea>
							<span class="description">This event is triggered after step panel has been initialized.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="onopen">onOpen event</label>
						</th>
						<td>
							<textarea cols="50" rows="5" id="onopen" class="large-text code" name="onOpen">function(event, step, content, stepNumber){}</textarea>
							<span class="description">This event is triggered before opening step content.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="afteropen">afterOpen event</label>
						</th>
						<td>
							<textarea cols="50" rows="5" id="afteropen" class="large-text code" name="afterOpen">function(event, step, content, stepNumber){}</textarea>
							<span class="description">This event is triggered after opening step content.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="onhoverin">onHoverIn event</label>
						</th>
						<td>
							<textarea cols="50" rows="5" id="onhoverin" class="large-text code" name="onHoverIn">function(event, step, stepNumber){}</textarea>
							<span class="description">This event is triggered when step is hovered.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="onhoverout">onHoverOut event</label>
						</th>
						<td>
							<textarea cols="50" rows="5" id="onhoverout" class="large-text code" name="onHoverOut">function(event, step, stepNumber){}</textarea>
							<span class="description">This event is triggered when step hover is out.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="onopenpopup">onOpenPopup event</label>
						</th>
						<td>
							<textarea cols="50" rows="5" id="onopenpopup" class="large-text code" name="onOpenPopup">function(event, button, panel){}</textarea>
							<span class="description">This event is triggered before opening process panel displayed as a popup.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="onclosepopup">onClosePopup event</label>
						</th>
						<td>
							<textarea cols="50" rows="5" id="onclosepopup" class="large-text code" name="onClosePopup">function(event, button, panel){}</textarea>
							<span class="description">This event is triggered after opening process panel displayed as a popup.</span>
						</td>
					</tr>
					<?php /*<tr valign="top">
						<th scope="row">
							<label for="packed">Packed</label>
						</th>
						<td>
							<select name="packed" id="packed">
								<option value="true">true</option>
								<option value="false">false</option>
							</select>
							<span class="description">If set to true, the minified version of javascript will be loaded (jquery.processPanel.min.js). If set to false, standard version of javascript will be loaded (jquery.processPanel.js).</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="jquery">jQuery</label>
						</th>
						<td>
							<select name="jQuery" id="jquery">
								<option value="true">true</option>
								<option value="false">false</option>
							</select>
							<span class="description">If set to true jquery-1.7.1.min.js will be loaded. If set to false jquery-1.7.1.min.js won't be loaded.</span>
						</td>
					</tr>*/ ?>
					<tr valign="top">
						<th scope="row">
							<label for="aspopup">Displayed as a popup</label>
						</th>
						<td>
							<select name="asPopup" id="aspopup">
								<option value="yes">yes</option>
								<option value="no" selected="selected">no</option>
							</select>
							<span class="description">Specifies that the panel will be displayed as a popup or not. <span style="font-weight: bold;">If you've choosen 'yes' please put this link on your page &lt;a href="#<span id="panelidhint">processPanel</span>-popup"&gt;open popup&lt;/a&gt;. When you gonna click on it, the popup will open.</span></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="paneltag">Panel tag</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="div" id="paneltag" name="panel_tag">
							<span class="description">Defines the html tag of the steps panel node.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="panelwidth">Panel width</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="" id="panelwidth" name="panel_width">
							<span class="description">Defines the width of the steps panel (in px).</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="panelid">Panel id</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="processPanel" id="panelid" name="panel_id">
							<span class="description">Defines the id attribute of the steps panel.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="panelclass">Panel class</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="dspp_panel dspp_clearfix" id="panelclass" name="panel_class">
							<span class="description">Defines the class attribute of the steps panel.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="panelstyle">Panel style</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="" id="panelstyle" name="panel_style">
							<span class="description">Defines the style attribute of the steps panel. Using this parameter you can define inline styles for the panel.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="panelaction">Panel action</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="" id="panelaction" name="panel_action">
							<span class="description">Defines the action attribute of the steps panel, when it is used as a form (panel tag field value = form).</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="panelmethod">Panel method</label>
						</th>
						<td>
							<select name="panel_method" id="panelmethod">
								<option value="post">post</option>
								<option value="get">get</option>
							</select>
							<span class="description">Defines the method attribute of the steps panel, when it is used as a form (panel tag field value = form).</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="stepscount">Number of steps</label>
						</th>
						<td>
							<input type="text" class="regular-text" value="3" id="stepscount" name="stepsCount" maxlength="2">
							<span class="description">Specifies the number of steps in panel.</span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row" colspan="2" style="padding: 0px;" id="steps_settings">
							<table class="form-table" id="dspp_table_content1">
								<tr valign="top">
									<th scope="row" colspan="2" style="font-weight: bold;">
										Step 1 settings:
									</th>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="title1">Title</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="title1" name="step_title[]">
										<span class="description">Defines the title of the step.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="width1">Width</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="width1" name="step_width[]">
										<span class="description">Defines the width of the step (in px).</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="tag1">Tag</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="a" id="tag1" name="step_tag[]">
										<span class="description">Defines the html tag of the step node.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="href1">Href</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="#content1" id="href1" name="step_href[]">
										<span class="description">Defines the href attribute of the step.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="class1">Class</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="class1" name="step_class[]">
										<span class="description">Defines the class attribute of the step.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="label1">Label</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="label1" name="step_label[]">
										<span class="description">Defines the label attribute of the step.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="content1">Content</label>
									</th>
									<td>
										<textarea cols="50" rows="10" id="content1" class="large-text code" name="step_content[]"></textarea>
										<span class="description">HTML step content.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="contentfromfile1">Content from file</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="contentfromfile1" name="step_content_from_file[]" />
										<span class="description">Specify the file from which content will be loaded via AJAX. If you specify this parameter, html step content will be ignored.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="contenttag1">Content tag</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="div" id="contenttag1" name="step_content_tag[]">
										<span class="description">Defines the html tag of the step content node.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="contentid1">Content id</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="content1" id="contentid1" name="step_content_id[]">
										<span class="description">Defines the id attribute of the step content.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="contentclass1">Content class</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="contentclass1" name="step_content_class[]">
										<span class="description">Defines the class attribute of the step content.</span>
									</td>
								</tr>
							</table>
							<table class="form-table" id="dspp_table_content2">
								<tr valign="top">
									<th scope="row" colspan="2" style="font-weight: bold;">
										Step 2 settings:
									</th>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="title2">Title</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="title2" name="step_title[]">
										<span class="description">Defines the title of the step.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="width2">Width</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="width2" name="step_width[]">
										<span class="description">Defines the width of the step (in px).</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="tag2">Tag</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="a" id="tag2" name="step_tag[]">
										<span class="description">Defines the html tag of the step node.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="href2">Href</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="#content2" id="href2" name="step_href[]">
										<span class="description">Defines the href attribute of the step.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="class2">Class</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="class2" name="step_class[]">
										<span class="description">Defines the class attribute of the step.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="label2">Label</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="label2" name="step_label[]">
										<span class="description">Defines the label attribute of the step.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="content2">Content</label>
									</th>
									<td>
										<textarea cols="50" rows="10" id="content2" class="large-text code" name="step_content[]"></textarea>
										<span class="description">HTML step content.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="contentfromfile2">Content from file</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="contentfromfile2" name="step_content_from_file[]" />
										<span class="description">Specify the file from which content will be loaded via AJAX. If you specify this parameter, html step content will be ignored.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="contenttag2">Content tag</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="div" id="contenttag2" name="step_content_tag[]">
										<span class="description">Defines the html tag of the step content node.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="contentid2">Content id</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="content2" id="contentid2" name="step_content_id[]">
										<span class="description">Defines the id attribute of the step content.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="contentclass2">Content class</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="contentclass2" name="step_content_class[]">
										<span class="description">Defines the class attribute of the step content.</span>
									</td>
								</tr>
							</table>
							<table class="form-table" id="dspp_table_content3">
								<tr valign="top">
									<th scope="row" colspan="2" style="font-weight: bold;">
										Step 3 settings:
									</th>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="title3">Title</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="title3" name="step_title[]">
										<span class="description">Defines the title of the step.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="width3">Width</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="width3" name="step_width[]">
										<span class="description">Defines the width of the step (in px).</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="tag3">Tag</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="a" id="tag3" name="step_tag[]">
										<span class="description">Defines the html tag of the step node.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="href3">Href</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="#content3" id="href3" name="step_href[]">
										<span class="description">Defines the href attribute of the step.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="class3">Class</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="class3" name="step_class[]">
										<span class="description">Defines the class attribute of the step.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="label3">Label</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="label3" name="step_label[]">
										<span class="description">Defines the label attribute of the step.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="content3">Content</label>
									</th>
									<td>
										<textarea cols="50" rows="10" id="content3" class="large-text code" name="step_content[]"></textarea>
										<span class="description">HTML step content.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="contentfromfile3">Content from file</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="contentfromfile3" name="step_content_from_file[]" />
										<span class="description">Specify the file from which content will be loaded via AJAX. If you specify this parameter, html step content will be ignored.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="contenttag3">Content tag</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="div" id="contenttag3" name="step_content_tag[]">
										<span class="description">Defines the html tag of the step content node.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="contentid3">Content id</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="content3" id="contentid3" name="step_content_id[]">
										<span class="description">Defines the id attribute of the step content.</span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="contentclass3">Content class</label>
									</th>
									<td>
										<input type="text" class="regular-text" value="" id="contentclass3" name="step_content_class[]">
										<span class="description">Defines the class attribute of the step content.</span>
									</td>
								</tr>
							</table>
						</th>
					</tr>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" value="Save Options" class="button-primary" name="Submit">
				<input type="hidden" name="action" value="save" />
			</p>
		</form>
		<?php
	}
}

function dspp_enqueue_scripts()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('dspp-process-panel', plugins_url('js/jquery.processPanel.js', __FILE__));
	//uncomment below line and remove above one if you would like to use minified version of js file
	//wp_enqueue_script('dspp-process-panel', plugins_url('js/jquery.processPanel.min.js', __FILE__));
	wp_enqueue_style('dspp-style', plugins_url('style.css', __FILE__));
	wp_enqueue_style('dspp-all-colors', plugins_url('colors/allColors.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'dspp_enqueue_scripts');

/*add_action('wp_head', 'dspp_head');
function dspp_head()
{
	echo "
		<link type='text/css' rel='stylesheet' href='" . get_bloginfo('wpurl') . "/wp-content/plugins/dynamic_step_process_panels/style.css' />
		<link type='text/css' rel='stylesheet' href='" . get_bloginfo('wpurl') . "/wp-content/plugins/dynamic_step_process_panels/colors/allColors.css' />
	";
}
add_action('wp_footer', 'dspp_footer');
function dspp_footer()
{
	delete_option('jsLoaded');
}*/
//Dynamic Step Process Panels shortcode
//add_option('jsLoaded', 'false');
function dspp_shortcode($atts) 
{
	extract(shortcode_atts(array(
		'id' => '',
		'packed' => 'true',
		'jquery' => 'true'
	), $atts));
	if($id!="")
	{
		if($shortcode_settings = get_option('dspp_shortcode_settings_' . $id))
		{
			extract($shortcode_settings);
			$dspp = "";
			/*if(get_option('jsLoaded')=='false')
			{
				if($jquery=="true")
					$dspp .= "<script type='text/javascript' src='" . get_bloginfo('wpurl') . "/wp-content/plugins/dynamic_step_process_panels/js/jquery-1.7.1.min.js'></script>";
				if($packed=="true")
					$dspp .= "<script type='text/javascript' src='" . get_bloginfo('wpurl') . "/wp-content/plugins/dynamic_step_process_panels/js/jquery.processPanel.min.js'></script>";
				else
					$dspp .= "<script type='text/javascript' src='" . get_bloginfo('wpurl') . "/wp-content/plugins/dynamic_step_process_panels/js/jquery.processPanel.js'></script>";
				update_option('jsLoaded', 'true');
			}*/
			//create panel html
			$shortcode = "[dspp_panel" 
				. ($paneltag!="" ? " tag='" . $paneltag . "'" : "")
				. ($panelwidth!="" ? " width='" . $panelwidth . "'" : "")
				. ($panelid!="" ? " id='" . $panelid . "'" : "")
				. ($panelclass!="" ? " class='" . $panelclass . "'" : "")
				. ($panelstyle!="" ? " style='" . $panelstyle . "'" : "")
				. ($panelaction!="" && $paneltag=="form" ? " action='" . $panelaction . "'" : "")
				. (($panelmethod=="post" || $panelmethod=="get") && $paneltag=="form" ? " method='" . $panelmethod . "'" : "") 
				. "]";
			$steps = "";
			$contents = "";
			for($i=0; $i<$stepscount; $i++)
			{
				$steps .=" [dspp_step"
					. ($width[$i]!="" ? " width='" . $width[$i] . "'" : "")
					. ($tag[$i]!="" ? " tag='" . $tag[$i] . "'" : "")
					. ($href[$i]!="" ? " href='" . $contentfromfile[$i] . $href[$i] . "'" : "")
					. ($class[$i]!="" ? " class='" . $class[$i] . "'" : "")
					. ($label[$i]!="" ? " label='" . $label[$i] . "'" : "") 
					. "]"
					. stripslashes($title[$i])
					. "[/dspp_step]";
			}
			for($i=0; $i<$stepscount; $i++)
			{
				$contents .=" [dspp_content"
					. ($contenttag[$i]!="" ? " tag='" . $contenttag[$i] . "'" : "")
					. ($contentid[$i]!="" ? " id='" . $contentid[$i] . "'" : "")
					. ($contentclass[$i]!="" ? " class='" . $contentclass[$i] . "'" : "")
					. "]"
					. stripslashes($content[$i])
					. "[/dspp_content]";
			}
			if($nextprevbuttonsposition=="top")
				$shortcode .= $contents.$steps;
			else
				$shortcode .= $steps.$contents;
			$shortcode .= "[/dspp_panel]";
			$dspp .= do_shortcode($shortcode);
			$dspp .= "
			<script type='text/javascript'>
				jQuery(document).ready(function($){
					$('#$panelid').processPanel({
						kind: '$kind',
						markVisited: $markvisited,
						style: '$style',
						firstSelected: $firstselected,
						icons: $icons,
						imgFolder: '$imgfolder',
						chooseAgain: $chooseagain,
						nextPrevButtons: $nextprevbuttons,
						nextPrevButtonsPosition: '$nextprevbuttonsposition',
						nextButtonTitle: '$nextbuttontitle',
						prevButtonTitle: '$prevbuttontitle',
						fadeSpeed: $fadespeed,
						event: '$event',
						beforeLoad: " . stripslashes($beforeload) . ",
						onLoad: " . stripslashes($onload) . ",
						onOpen: " . stripslashes($onopen) . ",
						afterOpen: " . stripslashes($afteropen) . ",
						onOpenPopup: " . stripslashes($onopenpopup) . ",
						onClosePopup: " . stripslashes($onclosepopup) . ",
						onHoverIn: " . stripslashes($onhoverin) . ",
						onHoverOut: " . stripslashes($onhoverout) . "
				});
				});
			</script>";
		}
		else
			$dspp = "Shortcode with given id not found!";
	}
	else
		$dspp = "Parameter id not specified!";
	return $dspp;
}
add_shortcode('dspp', 'dspp_shortcode');

function dspp_shortcode_old($atts) {
	extract(shortcode_atts(array(
		'id' => 'processPanel',
		'kind' => 'stepByStep',
		'markvisited' => 'true',
		'style' => 'green-blue',
		'firstselected' => 'true',
		'icons' => 'true',
		'imgfolder' => 'wp-content/plugins/dynamic_step_process_panels/img',
		'chooseagain' => 'true',
		'nextprevbuttons' => 'true',
		'nextprevbuttonsposition' => 'bottom',
		'nextbuttontitle' => 'Next step',
		'prevbuttontitle' => 'Previous step',
		'fadespeed' => '1000',
		'event' => 'click',
		'beforeload' => 'function(){}',
		'onload' => 'function(){}',
		'onopen' => 'function(){}',
		'afteropen' => 'function(){}',
		'onopenpopup' => 'function(){}',
		'onclosepopup' => 'function(){}',
		'onhoverin' => 'function(){}',
		'onhoverout' => 'function(){}',
		'packed' => 'true',
		'jquery' => 'true'
	), $atts));
	$dspp = "";
	if(get_option('jsLoaded')=='false')
	{
		if($jquery=="true")
			$dspp .= "<script type='text/javascript' src='" . get_bloginfo('wpurl') . "/wp-content/plugins/dynamic_step_process_panels/js/jquery-1.7.1.min.js'></script>";
		if($packed=="true")
			$dspp .= "<script type='text/javascript' src='" . get_bloginfo('wpurl') . "/wp-content/plugins/dynamic_step_process_panels/js/jquery.processPanel.min.js'></script>";
		else
			$dspp .= "<script type='text/javascript' src='" . get_bloginfo('wpurl') . "/wp-content/plugins/dynamic_step_process_panels/js/jquery.processPanel.js'></script>";
		update_option('jsLoaded', 'true');
	}
	$dspp .= "
	<script type='text/javascript'>
		jQuery(document).ready(function($){
			$('#$id').processPanel({
				kind: '$kind',
				markVisited: $markvisited,
				style: '$style',
				firstSelected: $firstselected,
				icons: $icons,
				imgFolder: '$imgfolder',
				chooseAgain: $chooseagain,
				nextPrevButtons: $nextprevbuttons,
				nextPrevButtonsPosition: '$nextprevbuttonsposition',
				nextButtonTitle: '$nextbuttontitle',
				prevButtonTitle: '$prevbuttontitle',
				fadeSpeed: $fadespeed,
				event: '$event',
				beforeLoad: $beforeload,
				onLoad: $onload,
				onOpen: $onopen,
				afterOpen: $afteropen,
				onOpenPopup: $onopenpopup,
				onClosePopup: $onclosepopup,
				onHoverIn: $onhoverin,
				onHoverOut: $onhoverout
		});
		});
	</script>";
	return $dspp;
}
add_shortcode('dspp_old', 'dspp_shortcode_old');

//panel shortcode
function dspp_panel_shortcode($atts, $content)
{
	extract(shortcode_atts(array(
		'tag' => 'div',
		'width' => '',
		'id' => 'processPanel',
		'class' => 'dspp_panel dspp_clearfix',
		'style' => '',
		'action' => '',
		'method' => ''
	), $atts));
	if($id!="")
		$stepContent = "<$tag id='$id'" . " class='$class'" . ($style!="" ? " style='$style'" : "") . ($action!="" ? " action='$action'" : "") . ($method!="" ? " method='$method'" : "") . ((int)$width>0 ? " style='width:" . (int)$width . "px;'" : "") . ">" . do_shortcode($content) . "</$tag>";
	else
		$stepContent = "id attribute required!";
	return $stepContent;
}
add_shortcode('dspp_panel', 'dspp_panel_shortcode');

//step shortcode
function dspp_step_shortcode($atts, $content)
{
	extract(shortcode_atts(array(
		'width' => '',
		'tag' => 'a',
		'class' => '',
		'href' => '',
		'label' => ''
	), $atts));
	if($href!="")
		$step = "<$tag href='$href'" . ($class!="" ? " class='$class'" : "") . ($label!="" ? " label='$label'" : "") . ((int)$width>0 ? " style='width:" . (int)$width . "px;'" : "") . ">" . do_shortcode($content) . "</$tag>";
	else
		$step = "href attribute required!";
	return $step;
}
add_shortcode('dspp_step', 'dspp_step_shortcode');

//content shortcode
function dspp_content_shortcode($atts, $content)
{
	extract(shortcode_atts(array(
		'tag' => 'div',
		'id' => '',
		'class' => ''
	), $atts));
	if($id!="")
		$stepContent = "<$tag id='$id'" . ($class!="" ? " class='$class'" : "") . ">" . do_shortcode($content) . "</$tag>";
	else
		$stepContent = "id attribute required!";
	return $stepContent;
}
add_shortcode('dspp_content', 'dspp_content_shortcode');
?>