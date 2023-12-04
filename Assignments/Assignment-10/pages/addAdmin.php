<?php

$formw = <<< HTML
<form method="post" action="index.php?page=addAdmin.php">
      <h1>Add Admin</h1>
      <p>Enter a username and password to create a new administrator.</p>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" name="username">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="addAdmin" value="Add Admin" >
            </div>
          </div>
        </div>
</form>

HTML;

return $formw;


?>

