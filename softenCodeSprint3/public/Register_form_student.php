<!DOCTYPE html>
<?php
    include('../config/database_connection.php');
    $msg0='';
    $msg1=''; 
    $msg2='';  
    $msg3=''; 
    $msg4='';  
    $msg5=''; 
    $msg6='';  
    $msg7='';  
    $msg8=''; 
    $msg9='';
    $degree='no';
    $major='no';
    $course='no';

    if (isset($_POST['btn-submit'])) {    
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $passcode = $_POST['password'];
        $confirm = $_POST['confirm'];
        $addr = $_POST['address'];
        $mobile = $_POST['mobile'];     
        $stdId = $_POST['stdId'];
        $course = $_POST['course'];      
        $level = $_POST['level']; 


        if($stdId==''){
            $msg0 = '<font color="red" align="left">   กรุณากรอกรหัสนักศึกษา</font>';
        }   
       
        if($fname==''){
            $msg1 = '<font color="red" align="left">   กรุณากรอกฃื่อ</font>';
        }   
        if($lname==''){
            $msg2 = '<font color="red" align="left">   กรุณากรอกนามสกุุล</font>';
        }    
        if($email==''){
            $msg3 = '<font color="red" align="left">   กรุณากรอกอีเมล</font>';
        } 
        if($passcode==''||$confirm==''||$passcode!=$confirm){
            // Validate password strength
            $uppercase = preg_match('@[A-Z]@', $passcode);
            $lowercase = preg_match('@[a-z]@', $passcode);
            $number    = preg_match('@[0-9]@', $passcode);
            //$specialChars = preg_match('@[^\w]@', $password);

            if(!$uppercase || !$lowercase || !$number || strlen($passcode) < 8) {
                $msg4 = '<font color="red" align="left">   รหัสผ่านต้องประกอบด้วย อักษรตัวพิมพ์เล็ก ตัวพิมพ์ใหญ่ และตัวเลข 8 อักขระขึ้นไป</font>';
            }
            if($password != $confirm){
                $msg9 = '<font color="red" align="left">   รหัสผ่านไม่ตรงกัน</font>';
            }
            
        }     
        if($addr==''){
            $msg5 = '<font color="red" align="left">   กรุณากรอกที่อยู่</font>';
        }    
        if($mobile==''){
            $msg6 = '<font color="red" align="left">   กรุณากรอกเบอร์โทรศัพท์</font>';
        }  
        if($level==''){
            $msg8 = '<font color="red" align="left">   กรุณาระบุชั้นปี</font>';
        } 
        if($course=='no'){
            $msg7 = '<font color="red" align="left">   กรุณาเลือกระดับการศึกษา</font>';
        } else {
           
            $query = "SELECT degree,major FROM course WHERE courseID = '$course';";
            $statement = $connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach($result as $row)
            { $degree = $row['degree'];
              $major = $row['major'];
            }            
        }

        if($stdId !='' & $fname!='' & $lname!='' & $email!='' & $addr !='' & $mobile != '' & $passcode !='' & $confirm !='' & $passcode == $confirm & $level!=='' & $major!='no'& $degree!='no'){  
             $sql= "INSERT INTO student(stdId,email,password,fname,lname,addr,degree,major,year,edu_year,study_status,mobile) 
            VALUES ('$stdId','$email','$passcode','$fname', '$lname', '$addr', '$degree', '$major', '$level', '62', 'กำลังศึกษาอยู่', '$mobile')";
        
            $statement = $connect->prepare($sql);
            $statement->execute();
        
            if(!isset($sql)){
                 die ("Error $sql" .mysqli_connect_error());
            }else{
                header("location: ../index.php");  
             }
         }
    }
