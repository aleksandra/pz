<?php
  // Jeśli użytkownik jest zalogowany, należy usunąć zmienne sesji, aby go wylogować.
  session_start();
  if (isset($_SESSION['id_obecne'])) {
		$_SESSION = array();
		// Usuwanie plików cookie z identyfikatorem i nazwą użytkownika przez ustawienie
		// daty wygasania na godzinę (3600 sekund) wstecz.
		if (isset($_COOKIE[session_name()])) {
			session_destroy();
			setcookie(session_name(), '', time()-3600);
		}
	}
	// Skierowanie użytkownika do strony głównej.
	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
	header('Location: ' . $home_url);
?>
