<?php

// Common includes
include('./init.php');

FpSession::initSession();

// Current Pageview
$pagename = explode('/', $_SERVER['REQUEST_URI'])[0];
if (!$pagename || $pagename === "") { $pagename = "index"; }
define('PAGEVIEW', './html/pages/'.$pagename.'.phtml');

// Include Core HTML
include('./html/core.phtml');

?>
