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
    <link rel="stylesheet" type="text/css" href="../css/iframe_admin.css">
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
        <div class="horizontal-align">
            <div class="header-show-dados">
                <p class="title">Medics</p>
            </div>
            <button id="new" class='add-button'>New</button>
        </div>
        
        <div class="p-t-20">
            <form method="get">
                <div style="text-align: center;" class="horizontal-align">
                    <button class='filter-button m-l-20 m-r-40' type="submit">Filter</button>
                    <div class="wrap-input m-t-10" style="width: 60%">
                        <input class="input" type="text" name="name" placeholder="Doctor's Name">
                    </div>
                    
                    <!--
                    <div class="wrap-input m-t-10" style="width: 60%">
                        <input class="input" type="text" name="crm" placeholder="CRM">
                    </div>
                    -->
                </div>          
            </form>
            
            <div class="table-box m-t-20 m-l-20">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Specialization</th>
                            <th>CRM</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            //ini_set('display_errors', 1);
                            //ini_set('display_startup_errors', 1);
                            //error_reporting(E_ALL);

                            require_once "../../php_backend/class/storage.php";
                            require_once "../../php_backend/class/person.php";
                            require_once "../../php_backend/class/secretary.php";

                            $secretary = new Secretary("admin", "istrator", "1");

                            if ((isset($_GET['name'])) || (isset($_GET['crm']))) {
                                $result = $secretary->search_doctor();

                                for ($i = 0; $i < count($result); $i++) {

                                    echo "<tr>";
                                    echo "<td>".$result[$i]->name."</td>";
                                    echo "<td>".$result[$i]->last_name."</td>";
                                    echo "<td>".$result[$i]->spec."</td>";
                                    echo "<td>".$result[$i]->crm."</td>";
                                    echo "<td>".$result[$i]->email."</td>";
                                    echo "<td>".$result[$i]->tel."</td>";
                                    echo "<td>".$result[$i]->addr."</td>";
                                    echo "</tr>";
                                }
                            }
                            else {
                                $result = $secretary->show_all_doctors();

                                for ($i = 0; $i < count($result->med); $i++) {

                                    echo "<tr>";
                                    echo "<td>".$result->med[$i]->name."</td>";
                                    echo "<td>".$result->med[$i]->last_name."</td>";
                                    echo "<td>".$result->med[$i]->spec."</td>";
                                    echo "<td>".$result->med[$i]->crm."</td>";
                                    echo "<td>".$result->med[$i]->email."</td>";
                                    echo "<td>".$result->med[$i]->tel."</td>";
                                    echo "<td>".$result->med[$i]->addr."</td>";
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
            
            $('#new').click(function () {
                location.replace("./new_medic_template.html");

			});

        });
    </script>

</body>
</html>