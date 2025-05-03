<!--                        
╭──────────────────╮
│ FEITO POR RAQUEL │
╰──────────────────╯
-->

<!DOCTYPE html>
<html lang="gl">

<head>
    <!-- Base metadata -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Page title -->
    <title>Base de datos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="CSS/estilo.css" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="ASSETS/icon.svg">
</head>


<body class="bg-white">
    <?php
    // Array for the checklist
    $checklist = [];

    // CONNECTION
    // Database variables
    $host = "localhost";
    $user = "root";
    $pwd = "abc123.";
    $db = "raquel_gonzalez_bd";
    $tablebooks = "libros";
    $tablegenre = "xenero";

    // Error compilation
    try {
        // Connection
        $connection = mysqli_connect($host, $user, $pwd);
        if (!$connection) {
            throw new Exception("Conexión fallida: " . mysqli_connect_error());
        }
        $checklist[] = ["Conexión exitosa", true];

        // Create the database only if it does not exist
        $createdb = "CREATE DATABASE IF NOT EXISTS $db";
        if (mysqli_query($connection, $createdb)) {
            $checklist[] = ["Creouse a base de datos se non existía xa", true];
        } else {
            $checklist[] = ["Erro ao crear a base de datos", false];
        }

        // Select the created database
        if (mysqli_select_db($connection, $db)) {
            $checklist[] = ["Seleccionouse a base de datos", true];
        } else {
            $checklist[] = ["Erro ao seleccionar a base de datos", false];
        }

        // TABLE STRUCTURE
        // Drop tables if they exist
        $droptables1 = "DROP TABLE IF EXISTS $tablebooks";
        $droptables2 = "DROP TABLE IF EXISTS $tablegenre";
        $okDrop1 = mysqli_query($connection, $droptables1);
        $okDrop2 = mysqli_query($connection, $droptables2);
        if ($okDrop1 && $okDrop2) {
            $checklist[] = ["Elimináronse as táboas existentes", true];
        } else {
            $checklist[] = ["Erro ao eliminar as táboas existentes", false];
        }

        // Create the XENERO table
        $createtablegenre = "CREATE TABLE $tablegenre (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(50) NOT NULL
        ) ENGINE=InnoDB";
        if (mysqli_query($connection, $createtablegenre)) {
            $checklist[] = ["Creouse a táboa xenero", true];
        } else {
            $checklist[] = ["Erro ao crear a táboa xenero", false];
        }

        // Create the LIBROS table
        $createtablebooks = "CREATE TABLE $tablebooks (
            isbn VARCHAR(13) PRIMARY KEY,
            titulo VARCHAR(100) NOT NULL,
            autor VARCHAR(100) NOT NULL,
            xenero_id INT NOT NULL,
            stock INT NOT NULL,
            FOREIGN KEY (xenero_id) REFERENCES $tablegenre(id)
        ) ENGINE=InnoDB";
        if (mysqli_query($connection, $createtablebooks)) {
            $checklist[] = ["Creouse a táboa libros", true];
        } else {
            $checklist[] = ["Erro ao crear a táboa libros", false];
        }

        // DATA INSERTION
        // Insert data into the XENERO table
        $insertGenre = "INSERT INTO $tablegenre (nome)
                        VALUES ('Horror'), ('Ficción'), ('Ciencia Ficción'), ('Acción'), ('Drama')";
        if (mysqli_query($connection, $insertGenre)) {
            $checklist[] = ["Inseríronse os datos na táboa xenero", true];
        } else {
            $checklist[] = ["Erro ao inserir datos en xenero", false];
        }

        // Insert data into the LIBROS table
        $insertbooks = "INSERT INTO $tablebooks (isbn, titulo, autor, xenero_id, stock)
                        VALUES 
                        ('9781421590561', 'Tomie', 'Junji Ito', 1, 15), 
                        ('9786073135498', 'La hija del clérigo', 'George Orwell', 2, 30)";
        if (mysqli_query($connection, $insertbooks)) {
            $checklist[] = ["Inseríronse os datos na táboa libros", true];
        } else {
            $checklist[] = ["Erro ao inserir datos en libros", false];
        }

        // CHECK THAT EVERYTHING WORKED NICELY
        $allworked = true;
        foreach ($checklist as $item) {
            if (!$item[1]) $allworked = false;
        }
        if ($allworked) {
            $checklist[] = ["Base de datos e táboas creadas correctamente", true];
        } else {
            $checklist[] = ["Houbo erros na execución dalgún paso", false];
        }

        // CLOSE CONNECTION
        mysqli_close($connection);
    } catch (Exception $e) {
        $checklist[] = ["Erro na conexión: " . $e->getMessage(), false];
    }
    ?>

    <!-- Visual checklist -->
    <div class="container my-5" style="max-width: 70%;">
        <!-- Title -->
        <h1 class="fw-normal" style="font-family:'Switzer',sans-serif; font-size: 2.5rem; margin-left: 1%; margin-bottom: 2rem;">
            Comprobacións de execución
        </h1>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered text-start align-middle mobile-optimised" style="width: 98%; margin-left: 1%; margin-bottom: 1.5rem;">
                <tbody>
                    <?php
                    // Loop through the CHECKLIST array
                    foreach ($checklist as $item) {
                        // Create a row for each item in the array
                        echo '<tr>';
                        // If the check was successful, show this
                        if ($item[1]) {
                            echo '<td style="font-family:\'Switzer\',sans-serif; vertical-align: middle;">
                            <i class="fas fa-check-circle text-success" style="font-size:1.3rem; margin-right: 28px;"></i>' . $item[0] . '
                          </td>';
                            // If the check failed, show this other thing
                        } else {
                            echo '<td style="font-family:\'Switzer\',sans-serif; vertical-align: middle;">
                            <i class="fas fa-times-circle text-danger" style="font-size:1.3rem; margin-right: 28px;"></i>' . $item[0] . '
                          </td>';
                        }
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>