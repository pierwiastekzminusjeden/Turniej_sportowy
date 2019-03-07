<?php 
    include('../db_connect.php');
    $id = intval($_POST[id]);

    $tmp = 0;
    echo"<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans);

    body {
        font-family: 'Open Sans', serif;
        background-image: linear-gradient(to right, rgba(216, 230, 231, 0.678), rgba(26, 143, 211, 0.473));
        margin-bottom: 5%;
    }
    
    table tr th{
    /* padding: 10px; */
    padding-right: 40px;
    }

    .section{
        margin: 10px;
        padding: 20px;
        border-radius: 50px;
        border: 2px dotted black;
        background-image: url(\"https://i.imgur.com/tXB3IaM.png\");}
    
    </style><body>";
    $query = pg_query($db, "SELECT * FROM zestawienie WHERE id_zawodnika = $id;");
    while($row = pg_fetch_array($query))
    {
        if($tmp == 0){
        echo"<div class = \"section\">";            
        echo"Dane zawodnika:<br>";
        echo "<table border=\"1\" ><tr><th>Numer licencji</th><th>Kategoria</th><th>Imie</th><th>Nazwisko</th><th>Klub</th><th>Wynik ogólny</th></tr>";
        echo "<tr><td>".$row[0]."</td>";
        echo "<td>".$row[1]."</td>";
        echo "<td>".$row[2]."</td>";
        echo "<td>".$row[3]."</td>";
        echo "<td>".$row[4]."";
        echo " ".$row[5]."</td>";
        echo "<td>".$row[11]."</tr></table></div>";
        $tmp = 1;

        }
        if($tmp == 0){
            echo"Wynik ogólny: ".$row[11]."<br>";
            $tmp = 1;
        }
        echo"<div class = \"section\">";
        echo "<table border=\"1\" ><tr><th>Odległość</th><th>Wynik</th><th>X</th><th>10</th><th>9</th></tr>";
        echo "<tr><td>".$row[6]."</td>";
        echo "<td>".$row[7]."</td>";
        echo "<td>".$row[8]."</td>";
        echo "<td>".$row[9]."</td>";
        echo "<td>".$row[10]."</td></tr></table></div>";
        
    }
    // while($row = pg_fetch_array($query))
    // {   
      
    //     echo "<table ><tr><th>Numer licencji</th><th>Kategoria</th><th>Imie</th><th>Nazwisko</th><th>Wynik</th><th>Kategoria</th></tr>";
    //    echo "<tr><td>".$row[0].". </td>";
    //    echo "<td>".$row[2]."</td>";
    //    echo "<td>".$row[3]."</td>";

    //    echo "<td>".$row[4];
    //    echo " ".$row[5]."</td>";
    //    echo "<td> ".$row[7]."</td>";
    //    echo "<td> ".$row[1]."</td></tr>";

    //    $tmp1 = $row[6];
    // }   
    //  echo "</table >";
    echo "<a href=\"/~6molenda/projekt_bd/index.php\">powrót do strony głównej</a> ";
    echo"</body>";
?>