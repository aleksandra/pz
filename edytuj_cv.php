<?php
session_start();
?>
<?php
	require_once('header.php');
?>
			
<!--edycja cv -->
<td class="content" style="padding-right: 44px; padding-left: 44px">
	
	<?php //jezeli zalogowany
		if (isset($_SESSION['id_obecne'])) {
			if ($_SESSION['typ'] == 'p' ) {
			
				$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				$id_obecne = $_SESSION['id_obecne'];
				
				$query = "SELECT * FROM pracownik WHERE id = '$id_obecne'";
				
				$result = mysqli_query($dbc, $query);
				$row = mysqli_fetch_array($result);
				
					
	?>
	<br /><br />
	
	<div id="cv_edit">
		<img src="img/cv.jpg" alt="cv" ><br /><br />
		<?php echo $_SESSION['msg_cv']; $_SESSION['msg_cv'] = '';?>
		<form enctype="multipart/form-data" method="POST" action="create_cv.php" onSubmit="return wal_cv(this)" >
                        <!-- DANE OSOBOWE -->
			<fieldset>
                            <legend>Dane osobowe</legend>
			<fieldset style=" float:right">
			<legend>Zdjęcie</legend>
			<label for="zdjecie">Zdjęcie w formacie jpg, nie większe niż 32 kB.</label><br/>
			<input type="file" id="zdjecie" name="zdjecie" />
			</fieldset>
			
			<label for="imie">Imię:</label>
			<input type="text" name="imie" id="imie" value="<?php echo $row['imie']; ?>"/><br/>
			<label for="nazwisko">Nazwisko:</label>
			<input type="text" name="nazwisko" id="nazwisko" value="<?php echo $row['nazwisko']; ?>"/><br/>
			<label for="data_ur">Data urodzenia:</label>
			<input type="date" name="data_ur" id="data_ur" value="<?php echo $row['data_ur']; ?>"/><br/>
			<label for="miejsce_ur">Miejsce urodzenia:</label>
			<input type="text" name="miejsce_ur" id="miejsce_ur" value="<?php echo $row['miejsce_ur']; ?>"/><br/>
			<label for="adres">Adres:</label>
			<input type="text" name="adres" id="adres" value="<?php echo $row['adres']; ?>"/><br/>
			<label for="tel">Telefon:</label>
			<input type="text" name="tel" id="tel" value="<?php echo $row['tel']; ?>"/><br/>
			<label for="email">Email:</label>
			<input type="email" name="email" id="email" value="<?php echo $row['email']; ?>"/><br/>
			<label for="stan_cywilny">Stan cywilny:</label>
		
<input type="text" name="stan_cywilny" id="stan_cywilny" value="<?php echo $row['stan_cywilny']; ?>"/>
			<br/>
			</fieldset>
			
			<!-- WYKSZTAŁCENIE -->
			<fieldset>
			<legend>Wykształcenie</legend>
			<div id="wykszt">
				Od:<span style="margin-left:150px;">Do:</span><span style="margin-left:150px;">Szkoła:</span><br/>
				<?php 
					$query = "SELECT * FROM wyksztalcenie WHERE id_pracownika = '$id_obecne'";
					$result = mysqli_query($dbc, $query);
                                        $i=0;
					while($row = mysqli_fetch_array($result) ) {
                                        $i++;

				?>
				<input type="text" name="wykszt_od<?php echo $i; ?>" class="wykszt_od" value="<?php echo $row['od']; ?>"/>
				<input type="text" name="wykszt_do<?php echo $i; ?>" class="wykszt_do" value="<?php echo $row['do']; ?>"/>
				<input type="text" name="wykszt_gdzie<?php echo $i; ?>" class="wykszt_gdzie" value="<?php echo $row['gdzie']; ?>"/><br/>
				<?php
					}
                                        $i++;
				?>
				<input type="text" name="wykszt_od<?php echo $i; ?>" class="wykszt_od" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="wykszt_do<?php echo $i; ?>" class="wykszt_do" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);" />
				<input type="text" name="wykszt_gdzie<?php echo $i; ?>" class="wykszt_gdzie" /><br/>
			</div>
                        <a id="dodatk_wykszt1">Jeszcze jedno</a>
                        <?php $i++; ?>
			<div id="dodatk_wykszt1_div" style="display:none">
                            <input type="text" name="wykszt_od<?php echo $i; ?>" class="wykszt_od" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="wykszt_do<?php echo $i; ?>" class="wykszt_do" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="wykszt_gdzie<?php echo $i; ?>" class="wykszt_gdzie" /><br/>
                                <a id="dodatk_wykszt2">Jeszcze jedno</a>
                           </div>
                         <?php $i++; ?>
			<div id="dodatk_wykszt2_div" style="display:none">
                            <input type="text" name="wykszt_od<?php echo $i; ?>" class="wykszt_od" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="wykszt_do<?php echo $i; ?>" class="wykszt_do" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="wykszt_gdzie<?php echo $i; ?>" class="wykszt_gdzie" /><br/>
                                <a id="dodatk_wykszt3">Jeszcze jedno</a>
                           </div>

                        <?php $i++; ?>
			<div id="dodatk_wykszt3_div" style="display:none">
                            <input type="text" name="wykszt_od<?php echo $i; ?>" class="wykszt_od" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="wykszt_do<?php echo $i; ?>" class="wykszt_do" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="wykszt_gdzie<?php echo $i; ?>" class="wykszt_gdzie" /><br/>
                                <a id="dodatk_wykszt4">Jeszcze jedno</a>
                           </div>

                         <?php $i++; ?>
			<div id="dodatk_wykszt4_div" style="display:none">
                            <input type="text" name="wykszt_od<?php echo $i; ?>" class="wykszt_od" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="wykszt_do<?php echo $i; ?>" class="wykszt_do" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="wykszt_gdzie<?php echo $i; ?>" class="wykszt_gdzie" /><br/>
                                
                           </div>
			</fieldset>
			
			<fieldset>
			<legend>Doświadczenie zawodowe</legend>
			<div id="dosw">
				Od:<span style="margin-left:150px;" >Do:</span><span style="margin-left:150px;" >Firma, stanowisko:</span><br/>
				 <?php 
					$query = "SELECT * FROM doswiadczenie WHERE id_pracownika = '$id_obecne'";
					$result = mysqli_query($dbc, $query);
                                        $i=0;
					while($row = mysqli_fetch_array($result) ) {
                                        $i++;

				?>
                                
                                <input type="text" name="dosw_od<?php echo $i; ?>" class="dosw_od" value="<?php echo $row['od']; ?>"/>
				<input type="text" name="dosw_do<?php echo $i; ?>" class="dosw_do" value="<?php echo $row['do']; ?>"/>
				<input type="text" name="dosw_gdzie<?php echo $i; ?>" class="dosw_gdzie" value="<?php echo $row['gdzie']; ?>"/><br/>

                        <?php
					}
                                        $i++;
				?>
                                <input type="text" name="dosw_od<?php echo $i; ?>" class="dosw_od" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="dosw_do<?php echo $i; ?>" class="dosw_do" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="dosw_gdzie<?php echo $i; ?>" class="dosw_gdzie" /><br/>
			</div>

                        <a id="dodatk_dosw1">Jeszcze jedno</a>
                        <?php $i++; ?>
			<div id="dodatk_dosw1_div" style="display:none">
                            <input type="text" name="dosw_od<?php echo $i; ?>" class="dosw_od" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="dosw_do<?php echo $i; ?>" class="dosw_do" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="dosw_gdzie<?php echo $i; ?>" class="dosw_gdzie" /><br/>
                                <a id="dodatk_dosw2">Jeszcze jedno</a>
                           </div>
                         <?php $i++; ?>
			<div id="dodatk_dosw2_div" style="display:none">
                            <input type="text" name="dosw_od<?php echo $i; ?>" class="dosw_od" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="dosw_do<?php echo $i; ?>" class="dosw_do" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="dosw_gdzie<?php echo $i; ?>" class="dosw_gdzie" /><br/>
                                <a id="dodatk_dosw3">Jeszcze jedno</a>
                           </div>

                        <?php $i++; ?>
			<div id="dodatk_dosw3_div" style="display:none">
                            <input type="text" name="dosw_od<?php echo $i; ?>" class="dosw_od" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="dosw_do<?php echo $i; ?>" class="dosw_do" value="rrrr-mm" style="color:grey"  onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="dosw_gdzie<?php echo $i; ?>" class="dosw_gdzie" /><br/>
                                <a id="dodatk_dosw4">Jeszcze jedno</a>
                           </div>

                         <?php $i++; ?>
			<div id="dodatk_dosw4_div" style="display:none">
                            <input type="text" name="dosw_od<?php echo $i; ?>" class="dosw_od" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="dosw_do<?php echo $i; ?>" class="dosw_do" value="rrrr-mm" style="color:grey" onfocus="czysc(this);" onblur="pisz(this);"/>
				<input type="text" name="dosw_gdzie<?php echo $i; ?>" class="dosw_gdzie" /><br/>

                           </div>

			</fieldset>
			
			<!-- JEZYKI -->
			<fieldset>
			<legend>Znajomość języków</legend>
			<div id="jezyki">

                             <?php
                                $query = "SELECT * FROM jezyki_lista ";
				$result = mysqli_query($dbc, $query);
                                $i=1;
				while($row = mysqli_fetch_array($result) ) {
                                $i++;
                                $nazwa=$row['nazwa'];
                                $id_jezyk=$row['id'];
                                ?>

                            <p><input type="hidden" id="jezyk<?php echo $id_jezyk; ?>" name="jezyk" value="<?php echo $nazwa; ?>" />
                                <?php echo '<b>'.$nazwa.'</b>';

                             $query2 = "SELECT * FROM jezyki_poziom ORDER BY id ";
				$result2 = mysqli_query($dbc, $query2);
                                while($row2 = mysqli_fetch_array($result2) ) {
                                     $nazwa=$row2['nazwa'];
                                     $id=$row2['id'];

                                     $query3 = "SELECT poziom_id FROM jezyki WHERE pracownik_id='$id_obecne' AND jezyk_id='$id_jezyk'";
                                     $result3 = mysqli_query($dbc, $query3);
                                    $row3 = mysqli_fetch_array($result3) ;

                                     ?>
                                <label for="<?php echo $nazwa.$id_jezyk; ?>">
                                <input type="radio" name="<?php echo $id_jezyk; ?>" id="<?php echo $nazwa.$id_jezyk; ?>" value="<?php echo $id; ?>" <?php if ($row3['poziom_id'] == $id) { echo 'checked="checked"'; }  ?> /> <?php echo $nazwa; ?>
                                </label>
                                <?php
                                }
                            ?></p>
                                <?php
                                }
				?>

                        </div>
                        </fieldset>
			
			  <!--DODATKOWE-->
			<fieldset>
			<legend>Dodatkowe umiejętności, kursy, zaświadczenia</legend>
			<div id="dodatkowe">

				<?php
					$query = "SELECT nazwa FROM dodatkowe WHERE pracownik_id = '$id_obecne'";
					$result = mysqli_query($dbc, $query);
                                        $i=0;
					while($row = mysqli_fetch_array($result) ) {
                                        $i++;

				?>
				<input type="text" name="dodatk<?php echo $i; ?>" class="dodatk" value="<?php echo $row['nazwa']; ?>"/>
				<?php
					}
                                        $i++;
				?>
				<input type="text" name="dodatk<?php echo $i; ?>" class="dodatk" /><br/>

			</div>
                        <a id="dodatk_dodatk1">Jeszcze jedno</a>
                        <?php $i++; ?>
			<div id="dodatk_dodatk1_div" style="display:none">
                            <input type="text" name="dodatk<?php echo $i; ?>" class="dodatk" /><br/>

                                <a id="dodatk_dodatk2">Jeszcze jedno</a>
                           </div>
                         <?php $i++; ?>
			<div id="dodatk_dodatk2_div" style="display:none">
                            <input type="text" name="dodatk<?php echo $i; ?>" class="dodatk" /><br/>

                                <a id="dodatk_dodatk3">Jeszcze jedno</a>
                           </div>

                        <?php $i++; ?>
			<div id="dodatk_dodatk3_div" style="display:none">
                            <input type="text" name="dodatk<?php echo $i; ?>" class="dodatk" /><br/>

                                <a id="dodatk_dodatk4">Jeszcze jedno</a>
                           </div>

                         <?php $i++; ?>
			<div id="dodatk_dodatk4_div" style="display:none">
                            <input type="text" name="dodatk<?php echo $i; ?>" class="dodatk" /><br/>


                           </div>
			</fieldset>
			
			<input type="submit" name="edytuj_cv" id="edytuj_cv" value="Edytuj CV" />
			</form>
	<br/>

	</div>	<br /><br /><div id="pokaz_button">
	<a href="cv.php?id=<?php echo $_SESSION['id_obecne']; ?>" onclick="sprawdz(event,this,' Stracisz wprowadzone zmiany. ')"><img src="img/show.jpg" alt="pokaz cv" ></a>
	<br/><br/>
        </div>
        <?php
        mysqli_close($dbc);
			}
			else echo 'Nie możesz tu być, wracaj do siebie!';
		}
		else { //jezeli niezalogowany
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