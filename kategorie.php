<?php
require_once "connect.php";
?>
<div class="d-none d-md-block">
<div class="kat">
<div class="widget text-center">
	<h4 class="widget-title">Wybierz kategorię:</h4>
		<ul class="arrow-list btn">
			<?php			
			$wynik = mysql_query("SELECT * FROM kategorie ORDER BY nazwa_kategorii ASC");
				while($row = mysql_fetch_array($wynik))
				{
				echo '<td>
				<a href="?category_id='.$row['id_kategorii']. ( !empty($_GET['woj_id']) ? '&woj_id=' . $_GET['woj_id'] : '' ) . ( !empty($_GET['id_firma']) ? '&id_firma=' . $_GET['id_firma'] : '' ) .( !empty($_GET['strona']) ? '&strona=' . $_GET['strona'] : '' ) .'" ">'.$row['nazwa_kategorii'].'</a></br>
				</td>';
				}		
			?>
	</ul>
</div>
</div>
<div class="woj">
<div class="widget text-center">
	<h4 class="widget-title">Wybierz województwo:</h4>
		<ul class="arrow-list btn">
			<?php			
			$wynik2 = mysql_query("SELECT * FROM wojewodztwa");
				while($row2 = mysql_fetch_array($wynik2))
				{
				echo '<td>
				<a href="?woj_id='.$row2['id_woj'] . ( !empty($_GET['category_id']) ? '&category_id=' . $_GET['category_id'] : ''). ( !empty($_GET['id_firma']) ? '&id_firma=' . $_GET['id_firma'] : '' ) .( !empty($_GET['strona']) ? '&strona=' . $_GET['strona'] : '' ) .'" ">'.$row2['nazwa_woj'].'</a></br>
				</td>';
				}		
			?>
	</ul>
</div>
</div>
</div>

<div class="d-md-none">
<div class="dropdown">
  <button class="btn btn-info dropdown-toggle" type="button" id="List" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Wybierz kategorię:    
  </button>
  <div class="dropdown-menu" aria-labelledby="list">
    <a class="dropdown-item" href="#">
    	<ul class="arrow-list btn">
			<?php			
			$wynik = mysql_query("SELECT * FROM kategorie ORDER BY nazwa_kategorii ASC");
				while($row = mysql_fetch_array($wynik))
				{
				echo '<td style="vertical-align: top;">
				<a href="?category_id='.$row['id_kategorii']. ( !empty($_GET['woj_id']) ? '&woj_id=' . $_GET['woj_id'] : ''  ) . 
				'" style color: blue; font-size: 35px;">'.$row['nazwa_kategorii'].'</a></br>
				</td>';
				}		
			?>
	</ul>
    </a>
  </div>
</div>
<div class="dropdown mg">
  <button class="btn btn-info dropdown-toggle" type="button" id="List" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Wybierz województwo:
  </button>
  <div class="dropdown-menu" aria-labelledby="List">
    <a class="dropdown-item" href="#">
    	<ul class="arrow-list btn">
			<?php			
			$wynik2 = mysql_query("SELECT * FROM wojewodztwa");
				while($row2 = mysql_fetch_array($wynik2))
				{
				echo '<td style="vertical-align: top;">
				<a href="?woj_id='.$row2['id_woj'] . ( !empty($_GET['category_id']) ? '&category_id=' . $_GET['category_id'] : ''  ) . 
				'" style color: blue; font-size: 25px;">'.$row2['nazwa_woj'].'</a></br>
				</td>';
				}		
			?>
	</ul>	
    </a>
  </div>
</div>
</div>


