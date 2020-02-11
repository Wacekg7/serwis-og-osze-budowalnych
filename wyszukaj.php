<?php 
	require_once("connect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset ="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<link rel="stylesheet" href="stylee.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	
<?php 
	include("header.php");
?>
<div class="site-content">
	<main class="main-content">
		<div class="container">
			<div class="row">
				<div class="sidebar col-md-3">
				</div>
	<div class="content col-md-12">
		<h4> </h4>
	<?php
//sprawdzenie czy użytkownik wpisał frazę 
if(empty($_POST['wyszukaj'])) 

die('Wypełniłeś formularz niepoprawnie! Nie można wyświetlić wyników wyszukiwania!');
else
//usunięcie białych znaków
$_POST['wyszukaj']=trim($_POST['wyszukaj']); 
{
  $query1 ="SELECT * FROM ogloszenia WHERE tytul LIKE '%{$_POST['wyszukaj']}%' OR tresc LIKE '%{$_POST['wyszukaj']}%'";

  $query2 ="SELECT * FROM ogloszenia_firm WHERE nazwa LIKE '%{$_POST['wyszukaj']}%' OR uslugi LIKE '%{$_POST['wyszukaj']}%'";
  //zapytanie do bazy
  $result1 =mysql_query($query1);
  $result2 =mysql_query($query2);
 //ilość obiektów zanlezionych w bazie 
  $obAmount1 =mysql_num_rows($result1);
  $obAmount2 =mysql_num_rows($result2);
	  
	  //wyświetlenie ilości znalezionych ogłoszeń
	  echo'<h4>Wyniki wyszukiwania:</h4>';
	  echo'Znaleziono ogłoszeń: '. ($obAmount1 + $obAmount2).'<br /><br />';
	 //wyświetlanie wyników w pętli
	  	for($x=0;$x<$obAmount1;$x++)
	  	{	
	    	$row=mysql_fetch_array($result1);//przekształcenie danych na tablice
	    		//wyświetlenie wyników zapytania
	        	echo'<h4><b>'.$row['tytul'].'</b></h4>';
				echo '<p class="fa fa-user" aria-hidden="true" style="color: #616161; letter-spacing: 2px;"><b>'.$row['imie']. ' </b></p>';
				echo '&nbsp;';
				$data = explode(" ", $row['data']); 
				echo '<p class="fa fa-calendar" aria-hidden="true" style="color: #616161; letter-spacing: 1px;"><b>'.$data[0].  '</p></b>';
				echo '<p style="color:#00695C; ">Miejscowość: <b>'.$row['miejscowosc'].'</b> / Kontakt: <b>'.$row['kontakt']. '</b></p>';
				echo $row['tresc'];
				echo '<br />';
				echo '&nbsp;';;
	  }
		for($x=0;$x<$obAmount2;$x++)
	 	 {
	    	$row=mysql_fetch_array($result2);

	        	echo'<h4><b>'.$row['nazwa'].'</b></h4>';
				echo '<p class="fa fa-user" aria-hidden="true" style="color: #616161; letter-spacing: 2px;"><b>'.$row['wlascicel']. ' </b></p>';
				echo '&nbsp;';
				$data = explode(" ", $row['data']); 
				echo '<p class="fa fa-calendar" aria-hidden="true" style="color: #616161; letter-spacing: 1px;"><b>'.$data[0].  '</p></b>';
				echo '<p style="color:#00695C; ">Miejscowość: <b>'.$row['adres'].'</b> / Kontakt: <b>'.$row['kontakt']. '</b></p>';
				echo $row['uslugi'];
				echo '<br />';
				echo '&nbsp;';;
	  }
}
?>							
							</div>	
					</div>
				</div>
			</main> 
		<?php 
			include("footer.php");
		?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>