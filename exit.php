<?php 
if(session_id() == '') {
	session_start();
	}
require("domain/standard_domain.php");

if(isset($_SESSION['loginmaster'])){
    // if you have any cookies related to the login it must be removed
    session_destroy();
    header('location:index.php');
}

?>