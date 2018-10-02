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
        
        <form id="f" style="padding:20px;">
            <h1>Add Appointment</h1>
            <div>Name: </div>
            <!--chama as clinicas do médico-->
            <select id="clinic" name="clinic">
                <option value="Clinica 1">Clinica 1</option>
                <option value="Clinica 2">Clinica 2</option>
                <option value="Clinica 3">Clinica 3</option>
            </select>
            <div>Start:</div>
            <div>
            <?php
                
                if (isset($_GET['start']))
                    echo "<input type=\"text\" id=\"start\" name=\"start\" value=\"".$_GET['start']."\" disabled>";
            ?>
            </div>
            <div>End:</div>
            <div>
            <?php
                
                if (isset($_GET['end']))
                    echo "<input type=\"text\" id=\"end\" name=\"end\" value=\"".$_GET['end']."\" disabled>";
            ?>
            <div class="space"><input type="submit" value="Save" /> <a href="javascript:close();">Cancel</a></div>
        </form>
        
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