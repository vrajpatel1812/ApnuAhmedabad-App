<?php 

$connection=mysqli_connect("localhost","root","","aahemedabad");

$response=array();

$query=mysqli_query($connection,"select * from news_master") or die(mysqli_error($connection));

$count=mysqli_num_rows($query);

if($count>0)
{
	while($row=mysqli_fetch_array($query))
	{
		$data['News_id']=$row['News_id'];
		$data['news_title']=$row['news_title'];
		$fetchdata[]=$data;
	}
	$response['news_tbl']=$fetchdata;
	$response['flag']=1;
	$response['msg']="$count records found";


}else{
	$response['flag']=0;
	$response['msg']="no records found";
}

echo json_encode($response);

 
?>