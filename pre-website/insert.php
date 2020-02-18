<?php
    include('database_connection.php');

    if (isset($_POST['btn-submit'])) {    
        $eid = $_POST['eid'];
        $equipment_type = $_POST['equipment_type'];
        $ename_eng = $_POST['ename_eng'];
        $cid = $_POST['cid'];

        $sql= "INSERT INTO equipment VALUES ('$eid', '$cid', '1','1', '$equipment_type', '$ename_eng','','')";
        $statement = $connect->prepare($sql);
        $statement->execute();

        if(!isset($sql)){
            die ("Error $sql" .mysqli_connect_error());
        }else{
            header("location: index.php");  
        }
        
    }
?>

<html>
    <head>
        <title>Menu</title>
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
                <a style="color:white; float:left" class="btn-black" onclick="goBack()">Go Back</a>
            </li>
        </ul>
        <center>
        <p align="center">
		    <h1 align="center" style="color:skyblue;">เพิ่มข้อมูลอุปกรณ์</h1>
	    </p>
        <br><br>
        <form method="post">
        <table>
            <tr>
                <td><label for="eid">Equipment ID:</label></td>
                <td><input type="text" name="eid" id="eid" placeholder=" AB0" class="bginput"><br></td>
            </tr>
            <tr>
                <td><label for="ename">Equipment Name:</label></td>
                <td><input type="text" name="ename" id="ename" placeholder=" English Please!" class="bginput"><br></td>
            </tr>
            <tr>
                <td><label for="equipment_type">Equipment Type:</label></td>
                <td><input type="text" name="equipment_type" id="equipment_type" placeholder=" English Please!" class="bginput"><br></td>
            </tr>
            <tr>
                <td><label for="category_type">Category Type:</label></td>
                <td><select name="cid">
                <option value=""><-- Please Select Item --></option>
                <?php
                    $query = "SELECT DISTINCT * FROM category";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                ?> 
                <option value="<?php echo $row['cid'];?>"><?php echo $row["cid"]." - ".$row['cname_eng'];?></option>
                <?php
                    }
                ?>
                
                </select><br></td>
            </tr>
        </table>
        <br><br>
            <input type="button" class="btn btn-dark" value="Back" onclick="history.back()">
            <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-dark">Submit</button>
        </form>
        </div>
    </body>
</html>