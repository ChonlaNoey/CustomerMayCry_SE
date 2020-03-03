<?php 
    include('../config/database_connection.php');
    session_start();
    if($_SESSION["role"] == "Staff")
    {
        header("location: ../index.php");
        exit();
    }else if($_SESSION["role"] == ""){
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
    $lid = $_GET['lid'];
    $cid = $_GET['cid'];
    
    //Fetch - Location
    $loc = $connect->prepare("SELECT * FROM location WHERE locationID='$lid'"); 
    $loc->execute(); 
    $loc = $loc->fetch();

    //Fetch - Equipment with LID and CID
    $equip = $connect->prepare("
                                SELECT * FROM 
                                    equipment,category,location,status 
                                WHERE 
                                    equipment.locationID = '$lid' 
                                    AND equipment.categoryID ='$cid'
                                    AND equipment.locationID = location.locationID
                                    AND equipment.categoryID = category.categoryID
                                    AND equipment.statusID = status.statusID
                                ORDER BY 
                                    equipment_ID
                                    ASC
                                "); 
    $equip->execute(); 
    $total_row = $equip->rowCount();
    $equip = $equip->fetchAll();
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>รายการครุภัณฑ์ - <?php echo $loc['locationName_th'] ;?></title>
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

<body data-gr-c-s-loaded="true">
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" >
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#" align="center" style="color:white;">ระบบยืมคืน-อุปกรณ์</a>
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">รายการครุภัณฑ์ - <?php echo $loc['locationName_th'] ;?></h1>
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
                <div class="table-responsive-lg">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">เลขครุภัณฑ์</th>
                            <th scope="col">ภาพครุภัณฑ์</th>
                            <th scope="col">รายละเอียดครุภัณฑ์</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">การจัดการครุภัณฑ์</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $output = '';
                        
                        if($total_row > 0)
                        {
                            $i = 0;
                            foreach($equip as $row)
                            {
                                $i++;
                                $status='';
                                if($row['status_en'] == "Available"){
                                    $status = '<button type="button" class="btn btn-success">'. $row['status_th']. '</button>';
                                }else{
                                    $status = '<button type="button" class="btn btn-danger">'.$row['status_th'].'</button>';
                                }
                            ?>
                                <tr>
                                <th scope="row"><?php echo $i;?></th>
                                <td><?php echo $row['equipment_id'];?></td>
                                <td width="200px"><center><img align="center" src="../assets/equipment/category/<?php echo $row['categoryID'].'.jpg'; ?>" alt="" class="img-responsive" width="100%"></center></td>
                                <td>
                                    <?php echo '<strong>ชื่อครุภัณฑ์:</strong> '.$row['equipName_th'];?><a><br>
                                    <?php echo '<strong>รายละเอียดรายการ:</strong> '.$row['equipInfo_th'];?>
                                </td>
                                <td><?php echo $status;?></td>
                                <td width="250px"><div name="btn-group" method="POST">
                                    <a href="borrow.php?equipment_id=<?php echo $row['equipment_id'];?>" class="btn btn-dark" id="btn-borrow<?php echo $i;?>" name="btn-borrow<?php echo $i;?>">ยืม</a>   
                                </div></td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <a href="user_list.php" class="btn btn-dark" id="btn-back" name="btn-back" >ย้อนกลับ</a>
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