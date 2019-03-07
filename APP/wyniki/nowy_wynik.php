<?php 
    include('../db_connect.php');
    $id_zawodnika = intval($_POST[id_zawodnika]);
    $odl = intval($_POST[odl]);
    $wyn = intval($_POST[wyn]);
    $l_x = intval($_POST[l_x]);
    $l_10 = intval($_POST[l_10]);
    $l_9 = intval($_POST[l_9]);

    // $query = "UPDATE Wyniki SET Wynik = $wyn, Liczba_X = $l_x, Liczba_10 = $l_10, Liczba_9 = $l_9 WHERE
    //      id_wynik =(SELECT id_wynik FROM Lista_startowa WHERE Odleglosc = $odl AND id_zawodnika = $id_zawodnika ) ;";
    $query = "SELECT dodaj_aktualizuj_wynik($id_zawodnika, $odl, $wyn, $l_x, $l_10, $l_9);";

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