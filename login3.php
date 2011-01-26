<?php
	session_start();
	require_once('connectvars.php');
  
	//sprawdza czy uzytkownik nie jest zalogowany
	if (!isset($_SESSION['id_obecne']) ) {
		//sprawdza czy uzytkownik przeslal formularz logowania
		if (isset($_POST['submit']) ) {
			// Łączenie się z bazą danych.
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

			// Pobieranie danych logowania podanych przez użytkownika.
			$user_username = mysqli_real_escape_string($dbc, trim($_POST['login_log']));
			$user_password = mysqli_real_escape_string($dbc, trim($_POST['haslo_log']));


    
			if (!empty($user_username) && !empty($user_password) ) {
				// Wyszukiwanie nazwy i hasła w bazie.
				$query = "SELECT login, id, typ, aktywacja FROM dane WHERE login = '$user_username' AND haslo = SHA('$user_password')";
				$data = mysqli_query($dbc, $query);

				if (mysqli_num_rows($data) == 1) {

                                    //
					// Dane są poprawne, dlatego można przypisać identyfikator i nazwę użytkownika do zmiennych.
					$row = mysqli_fetch_array($data);
                                 if ($row['aktywacja'] == 1) {
					session_regenerate_id();
					$id = $row['id'];
					$_SESSION['id_obecne'] =  $id;
					$typ = $row['typ'];
					$_SESSION['typ'] =  $typ;
					
					if ($typ == 'f' ) {
						$query = "SELECT nazwa FROM firma WHERE id = '$id'";
					}
					if ($typ == 'p' ) {
						$query = "SELECT imie, nazwisko FROM pracownik WHERE id = '$id' ";
					}
					$data = mysqli_query($dbc, $query);
					$row = mysqli_fetch_array($data);
					
					$_SESSION['do_wyswietlenia'] = $row['imie'] .' '. $row['nazwisko'] . $row['nazwa'];
					mysqli_close($dbc);
					
					$home_url = $_SERVER['HTTP_REFERER'];
					header('Location: '.$home_url);
				
      }
    else {
        $_SESSION['msg'] = "Twoje konto nie zostało aktywowane. Sprawdź swoją skrzynkę mailową";
        $home_url = $_SERVER['HTTP_REFERER'];
					header('Location: '.$home_url);
    }
                                }
				else {
					// Para nazwa - hasło jest nieprawidłowa, 
					$_SESSION['login_tmp'] =  $user_username;
					$_SESSION['msg'] = "Musisz podać poprawny login i hasło, aby się zalogować.";
					$home_url = $_SERVER['HTTP_REFERER'];
					header('Location: '.$home_url);
				}
			}
			else {
				//uzytkownik nie wypelnil wszystkich pól
				$_SESSION['login_tmp'] =  $user_username;
				$_SESSION['msg'] = "Musisz podać login i hasło, aby się zalogować.";
				$home_url = $_SERVER['HTTP_REFERER'];
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

