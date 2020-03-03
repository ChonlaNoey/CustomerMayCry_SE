<!DOCTYPE html>
<?php  
    $status = $_POST['status'];
        
    if (isset($_POST['btn-submit'])) {    
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

<div style="padding-top:200px;"><center>
    <div class="card border-success mb-3" style="width:70% ; height:40%;">
        <div class="card-header bg-transparent border-success"><h3>ระบบลงทะเบียน</h3></div>
        <div class="card-body text-success">
        <form method="post"> 
         <fieldset style="width:70% ; height:250px">
         <legend><h2>ระบุสถานะของผู้สมัคร </h2></legend>
           <table><tr><td>
          
                <label>
                 <input type="radio"  name="status" value="staff"><br><br></td><td> บุคลากร <br><br> </td></tr>
             <tr><td>           
                 <input type="radio"  name="status" value="student" checked><br><br></td><td> นักศึกษา <br><br></td></tr>
                </label>
          </table>            
          <br><br>
              <a href="../index.php" class="btn btn-success"  name="btn-back" id="btn-back"><span class="glyphicon glyphicon-chevron-right"> </span><-- ยกเลิก </a>
              <button type="submit" class="btn btn-success"  name="btn-submit" id="btn-submit">
              <span class="glyphicon glyphicon-chevron-right"> </span>
              ถัดไป -->> </button>
         </fieldset>
          </form>
    </div>
</center></div>

</body>
</html>