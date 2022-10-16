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

/* Verify parameter Nome */
if (!isset($_REQUEST["Nome"]) || trim($_REQUEST["Nome"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Nome ciclista mancante o vuoto.</p>
    </div>";
    exit;
}

/* Verify parameter Cognome */
if (!isset($_REQUEST["Cognome"]) || trim($_REQUEST["Cognome"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Cognome ciclista mancante o vuoto.</p>
    </div>";
    exit;
}

/* Verify parameter Nazionalita */
if (!isset($_REQUEST["Nazionalita"]) || trim($_REQUEST["Nazionalita"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Nazionalità ciclista mancante o vuoto.</p>
    </div>";
    exit;
}

/* Verify parameter CodS */
if (!isset($_REQUEST["CodS"]) || trim($_REQUEST["CodS"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Codice squadra mancante o vuoto.</p>
    </div>";
    exit;
}

/* Verify parameter AnnoDiNascita */
if (!isset($_REQUEST["AnnoDiNascita"]) || trim($_REQUEST["AnnoDiNascita"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Anno di nascita ciclista mancante o vuoto.</p>
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
$nome  = $_REQUEST["Nome"];
$cognome  = $_REQUEST["Cognome"];
$nazionalita  = $_REQUEST["Nazionalita"];
$squadra  = $_REQUEST["CodS"];
$anno  = $_REQUEST["AnnoDiNascita"];

/* Establish DB connection */
$conn = @mysqli_connect ( 'localhost', 'root', '', 'CICLISMO' );

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
} 

/* String sanification for DB query */
$ciclista =  utf8_decode( mysqli_real_escape_string($conn, $ciclista)  ); 
$nome =  utf8_decode( mysqli_real_escape_string($conn, $nome)  ); 
$cognome =  utf8_decode( mysqli_real_escape_string($conn, $cognome)  ); 
$nazionalita =  utf8_decode( mysqli_real_escape_string($conn, $nazionalita)  ); 
$squadra =  utf8_decode( mysqli_real_escape_string($conn, $squadra)  ); 
$anno =  utf8_decode( mysqli_real_escape_string($conn, $anno)  ); 

/* Check Type */
if (!filter_var($ciclista, FILTER_VALIDATE_INT)){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Il codice del ciclista deve essere un valore numerico intero.</p>
    </div>";
    exit;
}
/* Check Type */
if (!filter_var($squadra, FILTER_VALIDATE_INT)){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Il codice della squadra deve essere un valore numerico intero.</p>
    </div>";
    exit;
}
/* Check Type */
if (!filter_var($anno, FILTER_VALIDATE_INT)){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>L'anno di nascita del ciclista deve essere un valore numerico intero.</p>
    </div>";
    exit;
}
/* Check Type */
$query = "SELECT COUNT(*)
			FROM SQUADRA
			WHERE CodS=$squadra";
$result = mysqli_query ( $conn, $query );
if (!$result){
    die ( 'Query error: ' . mysqli_error ( $conn ) );
}
$num = mysqli_fetch_array($result);
if($num[0]==0){
	echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>La squadra non è presente nell'elenco di squadre.</p>
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
if($num[0]!=0){
	echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Il ciclista è già presente nell'elenco.</p>
    </div>";
    exit;
}

/* Query construction */
$query = "INSERT INTO CICLISTA (CodC, Nome, Cognome, Nazionalita, CodS, AnnoNascita)
			VALUES ($ciclista, '$nome', '$cognome', '$nazionalita', $squadra, $anno)";

/* Query execution */
$result = mysqli_query ( $conn, $query );
if (!$result){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Inserimento $ciclista non riuscito! ". mysqli_error ( $conn ) ." </p>
    </div>";
    exit;
} else {
    echo "<div class='w3-panel w3-green'>
        <h3>Inserimento avvenuto!</h3>
        <p>Inserimento del ciclista $ciclista avvenuto con successo.</p>
    </div>  ";
    exit;
}
?>

</body>
</html>
