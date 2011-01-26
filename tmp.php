<?php
	session_start();
	require_once('connectvars.php');
	require_once('appvars.php');
  
	//sprawdza czy uzytkownik nie jest zalogowany
	if (isset($_SESSION['id_obecne']) ) {
		//sprawdza czy uzytkownik przeslal formularz logowania
		if (isset($_POST['utworz_cv']) ) {
			// Łączenie się z bazą danych.
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

			//
			//
			// Pobieranie danych  podanych przez użytkownika.
			$zdjecie = $_FILES['zdjecie']['name'];
			$zdjecie_rozm = $_FILES['zdjecie']['size'];
			$zdjecie_typ = $_FILES['zdjecie']['type'];
			
			$cel = "zdjecia/".time().$zdjecie;
			move_uploaded_file($_FILES['zdjecie']['tmp_name'], $cel);
			
			
			
				if ( ( ($zrzut_typ =='image/jpeg') || ($zrzut_typ =='image/pjpeg')  ) && ($zrzut_rozm > 0) && ($zrzut_rozm <= MAXFILESIZE) ) {
		
					$id_obecne = $_SESSION['id_obecne'];
					$query = "INSERT INTO pracownik (zdjecie) VALUES('$cel') WHERE id = '$id_obecne";
					$result = mysqli_query($dbc, $query) or die("Błąd doanie do bazy");
			
					$_SESSION['msg_cv'] = 'Poprawnie edytowano cv. Zadowolony ze zmian?';
					$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/cv.php';
					header('Location: '.$home_url);

				}
				else { 
					$_SESSION['msg_cv'] = 'Zdjęcie musi być plikiem JPEG lub PNG, mniejszym niż 32 kB';
					@unlink($_FILES['zdjecie']['tmp_name']);
					$home_url = $_SERVER['HTTP_REFERER'];
					header('Location: '.$home_url);
				}
			//
			//
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

