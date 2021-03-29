# Role Management

APIs for managing Roles

## Get all Roles

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you get all the Roles

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/role" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/role"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/role',
    [
        'headers' => [
            'Authorization' => 'Bearer {YOUR_AUTH_KEY}',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/role'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()
```


> Example response (403):

```json
{
    "status": "error",
    "message": "Access Denied"
}
```
<div id="execution-results-GETapi-role" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-role"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-role"></code></pre>
</div>
<div id="execution-error-GETapi-role" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-role"></code></pre>
</div>
<form id="form-GETapi-role" data-method="GET" data-path="api/role" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-role', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-role" onclick="tryItOut('GETapi-role');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-role" onclick="cancelTryOut('GETapi-role');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-role" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/role</code></b>
</p>
<p>
<label id="auth-GETapi-role" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-role" data-component="header"></label>
</p>
</form>


## Store a Role

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you store a new Role

> Example request:

```bash
curl -X POST \
    "http://localhost/api/role" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"Admin","slug":"admin","permissions":{"test.all":true,"test.get":true,"test.add":false,"test.update":false,"test.delete":false}}'

```

```javascript
const url = new URL(
    "http://localhost/api/role"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Admin",
    "slug": "admin",
    "permissions": {
        "test.all": true,
        "test.get": true,
        "test.add": false,
        "test.update": false,
        "test.delete": false
    }
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost/api/role',
    [
        'headers' => [
            'Authorization' => 'Bearer {YOUR_AUTH_KEY}',
            'Accept' => 'application/json',
        ],
        'json' => [
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.add' => false,
                'test.update' => false,
                'test.delete' => false,
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/role'
payload = {
    "name": "Admin",
    "slug": "admin",
    "permissions": {
        "test.all": true,
        "test.get": true,
        "test.add": false,
        "test.update": false,
        "test.delete": false
    }
}
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


<div id="execution-results-POSTapi-role" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-role"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-role"></code></pre>
</div>
<div id="execution-error-POSTapi-role" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-role"></code></pre>
</div>
<form id="form-POSTapi-role" data-method="POST" data-path="api/role" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-role', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-role" onclick="tryItOut('POSTapi-role');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-role" onclick="cancelTryOut('POSTapi-role');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-role" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/role</code></b>
</p>
<p>
<label id="auth-POSTapi-role" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-role" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="POSTapi-role" data-component="body" required  hidden>
<br>
The name of the new Role.</p>
<p>
<b><code>slug</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="slug" data-endpoint="POSTapi-role" data-component="body" required  hidden>
<br>
The slug of the new Role.</p>
<p>
<b><code>permissions</code></b>&nbsp;&nbsp;<small>string[]</small>  &nbsp;
<input type="text" name="permissions.0" data-endpoint="POSTapi-role" data-component="body" required  hidden>
<input type="text" name="permissions.1" data-endpoint="POSTapi-role" data-component="body" hidden>
<br>
The permission for this Role.</p>

</form>


## Update a Role

<small class="badge badge-darkred">requires authentication</small>

This endpoint lets you update a single Role

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/role/qui" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/role/qui"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://localhost/api/role/qui',
    [
        'headers' => [
            'Authorization' => 'Bearer {YOUR_AUTH_KEY}',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/role/qui'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers)
response.json()
```


<div id="execution-results-PUTapi-role--role-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTapi-role--role-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-role--role-"></code></pre>
</div>
<div id="execution-error-PUTapi-role--role-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-role--role-"></code></pre>
</div>
<form id="form-PUTapi-role--role-" data-method="PUT" data-path="api/role/{role}" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTapi-role--role-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTapi-role--role-" onclick="tryItOut('PUTapi-role--role-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTapi-role--role-" onclick="cancelTryOut('PUTapi-role--role-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTapi-role--role-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>api/role/{role}</code></b>
</p>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>api/role/{role}</code></b>
</p>
<p>
<label id="auth-PUTapi-role--role-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="PUTapi-role--role-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>role</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="role" data-endpoint="PUTapi-role--role-" data-component="url" required  hidden>
<br>
</p>
</form>



