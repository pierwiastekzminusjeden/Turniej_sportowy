
-- Obsługa listy startowej

CREATE OR REPLACE FUNCTION zawodnik_do_startowej() RETURNS TRIGGER
AS '
DECLARE
aktualna_data DATE;
waznosc_lic DATE;
kat_zawodnika CHAR;
tmp INTEGER;
BEGIN
    IF EXISTS(SELECT 1 FROM Lista_startowa WHERE id_zawodnika = NEW.id_zawodnika AND Odleglosc = NEW.Odleglosc) THEN
        RAISE NOTICE ''Zawodnik jest juz przypisany do tej odleglosci'';
        RETURN NULL;
    END IF;

    IF((SELECT COUNT(id_nr_stanowiska) FROM Lista_startowa WHERE id_nr_stanowiska = NEW.id_nr_stanowiska AND Odleglosc = NEW.Odleglosc) >= 2 ) THEN
        RAISE NOTICE ''Za duzo zawodnikow na stanowisku'';
        RETURN NULL;
    END IF;
          
    IF EXISTS(SELECT 1 FROM Lista_startowa WHERE id_klubu = NEW.id_klubu AND id_nr_stanowiska = NEW.id_nr_stanowiska AND Odleglosc = NEW.Odleglosc) THEN
        RAISE NOTICE ''Zawodnicy z tego samego klubu nie moga byc na stanowisku'';
        RETURN NULL;
    END IF;
    
    SELECT Plec INTO kat_zawodnika FROM Zawodnicy WHERE id_zawodnika = NEW.id_zawodnika;
    IF EXISTS(SELECT 1 FROM Lista_Startowa ls WHERE ls.id_nr_stanowiska = NEW.id_nr_stanowiska AND (SELECT Plec FROM Zawodnicy WHERE
    id_zawodnika = ls.id_zawodnika ) != kat_zawodnika  AND ls.Odleglosc = NEW.Odleglosc) THEN
        RAISE NOTICE ''Zawodnicy z Roznych kategorii nie moga byc na stanowisku'';
        RETURN NULL;
    END IF;

    SELECT CURRENT_DATE INTO aktualna_data;
    SELECT Licencja_wazna INTO waznosc_lic FROM Zawodnicy WHERE id_zawodnika = NEW.id_zawodnika;
    IF (waznosc_lic < aktualna_data) THEN
        RAISE NOTICE ''Zawodnik nie ma waznej licencji'';
        RETURN NULL;
    END IF;
    IF (NEW.id_wynik = 0) THEN
        INSERT INTO Wyniki VALUES(DEFAULT);
        SELECT MAX(id_wynik )INTO tmp FROM Wyniki;  
        NEW.id_wynik = tmp;
    END IF;
    RETURN NEW;   
END;
' LANGUAGE 'plpgsql';

CREATE TRIGGER zawodnik_do_startowej_trig BEFORE INSERT ON Lista_startowa
FOR EACH ROW EXECUTE PROCEDURE zawodnik_do_startowej();


CREATE OR REPLACE FUNCTION zawodnik_do_startowej_update() RETURNS TRIGGER
AS '
DECLARE
aktualna_data DATE;
waznosc_lic DATE;
kat_zawodnika CHAR;
tmp INTEGER;
BEGIN
  

    IF EXISTS(SELECT 1 FROM Lista_startowa WHERE id_klubu = NEW.id_klubu AND id_nr_stanowiska = NEW.id_nr_stanowiska AND Odleglosc = NEW.Odleglosc) THEN
        RAISE NOTICE ''Zawodnicy z tego samego klubu nie moga byc na stanowisku'';
        RETURN NULL;
    END IF;
    
    SELECT Plec INTO kat_zawodnika FROM Zawodnicy WHERE id_zawodnika = NEW.id_zawodnika;
    IF EXISTS(SELECT 1 FROM Lista_Startowa ls WHERE ls.id_nr_stanowiska = NEW.id_nr_stanowiska AND (SELECT Plec FROM Zawodnicy WHERE
    id_zawodnika = ls.id_zawodnika ) != kat_zawodnika  AND ls.Odleglosc = NEW.Odleglosc) THEN
        RAISE NOTICE ''Zawodnicy z Roznych kategorii nie moga byc na stanowisku'';
        RETURN NULL;
    END IF;

    SELECT CURRENT_DATE INTO aktualna_data;
    SELECT Licencja_wazna INTO waznosc_lic FROM Zawodnicy WHERE id_zawodnika = NEW.id_zawodnika;
    IF (waznosc_lic < aktualna_data) THEN
        RAISE NOTICE ''Zawodnik nie ma waznej licencji'';
        RETURN NULL;
    END IF;
    
    RETURN NEW;   
