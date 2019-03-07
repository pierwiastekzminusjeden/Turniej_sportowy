<?php 

    include('../db_connect.php');
    $_id_trenera = intval($_POST[id_trenera]);
    $_id_klubu = intval($_POST[id_klubu]);

    $query = "INSERT INTO trenerzy_kluby VALUES($_id_trenera,$_id_klubu)";
    echo "Wykonane polecenie: $query<br/>";

    $res = pg_query($db, $query);
    if(!$res){
        echo "BŁĄD BAZY DANYCH:<br>";
        echo pg_last_error($db)."<br>";
        echo "<a href=\"/~6molenda/projekt_bd/index.php\">powrót do strony głównej</a> ";
        }
    else{
    header("Location: /~6molenda/projekt_bd/index.php");
    exit;
    }
?>