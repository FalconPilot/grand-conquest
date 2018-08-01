<?php

$pagename = explode('/', $_SERVER['REQUEST_URI'])[0];
if (!$pagename || $pagename === "") {
  $pagename = "index";
}

define('PAGEVIEW', './html/routes/'.$pagename.'.phtml');
include('./html/core.phtml');

?>
