<?php
require_once 'classes/FileProc.php';
$fileProc = new FileProc();
$arr = $fileProc->init();
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
    <div class="mb-3">
        <h1 style="font-weight: normal" align="center">File Upload and Display</h1>
        <h2 style="font-weight: normal">Upload File</h2>
        <p><?php echo $arr[0];?></p>
    </div>

    <form action="index.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="fileName" class="form-label">File Name:</label>
            <input class="form-control" type="text" class="form-control mb-3" id="fileName" name="fileName">
        </div>
        <div class="mb-3">
            <label for="file_path" class="form-label">Choose File:</label>
            <input class="form-control" type="file" name="file_path" id="file_path">
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-primary" name="uploadFile" value="Upload File">
        </div>
        <div class="mb-3">
                <h2 style="font-weight: normal">Display File List</h2>
            <p><?php echo $arr[1] ?></p>
        </div>
    </form>
</div>



</body>
</html>