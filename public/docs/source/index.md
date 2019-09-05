---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost:8000/docs/collection.json)

<!-- END_INFO -->

#Article management


APIs for managing articles
<!-- START_f12b8e5675a9867b848488d3de8cbeca -->
## Show all articles

Api to list all articles

> Example request:

```bash
curl -X GET -G "http://localhost:8000/auth/articles" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost:8000/auth/articles");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /auth/articles`


<!-- END_f12b8e5675a9867b848488d3de8cbeca -->

<!-- START_d387e3749c3755a3c63533f06550755d -->
## Show one article

Api to show one article

> Example request:

```bash
curl -X GET -G "http://localhost:8000/auth/articles/1" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost:8000/auth/articles/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /auth/articles/{id}`


<!-- END_d387e3749c3755a3c63533f06550755d -->

<!-- START_9a915642db53ac060c5e3bf700770117 -->
## Create an article

Api to create an article

> Example request:

```bash
curl -X POST "http://localhost:8000/auth/articles" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"main_title":"hic","secondary_title":"commodi","content":"ut","image":"tempora","author_id":18}'

```

```javascript
const url = new URL("http://localhost:8000/auth/articles");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "main_title": "hic",
    "secondary_title": "commodi",
    "content": "ut",
    "image": "tempora",
    "author_id": 18
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /auth/articles`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    main_title | string |  required  | The main title of the article.
    secondary_title | string |  required  | The secondary title of the article.
    content | string |  required  | The content of the article.
    image | file |  optional  | The image for the article.
    author_id | integer |  optional  | the ID of the author of the article

<!-- END_9a915642db53ac060c5e3bf700770117 -->

<!-- START_5c17a25103ba35d23264181da701ace7 -->
## Delete

Api to delete an article

> Example request:

```bash
curl -X DELETE "http://localhost:8000/auth/articles/1" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost:8000/auth/articles/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /auth/articles/{id}`


<!-- END_5c17a25103ba35d23264181da701ace7 -->

<!-- START_85efc05b78f7b64d79d4beba3fb59c99 -->
## Update

Api to update an article

> Example request:

```bash
curl -X PUT "http://localhost:8000/auth/articles/1" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost:8000/auth/articles/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /auth/articles/{id}`


<!-- END_85efc05b78f7b64d79d4beba3fb59c99 -->

#Author Login


<!-- START_b982a9c2785c94e078bbe534a1f12d68 -->
## LogIn
LogIn to your account.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/login" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"email":"molestias","password":"dignissimos"}'

```

```javascript
const url = new URL("http://localhost:8000/api/login");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "molestias",
    "password": "dignissimos"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "status": true,
    "code": 200,
    "msg": "author token",
    "version": "1.0.0",
    "data": []
}
```

### HTTP Request
`POST /api/login`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | The email of your account
    password | string |  required  | The password of your account

<!-- END_b982a9c2785c94e078bbe534a1f12d68 -->

#Author management


APIs for managing authors
<!-- START_1b34809b1566de388155bca68b442b93 -->
## Show all authors

Api to list all authors

> Example request:

```bash
curl -X GET -G "http://localhost:8000/auth/authors" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost:8000/auth/authors");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /auth/authors`


<!-- END_1b34809b1566de388155bca68b442b93 -->

<!-- START_ff15446b7384a9f29854489092a43703 -->
## Show one author

Api to show one author

> Example request:

```bash
curl -X GET -G "http://localhost:8000/auth/authors/1" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost:8000/auth/authors/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response:

```json
null
```

### HTTP Request
`GET /auth/authors/{id}`


<!-- END_ff15446b7384a9f29854489092a43703 -->

<!-- START_47c15efae3a4b1feac35bee8b3aabddc -->
## Create an author

Api to create an author

> Example request:

```bash
curl -X POST "http://localhost:8000/auth/authors" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"name":"rerum","password":"rerum","email":"non","location":"laudantium","github":"fuga","twitter":"nihil"}'

```

```javascript
const url = new URL("http://localhost:8000/auth/authors");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "rerum",
    "password": "rerum",
    "email": "non",
    "location": "laudantium",
    "github": "fuga",
    "twitter": "nihil"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /auth/authors`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | The name of the author.
    password | string |  required  | The password of the author.
    email | string |  required  | The email of the author.
    location | string |  required  | The location of the author.
    github | string |  optional  | The github account of the author.
    twitter | string |  optional  | The twitter account of the author.

<!-- END_47c15efae3a4b1feac35bee8b3aabddc -->

<!-- START_7d2c961da49027ef6aae09627ce35348 -->
## Delete

Api to delete an author

> Example request:

```bash
curl -X DELETE "http://localhost:8000/auth/authors/1" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost:8000/auth/authors/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE /auth/authors/{id}`


<!-- END_7d2c961da49027ef6aae09627ce35348 -->

<!-- START_3684312cf09d8bd9ef756190d31ea7be -->
## Update

Api to update an author

> Example request:

```bash
curl -X PUT "http://localhost:8000/auth/authors/1" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost:8000/auth/authors/1");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /auth/authors/{id}`


<!-- END_3684312cf09d8bd9ef756190d31ea7be -->


