<fieldset>
    <legend>Nueva Entrada de Blog</legend>

    <label for="titulo">Titulo:</label>
    <input data-cy="input-titulo" type="text" id="titulo" name="entrada[titulo]" placeholder="Titulo del Post" value="<?php echo sane( $entrada->titulo ); ?>" >

    <label for="summary">Resumen:</label>
    <input data-cy="input-resumen" type="text" id="summary" name="entrada[summary]" placeholder="Resumen del Post" value="<?php echo sane( $entrada->summary ); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg image/png" name="entrada[imagen]">
    <?php if($entrada->imagen):?>
        <img src="/public/imagenes-blog/<?php echo $entrada->imagen?>" class="imagen-small" alt="<?php echo "Imagen de ".$entrada->titulo?>">
    <?php endif;?>
    
    <label for="contenido">Contenido de la Entrada:</label>
    <textarea data-cy="input-contenido" name="entrada[contenido]" id="contenido" cols="30" rows="10"><?php echo sane($entrada->contenido);?></textarea>

    <label for="autor">Autor:</label>
    <input data-cy="input-autor" type="text" name="entrada[autor]" id="autor" placeholder="¿Quién escribió el blog?" value="<?php echo sane( $entrada->autor )?>">
</fieldset>