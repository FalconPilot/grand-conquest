<?php

<?php

/*
**  [GET] /api/gamedata
**
**  Return all gamedata infos
*/

include_once(dirname(__FILE__).'/../lib/FpApi');

$users = FpApi::fetchMulti(["wpn_rifles"]);

// If users were fetched, return JSON output
header("Content-Type: application/json");
exit(json_encode($users, JSON_NUMERIC_CHECK));

?>


?>
