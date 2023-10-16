<?php

//  DEECLARATION OF THE VARIABLE
$output="";

// LOGIC TO EXECUTE IF SOME VALUE IS PASSED ON TO SERVER VIA POST METHOD.
if(count($_POST) > 0){
    require_once 'AddName.php';
    $addName = new AddName();
    $output = $addName->display_name_list($_POST);
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <title>Names</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1>Add Names</h1>
        </div>
    </div>
    <form action="Names.php" method="post">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <button type="submit" class="btn btn-primary" name="addName">Add name</button>
                <button type="submit" class="btn btn-primary" name="clearName">Clear names</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <label for="name" class="form-label">Enter Name</label>
                <input type="text" class="form-control mb-3" id="name" name="name" placeholder="Enter Name">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <label for="nameList" class="form-label">List of names</label>
                <textarea style="height: 400px;" class="form-control mb-3" 
                    id="nameList" name="namelist"><?php echo $output ?></textarea>
            </div>
        </div>
    </form>
</div>



</body>
</html>