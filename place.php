<?php

//Connection
$connection=mysqli_connect("localhost","root","","aahemedabad");
//Blank Array 
$response = array();

if(isset($_POST["Category_id"]))
{
    $Category_id=mysqli_real_escape_string($connection,$_POST["Category_id"]);
    if($Category_id =="")
    {
        $search_cat = "";
    }
    else{
        $search_cat = "Where Category_id='{$Category_id}'";
    }
}
else{
    $search_cat = "";
}

if(isset($_POST["Place_id"]))
{
    $Place_id=mysqli_real_escape_string($connection,$_POST["Place_id"]);
    if($Place_id =="")
    {
        $search_place = "";
    }
    else{
        $search_place = "Where Place_id='{$Place_id}'";
    }
}
else{
    $search_place = "";
}


     //pagination start
     $query = mysqli_query($connection, "SELECT * FROM `place` $search_cat $search_place order by Place_id asc ") or die(mysqli_error($connection));
    
    
     $numrows = mysqli_num_rows($query);

     $rowsperpage = 10;
     $totalpages = ceil($numrows / $rowsperpage);
 
 // get the current page or set a default
     if (isset($_POST['currentpage']) && is_numeric($_POST['currentpage'])) {
         $currentpage = $_POST['currentpage'];
     } else {
         $currentpage = 1;  // default page number
     }
 // if current page is less than first page
     if ($currentpage <= 1) {
 // set current page to first page
         $currentpage = 1;
     }
     // the offset of the list, based on current page
     $offset = ($currentpage - 1) * $rowsperpage;
    //this condition check current page less then qual total page or totalpage qual to 0
    if ($currentpage <= $totalpages || $totalpages == 0) {
$query = mysqli_query($connection,"SELECT * FROM `place` $search_cat $search_place order by Place_id asc  limit $offset, $rowsperpage") or die(mysqli_error($connection));

$count=mysqli_num_rows($query);

if($count>0)
{
	while($row=mysqli_fetch_array($query))
	{
        $query_1 = mysqli_query($connection,"SELECT * FROM `place_category` WHERE `Category_id`='{$row['Category_id']}'")or die(mysqli_error($connection));
        $row_1 = mysqli_fetch_array($query_1);
		$data['Place_id']=$row['Place_id'];
		$data['Category_id']=$row['Category_id'];
        $data['Category_name']=$row_1['Category_name'];
        $data['Place_title']=$row['Place_title'];
        $data['Place_details']=$row['Place_details'];
        $data['Place_img_path']=$row['Place_img_path'];
		
		
		$fetchdata[]=$data;
	}
	$response['place']=$fetchdata;
	$response['flag']=1;
	$response['message']="$count records found";


}else{
	$response['flag']=0;
	$response['message']="no records found";
}
} else {
    $response["flag"] = "3";
    $response["message"] = "Page End";
}
echo json_encode($response);



?>