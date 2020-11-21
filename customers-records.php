<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css">


  <title>PHP</title>
  <meta charset="utf-8">

</head>

<body>

<h2>Customer Records</h2>


  
  <div class="row">
    <div class="col">
    <h5 style="margin-top: 0.5em;">To edit a record, click on the record ID</h5>
    </div>
    <div class="col">
    <button style="float: right; margin-bottom: 1em;" type="button" class="btn btn-success" onclick="document.location='create-customer-record.php'">Create New record</button>
    </div>
  </div>

  <?php
   $serverName = "localhost"; 
   $userName = "root"; 
   $password = ""; 
   $databaseName = "final_project";

try{
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
 
    $selectQuery = "SELECT * FROM customers ORDER BY customer_id";
    $query = $conn->prepare($selectQuery);
    $query->execute();
  
    $result = $query->setFetchMode(PDO::FETCH_ASSOC);

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
        //$htmlOutput .= '<a href="'.$_SERVER["PHP_SELF"].'">'.$value["customer_id"].'</a>';
        $htmlOutput .= '<a href="read-one-record.php?id='.$value["customer_id"].'">'.$value["customer_id"].'</a>';
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
    }

    $htmlOutput .= "</table>"; 
    echo $htmlOutput;
    echo "<br />end of records";
}
    catch(PDOException $e){
      echo "<br />Could not establish database connection.";
    }
  ?>



</body>
</html>