?>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>ลงทะเบียนสำหรับนักศึกษา</title>
    <!-- Logo -->
    <link rel="shortcut icon" href="../assets/logo/kku-logo.png" />
    <!-- Font -->
    <link href="../css/body-font.css" rel="stylesheet" >
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" >
    <script src="../js/jquery-3.4.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
    <!-- Custom script -->
    <script src="../js/modal.js"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
  <style></style><style type="text/css">/* Chart.js */
    @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>
    <body data-gr-c-s-loaded="true">
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" >
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#" align="center" style="color:white;">ระบบยืมคืน-อุปกรณ์</a>
        </nav>
        <center><div style="width: 1000px; height:auto; margin-top:150px;">
        <h3>ลงทะเบียนสำหรับนักศึกษา</h3><br>
        <div class="card">
            <div class="card-body">
            <form method="post"> 
                <table>
                    <tr>
                    <td><label >รหัสนักศึกษา <font color=red>*</font>: </label></td>
                    <td><?php echo $msg0; ?><input type="text" name="stdId" id="stdId" class="form-control" placeholder="กรุณากรอกรหัสนักศึกษา" value="<?php echo $stdId; ?>"><br></td>
                    </tr>
                    <tr>
                    <td><label >ชื่อ <font color=red>*</font>: </label></td>
                    <td><?php echo $msg1; ?><input type="text" name="fname" id="fname"  class="form-control" placeholder="กรุณากรอกชื่อ" value="<?php echo $fname; ?>"><br></td>
                    </tr>
                    <tr>
                    <td><label >นามสกุล <font color=red>*</font> :</label></td>
                    <td><?php echo $msg2; ?><input type="text" name="lname" id="lname"  class="form-control" placeholder="กรุณากรอกนามสกุล" value="<?php echo $lname; ?>"><br></td>
                    </tr>
                    <tr>
                    <tr>
                    <td><label >อีเมล <font color=red>*</font>: </label></td>
                    <td><?php echo $msg3; ?><input type="text" name="email" id="email" class="form-control" placeholder="กรุณากรอกอีเมล" value="<?php echo $email; ?>"><br></td>
                    </tr>
                    <tr>
                    <td><label >รหัสผ่าน <font color=red>*</font>: </label></td>
                    <td><?php echo $msg4; ?><input type="password" name="password" id="password" class="form-control" placeholder="กรุณากรอกรหัสผ่าน" ><br></td>
                    </tr>
                    <tr>
                    <td><label >ยืนยันรหัสผ่าน <font color=red>*</font>: </label></td>
                    <td><?php echo $msg9; ?><input type="password" name="confirm" id="confirm" class="form-control" placeholder="กรุณากรอกรหัสผ่านอีกครั้ง" ><br></td>
                    </tr>
                    <tr>
                    <td><label >ที่อยู่ <font color=red>*</font> : </label></td>
                    <td><?php echo $msg5; ?><textarea name="address" rows = 5 cols=50 class="form-control" placeholder="กรุณากรอกที่อยู่" ><?php echo $addr; ?></textarea><br></td>
                    </tr>
                    <tr>
                    <td><label > เบอร์โทรศัพท์ <font color=red>*</font> : </label></td>
                    <td><?php echo $msg6; ?><input type="text" name="mobile" id="mobile" class="form-control" placeholder="กรุณากรอกเบอร์โทรศัพท์ เช่น 0123456789" value="<?php echo $mobile; ?>"><br></td>
                    </tr>
                
                    <tr>
                    <td><label >ระดับการศึกษา <font color=red>*</font>: </label></td>
                    <td><?php echo $msg7; ?><select name="course" id="course" class="form-control">
                    <option value='no' <?php  if($course=='no') echo 'selected'; ?>><-- กรุณาเลือก --></option>
                    <?php
                    $query = "SELECT DISTINCT * FROM course";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                ?> 
                <option id="course<?php echo $row['courseID'];?>" value="<?php echo $row['courseID'];?>" <?php  if($course==$row['courseID']) echo 'selected'; ?>><?php echo $row["degree"]." : ".$row['major'];?></option>
                    <?php
                    }
                ?>
                       </select> <br></td>
                    </tr>
                    <tr>
                    <td><label >ระดับชั้นปี <font color=red>*</font> : </label></td>
                    <td><?php echo $msg8; ?><input type="text" name="level" id="level" class="form-control" placeholder="กรุณากรอกระดับชั้นปี" value="<?php echo $level; ?>"><br></td>
                    </tr>
                    
                
                </table>
                <br><br>
                    <a href="Register_status.php" type="button" class="btn btn-dark" value="ย้อนกลับ" >ย้อนกลับ</a>

                    <!-- Register student save modal button -->
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#regisStudentModel" id="regisstudent" name="regisstudent">ลงทะเบียน</button>
                    <!-- Register student save modal -->
                    <div class="modal fade" id="regisStudentModel" tabindex="-1" role="dialog" aria-labelledby="regisStudentModel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="regisStudentModel">คุณต้องการสมัครสมาชิกใช่หรือไม่</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">   
                                <b>*** ส่งคำขอสมัครสมาชิก ระบบจะอนุมัติภายใน 3 วัน ***</b>
                                </div>
                                <!-- Cancel & Submit- Staff button -->
                                <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">ยกเลิก</button>
                                <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-dark">ยืนยัน</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
            </div>
            </div>
        <div></center>
</body>
</html>