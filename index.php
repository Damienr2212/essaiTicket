<?php
    session_start();

echo '<html lang="fr">

    <head>
        <meta charset="utf-8">
        <title>Accueil Ticketing service</title>
        <link rel="stylesheet" href="index.css">
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
                            <a class="nav-link" href="Ticket.php"><i class="bi bi-plus"></i> Create Ticket</a>
                        </li>';
                        if(empty($_SESSION['nom'])){
                            echo '
                        <li class="navbar-item">
                            <a class="nav-link" href="Login.php"><i class="bi bi-lock"></i> Login</a>
                        </li>';
                        }
echo'               </ul>
                </div>
            </div>
        </nav>
        <br>';

        if(!empty($_SESSION['nom'])){
            echo '
        <a href="deconnexion.php">
        <button> Se deconnecter</button>
        </a>';
        }

        echo '<div class="container-lg">
            <h2>Home</h2>
            <hr>
            <div class="container ">
                <div class="row align-items-center">
                    <div class="col" id="ticket-open-square">
                      <h1>Open Ticket</h1>
                    </div>
                    <div class="col" id="ticket-resolved-square">
                      <h1> Resolved Ticket </h1>
                    </div>
                    <div class="col" id="ticket-closed-square">
                      <h1>Closed Ticket</h1>
                    </div>
                </div>
        </div>

        <div class="container-lg">
            <hr>
            <h2>New Ticket</h2>
        </div>';

        $servername = 'localhost';
        $username = 'root';
        $password = 'M@rseille13012*';
        $bdd = 'ticketing';

        $conn = mysqli_connect($servername, $username, $password, $bdd);

        function ticketsDisplay() {
            global $conn;

            /*var_dump($_SESSION);*/
            if(empty($_SESSION)){
                
                echo '  <br>
                        <h1> CONNECTER VOUS POUR VOIR VOS TICKETS </h1> 
                 ';
            }else{

            $user_role = $_SESSION['role'];

            $query = "
                SELECT tickets.id AS ticket_id, tickets.title, tickets.msg, tickets.priority,
                       accounts.full_name
                FROM tickets
                JOIN accounts ON accounts.id = tickets.account_id
            ";

            if ($user_role === 'Admin') {
                $sql = mysqli_prepare($conn, $query . "
                    WHERE tickets.ticket_status = 'open'
                    OR tickets.ticket_status = 'resolved'
                    OR tickets.ticket_status = 'closed'
                ");
                mysqli_stmt_execute($sql);

            } elseif ($user_role === 'Technicien') {
                $sql = mysqli_prepare($conn, $query . "
                    WHERE tickets.ticket_status = 'open'
                ");
                mysqli_stmt_execute($sql);

            } elseif ($user_role === 'Member') {
                $id_user = $_SESSION['id'];
                $sql = mysqli_prepare($conn, $query . "
                    WHERE tickets.ticket_status = 'open'
                    AND accounts.id = ?
                ");
                mysqli_stmt_bind_param($sql, 'i', $id_user);
                mysqli_stmt_execute($sql);
            }

            $result = mysqli_stmt_get_result($sql);

            echo '<div class="container">';
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col"> Nom </th>';
            echo '<th scope="col"> Title </th>';
            echo '<th scope="col"> Msg </th>';
            echo '<th scope="col"><button type="button" class="btn text-nowrap btn-outline-dark">Priority ⇅</button></th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['full_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['title']) . '</td>';
                echo '<td>' . htmlspecialchars($row['msg']) . '</td>';
                echo '<td>' . htmlspecialchars($row['priority']) . '</td>';
                echo "<td><button onclick='voirTicket(" . $row['ticket_id'] . ")'>Plus</button></td>";
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        }
        }

        ticketsDisplay();
?>

    </body>

    <script>
        const tbody = document.querySelector('tbody');
        const thx = document.querySelectorAll('th');
        const trxb = tbody.querySelectorAll('tr');

        thx.forEach(th => th.addEventListener('click', () =>{
            let classe = Array.from(trxb).sort(compare(Array.from(thx).indexOf(th), this.asc = !this.asc));
            classe.forEach(tr => tbody.appendChild(tr));
        }));

        const priorityWeights = {
            "hight" : 1,
            "medium" : 2,
            "low" : 3,
        }

        const compare = (ids, asc) => (row1, row2) => {
            const tdValue = (row, ids) => row.children[ids].textContent.trim().toLowerCase();
            
            const v1 = tdValue(asc ? row1 : row2, ids);
            const v2 = tdValue(asc ? row2 : row1, ids);

            if (priorityWeights[v1] && priorityWeights[v2]) {
                return priorityWeights[v1] - priorityWeights[v2];
            }

            return v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) 
                ? v1 - v2 
                : v1.toString().localeCompare(v2);
        };

        function voirTicket(id){
            window.location.href = "detail.php/?id=" + id;
        }
    </script>

</html>