<?php 
    if (!isset($_SESSION)) {
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;

    if (!isset($inicio)) {
        $inicio = false;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    
    <link rel="stylesheet" href="/public/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/public/">
                    <img src="/public/build/img/logo.svg" alt="Logotipo de Bienes Raíces">
                </a>

                <div class="mobile-menu">
                    <img src="/public/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img src="/public/build/img/dark-mode.svg" alt="" class="dark-mode-boton">

                    <nav class="navegacion" data-cy="navegacion-header">
                        <a href="/public/nosotros">Nosotros</a>
                        <a href="/public/propiedades">Propiedades</a>
                        <a href="/public/blog">Blog</a>
                        <a href="/public/contacto">Contacto</a>
                        <?php if ($auth): ?>
                            <a data-cy="cierre-sesion" href="/public/logout">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div> <!--.barra-->

            <?php echo  $inicio  ? "<h1 data-cy='heading-sitio'>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : ''; ?>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion" data-cy="navegacion-footer">
                <a href="/public/nosotros">Nosotros</a>
                <a href="/public/propiedades">Propiedades</a>
                <a href="/public/blog">Blog</a>
                <a href="/public/contacto">Contacto</a>
            </nav>
        </div>

        <p data-cy="copyright" class="copyright">Todos los derechos Reservados <?php echo date('Y'); ?> &copy;</p>
    </footer>
    <script src="/public/build/js/bundle.min.js"></script>
</body>
</html>