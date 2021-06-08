<article class="entrada-blog">
    <?php foreach ($entradas as $entrada) { ?>
        <div class="imagen">
            <img src="/public/imagenes-blog/<?php echo $entrada->imagen; ?>" alt="Texto Entrada Blog" loading="lazy">
        </div>

        <div class="texto-entrada">
            <a href="/public/entrada?id=<?php echo $entrada->id;?>">
                <h4><?php echo $entrada->titulo;?></h4>
                <p class="informacion-meta">Escrito el: <span><?php echo $entrada->fecha;?></span> por: <span><?php echo $entrada->autor;?></span> </p>
                <p><?php echo $entrada->summary;?></p>
            </a>
        </div>
    <?php } ?>
</article>