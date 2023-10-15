<?php


class AddName {

    // DECLARATION OF VARIABLES
    private $namelist="";

    // FUNCTION THAT FORMATS THE NAME SUCH THAT LASTNAME IS WRITTEN BEFORE FIRSTNMAE
    public function format_name($name) {
        $arrName = explode(" ", $name);
        $name_to_be_added = $arrName[1].", ".$arrName[0]."\n";
        return $name_to_be_added;
    }

    // FUNCTION TO ADD NAME TO THE NAMELIST
    public function add_name($name="no name entered", $namelist="") {
        $name_to_be_added = $this->format_name($name);
        $this->namelist = $namelist.$name_to_be_added;
    }

    // FUNCTION TO CLEAR THE NAMELIST FROM THE TETRABOX
    public function clear_names() {
        $this->namelist = "";
    }
    
    // FUNCTION TO OUTPUT THE NAMELIST IN THE TETABOX
    public function display_name_list(){
        return $this->namelist;
    }
}

?>