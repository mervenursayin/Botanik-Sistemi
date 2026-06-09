<?php
// cikis.php
require_once 'config/veritabanı.php';
$_SESSION = array();
session_destroy();
header("Location: index.php");
exit();
?>