<?php 
  include('../config/database_connection.php');
  session_start();

  // Condition in order to see a page
  if($_SESSION['email'] == ""){
    header("location: ../index.php");
    exit();
  }else{
    // Role check
    if($_SESSION["role"] == "Admin"){
      $dashboard="dashboard_admin.php";
    }else{
      header("location: ../index.php");
      exit();
    }
  }

  // email variable
  $stdId = $_GET['stdId'];

  // Fetch - user with email
  $user = $connect->prepare("
                  SELECT 
                    *
                  FROM 
                      student
                  WHERE 
                      stdId = '$stdId'
                   "); 
  $user->execute(); 
  $total_row = $user->rowCount();
  $user = $user->fetch();

  // Update student user profile
  if (isset($_POST['btn-submit-prof'])) {  
    
    if(strcmp($_POST['stdId'], "") == 0){
      $newStdId = $user['stdId'];
    }else{
      $newStdId = $_POST['stdId'];
    } 
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
    if(strcmp($_POST['email'], "") == 0){
      $email = $user['email'];
    }else{
      $email = $_POST['email'];
    }  
    if(strcmp($_POST['mobile'],"") == 0){
      $mobile = $user['mobile'];
    }else{
      $mobile = $_POST['mobile'];
    }
    if(strcmp($_POST['year'],"") == 0){
      $year = $user['year'];
    }else{
      $year = $_POST['year'];
    }
    if(strcmp($_POST['address'],"") == 0){
      $addr = $user['addr'];
    }else{
      $addr = $_POST['address'];
    }
    $study_status = $_POST['study_status'];

    if(strcmp($study_status,"กำลังศึกษาอยู่") == 0){
      $sql = "UPDATE student SET permissionId=2 WHERE stdId = '$stdId'";
      $statement = $connect->prepare($sql);
      $statement->execute();
    }else{
      $sql = "UPDATE student SET permissionId=3 WHERE stdId = '$stdId'";
      $statement = $connect->prepare($sql);
      $statement->execute();
    }

    //course update
    if(strcmp($_POST['courseId'], "false") != 0){
      $courseId = (int)$_POST['courseId'];
      $query = "SELECT degree,major FROM course WHERE courseID = $courseId;";
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetch();
      $degree = $result['degree'];
      $major = $result['major'];

      $sql = "UPDATE student SET stdId='$newStdId',fname='$fname', lname='$lname', addr='$addr', email='$email', mobile='$mobile', year='$year', study_status='$study_status', degree='$degree',major='$major', alert=1 WHERE stdId = '$stdId'";
    }else{
      $sql = "UPDATE student SET stdId='$newStdId',fname='$fname', lname='$lname', addr='$addr', email='$email', mobile='$mobile', year='$year', study_status='$study_status', alert=1 WHERE stdId = '$stdId'";
    }

    $statement = $connect->prepare($sql);
    $statement->execute();

    if(!isset($sql)){
      die ("Error $sql" .mysqli_connect_error());
    }else{
      header("location: student_edit_profile_by_admin.php?stdId=$newStdId&alert=profileSaved"); 
    }
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

    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
      header("location: student_edit_profile_by_admin.php?stdId=$stdId&alert=passwordChangedFailed");
    }else{
      if(strcmp($password,$repassword) == 0){
        $sql = "UPDATE student SET password='$password', alert=1 WHERE stdId = '$stdId'";
        $statement = $connect->prepare($sql);
        $statement->execute();
        header("location: student_edit_profile_by_admin.php?stdId=$stdId&alert=passwordChanged");
      }else{
        header("location: student_edit_profile_by_admin.php?stdId=$stdId&alert=passwordChangedFailed");
      }
    }
  }
