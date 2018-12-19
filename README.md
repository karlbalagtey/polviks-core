# Polviks Core
A starter boilerplate for the most commonly used features in an API

## Features
1. Authentication 
   - Laravel Passport (oAuth2)
   - Facebook Authentication
2. Products CRUD
   - Categories
   - Transaction
3. Services CRUD
   - Categories
   - Transaction
4. User types with permissions each
   - Agent
   - Customer
   - User (Admin) 


## Endpoints
- Products
   - api/products GET
   - api/products/{product} GET
   - api/products/{product}/customers GET
   - api/products/{product}/customers/{customer}/transactions GET
   - api/products/{product}/categories GET
   - api/products/{product}/categories/{category} PUT|PATCH
   - api/products/{product}/categories/{category} DELETE
   - api/products/{product}/transactions GET
   - api/products-transactions GET
   - api/products-transactions/{productTransaction} GET 
   - api/products-transactions/{products_transaction}/agents GET
   - api/products-transactions/{products_transaction}/categories GET
- Services
   - api/services GET
   - api/services/{service} GET
   - api/services/{service}/customers GET
   - api/services/{service}/customers/{customer}/transactions GET
   - api/services/{service}/categories GET
   - api/services/{service}/categories/{category} PUT|PATCH
   - api/services/{service}/categories/{category} DELETE
   - api/services/{service}/transactions GET
   - api/services-transactions GET
   - api/services-transactions/{serviceTransaction} GET 
   - api/services-transactions/{services_transaction}/agents GET
   - api/services-transactions/{services_transaction}/categories GET
- Customers
   - api/customers GET | POST | PUT | PATCH | DELETE
   - api/customers/verify/{token}
   - api/customers/{customer} GET
   - api/customers/{customer}/products
   - api/customers/{customer}/products/agents
   - api/customers/{customer}/products/categories
   - api/customers/{customer}/resend
   - api/customers/{customer}/services
   - api/customers/{customer}/services/agents
   - api/customers/{customer}/services/categories
   - api/customers/{customer}/{type}/transactions
- Categories
   - api/categories
   - api/categories/{category}
   - api/categories/{category}/agents
   - api/categories/{category}/agents/{agent}
   - api/categories/{category}/customers
   - api/categories/{category}/customers/{customer}
   - api/categories/{category}/items
   - api/categories/{category}/products
   - api/categories/{category}/services
   - api/categories/{category}/transactions
   - api/categories/{category}/transactions/{transaction}
   - api/categories/{id}/{type}/agents
   - api/categories/{id}/{type}/customers
   - api/categories/{id}/{type}/transactions
