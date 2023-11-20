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
    <title>Display Note </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      #msg {
        margin: 10px 0 0 0;
      }
    </style>
  </head>
  <body>
    <form action="displayNote.php" method="post">
        <div class="container">
            <h1>Display Notes</h1>
            <a href="./addNote.php"> Add Note</a>
            <div class="mb-3">
                <label for="begDate" class="form-label">Beginning Date</label>
                <input type="date" class="form-control" id="begDate" name="begDate">
            </div>
            <div class="mb-3">
                <label for="endDate" class="form-label">Ending Date</label>
                <input type="date" class="form-control" id="endDate" name="endDate">
            </div>
                <input type="submit" id="getNotes" name="getNotes" class="btn btn-primary" value="Get Notes">
                <div>
                    <p><?php echo $notes ?></p>
                </div>
            </div>
        </div>
    </form>
  </body>
</html>