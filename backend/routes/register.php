<?php

if($_SERVER['REQUEST_METHOD'] != "POST") {
  http_response_code(405);
  exit("[405] - Method not allowed");
}

include_once('./lib/FpSession.php');

FpSession::register();

?>
