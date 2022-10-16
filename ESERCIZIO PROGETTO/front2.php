<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<body>

<h1>Inserisci Ciclista</h1>

<form action="insCic.php">

    <label for="CodC">Codice Ciclista:</label><br>
    <input type="text" id="CodC" name="CodC" placeholder="e.g. 5"><br><br>
    
    <label for="Nome">Nome Ciclista:</label><br>
    <input type="text" id="Nome" name="Nome" placeholder="e.g. Mario"><br><br>
    
    <label for="Cognome">Cognome Ciclista:</label><br>
    <input type="text" id="Cognome" name="Cognome" placeholder="e.g. Rossi"><br><br>
    
    <label for="Nazionalita">Nazionalità Cicilista:</label><br>
    <input type="text" id="Naizonalita" name="Nazionalita" placeholder="e.g. Italiana"><br><br>
	
	
	<label for="CodS">Squadra:</label><br>
    <select id="CodS" name="CodS" class="w3-select">
	<option value="CodS"> - seleziona un codice squadra - </option>
    <?php

        /* Establish DB connection */
        $conn = @mysqli_connect ( 'localhost', 'root', '', 'CICLISMO' );

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error ();
        } 

        /* Query construction */
        $query = "SELECT CodS FROM SQUADRA";
        
        /* Query execution */
        $result = mysqli_query ( $conn, $query );
        if (!$result){
            die ( 'Query error: ' . mysqli_error ( $conn ) );
        }

        /* Check if course found */
        if (mysqli_num_rows ( $result ) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $codS = $row["CodS"];
                echo "<option value='$codS'>$codS</option>";
            }
        }

    ?>
	</select>
	
    <label for="AnnoDiNascita">Anno di Nascita Ciclista:</label><br>
    <input type="text" id="AnnoDiNascita" name="AnnoDiNascita" placeholder="e.g. 1980"><br><br>

    <input type="submit" value="Inserisci">
</form> 


</body>
</html>
