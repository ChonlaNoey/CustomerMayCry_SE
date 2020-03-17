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

  //Fetch student - user with approval state
  $std = $connect->prepare("
    SELECT * FROM 
        student
    WHERE 
        permissionId=1
    "); 
  $std->execute(); 
  $std_total_row = $std->rowCount();
  $std = $std->fetchAll();

  //Fetch student - user with approval state
  $staff = $connect->prepare("
    SELECT * FROM 
        staff,position
    WHERE 
        permissionId=1 AND staff.positionId = position.positionId
    "); 
  $staff->execute(); 
  $staff_total_row = $staff->rowCount();
  $staff = $staff->fetchAll();

  // Approve std
  if (isset($_POST['approve-std'])) {    
    $stdId = $_POST['stdId'];
    $sql = "UPDATE student SET permissionId=2 WHERE stdId = '$stdId'";
    $statement = $connect->prepare($sql);
    $statement->execute();
    header("location: user_approval.php");
  }

  // Reject std
  if (isset($_POST['reject-std'])) {    
    $stdId = $_POST['stdId'];
    $sql = "DELETE FROM student WHERE stdId = '$stdId'";
    $statement = $connect->prepare($sql);
    $statement->execute();
    header("location: user_approval.php");
  }

  // Approve staff
  if (isset($_POST['approve-staff'])) {    
    $email = $_POST['email'];
    $sql = "UPDATE staff SET permissionId=2 WHERE email = '$email'";
    $statement = $connect->prepare($sql);
    $statement->execute();
    header("location: user_approval.php");
  }

  // Reject staff
  if (isset($_POST['reject-staff'])) {    
    $email = $_POST['email'];
    $sql = "DELETE FROM staff WHERE email = '$email'";
    $statement = $connect->prepare($sql);
    $statement->execute();
    header("location: user_approval.php");
  }
?>
<html>
<head>
  <title>คำร้องขออนุมัติ</title>
  <link rel="shortcut icon" href="../assets/logo/kku-logo.png" />
  <!-- Logo -->
  <link rel="shortcut icon" href="assets/logo/kku-logo.png" />
  <!-- Font -->
  <link href="../css/body-font.css" rel="stylesheet" >
  <!-- Bootstrap core -->
  <link href="../css/bootstrap.min.css" rel="stylesheet" >
  <script src="../js/jquery-3.4.1.slim.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <!-- Custom styles for this template -->
  <link href="../css/dashboard.css" rel="stylesheet">
  <link href="../css/password-validation.css" rel="stylesheet">
  <!-- Custom script -->
  <script src="../js/modal.js"></script>
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
      <nav class="col-md-2 bg-light sidebar">
        ​<div id="user_detail">
          <center><img src="../assets/profile/profile1.jpg" class="img-fluid img-thumbnail rounded-circle" alt="" width="250px" height="" style="margin-top:10px; margin-bottom:10px;">
          <div id="user_txt" style="color:black;">
            <strong style="font-size:20px;"><?php echo $_SESSION["role"]; ?></strong><br>
            <strong style="font-size:18px;"><?php echo  $_SESSION["fname"].' '.$_SESSION["lname"].'<br>'.$_SESSION["email"];?></strong>
          </div></center>
        </div>
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $dashboard; ?>" id="dashboard" name="dashboard">
                <img src="../assets/logo/dashboard.png" width="24" height="24" fill="none" stroke="currentColor" style="margin-left:-1px;"> 
                <span style="margin-left:2px;">Dashboard</span>
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
      <!-- Dashboard Name -->
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">สมาชิกที่รอการอนุมัติ</h1>
      </div>
      <center>
      <!-- student approval table -->
      <div class="card" style="width:100%; border: none;">
        <div class="card-body" style="border: none;">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" style="margin-top:-20px;">
          <h3 align="left" style="padding-left:10px;"><b>นักศึกษา <b><span class="badge badge-secondary"><?php echo $std_total_row; ?></span></h3>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card" style="border: none;">
                <div class="table-responsive-lg">
                    <?php
                      if($std_total_row > 0)
                    { ?>
                          <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">รหัสนักศึกษา</th>
                            <th scope="col">ชื่อ-สกุล</th>
                            <th scope="col">ระดับการศึกษา</th>
                            <th scope="col">หลักสูตรการศึกษา</th>
                            <th scope="col">ตอบรับการเป็นสมาชิก</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $output = '';
                            $i = 0;
                            foreach($std as $row)
                            {
                                $i++;
                            ?>
                            <form method="POST">
                                <tr>
                                <th scope="row"><?php echo $i;?></th>
                                <td><input type="hidden" id="stdId" name="stdId" value="<?php echo $row['stdId'];?>"><?php echo $row['stdId'];?></td>
                                <td><?php echo $row['fname']." ".$row['lname']; ?></td>
                                <td><?php echo $row['degree'];?></td>
                                <td><?php echo $row['major'];?></td>
                                <td width="250px"><div name="btn-group">
                                  <!-- approve user modal button -->
                                  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="<?php echo "#stdApproval".$i; ?>" id="<?php echo "std-approval".$i; ?>" name="<?php echo "std-approval".$i; ?>">อนุมัติ</button>
                                  <!-- approve user modal -->
                                  <div class="modal fade" id="<?php echo "stdApproval".$i; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo "stdApproval".$i; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="<?php echo "staffApproval".$i; ?>">ยืนยันที่จะอนุญาต User นี้ในระบบ</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">   
                                          <center><b>*** หากมั่นใจแล้วโปรดกดตกลง ***</b></center>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" name="approve-std" id="approve-std<?php echo $i?>" class="btn btn-dark">ตกลง</button>
                                          <button type="button" class="btn btn-dark" data-dismiss="modal" name="<?php echo "stdApprovalCancel".$i; ?>" id="<?php echo "stdApprovalCancel".$i; ?>">ยกเลิก</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>   
                              
                                  <!-- approve user modal button -->
                                  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="<?php echo "#stdReject".$i; ?>" id="<?php echo "reject".$i; ?>" name="<?php echo "reject".$i; ?>">ปฎิเสธ</button>
                                  <!-- approve user modal -->
                                  <div class="modal fade" id="<?php echo "stdReject".$i; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo "stdReject".$i; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title">ยืนยันที่จะปฏิเสธ User นี้ในระบบ</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body"> 
                                          <center><b>*** หากมั่นใจแล้วโปรดกดตกลง ***</b></center>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" name="reject-std" id="reject-std<?php echo $i?>" class="btn btn-dark">ตกลง</button>
                                          <button type="button" class="btn btn-dark" data-dismiss="modal" name="<?php echo "stdRejectCancel".$i; ?>" id="<?php echo "stdRejectCancel".$i; ?>">ยกเลิก</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div></td>
                                </tr>
                              </form>
                            <?php
                            }
                            echo '</tbody></table>';
                        }else{
                          echo '
                          <div class="pt-3 pb-2 mb-3 border-bottom">
                          <h1 align="center">*** ยังไม่มีผู้สมัครสมาชิก ***</h1>
                          </div>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
        </div>
      </div>
      <br>
      <!--  staff approval table -->
      <div class="card" style="width:100%; border: none;">
        <div class="card-body" style="border: none;">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" style="margin-top:-20px;">
          <h3 align="left" style="padding-left:10px;"><b>บุคลากร <b><span class="badge badge-secondary"><?php echo $staff_total_row; ?></span></h3>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card" style="border: none;">
                <div class="table-responsive-lg">
                    <?php
                      if($staff_total_row > 0)
                    { ?>
                          <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">อีเมล</th>
                            <th scope="col">ชื่อ-สกุล</th>
                            <th scope="col">หน้าที่</th>
                            <th scope="col">ตอบรับการเป็นสมาชิก</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $output = '';
                            $i = 0;
                            foreach($staff as $row)
                            {
                                $i++;
                            ?>
                            <form method="POST">
                                <tr>
                                <th scope="row"><?php echo $i;?></th>
                                <td><input type="hidden" id="email" name="email" value="<?php echo $row['email'];?>"><?php echo $row['email'];?></td>
                                <td><?php echo $row['fname']." ".$row['lname']; ?></td>
                                <td><?php echo $row['position_th'];?></td>
                                <td width="250px"><div name="btn-group">
                                  <!-- approve user modal button -->
                                  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="<?php echo "#staff".$i; ?>" id="<?php echo "staff-approval".$i; ?>" name="<?php echo "staff-approval".$i; ?>">อนุมัติ</button>
                                  <!-- approve user modal -->
                                  <div class="modal fade" id="<?php echo "staff".$i; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo "staff".$i; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="<?php echo "staff".$i; ?>">ยืนยันที่จะอนุญาต User นี้ในระบบ</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">   
                                          <center><b>*** หากมั่นใจแล้วโปรดกดตกลง ***</b></center>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" name="approve-staff" id="approve-staff<?php echo $i?>" class="btn btn-dark">ตกลง</button>
                                          <button type="button" class="btn btn-dark" data-dismiss="modal" name="<?php echo "staffApprovalCancel".$i; ?>" id="<?php echo "staffApprovalCancel".$i; ?>">ยกเลิก</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>   
                  
                                  <!-- approve user modal button -->
                                  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="<?php echo "#staffReject".$i; ?>" id="<?php echo "staff-Reject".$i; ?>" name="<?php echo "staff-Reject".$i; ?>">ปฎิเสธ</button>
                                  <!-- approve user modal -->
                                  <div class="modal fade" id="<?php echo "staffReject".$i; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo "staffReject".$i; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="<?php echo "staffReject".$i; ?>">ยืนยันที่จะปฏิเสธ User นี้ในระบบ</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body"> 
                                          <center><b>*** หากมั่นใจแล้วโปรดกดตกลง ***</b></center>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="submit" name="reject-staff" id="reject-staff<?php echo $i?>" class="btn btn-dark">ตกลง</button>
                                          <button type="button" class="btn btn-dark" data-dismiss="modal" name="<?php echo "staffRejectCancel".$i; ?>" id="<?php echo "staffRejectCancel".$i; ?>">ยกเลิก</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div></td>
                                </tr>
                              </form>
                            <?php
                            }
                            echo '</tbody></table>';
                        }else{
                          echo '
                          <div class="pt-3 pb-2 mb-3 border-bottom">
                          <h1 align="center">*** ยังไม่มีผู้สมัครสมาชิก ***</h1>
                          </div>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
        </div>
      </div>
      </center>
    </main>
  </div>
</body>
</html>