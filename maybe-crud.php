<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style type="text/css">
    ol {
      margin:1em;
      width:70%;
    }
    pre {
      border: 1px solid black;
      margin: 1em 0;
    }
    body {
      padding: 1em;
    }
  </style>

  <title>PHP</title>
  <meta charset="utf-8">

</head>

<body>


  <h3>Database connection</h3>

  
<?php

  $serverName = "localhost"; 
  $userName = "root";  
  $password = "";  
  $databaseName = "final_project";


  try {
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);

    echo "<br />";
    var_dump($conn);

    $selectQuery = "SELECT * FROM customers ORDER BY customer_id";
    $query = $conn->prepare($selectQuery);
    $query->execute();
  
    $result = $query->setFetchMode(PDO::FETCH_ASSOC);

  }
  catch (PDOException $e) {
    echo "<br />Could not establish database connection.";
  }

?>
</body>
</html>
