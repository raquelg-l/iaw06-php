<!--                        
╭──────────────────╮
│ FEITO POR RAQUEL │
╰──────────────────╯
-->

<?php
// CONNECTION
// Database variables
$host = "localhost";
$user = "root";
$pwd = "abc123.";
$db = "raquel_gonzalez_bd";
$tablebooks = "libros";
$tablegenre = "xenero";

// Variable to store errors
$msg = "";

try {
    // Connect to the database
    $connection = mysqli_connect($host, $user, $pwd, $db);

    // Variables to store the info of the book that is going to be updated
    $isbn_update = "";
    $title_update = "";
    $author_update = "";
    $genre_update = "";
    $stock_update = "";

    // If there's an ISBN present in the url
    if (isset($_GET['isbn'])) {
        // Store the ISBN value in this variable
        $isbn_update = $_GET['isbn'];

        // Query to retrieve the info of the book that is going to be updated
        $booktoupdate = "SELECT $tablebooks.*, $tablegenre.nome
                         FROM $tablebooks 
                         JOIN $tablegenre ON $tablebooks.xenero_id = $tablegenre.id
                         WHERE isbn = '$isbn_update'";

        // Execution of the query
        $result_update = mysqli_query($connection, $booktoupdate);

        // If there's at least one result and one row on the result
        if ($result_update && mysqli_num_rows($result_update) > 0) {
            // Make the result an associative array and store it in the variable
            $booktoupdate_info = mysqli_fetch_assoc($result_update);
            // Making the associative array's values more accesible
            $title_update = $booktoupdate_info['titulo'];
            $author_update = $booktoupdate_info['autor'];
            $genre_update = $booktoupdate_info['nome'];
            $stock_update = $booktoupdate_info['stock'];
        }
    }

    // Process the form only if it was submitted via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Rename the form items to something more manageable (also avoid potential SQL injections)
        $isbn = mysqli_real_escape_string($connection, $_POST['isbn']);
        $title = mysqli_real_escape_string($connection, $_POST['titulo']);
        $author = mysqli_real_escape_string($connection, $_POST['autor']);
        $genre_name = mysqli_real_escape_string($connection, $_POST['xenero']);
        $stock = intval($_POST['stock']);

        // Get the genre id from its name in xenero table
        $sql_genre = "SELECT id FROM $tablegenre WHERE nome = '$genre_name'";
        $result_genre = mysqli_query($connection, $sql_genre);

        // If there's at least 1 result
        if ($result_genre && mysqli_num_rows($result_genre) > 0) {
            // Obtain genre id
            $row_genre = mysqli_fetch_assoc($result_genre);
            $genre_id = $row_genre['id'];

            // If isbn_update is not empty
            if (!empty($_POST['isbn_update'])) {
                // Update the book in the database
                $sql_update = "UPDATE $tablebooks 
                               SET titulo='$title', autor='$author', xenero_id=$genre_id, stock=$stock WHERE isbn='$isbn'";
                // If the update takes place
                if (mysqli_query($connection, $sql_update)) {
                    // Redirect to the main page with a confirmation
                    header("Location: lista-libros.php?update=ok");
                    // Stop the script
                    exit();
                    // If the deletion query is not executed
                } else {
                    // Show this
                    $msg = "Error actualizando o libro.";
                }
                // If isbn_update is empty and the user is adding a new book
            } else {
                // Query to insert the new book
                $sql_insert = "INSERT INTO $tablebooks (isbn, titulo, autor, xenero_id, stock) VALUES ('$isbn', '$title', '$author', $genre_id, $stock)";

                // If the insertion of the new book takes place
                if (mysqli_query($connection, $sql_insert)) {
                    // Redirect to the main page with a confirmation
                    header("Location: lista-libros.php?insert=ok");
                    // Stop the script
                    exit();
                    // If the insertion of the new book doesn't take place
                } else {
                    // Show this
                    $msg = "Error engadindo o libro.";
                }
            }
            // If there's no result
        } else {
            // Show this
            $msg = "Xénero non atopado.";
        }
    }

    // Query to retrieve nome from xenero
    $select = "SELECT nome FROM $tablegenre";
    // Execute the query for the navbar
    $resultnavbar = mysqli_query($connection, $select);
    // Execute the query for the form
    $resultform = mysqli_query($connection, $select);

    // CLOSE CONNECTION
    mysqli_close($connection);
} catch (Exception $e) {
    $msg = "Connection error: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="gl">

<head>
    <!-- Base metadata -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Page title -->
    <title>Engadir novo libro</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
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

    <!-- Form container -->
    <div class="container d-flex align-items-center justify-content-center p-0">
        <!-- Card -->
        <div class="card shadow-sm border-0 w-100 form-add-book-bg" style="max-width: 950px; border-radius: 1.5rem;">
            <div class="row g-0">
                <!-- Left column -->
                <div class="col-md-5 d-flex flex-column align-items-center justify-content-center py-md-4">
                    <!-- Book animated illustration -->
                    <img src="ASSETS/novo-libro.gif" alt="Novo Libro" class="img-fluid illustration-phone">
                </div>

                <!-- Right column -->
                <div class="col-md-7">
                    <!-- Card -->
                    <div class="card-body p-3 p-md-4">
                        <!-- Title -->
                        <h1 class="fw-normal mb-4">Engadir novo libro</h1>
                        <!-- If the variable $msg is not empty -->
                        <?php if (!empty($msg)): ?>
                            <!-- Show this -->
                            <div class="alert alert-danger">
                                <?php echo $msg; ?></div>
                        <?php endif; ?>

                        <!-- Form -->
                        <form method="POST" action="formulario.php">
                            <!-- Hidden input field to know what book is being updated if there's an ISBN in the url -->
                            <input type="hidden" name="isbn_update" value="<?php echo htmlspecialchars($isbn_update); ?>">
                            <!-- ISBN -->
                            <div class="mb-4">
                                <!-- Label -->
                                <label for="isbn" class="form-label fw-normal" style="color: #8E8E93">ISBN</label>
                                <!-- Answer area that prefills the form if there's an ISBN in the url with "value" -->
                                <input type="text" class="form-control rounded-pill" id="isbn" name="isbn" placeholder="Introduce o ISBN" required value="<?php echo htmlspecialchars($isbn_update); ?>" <?php if ($isbn_update); ?>>
                            </div>
                            <!-- Title -->
                            <div class="mb-4">
                                <!-- Label -->
                                <label for="titulo" class="form-label fw-normal" style="color: #8E8E93">Título</label>
                                <!-- Answer area that prefills the form if there's an ISBN in the url with "value" -->
                                <input type="text" class="form-control rounded-pill" id="titulo" name="titulo" placeholder="Introduce o título" required value="<?php echo htmlspecialchars($title_update); ?>">
                            </div>
                            <!-- Autor -->
                            <div class="mb-4">
                                <!-- Label -->
                                <label for="autor" class="form-label fw-normal" style="color: #8E8E93">Autor</label>
                                <!-- Answer area that prefills the form if there's an ISBN in the url with "value" -->
                                <input type="text" class="form-control rounded-pill" id="autor" name="autor" placeholder="Introduce o autor" required value="<?php echo htmlspecialchars($author_update); ?>">
                            </div>

                            <div class="d-flex gap-3 align-items-end mb-5">
                                <!-- Genre selection dropdown -->
                                <div class="flex-fill">
                                    <!-- Dropdown label -->
                                    <label for="xenero" class="form-label fw-normal" style="color: #8E8E93">Xénero</label>
                                    <!-- Genre selection dropdown -->
                                    <select id="xenero" class="form-select rounded-pill" name="xenero" required>
                                        <!-- The default behaviour with a title disabled option as placeholder -->
                                        <option value="" disabled selected>Selecciona un xénero</option>

                                        <?php
                                        // While there are genres in the result set, create an option for each one
                                        while ($row = mysqli_fetch_assoc($resultform)) {
                                            // If the genre name matches the genre of the book being edited, mark it as selected
                                            $selected = ($row['nome'] == $genre_update) ? 'selected' : '';
                                            // Output the option element for the dropdown, displaying the genre name
                                            echo '<option value="' . htmlspecialchars($row['nome']) . '" ' . $selected . '>' . htmlspecialchars($row['nome']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- Stock -->
                                <div style="max-width: 140px;">
                                    <!-- Label -->
                                    <label for="stock" class="form-label fw-normal" style="color: #8E8E93">Stock</label>
                                    <!-- Answer area that prefills the form if there's an ISBN in the url with "value" -->
                                    <input type="number" class="form-control rounded-pill" id="stock" name="stock" placeholder="Ex. 10" min="0" required value="<?php echo htmlspecialchars($stock_update); ?>">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="form-actions mt-3">
                                <!-- Add -->
                                <button type="submit" class="btn btn-info text-white rounded-pill px-4">Engadir</button>
                                <!-- Cancel -->
                                <a href="lista-libros.php" class="btn btn-outline-info rounded-pill px-4 hover-outline" style="color: #32ADE6;">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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