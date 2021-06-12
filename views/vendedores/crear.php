<main class="contenedor seccion">
        <h1 data-cy="heading-crear-vendedor">Registrar Vendedor(a)</h1>

        <a href="../admin" class="boton boton-verde">&larr; Volver</a>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form data-cy="form-vendedor" action="/public/vendedores/crear" class="formulario" method="POST">
        <?php include __DIR__.'/formulario.php'; ?>
            <div class="alinear-derecha">
                <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
            </div>
        </form>
    </main>