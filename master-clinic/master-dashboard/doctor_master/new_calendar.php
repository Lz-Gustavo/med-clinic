<!doctype html>
<html lang="en">

<?php session_start(); ?>

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		MedClinic
	</title>
	<!-- daypilot libraries -->
	<link type="text/css" rel="stylesheet" href="../helpers/demo.css?v=2018.2.232" />
	<link type="text/css" rel="stylesheet" href="../helpers/media/layout.css?v=2018.2.232" />
	<link type="text/css" rel="stylesheet" href="../helpers/media/elements.css?v=2018.2.232" />
	<script src="../helpers/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="../js/daypilot-all.min.js?v=2018.2.232" type="text/javascript"></script>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'
	/>
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
	/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<!-- CSS Files -->
	<link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>
    <body>    
        <div class="modal-content">
            <form id="f" style="padding:20px;">
                <h2 class="modal-title">Add Appointment</h2>
                <h6>Clinic</h6>
                <!--chama as clinicas do médico-->
                <select class="form-control" id="clinic" name="clinic">
                    <option value="Clinica 1">Clinica 1</option>
                    <option value="Clinica 2">Clinica 2</option>
                    <option value="Clinica 3">Clinica 3</option>
                </select>
                <h6 style="margin-top:10px;">Start</h6>
                <div>
                <?php
                    
                    if (isset($_GET['start']))
                        echo "<input type=\"text\" id=\"start\" name=\"start\" value=\"".$_GET['start']."\" disabled>";
                ?>
                </div>
                <h6 style="margin-top:10px;">End</h6>
                <div>
                <?php
                    
                    if (isset($_GET['end']))
                        echo "<input type=\"text\" id=\"end\" name=\"end\" value=\"".$_GET['end']."\" disabled>";
                ?>
                <div class="moda-footer space">
                    <input type="submit" class="btn btn-info" value="Save" /> 
                    <a href="javascript:close();">Cancel</a>
                </div>
            </form>
        </div>
    
        <script type="text/javascript">
        function close(result) {
            DayPilot.Modal.close(result);
        }

        $("#f").submit(function (ev) {
            
            var clinic = document.getElementById("clinic").value;
            var start = document.getElementById("start").value;
            var end = document.getElementById("end").value;
            
            var aux = '{"args" : [{ "start":"'+ start +'", "end":"'+ end +'", "clinic":"'+ clinic +'"}]}';
            var obj = JSON.parse(aux);

            DayPilot.Modal.close(obj);
        });

        $(document).ready(function () {
            $("#name").focus();
        });
    
        </script>
    </body>
</html>