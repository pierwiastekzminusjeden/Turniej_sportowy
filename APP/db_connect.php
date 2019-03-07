<?php 

    $host = "host = localhost";
    $port = "port = 5432";
    $dbname = "dbname = u6molenda";
    $credentials = "user = u6molenda password=6molenda";
    $db = pg_connect( "$host $port $dbname $credentials"  );
    if(!$db) {
        echo "Błąd bazy danych: Nie można połączyć z bazą<br/>";
        exit;
    }
    else{
        echo "Połączono<br>";
    }
?>