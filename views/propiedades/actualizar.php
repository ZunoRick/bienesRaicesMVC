<main class="contenedor seccion">
    <h1 data-cy="heading-actualizar-propiedad">Actualizar Propiedad</h1>

    <a href="../admin" class="boton boton-verde">&larr; Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form data-cy="form-actualizar-propiedad" class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__.'/formulario.php'; ?>
        <div class="alinear-derecha">
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </div>
    </form>
</main>