?>
<html>
<head>
    <title>แก้ไขโปรไฟล์นักศึกษา</title>
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
              <a class="nav-link" href="<?php echo $dashboard;?>" id="setting" name="setting">
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
        <h1 class="h2">แก้ไขโปรไฟล์นักศึกษา</h1>
      </div>
      <?php
      if($_GET['alert']=="profileSaved"){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5><strong>แจ้งเตือน! </strong>บันทึกข้อมูลสำเร็จ</h5>
              </div>';
      }else if($_GET['alert']=="passwordChanged"){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5><strong>แจ้งเตือน! </strong>รีเซ็ตรหัสผ่านสำเร็จ</h5>
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
                <td><input type="text" name="stdId" id="stdId" class="form-control" value="<?php echo $user['stdId']; ?>"><br></td>
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
                <td><input type="email" name="email" id="email" class="form-control" value="<?php echo $user['email']; ?>"><br></td>
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
                <?php 
                    // Fetch - user with email
                    $course = $connect->prepare("
                    SELECT 
                        *
                    FROM 
                        course
                    "); 
                    $course->execute(); 
                    $total_row = $course->rowCount();
                    $course = $course->fetchAll();
                    ?>
                    <td>
                      <select name="courseId" id="courseId" class="form-control">
                        <option id="courseId0" value="false" ><?php echo $user["degree"]." : ".$user['major']; ?> (ถูกเลือก)</option>
                        <?php if($total_row > 0) {
                            foreach($course as $row){
                                echo '<option id="courseId'.$row['courseID'].'" value="'.$row['courseID'].'">'.$row["degree"]." : ".$row['major'].'</option>';     
                            }
                        }
              ?></select><br></td>
              </tr>
              <tr>
                <td><label>ระดับชั้นปี : </label></td>
                <td><input type="text" name="year" id="year" class="form-control" value="<?php echo $user['year']; ?>"><br></td>
              </tr>
              <tr>
                <td><label>สถานะการศึกษา : </label></td>
                <td>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline1" name="study_status" value="กำลังศึกษาอยู่" class="custom-control-input" <?php if(strcmp($user['study_status'],"กำลังศึกษาอยู่") == 0){ echo "checked"; } ?>>
                  <label class="custom-control-label" for="customRadioInline1">กำลังศึกษาอยู่</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline2" name="study_status" value="จบการศึกษา" class="custom-control-input" <?php if(strcmp($user['study_status'],"จบการศึกษา") == 0){ echo "checked"; } ?>>
                  <label class="custom-control-label" for="customRadioInline2">จบการศึกษา</label>
                </div>
                </td>
              </tr>
            </table>
            <br><br>
            <div id="btn-group" name="btn-group">
            <a href="user_manager.php" type="button" class="btn btn-dark" id="back" value="ย้อนกลับ" >ย้อนกลับ</a>

            <!-- Change password modal button -->
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal" id="changePassword" name="changePassword">รีเซ็ตรหัสผ่าน</button>
            <!-- Change password modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">คุณต้องการรีเซ็ตรหัสผ่านใช่หรือไม่</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Change password form -->
                    <form method="post">
                      <!-- Change password fields -->
                      <div class="container">
                        <h5><b>รหัสผ่านจะถูกรีเซ็ตเป็น : borrowCS123</b></h5><b>***สามารถแก้ไขเอง***<b><br><br>
                        <table>
                          <tr>
                            <td><label >กรอกรหัสผ่าน <font color=red>*</font>: </label></td>
                            <td><input class="form-control" placeholder="กรุณากรอกรหัสผ่าน" type="password" value="borrowCS123" id="psw" name="psw"><br></td>
                          </tr>
                          <tr>
                            <td><label >กรอกรหัสผ่านอีกครั้ง <font color=red>*</font>: </label></td>
                            <td><input type="password" name="repsw" id="repsw" class="form-control" value="borrowCS123" placeholder="กรุณากรอกรหัสผ่านอีกครั้ง"><br></td>
                          </tr>
                        </table>
                      </div>
                      <!-- Change password condition check -->
                      <div id="message" align="left">
                        <h4>รหัสผ่านต้องประกอบด้วย:</h4>
                        <p id="letter" class="invalid">ต้องประกอบด้วยอักขระ<b>ตัวพิมพ์เล็ก</b></p>
                        <p id="capital" class="invalid">ต้องประกอบด้วยอักขระ<b>ตัวพิมพ์ใหญ่</b></p>
                        <p id="number" class="invalid">ต้องประกอบด้วย<b>ตัวเลข</b></p>
                        <p id="length" class="invalid">รหัสผ่านต้องไม่ต่ำกว่า <b>8 อักขระ</b></p>
                        <p id="recheck" class="invalid">รหัสผ่านต้อง<b>ตรงกัน</b></p>
                      </div>
                    <form>
                  </div>
                  <!-- Cancel & Submit-pw button -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal" id="cancel-pw" name="cancel-pw">ยกเลิก</button>
                    <button type="submit" name="btn-submit-pw" id="btn-submit-pw" class="btn btn-dark">รีเซ็ตรหัสผ่าน</button>
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