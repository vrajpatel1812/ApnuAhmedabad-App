<?php

//Connection
$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array 
$response = array();
//Tables Fields 
//Check Fields are Empty or Not 
//Only Use Required Fields 
if (isset($_POST['news_title']) && !empty($_POST['news_title']) && isset($_POST['News_details']) && !empty($_POST['News_details']) && isset($_POST['News_photo']) && !empty(['News_photo']))
{

    //Stores Values in Variable
    $news_title =  $_POST['news_title'];
    $News_details = $_POST['News_details'];
    $News_photo =  $_POST['News_photo'];
   

    $insertquery = mysqli_query($connection, "insert into news_master (`news_title`, `News_details`, `News_photo`) "
            . "values ('{$news_title}','{$News_details}','{$News_photo}')") or die(mysqli_error($connection));
    $lastinsertid = mysqli_insert_id($connection);

    if ($insertquery) 
    {
        $response['success'] = 1;
        $response['nid'] = $lastinsertid;
        $response['news_title'] = $news_title;
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