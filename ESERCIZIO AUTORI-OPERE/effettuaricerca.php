<html>
<head>
	<title>Risultati</title>
</head>

<body>

<?php

	/* CONTROLLO PARAMETRI */

	if( isset($_REQUEST["annoDa"])==false or isset($_REQUEST["annoA"])==false or isset($_REQUEST["città"])==false) {
		die("Errore: inserire tutti i dati richiesti");
	}

	if( is_numeric($_REQUEST["annoDa"])==false or is_numeric($_REQUEST["annoA"])==false or ($_REQUEST["annoDa"] > $_REQUEST["annoA"])) {
		die("Errore: anni non corretti");
	}


	/* ASSEGNAZIONE VARIABILI */
	$annoInizio = $_REQUEST["annoDa"];
	$annoFine = $_REQUEST["annoA"];
	$citta = $_REQUEST["città"];


	/* CONNESSIONE AL DB*/
	$con = mysqli_connect('localhost','root','','opere');

	if (mysqli_connect_errno())	{
		die ('Failed to connect to MySQL: ' . mysqli_connect_error());
	}


	/* QUERY SQL */ 
	$sql  = " SELECT autore.cognome AS autore, opera.nome AS opera, categoria
			  FROM autore, opera
			  WHERE autore.coda = opera.autore
				AND anno >= $annoInizio
				AND anno <= $annoFine
				AND opera.citta = '$citta'
			  ORDER BY cognome, opera";


	/* ESECUZIONE QUERY */ 
	$result = mysqli_query($con, $sql);

	if( !$result )
		die('Query error: ' . mysqli_error($con));

	/* HTML CON RISULTATI */
	echo "<h1> Opere a $citta degli autori nati tra il $annoInizio e il $annoFine </h1>"; 


	if( mysqli_num_rows($result) > 0 )	{
		echo "<table border=1 cellpadding=10>";
		/* Generazione riga intestazione della tabella */
		echo "	<tr>";
				for ($i = 0; $i < mysqli_num_fields($result); $i++)	{
					$attributo  =  mysqli_fetch_field($result);
					$nomeAttr = $attributo->name;
					echo "<th> $nomeAttr </th>";
				}  
		echo "	</tr>";

		/* Generazione di una riga della tabella per ogni risultato*/
		while ($row = mysqli_fetch_row($result)) {
			// Scelta del colore di background in base al tipo di opera
			switch($row[2]){
				case "architettura":	$color = "yellow";
										break;
				case "pittura":		   	$color = "orange";
										break;
				case "scultura": 		$color = "white";
										break;
				default: 				$color = "blue";
			}

			echo "<tr bgcolor=$color>";
				foreach ($row as $cell) {
					echo "<td>$cell</td>";
				}
			echo "</tr>";
		}

		echo "</table>";
	}	else	{
		echo "<h4> Nessun risultato</h4>";
	}

	//chiusura della connessione
	mysqli_close($con);

?>

</body>
</html>
