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
            <p class="title">Patients</p>
        </div>
        <div class="p-t-20">
            <form method="get">
                <div style="text-align: center;" class="horizontal-align">
                    <button class='filter-button m-l-20 m-r-40' type="submit">Filter</button>
                    <div class="wrap-input m-t-10" style="width: 60%">
                        <input class="input" type="text" name="name" placeholder="Patient's Name">
                    </div>
                </div>
            </form>
            <div class="table-box m-t-20 m-l-20">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th>Blood Type</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Telephone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            //ini_set('display_errors', 1);
                            //ini_set('display_startup_errors', 1);
                            //error_reporting(E_ALL);

                            require_once "../../php_backend/class/storage.php";
                            require_once "../../php_backend/class/person.php";
                            require_once "../../php_backend/class/doctor.php";

                            $doctor = new Doctor("admin", "istrator", "1");

                            if (isset($_GET['name'])) {
                                $result = $doctor->search_patient();

                                for ($i = 0; $i < count($result); $i++) {

                                    echo "<tr>";
                                    echo "<td>".$result[$i]->name."</td>";
                                    echo "<td>".$result[$i]->last_name."</td>";
                                    echo "<td>".$result[$i]->bday."</td>";
                                    echo "<td>".$result[$i]->blood."</td>";
                                    echo "<td>".$result[$i]->cpf."</td>";
                                    echo "<td>".$result[$i]->email."</td>";
                                    echo "<td>".$result[$i]->tel."</td>";
                                    echo "</tr>";
                                }
                            }
                            else {
                                $result = $doctor->show_all_patients();

                                for ($i = 0; $i < count($result->pct); $i++) {

                                    echo "<tr>";
                                    echo "<td>".$result->pct[$i]->name."</td>";
                                    echo "<td>".$result->pct[$i]->last_name."</td>";
                                    echo "<td>".$result->pct[$i]->bday."</td>";
                                    echo "<td>".$result->pct[$i]->blood."</td>";
                                    echo "<td>".$result->pct[$i]->cpf."</td>";
                                    echo "<td>".$result->pct[$i]->email."</td>";
                                    echo "<td>".$result->pct[$i]->tel."</td>";
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

</body>
</html