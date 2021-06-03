<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>        
    <title>Messages !</title>
</head>
<body>


<?php 
session_start();
$inc_path = 'inc/';

$db_host = "localhost";
$db_name = "portfolio";
$db_user = "root";
$db_pass = "password123";
$host_name = "http://xill.tk";

$db_table = "message";
if(isset($_SESSION['connected'])){
    try
    {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    catch (Exception $e)
    {

    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM {$db_table} WHERE id = " . $id;
        $t = $conn->query($query);
    }
    $t = $conn->query("SELECT * FROM {$db_table} ");
    echo "<table class='table table-striped table-dark'>
    <tr>
        <th>Nom</th>
        <th>message</th>
        <th>email</th>
        <th>Date</th>
        <th></th>
    </tr>";
    while ($m = $t->fetch()) 
    {
        echo "<tr>";
            echo "<td>". $m['fullname']."</td>";
            echo "<td>". $m['message']."</td>";
            echo "<td>". $m['email']."</td>";
            echo "<td>". $m['date_']."</td>";
            echo "<td><a href='show_message.php?id=" . $m['id'] . "&pass=motdepasse'>Supprimer<a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<div id='link_container'><a class='aa deco' href='index.php?disconnect=1'>Se déconnecter </a>";
    echo "<a class='aa' id='retour' href='index.php'>Retour à l'index </a></div>";
}
else {
    header('Location: https://xill.tk/portfolio/admin'); exit; 
}
?>
<style>
body{
    background:black;
}
.aa{
  padding: 8px 12px 10px 12px;
  text-decoration:none;
  border: 1px solid rgba(255,255,255,.5);
  background: rgba(0,0,0,.75);
}
#link_container{
    display:flex;
}
#retour{
    position:absolute;
    right:0;
}
</style>
</body>
</html>