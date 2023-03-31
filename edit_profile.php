<?php

//Connection
$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array 
$response = array();

//Only Use Required Fields 
if (isset($_POST['User_id']) && isset($_POST['User_name']) &&isset($_POST['User_mobileno'])) {  

    //Stores Values in Variable
    $User_id = mysqli_real_escape_string($connection, $_POST['User_id']);
    
      $query = mysqli_query($connection, "SELECT * FROM `user_master` where User_id ='{$User_id}'") or die(mysqli_error($connection));
      
      
  
      
    $User_name = mysqli_real_escape_string($connection, $_POST['User_name']);
    $User_mobileno = mysqli_real_escape_string($connection, $_POST['User_mobileno']);
     	 


$update =  mysqli_query($connection, "UPDATE `user_master` SET `User_name`='{$User_name}',`User_mobileno`='{$User_mobileno}' WHERE `User_id`='{$User_id}'") or die(mysqli_error($connection));

        
        if ($update) {
            
            
            
            $response['flag'] = 1;
            $response['message'] = "User Record Updated Successfully";
                    $temp = array();
					
					$temp['User_id'] =  $User_id;
                    $temp['User_name'] =  $User_name;
						$temp['User_email'] =  $User_email;
                    $temp['User_mobileno'] =  $User_mobileno;
					$response["user"] = $temp;
                    
        } else {
            $response['flag'] = 0;
            $response['message'] = "Please Try Again Something Went Wrong";
        }
    
} else {

    $response['flag'] = 0;
    $response['message'] = "Required fields missing";
}
echo json_encode($response);
