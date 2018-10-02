<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>New Event</title>
    	<!--link type="text/css" rel="stylesheet" href="media/layout.css" /-->    
        <!-- helper libraries -->
        <script src="../helpers/jquery-1.9.1.min.js" type="text/javascript"></script>
    
        <!-- daypilot libraries -->
        <script src="../js/daypilot-all.min.js?v=2018.2.232" type="text/javascript"></script>
    </head>
    <body>
        <?php
        
            $start = $_GET['start'];
            $end = $_GET['end'];
        ?>
        
        <form id="f" style="padding:20px;">
            <h1>Add Appointment</h1>
            <div>Name: </div>
            <!--div><input type="text" id="name" name="name" value="" /></div-->
            <select id="clinic" name="clinic">
                <option value="1">Clinica 1</option>
                <option value="2">Clinica 2</option>
                <option value="3">Clinica 3</option>
            </select>
            <div>Start:</div>
            <div><input type="text" id="start" name="start" /></div>
            <div>End:</div>
            <div><input type="text" id="end" name="end" /></div>
            
            <div class="space"><input type="submit" value="Save" /> <a href="javascript:close();">Cancel</a></div>
        </form>
        
        <script type="text/javascript">
        function close(result) {
            DayPilot.Modal.close(result);
        }

        $("#f").submit(function (ev) {
            
            DayPilot.Modal.close("foi");
        });

        $(document).ready(function () {
            $("#name").focus();
        });
    
        </script>
    </body>
</html>