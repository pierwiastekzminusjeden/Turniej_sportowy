--poprawne dane glowne potrzebne do zawodow
--Insert trenerzy
INSERT INTO Trenerzy VALUES(1,'Aleksander','Jablonski');
INSERT INTO Trenerzy VALUES(2,'Ryszard','Pacura');
INSERT INTO Trenerzy VALUES(3,'Jan','Lach');
INSERT INTO Trenerzy VALUES(4,'Ryszard','Boguń');
INSERT INTO Trenerzy VALUES(5,'Helena','Machera');
INSERT INTO Trenerzy VALUES(6,'Krzysztof','Wlosik');

--Insert kluby
INSERT INTO Kluby VALUES(0,'Niezrzeszony');
INSERT INTO Kluby VALUES(1,'ULKS Grot', 'Zabierzow');
INSERT INTO Kluby VALUES(2,'ULKS SOKOLE OKO', 'Zawadka');
INSERT INTO Kluby VALUES(3,'LKS Lucznik', 'Zywiec');
INSERT INTO Kluby VALUES(4,'UKS TALENT', 'Wroclaw');
INSERT INTO Kluby VALUES(5,'Plaszowianka', 'Krakow');
INSERT INTO Kluby VALUES(6,'MGOKIS', 'Dobczyce');
INSERT INTO Kluby VALUES(7,'Wyspianski', 'Krakow');

--trenerzy_kluby
INSERT INTO trenerzy_kluby VALUES(1,1);
INSERT INTO trenerzy_kluby VALUES(2,5);
INSERT INTO trenerzy_kluby VALUES(3,3);
INSERT INTO trenerzy_kluby VALUES(4,2);
INSERT INTO trenerzy_kluby VALUES(5,4);
INSERT INTO trenerzy_kluby VALUES(6,6);
INSERT INTO trenerzy_kluby VALUES(6,7);

--Insert zawodnicy
INSERT INTO Zawodnicy VALUES(1,1,'Krystian','Molenda','M','01-04-2019');
INSERT INTO Zawodnicy VALUES(2,4,'Kajetan','Kotlarz','M','04-06-2019');
INSERT INTO Zawodnicy VALUES(3,3,'Sylwia','Zyzanska','K','03-03-2019');
INSERT INTO Zawodnicy VALUES(4,1,'Jakub','Dudek','M','13-04-2019'); 
INSERT INTO Zawodnicy VALUES(5,2,'Sylwia','Warchal','K','30-10-2019');
INSERT INTO Zawodnicy VALUES(6,2,'Paulina','Kaminska','K','12-03-2019');
INSERT INTO Zawodnicy VALUES(7,5,'Kamila','Tobola','K','30-12-2019');
INSERT INTO Zawodnicy VALUES(8,6,'Patryk','Dudzik','M','09-05-2019');
INSERT INTO Zawodnicy VALUES(9,6,'Pawel','Sitarz','M','01-05-2019');
INSERT INTO Zawodnicy VALUES(10,7,'Magdalena','Gajek','K','02-06-2019');
INSERT INTO Zawodnicy VALUES(11,7,'Katarzyna','Bielak','K','02-06-2018');

--Insert Sedziowie
INSERT INTO Sedziowie VALUES(1,'Miroslaw', 'Jablonski', '01-01-2023');
INSERT INTO Sedziowie VALUES(2,'Beata', 'Chmielewska', '11-12-2023');
INSERT INTO Sedziowie VALUES(3,'Zdzislaw', 'Toczek', '11-11-2023');
INSERT INTO Sedziowie VALUES(4,'Damian', 'Idzi', '03-03-2022');

-- Insert stanowiska
INSERT INTO Stanowiska VALUES(DEFAULT,1);
INSERT INTO Stanowiska VALUES(DEFAULT,1);
INSERT INTO Stanowiska VALUES(DEFAULT,1);
INSERT INTO Stanowiska VALUES(DEFAULT,1);
INSERT INTO Stanowiska VALUES(DEFAULT,2);
INSERT INTO Stanowiska VALUES(DEFAULT,2);


