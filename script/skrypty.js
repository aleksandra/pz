$(document).ready(function() {
		$("#firma").click(function () { 
		$('#f').slideDown('slow');
		$('#p').slideUp('slow');
		});
		
		$("#pracownik").click(function () { 
		$('#p').slideDown('slow');
		$('#f').slideUp('slow');
		});

		$("#zmien_haslo").click(function () { 
		$('#zmien_haslo_div').slideToggle('slow');
		$('#ogloszenia_div').slideUp('slow');
		});
		
		$("#ogloszenia").click(function () { 
		$('#ogloszenia_div').slideToggle('slow');
		$('#zmien_haslo_div').slideUp('slow');
		});

                $("#add_oglo").click(function () {
		$('#add_oglo_div').slideToggle('slow');
		});

                 $("#oglo_lista").click(function () {
		$('#oglo_lista_div').slideToggle('slow');
		});

                 $("#dodatk_wykszt1").click(function () {
		$('#dodatk_wykszt1_div').slideToggle('slow');
                $('#dodatk_wykszt1').slideUp('slow');
		});

                 $("#dodatk_wykszt2").click(function () {
		$('#dodatk_wykszt2_div').slideToggle('slow');
                $('#dodatk_wykszt2').slideUp('slow');
		});

                 $("#dodatk_wykszt3").click(function () {
		$('#dodatk_wykszt3_div').slideToggle('slow');
                $('#dodatk_wykszt3').slideUp('slow');
		});

                 $("#dodatk_wykszt4").click(function () {
		$('#dodatk_wykszt4_div').slideToggle('slow');
                $('#dodatk_wykszt4').slideUp('slow');
		});

                $("#dodatk_dosw1").click(function () {
		$('#dodatk_dosw1_div').slideToggle('slow');
                $('#dodatk_dosw1').slideUp('slow');
		});

                $("#dodatk_dosw2").click(function () {
		$('#dodatk_dosw2_div').slideToggle('slow');
                $('#dodatk_dosw2').slideUp('slow');
		});
                $("#dodatk_dosw3").click(function () {
		$('#dodatk_dosw3_div').slideToggle('slow');
                $('#dodatk_dosw3').slideUp('slow');
		});
                $("#dodatk_dosw4").click(function () {
		$('#dodatk_dosw4_div').slideToggle('slow');
                $('#dodatk_dosw4').slideUp('slow');
		});

                $("#dodatk_dodatk4").click(function () {
		$('#dodatk_dodatk4_div').slideToggle('slow');
                $('#dodatk_dodatk4').slideUp('slow');
		});
                 $("#dodatk_dodatk3").click(function () {
		$('#dodatk_dodatk3_div').slideToggle('slow');
                $('#dodatk_dodatk3').slideUp('slow');
		});
                 $("#dodatk_dodatk2").click(function () {
		$('#dodatk_dodatk2_div').slideToggle('slow');
                $('#dodatk_dodatk2').slideUp('slow');
		});
                 $("#dodatk_dodatk1").click(function () {
		$('#dodatk_dodatk1_div').slideToggle('slow');
                $('#dodatk_dodatk1').slideUp('slow');
		});


});

function wal_rej(arg) {
    var err = 0;
    imie_reg = /^[A-ZŁŻŹ][a-ząęćółńś]+/;
    nazwisko_reg = /^[A-ZŁŻŹĘÓĄŚŃĆ][a-ząęćółńś]+(-?[A-ZŁŻŹĘÓĄŚŃĆ][a-ząęćółńś]+)*$/;
    email_reg = /^[a-zA-Z0-9ąćęłńóśżźĄĆĘŁŃÓŚŻŹ]{1,30}@[a-zA-Z0-9ąćęłńóśżźĄĆĘŁŃÓŚŻŹ]+(\.[a-zA-Z0-9ąćęłńóśżźĄĆĘŁŃÓŚŻŹ]+)+$/;
    $('.error').remove();
    with (arg) {
		if ( login.value == "" || haslo.value == "" || haslo2.value == "" || email.value == ""  ) {
                     $('<p class="error">Wypełnij wszystkie pola!</p>').insertBefore(arg);
                     err++;
                }
                else if (firma.checked && nazwa_firmy.value == "" ) {
                      $('<p class="error">Wypełnij wszystkie pola!</p>').insertBefore(arg);
                     err++;
                }
                else if (pracownik.checked) {
                        if ( !imie.value.match(imie_reg) ) {
                            $('<p class="error">Niepoprawne imię!</p>').insertBefore(arg);
                            err++;
                        }
                        if ( !nazwisko.value.match(nazwisko_reg)) {
                           $('<p class="error">Niepoprawne nazwisko!</p>').insertBefore(arg);
                            err++;
                        }
                }
                if (haslo.value.length < 5) {
                    $('<p class="error">Hasło musi mieć conajmniej 5 znaków.</p>').insertBefore(arg);
                     err++;
                }
                if (haslo.value != haslo2.value) {
                    $('<p class="error">Musisz wpisać to samo hasło dwa razy.</p>').insertBefore(arg);
                     err++;
                }
                if (!email.value.match(email_reg)) {
                     $('<p class="error">Niepoprawny email.</p>').insertBefore(arg);
                     err++;
                }
    }
    if (err == 0) {
        return true;
    }
    else {
        return false;
    }
}


function odpowiedzi(id){
	$('#odpowiedzi'+id+'_div').slideToggle('slow');
}

function sprawdz(e,a, msg) {
    if(e)e.preventDefault();
    else window.event.returnValue=false;
    if(window.confirm('Napewno?'+msg)) window.location=a.href;
}

function dodaj_enter(kontener){
	var znacznik = document.createElement('br');
	var kontene = document.getElementById(kontener);
	kontene.appendChild(znacznik);
}

function dodaj_element(kontener, nazwa){
	var znacznik = document.createElement('input');
	znacznik.setAttribute('type', 'text');
	znacznik.setAttribute('name', 'nazwa');
        znacznik.setAttribute('id', 'nazwa');
	var kontene = document.getElementById(kontener);
	kontene.appendChild(znacznik);
}

/*function dodaj_element(kontener){
	var znacznik_od = document.createElement('input');
	znacznik_od.setAttribute('type', 'text');
	znacznik_od.setAttribute('name', 'od');
	//var znacznik_do = document.createElement('input');
	//znacznik_do.setAttribute('type', 'text');
	//znacznik_do.setAttribute('name', 'do');
	//var znacznik_gdzie = document.createElement('input');
	//znacznik_gdzie.setAttribute('type', 'text');
	//znacznik_gdzie.setAttribute('name', 'gdzie');
	znacznik.className = 'upload';
	var kontener = document.getElementById(kontener);
	kontener.appendChild(znacznik_od);
	//kontener.appendChild(znacznik_do);
	//kontener.appendChild(znacznik_gdzie);
}*/
