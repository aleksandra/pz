<?php
session_start();
?>
<?php
	require_once('header.php');
?>

<!--edycja wizytowki -->
<td class="content" style="padding-right: 44px; padding-left: 44px">
    <?php //jezeli zalogowany
	if (isset($_SESSION['id_obecne'])) {
            if ($_SESSION['typ'] == 'f' ) {
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$id_obecne = $_SESSION['id_obecne'];
		$query = "SELECT * FROM firma WHERE id = '$id_obecne'";
		$result = mysqli_query($dbc, $query);
		$row = mysqli_fetch_array($result);
    ?>

    <div id="wiz_edit">
    <br /><br />
	<?php echo $_SESSION['msg_wiz']; $_SESSION['msg_cv'] = '';?>
	<form enctype="multipart/form-data" method="POST" action="create_wiz.php" onSubmit="return wal_wiz(this)" >
            <fieldset>

		<legend>Dane firmy</legend>
                    <label for="nazwa">Nazwa:</label>
                    <input type="text" name="nazwa" id="nazwa" value="<?php echo $row['nazwa']; ?>"/><br/>
                    <label for="adres">Adres:</label>
                    <input type="text" name="adres" id="adres" value="<?php echo $row['adres']; ?>"/><br/>
                    <label for="tel">Telefon:</label>
                    <input type="text" name="tel" id="tel" value="<?php echo $row['tel']; ?>"/><br/>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>"/><br/>
                    <label for="branza">Branża:</label>
                    <input type="text" name="branza" id="branza" value="<?php echo $row['branza']; ?>"/><br/>
                    <label for="opis">Opis:</label><br/>
                    <textarea name="opis" id="opis" rows="10" cols="62" ><?php echo $row['opis']; ?> </textarea><br/>

            </fieldset>
            <fieldset >
                    <legend>Zdjęcie</legend>
                    <label for="zdjecie">Zdjęcie w formacie jpg, nie większe niż 32 kB.</label><br/>
                    <input type="file" id="zdjecie" name="zdjecie" />
            </fieldset>
            <input type="submit" name="edytuj_wiz" id="edytuj_wiz" value="Edytuj" />
	</form>
	<br/>
    </div><br /><br /><div id="pokaz_button">
	<a href="wizytowka.php?id=<?php echo $_SESSION['id_obecne']; ?>">Pokaż wizytówkę bez wprowadzonych zmian</a>
	<?php
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
		mysqli_close($dbc);
	?></div>
</td>
</tr>
<?php
require_once('footer.html');
?>