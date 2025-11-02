describe('user login', () => {
    beforeEach(() => {
        cy.exec('npm run db:seed')
    })
    it('logs in', () => {
        cy.visit('/')
        cy.get('a').click()
        cy.url().should('include', '/login')
        cy.get('input[name=email]').type('test@test.com')
        cy.get('input[name=password]').type('password{enter}')
        cy.url().should('include', '/dashboard')
    })
    it('doesnt log in', () => {
        cy.visit('/')
        cy.get('a').click()
        cy.url().should('include', '/login')
        cy.get('input[name=email]').type('test@test.com')
        cy.get('input[name=password]').type('wrongPassword{enter}')
        cy.url().should('include', '/login')
    })
})
