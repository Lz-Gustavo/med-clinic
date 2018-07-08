<!DOCTYPE html>
<html lang="en">

<head>
    <title>PsyMed</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->

    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/iframe_doctor.css">
    <!--===============================================================================================-->

    <!-- bootstrap -->
    <link href="../plugins/x-editable/css/bootstrap.min.css" rel="stylesheet">
    <script src="../plugins/x-editable/js/bootstrap.min.js"></script>

    <!-- Jquery -->
    <script src="../plugins/x-editable/js/jquery-2.0.3.min.js"></script>

    <!-- x-editable (bootstrap version) -->
    <link href="../plugins/x-editable/css/bootstrap-editable.css" rel="stylesheet" />
    <script src="../plugins/x-editable/js/bootstrap-editable.min.js"></script>

</head>

<body style="background-color:#fff;">

    <div class="box">
        <div class="header-show-dados">
            <p class="title">Consulties</p>
        </div>
        <div class="p-t-20">         
            <form method = "get">
                <div style="text-align: center;" class="horizontal-align">

                    <button class='filter-button m-l-20 m-r-40' type='submit'>Filter</button>
                    <input type = "radio" name = "time" value = "all" checked> Todas<br>
                    <input type = "radio" name = "time" value = "future"> Futuras<br>
                </div>

            </form>
            
            <div class="table-box m-t-20 m-l-20">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>CPF</th>
                            <th>Doctor</th>
                            <th>CRM</th>
                            <th>Date</th>
                            <th>Hour</th>
                            <th>Notes</th>
                            <th>Prescription</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							ini_set('display_errors', 1);
							ini_set('display_startup_errors', 1);
							error_reporting(E_ALL);

							require_once "../../php_backend/class/storage.php";
							require_once "../../php_backend/class/person.php";
							require_once "../../php_backend/class/doctor.php";

							session_start();
							//echo "<pre>";
							//print_r($_SESSION);
							//echo "</pre>";
							$_GET['doctor_name'] = $_SESSION['login_user'];

							$doctor = new Doctor("admin", "istrator", "1");

                            $result = $doctor->search_history();

                            for ($i = 0; $i < count($result); $i++) {

                                echo "<tr>";
                                echo "<td id='name'>".$result[$i]->name."</td>";
                                echo "<td>".$result[$i]->last_name."</td>";
                                echo "<td>".$result[$i]->cpf."</td>";
                                echo "<td>".$result[$i]->doctor_name."</td>";
                                echo "<td>".$result[$i]->crm."</td>";
                                echo "<td>".$result[$i]->appt_date."</td>";
                                echo "<td>".$result[$i]->time."</td>";
                                echo "<td id='notes' data-pk='index'>".$result[$i]->obs."</td>";
                                echo "<td id='prescription' data-pk='index'>".$result[$i]->recipe."</td>";
                                echo "</tr>";
                            }
						?>
                    </tbody>

                </table>
            </div>
            
            <div style="margin: auto; text-align: center; padding-top: 20px">
                <button id="submit" class='submit-button' type="submit">Submit Changes</button>
            </div>

        </div>
    </div>

    <!-- JS SCRIPT -->
    <script>
        $(document).ready(function () {
            //`popup` / `inline`
            $.fn.editable.defaults.mode = 'inline';
            //$.fn.editable.defaults.ajaxOptions = {type: "PUT"};
            $('#notes, #prescription').editable({
                //pk: 1,
                url: 'test_table.php',

                ajaxOptions:{
                    type:'post'
                } ,
                success: function(data) {
                   alert(data);
                }, 
            });
            
            
            $('#notes, #prescription').on('save', function(e, params) {
                //console.log(params.newValue);                
            });

        });
    </script>

</body>
</html>