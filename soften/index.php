<?php
    include('config/database_connection.php');
    session_start();
    $msg = '';
    if (isset($_POST['btn-submit'])) {    
        $status = $_POST['status'];
        $email = $_POST['email'];
        $passcode = $_POST['password'];

      if($status=="staff"){
        $query = $connect->prepare("SELECT * FROM staff WHERE email = ? and password = ?");
        $query->bindParam(1, $email);
        $query->bindParam(2, $passcode);
        $query->execute();
        $result = $query->fetch();
        
        if(!empty($result)){
          $msg = '<font color="green" align="left">เข้าสู่ระบบสำเร็จ</font>';
          // Session data
          $_SESSION["fname"] = $result['fname'];
          $_SESSION["lname"] = $result['lname'];
          $_SESSION["email"] = $result['email'];
          $_SESSION["role"] = $result["role"];
          session_write_close();
          if($_SESSION["role"] == "Staff"){
            header("location: public/dashboard_user.php");  
          }else{
            header("location: public/dashboard_admin.php"); 
          }
        }else{
          $msg = '<font color="red" align="left">อีเมลหรือรหัสผ่านไม่ถูกต้อง</font>';
        }
      }else{
        $query = $connect->prepare("SELECT * FROM student WHERE email = ? and password = ?");
        $query->bindParam(1, $email);
        $query->bindParam(2, $passcode);
        $query->execute();
        $result = $query->fetch();

        if(!empty($result)){
          $msg = '<font color="green" align="left">เข้าสู่ระบบสำเร็จ</font>';
          // Session data
          $_SESSION["fname"] = $result['fname'];
          $_SESSION["lname"] = $result['lname'];
          $_SESSION["email"] = $result['email'];
          $_SESSION["stdId"] = $result['stdId'];
          $_SESSION["role"] = "Student";
          session_write_close();
          header("location: public/dashboard_user.php");    
        }else{
          $msg = '<font color="red" align="left">อีเมลหรือรหัสผ่านไม่ถูกต้อง</font>';
        }  
      }
    }
?>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>เข้าสู่ระบบ</title>
    <!-- Logo -->
    <link rel="shortcut icon" href="assets/logo/kku-logo.png" />
    <!-- Font -->
    <link href="css/body-font.css" rel="stylesheet" >
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  <style></style></head>
  <body class="text-center" data-gr-c-s-loaded="true">
  <form  name="formlogin" action="#" method="POST" id="login" class="form-signin">
  <img class="mb-4" src="assets/logo/kku-logo.png" alt="" width="250" height="200">
  <table style="width:100%; height:70px" bgcolor="gray"><tr><td>
         <center>สถานะเข้าสู่ระบบ :  </center></td><td> 
         <center><input type="radio"  name="status" value="staff">บุคลากร  </center></td><td>    
         <center><input type="radio"  name="status" value="student" checked> นักศึกษา</center></td></tr>
  </table><br>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="text"  name="email" class="form-control" required placeholder="อีเมล" />
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" name="password" class="form-control" required placeholder="รหัสผ่าน" />
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> จดจำข้อมูล <a href="public/Register_status.php" > ลงทะเบียน </a>
    </label><br>
    <?php echo $msg; ?>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit" id="btn-submit" name="btn-submit">เข้าสู่ระบบ</button>
  <p class="mt-5 mb-3 text-muted">© 2019</p>
</form>

</body></html>