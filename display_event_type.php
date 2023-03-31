<?php 

$connection=mysqli_connect("localhost","root","","aahemedabad");

$response=array();

$query=mysqli_query($connection,"select * from event_type") or die(mysqli_error($connection));

$count=mysqli_num_rows($query);

if($count>0)
{
	while($row=mysqli_fetch_array($query))
	{
		$data['Event_type_id']=$row['Event_type_id'];
		$data['Event_type_name']=$row['Event_type_name'];
		$fetchdata[]=$data;
	}
	$response['event_type_tbl']=$fetchdata;
	$response['flag']=1;
	$response['msg']="$count records found";


}else{
	$response['flag']=0;
	$response['msg']="no records found";
}

echo json_encode($response);

 
?>