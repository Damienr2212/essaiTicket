<!doctype html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <title>Accueil Ticketing service</title>
        <link rel="stylesheet" href="index.css">
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
        
        
            

    </body>

</html>