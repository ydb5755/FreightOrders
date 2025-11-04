describe('freight orders', () => {
    beforeEach(() => {
        cy.exec('npm run db:seed')
    })
    it('creates freight order', () => {
        cy.visit('/freight_orders')
        cy.get('input[name=ship_from_location]').type('new york')
        cy.get('input[name=ship_to_location]').type('pennsylvania')
        cy.get('input[name=pickup_date]').type('2026-01-01')
        cy.get('input[name=delivery_deadline]').type('2026-01-25{enter}')
        cy.url().should('include', '/freight_orders')
        cy.contains('new york')
    })
})
