<?php
session_start();
?>
<?php
require_once('header.php');
?>
<!-- tablica z ogłoszeniami 
<tr>
<?php //if (isset($_SESSION['id_obecne'])) { ?>
        <td class="featured">
				<div style="z-index:1; left:412px; top:570px; position: absolute;"> 
				<a href="reszta"><img src="button.jpg"></a>
				</div>
				</td>
<?php //} ?>
			</tr>
			 koniec tablicy -->

<td class="content" style="padding-right: 44px; padding-left: 44px">


    <?php
    //jezeli zalogowany
    if (isset($_SESSION['id_obecne'])) {
    ?>

        <br/>
        <div>
        <?php
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('błąd bazy');
        $id_obecne = $_SESSION['id_obecne'];
        if ($_SESSION['typ'] == 'p') {
            $query = "SELECT * FROM dane, pracownik WHERE dane.id = '$id_obecne' AND dane.id = pracownik.id";
        } else {
            $query = "SELECT * FROM dane, firma WHERE dane.id = '$id_obecne' AND dane.id = firma.id";
        }
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);

        $login = $row['login'];
        if ($_SESSION['typ'] == 'p') {
            $imie = $row['imie'];
            $nazwisko = $row['nazwisko'];
        } else {
            $nazwa = $row['nazwa'];
        }
        $email = $row['email'];
        $dolaczyl = $row['dolaczyl'];
        ?>
        <div class="profil2" ><table ><tr><td>
        <?php if ($_SESSION['typ'] == 'f') {
 ?>

                            <img src="img/panel2.jpg" alt="panel firmy"><br />
                            <a id="zmien_haslo_wypisz"> <img src="img/haslo.jpg" alt="zmien hasło"> </a><br />
                            <a href="wizytowka.php?id=<?php echo $_SESSION['id_obecne']; ?>" ><img src="img/wizit.jpg" alt="pokaz wizytowke"> </a><br/>
                            <a href="edytuj_wiz.php"> <img src="img/wizit2.jpg" alt="edytuj wizytowke">  </a> <br />


<?php } ?>

<?php if ($_SESSION['typ'] == 'p') { ?>
                        <img src="img/panel1.jpg" alt="panel"><br />
                        <a id="zmien_haslo_wypisz"> <img src="img/haslo.jpg" alt="zmien hasło"> </a><br />
                        <a href="cv.php?id=<?php echo $_SESSION['id_obecne']; ?>"> <img src="img/show2.jpg" alt="pokaż cv" > </a> <br />
                        <a href="edytuj_cv.php"> <img src="img/edit2.jpg" alt="edytuj cv"> </a> <br />
                        <a id="ogloszenia"> <img src="img/ur_oglo.jpg" alt="twoje ogłoszenia"> </a> <!--narazie nico -->
<?php } ?>				</td><td>			  
                        <p>Login: <?php echo $login; ?></p>
<?php if ($_SESSION['typ'] == 'p') { ?>
                        <p>Imię: <?php echo $imie; ?></p>
                        <p>Nazwisko: <?php echo $nazwisko; ?></p>
<?php
                    } else {
?>	
                        <p>Nazwa firmy: <?php echo $nazwa; ?></p>
<?php }
?>
                        <p>Email: <?php echo $email; ?></p>
                        <p>Zarejestrowany od: <?php echo $dolaczyl; ?></p>
                        <div id="zmien_haslo_div" <?php if ($_SESSION['pokaz'] != 1) {
                            echo 'style="display:none"';
                        } $_SESSION['pokaz'] = 0; ?> ><fieldset>
                                <form method="post" action="zmien_haslo.php">
                                    <label for="haslo" >Nowe hasło:</label>
                                    <input type="password" id="haslo" name="haslo" /><br />
                                    <label for="haslo2" >Powtórz nowe hasło:</label>
                                    <input type="password" id="haslo2" name="haslo2" /><br />
                                    <div id="ok">
                                        <input type="submit" id="zmien_haslo" name="zmien_haslo" value='OK'/></div>
                                </form></fieldset>
                            <?php
                            echo $_SESSION['err_zmiana_hasla'];
                            $_SESSION['err_zmiana_hasla'] = "";
                            ?>
                        </div>
                        </td></tr></table>
        </div>
        <div class="nav" >
                <?php echo $_SESSION['msg_aplikuj']; $_SESSION['msg_aplikuj']=""; ?>
                <div id="ogloszenia_div" <?php if($_SESSION['pokazuj'] != 1) { echo 'style="display:none"';  } else {$_SESSION['pokazuj'] = 0;} ?> >
                       <br />                       <br />
                       <br />

                        <?php
                            $query2 = "SELECT *,firma.id AS firma_id FROM  branza, firma, ogloszenie, odp WHERE ogloszenie.id_firmy = firma.id AND branza.branza_id = ogloszenie.branza_id AND odp.pracownik_id='$id_obecne' AND ogloszenie.id= odp.ogl_id ORDER BY dodano DESC ";
                            $result2 = mysqli_query($dbc, $query2);
                            $licznik = 1;
                            while ($row2 = mysqli_fetch_array($result2)) {
                                $firma_id = $row2['firma_id'];
                                $firma = $row2['nazwa'];
                                $dodano = $row2['dodano'];
                                $branza = $row2['branza_nazwa'];
                                $tresc = $row2['tresc'];
                                $odp_data = $row2['data'];
                                $id = $row2['id'];
                        ?><div id="lala">
                               <b> Ogłoszenie <?php echo $licznik;
                                $licznik++ ?></b> &diams;
                                Dodano: <?php echo $dodano; ?> &diams;
                                Branża: <?php echo $branza; ?> &diams;
                                Firma: <a href="wizytowka.php?id=<?php echo $firma_id ?>"><?php echo $firma; ?></a></div>
								<div id="la"><b>
<?php echo $tresc; ?></b></div><div id="al">
                                Przesłano CV: <?php echo $odp_data;?>
                                | <a href="rezygnuj.php?id=<?php echo $id; ?>" onclick="sprawdz(event,this,'')">Rezygnuj</a> <br /><br/>
                               <?php
                           } ?><br /></div><br /><br />

                            <?php if ($licznik == 1) {?>

                            <br/>Narazie żadnych <br/>
                            <?php } ?>
                    </div>

            </div>
        </div>

   
<?php
                            mysqli_close($dbc);
                        } else { //jezeli niezalogowany
?>
                            <br/><br/>
                            	Zaloguj się lub <a href='index.php'>zarejestruj</a>, aby mieć dostęp do tej strony.
                                <br/><br/>
    <?php
                        }
    ?>
                    </td>
                    </tr>
<?php
                        require_once('footer.html');
?>