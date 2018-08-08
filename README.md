# polviks-core
Polviks core API
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
