<?php

    // session_start();
    // if( ! $_SESSION['id'] ) {
    //     header("Location: ./login.php");
    // }
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    // Database connection
    include('./config/db.php');

    $name = "";
    $query = "";
    if( !empty( $_GET['name'] ) ){
        $name = $_GET['name'];
        // $query .= " WHERE status LIKE '" . $name . "%'";
        $query .= " WHERE status='".$name."'";
    }
    $orderby= "";
    $sortDirection = isset($_GET['sortDirection']) ? $_GET['sortDirection'] : 'desc' ;
    if(  isset( $_GET['sortKey'] ) && $_GET['sortKey'] == 'name' ){
        $sortKey = $_GET['sortKey'];
        $orderby = " ORDER BY ".$sortKey.' '.$sortDirection;    
    }
    

    
    $sql = "SELECT * FROM events ". $query. $orderby;
    // print_r($sql);die;
    $sqlQuery = mysqli_query($connection, $sql);
    $countRow = mysqli_num_rows($sqlQuery);
    $result = array();
    if($countRow > 0){
        while($rowData = mysqli_fetch_array($sqlQuery)){
            $result[] = $rowData;  
        }
    }    

?>