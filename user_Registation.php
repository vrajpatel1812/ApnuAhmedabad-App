<?php

//Connection
$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array 
$response = array();
//Tables Fields 
//Check Fields are Empty or Not 
//Only Use Required Fields 
if (isset($_POST['User_name']) && !empty($_POST['User_name']) && isset($_POST['User_email']) && !empty($_POST['User_email']) && isset($_POST['User_password']) && !empty(['User_password']) && isset($_POST['User_mobileno']) && !empty($_POST['User_mobileno'])){

    //Stores Values in Variable
    $User_name =  $_POST['User_name'];
    $User_email = $_POST['User_email'];
    $User_password =  $_POST['User_password'];
    $User_mobileno = $_POST['User_mobileno'];
   

    $insertquery = mysqli_query($connection, "insert into user_master (`User_name`, `User_email`, `User_password`,`User_mobileno`) "
            . "values ('{$User_name}','{$User_email}','{$User_password}','{$User_mobileno}')") or die(mysqli_error($connection));
    $lastinsertid = mysqli_insert_id($connection);

    if ($insertquery) {
        $response['flag'] = 1;
        $response['uid'] = $lastinsertid;
        $response['uname'] = $User_name;
        $response['message'] = "Your Registration Successfully";

        $query_2 = mysqli_query($connection, "select * from user_master where User_id='{$lastinsertid}'") or die(mysqli_error($connection));
        $row_user = mysqli_fetch_array($query_2);
        $mydata['User_id'] = $row_user["User_id"];
        $mydata['User_name'] = $row_user["User_name"];
        $mydata['User_mobileno'] = $row_user["User_mobileno"];
        $mydata['User_email'] = $row_user["User_email"];

        $response['userdata'] = $mydata;

    } else {
        $response['flag'] = 0;
        $response['message'] = "Please Try Again";
    }
} else {

    $response['flag'] = 0;
    $response['message'] = "Required fields missing";
}
echo json_encode($response);
?>