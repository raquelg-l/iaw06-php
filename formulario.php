<!--                        
╭──────────────────╮
│ FEITO POR RAQUEL │
╰──────────────────╯
-->

<?php
include_once ('PHP/conexion_bd.php');
include_once ('PHP/funcions-crud.php');

try {
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

        // Retrieve the info of the book that is going to be updated function
        $booktoupdate = getbook($isbn_update);

        // If there's at least one result and one row on the result
        if ($booktoupdate && mysqli_num_rows($booktoupdate) > 0) {
            // Make the result an associative array and store it in the variable
            $booktoupdate_info = mysqli_fetch_assoc($booktoupdate);
            // Making the associative array's values more accesible
            $title_update = $booktoupdate_info['titulo'];
            $author_update = $booktoupdate_info['autor'];
            $genre_update = $booktoupdate_info['nome'];
            $stock_update = $booktoupdate_info['stock'];
        }
    }

    // Process the form only if it was submitted via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Rename the form items to something more manageable and avoid potential SQL inyections
        $isbn = mysqli_real_escape_string($connection, $_POST['isbn']);
        $title = mysqli_real_escape_string($connection, $_POST['titulo']);
        $author = mysqli_real_escape_string($connection, $_POST['autor']);
        $genre_name = mysqli_real_escape_string($connection, $_POST['xenero']);
        $stock = intval($_POST['stock']);

        // Get the genre id from its name function
        $result_genre = getgenreid($genre_name);

        // If there's at least 1 result
        if ($result_genre && mysqli_num_rows($result_genre) > 0) {
            // Obtain genre id
            $row_genre = mysqli_fetch_assoc($result_genre);
            $genre_id = $row_genre['id'];

            // If isbn_update is not empty
            if (!empty($_POST['isbn_update'])) {
                // Update the book function
                updatebook($isbn, $title, $author, $genre_id, $stock);

            // If isbn_update is empty and the user is adding a new book
            } else {
                // Insert new book function
                addbook($isbn, $title, $author, $genre_id, $stock);
            }
        // If there's no result
        } else {
            // Show this
            return "Xénero non atopado.";
        }
    }

    // Obtain genres for the navbar function
    $resultnavbar = getgenrenames();
    // Obtain genres for the form function
    $resultform = getgenrenames();

} catch (Exception $e) {
    return "Error de conexión: " . $e->getMessage();
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
    <link rel="stylesheet" href="css/estilo.css" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="ASSETS/icon.svg">
</head>

<body class="bg-white">
    <!-- Navigation bar -->
    <?php include 'PHP/navbar.php'; ?>

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
    <?php include 'PHP/footer.php'; ?>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS for hamburger to X toggle in phone view -->
    <script src="js/navbar-toggle.js"></script>

</body>

</html>