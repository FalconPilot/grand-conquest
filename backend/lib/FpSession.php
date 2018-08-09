<?php

include_once(dirname(__FILE__).'/FpTools.php');

/*
**  Session handlers
*/

class FpSession {

  // Login user
  static public function login() {
    $url = isset($_POST['redirect']) ? $_POST['redirect'] : "/";
    $msg;

    // Check if user can log in
    if (isset($_POST['email']) && isset($_POST['pwd'])) {

      // Password/Email is correct
      if (FpSession::checkPassword($_POST['pwd'], $_POST['email']) === true) {
        session_start([
          "cookie_lifetime" => 86400
        ]);

        FpSession::initUserData($_POST['email']);

      // Password/Email is incorrect
      } else {
        $msg = "ep_incorrect";
      }
    }

    FpTools::redirect($url, $msg, "error");

  }

  // Set initial data
  static private function initUserData($email) {
    $row = FpTools::queryRow("users", "email = '{$email}'", ["password"]);
    foreach (array_keys($row) as $key) {
      $_SESSION[$key] = $row[$key];
    }
  }

  // Check password
  static private function checkPassword($pwd, $email) {
    $hash = FpTools::queryValue("users", "password", "email = '{$email}'");
    return password_verify($pwd, $hash);
  }

  // Logout user
  static public function logout($redirect = true) {
    session_unset();
    setcookie(session_name(), "", time() - 3600, "/");
    session_destroy();

    // Redirect if needed
    if ($redirect === true) {
      FpTools::redirect("/");
    }
  }

  // Register user
  static public function register() {
    $url = isset($_POST['redirect']) ? $_POST['redirect'] : "/";
    $msg;

    FpTools::redirect($url);
  }

  // Check if used is logged in, optional callback if true
  static public function initSession($callback = null, $errCallback = null) {

    // Check if user is logged in
    session_start();
    if (!isset($_SESSION['id'])) {
      session_unset();
      setcookie(session_name(), "", time()-3600, "/");
      session_destroy();

      // Execute error callback if specified
      if (is_callable($errCallback)) {
        $errCallback();
      }

    // Execute callback if user is logged-in
    } else if (is_callable($callback)) {
      $callback();
    }
  }

}

?>
