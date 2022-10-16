SET storage_engine=InnoDB;
SET FOREIGN_KEY_CHECKS=1;


-- create database

CREATE DATABASE IF NOT EXISTS Opere;
USE Opere;


-- drop tables if exist
 DROP TABLE IF EXISTS Opera;
 DROP TABLE IF EXISTS Autore;



-- create tables

SET autocommit=0;
START TRANSACTION;

CREATE TABLE Autore (
  `codA` varchar(10) PRIMARY KEY,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `anno` integer NOT NULL,
  `citta` varchar(20) NOT NULL
);

CREATE TABLE Opera (
  `codO` varchar(10) PRIMARY KEY,
  `nome` varchar(30) NOT NULL,
  `categoria` varchar(20) NOT NULL,
  `citta` varchar(20) NOT NULL,
  `nazione` varchar(20) NOT NULL,
  `autore` varchar(10) NOT NULL REFERENCES autore(codA)
);

COMMIT;



-- insert data values

START TRANSACTION;

INSERT INTO Autore VALUES ('1', 'Gian Lorenzo', 'Bernini', 1598, 'Napoli');
INSERT INTO Autore VALUES ('2', 'Francesco', 'Borromini', 1599, 'Bissone');

INSERT INTO Opera VALUES ('1', 'Apollo e Dafne', 'scultura', 'Roma', 'Italia', '1');
INSERT INTO Opera VALUES ('2', 'Baldacchino S.Pietro', 'architettura', 'Roma', 'Italia', '1');
INSERT INTO Opera VALUES ('3', 'Fontana dei fiumi', 'architettura', 'Roma', 'Italia', '1');
INSERT INTO Opera VALUES ('4', 'S.Ivo la Sapienza', 'architettura', 'Roma', 'Italia', '2');
        
COMMIT;

