<?php 
    function connect(){
        $host = "host = localhost";
        $port = "port = 5432";
        $dbname = "dbname = u6molenda";
        $credentials = "user = u6molenda password=6molenda";
        $db = pg_connect( "$host $port $dbname $credentials"  );
        if(!$db) {
           echo "Database Error : Unable to open database<br/>";
           exit;
        }
        return $db;
    }

    function Sedziowie(){
        $db = connect();
        $query = pg_query($db, "SELECT * FROM Sedziowie");
        while($row = pg_fetch_array($query))
        {   
           echo "Numer licencji: ".$row[0]."<br />";
           echo "Imie: ".$row[1]."<br />";
           echo "Nazwisko: ".$row[2]."<br /><br /> ";
        }
    }

    function dodaj_sedziego_form(){
        echo"
        <form action = \"sedziowie/nowy_sedzia.php\" method = \"post\">
        Numer Licencji : <br>
        <input type=\"number\" name=\"id\"><br>
        Imie: <br>
        <input type=\"text\" name=\"imie\" ><br> 
        Nazwisko: <br>
        <input type=\"text\" name=\"nazwisko\" ><br>
        Waznosc licencji: <br>
        <input type=\"text\" name=\"lic\" value=\"dd-mm-rrrr\" ><br>
        <input type=\"submit\" name =\"new\" value=\"Dodaj\">
      </form>";
      
    }

    function aktualizuj_sedziego_form(){
        echo"
        <form action = \"sedziowie/aktualizuj_sedziego.php\" method = \"post\">
        Numer Licencji : <br>
        <input type=\"number\" name=\"id\"><br>
        Imie: <br>
        <input type=\"text\" name=\"imie\" ><br> 
        Nazwisko: <br>
        <input type=\"text\" name=\"nazwisko\" ><br>
        Waznosc licencji: <br>
        <input type=\"text\" name=\"lic\"  value=\"dd-mm-rrrr\" ><br>
        <input type=\"submit\" name =\"new\" value=\"Aktualizuj\">
      </form>";
      Sedziowie();
    }
    function usun_sedziego_form(){
        echo"
        <form action = \"sedziowie/usun_sedziego.php\" method = \"post\">
        Numer Licencji : <br>
        <input type=\"number\" name=\"id\"><br>
        <input type=\"submit\" name =\"new\" value=\"Usun\">
      </form>";
      Sedziowie();
    }

    function stanowiska(){
        $db = connect();
        $query = pg_query($db, "SELECT s.id_nr_stanowiska, ss.Imie, ss.Nazwisko FROM Stanowiska s, Sedziowie ss WHERE ss.id_sedziego = s.id_sedziego;" );
        while($row = pg_fetch_array($query))
        {      
           echo "Numer stanowiska: ".$row[0]."<br />";
           echo "Sedzia: ".$row[1];
           echo " ".$row[2]."<br /><br /> ";
        }
    }

    function dodaj_stanowisko_form(){
        echo"
        <form action = \"sedziowie/nowe_stanowisko.php\" method = \"post\">
        Numer Stanowiska: <br>
        <input type=\"number\" name=\"id_stanowiska\"><br>
        Numer licencji Sędziego: <br>
        <input type=\"number\" name=\"id_sedziego\"><br>
        <input type=\"submit\" name =\"new\" value=\"Dodaj\">
      </form>";
      Sedziowie();
    }

    function usun_stanowisko_form(){
        echo"
        <form action = \"sedziowie/usun_stanowisko.php\" method = \"post\">
        Numer stanowiska : <br>
        <input type=\"number\" name=\"id\"><br>
        <input type=\"submit\" name =\"new\" value=\"Usun\">
      </form>";
      stanowiska();
    }

    function pokaz_kluby(){
        $db = connect();
        $query = pg_query($db, "SELECT * FROM Kluby ");
        echo "<table ><tr><th>Numer licencji</th><th>Klub</tr>";

        while($row = pg_fetch_array($query))
        {   
            while($row = pg_fetch_array($query))
            {   
               echo "<tr><td>".$row[0]."</td>";
               echo "<td>".$row[1];
               echo " ".$row[2]."</td>";
            }
        }
        echo"</tr></table>";
    }

    function dodaj_klub_form(){
        echo"
        <form action = \"kluby/nowy_klub.php\" method = \"post\">
        Numer Licencji : <br>
        <input type=\"number\" name=\"id\"><br>
        Nazwa: <br>
        <input type=\"text\" name=\"nazwa\" ><br> 
        Miasto: <br>
        <input type=\"text\" name=\"miasto\" ><br>
      
        <input type=\"submit\" name =\"new\" value=\"Dodaj\">
      </form>";
    }

    function aktualizuj_klub_form(){
        echo"
        <form action = \"kluby/aktualizuj_klub.php\" method = \"post\">
        Numer Licencji : <br>
        <input type=\"number\" name=\"id\"><br>
        Nazwa: <br>
        <input type=\"text\" name=\"nazwa\" ><br> 
        Miasto: <br>
        <input type=\"text\" name=\"miasto\" ><br>
       
        <input type=\"submit\" name =\"new\" value=\"Aktualizuj\">
      </form>";
      pokaz_kluby();
    }

    function usun_klub_form(){
        echo"
        <form action = \"kluby/usun_klub.php\" method = \"post\">
        Numer Licencji : <br>
        <input type=\"number\" name=\"id\"><br>
        <input type=\"submit\" name =\"new\" value=\"Usun\">
      </form>";
      pokaz_kluby();
    }

    function pokaz_trenerzy(){
        $db = connect();
        $query = pg_query($db, "SELECT * FROM Trenerzy");
        echo "<table ><tr><th>Numer licencji</th><th>Trener</tr>";

        while($row = pg_fetch_array($query))
        {   
            echo "<tr><td>".$row[0]."</td>";
            echo "<td>".$row[1];
            echo " ".$row[2]."</td>";
        }
        echo"</tr></table>";
    }

    function dodaj_trenera_form(){
        echo"
        <form action = \"trenerzy/nowy_trener.php\" method = \"post\">
        Numer Licencji : <br>
        <input type=\"number\" name=\"id\"><br>
        Imie: <br>
        <input type=\"text\" name=\"imie\" ><br> 
        Nazwisko: <br>
        <input type=\"text\" name=\"nazwisko\" ><br>
      
        <input type=\"submit\" name =\"new\" value=\"Dodaj\">
      </form>";
      
    }

    function aktualizuj_trenera_form(){
        echo"
        <form action = \"trenerzy/aktualizuj_trenera.php\" method = \"post\">
        Numer Licencji : <br>
        <input type=\"number\" name=\"id\"><br>
        Imie: <br>
        <input type=\"text\" name=\"imie\" ><br> 
        Nazwisko: <br>
        <input type=\"text\" name=\"nazwisko\" ><br>
       
        <input type=\"submit\" name =\"new\" value=\"Aktualizuj\">
      </form>";
      pokaz_trenerzy();
    }

    function usun_trenera_form(){
        echo"
        <form action = \"trenerzy/usun_trenera.php\" method = \"post\">
        Numer Licencji : <br>
        <input type=\"number\" name=\"id\"><br>
        <input type=\"submit\" name =\"new\" value=\"Usun\">
      </form>";
      pokaz_trenerzy();
    }

    function trenerzy_kluby(){
        $db = connect();
        $query = pg_query($db, "SELECT t.Imie, t.Nazwisko, k.Nazwa, k.miasto FROM Trenerzy t, Kluby k,trenerzy_kluby tk WHERE tk.id_trenera = t.id_trenera AND tk.id_klubu = k.id_klubu ORDER BY tk.id_klubu;");
        echo "<table ><tr><th>Trener</th><th>Klub</th></tr>";
        while($row = pg_fetch_array($query))
        {   
           echo "<tr><td>".$row[0];
           echo " ".$row[1]."</td>";
           echo "<td>".$row[2];
           echo " ".$row[3]."</td>";
        }
        echo"</tr></table>";
        
    }

    function dodaj_trenera_do_klubu_form(){
        echo"
        <form action = \"trenerzy/nowy_trener_klub.php\" method = \"post\">
        Numer Licencji Trenera: <br>
        <input type=\"number\" name=\"id_trenera\"><br>
        Numer licencji Klubu: <br>
        <input type=\"number\" name=\"id_klubu\"><br>
        <input type=\"submit\" name =\"new\" value=\"Dodaj\">
      </form>";
      echo "<div style = \"border-top: 2px solid black;\">";
      pokaz_trenerzy();
      echo "</div>";
      echo "<div style = \"border-top: 2px solid black;\">";

        pokaz_kluby();
        echo "</div>";
    }

    function usun_trenera_do_klubu_form(){
        echo"
        <form action = \"trenerzy/usun_trener_klub.php\" method = \"post\">
        Numer Licencji Trenera : <br>
        <input type=\"number\" name=\"id_t\"><br>
        Numer Licencji Klubu : <br>
        <input type=\"number\" name=\"id_k\"><br>
        <input type=\"submit\" name =\"new\" value=\"Usun\">
      </form>";
      echo "<div style = \"border-top: 2px solid black;\">";

      trenerzy_kluby();
      echo "</div>";

    }

    function pokaz_zawodnikow(){
        $db = connect();
        $query = pg_query($db, "SELECT * FROM Zawodnicy ORDER BY Plec;" );
        echo "<table ><tr><th>Numer licencji</th><th>Imie</th><th>Nazwisko</th><th>Kategoria</th><th>Ważność licencji</th></tr>";
        while($row = pg_fetch_array($query))
        {   
           echo "<tr><td>".$row[0]."</td>";
           echo "<td>".$row[2]."</td>";
           echo "<td>".$row[3]."</td>";
           echo "<td>".$row[4]."</td>";
           echo "<td>".$row[5]."</td></tr>";
        }
        echo"</tr></table>";
    }

    function dodaj_zawodnika_form(){
        echo"
        <form action = \"zawodnicy/nowy_zawodnik.php\" method = \"post\">
        Numer Licencji Zawodnika: <br>
        <input type=\"number\" name=\"id_zawodnika\"><br>
        Numer Licencji Klubu: <br>
        <input type=\"number\" name=\"id_klubu\"><br>
        Imie: <br>
        <input type=\"text\" name=\"imie\" ><br> 
        Nazwisko: <br>
        <input type=\"text\" name=\"nazwisko\" ><br>
        Kategoria: <br>

        <select name=\"kategoria\">
        <option VALUE=\"M\"> Mężczyźni (M)</option>
        <option VALUE=\"K\">Kobiety (K)</option>
        </select><br>
        Ważność licencji: <br>
        <input type=\"text\" name=\"lic\"  value=\"dd-mm-rrrr\"><br>
        
        <input type=\"submit\" name =\"new\" value=\"Dodaj\">
      </form>";
      echo "<div style = \"border-top: 2px solid black;\">";

      pokaz_kluby();
      echo "</div>";
    }

    function aktualizuj_zawodnika_form(){
        echo"
        <form action = \"zawodnicy/aktualizuj_zawodnika.php\" method = \"post\">
        Numer Licencji Zawodnika: <br>
        <input type=\"number\" name=\"id_zawodnika\"><br>
        Numer Licencji Klubu: <br>
        <input type=\"number\" name=\"id_klubu\"><br>
        Imie: <br>
        <input type=\"text\" name=\"imie\" ><br> 
        Nazwisko: <br>
        <input type=\"text\" name=\"nazwisko\" ><br>
        Kategoria: <br>
        <select name=\"kategoria\">
        <option VALUE=\"M\"> Mężczyźni (M)</option>
        <option VALUE=\"K\">Kobiety (K)</option>
        </select><br>
        Ważność licencji: <br>
        <input type=\"text\" name=\"lic\"  value=\"dd-mm-rrrr\"><br>
        
        <input type=\"submit\" name =\"new\" value=\"Aktualizuj\">
      </form>";
      echo "<div style = \"border-top: 2px solid black;\">";
      pokaz_zawodnikow();
      echo "</div>";
      echo "<div style = \"border-top: 2px solid black;\">";

      pokaz_kluby();
      echo "</div>";
    }

    function usun_zawodnika_form(){
        echo"
        <form action = \"zawodnicy/usun_zawodnika.php\" method = \"post\">
        Numer Licencji Zawodnika : <br>
        <input type=\"number\" name=\"id_zaw\"><br>
        <input type=\"submit\" name =\"new\" value=\"Usun\">
      </form>";
      echo "<div style = \"border-top: 2px solid black;\">";
      pokaz_zawodnikow();
      echo "</div>";
    }

    function Sklady_klubowe()
    {
        $tmp1 = '';
        $tmp2 = '';
        $db = connect();
        $query = pg_query($db, "SELECT * FROM Sklady_klubowe_zarejestrowane");
        while($row = pg_fetch_array($query))
        {   
            
            if($tmp1 != $row[0] && $tmp2 != $row[1]){
            echo "<div style = \"border: 2px solid black;\">";
           echo "Klub: ".$row[0];
           echo " ".$row[1]."<br /> <br /></div>";
            }           
            echo "id_zawodnika: ".$row[4]."<br />";
           echo "Imie: ".$row[2]."<br />";
           echo "Nazwisko: ".$row[3]."<br /> <br/>";
           $tmp1 = $row[0];
           $tmp2 = $row[1];
        }
    }

    function rozstawienie(){
        $tmp1 = 0;
        $tmp2 = 0;
        $tmp3 = '';
        $db = connect();
        $query = pg_query($db, "SELECT * FROM Rozstawienie_zawodnikow_dopuszczonych");
        while($row = pg_fetch_array($query))
        {   
            if($tmp2 != $row[1]){
                
                
            echo "<div style = \"border: 2px solid black;\">";
            echo "<b>Odleglosc: ".$row[1]."</b><br></div>";  
           
            }
            if($tmp3 != $row[7]){
                echo "<div style = \"border: 2px solid black;\">";
                echo "<b>Kategoria: ".$row[7]."<br /><br /></b></div>";
                
            }
            if($tmp1 != $row[0]){
                echo "<div style = \"border: 2px solid black;\">";
           echo "Stanowisko: ".$row[0]."<br /><br/> </div>";
                
            }
           
            echo "Numer licencji: ".$row[2]."<br>";
           echo "Imie: ".$row[3]."<br />";
           echo "Nazwisko: ".$row[4]."<br />";
           echo "Klub: ".$row[5]; 
           echo " ".$row[6]."<br /><br/>";

            $tmp1 = $row[0];
            $tmp2 = $row[1];
            $tmp3 = $row[7];
        }
    }


    function pokaz_zawodnicy_niezapisani(){
        $db = connect();
        $query = pg_query($db, "SELECT * FROM zawodnicy_niezapisani ORDER BY Plec;" );
        echo "<table ><tr><th>Numer licencji</th><th>Imie</th><th>Nazwisko</th><th>Kategoria</th></tr>";
        while($row = pg_fetch_array($query))
        {   
           echo "<tr><td>".$row[0]."</td>";
           echo "<td>".$row[1]."</td>";
           echo "<td>".$row[2]."</td>";
           echo "<td>".$row[3]."</td></tr>";
        }
        echo"</tr></table>";
    }

    function pokaz_zawodnicy_zapisani(){
        $db = connect();
        $query = pg_query($db, "SELECT * FROM zawodnicy WHERE id_zawodnika NOT IN (SELECT id_Zawodnika FROM zawodnicy_niezapisani) ORDER BY Plec;" );
        echo "<table ><tr><th>Numer licencji</th><th>Imie</th><th>Nazwisko</th><th>Kategoria</th></tr>";
        while($row = pg_fetch_array($query))
        {   
           echo "<tr><td>".$row[0]."</td>";
           echo "<td>".$row[1]."</td>";
           echo "<td>".$row[2]."</td>";
           echo "<td>".$row[3]."</td></tr>";
        }
        echo"</tr></table>";
    }

    function dodaj_do_listy_startowej_form(){
        echo"
        <form action = \"zawodnicy/dodaj_do_listy_zaw.php\" method = \"post\">
        Numer Licencji Zawodnika: <br>
        <input type=\"number\" name=\"id_zawodnika\"><br>
        Numer stanowiska: <br>
        <input type=\"number\" name=\"id_stan\"><br>
        Odległość: <br>
        <select name=\"odl\">
        <option VALUE=\"90\"> 90m</option>
        <option VALUE=\"70\" selected>70m</option>
        <option VALUE=\"60\">60m</option>
        <option VALUE=\"50\">50m</option>
        <option VALUE=\"30\">30m</option>
        </select><br>
        <input type=\"submit\" name =\"new\" value=\"Dodaj\">
      </form>";

      echo "<div style = \"border-top: 2px solid black;\">";
    echo "<b>Zawodnicy nie będący na liście: </b><br>";
      pokaz_zawodnicy_niezapisani();
      echo "<br></div>";
      echo "<div style = \"border-top: 2px solid black;\">";
      rozstawienie();
      echo "</div>";
    }

    function aktualizuj_zawodnika_lista_form(){
        echo"
        <form action = \"zawodnicy/aktualizuj_liste.php\" method = \"post\">
        Numer Licencji Zawodnika: <br>
        <input type=\"number\" name=\"id_zawodnika\"><br>
        Numer nowego stanowiska: <br>
        <input type=\"number\" name=\"id_stan\"><br>
        Odległość: <br>
        <select name=\"odl_poprzednia\">
        <option VALUE=\"90\"> 90m</option>
        <option VALUE=\"70\" selected>70m</option>
        <option VALUE=\"60\">60m</option>
        <option VALUE=\"50\">50m</option>
        <option VALUE=\"30\">30m</option>
        </select><br>
        Nowa dległość: <br>
        <select name=\"odl\">
        <option VALUE=\"90\"> 90m</option>
        <option VALUE=\"70\" selected>70m</option>
        <option VALUE=\"60\">60m</option>
        <option VALUE=\"50\">50m</option>
        <option VALUE=\"30\">30m</option>
        </select><br>
        <input type=\"submit\" name =\"new\" value=\"Aktualizuj\">
      </form>";
      echo "<div style = \"border-top: 2px solid black;\">";
      pokaz_zawodnicy_zapisani();
      echo "</div>";

      echo "<div style = \"border-top: 2px solid black;\">";
      rozstawienie();
      echo "</div>";
    }

    function usun_zawodnika_lista_form(){
        echo"
        <form action = \"zawodnicy/usun_z_listy.php\" method = \"post\">
        Numer Licencji Zawodnika : <br>
        <input type=\"number\" name=\"id_zaw\"><br>
        <input type=\"submit\" name =\"new\" value=\"Usun\">
      </form>";
      echo "<div style = \"border-top: 2px solid black;\">";
      rozstawienie();
      echo "</div>";
    }

    function wyniki_zaw(){
        $tmp1 = '';
        $db = connect();
        $query = pg_query($db, "SELECT * FROM Wyniki_ogolne;");                   
        echo"<table>";
        while($row = pg_fetch_array($query))
        {
           if($tmp1 != $row[1]){
                echo"</table>";
                echo "<div style = \"border-top: 2px solid black;\">";
                echo "<table ><tr><th>Lp.</th><th>Imie</th><th>Nazwisko</th><th>Klub</th><th>Wynik</th><th>Kategoria</th></tr></div>";
           }
           echo "<tr><td>".$row[0].". </td>";
           echo "<td>".$row[2]."</td>";
           echo "<td>".$row[3]."</td>";

           echo "<td>".$row[4];
           echo " ".$row[5]."</td>";
           echo "<td> ".$row[6]."</td>";
           echo "<td> ".$row[1]."</td></tr>";
           $tmp1 = $row[1];
        }
        echo "</table >";
    }

    function wyniki_odl(){   
        $tmp1 = 0;
        $tmp2 = '';
        $db = connect();
        $query = pg_query($db, "SELECT * FROM Wyniki_Odleglosci");
        while($row = pg_fetch_array($query))
        {   
            
            if($tmp1 != $row[6]){
                if($tmp1 != 0){
                    echo "</table >";
                    echo "<div style = \"border-top: 2px solid black;\">";
                    echo "<table ><tr><th>Lp.</th><th>Imie</th><th>Nazwisko</th><th>Klub</th><th>Wynik</th><th>Kategoria</th></tr></div>";
                }

            echo "<div style = \"border: 2px solid black;\">";
            echo "Odleglosc: ".$row[6]."<br /></div>";  
           
            }
            if($tmp2 != $row[1]){
                echo"</table>";
                echo "<div style = \"border-top: 2px solid black;\">";
                echo "<table ><tr><th>Lp.</th><th>Imie</th><th>Nazwisko</th><th>Klub</th><th>Wynik</th><th>Kategoria</th></tr></div>";
           }
           echo "<tr><td>".$row[0].". </td>";
           echo "<td>".$row[2]."</td>";
           echo "<td>".$row[3]."</td>";

           echo "<td>".$row[4];
           echo " ".$row[5]."</td>";
           echo "<td> ".$row[7]."</td>";
           echo "<td> ".$row[1]."</td></tr>";

           $tmp1 = $row[6];
           $tmp2 = $row[1];
        }
        echo "</table >";
    }

    function dodaj_wynik_zawodnika_form(){
        echo"
        <form action = \"wyniki/nowy_wynik.php\" method = \"post\">
        Numer Licencji Zawodnika: <br>
        <input type=\"number\" name=\"id_zawodnika\"><br>
        Odległość: <br>
        <select name=\"odl\">
        <option VALUE=\"90\"> 90m</option>
        <option VALUE=\"70\">70m</option>
        <option VALUE=\"60\">60m</option>
        <option VALUE=\"50\">50m</option>
        <option VALUE=\"30\">30m</option>
        </select><br>
        Wynik: <br>
        <input type=\"number\" name=\"wyn\"><br>
        Liczba X: <br>
        <input type=\"number\" name=\"l_x\"><br>
        Liczba 10: <br>
        <input type=\"number\" name=\"l_10\"><br>
        Liczba 9: <br>
        <input type=\"number\" name=\"l_9\"><br>
        <input type=\"submit\" name =\"new\" value=\"Dodaj\">
      </form>";
    }
