<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
<body>

<h1>Posizione Ciclista in Tappa</h1>

<form action="getPos.php">
	
	<label for="CodC">Ciclista:</label><br>
    <select id="CodC" name="CodC" class="w3-select">
	<option value="CodC"> - seleziona un codice ciclista - </option>
    <?php

        /* Establish DB connection */
        $conn = @mysqli_connect ( 'localhost', 'root', '', 'CICLISMO' );

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error ();
        } 

        /* Query construction */
        $query = "SELECT CodC, Nome FROM CICLISTA";
        
        /* Query execution */
        $result = mysqli_query ( $conn, $query );
        if (!$result){
            die ( 'Query error: ' . mysqli_error ( $conn ) );
        }

        /* Check if course found */
        if (mysqli_num_rows ( $result ) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $codC = $row["CodC"];
                $nome = $row["Nome"];
                echo "<option value='$codC', '$nome'>$codC - $nome</option>";
                #echo "<option value='$codC'>$codC - ";							????????????????
                #echo "<option value='$nome'>$nome</option>";					????????????????
            }
        }

    ?>
	</select>
	
    <label for="CodT">Codice Tappa:</label><br>
    <input type="text" id="CodT" name="CodT" placeholder="e.g. 2"><br><br>

    <input type="submit" value="Cerca">
</form> 

</body>
</html>
