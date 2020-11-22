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
<div class="row">
    <div class="col">
    <h2>Customer Orders</h2>
    </div>
    
  </div> 

  
<?php
  session_start();

  $serverName = "localhost";  
  $userName = "root";  
  $password = "";  
  $databaseName = "final_project";

  $fieldSize = 30;

  try {
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      if($_SESSION["authenticated"] === true){
        echo 'Hello, '.$_SESSION["username"];
        echo '<div class="row"><div class="col"><br />';
        echo '</div></div>'; 

      $customerOrdersQueryString = "SELECT * FROM customers, orders";
      $customerOrdersQueryString.= " WHERE customers.customer_id = orders.customer_id";
      $customerOrdersQuery = $conn->prepare($customerOrdersQueryString);
      $customerOrdersQuery->execute();
      

      $htmlOutput = '<table class="table table-hover">'; 
      $htmlOutput .= '<thead class="thead-dark">';
      $htmlOutput .= "<tr>"; 
      $htmlOutput .= '<th scope="col">Order ID</th>';
      $htmlOutput .= '<th scope="col">Order Date</th>';
      $htmlOutput .= '<th scope="col">Order Status</th>';
      $htmlOutput .= "</tr>";
      $htmlOutput .= '</thead>';


        foreach($customerOrdersQuery->fetchAll() as $key=>$value){

          $htmlOutput .= "<tr>";
          $htmlOutput .= "<td>";
          $htmlOutput .= $value["order_id"];
          $htmlOutput .= "</td>";          
          $htmlOutput .= "<td>";
          $htmlOutput .= $value["order_date"];
          $htmlOutput .= "</td>";          
          $htmlOutput .= "<td>";
          $htmlOutput .= $value["order_status"];
          $htmlOutput .= "</td>";          

            // echo "<br />order_id: ".$value["order_id"];
            // echo "<br />order_date: ".$value["order_date"];
            // echo "<br />order_status: ".$value["order_status"];
        }//end foreach
        $htmlOutput .= "</table>"; 
        echo $htmlOutput;
      }//end if
      else{
        echo "Please login first!";
        echo '<br />';
        echo '<a href="user-login.php" type="button" class="btn btn-primary" >Login</a>';
      }
    echo "<br />end of records";
      }//end try
  catch (PDOException $e) {
    echo '<br />  $e (toString()): '.$e;
    echo '<br />  $e->getMessage(): '.$e->getMessage();
    echo '<br />$e->getCode(): '.$e->getCode();
  } // end catch

?>
  


</body>
</html>
