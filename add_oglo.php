<?php
	session_start();
	require_once('connectvars.php');

	//sprawdza czy uzytkownik nie jest zalogowany
	if (isset($_SESSION['id_obecne']) ) {
            if( $_SESSION['typ'] == 'f') {
                //sprawdza czy uzytkownik przeslal formularz logowania
		if (isset($_POST['add_oglo']) ) {
			// Łączenie się z bazą danych.
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        $branza = mysqli_real_escape_string($dbc, trim($_POST['branza']));
			$tresc = mysqli_real_escape_string($dbc, trim($_POST['tresc']));

                        if (!empty($branza) && !empty($tresc) ) {
                            // Wstawianie nowego hasla do bazy
				$id_obecne = $_SESSION['id_obecne'];
				$query = "INSERT INTO ogloszenie (id_firmy, branza_id, tresc) VALUES ('$id_obecne', '$branza', '$tresc')";
				$data = mysqli_query($dbc, $query);

				mysqli_close($dbc);


					// oglo poprawnie zmieniono
					$_SESSION['pokaz'] =  0;
					$_SESSION['git_add_oglo'] = "Ogłoszenie dodane poprawnie.";
					$home_url = $_SERVER['HTTP_REFERER'];
					header('Location: '.$home_url);
                        }
                        else {
                            //uzytkownik nie wypelnil wszystkich pól
				$_SESSION['pokaz'] =  1;
                                $_SESSION['branza'] =  $branza;
                                $_SESSION['tresc'] = $tresc;
				$_SESSION['err_add_oglo'] = "<p class='error'>No i po co Ci ogłoszenie bez <b>treści</b></p>";
				$home_url = $_SERVER['HTTP_REFERER'].'#add_oglo';
				header('Location: '.$home_url);
                        }



        }
		//jeżeli wszedl nie poprzez submit
		else {
			$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
			header('Location: '.$home_url);
		}

             }
	//jezeli jest już zalogowany
	else {
		$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
		header('Location: '.$home_url);
	}
        }

	//jezeli jest już zalogowany
	else {
		$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
		header('Location: '.$home_url);
	}


?>
