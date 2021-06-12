<main class="contenedor seccion contenido-centrado">

    <?php if ($auth) {?>
        <div data-cy="elements-admin" class="elements-admin">
            <a href="/public/admin" class="boton boton-verde">&larr; Volver</a>
            <p>Venta a cargo de: <?php echo $vendedor->nombre . " ". $vendedor->apellido;?> </p>
            <a data-cy="btn-actualizar-propiedad" href="/public/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo"><img src="/public/build/img/edit.svg" class="icono-boton editar">Actualizar</a>
        </div>
    <?php } ?>

    <h1 data-cy="titulo-propiedad"><?php echo $propiedad->titulo; ?></h1>
    <img src="/public/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen de la Propiedad" loading="lazy">
    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad->precio; ?></p>

        <ul class="iconos-caracteristicas">
            <li>
                <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
                <p>$<?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" loading="lazy">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img src="build/img/icono_dormitorio.svg" alt="Icono habitaciones" loading="lazy">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>
        <p><?php echo $propiedad->descripcion; ?></p>
    </div>
</main>