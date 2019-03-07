<?php 

    $host = "host = localhost";
    $port = "port = 5432";
    $dbname = "dbname = u6molenda";
    $credentials = "user = u6molenda password=6molenda";
    $db = pg_connect( "$host $port $dbname $credentials"  );
    if(!$db) {
        echo "Database Error : Unable to open database<br/>";
        exit;
    }
    $_id = intval($_POST[id]);
    $query = "INSERT INTO Sedziowie VALUES($_id,'$_POST[imie]','$_POST[nazwisko]','$_POST[lic]')";
    echo "$query";

    $res = pg_query($db, $query);
?>