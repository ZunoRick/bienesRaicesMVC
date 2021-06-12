<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input data-cy="input-nombre" type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre Vendedor(a)" value="<?php echo sane( $vendedor->nombre ); ?>" >

    <label for="apellido">Apellido:</label>
    <input data-cy="input-apellido" type="text" id="apellido" name="vendedor[apellido]" placeholder="Appelido Vendedor(a)" value="<?php echo sane( $vendedor->apellido ); ?>" >

</fieldset>

<fieldset>
    <legend>Información Extra</legend>
    <label for="telefono">Teléfono:</label>
    <input data-cy="input-telefono" type="text" id="telefono" name="vendedor[telefono]" placeholder="Teléfono" value="<?php echo sane( $vendedor->telefono ); ?>" >

    <label for="email">Correo:</label>
    <input data-cy="input-correo" type="email" id="email" name="vendedor[email]" placeholder="Correo" value="<?php echo sane( $vendedor->email ); ?>" >
</fieldset>