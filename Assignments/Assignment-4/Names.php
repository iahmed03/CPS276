<?php
$output="";
if(count($_POST) > 0){
    require_once 'AddName.php';
    $addName = new AddName();
    echo $addName->display_name_list();
    if (isset($_POST["addName"])){
        $addName->add_name($_POST["name"], $_POST["namelist"]);
    }
    else if(isset($_POST["clearName"])){
        $addName->clear_names();
    }
    $output = $addName->display_name_list();
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
    <h1>Add Names</h1>
    <form action="Names.php" method="post">
        <div class="col-12">
            <button type="submit" class="btn btn-primary" name="addName">Add name</button>
            <button type="submit" class="btn btn-primary" name="clearName">Clear names</button>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Enter Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
        </div>
        <div class="mb-3">
             <label for="nameList" class="form-label">List of names</label>
             <textarea style="height: 500px;" class="form-control" 
             id="nameList" name="namelist"><?php echo $output ?></textarea>

        </div>    
    </form>
</div>
</body>
</html>