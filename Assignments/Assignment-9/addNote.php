<?php
require_once 'classes/Date_time.php';
$dt = new Date_time();
$notes = $dt->checkSubmit();
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Note </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      #msg {
        margin: 10px 0 0 0;
      }
    </style>
  </head>
  <body>
    <form action="addNote.php" method="post">
        <div class="container">
            <h1>Add Note</h1>
            <a href="./displayNote.php"> Display Notes </a>
            <p><?php echo $notes ?></p>
            <div class="mb-3">
                <label for="dataTime" class="form-label">Date and Time</label>
                <input type="datetime-local" class="form-control" id="dataTime" name="dateTime">
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <textarea style="height: 400px;" class="form-control mb-3" id="note" name="note"></textarea>
            </div>
                <input type="submit" id="addNote" name="addNote" class="btn btn-primary" value="Add Note">
            </div>
        </div>
    </form>
  </body>
</html>