<?php
require_once '../classes/Crud.php';
function initDeleteContacts(){
    $crud = new Crud();
            if(isset($_POST['delete'])){
            $msg = $crud->deleteContacts();
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

    $crud = new Crud();
    $records = $crud->getTableData("Contacts");
    if(count($records) === 0){
        return "<p>There are no records to display</p>";
    }
    else {
       return table($crud->createTableData($records));
    }

}

?>