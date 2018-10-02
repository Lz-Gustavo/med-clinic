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
            <p class="title">Future Consulties</p>
        </div>
        <div>
            <div class="table-box m-t-20 m-l-20">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <!--th>First Name</th-->
                            <th>CPF</th>
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

							session_start();
							
                            $db_instance = Storage::getInstance();
                            $db_instance->connect("GeracaoSaude");

                            $now = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));

                            $sql = "SELECT * FROM GeracaoSaude.consultas WHERE crm='".$_SESSION['login_crm']."' AND CAST(dia AS Date)>='".$now->format("Ymd"."';");

                            $result = $db_instance->SQLretrieve($sql);

                            for ($i = 0; $i < count($result); $i++) {

                                $hour = $db_instance->translate_time($result[$i]['horario']);
                                $index = $result[$i]['crm']."!".$result[$i]['dia']."!".$result[$i]['horario'];

                                echo "<tr>";
                                echo "<td>".$result[$i]['cpf']."</td>";
                                echo "<td>".$result[$i]['dia']."</td>";
                                echo "<td>".$hour."</td>";
                                echo "<td id='obs' data-pk='".$index."'>".$result[$i]['obs']."</td>";
                                echo "<td id='receita' data-pk='".$index."'>".$result[$i]['receita']."</td>";
                                echo "</tr>";
                            }

                            $db_instance->disconnect();
						?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>


    <div class="box">
        <div class="header-show-dados">
            <p class="title">Consulties</p>
        </div>
        <div>         
            <form method = "get">
                <div style="text-align: center;" class="horizontal-align">

                    <button class='filter-button m-l-20 m-r-40' type='submit'>Filter</button>
                    
                    <div class="wrap-input m-t-10" style="width: 60%">
                        <input class="input" type="text" name="cpf" placeholder="Patient's CPF">
                    </div>
                </div>
            </form>
            
            <div class="table-box-bot m-t-20 m-l-20">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <!--th>First Name</th-->
                            <th>CPF</th>
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

							//session_start();
							
                            $db_instance = Storage::getInstance();
                            $db_instance->connect("GeracaoSaude");

                            /*$filter = array(
                                "TABLE:" => "consultas",
                                "crm:" => $_SESSION['login_crm']
                            );

                            if ((isset($_GET['cpf'])) && (is_numeric($_GET['cpf'])))
                                $filter['cpf:'] = $_GET['cpf'];
                            
                            $result = $db_instance->read($filter);*/
                            
                            $now = new DateTime(null, new DateTimeZone('America/Sao_Paulo'));
                            
                            $sql = "SELECT * FROM GeracaoSaude.consultas WHERE crm='".$_SESSION['login_crm']."' AND CAST(dia AS Date)<'".$now->format("Ymd"."';");
                            
                            // TODO: must decide if we r gonna display all history or just past appts on this table...
                            $result = $db_instance->SQLretrieve($sql);
                            
                            for ($i = 0; $i < count($result); $i++) {

                                $hour = $db_instance->translate_time($result[$i]['horario']);
                                $index = $result[$i]['crm']."!".$result[$i]['dia']."!".$result[$i]['horario'];

                                echo "<tr>";
                                echo "<td>".$result[$i]['cpf']."</td>";
                                echo "<td>".$result[$i]['dia']."</td>";
                                echo "<td>".$hour."</td>";
                                echo "<td id='obs' data-pk='".$index."'>".$result[$i]['obs']."</td>";
                                echo "<td id='receita' data-pk='".$index."'>".$result[$i]['receita']."</td>";
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
            //$.fn.editable.defaults.ajaxOptions = {type: "PUT"};
            $('#obs, #receita').editable({
                //pk: 1,
                url: '../../php_backend/save-forms/doctor_panel/save_notes.php',

                ajaxOptions:{
                    type:'post'
                }
            });
            
            
            $('#obs, #receita').on('save', function(e, params) {
                //console.log(params.newValue);                
            });

        });
    </script>

</body>
</html>