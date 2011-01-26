<?php
	session_start();
	require_once('connectvars.php');
  
	//sprawdza czy uzytkownik nie jest zalogowany
	if (isset($_SESSION['id_obecne']) ) {
		//sprawdza czy uzytkownik przeslal formularz logowania
		if (isset($_POST['zmien_haslo']) ) {
			// Łączenie się z bazą danych.
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

			// Pobieranie nowego hasla od uzytkownika
			$haslo = mysqli_real_escape_string($dbc, trim($_POST['haslo']));
			$haslo2 = mysqli_real_escape_string($dbc, trim($_POST['haslo2']));

			if (!empty($haslo) && !empty($haslo2) && $haslo == $haslo2 ) {
				
				// Wstawianie nowego hasla do bazy
				$id_obecne = $_SESSION['id_obecne'];
				$query = "UPDATE dane SET haslo = SHA('$haslo') WHERE  id = '$id_obecne'";
				$data = mysqli_query($dbc, $query);
				
				mysqli_close($dbc);
				
				
					// Hasło poprawnie zmieniono
					$_SESSION['pokaz'] =  1;
					$_SESSION['err_zmiana_hasla'] = "Hasło poprawnie zmieniono.";
					$home_url = $_SERVER['HTTP_REFERER'].'#zmien_haslo_div';
					header('Location: '.$home_url);
				
			}
			else {
				//uzytkownik nie wypelnil wszystkich pól
				$_SESSION['pokaz'] =  1;
				$_SESSION['err_zmiana_hasla'] = "<p class='error'>Musisz dwa razy poprawnie wpisać nowe hasło, aby zmienić.</p>";
				$home_url = $_SERVER['HTTP_REFERER'].'#zmien_haslo_div';
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
	
?>