END;
' LANGUAGE 'plpgsql';

CREATE TRIGGER zawodnik_do_startowej_update BEFORE UPDATE ON Lista_startowa
FOR EACH ROW EXECUTE PROCEDURE zawodnik_do_startowej_update();

CREATE OR REPLACE FUNCTION dodaj_do_listy(INTEGER, INTEGER, INTEGER) RETURNS void 
AS '
DECLARE
id_zaw ALIAS FOR $1;
id_stan ALIAS FOR $2;
odl ALIAS FOR $3;

id_k INTEGER;
id_s INTEGER;


BEGIN
    SELECT id_klubu INTO id_k FROM Zawodnicy WHERE id_zawodnika = id_zaw;
    SELECT id_sedziego INTO id_s FROM Stanowiska WHERE id_nr_stanowiska = id_stan;
    INSERT INTO Lista_startowa VALUES(id_stan, id_s, id_k, id_zaw, 0, odl);

END;
'LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION aktualizuj_liste(INTEGER,INTEGER, INTEGER, INTEGER) RETURNS void 
AS '
DECLARE
id_zaw ALIAS FOR $1;
id_stan ALIAS FOR $2;
odl_stara ALIAS FOR $3;
odl ALIAS FOR $4;

id_k INTEGER;
id_s INTEGER;


BEGIN
    SELECT id_sedziego INTO id_s FROM Stanowiska WHERE id_nr_stanowiska = id_stan;
    UPDATE Lista_startowa SET id_nr_stanowiska= id_stan, id_sedziego = id_s, Odleglosc = odl WHERE 
    id_zawodnika = id_zaw AND Odleglosc = odl_stara ;

END;
'LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION nowy_zawodnik() RETURNS TRIGGER
AS '
DECLARE
    aktualna_data DATE;
    wazn_lic DATE;
BEGIN
    IF EXISTS(SELECT 1 FROM Zawodnicy WHERE id_zawodnika = NEW.id_zawodnika) THEN
        RAISE NOTICE ''Zawodnik o podanym numerze licencji już istnieje'';
        RETURN NULL;
    ELSE
        RETURN NEW;
    END IF;
END;
' LANGUAGE 'plpgsql';

CREATE TRIGGER nowy_zawodnik_trig BEFORE INSERT ON Zawodnicy
FOR EACH ROW EXECUTE PROCEDURE nowy_zawodnik();


--obsługa sędziów oraz stanowisk, sprawdzanie licencji oraz liczby przypisanych stanowisk
CREATE OR REPLACE FUNCTION nowy_sedzia() RETURNS TRIGGER
AS '
DECLARE
    aktualna_data DATE;
    wazn_lic DATE;
BEGIN
    SELECT CURRENT_DATE INTO aktualna_data;
    wazn_lic := NEW.Licencja_wazna;
    IF (wazn_lic > aktualna_data) THEN
        RETURN NEW;
    ELSE
        RAISE NOTICE ''Sedzia nie ma waznej licencji'';
        RETURN NULL;
    END IF;
END;
' LANGUAGE 'plpgsql';

CREATE TRIGGER nowy_sedzia_trig BEFORE INSERT OR UPDATE ON Sedziowie
FOR EACH ROW EXECUTE PROCEDURE nowy_sedzia();

