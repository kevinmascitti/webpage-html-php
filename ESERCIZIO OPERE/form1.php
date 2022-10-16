<html>
<head>
	<title>Form 1</title>
    <style type="text/css">
    	td {
    		color:red;
    	}
    </style>
</head>
<body>
<h1> Inpostare anno di nascita dell'autore e la citt&agrave; di interesse</h1>

<form action="response_fullcss.php" method="get">
<p> Data di nascita compresa tra </p>
<table>
	<tr> <td style="color:green"> anno </td> <td> <input type="text" name="anno1"> </td> </tr>
	<tr> <td> e anno </td> <td> <input type="text" name="anno2"> </td> </tr>
	<tr>
	<td> citt&agrave; </td>
	<td>

	 <select name="citta">
	  <?php
		  /* CONNESSIONE AL DB*/
		  $con = mysqli_connect('localhost','root','','opere');
		  if (mysqli_connect_errno()){
		    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
		  }

		  /* QUERY SQL */ 
		   $sql  = "SELECT DISTINCT citta 
		   FROM opera";

		  /* ESECUZIONE QUERY */ 
		  $result = mysqli_query($con,$sql);

		  if( !$result )
		    die('Query error: ' . mysqli_error($con));
	       
	      while ($row = mysqli_fetch_row($result)) {
		      $citta = $row[0];
		      echo"<option value=\"$citta\"> $citta </option>";
	      }

		?>
	 </select>
	</td>
	</tr>
</table>

<input type="submit" value="Invia Dati">
<input type="reset" value="Cancella">

</form>

</body>
</html>