<?php 

//list.php

include('../config/database_connection.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>รายการอุปกรณ์</title>
    <script src="../js.css.list/js/jquery-1.10.2.min.js"></script>
    <script src="../js.css.list/js/jquery-ui.js"></script>
    <script src="../js.css.list/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../js.css.list/css/bootstrap.min.css">
    <link href = "../js.css.list/css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom -->
    <link href="../js.css.list/css/style.css" rel="stylesheet">
    <link href="../js.css.list/css/my_custom.css" rel="stylesheet">
    <script src="../js.css.list/js/custom_script.js"></script>
</head>

<body>
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
                        <label><strong><input type="checkbox" class="common_selector category" value="<?php echo $row['cname_tha']; ?>"  > <?php echo $row['cname_tha']; ?></strong></label>
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
                    SELECT DISTINCT(equip_type) FROM equipment ORDER BY equip_type DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item csheckbox">
                        <label><input type="checkbox" class="common_selector type" value="<?php echo $row['equip_type']; ?>" > <?php echo $row['equip_type']; ?></label>
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
                        <label><strong><input type="checkbox" class="common_selector location" value="<?php echo $row['lname_tha']; ?>"  > <?php echo $row['lname_tha']; ?></strong></label>
                    </div>
                    <?php
                    }
                    ?>	
                </div>
                <div class="list-group">
                    <h2>สถานะอุปกรณ์</h2>
					<?php
                    $query = "
                    SELECT * FROM status ORDER BY sid   
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item csheckbox">
                        <label><input type="checkbox" class="common_selector status" value="<?php echo $row['status_tha']; ?>"  > <?php echo $row['status_tha']; ?></label>
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
