<?php

    //sprawdza czy uzytkownik jest zalogowany
if (isset($_SESSION['id_obecne'])) {
    if( $_SESSION['typ'] == 'f') {
       $id_obecne=$_SESSION['id_obecne'];
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('błąd bazy');
	
        ?>
       
        <a id="add_oglo_wypisz"> Dodaj ogłoszenie </a>
         <div id="add_oglo_div" <?php  if ($_SESSION['pokaz'] != 1 ) {echo 'style="display:none"';} $_SESSION['pokaz'] = 0;?> >
           <?php
		echo $_SESSION['err_add_oglo'];
		$_SESSION['err_add_oglo'] = "";
	   ?>
           <form method="post" action="add_oglo.php" >
              
                Branża
               <select name="branza">
                   <?php

                   $query = "SELECT * FROM branza ORDER BY branza_nazwa ";
                   $result = mysqli_query($dbc, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        $branza_id=$row['branza_id'];
                        $branza_nazwa=$row['branza_nazwa'];
                    

                   ?>
                   <option value="<?php echo $branza_id; ?>" <?php if ($_SESSION['branza'] == $branza_id) {echo 'selected="selected"'; $_SESSION['branza']=""; }?> > <?php echo $branza_nazwa; ?></option>
                   <?php } ?>
               </select><br/>
                 <label for="tresc">Treść </label><br/>
               <textarea name="tresc" id="tresc" rows="10" cols="62"><?php echo $_SESSION['tresc']; $_SESSION['branza']=""; ?> </textarea><br/>
               <input type="submit" name="add_oglo" id="add_oglo" value="Dodaj" />
           </form>
        
        </div>
       <br/>
           <?php
		echo $_SESSION['git_add_oglo'];
		$_SESSION['git_add_oglo'] = "";

           $query = "SELECT * FROM ogloszenie,branza WHERE id_firmy = '$id_obecne' AND ogloszenie.branza_id = branza.branza_id ORDER BY dodano DESC ";
	$result = mysqli_query($dbc, $query);
	$licznik=1;
                ?>
        <h1> Twoje ogłoszenia: </h1>
        <div id="oglo_lista">
        <?php
        while ($row = mysqli_fetch_array($result)) {
         
        $id = $row['id'];
	$branza = $row['branza_nazwa'];
        $dodano = $row['dodano'];
        $tresc = $row['tresc'];
        ?>

        
            <?php echo $_SESSION['git_edit_oglo'];
		$_SESSION['git_edit_oglo'] = ""; ?>
            <h2>Ogłoszenie <?php echo $licznik; $licznik++?></h2>
            Dodano: <?php echo $dodano; ?><br/>
            Branża: <?php echo $branza; ?><br/>
            <?php echo $tresc; ?><br/>

            <?php
             $query2 = "SELECT *,COUNT(*) FROM odp, pracownik WHERE ogl_id='$id' AND pracownik_id=pracownik.id ORDER BY data DESC";
             $result2 = mysqli_query($dbc, $query2);
             $row2 = mysqli_fetch_array($result2);

            $ile = $row2['COUNT(*)'];
           
            ?>

            <a href="delete_oglo.php?id=<?php echo $id; ?>" onclick="sprawdz(event,this,'')" >Usuń</a> | <a onclick='odpowiedzi("<?php echo $id; ?>")'> Odpowiedzi(<?php echo $ile;?> ) </a>

            <?php if ( $ile > 0 ) { ?>
            <div id="odpowiedzi<?php echo $id; ?>_div" style="display:none">
            
            <?php
            $query3 = "SELECT * FROM odp, pracownik WHERE ogl_id='$id' AND pracownik_id=pracownik.id ORDER BY data DESC";
             $result3 = mysqli_query($dbc, $query3);
             while ($row3 = mysqli_fetch_array($result3)) {
                 $data = $row3['data'];
                $imie_nazwisko = $row3['imie'].' '.$row3['nazwisko'];
                $id_p = $row3['id'];

            echo $data;  ?>
           <a href="cv.php?id=<?php echo $id_p; ?>" ><?php echo $imie_nazwisko; ?></a><br/>
                <?php
                //while ( $row2 = mysqli_fetch_array($result2)) {echo 'lll';
                  //   $data = $row2['data'];
            //$imie_nazwisko = $row2['imie'].' '.$row2['nazwisko'];
            //$id_p = $row2['id'];
             //echo $data;
            
                }
        ?>
            </div>
            <?php } ?>
        <?php
         } ?>
            
         </div><?php
         if ($licznik == 1) {
            ?>Narazie brak.<?php
         }
    }
}

?>
