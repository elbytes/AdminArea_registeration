<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
    <table>
      <tr>
        <td>
          <label for="new_username">Username:</label>
        </td>
        <td>
          <input class="form-control" type="text" name="table_username" id="table_username" size="<?php echo $fieldSize; ?>" />
        </td>
      </tr>
      <tr>
        <td>
          <label for="password">Password:</label>
        </td>
        <td>
          <input class="form-control" type="password" name="password" id="password" size="<?php echo $fieldSize; ?>" v/>
        </td>
      </tr>
      <tr>
        <td>
          <label for="confirmed_password">Confirm Password:</label>
        </td>
        <td>
          <input class="form-control" type="password" name="confirmed_password" id="confirmed_password" size="<?php echo $fieldSize; ?>" />
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" class="btn btn-success" name="create_new_user" value="Create New User" style="margin: 1em;"/>
        </td>
      </tr>
    </table>
  </form>