drop table Wyniki cascade;
drop table Sedziowie cascade;
drop table Stanowiska cascade;
drop table Trenerzy cascade;
drop table Kluby cascade;
drop table trenerzy_kluby cascade;
drop table Zawodnicy cascade;
drop table Lista_startowa cascade;

drop domain lic_zawodnik_date;
drop domain lic_kluby_date;
drop domain lic_sedziowie_date;
drop domain kat_char;
drop domain odl_int;
drop domain wynik_int;
drop domain l_x_10_int;
drop domain l_9_int;
drop sequence seq_nr_stan_int;


drop view sklady_klubowe;
drop view Rozstawienie_zawodnikow;
drop view Podpowiedz;