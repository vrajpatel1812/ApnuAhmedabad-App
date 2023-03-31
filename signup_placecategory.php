<?php

//Connection
$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array 
$response = array();
//Tables Fields 
//Check Fields are Empty or Not 
//Only Use Required Fields 
if (isset($_POST['Category_name']) && !empty($_POST['Category_name']) && isset($_POST['Category_photo_path']) && !empty($_POST['Category_photo_path']))
{

    //Stores Values in Variable
    $Category_name =  $_POST['Category_name'];
    $Category_photo_path = $_POST['Category_photo_path'];
    
    $insertquery = mysqli_query($connection, "insert into place_category (`Category_name`, `Category_photo_path`) "
            . "values ('{$Category_name}','{$Category_photo_path}')") or die(mysqli_error($connection));
    $lastinsertid = mysqli_insert_id($connection);

    if ($insertquery) 
    {
        $response['success'] = 1;
        $response['cid'] = $lastinsertid;
        $response['Category_name'] = $Category_name;
        $response['message'] = "Signup Successfully";
    }
     else 
    {
        $response['success'] = 0;
        $response['message'] = "Please Try Again";
    }
} 
else 
{

    $response['success'] = 0;
    $response['message'] = "Required fields missing";
}
echo json_encode($response);
?>