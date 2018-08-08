<?php

/*
**  Custom useful functions for convenience
*/

include_once(dirname(__FILE__).'/../priv/constants.php');
include_once(dirname(__FILE__).'/FpArray.php');

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

  // Roll dice
  static public function dice($amt = 1, $faces = 6) {
    $arr = new FpArray(array_pad([], $amt, $faces));

    // Mapping function
    $mapper = function($n) {
      return rand(1, $n);
    };

    // Return mapped array
    return $arr->map($mapper)->get();
  }

}

?>
