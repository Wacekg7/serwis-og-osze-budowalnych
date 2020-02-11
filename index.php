<?php
require_once"connect.php";
session_start();	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset ="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="stylee.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
</head>
<body>	

<?php 
	include("header.php");
?>	
			<main class="main-content">
				<div class="container">
				<div class="row">
					<div class="sidebar col-md-3">
					<?php
					include_once "kategorie.php";
					?>
					</div>
						<div class="content col-md-9">
	<?php 
	$where = ' WHERE 1=1';
	if (!empty($_GET['category_id'])) {
   		$where .= ' AND kategoria = ' . $_GET['category_id']; } 
	if (!empty($_GET['woj_id'])) {
    	$where .= ' AND wojewodztwa = ' . $_GET['woj_id']; }
	$na_stronie =4; // ustawienie ilości wpisów na 1 stronie
		$table = 'ogloszenia';
		if (!empty($_GET['id_firma'])) { 
	    $table = 'ogloszenia_firm'; }
	    
	$zapytanie = "SELECT COUNT(*) FROM $table" . $where; 
    $wynik = mysql_query($zapytanie);
    $a = mysql_fetch_row($wynik); //ilość wyników 
    $liczba_wpisow = $a[0];
    $liczba_stron = ceil($liczba_wpisow / $na_stronie);
    if (isset($_GET['strona'])) {
        if ($_GET['strona'] < 1 || $_GET['strona'] > $liczba_stron) $strona = 1;
        else $strona = $_GET['strona'];
    }
    else $strona = 1;
    $od = $na_stronie * ($strona - 1);
	$query = 'SELECT * FROM ' . $table . $where;
	$query .= " ORDER BY data DESC LIMIT $od, $na_stronie"; //ustwaienie wy świetlanie oraz limitu nogłoszen na jednej stronie
    $fetch = mysql_query($query); 
    if ($fetch) {
		while($row = mysql_fetch_array($fetch))	{	
		    if ($table == 'ogloszenia_firm') {
		    //wyświetlanie ogłoszeń firm
		    echo '<h4><b>'.$row['nazwa'].'</b></h4>';
		    echo '<p class="fa fa-user" aria-hidden="true" style="color: #616161; letter-spacing: 2px;"><b>'.$row['wlasciciel']. ' </b></p>';
			echo '&nbsp;';
			$data = explode(" ", $row['data']); 
			echo '<p class="fa fa-calendar" aria-hidden="true" style="color: #616161; letter-spacing: 1px;"><b>'.$data[0].  '</p></b>';
			echo '<p style="color:#00695C; ">Adres: <b>'.$row['adres'].'</b> / Kontakt: <b>'.$row['kontakt']. '</b></p>';
			echo $row['uslugi'];
			echo '<br />';
			echo '&nbsp;';}
			else {
			//wyświetlanie ogłoszeń uzytkowników
			echo '<h4><b>'.$row['tytul'].'</b></h4>';
			echo '<p class="fa fa-user" aria-hidden="true" style="color: #616161; letter-spacing: 2px;"><b>'.$row['imie']. ' </b></p>';
			echo '&nbsp;';
			$data = explode(" ", $row['data']); 
			echo '<p class="fa fa-calendar" aria-hidden="true" style="color: #616161; letter-spacing: 1px;"><b>'.$data[0].  '</p></b>';
			echo '<p style="color:#00695C; ">Miejscowość: <b>'.$row['miejscowosc'].'</b> / Kontakt: <b>'.$row['kontakt']. '</b></p>';
			echo $row['tresc'];
			echo '<br />';
			echo '&nbsp;';
			} }
		?>
		<div class="container text-center"><?php
			//wyświetlanie stronicowania 
    		if ($liczba_wpisow > $na_stronie) {
        	$poprzednia = $strona - 1;
        	$nastepna = $strona + 1;
        		if ($poprzednia > 0) {
 				echo '<a id="POPRZEDNIA" href="index.php?strona='.$poprzednia.'"> ~poprzednia\  </a>'; }
        		if ($nastepna <= $liczba_stron) {
				echo '<a id="NASTEPNA" href="index.php?strona='.$nastepna.'">  /następna~ </a>';
       			 }?>
    	</div>
    <?php    
}
}
?>
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

