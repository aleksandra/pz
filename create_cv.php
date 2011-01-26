<?php

session_start();
require_once('connectvars.php');

//sprawdza czy uzytkownik jest zalogowany
if (isset($_SESSION['id_obecne'])) {
    //sprawdza czy uzytkownik przeslal dane przez formularz
    if (isset($_POST['edytuj_cv'])) {
        // Łączenie się z bazą danych.
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        $id_obecne = $_SESSION['id_obecne'];

        // Pobieranie danych podanych przez użytkownika DANE OSOBOWE
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $data_ur = $_POST['data_ur'];
        $miejsce_ur = $_POST['miejsce_ur'];
        $adres = $_POST['adres'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $stan_cywilny = $_POST['stan_cywilny'];


        $query = "UPDATE pracownik SET imie = '$imie' , nazwisko = '$nazwisko', data_ur = '$data_ur', miejsce_ur = '$miejsce_ur',
						adres = '$adres', tel = '$tel', email = '$email', stan_cywilny = '$stan_cywilny' WHERE id = '$id_obecne' ";
        $result = mysqli_query($dbc, $query) or die("Błąd dodanie do bazy");

        //pobieranie danych podanych przez uzytkownika WYKSZTALCENIE
        $query = "SELECT id FROM wyksztalcenie WHERE id_pracownika = '$id_obecne'";
        $dane = mysqli_query($dbc, $query);
        $i=1;
      
        while($row = mysqli_fetch_array($dane)  ) {
        $gdzie = $_POST["wykszt_gdzie$i"];
        if ( $gdzie != "") {
            $od = $_POST["wykszt_od$i"];
            $do = $_POST["wykszt_do$i"];
        }
        else {
            $od = "";
            $do = "";
        }
        $id_wykszt = $row['id'];

        //$row = mysqli_fetch_array($dane);
        
      //  if($row['id'] != $i) {
      //      $query = "INSERT INTO wyksztalcenie (id, id_pracownika, od, do, gdzie) VALUES ('$i', '$id_obecne', '$od', '$do', '$gdzie')";
      //  }
      //  else {
            $query = "UPDATE wyksztalcenie SET od = '$od', do = '$do', gdzie = '$gdzie' WHERE id_pracownika = '$id_obecne' AND id = '$i'";
      // }
        $result = mysqli_query($dbc, $query) or die('blad w');
        $i++;
    }
    while (!empty($_POST["wykszt_gdzie$i"])) {
            $od = $_POST["wykszt_od$i"];
            $do = $_POST["wykszt_do$i"];
            $gdzie = $_POST["wykszt_gdzie$i"];
            $query = "INSERT INTO wyksztalcenie (id, id_pracownika, od, do, gdzie) VALUES ('$i', '$id_obecne', '$od', '$do', '$gdzie')";
            $result = mysqli_query($dbc, $query) or die('blad dos');
            $i++;
        }

        //pobieranie danych podanych przez uzytkownika DOSWIADCZENIE
        $query = "SELECT id FROM doswiadczenie WHERE id_pracownika = '$id_obecne'";
        $dane = mysqli_query($dbc, $query);
        $i=1;

        while($row = mysqli_fetch_array($dane)  ) {

            $gdzie = $_POST["dosw_gdzie$i"];
            if ( $gdzie != "") {
                $od = $_POST["dosw_od$i"];
                $do = $_POST["dosw_do$i"];
            }
            else {
                $od = "";
                $do = "";
            }
            $id_dosw = $row['id'];
      
            $query = "UPDATE doswiadczenie SET od = '$od', do = '$do', gdzie = '$gdzie' WHERE id_pracownika = '$id_obecne' AND id = '$i'";
     
            $result = mysqli_query($dbc, $query) or die('blad d');
            $i++;
        }
        while (!empty($_POST["dosw_gdzie$i"])) {
            $od = $_POST["dosw_od$i"];
            $do = $_POST["dosw_do$i"];
            $gdzie = $_POST["dosw_gdzie$i"];
            $query = "INSERT INTO doswiadczenie (id, id_pracownika, od, do, gdzie) VALUES ('$i', '$id_obecne', '$od', '$do', '$gdzie')";
            $result = mysqli_query($dbc, $query) or die('blad dos');
            $i++;
        }

     //pobieranie danych podanych przez uzytkownika JEZYKI
        $query = "SELECT count(*) FROM jezyki_lista ";
        $dane = mysqli_query($dbc, $query);
       $row = mysqli_fetch_array($dane);
        $ile=$row['count(*)'];
        $i=1;

        while($ile) {
            $id_jezyka = $i; 
            $poziom = $_POST["$i"]; 
            $gotowe=0;


            $query = "SELECT * FROM jezyki WHERE pracownik_id = '$id_obecne' ";
            $dane = mysqli_query($dbc, $query);
           while( $row = mysqli_fetch_array($dane)) {
               $id_jezyka_spr=$row['jezyk_id'];
               
               if( $id_jezyka == $id_jezyka_spr) {
                   if($poziom != 1) {
                        $query = "UPDATE jezyki SET poziom_id = '$poziom' WHERE pracownik_id = '$id_obecne' AND jezyk_id = '$id_jezyka'";
                   }
                   else {
                       $query = "DELETE FROM jezyki WHERE pracownik_id = '$id_obecne' AND jezyk_id = '$id_jezyka'";
                   }
                   $gotowe=1;
               }
              
           }
           if($gotowe ==0 && $poziom != 1 && $poziom != 0) {
                    $query = "INSERT INTO jezyki (pracownik_id, jezyk_id, poziom_id) VALUES ('$id_obecne', '$id_jezyka', '$poziom')";
                   }
               
        
        
        $result = mysqli_query($dbc, $query) or die('blad j');
        $ile--; $i++;
    }


      //pobieranie danych podanych przez uzytkownika DODATKOWE
        $query = "SELECT id FROM dodatkowe WHERE pracownik_id = '$id_obecne'";
        $dane = mysqli_query($dbc, $query);
        $i=1;

        while( $row = mysqli_fetch_array($dane) ) {
            $nazwa = $_POST["dodatk$i"];

//echo $i . $nazwa . $row['id'] . "<br/>";
       // if($row['id'] != $i) {
         //   $query = "INSERT INTO dodatkowe (id, pracownik_id, nazwa) VALUES ('$i', '$id_obecne', '$nazwa')";
        //}
        //else {
            $id_oglo = $row['id'];
            $query = "UPDATE dodatkowe SET nazwa = '$nazwa' WHERE pracownik_id = '$id_obecne' AND id = '$id_oglo'";
      
            $result = mysqli_query($dbc, $query) or die('blad dod');
            $i++;
        }
        while (!empty($_POST["dodatk$i"])) {
            $nazwa = $_POST["dodatk$i"];
            $query = "INSERT INTO dodatkowe (id, pracownik_id, nazwa) VALUES ('$i', '$id_obecne', '$nazwa')";
            $result = mysqli_query($dbc, $query) or die('blad dod');
            $i++;
        }


        //pobieranie danych ponych przez uzytkownika ZDJECIE
        $zdjecie = $_FILES['zdjecie']['name'];
        $zdjecie_rozm = $_FILES['zdjecie']['size']; 
        $zdjecie_typ = $_FILES['zdjecie']['type']; 

        if (!empty($zdjecie)) {

            if (( ($zdjecie_typ == 'image/jpeg') || ($zdjecie_typ == 'image/pjpeg') ) && ($zdjecie_rozm > 0) && ($zdjecie_rozm <= MAXFILESIZE)) {
                $cel = "zdjecia/" . time() . $zdjecie;
                move_uploaded_file($_FILES['zdjecie']['tmp_name'], $cel);


                $query = "UPDATE pracownik SET zdjecie = '$cel' WHERE pracownik.id = '$id_obecne' ";
                $result = mysqli_query($dbc, $query) or die("Błąd doanie do bazy");

                $_SESSION['msg_cv'] = 'Poprawnie edytowano cv. Zadowolony ze zmian?';
                mysqli_close($dbc);

                $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/cv.php?id=' . $_SESSION['id_obecne'];
                header('Location: ' . $home_url);
            } else {
                //
                $_SESSION['msg_cv'] = 'Zdjęcie musi być plikiem JPEG lub PNG, mniejszym niż 32 kB';
                @unlink($_FILES['zdjecie']['tmp_name']);
                $home_url = $_SERVER['HTTP_REFERER'];
                header('Location: ' . $home_url);
            }
        } else {
            //
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/cv.php';
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

