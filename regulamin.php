<?php
session_start();
?>
<?php
	require_once('header.php');
?>
			<!-- tablica z ogłoszeniami 
			<tr>
				<?php 
					if (isset($_SESSION['id_obecne'])) {
				?>
				<td class="featured">
				<div style="z-index:1; left:412px; top:570px; position: absolute;"> 
				<a href="reszta"><img src="button.jpg"></a>
				</div>
				</td>
				<?php
					}
				?>
			</tr>
			 koniec ogloszen -->
			
			 <td class="content" style="padding-right: 44px; padding-left: 44px">
		<div id="regulamin">
			 <h3>Regulamin serwisu ePortal firmowy, zwanego dalej portalem:</h3>
			 <ul>
				<li>Można się rejestrować.</li>
				<li>Można się logować.</li>
				<li>Można sobie popatrzeć.</li>
				<li>Nic więcej nie można.</li>
				<li>Właścicielki portalu za nic nie ponoszą odpowiedzialności</li>
				<li>Rejestrując się, użytkownik wyaża zgodę na przetwarzanie swoich danych osobowych, oczywiście.</li>
			 </ul>
			 
			 Dziękuje. Dowidzenia.
		</div>	
			
			</td>
			</tr>
			<?php
			
			require_once('footer.html');
			?>