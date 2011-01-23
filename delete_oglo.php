<?php

session_start();
require_once('connectvars.php');

//sprawdza czy uzytkownik jest zalogowany
if (isset($_SESSION['id_obecne'])) {
   if( $_SESSION['typ'] == 'f') {
    //sprawdza czy uzytkownik przeslal dane przez formularz
    
        // laczenie sie z baza danych.
         if (isset($_GET['id'])) {

             $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
             $id_obecne = $_SESSION['id_obecne'];
             $id_oglo = $_GET['id'];

             $query = "DELETE FROM ogloszenie WHERE id='$id_oglo' AND id_firmy='$id_obecne'";
             $result = mysqli_query($dbc, $query);

             $_SESSION['git_add_oglo'] = "Ogłoszenie usunięto poprawnie.";
            $home_url = $_SERVER['HTTP_REFERER'];
		header('Location: '.$home_url);


         }
         else {
             $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
             header('Location: ' . $home_url);
        }
      
    }
	//jezeli jest już zalogowany
	else {
		$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
		header('Location: '.$home_url);
	}
}
//jezeli nie jest zalogowany
else {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
    header('Location: ' . $home_url);
}

?>
