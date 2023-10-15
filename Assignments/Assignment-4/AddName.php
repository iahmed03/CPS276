<?php


class AddName {


    private $namelist="";

    public function format_name($name) {
        $arrName = explode(" ", $name);
        $name_to_be_added = $arrName[1].", ".$arrName[0]."\n";
        return $name_to_be_added;
    }

    public function add_name($name="no name entered", $namelist="") {
        $name_to_be_added = $this->format_name($name);
        $this->namelist = $namelist.$name_to_be_added;
    }

    public function clear_names() {
        $this->namelist = "";
    }
    
    public function display_name_list(){
        return $this->namelist;
    }
}

/*$ex=new AddName();
$ex->clear_names();
echo $ex->display_name_list();
$ex->add_name("ishaq ahmed");
echo $ex->display_name_list()."<br/>";

$do=new AddName();
$do->add_name("Osama Ahmed");
echo $do->display_name_list();*/

?>