# Microservice ShopApi
This project has the objective handle functionalities related to the shopping cart of an ecommerce.
 
### 🤖 Technologies
This microservice API are make with ```Slim PHP``` and using ```Hexagonal Arquitecture```, ```CommandBus```, ```DDD```, ```CQRS```, ```Symfony Console```,```Domain events```, ```VO``` and ```RabbitMQ```.
 
### 🌲 Architecture
We have code split for layers:

    ├── Application
    ├── Domain
    ├── Infrastructure
    └── UI

```Aplication```
In this layer we has commands and handlers.

```Domain```
Bussiness logic in entity files and requests Specification, VO, events, etc.

```Infrastructure```
Implementations external services (Postgres, RabbitMQ, Doctrine).

```UI```
Entry point how it can be commands from console or controllers from HTTP request.

### 💪 Quick Start
#### Set environment vars (.env)

Copy __.env.dist__ to __.env__ and replace with your custom values

```bash
$ cp .env.dist .env
```

#### Upload service
```bash
$ docker-compose up -d --build
```

#### Create DB
```bash
$ docker exec -i local_postgres createdb shop --encoding=UTF-8 --owner=root
```

#### Access container
```bash
$ docker exec -it shopapi bash
```

#### Update database
```bash
$ bin/doctrine orm:schema-tool:update -f
```

#### Application execution
```Important: Look at the port assigned to the project```

- [Swagger](apps/execution/swagger): http://localhost:7000/docs/index.html
- [Status](apps/execution/status): http://localhost:7000/status
- [Adminer](apps/execution/adminer): http://localhost:8081

``` 
Server: local_postgres
User: root
Pass: root
DB: shop
```
- [RabbitMQ](apps/execution/rabbit): http://localhost:8085
 ``` 
 User: guest
 Pass: guest
 ```
#### ✅ Tests execution
We have ```100%``` coverage in Application Layer and ```26.75%``` in Domain.
At this moment functional testing not works fine because we need a fake db when execute them.

```bash
bin/codecept run
```

### 😋 Workflow
This is the process to follow when we want to complete an order including the registration of customers, products and sellers.  

To create customer we need to execute the command inside the container:

```
$ bin/console rabbit:publish:create-customer {firstname} {lastname}
```

In this way we will enqueue a message in RabbitMQ, in the ```create-client``` queue. To consume this message:
```
$ bin/console rabbit:consume:create-customer
```


Create seller:
```
curl -X POST "http://localhost:7000/seller" -H "accept: */*" -H "Content-Type: application/json" -d "{\"name\":\"Seller test\"}"
```

Assign product to seller:
```
curl -X POST "http://localhost:7000/product" -H "accept: */*" -H "Content-Type: application/json" -d "{\"seller_uuid\":\"6f264cc2-0a8c-4c32-ac18-fb3e814ba826\",\"name\":\"Product test\",\"price\":\"10.50\"}"
```

Add product to cart:
```
curl -X POST "http://localhost:7000/cart/product" -H "accept: */*" -H "Content-Type: application/json" -d "{\"customer_uuid\":\"4c87ea6d-1249-4bf1-bb36-863be3f22188\",\"product_uuid\":\"1b41c951-76e9-466a-a5e1-05dabbd271da\",\"quantity\":3}"
```

To finally cart and complete the process:
```
curl -X PUT "http://localhost:7000/cart/buy" -H "accept: */*" -H "Content-Type: application/json" -d "{\"customer_uuid\":\"4c87ea6d-1249-4bf1-bb36-863be3f22188\"}"
```

### Extra endpoints
Delete seller by uuid
```
curl -X DELETE "http://localhost:7000/seller/uuid/6f264cc2-0a8c-4c32-ac18-fb3e814ba826" -H "accept: */*"
```

Delete product by uuid
```
curl -X DELETE "http://localhost:7000/product/uuid/1b41c951-76e9-466a-a5e1-05dabbd271da" -H "accept: */*"
```

Delete cart by customer identifier
```
curl -X DELETE "http://localhost:7000/cart/customer/uuid/4c87ea6d-1249-4bf1-bb36-863be3f22188" -H "accept: */*"
```

Remove product to cart
```
curl -X PUT "http://localhost:7000/cart/product" -H "accept: */*" -H "Content-Type: application/json" -d "{\"customer_uuid\":\"a2aa0365-7560-454c-8e96-a79da26895c5\",\"product_uuid\":\"4bcd1d74-6faa-4177-a01d-830e30d0990f\",\"quantity\":1}"
```

Get total amount from cart
```
curl -X GET "http://localhost:7000/cart/total/a2aa0365-7560-454c-8e96-a79da26895c5" -H "accept: */*"
```
