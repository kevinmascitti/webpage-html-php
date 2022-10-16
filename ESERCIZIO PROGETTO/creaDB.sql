-- create an empty database. Name of the database: 
SET storage_engine=InnoDB;
SET FOREIGN_KEY_CHECKS=1;
CREATE DATABASE IF NOT EXISTS CICLISMO
CHARACTER SET utf8mb4;
USE CICLISMO;


-- drop tables if they already exist
DROP TABLE IF EXISTS CICLISTA;
DROP TABLE IF EXISTS SQUADRA;
DROP TABLE IF EXISTS TAPPA;
DROP TABLE IF EXISTS CLASSIFICA_INDIVIDUALE;

-- create tables

SET autocommit=0;
START TRANSACTION;

CREATE TABLE SQUADRA (
	CodS INT ,
	NomeS CHAR(50) NOT NULL ,
	AnnoFondazione INT NOT NULL ,
	SedeLegale CHAR(50) ,
	PRIMARY KEY (CodS) ,
	
	CONSTRAINT chk_AnnoFondazione CHECK (AnnoFondazione>=1900 and AnnoFondazione<=2000)
);

CREATE TABLE CICLISTA (
	CodC INT ,
	Nome CHAR(50) NOT NULL ,
	Cognome CHAR(50) NOT NULL ,
	Nazionalita CHAR(50) NOT NULL ,
	CodS INT NOT NULL ,
	AnnoNascita INT NOT NULL ,
	PRIMARY KEY (CodC) ,
	
	FOREIGN KEY (CodS)
		REFERENCES SQUADRA(CodS) 
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE TAPPA (
	Edizione INT ,
	CodT INT ,
	CittaPartenza CHAR(50) NOT NULL ,
	CittaArrivo CHAR(50) NOT NULL ,
	Lunghezza DOUBLE NOT NULL,
	Dislivello DOUBLE NOT NULL,
	GradoDifficolta INT NOT NULL,
	PRIMARY KEY (Edizione, CodT) ,
	
	CONSTRAINT chk_GradoDifficolta CHECK (GradoDifficolta>=1 and GradoDifficolta<=10)
);

CREATE TABLE CLASSIFICA_INDIVIDUALE (
	CodC INT ,
	CodT INT ,
	Edizione INT ,
	Posizione INT NOT NULL ,
	PRIMARY KEY (CodC, CodT, Edizione),
	FOREIGN KEY (CodC)
		REFERENCES CICLISTA(CodC) 
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (Edizione, CodT)
		REFERENCES TAPPA(Edizione, CodT) 
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

COMMIT;

START TRANSACTION;

INSERT INTO SQUADRA (CodS, NomeS, AnnoFondazione, SedeLegale)
VALUES (1, 'TorinoFC', 1970, 'Torino');
INSERT INTO CICLISTA (CodC, Nome, Cognome, Nazionalita, CodS, AnnoNascita)
VALUES (1, 'Mario', 'Verdi', 'Italiana', 1, 1976);
INSERT INTO TAPPA (Edizione, CodT, CittaPartenza, CittaArrivo, Lunghezza, Dislivello, GradoDifficolta)
VALUES (70, 3, 'Milano', 'Torino', 300000, 30, 2);
INSERT INTO CLASSIFICA_INDIVIDUALE (CodC, CodT, Edizione, Posizione)
VALUES (1, 3, 70, 2);
INSERT INTO TAPPA (Edizione, CodT, CittaPartenza, CittaArrivo, Lunghezza, Dislivello, GradoDifficolta)
VALUES (75, 2, 'Venezia', 'Milano', 300000, 30, 2);
INSERT INTO CLASSIFICA_INDIVIDUALE (CodC, CodT, Edizione, Posizione)
VALUES (1, 2, 75, 4);
INSERT INTO TAPPA (Edizione, CodT, CittaPartenza, CittaArrivo, Lunghezza, Dislivello, GradoDifficolta)
VALUES (73, 1, 'Milano', 'Venezia', 300000, 30, 2);
INSERT INTO CLASSIFICA_INDIVIDUALE (CodC, CodT, Edizione, Posizione)
VALUES (1, 1, 73, 8);
INSERT INTO TAPPA (Edizione, CodT, CittaPartenza, CittaArrivo, Lunghezza, Dislivello, GradoDifficolta)
VALUES (77, 2, 'Venezia', 'Milano', 300000, 30, 2);
INSERT INTO CLASSIFICA_INDIVIDUALE (CodC, CodT, Edizione, Posizione)
VALUES (1, 2, 77, 1);

COMMIT;
