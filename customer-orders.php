<!DOCTYPE html>
<html>
<head>
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

  <title>Customer Orders</title>
  <meta charset="utf-8">

</head>

<body>
<?php require("navbar.html"); ?>
  <h3>Customer Orders</h3>

  
<?php
  $serverName = "localhost";  
  $userName = "root";  
  $password = "";  
  $databaseName = "final_project";

  $fieldSize = 30;


  try {
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $customerOrdersQueryString = "SELECT * FROM customers, orders";
    $customerOrdersQueryString.= " WHERE customers.customer_id = orders.customer_id";
    echo $customerOrdersQueryString;
    $customerOrdersQuery = $conn->prepare($customerOrdersQueryString);
    $customerOrdersQuery->execute();

    foreach($customerOrdersQuery->fetchAll() as $key=>$value){
        echo "<br />order_id: ".$value["order_id"];
        echo "<br />order_date: ".$value["order_date"];
        echo "<br />order_status: ".$value["order_status"];
    }
   

  }  // end try
  catch (PDOException $e) {
    echo '<br />  $e (toString()): '.$e;
    echo '<br />  $e->getMessage(): '.$e->getMessage();
    echo '<br />$e->getCode(): '.$e->getCode();
  } // end catch

?>
  


</body>
</html>
