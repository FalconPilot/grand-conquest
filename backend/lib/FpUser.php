<?php

include(dirname(__FILE__).'/FpTools.php');

class FpUser {
  private $uid;
  public $name;

  // Constructor
  public function __construct($id) {
    $infos = FpTools::queryRow("users", "id = {$id}");
    $this->uid = $infos['id'];
    $this->name = $infos['name'];
  }
}

?>
