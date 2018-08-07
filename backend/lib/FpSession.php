<?php

include(dirname(__FILE__).'/FpTools.php');

/*
**  Session handlers
*/

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

        $this->initUserData($_POST['email']);

      // Password/Email is incorrect
      } else {
        $msg = "ep_incorrect";
      }
    } else {
      $msg = "logged";
    }

    $this->redirect($url, $msg, "error");

  }

  // Set initial data
  private function initUserData($email) {
    $row = $this->queryRow("users", "email = '{$email}'");
    foreach (['id', 'username'] as $key) {
      $_SESSION[$key] = $row[$key];
    }
  }

  // Check password
  private function checkPassword($pwd, $email) {
    $hash = $this->queryValue("users", "password", "email = '{$email}'");
    return password_verify($pwd, $hash);
  }

  // Logout user
  public function logout() {
    session_unset();
    setcookie(session_name(), "", time()-3600, "/");
    session_destroy();
    $this->redirect("/");
  }

  // Register user
  public function register() {
    $this->redirect("/");
  }

}

?>
