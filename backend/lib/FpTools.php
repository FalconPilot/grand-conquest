<?php

/*
**  Custom MySQL functions for convenience
*/

include(dirname(__FILE__).'/../priv/constants.php');

class FpTools {

  // Redirect to other page
  static public function redirect($url, $code = null, $type = "notif") {
    $arg = is_string($code) ? "?flash={$code}&type={$type}" : "";
    header("Location: {$url}{$arg}");
    exit();
  }

  // Connect to database
  static private function connect() {
    return new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

  // Query single value
  static public function queryValue($table, $key, $cond = "true") {
    $result = FpTools::connect()->query("SELECT {$key} FROM {$table} WHERE {$cond} LIMIT 1");
    return $result ? $result->fetch_array()[$key] : null;
  }

  // Query entire row
  static public function queryRow($table, $cond = "true") {
    $result = FpTools::connect()->query("SELECT * FROM {$table} WHERE {$cond} LIMIT 1");
    return $result ? $result->fetch_array() : null;
  }

}

?>
