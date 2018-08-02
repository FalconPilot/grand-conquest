<?php

// GC Backend Version
define('GC_VERSION', '0.1.0');

// Current Pageview
$pagename = explode('/', $_SERVER['REQUEST_URI'])[0];
if (!$pagename || $pagename === "") { $pagename = "index"; }
define('PAGEVIEW', './html/routes/'.$pagename.'.phtml');

// Include Core HTML
include('./html/core.phtml');

?>