//dp naprawienia wyniki w kategoriach
    function wyniki_team(){
        $db = connect();
        $query = pg_query($db, "SELECT * FROM Wyniki_team");
        echo "<table ><tr><th>Lp.</th><th>Klub</th><th>Wynik</th></tr>";

        while($row = pg_fetch_array($query))
        {   
            echo "<tr><td>".$row[0]."</td>";

           echo "<td>".$row[1];
           echo" ".$row[2]."</td>" ;
           echo "<td>".$row[3]."</td></tr>";
        }
        echo "</table >";

    }
    function staty_form(){
        echo"<form action = \"zawodnicy/staty.php\" method = \"post\">
        Numer Licencji: <br>
        <input type=\"number\" name=\"id\" ><br> 
      
        <input type=\"submit\" name =\"new\" value=\"Dodaj\">
      </form>";
      echo "<div style = \"border-top: 2px solid black;\">";

      pokaz_zawodnicy_zapisani();
      echo "</div>";
    }
?>

<html lang="pl">

    <head>
        <meta charset="utf-8" >
        <title>Proj_BD</title>
        <link rel="StyleSheet" href="index.css" type="text/css">
    </head>
        
    <body>
        <h1 style="text-align:center;">Zarządzanie turniejem łuczniczym</h1>

        <div class = "row">
            <div class = "column left">
                <h2>MENU</h2>
            <form method="post">
                    <h3 >Dane organizacyjne</h3>
                    <div class = "section">
                <input type="submit" name="sedziowie" value="Sędziowie" /><br/>
                    <input type="submit" name="dodaj_sedziego_form" value="Dodaj" />
                    <input type="submit" name="aktualizuj_sedziego_form" value="Aktualizuj" />
                    <input type="submit" name="usun_sedziego_form" value="Usun" /><br/>
                    </div>
                    <div class = "section">

                    <input type="submit" name="stanowiska" value="Stanowiska" /><br/>
                    <input type="submit" name="dodaj_stanowisko_form" value="Dodaj" />
                    <input type="submit" name="usun_stanowisko_form" value="Usuń" /><br/>
                    </div>
                    <div class = "section">
                    <input type="submit" name="pokaz_kluby" value="Zarejestrowane kluby" /><br/>
                    <input type="submit" name="dodaj_klub_form" value="Dodaj" />
                    <input type="submit" name="aktualizuj_klub_form" value="Aktualizuj" />
                    <input type="submit" name="usun_klub_form" value="Usun" /><br/>
                    </div>
                    <div class = "section">

                    <input type="submit" name="pokaz_trenerow" value="Trenerzy" /><br/>
                    <input type="submit" name="dodaj_trenera_form" value="Dodaj" />
                    <input type="submit" name="aktualizuj_trenera_form" value="Aktualizuj" />
                    <input type="submit" name="usun_trenera_form" value="Usun" /><br/>
                    </div>
                    <div class = "section">

                    <input type="submit" name="trenerzy-kluby" value="Trenerzy-Kluby" /><br/>
                    <input type="submit" name="dodaj_trenera_do_klubu_form" value="Dodaj" />
                    <input type="submit" name="usun_trenera_do_klubu_form" value="Usun" /><br/>
                    </div>
                    <div class = "section">

                    <input type="submit" name="pokaz_zawodnikow" value="Zarejestrowani zawodnicy" /><br/>
                    <input type="submit" name="dodaj_zawodnika_form" value="Dodaj" />
                    <input type="submit" name="aktualizuj_zawodnika_form" value="Aktualizuj" />
                    <input type="submit" name="usun_zawodnika_form" value="Usun" /><br/>
                    </div>

                    <h3>Wprowadź dane:</h3>                    
                    <div class = "section">

                    <input type="submit" name="dodaj_do_listy_startowej_form" value="Lista startowa" /><br/>
                    <input type="submit" name="aktualizuj_zawodnika_lista_form" value="Aktualizuj" />
                    <input type="submit" name="usun_zawodnika_lista_form" value="Usuń" /><br/>
                    </div>
                    <div class = "section">

                    <input type="submit" name="dodaj_wynik_zawodnika_form" value="Wprowadzanie wyników" /><br/>
                    </div>
                    <h3>Dla uczestnikow</h3>

                    <div class = "section">
                <input type="submit" name="sklady_klubowe" value="Składy klubowe" /><br/>
                <input type="submit" name="rozstawienie" value="Rozstawienie" /><br/>
                <input type="submit" name="wyniki_odl" value="Wyniki na odleglosciach" /><br/>
                <input type="submit" name="wyniki_zaw" value="Wyniki Koncowe" /><br/>
                <input type="submit" name="wyniki_team" value="Wyniki teamowe" /><br/>
                <input type="submit" name="staty_form" value="Statystyki zawodnika" /><br/>

                </div>

            </form>

            </div>
            
            <div class = "column right" >
                Projekt wykonany na zajęcia z przedmiotu bazy danych<br>
                Temat: Organizacja turnieju sportowego<br>
                Autor: Krystian Molenda<br>
                </div>                
                <div class="column right">

                <div id="insert_section"></div>
                <?php #endregion
                //sedziowie
                if(array_key_exists('sedziowie',$_POST)){
                    sedziowie();
                }
                elseif(array_key_exists('dodaj_sedziego_form',$_POST)){
                    dodaj_sedziego_form();
                }
                elseif(array_key_exists('aktualizuj_sedziego_form',$_POST)){
                    aktualizuj_sedziego_form();
                }   
                elseif(array_key_exists('usun_sedziego_form',$_POST)){
                    usun_sedziego_form();
                }
                //stanowiska
                elseif(array_key_exists('stanowiska',$_POST)){
                    stanowiska();
                }   
                elseif(array_key_exists('dodaj_stanowisko_form',$_POST)){
                    dodaj_stanowisko_form();
                }
                elseif(array_key_exists('usun_stanowisko_form',$_POST)){
                    usun_stanowisko_form();
                }
                //kluby
               elseif(array_key_exists('pokaz_kluby',$_POST)){
                    pokaz_kluby();
                }
                elseif(array_key_exists('dodaj_klub_form',$_POST)){
                    dodaj_klub_form();
                }
                elseif(array_key_exists('aktualizuj_klub_form',$_POST)){
                    aktualizuj_klub_form();
                }
                elseif(array_key_exists('usun_klub_form',$_POST)){
                    usun_klub_form();
                }
                //trenerzy
                elseif(array_key_exists('pokaz_trenerow', $_POST)){
                    pokaz_trenerzy();
                }
                elseif(array_key_exists('dodaj_trenera_form', $_POST)){
                    dodaj_trenera_form();
                }
                elseif(array_key_exists('aktualizuj_trenera_form', $_POST)){
                    aktualizuj_trenera_form();
                }
                elseif(array_key_exists('usun_trenera_form', $_POST)){
                    usun_trenera_form();
                }
                //trenerzy-kluby
                elseif(array_key_exists('dodaj_trenera_do_klubu_form', $_POST)){
                    dodaj_trenera_do_klubu_form();
                }
                elseif(array_key_exists('trenerzy-kluby', $_POST)){
                    trenerzy_kluby();
                }
                elseif(array_key_exists('usun_trenera_do_klubu_form', $_POST)){
                    usun_trenera_do_klubu_form();
                }
                //zawodnicy
                elseif(array_key_exists('pokaz_zawodnikow', $_POST)){
                    pokaz_zawodnikow();
                }
                elseif(array_key_exists('dodaj_zawodnika_form', $_POST)){
                    dodaj_zawodnika_form();
                }
                elseif(array_key_exists('aktualizuj_zawodnika_form', $_POST)){
                    aktualizuj_zawodnika_form();
                }
                elseif(array_key_exists('usun_zawodnika_form', $_POST)){
                    usun_zawodnika_form();
                }
                //przebieg turnieju
                elseif(array_key_exists('dodaj_do_listy_startowej_form', $_POST)){
                    dodaj_do_listy_startowej_form();
                }
                elseif(array_key_exists('aktualizuj_zawodnika_lista_form', $_POST)){
                    aktualizuj_zawodnika_lista_form();
                }
                elseif(array_key_exists('usun_zawodnika_lista_form', $_POST)){
                    usun_zawodnika_lista_form();
                }
                elseif(array_key_exists('dodaj_wynik_zawodnika_form', $_POST)){
                    dodaj_wynik_zawodnika_form();
                }
                //dla zawodnikow
                elseif(array_key_exists('sklady_klubowe', $_POST)){
                    Sklady_klubowe();
                }
                elseif(array_key_exists('rozstawienie', $_POST)){
                    rozstawienie();
                }
                elseif(array_key_exists('wyniki_odl', $_POST)){
                    wyniki_odl();
                }
                elseif(array_key_exists('wyniki_zaw', $_POST)){
                    wyniki_zaw();
                }
                elseif(array_key_exists('wyniki_team', $_POST)){
                    wyniki_team();
                }
                elseif(array_key_exists('staty_form', $_POST)){
                    staty_form();
                    echo file_get_contents('staty.php');
                }

                ?>                       
            </div>
        </div>
    </body>
</html>