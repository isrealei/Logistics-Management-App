<?php   
session_start(); //to ensure you are using same session
include "../../config/database.php";


session_destroy();//destroy the session


	  header("location:../pages/login.php");

exit();
?>