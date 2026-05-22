<?php
session_start();
        $servername = 'localhost';
        $username = 'admin';
        $password = 'admin';
        $dbname = 'Ticketing';

        $db = mysqli_connect($servername, $username, $password, $dbname);

        function dbquery(string $query) {
            global $db;
            $result = mysqli_query($db, $query);
            if (!$result) {
                echo 'query pas ok';
            }
            return $result;
        }

        function accCreate() {
            global $db;
            $salt = '$5$rounds=5000$' . bin2hex(random_bytes(8)) . '$';
            $full_name = $_POST['full_name'];
            $accpassword = $_POST['password'];
            $hashpassword = crypt($accpassword, $salt);
            $email = $_POST['email'];
            $stmt = mysqli_prepare($db, "INSERT INTO accounts (full_name, password, email) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, 'sss', $full_name, $hashpassword, $email);
            mysqli_stmt_execute($stmt);
        }

        if(isset($_POST['envoyer']) && $_POST['envoyer'] == 'Ajouter') {
            accCreate();
            echo '<div class="alert alert-success">Compte créé !</div>';
        }

        $bdd = new PDO('mysql:host=localhost;dbname=Ticketing;charset=utf8;', 'admin', 'admin');

        if(isset($_POST['connecter'])) {
            if(!empty($_POST['pswd']) && !empty($_POST['mail'])) {

                $mail = $_POST['mail'];
                $pswd = $_POST['pswd'];

                $recupUser = $bdd->prepare('SELECT * FROM accounts WHERE email = ?');
                $recupUser->execute(array($mail));

                if($recupUser->rowCount() > 0) {
                    $user = $recupUser->fetch();
                    var_dump($user);
                    if(crypt($pswd, $user['password']) == $user['password']) {
                        $_SESSION['mail'] = $mail;
                        $_SESSION['nom'] = $user['full_name'];
                        $_SESSION['role'] = $user['role'];
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['mail'] = $user['email'];
                        echo '<div class="alert alert-success">Connecté : ' . $_SESSION['nom'] . '</div>';
                        header('Location:index.php');
                    } else {
                        echo '<div class="alert alert-danger">Mot de passe incorrect.</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Mail introuvable.</div>';
                }

            } else {
                echo '<div class="alert alert-warning">Veuillez compléter tous les champs.</div>';
            }

            
        }


echo '
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Ticket Form</title>
        <link rel="stylesheet" href="login.css">
        <script src="index.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <h1 class="navbar-brand"> Ticketing Service | Connecté en tant que : ' . (isset($_SESSION['nom']) ? $_SESSION['nom'] : '') . '</h1>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="navbar-item">
                            <a class="nav-link" href="index.php"><i class="bi bi-house"></i> Accueil</a>
                        </li>
                        <li class="navbar-item">
                            <a class="nav-link" href="Ticket.php"><i class="bi bi-plus"></i> Create Ticket</a>
                        </li>                        
                    </ul>
                </div>
            </div>
        </nav>
        <br>';

        echo '
        <div class="container">
            <div class="row justify-content-around" style="width: auto">
                <div class="col-sm-3">
                    <h1>Créer un compte</h1>
                    <form method="post">

                        <label>Nom complet</label>
                        <input class="form-control" type="text" name="full_name" placeholder="Jean Martin" required>
                        <div class="invalid-feedback">Valeur incorrecte</div>

                        <label>Mail</label>
                        <input class="form-control" type="email" name="email" placeholder="example@example.com">
                        <div class="invalid-feedback">Valeur incorrecte</div>

                        <label>Mot de passe</label>
                        <input class="form-control" type="password" name="password" size="10" maxlength="10" />
                        <div class="invalid-feedback">Valeur incorrecte</div>

                        <br>
                        <input class="btn btn-primary" id="button" type="submit" name="envoyer" value="Ajouter" />
                    </form>
                </div>

                <div class="col-sm-3">
                    <h1>Se connecter</h1>
                    <form method="post">

                        <label>Mail</label>
                        <input class="form-control" type="email" name="mail" placeholder="example@example.com" required>
                        <div class="invalid-feedback">Valeur incorrecte</div>

                        <label>Mot de passe</label>
                        <input class="form-control" type="password" name="pswd" size="10" maxlength="10" />
                        <div class="invalid-feedback">Valeur incorrecte</div>

                        <br>
                        <input class="btn btn-primary" type="submit" name="connecter" value="Se connecter" />
                    </form>
                </div>
            </div>
        </div>';



?>
</body>