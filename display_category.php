<?php 

$connection=mysqli_connect("localhost","root","","aahemedabad");

$response=array();

$query=mysqli_query($connection,"select * from place_category") or die(mysqli_error($connection));

$count=mysqli_num_rows($query);

if($count>0)
{
	while($row=mysqli_fetch_array($query))
	{
		$data['Category_id']=$row['Category_id'];
		$data['Category_name']=$row['Category_name'];
		$data['Category_photo_path']=$row['Category_photo_path'];
		$fetchdata[]=$data;
	}
	$response['category_tbl']=$fetchdata;
	$response['flag']=1;
	$response['msg']="$count records found";


}else{
	$response['flag']=0;
	$response['msg']="no records found";
}

echo json_encode($response);

 
?>