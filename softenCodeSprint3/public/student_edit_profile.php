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
      $dashboard="dashboard_user.php";
    }else if($_SESSION["role"] == "Student"){
      $dashboard="dashboard_user.php";
    }else{
      $dashboard="dashboard_admin.php";
    }
  }

  // email variable
  $email=$_SESSION['email'];

  //Fetch - user with email from student
  $user = $connect->prepare("
                  SELECT 
                    *
                  FROM 
                      student
                  WHERE 
                       email = '$email'
                   "); 
  $user->execute(); 
  $total_row = $user->rowCount();
  $user = $user->fetch();

  // Update student user profile
  if (isset($_POST['btn-submit-prof'])) {  
    if(strcmp($_POST['fname'], "") == 0){
      $fname = $user['fname'];
    }else{
      $fname = $_POST['fname'];
    } 
    if(strcmp($_POST['lname'], "") == 0){
      $lname = $user['lname'];
    }else{
      $lname = $_POST['lname'];
    }   
    if(strcmp($_POST['mobile'],"") == 0){
      $mobile = $user['mobile'];
    }else{
      $mobile = $_POST['mobile'];
    }
    if(strcmp($_POST['address'],"") == 0){
      $addr = $user['addr'];
    }else{
      $addr = $_POST['address'];
    }
    $year = $user['study_year']-(int)substr($user['stdId'],0,2)+1;
    
    $sql = "UPDATE student SET fname='$fname', lname='$lname', addr='$addr', mobile='$mobile' WHERE email = '$email'";
    $statement = $connect->prepare($sql);
    $statement->execute();
    // Session data
    $_SESSION["fname"] = $fname;
    $_SESSION["lname"] = $lname;
    header("location: student_edit_profile.php?alert=profileSaved");
  }

  // Change staff user password
  if (isset($_POST['btn-submit-pw'])) {    
    $password = $_POST['psw'];
    $repassword = $_POST['repsw'];
    
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    //$specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8 || $password!=$repassword) {
      header("location: student_edit_profile.php?alert=passwordChangedFailed");
    }else{
      if(strcmp($password,$repassword) == 0){
        $sql = "UPDATE student SET password='$password' WHERE email = '$email'";
        $statement = $connect->prepare($sql);
        $statement->execute();
        header("location: student_edit_profile.php?alert=passwordChanged");
      }else{
        header("location: student_edit_profile.php?alert=passwordChangedFailed");
      }
    }
  }
