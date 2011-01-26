<?php

   //sprawdza czy uzytkownik jest zalogowany
if (isset($_SESSION['id_obecne'])) {
    if( $_SESSION['typ'] == 'p') {
        $id_obecne=$_SESSION['id_obecne'];

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
            $pokazuj=1;
        }
       $ile_na_strone = 5;
       $poczatek = ($page-1)*$ile_na_strone +3;
       $licznik=($page-1)*$ile_na_strone +1 +3;


        
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('błąd bazy');
	$query = "SELECT *, firma.id AS firma_id FROM  branza, firma, ogloszenie WHERE ogloszenie.id_firmy = firma.id AND branza.branza_id = ogloszenie.branza_id ORDER BY dodano DESC LIMIT 3";
	$result = mysqli_query($dbc, $query);
    
        echo  $_SESSION['msg_aplikuj']; $_SESSION['msg_aplikuj']="";


        $trzy_pierwsze=3;
        $ktore=1;
        while ($trzy_pierwsze  && $row = mysqli_fetch_array($result)) {

        $firma_id = $row['firma_id'];
        $id = $row['id'];
	$branza = $row['branza_nazwa'];
        $dodano = $row['dodano'];
        $tresc = $row['tresc'];
        $firma = $row['nazwa'];

        $query2 = "SELECT * FROM odp WHERE pracownik_id='$id_obecne' AND ogl_id='$id' ";
        $result2 = mysqli_query($dbc, $query2);
       
        ?>
           
             <div class="oglo<?php echo $ktore; ?>">
                 <div class="obrocone">
            <h2>Ogłoszenie <?php echo $ktore;?></h2>
            Dodano: <?php echo $dodano; ?><br/>
            Branża: <?php echo $branza; ?><br/>
            Dodane przez: <a href="wizytowka.php?id=<?php echo $firma_id ?>"><?php echo $firma; ?></a><br/>
           <b> <?php echo $tresc; ?></b><br/>
            <br/>
            <?php if (!$row2 = mysqli_fetch_array($result2)) {?>
            <a href="aplikuj.php?id=<?php echo $id; ?>" onclick="sprawdz(event, this,'')">Aplikuj</a>
            <?php }
            else {?>
                Aplikowałeś na to ogłoszenie. | <a href="rezygnuj.php?id=<?php echo $id; ?>" onclick="sprawdz(event,this,'')">Rezygnuj</a>
        

                <?php }
            $trzy_pierwsze--; $ktore++;
            ?>
            </div>
             </div>
             <?php
            } ?>

<div id="oglo_lista_div" <?php if($pokazuj!=1) { echo 'style="display:none"'; } ?> >
              <?php
$query = "SELECT *, firma.id AS firma_id FROM  branza, firma, ogloszenie WHERE ogloszenie.id_firmy = firma.id AND branza.branza_id = ogloszenie.branza_id ORDER BY dodano DESC LIMIT $poczatek,$ile_na_strone";
	$result = mysqli_query($dbc, $query);

        while ($row = mysqli_fetch_array($result)) {

        $id = $row['id'];
	$branza = $row['branza_nazwa'];
        $dodano = $row['dodano'];
        $tresc = $row['tresc'];
        $firma = $row['nazwa'];
         $firma_id = $row['firma_id'];

        $query2 = "SELECT * FROM odp WHERE pracownik_id='$id_obecne' AND ogl_id='$id' ";
        $result2 = mysqli_query($dbc, $query2);

        ?>
<br /><br /><div id="lala">
            <b>Ogłoszenie <?php echo $licznik; $licznik++?></b> &diams; 
            Dodano: <?php echo $dodano; ?> &diams; 
            Branża: <?php echo $branza; ?> &diams; 
            Dodane przez: <a href="wizytowka.php?id=<?php echo $firma_id ?>"><?php echo $firma; ?></a></div><div id="la">
            <b> <?php echo $tresc; ?></b></div>
           <div id="al">
            <?php if (!$row2 = mysqli_fetch_array($result2)) {?>
            <a href="aplikuj.php?id=<?php echo $id; ?>" onclick="sprawdz(event, this,'')">Aplikuj</a>
            <?php }
            else {?>
                Aplikowałeś na to ogłoszenie. | <a href="rezygnuj.php?id=<?php echo $id; ?>" onclick="sprawdz(event, this,'')">Rezygnuj</a>
            <?php }

            }
?></div><br/><br/><?php
        $query = "SELECT COUNT(*) FROM ogloszenie ";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        $ilosc_ogolem = $row['COUNT(*)']-3;
        $ile_stron = ceil($ilosc_ogolem/$ile_na_strone);

         if ($ilosc_ogolem != 0)  {echo 'Strona:';
            for ($i=1;$i<=$ile_stron;$i++) {

             ?>
            <a href="index.php?page=<?php echo $i ?>" ><?php echo $i; ?></a>
            <?php
            }
         } ?>
         </div> <?php
    }
}

?>