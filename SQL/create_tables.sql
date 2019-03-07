
CREATE TABLE public.Kluby (
                id_klubu SERIAL ,
                Nazwa VARCHAR NOT NULL,
                Miasto VARCHAR ,
                CONSTRAINT id_klubu PRIMARY KEY (id_klubu)
);

CREATE DOMAIN lic_zawodnik_date AS date CHECK((VALUE >'01-01-2000'::date) AND (VALUE < (CURRENT_DATE + 365)::date));
COMMENT ON DOMAIN lic_zawodnik_date IS 'Niepoprawna data wazności licencji zawodnika'; 

CREATE DOMAIN kat_char AS CHAR CHECK((VALUE = 'M'::CHAR) OR (VALUE = 'K'::CHAR));
COMMENT ON DOMAIN kat_char IS 'kategoria'; 

CREATE TABLE public.Zawodnicy (
                id_zawodnika SERIAL,
                id_klubu INTEGER,
                Imie VARCHAR NOT NULL,
                Nazwisko VARCHAR NOT NULL,
                Plec kat_char NOT NULL,
                Licencja_wazna lic_zawodnik_date,
                CONSTRAINT id_zawodnika PRIMARY KEY (id_zawodnika, id_klubu)
);

CREATE TABLE public.Trenerzy (
                id_trenera SERIAL,
                Imie VARCHAR NOT NULL,
                Nazwisko VARCHAR NOT NULL,
                CONSTRAINT id_trenera PRIMARY KEY (id_trenera)
);

CREATE DOMAIN lic_sedziowie_date AS date CHECK((VALUE >'01-01-2000'::date) AND
     (VALUE <  (CURRENT_DATE + (5*365))::date));
COMMENT ON DOMAIN lic_sedziowie_date IS 'Niepoprawna data wazności licencji Sedziego'; 

CREATE TABLE public.Sedziowie (
                id_sedziego SERIAL,
                Imie VARCHAR NOT NULL,
                Nazwisko VARCHAR NOT NULL,
                Licencja_wazna lic_sedziowie_date ,
                CONSTRAINT id_sedziego PRIMARY KEY (id_sedziego)
);

--domeny dotyczące wprowadzanych wyników
--odleglosci w metrach
CREATE DOMAIN odl_int AS INTEGER CHECK((VALUE =90::integer) OR (VALUE =70::integer) OR 
    (VALUE =60::integer) OR (VALUE =50::integer) OR (VALUE =30::integer));
COMMENT ON DOMAIN odl_int IS 'odleglosc'; 

--wynik glowny
CREATE DOMAIN wynik_int AS INTEGER CHECK((VALUE >=0::integer) AND (VALUE <=720::integer));
COMMENT ON DOMAIN wynik_int IS 'wynik'; 

-- wprowadzana liczba trafien
CREATE DOMAIN l_x_10_int AS INTEGER CHECK((VALUE >=0::integer) AND (VALUE <=72::integer));
COMMENT ON DOMAIN l_x_10_int IS 'liczba X lub 10'; 

CREATE DOMAIN l_9_int AS INTEGER CHECK((VALUE >=0::integer) AND (VALUE <=80::integer));
COMMENT ON DOMAIN l_9_int IS 'liczba 9'; 

CREATE TABLE public.Wyniki (
                id_wynik SERIAL,
                Liczba_X l_x_10_int ,
                Liczba_10 l_x_10_int ,
                Liczba_9 l_9_int,
                Wynik wynik_int ,
                CONSTRAINT id_wynik PRIMARY KEY (id_wynik)

);
CREATE SEQUENCE seq_nr_stan_int START 1  MAXVALUE 16; 

CREATE TABLE public.Stanowiska (
                id_nr_stanowiska INTEGER DEFAULT nextval('seq_nr_stan_int') NOT NULL,
                id_sedziego INTEGER NOT NULL,
                CONSTRAINT id_nr_stanowiska PRIMARY KEY (id_nr_stanowiska, id_sedziego)
);


CREATE TABLE public.trenerzy_kluby (
                id_trenera INTEGER NOT NULL,
                id_klubu INTEGER,
                CONSTRAINT trenerzy_kluby_pk PRIMARY KEY (id_trenera, id_klubu)
);

CREATE TABLE public.Lista_startowa (             
                id_nr_stanowiska INTEGER NOT NULL,
                id_sedziego INTEGER NOT NULL,
                id_klubu INTEGER,
                id_zawodnika INTEGER NOT NULL,
                id_wynik INTEGER NOT NULL,
                Odleglosc INTEGER NOT NULL,
                CONSTRAINT lista_startowa_pk PRIMARY KEY (id_zawodnika, id_nr_stanowiska, id_sedziego, id_wynik)
);

/*
Warning: Relationship has no columns to map:
*/
ALTER TABLE public.Zawodnicy ADD CONSTRAINT kluby_zawodnicy_fk
FOREIGN KEY (id_klubu)
REFERENCES public.Kluby (id_klubu)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE public.Stanowiska ADD CONSTRAINT sedziowie_stanowiska_fk
FOREIGN KEY (id_sedziego)
REFERENCES public.Sedziowie (id_sedziego)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE public.trenerzy_kluby ADD CONSTRAINT trenerzy_trenerzy_kluby_fk
FOREIGN KEY (id_trenera)
REFERENCES public.Trenerzy (id_trenera)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE public.Lista_startowa ADD CONSTRAINT stanowiska_lista_startowa_fk
FOREIGN KEY (id_nr_stanowiska, id_sedziego)
REFERENCES public.Stanowiska (id_nr_stanowiska, id_sedziego)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE public.trenerzy_kluby ADD CONSTRAINT kluby_trenerzy_kluby_fk
FOREIGN KEY (id_klubu)
REFERENCES public.Kluby (id_klubu)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE public.Lista_startowa ADD CONSTRAINT zawodnicy_lista_startowa_fk
FOREIGN KEY (id_zawodnika, id_klubu)
REFERENCES public.Zawodnicy (id_zawodnika, id_klubu)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE public.Lista_startowa ADD CONSTRAINT wyniki_lista_startowa_fk
FOREIGN KEY (id_wynik)
REFERENCES public.Wyniki (id_wynik)
ON DELETE CASCADE
ON UPDATE CASCADE
NOT DEFERRABLE;