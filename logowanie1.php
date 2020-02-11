
<?php
//dołączenie pliku łączącego się z bazą danych
require_once "connect.php";
//start nowej sesji
session_start();
 if(isset($_SESSION["id"]))  
 {  
    header("location:index.php");  
 }  
 if(isset($_POST["login"]))  
 {    
      //sprawdza czy hasło lub login zostały wprowadzone i przesłane metodą POST 
      if(empty($_POST["login"]) || empty($_POST["haslo"]))
      {   
          //jeśli dane nie zostały wprowadzone wyświetli komunikat
          include"header.php";
           echo '<p <div class="alert alert-danger text-center font-weight-bold" role="alert">Nie wprowadziłeś danych logowania!</div></p>';  
      }  
      else {  
        //zabezpieczenie danych przed atakami SQL injection
        $login = mysql_real_escape_string($_POST["login"]);  
        $haslo = mysql_real_escape_string($_POST["haslo"]); 
        //zapytanie do bazy
        $query = "SELECT * FROM uzytkownicy WHERE login = '$login'";  
        $result = mysql_query($query); 
        //instrukcja warunkowa sprawdzająca login
        if(mysql_num_rows($result) > 0) {  
                while($row = mysql_fetch_array($result))  { 
                    // sprawdzenie czy hasło jest poprawne
                     if(password_verify($haslo, $row["haslo"]))  
                     { 
                      //Zalogowano! Do tablic superglobalnych zostaje dodane id oraz login
                      $_SESSION['id'] = $row['id_uzytkownik'];
                      $_SESSION["login"] = $login;
                      header('location:index.php');  
                     }  
                     else  
                     {   
                        //wyświetlenie klomunikatu o błędnym haśle 
                        include "header.php";
                        echo'<p
                        <div class="alert alert-danger text-center font-weight-bold" role="alert">Błędne hasło! Spróbuj ponownie</div></p>';
                     }  
                }  
           }  
           else {  
                  //komunikat o błednym loginie  
                  include "header.php";
                  echo'<p <div class="alert alert-danger text-center font-weight-bold" role="alert">Błędny login! Spróbuj ponownie </div>></p>';
           }  
      }  
  }  
 ?>

