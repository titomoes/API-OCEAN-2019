---
title: API Reference OCEAN

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
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## Registra um Usuário.

> Example request:

```bash
curl -X POST "http://localhost/api/register" \
    -H "Content-Type: application/json" \
    -d '{"name":"vwcfnoWWFsDlzlhZ","email":"oN0Tohe0p7hK5K0f","password":"kIJhgGxm23eRmR07","password_confirmation":"TBdifpuq59BsswTM"}'

```

```javascript
const url = new URL("http://localhost/api/register");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "vwcfnoWWFsDlzlhZ",
    "email": "oN0Tohe0p7hK5K0f",
    "password": "kIJhgGxm23eRmR07",
    "password_confirmation": "TBdifpuq59BsswTM"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (201):

```json
{
    "id": 1,
    "name": "Jessica Jones",
    "email": "js@uea.edu.br",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "api_token": "Vn9TWl6dGEXZt0XRn7k0z13rbBss17VoWjXy3j3Si76bp9SFXm1mV16jzAQL"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": [
        "name: The name field is required.",
        "name: The name may not be greater than 255 characters.",
        "email: The email field is required.",
        "email: The email may not be greater than 255 characters.",
        "email: The email has already been taken.",
        "email: The email must be a valid email address.",
        "password : The password field is required.",
        "password : The password must be at least 8 characters.",
        "password : The password confirmation does not match."
    ]
}
```

### HTTP Request
`POST api/register`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | O nome do usuário.
    email | string |  required  | O email do usuário.
    password | string |  required  | A senha do usuário.
    password_confirmation | string |  required  | A confirmação da senha do usuário.

<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## Loga um Usuário.

> Example request:

```bash
curl -X POST "http://localhost/api/login" \
    -H "Content-Type: application/json" \
    -d '{"name":"5GVKBD4I7gYzvt8R","password":"xPBacMO0VZjGqstS"}'

```

```javascript
const url = new URL("http://localhost/api/login");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "5GVKBD4I7gYzvt8R",
    "password": "xPBacMO0VZjGqstS"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (201):

```json
{
    "id": 1,
    "name": "Jessica Jones",
    "email": "js@uea.edu.br",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "api_token": "Vn9TWl6dGEXZt0XRn7k0z13rbBss17VoWjXy3j3Si76bp9SFXm1mV16jzAQL"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": [
        "email: The email field is required.",
        "email: The email may not be greater than 255 characters.",
        "email: The email must be a valid email address.",
        "password : The password field is required.",
        "password : The password must be at least 8 characters."
    ]
}
```

### HTTP Request
`POST api/login`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | O nome do usuário.
    password | string |  required  | A senha do usuário.

<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_61739f3220a224b34228600649230ad1 -->
## Desloga um Usuário.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "http://localhost/api/logout" 
```

```javascript
const url = new URL("http://localhost/api/logout");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data": "User logged out."
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```

### HTTP Request
`POST api/logout`


<!-- END_61739f3220a224b34228600649230ad1 -->

<!-- START_742a1cbd4a274c7269f0db99a704ff41 -->
## Lista todos os Eventos.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/api/events" 
```

