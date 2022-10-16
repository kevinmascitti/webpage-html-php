<html>
<head>
	<title>Risultati</title>
</head>

<body>

<?php

	/* CONTROLLO PARAMETRI */

	if( isset($_REQUEST["codA"])==false or 
		isset($_REQUEST["nomeA"])==false or 
		isset($_REQUEST["cognomeA"])==false or
		isset($_REQUEST["annoNascita"])==false or
		isset($_REQUEST["codO"])==false or
		isset($_REQUEST["nomeO"])==false or
		isset($_REQUEST["categoria"])==false or
		isset($_REQUEST["citta"])==false or
		isset($_REQUEST["nazione"])==false) {
		die("Errore: inserire tutti i dati richiesti");
	}

	if( is_numeric($_REQUEST["annoNascita"])==false) {
		die("Errore: anno di nascita non numerico");
	}


	/* ASSEGNAZIONE VARIABILI */
	$codA=$_REQUEST["codA"];
	$nomeA=$_REQUEST["nomeA"];
	$cognomeA=$_REQUEST["cognomeA"];
	$annoNascita=$_REQUEST["annoNascita"];
	$cittaNascita=$_REQUEST["cittaNascita"];

	$codO=$_REQUEST["codO"];
	$nomeO=$_REQUEST["nomeO"];
	$categoria=$_REQUEST["categoria"];
	$citta=$_REQUEST["citta"];
	$nazione=$_REQUEST["nazione"];


	/* CONNESSIONE AL DB*/
	$con = mysqli_connect('localhost','root','','opere');

	if (mysqli_connect_errno())	{
		die ('Failed to connect to MySQL: ' . mysqli_connect_error());
	}

	mysqli_autocommit($con , false);

	/* ESECUZIONE INSERIMENTO DATI */

	// DISABILITO AUTOCOMMIT E INIZIO TRANSAZIONE
	mysqli_query($con,"SET autocommit=0");
	if( !$result )
		die('Errore in fase di disabilitazione autocommit' . mysqli_error($con));

	$result = mysqli_query($con, "START TRANSACTION");
	if( !$result )
		die('Errore in fase di inizializzazione della transazione' . mysqli_error($con));


	// ESECUZIONE insert autore
	$insertAutore="INSERT INTO Autore(CodA, nome, cognome, anno, citta) VALUES ('$codA','$nomeA','$cognomeA',$annoNascita, '$cittaNascita')";

	$result = mysqli_query($con, $insertAutore);
	if( !$result ) {
		echo ('Errore in fase di inserimento dell\'autore ' . mysqli_error($con));
		mysqli_rollback($con);
		die();
	}

	// ESECUZIONE insert opera
	$insertOpera="INSERT INTO Opera(CodO, nome, categoria, citta, nazione, autore) VALUES ('$codO', '$nomeO', '$categoria', '$citta', '$nazione', '$codA')";

	$result = mysqli_query($con, $insertOpera);
	if( !$result ) {
		die('Errore in fase di inserimento dell\'opera ' . mysqli_error($con));
		mysqli_rollback($con);
	}	
	
	// commit della transazione
	mysqli_commit($con);
	
	/* oppure
		$result = mysqli_query($con, "COMMIT");
	*/

	//chiusura della connessione
	mysqli_close($con);

?>
<p>Dati inseriti correttamente</p>
</body>
</html>
