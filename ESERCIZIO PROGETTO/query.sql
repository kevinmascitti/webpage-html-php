SELECT C.Nome,
	C.Cognome,
	S.NomeS,
	CL.CodT,
	CL.Edizione,
	CL.Posizione
FROM CICLISTA C, CLASSIFICA_INDIVIDUALE	CL, SQUADRA S
WHERE C.CodC = CL.CodC AND C.CodS = S.CodS AND C.CodC = 1 AND CL.CodT = 2 
ORDER BY CL.Edizione