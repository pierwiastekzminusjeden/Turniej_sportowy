<?php 
    include('../db_connect.php');
    $_id = intval($_POST[id]);
    $query = "INSERT INTO Trenerzy VALUES($_id,'$_POST[imie]','$_POST[nazwisko]')";
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