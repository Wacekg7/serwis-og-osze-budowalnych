
<?php 
//dołączenie pliku łączącego się z bazą danych
require_once "connect.php";

session_start();

//funkcja filtrująca dane
function filtruj($zmienna)
{	
	// usuwamy slashe
   $zmienna = stripslashes($zmienna); 
   // usuwamy tagi html oraz niebezpieczne znaki
    return mysql_real_escape_string(htmlspecialchars($zmienna));
}

$post = false;
$error = false; //zmienna przechowująca błąd
if(!empty($_POST['tytul']))
{	
	$post = true;
	//odebranie danych z formularza i ich przypisanie 
	//przefiltorwanie wprowadzanych danych przez użytkownika
	$tytul = filtruj($_POST['tytul']);
	$imie = filtruj($_POST['imie']);
	$kategoria = (int)$_POST['kategoria'];
	$wojewodztwa = (int)$_POST['wojewodztwa'];
	$kontakt = filtruj($_POST['kontakt']);
	$miejscowosc = filtruj($_POST['miejscowosc']);
	$tresc = filtruj($_POST['tresc']);
	$autor = $_SESSION['id'];
	
	//sprawdzenie czy użytkownik wprowadził dane do wszystkich pól
	if((empty($tytul)) OR (empty($imie)) OR (empty($kontakt)) OR (empty($miejscowosc)) OR (empty($tresc))) { 
		//komunikat o braku danych
		$error = true; 
		$message="Wprowadź poprawne dane do wszystkich pól.";
	}
	//Jeśli w dalszym ciągu zmienna $error jest false dane zostają dodane do bazy
	if(!$error)
	{
		$query = "INSERT INTO `ogloszenia` (`id_ogloszenia`, `autor`,`kategoria`, `wojewodztwa`,`tytul`, `imie`, `kontakt`, `miejscowosc`, `tresc`, `data`) VALUES (NULL, '".$autor."','".$kategoria."','".$wojewodztwa."','".$tytul."', '".$imie."', '".$kontakt."', '".$miejscowosc."', '".$tresc."', '".date("Y-m-d H:i:s")."')";
		//wykonanie zapytania do bazy 
		$select = mysql_query($query) or die(mysql_error());
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="stylee.css">
</head>
<body>
	<?php
	include_once 'header.php';
	?>
	<?php
		if(isset($_SESSION['login'])) { ?>
			<main class="main-content ">
				<div class="container">
					<div class="col-md-12 col-md-offset-1 text-center">
							<?php
						if($post) 
						{
							if(!$error)
							{
						?>
						<div style="background-color: #4CAF50; color: white;">
						  <b>Ogłoszenie zostało dodane do serwisu, będzie aktywne 30 dni. </b><br />
						</div>
						<?php
							}
							else
							{
						?>
						<div style="background-color: #f44336; color: white;">
						  <b>Ogłoszenie nie zostało dodane. <br />
						  <?php echo $message; ?><br /></b>
						</div>
						<?php
							}
						}
					?>
							<h2 class="section-title text-center">Dodawanie ogłoszenia</h2>
							<p>Aby dodać ogłoszenie do serwisu wypełnij poniższy formularz.</p>
							
							<form action="dodaj.php" method="POST" class="contact-form">
								<div class="row">
									<div class="col-md-6"><input type="text" maxlength='100' name="tytul" placeholder="Tytuł ogłoszenia..."></div>
									<div class="col-md-6"><input type="text" maxlength='50'name="imie" placeholder="Imie..."></div>
								</div>
								<div class="row">
									<div class="col-md-6"><input type="text" maxlength='100'name="kontakt" placeholder="Kontakt..."></div>
									<div class="col-md-6"><input type="text" maxlength='50'name="miejscowosc" placeholder="Miejscowość.."></div>
								</div>
								<div class="row">
									<div class="col-md-6 d-flex justify-content-center">
										<h6><p>Wybierz kategorię:</p></h6> </div>
									<div class="col-md-6">
										<select name="kategoria">				
										<?php 	
										$query= "SELECT * FROM `kategorie` ORDER BY nazwa_kategorii ASC";
										$select= mysql_query($query);
										while($row=mysql_fetch_array($select))
										{
										echo '<option value="'.$row['id_kategorii'].'">'.$row['nazwa_kategorii'].'</option>';
										}?>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 d-flex justify-content-center mg">
										<h6><p>Wybierz województwo:</p></h6> </div>
									<div class="col-md-6">
										<select name="wojewodztwa">						
										<?php 
										$query= "SELECT * FROM `wojewodztwa`";
										$select= mysql_query($query);
										while($row=mysql_fetch_array($select))
										{
										echo '<option value="'.$row['id_woj'].'">'.$row['nazwa_woj'].'</option>';
										}
										?>
										</select>
									</div>
								</div>
								<textarea name="tresc"  maxlength='2000' placeholder="Treść ogłoszenia..."></textarea>
								<div class="text-right">
									<input type="submit" class=" btn btn-success btn-sm" value="Dodaj ogłoszenie"/>
								</div>
							</form>
					</div>
				</div>
			</main>
<?php
} else { ?>
<div class="container text-center add">
<b><h4>Musisz się zalogować aby dodać nowe ogłoszenie. </h4></b>	
				<div class="p-2 bd-highlight">
				<button type="button" class="btn btn-light" data-toggle="modal" data-target=".bd-example-modal-sm">Zaloguj</button>
				 </div>
				<?php 
        		include_once"logowanie.php";
       			 ?>
       			 <div class="p-2 bd-highlight">
				<p class="text-center"><a href="rejestracja.php" class="btn">Nie masz konta? Załóż już teraz</a></p>
				 </div>
				</div>					
<?php } ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>