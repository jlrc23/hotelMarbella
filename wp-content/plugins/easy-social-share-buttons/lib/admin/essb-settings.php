<?php
$current_tab = (empty ( $_GET ['tab'] )) ? 'general' : sanitize_text_field ( urldecode ( $_GET ['tab'] ) );

$tabs = array ('general' => __ ( 'Main Settings', ESSB_TEXT_DOMAIN ), 'display' => __ ( 'Display Settings', ESSB_TEXT_DOMAIN ), 'shortcode' => __ ( 'Shortcode Generator', ESSB_TEXT_DOMAIN ) );

?>
<div class="wrap">
	<div class="icon32">
		<img
			src="<?php echo ESSB_PLUGIN_URL . '/assets/images/essb_32.png';?>" />
	</div>
	<h2 class="nav-tab-wrapper">
<?php
foreach ( $tabs as $name => $label ) {
	echo '<a href="' . admin_url ( 'admin.php?page=essb_settings&tab=' . $name ) . '" class="nav-tab ';
	if ($current_tab == $name)
		echo 'nav-tab-active';
	echo '">' . $label . '</a>';
}
?>
</h2>

<?php

switch ($current_tab) :
	case "general" :
		include (ESSB_PLUGIN_ROOT . '/lib/admin/pages/essb-settings-general.php');
		
		break;
	case "display" :
		include (ESSB_PLUGIN_ROOT . '/lib/admin/pages/essb-settings-display.php');
		
		break;	
	case "shortcode" :
		include (ESSB_PLUGIN_ROOT . '/lib/admin/pages/essb-settings-shortcode.php');
		
		break;	
		case "backup" :
			include (ESSB_PLUGIN_ROOT . '/lib/admin/pages/essb-settings-backup.php');
		
			break;
		
endswitch
;


?>
