<?php

    require_once "../classes/Pdo_methods.php";

	// CREATE AN INSTANCE OF THE PDOMETHODS CLASS
    $pdo = new PdoMethods();

    // CREATE THE SQL
    $sql = "SELECT * FROM names ORDER BY name";

    //PROCESS THE SQL AND GET THE RESULTS
    $records = $pdo->selectNotBinded($sql);

    // IF THERE WAS AN ERROR DISPLAY MESSAGE
    if($records == 'error'){
        $response = (object) [
            'masterstatus' => 'error',
            'msg' => 'There has been an error while displaying the names',
          ];
        echo json_encode($response);
    
        /* BECAUSE WE DON'T WANT TO GO ANY FURTHER WITH THIS OPERATION TERMINATE IT HERE */
        exit;
    }
    else {
            $list = "";
            foreach ($records as $row){
                $list .= "<p>{$row['name']}</p>";
            }
            $response = (object) [
                'masterstatus' => 'success',
                'names' => $list,
              ];
              echo json_encode($response);
    }
?>