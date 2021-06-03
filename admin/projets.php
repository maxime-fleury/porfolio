<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Gestion des projets</title>
</head>
<body class="text-white bg-dark">
<?php
session_start();
if(isset($_SESSION['connected'])){

$inc_path = 'inc/';

$db_host = "localhost";
$db_name = "portfolio";
$db_user = "root";
$db_pass = "password123";
$host_name = "http://xill.tk";

$db_table = "projet";
function checkInput($t){
    $res = false;
    $t = explode(",", $t);
    foreach($t as $k){
        if(!isset($_POST[$k]))
        {
            echo "<p class='err'>Erreur : \$_POST['" . $k . "'] n'existe pas !<br></p>";
            $res = true;
        }
        if($_POST[$k] == "")
        {
            echo "<p class='err'>Erreur : \$_POST['" . $k . "'] est vide !<br></p>";
            $res = true;
        }
    }
    return $res;
}
try
{
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (Exception $e){}
//  100MB maximum file size
ini_set("upload_max_filesize", "100M");
$MAXIMUM_FILESIZE = 100 * 1024 * 1024;
$rEFileTypes =
"/^\.(jpg|jpeg|gif|png|doc|docx|txt|rtf|pdf|xls|xlsx|
      ppt|pptx){1}$/i";
if(isset($_POST['action'])){
    $inputs = "action,titre";
    $check = checkInput($inputs);
    if(!$check){
        $title = addslashes($_POST['titre']);
        $action = $_POST['action'];
        
        if(isset($_POST['github']))
            $github = $_POST['github'];
        else $github = "";
        if(isset($_POST['url']))
            $url = $_POST['url'];
        else $url = "";
        if(isset($_POST['contenu']))
            $contenu = addslashes($_POST['contenu']);
        else $contenu = "";
        $disabled = isset($_POST['disabled']) ? 1 : 0;
        echo "<hr>";
        echo $title . "<br>";     
        echo $disabled . "<br>";
        echo $action .  "<br>";
        echo $contenu . "<br>";
        echo $github . "<br>";
        echo $url . "<br>";
        echo "<hr>";
        $uploaddir = '/var/www/uploads/';

        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        if ($_FILES['image']['size'] <= $MAXIMUM_FILESIZE){
            echo '<pre>';

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                echo "Le fichier est valide, et a été téléchargé
                    avec succès. Voici plus d'informations :\n";
            } else {
                echo "Attaque potentielle par téléchargement de fichiers.
                    Voici plus d'informations :\n";
            }

            echo 'Voici quelques informations de débogage :';
            print_r($_FILES);

            echo '</pre>';
            if($_POST["action"] == "add" ){
                //HERE EVERYTHING LOOKS OK LETS ADD TO THE DATABASE ! 
                $statement = "INSERT INTO projet VALUES (NULL, '{$title}', '{$contenu}', '{$uploadfile}',  '{$disabled}',  '{$github}',  '{$url}')";
                $h = $conn->exec($statement);
            }

            
        }
        else{
            echo "Image trop volumineuse !";

        }
        if($_POST["action"] == "edit" ){
            //HERE EVERYTHING LOOKS OK LETS EDIT TO THE DATABASE ! 
            $id = $_POST['id'];
            $img = "";
            if(isset($_FILES['image']['name']))
                $img = ", image_name = '{$uploadfile}'";
            $statement = "UPDATE projet set titre = '{$title}', content = '{$contenu}' " . $img . ", disabled = '{$disabled}',  github = '{$github}',  url = '{$url}' WHERE id = '{$id}'";
            $h = $conn->exec($statement);
        }
    }
}

//list projets + add edit button
$t = $conn->query("SELECT * FROM {$db_table} ");
?>
<h2> Liste des projets </h2>
<table  class="table table-striped table-dark">
    <tr>
        <th>Titre</th>
        <th>Contenu</th>
        <th>Archivé</th>
        <th>Image</th>
        <th>Aperçu</th>
        <th>Github</th>
        <th>Url</th>
        <th></th>
    </tr>
<?php
while ($projets = $t->fetch()) {
    ?>
    <tr>
        <form action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo $projets['id']; ?>">
            <td><input type="text" name="titre" value="<?php echo $projets['titre']; ?>"/></td>
            <td><textarea name="contenu"> <?php  echo $projets["content"]; ?>  </textarea></td>
            <td><input type="checkbox" id="disabled" name="disabled" <?php if($projets["disabled"]) echo "checked"; ?>></td>
            <td><input type="file" name='image'/></td>
            <td><img style='width:100px;' src='img.php?i=<?php echo $projets["image_name"];?>'/></td>
            <td><input type="text" name="github" placeholder="https://github.com/" value="<?php echo $projets['github'];?>"/></td>
            <td><input type="text" name="url" placeholder="https://xill.tk/" value="<?php echo $projets['url'];?>"/></td>
            <td><input type="submit" value="Modifier"/></td>
        </form>
    </tr>
    <?php
}
?>
</table>
<hr>
    <h2><p> Ajouter un projet !?</p></h2><br>
<table  class="table table-striped table-dark">
    <tr>
        <th scope="col">Titre</th>
        <th scope="col">Contenu</th>
        <th scope="col">Archiver</th>
        <th scope="col">Image</th>
        <th scope="col">Github</th>
        <th scope="col">Url</th>
        <th scope="col"></th>
    </tr>
    <tr>
        <form action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">

            <td><input type="text" name="titre" placeholder="Titre"/></td>
            <td><textarea name="contenu" placeholder="contenu">   </textarea></td>
            <td><input type="checkbox" id="disabled" name="disabled"></td>
            <td><input type="file" name="image"/></td>
            <td><input type="text" name="github" placeholder="https://github.com/"/></td>
            <td><input type="text" name="url" placeholder="https://xill.tk/"/></td>
            <td><input type="submit" value="Ajouter"/></td>
        </form>

</table>
<?php
echo "<a href='index.php?disconnect=1'>Se déconnecter </a><br>";
echo "<a href='index.php'>Retour à l'index </a>";


}
else {//not connected
    header('Location: https://xill.tk/portfolio/admin'); exit; 
}

?>



</body>
</html>
