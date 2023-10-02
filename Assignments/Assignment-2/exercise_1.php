<?php

// Declaration and initialization of variables
$list="<ul>";
$parentList=4;
$subList=5;

// Logic for creating the required list
for ($parentListItem=1; $parentListItem<=$parentList; $parentListItem++){
    $list.="<li> {$parentListItem} </li>";
    $list.="<ul>";
    for ($subListItem=1; $subListItem<=$subList; $subListItem++){
        $list.="<li> {$subListItem} </li>";
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