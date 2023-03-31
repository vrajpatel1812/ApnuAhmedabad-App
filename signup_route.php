<?php

//Connection
$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array 
$response = array();
//Tables Fields 
//Check Fields are Empty or Not 
//Only Use Required Fields 
if (isset($_POST['Route_details']) && !empty($_POST['Route_details']) && isset($_POST['Route_type']) && !empty($_POST['Route_type']))
{

    //Stores Values in Variable
    $Route_details =  $_POST['Route_details'];
    $Route_type = $_POST['Route_type'];
    
    $insertquery = mysqli_query($connection, "insert into route (`Route_details`, `Route_type`) "
            . "values ('{$Route_details}','{$Route_type}')") or die(mysqli_error($connection));
    $lastinsertid = mysqli_insert_id($connection);

    if ($insertquery) 
    {
        $response['success'] = 1;
        $response['rid'] = $lastinsertid;
        $response['Route_details'] = $Route_details;
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