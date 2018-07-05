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

</head>

<body style="background-color:#fff;">

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
			$_GET['doctor_name'] = $_SESSION['login_user'];
			$_GET['name'] = $_SESSION['login_user'];
			$doctor = new Doctor("admin", "istrator", "1");

			$result = $doctor->search_profile();

			$_POST['name'] = $result[0]->name;
			$_POST['last_name'] = $result[0]->last_name;
			$_POST['email'] = $result[0]->email;
			$_POST['tel'] = $result[0]->tel;
			$_POST['crm'] = $result[0]->crm;
	?>

    <div class="box">
        <div class="header-show-dados">
            <p class="title">Profile</p>
        </div>

        <div class="show-dados">
		<form method="post">
            <div class="horizontal-align w-full">
                <div style="width: 20%;">
                    <p>First name:</p>
				</div>
				
                <div class="wrap-input m-t-10">
                    <input class="input" type="text" name="first_name" value="<?php echo $_POST['name'] ?>">
                </div>
			</div>

            <div class="horizontal-align w-full">
                <div style="width: 20%;">
                    <p>Last name:</p>
                </div>
                <div class="wrap-input m-t-10">
                    <input class="input" type="text" name="last_name" value="<?php echo $_POST['last_name'] ?>">
                </div>
			</div>
			
			<div class="horizontal-align w-full">
                <div style="width: 20%;">
                    <p>Telephone:</p>
                </div>
                <div class="wrap-input m-t-10">
                    <input class="input" type="number" name="last_name" value="<?php echo $_POST['tel'] ?>">
                </div>
            </div>

            <div class="horizontal-align w-full">
                <div style="width: 20%;">
                    <p>CRM:</p>
                </div>
                <div class="wrap-input m-t-10">
                    <input class="input" type="number" min="0" name="crm" value="<?php echo $_POST['crm'] ?>">
                </div>
            </div>

            <div class="horizontal-align w-full">
                <div style="width: 20%;">
                    <p>Email:</p>
                </div>
                <div class="wrap-input m-t-10">
                    <input class="input" type="email" name="email" value="<?php echo $_POST['email'] ?>">
                </div>
            </div>

            <div class="horizontal-align w-full">
                <div style="width: 20%;">
                    <p>Schedule:</p>
                </div>
                <div id="target">
                </div>
            </div>

            <div style="margin: auto; text-align: center; padding-top: 20px">
                <button id="submit" class='submit-button' type="submit">Submit Changes</button>
            </div>
		
		</form>
        </div>
    </div>

    <!-- JS SCRIPT -->
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../plugins/weekly_schedule/jquery.weekly-schedule-plugin.min.js"></script>

    <script>
        $('#target').weekly_schedule();
        $('.schedule').on('selectionmade', function () {
            console.log("Selection Made");
        }).on('selectionremoved', function () {
            console.log("Selection Removed");
        });
        
        $('#submit').click(function(){
            console.log($('#target').weekly_schedule("getSelectedHour"));
        });
    </script>

</body>
</html