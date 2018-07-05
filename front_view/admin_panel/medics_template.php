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
            <div style="text-align: center;" class="horizontal-align">
                
                <button class='filter-button m-l-20 m-r-40'>Filter</button>
                <div class="wrap-input m-t-10" style="width: 60%">
                    <input class="input" type="text" placeholder="Doctor Name">
                </div>
            </div>
            <div class="table-box m-t-20 m-l-20">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>CRM</th>
                            <th>Email</th>
                            <th>Telephone</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        
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
            $('#notes, #prescription').editable();
            
            $('#new').click(function () {
                location.replace("./new_medic_template.html");

			});

        });
    </script>

</body>
</html>