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
    <link rel="stylesheet" href="estilo.css" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="ASSETS/icon.svg">
</head>


<body class="bg-white">
    <?php
    // Array para a checklist
    $checklist = [];

    // CONEXIÓN
    // Variables da base de datos
    $host = "localhost";
    $user = "root";
    $pwd = "abc123.";
    $db = "raquel_gonzalez_bd";
    $tablebooks = "libros";
    $tablegenre = "xenero";

    // Compilación de erros
    try {
        // Conexión
        $connection = mysqli_connect($host, $user, $pwd);
        if (!$connection) {
            throw new Exception("Conexión fallida: " . mysqli_connect_error());
        }
        $checklist[] = ["Conexión exitosa", true];

        // Crear a base de datos só se non existe
        $createdb = "CREATE DATABASE IF NOT EXISTS $db";
        if (mysqli_query($connection, $createdb)) {
            $checklist[] = ["Creouse a base de datos se non existía xa", true];
        } else {
            $checklist[] = ["Erro ao crear a base de datos", false];
        }

        // Seleccionar a base de datos creada
        if (mysqli_select_db($connection, $db)) {
            $checklist[] = ["Seleccionouse a base de datos", true];
        } else {
            $checklist[] = ["Erro ao seleccionar a base de datos", false];
        }

        // ESTRUTURA DAS TÁBOAS
        // Eliminar táboas se existen
        $droptables1 = "DROP TABLE IF EXISTS $tablebooks";
        $droptables2 = "DROP TABLE IF EXISTS $tablegenre";
        $okDrop1 = mysqli_query($connection, $droptables1);
        $okDrop2 = mysqli_query($connection, $droptables2);
        if ($okDrop1 && $okDrop2) {
            $checklist[] = ["Elimináronse as táboas existentes", true];
        } else {
            $checklist[] = ["Erro ao eliminar as táboas existentes", false];
        }

        // Crear a táboa XENERO
        $createtablegenre = "CREATE TABLE $tablegenre (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(50) NOT NULL
        ) ENGINE=InnoDB";
        if (mysqli_query($connection, $createtablegenre)) {
            $checklist[] = ["Creouse a táboa xenero", true];
        } else {
            $checklist[] = ["Erro ao crear a táboa xenero", false];
        }

        // Crear a táboa LIBROS
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

        // INSERCIÓN DE DATOS
        // Inserción de datos na táboa XENERO
        $insertGenre = "INSERT INTO $tablegenre (nome)
                        VALUES ('Horror'), ('Ficción'), ('Ciencia Ficción'), ('Acción'), ('Drama')";
        if (mysqli_query($connection, $insertGenre)) {
            $checklist[] = ["Inseríronse os datos na táboa xenero", true];
        } else {
            $checklist[] = ["Erro ao inserir datos en xenero", false];
        }

        // Inserción de datos na táboa LIBROS
        $insertBooks = "INSERT INTO $tablebooks (isbn, titulo, autor, xenero_id, stock)
                        VALUES 
                        ('9781421590561', 'Tomie', 'Junji Ito', 1, 15), 
                        ('9786073135498', 'La hija del clérigo', 'George Orwell', 2, 30)";
        if (mysqli_query($connection, $insertBooks)) {
            $checklist[] = ["Inseríronse os datos na táboa libros", true];
        } else {
            $checklist[] = ["Erro ao inserir datos en libros", false];
        }

        // COMPROBACIÓN DE QUE SE EXECUTOU CORRECTAMENTE
        $allOk = true;
        foreach ($checklist as $item) {
            if (!$item[1]) $allOk = false;
        }
        if ($allOk) {
            $checklist[] = ["Base de datos e táboas creadas correctamente", true];
        } else {
            $checklist[] = ["Houbo erros na execución dalgún paso", false];
        }

        // PECHE DE CONEXIÓN
        mysqli_close($connection);
    } catch (Exception $e) {
        $checklist[] = ["Erro na conexión: " . $e->getMessage(), false];
    }
    ?>

    <!-- Checklist visual -->
    <div class="container my-5" style="max-width: 70%;">
        <!-- Título -->
        <h1 class="fw-normal" style="font-family:'Switzer',sans-serif; font-size: 2.5rem; margin-left: 1%; margin-bottom: 2rem;">
            Comprobacións de execución
        </h1>

        <!-- Táboa -->
        <div class="table-responsive">
            <table class="table table-bordered text-start align-middle mobile-optimised" style="width: 98%; margin-left: 1%; mb-2">
                <tbody>
                    <?php
                    // Recorrer o array CHECKLIST
                    foreach ($checklist as $item) {
                        // Por cada item do array crea unha fila
                        echo '<tr>';
                        // Se a comprobación foi ben mostra isto
                        if ($item[1]) {
                            echo '<td style="font-family:\'Switzer\',sans-serif; vertical-align: middle;">
                            <i class="fas fa-check-circle text-success" style="font-size:1.3rem; margin-right: 28px;"></i>' . $item[0] . '
                          </td>';
                            // Se a comprobación falla mostra isto
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

    <!-- Footer -->
    <footer class="bg-black text-white fixed-bottom py-3">
        <div class="d-flex justify-content-between align-items-center" style="margin: 0 5%;">
            <!-- Texto esquerda -->
            <span>© 2025 Raquel G-L para IAW06</span>
            <!-- Iconas -->
            <div class="d-flex gap-3">
                <!-- GitHub -->
                <a href="https://github.com/raquelg-l" class="text-white"><i class="fab fa-github"></i></a>
                <!-- Mail -->
                <a href="mailto:glez.erre@gmail.com" class="text-white"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>