<?php
function init_logout($name=null){
    session_start();
    session_destroy();
	setcookie(session_name(), "", time() - 3600, "/");
    return "Logged out. Have a nice day"." ".$name;

}
?>