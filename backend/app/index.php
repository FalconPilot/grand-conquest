<?php

include(dirname(__FILE__)."/../init.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

FpSession::initSession(function() {
  define('PAGEVIEW', './app.html');
  include('../html/core.phtml');
}, true);

?>
