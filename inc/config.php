<?php



function inc($files_name){
    $files_name = explode(", ", $files_name);
    foreach( $files_name as $file) 
        require_once($file);
}


?>