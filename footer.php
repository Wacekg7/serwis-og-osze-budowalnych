<?php
require_once 'connect.php';
$post = false;
$error = false;

function filtruj($zmienna)
{
        $zmienna = stripslashes($zmienna);
    	return mysql_real_escape_string(htmlspecialchars($zmienna)); }

if(isset($_POST['tytul']))
{
	$post = true;
	$tytul = filtruj($_POST['tytul']);
	$email = $_POST['email'];
	$tresc = filtruj($_POST['tresc']);
	$imie = filtruj($_POST['imie']);
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
		$error = true; $message="Adres e-mail jest niepoprawny.";}
	
	if(!$error)
	{
		$query = "INSERT INTO `wiadomosci`(`id_wiadomosc`, `tytul`,`imie` , `email`,`tresc`, `data`) VALUES (NULL, '".$tytul."','".$imie."', '".$email."','".$tresc."','".date("Y-m-d H:i:s")."')";
		$select = mysql_query($query);
	}
}
?>

<main class="main-content  text-center text-white bg-dark mt-4">
	
		<div class="container">
			<div class="row">
			<div class="col-md-6 mt-4">
					<?php
						if($post) 
						{
							if(!$error)
							{
						?>
						<div style="background-color: #4CAF50; color: white;">
						  Wiadomość została wysłana. <br />
						  Skontaktujemy się z Tobą niezwłocznie po jej przeczytaniu.<br />
						</div>
						<?php
							}
							else
							{
						?>
						<div style="background-color: #f44336; color: white;">
						  Wiadomość nie została wysłana. <br />
						  <?php echo $message; ?><br />
						</div>
						<?php
							}
						}
					?>
<h3 class="section-title font-italic text-success">Skontaktuj się z nami</h3>
	<p>Wypełnij poniższy formularz, skontaktujemy się z Tobą niezwocznie po jego przeczytaniu.</p>
		<form action="index.php" method="POST" class="contact-form">
			<div class="row">
				<div class="col-md-6 pg"><input type="text" maxlength='50' name="tytul" placeholder="Tytuł..." required title=" "></div>
				<div class="col-md-6 pg"><input type="text" maxlength='20' name="imie" placeholder="Imię..." required title=" "></div>
			</div>
			<div class="row">
				<div class="col-md-12 pg"><input type="text" maxlength='25' name="email" placeholder="Email..." required title=" "></div>
			</div>
			<div class="row">
				<div class="col-md-12 pg"><textarea name="tresc" placeholder="Wiadomość..."></textarea>
				</div>
			</div>

			<div class="row mb-3">
				<div class="col-md-12 d-flex justify-content-center">
				<form method="post" action="">
				<button class="btn btn-sm btn-info" type="submit" required title=" ">Wyślij</button>
				</form>	
				</div>
			</div>
		</form>
			
	</div>
	<div class="col-md-6 mt-4 ">	
			<h3 class="section-title font-italic text-info">Polecane strony z poradami i artykułami budowlanymi:</h3>
				<div class="row d-flex justify-content-center mt-3">
					<a href="https://muratordom.pl/"class=" text-white text-center">
    				<h5>Murator</h5>
 					</a>
				</div>

				<div class="row d-flex justify-content-center mt-3">
					<a href="https://www.liderbudowlany.pl/"class=" text-white text-center">
    				<h5>Lider budowlany</h5>
 					</a>
				</div>
				<div class="row d-flex justify-content-center mt-3">
					<a href="https://kb.pl/"class=" text-white text-center">
    				<h5>Kalkulatory budowlane</h5>
 					</a>
				</div>
				<div class="row d-flex justify-content-center mt-3">
					<a href="https://budujemydom.pl/"class=" text-white text-center">
    				<h5>Budujemy dom</h5>
 					</a>
				</div>
				<div class="row d-flex justify-content-center mt-3">
					<a href="http://www.forumbudowlane.pl/"class=" text-white text-center">
    				<h5>Forum budowalne</h5>
 					</a>
				</div>
			</div>
		</div>
	</div>
			</main> 

		<section class="main-content text-center d-flex align-items-center bg-dark">
		<div class="container text-white mg">    
                <b>Copyright &copy; 2018. 
					<a href="adminpanel/logadmin.php"class=" text-white text-center">
    				<span class="fa fa-user"></span></a>
				
                	<br>
                Serwis wykonał Wacław Golas w ramach pracy inżynierskiej. </b>   
		    </div>
	</section>
