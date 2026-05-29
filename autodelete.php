<?php

$servername = 'localhost';
$username = 'admin';
$password = 'admin';
$bdd = 'Ticketing';

$conn = mysqli_connect($servername, $username, $password, $bdd);

$stmt1 = mysqli_prepare($conn,
    "DELETE tickets_uploads FROM tickets_uploads
     JOIN tickets ON tickets.id = tickets_uploads.ticket_id
     WHERE tickets.created < NOW() - INTERVAL 1 MONTH"
);
mysqli_stmt_execute($stmt1);

$stmt2 = mysqli_prepare($conn,
    "DELETE tickets_comments FROM tickets_comments
     JOIN tickets ON tickets.id = tickets_comments.ticket_id
     WHERE tickets.created < NOW() - INTERVAL 1 MONTH"
);
mysqli_stmt_execute($stmt2);

$stmt3 = mysqli_prepare($conn,
    "DELETE FROM tickets
     WHERE created < NOW() - INTERVAL 1 MONTH"
);
mysqli_stmt_execute($stmt3);

mysqli_close($conn);

/* 
        CRON :
        0 0 1 * * php /chemin/vers/autodelete.php
*/

?>

