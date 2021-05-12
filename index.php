<?php
require("inc/config.php");
if(isset($_GET["header"])){
    $files_name = "session.php, connect.php, body.php, footer.php";
}
else{
    $files_name = "session.php, connect.php, header.php, body.php, footer.php";
}
inc($files_name);