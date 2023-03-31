    <?php

//Connection
$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array 
$response = array();
//Tables Fields 
//Check Fields are Empty or Not 
//Only Use Required Fields 
if (isset($_POST['User_name']) && !empty($_POST['User_name']) && isset($_POST['User_email']) && !empty($_POST['User_email']) && isset($_POST['User_password']) && !empty($_POST['User_password']) && isset($_POST['User_mobileno']) && !empty($_POST['User_mobileno']))
{

    //Stores Values in Variable
    $User_name =  $_POST['User_name'];
    $User_email = $_POST['User_email'];
    $User_password =  $_POST['User_password'];
    $User_mobileno =  $_POST['User_mobileno'];
    

    $insertquery = mysqli_query($connection, "insert into user_master (`User_name`, `User_email`, `User_password`,`User_mobileno`) "
            . "values ('{$User_name}','{$User_email}','{$User_password}','{$User_mobileno}')") or die(mysqli_error($connection));
    $lastinsertid = mysqli_insert_id($connection);

    if ($insertquery) 
    {
        $response['success'] = 1;
        $response['uid'] = $lastinsertid;
        $response['User_name'] = $user_name;
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