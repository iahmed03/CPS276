<?php
$rows=15;
$columns=5;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
    <?php
    for ($i=1; $i<=$rows; $i++){
        echo "<tr>";
        for ($j=1; $j<=$columns; $j++){
            echo "<td> Row {$i} Cell {$j} </td>"; 
        }
        echo "<tr>";
    }
    ?>
    </table>
</body>
</html>