<?php

require_once "PdoMethods.php";

class FileProc extends PdoMethods{


    private $output;

    public function fileUpload(){
        
        global $output;
        $output=$this->processFile();
        return $output;

    }
    
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
    
        //CHECK TO MAKE SURE IT IS THE CORRECT FILE TYPE IN THIS CASE JPEG OR PNG
        elseif ($_FILES["file_path"]["type"] != "application/pdf") {
            $output= "pdf files only";
        }
    
        //IF ALL GOES WELL MOVE FILE FROM TEMP LCOATION TO THE PHOTOS DIRECTORY 
        elseif (!move_uploaded_file( $_FILES["file_path"]["tmp_name"], "files/" . $_FILES["file_path"]["name"])){
            $output= "Could not move file";
        }
        else {
            //IF ALL GOES WELL CALL DISPLAY THANKS METHOD	
            $output=$this->addFile();
        } 
        
        return $output;
    }

    public function displayList(){
		
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

    private function addFile(){
	
		$pdo = new PdoMethods();

		// HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS
		$sql = "INSERT INTO file_info (fileName, file_path) VALUES (:fileName, :file_path)";

			 
	    // THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS
	    $bindings = [
			[':fileName',$_POST['fileName'],'str'],
			[':file_path',"files/" . $_FILES["file_path"]["name"],'str'],
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

    public function init(){
        if(count($_POST) > 0){
            return [$this->fileUpload(), $this->displayList()];
        }
        else {
             return "ok";
        } 
    } 

    private function createList($records){
		$list = '<ol>';
		foreach ($records as $row){
			$list .= "<li><a target='_blank' href={$row['file_path']}>{$row['fileName']}</a></li>";
		}
		$list .= '</ol>';
		return $list;
	}

}

