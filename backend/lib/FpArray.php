<?php

class FpArray {

  // Class variables
  private $value;

  // Initialize object
  public function __construct($initial = []) {
    $this->value = is_array($initial) ? $initial : [];
  }

  /*
  **  Morphing functions, return $this
  */

  // Map array
  public function map($func) {
    $this->value = array_map($func, $this->value);
    return $this;
  }

  // Reduce array
  public function reduce($func, $acc) {
    $this->value = array_reduce($this->value, $func, $acc);
    return $this;
  }

  // Filter array
  public function filter($func) {
    $this->value = array_filter($this->value, $func);
    return $this;
  }

  /*
  **  Data-returning functions
  */

  // Fetch class value
  public function get() {
    return $this->value;
  }

  // Fetch class count
  public function count() {
    return count($this->value);
  }

  // Return glued
  public function join($glue) {
    return implode($glue, $this->value);
  }

}

?>
