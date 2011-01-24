<?php

session_start();
require_once('connectvars.php');

//sprawdza czy uzytkownik jest zalogowany
if (isset($_SESSION['id_obecne'])) {
    //sprawdza czy uzytkownik przeslal dane przez formularz
    if (isset($_POST['edytuj_wiz'])) {
        // Łączenie się z bazą danych.
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        $id_obecne = $_SESSION['id_obecne'];

        // Pobieranie danych podanych przez użytkownika
        $nazwa = $_POST['nazwa'];
        $adres = $_POST['adres'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $branza = $_POST['branza'];
        $opis = $_POST['opis'];


        $query = "UPDATE firma SET nazwa = '$nazwa' , adres = '$adres',
                    tel = '$tel', email = '$email', email = '$email', opis = '$opis' WHERE id = '$id_obecne' ";
        $result = mysqli_query($dbc, $query) or die("Błąd dodanie do bazy");



        //pobieranie danych ponych przez uzytkownika ZDJECIE
        $zdjecie = $_FILES['zdjecie']['name'];
        $zdjecie_rozm = $_FILES['zdjecie']['size'];
        $zdjecie_typ = $_FILES['zdjecie']['type'];

        if (!empty($zdjecie)) {

            if (( ($zdjecie_typ == 'image/jpeg') || ($zdjecie_typ == 'image/pjpeg') ) && ($zdjecie_rozm > 0) && ($zdjecie_rozm <= MAXFILESIZE)) {
                $cel = "zdjecia/" . time() . $zdjecie;
                move_uploaded_file($_FILES['zdjecie']['tmp_name'], $cel);


                $query = "UPDATE firma SET zdjecie = '$cel' WHERE firma.id = '$id_obecne' ";
                $result = mysqli_query($dbc, $query) or die("Błąd doanie do bazy");

                mysqli_close($dbc);

                $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/wizytowka.php';
                header('Location: ' . $home_url);
            } else {
                //
                $_SESSION['msg_wiz'] = 'Zdjęcie musi być plikiem JPEG lub PNG, mniejszym niż 32 kB';
                @unlink($_FILES['zdjecie']['tmp_name']);
                $home_url = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $home_url);
            }
        } else {
            //
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/wizytowka.php';
            header('Location: ' . $home_url);
        }
    }
    //jeżeli wszedl nie poprzez formularz
    else {
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
        header('Location: ' . $home_url);
    }
}
//jezeli nie jest zalogowany
else {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
    header('Location: ' . $home_url);
}
?>

