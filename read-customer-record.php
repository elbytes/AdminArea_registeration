<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="styles.css">


  <title>One Customer Record</title>
  <meta charset="utf-8">

</head>

<body>
<?php require("navbar.html"); ?>
  <h2>Read one record / Edit / Delete</h2>

  <?php
   session_start();
   $customerId = ""; 
   $customerName = "";
   $customerAddress= "";
   $customerCity = "";
   $customerStatus = "";

   $statusArray = array("0", "1");  

   $serverName = "localhost"; 
   $userName = "root"; 
   $password = ""; 
   $databaseName = "final_project";

try{
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if(isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === true){
      echo '<div class="container-fluid">';
      echo '<div class="row">';
      echo '<div class="col-sm-8"><h4>Hello, '.$_SESSION["username"] .'</h4>';
      echo '</div>';
      echo '<div class="col-sm-4"><a href="user-logout.php" type="button" class="btn btn-info" style="float: right;">Logout</a>';
      echo '</div>';
      echo '</div></div>';

      //read one record
      $customerId = htmlspecialchars($_GET['id']);
      $selectQueryString = "SELECT * FROM customers WHERE customer_id = ?";
      $selectQuery = $conn->prepare($selectQueryString);
      $selectQuery->bindParam(1, $customerId);
      $selectQuery->execute();

      $result = $selectQuery->setFetchMode(PDO::FETCH_ASSOC);
      $customers = $selectQuery->fetch();
      if(!empty($customers)){
        $customerName = $customers["customer_name"];
        $customerAddress = $customers["customer_address"];
        $customerCity = $customers["customer_city"];
        $customerStatus = $customers["customer_status"];
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
     <table>
       <tr>
         <td>
           <input type="hidden" name="customer_id" value="">           
         </td>
       </tr>
       <tr class="d-flex">
         <td class="col-5">
           <label for="customer_name">Customer Name:</label>
         </td>
         <td class="col-8">
           <input class="form-control" type="text" name="customer_name" id="customer_name" size="<?php echo $fieldSize; ?>"value="<?php echo $customerName ?>" />
         </td>
       </tr>
       <tr class="d-flex">
         <td class="col-5">
           <label for="customer_address">Customer Address:</label>
         </td>
         <td class="col-8">
           <input class="form-control" type="text" name="customer_address" id="customer_address" size="<?php echo $fieldSize; ?>" value="<?php echo $customerAddress ?>" />
         </td>
       </tr>
       <tr class="d-flex">
         <td class="col-5">
           <label for="customer_city">Customer City:</label>
         </td>
         <td class="col-8">
           <input class="form-control" type="text" name="customer_city" id="customer_city" size="<?php echo $fieldSize; ?>" value="<?php echo $customerCity ?>" />
         </td class="col-1">
       </tr> 
       <tr class="d-flex">
         <td class="col-5">
           <label for="customer_status">Customer Status:</label>
         </td>
         <td class="col-3">
           <select class="form-control form-control-sm" name="customer_status" id="customer_status">
             <?php
               foreach($statusArray as $value){
                 echo '<option value="'.$value.'">'.$value.'</option>';
               }
             ?>
           </select>
         </td>
       </tr>
     </table>
 </form>
        <?php
      }//end if !empty


    //update one records
    if(isset($_POST["updateRecord"])){
      $customerName = $_POST["customer_name"];
      $customerName = $_POST["customer_address"];
      $customerCity = $_POST["customer_city"];
      $customerStatus = $_POST["customer_status"];
      $customerId = $_POST['customer_id'];

      echo "page accessed from POST updateRecord button";
        $updateQueryString = "UPDATE customers SET customer_name = ?, customer_address = ?, customer_city= ?, customer_status=?";
        $updateQueryString.= " WHERE customer_id = ?";
        $updateQuery = $conn->prepare($updateQueryString);
        $updateQuery->bindParam(1, $customerName);
        $updateQuery->bindParam(2, $customerAddress);
        $updateQuery->bindParam(3, $customerCity);
        $updateQuery->bindParam(4, $customerStatus);
        $updateQuery->bindParam(5,$customerId);
        $updateQuery->execute();
    }     
     else{
         $customerId = htmlspecialchars($_GET['id']);
     }// end isset updateRecord
    
    //delete one records
    if(isset($_POST["deleteRecord"])){
        $customerId = htmlspecialchars($_POST["customer_id"]);
         
        $deleteQueryString = "DELETE FROM customers WHERE";
        $deleteQueryString.= " customer_id= ?";
        $deleteQuery = $conn->prepare($deleteQueryString);
        $deleteQuery->bindParam(1, $customerId);
        $deleteQuery->execute();
    } 
     else{
        $customerId = htmlspecialchars($_GET['id']);
     }// end isset deleteRecord


    if(isset($_GET["id"])){
      //debug:
      echo 'page accessed from GET hyperlink';
      
   
    }
 ?>
      
  <a href="customers-records.php" type="button" class="btn btn-primary" style="float: right; margin: 1em;">Back To Records</a>
  <input class="btn btn-success" type="submit" name="updateRecord" value="Update Customer Record" style="margin: 1em;"/>
  <input type="submit" class="btn btn-danger" name="deleteRecord" value="Delete Record" style="margin: 1em;">

    <?php

  }//end if for SESSION
  else{
    echo "<br />Please login first!<br />";
    echo '<br /><a href="user-login.php" type="button" class="btn btn-primary" >Login</a>';
  }
}//end try
catch(PDOException $e){
  echo "<br />Could not establish database connection.";
}
?>

</body>
</html>