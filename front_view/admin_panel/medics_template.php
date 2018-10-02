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
                        <input class="input" type="text" name="crm" placeholder="Doctor's CRM">
                    </div>
                    
                    <div class="wrap-input m-t-10" style="width: 60%">
                        <input class="input" type="text" name="name" placeholder="Doctor's Name">
                    </div>
                </div>          
            </form>
            
            <div class="table-box m-t-20 m-l-20">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>CRM</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Specialization</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            require_once "../../php_backend/class/storage.php";

                            session_start();

                            $db_instance = Storage::getInstance();
                            $db_instance->connect("GeracaoSaude");

                            $sql = "SELECT medicos.crm, medicos.nome, medicos.sobrenome, medicos.especializacao, medicos.email, medicos.telefone, medicos.endereco ";
                            $sql .= "FROM GeracaoSaude.medicos RIGHT JOIN GeracaoSaude.func_clinica ON medicos.crm=func_clinica.crm WHERE clinica='1'";

                            if (isset($_GET['crm']) && (is_numeric($_GET['crm'])))
                                $sql .= " AND medicos.crm='".$_GET['crm']."'";
                            
                            if ((isset($_GET['name'])) && (strlen($_GET['name']) >= 1))
                                $sql .= " AND medicos.nome='".$_GET['name']."'";
                            
                            $sql .= ";";

                            $result = $db_instance->SQLretrieve($sql);

                            for ($i = 0; $i < count($result); $i++) {

                                echo "<tr>";
                                echo "<td>".$result[$i]['crm']."</td>";
                                echo "<td>".$result[$i]['nome']."</td>";
                                echo "<td>".$result[$i]['sobrenome']."</td>";
                                echo "<td>".$result[$i]['especializacao']."</td>";
                                echo "<td>".$result[$i]['email']."</td>";
                                echo "<td>".$result[$i]['telefone']."</td>";
                                echo "<td>".$result[$i]['endereco']."</td>";
                                echo "</tr>";
                            }

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
                location.replace("./new_medic_template.html");

			});

        });
    </script>

</body>
</html>