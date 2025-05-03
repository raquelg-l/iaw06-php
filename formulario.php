<!--                        
╭──────────────────╮
│ FEITO POR RAQUEL │
╰──────────────────╯
-->

<?php
require_once 'PHP/controlador_formulario.php';
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
    <!-- Switzer font -->
    <link href="https://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
</head>

<body class="bg-white">
    <!-- Navigation bar -->
    <?php include 'PHP/navbar.php'; ?>

    <!-- Form container -->
    <div class="container d-flex align-items-center justify-content-center p-0">
        <!-- Card -->
        <div class="card shadow-sm border-0 w-100 form-add-book-bg">
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
                                <label for="isbn" class="form-label fw-normal">ISBN</label>
                                <!-- Answer area that prefills the form if there's an ISBN in the url with "value" -->
                                <input type="text" class="form-control rounded-pill" id="isbn" name="isbn" placeholder="Introduce o ISBN" required value="<?php echo htmlspecialchars($isbn_update); ?>" <?php if ($isbn_update); ?>>
                            </div>
                            <!-- Title -->
                            <div class="mb-4">
                                <!-- Label -->
                                <label for="titulo" class="form-label fw-normal">Título</label>
                                <!-- Answer area that prefills the form if there's an ISBN in the url with "value" -->
                                <input type="text" class="form-control rounded-pill" id="titulo" name="titulo" placeholder="Introduce o título" required value="<?php echo htmlspecialchars($title_update); ?>">
                            </div>
                            <!-- Autor -->
                            <div class="mb-4">
                                <!-- Label -->
                                <label for="autor" class="form-label fw-normal">Autor</label>
                                <!-- Answer area that prefills the form if there's an ISBN in the url with "value" -->
                                <input type="text" class="form-control rounded-pill" id="autor" name="autor" placeholder="Introduce o autor" required value="<?php echo htmlspecialchars($author_update); ?>">
                            </div>

                            <div class="d-flex gap-3 align-items-end mb-5">
                                <!-- Genre selection dropdown -->
                                <div class="flex-fill">
                                    <!-- Dropdown label -->
                                    <label for="xenero" class="form-label fw-normal">Xénero</label>
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
                                <div class="form-stock-wrapper">
                                    <!-- Label -->
                                    <label for="stock" class="form-label fw-normal">Stock</label>
                                    <!-- Answer area that prefills the form if there's an ISBN in the url with "value" -->
                                    <input type="number" class="form-control rounded-pill" id="stock" name="stock" placeholder="Ex. 10" min="0" required value="<?php echo htmlspecialchars($stock_update); ?>">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="form-actions mt-3">
                                <!-- Add -->
                                <button type="submit" class="btn btn-info text-white rounded-pill px-4">Engadir</button>
                                <!-- Cancel -->
                                <a href="lista-libros.php" class="btn btn-outline-info rounded-pill px-4 hover-outline">Cancelar</a>
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