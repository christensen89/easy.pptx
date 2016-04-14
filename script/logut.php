<?php
session_start();
include 'db-tilkobling.php';
session_unset();
session_destroy();
header ("Location: ../index.php");
?>
