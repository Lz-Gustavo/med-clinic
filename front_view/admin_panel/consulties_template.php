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
                <p class="title">Consulties</p>
            </div>
            <button id="new" class="add-button">New</button>
        </div>
        
        <div class="p-t-20">
            <form method="get">
                <div style="text-align: center;" class="horizontal-align">
                    <button class='filter-button m-l-20 m-r-40' type="submit">Filter</button>
                    <div class="wrap-input m-t-10" style="width: 60%">
                        <input class="input" type="text" name="cpf" placeholder="Patient's CPF">
                    </div>

                    <div class="wrap-input m-t-10" style="width: 60%">
                        <input class="input" type="text" name="crm" placeholder="Doctor's CRM">
                    </div>

                </div>
            </form>

            <div class="table-box m-t-20 m-l-20">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>CPF</th>
                            <th>CRM</th>
                            <th>Date</th>
                            <th>Hour</th>
                            <!--th>Notes</th-->
                            <!--th>Prescription</th-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            //ini_set('display_errors', 1);
                            //ini_set('display_startup_errors', 1);
                            //error_reporting(E_ALL);

                            require_once "../../php_backend/class/storage.php";

                            $db_instance = Storage::getInstance();
                            $db_instance->connect("GeracaoSaude");

                            if ((isset($_GET['crm'])) || (isset($_GET['cpf']))) {

                                $filter = array(
                                    "TABLE:" => "consultas"
                                );

                                if (is_numeric($_GET['crm']))
                                    $filter["crm:"] = $_GET['crm'];
                                
                                if (is_numeric($_GET['cpf']))
                                    $filter["cpf:"] = $_GET['cpf'];


                                $result = $db_instance->read($filter);
                            }
                            else {

                                $result = $db_instance->read_all("consultas");
                            }

                            for ($i = 0; $i < count($result); $i++) {

                                $hour = $db_instance->translate_time($result[$i]['horario']);

                                echo "<tr>";
                                echo "<td>".$result[$i]['cpf']."</td>";
                                echo "<td>".$result[$i]['crm']."</td>";
                                echo "<td>".$result[$i]['dia']."</td>";
                                echo "<td>".$hour."</td>";
                                //echo "<td>".$result[$i]['obs']."</td>";
                                //echo "<td>".$result[$i]['receita']."</td>";
                                echo "</tr>";
                            }

                            unset($_GET);
                            $db_instance->disconnect();

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
                location.replace("./new_consultie_template.html");

			});

        });
    </script>

</body>
</html>