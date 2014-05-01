<?php

include "../../../../wp-load.php";

global $_POST, $_GET;

$options = get_option(  EasySocialShareButtons::$plugin_settings_name );

$from = isset($_POST['from']) ? $_POST['from'] : '';
if ($from == '') {
	$from = isset($_GET['from']) ? $_GET['from'] : '';
}
$to = isset($_POST['to']) ? $_POST['to'] : '';
if ($to == '') {
	$to = isset($_GET['to']) ? $_GET['to'] : '';
}

$t = isset($_GET['t']) ? $_GET['t'] : '';
$u = isset($_GET['u']) ? $_GET['u'] : '';
$p = isset($_GET['p']) ? $_GET['p'] : '';

$message_subject = $options['mail_subject'];
$message_body = $options['mail_body'];

$message_body = esc_textarea (stripslashes ( $message_body ) );

$message_subject = preg_replace(array('#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#'), array($t, $u, $p), $message_subject);
$message_body = preg_replace(array('#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#'), array($t, $u, $p), $message_body);
	
$copy_address = isset($options['mail_copyaddress']) ?  $options['mail_copyaddress'] : '';

/*$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
$headers .= "From: <$from>\n";
if ($copy_address != '' ) {
	$headers .= "Bcc: $copy_address\n";
}*/

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

// Additional headers
$headers .= 'To: '.$to. '' . "\r\n";
$headers .= 'From: '.$from.'' . "\r\n";
if ($copy_address != '' ) { 
	$headers .= 'Bcc: '. $copy_address . "\r\n";
}

// Mail it
//$headers .= "Return-Path: <" . mysql_real_escape_string(trim($from)) . ">\n";
$message_body = str_replace("\r\n", "<br />", $message_body);

$json = array("message" => "");

if ($from != '' && $to != '' ){ 
//@wp_mail($to, $message_subject, $message_body, $headers);
	mail($to, $message_subject, $message_body, $headers);
	
	
$json['message'] = "Message sent!";
}
else {
	$json ['message'] = "Error sending message!";
}

echo str_replace('\\/','/',json_encode($json));
?>