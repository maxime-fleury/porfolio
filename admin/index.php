<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Saira">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Page d'accueil administration</title>
</head>
<body>
<style>
    input[type=submit]{
        display: block;
        width: 150px;
        color:white;
        margin: 0 125px 20px;
        padding: 8px 0 10px 0;
        text-align: center;
        border: 1px solid rgba(255,255,255,.5);
        background: rgba(0,0,0,.25);
    }

    input[type=password]{
        display: block;
        color:white;
        width: 400px;
        margin: 150px 0 -20px;
        padding: 8px 12px 10px 12px;
        border: 1px solid rgba(255,255,255,.5);
        background: rgba(0,0,0,.25);
    }
    input[type=password]:hover, input[type=submit]:hover,a:hover{
        outline: thick double #32a1ce;
    }
    body{
        font-familly: 'Saria', bold;
        margin:0;
        padding:0;
        background-color:#101010;
        color:white;
    }

a{
  padding: 8px 12px 10px 12px;
  margin-top:10px;
  margin-left:50px;
  margin-bottom:25px;
  text-decoration:none;
  border: 1px solid rgba(255,255,255,.5);
  background: rgba(0,0,0,.75);
}
#retour{
    position:absolute;
    right:0;
}

    #container{
        display:flex;
        justify-content:center;
        background:black;
    }
</style>
<?php
session_start();
if(isset($_POST["pass"])){
    if($_POST['pass'] == 'motdepasse'){
        $_SESSION['connected'] = true;
    }
    else{
        echo "Mot de passe incorrect !";
    }
}
if(isset($_GET['disconnect'])){
    unset($_SESSION['connected']);
    header('Location: https://xill.tk/portfolio/admin/index.php');
}
if(isset($_SESSION['connected'])){//connecté !
?>
<div id='container'>
    <a href="https://xill.tk/portfolio/admin/pages.php">Gerer les pages</a><br>
    <a href="https://xill.tk/portfolio/admin/projets.php">Gerer les projets</a></br>
    <a href="https://xill.tk/portfolio/admin/show_message.php">Afficher les nouveaux messages</a>
    <a href='https://xill.tk/portfolio/admin/index.php?disconnect=1'>Se déconnecter </a>
</div>

<?php
}else{//non connecté
?>
<div id='container' style='background:black'>
<form action='#' method='post'>
    <input type="password" name='pass' placeholder='*******'><br>
    <input class=''type='submit' value='Se connecter'>
</form>
</div>
<?php
}//end else
?>

    
</body>
</html>