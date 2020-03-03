<?php 
  include('../config/database_connection.php');
  session_start();
  if($_SESSION["role"] == "Staff"){
    header("location: ../index.php");
    exit();
  }else if($_SESSION["role"] == "Student"){
      header("location: ../index.php");
      exit();
  }
  if($_SESSION['email'] == ""){
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
?>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="../assets/logo/kku-logo.png" />
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
          <h1 class="h2">Dashboard</h1>
        </div>
        <center>
        <div id="all_cards" style="display: block; margin-bottom:20px; width:1300px;">
        <div class="card" style="display: block; margin-bottom:20px;" id="annoucement">
          <h5 class="card-header">ประกาศ</h5>
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner" style="height:400px;">
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
        <div class="card-deck" style="width:1325px; height:300px; margin-bottom:20px;" align="left">
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
          <!-- Statement -->
          <div class="card-deck" style="width:1325px; height:300px; margin-bottom:20px;" align="left">
          <div class="card ">
              <h5 class="card-header">การยืมคืน</h5>
              <div class="card-body">
              <div class="card-body" align="center">
                  <div class="card-deck" style="margin-bottom:20px;">
                      <div class="card">
                        <p class="card-text" align="left"><h6 class="text-muted"><b>รอการตรวจสอบ</b></h6></p>
                          <a href="#" id="check"><img class="card-img-top" src="../assets/logo/check.png" alt="check" style="width:80px;">
                            <div class="card-body">
                            <p class="card-text"><Strong style="color:Green;" class="text-">4 รายการ</Strong></p>
                          </div></a>
                      </div>
                      <div class="card">
                        <p class="card-text" align="left"><h6 class="text-muted"><b>อนุมัติแล้ว</b></h6></p>
                          <a href="#" id="approve"><img class="card-img-top" src="../assets/logo/approve.png" alt="approve" style="width:80px;">
                            <div class="card-body">
                            <p class="card-text"><Strong style="color:Green;" class="text-">16 รายการ</Strong></p>
                          </div></a>
                      </div>
                  </div>
                  <div class="card-deck">
                      <div class="card">
                        <p class="card-text" align="left"><h6 class="text-muted"><b>รายการครบกำหนด</b></h6></p>
                          <a href="#" id="deadline"><img class="card-img-top" src="../assets/logo/deadline.png" alt="deadline" style="width:150px;">
                            <div class="card-body">
                            <p class="card-text"><Strong style="color:Green;" class="text-">2 รายการ</Strong></p>
                          </div></a>
                      </div>
                      <div class="card">
                        <p class="card-text" align="left"><h6 class="text-muted"><b>ดำเนินการเรียบร้อย</b></h6></p>
                          <a href="#" id="complete"><img class="card-img-top" src="../assets/logo/complete.png" alt="complete" style="width:80px;">
                            <div class="card-body">
                            <p class="card-text"><Strong style="color:Green;" class="text-">4 รายการ</Strong></p>
                          </div></a>
                      </div>
                  </div>
              </div>
              </div>
          </div>
          <!-- Services -->
          <div class="card">
              <h5 class="card-header">บริการ</a></h5>
              <div class="card-body">
              <div class="card-body" align="center">
                  <!-- Service row 1 -->
                  <div class="card-deck" style="padding-bottom:20px;">
                      <div class="card">
                          <a href="user_list.php" id="wishlist"><img class="card-img-top" src="../assets/logo/wishlist.png" alt="wishlist" style="width:80px;">
                          <div class="card-body">
                              <p class="card-text"><Strong class="text-muted">เลือกยืมอุปกรณ์</Strong></p>
                          </div></a>
                      </div>
                      <div class="card">
                          <a href="#" id="history"><img class="card-img-top" src="../assets/logo/history2.png" alt="history" style="width:80px;">
                          <div class="card-body">
                              <p class="card-text"><Strong class="text-muted">ประวัติการยืม</Strong></p>
                          </div></a>
                      </div>
                      <div class="card">
                          <a href="#" id="status"><img class="card-img-top" src="../assets/logo/status2.png" alt="status" style="width:80px;">
                          <div class="card-body">
                              <p class="card-text"><Strong class="text-muted">สถานะการยืม-คืน</Strong></p>
                          </div></a>
                      </div>
                  </div>
                  <!-- Service row 2 -->
                  <div class="card-deck">
                      <div class="card">
                          <a href="admin_list.php" id="manage"><img class="card-img-top" src="../assets/logo/manage.png" alt="wishlist" style="width:80px;">
                          <div class="card-body">
                              <p class="card-text"><Strong class="text-muted">จัดการอุปกรณ์</Strong></p>
                          </div></a>
                      </div>
                      <div class="card">
                          <a href="insert_equipment.php" id="addEquip"><img class="card-img-top" src="../assets/logo/add.png" alt="wishlist" style="width:80px;">
                          <div class="card-body">
                              <p class="card-text"><Strong class="text-muted">เพิ่มอุปกรณ์</Strong></p>
                          </div></a>
                      </div>
                      <div class="card">
                          <a href="#" id="NaN"><img class="card-img-top" src="../assets/noimage.jpg" alt="NaN" style="width:120px;">
                          <div class="card-body">
                              <p class="card-text"><Strong class="text-muted">NaN</Strong></p>
                          </div></a>
                      </div>
                  </div>
              </div>
              </div>
          </div>
        </div>
        </center>
      </main>
    </div>
  </div>
</div>
    <script src="../js/jquery-3.3.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="../js/jquery-slim.min.js"><\/script>')</script><script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/feather.min.js"></script>
    <script src="../js/Chart.min.js"></script>
    <script src="../js/dashboard.js"></script>

</body></html>