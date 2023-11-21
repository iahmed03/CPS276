<?php

require_once "Pdo_methods.php";

Class Date_time {

    // Function to upload date to database.
    private function uploadData($dateTime, $note){
        $pdo = new PdoMethods();
		$sql = "INSERT INTO date_table (dateTime, note) VALUES (:dateTime, :note)"; 
	    $bindings = [
			[':dateTime',strtotime($dateTime),'str'],
			[':note',$note,'str'],
		];

		$result = $pdo->otherBinded($sql, $bindings);

        // Checking if there was an error while uploading data to database.
		if($result === 'error'){
			return 'There was a problem adding the note';
		}
		else {
			return 'Note has been added';
		}
	}

    // Function to retrive data from the database.
    private function getData($begDate, $endDate){
        $pdo = new PdoMethods();
		$sql = "SELECT dateTime, note FROM date_table WHERE dateTime BETWEEN :begDate AND :endDate ORDER BY dateTime DESC"; 
	    $bindings = [
			[':begDate',strtotime($begDate),'str'],
			[':endDate',strtotime($endDate),'str'],
		];

		$result = $pdo->selectBinded($sql, $bindings);

        // Checking if there was an error while uploading data to database.
		if($result === 'error'){
			return 'There was a problem retriveing the data';
		}
		else {
            if (count($result)!=0){
                return $this->processData($result);
            }
            else {
                return "No notes found for the date range selected.";
            }
		}
    }

    // Function that process the data record retrived from the database
    private function processData($result){
        $output="<table class='table table-striped table-bordered'><tr><th>Date and Time</th><th>Note</th></tr>";
        foreach($result as $row){
            $date=date('m/d/Y g:i a',$row["dateTime"]);
            $output.="<tr><td>{$date}</td><td>{$row['note']}</td></tr>";
        }
        $output.="</table>";
        return $output;
    }

    // Inital function which is called from the view page.
    public function checkSubmit(){
        if(count($_POST) > 0){
            if (isset($_POST["addNote"])){
                if ($_POST["dateTime"]!=null && $_POST["note"]!=null){
                    return $this->uploadData($_POST["dateTime"], $_POST["note"]);
                }
                else{
                    return "Enter a date, time and note";
                }
            }
            elseif(isset($_POST["getNotes"])){
                if ($_POST["begDate"]!=null && $_POST["endDate"]!=null){
                    return $this->getData($_POST["begDate"], $_POST["endDate"]);
                }
                else{
                    return "Enter Beginning and ending date";
                }
            }
        }
    }

} 

?>