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

/* Verify parameter CodT */
if (!isset($_REQUEST["CodT"]) || trim($_REQUEST["CodT"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Codice tappa mancante o vuoto.</p>
    </div>";
    exit;
}

/* Verify parameter Edizione */
if (!isset($_REQUEST["Edizione"]) || trim($_REQUEST["Edizione"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Edizione mancante o vuoto.</p>
    </div>";
    exit;
}

/* Verify parameter posizione */
if (!isset($_REQUEST["Posizione"]) || trim($_REQUEST["Posizione"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Posizione ciclista mancante o vuoto.</p>
    </div>";
    exit;
}

/* The <div> tag defines a division or a section in an HTML document.
The <div> tag is used as a container for HTML elements - which is 
then styled with CSS or manipulated with JavaScript.
The <div> tag is easily styled by using the class or id attribute.
Any sort of content can be put inside the <div> tag! 
*/

$ciclista  = $_REQUEST["CodC"];
$tappa  = $_REQUEST["CodT"];
$edizione  = $_REQUEST["Edizione"];
$posizione  = $_REQUEST["Posizione"];

/* Establish DB connection */
$conn = @mysqli_connect ( 'localhost', 'root', '', 'CICLISMO' );

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
} 

/* String sanification for DB query */
$ciclista =  utf8_decode( mysqli_real_escape_string($conn, $ciclista)  ); 
$tappa =  utf8_decode( mysqli_real_escape_string($conn, $tappa)  ); 
$edizione =  utf8_decode( mysqli_real_escape_string($conn, $edizione)  ); 
$posizione =  utf8_decode( mysqli_real_escape_string($conn, $posizione)  ); 

/* Check Type */
if (!filter_var($ciclista, FILTER_VALIDATE_INT)){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Il codice del ciclista deve essere un valore numerico intero.</p>
    </div>";
    exit;
}
/* Check Type */
if (!filter_var($tappa, FILTER_VALIDATE_INT)){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Il codice della tappa deve essere un valore numerico intero.</p>
    </div>";
    exit;
}
/* Check Type */
if (!filter_var($edizione, FILTER_VALIDATE_INT)){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>L'edizione deve essere un valore numerico intero.</p>
    </div>";
    exit;
}
/* Check Type */
if (!filter_var($posizione, FILTER_VALIDATE_INT)){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>La posizione deve essere un valore numerico intero.</p>
    </div>";
    exit;
}

/* Check Type */
$query = "SELECT COUNT(*)
			FROM CICLISTA
			WHERE CodC=$ciclista";
$result = mysqli_query ( $conn, $query );
if (!$result){
    die ( 'Query error: ' . mysqli_error ( $conn ) );
}
$num = mysqli_fetch_array($result);
if($num[0]==0){
	echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Il ciclista non è presente nell'elenco.</p>
    </div>";
    exit;
}
/* Check Type */
$query = "SELECT COUNT(*)
			FROM TAPPA
			WHERE CodT=$tappa";
$result = mysqli_query ( $conn, $query );
if (!$result){
    die ( 'Query error: ' . mysqli_error ( $conn ) );
}
$num = mysqli_fetch_array($result);
if($num[0]==0){
	echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>La tappa non è presente nell'elenco.</p>
    </div>";
    exit;
}
/* Check Type */
$query = "SELECT COUNT(*)
			FROM TAPPA
			WHERE Edizione=$edizione";
$result = mysqli_query ( $conn, $query );
if (!$result){
    die ( 'Query error: ' . mysqli_error ( $conn ) );
}
$num = mysqli_fetch_array($result);
if($num[0]==0){
	echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>L'edizione non è presente nell'elenco.</p>
    </div>";
    exit;
}
/* Check Type */
$query = "SELECT Posizione
			FROM CLASSIFICA_INDIVIDUALE
			WHERE CodC=$ciclista";
$result = mysqli_query ( $conn, $query );
if (!$result){
    die ( 'Query error: ' . mysqli_error ( $conn ) );
}
$num = mysqli_fetch_array($result);
if($num[0]!=0){
	echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>La posizione del ciclista è già presente.</p>
    </div>";
    exit;
}

/* Query construction */
$query = "INSERT INTO CLASSIFICA_INDIVIDUALE (CodC, CodT, Edizione, Posizione)
			VALUES ($ciclista, $tappa, $edizione, $posizione)";

/* Query execution */
$result = mysqli_query ( $conn, $query );
if (!$result){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Inserimento della posizione relativa al ciclista $ciclista non riuscito! ". mysqli_error ( $conn ) ." </p>
    </div>";
    exit;
} else {
    echo "<div class='w3-panel w3-green'>
        <h3>Inserimento avvenuto!</h3>
        <p>Inserimento della posizione relativa al ciclista $ciclista avvenuto con successo.</p>
    </div>  ";
    exit;
}

?>

</body>
</html>
