<?php

//Connection
$connection=mysqli_connect("localhost","","","aahemedabad");
//Blank Array 
$response = array();
//Tables Fields 
//Check Fields are Empty or Not 
//Only Use Required Fields 
if (isset($_POST['Admin_name']) && !empty($_POST['Admin_name']) && isset($_POST['Admin_email']) && !empty($_POST['Admin_email']) && isset($_POST['Admin_password']) && !empty(['Admin_password']))
{

    //Stores Values in Variable
    $Admin_name =  $_POST['Admin_name'];
    $Admin_email = $_POST['Admin_email'];
    $Admin_password =  $_POST['Admin_password'];
   
   

    $insertquery = mysqli_query($connection, "insert into user_tbl (`Admin_name`, `Admin_email`, `Admin_password`) "
            . "values ('{$Admin_name}','{$Admin_email}','{$Admin_password}')") or die(mysqli_error($connection));
    $lastinsertid = mysqli_insert_id($connection);

    if ($insertquery) {
        $response['success'] = 1;
        $response['aid'] = $lastinsertid;
        $response['Admin_name'] = $user_name;
        $response['message'] = "Signup Successfully";
    } else {
        $response['success'] = 0;
        $response['message'] = "Please Try Again";
    }
} else {

    $response['success'] = 0;
    $response['message'] = "Required fields missing";
}
echo json_encode($response);
?>