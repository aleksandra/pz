<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>ePortal pracy</title>
       
               
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <script  src="http://code.jquery.com/jquery-latest.js"></script>
        <script  src="script/skrypty.js"></script>
       <!-- <script src="script/snow.js"></script>-->
    </head>
    <body>

        <table id="tabela" cellspacing="0">
            <tr>
                <td CLASS="top">
                    <div style="z-index:1; left:41px; top:130px; position: absolute;">
                        <ul>
                            <li>
                                <a href="index.php">STRONA GŁÓWNA</a>
                            </li>
                        </ul>
                    </div>
                    <div style="z-index:1; left:184px; top:130px; position: absolute;">
                        <ul>
                            <li>
                                <a href="regulamin.php">REGULAMIN</a>
                            </li>
                        </ul>
                    </div>
                    <?php
                    if (isset($_SESSION['id_obecne'])) {
                    ?>
                        <div style="z-index:1; left:327px; top:130px; position: absolute;">
                            <ul>
                                <li>
                                    <a href="profil.php">PROFIL</a>
                                </li>
                            </ul>
                        </div>
                    <?php
                    }
                    ?>
                    
                    <!-- logowanie -->
                    <div <?php if (!isset($_SESSION['id_obecne']))
                        echo "id='log'"; else
                        echo "id='log2'"; ?> >

                        <?php
                        require_once('connectvars.php');
                        echo "<p class='error' >" . $_SESSION['msg'] . "</p>";
                        $_SESSION['msg'] = '';
                        if (!isset($_SESSION['id_obecne'])) {
                        ?>

                            <form method='POST' action="login3.php" >
                                <input type="text" id="login_log" name="login_log" value="<?php echo $_SESSION['login_tmp']; ?>"/>
                                <input type="password" id="haslo_log" name="haslo_log" />
                                <input type="submit" id="submit" name="submit" value=" " />
                            </form>

                        <?php
                            $_SESSION['login_tmp'] = '';
                        } else
                            echo '<p class="ok" >' . $_SESSION['ok'] . ' Zalogowany jako ' . $_SESSION['do_wyswietlenia'] . '<br/><a href="logout.php">Wyloguj się</a> </p>';
                        $_SESSION['ok'] = '';
                        ?>

                    </div>
                    <!-- koniec logowania -->
                </td>
            </tr>