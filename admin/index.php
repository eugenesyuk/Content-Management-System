<?php 
ob_start();
include(dirname(__DIR__)."/includes/config.php");
header("Location: ".ADMINURL."dashboard.php");
?>