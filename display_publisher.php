<?php 

$connection=mysqli_connect("localhost","root","","ahmedabad");

$response=array();

$query=mysqli_query($connection,"select * from  publisher_master") or die(mysqli_error($connection));

$count=mysqli_num_rows($query);

if($count>0)
{
	while($row=mysqli_fetch_array($query))
	{
		$data['Publisher_id']=$row['Publisher_id'];
		$data['Publisher_name']=$row['Publisher_name'];
		$data['Publisher_email']=$row['Publisher_email'];
		$data['Publisher_password']=$row['Publisher_password'];
		$data['Publisher_mobileno']=$row['Publisher_mobileno'];
		$fetchdata[]=$data;
	}
	$response['publisher_master']=$fetchdata;
	$response['flag']=1;
	$response['msg']="$count records found";


}else{
	$response['flag']=0;
	$response['msg']="no records found";
}

echo json_encode($response);

 
?>