<?php 

   require 'FonctionEnvoie.php';

if($_SERVER['REQUEST_METHOD']==="POST"){
    $email = $_POST['email'];
    $nom = $_POST['full_name'];
    #echo "email: ".$email. "<br> name: ".$nom;
    EnvoieMail($nom, $email);
}

?>