<?php

//Connection
$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array 
$response = array();
//Tables Fields 
//Check Fields are Empty or Not 
//Only Use Required Fields 
if (isset($_POST['Event_type_name']) && !empty($_POST['Event_type_name'])){

    //Stores Values in Variable
    $Event_type_name =  $_POST['Event_type_name'];
   

    $insertquery = mysqli_query($connection, "insert into event_type (`Event_type_name`) "
            . "values ('{$Event_type_name}')") or die(mysqli_error($connection));
    $lastinsertid = mysqli_insert_id($connection);

    if ($insertquery) 
    {
        $response['success'] = 1;
        $response['eid'] = $lastinsertid;
        $response['Event_type_name'] = $Event_type_name;
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