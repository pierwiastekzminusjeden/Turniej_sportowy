<?php 
    include('../db_connect.php');
    $_id = intval($_POST[id]);
    $query = "DELETE FROM Trenerzy WHERE id_trenera = $_id ;";
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