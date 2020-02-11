
<?php
require_once "connect.php";
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
    <header class="content">
      <div class="container text-center my-auto">
        <h5 class="card-subtitle mb-2 text-muted">Załóż darmowe konto już teraz!</h5>
      </div>
    </header>

    <section class="content-section" id="about">
      <div class="container text-center">
        <div class="row">
          <div class="col-lg-10 mx-auto">
		  <div class="card mb-6">

  <div class="card-body">
    <h6 class="card-subtitle mb-2 text-muted">Wypełnij formularz:</h6>
<?php
if (isset($_POST['rejestruj'])){
    // Zabezpieczenie i przefiltorwanie danych wprowadzanych przez użtykownika
    $login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
    $haslo = mysql_real_escape_string(htmlspecialchars($_POST['haslo']));
    $haslo1 = mysql_real_escape_string(htmlspecialchars($_POST['haslo1']));
    $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
    
    //Sprawdź czy podany przez użytkownika email lub login już istnieje
    $errlogin = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE login='$login' LIMIT 1"));
    $erremail = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE email='$email' LIMIT 1"));

    // Zmienna w której zapisywane są ewnetualne błedy
    $errors = ''; 

    // Sprawdzanie wprowadzanych danych
    if (!$login || !$email || !$haslo || !$haslo1) $errors .= '- Musisz wypełnić wszystkie pola<br />';
    if ($errlogin[0] >= 1) $errors .= '- Ten login jest zajęty<br />';
    if ($erremail[0] >= 1) $errors .= '- Ten e-mail jest już używany<br />';
    if ($haslo != $haslo1)  $errors .= '- Hasła nie sa takie same<br />';

     //Wyświetlanie ewntualnych błedów
    if ($errors != '') {
        echo '<font color="red" size="5"><p class="error"><br />'.$errors.'</p></font>';
    }
     //Jeżeli nie ma błedów rejestracja jest kontynuowana
    else {
        $hashed_haslo = password_hash($haslo, PASSWORD_DEFAULT);
        // Zapisywanie danych
        $query = "INSERT INTO `uzytkownicy` (`login`, `haslo`, `email`,`data`) VALUES ('".$login."','".$hashed_haslo."', '".$email."','".date("Y-m-d H:i:s")."')";
          mysql_query($query) or die(mysql_error());
          //Wyświetlenie komunikatu o poprawnym zarejestrowaniu
           echo '<font color="green" size="5"><p class="error">Zostałeś zarejestrowany, teraz możesz się zalogowac!<br /></p></font>';?>
           <div class="p-2 bd-highlight mb-3">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">Zaloguj</button>
         </div>
        <?php 
          include_once"logowanie.php";
}
}
?>
  <form method="POST" action="rejestracja.php">
  <div class="form-row bg-secondary">

    <div class="form-group col-md-6">
      <label for="inputlogin">Podaj Login</label>
      <input type="login" class="form-control" name="login" placeholder="Login..." required title="Podaj login!">
    </div>

    <div class="form-group col-md-6">
      <label for="inputemail">Podaj Email</label>
      <input type="email" class="form-control" name="email"  placeholder="Email" required title="Wpisz poprawny adres email!">
    </div>
  </div>
  
  <div class="form-row bg-secondary">
    <div class="form-group col-md-6">
      <label for="inputhaslo1">Podaj Hasło</label>
      <input type="password" class="form-control"  name="haslo" placeholder="Hasło..." pattern=".{6,20}" required title="Podaj hasło!">
    </div>

    <div class="form-group col-md-6">
      <label for="inputhaslo2">Powtórz Hasło</label>
      <input type="password" class="form-control" name="haslo1" placeholder="Hasło..." pattern=".{6,20}" required title="Powtórz hasło!">
    </div>
  </div>

  <div class="form-group mg">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck" required title="Musisz zaakceptować regulamin !">
      <label class="form-check-label" name="akceptuje" value="yes" for="gridCheck" >Akceptuje <a href="">regulamin</a> serwisu ogłoszeń!
      </label>
    </div>
  </div>
    <input type="button" class="btn btn-success" value="Strona główna" onclick="location.href='index.php';" > 
  <input type="submit" class="btn btn-success" value="Zarejestruj" name="rejestruj">

</form>
  </div>
</div>
          </div>
        </div>
      </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>

</html>


