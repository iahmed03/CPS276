<?php

//  DEECLARATION OF THE VARIABLE
$output="";
$filePath="";

// LOGIC TO EXECUTE IF SOME VALUE IS PASSED ON TO SERVER VIA POST METHOD(TO INSTRUCT Directories CLASS TO CREATE DIRECTORES AND FILES).
if(count($_POST) > 0){
    require_once 'Directories.php';
    $addDir = new Directories($_POST["folderName"], $_POST["fileContent"]);
    $output = $addDir->createDirectory();
    if ($addDir->getFilePath()!=""){
        $filePath="<a href=\"{$addDir->getFilePath()}\"> Path were file is located</a>";
    }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <title>Files and Directory</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1>Files and Directory Assignment</h1>
            <p>Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters</p>
            <p><?php echo $output?></p>
            <p><?php echo $filePath ?></p>
        </div>
    </div>
    <form action="form.php" method="post">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <label for="folderName" class="form-label">Folder Name</label>
                <input type="text" class="form-control mb-3" id="folderName" name="folderName" placeholder="Enter Name">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <label for="fileContent" class="form-label">File Content</label>
                <textarea style="height: 400px;" class="form-control mb-3" 
                    id="fileContent" name="fileContent"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <button type="submit" class="btn btn-primary" name="submitForm">Submit</button>
            </div>
        </div>
    </form>
</div>



</body>
</html>