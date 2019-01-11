<?php
$hostname = "(local)"; 	// naam van server
$dbname = "FLETNIX";    	// naam van database 
$username = "sa";      	// gebruikersnaam
$pw = "Rol_dfa123";      	// password
$dbh = new PDO ("sqlsrv:Server=$hostname;Database=$dbname; ConnectionPooling=0", "$username", "$pw");
$data = $dbh->query("SELECT * FROM WatchHistory ");
while ($row = $data->fetch()){    echo "$row[movie_id]: $row[customer_mail_address]: $row[watch_date]: $row[price]</br>";}
?>