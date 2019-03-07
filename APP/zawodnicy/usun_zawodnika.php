<?php 
    include('../db_connect.php');
    $id = intval($_POST[id_zaw]);
    $query = "DELETE FROM Zawodnicy WHERE id_zawodnika = $id ;";
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
    echo "<a href=\"/~6molenda/projekt_bd/index.php\">powrót do strony głównej</a> ";

?>