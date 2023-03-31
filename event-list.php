<?php

//Connection
$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array 
$response = array();

if(isset($_POST["Event_type_id"]))
{
    $Event_type_id=mysqli_real_escape_string($connection,$_POST["Event_type_id"]);
    if($Event_type_id =="")
    {
        $search_type = "";
    }
    else{
        $search_type = "Where Event_type_id='{$Event_type_id}'";
    }
}
else{
    $search_type = "";
}

if(isset($_POST["Event_id"]))
{
    $Event_id=mysqli_real_escape_string($connection,$_POST["Event_id"]);
    if($Event_id =="")
    {
        $search_event = "";
    }
    else{
        $search_event = "Where Event_id='{$Event_id}'";
    }
}
else{
    $search_event = "";
}


    
$query = mysqli_query($connection,"SELECT * FROM `event_master` $search_type $search_event order by Event_id asc ") or die(mysqli_error($connection));

$count=mysqli_num_rows($query);

if($count>0)
{
	while($row=mysqli_fetch_array($query))
	{
        $query_1 = mysqli_query($connection,"SELECT * FROM `event_type` WHERE `Event_type_id`='{$row['Event_type_id']}'")or die(mysqli_error($connection));
        $row_1 = mysqli_fetch_array($query_1);
		$data['Event_id']=$row['Event_id'];
		$data['Event_type_id']=$row['Event_type_id'];
        $data['Event_type_name']=$row_1['Event_type_name'];
        $data['Event_name']=$row['Event_name'];
        $data['Event_location']=$row['Event_location'];
        $data['Event_details']=$row['Event_details'];
        $data['Event_photo_path']=$row['Event_photo_path'];
		
		
		$fetchdata[]=$data;
	}
	$response['event_list']=$fetchdata;
	$response['flag']=1;
	$response['message']="$count records found";


}else{
	$response['flag']=0;
	$response['message']="no records found";
}

echo json_encode($response);



?>