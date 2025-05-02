<!--                        
╭──────────────────╮
│ FEITO POR RAQUEL │
╰──────────────────╯
-->

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// CONNECTION
// Database variables
$host = "localhost";
$user = "root";
$pwd = "abc123.";
$db = "raquel_gonzalez_bd";
$tablebooks = "libros";
$tablegenre = "xenero";

// Error handling
try {
    // Connection
    $connection = mysqli_connect($host, $user, $pwd, $db);

    // If there's an ISBN present in the url
    if (isset($_GET['isbn'])) {
        // Store the ISBN value in this variable
        $isbn_delete = $_GET['isbn'];

        // Deletion query
        $delete_book = "DELETE FROM $tablebooks WHERE isbn = '$isbn_delete'";

        // If the deletion query is executed
        if (mysqli_query($connection, $delete_book)) {
            // Redirect the user to the regular index page with a confirmation
            header("Location: lista-libros.php?deletion=ok");
            // Stop the script
            exit();
        // If the deletion query is not executed
        } else {
            // Show this
            echo "Error ao eliminar o libro: " . mysqli_error($connection);
        }
    }

    // Query to retrieve nome from xenero
    $select = "SELECT nome FROM $tablegenre";
    // Execute the query for the navbar
    $resultnavbar = mysqli_query($connection, $select);

    // Query to retrieve all fields from libros and nome from xenero
    $select = "SELECT * FROM $tablebooks
               JOIN $tablegenre ON $tablegenre.id = $tablebooks.xenero_id";
    // Execute the query for the table
    $resultable = mysqli_query($connection, $select);

    // CLOSE CONNECTION
    mysqli_close($connection);
} catch (Exception $e) {
    echo "Erro na conexión: " . $e->getMessage();
}
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
    <link rel="stylesheet" href="estilo.css" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="ASSETS/icon.svg">
</head>

<body class="bg-white">
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-black rounded-pill px-3 py-2 my-3">
        <!-- Logo -->
        <a class="navbar-brand ms-3" href="lista-libros.php">
            <!-- Logo image -->
            <img src="ASSETS/logo.svg" alt="Logo" width="150" />
        </a>

        <!-- Phone view hamburger button -->
        <button class="navbar-toggler border-0 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Menú">
            <i class="fas fa-bars"></i>
            <i class="fas fa-times d-none"></i>
        </button>

        <!-- Phone view responsive menu -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <!-- Genres dropdown -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <!-- Title -->
                    <a class="nav-link dropdown-toggle text-white" href="lista-libros.php" role="button" data-bs-toggle="dropdown">
                        Xéneros
                    </a>
                    <!-- Options -->
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php
                        // For loop where that goes through the array that contains the result of the query defined
                        for ($i = 0; $row = mysqli_fetch_array($resultnavbar, MYSQLI_ASSOC); $i++) {
                            // Returns the nome field of all the records in the xenero table following the style of the page
                            echo '<li><a class="dropdown-item" href="lista-libros.php">' . $row['nome'] . '</a></li>';
                        }
                        ?>
                    </ul>
                </li>
            </ul>
            <!-- Search area -->
            <form class="d-flex position-relative my-2 my-md-0">
                <!-- Search form -->
                <input class="form-control border-0 rounded-pill ps-4 pe-5 search-desktop-md" type="search" placeholder="Título, autor, xénero..." aria-label="Buscar" />
                <!-- Magnifying glass icon -->
                <span class="position-absolute end-0 top-50 translate-middle-y me-3 text-black">
                    <i class="fas fa-search"></i>
                </span>
            </form>
        </div>
    </nav>

    <!-- Title and new book button -->
    <div class="d-flex align-items-center justify-content-between mt-4 mb-3">
        <!-- Title -->
        <h1 class="fw-normal" style="font-family:'Switzer',sans-serif;font-size:2.5rem;">Lista de libros</h1>
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
            <tbody>
                <?php
                // Loop through each row in the result set from the table query
                while ($row = mysqli_fetch_array($resultable, MYSQLI_ASSOC)) {
                    echo "<tr>";
                    // Display the ISBN in its table cell
                    echo '<td data-th="ISBN">' . $row['isbn'] . '</td>';
                    // Display the title in its table cell
                    echo '<td data-th="Título">' . $row['titulo'] . '</td>';
                    // Display the author in its table cell
                    echo '<td data-th="Autor">' . $row['autor'] . '</td>';
                    // Display the genre name in its table cell
                    echo '<td data-th="Xénero">' . $row['nome'] . '</td>';
                    // Display the stock in its table cell
                    echo '<td data-th="Stock">' . $row['stock'] . '</td>';
                    // Kebab menu
                    echo '<td class="td-end">
                        <div class="dropdown">
                            <!-- Button that triggers the dropdown menu -->
                            <button class="btn btn-kebab" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- Kebab icon -->
                                <i class="fas fa-ellipsis-v"></i>
                            </button>

                            <!-- Dropdown with the actions -->
                            <ul class="dropdown-menu kebab-dropdown" aria-labelledby="dropdownMenuButton">
                                <!-- Option to update the book (passes ISBN in the URL) -->
                                <li><a class="dropdown-item" href="formulario.php?isbn=' . $row['isbn'] . '">Actualizar</a></li>

                                <!-- Option to delete the book (passes ISBN in the URL) -->
                                <li><a class="dropdown-item text-danger" href="lista-libros.php?isbn=' . $row['isbn'] . '">Eliminar</a></li>

                            </ul>
                        </div>
                        </td>';
                    // End the table row
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bottom book illustration container -->
    <div class="book-illustration-container my-4">
        <!-- Book illustration -->
        <img src="ASSETS/libro.png" alt="Libro" class="img-fluid book-illustration" />
    </div>

    <!-- Footer -->
    <footer class="bg-black text-white fixed-bottom py-3">
        <div class="d-flex justify-content-between align-items-center" style="margin: 0 5%;">
            <!-- Left text -->
            <span>© 2025 Raquel G-L para IAW06</span>
            <!-- Icons on the right -->
            <div class="d-flex gap-3">
                <!-- GitHub -->
                <a href="https://github.com/raquelg-l" class="text-white"><i class="fab fa-github"></i></a>
                <!-- Mail -->
                <a href="mailto:glez.erre@gmail.com" class="text-white"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!--Hamburger to X toggle in phone view -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggler = document.querySelector('.navbar-toggler');
            const iconHamburger = toggler.querySelector('.fa-bars');
            const iconClose = toggler.querySelector('.fa-times');
            const navbarCollapse = document.getElementById('navbarContent');
            navbarCollapse.addEventListener('show.bs.collapse', function() {
                iconHamburger.classList.add('d-none');
                iconClose.classList.remove('d-none');
            });
            navbarCollapse.addEventListener('hide.bs.collapse', function() {
                iconHamburger.classList.remove('d-none');
                iconClose.classList.add('d-none');
            });
        });
    </script>
</body>

</html>