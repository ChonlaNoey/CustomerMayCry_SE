<?php

//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM equipment,category,location,status WHERE equipment.cid = category.cid AND equipment.lid = location.lid AND equipment.sid = status.sid
	";
	if(isset($_POST["category"]))
	{
		$category_filter = implode("','", $_POST["category"]);
		$query .= "
			AND cname_tha IN('".$category_filter."')
		";
	}
	if(isset($_POST["type"]))
	{
		$type_filter = implode("','", $_POST["type"]);
		$query .= "
			AND equipment_type IN('".$type_filter."')
		";
	}
	if(isset($_POST["location"]))
	{
		$location_filter = implode("','", $_POST["location"]);
		$query .= "
			AND lname_tha IN('".$location_filter."')
		";
	}
	if(isset($_POST["status"]))
	{
		$status_filter = implode("','", $_POST["status"]);
		$query .= "
			AND status_tha IN('".$status_filter."')
		";
	}

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			if($row['status_tha'] == 'ว่าง'){
				$status_ico = 'available.png" width="10%" height="10%"';
			}else if($row['equipment_status'] != 'ว่าง'){
				$status_ico = 'unavailable.png" width="10%" height="10%"';
			}
			if($row['equipment_type'] == 'Portable'){
				$type = 'Portable';
				$type_ico = 'portable.png" width="10%" height="10%"';
			}else if($row['equipment_status'] != 'Portable'){
				$type = 'Unportable';
				$type_ico = 'unportable.png" width="10%" height="10%"';
			}
			$output .= '
			<div class="col-sm-4 col-lg-3 col-md-3">
				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:20px; height:350px;">
					<p align="center"><strong><a href="#">'. $row['eid'] .'</a></strong></p>
					<img align="center" src="image/'. $row['equipment_image'] .'" alt="" class="img-responsive" >
					<h4 align="center"><strong><a href="#">'. $row['ename_eng'].'</a></strong></h4>
					<h4 style="text-align:center;" class="text-danger" >'. $row['cname_eng'] .'</h4>
					<img align="left" src="image/ico/location.png" alt="" class="img-responsive" width="10%" height="10%" >&nbsp:&nbsp'. $row['lname_tha'] .'<br>
					<img align="left" src="image/ico/'.$type_ico.'" alt="" class="img-responsive">&nbsp:&nbsp'.$type.'<br>
					<img align="left" src="image/ico/'.$status_ico.'" alt="" class="img-responsive">&nbsp:&nbsp'.$row['status_tha'].'
				</div>
			</div>
			';
		}
	}
	else
	{
		$output = '<h1 align="center">ไม่พบข้อมูล</h1>';
	}
	echo $output;
}

?>