<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>รายละเอียดสินค้า</title>
</head>
<body>
<p align="center">
	<a href="showdetail.php">แสดงรายละเอียดสินค้า</a>
</p>
<table border="1" align="center" width="500">
	<tr>
		<td>ชื่อรุ่น</td>
		<td>สถานะ</td>
		<td>แก้ไข</td>
		<td>ลบ</td>
	</tr>
<?php
include('database_connection.php');
$sql = mysqli_query($connect, "SELECT * FROM equipment WHERE equipment_id = '".$equipment_id."' ");