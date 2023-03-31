<?php 

$connection=mysqli_connect("localhost","root","","ahmedabad");

$response=array();

$query=mysqli_query($connection,"select * from  user_master") or die(mysqli_error($connection));

$count=mysqli_num_rows($query);

if($count>0)
{
	while($row=mysqli_fetch_array($query))
	{
		$data['User_id']=$row['User_id'];
		$data['User_name']=$row['User_name'];
		$data['User_email']=$row['User_email'];
		$data['User_password']=$row['User_password'];
		$data['User_mobileno']=$row['User_mobileno'];
		$fetchdata[]=$data;
	}
	$response['user_master']=$fetchdata;
	$response['flag']=1;
	$response['msg']="$count records found";


}else{
	$response['flag']=0;
	$response['msg']="no records found";
}

echo json_encode($response);

 
?>