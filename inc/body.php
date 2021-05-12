<?php 
$inc_path = 'inc/';

$db_host = "localhost";
$db_name = "portfolio";
$db_user = "root";
$db_pass = "password123";
$host_name = "http://xill.tk";

$db_table = "articles";
    if(isset($_GET["id"])){//une page à été choisi
        $id = $_GET["id"];
    }
    else{
        $id = 1;
    }
        //connexion base de donnée
        try
        {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        catch (Exception $e)
        {

        }
        
        $t = $conn->query("SELECT * FROM {$db_table} WHERE id = '{$id}' ");
        //montre l'article actuelle
        while ($article = $t->fetch()) {
            echo '<h2 id="article_title">' . $article["title"] . '</h2>';
            echo '<section id="article_content">' . $article["content"] . '</section>';
        }
        //menu de gauche
        $t = $conn->query("SELECT id,title FROM {$db_table} ");
        $active_point = "class='not_active'";
        echo "<nav id='left_menu'>";
        while ($articles = $t->fetch()) {
            if($id == $articles['id'])
                $active_point = "class='active'";
            echo "<a href='index.php?id={$articles['id']}' {$active_point}>{$articles['title']}</a>";
            $active_point = "class='not_active'";
        }
        echo "</nav>";

        //second_nav_bar (en bas de page)
        $t = $conn->query("SELECT id,title FROM {$db_table} ");
        echo "<div id='navcontainer'>";
        echo "<div id='makeOneElement'>";
        echo "<nav id='menubar'>";
        $active_point = "class='not_active'";
        while ($articles = $t->fetch()) {
            if($id == $articles['id'])
                $active_point = "class='active'";
            echo "<a href='index.php?id={$articles['id']}' {$active_point}></a>";
            $active_point = "class='not_active'";
        }
        echo "</nav>";
        echo "<div id='aroundmenu'></div>";
        echo "</div></div>";
    
    
?>

</body>
