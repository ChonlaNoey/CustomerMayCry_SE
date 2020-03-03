<!DOCTYPE html>
<?php   
    include('../config/database_connection.php');
    session_start();
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
    $msg1=''; 
    $msg2='';  
    $msg3=''; 
    $msg4='';    
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
        $equipment_id = $_POST['equipment_id'];
        $equipInfo_th = $_POST['equipInfo_th'];
        $reason = $_POST['reason'];
        $dateToBorrow = $_POST['dateToBorrow'];
        $dateToBringback = $_POST['dateToBringback'];
        $quantityToBorrow = $_POST['quantityToBorrow'];   
       
        if($reason==''){
            $msg1 = '<font color="red" align="left">   กรุณากรอกเหตุผลการยืม</font>';
        }   
        if($dateToBorrow==''){
            $msg2 = '<font color="red" align="left">   กรุณากรอกวันที่ยืมอุปกรณ์</font>';
        }    
        if($dateToBringback==''){
            $msg3 = '<font color="red" align="left">   กรุณากรอกวันที่คืนอุปกรณ์</font>';
        } 
        if($quantityToBorrow==''){
            $msg4 = '<font color="red" align="left">   กรุณากรอกจำนวนที่ยืม</font>';
        }       
    }
?>

<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>แบบคำร้องยืมครุภัณฑ์</title>
    <!-- Logo -->
    <link rel="shortcut icon" href="../assets/logo/kku-logo.png" />
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

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">แบบคำร้องยืมครุภัณฑ์</h1>
      </div>
      <center>
      <div style="width: 1000px; height:auto; margin-top:50px;">
        <div class="card">
            <div class="card-body">
            <form method="post">
            <table>
                <tr>
                <td><label >หมายเลขครุภัณฑ์ : </label></td>
                <td><a type="text" name="equipment_id" id="equipment_id" value="<?php echo $equipment_id; ?>" class="bginput" ><?php echo $equipment_id; ?><a></td>
                </tr>
                <tr>
                <td><label >รายละเอียดครุภัณฑ์ : </label></td>
                <td><textarea readonly name="equipInfo_th" id="equipInfo_th" rows = 5 cols=50><?php echo $equip['equipInfo_th']; ?></textarea><br></td>
                </tr>
                <tr>
                <td><label >วัตถุประสงค์ที่ยืม <font color=red>*</font> : </label></td>
                <td><textarea name="reason" rows = 5 cols=50><?php echo $reason; ?></textarea><?php echo $msg1; ?><br></td>
                </tr> 
                <tr>
                <td><label >วันที่ยืม <font color=red>*</font> : </label></td>
                <td><input type="text" name="dateToBorrow" id="dateToBorrow" class="bginput"><?php echo $msg2; ?><br></td>
                </tr>
                <tr>
                <td><label >วันที่คืน <font color=red>*</font>: </label></td>
                <td><input type="text" name="dateToBringback" id="dateToBringback" class="bginput"><?php echo $msg3; ?><br></td>
                </tr>
                <tr>
                <td><label >จำนวนที่ยืม <font color=red>*</font>: </label></td>
                <td><input type="text" name="quantityToBorrow" id="quantityToBorrow" class="bginput"><?php echo $msg4; ?><br></td>
                </tr>        
            
            </table>
            <br><br>
                <a href="product-list-by-room-user.php?cid=<?php echo $equip['categoryID']; ?>&lid=<?php echo $equip['locationID']; ?>" type="button" class="btn btn-dark" value="ย้อนกลับ" >ย้อนกลับ</a>
                <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-dark">บันทึก</button>
            </form>
            </div>
            </div>
        <div>
      </center>
    </main>
  </div>
  </div>
</div>
</body>
</html>