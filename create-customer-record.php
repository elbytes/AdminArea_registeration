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


<?php

  try {

    $servername = "localhost";  
    $username = "root";
    $password = "";
    $dbname = "final_project";
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      

      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";


      // Debug
      define('DEBUG_FIELD_SIZE', 100);
      define('PRODUCTION_FIELD_SIZE', 30);

      
      // set this with one of the above values:
     $fieldSize = DEBUG_FIELD_SIZE;


      $customerId = ""; 
      $customerName = "";
      $customerAddress= "";
      $customerCity = "";
      $customerStatus = "";

      $statusArray = array("0", "1");  

      if(isset($_POST['insert_record'])) {
        $customerName = htmlspecialchars($_POST['customer_name']);
        $customerAddress = htmlspecialchars($_POST['customer_address']);
        $customerCity = htmlspecialchars($_POST['customer_city']);
        $customerStatus = htmlspecialchars($_POST['customer_status']);

        $insertQueryString = "INSERT INTO customers";
        $insertQueryString.= " (customer_name, customer_address, customer_city, customer_status)";
        $insertQueryString.= " VALUES(?,?,?,?)";

        $insertQuery = $conn->prepare($insertQueryString);
        $insertQuery->bindParam(1, $customerName);
        $insertQuery->bindParam(2, $customerAddress);
        $insertQuery->bindParam(3, $customerCity);
        $insertQuery->bindParam(4, $customerStatus);

        $insertQuery->execute();
      }//end isset insert

  ?>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
     

    <table>
      <tr>
        <td>
          <label for="customer_name">Customer Name:</label>
        </td>
        <td>
          <input class="form-control" type="text" name="customer_name" id="customer_name" size="<?php echo $fieldSize; ?>"value="<?php echo $customerName ?>" />
        </td>
      </tr>
      <tr>
        <td>
          <label for="customer_address">Customer Address:</label>
        </td>
        <td>
          <input class="form-control" type="text" name="customer_address" id="customer_address" size="<?php echo $fieldSize; ?>" value="<?php echo $customerAddress ?>" />
        </td>
      </tr>
      <tr>
        <td>
          <label for="customer_city">Customer City:</label>
        </td>
        <td>
          <input class="form-control" type="text" name="customer_city" id="customer_city" size="<?php echo $fieldSize; ?>" value="<?php echo $customerCity ?>" />
        </td>
      </tr> 
      <tr>
        <td>
          <label for="customer_status">Customer Status:</label>
        </td>
        <td>
          <select class="form-control form-control-sm">
            <?php
              foreach($statusArray as $value){
                echo '<option value="'.$value.'">'.$value.'</option>';
              }
              
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input class="btn btn-success" type="submit" name="insert_record" value="Create New Customer Record" />
        </td>
      </tr>
    </table>
</form>

<a href="customers-records.php">Back to records</a>

  <?php
      }
  catch(PDOException $e)
      {
      echo "Connection failed: " . $e->getMessage();
      }
 ?>

</body>
</html>
