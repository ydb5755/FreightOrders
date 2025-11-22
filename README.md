

# TODO
 - Make UpdateBid use case
 - Make GetBidsOfFreightOrder use case
 - Dashboard:
   - Show open requests use case
   - Show closed requests use case



Freight Quote Request System – Functional Requirements Summary

1. Objective

Develop a web-based system that allows operations staff to create freight quote
requests, send them to selected carriers, and collect responses automatically —
all organized under a single freight request record.


---

2. User Roles

Operations User (Admin): Creates and manages freight quote requests,
views all carrier responses.

Carrier (External User): Receives email invitations and submits quote responses
via a secure link (no login required).



---

3. Core Features

A. Freight Quote Request Creation

User can create a new freight quote request with:

Request ID (auto-generated)

Ship-from location

Ship-to location

Pickup date / delivery deadline

Load details (pallet count, weight, dimensions, etc.)

Notes / special instructions

File attachments (e.g., BOL, load sheet, customer order)


Ability to select multiple carriers from an internal database.


B. Carrier Database

Central list of all approved carriers with:

Company name

Contact person

Email

Phone number

Notes / preferred lanes / service type


Search, filter, and tag carriers (e.g., “East Coast”, “LTL”, “Full Truckload”)


C. Sending Quote Requests

When user submits a new freight quote request:

System sends an email to each selected carrier with:

Summary of shipment details

“Reply with Quote” button or link


Each link is unique to that carrier and request.



D. Carrier Response Portal

Carriers click the email link and open a simple web form (no login) showing:

Shipment details

Fields to enter:

Freight cost

Notes / conditions

Add file

Submit Quote button

Upon submission:

Carrier’s quote is recorded in the system.

Confirmation message shown to carrier and redirected
to bid summary page.



E. Quote Response Management

Operations dashboard shows:

List of all freight quote requests

From and to location

Date created

How many people recieved the request

How many people clicked on the email

How many people submitted

Ability to close request.

If request is closed then will not accept bids.


When a request is opened:

Table view of all carrier responses with columns:

Carrier Name

Quote Amount

Pickup Date

Delivery Date

Notes

Date created

