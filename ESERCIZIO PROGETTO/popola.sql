START TRANSACTION;

INSERT INTO CICLISTA (CodC, Nome, Cognome, Nazionalita, CodS, AnnoNascita)
VALUES (2, 'Federico', 'Rossi', 'Italiana', 1, 1980);
INSERT INTO CLASSIFICA_INDIVIDUALE (CodC, CodT, Edizione, Posizione)
VALUES (2, 3, 70, 1);

COMMIT;