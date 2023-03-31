<?php
//Require File Name 
$connection=mysqli_connect("localhost","root","","aahemedabad");

//Create an Blank Array
$response = array(); //Blank Array
$response["Category_id"] = array(); // Two Dim Array Key will be Student

$Category_id=$_POST["Category_id"];
$query = mysqli_query($connection, "SELECT * FROM `place` where Category_id='{$Category_id}' ") or die(mysqli_error($connection));
$count = mysqli_num_rows($query);
// check for empty result
if ($count > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $temparry = array();
        $temparry["Place_id"] = $row["Place_id"];
        $temparry["Place_title"] = $row["Place_title"];
        $temparry["Place_details"] = $row["Place_details"];
       
       
        //Array Append
        array_push($response["Category_id"], $temparry);
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

