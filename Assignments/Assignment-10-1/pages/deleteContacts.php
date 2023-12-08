<?php
require_once 'classes/Pdo_methods.php';
function initDeleteContacts(){
            if(isset($_POST['delete'])){
            $msg = deleteContacts();
            return $msg."<br>".getContacts();
        }
        else {
            return getContacts();
        }
}

 function table($tableData){
    $output = <<<HTML
    <form method='post' action=''>
        <input type='submit' class='btn btn-danger' name='delete' value='Delete'/>
        <br><br>
        <table class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Phone</th>
                    <th>Email Address</th>
                    <th>DOB</th>
                    <th>Contacts</th>
                    <th>Age</th>
                </tr>
            </thead>
            <tbody>
               {$tableData}
            </tbody>
        </table>
    </form>
HTML;

    return $output;
}

 function getContacts(){

    $records = displayContacts();
    if(count($records) === 0){
        return "<p>There are no records to display</p>";
    }
    else {
       return table(processData($records));
    }

}

function deleteContacts(){
    if(isset($_POST['chkbx'])){
        $error = false;
        foreach($_POST['chkbx'] as $id){
            $pdo = new PdoMethods();

            $sql = "DELETE FROM Contacts WHERE id=:id";
            
            $bindings = [
                [':id', $id, 'int'],
            ];

            $result = $pdo->otherBinded($sql, $bindings);

            if($result === 'error'){
                $error = true;
                break;
            }
        }
        if($error){
            return "<p>Could not delete the contact(s)</p>";
        }
        else {
            return "<p>Contact(s) deleted</p>";
        }

    }
    else {
        return "No names selected to delete";
    }
}

function displayContacts(){
    		/* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
		$pdo = new PdoMethods();

		/* CREATE THE SQL */
		$sql = "SELECT * FROM Contacts";

		//PROCESS THE SQL AND GET THE RESULTS
		$records = $pdo->selectNotBinded($sql);

		/* IF THERE WAS AN ERROR DISPLAY MESSAGE */
		if($records == 'error'){
			return 'There has been and error processing your request';
		}
        else {
            return $records;
        }
}

function processData($records){
    $tableData="";
    foreach($records as $row){
       $tableData.= "<tr><td>{$row['name']}</td>
        <td>{$row['address']}</td>
        <td>{$row['city']}</td>
        <td>{$row['state']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['email']}</td>
        <td>{$row['dob']}</td>
        <td>{$row['contacts']}</td>
        <td>{$row['age']}</td>
        <td><input type='checkbox' name='chkbx[]' value='{$row['id']}' /></td></tr>";
    }
    return $tableData;
}

?>