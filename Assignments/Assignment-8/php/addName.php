<?php
    require_once "../classes/Pdo_methods.php";

    $data = $_POST["data"];
    
    if(!$data){
        $response = (object) [
            'masterstatus' => 'error',
            'msg' => 'Could not add name',
          ];
        echo json_encode($response);
    
        /* BECAUSE WE DON'T WANT TO GO ANY FURTHER WITH THIS OPERATION TERMINATE IT HERE */
        exit;
    }
    
    $data = json_decode($data);


    // FUNCTION THAT FORMATS THE NAME SUCH THAT LASTNAME IS WRITTEN BEFORE FIRSTNMAE
    $arrName = explode(" ", $data->name);
    $name_to_be_added = $arrName[1].", ".$arrName[0]."\n";

    $pdo = new PdoMethods();

	// HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS
	$sql = "INSERT INTO names (name) VALUES (:name_to_be_added)";
 
	// THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS
	$bindings = [
		[':name_to_be_added',$name_to_be_added,'str']
	];

	// I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS
	$result = $pdo->otherBinded($sql, $bindings);

	/* HERE I AM RETURNING EITHER AN ERROR STRING OR A SUCCESS STRING */
	if($result === 'error'){
		echo 'There was an error adding the name';
	}
	else {
		$response = (object) [
            'masterstatus' => 'success',
            'msg' => "name added",
          ];
          echo json_encode($response);
	}
?>