CREATE OR REPLACE FUNCTION sedzia_do_stan() RETURNS TRIGGER
AS ' 
BEGIN
    IF EXISTS(SELECT 1 FROM Stanowiska WHERE id_nr_stanowiska = NEW.id_nr_stanowiska) THEN
        RAISE NOTICE ''Stanowisko istnieje z przypisanym innym sędzią'';
        RETURN NULL;
    END IF;
    IF ( ( SELECT COUNT(id_sedziego) FROM Stanowiska WHERE id_sedziego = NEW.id_sedziego) < 4 ) THEN
      RETURN NEW;
    ELSE 
        RAISE NOTICE ''Za duzo stanowisk na jednego sedziego'';
        RETURN NULL;
    END IF;
END;
'LANGUAGE 'plpgsql';

CREATE TRIGGER sedzia_do_stan BEFORE INSERT OR UPDATE ON Stanowiska
FOR EACH ROW EXECUTE PROCEDURE sedzia_do_stan();


--obsługa klubów, Zawodnicy po usunięciu klubu zostają dalej w bazie, lecz jako niezrzeszeni
CREATE OR REPLACE FUNCTION usun_klub() RETURNS TRIGGER
AS '
BEGIN
UPDATE Zawodnicy SET id_klubu = 0 WHERE id_klubu = old.id_klubu;
RETURN OLD;
END;
' LANGUAGE 'plpgsql';

CREATE TRIGGER usun_klub BEFORE DELETE ON Kluby
FOR EACH ROW EXECUTE PROCEDURE usun_klub();


CREATE OR REPLACE FUNCTION dodaj_aktualizuj_wynik(INTEGER, INTEGER, INTEGER, INTEGER, INTEGER, INTEGER) RETURNS void 
AS '
DECLARE
id_zaw ALIAS FOR $1;
odl ALIAS FOR $2;
wyn ALIAS FOR $3;
l_X ALIAS FOR $4;
l_10 ALIAS FOR $5;
l_9 ALIAS FOR $6;

BEGIN
   UPDATE Wyniki SET Wynik = wyn, Liczba_X = l_X, Liczba_10 = l_10, Liczba_9 = l_9 WHERE
         id_wynik =(SELECT id_wynik FROM Lista_startowa WHERE Odleglosc = odl AND id_zawodnika = id_zaw ) ;
END;
'LANGUAGE 'plpgsql';

--Obsługa wyników, dodawanie sumowanie
CREATE OR REPLACE FUNCTION dodaj_wynik() RETURNS TRIGGER
AS ' 
BEGIN
    IF((New.Liczba_X + New.Liczba_10 + New.Liczba_9) > NEW.Wynik) THEN
        RAISE NOTICE ''Niemozliwy wynik'';
        RETURN NULL;
    ELSE 
        RETURN NEW;
    END IF;
END;
'LANGUAGE 'plpgsql';

CREATE TRIGGER nowy_wynik BEFORE INSERT OR UPDATE ON Wyniki
FOR EACH ROW EXECUTE PROCEDURE dodaj_wynik();

CREATE OR REPLACE FUNCTION sumuj_wyniki(INTEGER) RETURNS INTEGER 
AS '
DECLARE
id_zaw ALIAS FOR $1;
sum INTEGER;
tmp INTEGER;
id_w INTEGER;
BEGIN
    sum := 0;
    FOR id_w IN SELECT id_wynik FROM Lista_startowa WHERE id_zaw = id_zawodnika 
    LOOP
        SELECT wynik INTO tmp FROM Wyniki WHERE id_wynik = id_w;
        IF tmp IS NULL THEN
            UPDATE Wyniki SET Liczba_X = 0, Liczba_10 = 0, Liczba_9 = 0, Wynik = 0 WHERE id_wynik = id_w;
            SELECT wynik INTO tmp FROM Wyniki WHERE id_wynik = id_w;
        END IF;
        sum := sum + tmp;
    END LOOP;
    RETURN sum;
END;
'LANGUAGE 'plpgsql';

