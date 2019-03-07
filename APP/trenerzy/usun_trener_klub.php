<?php 

include('../db_connect.php');
    $id_t = intval($_POST[id_t]);
    $id_k = intval($_POST[id_k]);
    $query = "DELETE FROM trenerzy_kluby WHERE id_trenera = $id_t AND id_klubu = $id_k ;";
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