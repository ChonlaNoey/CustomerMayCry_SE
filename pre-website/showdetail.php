<?php
	include('database_connection.php');

	$query = "
	SELECT * FROM equipment,category,location,status 
	WHERE equipment.cid = category.cid AND equipment.lid = location.lid AND equipment.sid = status.sid
	AND eid='".$_GET['eid']."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();

	foreach($result as $row){
		$eid = $row['eid'];
		$ename = $row['ename_eng'];
		$tname = $row['ename_tha'];
		$img_path = $row['equipment_image'];
		$eloc = $row['lname_tha'];
		$ecat = $row['cname_tha'];
		$cid = $row['cid'];
		$equip_type = $row['equip_type'];
	}

	$query = "SELECT * FROM status";
	$statement = $connect->prepare($query);
	$statement->execute();
	$status = $statement->fetchAll();
	
	$query = "SELECT * FROM location";
	$statement = $connect->prepare($query);
	$statement->execute();
	$loc = $statement->fetchAll();

	$query = "SELECT * FROM category";
	$statement = $connect->prepare($query);
	$statement->execute();
	$cat = $statement->fetchAll();

	if(isset($_POST['btn-submit'])){
		$sid = $_POST['sid'];
		$sql = "UPDATE equipment SET sid = '$sid' WHERE eid = '$eid'";
		$statement = $connect->prepare($sql);
		$statement->execute();
		header("location:showdetail.php?eid=$eid");
	}
	if(isset($_POST['btn-submit-loc'])){
		$lid = $_POST['lid'];
		$sql = "UPDATE equipment SET lid = '$lid' WHERE eid = '$eid'";
		$statement = $connect->prepare($sql);
		$statement->execute();
		header("location:showdetail.php?eid=$eid");
	}
	if(isset($_POST['btn-submit-cat'])){
		$ncid = $_POST['cid'];

		//get prefix - Single row select
        $pre = $connect->prepare("SELECT prefix FROM category WHERE cid='$ncid'"); 
        $pre->execute(); 
        $pre = $pre->fetch();
        $prefix = $pre['prefix'];

        //Single row select
        $stmt = $connect->prepare("SELECT COUNT(cid) rowCount FROM equipment WHERE cid='$ncid'"); 
        $stmt->execute(); 
        $row = $stmt->fetch();
        $rowNum = $row['rowCount']+1;
		$neid = $prefix.$rowNum;
		
		$sql = "UPDATE equipment SET cid='$ncid', ename_tha='$tname', ename_eng='$ename', eid='$neid' WHERE eid = '$eid'";
		$statement = $connect->prepare($sql);
		$statement->execute();
		header("location:showdetail.php?eid=$neid");
	}
	if(isset($_POST['btn-submit-detail'])){
		
		$tha_name = $_POST['tname'];
		
		if($ename != $_POST['ename']){
			$eng_name = $_POST['ename'];
		}else{
			$eng_name = $ename;
		}
		if($tname != $_POST['tname']){
			$tha_name = $_POST['tname'];
		}else{
			$tha_name = $tname;
		}

		$sql = "UPDATE equipment SET ename_tha='$tha_name', ename_eng='$eng_name' WHERE eid = '$eid'";
		$statement = $connect->prepare($sql);
		$statement->execute();
		header("location:showdetail.php?eid=$eid");
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>รายละเอียดสินค้า</title>
		<link href="css/new.bootstrap.min.css" rel="stylesheet">		
		<link href="css/my_custom.css" rel="stylesheet">		
		<script src="js/custom_script.js"></script>
	</head>
	<body>
		<!-- navigation bar-->
		<div>
			<ul class="sticky">
				<li>
					<a style="float:right;" class="nav-logo" href="#">ระบบยืมคืน-อุปกรณ์</a>
					<a style="color:white; float:left" class="btn-black" href="list.php">Go Back</a>
				</li>
			</ul>
			<br><br><br>
			<h1 align="center">แสดงรายละเอียดอุปกรณ์</h1>
		</div>
		<!-- Picture and detail table -->
		<table border="0" align="center" style="margin-top:100px;">
			<!-- Equipment image -->
			<td width="400px"><div align="center">
				<h2><?php echo $ename ?></h2><br>
				<img src="image/<?php echo $img_path?>" width="50%" height="50%" "class="img-responsive" ></center>
				<!-- Status, category and location change -->
				<div align="center" style="margin-top:30px;"><table><td width="400px">
					<form method="post">
						<table  class="table">	
							<?php foreach($result as $row){?>
									<tr class="table-success">
										<th scope="row">สถานะ</td>
										<td>
											<select  name="sid">
												<option value=""><?php echo $row['status_tha']?></option>
												<?php foreach($status as $stat){ ?> 
													<option value="<?php echo $stat['sid'];?>"><?php echo $stat["sid"]." - ".$stat['status_tha'];?></option>
												<?php } ?>
											</select>
										</td>
										<td>
											<button style="margin-left:10px; padding-top:-400px;" onClick="statusChangeConfirm()" type="submit" name="btn-submit" id="btn-submit" class="btn btn-dark">เปลี่ยนสถานะ</button><br>
										</td>
									</tr>
									<tr class="table-success">
										<th scope="row">สถานที่</td>
										<td>
											<select  name="lid">
												<option value=""><?php echo $eloc ?></option>
												<?php foreach($loc as $lo){ ?> 
															<option value="<?php echo $lo['lid'];?>"><?php echo $lo["lid"]." - ".$lo['lname_tha'];?></option>
												<?php } ?>
											</select>
										</td>
										<td>
											<button style="margin-left:10px; padding-top:-400px;" onClick="changeLoc()" type="submit" name="btn-submit-loc" id="btn-submit-loc" class="btn btn-dark">เปลี่ยนสถานที่</button><br>
										</td>
									</tr>
									<tr class="table-success">
										<th scope="row">ชนิดอุปกรณ์</td>
										<td>
											<select  name="cid">
												<option value=""><?php echo $ecat ?></option>
												<?php foreach($cat as $cate){ ?> 
															<option value="<?php echo $cate['cid'];?>"><?php echo $cate["cid"]." - ".$cate['cname_tha'];?></option>
												<?php } ?>
											</select>
										</td>
										<td>
											<button style="margin-left:10px; padding-top:-400px;" onClick="changeCat()" type="submit" name="btn-submit-cat" id="btn-submit-cat" class="btn btn-dark">เปลี่ยนชนิดอุปกรณ์</button><br>
										</td>
									</tr>
							<?php } ?>
						</table>
					</form>
				</td></table></div>
			</td>
			<td width="600px">
				<!-- Detail Table -->
				<form method="post">
					<div style="padding-bottom:50px; padding-left:-500px;" align="center">
						<table><tr><td width="500px">
							<table border="0" class="table" width="0px">
								<tr>
									<th class="" scope="row">รหัสอุปกรณ์</td>
									<td><?php echo $row['eid'] ?></td>
								</tr>
								<tr>
									<th class="" scope="row">ชื่อภาษาไทย</td>
									<td><input type="text" name="tname" id="tname" value="<?php echo $row['ename_tha'] ?>" class="bginput"></td>
								</tr>
								<tr>
									<th class="" scope="row">ชื่อภาษาอังกฤษ</td>
									<td><input type="text" name="ename" id="ename" value="<?php echo $row['ename_eng'] ?>" class="bginput"></td>
								</tr>
								<tr>
									<th class="" scope="row">ชนิดอุปกรณ์</td>
									<td><?php echo $ecat ?></option></td>
								</tr>
								<tr>
									<th class="" scope="row">สถานะ</td>
									<td><?php echo $row['status_tha'] ?></td>
								</tr>
								<tr>
									<th class="" scope="row">สถานที่</td>
									<td><?php echo $row['lname_tha'] ?></td>
								</tr>
								<tr>
									<th class="" scope="row">รูปแบบการยืม</td>
									<td><?php echo $equip_type ?></td>
								<tr>
								
							</table>
							<center><button style="margin-left:10px; padding-top:-400px;" onClick="changeEquipDetail()" type="submit" name="btn-submit-detail" id="btn-submit-detail" class="btn btn-dark">บันทึกการเปลี่ยนแปลง</button><center><br>
						</table>
					</div>
				</form>
			</td>
		</table>
		<div>
	</body>
</html>