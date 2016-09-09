<?php 
    ob_start();
    session_start();
    include( dirname(__DIR__). '/includes/config.php');
    include( ABSPATH. 'admin/includes/functions.php'); 
    if(!user_logged_in()) header("Location: ".ADMINURL."login.php");
    else logout_user();
?>