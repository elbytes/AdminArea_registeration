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
  </style>

  <title>PHP</title>
  <meta charset="utf-8">

</head>

<body>

  <h2>database connection</h2>

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

    foreach($query->fetchAll() as $value){
        $htmlOutput .= "/n<tr>";

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


  <form action="?firstName=Default" method="POST">

    Text: <input type="text" name="firstName" value="" />
    <br />
    Password: <input type="password" name="password" value="" />
    <br />
    <input type="submit" name="submit" value="Submit:">
    <br />
    <label for="checkboxExample">Label for checkbox</label>
    <input type="checkbox" name="checkboxExample" id="checkboxExample" checked="checked" value="isActiveDutyMilitary">
    <br />
    

  </form>

</body>
</html>