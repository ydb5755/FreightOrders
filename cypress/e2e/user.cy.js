describe('user login', () => {
    it('logs in', () => {
        cy.exec('npm run db:seed')
        cy.visit('/')
        cy.get('a').click()
        cy.url().should('include', '/login')
        cy.get('input[name=email]').type('test@test.com')
        cy.get('input[name=password]').type('password{enter}')
        cy.url().should('include', '/dashboard')
    })
})
