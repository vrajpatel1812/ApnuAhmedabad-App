<?php 

$connection=mysqli_connect("localhost","root","","ahmedabad");

$response=array();

$query=mysqli_query($connection,"select * from feedback") or die(mysqli_error($connection));

$count=mysqli_num_rows($query);

if($count>0)
{
	while($row=mysqli_fetch_array($query))
	{
		$data['Feedback_id']=$row['Feedback_id'];
		$data['User_id']=$row['User_id'];
		$data['Feedback_details']=$row['Feedback_details'];
		$fetchdata[]=$data;
	}
	$response['feedback']=$fetchdata;
	$response['flag']=1;
	$response['msg']="$count records found";


}else{
	$response['flag']=0;
	$response['msg']="no records found";
}

echo json_encode($response);

 
?>