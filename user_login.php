<?php
$connection=mysqli_connect("localhost","","","aahemedabad");


$response = array();

if (isset($_POST['User_email']) && !empty($_POST['User_email']) && isset($_POST['User_password']) && !empty($_POST['User_password'])) 
    {

    $email = mysqli_real_escape_string($connection, $_POST['User_email']);
    $password = mysqli_real_escape_string($connection, $_POST['User_password']);

    $loginquery = mysqli_query($connection, "select * from user_master where User_email='{$email}' and User_password='{$password}'") or die(mysqli_error($connection));
    $fetchrow = mysqli_fetch_array($loginquery);
    $count = mysqli_num_rows($loginquery);

    if ($count > 0) {
        
        
        
        // $response['userdata'] = $fetchrow;
        $response['flag'] = 1;
        $response['message'] = "Login Success";
         $query_2 = mysqli_query($connection, "select * from user_master where user_id='{$fetchrow["User_id"]}'") or die(mysqli_error($connection));
        $row_user = mysqli_fetch_array($query_2);
        $mydata['User_id'] = $row_user["User_id"];
        $mydata['User_name'] = $row_user["User_name"];
        $mydata['User_mobileno'] = $row_user["User_mobileno"];
        $mydata['User_email'] = $row_user["User_email"];
       

        $response['userdata'] = $mydata;
    } else {
        $response['flag'] = 0;
        $response['message'] = "Login Failed";
    }
} else {
    $response['flag'] = 0;
    $response['message'] = "Required fields missing";
}
echo json_encode($response);
