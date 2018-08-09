<?php

include_once(dirname(__FILE__)."/../init.php");
include_once(dirname(__FILE__)."/../lib/FpApp.php");

FpSession::initSession(function() {
  $data = json_encode(FpApp::fetchData(), JSON_NUMERIC_CHECK);
  echo("<script id='app-ephemeral'>window.appData = {$data}</script>");
  define('PAGEVIEW', './app.html');
  include_once('../html/core.phtml');
}, function() {
  FpTools::redirect("/");
});

?>
