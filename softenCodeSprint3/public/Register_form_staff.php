<!DOCTYPE html>
<?php   include('../config/database_connection.php');
    $msg1=''; 
    $msg2='';  
    $msg3=''; 
    $msg4='';  
    $msg5=''; 
    $msg6='';  
    $msg7='';
    $msg8='';

    if (isset($_POST['btn-submit'])) {    
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $passcode = $_POST['password'];
        $confirm = $_POST['confirm'];
        $addr = $_POST['address'];
        $mobile = $_POST['mobile'];     
        $work = (int)$_POST['work'];   

        if($fname==''){
            $msg1 = '<font color="red" align="left">   กรุณากรอกชื่อ</font>';
        }   
        if($lname==''){
            $msg2 = '<font color="red" align="left">   กรุณากรอกนามสกุล</font>';
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
                $msg5 = '<font color="red" align="left">   รหัสผ่านไม่ตรงกัน</font>';
            }
            
        }
        
        if($addr==''){
            $msg6 = '<font color="red" align="left">   กรุณากรอกที่อยู่</font>';
        }    
        if($mobile==''){
            $msg7 = '<font color="red" align="left">   กรุณากรอกเบอร์โทรศัพท์</font>';
        }  
        if($work=='0'){
            $msg8 = '<font color="red" align="left">   กรุณาเลือกตำแหน่งงาน</font>';
        }
        if($fname!='' & $lname!='' & $email!='' & $addr !='' & $mobile != '' & $passcode !='' & $confirm !='' & ($passcode != '') == $confirm & $work!='0' ){        
        
            $sql= "INSERT INTO staff(fname,lname,email,password,addr,mobile,positionId) 
            VALUES ('$fname', '$lname', '$email', '$passcode', '$addr', '$mobile', $work)";
        
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
    <title>ลงทะเบียนสำหรับบุคลากร</title>
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
</head>
    <body data-gr-c-s-loaded="true">
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" >
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#" align="center" style="color:white;">ระบบยืมคืน-อุปกรณ์</a>
        </nav>
        <center><div style="width: 1000px; height:auto; margin-top:150px;">
        <h3>ลงทะเบียนสำหรับบุคลากร</h3><br>
        <div class="card">
            <div class="card-body">
            <form method="post">
            <table>
                <tr>
                    <td><label >ชื่อ <font color=red>*</font>: </label></td>
                    <td><?php echo $msg1." ".$msg2; ?>
                    <div class="form-row" style="width:500px;">
                    <div class="col">
                        <input type="text" name="fname" id="fname"  class="form-control" placeholder="กรุณากรอกชื่อ">
                    </div>
                    <div class="col">
                        <input type="text" name="lname" id="lname"  class="form-control" placeholder="กรุณากรอกนามสกุล">
                    </div>
                    </div><br></td><br>
                    </td>
                </tr>
                <tr>
                <tr>
                <td><label >อีเมล <font color=red>*</font>: </label></td>
                <td><?php echo $msg3; ?><input type="email" name="email" id="email" class="form-control" placeholder="กรุณากรอกอีเมล"><br></td>
                </tr>
                <tr>
                <td><label >รหัสผ่าน <font color=red>*</font> : </label></td>
                <td><?php echo $msg4; ?><input type="password" name="password" id="password" class="form-control" placeholder="กรุณากรอกรหัสผ่าน"><br></td>
                </tr>
                <tr>
                <td><label >ยืนยันรหัสผ่าน <font color=red>*</font>: </label></td>
                <td><?php echo $msg5; ?><input type="password" name="confirm" id="confirm" class="form-control" placeholder="กรุณากรอกรหัสผ่านอีกครั้ง"><br></td>
                </tr>
                <tr>
                <td><label >ที่อยู่ <font color=red>*</font> : </label></td>
                <td><?php echo $msg6; ?><textarea name="address" rows = 5 cols=50 class="form-control" placeholder="กรุณากรอกที่อยู่"></textarea><br></td>
                </tr>
                <tr>
                <td><label >เบอร์โทรศัพท์ <font color=red>*</font>: </label></td>
                <td><?php echo $msg7; ?><input type="text" name="mobile" id="mobile" class="form-control" placeholder="กรุณากรอกเบอร์โทรศัพท์ เช่น 0123456789"><br></td>
                </tr>
                <tr>
                    <td><label >ตำแหน่งงาน <font color=red>*</font>: </label><br></td>
                    <?php 
                    // Fetch - user with email
                    $position = $connect->prepare("
                    SELECT 
                        *
                    FROM 
                        position
                    "); 
                    $position->execute(); 
                    $total_row = $position->rowCount();
                    $position = $position->fetchAll();
                    ?>
                    <td><?php echo $msg8;?><select name="work" id="work" class="form-control">
                        <option value=""><-- โปรดเลือก --></option>
                        <?php if($total_row > 0) {
                            foreach($position as $row){
                                echo '<option name="work'.$row['positionId'].'" id="work'.$row['positionId'].'" value="'.$row['positionId'].'">'.$row['position_th'].'</option>';     
                            }
                        }
                        ?></td>
                </tr>
            </table>
            <br><br>
                <a href="Register_status.php" type="button" class="btn btn-dark" value="ย้อนกลับ" >ย้อนกลับ</a>

                <!-- Register staff save modal button -->
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#regisStaffModel" id="regisstaff" name="regisstaff">ลงทะเบียน</button>
                <!-- Register staff save modal -->
                <div class="modal fade" id="regisStaffModel" tabindex="-1" role="dialog" aria-labelledby="regisStaffModel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="regisStaffModel">คุณต้องการสมัครสมาชิกใช่หรือไม่</h5>
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