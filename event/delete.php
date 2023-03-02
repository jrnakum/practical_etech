<?php

include('../config/db.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_reporting(E_ERROR | E_PARSE);


if( ! empty($_GET["id"] ) ) {
    $query = "DELETE FROM events WHERE id=".$_GET["id"];
    $result = mysqli_query($connection, $query);
	if(!empty($result)){
		header("Location: ./list.php");
	}
}
?>