--wynik pierwszego klubu jest podwojony
CREATE OR REPLACE FUNCTION sumuj_wyniki_klub(INTEGER) RETURNS INTEGER 
AS '
DECLARE
id_k ALIAS FOR $1;
id_z INTEGER;
sum INTEGER;
tmp INTEGER;
BEGIN
    sum := 0;
    FOR id_z IN SELECT DISTINCT id_zawodnika FROM Lista_startowa WHERE id_klubu = id_k 
    LOOP
        tmp := sumuj_wyniki(id_z);
        sum := sum + tmp;
    END LOOP;
    RETURN sum;
END;
'LANGUAGE 'plpgsql';


--widoki 

--Wyniki zawodników na poszczegolnych odleglosciach
CREATE VIEW Wyniki_odleglosci AS SELECT row_number() over(partition by ls.Odleglosc, z.Plec ORDER BY z.Plec, ls.Odleglosc DESC, w.wynik DESC, w.Liczba_X DESC,
 w.Liczba_10 DESC, w.Liczba_9 DESC) as lp, z.Plec AS Plec, z.imie AS Imie, z.nazwisko AS Nazwisko, k.nazwa AS Nazwa, k.miasto AS Miasto, ls.Odleglosc AS Odleglosc,
  w.wynik AS Wynik FROM Kluby k, Zawodnicy z, Wyniki w, Lista_startowa ls WHERE ls.id_zawodnika = z.id_zawodnika  AND ls.id_wynik = w.id_wynik AND ls.id_klubu = k.id_klubu ;

--wszystkie statystyki zawodnikow
CREATE VIEW zestawienie AS SELECT z.id_zawodnika, z.Plec, z.Imie, z.Nazwisko, k.nazwa, k.miasto, ls.Odleglosc, w.wynik, w.Liczba_X, w.Liczba_10, w.Liczba_9, sumuj_wyniki(z.id_zawodnika)
FROM Zawodnicy z , Wyniki w, Kluby k, Lista_startowa ls WHERE z.id_zawodnika = ls.id_zawodnika AND z.id_klubu = k.id_klubu AND ls.id_wynik = w.id_wynik;

--nie dziala
--wyniki ogolne
CREATE VIEW Wyniki_ogolne_tmp AS SELECT DISTINCT ON(id_zawodnika) row_number() over(partition by Plec ORDER BY Plec DESC,sumuj_wyniki(id_zawodnika) DESC) AS lp, Plec, Imie, Nazwisko, nazwa, miasto,
 sumuj_wyniki FROM zestawienie ;

 
CREATE VIEW Wyniki_ogolne AS SELECT DISTINCT  lp, Plec, Imie, Nazwisko, nazwa, miasto,
 sumuj_wyniki FROM Wyniki_ogolne_tmp ORDER BY Plec, lp;
 
--Wyniki teamowe
CREATE VIEW Wyniki_team AS SELECT row_number() over( ORDER BY sumuj_wyniki_klub(k.id_klubu) DESC) as lp, k.nazwa, k.miasto, sumuj_wyniki_klub(k.id_klubu) FROM Kluby k WHERE k.id_klubu != 0 ;

--Składy teamowe. Klub oraz przypisani do niego zawodnicy
CREATE VIEW Sklady_klubowe_zarejestrowane AS SELECT k.nazwa, k.miasto, z.imie, z.nazwisko, z.id_zawodnika 
    FROM Kluby k, Zawodnicy z WHERE k.id_klubu = z.id_klubu ORDER BY k.nazwa;

--Rozstawienie zawodników na poszczególnych stanowiskach
CREATE VIEW Rozstawienie_zawodnikow_dopuszczonych AS SELECT ls.id_nr_stanowiska, ls.Odleglosc, z.id_zawodnika, z.imie, z.nazwisko, k.nazwa, k.miasto, z.Plec
    FROM Lista_startowa ls, Zawodnicy z, Kluby k WHERE ls.id_zawodnika = z.id_zawodnika AND z.id_klubu = k.id_klubu 
    ORDER BY z.Plec, ls.Odleglosc DESC, ls.id_nr_stanowiska; 

CREATE VIEW zawodnicy_niezapisani AS SELECT z.id_zawodnika, z.Imie, z.Nazwisko, z.Plec FROM Zawodnicy z 
    WHERE z.id_zawodnika NOT IN (SELECT id_zawodnika FROM Lista_startowa);