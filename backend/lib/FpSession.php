<?php

include(dirname(__FILE__).'/FpTools.php');

/*
**  Session handlers
*/

class FpSession {

  // Login user
  public function login() {
    $url = isset($_POST['redirect']) ? $_POST['redirect'] : "/";
    $msg;

    // Check if user can log in
    if (isset($_POST['email']) && isset($_POST['pwd'])) {

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
    }

    FpTools::redirect($url, $msg, "error");

  }

  // Set initial data
  private function initUserData($email) {
    $row = FpTools::queryRow("users", "email = '{$email}'");
    foreach (['id', 'username'] as $key) {
      $_SESSION[$key] = $row[$key];
    }
  }

  // Check password
  private function checkPassword($pwd, $email) {
    $hash = FpTools::queryValue("users", "password", "email = '{$email}'");
    return password_verify($pwd, $hash);
  }

  // Logout user
  public function logout($redirect = true) {
    session_unset();
    setcookie(session_name(), "", time() - 3600, "/");
    session_destroy();

    // Redirect if needed
    if ($redirect === true) {
      FpTools::redirect("/");
    }
  }

  // Register user
  public function register() {
    $url = isset($_POST['redirect']) ? $_POST['redirect'] : "/";
    $msg;

    FpTools::redirect($url);
  }

  // Check if used is logged in, optional callback if true
  static public function initSession($callback = null, $forbidden = false) {

    // Check if user is logged in
    session_start();
    if (!isset($_SESSION['id'])) {
      session_unset();
      setcookie(session_name(), "", time()-3600, "/");
      session_destroy();

      // Execute code if un-logged activity is forbidden
      if ($forbidden === true) {
        http_response_code(401);
        exit("[401] - Unauthorized");
      }

    // Execute callback if user is logged-in
    } else if (is_callable($callback)) {
      $callback();
    }
  }

}

?>
