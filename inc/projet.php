<div id="card_container">
<?php
$t = $conn->query("SELECT * FROM projet ");
while ($projets = $t->fetch()) {
    if(!$projets["disabled"]){
?>

   <div class="card">
        <span class='card_title'><?php echo $projets['titre'];?></span>
        <div class='card_content'>      
            <span class='card_text'><?php echo $projets['content']; if($projets['content']==NULL) echo "<br>";?>
            </span>  
            <a class='card_link' href='<?php echo $projets['url'];?>'> Voir </a>
            <a class='card_link' href='<?php echo $projets['github'];?>'> <i class="fab fa-github"></i> </a>
        </div>
        <div><img class='minature_img' alt='screen_projet_ampoule' src='https://xill.tk/portfolio/admin/img.php?i=<?php echo $projets["image_name"];?>'/></div>
   </div>

<?php 
}}
?>
</div>