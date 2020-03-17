<?php

//fetch_data.php

include('../config/database_connection.php');

if(isset($_POST["action"]))
{
	$query = "
	SELECT DISTINCT 
				location.locationID,locationName_th,category.categoryID,categoryName_th
			FROM 
				equipment,category,location 
			WHERE 
				equipment.categoryID = category.categoryID 
				AND equipment.locationID = location.locationID
	";

	if(isset($_POST["category"]))
	{
		$category_filter = implode("','", $_POST["category"]);
		$query .= "
			AND categoryName_th IN('".$category_filter."')
		";
	}
	if(isset($_POST["location"]))
	{
		$location_filter = implode("','", $_POST["location"]);
		$query .= "
			AND locationName_th IN('".$location_filter."')
		";
	}

	$query .= " ORDER BY categoryID ASC";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';

	if($total_row > 0)
	{
		$i = 0;
		foreach($result as $row)
		{
			$i++;
			$output .= '
			<div class="col-sm-4 col-lg-3 col-md-5">
				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:20px; height:200px;">
					<h5><p align="center"><strong><a id="'.$i.'" href="product-list-by-room-user.php?cid='. $row['categoryID'] .'&lid='.$row['locationID'].'">'. $row['categoryName_th'] .'</a></strong></p></h5>
					<center><img align="center" src="../assets/equipment/category/'.$row['categoryID'].'.jpg" alt="" class="img-responsive" width="80%"></center>
					<h5 style="text-align:center; color:green;" >สถานที่: '. $row['locationName_th'] .'</h5>
				</div>
			</div>
			';
		}
	}
	else
	{
		$output = '<h1>ไม่พบข้อมูล</h1>';
	}
	echo $output;
}

?>