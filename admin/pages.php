<?php

$inc_path = 'inc/';

$db_host = "localhost";
$db_name = "portfolio";
$db_user = "root";
$db_pass = "password123";
$host_name = "http://xill.tk";

$db_table = "articles";

session_start();
if(isset($_SESSION['connected'])){
try
{
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (Exception $e)
{

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Modification de pages</title>
</head>
<body>

<?php
if( (isset($_GET["id"])) && (isset($_GET["title"])) && (isset($_GET["content"])) && (isset($_GET['action']))){
    $id = $_GET["id"];
    $title = addslashes($_GET['title']);
    $case = "0";
    if(isset($_GET["case"]))
        $case = "1";
    $content = addslashes($_GET['content']);
    if($_GET['action'] == 'edit')
        $query = "UPDATE articles SET title='{$title}', content = '{$content}',isInclude='{$case}' WHERE id='{$id}'";
    if($_GET['action'] == 'add')
        $query = "INSERT INTO articles VALUES (NULL, '{$title}', '{$content}', '{$case}')";
    $h = $conn->exec($query);
}
if(isset($_GET['id']) && isset($_GET['action'])){
    $id = $_GET['id'];
    if($_GET['action'] == 'delete'){
        $query = "DELETE from articles WHERE id=$id";
        $h = $conn->exec($query);
    }
}
$t = $conn->query("SELECT * FROM {$db_table} ");
echo "<table class='table table-striped table-dark'><tr><th>Titre</th><th>Contenu</th><th>isInclude ?</th><th></th></tr>";
while ($article = $t->fetch()) {
    echo "<form action='#' method='get'>";
    echo "<input type='hidden' name='id' value='".$article['id']."'>";
    echo "<input type='hidden' name='action' value='edit'>";
    echo "<tr><td><input type='text' name='title' value='".$article['title']."'></td>";
    echo "<td><textarea name='content' ";
    echo  ($article["isInclude"]=="1") ? 'class="isinclude">' : ">";
    echo $article['content'] . "</textarea></td>";
    echo "<td><input type='checkbox' name='case' value=`";
    echo ($article["isInclude"]=="1") ? 'on` checked' : 'off`';
    echo "></td>";
    echo "<td><input type='submit' value='Modifier'><a href='?id=" . $article["id"] . "&action=delete'>";
    echo "Supprimer</a></td></tr>";
    echo "</form>";
}
    echo "</table>";
    echo "<hr>";
    echo "<h2>Ajouter une page ?</h2>";
    echo "<table class='table table-striped table-dark'><tr><th>Titre</th><th>Contenu</th><th>isInclude ?</th><th></th></tr>";
    echo "<form action='#' method='get'>";
    echo "<input type='hidden' name='action' value='add'>";
    echo "<input type='hidden' name='id' value='0'>";//random id just because the formular checks its get parameters
    echo "<tr><td><input type='text' name='title' placeholder='titre'></td>";
    echo "<td><textarea name='content' placeholder='contenue'></textarea></td>";
    echo "<td><input type='checkbox' name='case'></td>";
    echo "<td><input type='submit' value='Ajouter'></td></tr>";
    echo "</form>";
    echo "</table>";
    echo "<a id='deco' href='index.php?disconnect=1'>Se déconnecter </a>";
    echo "<a id='retour' href='index.php'>Retour à l'index </a>";
}
else {
    header('Location: https://xill.tk/portfolio/admin'); exit; 
}
?>
<style>
body{
    color:white;
    background:var(--dark);
}
textarea{
    width:450px;
    height: 150px;
}
.isinclude{
    width:200px;
    height:2.1em;
    text-align:center;
}
input,textarea{
    color:white;
    background:var(--dark);
}
input{
    padding: 8px 12px 10px 12px;
    border: 1px solid rgba(255,255,255,.5);
}
a{
  padding: 8px 12px 10px 12px;
  margin-left:5px;
  margin-top:5px;
  border: 1px solid rgba(255,255,255,.5);
  background: rgba(0,0,0,.25);
}
#retour{
    position:absolute;
    right:0;
}
</style>
</body>
</html>
