<?php
	session_start();
	require_once('connectvars.php');
  
	//sprawdza czy uzytkownik nie jest zalogowany
	if (!isset($_SESSION['id_obecne']) ) {
		//sprawdza czy uzytkownik przeslal formularz rejestracji
		if (isset($_POST['rejestruj'])) {
			
			$typ = $_POST['typ'];
			$login = $_POST['login'];
			$haslo = $_POST['haslo'];
			$haslo2 = $_POST['haslo2'];
			$imie = $_POST['imie'];
			$nazwisko = $_POST['nazwisko'];
			$nazwa_firmy = $_POST['nazwa_firmy'];
			$email = $_POST['email'];
			
			// Łączenie się z bazą danych.
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$query = "SELECT id FROM dane WHERE login='$login'";
			$result = mysqli_query($dbc, $query);
			 
			 //sprawdza czy nie ma takiego loginu w bazie
			if(mysqli_num_rows($result) == 0){
			
				//sprawdza czy wszystkie pola sa wypelnione
				if(!empty($login) && !empty($haslo) && !empty($haslo2) && ( ( !empty($imie) && !empty($nazwisko) ) || (!empty($nazwa_firmy)) ) && !empty($email) &&  $haslo == $haslo2) {
					//dodaje
                                        $klucz = rand(10000,99999);
					$query = "INSERT INTO dane (login, haslo,typ, klucz) VALUES ('$login', SHA('$haslo'), '$typ', '$klucz')";
					$result = mysqli_query($dbc, $query) or die('Nie udało się utworzyć profilu, spróbuj później<br/>');
					
					$query = "SELECT id FROM dane WHERE login='$login'";
					$result = mysqli_query($dbc, $query);
					$row = mysqli_fetch_array($result);
					$id = $row['id'];
					
					if ($typ == 'p' ) {
						$query = "INSERT INTO pracownik (id, imie, nazwisko, email) VALUES ('$id', '$imie', '$nazwisko', '$email') ";
					}
					if ($typ == 'f') {
						$query = "INSERT INTO firma (id, nazwa, email) VALUES ('$id', '$nazwa_firmy', '$email') ";
					}
					$result = mysqli_query($dbc, $query) or die('cos nie tak');
					mysqli_close($dbc);
					
					$_SESSION['error']='';
					$_SESSION['do_wyswietlenia'] = $imie .' '. $nazwisko . $nazwa_firmy;
					$_SESSION['ok'] = 'Utworzenie profilu powiodło się.  ';
						//$_SESSION['id_obecne'] = $id;
                                                //$_SESSION['typ'] = $typ;

                                               
                                                $link = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/aktywacja.php?id='.$id.'&key='.$klucz;
                                                 $msg = 'Kliknij w link, aby aktywować swoje konto w serwisie ePortal<br/><a href="'.$link.'">'.$link.'</a>';
                                                $_SESSION['link'] = $msg;
                                                $from = 'From: ola@efirma.pl';
                                                mail($email, 'Aktywacja konta.', $msg, $from );

						$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
						header('Location: '.$home_url);
				}
				else {
					$_SESSION['error'] = "Wypełnij wszystkie pola";
					$_SESSION['login'] = $login;
					$_SESSION['typ'] = $typ;
					$_SESSION['imie'] = $imie;
					$_SESSION['nazwisko'] = $nazwisko;
					$_SESSION['nazwa_firmy'] = $nazwa_firmy;
					$_SESSION['email'] = $email;
					$home_url = $_SERVER['HTTP_REFERER'];
					header('Location: '.$home_url);
				}
			}
			else {
				$_SESSION['error'] = "Użytkownik o loginie $login już istnieje.";
				$_SESSION['login'] = '';
				$_SESSION['typ'] = $typ;
				$_SESSION['imie'] = $imie;
				$_SESSION['nazwisko'] = $nazwisko;
				$_SESSION['nazwa_firmy'] = $nazwa_firmy;
				$_SESSION['email'] = $email;
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

