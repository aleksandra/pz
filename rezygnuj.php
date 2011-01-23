<?php


session_start();
require_once('connectvars.php');

//sprawdza czy uzytkownik jest zalogowany i czy jako pracownik
if (isset($_SESSION['id_obecne']) && $_SESSION['typ'] == 'p') {
     $id_ogloszenia = $_GET['id'];
     $id_obecne = $_SESSION['id_obecne'];

      // Łączenie się z bazą danych.
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
     $query = "DELETE FROM odp WHERE ogl_id='$id_ogloszenia' AND pracownik_id='$id_obecne'";
     $result = mysqli_query($dbc, $query) or die('blad');

      mysqli_close($dbc);

      $_SESSION['msg_aplikuj']="Zrezygnowano";
     
      $home_url = $_SERVER['HTTP_REFERER'];
      header('Location: ' . $home_url);



}
//jezeli nie jest zalogowany
else {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
    header('Location: ' . $home_url);
}
?>
