<?php

// Declaration and initialization of variables
$table="<table border=\"1\" cellpadding=\"3\" cellspacing=\"2\">";
$numberOfRows=15;
$numberOfColumns=5;

// Logic to build the table
for ($row=1; $row<=$numberOfRows; $row++){
    $table.="<tr>";
    for($column=1; $column<=$numberOfColumns; $column++){
        $table.="<td>Row {$row} cell {$column}</td>";
    }
    $table.="</tr>";
}
$table.="</table>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
</head>
<body>
    <?php
    echo $table;
    ?>

</body>
</html>