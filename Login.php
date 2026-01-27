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
                <h1 class="navbar-brand"> Ticketing Service </h1>
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <a class="nav-link" href="index.php"><i class="bi bi-house"></i> Home</a>
                    </li>
                    <li class="navbar-item">
                        <a class="nav-link" href="#"><i class="bi bi-list-ul"></i> Browse</a>
                    </li>
                    <li class="navbar-item">
                        <a class="nav-link" href="Login.php"><i class="bi bi-lock"></i> Login</a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <br>

        <?php 
        echo'
        <div class="container">

            <div class="row justify-content-around" style="width: auto">
                <div class="col-sm-3">
                    
                    <h1>Créer un compte</h1>

                    <form method="post">

                        <label>Nom</label>
                        <input class="form-control" type="text"  name="full_name" placeholder="Jean Martin" required>
                        <div class="invalid-feedback">Valeur incorrecte</div>
                        
                        <label>Mail</label>
                        <input class="form-control" type="mail" name="email" placeholder="example@example.com">
                        <div class="invalid-feedback">Valeur incorrecte></div>
                        
                        <label>Mot de passe</label>
                        <input class="form-control" type="password" name="password"  size="10" maxlength="10" />
                        <div class="invalid-feedback">Valeur incorrecte></div>
                        
                        <br>
                        <input class="btn btn-primary" type="submit" value="Ajouter" />

                    </form>
                </div>



                <div class="col-sm-3">
                    <h1>Se connecter</h1>

                    <form method="post">
                        
                        

                            <label>Mail</label>
                            <input class="form-control" type="mail"  name="mail" placeholder="example@example.com" required>
                            <div class="invalid-feedback">Valeur incorrecte</div>
                            
                            <label>Mot de passe</label>
                            <input class="form-control" type="password"  size="10" maxlength="10" />
                            <div class="invalid-feedback">Valeur incorrecte></div>
                            
                            <br>
                            <input class="btn btn-primary" type="submit" value="Se connecter" />

                        
                    </form>
                </div>
            </div>        
        </div>';



            $servername = 'localhost';
            $username = 'admin';
            $password = 'admin';
            $table = 'ticket';
            

            $db = mysqli_connect($servername, $username, $password, $table);

           function dbquery(string $query){
            global $db;
             $result = mysqli_query($db, $query);
            if (!$result) {
             echo 'query pas ok';
            }
             return $result;
            }

            $full_name = $_POST['full_name'];
            $accpassword = $_POST['password'];
            $email = $_POST['email'];
            $sql = "INSERT INTO accounts (full_name, password, email) VALUES ('$full_name','$accpassword','$email')";
            dbquery($sql)
            
?>
</body>