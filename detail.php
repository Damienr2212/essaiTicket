<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Detail Ticket</title>
</head>
<body>



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