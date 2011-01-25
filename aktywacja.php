<?php

	session_start();
	require_once('connectvars.php');

        $id = $_GET['id'];
        $klucz = $_GET['key'];

        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        $query = "SELECT klucz FROM dane WHERE id = '$id'";
	$data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
            $row = mysqli_fetch_array($data);
            $klucz_z_tabeli = $row['klucz'];
            if ($klucz == $klucz_z_tabeli) {
                $query = "UPDATE dane SET aktywacja = '1' WHERE id = '$id'";
                $data = mysqli_query($dbc, $query);
                $_SESSION['aktywacja'] = 'Poprawnie aktywowano profil, możesz się zalogować.';
            }
            else {
                $_SESSION['aktywacja'] ='Niepoprawny link aktywacyjny';
            }
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
			header('Location: '.$home_url);
        }

?>
