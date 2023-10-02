<?php
$listItems=4;
$nestedListItems=5;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
    <?php
    for ($i=1; $i<= $listItems; $i++){
        echo "<li> {$i} </li>";
        echo "<ul>";
        for ($j=1; $j<=$nestedListItems; $j++){
            echo "<li> {$j} </li>";
        }
        echo "</ul>";
    }
    ?>
    </ul>
</body>
</html>