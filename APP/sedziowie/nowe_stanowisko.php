<?php 
    include('../db_connect.php');
    $_id_stan = intval($_POST[id_stanowiska]);
    $_id_sed = intval($_POST[id_sedziego]);

    $query = "INSERT INTO Stanowiska VALUES($_id_stan,$_id_sed)";
    echo "Wykonane polecenie: $query<br/>";

    $res = pg_query($db, $query);
    $note = pg_last_notice($db);

    if(!$res){
        echo "BŁĄD BAZY DANYCH:<br>";
        echo pg_last_error($db)."<br>";
        }
    else if($note ){
        echo "$note<br>";
    }
    else{
    header("Location: /~6molenda/projekt_bd/index.php");
    exit;
    }        
    echo "<a href=\"/~6molenda/projekt_bd/index.php\">powrót do strony głównej</a> ";
?>