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
  <title>การจัดการสมาชิก</title>
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
        <h1 class="h2">การจัดการสมาชิก</h1>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="student-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="true"><h4>นักศึกษา</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="staff-tab" data-toggle="tab" href="#staff" role="tab" aria-controls="staff" aria-selected="false"><h4>บุคลากร</h4></a>
        </li>
        </ul>
      </div>
      <div class="tab-content" id="myTabContent">
        <!-- Student tab -->
        <div class="tab-pane fade show active" id="student" role="tabpanel" aria-labelledby="student-tab">
          <input class="form-control" id="stdInput" type="text" placeholder="Search.."><br>            
          <?php
          if($std_total_row > 0)
          { ?>
              <table class="table">
                <thead class="table-active">
                  <tr>
                  <th scope="col">#</th>
                  <th scope="col">รหัสนักศึกษา</th>
                  <th scope="col">ชื่อ-สกุล</th>
                  <th scope="col">ระดับการศึกษา</th>
                  <th scope="col">หลักสูตรการศึกษา</th>
                  <th scope="col">สถานะบัญชี</th>
                  <th scope="col">การจัดการสมาชิก</th>
                  </tr>
                </thead>
                <tbody id="stdTab">
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
                        <td><?php 
                          if($row['permissionId'] == 2){
                            echo '<button class="btn btn-success" id="stdPermission'.$i.'" name="stdPermission'.$i.'" disabled="disabled">'.$row['permission_th'].'</button>';
                          }else{
                            echo '<button class="btn btn-danger" id="stdPermission'.$i.'" name="stdPermission'.$i.'" disabled="disabled">'.$row['permission_th'].'</button>';
                          }
                        ?></td>
                        <!-- button -->
                        <td width="250px"><div name="btn-group">
                          <!-- Student edit -->
                          <a id="stdEdit<?php echo $i ?>" name="stdEdit<?php echo $i ?>" href="student_edit_profile_by_admin.php?stdId=<?php echo $row['stdId'];?>" class="btn btn-dark">แก้ไข</a>
                          <?php if($row['permissionId'] != 1 && $row['permissionId'] == 2){ ?>
                            <!-- Deactivate student modal button -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="<?php echo "#stdDeactivated".$i; ?>" id="<?php echo "stdDeact".$i; ?>" name="<?php echo "stdDeact".$i; ?>">ปิดการใช้งาน</button>
                            <!-- Deactivate student modal -->
                            <div class="modal fade" id="<?php echo "stdDeactivated".$i; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo "stdDeactivated".$i; ?>" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">ต้องการที่จะปิดการใช้งานบัญชีนี้</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body"> 
                                    <center><b>*** หากมั่นใจแล้วโปรดกดตกลง ***</b></center>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" name="std-deactivated" id="std-deactivated<?php echo $i; ?>" class="btn btn-dark">ตกลง</button>
                                    <button type="button" class="btn btn-dark" data-dismiss="modal" name="<?php echo "stdDeactivatedCancel".$i; ?>" id="<?php echo "stdDeactivatedCancel".$i; ?>">ยกเลิก</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                      <?php 
                      }else{ ?>
                        <!-- Activate student modal button -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="<?php echo "#stdActivated".$i; ?>" id="<?php echo "stdDeact".$i; ?>" name="<?php echo "stdDeact".$i; ?>">เปิดการใช้งาน</button>
                        <!-- Activate student modal -->
                        <div class="modal fade" id="<?php echo "stdActivated".$i; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo "staffActivated".$i; ?>" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">ต้องการที่จะเปิดการใช้งานบัญชีนี้</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body"> 
                                <center><b>*** หากมั่นใจแล้วโปรดกดตกลง ***</b></center>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="std-activated" id="std-activated<?php echo $i; ?>" class="btn btn-dark">ตกลง</button>
                                <button type="button" class="btn btn-dark" data-dismiss="modal" name="<?php echo "stdActivatedCancel".$i; ?>" id="<?php echo "stdActivatedCancel".$i; ?>">ยกเลิก</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php
                      }
                      ?>
                      </td>
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
        <!-- Staff tab -->
        <div class="tab-pane fade" id="staff" role="tabpanel" aria-labelledby="staff-tab">
            <input class="form-control" id="staffInput" type="text" placeholder="Search.."><br>
            <?php
            if($staff_total_row > 0)
            { ?>
              <table class="table">
                <thead class="table-active">
                  <tr>
                  <th scope="col">#</th>
                  <th scope="col">อีเมล</th>
                  <th scope="col">ชื่อ-สกุล</th>
                  <th scope="col">หน้าที่</th>
                  <th scope="col">สถานะบัญชี</th>
                  <th scope="col">สิทธิ์ในการเข้าถึงระบบ</th>
                  <th scope="col">การจัดการสมาชิก</th>
                  </tr>
                </thead>
                <tbody id="staffTab">
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
                      <td><?php 
                        if($row['permissionId'] == 2){
                          echo '<button id="staffPermission'.$i.'" name="staffPermission'.$i.'" class="btn btn-success" disabled="disabled">'.$row['permission_th'].'</button>';
                        }else{
                          echo '<button id="staffPermission'.$i.'" name="staffPermission'.$i.'" class="btn btn-danger" disabled="disabled">'.$row['permission_th'].'</button>';
                        }
                      ?></td>
                      <td><?php echo $row['role'];?></td>
                      <td width="250px"><div name="btn-group">
                        <!-- Edit staff -->
                        <a id="staffEdit<?php echo $i ?>" name="staffEdit<?php echo $i ?>" href="staff_edit_profile_by_admin.php?email=<?php echo $row['email'];?>" class="btn btn-dark">แก้ไข</a>
                        <?php if(strcmp($row['email'],$_SESSION['email'])==0){
                        }else{
                          if($row['permissionId'] != 1 && $row['permissionId'] == 2){ ?>
                          <!-- Deactivate staff modal button -->
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="<?php echo "#staffDeactivated".$i; ?>" id="<?php echo "staffDeact".$i; ?>" name="<?php echo "staffDeact".$i; ?>">ปิดการใช้งาน</button>
                          <!-- Deactivate staff modal -->
                          <div class="modal fade" id="<?php echo "staffDeactivated".$i; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo "staffDeactivated".$i; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">ต้องการที่จะปิดการใช้งานบัญชีนี้</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body"> 
                                  <center><b>*** หากมั่นใจแล้วโปรดกดตกลง ***</b></center>
                                </div>
                              <div class="modal-footer">
                                <button type="submit" name="staff-deactivated" id="staff-deactivated<?php echo $i; ?>" class="btn btn-dark">ตกลง</button>
                                <button type="button" class="btn btn-dark" data-dismiss="modal" name="<?php echo "staffDeactivatedCancel".$i; ?>" id="<?php echo "staffDeactivatedCancel".$i; ?>">ยกเลิก</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div></td>
                        </tr>
                        <?php 
                        }else{ ?>
                          <!-- Activate staff modal button -->
                          <button type="button" class="btn btn-success" data-toggle="modal" data-target="<?php echo "#staffActivated".$i; ?>" id="<?php echo "staffDeact".$i; ?>" name="<?php echo "staffDeact".$i; ?>">เปิดการใช้งาน</button>
                          <!-- Activate staff modal -->
                          <div class="modal fade" id="<?php echo "staffActivated".$i; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo "staffActivated".$i; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">ต้องการที่จะเปิดการใช้งานบัญชีนี้</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body"> 
                                  <center><b>*** หากมั่นใจแล้วโปรดกดตกลง ***</b></center>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" name="staff-activated" id="staff-activated<?php echo $i?>" class="btn btn-dark">ตกลง</button>
                                  <button type="button" class="btn btn-dark" data-dismiss="modal" name="<?php echo "staffActivatedCancel".$i; ?>" id="<?php echo "staffActivatedCancel".$i; ?>">ยกเลิก</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php
                        }
                      }  ?>
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
    </main>
  </div>
  <script>
    $(document).ready(function(){
    $("#stdInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#stdTab tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    });
    $(document).ready(function(){
    $("#staffInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#staffTab tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    });
</script>
</body>
</html>