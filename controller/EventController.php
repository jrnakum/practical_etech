<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// error_reporting(E_ERROR | E_PARSE);

// Database connection
include('../config/db.php');
global $errorFile;

$name = "";
$query = "WHERE user_id='".$_SESSION['id']."'";
if( !empty( $_GET['name'] ) ){
    $name = $_GET['name'];
    $query .= " AND name LIKE '" . $name . "%'";
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
if(isset($_POST['create'])) {
    // print_r($_FILES);
    // print_r($_POST);die;
    $name = $_POST['name'];
    $location = $_POST['location'];
    $date = date('Y-m-d',strtotime($_POST['date']));
    $status = $_POST['status'];
    $user_id = $_SESSION['id'];
    $file_name = "";

    if(isset($_FILES['image'])){
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        // $file_ext=strtolower(end(explode('.',$file_name)));
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $extensions= array("jpeg","jpg","png");
        
        if(in_array($file_ext,$extensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
           $errorFile = '<div class="alert alert-danger">
                            extension not allowed, please choose a JPEG or PNG file.
                        </div>';
        }
        
        if($file_size > 2097152){
            $errorFile = '<div class="alert alert-danger">
                            File size must be excately 2 MB.
                        </div>';
           $errors[]='File size must be excately 2 MB';
        }
        
        if(empty($errors)==true){
           move_uploaded_file($file_tmp,"../uploads/".$file_name);
        }

        // print_r($errors);die;
     }
    

    // clean data 
    $name = mysqli_real_escape_string($connection, $name);
    $location = mysqli_real_escape_string($connection, $location);
    $date = mysqli_real_escape_string($connection, $date);
    $status = mysqli_real_escape_string($connection, $status);
    $file_name = mysqli_real_escape_string($connection, $file_name);
    $user_id = mysqli_real_escape_string($connection, $user_id);

    // Query if email exists in db
    $sql = "INSERT INTO events(name, location,event_date, status, photos,user_id) VALUES ('{$name}', '{$location}','{$date}', '{$status}', '{$file_name}','{$user_id}')";
    $query = mysqli_query($connection, $sql);
    // echo "<pre>";
    // var_dump($connection, $sql);die;
    // $rowCount = mysqli_num_rows($query);
    if( $query ) {
        header("Location: ./list.php");
    }
    // If query fails, show the reason 
    if(!$query){
       die("SQL query failed: " . mysqli_error($connection));
    }
    // print_r($_GET['id']);die;
    

}

if( !empty( $_GET['id'] ) ){
    $sqlQuery = mysqli_query($connection, "SELECT * FROM events WHERE id='" . $_GET["id"] . "'");
    $result = mysqli_fetch_array($sqlQuery);    
} 

if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $date = date('Y-m-d',strtotime($_POST['date']));
    $status = $_POST['status'];
    $file_name = "";
    $id = $_POST['id'];
    $user_id = $_SESSION['id'];

    if(isset($_FILES['image'])){
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $extensions= array("jpeg","jpg","png");
        
        if(in_array($file_ext,$extensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
           $errorFile = '<div class="alert alert-danger">
                            extension not allowed, please choose a JPEG or PNG file.
                        </div>';
        }
        
        if($file_size > 2097152){
            $errorFile = '<div class="alert alert-danger">
                            File size must be excately 2 MB.
                        </div>';
           $errors[]='File size must be excately 2 MB';
        }
        
        if( empty($errors) == true ){
            move_uploaded_file($file_tmp,"../uploads/".$file_name);
        }
     }
    

    // clean data 
    $name = mysqli_real_escape_string($connection, $name);
    $location = mysqli_real_escape_string($connection, $location);
    $date = mysqli_real_escape_string($connection, $date);
    $status = mysqli_real_escape_string($connection, $status);
    $file_name = mysqli_real_escape_string($connection, $file_name);
    $user_id = mysqli_real_escape_string($connection, $user_id);
    // Query if email exists in db
    // $sql = "INSERT INTO products (name, price, status, image) VALUES ('{$name}', '{$price}', '{$status}', '{$file_name}')";
    // $sql = "INSERT INTO products (name, price, status, image) VALUES ('{$name}', '{$price}', '{$status}', '{$file_name}')";
    // $query = "UPDATE toy set name = '".$_POST["name"]."', code = '".$_POST["code"]."', category = '".$_POST["category"]."', price = '".$_POST["price"]."', stock_count = '".$_POST["stock_count"]."' WHERE  id=".$_GET["id"];
    // $sql = "UPDATE INTO products set name='"" (name, price, status, image) VALUES ('{$name}', '{$price}', '{$status}', '{$file_name}')";
    // $sql = "UPDATE products set name='".$name."', price='".$price."', status='".$status."', image='".$file_name."' WHERE id=".$id;
    $sql = "UPDATE events set name='".$name."', user_id='".$user_id."',location='".$location."',event_date='".$date."', status='".$status."', photos='".$file_name."' WHERE id=".$id;
    $query = mysqli_query($connection, $sql);
    // $rowCount = mysqli_num_rows($query);
    if( $query ) {
        header("Location: ./list.php");
    }
    // If query fails, show the reason 
    if(!$query){
       die("SQL query failed: " . mysqli_error($connection));
    }
    // print_r($_GET['id']);die;
    

}