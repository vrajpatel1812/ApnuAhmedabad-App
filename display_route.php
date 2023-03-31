<?php 

$connection=mysqli_connect("localhost","root","","ahmedabad");

$response=array();

$query=mysqli_query($connection,"select * from  route") or die(mysqli_error($connection));

$count=mysqli_num_rows($query);

if($count>0)
{
	while($row=mysqli_fetch_array($query))
	{
		$data['Route_id ']=$row['Route_id '];
		$data['Route_details']=$row['Route_details'];
		$data['	Route_type']=$row['	Route_type'];
		$fetchdata[]=$data;
	}
	$response['route']=$fetchdata;
	$response['flag']=1;
	$response['msg']="$count records found";


}else{
	$response['flag']=0;
	$response['msg']="no records found";
}

echo json_encode($response);

 
?>