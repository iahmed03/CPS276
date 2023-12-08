<?php
require_once 'classes/Pdo_methods.php';
function initDeleteAdmins(){
            if(isset($_POST['delete'])){
            $msg = deleteAdmins();
            return $msg."<br>".getAdmins();
        }
        else {
            return getAdmins();
        }
}

 function tableAdmin($tableData){
    $output = <<<HTML
    <form method='post' action=''>
        <input type='submit' class='btn btn-danger' name='delete' value='Delete'/>
        <br><br>
        <table class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Status</th>
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

 function getAdmins(){

    $records = displayAdmins();
    if(count($records) === 0){
        return "<p>There are no records to display</p>";
    }
    else {
       return tableAdmin(processData($records));
    }

}

function deleteAdmins(){
    if(isset($_POST['chkbx'])){
        $error = false;
        foreach($_POST['chkbx'] as $id){
            $pdo = new PdoMethods();

            $sql = "DELETE FROM Admins WHERE id=:id";
            
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
            return "<p>Could not delete the admin(s)</p>";
        }
        else {
            return "<p>Admin(s) deleted</p>";
        }

    }
    else {
        return "No names selected to delete";
    }
}

function displayAdmins(){
    /* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
$pdo = new PdoMethods();

/* CREATE THE SQL */
$sql = "SELECT * FROM Admins";

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
        <td>{$row['email']}</td>
        <td>{$row['password']}</td>
        <td>{$row['status']}</td>
        <td><input type='checkbox' name='chkbx[]' value='{$row['id']}' /></td></tr>";
    }
    return $tableData;
}

?>