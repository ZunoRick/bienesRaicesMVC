<main class="contenedor seccion">
    <h1>Actualizar Entrada</h1>

    <a href="/public/admin-blog" class="boton boton-verde">&larr; Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__.'/formulario.php'; ?>
        <div class="alinear-derecha">
            <input type="submit" value="Actualizar Entrada" class="boton boton-verde">
        </div>
    </form>
</main>