<?php

include_once(dirname(__FILE__).'/FpArray.php');
include_once(dirname(__FILE__).'/FpTools.php');

class FpApi {

  // Authorization constants
  const $auth_public      = 1;
  const $auth_restricted  = 2;
  const $auth_forbidden   = 3;

  // Check authorization
  static private function isAllowed($required_level) {

  }

  // Check required params
  static private function checkParams($source, $query) {
    $arr = new FpArray($query);
    $filter = function($key) use ($source) {
      return array_key_exists($key, $source);
    };
    $arr->filter($filter)->get();
  }

  static private function returnError($code = 500, $message = "Internal server error") {
    http_response_code($code);
    exit("<pre>[{$code}] - {$message}</pre>");
  }

  // Fetch all data from category
  static public function fetchAll($table) {

  }
}

?>
