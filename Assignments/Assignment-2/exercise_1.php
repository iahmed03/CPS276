<?php

// Declaration and initialization of variables
$list="<ul>";
$parentListItems=4;
$subListItems=5;

// Logic for creating the required list
for ($parentList=1; $parentList<=$parentListItems; $parentList++){
    $list.="<li> {$parentList} </li>";
    $list.="<ul>";
    for ($subList=1; $subList<=$subListItems; $subList++){
        $list.="<li> {$subList} </li>";
    }
    $list.="</ul>";
}
$list.="</ul>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lists</title>
</head>
<body>
    <ul>
    <?php
    echo $list;
    ?>
    </ul>
</body>
</html>