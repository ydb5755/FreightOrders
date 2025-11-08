describe('freight carriers', () => {
    beforeEach(() => {
        cy.exec('npm run db:seed')
    })
    it('creates freight carrier', () => {
        cy.visit('/freight_carriers')
        cy.get('input[name=companyName]').type('test company')
        cy.get('input[name=contact_person]').type('Joe Shmoe')
        cy.get('input[name=email]').type('joe@shmoe.com')
        cy.get('input[name=phone_number]').type('123456789')
        cy.get('input[name=notes]').type('some notes{enter}')
        cy.url().should('include', '/freight_carriers')
        cy.get('table').contains('test company')
    })
})
