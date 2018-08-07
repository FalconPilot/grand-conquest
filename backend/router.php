<?php

$path = str_replace('.', '', $_GET['path']);

if (isset($_GET['path']) && file_exists("./routes/{$path}.php")) {
  include("./routes/{$path}.php");
} else {
  include("./index.php");
}

?>
