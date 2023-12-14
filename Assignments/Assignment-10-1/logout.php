<?php
function init_logout($base){
    if(isset($_SESSION)) { 
        session_destroy();
        setcookie(session_name(), "", time() - 3600, "/");
        header("Location: {$base}login");
    }
}
?>