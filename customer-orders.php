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
    
    if(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true){
        echo '<div class="container-fluid">';
        echo '<div class="row">';
        echo '<div class="col-sm-8"><h4>Hello, '.$_SESSION["username"] .'</h4>';
        echo '</div>';
        echo '<div class="col-sm-4"><a href="user-logout.php" type="button" class="btn btn-info" style="float: right;">Logout</a>';
        echo '</div>';
        echo '<br /><p>Here you can view orders placed by customers:</p>';
        echo '</div></div>';

      $customerOrdersQueryString = "SELECT * FROM customers, orders";
      $customerOrdersQueryString.= " WHERE customers.customer_id = orders.customer_id";
      $customerOrdersQuery = $conn->prepare($customerOrdersQueryString);
      $customerOrdersQuery->execute();
      
      $htmlOutput = '<table class="table table-hover">'; 
      $htmlOutput .= '<thead class="thead-dark">';
      $htmlOutput .= "<tr>"; 
      $htmlOutput .= '<th scope="col">Customer ID</th>';
      $htmlOutput .= '<th scope="col">Customer name</th>';
      $htmlOutput .= '<th scope="col">Order ID</th>';
      $htmlOutput .= '<th scope="col">Order Date</th>';
      $htmlOutput .= '<th scope="col">Order Status</th>';
      $htmlOutput .= "</tr>";
      $htmlOutput .= '</thead>';


        foreach($customerOrdersQuery->fetchAll() as $key=>$value){

          $htmlOutput .= "<tr>";
          $htmlOutput .= "<td>";
          $htmlOutput .= $value["customer_id"];
          $htmlOutput .= "</td>";
          $htmlOutput .= "<td>";
          $htmlOutput .= $value["customer_name"];
          $htmlOutput .= "</td>";
          $htmlOutput .= "<td>";
          $htmlOutput .= $value["order_id"];
          $htmlOutput .= "</td>";          
          $htmlOutput .= "<td>";
          $htmlOutput .= $value["order_date"];
          $htmlOutput .= "</td>";          
          $htmlOutput .= "<td>";
          $htmlOutput .= $value["order_status"];
          $htmlOutput .= "</td>";
          $htmlOutput .=  "</tr>";         

        }//end foreach
        $htmlOutput .= "</table>"; 
        echo $htmlOutput;
      }//end if
      else{
        echo "<br />Please login first!<br />";
        echo '<br /><a href="user-login.php" type="button" class="btn btn-primary" >Login</a>';
      }
      
      echo '<a href="user-landing.php" type="button" class="btn btn-primary" style="float: right;">Back</a>';
    }//end try
  catch (PDOException $e) {
    echo '<br />  $e (toString()): '.$e;
    echo '<br />  $e->getMessage(): '.$e->getMessage();
    echo '<br />$e->getCode(): '.$e->getCode();
  } // end catch

?>
  


</body>
</html>
