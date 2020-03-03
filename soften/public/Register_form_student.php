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
    $degree='bachelor';
    $major='no';

    if (isset($_POST['btn-submit'])) {    
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $passcode = $_POST['password'];
        $confirm = $_POST['confirm'];
        $addr = $_POST['address'];
        $mobile = $_POST['mobile'];     
        $stdId = $_POST['stdId'];
        $degree = $_POST['degree'];
        $major = $_POST['major'];  
        $level = $_POST['level']; 


        if($stdId==''){
            $msg0 = '<font color="red" align="left">   กรุณากรอกรหัสนักศึกษา</font>';
        }   
       
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
            $msg4 = '<font color="red" align="left">   กรุณากรอกรหัสผ่านให้ถูกต้อง</font>';
        }     
        if($addr==''){
            $msg5 = '<font color="red" align="left">   กรุณากรอกที่อยู่</font>';
        }    
        if($mobile==''){
            $msg6 = '<font color="red" align="left">   กรุณากรอกเบอร์โทรศัพท์</font>';
        }  
        if($level==''){
            $msg7 = '<font color="red" align="left">   กรุณาระบุฃั้นปี</font>';
        } 
        if($major=='no'){
            $msg8 = '<font color="red" align="left">   กรุณาเลือกสาขา</font>';
        } 

        if($stdId !='' & $fname!='' & $lname!='' & $email!='' & $addr !='' & $mobile != '' & $passcode !='' & $confirm !='' & $passcode == $confirm & $level!=='' & $major!='no'){  
             $sql= "INSERT INTO student(fname,lname,email,passcode,confirm,addr,mobile,stdId,degree,major) 
            VALUES ('$fname', '$lname', '$email', '$passcode', '$confirm', '$addr', '$mobile', '$stdId', '$degree', '$major')";
        
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
    <link rel="shortcut icon" href="../assets/logo/kku-logo.png" />
    <!-- Font -->
    <link href="../css/body-font.css" rel="stylesheet" >
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" >

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
                    <td><input type="text" name="stdId" id="stdId" class="bginput" value="<?php echo $stdId; ?>"><?php echo $msg0; ?><br></td>
                    </tr>
                    <tr>
                    <td><label >ชื่อ <font color=red>*</font>: </label></td>
                    <td><input type="text" name="fname" id="fname"  class="bginput"value="<?php echo $fname; ?>"><?php echo $msg1; ?><br></td>
                    </tr>
                    <tr>
                    <td><label >นามสกุล <font color=red>*</font> :</label></td>
                    <td><input type="text" name="lname" id="lname"  class="bginput" value="<?php echo $lname; ?>"><?php echo $msg2; ?><br></td>
                    </tr>
                    <tr>
                    <tr>
                    <td><label >อีเมล <font color=red>*</font>: </label></td>
                    <td><input type="text" name="email" id="email" class="bginput" value="<?php echo $email; ?>"><?php echo $msg3; ?><br></td>
                    </tr>
                    <tr>
                    <td><label >รหัสผ่าน <font color=red>*</font>: </label></td>
                    <td><input type="password" name="password" id="password" class="bginput" ><br></td>
                    </tr>
                    <tr>
                    <td><label >ยืนยันรหัสผ่าน <font color=red>*</font>: </label></td>
                    <td><input type="password" name="confirm" id="confirm" class="bginput"><?php echo $msg4; ?><br></td>
                    </tr>
                    <tr>
                    <td><label >ที่อยู่ <font color=red>*</font> : </label></td>
                    <td><textarea name="address" rows = 5 cols=50><?php echo $addr; ?></textarea><?php echo $msg5; ?><br></td>
                    </tr>
                    <tr>
                    <td><label > เบอร์โทรศัพท์ <font color=red>*</font> : </label></td>
                    <td><input type="text" name="mobile" id="mobile" class="bginput" value="<?php echo $mobile; ?>"><?php echo $msg6; ?><br></td>
                    </tr>
                
                    <tr>
                    <td><label >ระดับการศึกษา <font color=red>*</font>: </label></td>
                    <td><input type="radio"  name="degree" value="bachelor" <?php if($degree=='bachelor') echo 'checked'; ?>> ปริญญาตรี            
                        <input type="radio"  name="degree" value="master"   <?php if($degree=='master') echo 'checked'; ?>> ปริญญาโท
                        <input type="radio"  name="degree" value="doctor" <?php if($degree=='doctor') echo 'checked'; ?>> ปริญญาเอก <br></td>
                    </tr>
                    <tr>
                    <td><label >ระดับชั้นปี <font color=red>*</font> : </label></td>
                    <td><input type="text" name="level" id="level" class="bginput" value="<?php echo $level; ?>"><?php echo $msg7; ?><br></td>
                    </tr>
                    <tr>
                    <td><label >หลักสูตร <font color=red>*</font>:</label></td>
                    <td><select name="major" id="major">
                        <option value="no" <?php  if($major=='no') echo 'selected'; ?>><-- โปรดเลือกหลักสูตร --></option>
                        <option value="CS" <?php  if($major=='CS') echo 'selected'; ?> >วิทยาการคอมพิวเตอร์ </option>
                        <option value="IT" <?php  if($major=='IT') echo 'selected'; ?>>เทคโนโลยีสารสนเทศ </option>
                        <option value="GIS" <?php  if($major=='GIS') echo 'selected'; ?> > ภูมิสารสนเทสศาสตร์</option></select> <?php echo $msg8; ?>
                    </tr>
                
                </table>
                <br><br>
                    <a href="Register_status.php" type="button" class="btn btn-dark" value="ย้อนกลับ" >ย้อนกลับ</a>
                    <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-dark">ลงทะเบียน</button>
            </form>
            </div>
            </div>
        <div></center>
</body>
</html>