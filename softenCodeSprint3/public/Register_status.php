<!DOCTYPE html>
<?php  
        
    if (isset($_POST['btn-submit'])) {    
      $status = $_POST['status'];
           if($status=="student"){
             header("location: Register_form_student.php");             
            }else{
             header("location: Register_form_staff.php");  
        }
    }
?>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>ระบุสถานะลงทะเบียน</title>
    <link rel="shortcut icon" href="../assets/logo/kku-logo.png" />
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
    <div style="padding-top:200px;"><center>
      <div class="card bg-light mb-3" style="width:70% ; height:40%;">
        <div class="card-body border-success"><h2><b>ลงทะเบียนใช้งาน</b></h2></div>
        <div class="card-body ">
        <form method="post"> 
         <fieldset style="width:70% ; height:250px">
         <legend><h4>ระบุสถานะของผู้สมัคร </h4></legend>
           <table><tr><td>
                <label>
                 <input type="radio"  name="status" id="staff" value="staff"><br><br></td><td> บุคลากร <br><br> </td></tr>
             <tr><td>           
                 <input type="radio"  name="status" id="student" value="student" checked><br><br></td><td> นักศึกษา <br><br></td></tr>
                </label>
          </table>            
          <br><br>
              <a href="../index.php" class="btn btn-dark"  name="btn-back" id="btn-back"><span class="glyphicon glyphicon-chevron-right"> </span><-- ยกเลิก </a>
              <button type="submit" class="btn btn-dark"  name="btn-submit" id="btn-submit">
              <span class="glyphicon glyphicon-chevron-right"> </span>
              ถัดไป --> </button>
         </fieldset>
        </form>
    </div>
</center></div>

</body>
</html>

