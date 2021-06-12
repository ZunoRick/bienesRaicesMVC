<main class="contenedor seccion contenido-centrado">
    <?php if ($auth) { ?>
        <div data-cy="elements-blog-admin" class="elements-admin">
            <a href="/public/admin-blog" class="boton boton-verde">&larr; Volver</a>
            <a data-cy="btn-actualizar-entrada" href="/public/admin-blog/actualizar?id=<?php echo $entrada->id; ?>" class="boton-amarillo"><img src="/public/build/img/edit.svg" class="icono-boton editar">Actualizar</a>
        </div>
    <?php } ?>

    <h1><?php echo $entrada->titulo; ?></h1>

    <h4><?php echo $entrada->summary; ?></h4>

    <img src="/public/imagenes-blog/<?php echo $entrada->imagen; ?>" alt="Imagen de la Propiedad" loading="lazy">

    <p class="informacion-meta">Escrito el: <span><?php echo $entrada->fecha; ?></span> Por: <span><?php echo $entrada->autor; ?></span> </p>

    <div class="resumen-propiedad">
        <p><?php echo $entrada->contenido; ?></p>
    </div>
</main>