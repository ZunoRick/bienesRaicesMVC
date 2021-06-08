<main class="contenedor seccion">
    <h1 data-cy="heading-administrador">Administrador de Bienes Raices</h1>

    <a href="/public/admin" class="boton boton-verde">&larr; Volver</a>
    <a href="/public/admin-blog/crear" class="boton boton-amarillo">Nueva Entrada</a>

    <?php
    if ($resultado) {
        $mensaje = mostrarNotificacion(intval($resultado));
        if ($_GET['tipo'] != 'Post') {
            header('Location: /public/admin-blog');
        }
        if ($mensaje && intval($resultado) === 1) { ?>
            <p class="alerta exito"><?php echo "Nuevo Post " . sane($mensaje) ?></p>
        <?php } elseif ($mensaje) { ?>
            <p class="alerta exito"><?php echo "Post " . $urlId . " " . sane($mensaje) ?></p>
    <?php }
    }
    ?>
    
    <h2>Entradas de Blog</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Fecha</th>
                <th>Autor</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!--Mostrar los resultados-->
            <?php foreach ($entradas as $entrada) : ?>
                <tr>
                    <td><?php echo $entrada->id; ?></td>
                    <td><?php echo $entrada->titulo; ?></td>
                    <td><img src="/public/imagenes-blog/<?php echo $entrada->imagen; ?>" class="imagen-tabla" alt=""></td>
                    <td><?php echo $entrada->fecha; ?></td>
                    <td><?php echo $entrada->autor; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/public/admin-blog/eliminar">
                            <input type="hidden" name="id" value="<?php echo $entrada->id; ?>">
                            <input type="hidden" name="tipo" value="post">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <!-- <img src="/build/img/trash-alt.svg" class="icono-boton"> -->

                        </a>
                        <a href="/public/admin-blog/actualizar?id=<?php echo $entrada->id; ?>" class="boton-amarillo-block">
                            <img src="/public/build/img/edit.svg" class="icono-boton editar">
                            Actualizar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>