<?php


class AddName {


    private static $nameList="";
    private $name_to_be_added="";

    public function format_name($name) {
        $arrName = explode(" ", $name);
        $this->name_to_be_added = $arrName[1].", ".$arrName[0]."\n";
    }

    public function add_name($name) {
        $this->format_name($name);
        AddName::$nameList .= $this->name_to_be_added;
    }

    public function clear_names() {
        AddName::$nameList = "";
    }
    
    public function display_name_list(){
        return AddName::$nameList;
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