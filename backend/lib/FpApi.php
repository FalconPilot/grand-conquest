<?php

include_once(dirname(__FILE__).'/FpArray.php');
include_once(dirname(__FILE__).'/FpTools.php');

class FpApi {

  // Authorization constants
  const AUTH_USR = 1;
  const AUTH_MOD = 2;
  const AUTH_ADM = 3;

  const AUTHORIZATIONS = [
    "user"      => FpApi::AUTH_USR,
    "moderator" => FpApi::AUTH_MOD,
    "admin"     => FpApi::AUTH_ADM
  ];

  // Other constants
  const PRIVATE_KEYS = ["password", "personal_api_key", "email"];

  /*
  **  Check general authorization
  */

  static private function isAllowed($required) {
    $status = FpTools::queryValue("users", "status", "personal_api_key = '{$_GET['ak']}'");
    if ($status && FpApi::AUTHORIZATIONS[$status] >= $required) {
      return;
    } else {
      FpApi::returnError(401, "Forbidden access");
    }
  }

  /*
  **  Check individual users authorizations
  */

  static private function forUser($table, $id_data) {
    $user = FpTools::queryRow("users", "personal_api_key = '{$_GET['ak']}'");
    $level = $user ? (int)FpApi::AUTHORIZATIONS[$user["status"]] : 0;

    // If user is found, process
    if ($user && $user["id"] && $level < FpApi::AUTH_MOD) {
      $row = FpTools::queryRow($table, "id_user", "id_user = {$user['id']}");

      // Check ID correspondance
      if ($row["id"] !== $user["id"]) {
        FpApi::returnError(401, "Forbidden access");
      }

    // Return forbidden error
  } else if ($level < FpApi::AUTH_MOD) {
      FpApi::returnError(401, "Forbidden access");
    }
  }

  // Check required params
  static private function checkParams($source, $query) {
    $arr = new FpArray($query);
    $filter = function($key) use ($source) {
      return !array_key_exists($key, $source);
    };

    // Return error if parameters are missing
    if ($arr->filter($filter)->count() > 0) {
      FpApi::returnError(400, "Parameters are missing");
    }
  }

  static private function returnError($code = 500, $message = "Internal server error") {
    http_response_code($code);
    exit("<pre>[{$code}] - {$message}</pre>");
  }

  /*
  **  Fetch all data from table
  */

  static public function fetchAll($table, $auth_required) {
    FpApi::isAllowed($auth_required);

    return FpTools::queryAll($table, "true", FpApi::PRIVATE_KEYS);
  }

  /*
  **  Fetch one row from a table
  */

  static public function fetchSingle($table, $id_data, $auth_required) {
    FpApi::forUser($table, $id_data);

    return FpTools::queryRow($table, "id = {$id_data}", FpApi::PRIVATE_KEYS);
  }

  /*
  **  Fetch all data from multiple tables
  */

  static public function fetchMultiple($tables) {
    $arr = new FpArray($tables);
    return $arr->map(FpApi::fetchAll)->get();
  }
}

?>
