<!--                        
╭──────────────────╮
│ FEITO POR RAQUEL │
╰──────────────────╯
-->

<?php
require_once 'PHP/controlador_taboa.php';
?>

<!DOCTYPE html>
<html lang="gl">

<head>
    <!-- Base metadata -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Page title -->
    <title>Libros & co.</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/estilo.css" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="ASSETS/icon.svg">
    <!-- Switzer font -->
    <link href="https://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
</head>

<body class="bg-white">
    <!-- Navigation bar -->
    <?php include 'PHP/navbar.php'; ?>

    <!-- Title and new book button -->
    <div class="d-flex align-items-center justify-content-between mt-4 mb-3">
        <!-- Title -->
        <h1 class="fw-normal">Lista de libros</h1>
        <!-- New book button -->
        <button class="btn btn-info text-white rounded-pill d-flex align-items-center px-4 py-2" onclick="document.location='formulario.php'">
            <!-- + icon -->
            <i class="fas fa-plus me-2"></i>
            <!-- Text -->
            <span class="d-none d-sm-inline">Engadir novo</span>
        </button>
    </div>

    <!-- Books table -->
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle mobile-optimised">
            <!-- Table header -->
            <thead>
                <tr>
                    <th scope="col">ISBN</th>
                    <th scope="col">Título</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Xénero</th>
                    <th scope="col">Stock</th>
                </tr>
            </thead>
            <!-- Table body -->
            <?php
            require_once 'PHP/corpo_taboa.php';
            ?>
        </table>
    </div>

    <!-- Bottom book illustration container -->
    <div class="book-illustration-container my-4">
        <!-- Book illustration -->
        <img src="ASSETS/libro.png" alt="Libro" class="img-fluid book-illustration" />
    </div>

    <!-- Footer -->
    <?php include 'PHP/footer.php'; ?>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS for hamburger to X toggle in phone view -->
    <script src="js/navbar-toggle.js"></script>
</body>

</html>