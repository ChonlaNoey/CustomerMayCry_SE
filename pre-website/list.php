<?php 

//list.php

include('database_connection.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>รายการอุปกรณ์</title>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/my_custom.css" rel="stylesheet">
    <script src="js/custom_script.js"></script>
</head>

<body >
    <!-- navigation bar-->
    <ul>
        <li>
            <a style="float:right;" class="nav-logo" href="#+">ระบบยืมคืน-อุปกรณ์</a>
            <a style="float:left;" class="btn-black" onclick="goBack()">Go Back</a>
        </li>
    </ul>
    <!-- Page Content -->
    <div class="custom-container">
        <div class="custom-row">
        	<br />
        	<h1 align="center" class="forced-font">รายการอุปกรณ์</h1>
            <br />
            <br>
            <div class="col-md-3">                							
                <div class="list-group">
					<h2>ชนิดอุปกรณ์</h2>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php
                    $query = "SELECT DISTINCT * FROM category";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><strong><input type="checkbox" class="common_selector category" value="<?php echo $row['cname']; ?>"  > <?php echo $row['cname']; ?></strong></label>
                    </div>
                    <?php
                    }
                    ?>
                    </div>
                </div>
				<div class="list-group">
                    <h2>ประเภทอุปกรณ์</h2>
					<?php
                    $query = "
                    SELECT DISTINCT(equipment_type) FROM equipment ORDER BY equipment_type DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item csheckbox">
                        <label><input type="checkbox" class="common_selector type" value="<?php echo $row['equipment_type']; ?>"  > <?php echo $row['equipment_type']; ?></label>
                    </div>
                    <?php
                    }
                    ?>	
                </div>
				<div class="list-group">
					<h2>สถานที่เก็บ</h2>
					<?php
                    $query = "
                    SELECT DISTINCT * FROM location
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><strong><input type="checkbox" class="common_selector location" value="<?php echo $row['lname']; ?>"  > <?php echo $row['lname']; ?></strong></label>
                    </div>
                    <?php
                    }
                    ?>	
                </div>
                <div class="list-group">
                    <h2>สถานะอุปกรณ์</h2>
					<?php
                    $query = "
                    SELECT DISTINCT(equipment_status) FROM equipment ORDER BY equipment_status DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item csheckbox">
                        <label><input type="checkbox" class="common_selector status" value="<?php echo $row['equipment_status']; ?>"  > <?php echo $row['equipment_status']; ?></label>
                    </div>
                    <?php
                    }
                    ?>	
                </div>
            </div>
            <div class="col-md-9">
            	<br />
                <div class="row filter_data"> </div>
            </div>
        </div>

    </div>
<style>
#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var category = get_filter('category');
        var type = get_filter('type');
        var location = get_filter('location');
        var status = get_filter('status');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, category:category, type:type, location:location, status:status},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

});
</script>

</body>

</html>
