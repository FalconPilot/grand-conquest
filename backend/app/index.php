<?php

include(dirname(__FILE__)."/../includes.php");

FpSession::initSession(function() {
  define('PAGEVIEW', './app.html');
  include('../html/core.phtml');
}, true);

?>
