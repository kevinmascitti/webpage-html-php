<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<body>

<h1>Inserisci posizione in classifica</h1>

<form action="insPos.php">

	<label for="CodC">Codice Ciclista:</label><br>
    <select id="CodC" name="CodC" class="w3-select">
	<option value="CodC"> - seleziona un codice ciclista - </option>
    <?php

        /* Establish DB connection */
        $conn = @mysqli_connect ( 'localhost', 'root', '', 'CICLISMO' );

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error ();
        } 

        /* Query construction */
        $query = "SELECT CodC FROM CICLISTA";
        
        /* Query execution */
        $result = mysqli_query ( $conn, $query );
        if (!$result){
            die ( 'Query error: ' . mysqli_error ( $conn ) );
        }

        /* Check if course found */
        if (mysqli_num_rows ( $result ) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $codC = $row["CodC"];
                echo "<option value='$codC'>$codC</option>";
            }
        }

    ?>
	</select>
	
	<label for="CodT">Codice tappa:</label><br>
    <select id="CodT" name="CodT" class="w3-select">
	<option value="CodT"> - seleziona un codice tappa - </option>
    <?php

        /* Establish DB connection */
        $conn = @mysqli_connect ( 'localhost', 'root', '', 'CICLISMO' );

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error ();
        } 

        /* Query construction */
        $query = "SELECT DISTINCT CodT FROM TAPPA";
        
        /* Query execution */
        $result = mysqli_query ( $conn, $query );
        if (!$result){
            die ( 'Query error: ' . mysqli_error ( $conn ) );
        }

        /* Check if course found */
        if (mysqli_num_rows ( $result ) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $codT = $row["CodT"];
                echo "<option value='$codT'>$codT</option>";
            }
        }

    ?>
	</select>
	
	<label for="Edizione">Edizione:</label><br>
    <select id="Edizione" name="Edizione" class="w3-select">
	<option value="Edizione"> - seleziona un'edizione - </option>
    <?php

        /* Establish DB connection */
        $conn = @mysqli_connect ( 'localhost', 'root', '', 'CICLISMO' );

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error ();
        } 

        /* Query construction */
        $query = "SELECT Edizione FROM TAPPA";
        
        /* Query execution */
        $result = mysqli_query ( $conn, $query );
        if (!$result){
            die ( 'Query error: ' . mysqli_error ( $conn ) );
        }

        /* Check if course found */
        if (mysqli_num_rows ( $result ) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $ed = $row["Edizione"];
                echo "<option value='$ed'>$ed</option>";
            }
        }

    ?>
	</select>
	
    <label for="Posizione">Posizione Ciclista:</label><br>
    <input type="text" id="Posizione" name="Posizione" placeholder="e.g. 2"><br><br>

    <input type="submit" value="Inserisci">
</form> 


</body>
</html>
