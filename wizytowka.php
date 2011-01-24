<?php
session_start();
?>
<?php
require_once('header.php');
require_once('connectvars.php');
?>

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
        $query = "SELECT * FROM firma WHERE id='$id'";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
    ?>
        <br />
        <br />
        <div id="wizytowka">
            <?php echo $row['nazwa']; ?><br />
            <div id="dane_firmy" style="display:block">
                <h4>Dane firmy </h4>
                <table>
                    <tr>
                        <td><p>	
    				<?php if (!empty($row['adres'])) { ?>Adres:<br />  <?php } ?>
                                <?php if (!empty($row['tel'])) { ?>Telefon Kontaktowy:<br /> <?php } ?>
    				Email:<br />
                                <?php if (!empty($row['branza'])) { ?>Branża: <br/> <?php } ?>
                                <?php if (!empty($row['opis'])) { ?>Opis:<br/> <?php } ?>
                        </td>
                        <td><p>
                               
                                <?php if (!empty($row['adres'])) { ?>
                                    <?php echo $row['adres']; ?>
                                <?php }
                                if (!empty($row['tel'])) { ?>
                                    <br /> <?php echo $row['tel']; ?>
                                <?php } ?>
                                <br /><?php echo $row['email']; 
                                if (!empty($row['branza'])) { ?>
                                    <br/><?php echo $row['branza']; ?>
                                <?php } if (!empty($row['opis'])) { ?>
                                    <br/><?php echo $row['opis']; ?>
                                <?php } ?>
                        </td>
                        <td><?php if (!empty($row['zdjecie'])) { ?>
                            <img src="<?php echo $row['zdjecie']; ?>" alt="zdjęcie" align="right"/>
                        <?php } ?></td>

                    </tr>
                </table>
            </div>
            <br/>
        </div>
        <br /><br />
        <center>
        <?php
            if ($_SESSION['id_obecne'] == $id) {
                echo '<a href="edytuj_wiz.php">Edytuj</a>';
            }
      } else { //jezeli niezalogowany
        ?>
         <br/><br/>
                Zaloguj się lub <a href='index.php'>zarejestruj</a>, aby mieć dostęp do tej strony.
         <br/><br/>
        <?php
     }
        ?>
       </center> </td>
                </tr>
<?php
      require_once('footer.html');
?>