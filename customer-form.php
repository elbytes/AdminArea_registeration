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
          <select class="form-control form-control-sm" name="customer_status" id="customer_status">
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