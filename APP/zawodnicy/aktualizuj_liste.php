<?php 
    include('../db_connect.php');
    $id_zawodnika = intval($_POST[id_zawodnika]);
    $id_stan = intval($_POST[id_stan]);
    $odl = intval($_POST[odl]);
    $odl_stara = intval($_POST[odl_poprzednia]);

    $query = "SELECT aktualizuj_liste($id_zawodnika,$id_stan,$odl_stara,$odl);";
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