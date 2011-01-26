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
		<table ><tr><td>
		<?php if (!empty($row['zdjecie'])) { ?>
                            <img src="<?php echo $row['zdjecie']; ?>" alt="zdjęcie"/>
                        <?php } ?>
						</td><td>
      <h3>      <?php echo $row['nazwa']; ?></h3>
            <div id="dane_firmy" style="display:block">
                <h4>Dane firmy </h4>
                
    				<?php if (!empty($row['adres'])) { ?>Adres: <?php echo $row['adres']; ?><br />  <?php } ?>
                                <?php if (!empty($row['tel'])) { ?>Telefon Kontaktowy: <?php echo $row['tel']; ?> <br /><?php } ?>
					 <?php if (!empty($row['email'])) { ?>Email: <?php echo $row['email']; ?> <br /><?php } ?>
                                <?php if (!empty($row['branza'])) { ?>Branża: <?php echo $row['branza']; ?><br /><br /> <?php } ?>
                               <div id="opis">
							   <?php if (!empty($row['opis'])) { ?><b>Opis:</b> <?php echo $row['opis']; ?><br /><?php } ?>
                        </div>
                        
                               
                              
                        </td>

                    </tr>
                </table>
            </div>
            <br/>
        </div>
        <br /><br />
        <div class="edytuj_button">
        <?php
            if ($_SESSION['id_obecne'] == $id) {
                echo '<a href="edytuj_wiz.php"><img src="img/blue1.jpg" alt="pokaz wizytowke" ></a></a>';
            }
      } else { //jezeli niezalogowany
        ?>
         <br/><br/>
                Zaloguj się lub <a href='index.php'>zarejestruj</a>, aby mieć dostęp do tej strony.
         <br/><br/>
        <?php
     }
        ?><br /><br />
        </div> </td>
                </tr>
<?php
      require_once('footer.html');
?>