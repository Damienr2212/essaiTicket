<?php 
    session_start();
    echo '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>Detail Ticket</title>
</head>
<body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <h1 class="navbar-brand"> Ticketing Service | Connecté en tant que : ' . (isset($_SESSION['nom']) ? $_SESSION['nom'] : '') . '</h1>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="navbar-item">
                            <a class="nav-link" href="Ticket.php"><i class="bi bi-plus"></i> Create Ticket</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <br>';





    $servername = 'localhost';
    $username = 'root';
    $password = 'M@rseille13012*';
    $bdd = 'ticketing';
    

     $db = mysqli_connect($servername, $username, $password, $bdd);
    function dbquery(string $query){
     global $db;
      $result = mysqli_query($db, $query);
     if (!$result) {
      echo 'query pas ok';
     }
      return $result;
     }

$id_ticket = htmlspecialchars($_GET["id"]);
/*var_dump($id_ticket);*/

function ticketsDisplay(){
    $id_ticket = htmlspecialchars($_GET["id"]);
    $sql = "SELECT * FROM tickets WHERE id=$id_ticket";
    $result = dbquery($sql);
    $row = mysqli_fetch_assoc($result);
    

    echo '<div class="container">
    <table class="table table-striped">
    <thead>
    <tr>
    <th scope="col"> Nom </th>
    <th scope="col"> Title </th>
    <th scope="col"> Msg </th>
    <th scope="col">Priority</th>
    <th scope="col">Date</th>
    <th scope="col">Statut</th>
    <th scope="col">Mail</th>

    </tr>
    </thead>
    <tbody>';
        echo '<tr>';
        echo '<td>'.$row['full_name'].'</td>';
        echo '<td>'.$row['title'].'</td>';
        echo '<td>'.$row['msg'].'</td>';
        echo '<td>'.$row['priority'].'</td>';
        echo '<td>'.$row['created'].'</td>';
        echo '<td>'.$row['ticket_status'].'</td>';
        echo '<td>'.$row['email'].'</td>';
        echo '</tr>';
    
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
ticketsDisplay();


$sql = "SELECT * FROM tickets_comments WHERE ticket_id=$id_ticket";
$result = dbquery($sql);
    echo '<div class="container" id="comment" >';
    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col"> Commentaire suplementaire </th>';  
    echo '<th scope="col"> date du post </th>';  
    echo '</tr>';  
    echo '</thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
    echo '<td>'.$row['msg'].'</td>';
    echo '<td>'.$row['created'].'</td>';
}
    echo '</tbody>';
    echo '</table>';
    echo '</div>';

function ChangeStatusTicket(){
    $id_ticket = htmlspecialchars($_GET["id"]);
    $sql = "UPDATE tickets SET ticket_status='closed' WHERE id=$id_ticket";
    dbquery($sql);
    retour_index();
    exit();

}

function retour_index(){
    header('Location: /index.php');
	exit();
}

if (isset($_POST['Ticket_resolved'])) {
    if ($_POST['Ticket_resolved'] == "Close_ticket") {
        ChangeStatusTicket();
    }
}

if (isset($_POST['Retour_Racine'])){
    if ($_POST['Retour_Racine']=="Accueil"){
        retour_index();
    }
}



?>          

<!-- Formulaire 1 : Fermer le ticket -->
<form method="post" action="#">
    <input type="submit" name="Ticket_resolved" value="Close_ticket" />
</form>

<br>

<!-- Formulaire 2 : Retour accueil -->
<form method="post" action="#">
    <input type="submit" name="Retour_Racine" value="Accueil" />
</form>


    
</body>
</html>