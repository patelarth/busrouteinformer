<?php 
require "config.php";
session_start();
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>bus route</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->

<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script language="javascript" type="text/javascript">
function process() {
var apiurl = "https://chart.googleapis.com/chart";
var els = document.forms["theform"].elements;
var el;
var i = 0;
var querystring = "?";
while (null != (el = els.item(i++))) {
  querystring += escape(el.name) + "=" + escape(el.value) + "&";
}
var resultado = document.getElementById('resultado');
var basura = resultado.childNodes;
var basurita;
i = 0;
while (null != (basurita = basura.item(i++))) {
  resultado.removeChild(basurita);
}
var img = document.createElement('img');
img.src = apiurl + querystring;
resultado.appendChild(img);
return false;
}
</script>
<script src="AdminPanel/js/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="js/jquery.PrintArea.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#print_button").click(function () {
                $(".PrintArea").printArea();
            });
        });
     </script>
 

<?php
// add information to database
if (isset($_POST['submit'])){

        $BUS_ID = $_POST['chl'];
        $BUS_NAME = $_POST['bname'];
        $P_START = $_POST['pickup'];
        $D_DROP = $_POST['drop'];
        $P_TIME = $_POST['ptime'];
        $D_TIME = $_POST['dtime'];
        $BUS_STAND = $_POST['place'];
        //Attempt insert query execution
        $sql = "INSERT INTO time_table (BUS_ID,BUS_NAME,P_START,D_DROP,P_TIME,D_TIME,BUS_STAND) VALUES ('$BUS_ID','$BUS_NAME','$P_START','$D_DROP','$P_TIME','$D_TIME','$BUS_STAND')";

        if(mysqli_query($link, $sql)){
             echo "Records inserted successfully.";
      } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
        mysqli_close($link);
    }
?>

    
    
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
                <div align="center"><a class="btn btn-success" href="bus_table.php">BUS ROUTE</a>&nbsp;&nbsp;<a class="btn btn-danger" href="logout.php">LOGOUT</a></div>
            </div>
        </div>

        <form class="form-horizontal" action="welcome.php" method="POST" id="theform" name="theform">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>BUS ID:</label>
                        <input type="text" name="chl" id="chl" class="form-control" required>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>first generate code</label>
                        <input type="button" onclick="process();" value="press here">
                    </div>
                </div>
            </div>
            <div clas=" printarea container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <?php    
                $temp = "<div id='resultado'></div>";
                $_SESSION['qrcode']=$temp;
                
                echo $_SESSION['qrcode'];?>
                
                </div>
            </div>
        </div>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>bus name:</label>
                        <input type="text" name="bname" id="bname" class="form-control" required>
                    </div>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>start </label>
                        <input type="text" name="pickup" id="" class="form-control" placeholder="place" required>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>drop</label>
                        <input type="text" name="drop" id="" class="form-control" placeholder="destination" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>start time</label>
                        <input type="text" name="ptime" id="" class="form-control" placeholder=" pickuptime" required>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>drop time</label>
                        <input type="text" name="dtime" id="" class="form-control" placeholder=" droptime" required>
                    </div>
                </div>
            </div>

            <div class="row">
               <div class="col-md-3">
                    <div class="form-group">
                        <label>Code Type</label>
                        <select name="chld" id="chld">
                            <option value="L" selected="selected">L (7%)</option>
                            <option value="M">M (15%)</option>
                            <option value="Q">Q (25%)</option>
                            <option value="H">H (30%)</option>
                            </select>
                    </div>
                </div>

                            <input type="hidden" name="choe" value="UTF-8" id="choe"/>
                            <input type="hidden" name="chs" value="300x300" id="chs"/>
                            <input type="hidden" name="cht" value="qr" id="cht"/>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>stand name</label>
                        <input type="text" name="place" class="form-control">
                    </div>
                </div>
            </div>
            
            <div class="row text-center">
                <div class="col-md-12">
                    <input type="submit" name="submit" class="btn btn-success text-center form-control" id="" value="enter in timetable">
                    <h6 style="color:red">Note: DON`t forgot about downloading QR code</h6>
                </div>
            </div>
         </form>
    </div>
	
    
</body>
</html>

