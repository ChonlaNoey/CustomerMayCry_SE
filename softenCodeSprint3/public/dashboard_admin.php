<?php 
  include('../config/database_connection.php');
  session_start();

  // Condition in order to see a page
  if($_SESSION['email'] == ""){
    header("location: ../index.php");
    exit();
  }else{
    // Role check
    if($_SESSION["role"] == "User"){
      header("location: ../index.php");
      exit();
    }else if($_SESSION["role"] == "Student"){
        header("location: ../index.php");
        exit();
    }else{
      $dashboard="dashboard_admin.php";
    }
  }
  
  $email = $_SESSION['email'];
  // Fetch - user with email
  $user = $connect->prepare("
      SELECT 
        *
      FROM 
        staff
      WHERE 
        email = '$email'
     "); 
  $user->execute(); 
  $user = $user->fetch();
  $alert = '';

  if($user['alert'] == 1){
    $alert = '
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <h5><strong>แจ้งเตือน!</strong> ข้อมูลของคุณได้ถูกแก้ไขโดยแอดมิน กรุณาเข้าสู่ระบบใหม่อีกครั้ง</h5>
    </div>';
    $sql = "UPDATE staff SET alert = 0 WHERE email = '$email'";
    $statement = $connect->prepare($sql);
    $statement->execute();
  }

  //Fetch student - user with approval state
  $std = $connect->prepare("
  SELECT COUNT(stdId) std_row FROM 
      student
  WHERE 
      permissionId = 1
  "); 
  $std->execute(); 
  $std = $std->fetch();
  
  //Fetch staff - user with approval state
  $staff = $connect->prepare("
  SELECT COUNT(email) staff_row FROM 
      staff
  WHERE 
      permissionId = 1
  "); 
  $staff->execute(); 
  $staff = $staff->fetch();

  $total_row = $std['std_row']+$staff['staff_row'];

?>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <!-- Logo -->
    <link rel="shortcut icon" href="../assets/logo/kku-logo.png">
    <!-- Font -->
    <link href="../css/body-font.css" rel="stylesheet" >
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" >
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
    <!-- Dashboard script -->
    <script src="../js/dashboard.js"></script>
</head>
<body data-gr-c-s-loaded="true">
  <!-- Navbar -->
  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" >
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#" align="center" style="color:white;">ระบบยืมคืน-อุปกรณ์</a>
  </nav>
  <!-- Content -->
  <div class="container-fluid">
    <!-- Sidebar -->
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div id="user_detail"><center>
        <img src="../assets/profile/profile1.jpg" class="img-fluid img-thumbnail rounded-circle" alt="" width="250px" height="" style="margin-top:10px; margin-bottom:10px;">
        <div id="user_txt" style="color:black;">
          <strong style="font-size:20px;"><?php echo $_SESSION["role"]." - ".$_SESSION["position_th"]; ?></strong><br>
          <strong style="font-size:18px;"><?php echo  $_SESSION["fname"].' '.$_SESSION["lname"].'<br>'.$_SESSION["email"];?></strong>
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
            <a class="nav-link" href="staff_edit_profile.php" id="setting" name="setting">
              <img src="../assets/logo/setting.png" width="20" height="20" fill="none" stroke="currentColor" style="margin-left:0px;"> 
              <span style="margin-left:2px;">Edit profile</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" id="logout" name="logout">
              <img src="../assets/logo/logout.png" width="20" height="20" fill="none" stroke="currentColor" >
              <span style="margin-left:1px;">Logout</span>
            </a>
          </li>
        </ul>
      </div>
      </nav>
    </div>
    <!-- Dashboard Main -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div style="width:100%;">
      <?php echo $alert; ?>
      <!-- Dashboard Name -->
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>
      <center>
      <!-- Anoucement -->
      <div id="all_cards" style="display: block; margin-bottom:20px; width:90%;">
        <div class="card" style="display: block; margin-bottom:20px;" id="annoucement">
          <h5 class="card-header">ประกาศ</h5>
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" style="height:auto;">
              <div class="carousel-item active">
                <a href="#" id="annouce1"><img class="d-block w-100" src="../assets/annoucement/annouce1.JPG" alt="First slide"></a>
              </div>
              <div class="carousel-item">
                <a href="#" id="annouce2"><img class="d-block w-100" src="../assets/annoucement/annouce2.JPG" alt="Second slide"></a>
              </div>
              <div class="carousel-item">
                <a href="#" id="annouce3"><img class="d-block w-100" src="../assets/annoucement/annouce3.JPG" alt="Third slide"></a>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
      <!-- News & Event -->
      <div class="card-deck" style="width:1325px; height:auto; margin-bottom:20px; width:92%;" align="left">
        <!-- News -->
        <div class="card ">
          <h5 class="card-header">ข่าวสาร<a href="#" class="btn btn-secondary float-right">แก้ไข</a></h5>
          <div class="card-body">
            <h6 class="card-title">ข่าวสาร 1</h6>
            <h6 class="card-title">ข่าวสาร 2</h6>
            <h6 class="card-title">ข่าวสาร 3</h6>
            <h6 class="card-title">ข่าวสาร 4</h6>
            <h6 class="card-title">ข่าวสาร 5</h6>
            <h6 class="card-title">ข่าวสาร 6</h6>
          </div>
        </div>
        <!-- Event -->
        <div class="card">
          <h5 class="card-header">กิจกรรม<a href="#" class="btn btn-secondary float-right">แก้ไข</a></h5>
          <div class="card-body">
            <h6 class="card-title">กิจกรรม 1</h6>
            <h6 class="card-title">กิจกรรม 2</h6>
            <h6 class="card-title">กิจกรรม 3</h6>
            <h6 class="card-title">กิจกรรม 4</h6>
            <h6 class="card-title">กิจกรรม 5</h6>
            <h6 class="card-title">กิจกรรม 6</h6>
          </div>
        </div>
      </div>
      <!--Statement & Services-->
      <div class="card-deck" style="width:92%; height:auto; margin-bottom:20px;" align="left">
        <!-- Statement -->
        <div class="card">
          <h5 class="card-header">สถานะ</h5>
          <div class="card-body" style="width:100%;" align="center">
            <div class="row">
              <!-- รอการอนุมัติสมาชิก -->
              <div class="col-sm-12 col-lg-4 col-md-12 mb-2">
                <a href="user_approval.php" id="approval"><button type="button" class="btn btn-success" style="width: 100%; height: 100%;">
                  <img class="card-img-top" src="../assets/logo/approval.png" alt="approval" style="width:50px;"><br><br>
                  รอการอนุมัติสมาชิก <span class="badge badge-light"><?php echo $total_row; ?></span>
                  <span class="sr-only">คำขออนุมัติ</span>
                </button></a>
              </div>
              <!-- รอการอนุมัติยืม -->
              <div class="col-sm-12 col-lg-4 col-md-12 mb-2">
                <a href="#" id="borrow"><button type="button" class="btn btn-dark" style="width: 100%; height: 100%;">
                  <img class="card-img-top" src="../assets/logo/approve.png" alt="approve" style="width:50px;"><br><br>            
                  รอการอนุมัติยืม <span class="badge badge-light">8</span>
                  <span class="sr-only">รายการ</span>
                </button></a>
              </div>
              <!-- รอการตรวจสอบ -->
              <div class="col-sm-12 col-lg-4 col-md-12 mb-2">
                <a href="#" id="check"><button type="button" class="btn btn-dark" style="width: 100%; height: 100%;">
                  <img class="card-img-top" src="../assets/logo/check.png" alt="approve" style="width:50px;"><br><br>
                  รอการตรวจสอบ <span class="badge badge-light">6</span>
                  <span class="sr-only">รายการ</span>
                </button></a>
              </div>
              <!-- รายการครบกำหนด -->
              <div class="col-sm-12 col-lg-4 col-md-12 mb-2">
                <a href="#" id="deadline"><button type="button" class="btn btn-dark" style="width: 100%; height: 100%;">
                  <img class="card-img-top" src="../assets/logo/deadline.png" alt="deadline" style="width:135px;"><br>
                  รายการครบกำหนด <span class="badge badge-light">3</span>
                  <span class="sr-only">รายการ</span>
                </button></a>
              </div>
              <!-- ดำเนินการเรียบร้อย -->
              <div class="col-sm-12 col-lg-4 col-md-12 mb-2">
                <a href="#" id="complete"><button type="button" class="btn btn-dark" style="width: 100%; height: 100%;">
                  <img class="card-img-top" src="../assets/logo/complete.png" alt="complete" style="width:50px;"><br><br>
                  ดำเนินการเรียบร้อย <span class="badge badge-light">4</span>
                  <span class="sr-only">รายการ</span>
                </button></a>
              </div>
              <!-- NaN -->
              <div class="col-sm-12 col-lg-4 col-md-12 mb-2">
                <a href="maintenance.php" id="maintenance"><button type="button" class="btn btn-info" style="width: 100%; height: 100%;">
                  <img class="card-img-top" src="../assets/logo/maintenance.png" alt="complete" style="width:50px;"><br><br>
                  Maintenance <span class="badge badge-light">New</span>
                  <span class="sr-only"></span>
                </button></a>
              </div>
            </div>
          </div>
        </div>
        <!-- Services -->
        <div class="card" style="width:100%;">
          <h5 class="card-header">บริการ</a></h5>
          <div class="card-body">
          <center>
          <div class="row">
            <!-- จัดการข้อมูลสมาชิก -->
            <div class="col-sm-12 col-lg-4 col-md-12 mb-2">
              <a href="user_manager.php" id="userManage">
                <img class="card-img-top" src="../assets/logo/edit-user.png" alt="จัดการข้อมูลสมาชิก" style="width:50px;">
                <div class="card-body">
                  <p class="card-text"><Strong class="text-muted">จัดการข้อมูลสมาชิก</Strong></p>
                </div>
              </a>
            </div>
            <!-- เพิ่มอุปกรณ์ -->
            <div class="col-sm-12 col-lg-4 col-md-12 mb-2">
              <a href="insert_equipment.php" id="addEquip">
                <img class="card-img-top" src="../assets/logo/add.png" alt="wishlist" style="width:50px;">
                <div class="card-body">
                  <p class="card-text"><Strong class="text-muted">เพิ่มอุปกรณ์</Strong></p>
                </div>
              </a>
            </div>
            <!-- จัดการอุปกรณ์ -->
            <div class="col-sm-12 col-lg-4 col-md-12 mb-2">
              <a href="admin_list.php" id="manage">
                  <img class="card-img-top" src="../assets/logo/manage.png" alt="wishlist" style="width:50px;">
                <div class="card-body">
                  <p class="card-text"><Strong class="text-muted">จัดการอุปกรณ์</Strong></p>
                </div>
              </a>
            </div>
            <!-- เลือกยืมอุปกรณ์ -->
            <div class="col-sm-12 col-lg-4 col-md-12 mb-2">
              <a href="user_list.php" id="wishlist">
                <img class="card-img-top" src="../assets/logo/wishlist.png" alt="wishlist" style="width:50px;">
                <div class="card-body">
                  <p class="card-text"><Strong class="text-muted">เลือกยืมอุปกรณ์</Strong></p>
                </div>
              </a>
            </div>
            <!-- สถานะการยืม-คืน -->
            <div class="col-sm-12 col-lg-4 col-md-12 mb-2">
              <a href="#" id="status">
                <img class="card-img-top" src="../assets/logo/status2.png" alt="status" style="width:50px;">
                <div class="card-body">
                  <p class="card-text"><Strong class="text-muted">สถานะการยืม-คืน</Strong></p>
                </div>
              </a>
            </div>
            <!-- ประวัติการยืม -->
            <div class="col-sm-12 col-lg-4 col-md-12 mb-2">
              <a href="#" id="history">
                <img class="card-img-top" src="../assets/logo/history2.png" alt="history" style="width:50px;">
                <div class="card-body">
                  <p class="card-text"><Strong class="text-muted">ประวัติการยืม</Strong></p>
                </div>
            </div>
          </div>
          </center>
        </div>
      </div>
      </center>
    </main>
  </div>
</body>
</html>