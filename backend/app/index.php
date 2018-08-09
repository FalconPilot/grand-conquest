<?php

include_once(dirname(__FILE__)."/../init.php");

FpSession::initSession(function() {
  define('PAGEVIEW', './app.html');
  include_once('../html/core.phtml');
}, function() {
  FpTools::redirect("/");
});

?>
