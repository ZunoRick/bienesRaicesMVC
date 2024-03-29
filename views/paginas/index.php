<main class="contenedor seccion">
    <h2 data-cy='heading-nosotros'>Más Sobre Nosotros</h2>
    <?php include 'iconos.php'; ?>
</main>

<section class="seccion contenedor">
    <h2 data-cy='heading-anuncios'>Casas y Depas en Venta</h2>
    <?php 
        include 'listado.php';
    ?>
    <div class="alinear-derecha">
        <a href="/public/propiedades" class="boton-verde" data-cy="todas-propiedades">Ver todas</a>
    </div>
</section>

<section class="imagen-contacto" data-cy="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se podrá en contacto contigo a la brevedad.</p>
    <a href="/contacto" class="boton-amarillo">Contactános</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section data-cy="blog" class="blog">
        <h3>Nuestro Blog</h3>
        <?php 
            include 'entradas-blog.php';
        ?>
    </section>
    <section data-cy="testimoniales" class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
            </blockquote>
            <p>- Ricardo Zuno</p>
        </div>
    </section>
</div>