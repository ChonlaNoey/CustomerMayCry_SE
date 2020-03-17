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

  //Fetch student
  $std = $connect->prepare("
    SELECT * FROM 
        student,permission
    WHERE
        student.permissionId != 1 AND student.permissionId = permission.permissionId
    ORDER BY 
        stdId,fname,lname,email
        ASC
    "); 
  $std->execute(); 
  $std_total_row = $std->rowCount();
  $std = $std->fetchAll();

  //Fetch staff
  $staff = $connect->prepare("
    SELECT * FROM 
        staff,position,permission
    WHERE
        staff.permissionId != 1 AND staff.positionId = position.positionId AND staff.permissionId = permission.permissionId
    ORDER BY 
        fname,lname,email
        ASC
    "); 
  $staff->execute(); 
  $staff_total_row = $staff->rowCount();
  $staff = $staff->fetchAll();

  // Deactivate student
  if (isset($_POST['std-deactivated'])) {    
    $stdId = $_POST['stdId'];
    $sql = "UPDATE student SET permissionId=3 WHERE stdId = '$stdId'";
    $statement = $connect->prepare($sql);
    $statement->execute();
    header("location: user_manager.php");
  }

  // Activate student
  if (isset($_POST['std-activated'])) {    
    $stdId = $_POST['stdId'];
    $sql = "UPDATE student SET permissionId=2 WHERE stdId = '$stdId'";
    $statement = $connect->prepare($sql);
    $statement->execute();
    header("location: user_manager.php");
  }

  // Deactivate staff
  if (isset($_POST['staff-deactivated'])) {    
    $email = $_POST['email'];
    $sql = "UPDATE staff SET permissionId=3 WHERE email = '$email'";
    $statement = $connect->prepare($sql);
    $statement->execute();
    header("location: user_manager.php");
  }

  // Activate staff
  if (isset($_POST['staff-activated'])) {    
    $email = $_POST['email'];
    $sql = "UPDATE staff SET permissionId=2 WHERE email = '$email'";
    $statement = $connect->prepare($sql);
    $statement->execute();
    header("location: user_manager.php");
  }

?>
<html>
<head>
  <title>การบำรุงรักษาระบบ</title>
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
        <h1 class="h2">การบำรุงรักษาระบบ</h1>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="member-tab" data-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="true"><h4>เกี่ยวกับสมาชิก</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="borrow-tab" data-toggle="tab" href="#borrow" role="tab" aria-controls="borrow" aria-selected="false"><h4>เกี่ยวกับการยืมคืน-อุปกรณ์</h4></a>
        </li>
        </ul>
      </div>
      <div class="tab-content" id="myTabContent">
        <!-- Member tab -->
        <div class="tab-pane fade show active" id="member" role="tabpanel" aria-labelledby="member-tab">
          <div class="row">
            <!-- ตำแหน่งบุคลกร -->
            <div class="col-sm-4 col-lg-4 col-md-12 mb-2">
              <!-- Position modal button -->
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#position" style="width: 100%; height: 100%;"><h2>ตำแหน่งบุคลากร</h2></button>
              <!-- Position modal -->
              <div class="modal fade" id="position" tabindex="-1" role="dialog" aria-labelledby="position" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="position">ตำแหน่งบุคลากร</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body"><center>
                      <?php
                        // Insert position
                        $msg_addposition ='';
                        if (isset($_POST['btn-submit-position'])) {
                          $position = $connect->prepare("
                          SELECT * FROM 
                              position
                          ORDER BY
                              positionId
                        "); 
                        $position->execute(); 
                        $positionId = (int)$position->rowCount()+1;

                        $position_th = $_POST['newposition']; 
                        if(strcmp($position_th,"") == 0){
                          $msg_addposition ='<font color="red">กรุณากรอกตำแหน่ง</font>';
                        }else{
                          $sql = "INSERT INTO position VALUES ($positionId,'$position_th')";
                          $statement = $connect->prepare($sql);
                          $statement->execute();
                        }
                      }
                      // Update position
                      $msg_addposition ='';
                      if (isset($_POST['save-edit-position'])) {
                        $position_th = $_POST['newPosition']; 
                        $positionId= $_POST['positionId']; 
                        $sql = "Update position SET position_th = '$position_th' WHERE positionId=$positionId";
                        $statement = $connect->prepare($sql);
                        $statement->execute();
                      }
                      //Fetch position
                      $position = $connect->prepare("
                      SELECT * FROM 
                          position
                      ORDER BY
                          positionId
                      "); 
                      $position->execute(); 
                      $position_total_row = $position->rowCount();
                      $position = $position->fetchAll();
                                      
                      echo '
                      <table class="table">
                        <thead class="thead-dark">
                          <tr>
                          <th scope="col">ID</th>
                          <th scope="col">ตำแหน่ง</th>
                          <th scope="col">แก้ไข</th>
                          </tr>
                        </thead>
                        <tbody>
                      ';

                      if($position_total_row > 0){
                        $i=0;
                        foreach ($position as $row){
                          $i++;
                          echo'
                          <tr>
                          <th scope="row">'.$row['positionId'].'</th>
                          <td>'.$row['position_th'].'</td>
                          <td>
                            <!-- approve user modal button -->
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="'."#editPosition".$i.'" id="'."editPost".$i.'" name="'."editPost".$i.'">แก้ไข</button>
                            <!-- approve user modal -->
                            <div class="modal fade" id="'."editPosition".$i.'" tabindex="-1" role="dialog" aria-labelledby="'."editPosition".$i.'" aria-hidden="true">
                              <div class="modal-dialog" role="document"><form method="post">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">แก้ไข</h5>
                                  </div>
                                  <div class="modal-body"> 
                                    <input type="hidden" id="positionId" name="positionId" value="'.$row['positionId'].'">
                                    <input class="form-control" id="newPosition" name="newPosition" value="'.$row['position_th'].'">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" name="save-edit-position" id="save-edit-position" class="btn btn-dark">บันทึก</button>
                                    <button type="button" class="btn btn-dark" data-dismiss="modal" name="'."editPositionCancel".$i.'" id="'."editPositionCancel".$i.'">ยกเลิก</button>
                                  </div>
                                </div>
                              </form></div>
                            </div>
                          <td>
                          </tr>
                          ';
                        }
                      }
                      echo '
                        </tbody>
                      </table>';
                      ?>
                    <!-- Position modal button -->
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addposition" style="width: 100%; height: 100%;"><h4>เพิ่มตำแหน่งบุคลากร</h4></button><br><br>
                    <!-- Profile staff edit save modal -->
                    <div class="modal fade" id="addposition" tabindex="-1" role="dialog" aria-labelledby="addposition" aria-hidden="true">
                      <div class="modal-dialog" role="document"><form method="post">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="addposition">เพิ่มตำแหน่งบุคลากร</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">   
                            <input class="form-control" id="newposition" name="newposition" placeholder="กรุณาป้อนตำแหน่งที่ต้องการเพิ่ม" value="">
                          </div>
                          <!-- Cancel & Submit-profile button -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" name="btn-submit-position" id="btn-submit-position" class="btn btn-dark">เพิ่ม</button>
                          </div>
                        </div>
                      </form></div>
                    </div>
                    </center></div>
                </div>
              </div>
            </div>
          </div>
            <!-- สิทธิ์ -->
            <div class="col-sm-4 col-lg-4 col-md-12 mb-2">
              <!-- modal button -->
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#permission" style="width: 100%; height: 100%;"><h2>สิทธิ์ของ User</h2></button>
              <!-- modal -->
              <div class="modal fade" id="permission" tabindex="-1" role="dialog" aria-labelledby="permission" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="permission">ตำแหน่งบุคลากร</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body"><center>
                      <?php
                        // Insert permission
                        $msg_addpermission ='';
                        if (isset($_POST['btn-submit-permission'])) {
                          $permission = $connect->prepare("
                          SELECT * FROM 
                              permission
                          ORDER BY
                              permissionId
                        "); 
                        $permission->execute(); 
                        $permissionId = (int)$permission->rowCount()+1;

                        $permission_th = $_POST['newpermission']; 
                        if(strcmp($permission_th,"") == 0){
                          $msg_addpermission ='<font color="red">กรุณากรอกสิทธิ์</font>';
                        }else{
                          $sql = "INSERT INTO permission VALUES ($permissionId,'$permission_th')";
                          $statement = $connect->prepare($sql);
                          $statement->execute();
                        }
                      }
                      // Update permission
                      $msg_addpermission ='';
                      if (isset($_POST['save-edit-permission'])) {
                        $permission_th = $_POST['newpermission']; 
                        $permissionId= $_POST['permissionId']; 
                        $sql = "Update permission SET permission_th = '$permission_th' WHERE permissionId=$permissionId";
                        $statement = $connect->prepare($sql);
                        $statement->execute();
                      }
                      //Fetch permission
                      $permission = $connect->prepare("
                      SELECT * FROM 
                          permission
                      ORDER BY
                          permissionId
                      "); 
                      $permission->execute(); 
                      $permission_total_row = $permission->rowCount();
                      $permission = $permission->fetchAll();
                                      
                      echo '
                      <table class="table">
                        <thead class="thead-dark">
                          <tr>
                          <th scope="col">ID</th>
                          <th scope="col">สิทธิ์</th>
                          <th scope="col">แก้ไข</th>
                          </tr>
                        </thead>
                        <tbody>
                      ';

                      if($permission_total_row > 0){
                        $i=0;
                        foreach ($permission as $row){
                          $i++;
                          echo'
                          <tr>
                          <th scope="row">'.$row['permissionId'].'</th>
                          <td>'.$row['permission_th'].'</td>
                          <td>
                            <!-- approve user modal button -->
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="'."#editpermission".$i.'" id="'."editPost".$i.'" name="'."editPost".$i.'">แก้ไข</button>
                            <!-- approve user modal -->
                            <div class="modal fade" id="'."editpermission".$i.'" tabindex="-1" role="dialog" aria-labelledby="'."editpermission".$i.'" aria-hidden="true">
                              <div class="modal-dialog" role="document"><form method="post">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">แก้ไข</h5>
                                  </div>
                                  <div class="modal-body"> 
                                    <input type="hidden" id="permissionId" name="permissionId" value="'.$row['permissionId'].'">
                                    <input class="form-control" id="newpermission" name="newpermission" value="'.$row['permission_th'].'">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" name="save-edit-permission" id="save-edit-permission" class="btn btn-dark">บันทึก</button>
                                    <button type="button" class="btn btn-dark" data-dismiss="modal" name="'."editpermissionCancel".$i.'" id="'."editpermissionCancel".$i.'">ยกเลิก</button>
                                  </div>
                                </div>
                              </form></div>
                            </div>
                          <td>
                          </tr>
                          ';
                        }
                      }
                      echo '
                        </tbody>
                      </table>';
                      ?>
                    <!-- permission modal button -->
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addpermission" style="width: 100%; height: 100%;"><h4>เพิ่มสิทธิ์</h4></button><br><br>
                    <!-- permission modal -->
                    <div class="modal fade" id="addpermission" tabindex="-1" role="dialog" aria-labelledby="addpermission" aria-hidden="true">
                      <div class="modal-dialog" role="document"><form method="post">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="addpermission">เพิ่มสิทธิ์</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">   
                            <input class="form-control" id="newpermission" name="newpermission" placeholder="กรุณาป้อนตำแหน่งที่ต้องการเพิ่ม" value="">
                          </div>
                          <!-- Cancel & Submit-profile button -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" name="btn-submit-permission" id="btn-submit-permission" class="btn btn-dark">เพิ่ม</button>
                          </div>
                        </div>
                      </form></div>
                    </div>
                    </center></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        <!-- Borrowing tab -->
        <div class="tab-pane fade" id="borrow" role="tabpanel" aria-labelledby="borrow-tab">
            borrow
        </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>