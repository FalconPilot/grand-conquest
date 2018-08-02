<?php

/*
**  Custom MySQL functions for convenience
*/

include(dirname(__FILE__).'/../priv/constants.php');

class FpTools {

  // Redirect to other page
  public function redirect($url, $code = null) {
    $arg = is_string($code) ? "?flash={$code}" : "";
    header("Location: {$url}{$arg}");
    exit();
  }

  // Connect to database
  private function connect() {
    return new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

  // Query data
  public function queryValue($table, $key, $cond = "true") {
    $result = $this->connect()->query("SELECT {$key} FROM {$table} WHERE {$cond} LIMIT 1");
    return $result ? $result->fetch_array()[$key] : null;
  }

}

?>
