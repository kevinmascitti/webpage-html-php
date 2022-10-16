<html>

  <head>
    <title>Risultati</title>

  </head>

  <body>
  
  <?php


  /* CONNESSIONE AL DB*/
  $con = mysqli_connect('localhost','root','','opere');
  if (mysqli_connect_errno()){
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
  }

  /* DISABILITA L'AUTOCOMMIT */
  if (mysqli_autocommit($con,FALSE)==FALSE){
      die ('Failed to autocommit '. mysqli_error($con));
    }
  

  /* QUERY SQL */ 
  
  $sql1  = "INSERT INTO Autore VALUES ('992', 'Gian Lorenzo', 'Bernini', 1598, 'Napoli')";
  $sql2 = "INSERT INTO Opera VALUES ('52', 'Test', 'scultura', 'Roma', 'Italia', '1')";
  /* ESECUZIONE QUERY */ 
  $result1 = mysqli_query($con,$sql1);
  $result2 = mysqli_query($con,$sql2);

  if($result1 && $result2 ){
    mysqli_commit($con);
    echo "Transazione completta con successo";
  }else{
    die('Query error: Transazione Fallita ' . mysqli_error($con));
    mysqli_rollback($con);
  }


  //chiusura della connessione
  mysqli_close($con);
  ?>
  </body>
</html>