```javascript
const url = new URL("http://localhost/api/events");

let headers = {
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

> Example response (200):

```json
{
    "id": 3,
    "name": "Festa",
    "lat": "-3.087147",
    "lng": "-60.006116",
    "date_event": "2016-04-15",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "user_id": 1
}
```
> Example response (404):

```json
{
    "erro": "01 = No query results"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```

### HTTP Request
`GET api/events`


<!-- END_742a1cbd4a274c7269f0db99a704ff41 -->

<!-- START_de3413bf02c9bb71627fa96e1c1c409f -->
## Salva o Evento no Banco de Dados.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "http://localhost/api/events" \
    -H "Content-Type: application/json" \
    -d '{"name":"kzJVEqG79Ul2pFYU","lat":"SqjLyZrXQOsMrvKe","lng":"9M173aF5vQbaPehb","date_event":"lNuPKuNyQD1NcRIt","user_id":2}'

```

```javascript
const url = new URL("http://localhost/api/events");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "kzJVEqG79Ul2pFYU",
    "lat": "SqjLyZrXQOsMrvKe",
    "lng": "9M173aF5vQbaPehb",
    "date_event": "lNuPKuNyQD1NcRIt",
    "user_id": 2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (201):

```json
{
    "id": 3,
    "name": "Festa",
    "lat": "-3.087147",
    "lng": "-60.006116",
    "date_event": "2016-04-15",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "user_id": 1
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": [
        "name: The name field is required.",
        "name: The name may not be greater than 255 characters.",
        "date_event: The date_event field is required.",
        "date_event: The date event does not match the format Y\/m\/d.",
        "lat: The lat field is required.",
        "lat: The lat may not be greater than 255 characters.",
        "lng: The lng field is required.",
        "lng: The lng may not be greater than 255 characters.",
        "user_id: The user_id field is required.",
        "user_id: The selected user id is invalid."
    ]
}
```
> Example response (400):

```json
{
    "erro": "02 = No create the object"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```

### HTTP Request
`POST api/events`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | O nome do evento.
    lat | string |  required  | A latitude do evento.
    lng | string |  required  | A longitude do evento.
    date_event | date |  required  | A data que irá ocorrer o evento.
    user_id | integer |  required  | O id do usuário que criou o evento.

<!-- END_de3413bf02c9bb71627fa96e1c1c409f -->

<!-- START_379a3beb17bbb91528d80d8507f69655 -->
## Mostra um Evento específico dado o id.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/api/events/{event}" 
```

```javascript
const url = new URL("http://localhost/api/events/{event}");

    let params = {
            "event": "GHZGsxljbS2oH2l9",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
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

> Example response (200):

```json
{
    "id": 3,
    "name": "Festa",
    "lat": "-3.087147",
    "lng": "-60.006116",
    "date_event": "2016-04-15",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "user_id": 1
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```
> Example response (404):

```json
{
    "erro": "01 = No query results"
}
```

### HTTP Request
`GET api/events/{event}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    event |  required  | O id do evento

<!-- END_379a3beb17bbb91528d80d8507f69655 -->

<!-- START_d16967fd1d3d935666f7e8112a1a4451 -->
## Atualiza os dados de um Evento específico.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT "http://localhost/api/events/{event}" \
    -H "Content-Type: application/json" \
    -d '{"name":"FjbWlO1d2aOq7ZWM","lat":"b8g4ZlF15VLDSraW","lng":"G60pk8GUHaY6CqYw","date_event":"Xn0Bi8hgJox3D6JO","user_id":13}'

```

```javascript
const url = new URL("http://localhost/api/events/{event}");

    let params = {
            "event": "5apHJyAhVkpVRcsx",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "FjbWlO1d2aOq7ZWM",
    "lat": "b8g4ZlF15VLDSraW",
    "lng": "G60pk8GUHaY6CqYw",
    "date_event": "Xn0Bi8hgJox3D6JO",
    "user_id": 13
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "id": 3,
    "name": "Festa",
    "lat": "-3.087147",
    "lng": "-60.006116",
    "date_event": "2016-04-15",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "user_id": 1
}
```
> Example response (404):

```json
{
    "erro": "03 = No update the object"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": [
        "name: The name may not be greater than 255 characters.",
        "date_event: The date event does not match the format Y\/m\/d.",
        "lat: The lat may not be greater than 255 characters.",
        "lng: The lng may not be greater than 255 characters.",
        "user_id: The selected user id is invalid."
    ]
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```

### HTTP Request
`PUT api/events/{event}`

`PATCH api/events/{event}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | O nome do evento.
    lat | string |  optional  | A latitude do evento.
    lng | string |  optional  | A longitude do evento.
    date_event | date |  optional  | A data que irá ocorrer o evento.
    user_id | integer |  optional  | O id do usuário que criou o evento.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    event |  required  | O id do evento

<!-- END_d16967fd1d3d935666f7e8112a1a4451 -->

<!-- START_379a30feb2949828b5f95efbfd7649c3 -->
## Remove um Evento específico .

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE "http://localhost/api/events/{event}" 
```

```javascript
const url = new URL("http://localhost/api/events/{event}");

    let params = {
            "event": "bGGwh4hgMamixu2R",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
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

> Example response (204):

```json
{
    "data": "Event Deleted"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```
> Example response (404):

```json
{
    "erro": "04 = No delete the object"
}
```

### HTTP Request
`DELETE api/events/{event}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    event |  required  | O id do evento

<!-- END_379a30feb2949828b5f95efbfd7649c3 -->

<!-- START_e514be6d885d368238f4d54e8dc181b0 -->
## Pesquisa um Evento por nome .

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/api/event/{name}" 
```

```javascript
const url = new URL("http://localhost/api/event/{name}");

    let params = {
            "name": "moDfFZcbTHit5jRF",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
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

> Example response (200):

```json
{
    "id": 3,
    "name": "Festa",
    "lat": "-3.087147",
    "lng": "-60.006116",
    "date_event": "2016-04-15",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "user_id": 1
}
```
> Example response (404):

```json
{
    "erro": "01 = No query results"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": [
        "name: The name may not be greater than 255 characters."
    ]
}
```

### HTTP Request
`GET api/event/{name}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    name |  required  | O nome do evento em busca

<!-- END_e514be6d885d368238f4d54e8dc181b0 -->

<!-- START_ca0ded76dada7c8dfc72118bab0cc6e5 -->
## Pesquisa um Evento por dia .

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/api/events/day/{day}" 
```

```javascript
const url = new URL("http://localhost/api/events/day/{day}");

    let params = {
            "day": "EAxQENHDU6jKC7oB",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
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

> Example response (200):

```json
{
    "id": 3,
    "name": "Festa",
    "lat": "-3.087147",
    "lng": "-60.006116",
    "date_event": "2016-04-15",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "user_id": 1
}
```
> Example response (404):

```json
{
    "erro": "01 = No query results"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": [
        "day: The day may not be greater than 31 characters.",
        "day: The day must be an integer.",
        "day: The day must be at least 1."
    ]
}
```

### HTTP Request
`GET api/events/day/{day}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    day |  required  | O dia do evento

<!-- END_ca0ded76dada7c8dfc72118bab0cc6e5 -->

<!-- START_427ad293178719e24a5b74a2f044cc63 -->
## Pesquisa um Evento por mês.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/api/events/month/{month}" 
```

```javascript
const url = new URL("http://localhost/api/events/month/{month}");

    let params = {
            "month": "YIKozVqgav99QM9S",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
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

> Example response (200):

```json
{
    "id": 3,
    "name": "Festa",
    "lat": "-3.087147",
    "lng": "-60.006116",
    "date_event": "2016-04-15",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "user_id": 1
}
```
> Example response (404):

```json
{
    "erro": "01 = No query results"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": [
        "month: The day may not be greater than 12 characters.",
        "month: The day must be an integer.",
        "month: The day must be at least 1."
    ]
}
```

### HTTP Request
`GET api/events/month/{month}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    month |  required  | O mês do evento

<!-- END_427ad293178719e24a5b74a2f044cc63 -->

<!-- START_924b94df68bea7de7544fee693791262 -->
## Pesquisa um Evento por ano .

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/api/events/year/{year}" 
```

```javascript
const url = new URL("http://localhost/api/events/year/{year}");

    let params = {
            "year": "rQamKHl8DBuNrz96",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
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

> Example response (200):

```json
{
    "id": 3,
    "name": "Festa",
    "lat": "-3.087147",
    "lng": "-60.006116",
    "date_event": "2016-04-15",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "user_id": 1
}
```
> Example response (404):

```json
{
    "erro": "01 = No query results"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": [
        "month: The day must be an integer.",
        "month: The day must be at least 1900.",
        "month: The year must be 4 digits."
    ]
}
```

### HTTP Request
`GET api/events/year/{year}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    year |  required  | O ano do evento

<!-- END_924b94df68bea7de7544fee693791262 -->

<!-- START_fc1e4f6a697e3c48257de845299b71d5 -->
## Lista todos os Usuários.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/api/users" 
```

```javascript
const url = new URL("http://localhost/api/users");

let headers = {
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

> Example response (200):

```json
{
    "id": 1,
    "name": "Jessica Jones",
    "email": "js@uea.edu.br",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "api_token": "Vn9TWl6dGEXZt0XRn7k0z13rbBss17VoWjXy3j3Si76bp9SFXm1mV16jzAQL"
}
```
> Example response (404):

```json
{
    "erro": "01 = No query results"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```

### HTTP Request
`GET api/users`


<!-- END_fc1e4f6a697e3c48257de845299b71d5 -->

<!-- START_12e37982cc5398c7100e59625ebb5514 -->
## Salva o Usuário no Banco de Dados.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "http://localhost/api/users" \
    -H "Content-Type: application/json" \
    -d '{"name":"v5pPgOgsMspm6NH2","email":"QNkxeNhRPnjxc080","password":"v4E1vYArW4VHbiCM"}'

```

```javascript
const url = new URL("http://localhost/api/users");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "v5pPgOgsMspm6NH2",
    "email": "QNkxeNhRPnjxc080",
    "password": "v4E1vYArW4VHbiCM"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (201):

```json
{
    "id": 1,
    "name": "Jessica Jones",
    "email": "js@uea.edu.br",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "api_token": "Vn9TWl6dGEXZt0XRn7k0z13rbBss17VoWjXy3j3Si76bp9SFXm1mV16jzAQL"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": [
        "name: The name field is required.",
        "name: The name may not be greater than 255 characters.",
        "email: The email field is required.",
        "email: The email may not be greater than 255 characters.",
        "email: The email has already been taken.",
        "email: The email must be a valid email address.",
        "password : The password field is required.",
        "password : The password must be at least 8 characters."
    ]
}
```
> Example response (400):

```json
{
    "erro": "02 = No create the object"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```

### HTTP Request
`POST api/users`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | O nome do usuário.
    email | string |  required  | O email do usuário.
    password | string |  required  | A senha do usuário.

<!-- END_12e37982cc5398c7100e59625ebb5514 -->

<!-- START_8653614346cb0e3d444d164579a0a0a2 -->
## Mostra um Usuário específico dado o id.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/api/users/{user}" 
```

```javascript
const url = new URL("http://localhost/api/users/{user}");

    let params = {
            "user": "iACW6iBpTHS18vUT",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
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

> Example response (200):

```json
{
    "id": 1,
    "name": "Jessica Jones",
    "email": "js@uea.edu.br",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "api_token": "Vn9TWl6dGEXZt0XRn7k0z13rbBss17VoWjXy3j3Si76bp9SFXm1mV16jzAQL"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```
> Example response (404):

```json
{
    "erro": "01 = No query results"
}
```

### HTTP Request
`GET api/users/{user}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    user |  required  | O id do usuário.

<!-- END_8653614346cb0e3d444d164579a0a0a2 -->

<!-- START_48a3115be98493a3c866eb0e23347262 -->
## Atualiza os dados de um usuário específico.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT "http://localhost/api/users/{user}" 
```

```javascript
const url = new URL("http://localhost/api/users/{user}");

    let params = {
            "user": "pOB47CJG673V8qg8",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
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

> Example response (200):

```json
{
    "id": 1,
    "name": "Jessica Jones",
    "email": "js@uea.edu.br",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "api_token": "Vn9TWl6dGEXZt0XRn7k0z13rbBss17VoWjXy3j3Si76bp9SFXm1mV16jzAQL"
}
```
> Example response (404):

```json
{
    "erro": "03 = No update the object"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": [
        "name: The name may not be greater than 255 characters.",
        "email: The email may not be greater than 255 characters.",
        "email: The email must be a valid email address.",
        "password : The password must be at least 8 characters."
    ]
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```

### HTTP Request
`PUT api/users/{user}`

`PATCH api/users/{user}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    user |  required  | O id do usuário.

<!-- END_48a3115be98493a3c866eb0e23347262 -->

<!-- START_d2db7a9fe3abd141d5adbc367a88e969 -->
## Remove um usuário específico .

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE "http://localhost/api/users/{user}" 
```

```javascript
const url = new URL("http://localhost/api/users/{user}");

    let params = {
            "user": "nZCiXm7Gk2YAO8IL",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
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

> Example response (204):

```json
{
    "data": "User Deleted"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```
> Example response (404):

```json
{
    "erro": "04 = No delete the object"
}
```

### HTTP Request
`DELETE api/users/{user}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    user |  required  | O id do usuário.

<!-- END_d2db7a9fe3abd141d5adbc367a88e969 -->

<!-- START_c16000cacc567eb9ad8fb18103baaa4f -->
## Pesquisa um usuário por nome.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/api/user/{name}" 
```

```javascript
const url = new URL("http://localhost/api/user/{name}");

    let params = {
            "name": "inMhEFk7S3HbgAS7",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
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

> Example response (200):

```json
{
    "id": 1,
    "name": "Jessica Jones",
    "email": "js@uea.edu.br",
    "updated_at": "2019-04-15 12:20:44",
    "created_at": "2019-04-15 12:20:44",
    "api_token": "Vn9TWl6dGEXZt0XRn7k0z13rbBss17VoWjXy3j3Si76bp9SFXm1mV16jzAQL"
}
```
> Example response (404):

```json
{
    "erro": "01 = No query results"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": [
        "name: The name may not be greater than 255 characters."
    ]
}
```

### HTTP Request
`GET api/user/{name}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    name |  required  | O nome do usuário.

<!-- END_c16000cacc567eb9ad8fb18103baaa4f -->

<!-- START_e395370972415f095d8538799af262b3 -->
## Inscrever em um Evento.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST "http://localhost/api/event/{event_id}/user/{user_id}" 
```

```javascript
const url = new URL("http://localhost/api/event/{event_id}/user/{user_id}");

    let params = {
            "event_id": "SQmGDF8rkWkVTCj1",
            "user_id": "IAZPNkN2xSJ7FxDZ",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "message": "Subscribed"
}
```
> Example response (404):

```json
{
    "erro": "05 = Not find user"
}
```
> Example response (404):

```json
{
    "erro": "06 = Not find event"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```

### HTTP Request
`POST api/event/{event_id}/user/{user_id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    event_id |  required  | O id do evento.
    user_id |  required  | O id do usuario.

<!-- END_e395370972415f095d8538799af262b3 -->

<!-- START_54bc8c65ad18b3df48ff98e2d6bce244 -->
## Realiza check-in em Evento por GPS .

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
O check-in é realizado  através da formula de Haversine e para o check-in funcionar tem que estar em um raio de 2km ao redor do evento

> Example request:

```bash
curl -X GET -G "http://localhost/api/event/{id}/lat/{lat}/lng/{lng}" 
```

```javascript
const url = new URL("http://localhost/api/event/{id}/lat/{lat}/lng/{lng}");

    let params = {
            "id": "FCNAxtZcd561jW1o",
            "lat": "QymTh6AohOxDfS9x",
            "lng": "wFjdHhzBnmyvPPMB",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
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

> Example response (200):

```json
{
    "Check-in": "yes"
}
```
> Example response (200):

```json
{
    "Check-in": "no"
}
```
> Example response (401):

```json
{
    "message": "Unauthenticated"
}
```

### HTTP Request
`GET api/event/{id}/lat/{lat}/lng/{lng}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | string required O id do evento.
    lat |  optional  | string required A latitude do usuario.
    lng |  optional  | string required A longitude do usuario.

<!-- END_54bc8c65ad18b3df48ff98e2d6bce244 -->


