# Requirement

Pastikan untuk memiliki versi PHP minimal 8.2

## Instalasi

```sh
    git clone https://github.com/gibranar/laravel-books-api-rbac-with-sanctum.git
```

```sh
    cd laravel-books-api-rbac-with-sanctum
```

```sh
    composer update
```

```sh
    cp .env.example .env
```

```sh
    php artisan key:generate
```

```sh
    php artisan migrate:fresh --seed
```

```sh
    php artisan serve
```

# REST API

Gunakan software postman untuk menjalankan API

### BASE_URL

```sh
http://127.0.0.1:8000/api
```

## Login

```sh
URL: {BASE_URL}/login
Method: POST
```

```json
data = [
    Admin => email: admin@gmail.com, pass: password,
    Editor => email: editor@gmail.com, pass: password,
    Viewer => email: viewer@gmail.com, pass: password
]
```

### Request

```json
Headers: { 
    Accept: application/json
},
Body: {
    email: data.email,
    password: data.password
}
```

### Response

```json
{
    "status": "success",
    "status_code": 200,
    "message": "Login Success",
    "data": {
        "token": "1|Cmosr7o53C3ddlyeqtMKZNg7SPDpQ4yqp0AOFgXk0a4ac24e",
        "user": {
            "id": 1,
            "name": "Admin",
            "email": "admin@gmail.com",
            "email_verified_at": null,
            "created_at": "2025-02-22T15:46:56.000000Z",
            "updated_at": "2025-02-22T15:46:56.000000Z"
        },
        "role": [
            "admin"
        ]
    }
}
```

## Register

```sh
URL: {BASE_URL}/register
Method: POST
```

### Request

```json
Headers: { 
    Accept: application/json
},
Body: {
    name: value,
    email: value@gmail.com,
    password: value123
}
```

### Response

```json
{
    "status": "success",
    "status_code": 201,
    "message": "Account created successfully",
    "data": {
        "user": {
            "name": "value",
            "email": "value@gmail.com",
            "updated_at": "2025-02-22T14:18:10.000000Z",
            "created_at": "2025-02-22T14:18:10.000000Z",
            "id": 4
        }
    }
}
```

## GET All Data

```sh
URL: {BASE_URL}/books
Method: GET
```

### Request

```json
Headers: { 
    Accept: application/json,
    Authorization: Bearer + TOKEN_AFTER_LOGIN
},
Body: {}
```

### Response

```json
{
    "status": "success",
    "status_code": 200,
    "message": "Success get all books",
    "data": {
        "meta": {
            "from": 1,
            "to": 25,
            "total": 50,
            "per_page": 25,
            "current_page": 1,
            "last_page": 2
        },
        "books": [
            {
                "id": 1,
                "title": "Consequatur quisquam dolor quod.",
                "author": "Allene Bergnaum",
                "year": 2000,
                "description": "Necessitatibus nobis recusandae blanditiis minima suscipit. Cumque earum vitae ut maiores quaerat. Repellat doloribus pariatur necessitatibus distinctio reiciendis hic. Debitis reiciendis dolorum in dolores esse laboriosam quos eveniet."
            },
            {
                "id": 2,
                "title": "Est animi.",
                "author": "Prof. Vincenzo Hauck",
                "year": 2019,
                "description": "Dolor voluptatum vel soluta ut laboriosam. Tenetur amet iure error eum similique voluptatibus quod tempora. Voluptas omnis quis eligendi doloremque adipisci consequatur consectetur."
            },
            {
                ...
            }],
        "status_code": 200
    }
}
```

## Show Detail

```sh
URL: {BASE_URL}/books/{id}
Method: GET
```

### Request

```json
Headers: { 
    Accept: application/json,
    Authorization: Bearer + TOKEN_AFTER_LOGIN
},
Body: {}
```

### Response

```json
{
    "status": "success",
    "status_code": 200,
    "message": "Book found",
    "book": {
        "id": 4,
        "title": "Aut quae fuga id.",
        "author": "Mr. Bobbie Torphy",
        "year": 1989,
        "description": "Molestias eum architecto illo et delectus libero. Mollitia possimus minima ipsa quia et sint. Quasi ut autem sed ullam. Qui non adipisci reprehenderit praesentium voluptas."
    }
}
```

## Store Data

```sh
URL: {BASE_URL}/books
Method: POST
```

### Request

```json
Headers: { 
    Accept: application/json,
    Authorization: Bearer + TOKEN_AFTER_LOGIN
},
Body: {
    title: book 1
    author: john doe
    year: 2025
    description: lorem ipsum book 1
}
```

### Response

```json
{
    "status": "success",
    "status_code": 201,
    "message": "Book created",
    "data": {
        "book": {
            "title": "book 1",
            "author": "john doe",
            "year": 2025,
            "description": "lorem ipsum book 1",
            "id": 51
        }
    }
}
```

## Update Data

```sh
URL: {BASE_URL}/books/{id}
Method: PUT
```

### Request

```json
Headers: { 
    Accept: application/json,
    Authorization: Bearer + TOKEN_AFTER_LOGIN
},
Body: {
    title: laskar pelangi
    author: john doe
    year: 2020
    description: deskripsi laskar pelangi
}
```

### Response

```json
{
    "status": "success",
    "status_code": 200,
    "message": "Book updated",
    "data": {
        "book": {
            "id": 3,
            "title": "laskar pelangi",
            "author": "john doe",
            "year": 2020,
            "description": "deskripsi laskar pelangi"
        }
    }
}
```

## Delete Data

```sh
URL: {BASE_URL}/books/{id}
Method: DELETE
```

### Request

```json
Headers: { 
    Accept: application/json,
    Authorization: Bearer + TOKEN_AFTER_LOGIN
},
Body: {}
```

### Response

```json
{
    "status": "success",
    "status_code": 200,
    "message": "Book deleted",
    "data": null
}
```