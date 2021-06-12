/// <reference types="cypress" />

describe('Prueba las funciones del panel de admin', () => {
    it('Prueba que los usuarios no autenticados no accedan a cualquier enlace de admin', () => {
        //Propiedades
        cy.visit('/admin');
        cy.get('[data-cy="heading-administrador"]').should('not.exist');
        cy.wait(1000);

        cy.visit('/propiedades/crear');
        cy.get('[data-cy="heading-crear-propiedad"]').should('not.exist');
        cy.wait(1000);

        cy.visit('/propiedades/actualizar');
        cy.get('[data-cy="heading-actualizar-propiedad"]').should('not.exist');
        cy.wait(1000);

        cy.visit('/propiedades/eliminar');
        cy.wait(1000);

        //Vendedores
        cy.visit('/vendedores/crear');
        cy.get('[data-cy="heading-crear-vendedor"]').should('not.exist');
        cy.wait(1000);

        cy.visit('/vendedores/actualizar');
        cy.get('[data-cy="heading-actualizar-vendedor"]').should('not.exist');
        cy.wait(1000);

        cy.visit('/vendedores/eliminar');
        cy.wait(1000);

        //Entradas blog
        cy.visit('/admin-blog');
        cy.get('[data-cy="heading-administrador-blog"]').should('not.exist');
        cy.wait(1000);

        cy.visit('/admin-blog/crear');
        cy.get('[data-cy="heading-crear-entrada"]').should('not.exist');
        cy.wait(1000);

        cy.visit('/admin-blog/actualizar');
        cy.get('[data-cy="heading-actualizar-entrada"]').should('not.exist');
        cy.wait(1000);

        cy.visit('/admin-blog/eliminar');
        cy.wait(1000);
    });

    it('Prueba que los enlaces sean correctos', () => {
        //Entrar como administrador
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        //Boton crear propiedad
        cy.get('[data-cy="crear-propiedad"]').should('exist');
        cy.get('[data-cy="crear-propiedad"]').should('have.class', 'boton-verde');
        cy.get('[data-cy="crear-propiedad"]').invoke('text').should('equal', 'Nueva Propiedad');
        cy.get('[data-cy="crear-propiedad"]').invoke('attr', 'href').should('equal', '/public/propiedades/crear');
        cy.get('[data-cy="crear-propiedad"]').click();

        cy.get('[data-cy="heading-crear-propiedad"]').should('exist');
        cy.get('[data-cy="heading-crear-propiedad"]').should('have.text', 'Crear');
        cy.get('[data-cy="heading-crear-propiedad"]').should('not.have.text', 'Crear Propiedad');
        cy.wait(1000);
        cy.go('back');

        //Boton crear vendedor
        cy.get('[data-cy="crear-vendedor"]').should('exist');
        cy.get('[data-cy="crear-vendedor"]').should('have.class', 'boton-amarillo');
        cy.get('[data-cy="crear-vendedor"]').invoke('text').should('equal', 'Nuevo(a) Vendedor');
        cy.get('[data-cy="crear-vendedor"]').invoke('attr', 'href').should('equal', '/public/vendedores/crear');
        cy.get('[data-cy="crear-vendedor"]').click();

        cy.get('[data-cy="heading-crear-vendedor"]').should('exist');
        cy.get('[data-cy="heading-crear-vendedor"]').should('have.text', 'Registrar Vendedor(a)');
        cy.get('[data-cy="heading-crear-vendedor"]').should('not.have.text', 'Crear Vendedor(a)');
        cy.wait(1000);
        cy.go('back');

        //Boton ir a admin blog
        cy.get('[data-cy="ir-admin-blog"]').should('exist');
        cy.get('[data-cy="ir-admin-blog"]').should('have.class', 'boton-amarillo');
        cy.get('[data-cy="ir-admin-blog"]').invoke('text').should('equal', 'Administrar Blog');
        cy.get('[data-cy="ir-admin-blog"]').invoke('attr', 'href').should('equal', '/public/admin-blog');
        cy.get('[data-cy="ir-admin-blog"]').click();

        cy.get('[data-cy="heading-administrador-blog"]').should('exist');
        cy.get('[data-cy="heading-administrador-blog"]').should('have.text', 'Administrador de Blog');
        cy.get('[data-cy="heading-administrador-blog"]').should('not.have.text', 'Administrar Entradas de Blog');
        cy.wait(1000);
        cy.go('back');
    });

    it('Prueba el formulario para crear una propiedad', () => {
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        cy.visit('/propiedades/crear');
        cy.get('[data-cy="form-crear-propiedad"]').should('exist');

        //Llenando el formulario
        cy.get('[data-cy="input-titulo"]').type('Esto es una propiedad de prueba');
        cy.get('[data-cy="input-precio"]').type('22000000');

        //Subiendo una imagen
        cy.fixture('images/testPicture.jpg').as('logo');
        cy.get('[data-cy="input-imagen"]').then(function (el) {
            // convert the logo base64 string to a blob
            const blob = Cypress.Blob.base64StringToBlob(this.logo, 'image/jpg')

            const file = new File([blob], 'testPicture.jpg', { type: 'image/jpg' })
            const list = new DataTransfer()

            list.items.add(file)
            const myFileList = list.files

            el[0].files = myFileList
            el[0].dispatchEvent(new Event('change', { bubbles: true }))
        });

        cy.get('[data-cy="input-descripcion"]').type("Donec semper felis in purus molestie tempus. Morbi non ante dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas sit amet sapien in libero lacinia feugiat rutrum et nibh.");

        cy.get('[data-cy="input-habitaciones"]').type('4');
        cy.get('[data-cy="input-wc"]').type('2');
        cy.get('[data-cy="input-estacionamiento"]').type('2');
        cy.get('[data-cy="select-vendedor"]').select('2');

        cy.get('[data-cy="form-crear-propiedad"]').submit();

        //Validando el mensaje de éxito
        cy.get('[data-cy="alerta-admin"]').should('exist');
        cy.get('[data-cy="alerta-admin"]').should('have.class', 'alerta').and('have.class', 'exito');
        cy.get('[data-cy="alerta-admin"]').invoke('text').should('equal', 'Anuncio Creado correctamente');
        cy.wait(2000);
    });

    it('Prueba actualizar una propiedad', () =>{
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        //Validando boton actualizar
        cy.get('[data-cy="btn-actualizar-propiedad"]').should('exist');
        cy.get('[data-cy="btn-actualizar-propiedad"]').should('have.class', 'boton-amarillo-block');
        cy.get('[data-cy="btn-actualizar-propiedad"]').last().should('have.text', 'Actualizar');
        //Validando el icono del boton
        cy.get('[data-cy="btn-actualizar-propiedad"]').find('img').invoke('attr', 'src').should('equal', '/public/build/img/edit.svg');
        cy.get('[data-cy="btn-actualizar-propiedad"]').last().click();

        cy.get('[data-cy="heading-actualizar-propiedad"]').should('exist');
        cy.get('[data-cy="form-actualizar-propiedad"]').should('exist');

        //Remplazando imagen
        cy.fixture('images/testPicture2.jpg').as('logo');
        cy.get('[data-cy="input-imagen"]').then(function (el) {
            // convert the logo base64 string to a blob
            const blob = Cypress.Blob.base64StringToBlob(this.logo, 'image/jpg')

            const file = new File([blob], 'testPicture2.jpg', { type: 'image/jpg' })
            const list = new DataTransfer()

            list.items.add(file)
            const myFileList = list.files

            el[0].files = myFileList
            el[0].dispatchEvent(new Event('change', { bubbles: true }))
        });

        cy.get('[data-cy="form-actualizar-propiedad"]').submit();

        //Validando el mensaje de éxito
        cy.get('[data-cy="alerta-admin"]').should('exist');
        cy.get('[data-cy="alerta-admin"]').should('have.class', 'alerta').and('have.class', 'exito');
        cy.wait(2000);
    });

    it('Prueba eliminar una propiedad', () => {
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        cy.get('[data-cy="eliminar-propiedad"]').should('exist');
        cy.get('[data-cy="eliminar-propiedad"]').find('input').should('have.class', 'boton-rojo-block');
        cy.get('[data-cy="eliminar-propiedad"]').last().submit();

        //Validando el mensaje de éxito
        cy.get('[data-cy="alerta-admin"]').should('exist');
        cy.get('[data-cy="alerta-admin"]').should('have.class', 'alerta').and('have.class', 'exito');
        cy.wait(2000);
    });

    it('Prueba el boton ver detalles de la propiedad', () => {
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        //Validando el boron ver detalles
        cy.get('[data-cy="btn-ver-propiedad"]').should('exist');
        cy.get('[data-cy="btn-ver-propiedad"]').should('have.class', 'boton boton-verde');
        //Validando icono del boton
        cy.get('[data-cy="btn-ver-propiedad"]').find('img').invoke('attr', 'src').should('equal', '/public/build/img/arrow-go.svg');
        cy.get('[data-cy="btn-ver-propiedad"]').last().should('have.text', 'Ver detalles');
        cy.get('[data-cy="btn-ver-propiedad"]').last().click();

        //Validando elementos de admin en propiedad
        cy.get('[data-cy="elements-admin"]').should('exist');
        cy.get('[data-cy="elements-admin"]').find('a').should('have.class', 'boton boton-verde');
        cy.get('[data-cy="elements-admin"]').find('a').invoke('attr', 'href').should('equal', '/public/admin');

        cy.get('[data-cy="elements-admin"]').find('p').should('exist');

        cy.get('[data-cy="btn-actualizar-propiedad"]').should('exist');
        cy.get('[data-cy="btn-actualizar-propiedad"]').should('have.class', 'boton-amarillo');
        cy.get('[data-cy="btn-actualizar-propiedad"]').should('have.text', 'Actualizar');
        //Validando el icono del boton
        cy.get('[data-cy="btn-actualizar-propiedad"]').find('img').invoke('attr', 'src').should('equal', '/public/build/img/edit.svg');
        cy.wait(2000);

        cy.get('[data-cy="btn-actualizar-propiedad"]').click();

        cy.get('[data-cy="heading-actualizar-propiedad"]').should('exist');
        cy.wait(1000);
    });

    it('Prueba el formulario para registrar a nuevo vendedor', () => {
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        cy.visit('/vendedores/crear');
        cy.get('[data-cy="form-vendedor"]').should('exist');

        //Llenando el formulario
        cy.get('[data-cy="input-nombre"]').type('Kim');
        cy.get('[data-cy="input-apellido"]').type('Bonilla Castro');
        cy.get('[data-cy="input-telefono"]').type('6641 697 665');
        cy.get('[data-cy="input-correo"]').type('KimBonillaCastro@dayrep.com');
        cy.get('[data-cy="form-vendedor"]').submit();

        //Validando el mensaje de éxito
        cy.get('[data-cy="alerta-admin"]').should('exist');
        cy.get('[data-cy="alerta-admin"]').should('have.class', 'alerta').and('have.class', 'exito');
        cy.wait(2000);
    });

    it('Prueba actualizar vendedor', () => {
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        //Validando boton actualizar
        cy.get('[data-cy="btn-actualizar-vendedor"]').should('exist');
        cy.get('[data-cy="btn-actualizar-vendedor"]').should('have.class', 'boton-amarillo-block');
        cy.get('[data-cy="btn-actualizar-vendedor"]').last().should('have.text', 'Actualizar');

        //Validando el icono del boton
        cy.get('[data-cy="btn-actualizar-vendedor"]').find('img').invoke('attr', 'src').should('equal', '/public/build/img/edit.svg');
        cy.get('[data-cy="btn-actualizar-vendedor"]').last().click();

        cy.get('[data-cy="heading-actualizar-vendedor"]').should('exist');
        cy.get('[data-cy="form-actualizar-vendedor"]').should('exist');

        cy.get('[data-cy="input-apellido"]').clear();
        cy.get('[data-cy="input-apellido"]').type('Castro Bonilla');
        cy.get('[data-cy="form-actualizar-vendedor"]').submit();

        //Validando el mensaje de éxito
        cy.get('[data-cy="alerta-admin"]').should('exist');
        cy.get('[data-cy="alerta-admin"]').should('have.class', 'alerta').and('have.class', 'exito');
        cy.wait(2000);
    });

    it('Prueba eliminar un vendedor', () => {
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        cy.get('[data-cy="eliminar-vendedor"]').should('exist');
        cy.get('[data-cy="eliminar-vendedor"]').find('input').should('have.class', 'boton-rojo-block');
        cy.get('[data-cy="eliminar-vendedor"]').last().submit();

        //Validando el mensaje de éxito
        cy.get('[data-cy="alerta-admin"]').should('exist');
        cy.get('[data-cy="alerta-admin"]').should('have.class', 'alerta').and('have.class', 'exito');
        cy.wait(2000);
    });

    it('Prueba el formulario paea crear nueva entrada de blog', () => {
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        cy.visit('/admin-blog/crear');
        cy.get('[data-cy="form-crear-entrada"]').should('exist');

        //Llenando el formulario
        cy.get('[data-cy="input-titulo"]').type('Nueva entrada de prueba');

        cy.get('[data-cy="input-resumen"]').type('SECTOR INMOBILIARIO, PILAR EN MATERIA DE INVERSIÓN');

        cy.get('[data-cy="input-contenido"]').type('México se ha convertido en uno de los países más importantes para los ojos de muchos inversionistas alrededor del mundo según el presidente de la Asociación Mexicana de Profesionales Inmobiliarios (AMPI), Pedro Fernández Martínez. Es por ello que el Sector Inmobiliario se ha posicionado como uno de los pilares más importantes y seguros en materia de inversión inteligente. Gracias a…');

        cy.get('[data-cy="input-autor"]').type('Sociedad de Bienes Raíces Latinoamérica');

        cy.get('[data-cy="form-crear-entrada"]').submit();

        //Validando el mensaje de éxito
        cy.get('[data-cy="alerta-blog-admin"]').should('exist');
        cy.get('[data-cy="alerta-blog-admin"]').should('have.class', 'alerta').and('have.class', 'exito');
        cy.wait(2000);
    });

    it('Prueba actualizar una entrada de blog', () => {
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        cy.visit('/admin-blog/actualizar');
        //Validando boton actualizar
        cy.get('[data-cy="btn-actualizar-entrada"]').should('exist');
        cy.get('[data-cy="btn-actualizar-entrada"]').should('have.class', 'boton-amarillo-block');
        cy.get('[data-cy="btn-actualizar-entrada"]').last().should('have.text', 'Actualizar');
        //Validando el icono del boton
        cy.get('[data-cy="btn-actualizar-entrada"]').find('img').invoke('attr', 'src').should('equal', '/public/build/img/edit.svg');
        cy.get('[data-cy="btn-actualizar-entrada"]').last().click();

        cy.get('[data-cy="heading-actualizar-entrada"]').should('exist');
        cy.get('[data-cy="form-actualizar-entrada"]').should('exist');

        cy.get('[data-cy="input-titulo"]').type(' ACTUALIZADO');

        cy.get('[data-cy="form-actualizar-entrada"]').submit();

        //Validando el mensaje de éxito
        cy.get('[data-cy="alerta-blog-admin"]').should('exist');
        cy.get('[data-cy="alerta-blog-admin"]').should('have.class', 'alerta').and('have.class', 'exito');
        cy.wait(2000);
    });

    it('Prueba eliminar una entrada de blog', () => {
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        cy.visit('/admin-blog');
        cy.get('[data-cy="eliminar-entrada"]').should('exist');
        cy.get('[data-cy="eliminar-entrada"]').find('img').invoke('attr', 'src').should('equal', '/public/build/img/trash-alt.svg');
        cy.get('[data-cy="eliminar-entrada"]').find('input').should('have.class', 'boton-rojo-block');
        cy.get('[data-cy="eliminar-entrada"]').last().submit();

        //Validando el mensaje de éxito
        cy.get('[data-cy="alerta-blog-admin"]').should('exist');
        cy.get('[data-cy="alerta-blog-admin"]').should('have.class', 'alerta').and('have.class', 'exito');
        cy.wait(2000);
    });

    it('Prueba el boton ver detalles de la entrada', () => {
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        cy.visit('/admin-blog');
        //Validando el boton ver detalles
        cy.get('[data-cy="btn-ver-entrada"]').should('exist');
        cy.get('[data-cy="btn-ver-entrada"]').should('have.class', 'boton boton-verde');
        //Validando icono del boton
        cy.get('[data-cy="btn-ver-entrada"]').find('img').invoke('attr', 'src').should('equal', '/public/build/img/arrow-go.svg');
        cy.get('[data-cy="btn-ver-entrada"]').last().should('have.text', 'Ver detalles');
        cy.get('[data-cy="btn-ver-entrada"]').last().click();

        //Validando elementos de admin en la entrada de blog
        cy.get('[data-cy="elements-blog-admin"]').should('exist');
        cy.get('[data-cy="elements-blog-admin"]').find('a').should('have.class', 'boton boton-verde');
        cy.get('[data-cy="elements-blog-admin"]').find('a').invoke('attr', 'href').should('equal', '/public/admin-blog');
        cy.get('[data-cy="btn-actualizar-entrada"]').should('exist');
        cy.get('[data-cy="btn-actualizar-entrada"]').should('have.class', 'boton-amarillo');
        cy.get('[data-cy="btn-actualizar-entrada"]').should('have.text', 'Actualizar');
        //Validando el icono del boton
        cy.get('[data-cy="btn-actualizar-entrada"]').find('img').invoke('attr', 'src').should('equal', '/public/build/img/edit.svg');
        cy.wait(2000);
        cy.get('[data-cy="btn-actualizar-entrada"]').click();

        cy.get('[data-cy="heading-actualizar-entrada"]').should('exist');
        cy.wait(1000);
    });

    it('Prueba que el cierre de sesión de admin sea correcta', () =>{
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        cy.get('[data-cy="cierre-sesion"]').should('exist');
        cy.get('[data-cy="cierre-sesion"]').click();
        cy.get('[data-cy="heading-sitio"]').should('exist');
    });
});