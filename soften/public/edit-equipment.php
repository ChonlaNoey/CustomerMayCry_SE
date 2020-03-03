<?php 
    include('../config/database_connection.php');
    session_start();
    if($_SESSION["role"] == "Staff")
    {
        header("location: ../index.php");
        exit();
    }else if($_SESSION["role"] == "Student"){
        header("location: ../index.php");
        exit();
    }
    if($_SESSION['email'] == "")
	{
    header("location: ../index.php");
		exit();
  }
  if($_SESSION["role"] == "Staff"){
    $dashboard="dashboard_user.php";
}else if($_SESSION["role"] == "Student"){
    $dashboard="dashboard_user.php";
}else{
    $dashboard="dashboard_admin.php";
}
    if($_GET['logout'] == "logout"){
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
    session_destroy(); // ทำลาย session
    header("location:../index.php");
    }
	$equipment_id = $_GET['equipment_id'];
	
    //Fetch - Equipment with equipment_id
    $equip = $connect->prepare("
								SELECT 
									*
								FROM 
                                    equipment,category,location,status,subcategory,Faculty
                                WHERE 
                                    equipment.equipment_id = '$equipment_id'
                                    AND equipment.locationID = location.locationID
                                    AND equipment.categoryID = category.categoryID
                                    AND equipment.statusID = status.statusID
                                ORDER BY 
                                    equipment_ID
                                    ASC
                                "); 
    $equip->execute(); 
    $total_row = $equip->rowCount();
	$equip = $equip->fetch();

	if (isset($_POST['btn-submit'])) {    
		$equipment_id = $_GET['equipment_id'];
        $equipment_name = $_POST['equipment_name'];
        $status = $_POST['status'];
		$location = $_POST['location'];
		$detail = $_POST['detail'];

		$sql = "UPDATE equipment SET  equipName_th='$equipment_name', statusID='$status', locationID='$location', equipInfo_th='$detail' WHERE equipment_id = '$equipment_id'";

		$statement = $connect->prepare($sql);
		$statement->execute();
		header("location: edit-equipment.php?equipment_id=$equipment_id");
    }

    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>แก้ไขครุภัณฑ์</title>
    <script src="../js.css.list/js/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- Logo -->
    <link rel="shortcut icon" href="assets/logo/kku-logo.png" />
    <!-- Font -->
    <link href="../css/body-font.css" rel="stylesheet" >
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" >
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
</head>
  <body data-gr-c-s-loaded="true">
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" >
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#" align="center" style="color:white;">ระบบยืมคืน-อุปกรณ์</a>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">แก้ไขครุภัณฑ์หมายเลข - <?php echo $equipment_id;?></h1>
        </div>
        <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            ​<div id="user_detail"><center>
                <img src="../assets/profile/profile1.jpg" class="img-fluid img-thumbnail rounded-circle" alt="" width="250px" height="" style="margin-top:10px; margin-bottom:10px;">
                <div id="user_txt" style="color:black;">
                    <strong style="font-size:20px;"><?php echo $_SESSION["role"]; ?></strong><br>
                    <strong style="font-size:18px;"><?php echo  $_SESSION["fname"].' '.$_SESSION["lname"].'<br>'.$_SESSION["email"];?></strong>
                </div>
            </center></div>
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $dashboard; ?>" id="dashboard" name="dashboard">
                        <img src="../assets/logo/dashboard.png" width="24" height="24" fill="none" stroke="currentColor" style="margin-left:-1px;"> 
                        <span style="margin-left:2px;">Dashboard (current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="setting" name="setting">
                        <img src="../assets/logo/setting.png" width="20" height="20" fill="none" stroke="currentColor" style="margin-left:0px;"> 
                        <span style="margin-left:2px;">Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?logout=logout" id="logout" name="logout">
                        <img src="../assets/logo/logout.png" width="20" height="20" fill="none" stroke="currentColor" >
                        <span style="margin-left:1px;">Logout</span>
                    </a>
                </li>
                </ul>
            </div>
            </nav>
            </div>

            <div class="row">
            <div class="col-sm-12">
                <div class="card">
                <form method="post" style="margin-top:20Px;"><center>
					<table>
						<tr>
						<td><label><b>ชื่อครุภัณฑ์ : </b></label></td>
						<td><input type="text" name="equipment_name" id="equipment_name" class="bginput" value="<?php echo $equip['equipName_th'];?>" placeholder="<?php echo $equip['equipName_th'];?>"><br></td>
						</tr>
						<tr>
						<td><label ><b>หมายเลขครุภัณฑ์ : </b></label></td>
						<td><a name="equipment_id" id="equipment_id" value="<?php echo $equip['equipment_id'];?>"><?php echo $equip['equipment_id'];?><a></td>
						</tr>
						<tr>
						<td><label ><b>ปีงบประมาณ : </b></label></td>
						<td><?php echo $equip['budget_year'];?></td>
						</tr>
						<tr>
						<td><label ><b>คณะ : </b></label></td>
						<td><?php echo $equip['factName_th'];?></td>
						</tr>
						<tr>
						<td><label ><b>ประเภทครุภัณฑ์ : </b></label></td>
						<td><?php echo $equip['categoryName_th'];?></td>
						</tr>
						<tr>
						<td><label ><b>ประเภทย่อยครุภัณฑ์ : </b></label></td>
						<td><?php echo $equip['subcategoryName_th'];?></td>
						</tr>
						<tr>
						<td><label ><b>สถานที่ : <b></label></td>
						<td><select name="location" id="location">
						<option value="<?php echo $equip["locationID"]; ?>"><-- <?php echo $equip["locationID"]." - ".$equip['locationName_th']; ?> --></option>
						<?php
							$query = "SELECT DISTINCT * FROM location";
							$statement = $connect->prepare($query);
							$statement->execute();
							$result = $statement->fetchAll();
							foreach($result as $row)
							{
						?> 
						<option value="<?php echo $row['locationID'];?>"><?php echo $row["locationID"]." - ".$row['locationName_th'];?></option>
							<?php
							}
						?>
						</select><br></td>
						</tr>
						<tr>
						<td><label ><b>สถานะ : </b></label></td>
						<td><select name="status" id="status">
						<option value="<?php echo $equip["statusID"]; ?>"><-- <?php echo $equip["statusID"]." - ".$equip['status_th']; ?> --></option>
						<?php
							$query = "SELECT DISTINCT * FROM status";
							$statement = $connect->prepare($query);
							$statement->execute();
							$result = $statement->fetchAll();
							foreach($result as $row)
							{
						?> 
						<option value="<?php echo $row['statusID'];?>"><?php echo $row["statusID"]." - ".$row['status_th'];?></option>
							<?php
							}
						?>
						</select><br></td>
						</tr>
						<tr>
						<td colspan=2><label><b>รายละเอียดครุภัณฑ์ : </b></label></td></tr>
						<tr><td colspan=2><textarea name="detail" name="detail" rows = 5 cols=50 value="<?php echo $equip['equipInfo_th'];?>" placeholder="<?php echo $equip['equipInfo_th'];?>"><?php echo $equip['equipInfo_th'];?></textarea><br></td>
						</tr>
					</table>
					<br><br>
					<a href="product-list-by-room.php?cid=<?php echo $equip['categoryID']; ?>&lid=<?php echo $equip['locationID']; ?>" type="button" class="btn btn-dark" id="btn-back" name="btn-back" >ย้อนกลับ</a>
					<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-dark">บันทึก</button>
				</center></form>
                </div>
            </div>
            </div>

    <style>
    #loading
    {
        text-align:center; 
        background: url('../assets/logo/loader.gif') no-repeat center; 
        height: 150px;
    }
    </style>
    <script src="../js.css.list/js/filter-func.js"></script>
    </body>

</html>