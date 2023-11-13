<?php
    require_once "../classes/Pdo_methods.php"; 

    // CREATE AN INSTANCE OF THE PDOMETHODS CLASS
    $pdo = new PdoMethods();

    // CREATE THE SQL
    $sql = "TRUNCATE TABLE names";

    //PROCESS THE SQL AND GET THE RESULTS
    $records = $pdo->selectNotBinded($sql);

    // IF THERE WAS AN ERROR DISPLAY MESSAGE
    if($records == 'error'){
        $response = (object) [
            'masterstatus' => 'error',
            'msg' => 'Could not add name',
          ];
        echo json_encode($response);
    }
    else {
        $response = (object) [
            'masterstatus' => 'success',
            'msg' => "database cleared",
          ];
          echo json_encode($response);
    }
?>