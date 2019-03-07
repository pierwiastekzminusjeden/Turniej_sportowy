<?php 
    include('../db_connect.php');
    $id_zawodnika = intval($_POST[id_zawodnika]);
    $id_klubu = intval($_POST[id_klubu]);

    $query = "INSERT INTO Zawodnicy VALUES($id_zawodnika,$id_klubu,'$_POST[imie]','$_POST[nazwisko]',
    '$_POST[kategoria]','$_POST[lic]');";
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