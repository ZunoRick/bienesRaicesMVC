<main class="contenedor seccion">
        <h1 data-cy="heading-administrador">Administrador de Bienes Raices</h1>

        <?php 
            if ($resultado) {
                $mensaje = mostrarNotificacion( intval($resultado) );
                if ($mensaje && intval($resultado) === 1){ ?>
                    <p class="alerta exito"><?php echo $_GET['tipo']." ".sane($mensaje)?></p>
                <?php } elseif ($mensaje){ ?>
                    <p class="alerta exito"><?php echo $_GET['tipo']." ".$urlId." ".sane($mensaje)?></p>
                <?php }             
            } 
        ?>
        <a href="/public/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/public/vendedores/crear" class="boton boton-amarillo">Nuevo(a) Vendedor</a>
        <a href="/public/admin-blog" class="boton boton-amarillo">Administrar Blog</a>
        <h2>Propiedades</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>  <!--Mostrar los resultados-->
                <?php foreach( $propiedades as $propiedad): ?>
                    <tr>
                        <td><?php echo $propiedad->id; ?></td>
                        <td><?php echo $propiedad->titulo; ?></td>
                        <td><img src="/public/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt=""></td>
                        <td><?php echo "$". $propiedad->precio; ?></td>
                        <td>
                            <form method="POST" class="w-100" action="/public/propiedades/eliminar">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                <input type="hidden" name="tipo" value="propiedad">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <!-- <img src="/build/img/trash-alt.svg" class="icono-boton"> -->
                                
                            </a>
                            <a href="/public/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">
                                <img src="/public/build/img/edit.svg" class="icono-boton editar">
                                Actualizar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>  <!--Mostrar los resultados-->
                <?php foreach( $vendedores as $vendedor): ?>
                    <tr>
                        <td><?php echo $vendedor->id; ?></td>
                        <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                        <td><?php echo $vendedor->telefono; ?></td>
                        <td>
                            <form method="POST" class="w-100" action="/public/vendedores/eliminar">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                <input type="hidden" name="tipo" value="vendedor">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <!-- <img src="/build/img/trash-alt.svg" class="icono-boton"> -->
                                
                            </a>
                            <a href="/public/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">
                                <img src="/public/build/img/edit.svg" class="icono-boton editar">
                                Actualizar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>