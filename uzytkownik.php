<?php
require_once"connect.php";

session_start();

if (isset($_GET['usun'])){
  $id = $_GET['usun'];
    $query1 = ("DELETE FROM ogloszenia WHERE id_ogloszenia = $id");
      $select1 = mysql_query($query1) or die(mysql_error()); }

if (isset($_GET['usun_firma'])){
  $id = $_GET['usun_firma'];
    $query1 = ("DELETE FROM ogloszenia_firm WHERE id_firma = $id");
      $select1 = mysql_query($query1) or die(mysql_error()); }

if (isset($_GET['wybierz'])){
  $id = $_GET['wybierz'];
    $query1 = ("SELECT * FROM ogloszenia_firm WHERE id_firma = $id");
      $select1 = mysql_query($query1) or die(mysql_error()); }
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
<main>
	<div class="container text-center font-weight-bold ">

<?php
echo '<h4>Witaj '.$_SESSION['login'].'</h4>';
echo 'Jesteś zarejestrowany w serwisie od:';
 
$query = "SELECT * FROM uzytkownicy WHERE  id_uzytkownik = '".$_SESSION['id']."'";
				$fetch = mysql_query($query);
    			if ($fetch) {
				while($row = mysql_fetch_array($fetch))	{
  			$data = explode(" ", $row['data']); ?>
  			<i class="fa fa-calendar" aria-hidden="true"></i>
  			<?php 
  			echo $data[0].'</b> <br />';

        echo 'Twój email to: '.$row['email'].'';
		}} ?>
  </div>
  <div class="container">
<div class="row">
    <table class="table mt-3">
        <tr>
          <th>Tytuł ogłoszenia:</th>
          <th>Data dodania:</th>
          <th>Wybierz</th>
          <th colspan="2">Usuń</th>
        </tr>
            <?php
            $query = "SELECT * FROM ogloszenia  WHERE autor = '".$_SESSION['id']."'";
				    $fetch = mysql_query($query);
    			 if ($fetch) {
				    while($row = mysql_fetch_array($fetch))	
              {?>
        <tr> 
            <td> <?php echo $row['tytul'] ?> </td>
            <td> <?php $data = explode(" ", $row['data']); ?>
			         <i class="fa fa-calendar" aria-hidden="true"></i>
			       <?php echo $data[0].'</b>';?> </td>
             
             <td> <a href="edit<?= $row['id_ogloszenia'] ?>" class="btn btn-success" data-toggle="modal" data-target="#exampleModal<?= $row['id_ogloszenia'] ?>">Wyświetl</a></td>
              <div class="modal fade" id="exampleModal<?= $row['id_ogloszenia'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?= $row['id_ogloszenia'] ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel<?= $row['id_ogloszenia'] ?>"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                <?php
                echo '<h4><b>'.$row['tytul'].'</b></h4>';
                echo '<p class="fa fa-user" aria-hidden="true" style="color: #616161; letter-spacing: 2px;"><b>'.$row['imie']. ' </b></p>';
                echo '&nbsp;';
                $data = explode(" ", $row['data']); 
                echo '<p class="fa fa-calendar" aria-hidden="true" style="color: #616161; letter-spacing: 1px;"><b>'.$data[0].  '</p></b>';
                echo '<p style="color:#00695C; ">Miejscowość: <b>'.$row['miejscowosc'].'</b> / Kontakt: <b>'.$row['kontakt']. '</b></p>';
                echo $row['tresc'];
                echo '<br />';
                echo '&nbsp;';?>
              </div>
            </div>
          </div>
        </div>
        
            <td> <a href="uzytkownik.php?usun=<?php echo $row['id_ogloszenia']?>" class="btn btn-danger">Usuń</a></td>
        </tr>
            <tr>
              <?php }} 
               $query = "SELECT * FROM ogloszenia_firm  WHERE autor = '".$_SESSION['id']."'";
                $fetch = mysql_query($query);
                if ($fetch) {
                while($row = mysql_fetch_array($fetch)) 
                {?>
            <tr>
                <td> <?php echo $row['nazwa'] ?> </td>
                <td> <?php $data = explode(" ", $row['data']); ?>
                <i class="fa fa-calendar" aria-hidden="true"></i>
              <?php echo $data[0].'</b>';?> </td>
              <td> <a href="?edit<?= $row['id_firma'] ?>"  class="btn btn-success" data-toggle="modal" data-target="#exampleModal<?= $row['id_firma'] ?>">Wyświetl</a>
              <div class="modal fade" id="exampleModal<?= $row['id_firma'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?= $row['id_firma'] ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel<?= $row['id_firma'] ?>">
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                <?php
                echo '<h4><b>'.$row['nazwa'].'</b></h4>';
                echo '<p class="fa fa-user" aria-hidden="true" style="color: #616161; letter-spacing: 2px;"><b>'.$row['wlasciciel']. ' </b></p>';
                echo '&nbsp;';
                $data = explode(" ", $row['data']); 
                echo '<p class="fa fa-calendar" aria-hidden="true" style="color: #616161; letter-spacing: 1px;"><b>'.$data[0].  '</p></b>';
                echo '<p style="color:#00695C; ">Adres: <b>'.$row['adres'].'</b> / Kontakt: <b>'.$row['kontakt']. '</b></p>';
                echo $row['uslugi'];
                echo '<br />';
                echo '&nbsp;';
                ?>
              </div>
            </div>
          </div>
        </div>
                <td> <a href="uzytkownik.php?usun_firma=<?php echo $row['id_firma']?>" class="btn btn-danger">Usuń</a>
                </td>
              </tr>
            <tr><?php }} ?>
          </table>
        </div>
	</div>
</main>
<?php
include_once "footer.php";
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
