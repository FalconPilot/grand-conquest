<?php

/*
**  Custom MySQL functions for convenience
*/

include('../priv/constants.php');

class FpSql {

  // Connect to database
  private function connect() {
    return new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

}

?>
