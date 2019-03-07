<?php 
    include('../db_connect.php');
    $id_zawodnika = intval($_POST[id_zawodnika]);
    $id_klubu = intval($_POST[id_klubu]);


    $query = "UPDATE Zawodnicy SET id_klubu = $id_klubu, Imie =  '$_POST[imie]', 
        Nazwisko = '$_POST[nazwisko]', Plec = '$_POST[kategoria]', Licencja_wazna = '$_POST[lic]' WHERE id_zawodnika = $id_zawodnika;";
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