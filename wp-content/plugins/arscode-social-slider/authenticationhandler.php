<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php');

if(!defined('INSTAGRAM_PLUGIN_URL')) {
  define('INSTAGRAM_PLUGIN_URL', plugins_url() . '/' . basename(dirname(__FILE__)));
}

if (isset($_GET['code'])) {

    $options = fblb_get_options();

	$client_id = $options['INST_client_id'];
	$client_secret = $options['INST_client_secret'];

	$response = wp_remote_post("https://api.instagram.com/oauth/access_token",
		array(
			'body' => array(
				'code' => $_GET['code'],
				'response_type' => 'authorization_code',
				'redirect_uri' => plugins_url('authenticationhandler.php', __FILE__),
				'client_id' => $client_id,
				'client_secret' => $client_secret,
				'grant_type' => 'authorization_code',
			),
			'sslverify' => apply_filters('https_local_ssl_verify', false)
		)
	);

	$access_token = null;
	$username = null;
	$image = null;

	$success = false;
	$errormessage = null;
	$errortype = null;

	if(!is_wp_error($response) && $response['response']['code'] < 400 && $response['response']['code'] >= 200):
		$auth = json_decode($response['body']);
		if(isset($auth->access_token)):
			$access_token = $auth->access_token;
			$user = $auth->user;
			
            $options = array_merge(array(
                'INST_access_token' => $access_token,
                'INST_username' => $user->username,
                'INST_picture' => $user->profile_picture,
                'INST_fullname' => $user->full_name
            ),(array)fblb_get_options());
            
            update_option('FBLB_Options', $options);

			$success = true;
		endif;
        elseif(is_wp_error($response)):
                $error = $response->get_error_message();
                $errormessage = $error;
                $errortype = 'Wordpress Error';
	elseif($response['response']['code'] >= 400):
		$error = json_decode($response['body']);
		$errormessage = $error->error_message;
		$errortype = $error->error_type;
	endif;  

	if (!$access_token):
        $options = array_merge(array(
            'INST_access_token' => '',
        ),(array)fblb_get_options());
            
        update_option('FBLB_Options', $options);
	endif;
}

?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		body, html {
			font-family: arial, sans-serif;
			padding: 30px;

			text-align: center;
		}
	</style>
</head>
<body>
<?php if ($success): ?>
	<script type="text/javascript">		
        opener.document.getElementById('INST_access_token').value = '<?php echo $access_token; ?>';
        opener.document.getElementById('INST_username').value = '<?php echo $user->username; ?>';
        opener.document.getElementById('INST_picture').value = '<?php echo $user->profile_picture; ?>';
        opener.document.getElementById('INST_fullname').value = '<?php echo $user->full_name; ?>';
        opener.document.getElementById('submit').click();
   		self.close();
	</script>
<?php else: ?>
	<h1>An error occured</h1>
	<p>
		Type: <?php echo $errortype; ?>
		<br>
		Message: <?php echo $errormessage; ?>
	</p>
	<p>Please make sure you entered the right client details</p>
<?php endif; ?>
</body>
</html>
