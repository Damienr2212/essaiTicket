<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Ticket Form</title>
        <link rel="stylesheet" href="Ticket.css">
        <script src="index.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </head>

    <body>

<?php
    session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = 'localhost';
$username = 'admin';
$password = 'admin';
$bdd = 'Ticketing';

$db = mysqli_connect($servername, $username, $password, $bdd);
if (!$db) die('Connexion échouée : ' . mysqli_connect_error());

function tickCreate($db) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $msg = mysqli_real_escape_string($db, $_POST['msg']);
    $priority = mysqli_real_escape_string($db, $_POST['priority']);
    $private = (int)$_POST['private'];
    $category_id = (int)$_POST['category'];
    $user_id = $_SESSION['id'];
    $user_full_name = $_SESSION['nom'];
    var_dump($user_full_name);
    $sql = "INSERT INTO tickets (title, msg, full_name, priority, private, category_id,account_id) 
            VALUES ('$title', '$msg','$user_full_name', '$priority', $private, $category_id, $user_id)";
    var_dump($sql);
    
    if (mysqli_query($db, $sql)) {
        echo '<div class="alert alert-success mt-3">
             Ticket créé ID : ' . mysqli_insert_id($db) . '
              </div>';
    } else {
        echo '<div class="alert alert-danger mt-3">
                Erreur : ' . mysqli_error($db) . '
              </div>';
    }
}

if (isset($_POST['envoyer']) && $_POST['envoyer'] == 'Créer') {
    if(!empty($_SESSION['nom'])){
        tickCreate($db);
    }else{
        header('Location:Login.php');
    }
}

echo'  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <h1 class="navbar-brand"> Ticketing Service | Connecté en tant que : ' . (isset($_SESSION['nom']) ? $_SESSION['nom'] : '') . '</h1>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="navbar-item">
                            <a class="nav-link" href="index.php"><i class="bi bi-house"></i> Accueil</a>
                        </li';
                        if(empty($_SESSION['nom'])){
                            echo '
                        <li class="navbar-item">
                            <a class="nav-link" href="Login.php"><i class="bi bi-lock"></i> Login</a>
                        </li>';
                        }
                echo '</ul>
                </div>
            </div>
        </nav>
        
        <br>


            <div class="container">
                <h1>Create Ticket</h1>
                <hr>
                <div class="row justify-content-start" style="width: auto">
                    <div class="col-sm-3">
                        
                            
                        <form method="post">
                            <label>Titre</label>
                            <input class="form-control" type="text"  name="title" placeholder="Titre" required>
                            <div class="invalid-feedback">Valeur incorrecte</div>

                            <br>

                            <label>Categorie</label>
                            <select class="form-control" name="category" placeholder="Categorie" required>
                                <option value="">Selectionner votre choix</option>
                                <option value="1">Generale</option>
                                <option value="2">Technique</option>
                                <option value="3">Divers</option>
                            </select>   
                            <div class="invalid-feedback">Valeur incorrecte</div>

                            <br>

                            <label>Prioritée</label>
                            <select class="form-control" name="priority" placeholder="Prioritée" required>
                                <option value="">Selectionner votre choix</option>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>   
                            <div class="invalid-feedback">Valeur incorrecte</div>

                            <br>

                            <label>Privé</label>
                            <select class="form-control" name="private" placeholder="Privé" required>
                                <option value="">Selectionner votre choix</option>
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>   
                            <div class="invalid-feedback">Valeur incorrecte</div>

                            <br>
                            
                            <div class="message-box">
                                 <label>Message</label>
                                <textarea name="msg" id="msg" class="form-control" rows="4" required></textarea>
                            </div>';
    ?>



                            <div class="toolbar">
                                <button onclick="format('bold')"><b>B</b></button>
                                <button onclick="format('italic')"><i>I</i></button>
                                <button onclick="format('underline')"><u>U</u></button>
                            </div>
                            </div>

                            

                            <br>

                            <input class="btn btn-primary" type="submit" name="envoyer" value="Créer" />
                        </form>

                    </div>
                </div>
            </div>

        
    </body>

