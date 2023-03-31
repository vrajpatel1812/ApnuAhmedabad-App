<?php

//Connection
$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array 
$response = array();

$query = mysqli_query($connection,"SELECT * FROM `tbl_bus`") or die(mysqli_error($connection));

$count=mysqli_num_rows($query);

if($count>0)
{
	while($row=mysqli_fetch_array($query))
	{
		$data['bus_id']=$row['bus_id'];
		$data['bus_no']=$row['bus_no'];
        $data['source_title']=$row['source_title'];
        $data['source_lat']=$row['source_lat'];
        $data['source_long']=$row['source_long'];
        $data['destination_title']=$row['destination_title'];
        $data['destination_lat']=$row['destination_lat'];
        $data['destination_long']=$row['destination_long'];
		
		
		$fetchdata[]=$data;
	}
	$response['bus_list']=$fetchdata;
	$response['flag']=1;
	$response['message']="$count records found";


}else{
	$response['flag']=0;
	$response['message']="no records found";
}

echo json_encode($response);



?>