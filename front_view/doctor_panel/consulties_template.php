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
    <link rel="stylesheet" type="text/css" href="../css/profile_template.css">
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



    <div class="box m-b-10">
        <div class="header-show-dados">
            <p class="title">Consulties</p>
        </div>
        <div class="p-t-20">
            <div style="margin: auto; text-align: center;">
                
                <form method = "get">
                    <span>Periodo: </span><br>
                    <input type = "radio" name = "time" value = "all" checked> Todas<br>
                    <input type = "radio" name = "time" value = "future"> Futuras<br>

                    <br>
                    <button type = "submit">Submeter!</button>
                </form><br>
                
                <!--button id="submit" class='filter-button m-r-30'>Next</button-->
                <!--button id="submit" class='filter-button m-r-30'>Performed</button-->
                <!--button id="submit" class='filter-button'>All</button-->
            </div>
            <div class="table-box m-t-20 m-l-20">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date</th>
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
                            require_once "../../php_backend/class/secretary.php";
                            require_once "../../php_backend/class/doctor.php";
                            require_once "../../php_backend/class/patient.php";
                    
                            session_start();
                            echo "<pre>";
                            print_r($_SESSION);
                            echo "</pre>";
                            $_GET['doctor_name'] = $_SESSION['login_user'];


                            $doctor = new Doctor("admin", "istrator", "Atendente");
                            
                            if (isset($_GET['time'])) {
                                $result = $doctor->search_history();

                                //print_r($result);

                                for ($i = 0; $i < count($result); $i++) {
                                    
                                    echo "<tr>";
                                    echo "<th>".$result[$i]->name."</th>";
                                    echo "<th>".$result[$i]->last_name."</th>";
                                    //echo "<th>".$result[$i]->doctor_name."</th>";
                                    echo "<th>".$result[$i]->appt_date."</th>";
                                    echo "<th id='notes'>".$result[$i]->obs."</th>";
                                    echo "<th id='prescription'>".$result[$i]->recipe."</th>";
                                    echo "</tr>";
                                }
                            }

                        ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <!-- JS SCRIPT -->
    <script>
        $(document).ready(function () {
            //`popup` / `inline`
            $.fn.editable.defaults.mode = 'inline';
            $('#notes, #prescription').editable();

        });
    </script>

</body>
</html>
Notice: Undefined index: login_user in /var/www/html/med-clinic/front_view/doctor_panel/consulties_template.php on line 78
First Name	Last Name	Date	Notes	