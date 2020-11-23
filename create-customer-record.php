<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

  <title>Create New Customer</title>
  <meta charset="utf-8">

</head>

<body>
<?php require("navbar.html"); ?>

<?php
session_start();
$servername = "localhost";  
$username = "root";
$password = "";
$dbname = "final_project";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if($_SESSION["authenticated"] === true){
      echo '<div class="container-fluid">';
      echo '<div class="row">';
      echo '<div class="col-sm-8"><h4>Hello, '.$_SESSION["username"] .'</h4>';
      echo '</div>';
      echo '<div class="col-sm-4"><a href="user-logout.php" type="button" class="btn btn-info" style="float: right;">Logout</a>';
      echo '</div>';
      echo '<br /><p>You can create a new user here</p>';
      echo '</div></div>';
      
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
      require("customer-form.php");
      echo '<table><tr>
      <td colspan="2">
        <input class="btn btn-success" type="submit" name="insert_record" value="Create New Customer Record" style="margin: 1em;"/>
      </td>
    </tr></table>';
    }
    else{
      echo "<br />Please login first!";
      echo '<br /><a href="user-login.php" type="button" class="btn btn-primary" >Login</a>';
    }
    ?>
 <a href="user-landing.php" type="button" class="btn btn-primary" style="float: right;">Back</a>

  <?php
  }
  catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
  }
 ?>

</body>
</html>
