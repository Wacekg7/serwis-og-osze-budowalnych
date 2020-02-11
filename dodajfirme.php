<?php 
require_once "connect.php";
session_start();

function filtruj($zmienna)
{
        $zmienna = stripslashes($zmienna);
    	return mysql_real_escape_string(htmlspecialchars($zmienna));
}

$post = false;
$error = false;
if(!empty($_POST['nazwa']))
{	
	$post = true;
	$nazwa = filtruj($_POST['nazwa']);
	$wlasciciel = filtruj($_POST['wlasciciel']);
	$kategoria = (int)$_POST['kategoria'];
	$wojewodztwa = (int)$_POST['wojewodztwa'];
	$adres = filtruj($_POST['adres']);
	$kontakt = filtruj($_POST['kontakt']);
	$uslugi = filtruj($_POST['uslugi']);
	$autor = $_SESSION['id'];
	
	if((empty($nazwa)) OR (empty($wlasciciel)) OR (empty($adres)) OR (empty($kontakt)) OR (empty($uslugi))) { 
		$error = true; $message="Wprowadź dane do wszystkich pól.";
	}
	if(!$error)
	{
		$query = "INSERT INTO `ogloszenia_firm` (`id_firma`, `kategoria`, `wojewodztwa`, `nazwa`, `wlasciciel`, `adres`, `kontakt`, `uslugi`, `data`,`autor`) VALUES (NULL, '".$kategoria."','".$wojewodztwa."', '".$nazwa."', '".$wlasciciel."', '".$adres."', '".$kontakt."', '".$uslugi."', '".date("Y-m-d H:i:s")."', '".$autor."')";

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
	<link rel="stylesheet" href="stylee.css">

</head>
<body>
		<?php
	include_once "header.php";
	
	?>
	<?php
if(isset($_SESSION['login'])){
	?>
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
							<h2 class="section-title text-center">Zaoferuj usługi swojej firmy</h2>
							<p>Aby dodać ogłoszenie o usługach do serwisu wypełnij poniższy formularz.</p>
							<form action="dodajfirme.php" method="POST" class="contact-form">
								<div class="row">
									<div class="col-md-6">
										<input type="text" maxlength='30' name="nazwa" placeholder="Nazwa Firmy..."></div>
									<div class="col-md-6"><input type="text" name="wlasciciel" placeholder="Właściciel..."></div>
								</div>
								<div class="row">
									<div class="col-md-6"><input type="text" name="adres" placeholder="Adres Firmy..."></div>
									<div class="col-md-6"><input type="text" name="kontakt" placeholder="Kontakt.."></div>
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
										}
										?>
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
								<textarea name="uslugi" placeholder="Zakres Usług..."></textarea>
								<div class="text-right">
									<input type="submit" class=" btn btn-info btn-sm" value="Dodaj ogłoszenie"/>
								</div>
							</form>

						</div>
					</div>
				</div>
			</main>
<?php
} else { ?>
<div class="container text-center addfirma">
<b><h4>Musisz się zalogować aby dodać ofertę firmy. </h4></b>	
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