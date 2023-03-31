<?php

//Connection
$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array 
$response = array();
//Tables Fields 
//Check Fields are Empty or Not 
//Only Use Required Fields 
if (isset($_POST['Event_name']) && !empty($_POST['Event_name']) && isset($_POST['Event_location']) && !empty($_POST['Event_location']) && isset($_POST['Event_details']) && !empty($_POST['Event_details']) && isset($_POST['Event_photo_path']) && !empty($_POST['Event_photo_path']) && isset($_POST['Event_type_id']) && !empty($_POST['Event_type_id']))
{

    //Stores Values in Variable
    $Event_name =  $_POST['Event_name'];
    $Event_location = $_POST['Event_location'];
    $Event_details =  $_POST['Event_details'];
    $Event_photo_path =  $_POST['Event_photo_path'];
    $Event_type_id =  $_POST['Event_type_id'];

    $insertquery = mysqli_query($connection, "insert into  event_master (`Event_name`, `Event_location`, `Event_details`,`Event_photo_path`,`Event_type_id`) "
            . "values ('{$Event_name}','{$Event_location}','{$Event_details}','{$Event_photo_path}','{$Event_type_id}')") or die(mysqli_error($connection));
    $lastinsertid = mysqli_insert_id($connection);

    if ($insertquery) 
    {
        $response['success'] = 1;
        $response['aid'] = $lastinsertid;
        $response['Event_name'] = $Event_name;
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