<?php

//Connection
$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array 
$response = array();
//Tables Fields 
//Check Fields are Empty or Not 
//Only Use Required Fields 
if (isset($_POST['Category_id']) && !empty($_POST['Category_id']) && isset($_POST['Place_title']) && !empty($_POST['Place_title']) && isset($_POST['Place_details']) && !empty(['Place_details']) && isset($_POST['Place_img_path']) && !empty($_POST['Place_img_path']))
{

    //Stores Values in Variable
    $Category_id =  $_POST['Category_id'];
    $Place_title = $_POST['Place_title'];
    $Place_details =  $_POST['Place_details'];
    $Place_img_path =  $_POST['Place_img_path'];
    

    $insertquery = mysqli_query($connection, "insert into place (`Category_id`, `Place_title`, `Place_details`,`Place_img_path`) "
            . "values ('{$Category_id}','{$Place_title}','{$Place_details}','{$Place_img_path}')") or die(mysqli_error($connection));
    $lastinsertid = mysqli_insert_id($connection);

    if ($insertquery) 
    {
        $response['success'] = 1;
        $response['pid'] = $lastinsertid;
        $response['Category_id'] = $Category_id;
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