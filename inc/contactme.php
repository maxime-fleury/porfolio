<?php
session_start();
$inc_path = 'inc/';

$db_host = "localhost";
$db_name = "portfolio";
$db_user = "root";
$db_pass = "password123";
$host_name = "http://xill.tk";

//make sure we're connected
try
{
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (Exception $e)
{

}
if(isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['message'])){
   if($_POST['nom'] != ''){
    if($_POST['email'] != ''){
       if($_POST['message'] != ''){
           if(str_replace(' ', '', strtolower($_SESSION['captcha'])) == str_replace(' ', '', strtolower(strtolower($_POST['captcha'])))){
           $nom = addslashes(htmlentities($_POST['nom']));
           $email = addslashes(htmlentities($_POST['email']));
           $message = addslashes(htmlentities($_POST['message']));
            echo "Message envoyé !";/*
            $message = htmlentities($_POST['message']);
            $message = wordwrap($message, 70, "\r\n");

            $to      = 'maxfdev@gmail.com';
            $subject = 'Email du Portfolio';
            $headers = 'From: webmaster@xill.tk' . "\r\n" .
            'Reply-To: maxfdev@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
       
            mail($to, $subject, $message, $headers);
            */
            
            $statement = "INSERT INTO message VALUES (NULL, '{$message}', '{$email}', '{$nom}', NOW())";
            $h = $conn->exec($statement);
           }
           else 
           echo "Captcha incorrect !";
       }
       else {
           echo "Le champ 'message' ne peut être vide !";
       }
    }
    else {
        echo "Le champ 'email' ne peut être vide !";
    }
   }
   else{
       echo "Le champ 'nom' ne peut être vide !";
   }
}

echo "<form action='?id=4&success=1' method='post'>";
echo "<input type='text' name='nom' placeholder='Nom Prénom'><br>";
echo "<input type='email' name='email' placeholder='NomPrénom@gmail.com'><br><div id='cap'>
<input type='text' id='input_captcha' name='captcha' placeholder='Captcha'><img id='captcha' src='inc/captcha.php'></div><br>";
echo "<textarea name='message' placeholder='Votre message ici.'></textarea>";
echo "<input type='submit'>";
?>

