<?php 

//Require File Name 
$connection=mysqli_connect("localhost","","","aahemedabad");

//Create an Blank Array
$response = array(); //Blank Array
$response["event_array"] = array(); // Two Dim Array Key will be Student

$Event_type_id=$_POST["Event_type_id"];
$query = mysqli_query($connection, "SELECT * FROM `event_master` where Event_type_id='{$Event_type_id}' ") or die(mysqli_error($connection));
$count = mysqli_num_rows($query);

if ($count > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $temparry = array();
        $temparry["Event_id"] = $row["Event_id"];
        $temparry["Event_name"] = $row["Event_name"];
        $temparry["Event_location"] = $row["Event_location"];
       
       
        //Array Append
        array_push($response["event_array"], $temparry);
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
