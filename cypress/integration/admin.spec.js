/// <reference types="cypress" />

describe('Prueba las funciones del panel de admin', () => {
    it('Prueba que los usuarios no autenticados no accedan a cualquier enlace de admin', () => {
        //Propiedades
        cy.visit('/admin');
        cy.get('[data-cy="heading-administrador"]').should('not.exist');
        // cy.wait(1000);

        cy.visit('/propiedades/crear');
        cy.get('[data-cy="heading-crear-propiedad"]').should('not.exist');
        // cy.wait(1000);

        cy.visit('/propiedades/actualizar');
        cy.get('[data-cy="heading-actualizar-propiedad"]').should('not.exist');
        // cy.wait(1000);

        cy.visit('/propiedades/eliminar');
        // cy.wait(1000);

        //Vendedores
        cy.visit('/vendedores/crear');
        cy.get('[data-cy="heading-crear-vendedor"]').should('not.exist');
        // cy.wait(1000);

        cy.visit('/vendedores/actualizar');
        cy.get('[data-cy="heading-actualizar-vendedor"]').should('not.exist');
        // cy.wait(1000);

        cy.visit('/vendedores/eliminar');
        // cy.wait(1000);

        //Entradas blog
        cy.visit('/admin-blog');
        cy.get('[data-cy="heading-administrador-blog"]').should('not.exist');
        // cy.wait(1000);

        cy.visit('/admin-blog/crear');
        cy.get('[data-cy="heading-crear-entrada"]').should('not.exist');
        // cy.wait(1000);

        cy.visit('/admin-blog/actualizar');
        cy.get('[data-cy="heading-actualizar-entrada"]').should('not.exist');
        // cy.wait(1000);

        cy.visit('/admin-blog/eliminar');
        // cy.wait(1000);
    });

    it('Prueba que los enlaces sean correctos', () => {
        //Entrar como administrador
        cy.visit('/login');
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        //Panel de admin
        cy.get('[data-cy="heading-administrador"]').should('exist').should('have.text', 'Administrador de Bienes Raices');
        cy.wait(1000);

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
        cy.get('[data-cy="form-propiedad"]').should('exist');

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

        cy.get('[data-cy="form-propiedad"]').submit();

        //Validando el mensaje de éxito
        cy.get('[data-cy="alerta-admin"]').should('exist');
        cy.get('[data-cy="alerta-admin"]').should('have.class', 'alerta').and('have.class', 'exito');
        cy.get('[data-cy="alerta-admin"]').invoke('text').should('equal', 'Anuncio Creado correctamente');
    });
});