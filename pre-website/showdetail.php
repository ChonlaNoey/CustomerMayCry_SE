<?php
	include('database_connection.php');

	$query = "
	SELECT * FROM equipment,category,location,status 
	WHERE equipment.cid = category.cid AND equipment.lid = location.lid AND equipment.sid = status.sid
	AND eid='".$_GET['eid']."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();

	$query = "SELECT * FROM status";
	$statement = $connect->prepare($query);
	$statement->execute();
	$status = $statement->fetchAll();

	if(isset($_REQUEST['save'])){
		$connct = mysqli_connect('localhost','root','','soften');
        $value = $_POST['status_tha'];
        $result = mysqli_query($connect,"UPDATE status SET status_tha = '$value'");
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
	<ul>
        <li>
            <a style="float:right;" class="nav-logo" href="#">ระบบยืมคืน-อุปกรณ์</a>
            <a style="color:white; float:left" class="btn-black" onclick="goBack()">Go Back</a>
        </li>
    </ul>
	<p align="center">
		<h1 align="center" style="color:skyblue;">แสดงรายละเอียดสินค้า</h1>
	</p>

	<?php
	foreach($result as $row){?>
	<center><img align="center" src="image/<?php echo $row['equipment_image']?>" width="25%" height="25%" "class="img-responsive" ></center>
	<center><label for="status">สถานะอุปกรณ์:</label></center>
	<center><select id="status"></center>
	<?php }  
	foreach($status as $row){
	?>
  		<option value="<?php echo $row['sid'] ?>"><?php echo $row['status_tha'] ?></option>
	<?php }?>
	</select></center>

	<center><a style="margin-top:10px;" type="save" name="save" value="save" class="btn btn-outline-primary" >Save</a><button style="margin-top:10px;" type="cancel" class="btn btn-outline-danger">Cancel</button></center>
	<?php
	foreach($result as $row){?>
		<table align="center" width="40px" style="margin-top:10px;" class="table light">
		<tr>
			<th scope="row">ชื่อรุ่น</td>
			<td><?php echo $row['ename_eng'] ?></td>
		</tr>
		<tr>
			<th scope="row">ชนิดอุปกรณ์</td>
			<td><?php echo $row['cname_eng'] ?></td>
		</tr>
		<tr>
			<th scope="row">สถานะ</td>
			<td><?php echo $row['status_tha'] ?></td>
		</tr>
		<tr>
			<th scope="row">สถานที่</td>
			<td><?php echo $row['lname_tha'] ?></td>
		</tr>
		<tr>
			<th scope="row">รูปแบบการยืม</td>
			<td><?php echo $row['equipment_type'] ?></td>
		</tr>
	</table>
	<?php } ?>
	</body>
</html>