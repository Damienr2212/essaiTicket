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


            <div class="container">
                <h1>Create Ticket</h1>
                <hr>
                <div class="row justify-content-start" style="width: auto">
                    <div class="col-sm-3">
                        
                            
                        <form method="post">
                            <label>Titre</label>
                            <input class="form-control" type="text"  name="Nom" placeholder="Titre" required>
                            <div class="invalid-feedback">Valeur incorrecte</div>

                            <br>

                            <label>Categorie</label>
                            <select class="form-control" name="Categorie" placeholder="Categorie" required>
                                <option value="">Selectionner votre choix</option>
                                <option value="Generale">Generale</option>
                                <option value="TEST1">TEST1</option>
                                <option value="TEST2">TEST2</option>
                            </select>   
                            <div class="invalid-feedback">Valeur incorrecte</div>

                            <br>

                            <label>Prioritée</label>
                            <select class="form-control" name="Prioritée" placeholder="Prioritée" required>
                                <option value="">Selectionner votre choix</option>
                                <option value="Generale">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>   
                            <div class="invalid-feedback">Valeur incorrecte</div>

                            <br>

                            <label>Privé</label>
                            <select class="form-control" name="Privé" placeholder="Privé" required>
                                <option value="">Selectionner votre choix</option>
                                <option value="Oui">Oui</option>
                                <option value="Non">Non</option>
                            </select>   
                            <div class="invalid-feedback">Valeur incorrecte</div>

                            <br>
                            
                            <div class="message-box">
                            <label>Message</label>

                            <div id="editor" contenteditable="true" class="editor">
                                <span class="placeholder"></span>
                            </div>

                            <div class="toolbar">
                                <button onclick="format('bold')"><b>B</b></button>
                                <button onclick="format('italic')"><i>I</i></button>
                                <button onclick="format('underline')"><u>U</u></button>
                            </div>
                            </div>

                            <br>

                            <input class="form-control" type="file" name="files" accept="image/png,image/jpeg"/>

                            <br>

                            <input class="btn btn-primary" type="submit" value="Créer" />
                        </form>

                    </div>
                </div>
            </div>



<script>
function format(command) {
  document.execCommand(command, false, null);
}
</script>


            <!--



        <?php
		if (isset($_POST['prenom'])) {
			$mysqli = new mysqli("localhost", "root", "", "essai");
            $mysqli->set_charset("utf8");
            $requete = "INSERT INTO carnet VALUES(NULL, '" . $_POST['civilite'] . "', '" . $_POST['prenom'] . "', '" . $_POST['nom'] . "', '" . $_POST['email'] . "', '" . $_POST['date_naissance'] . "')";
		    $resultat = $mysqli->execute_query($requete);
            if ($resultat)
                echo "<p>Le contact a été ajouté</p>";
            else
                echo "<p>Erreur</p>";
		}
		?>  
    -->

    </body>