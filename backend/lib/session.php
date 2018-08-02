<?php

include(dirname(__FILE__).'/tools.php');

/*
**  Session handlers
*/

error_reporting(E_ALL);
ini_set("display_errors", 1);

class FpSession extends FpTools {

  // Login user
  public function login() {
    $url = isset($_POST['redirect']) ? $_POST['redirect'] : "/";
    $msg;

    // Check if user can log in
    if (session_status() == PHP_SESSION_NONE && isset($_POST['email']) && isset($_POST['pwd'])) {

      // Password/Email is correct
      if ($this->checkPassword($_POST['pwd'], $_POST['email']) === true) {
        session_start([
          "cookie_lifetime" => 86400
        ]);

      // Password/Email is incorrect
      } else {
        $msg = "ep_incorrect";
      }
    } else {
      $msg = "logged";
    }

    $this->redirect($url, $msg);

  }

  // Check password
  private function checkPassword($pwd, $email) {
    $hash = $this->queryValue("users", "password", "email = '{$email}'");
    return password_verify($pwd, $hash);
  }

  // Logout user
  public function logout() {
    session_unset();
    session_destroy();
  }

}

?>
