<?php
session_start();
?>
<?php
require_once('header.php');
require_once('connectvars.php');
?>

<!--edycja cv -->
<td class="content" style="padding-right: 44px; padding-left: 44px">

    <?php
    //jezeli zalogowany
    if (isset($_SESSION['id_obecne'])) {
        if (!isset($_GET['id'])) {
            $id = $_SESSION['id_obecne'];
        } else {
            $id = $_GET['id'];
        }
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * FROM pracownik WHERE id='$id'";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
    ?>
	<br/><br/>
	<img src="img/cv.jpg"><br /><br />
        <div id="cv">

            

            <div id="dane_osobowe" style="display:block">
                <h4>Dane osobowe </h4>
                <table>
                    <tr>
					<td><p>
					Imię i nazwisko:<br />
					Data i miejsce urodzenia:<br />
					Adres:<br />
					Telefon Kontaktowy:<br />
					Email:<br />
					Stan cywilny:<br /></p>
                        <td><p><?php echo $row['imie'] . ' ' . $row['nazwisko']; ?><br />
                    <?php if (!empty($row['data_ur']) || !empty($row['miejsce_ur'])) { ?>
                    <?php echo $row['data_ur'] . ', ' . $row['miejsce_ur']; ?><br />
                   
                    <?php
                    }
                    if (!empty($row['adres'])) {
                    ?>
                    <?php echo $row['adres']; ?>
                   
                    <?php
                    }
                    if (!empty($row['tel'])) {
                    ?>
                    <br /> <?php echo $row['tel']; ?>
                    
                    <?php } ?>
                    <br /><?php echo $row['email']; ?><br />
                   
                    <?php if (!empty($row['stan_cywilny'])) { ?>
                    
                         <?php echo $row['stan_cywilny']; ?></p></td>
												<td><?php if (!empty($row['zdjecie'])) { ?>
                    <img src="<?php echo $row['zdjecie']; ?>" alt="zdjęcie" />
                <?php } ?></td>

                    </tr>
					
                    <?php } ?>
            </table>

        </div>

        <div id="wyksztalcenie" style="display:block">
            <h4>Wykształcenie </h4>
            <table>
                <?php
                $query = "SELECT * FROM wyksztalcenie WHERE id_pracownika = '$id' ORDER BY od DESC";
                $result = mysqli_query($dbc, $query);
                while ($row = mysqli_fetch_array($result)) {

                    if ($row['gdzie'] != "") {?>
                    <tr>
                        <td><?php echo $row['od']; ?> - <?php echo $row['do']; ?></td><td><?php echo $row['gdzie']; ?></td>
                    </tr>
<?php
                    }}
?>
            </table>
        </div>

        <div id="doswiadczenie" style="display:block">
            <h4>Doświadczenie zawodowe </h4>
    <table>
<?php
                $query = "SELECT * FROM doswiadczenie WHERE id_pracownika = '$id' ORDER BY od DESC";
                $result = mysqli_query($dbc, $query);
                while ($row = mysqli_fetch_array($result)) {
                    if ($row['gdzie'] != "") {
                    ?>
                    <tr>
                        <td><?php echo $row['od']; ?> - <?php echo $row['do']; ?></td><td><?php echo $row['gdzie']; ?></td>
                    </tr>
<?php
                    } }
?>
            </table>
        </div>

		<!--JEZYKI-->
       <div id="jezyki" style="display:block">
            <h4>Znajomość języków</h4>
            <table>

                <?php
                $query = "SELECT *,jezyki_lista.nazwa AS jezyk_nazwa, jezyki_poziom.nazwa AS jezyk_poziom FROM jezyki, jezyki_lista, jezyki_poziom WHERE jezyki.pracownik_id = '$id' AND jezyki.jezyk_id = jezyki_lista.id AND jezyki.poziom_id =jezyki_poziom.id  ORDER BY jezyki_lista.id";
                $result = mysqli_query($dbc, $query);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['jezyk_nazwa']; ?></td><td> <?php echo $row['jezyk_poziom']; ?></td>
                    </tr>
<?php
                }
?>

            </table>
        </div>
		
		  <!--DODATKOWE-->
           <div id="dodatkowe" style="display:block">
            <h4>Dodatkowe umiejętności, kursy, zaświadczenia</h4>
            <table>
                <?php
                $query = "SELECT * FROM dodatkowe WHERE pracownik_id = '$id' ";
                $result = mysqli_query($dbc, $query);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['nazwa']; ?></td>
                    </tr>
<?php
                }
?>
            </table>
        </div>
		
       

        <br/>
    </div><br /><br /><div class="edytuj_button">
    <?php
                if ($_SESSION['id_obecne'] == $id) {

                    echo '<a href="edytuj_cv.php"><img src="img/edit.jpg" ></a>';
                }
            } else { //jezeli niezalogowany
    ?>
                <br/><br/><br/><br/>
                        				Zaloguj się lub <a href='index.php'>zarejestruj</a>, aby mieć dostęp do tej strony.
                <br/><br/>
<?php
            }
?><br/><br/>
           </div> </td>
            </tr>
<?php
            require_once('footer.html');
?>