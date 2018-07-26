<?php session_start();
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>bus route</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->

<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

<script src="AdminPanel/js/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="js/jquery.PrintArea.js" type="text/javascript"></script>
   
<style>
.mtb-margin-top { margin-top: 20px; }
.top-margin { border-bottom:2px solid #ccc; margin:20px 0; display:block; font-size:1.3rem; line-height:1.7rem;}
.btn-success {
	cursor:pointer;
}
img.barcode {
    border: 1px solid #ccc;
    padding: 20px 10px;
    border-radius: 5px;
}
label {
    margin-bottom: 0rem;
    font-weight: bold;
    font-size: 13px;
}
.form-control {
    padding:0.2rem .75rem;
    font-size: 14px;
}
select.form-control:not([size]):not([multiple]) {
    height: auto;
}
#string, #size {
    height: 30px;
}
.btn {
    margin-bottom:30px;
}
</style>
</head>

<body>
	<div class="container-fluid mtb-margin-top">
        <div class="row">
            <div class="col-md-12">
                <h1 class="top-margin jumbotron" align="center">BUS ROUTE SUGGESTION SYSTEM</h1>
                <div align="center"><a class="btn btn-success" href="welcome.php">ADD NEW</a>&nbsp;&nbsp;<a class="btn btn-danger" href="logout.php">LOGOUT</a></div>
            </div>
        </div>
        
        <table>
        <?php
            
            require "config.php";
            // Create connection
            // Check connection
            if ($link->connect_error) {
                die("Connection failed: " . $link->connect_error);
            } 

            $sql = "SELECT * FROM time_table";
            $result = $link->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
              ?>
            <center>
            <table class="table table-hover table-bordered">
                <tr>
                    <th>bus id</th>
                    <th>bus name</th>
                    <th>bus stand</th>
                    <th>start point</th>
                    <th>destination point</th>
                    <th>start time</th>
                    <th>reaching time</th>
                </tr>
            <?php
                while($row = $result->fetch_assoc()) {
                   ?>
                <tr>
                    <td><?php echo $row['BUS_ID'];?></td>
                    <td><?php echo $row['BUS_NAME'];?></td>
                    <td><?php echo $row['BUS_STAND'];?></td>
                    <td><?php echo $row['P_START'];?></td>
                    <td><?php echo $row['D_DROP'];?></td>
                    <td><?php echo $row['P_TIME'];?></td>
                    <td><?php echo $row['D_TIME'];?></td>
                </tr>
            <?php
                }
            } else {
                echo "0 results";
            }
            $link->close();
            
            ?>    
            
        </table>
            </center>

    </div>
</body>
</html>



