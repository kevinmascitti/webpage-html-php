<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<body>

<?php

/* Verify parameter CodC */
if (!isset($_REQUEST["CodC"]) || trim($_REQUEST["CodC"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Codice ciclista mancante o vuoto.</p>
    </div>";
    exit;
}

/* The <div> tag defines a division or a section in an HTML document.
The <div> tag is used as a container for HTML elements - which is 
then styled with CSS or manipulated with JavaScript.
The <div> tag is easily styled by using the class or id attribute.
Any sort of content can be put inside the <div> tag! 
*/

/* Verify parameter CodT */
if (!isset($_REQUEST["CodT"]) || trim($_REQUEST["CodT"]) == "" ){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Codice tappa mancante o vuoto.</p>
    </div>";
    exit;
}

$ciclista  = $_REQUEST["CodC"];
$tappa  = $_REQUEST["CodT"];

/* Establish DB connection */
$conn = @mysqli_connect ( 'localhost', 'root', '', 'CICLISMO' );

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
} 

/* String sanification for DB query */
$ciclista =  utf8_decode( mysqli_real_escape_string($conn, $ciclista)  ); 
$tappa =  utf8_decode( mysqli_real_escape_string($conn, $tappa)  ); 

/* Check Type */
if (!filter_var($tappa, FILTER_VALIDATE_INT)){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Il codice della tappa deve essere un valore numerico intero.</p>
    </div>";
    exit;
}

/* Check Type */
if ($tappa < 1){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Il codice della tappa deve essere un numero intero positivo.</p>
    </div>";
    exit;
}

/* Query construction */
$query = "SELECT C.Nome as Nome,
			C.Cognome as Cognome,
			S.NomeS as NomeSquadra,
			CL.CodT as CodT,
			CL.Edizione as Edizione,
			CL.Posizione as Posizione
			FROM CICLISTA as C, CLASSIFICA_INDIVIDUALE	as CL, SQUADRA as S
			WHERE C.CodC = CL.CodC AND C.CodS=S.CodS AND C.CodC = $ciclista AND CL.CodT = $tappa 
			ORDER BY CL.Edizione ";

/* Query execution */
$result = mysqli_query ( $conn, $query );
if (!$result){
    die ( 'Query error: ' . mysqli_error ( $conn ) );
}

/* Check if course found */
if (mysqli_num_rows ( $result ) > 0) {
    $ciclistaEN = utf8_encode($ciclista);
    $tappaEN = utf8_encode($tappa);
	
    echo "<h1>E' stato trovato il ciclista con codice $ciclistaEN.<br></h1>";
	echo "<h1><br>Il ciclista ha partecipato alla tappa $tappaEN nelle seguenti edizioni:<br></h1>";

    echo "<table class='w3-table-all w3-hoverable'>";
	
    /* Table header */
    echo "<thead><tr>";
    
	echo "<th>Nome</th>";	
	echo "<th>Cognome</th>";
	echo "<th>Nome squadra</th>";
    echo "<th>Edizione</th>";
    echo "<th>Posizione</th>";

    echo "</thead></tr>";
    
    /* Table content */
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>". htmlspecialchars($row["Nome"]) . "</td>";
        echo "<td>". htmlspecialchars($row["Cognome"]) . "</td>";
        echo "<td>". htmlspecialchars($row["NomeSquadra"]) . "</td>";
        echo "<td>". htmlspecialchars($row["Edizione"]) . "</td>";
        echo "<td>". htmlspecialchars($row["Posizione"]) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
	
} else {
    echo "<h1>Nessun risultato trovato.</h1>";
}

?>

</body>
</html>
