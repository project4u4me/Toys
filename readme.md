## About

This is very simple app created with Laravel. 
This task is for Ranan's test and demo is available **[HERE](http://api.myshopify.eu)**

## Installation

**Toys** app needs standards instalation steps. 
After uploading app set `.env` file with neccesary settings (mainly database creditentials).

All classes for migration and seeds are set. From comannd line (main Laravel directory) call commands below:

`php artisan migrate`

`php artisan db:seed`

These commands will create neccesary tables and seed it fake data.

## Tests

If you need you can do test using PHP Unit. From main Laravel's directory call command below:

`vendor/bin/phpunit`

This will do simple test of main route `products` and will check if you have got data in database and if your roting is sets correctly.


## API

**Toys** app uses its own API for CRUD (create, retrieve, update and delete) data. 
Some end-points requres tokens for security reasons. In this siple project Session Id is uses as a token.


### Get All Products

Products can be retrieved via `App\Api\ProductController`->`getProducts()` using `HTTP-GET` method: 

```
GET /api/products
```

The response will contain a `success`-flag and optional `data` and `errors` array.

```
{
    "success": true,
    "data": [
        {
          "uuid": "e2a3f36376f53e306c5460ab30729917",
          "name": "Product name 0",
          "price": "8.50",
          "stock": 587
        },
        [...]
        ],
    "errors": []
}
```

### Get Product

Product can be retrieved via `App\Api\ProductController`->`getProduct()` using `HTTP-GET` method: 

```
GET /api/product/{uuid}
```

The response will contain a `success`-flag and optional `data` and `errors` array.

```
{
    "success": true,
    "data": {
        "uuid": "e2a3f36376f53e306c5460ab30729917",
        "name": "Product name 0",
        "price": "8.50",
        "stock": 587,
        "max_discount": 60,
        "min_price": 5.1,
        "vouchers": [
            {
                "uuid": "13222e1cd0877347a70724f021656377",
                "code": "MBO-747-FUJ-904",
                "start": "2018-09-13",
                "end": "2018-09-27",
                "discount": {
                    "uuid": "1bb17a7c35e7d2bf4825c9424339c09f",
                    "value": 10,
                    "name": "10%"
                }
            },
            [...]
            ]
    },
    "errors": []
}
```

Possible to get `success` flags, HTTP response codes and error messages:

| Success | HTTP | Message                 | Description                                           |
| :------ | :--- | :---------------------- | :---------------------------------------------------- |
| true    | 200  |                         |                                                       |
| false   | 406  | `uuid` - `incorrect`    | Not provided `uuid` string                            |
| false   | 404  | `product` - `not-found` | Product with provided `uuid` not exists               |



### Count Cards

Cards can be counted via `App\Api\CartController`->`countCartItems()` using `HTTP-GET` method: 

```
GET /api/cart/count/{token}
```

The response will contain a `success`-flag and optional `data` and `errors` array.

```
{
    "success": true,
    "data": {
        "items": 7,
        "cart": {
            "e2a3f36376f53e306c5460ab30729917": {
                "uuid": "e2a3f36376f53e306c5460ab30729917",
                "value": 5.1,
                "quantity": 1
            },
            [...]
        }
    },
    "errors": []
}
```


### Update Cart Values

Cards values can be updated via `App\Api\CartController`->`updateCart()` using `HTTP-POST` method: 

```
POST /api/cart/upadte/{token}
```

An Cart value updating requires params as below:
| Param           | Type     | Description                         |
| :-------------- | :------- | :---------------------------------- |
| uuid            | string   | Uuid of edited item                 |
| best_price      | decimal  | Price after discounts               |
| items           | integer  | Number of items                     |


The response will contain a `success`-flag and optional `data` and `errors` array.

```
{
    "success": true,
    "data": {
        "item": {
            "uuid": "e2a3f36376f53e306c5460ab30729917",
            "value": 5.1,
            "quantity": 1
        },
        "token": "rQPbDvupVq9bQ4AjyLDoGWqJefnBJkxiojqunmL5"
    },
    "errors": []
}
```


### Delete Cart Item

Cards items can be deleted via `App\Api\CartController`->`deleteCartItem()` using `HTTP-POST` method: 

```
POST /api/cart/delete/{token}
```

An Cart value updating requires params as below:
| Param           | Type     | Description                         |
| :-------------- | :------- | :---------------------------------- |
| uuid            | string   | Uuid of deleted item                |


The response will contain a `success`-flag and optional `data` and `errors` array.

```
{
    "success": true,
    "data": {
        "token": "rQPbDvupVq9bQ4AjyLDoGWqJefnBJkxiojqunmL5"
    },
    "errors": []
}
```

### Buy

Items can be buing (deleted) via `App\Api\CartController`->`buyCart()` using `HTTP-POST` method: 

```
POST /api/cart/buy/{token}
```

An Cart buing not requires any params.


The response will contain a `success`-flag and optional `data` and `errors` array.

```
{
    "success": true,
    "data": {
        "token": "rQPbDvupVq9bQ4AjyLDoGWqJefnBJkxiojqunmL5"
    },
    "errors": []
}
```


## WEB

Views are rendered by using Blade templates.

### Get Products (Home Page)

Products can be retrieved via `App\Http\Controllers\ProductController`->`showProducts()` using `HTTP-GET` method: 

```
GET /products
```

or

```
GET /
```

### Get Product

Product can be retrieved via `App\Http\Controllers\ProductController`->`showProduct()` using `HTTP-GET` method: 

```
GET /product/{uuid}
```


### Get Cart Items

Items can be retrieved via `App\Http\Controllers\ProductController`->`showCart()` using `HTTP-GET` method: 

```
GET /cart
```


## License

The Toys app is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
