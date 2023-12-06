<?php
require 'Pdo_methods.php';

class Crud extends PdoMethods{


	//THIS HAS TO BE PUBLIC BECAUSE INDEX.PHP AND UPDATE_DELETE_NAMES.PHP BOTH CALL IT DIRECTLY
	public function getTableData($table){
		
		/* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
		$pdo = new PdoMethods();

		/* CREATE THE SQL */
		$sql = "SELECT * FROM {$table}";

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


	/***** THE REST OF THESE METHODS CAN BE PRIVATE BECAUSE THEY ARE CALLED WITHIN THE CLASS. */


    public function addAdmin(){
        $pdo = new PdoMethods();
        $sql = "INSERT INTO Admins (name, email, password, status) VALUES (:name, :email, :password, :status)";

        $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
        /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
	    $bindings = [
            [':name',$_POST['name'],'str'],
            [':email',$_POST['email'],'str'],
            [':password',$hashedPassword,'str'],
            [':status',$_POST['status'],'str']
          ];

        $result = $pdo->otherBinded($sql, $bindings);

        /* HERE I AM RETURNING EITHER AN ERROR STRING OR A SUCCESS STRING */
        if($result === 'error'){
            return 'error';
        }
        else {
            return '';
        }
    }

	public function addContacts(){
	
		$pdo = new PdoMethods();
    
		/* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
		$sql = "INSERT INTO Contacts (name, address, city, state, phone, email, dob, contacts, age) VALUES (:name, :address, :city, :state, :phone, :email, :dob, :contacts, :age)";
		
        if(isset($_POST['contacts'])){
            $contacts = "";
            foreach($_POST['contacts'] as $v){
              $contacts .= $v.",";
            }
            /* REMOVE THE LAST COMMA FROM THE CONTACTS */
            $contacts = substr($contacts, 0, -1);
          }
          else {
            $contacts = "";
          }
    
          if(isset($_POST['age'])){
            $age = $_POST['age'];
          }
          else {
            $age = "";
          }

	    /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
	    $bindings = [
            [':name',$_POST['name'],'str'],
            [':address',$_POST['address'],'str'],
            [':city',$_POST['city'],'str'],
            [':state',$_POST['state'],'str'],
            [':phone',$_POST['phone'],'str'],
            [':email',$_POST['email'],'str'],
            [':dob',$_POST['dob'],'str'],
            [':contacts',$contacts,'str'],
            [':age',$age,'str']
          ];

		/* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
		$result = $pdo->otherBinded($sql, $bindings);

		/* HERE I AM RETURNING EITHER AN ERROR STRING OR A SUCCESS STRING */
		if($result === 'error'){
			return 'error';
		}
		else {
			return '';
		}
	}

	public function updateNames($post){
		$error = false;

		if(isset($post['inputDeleteChk'])){

			foreach($post['inputDeleteChk'] as $id){
				$pdo = new PdoMethods();

				/* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
				$sql = "UPDATE short_names SET first_name = :fname, last_name = :lname, eye_color = :eyecolor, state = :state WHERE id = :id";

				//THE ^^ WAS USED TO MAKE EACH ITEM UNIQUE BY COMBINING FNAME WITH THE ID
				$bindings = [
					[':fname', $post["fname^^{$id}"], 'str'],
					[':lname', $post["lname^^{$id}"], 'str'],
					[':eyecolor', $post["color^^{$id}"], 'str'],
					[':state', $post["state^^{$id}"], 'str'],
					[':id', $id, 'str']
				];

				$result = $pdo->otherBinded($sql, $bindings);

				if($result === 'error'){
					$error = true;
					break;
				}
				
			}

			if($error){
				return "There was an error in updating a name or names";
			}
			else {
				return "All names updated";
			}
		}
		else {
			return "No names selected to update";
		}
	}

	public function deleteContacts(){
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

    public function deleteAdmins(){
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

	/*THIS FUNCTION TAKES THE DATA FROM THE DATABASE AND RETURN AN UNORDERED LIST OF THE DATA*/
	public function createTableData($records){
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

    public function createTableData1($records){
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
}