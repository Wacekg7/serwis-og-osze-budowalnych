<?php
require_once"connect.php";
	
?>
	<div class="container-fluid">
          <div class="container">
          	<div class="row d-flex bd-highlight mb-3 pg">
          		<div class="mr-auto p-2 bd-highlight">
          			<form class="form-horizontal" method="post" action="index.php">
					<input type="submit" class=" btn btn-light btn-sm" value="Home"/>
					</form>
				</div>
				<div class="p-2 bd-highlight btn">
					<?php
					echo date('d/m/Y');
					?>
				</div>

	<?php
if(isset($_SESSION['login'])){
	?>		
				<div class="p-2 bd-highlight">
				<form method="post" action="uzytkownik.php">
				<button class="btn btn-sm btn-info" type="submit">Profil</button>
				</form>	
				</div>
				<div class="p-2 bd-highlight">
				<form method="post" action="wyloguj.php">
				<button class="btn btn-sm btn-info" type="submit">Wyloguj</button>
				</form>	
				</div>
				</div>
<?php
} else { ?>		
				<div class="p-2 bd-highlight">
				<button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">Zaloguj</button>
				 </div>
				<?php 
        		include_once"logowanie.php";
       			 ?>
				</div>
<?php } ?>


			<div class="d-flex justify-content-center">
			<h2>Wyszukaj ogłoszenia</h2>	
			</div>
				<form method="POST" action="wyszukaj.php" >
				<div class="d-flex justify-content-center ">	
				</div>  
					  <div class="form-group d-flex justify-content-center">
					    <input type="text" name="wyszukaj" class="form-control" placeholder="Wpisz czego szukasz..." value="<?= !empty($_POST['wyszukaj']) ? $_POST['wyszukaj'] : '' ?>">
					    <button type="submit" class="btn btn-danger btn-sm">Wyszukaj</button>
					  </div>
				</div>
				</form> 

		<div class="container">
			<div class="row justify-content-center pgadd">
				<div class="d-flex align-content-center flex-wrap">
          			<form method="post" action="dodaj.php">
						<button class="btn btn-success" type="submit" style="margin-right:10px">Dodaj ogłoszenie</button>
					</form>
					<form method="post" action="dodajfirme.php">
						<button class="btn btn-info" type="submitt"style="margin-left:10px">Dodaj usługi firmy</button>
					</form>
				</div>
			</div>
		</div>

		<div class="container d-flex justify-content-center">
			<div class="row">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="?id_oglo">Ogłoszenia użytkowników</a></li>
						<li class="breadcrumb-item"><a href="?id_firma=1">Usługi firm</a></li>
						</li>
					</ol>
				</nav>
			</div>
		</div>