<?php
require_once '../classes/Crud.php';
function initDeleteAdmins(){
    $crud = new Crud();
            if(isset($_POST['delete'])){
            $msg = $crud->deleteAdmins();
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

    $crud = new Crud();
    $records = $crud->getTableData("Admins");
    if(count($records) === 0){
        return "<p>There are no records to display</p>";
    }
    else {
       return tableAdmin($crud->createTableData1($records));
    }

}

?>