<!DOCTYPE html>
<?php
    include('../config/database_connection.php');
    $genID='';
    $lastID =0;
    $lastgenID='';
    $startID = '';
    $msg1=''; 
    $msg2='';  
    $msg3=''; 
    $msg4='';  
    $msg5=''; 
    $msg6='';
    $msg7='';  
    $msg8='';
    $status ='01';
    $equipmentID='';
    

   

    if (isset($_POST['btn-genID'])) {    
        $equipmentName = $_POST['equipment_name'];
        $year = $_POST['year'];
        $faculty = $_POST['faculty'];
        $category = $_POST['category'];
        $subcategory = $_POST['subcategory'];
        $quantity = $_POST['quantity'];
      

        if($equipmentName==''){
            $msg1 = '<font color="red" align="left">   กรุณากรอกฃื่อครุภัณฑ์</font>';
        }   
        if($year==''){
            $msg2 = '<font color="red" align="left">   กรุณากรอกปีงบประมาณ</font>';
        }    
        if($faculty=='0'){
            $msg3 = '<font color="red" align="left">   กรุณาระบุคณะ</font>';
        } 
        if($category=='0'){
            $msg4 = '<font color="red" align="left">   กรุณาระบุประเภทครุภัณฑ์</font>';
        }     
        if($subcategory=='-1'){
            $msg5 = '<font color="red" align="left">   กรุณาระบุประเภทครุภัณฑ์ย่อย</font>';
        }    
        if($quantity==''){
            $msg6 = '<font color="red" align="left">   กรุณากรอกจำนวน</font>';
        }  
        
        if($equipmentName !='' & $year !='' & $faculty!='0' & $category!='0' & $subcategory!='-1' & $quantity!=''){
        // genID
        $genID = substr($year,-2).$faculty.$category.$subcategory;

        $query = "SELECT lastCode FROM generateID WHERE groupID LIKE '$genID%';";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row)
        { $lastID = $row['lastCode'];}

        if($lastID ==0){            
            $sql= "INSERT INTO generateid(groupID,lastCode) VALUES ('$genID', '0')";        
            $statement = $connect->prepare($sql);
            $statement->execute();
            $lastID = 0;
        }           
           
        
        
        $lastID = $lastID + 1;
        
        if($lastID <10){
            $lastID = '000'.$lastID;
        }elseif ($lastID <100){
            $lastID = '00'.$lastID;
        }elseif ($lastID <1000){
            $lastID = '0'.$lastID;
        }
          
        $startID = $genID.$lastID;
        
        if($quantity >1){
            $lastgenID = $lastID + $quantity -1 ;
            if($lastgenID <10){
                $lastgenID = '000'.$lastgenID;
            }elseif ($lastgenID <100){
                $lastgenID = '00'.$lastgenID;
            }elseif ($lastID <1000){
                $lastgenID = '0'.$lastgenID;
            }
            else {
                $lastgenID = $lastgenID;
            }
            $lastgenID = $genID.$lastgenID;
            $genID =$startID.'  -  '.$lastgenID;
        }else{
            $genID = $startID;
        } 
        $equipmentID=$genID;     
      }    
    }
    // insert data base
    if (isset($_POST['btn-submit'])) {    
        $equipmentName = $_POST['equipment_name'];
        $year = $_POST['year'];
        $faculty = $_POST['faculty'];
        $category = $_POST['category'];
        $subcategory = $_POST['subcategory'];
        $quantity = $_POST['quantity'];
        $status ='01';
        $location = $_POST['location'];
        $detail = $_POST['detail'];
        $equipmentID =$_POST['equipment_id'];      
        
        
        if($equipmentName==''){
            $msg1 = '<font color="red" align="left">   กรุณากรอกฃื่อครุภัณฑ์</font>';
        }   
        if($year==''){
            $msg2 = '<font color="red" align="left">   กรุณากรอกปีงบประมาณ</font>';
        }    
        if($faculty=='0'){
            $msg3 = '<font color="red" align="left">   กรุณาระบุคณะ</font>';
        } 
        if($category=='0'){
            $msg4 = '<font color="red" align="left">   กรุณาระบุประเภทครุภัณฑ์</font>';
        }     
        if($subcategory=='-1'){
            $msg5 = '<font color="red" align="left">   กรุณาระบุประเภทครุภัณฑ์ย่อย</font>';
        }    
        if($quantity==''){
            $msg6 = '<font color="red" align="left">   กรุณากรอกจำนวน</font>';
        }  
                
        if($location=='0'){
            $msg7 = '<font color="red" align="left">   กรุณาระบุสถานที่</font>';
        }    
        if($equipmentID==''){
            $msg8= '<font color="red" align="left">   กรุณากดขอรหัสก่อน</font>';
        }
        if($location!='0'){
            
            $equipmentID=substr($equipmentID,0,13);
            $genID = substr($equipmentID,0,9);
            $running = substr($equipmentID,-4);

            for($i=0; $i<$quantity;$i++){
                $sql= "INSERT INTO equipment(equipment_id,equipName_th,equipName_en,budget_year,factID,categoryID,subcategoryID,locationID,statusID,equipInfo_th,equipInfo_en) 
                VALUES ('$equipmentID', '$equipmentName', '', '$year', '$faculty', '$category', '$subcategory','$location','$status','$detail','')";        
                $statement = $connect->prepare($sql);
                $statement->execute();
                $running++;
                if($running <10){
                    $running = '000'.$running;
                }elseif($running <100){
                    $running = '00'.$running;
                } elseif($running <1000){
                    $running = '0'.$running;
                }  
                $equipmentID = $genID.$running;
            }
            $running--;
            $sql ="UPDATE generateid SET lastCode ='$running' WHERE groupID='$genID'";
           // $sql= "INSERT INTO generateid(groupID,lastCode) VALUES ('$genID', '$quantity')";        
            $statement = $connect->prepare($sql);
            $statement->execute();
            
            
            if(!isset($sql)){
                die ("Error $sql" .mysqli_connect_error());
             }else{
                 header("location: admin_list.php");  
             }
        }
    }

