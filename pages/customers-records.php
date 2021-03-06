<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css">


  <title>Customer Records</title>
  <meta charset="utf-8">

</head>

<body>
<?php require("navbar.html"); ?>

 <div class="row">
    <div class="col">
    <h2>Customer Records</h2>
    </div>
    
  </div> 

  <?php
  session_start();

   $serverName = "localhost"; 
   $userName = "root"; 
   $password = ""; 
   $databaseName = "final_project";

try{
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true){      echo '<div class="container-fluid">';
      echo '<div class="row">';
      echo '<div class="col-sm-8"><h4>Hello, '.$_SESSION["username"] .'</h4>';
      echo '</div>';
      echo '<div class="col-sm-4"><a href="user-logout.php" type="button" class="btn btn-info" style="float: right;">Logout</a>';
      echo '</div>';
      echo '<br /><p>To edit a record, click on the record ID</p>';
      echo '</div></div>';

      
        $selectQuery = "SELECT * FROM customers ORDER BY customer_id";
        $query = $conn->prepare($selectQuery);
        $query->execute();
      
        $result = $query->setFetchMode(PDO::FETCH_ASSOC);
?>

        <div class="col">
    <button style="float: right; margin-bottom: 1em;" type="button" class="btn btn-success" onclick="document.location='create-customer-record.php'">Create New record</button>
    </div>

    <?php
        $htmlOutput = '<table class="table table-hover">'; 
        $htmlOutput .= '<thead class="thead-dark">';
        $htmlOutput .= "<tr>"; 
        $htmlOutput .= '<th scope="col">Customer ID</th>';
        $htmlOutput .= '<th scope="col">Customer Name</th>';
        $htmlOutput .= '<th scope="col">Address</th>';
        $htmlOutput .= '<th scope="col">City</th>';
        $htmlOutput .= '<th scope="col">Status</th>';
        $htmlOutput .= "</tr>";
        $htmlOutput .= '</thead>';

          foreach($query->fetchAll() as $value){
              $htmlOutput .= "<tr>";
              $htmlOutput .= "<td>";
              $htmlOutput .= '<a href="read-customer-record.php?id='.$value["customer_id"].'">'.$value["customer_id"].'</a>';
              $htmlOutput .= "</td>";
              $htmlOutput .= "<td>";
              $htmlOutput .= $value["customer_name"];
              $htmlOutput .= "</td>";          
              $htmlOutput .= "<td>";
              $htmlOutput .= $value["customer_address"];
              $htmlOutput .= "</td>";          
              $htmlOutput .= "<td>";
              $htmlOutput .= $value["customer_city"];
              $htmlOutput .= "</td>";          
              $htmlOutput .= "<td>";
              $htmlOutput .= $value["customer_status"];
              $htmlOutput .= "</td>";
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
    catch(PDOException $e){
      echo "<br />Could not establish database connection.";
    }//end catch
  ?>
</body>
</html>