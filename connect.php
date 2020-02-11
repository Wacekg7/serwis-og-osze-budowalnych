<?php
mysql_connect("localhost","root","") 
or die('Nie udało się połączyć z bazą danych.'.mysql_error());
mysql_select_db("ogloszenia");
mysql_query("SET CHARSET utf8");
mysql_query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
?>