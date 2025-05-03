<!--                        
╭──────────────────╮
│ FEITO POR RAQUEL │
╰──────────────────╯
-->

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
    <div class="collapse navbar-collapse justify-content-end gap-3" id="navbarContent">
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