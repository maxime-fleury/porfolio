<?php
if(isset($_GET['i']) && $_GET['i'] != ''){
    header('Content-Type: image/png');
    $imgPng = imageCreateFromPng($_GET['i']);
    imageAlphaBlending($imgPng, true);
    imageSaveAlpha($imgPng, true);
    
    /* Output image to browser */
    imagePng($imgPng);



}
