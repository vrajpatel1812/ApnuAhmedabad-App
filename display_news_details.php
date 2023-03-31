<?php
//Require File Name 
$connection=mysqli_connect("localhost","root","","aahemedabad");

//Create an Blank Array
$response = array(); //Blank Array
$response["display_News_details"] = array(); // Two Dim Array Key will be Student

$News_id=$_POST["News_id"];
$query = mysqli_query($connection, "SELECT * FROM `news_master` where News_id='{$News_id}' ") or die(mysqli_error($connection));
$count = mysqli_num_rows($query);
// check for empty result
if ($count > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $temparry = array();
        $temparry["News_id"] = $row["News_id"];
        $temparry["news_title"] = $row["news_title"];
        $temparry["News_details"] = $row["News_details"];
        $temparry["News_photo"] = $row["News_photo"];
       
       
        //Array Append
        array_push($response["display_News_details"], $temparry);
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

