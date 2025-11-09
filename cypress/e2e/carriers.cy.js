describe('freight carriers', () => {
    it('creates freight carrier', () => {
        cy.exec('npm run db:seed')
        cy.visit('/freight_carriers')
        cy.get('input[name=companyName]').type('test company')
        cy.get('input[name=contact_person]').type('Joe Shmoe')
        cy.get('input[name=email]').type('joe@shmoe.com')
        cy.get('input[name=phone_number]').type('123456789')
        cy.get('input[name=notes]').type('some notes{enter}')
        cy.url().should('include', '/freight_carriers')
        cy.get('table').contains('test company')
    })
    it('shows message if no carriers to display', () => {
        cy.exec('npm run db:wipe')
        cy.visit('/freight_carriers')
        cy.contains('No Carriers to Display')
    })
})
