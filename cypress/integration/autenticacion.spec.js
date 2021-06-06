/// <reference types="cypress" />

describe('Probar la Autenticación', () => {
    it('Prueba la Autenticación en /login', () => {
        cy.visit('/login');

        cy.get('[data-cy="heading-login"]').should('exist');
        cy.get('[data-cy="heading-login"]').should('have.text', 'Iniciar Sesión');

        cy.get('[data-cy="formulario-login"]').should('exist');
        cy.get('[data-cy="formulario-login"]').should('exist');

        //Ambos campos son obligatorios
        cy.get('[data-cy="formulario-login"]').submit();
        cy.get('[data-cy="alerta-login"]').should('exist');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.class', 'error');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.text', 'El email es obligatorio');

        cy.get('[data-cy="alerta-login"]').eq(1).should('have.class', 'error');
        cy.get('[data-cy="alerta-login"]').eq(1).should('have.text', 'El password es obligatorio');

        //El usuario exista
        cy.get('[data-cy="input-usuario"]').type('usuario@correo.com');
        cy.get('[data-cy="input-password"]').type('password');
        cy.wait(1000);
        cy.get('[data-cy="formulario-login"]').submit();
        cy.get('[data-cy="alerta-login"]').should('exist');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.text', 'El usuario no existe');

        //Verificar el password
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('password');
        cy.wait(1000);
        cy.get('[data-cy="formulario-login"]').submit();
        cy.get('[data-cy="alerta-login"]').should('exist');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.text', 'El password es Incorrecto');

        //Ingrasando correctamente
        cy.wait(1000);
        cy.get('[data-cy="input-usuario"]').type('correo@correo.com');
        cy.get('[data-cy="input-password"]').type('123456');
        cy.get('[data-cy="formulario-login"]').submit();

        cy.get('[data-cy="heading-administrador"]').should('exist');
        cy.get('[data-cy="heading-administrador"]').should('have.text', 'Administrador de Bienes Raices');
    });
});