<?php

/*
**  [GET] /api/users
**
**  Return all users infos
*/

include_once(dirname(__FILE__).'/../lib/FpApi');

$users = FpApi::fetchAll("users");

// If users were fetched, return JSON output
header("Content-Type: application/json");
exit(json_encode($users, JSON_NUMERIC_CHECK));

?>
