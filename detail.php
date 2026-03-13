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
    $servername = 'localhost';
    $username = 'admin';
    $password = 'snir';
    $bdd = 'Ticketing';
    $table = 'tickets';

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

function ticketsDisplay(){
    $id_ticket = htmlspecialchars($_GET["id"]);
    $sql = "SELECT * FROM tickets WHERE id=$id_ticket";
    $result = dbquery($sql);

    echo '<div class="container">';
    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col"> Nom </th>';
    echo '<th scope="col"> Title </th>';
    echo '<th scope="col"> Msg </th>';  
    echo '<th scope="col">Priority</th>';
    echo '</tr>';  
    echo '</thead>';
    echo '<tbody>';


    $row = mysqli_fetch_assoc($result);
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

function ChangeStatusTicket(){
    $id_ticket = htmlspecialchars($_GET["id"]);
    $sql = "UPDATE tickets SET ticket_status='closed' WHERE id=$id_ticket";
    dbquery($sql);
    header('Location: http://127.0.0.1/essaiTicket-main/');
    exit();

}

if (isset($_POST['Ticket_resolved'])) {
    if ($_POST['Ticket_resolved'] == "Close_ticket") {
        ChangeStatusTicket();
    }
}

$sql = "SELECT * FROM tickets_comments WHERE ticket_id=$id_ticket";
$result = dbquery($sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['msg'];
    echo $row['created'];
}

?>          


<form id="bouton" name="bouton" method="post" action="#">
  <label>
  <input type="submit" name="Ticket_resolved" id="bouton" value="Close_ticket" />
  </label>
</form>

    
</body>
</html>