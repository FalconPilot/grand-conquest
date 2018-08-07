<?php

include(dirname(__FILE__).'/FpTools.php');

class FpUser extends FpTools {
  private $uid;
  public $name;

  // Constructor
  public function __construct($id) {
    $infos = $this->queryRow("users", "id = {$id}");
    $this->uid = $infos['id'];
    $this->name = $infos['name'];
  }
}

?>
