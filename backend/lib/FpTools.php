<?php

/*
**  Custom useful functions for convenience
*/

include_once(dirname(__FILE__).'/../priv/constants.php');
include_once(dirname(__FILE__).'/FpArray.php');

class FpTools {

  /*
  **  Redirect user to other page
  */

  static public function redirect($url, $code = null, $type = "notif") {
    $arg = is_string($code) ? "?flash={$code}&type={$type}" : "";
    header("Location: {$url}{$arg}");
    exit();
  }

  /*
  **  Connect to database
  */

  static private function connect() {
    return new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

  /*
  **  Query single value
  */

  static public function queryValue($table, $key, $cond = "true") {
    $result = FpTools::connect()->query("SELECT {$key} FROM {$table} WHERE {$cond} LIMIT 1");
    return $result ? $result->fetch_array()[$key] : null;
  }

  /*
  **  Query entire row
  */

  static public function queryRow($table, $cond = "true", $exclude = []) {
    $result = FpTools::connect()->query("SELECT * FROM {$table} WHERE {$cond} LIMIT 1");
    return $result ? FpTools::removeSingleExcluded($result->fetch_array(MYSQLI_ASSOC), $exclude) : null;
  }

  /*
  **  Query row(s), only selecting some keys
  */

  static public function queryRowSelect($table, $cond = "true", $keys, $unique = false) {
    $q = implode(", ", $keys);
    $limit = $unique === true ? "LIMIT 1" : "";
    $result = FpTools::connect()->query("SELECT {$q} FROM {$table} WHERE {$cond} {$limit}");
    $data = $result ? $result->fetch_all(MYSQLI_ASSOC) : null;
    return $unique === true ? $data[0] : $data;
  }

  /*
  **  Query only one row
  */

  static public function queryAll($table, $cond = "true", $exclude = []) {
    $result = FpTools::connect()->query("SELECT * FROM {$table} WHERE {$cond}");
    $data = $result ? $result->fetch_all(MYSQLI_ASSOC) : null;
    return FpTools::removeExcluded($data, $exclude);
  }

  /*
  **  Query squad equipment
  */

  static public function queryEquipment($id_squad) {
    $joint = FpTools::connect()->query("SELECT
        id_equipment,
        quantity,
        equipment_table
      FROM squads_equipments
      WHERE id_squad = {$id_squad}
    ")->fetch_all(MYSQLI_ASSOC);

    return array_map(function($obj) {
      $result = FpTools::connect()->query("SELECT
          id,
          name,
          image_url,
          description
        FROM {$obj['equipment_table']}
        WHERE id = {$obj['id_equipment']}
      ")->fetch_array(MYSQLI_ASSOC);
      $result['quantity'] = $obj['quantity'];
      return $result;
    }, $joint);
  }

  /*
  **  Roll a set amount of dices
  */

  static public function dice($amt = 1, $faces = 6) {
    $arr = new FpArray(array_pad([], $amt, $faces));

    // Mapping function
    $mapper = function($n) {
      return rand(1, $n);
    };

    // Return mapped array
    return $arr->map($mapper)->get();
  }

  static private function removeSingleExcluded($result, $excludeList) {
    return FpTools::removeExcluded([$result], $excludeList)[0];
  }

  // Filter rows based on array of excluded keys
  static private function removeExcluded($result, $excludeList) {
    $arr = new FpArray($result);

    // Return mapped values
    return $arr->map(function($row) use ($excludeList) {
      foreach($excludeList as $key) {
        unset($row[$key]);
      }
      return $row;
    })->get();
  }
}

?>
