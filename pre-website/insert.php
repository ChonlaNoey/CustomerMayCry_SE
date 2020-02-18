<?php
    include('database_connection.php');

    if (isset($_POST['btn-submit'])) {    
        $equip_type = $_POST['equip_type'];
        $ename_tha = $_POST['tname'];
        $ename_eng = $_POST['ename'];
        $cid = $_POST['cid'];

        //get prefix - Single row select
        $pre = $connect->prepare("SELECT prefix FROM category WHERE cid='$cid'"); 
        $pre->execute(); 
        $pre = $pre->fetch();
        $prefix = $pre['prefix'];

        //Single row select
        $stmt = $connect->prepare("SELECT COUNT(cid) rowCount FROM equipment WHERE cid='$cid'"); 
        $stmt->execute(); 
        $row = $stmt->fetch();
        $rowNum = $row['rowCount']+1;
        $eid = $prefix.$rowNum;
        echo $eid;
        
        if($ename_tha == "" && $ename_eng == ""){
            $sql= "INSERT INTO equipment(eid,cid,equip_type) VALUES ('$eid', '$cid', '$equip_type')";
        }else if($ename_tha != "" && $ename_eng == ""){
            $sql= "INSERT INTO equipment(eid,cid,equip_type,ename_tha) VALUES ('$eid', '$cid', '$equip_type', '$ename_tha')";
        }else if($ename_tha == "" && $ename_eng != ""){
            $sql= "INSERT INTO equipment(eid,cid,equip_type,ename_eng) VALUES ('$eid', '$cid', '$equip_type', '$ename_eng')";
        }else if($ename_tha != "" && $ename_eng != ""){
            $sql= "INSERT INTO equipment(eid,cid,equip_type,ename_tha,ename_eng) VALUES ('$eid', '$cid', '$equip_type', '$ename_tha','$ename_eng')";
        }
        $statement = $connect->prepare($sql);
        $statement->execute();
        
        if(!isset($sql)){
            die ("Error $sql" .mysqli_connect_error());
        }else{
            header("location: insert.php");  
        }
        
    }
?>

<html>
    <head>
        <title>เพิ่มข้อมูลอุปกรณ์</title>
        <meta charset="utf8">
        <link href="css/new.bootstrap.min.css" rel="stylesheet">
        <link href="css/my_custom.css" rel="stylesheet">
        <script src="js/custom_script.js"></script>
    </head>
    <body>
        <!-- navigation bar-->
        <ul>
            <li>
                <a style="float:right;" class="nav-logo" href="#">ระบบยืมคืน-อุปกรณ์</a>
                <a style="color:white; float:left" class="btn-black" href="index.php">Go Back</a>
            </li>
        </ul>
        <center>
        <p align="center">
		    <h1 align="center">เพิ่มข้อมูลอุปกรณ์</h1>
	    </p>
        <br><br>
        <form method="post">
        <table>
            <tr>
             <td><label for="ename">ชื่ออุปกรณ์ (ภาษาไทย):</label></td>
             <td><input type="text" name="tname" id="tname" placeholder="ชื่ออุปกรณ์ (ภาษาไทย)" class="bginput"><br></td>
            </tr>
            <tr>
             <td><label for="ename">ชื่ออุปกรณ์ (ภาษาอังกฤษ):</label></td>
             <td><input type="text" name="ename" id="ename" placeholder="ชื่ออุปกรณ์ (ภาษาอังกฤษ)" class="bginput"><br></td>
            </tr>
            <tr>
            <td><label for="equip_type">ประเภทอุปกรณ์:</label></td>
            <td><select name="equip_type" id="equip_type">
			<option value="ไม่ได้ระบุ"><-- กรุณาเลือก --></option>
                <option value="ไม่ได้ระบุ">ไม่ได้ระบุ</option>
                <option value="สามารถพกพาได้">สามารถพกพาได้</option>
                <option value="ไม่สามารถพกพาได้">ไม่สามารถพกพาได้</option>
            </tr>
            <tr>
            <td><label for="category_type">ชนิดอุปกรณ์:</label></td>
            <td><select name="cid">
			<option value="0"><-- กรุณาเลือก --></option>
                <?php
                    $query = "SELECT DISTINCT * FROM category";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                ?> 
                <option value="<?php echo $row['cid'];?>"><?php echo $row["cid"]." - ".$row['cname_tha'];?></option>
                    <?php
                    }
                ?>
		    </select><br></td>
            </tr>
        </table>
        <br><br>
            <input type="button" class="btn btn-dark" value="ย้อนกลับ" href="index.php">
            <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-dark" onClick="insertEquip()">เพิ่มอุปกรณ์</button>
        </form>
        </div>
    </body>
</html>