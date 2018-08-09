<?php

include_once(dirname(__FILE__)."/FpTools.php");

class FpApp {

  // User keys
  const USER_KEYS = [
    "id",               // User ID
    "email",            // User email
    "username",         // Username
    "flag_url",         // Player flag URL
    "personal_api_key"  // User API Key, used for front-end authentication
  ];

  // Army keys
  const ARMY_KEYS = [
    "id",       // Army ID
    "name",     // Army name
    "manpower"  // Army manpower count
  ];

  /*
  **  Load App profile of logged-in user
  */

  static public function fetchData() {
    $uid = $_SESSION['id'];

    // Fetch data
    $userData = FpTools::queryRowSelect("users", "id = {$uid}", FpApp::USER_KEYS);
    $armies = FpTools::queryRowSelect("armies", "id_owner = {$uid}", FpApp::ARMY_KEYS);

    // Compose final associative array
    return [
      "user"    => $userData,
      "armies"  => ($armies ? $armies : [])
    ];
  }

}

?>
