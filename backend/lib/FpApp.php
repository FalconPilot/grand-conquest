<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once(dirname(__FILE__)."/FpTools.php");

class FpApp {

  // User keys
  const USER_KEYS = [
    "id",               // User ID
    "email",            // User email
    "username",         // Username
    "avatar_url",       // Player flag URL
    "personal_api_key"  // User API Key, used for front-end authentication
  ];

  // Nation keys
  const NATION_KEYS = [
    "id",       // Nation ID
    "name",     // Nation name
    "flag_url", // Nation flag URL
    "manpower"  // National manpower
  ];

  // Army keys
  const ARMY_KEYS = [
    "id",         // Army ID
    "name",       // Army name
    "flag_url"    // Army manpower count
  ];

  // Squad keys
  const SQUAD_KEYS = [
    "id",         // Squad ID
    "codename",   // Squad codename
    "manpower"    // Squad manpower usage
  ];

  // Squad equipment keys
  const EQUIP_KEYS = [

  ];

  /*
  **  Load App profile of logged-in user
  */

  static public function fetchData() {
    $uid = $_SESSION['id'];

    // Fetch data
    $userData = FpTools::queryRowSelect("users", "id = {$uid}", FpApp::USER_KEYS, true);
    $nationData = FpTools::queryRowSelect("nations", "id_owner = {$uid}", FpApp::NATION_KEYS, true);
    $aqr = FpTools::queryRowSelect("armies", "id_owner = {$uid}", FpApp::ARMY_KEYS);
    $aqd = new FpArray($aqr && count(array_filter(array_keys($aqr), 'is_string')) > 0 ? [$aqr] : $aqr);
    $armies = $aqd->map(function($army) {
      $obj = $army;
      $sqd = new FpArray(FpTools::queryRowSelect("squads", "id_army = {$army['id']}", FpApp::SQUAD_KEYS));
      $squads = $sqd->map(function($squad) {
        $obj = $squad;
        $sqe = FpTools::queryEquipment($squad['id']);
        $obj['equipment'] = $sqe;
        return $obj;
      })->get();
      $obj['squads'] = $squads;
      return $obj;
    })->get();

    // Compose final associative array
    return [
      "user"    => $userData,
      "nation"  => $nationData,
      "armies"  => ($armies ? $armies : [])
    ];
  }

}

?>