--Insert Lista startowa
--90m M
SELECT dodaj_do_listy(1,1,90);
SELECT dodaj_do_listy(2,1,90);
SELECT dodaj_do_listy(4,2,90);
SELECT dodaj_do_listy(8,2,90);
SELECT dodaj_do_listy(9,3,90);

--70m M K
SELECT dodaj_do_listy(1,1,70);
SELECT dodaj_do_listy(2,1,70);
SELECT dodaj_do_listy(4,2,70);
SELECT dodaj_do_listy(8,2,70);
SELECT dodaj_do_listy(9,3,70);

SELECT dodaj_do_listy(3,4,70);
SELECT dodaj_do_listy(5,4,70);
SELECT dodaj_do_listy(7,5,70);
SELECT dodaj_do_listy(10,5,70);
SELECT dodaj_do_listy(6,6,70);
--50m K 

SELECT dodaj_do_listy(3,4,50);
SELECT dodaj_do_listy(5,4,50);
SELECT dodaj_do_listy(7,5,50);
SELECT dodaj_do_listy(10,5,50);
SELECT dodaj_do_listy(6,6,50);

--30 M K
SELECT dodaj_do_listy(1,1,30);
SELECT dodaj_do_listy(2,1,30);
SELECT dodaj_do_listy(4,2,30);
SELECT dodaj_do_listy(8,2,30);
SELECT dodaj_do_listy(9,3,30);

SELECT dodaj_do_listy(3,4,30);
SELECT dodaj_do_listy(5,4,30);
SELECT dodaj_do_listy(7,5,30);
SELECT dodaj_do_listy(10,5,30);
SELECT dodaj_do_listy(6,6,30);

--Insert wyniki
--90m M
SELECT dodaj_aktualizuj_wynik(1,90,425,3,5,10);
SELECT dodaj_aktualizuj_wynik(2,90,433,3,11,12);
SELECT dodaj_aktualizuj_wynik(4,90,405,1,3,11);
SELECT dodaj_aktualizuj_wynik(8,90,250,2,1,9);
SELECT dodaj_aktualizuj_wynik(9,90,250,0,3,6);

--70 M K 

SELECT dodaj_aktualizuj_wynik(1,70,615,7,10,11);
SELECT dodaj_aktualizuj_wynik(2,70,603,11,11,12);
SELECT dodaj_aktualizuj_wynik(4,70,420,12,3,11);
SELECT dodaj_aktualizuj_wynik(8,70,512,5,5,20);
SELECT dodaj_aktualizuj_wynik(9,70,430,2,7,6);


SELECT dodaj_aktualizuj_wynik(3,70,644,10,15,15);
SELECT dodaj_aktualizuj_wynik(5,70,550,5,10,15);
SELECT dodaj_aktualizuj_wynik(7,70,435,2,5,11);
SELECT dodaj_aktualizuj_wynik(10,70,501,10,5,11);
SELECT dodaj_aktualizuj_wynik(6,70,430,2,7,6);

--50m


SELECT dodaj_aktualizuj_wynik(3,50,660,11,12,15);
SELECT dodaj_aktualizuj_wynik(5,50,635,5,12,15);
SELECT dodaj_aktualizuj_wynik(7,50,601,10,10,11);
SELECT dodaj_aktualizuj_wynik(10,50,595,11,9,11);
SELECT dodaj_aktualizuj_wynik(6,50,499,9,7,6);

--30

SELECT dodaj_aktualizuj_wynik(1,30,650,7,10,11);
SELECT dodaj_aktualizuj_wynik(2,30,666,11,11,12);
SELECT dodaj_aktualizuj_wynik(4,30,599,12,3,11);
SELECT dodaj_aktualizuj_wynik(8,30,601,5,5,20);
SELECT dodaj_aktualizuj_wynik(9,30,622,2,7,6);


SELECT dodaj_aktualizuj_wynik(3,30,644,10,15,15);
SELECT dodaj_aktualizuj_wynik(5,30,630,10,10,15);
SELECT dodaj_aktualizuj_wynik(7,30,555,10,11,11);
SELECT dodaj_aktualizuj_wynik(10,30,621,11,5,11);
SELECT dodaj_aktualizuj_wynik(6,30,501,12,7,6);
