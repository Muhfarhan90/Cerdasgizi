<?php
session_start();
if (isset($_POST["logout"])) {
  $_SESSION['is_login'] = false;
  session_unset();
  session_destroy();
  header("Location: http://localhost/cerdasgizi.com/index.php");
  exit();
}
