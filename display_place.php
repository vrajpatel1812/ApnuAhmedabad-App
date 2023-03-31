<?php

$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array
$response=array();
if (isset($_POST['Category_id'])) {

    $Category_id = mysqli_real_escape_string($connection, $_POST['Category_id']);
   if($Category_id != "")
    {
    $productquery = mysqli_query($connection, "select * from  place where Category_id ='{$Category_id}' ") or die(mysqli_error($connection));
    }
    else{
        $productquery = mysqli_query($connection, "select * from  place") or die(mysqli_error($connection));
    }
} else if (isset($_POST['Place_id'])) {

    $Place_id = mysqli_real_escape_string($connection, $_POST['Place_id']);
    $productquery = mysqli_query($connection, "select * from  place where 	Place_id ='{$Place_id}'") or die(mysqli_error($connection));
} else {
    $productquery = mysqli_query($connection, "select * from  place") or die(mysqli_error($connection));
}

$count = mysqli_num_rows($productquery);

if ($count > 0) {

    while ($row = mysqli_fetch_array($productquery)) {
        $subcategoryq = mysqli_query($connection, "select * from place_category where Category_id ='{$row['Category_id']}' ") or die(mysqli_error($connection));
        $subcategoryrow = mysqli_fetch_array($subcategoryq);

        $tempdata['Place_id'] = $row['Place_id'];
        $tempdata['Place_title'] = $row['Place_title'];
        $tempdata['Place_details'] = $row['Place_details'];
        $tempdata['Place_img_path'] = $row['Place_img_path'];
        
        $tempdata['Category_name'] = $subcategoryrow['Category_name'];
        $tempdata['Category_id'] = $row['Category_id'];

        //Blank Array and Add value into FetchData
        $temp_array[] = $tempdata;
    }
    $response['product'] = $temp_array;
    $response['flag'] = 1;
    $response['message'] = "$count Record Found.";
} else {
    $response['flag'] = 0;
    $response['message'] = "No Record Found.";
}
echo json_encode($response);
