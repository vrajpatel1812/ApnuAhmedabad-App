<?php
//Require File Name 
$connection=mysqli_connect("localhost","root","","aahemedabad");

//Create an Blank Array
$response = array(); //Blank Array
$response["profile"] = array(); // Two Dim Array Key will be Student

$User_id=$_POST["User_id"];
$query = mysqli_query($connection, "SELECT * FROM `user_master` where User_id='{$User_id}' ") or die(mysqli_error($connection));
$count = mysqli_num_rows($query);
// check for empty result
if ($count > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $temparry = array();
        $temparry["User_id"] = $row["User_id"];
        $temparry["User_name"] = $row["User_name"];
        $temparry["User_email"] = $row["User_email"];
        $temparry["User_mobileno"] = $row["User_mobileno"];
       
       
        //Array Append
        array_push($response["profile"], $temparry);
    }
    // success
    $response["flag"] = 1;
    $response["message"] = "$count Record Found";
    // echoing JSON response
} else {
    // success
    $response["flag"] = 0;
    $response["message"] = "No Record Found";
    // echoing JSON response
}


//print_r($response);

echo json_encode($response);
?>

