<?php

//Connection
$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array 
$response = array();
//Tables Fields 
//Check Fields are Empty or Not 
//Only Use Required Fields 
if (isset($_POST['User_id']) && !empty($_POST['User_id']) && isset($_POST['Feedback_details']) && !empty($_POST['Feedback_details']))
{

    //Stores Values in Variable
    $User_id =  $_POST['User_id'];
    $Feedback_details = $_POST['Feedback_details'];
    
    $insertquery = mysqli_query($connection, "insert into feedback (`User_id`, `Feedback_details`) "
            . "values ('{$User_id}','{$Feedback_details}')") or die(mysqli_error($connection));
    $lastinsertid = mysqli_insert_id($connection);

    if ($insertquery) 
    {
        $response['success'] = 1;
        $response['fid'] = $lastinsertid;
        $response['User_id'] = $User_id;
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