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
        <div class="profil2" ><table border="0"><tr><td>
        <?php if ($_SESSION['typ'] == 'f') {
 ?>

                            <img src="img/panel2.jpg" alt="panel firmy"><br />
                            <a id="zmien_haslo"> <img src="img/haslo.jpg" alt="zmien hasło"> </a><br />
                            <a href="wizytowka.php?id=<?php echo $_SESSION['id_obecne']; ?>" > Pokaż wizytówkę </a><br/>
                            <a href="edytuj_wiz.php"> Edytuj wizytówkę </a> <br />


<?php } ?>

<?php if ($_SESSION['typ'] == 'p') { ?>
                        <img src="img/panel1.jpg" alt="panel"><br />
                        <a id="zmien_haslo"> <img src="img/haslo.jpg" alt="zmien hasło"> </a><br />
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
        <div class="nav" ><center>
                <div id="ogloszenia_div" style="display:none" >
                        <b>Twoje ogłoszenia:</b>
                        <?php
                            $query2 = "SELECT * FROM  branza, firma, ogloszenie, odp WHERE ogloszenie.id_firmy = firma.id AND branza.branza_id = ogloszenie.branza_id AND odp.pracownik_id='$id_obecne' AND ogloszenie.id= odp.ogl_id ORDER BY dodano DESC ";
                            $result2 = mysqli_query($dbc, $query2);
                            $licznik = 1;
                            while ($row2 = mysqli_fetch_array($result2)) {
                                $firma = $row2['nazwa'];
                                $dodano = $row2['dodano'];
                                $branza = $row2['branza_nazwa'];
                                $tresc = $row2['tresc'];
                                $odp_data = $row2['data'];
                        ?>
                                <h2>Ogłoszenie <?php echo $licznik;
                                $licznik++ ?></h2>
                                Dodano: <?php echo $dodano; ?><br/>
                                Branża: <?php echo $branza; ?><br/>
                                Firma: <?php echo $firma; ?><br/>
<?php echo $tresc; ?><br/><br/>
                                Przesłano CV: <?php echo $odp_data;
                            } ?>

                            <br/>Narazie żadnych <br/>
                    </div></center>

            </div>
        </div>

   
<?php
                            mysqli_close($dbc);
                        } else { //jezeli niezalogowany
?>
                            <br/><br/><center>
                            	Zaloguj się lub <a href='index.php'>zarejestruj</a>, aby mieć dostęp do tej strony.
                                <br/><br/></center>
    <?php
                        }
    ?>
                    </td>
                    </tr>
<?php
                        require_once('footer.html');
?>