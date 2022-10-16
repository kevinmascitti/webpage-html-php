<html>

  <head>
    <title>Risultati</title>

  </head>

  <body>
  
  <?php

  /* ASSEGNAZIONE VARIABILI */
  $a1 = $_REQUEST["anno1"];
  $a2 = $_REQUEST["anno2"];
  $c = $_REQUEST["citta"];

  /* CONNESSIONE AL DB*/
  $con = mysqli_connect('localhost','root','','opere');
  if (mysqli_connect_errno()){
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
  }

  /* QUERY SQL */ 
   $sql  = "SELECT autore.cognome AS autore, opera.nome AS opera, categoria
   FROM autore, opera
   WHERE autore.coda = opera.autore
   AND anno >= $a1 AND anno <= $a2 AND opera.citta =  '$c'
   ORDER BY cognome, opera";

  /* ESECUZIONE QUERY */ 
  $result = mysqli_query($con,$sql);
  if( !$result )
    die('Query error: ' . mysqli_error($con));

  /* HTML CON RISULTATI */
  echo "<h1> Opere a $c degli autori nati tra il $a1 e il $a2 </h1>"; 

  /* TABELLA CON RISULTATI */
  if( mysqli_num_rows($result) > 0 ){
    echo "<table border=1 cellpadding=10>";
    echo "<tr>";
    for ($i = 0; $i < mysqli_num_fields($result); $i++){
      $title  =  mysqli_fetch_field($result);
      $name = $title->name;
      echo "<th> $name </th>";
    }  
    echo "</tr>";

    while ($row = mysqli_fetch_row($result)) {

      echo "<tr>";
      foreach ($row as $cell) {
          echo "<td>$cell</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  }else{
    echo "<h4> Nessun risultato</h4>";
  }

  //chiusura della connessione
  mysqli_close($con);
  ?>
  </body>
</html>