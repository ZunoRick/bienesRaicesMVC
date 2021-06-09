<main class="contenedor seccion contenido-centrado">
        <h1><?php echo $entrada->titulo; ?></h1>

        <h4><?php echo $entrada->summary; ?></h4>

        <img src="/public/imagenes-blog/<?php echo $entrada->imagen;?>" alt="Imagen de la Propiedad" loading="lazy">

        <p class="informacion-meta">Escrito el: <span><?php echo $entrada->fecha; ?></span> Por: <span><?php echo $entrada->autor;?></span> </p>

        <div class="resumen-propiedad">
            <p><?php echo $entrada->contenido;?></p>
        </div>
    </main>