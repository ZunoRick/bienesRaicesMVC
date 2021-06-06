<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad): ?>
    <div class="anuncio" data-cy="anuncio">
        <img src="/public/imagenes/<?php echo $propiedad->imagen; ?>" alt="Anuncio" loading="lazy">

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo; ?></h3>
            <p><?php echo $propiedad->descripcion; ?></p>
            <p class="precio">$<?php echo $propiedad->precio; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img src="/public/build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img src="/public/build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" loading="lazy">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img src="/public/build/img/icono_dormitorio.svg" alt="Icono habitaciones" loading="lazy">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>
            <a data-cy="enlace-propiedad" href="/public/propiedad?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver Propiedad</a>
        </div><!--.contenido-anuncio-->
    </div><!--.anuncio-->
    <?php endforeach; ?>
</div><!--.contenedor-anuncios-->