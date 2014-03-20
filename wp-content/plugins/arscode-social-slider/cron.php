<?php
require_once(dirname(__FILE__) . '/../../../wp-config.php');
nocache_headers(); 
fblb_getgpfeed();
fblb_getpifeed();
?>
DONE