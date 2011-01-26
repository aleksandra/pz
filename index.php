<?php
session_start();
?>
<?php
	require_once('header.php');
?>
			<!-- tablica z ogloszeniami -->
			<tr>
				<?php 
					if (isset($_SESSION['id_obecne'])  && $_SESSION['typ'] == 'p') {
				?>
				<td CLASS="featured">
				<div style="z-index:1; left:412px; top:570px; position: absolute;"> 
                                    <a id="oglo_lista"><img alt="button"  src="img/button.jpg"></a>
				</div>
				</td>
				<?php
					}
				?>
			</tr>
			<!-- koniec tablicy -->
			
			 <td CLASS="content" STYLE="padding-right: 44px; padding-left: 44px">
                        
                        <br/>
			<br/>
			 <?php //jezeli zalogowany
				if (isset($_SESSION['id_obecne'])) {
                                    if ($_SESSION['typ'] == 'f') {

                                       
                                        require_once('ogloszenia.php');


                                    }
                                    else {
                                        require_once('show_ogloszenia.php');
                                    }
			?>
			
			<?php
				}
				else {
				//rejestracja jezeli jeszcze nie zalogowany
			echo $_SESSION['link']; $_SESSION['link']=""; echo $_SESSION['aktywacja']; $_SESSION['aktywacja']="";
                               ?>

                        <div id="rejestracja">
		
			Nie masz jeszcze konta? Zarejestruj się.
                         <p class="error"><?php echo $_SESSION['error']; $_SESSION['error']=""; ?></p>
			<form method="post" action="add.php" onSubmit="return wal_rej(this)">
			<input type="radio" name="typ" id="pracownik" value="p" <?php if($_SESSION['typ'] != 'f') { echo 'checked="checked"'; } ?> />Szukasz pracy
			<input type="radio" name="typ" id="firma" value="f" <?php if($_SESSION['typ'] == 'f') {echo 'checked="checked"';} ?>/>Szukasz pracowników
			<br/>
			<label for="login"> Login  </label>
			<input type="text" id="login" name="login" value="<?php echo $_SESSION['login']; ?>" /><br/>
			<label for="haslo"> Hasło </label>
			<input type="password" id="haslo" name="haslo" /><br/>
			<label for="haslo2"> Powtórz hasło </label>
			<input type="password" id="haslo2" name="haslo2" /><br/>
			<div id="p" <?php if($_SESSION['typ'] == 'f') {echo 'style="display:none"';} ?>>
			<label for="imie"> Imię </label>
			<input type="text" id="imie" name="imie" value="<?php echo $_SESSION['imie']; ?>" /><br/>
			<label for="nazwisko"> Nazwisko </label>
			<input type="text" id="nazwisko" name="nazwisko" value="<?php echo $_SESSION['nazwisko']; ?>"/><br/>
			</div>
			<div id="f" <?php if($_SESSION['typ'] != 'f') {echo 'style=" display:none"';}?> >
			<label for="nazwa_firmy"> Nazwa firmy </label>
			<input type="text" id="nazwa_firmy" name="nazwa_firmy" value="<?php echo $_SESSION['nazwa_firmy']; ?>"/><br/>
			</div>
			<label for="email"> Email </label>
			<input type="text" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" /><br/>
			<input type="submit" id="rejestruj" name="rejestruj" value="Utwórz konto" />
			</form>
			`</div>
			<?php 
					} //koniec rejestracji	
			?>
			
			</td>
			</tr>
			<?php 
			require_once('footer.html');
			?>