?>

<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>เพิ่มครุภัณฑ์</title>
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
        <h3>เพิ่มครุภัณฑ์</h3><br>
        <div class="card">
            <div class="card-body">
            <form method="post">
            <table>
                <tr>
                <td><label >ชื่อครุภัณฑ์ <font color=red>*</font>: </label></td>
                <td><input type="text" name="equipment_name" id="equipment_name"  class="bginput" value="<?php echo $equipmentName; ?>"><?php echo $msg1; ?><br></td>
                </tr>
               
                <tr>
                <td><label >ปีงบประมาณ <font color=red>*</font>:</label></td>
                <td><input type="text" name="year" id="year"  class="bginput" value="<?php echo $year; ?>"><?php echo $msg2; ?><br></td>
                </tr>
                <tr>
                <td><label >สังกัดคณะ <font color=red>*</font> :</label></td>
                <td><select name="faculty">
			    <option value="0"><-- กรุณาเลือก --></option>
                <?php
                    $query = "SELECT DISTINCT * FROM faculty";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                ?> 
                <option value="<?php echo $row['factID'];?>" <?php  if($faculty==$row['factID']) echo 'selected'; ?>><?php echo $row["factID"]." - ".$row['factName_th'];?></option>
                    <?php
                    }
                ?>
		    </select><?php echo $msg3; ?><br></td>
                </tr>
                <tr>
                <td><label >ประเภทครุภัณฑ์ <font color=red>*</font>:</label></td>
                <td><select name="category">
			    <option value="0"><-- กรุณาเลือก --></option>
                <?php
                    $query1 = "SELECT DISTINCT * FROM category";
                    $statement1 = $connect->prepare($query1);
                    $statement1->execute();
                    $result1 = $statement1->fetchAll();
                    foreach($result1 as $row)
                    {
                ?> 
                <option value="<?php echo $row['categoryID'];?>" <?php  if($category==$row['categoryID']) echo 'selected'; ?>><?php echo $row["categoryID"]." - ".$row['categoryName_th'];?></option>
                    <?php
                    }
                ?>
		    </select><?php echo $msg4; ?><br></td>
                </tr>
                <tr>
                <td><label >ประเภทครุภัณฑ์ย่อย <font color=red>*</font>: </label></td>
                <td><select name="subcategory">
			    <option value="-1"><-- กรุณาเลือก --></option>
                <?php
                    $query1 = "SELECT DISTINCT * FROM subcategory";
                    $statement1 = $connect->prepare($query1);
                    $statement1->execute();
                    $result1 = $statement1->fetchAll();
                    foreach($result1 as $row)
                    {
                ?> 
                <option value="<?php echo $row['subcategoryID'];?>" <?php  if($subcategory==$row['subcategoryID']) echo 'selected'; ?>><?php echo $row["subcategoryID"]." - ".$row['subcategoryName_th'];?></option>
                    <?php
                    }
                ?>
		    </select><?php echo $msg5; ?><br></td>
                </tr>
             
                <tr>
                <td><label >จำนวนครุภัณฑ์ <font color=red>*</font>: </label></td>
                <td><input type="text" name="quantity" id="quantity" class="bginput" value="<?php echo $quantity; ?>"><?php echo $msg6; ?><br></td>
                </tr>
                <tr>
                <td colspan=2><label >หมายเลขครุภัณฑ์ : </label><?php echo $msg8; ?></td></tr>
                <tr><td colspan=2><textarea name="equipment_id" rows = 3 cols=50 ><?php echo $equipmentID; ?></textarea>
                <button type="submit" name="btn-genID" id="btn-genID" class="btn btn-success">ขอรหัส</button></td>
                </tr>
               
                <tr>
                <td><label >สถานที่ <font color=red>*</font>: </label></td>
                <td><select name="location">
			    <option value="0"><-- กรุณาเลือก --></option>
                <?php
                    $query = "SELECT DISTINCT * FROM location";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                ?> 
                <option value="<?php echo $row['locationID'];?>" <?php  if($location==$row['locationID']) echo 'selected'; ?>><?php echo $row["locationID"]." - ".$row['locationName_th'];?></option>
                    <?php
                    }
                ?>
		    </select><?php echo $msg7; ?><br></td>
                </tr>
                <tr>
                <td><label >สถานะ <font color=red>*</font> : </label></td>
                <td><select name="status" disabled>
			    <option value="0"><-- กรุณาเลือก --></option>
                <?php
                    $query = "SELECT DISTINCT * FROM status";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                ?> 
                <option value="<?php echo $row['statusID'];?>" <?php  if($status==$row['statusID']) echo 'selected'; ?>><?php echo $row["statusID"]." - ".$row['status_th'];?></option>
                    <?php
                    }
                ?>
		    </select><br></td>
                </tr>
                <tr>
                <td colspan=2><label >รายละเอียดครุภัณฑ์ : </label></td></tr>
                <tr><td colspan=2><textarea name="detail" rows = 5 cols=50></textarea><br></td>
                </tr>
            
            
            </table>
            <br><br>
                <a href="Register_status.php" type="button" class="btn btn-dark" value="ย้อนกลับ" >ย้อนกลับ</a>
                <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-dark">บันทึก</button>
            </form>
            </div>
        </div>
    <div></center>
</body>
</html>