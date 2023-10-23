<?php

class Directories{

    // DECLARATION OF VARIABLES:
    private $dirName="1";
    private $content="";
    private $dir_relative_path="";
    private $file_relative_path="";

    // CONSTRUCTOR:
    public function __construct($dirName, $content){
        $this->dirName=$dirName;
        $this->content=$content;
    }

    // METHOD TO CREATE DIRECTORY AND FILE, AND TO RESPOND TO ANY ERROR MESSAGES ENCOUNTERED
    public function createDirectory(){
        $dir_relative_path="../../../directories/{$this->dirName}";
        $file_relative_path="{$dir_relative_path}/readme.text";
        if ( !is_dir($dir_relative_path)){
            if (mkdir($dir_relative_path, 0777, true)){
                chmod($dir_relative_path, 0777);
                if (touch($file_relative_path)){
                    $handler=fopen($file_relative_path, "w");
                    fwrite($handler, $this->content);
                    fclose($handler);
                    $this->dir_relative_path=$dir_relative_path;
                    $this->file_relative_path=$file_relative_path;
                    return "Directory and file where created.";
                }
                else{
                    return "Error in creation of file";
                }
            }
            else{
                return "Error in creation of directory";
            }

        }
        else{
            return "A directory already exists with that name.";
        }
    }

    // METHOD TO GET FILE_RELATIVE_PATH VALUE:
    public function getFilePath(){
        return $this->file_relative_path;
    }

    // METHOD TO GET DIR_RELATIVE_PATH VALUE:
    public function getDirPath(){
        return $this->dir_relative_path;
    }
}
?>
