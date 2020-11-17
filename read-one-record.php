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
      background-color: #282828 ;
      color: #E8E8E8;
    }

    .form-control{
        margin: 1em;
    }
  </style>

  <title>PHP</title>
  <meta charset="utf-8">

</head>

<body>

  <h2>Read one record / Edit / Delete</h2>

  <?php

   $customerId = ""; 
   $customerName = "";
   $customerAddress= "";
   $customerCity = "";
   $customerStatus = "";

   $serverName = "localhost"; 
   $userName = "root"; 
   $password = ""; 
   $databaseName = "final_project";

try{
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
   
    //update one records
    if(isset($_POST["updateRecord"])){
        $customerName = htmlspecialchars($_POST["customer_name"]);
        $customerAddress = htmlspecialchars($_POST["customer_address"]);
        $customerCity =htmlspecialchars($_POST["customer_city"]);
        $customerStatus = htmlspecialchars($_POST["customer_status"]);
        $customerId = htmlspecialchars($_POST["customer_id"]);

        $updateQueryString = "UPDATE customers SET customer_name = ?, customer_address = ?, customer_city= ?, customer_status=?";
        $updateQueryString.= " WHERE customer_id = ?";
        $updateQuery = $conn->prepare($updateQueryString);
        $updateQuery->bindParam(1, $customerName);
        $updateQuery->bindParam(2, $customerAddress);
        $updateQuery->bindParam(3, $customerCity);
        $updateQuery->bindParam(4, $customerStatus);
        $updateQuery->bindParam(5,$customerId);
        $updateQuery->execute();

        //echo "debug: $updateQuery";
    }     // end isset updateRecord
    else{
        $customerId = htmlspecialchars($_GET['id']);
    }
    
    //delete one records
    if(isset($_POST["deleteRecord"])){

    } // end isset deleteRecord


    // echo "<br />";
    // var_dump($conn);
    $selectQuery = "SELECT * FROM customers WHERE customer_id = " .$customerId;
    echo $selectQuery;

    $query = $conn->prepare($selectQuery);
    $query->execute();
  
    $result = $query->setFetchMode(PDO::FETCH_ASSOC);

    $htmlOutput = '<table class="table table-dark">'; 
    $htmlOutput .= '<thead class="thead-dark">';
    $htmlOutput .= "<tr>"; 
    $htmlOutput .= '<th scope="col">Customer ID</th>';
    $htmlOutput .= '<th scope="col">Customer Name</th>';
    $htmlOutput .= '<th scope="col">Address</th>';
    $htmlOutput .= '<th scope="col">City</th>';
    $htmlOutput .= '<th scope="col">Status</th>';
    $htmlOutput .= "</tr>";
    $htmlOutput .= '</thead>';

    $customers = $query->fetch();

    if(!empty($customers)){
        echo "<br />record found";
    }

    $htmlOutput .= "</table>"; 
    echo $htmlOutput;
    echo "<br />end of one record";

 
    $customerName = $customers["customer_name"];
    $customerAddress = $customers["customer_address"];
    $customerCity = $customers["customer_city"];
    $customerStatus = $customers["customer_status"];
 ?>
    <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
<div class="form-group">
    
    <input type="hidden" class="form-control" name="customer_id" value="<?php echo htmlspecialchars($customerId); ?>" />

    <label for="customer__name">Customer Name:</label>
    <input type="text" id="customer__name" class="form-control" name="customer_name" value="<?php echo $customerName ?>" />
</div>
  <div class="form-group">
    <label for="customer__address">Customer Address:</label>
    <input type="text" id="customer__address" class="form-control" name="customer_address" value="<?php echo $customerAddress ?>" />
    </div>
  <div class="form-group">
    <label for="customer__city">Customer City:</label>
    <input type="text" id="customer__city" class="form-control" name="customer_city" value="<?php echo $customerCity ?>" />
    </div>
  <div class="form-group">
    <label for="customer__status">Customer Status:</label>
    <input type="text"  id="customer__status" name="customer_status" value="<?php echo $customerStatus ?>" />
    </div>
    <input type="submit" class="btn btn-primary" name="updateRecord" value="Update Record">
    <br />
    <input type="submit" class="btn btn-danger" name="deleteRecord" value="Delete Record">
    <br />
    </form>
    

    <?php

    
    }
    catch(PDOException $e){
      echo "<br />Could not establish database connection.";
    }

  ?>


  

</body>
</html>