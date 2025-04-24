<!DOCTYPE html>
<html lang="gl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros & co.</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="estilo.css">
</head>

<body class="bg-white">

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-md  navbar-dark bg-black rounded-pill px-3 py-2 my-3">
        <a class="navbar-brand ms-3" href="#">
            <img src="ASSETS/logo.svg" alt="Logo" width="170">
        </a>
        <button class="navbar-toggler border-0 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Menú">
            <i class="fas fa-bars"></i>
            <i class="fas fa-times d-none"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <form class="d-flex position-relative my-2 my-md-0">
                <input class="form-control border-0 rounded-pill ps-4 pe-5 search-desktop-md" type="search" placeholder="Título, autor, xénero..." aria-label="Buscar">
                <span class="position-absolute end-0 top-50 translate-middle-y me-3 text-black">
                    <i class="fas fa-search"></i>
                </span>
            </form>

        </div>
    </nav>

    <div class="d-flex align-items-center justify-content-between mt-4 mb-3">
        <h1 class="fw-normal" style="font-family:'Switzer',sans-serif;font-size:2.5rem;">Lista de libros</h1>
        <button class="btn btn-info text-white rounded-pill d-flex align-items-center px-4 py-2">
            <i class="fas fa-plus me-2"></i> <span class="d-none d-sm-inline">Engadir novo</span>
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle mobile-optimised">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Título</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Xénero</th>
                    <th scope="col">Stock</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-th="ID">1</td>
                    <td data-th="Título">Tomie</td>
                    <td data-th="Autor">Junji Ito</td>
                    <td data-th="Xénero">Horror</td>
                    <td data-th="Stock">15</td>
                </tr>
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


    <footer class="bg-black text-white fixed-bottom py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <span>© 2025 Raquel G-L para IAW06</span>
            <div class="d-flex gap-3">
                <a href="#" class="text-white"><i class="fab fa-github"></i></a>
                <a href="#" class="text-white"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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