<?php

require_once "PdoMethods.php";

class FileProc extends PdoMethods{

    // DECLARATION OF VARIABLE USED FOR STORING VARIOUS ERROR MESSAGES.
    private $output;

    // PRIMARY FUNCTION THAT IS CALLED FROM INNIT FUNCTION THAT STARTS THE PROCESSING FOR THE FILE AND RETURNS APPROPRIATE ERROR MESSAGE OR NO MESSAGE IF THE FILE UPLOAD PROCESS WAS SUCCESSFULL TO DATABASE
    private function fileUpload(){
        
        global $output;
        $this->processFile();
        return $output;

    }
    
    // FUNCTION THAT PROCESSES THE FILE FOR VARIOUS ERROR MESSAGES
    private function processFile(){
	
        global $output;
        if($_POST["fileName"]==null){
            $output="No file name was entered";
        }
        
        //CHECK TO SEE IF A FILE WAS UPLOADED.  ERROR EQUALS 4 MEANS THERE WAS NO FILE UPLOADED
        elseif ($_FILES["file_path"]["error"] == 4){
            $output= "No file was uploaded. Make sure you choose a file to upload.";
        }
    
        //MAKE SURE THE FILE SIZE IS LESS THAN 100000 BYTES.  
        elseif($_FILES["file_path"]["size"] > 100000){
            $output= "The file is too large";
        }
    
        //CHECK TO MAKE SURE IT IS THE CORRECT FILE TYPE IN THIS CASE PDF
        elseif ($_FILES["file_path"]["type"] != "application/pdf") {
            $output= "pdf files only";
        }
    
        //IF ALL GOES WELL MOVE FILE FROM TEMP LCOATION TO THE 'Files' DIRECTORY 
        elseif (!move_uploaded_file( $_FILES["file_path"]["tmp_name"], "files/" . $_POST["fileName"])){
            $output= "Could not move file";
        }

        // IF ALL GOES WELL ADDFILE FUNCTION IS CALLED WHICH ADD FILENAME AND FILEPATH TO THE DATABASE
        else {
            if (!$this->checkRecord()){
                $output=$this->addFile();
            }
            else{
                $output="File has been added";
            }
        } 
        
    }

    // FUNCTION THAT RETRIVES THE INFO FROM THE DATABASE AND DISPLAYS IN IN THE FORM OF LIST
    private function displayList(){
		
		// CREATE AN INSTANCE OF THE PDOMETHODS CLASS
		$pdo = new PdoMethods();

		// CREATE THE SQL
		$sql = "SELECT * FROM file_info";

		//PROCESS THE SQL AND GET THE RESULTS
		$records = $pdo->selectNotBinded($sql);

		// IF THERE WAS AN ERROR DISPLAY MESSAGE
		if($records == 'error'){
			return 'There has been and error while retriving file info';
		}
		else {
			if(count($records) != 0){
                    return $this->createList($records);
			}
			else {
				return 'There are no files to display';
			}
		}
	}

    // FUNCTION THAT ADD FILE TO THE DATABASE
    private function addFile(){
	
		$pdo = new PdoMethods();

		// HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS
		$sql = "INSERT INTO file_info (fileName, file_path) VALUES (:fileName, :file_path)";

			 
	    // THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS
	    $bindings = [
			[':fileName',$_POST['fileName'],'str'],
			[':file_path',"files/" . $_POST["fileName"],'str'],
		];

		// I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS
		$result = $pdo->otherBinded($sql, $bindings);

		/* HERE I AM RETURNING EITHER AN ERROR STRING OR A SUCCESS STRING */
		if($result === 'error'){
			return 'There was an error adding the record';
		}
		else {
			return 'File has been added';
		}
	}

    // FUNCTION THAT MARKS THE START OF THE WEBPAGE(LOADING AND ON SUBMITTING PAGE)
    public function init(){
        if(count($_POST) > 0){
            return [$this->fileUpload(), $this->displayList()];
        }
        else {
            return ["", $this->displayList()];
        } 
    } 

    // FUNCTION THAT ITERATES THROUGHT THE LIST OF RECORDS RETRIEVED FROM THE DATABASE.
    private function createList($records){
		$list = '<ol>';
		foreach ($records as $row){
			$list .= "<li><a target='_blank' href={$row['file_path']}>{$row['fileName']}</a></li>";
		}
		$list .= '</ol>';
		return $list;
	}

    // FUNCTION TO PREVENT DUPLICATE ENTRIES OF FILE INTO THE DATABASE.
    private function checkRecord(){
        // CREATE AN INSTANCE OF THE PDOMETHODS CLASS
		$pdo = new PdoMethods();

		// CREATE THE SQL
		$sql = "SELECT * FROM file_info";

		//PROCESS THE SQL AND GET THE RESULTS
		$records = $pdo->selectNotBinded($sql);

		// IF THERE WAS AN ERROR DISPLAY MESSAGE
		if($records == 'error'){
			return 'There has been and error while retriving file info';
		}
		else {
            if(count($records) != 0){
                foreach ($records as $row){
                    if ($row['fileName']==$_POST["fileName"]){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
        }
        }

    }
}

