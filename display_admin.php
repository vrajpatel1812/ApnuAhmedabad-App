<?php 

$connection=mysqli_connect("localhost","root","","ahmedabad");

$response=array();

$query=mysqli_query($connection,"select * from admin_master") or die(mysqli_error($connection));

$count=mysqli_num_rows($query);

if($count>0)
{
	while($row=mysqli_fetch_array($query))
	{
		$data['Admin_id']=$row['Admin_id'];
		$data['Admin_name']=$row['Admin_name'];
		$data['Admin_email']=$row['Admin_email'];
		$data['Admin_password']=$row['Admin_password'];
		$fetchdata[]=$data;
	}
	$response['admin_master']=$fetchdata;
	$response['flag']=1;
	$response['msg']="$count records found";


}else{
	$response['flag']=0;
	$response['msg']="no records found";
}

echo json_encode($response);

 
?>