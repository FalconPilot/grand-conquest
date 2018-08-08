<?php

// Common includes
include('./includes.php');

// GC Backend Version
define('GC_VERSION', '0.1.3');

// Check session
session_start();
if (!isset($_SESSION['id'])) {
  session_unset();
  setcookie(session_name(), "", time()-3600, "/");
  session_destroy();
}

// Current Pageview
$pagename = explode('/', $_SERVER['REQUEST_URI'])[0];
if (!$pagename || $pagename === "") { $pagename = "index"; }
define('PAGEVIEW', './html/pages/'.$pagename.'.phtml');

// Include Core HTML
include('./html/core.phtml');

?>
