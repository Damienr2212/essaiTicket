<html lang="fr">

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
                <h1 class="navbar-brand"> Ticketing Service </h1>
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <a class="nav-link" href="Ticket.php"><i class="bi bi-plus"></i> Create Ticket</a>
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



        <div class="container-lg">
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
        </div>



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

function ticketsDisplay(){
    $sql = "SELECT * FROM tickets Where ticket_status='open' or ticket_status='resolved'";
    $result = dbquery($sql);

    echo '<div class="container">';
    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col"> Nom </th>';
    echo '<th scope="col"> Title </th>';
    echo '<th scope="col"> Msg </th>';  
    echo '<th scope="col"> <button type="button" class="btn text-nowrap btn-outline-dark">Priority ⇅</button> </th>';
    echo '</tr>';  
    echo '</thead>';
    echo '<tbody>';


    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>'.$row['full_name'].'</td>';
        echo '<td>'.$row['title'].'</td>';
        echo '<td>'.$row['msg'].'</td>';
        echo '<td>'.$row['priority'].'</td>';
        echo "<td> <button  onclick='voirTicket(".$row['id'].")' > Plus </button></td> ";
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
            ticketsDisplay();

    function TicketClosed(){        
        $sql = "SELECT COUNT(*) FROM tickets WHERE ticket_status= 'closed'";
        $result = dbquery($sql);
        echo '<h1>'.$result.'</h1>'; 
    }
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
            "medium" : 2 ,
            "low" : 3 ,
        }


        const compare = (ids, asc) => (row1, row2) => {
            const tdValue = (row, ids) => row.children[ids].textContent.trim().toLowerCase();
            
            const v1 = tdValue(asc ? row1 : row2, ids);
            const v2 = tdValue(asc ? row2 : row1, ids);

            // Si les valeurs sont dans notre dictionnaire de priorités, on compare les poids
            if (priorityWeights[v1] && priorityWeights[v2]) {
                return priorityWeights[v1] - priorityWeights[v2];
            }

            // Sinon, on garde votre logique actuelle (numérique ou alphabétique)
            return v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) 
                ? v1 - v2 
                : v1.toString().localeCompare(v2);
        };



        function voirTicket(id){
            window.location.href = "detail.php/?id=" +id
        }
        </script>


</html>