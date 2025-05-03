<!--                        
╭──────────────────╮
│ FEITO POR RAQUEL │
╰──────────────────╯
-->

<?php
include_once ('PHP/conexion_bd.php');
// include ('PHP/navbar.php');
include_once ('PHP/funcions-crud.php');

// Run the code inside
try {
    // If there's an ISBN present in the url
    if (isset($_GET['isbn'])) {
        // Store the ISBN value in this variable
        $isbn_delete = $_GET['isbn'];

        // Deletion function
        $delete_book = deletebook($isbn_delete);
    }

    // Obtain genres for the navbar function
    $resultnavbar = getgenrenames();

    // Obtain books for the table function
    $resultable = getallbooks();

// Catch anything that failed in the try block
} catch (Exception $e) {
    // Show what failed
    return "Erro na conexión: " . $e->getMessage();
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
    <link rel="stylesheet" href="css/estilo.css" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="ASSETS/icon.svg">
</head>

<body class="bg-white">
    <!-- Navigation bar -->
    <?php include 'PHP/navbar.php'; ?>

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
    <?php include 'PHP/footer.php'; ?>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS for hamburger to X toggle in phone view -->
    <script src="js/navbar-toggle.js"></script>
</body>

</html>