<!DOCTYPE html>
<html lang="gl">

<head>
    <!-- Metadatos base -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Título da páxina -->
    <title>Libros & co.</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="estilo.css" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="ASSETS/icon.svg">
</head>

<body class="bg-white">
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-md navbar-dark bg-black rounded-pill px-3 py-2 my-3">
        <!-- Logo -->
        <a class="navbar-brand ms-3" href="lista-libros.php">
            <img src="ASSETS/logo.svg" alt="Logo" width="150" />
        </a>

        <!-- Botón hamburguesa vista móbil -->
        <button class="navbar-toggler border-0 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Menú">
            <i class="fas fa-bars"></i>
            <i class="fas fa-times d-none"></i>
        </button>

        <!-- Menú responsive vista móbil -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <!-- Dropdown xéneros -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <!-- Título -->
                    <a class="nav-link dropdown-toggle text-white" href="lista-libros.php" role="button" data-bs-toggle="dropdown">
                        Xéneros
                    </a>
                    <!-- Opcións -->
                    <ul class="dropdown-menu dropdown-menu-end">
                        <!-- Ciencia ficción -->
                        <li><a class="dropdown-item" href="lista-libros.php?genero=ciencia-ficcion">Ciencia ficción</a></li>
                        <!-- Acción -->
                        <li><a class="dropdown-item" href="lista-libros.php?genero=accion">Acción</a></li>
                        <!-- Drama -->
                        <li><a class="dropdown-item" href="lista-libros.php?genero=drama">Drama</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Zona de busca -->
            <form class="d-flex position-relative my-2 my-md-0">
                <!-- Formulario busca -->
                <input class="form-control border-0 rounded-pill ps-4 pe-5 search-desktop-md" type="search" placeholder="Título, autor, xénero..." aria-label="Buscar" />
                <!-- Icona da lupa -->
                <span class="position-absolute end-0 top-50 translate-middle-y me-3 text-black">
                    <i class="fas fa-search"></i>
                </span>
            </form>
        </div>
    </nav>

    <!-- Título e botón de engadir -->
    <div class="d-flex align-items-center justify-content-between mt-4 mb-3">
        <!-- Título -->
        <h1 class="fw-normal" style="font-family:'Switzer',sans-serif;font-size:2.5rem;">Lista de libros</h1>
        <!-- Botón de engadir -->
        <button class="btn btn-info text-white rounded-pill d-flex align-items-center px-4 py-2">
            <i class="fas fa-plus me-2"></i>
            <span class="d-none d-sm-inline" onclick="document.location='formulario.php'">Engadir novo</span>
        </button>
    </div>

    <!-- Container da táboa -->
    <div class="table-responsive">
        <!-- Táboa -->
        <table class="table table-bordered text-center align-middle mobile-optimised">
            <!-- Cabeceira -->
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Título</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Xénero</th>
                    <th scope="col">Stock</th>
                </tr>
            </thead>
            <!-- Corpo -->
            <tbody>
                <!-- Libro 1 -->
                <tr>
                    <td data-th="ID">1</td>
                    <td data-th="Título">Tomie</td>
                    <td data-th="Autor">Junji Ito</td>
                    <td data-th="Xénero">Horror</td>
                    <td data-th="Stock">15</td>
                </tr>
                <!-- Libro 2 -->
                <tr>
                    <td data-th="ID">2</td>
                    <td data-th="Título">La hija del clérigo</td>
                    <td data-th="Autor">George Orwell</td>
                    <td data-th="Xénero">Ficción</td>
                    <td data-th="Stock">30</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Imaxe do libro -->
    <div class="book-illustration-container my-4">
        <img src="ASSETS/libro.png" alt="Libro" class="img-fluid book-illustration" />
    </div>

    <!-- Footer -->
    <footer class="bg-black text-white fixed-bottom py-3">
        <div class="d-flex justify-content-between align-items-center" style="margin: 0 5%;">
            <!-- Texto esquerda -->
            <span>© 2025 Raquel G-L para IAW06</span>
            <!-- Iconas -->
            <div class="d-flex gap-3">
                <!-- Icona Github -->
                <a href="#" class="text-white"><i class="fab fa-github"></i></a>
                <!-- Icona mail -->
                <a href="#" class="text-white"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para o cambio de hamburguesa a X no menú en vista móbil -->
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