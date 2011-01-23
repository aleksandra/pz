<?php

   //sprawdza czy uzytkownik jest zalogowany
if (isset($_SESSION['id_obecne'])) {
    if( $_SESSION['typ'] == 'p') {
        $id_obecne=$_SESSION['id_obecne'];
        $licznik=1;
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('błąd bazy');
	$query = "SELECT * FROM  branza, firma, ogloszenie WHERE ogloszenie.id_firmy = firma.id AND branza.branza_id = ogloszenie.branza_id ORDER BY dodano DESC ";
	$result = mysqli_query($dbc, $query);
    
        echo  $_SESSION['msg_aplikuj']; $_SESSION['msg_aplikuj']="";
        ?>
        
        <?php
        $trzy_pierwsze=3;
        $ktore=1;
        while ($trzy_pierwsze  && $row = mysqli_fetch_array($result)) {
        
        $id = $row['id'];
	$branza = $row['branza_nazwa'];
        $dodano = $row['dodano'];
        $tresc = $row['tresc'];
        $firma = $row['nazwa'];

        $query2 = "SELECT * FROM odp WHERE pracownik_id='$id_obecne' AND ogl_id='$id' ";
        $result2 = mysqli_query($dbc, $query2);
       
        ?>
           
             <div class="oglo<?php echo $ktore; ?>">
                 <span class="obrocone">
            <h2>Ogłoszenie <?php echo $licznik; $licznik++?></h2>
            Dodano: <?php echo $dodano; ?><br/>
            Branża: <?php echo $branza; ?><br/>
            Dodane przez: <?php echo $firma; ?><br/>
           <b> <?php echo $tresc; ?></b><br/>
            <br/>
            <?php if (!$row2 = mysqli_fetch_array($result2)) {?>
            <a href="aplikuj.php?id=<?php echo $id; ?>" >Aplikuj</a>
            <?php }
            else {?>
                Aplikowałeś na to ogłoszenie. | <a href="rezygnuj.php?id=<?php echo $id; ?>" >Rezygnuj</a>
        

                <?php }
            $trzy_pierwsze--; $ktore++;
            ?>
            </span>
             </div>
             <?php
            } ?>

<div id="oglo_lista_div" style="display:none">
              <?php

        while ($row = mysqli_fetch_array($result)) {

        $id = $row['id'];
	$branza = $row['branza_nazwa'];
        $dodano = $row['dodano'];
        $tresc = $row['tresc'];
        $firma = $row['nazwa'];

        $query2 = "SELECT * FROM odp WHERE pracownik_id='$id_obecne' AND ogl_id='$id' ";
        $result2 = mysqli_query($dbc, $query2);

        ?>

            <h2>Ogłoszenie <?php echo $licznik; $licznik++?></h2>
            Dodano: <?php echo $dodano; ?><br/>
            Branża: <?php echo $branza; ?><br/>
            Dodane przez: <?php echo $firma; ?><br/>
            <b> <?php echo $tresc; ?></b><br/>
           
            <?php if (!$row2 = mysqli_fetch_array($result2)) {?>
            <a href="aplikuj.php?id=<?php echo $id; ?>" >Aplikuj</a>
            <?php }
            else {?>
                Aplikowałeś na to ogłoszenie. | <a href="rezygnuj.php?id=<?php echo $id; ?>" >Rezygnuj</a>
            <?php }

            } ?>


         </div><?php
         if ($licznik == 1) {
            ?>Narazie brak.<?php
         }
       
    }
}
?>