?>
<html>
<head>
    <title>แก้ไขโปรไฟล์ของฉัน</title>
    <!-- Logo -->
    <link rel="shortcut icon" href="../assets/logo/kku-logo.png" />
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
  <?php 
  if($_GET['alert']=="profileSaved"){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5><strong>แจ้งเตือน! </strong>บันทึกข้อมูลสำเร็จ</h5>
          </div>';
  }else if($_GET['alert']=="passwordChanged"){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5><strong>แจ้งเตือน! </strong>เปลี่ยนรหัสผ่านสำเร็จ</h5>
          </div>';
  }else if($_GET['alert']=="passwordChangedFailed"){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5><strong>แจ้งเตือน! </strong>เปลี่ยนรหัสผ่านไม่สำเร็จ</h5>
          </div>';
  }
  ?>
  <!-- Content -->
  <div class="container-fluid">
    <!-- Sidebar -->
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div id="user_detail">
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
              <a class="nav-link active" href="student_edit_profile.php" id="setting" name="setting">
                <img src="../assets/logo/setting.png" width="20" height="20" fill="none" stroke="currentColor" style="margin-left:0px;"> 
                <span style="margin-left:2px;">Edit profile (current)</span>
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
        <h1 class="h2">แก้ไขโปรไฟล์ของฉัน</h1>
      </div>
      <?php
      if($_GET['alert']=="profileSaved"){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5><strong>แจ้งเตือน! </strong>บันทึกข้อมูลสำเร็จ</h5>
              </div>';
      }else if($_GET['alert']=="passwordChanged"){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5><strong>แจ้งเตือน! </strong>เปลี่ยนรหัสผ่านสำเร็จ</h5>
              </div>';
      }else if($_GET['alert']=="passwordChangedFailed"){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5><strong>แจ้งเตือน! </strong>รีเซ็ตรหัสผ่านไม่สำเร็จ</h5>
              </div>';
      }
      ?>
      <center>
      <!-- Edit student profile form -->
      <div class="card" style="width:100%;">
        <div class="card-body">
          <form method="post">
            <table>
              <tr>
                <td><label >รหัสประจำตัวนักศึกษา : </label></td>
                <td><input type="text" name="stdId" id="stdId" class="form-control" value="<?php echo $user['stdId']; ?>" readonly><br></td>
              </tr>
              <tr>
                <td><label >ชื่อ : </label></td>
                <td><div class="form-row" style="width:500px;">
                  <div class="col">
                    <input type="text" name="fname" id="fname"  class="form-control" value="<?php echo $user['fname']; ?>" placeholder="<?php echo $user['fname']; ?>">
                  </div>
                  <div class="col">
                    <input type="text" name="lname" id="lname"  class="form-control" value="<?php echo $user['lname']; ?>" placeholder="<?php echo $user['lname']; ?>">
                  </div>
                </div><br></td>
              </tr>
              <tr>
                <td><label >อีเมล : </label></td>
                <td><input type="text" name="email" id="email" class="form-control" value="<?php echo $user['email']; ?>" readonly><br></td>
              </tr>
              <tr>
                <td><label >ที่อยู่ : </label></td>
                <td><textarea name="address" rows = 5 cols=50 class="form-control" value="<?php echo $user['addr'];?>" placeholder="<?php echo $user['addr'];?>"><?php echo $user['addr'];?></textarea><br></td>
              </tr>
              <tr>
                <td><label >เบอร์โทรศัพท์ : </label></td>
                <td><input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo $user['mobile']; ?>" placeholder="<?php echo $user['mobile']; ?>"><br></td>
              </tr>
              <tr>
                <td><label>ระดับการศึกษา : </label></td>
                <td><input type="text" name="degree" id="degree" class="form-control" value="<?php echo $user['degree']; ?>" readonly><br></td>
              </tr>
              <tr>
                <td><label>ระดับชั้นปี : </label></td>
                <td><input type="text" name="year" id="year" class="form-control" value="<?php echo $user['year']; ?>" readonly><br></td>
              </tr>
              <tr>
                <td><label>หลักสูตร : </label></td>
                <td><input type="text" name="major" id="major" class="form-control" value="<?php echo $user['major']; ?>" readonly><br></td>
              </tr>
              <tr>
                <td><label>สถานะการศึกษา : </label></td>
                <td><input type="text" name="study_status" id="study_status" class="form-control" value="<?php echo $user['study_status']; ?>" readonly><br></td>
              </tr>
            </table>
            <br><br>
            <div id="btn-group" name="btn-group">
            <a href="dashboard_admin.php" type="button" class="btn btn-dark" value="ย้อนกลับ" >ย้อนกลับ</a>

            <!-- Change password modal button -->
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal" id="changePassword" name="changePassword">เปลี่ยนรหัสผ่าน</button>
            <!-- Change password modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">คุณต้องการเปลี่ยนแปลงรหัสผ่านใช่หรือไม่</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Change password form -->
                    <form method="post">
                      <!-- Change password fields -->
                      <div class="container">
                        <table>
                          <tr>
                            <td><label >กรอกรหัสผ่าน <font color=red>*</font>: </label></td>
                            <td><input class="form-control" placeholder="กรุณากรอกรหัสผ่าน" type="password" value="<?php echo $user['password']; ?>" id="psw" name="psw"><br></td>
                          </tr>
                          <tr>
                            <td><label >กรอกรหัสผ่านอีกครั้ง <font color=red>*</font>: </label></td>
                            <td><input type="password" name="repsw" id="repsw" class="form-control" value="<?php echo $user['password']; ?>" placeholder="กรุณากรอกรหัสผ่านอีกครั้ง"><br></td>
                          </tr>
                        </table>
                      </div>
                      <!-- Change password condition check -->
                      <div id="message" align="left">
                        <h4>รหัสผ่านต้องประกอบด้วย:</h4>
                        <p id="letter" class="invalid"><label id="msg1">pass:</label> ต้องประกอบด้วยอักขระ<b>ตัวพิมพ์เล็ก</b></p>
                        <p id="capital" class="invalid"><label id="msg2">pass:</label> ต้องประกอบด้วยอักขระ<b>ตัวพิมพ์ใหญ่</b></p>
                        <p id="number" class="invalid"><label id="msg3">pass:</label> ต้องประกอบด้วย<b>ตัวเลข</b></p>
                        <p id="length" class="invalid"><label id="msg4">pass:</label> รหัสผ่านต้องไม่ต่ำกว่า <b>8 อักขระ</b></p>
                        <p id="recheck" class="invalid"><label id="msg5">pass:</label> รหัสผ่านต้อง<b>ตรงกัน</b></p>
                      </div>
                    <form>
                  </div>
                  <!-- Cancel & Submit-pw button -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal" id="cancel-pw" name="cancel-pw">ยกเลิก</button>
                    <button type="submit" name="btn-submit-pw" id="btn-submit-pw" class="btn btn-dark">เปลี่ยนรหัสผ่าน</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Profile staff edit save modal button -->
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModel" id="save" name="save">บันทึก</button>
            <!-- Profile staff edit save modal -->
            <div class="modal fade" id="myModel" tabindex="-1" role="dialog" aria-labelledby="myModel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myModel">คุณต้องการเปลี่ยนแปลงข้อมูลส่วนตัวใช่หรือไม่</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">   
                    <b>*** หากมั่นใจแล้วโปรดกดบันทึการเปลี่ยนแปลง ***</b>
                  </div>
                  <!-- Cancel & Submit-profile button -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal" id="cancel-prof" name="cancel-prof">ยกเลิกการเปลี่ยนแปลง</button>
                    <button type="submit" name="btn-submit-prof" id="btn-submit-prof" class="btn btn-dark">บันทึกการเปลี่ยนแปลง</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
      </center>
    </main>
  </div>
  <script src="../js/password-validation.js"></script>
</body>
</html>