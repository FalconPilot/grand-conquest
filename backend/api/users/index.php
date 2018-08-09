<?php

/*
**  [GET] /api/users
**
**  Return all users infos
*/

include_once(dirname(__FILE__).'/../../lib/FpApi.php');

$users = isset($_GET['id'])
  ? FpApi::fetchSingle("users", $_GET['id'], FpApi::AUTH_USR)
  : FpApi::fetchAll("users", FpApi::AUTH_USR);


// If users were fetched, return JSON output
header("Content-Type: application/json");
exit(json_encode($users, JSON_NUMERIC_CHECK));

?>
