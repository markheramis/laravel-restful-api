<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel-Restful-API</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/vendor/scribe/css/theme-default.style.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('/vendor/scribe/css/theme-default.print.css') }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
        body .content .bash-example code {
            display: none;
        }

        body .content .javascript-example code {
            display: none;
        }

        body .content .php-example code {
            display: none;
        }

        body .content .python-example code {
            display: none;
        }
    </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset('/vendor/scribe/js/tryitout-4.29.0.js') }}"></script>
    <script src="{{ asset('/vendor/scribe/js/theme-default-4.29.0.js') }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;,&quot;python&quot;]">

    <a href="#" id="nav-button">
        <span>
            MENU
            <img src="{{ asset('/vendor/scribe/images/navbar.png') }}" alt="navbar-image" />
        </span>
    </a>
    <div class="tocify-wrapper">
        <img src="/logo.png" alt="logo" class="logo" style="padding-top: 10px;" width="100%" />

        <div class="lang-selector">
            <button type="button" class="lang-button" data-language-name="bash">bash</button>
            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
            <button type="button" class="lang-button" data-language-name="php">php</button>
            <button type="button" class="lang-button" data-language-name="python">python</button>
        </div>

        <div class="search">
            <input type="text" class="search" id="input-search" placeholder="Search">
        </div>

        <div id="toc">
            <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
            </ul>
            <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
            </ul>
            <ul id="tocify-header-media-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="media-management">
                    <a href="#media-management">Media Management</a>
                </li>
                <ul id="tocify-subheader-media-management" class="tocify-subheader">
                    <li class="tocify-item level-2" data-unique="media-management-GETapi-media">
                        <a href="#media-management-GETapi-media">Get all Media</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="media-management-POSTapi-media">
                        <a href="#media-management-POSTapi-media">Store a Media</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="media-management-GETapi-media--media_id-">
                        <a href="#media-management-GETapi-media--media_id-">Show a Media</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="media-management-PUTapi-media--media_id-">
                        <a href="#media-management-PUTapi-media--media_id-">Update a Media
                            This endpoint lets you update a Media File matching the provided ID.</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="media-management-DELETEapi-media--media_id-">
                        <a href="#media-management-DELETEapi-media--media_id-">Delete a Media</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="media-management-GETapi-media--media_id--download">
                        <a href="#media-management-GETapi-media--media_id--download">GET
                            api/media/{media_id}/download</a>
                    </li>
                </ul>
            </ul>
            <ul id="tocify-header-permission-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="permission-management">
                    <a href="#permission-management">Permission Management</a>
                </li>
                <ul id="tocify-subheader-permission-management" class="tocify-subheader">
                    <li class="tocify-item level-2" data-unique="permission-management-GETapi-permission">
                        <a href="#permission-management-GETapi-permission">Get all Permissions</a>
                    </li>
                </ul>
            </ul>
            <ul id="tocify-header-role-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="role-management">
                    <a href="#role-management">Role Management</a>
                </li>
                <ul id="tocify-subheader-role-management" class="tocify-subheader">
                    <li class="tocify-item level-2" data-unique="role-management-GETapi-role">
                        <a href="#role-management-GETapi-role">Get all Roles</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="role-management-POSTapi-role">
                        <a href="#role-management-POSTapi-role">Store a Role</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="role-management-GETapi-role-stats">
                        <a href="#role-management-GETapi-role-stats">Role stats</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="role-management-GETapi-role--slug-">
                        <a href="#role-management-GETapi-role--slug-">Show a Role</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="role-management-PUTapi-role--slug-">
                        <a href="#role-management-PUTapi-role--slug-">Update a Role</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="role-management-DELETEapi-role--slug-">
                        <a href="#role-management-DELETEapi-role--slug-">Delete a Role</a>
                    </li>
                </ul>
            </ul>
            <ul id="tocify-header-user-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="user-management">
                    <a href="#user-management">User Management</a>
                </li>
                <ul id="tocify-subheader-user-management" class="tocify-subheader">
                    <li class="tocify-item level-2" data-unique="user-management-POSTapi-auth-login">
                        <a href="#user-management-POSTapi-auth-login">Login API</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-POSTapi-auth-register">
                        <a href="#user-management-POSTapi-auth-register">Register API</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-POSTapi-auth-activate">
                        <a href="#user-management-POSTapi-auth-activate">Activate a User</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-POSTapi-auth-password-forgot">
                        <a href="#user-management-POSTapi-auth-password-forgot">Forgot Password</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-PUTapi-auth-password-reset">
                        <a href="#user-management-PUTapi-auth-password-reset">Reset Password</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-GETapi-auth-me">
                        <a href="#user-management-GETapi-auth-me">Me API</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-POSTapi-auth-logout">
                        <a href="#user-management-POSTapi-auth-logout">Logout API</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-GETapi-user">
                        <a href="#user-management-GETapi-user">Get all Users</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-POSTapi-user">
                        <a href="#user-management-POSTapi-user">Store User</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-PUTapi-user-mfa">
                        <a href="#user-management-PUTapi-user-mfa">PUT api/user/mfa</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-POSTapi-user-change">
                        <a href="#user-management-POSTapi-user-change">Change Password</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-GETapi-user--id-">
                        <a href="#user-management-GETapi-user--id-">Get a User</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-PUTapi-user--id-">
                        <a href="#user-management-PUTapi-user--id-">Update a User</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-POSTapi-user--user_id--mfa">
                        <a href="#user-management-POSTapi-user--user_id--mfa">POST api/user/{user_id}/mfa</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-DELETEapi-user--user_id--mfa">
                        <a href="#user-management-DELETEapi-user--user_id--mfa">DELETE api/user/{user_id}/mfa</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-GETapi-user--user_id--qr">
                        <a href="#user-management-GETapi-user--user_id--qr">GET api/user/{user_id}/qr</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-management-DELETEapi-user--id-">
                        <a href="#user-management-DELETEapi-user--id-">Destroy a User</a>
                    </li>
                </ul>
            </ul>
            <ul id="tocify-header-user-permission-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="user-permission-management">
                    <a href="#user-permission-management">User Permission Management</a>
                </li>
                <ul id="tocify-subheader-user-permission-management" class="tocify-subheader">
                    <li class="tocify-item level-2"
                        data-unique="user-permission-management-GETapi-user--user_id--permission">
                        <a href="#user-permission-management-GETapi-user--user_id--permission">Get User Permission</a>
                    </li>
                    <li class="tocify-item level-2"
                        data-unique="user-permission-management-PUTapi-user--user_id--permission">
                        <a href="#user-permission-management-PUTapi-user--user_id--permission">Update User
                            Permission</a>
                    </li>
                    <li class="tocify-item level-2"
                        data-unique="user-permission-management-POSTapi-user--user_id--permission">
                        <a href="#user-permission-management-POSTapi-user--user_id--permission">Store User
                            Permission</a>
                    </li>
                    <li class="tocify-item level-2"
                        data-unique="user-permission-management-DELETEapi-user--user_id--permission">
                        <a href="#user-permission-management-DELETEapi-user--user_id--permission">Destroy User
                            Permission</a>
                    </li>
                </ul>
            </ul>
            <ul id="tocify-header-user-role-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="user-role-management">
                    <a href="#user-role-management">User Role Management</a>
                </li>
                <ul id="tocify-subheader-user-role-management" class="tocify-subheader">
                    <li class="tocify-item level-2" data-unique="user-role-management-GETapi-user--user_id--role">
                        <a href="#user-role-management-GETapi-user--user_id--role">Get User Roles</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-role-management-POSTapi-user--user_id--role">
                        <a href="#user-role-management-POSTapi-user--user_id--role">Add Role to User</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-role-management-PUTapi-user--user_id--role">
                        <a href="#user-role-management-PUTapi-user--user_id--role">Update Role to User</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="user-role-management-DELETEapi-user--user_id--role">
                        <a href="#user-role-management-DELETEapi-user--user_id--role">Delete a User's Role</a>
                    </li>
                </ul>
            </ul>
        </div>

        <ul class="toc-footer" id="toc-footer">
            <li style="padding-bottom: 5px;"><a href="{{ route('scribe.postman') }}">View Postman collection</a></li>
            <li style="padding-bottom: 5px;"><a href="{{ route('scribe.openapi') }}">View OpenAPI spec</a></li>
            <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
        </ul>

        <ul class="toc-footer" id="last-updated">
            <li>Last updated: February 8, 2024</li>
        </ul>
    </div>

    <div class="page-wrapper">
        <div class="dark-box"></div>
        <div class="content">
            <h1 id="introduction">Introduction</h1>
            <aside>
                <strong>Base URL</strong>: <code>http://localhost:8000</code>
            </aside>
            <p>This documentation aims to provide all the information you need to work with our API.</p>
            <aside>As you scroll, you'll see code examples for working with the API in different programming languages
                in the dark area to the right (or as part of the content on mobile).
                You can switch the language used with the tabs at the top right (or from the nav menu at the top left on
                mobile).</aside>

            <h1 id="authenticating-requests">Authenticating requests</h1>
            <p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value
                <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.
            </p>
            <p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the
                documentation below.</p>
            <p>You can retrieve your token by submitting the correct login information in the <b>Login Endpoint</b>.</p>

            <h1 id="media-management">Media Management</h1>

            <p>APIs for managing Media</p>

            <h2 id="media-management-GETapi-media">Get all Media</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you get all the Media</p>

            <span id="example-requests-GETapi-media">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre>
                        <code class="language-bash">
                            curl --request GET \
                            --get "http://localhost:8000/api/media" \
                            --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
                            --header "Content-Type: application/json" \
                            --header "Accept: application/json"
                        </code>
                    </pre>
                </div>


                <div class="javascript-example">
                    <pre>
                        <code class="language-javascript">
                            const url = new URL(
                                "http://localhost:8000/api/media"
                            );
                            const headers = {
                                "Authorization": "Bearer {YOUR_AUTH_KEY}",
                                "Content-Type": "application/json",
                                "Accept": "application/json",
                            };
                            fetch(url, {
                                method: "GET",
                                headers,
                            }).then(response =&gt; response.json());
                        </code>
                    </pre>
                </div>
                <div class="php-example">
                    <pre>
                        <code class="language-php">$client = new \GuzzleHttp\Client();
                            $response = $client-&gt;get(
                                'http://localhost:8000/api/media',
                                [
                                    'headers' =&gt; [
                                        'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
                                        'Content-Type' =&gt; 'application/json',
                                        'Accept' =&gt; 'application/json',
                                    ],
                                ]
                            );
                            $body = $response-&gt;getBody();
                            print_r(json_decode((string) $body));
                        </code>
                    </pre>
                </div>
                <div class="python-example">
                    <pre>
                        <code class="language-python">
                            import requests
                            import json

                            url = 'http://localhost:8000/api/media'
                            headers = {
                            'Authorization': 'Bearer {YOUR_AUTH_KEY}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                            }

                            response = requests.request('GET', url, headers=headers)
                            response.json()
                        </code>
                    </pre>
                </div>

            </span>

            <span id="example-responses-GETapi-media">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=SwR5p1DmrOX2UHxWhmGZHWThs0sqeGMZS8GUypPI; expires=Thu, 08 Feb 2024 07:39:31 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-media" hidden>
                <blockquote>Received response<span id="execution-response-status-GETapi-media"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-media" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-media" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-media"></code></pre>
            </span>
            <form id="form-GETapi-media" data-method="GET" data-path="api/media" data-authed="1" data-hasfiles="0"
                data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-media', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-media" onclick="tryItOut('GETapi-media');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-media" onclick="cancelTryOut('GETapi-media');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-media" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/media</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="GETapi-media" value="Bearer {YOUR_AUTH_KEY}" data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type" data-endpoint="GETapi-media"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-media"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
            </form>

            <h2 id="media-management-POSTapi-media">Store a Media</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you store a new Media</p>

            <span id="example-requests-POSTapi-media">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre>
                        <code class="language-bash">
                            curl --request POST \
                            "http://localhost:8000/api/media" \
                            --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
                            --header "Content-Type: multipart/form-data" \
                            --header "Accept: application/json" \
                            --form "status=nam" \
                            --form "description=Voluptatum rem velit perspiciatis aspernatur quasi sunt in." \
                            --form "meta[is_dicom]=" \
                            --form "file=@/tmp/phpvv1XEU"
                        </code>
                    </pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/media"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('status', 'nam');
body.append('description', 'Voluptatum rem velit perspiciatis aspernatur quasi sunt in.');
body.append('meta[is_dicom]', '');
body.append('file', document.querySelector('input[name="file"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8000/api/media',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'multipart/form-data',
            'Accept' =&gt; 'application/json',
        ],
        'multipart' =&gt; [
            [
                'name' =&gt; 'status',
                'contents' =&gt; 'nam'
            ],
            [
                'name' =&gt; 'description',
                'contents' =&gt; 'Voluptatum rem velit perspiciatis aspernatur quasi sunt in.'
            ],
            [
                'name' =&gt; 'meta[is_dicom]',
                'contents' =&gt; ''
            ],
            [
                'name' =&gt; 'file',
                'contents' =&gt; fopen('/tmp/phpvv1XEU', 'r')
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/media'
files = {
  'file': open('/tmp/phpvv1XEU', 'rb')
}
payload = {
    "status": "nam",
    "description": "Voluptatum rem velit perspiciatis aspernatur quasi sunt in.",
    "meta": {
        "is_dicom": false
    }
}
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'multipart/form-data',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, files=files, data=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-media">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=hhDkEMZwHbDi6RDPvL48zcXfWg01Ud0ulmq9leuP; expires=Thu, 08 Feb 2024 07:39:33 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-POSTapi-media" hidden>
                <blockquote>Received response<span id="execution-response-status-POSTapi-media"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-media" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-media" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-media"></code></pre>
            </span>
            <form id="form-POSTapi-media" data-method="POST" data-path="api/media" data-authed="1"
                data-hasfiles="1" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-media', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-media" onclick="tryItOut('POSTapi-media');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-media" onclick="cancelTryOut('POSTapi-media');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-media" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/media</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="POSTapi-media" value="Bearer {YOUR_AUTH_KEY}" data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type" data-endpoint="POSTapi-media"
                        value="multipart/form-data" data-component="header">
                    <br>
                    <p>Example: <code>multipart/form-data</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept" data-endpoint="POSTapi-media"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>file</code></b>&nbsp;&nbsp;
                    <small>file</small>&nbsp;
                    &nbsp;
                    <input type="file" style="display: none" name="file" data-endpoint="POSTapi-media"
                        value="" data-component="body">
                    <br>
                    <p>Must be a file. Example: <code>/tmp/phpvv1XEU</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="status" data-endpoint="POSTapi-media"
                        value="nam" data-component="body">
                    <br>
                    <p>Example: <code>nam</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="description" data-endpoint="POSTapi-media"
                        value="Voluptatum rem velit perspiciatis aspernatur quasi sunt in." data-component="body">
                    <br>
                    <p>Example: <code>Voluptatum rem velit perspiciatis aspernatur quasi sunt in.</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <details>
                        <summary style="padding-bottom: 10px;">
                            <b style="line-height: 2;"><code>meta</code></b>&nbsp;&nbsp;
                            <small>object</small>&nbsp;
                            <i>optional</i> &nbsp;
                            <br>
                            <p>Must have at least 0 items. Must not have more than 10 items.</p>
                        </summary>
                        <div style="margin-left: 14px; clear: unset;">
                            <b style="line-height: 2;"><code>is_dicom</code></b>&nbsp;&nbsp;
                            <small>boolean</small>&nbsp;
                            <i>optional</i> &nbsp;
                            <label data-endpoint="POSTapi-media" style="display: none">
                                <input type="radio" name="meta.is_dicom" value="true"
                                    data-endpoint="POSTapi-media" data-component="body">
                                <code>true</code>
                            </label>
                            <label data-endpoint="POSTapi-media" style="display: none">
                                <input type="radio" name="meta.is_dicom" value="false"
                                    data-endpoint="POSTapi-media" data-component="body">
                                <code>false</code>
                            </label>
                            <br>
                            <p>Example: <code>false</code></p>
                        </div>
                    </details>
                </div>
            </form>

            <h2 id="media-management-GETapi-media--media_id-">Show a Media</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you get a Media</p>

            <span id="example-requests-GETapi-media--media_id-">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/media/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/media/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8000/api/media/1',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/media/1'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-media--media_id-">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=byd7VwdlrMGnJIHNUoJCRFbBwDLHI5ZkQnppTjy7; expires=Thu, 08 Feb 2024 07:39:34 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-media--media_id-" hidden>
                <blockquote>Received response<span id="execution-response-status-GETapi-media--media_id-"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-media--media_id-" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-media--media_id-" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-media--media_id-"></code></pre>
            </span>
            <form id="form-GETapi-media--media_id-" data-method="GET" data-path="api/media/{media_id}"
                data-authed="1" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-media--media_id-', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-media--media_id-" onclick="tryItOut('GETapi-media--media_id-');">Try it
                        out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-media--media_id-"
                        onclick="cancelTryOut('GETapi-media--media_id-');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-media--media_id-" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/media/{media_id}</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="GETapi-media--media_id-" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="GETapi-media--media_id-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="GETapi-media--media_id-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>media_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="media_id"
                        data-endpoint="GETapi-media--media_id-" value="1" data-component="url">
                    <br>
                    <p>The ID of the media. Example: <code>1</code></p>
                </div>
            </form>

            <h2 id="media-management-PUTapi-media--media_id-">Update a Media
                This endpoint lets you update a Media File matching the provided ID.</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>



            <span id="example-requests-PUTapi-media--media_id-">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/media/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/media/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'http://localhost:8000/api/media/1',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/media/1'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-PUTapi-media--media_id-">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=gusjsg4HLuK76ChsmF5Mio1TDFNAwbXbKl06B9Hv; expires=Thu, 08 Feb 2024 07:39:35 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-PUTapi-media--media_id-" hidden>
                <blockquote>Received response<span id="execution-response-status-PUTapi-media--media_id-"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-PUTapi-media--media_id-" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-PUTapi-media--media_id-" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-PUTapi-media--media_id-"></code></pre>
            </span>
            <form id="form-PUTapi-media--media_id-" data-method="PUT" data-path="api/media/{media_id}"
                data-authed="1" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('PUTapi-media--media_id-', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-PUTapi-media--media_id-" onclick="tryItOut('PUTapi-media--media_id-');">Try it
                        out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-PUTapi-media--media_id-"
                        onclick="cancelTryOut('PUTapi-media--media_id-');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-PUTapi-media--media_id-" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-darkblue">PUT</small>
                    <b><code>api/media/{media_id}</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="PUTapi-media--media_id-" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="PUTapi-media--media_id-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="PUTapi-media--media_id-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>media_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="media_id"
                        data-endpoint="PUTapi-media--media_id-" value="1" data-component="url">
                    <br>
                    <p>The ID of the media. Example: <code>1</code></p>
                </div>
            </form>

            <h2 id="media-management-DELETEapi-media--media_id-">Delete a Media</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you delete a single Role</p>

            <span id="example-requests-DELETEapi-media--media_id-">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/media/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/media/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'http://localhost:8000/api/media/1',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/media/1'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-DELETEapi-media--media_id-">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=Els24cqA9FDvrkW3kywz4J82NiyLCqRf76dZkN4h; expires=Thu, 08 Feb 2024 07:39:36 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-DELETEapi-media--media_id-" hidden>
                <blockquote>Received response<span id="execution-response-status-DELETEapi-media--media_id-"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-DELETEapi-media--media_id-" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-DELETEapi-media--media_id-" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-DELETEapi-media--media_id-"></code></pre>
            </span>
            <form id="form-DELETEapi-media--media_id-" data-method="DELETE" data-path="api/media/{media_id}"
                data-authed="1" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('DELETEapi-media--media_id-', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-DELETEapi-media--media_id-"
                        onclick="tryItOut('DELETEapi-media--media_id-');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-DELETEapi-media--media_id-"
                        onclick="cancelTryOut('DELETEapi-media--media_id-');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-DELETEapi-media--media_id-" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-red">DELETE</small>
                    <b><code>api/media/{media_id}</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="DELETEapi-media--media_id-" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="DELETEapi-media--media_id-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="DELETEapi-media--media_id-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>media_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="media_id"
                        data-endpoint="DELETEapi-media--media_id-" value="1" data-component="url">
                    <br>
                    <p>The ID of the media. Example: <code>1</code></p>
                </div>
            </form>

            <h2 id="media-management-GETapi-media--media_id--download">GET api/media/{media_id}/download</h2>

            <p>
            </p>



            <span id="example-requests-GETapi-media--media_id--download">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/media/1/download" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/media/1/download"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8000/api/media/1/download',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/media/1/download'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-media--media_id--download">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=SghxYM18Nobe8dSgUkSX5MtnQ5ETkL8oDZOVURxp; expires=Thu, 08 Feb 2024 07:39:36 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-media--media_id--download" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-GETapi-media--media_id--download"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-media--media_id--download" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-media--media_id--download" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-media--media_id--download"></code></pre>
            </span>
            <form id="form-GETapi-media--media_id--download" data-method="GET"
                data-path="api/media/{media_id}/download" data-authed="0" data-hasfiles="0" data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-media--media_id--download', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-media--media_id--download"
                        onclick="tryItOut('GETapi-media--media_id--download');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-media--media_id--download"
                        onclick="cancelTryOut('GETapi-media--media_id--download');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-media--media_id--download" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/media/{media_id}/download</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="GETapi-media--media_id--download" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="GETapi-media--media_id--download" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>media_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="media_id"
                        data-endpoint="GETapi-media--media_id--download" value="1" data-component="url">
                    <br>
                    <p>The ID of the media. Example: <code>1</code></p>
                </div>
            </form>

            <h1 id="permission-management">Permission Management</h1>



            <h2 id="permission-management-GETapi-permission">Get all Permissions</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint returns all the permissions available in the system.</p>

            <span id="example-requests-GETapi-permission">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/permission" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/permission"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8000/api/permission',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/permission'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-permission">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=CFhF9GqJ0v4UfJxu9jzc6xpKhPagpOeIg6R50U7Z; expires=Thu, 08 Feb 2024 07:39:30 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-permission" hidden>
                <blockquote>Received response<span id="execution-response-status-GETapi-permission"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-permission" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-permission" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-permission"></code></pre>
            </span>
            <form id="form-GETapi-permission" data-method="GET" data-path="api/permission" data-authed="1"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-permission', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-permission" onclick="tryItOut('GETapi-permission');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-permission" onclick="cancelTryOut('GETapi-permission');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-permission" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/permission</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="GETapi-permission" value="Bearer {YOUR_AUTH_KEY}" data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="GETapi-permission" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-permission"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
            </form>

            <h1 id="role-management">Role Management</h1>

            <p>APIs for managing Roles</p>

            <h2 id="role-management-GETapi-role">Get all Roles</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you get all the Roles</p>

            <span id="example-requests-GETapi-role">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/role" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/role"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8000/api/role',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/role'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-role">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=yhI61G7mwhGDcq2lIgj2HdFaL25eN3n9cXuCXbx3; expires=Thu, 08 Feb 2024 07:39:23 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-role" hidden>
                <blockquote>Received response<span id="execution-response-status-GETapi-role"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-role" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-role" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-role"></code></pre>
            </span>
            <form id="form-GETapi-role" data-method="GET" data-path="api/role" data-authed="1" data-hasfiles="0"
                data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-role', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-role" onclick="tryItOut('GETapi-role');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-role" onclick="cancelTryOut('GETapi-role');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-role" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/role</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="GETapi-role" value="Bearer {YOUR_AUTH_KEY}" data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type" data-endpoint="GETapi-role"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-role"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
            </form>

            <h2 id="role-management-POSTapi-role">Store a Role</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you store a new Role</p>

            <span id="example-requests-POSTapi-role">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/role" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"ratione\",
    \"slug\": \"tenetur\",
    \"permissions\": []
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/role"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "ratione",
    "slug": "tenetur",
    "permissions": []
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8000/api/role',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'ratione',
            'slug' =&gt; 'tenetur',
            'permissions' =&gt; [],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/role'
payload = {
    "name": "ratione",
    "slug": "tenetur",
    "permissions": []
}
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-role">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=sy0FBwRGGZUlUeyOBVNqAIbhx2Y2ymaTMhizO3Kz; expires=Thu, 08 Feb 2024 07:39:24 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-POSTapi-role" hidden>
                <blockquote>Received response<span id="execution-response-status-POSTapi-role"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-role" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-role" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-role"></code></pre>
            </span>
            <form id="form-POSTapi-role" data-method="POST" data-path="api/role" data-authed="1" data-hasfiles="0"
                data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-role', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-role" onclick="tryItOut('POSTapi-role');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-role" onclick="cancelTryOut('POSTapi-role');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-role" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/role</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="POSTapi-role" value="Bearer {YOUR_AUTH_KEY}" data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type" data-endpoint="POSTapi-role"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept" data-endpoint="POSTapi-role"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="name" data-endpoint="POSTapi-role"
                        value="ratione" data-component="body">
                    <br>
                    <p>Example: <code>ratione</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="slug" data-endpoint="POSTapi-role"
                        value="tenetur" data-component="body">
                    <br>
                    <p>Example: <code>tenetur</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>permissions</code></b>&nbsp;&nbsp;
                    <small>object</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="permissions" data-endpoint="POSTapi-role"
                        value="" data-component="body">
                    <br>

                </div>
            </form>

            <h2 id="role-management-GETapi-role-stats">Role stats</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>Get the statistics, number of users per role.</p>

            <span id="example-requests-GETapi-role-stats">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/role/stats" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/role/stats"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8000/api/role/stats',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/role/stats'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-role-stats">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=8RNn02p2WEOnEe0XyRLx3zk6xTKBOH6T5Ir3kFjL; expires=Thu, 08 Feb 2024 07:39:25 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-role-stats" hidden>
                <blockquote>Received response<span id="execution-response-status-GETapi-role-stats"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-role-stats" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-role-stats" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-role-stats"></code></pre>
            </span>
            <form id="form-GETapi-role-stats" data-method="GET" data-path="api/role/stats" data-authed="1"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-role-stats', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-role-stats" onclick="tryItOut('GETapi-role-stats');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-role-stats" onclick="cancelTryOut('GETapi-role-stats');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-role-stats" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/role/stats</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="GETapi-role-stats" value="Bearer {YOUR_AUTH_KEY}" data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="GETapi-role-stats" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-role-stats"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
            </form>

            <h2 id="role-management-GETapi-role--slug-">Show a Role</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you get a Role</p>

            <span id="example-requests-GETapi-role--slug-">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/role/administrator" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/role/administrator"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8000/api/role/administrator',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/role/administrator'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-role--slug-">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=fvytKkiCCMb5eQSMhgwQmtQogQ7cMjkVM2g3SbLV; expires=Thu, 08 Feb 2024 07:39:26 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-role--slug-" hidden>
                <blockquote>Received response<span id="execution-response-status-GETapi-role--slug-"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-role--slug-" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-role--slug-" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-role--slug-"></code></pre>
            </span>
            <form id="form-GETapi-role--slug-" data-method="GET" data-path="api/role/{slug}" data-authed="1"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-role--slug-', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-role--slug-" onclick="tryItOut('GETapi-role--slug-');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-role--slug-" onclick="cancelTryOut('GETapi-role--slug-');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-role--slug-" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/role/{slug}</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="GETapi-role--slug-" value="Bearer {YOUR_AUTH_KEY}" data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="GETapi-role--slug-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="GETapi-role--slug-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="slug"
                        data-endpoint="GETapi-role--slug-" value="administrator" data-component="url">
                    <br>
                    <p>The slug of the role. Example: <code>administrator</code></p>
                </div>
            </form>

            <h2 id="role-management-PUTapi-role--slug-">Update a Role</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you update a single Role</p>

            <span id="example-requests-PUTapi-role--slug-">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/role/administrator" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/role/administrator"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'http://localhost:8000/api/role/administrator',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/role/administrator'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-PUTapi-role--slug-">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=qtUbsvXSPJF5raIEgvWr6kaT4xaUWvkVANZRd8dE; expires=Thu, 08 Feb 2024 07:39:27 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-PUTapi-role--slug-" hidden>
                <blockquote>Received response<span id="execution-response-status-PUTapi-role--slug-"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-PUTapi-role--slug-" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-PUTapi-role--slug-" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-PUTapi-role--slug-"></code></pre>
            </span>
            <form id="form-PUTapi-role--slug-" data-method="PUT" data-path="api/role/{slug}" data-authed="1"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('PUTapi-role--slug-', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-PUTapi-role--slug-" onclick="tryItOut('PUTapi-role--slug-');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-PUTapi-role--slug-" onclick="cancelTryOut('PUTapi-role--slug-');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-PUTapi-role--slug-" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-darkblue">PUT</small>
                    <b><code>api/role/{slug}</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="PUTapi-role--slug-" value="Bearer {YOUR_AUTH_KEY}" data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="PUTapi-role--slug-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="PUTapi-role--slug-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="slug"
                        data-endpoint="PUTapi-role--slug-" value="administrator" data-component="url">
                    <br>
                    <p>The slug of the role. Example: <code>administrator</code></p>
                </div>
            </form>

            <h2 id="role-management-DELETEapi-role--slug-">Delete a Role</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you delete a single Role</p>

            <span id="example-requests-DELETEapi-role--slug-">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/role/administrator" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/role/administrator"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'http://localhost:8000/api/role/administrator',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/role/administrator'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-DELETEapi-role--slug-">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=j0nTECrylrwouqD2lJ69SrTxc5D179mJefQcpTSu; expires=Thu, 08 Feb 2024 07:39:28 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-DELETEapi-role--slug-" hidden>
                <blockquote>Received response<span id="execution-response-status-DELETEapi-role--slug-"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-DELETEapi-role--slug-" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-DELETEapi-role--slug-" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-DELETEapi-role--slug-"></code></pre>
            </span>
            <form id="form-DELETEapi-role--slug-" data-method="DELETE" data-path="api/role/{slug}"
                data-authed="1" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('DELETEapi-role--slug-', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-DELETEapi-role--slug-" onclick="tryItOut('DELETEapi-role--slug-');">Try it
                        out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-DELETEapi-role--slug-" onclick="cancelTryOut('DELETEapi-role--slug-');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-DELETEapi-role--slug-" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-red">DELETE</small>
                    <b><code>api/role/{slug}</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="DELETEapi-role--slug-" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="DELETEapi-role--slug-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="DELETEapi-role--slug-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="slug"
                        data-endpoint="DELETEapi-role--slug-" value="administrator" data-component="url">
                    <br>
                    <p>The slug of the role. Example: <code>administrator</code></p>
                </div>
            </form>

            <h1 id="user-management">User Management</h1>

            <p>APIs for managnign Users</p>

            <h2 id="user-management-POSTapi-auth-login">Login API</h2>

            <p>
            </p>

            <p>This endpoint allows you to login users.</p>

            <span id="example-requests-POSTapi-auth-login">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/auth/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"gyufkgcbzpeyq\",
    \"password\": \"G}b7:d}(T\"
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "gyufkgcbzpeyq",
    "password": "G}b7:d}(T"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8000/api/auth/login',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'username' =&gt; 'gyufkgcbzpeyq',
            'password' =&gt; 'G}b7:d}(T',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/auth/login'
payload = {
    "username": "gyufkgcbzpeyq",
    "password": "G}b7:d}(T"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-auth-login">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
set-cookie: laravel_restful_api_session=34dAZOIoP6aGMfrHDxF1jr1cpTzYeX1EK4KxABHC; expires=Thu, 08 Feb 2024 07:39:00 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;state&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Username or Password is Incorrect&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
            </span>
            <span id="execution-results-POSTapi-auth-login" hidden>
                <blockquote>Received response<span id="execution-response-status-POSTapi-auth-login"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-auth-login" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-auth-login" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-auth-login"></code></pre>
            </span>
            <form id="form-POSTapi-auth-login" data-method="POST" data-path="api/auth/login" data-authed="0"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-login', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-auth-login" onclick="tryItOut('POSTapi-auth-login');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-auth-login" onclick="cancelTryOut('POSTapi-auth-login');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-auth-login" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/auth/login</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="POSTapi-auth-login" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="POSTapi-auth-login" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="username"
                        data-endpoint="POSTapi-auth-login" value="gyufkgcbzpeyq" data-component="body">
                    <br>
                    <p>Must be at least 5 characters. Must not be greater than 255 characters. Example:
                        <code>gyufkgcbzpeyq</code>
                    </p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="password"
                        data-endpoint="POSTapi-auth-login" value="G}b7:d}(T" data-component="body">
                    <br>
                    <p>Must be at least 5 characters. Must not be greater than 255 characters. Example:
                        <code>G}b7:d}(T</code>
                    </p>
                </div>
            </form>

            <h2 id="user-management-POSTapi-auth-register">Register API</h2>

            <p>
            </p>

            <p>This endpoint allows you to register a new user.</p>

            <span id="example-requests-POSTapi-auth-register">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/auth/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"rcxsbjufxhpeapceywoos\",
    \"email\": \"orunte@example.org\",
    \"password\": \"6UpvQ2s\",
    \"first_name\": \"bixicb\",
    \"last_name\": \"ocx\",
    \"role\": \"quo\",
    \"activate\": false,
    \"phone_number\": 20100.9524532,
    \"country_code\": 4079.8735
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "rcxsbjufxhpeapceywoos",
    "email": "orunte@example.org",
    "password": "6UpvQ2s",
    "first_name": "bixicb",
    "last_name": "ocx",
    "role": "quo",
    "activate": false,
    "phone_number": 20100.9524532,
    "country_code": 4079.8735
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8000/api/auth/register',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'username' =&gt; 'rcxsbjufxhpeapceywoos',
            'email' =&gt; 'orunte@example.org',
            'password' =&gt; '6UpvQ2s',
            'first_name' =&gt; 'bixicb',
            'last_name' =&gt; 'ocx',
            'role' =&gt; 'quo',
            'activate' =&gt; false,
            'phone_number' =&gt; 20100.9524532,
            'country_code' =&gt; 4079.8735,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/auth/register'
payload = {
    "username": "rcxsbjufxhpeapceywoos",
    "email": "orunte@example.org",
    "password": "6UpvQ2s",
    "first_name": "bixicb",
    "last_name": "ocx",
    "role": "quo",
    "activate": false,
    "phone_number": 20100.9524532,
    "country_code": 4079.8735
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-auth-register">
                <blockquote>
                    <p>Example response (422):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 58
set-cookie: laravel_restful_api_session=Y8BIoI0bR9iEMxUHKg9GuN9U2PoSTLeMc0j69lIE; expires=Thu, 08 Feb 2024 07:39:01 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;state&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Data validation failed&quot;,
    &quot;data&quot;: {
        &quot;password&quot;: [
            &quot;The password must be at least 8 characters.&quot;
        ]
    }
}</code>
 </pre>
            </span>
            <span id="execution-results-POSTapi-auth-register" hidden>
                <blockquote>Received response<span id="execution-response-status-POSTapi-auth-register"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-auth-register" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-auth-register" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-auth-register"></code></pre>
            </span>
            <form id="form-POSTapi-auth-register" data-method="POST" data-path="api/auth/register"
                data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-register', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-auth-register" onclick="tryItOut('POSTapi-auth-register');">Try it
                        out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-auth-register" onclick="cancelTryOut('POSTapi-auth-register');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-auth-register" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/auth/register</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="POSTapi-auth-register" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="POSTapi-auth-register" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="username"
                        data-endpoint="POSTapi-auth-register" value="rcxsbjufxhpeapceywoos" data-component="body">
                    <br>
                    <p>Must be at least 5 characters. Must not be greater than 255 characters. Example:
                        <code>rcxsbjufxhpeapceywoos</code>
                    </p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="email"
                        data-endpoint="POSTapi-auth-register" value="orunte@example.org" data-component="body">
                    <br>
                    <p>Must be a valid email address. Must be at least 10 characters. Must not be greater than 255
                        characters. Example: <code>orunte@example.org</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="password"
                        data-endpoint="POSTapi-auth-register" value="6UpvQ2s" data-component="body">
                    <br>
                    <p>Must be at least 8 characters. Must not be greater than 255 characters. Example:
                        <code>6UpvQ2s</code>
                    </p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="first_name"
                        data-endpoint="POSTapi-auth-register" value="bixicb" data-component="body">
                    <br>
                    <p>Must be at least 3 characters. Must not be greater than 255 characters. Example:
                        <code>bixicb</code>
                    </p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="last_name"
                        data-endpoint="POSTapi-auth-register" value="ocx" data-component="body">
                    <br>
                    <p>Must be at least 3 characters. Must not be greater than 255 characters. Example: <code>ocx</code>
                    </p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="role"
                        data-endpoint="POSTapi-auth-register" value="quo" data-component="body">
                    <br>
                    <p>Example: <code>quo</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>permissions</code></b>&nbsp;&nbsp;
                    <small>object</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="permissions"
                        data-endpoint="POSTapi-auth-register" value="" data-component="body">
                    <br>

                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>activate</code></b>&nbsp;&nbsp;
                    <small>boolean</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <label data-endpoint="POSTapi-auth-register" style="display: none">
                        <input type="radio" name="activate" value="true"
                            data-endpoint="POSTapi-auth-register" data-component="body">
                        <code>true</code>
                    </label>
                    <label data-endpoint="POSTapi-auth-register" style="display: none">
                        <input type="radio" name="activate" value="false"
                            data-endpoint="POSTapi-auth-register" data-component="body">
                        <code>false</code>
                    </label>
                    <br>
                    <p>Example: <code>false</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>phone_number</code></b>&nbsp;&nbsp;
                    <small>number</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="number" style="display: none" name="phone_number"
                        data-endpoint="POSTapi-auth-register" value="20100.9524532" data-component="body">
                    <br>
                    <p>Example: <code>20100.9524532</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>country_code</code></b>&nbsp;&nbsp;
                    <small>number</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="number" style="display: none" name="country_code"
                        data-endpoint="POSTapi-auth-register" value="4079.8735" data-component="body">
                    <br>
                    <p>Example: <code>4079.8735</code></p>
                </div>
            </form>

            <h2 id="user-management-POSTapi-auth-activate">Activate a User</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you activate a User.</p>

            <span id="example-requests-POSTapi-auth-activate">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/auth/activate" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"code\": \"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\"
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/activate"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "code": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8000/api/auth/activate',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'code' =&gt; 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/auth/activate'
payload = {
    "code": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
}
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-auth-activate">
                <blockquote>
                    <p>Example response (500):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 57
set-cookie: laravel_restful_api_session=jMtIIkUJ5HmV3Nfz1REXK1R7yslhDlWhfrv708ej; expires=Thu, 08 Feb 2024 07:39:03 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Class \&quot;Activation\&quot; not found&quot;,
    &quot;exception&quot;: &quot;Error&quot;,
    &quot;file&quot;: &quot;/var/www/html/app/Http/Controllers/API/UserController.php&quot;,
    &quot;line&quot;: 129,
    &quot;trace&quot;: [
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Controller.php&quot;,
            &quot;line&quot;: 54,
            &quot;function&quot;: &quot;activate&quot;,
            &quot;class&quot;: &quot;App\\Http\\Controllers\\API\\UserController&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/ControllerDispatcher.php&quot;,
            &quot;line&quot;: 43,
            &quot;function&quot;: &quot;callAction&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Controller&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Route.php&quot;,
            &quot;line&quot;: 260,
            &quot;function&quot;: &quot;dispatch&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\ControllerDispatcher&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Route.php&quot;,
            &quot;line&quot;: 205,
            &quot;function&quot;: &quot;runController&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Route&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Router.php&quot;,
            &quot;line&quot;: 798,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Route&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 141,
            &quot;function&quot;: &quot;Illuminate\\Routing\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Middleware/SubstituteBindings.php&quot;,
            &quot;line&quot;: 50,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Middleware\\SubstituteBindings&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Middleware/ThrottleRequests.php&quot;,
            &quot;line&quot;: 126,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Middleware/ThrottleRequests.php&quot;,
            &quot;line&quot;: 62,
            &quot;function&quot;: &quot;handleRequest&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Middleware\\ThrottleRequests&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Middleware\\ThrottleRequests&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php&quot;,
            &quot;line&quot;: 121,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php&quot;,
            &quot;line&quot;: 64,
            &quot;function&quot;: &quot;handleStatefulRequest&quot;,
            &quot;class&quot;: &quot;Illuminate\\Session\\Middleware\\StartSession&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Session\\Middleware\\StartSession&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Router.php&quot;,
            &quot;line&quot;: 799,
            &quot;function&quot;: &quot;then&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Router.php&quot;,
            &quot;line&quot;: 776,
            &quot;function&quot;: &quot;runRouteWithinStack&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Router.php&quot;,
            &quot;line&quot;: 740,
            &quot;function&quot;: &quot;runRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Router.php&quot;,
            &quot;line&quot;: 729,
            &quot;function&quot;: &quot;dispatchToRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php&quot;,
            &quot;line&quot;: 190,
            &quot;function&quot;: &quot;dispatch&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 141,
            &quot;function&quot;: &quot;Illuminate\\Foundation\\Http\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/ConvertEmptyStringsToNull.php&quot;,
            &quot;line&quot;: 31,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TrimStrings.php&quot;,
            &quot;line&quot;: 40,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TrimStrings&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/ValidatePostSize.php&quot;,
            &quot;line&quot;: 27,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/PreventRequestsDuringMaintenance.php&quot;,
            &quot;line&quot;: 86,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Http/Middleware/TrustProxies.php&quot;,
            &quot;line&quot;: 39,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Http\\Middleware\\TrustProxies&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php&quot;,
            &quot;line&quot;: 165,
            &quot;function&quot;: &quot;then&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php&quot;,
            &quot;line&quot;: 134,
            &quot;function&quot;: &quot;sendRequestThroughRouter&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Strategies/Responses/ResponseCalls.php&quot;,
            &quot;line&quot;: 300,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Strategies/Responses/ResponseCalls.php&quot;,
            &quot;line&quot;: 288,
            &quot;function&quot;: &quot;callLaravelOrLumenRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Strategies/Responses/ResponseCalls.php&quot;,
            &quot;line&quot;: 91,
            &quot;function&quot;: &quot;makeApiCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Strategies/Responses/ResponseCalls.php&quot;,
            &quot;line&quot;: 44,
            &quot;function&quot;: &quot;makeResponseCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Strategies/Responses/ResponseCalls.php&quot;,
            &quot;line&quot;: 35,
            &quot;function&quot;: &quot;makeResponseCallIfConditionsPass&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Extractor.php&quot;,
            &quot;line&quot;: 236,
            &quot;function&quot;: &quot;__invoke&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Extractor.php&quot;,
            &quot;line&quot;: 166,
            &quot;function&quot;: &quot;iterateThroughStrategies&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Extractor.php&quot;,
            &quot;line&quot;: 95,
            &quot;function&quot;: &quot;fetchResponses&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/GroupedEndpoints/GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 125,
            &quot;function&quot;: &quot;processRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/GroupedEndpoints/GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 72,
            &quot;function&quot;: &quot;extractEndpointsInfoFromLaravelApp&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/GroupedEndpoints/GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 50,
            &quot;function&quot;: &quot;extractEndpointsInfoAndWriteToDisk&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Commands/GenerateDocumentation.php&quot;,
            &quot;line&quot;: 53,
            &quot;function&quot;: &quot;get&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php&quot;,
            &quot;line&quot;: 36,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Commands\\GenerateDocumentation&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Container/Util.php&quot;,
            &quot;line&quot;: 41,
            &quot;function&quot;: &quot;Illuminate\\Container\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php&quot;,
            &quot;line&quot;: 93,
            &quot;function&quot;: &quot;unwrapIfClosure&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Util&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;callBoundMethod&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Container/Container.php&quot;,
            &quot;line&quot;: 661,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Console/Command.php&quot;,
            &quot;line&quot;: 183,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Container&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/symfony/console/Command/Command.php&quot;,
            &quot;line&quot;: 326,
            &quot;function&quot;: &quot;execute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Console/Command.php&quot;,
            &quot;line&quot;: 153,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Command\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/symfony/console/Application.php&quot;,
            &quot;line&quot;: 1078,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/symfony/console/Application.php&quot;,
            &quot;line&quot;: 324,
            &quot;function&quot;: &quot;doRunCommand&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/symfony/console/Application.php&quot;,
            &quot;line&quot;: 175,
            &quot;function&quot;: &quot;doRun&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Console/Application.php&quot;,
            &quot;line&quot;: 102,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php&quot;,
            &quot;line&quot;: 155,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/artisan&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Console\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        }
    ]
}</code>
 </pre>
            </span>
            <span id="execution-results-POSTapi-auth-activate" hidden>
                <blockquote>Received response<span id="execution-response-status-POSTapi-auth-activate"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-auth-activate" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-auth-activate" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-auth-activate"></code></pre>
            </span>
            <form id="form-POSTapi-auth-activate" data-method="POST" data-path="api/auth/activate"
                data-authed="1" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-activate', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-auth-activate" onclick="tryItOut('POSTapi-auth-activate');">Try it
                        out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-auth-activate" onclick="cancelTryOut('POSTapi-auth-activate');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-auth-activate" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/auth/activate</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="POSTapi-auth-activate" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="POSTapi-auth-activate" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="POSTapi-auth-activate" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="code"
                        data-endpoint="POSTapi-auth-activate" value="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
                        data-component="body">
                    <br>
                    <p>The activation code. Example: <code>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</code></p>
                </div>
            </form>

            <h2 id="user-management-POSTapi-auth-password-forgot">Forgot Password</h2>

            <p>
            </p>

            <p>This endpoint will send an authorized email reset password</p>

            <span id="example-requests-POSTapi-auth-password-forgot">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/auth/password/forgot" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"carey.rice@example.org\"
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/password/forgot"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "carey.rice@example.org"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8000/api/auth/password/forgot',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'carey.rice@example.org',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/auth/password/forgot'
payload = {
    "email": "carey.rice@example.org"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-auth-password-forgot">
                <blockquote>
                    <p>Example response (404):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 56
set-cookie: laravel_restful_api_session=NQ1HKdhjUvoKSajWk7IL0SPyFganoV7zqCZd4uui; expires=Thu, 08 Feb 2024 07:39:03 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;state&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Email doesn&#039;t exist&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
            </span>
            <span id="execution-results-POSTapi-auth-password-forgot" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-POSTapi-auth-password-forgot"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-auth-password-forgot" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-auth-password-forgot" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-auth-password-forgot"></code></pre>
            </span>
            <form id="form-POSTapi-auth-password-forgot" data-method="POST" data-path="api/auth/password/forgot"
                data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-password-forgot', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-auth-password-forgot"
                        onclick="tryItOut('POSTapi-auth-password-forgot');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-auth-password-forgot"
                        onclick="cancelTryOut('POSTapi-auth-password-forgot');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-auth-password-forgot" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/auth/password/forgot</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="POSTapi-auth-password-forgot" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="POSTapi-auth-password-forgot" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="email"
                        data-endpoint="POSTapi-auth-password-forgot" value="carey.rice@example.org"
                        data-component="body">
                    <br>
                    <p>Must be a valid email address. Example: <code>carey.rice@example.org</code></p>
                </div>
            </form>

            <h2 id="user-management-PUTapi-auth-password-reset">Reset Password</h2>

            <p>
            </p>

            <p>This endpoint lets you reset and update password</p>

            <span id="example-requests-PUTapi-auth-password-reset">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/auth/password/reset" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"password\": \"E%]z\'CN3FM\",
    \"confirm_password\": \"hic\",
    \"token\": \"sed\"
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/password/reset"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "password": "E%]z'CN3FM",
    "confirm_password": "hic",
    "token": "sed"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'http://localhost:8000/api/auth/password/reset',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'password' =&gt; 'E%]z\'CN3FM',
            'confirm_password' =&gt; 'hic',
            'token' =&gt; 'sed',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/auth/password/reset'
payload = {
    "password": "E%]z'CN3FM",
    "confirm_password": "hic",
    "token": "sed"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-PUTapi-auth-password-reset">
                <blockquote>
                    <p>Example response (500):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 55
set-cookie: laravel_restful_api_session=285Kg31XiAZxbrzWTryYlt227Zlg3oChEf8V5TZ2; expires=Thu, 08 Feb 2024 07:39:04 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Call to a member function first() on null&quot;,
    &quot;exception&quot;: &quot;Error&quot;,
    &quot;file&quot;: &quot;/var/www/html/app/Http/Controllers/API/UserController.php&quot;,
    &quot;line&quot;: 386,
    &quot;trace&quot;: [
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Controller.php&quot;,
            &quot;line&quot;: 54,
            &quot;function&quot;: &quot;resetPassword&quot;,
            &quot;class&quot;: &quot;App\\Http\\Controllers\\API\\UserController&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/ControllerDispatcher.php&quot;,
            &quot;line&quot;: 43,
            &quot;function&quot;: &quot;callAction&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Controller&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Route.php&quot;,
            &quot;line&quot;: 260,
            &quot;function&quot;: &quot;dispatch&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\ControllerDispatcher&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Route.php&quot;,
            &quot;line&quot;: 205,
            &quot;function&quot;: &quot;runController&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Route&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Router.php&quot;,
            &quot;line&quot;: 798,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Route&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 141,
            &quot;function&quot;: &quot;Illuminate\\Routing\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Middleware/SubstituteBindings.php&quot;,
            &quot;line&quot;: 50,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Middleware\\SubstituteBindings&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Middleware/ThrottleRequests.php&quot;,
            &quot;line&quot;: 126,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Middleware/ThrottleRequests.php&quot;,
            &quot;line&quot;: 62,
            &quot;function&quot;: &quot;handleRequest&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Middleware\\ThrottleRequests&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Middleware\\ThrottleRequests&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php&quot;,
            &quot;line&quot;: 121,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Session/Middleware/StartSession.php&quot;,
            &quot;line&quot;: 64,
            &quot;function&quot;: &quot;handleStatefulRequest&quot;,
            &quot;class&quot;: &quot;Illuminate\\Session\\Middleware\\StartSession&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Session\\Middleware\\StartSession&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Router.php&quot;,
            &quot;line&quot;: 799,
            &quot;function&quot;: &quot;then&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Router.php&quot;,
            &quot;line&quot;: 776,
            &quot;function&quot;: &quot;runRouteWithinStack&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Router.php&quot;,
            &quot;line&quot;: 740,
            &quot;function&quot;: &quot;runRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Routing/Router.php&quot;,
            &quot;line&quot;: 729,
            &quot;function&quot;: &quot;dispatchToRoute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php&quot;,
            &quot;line&quot;: 190,
            &quot;function&quot;: &quot;dispatch&quot;,
            &quot;class&quot;: &quot;Illuminate\\Routing\\Router&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 141,
            &quot;function&quot;: &quot;Illuminate\\Foundation\\Http\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/ConvertEmptyStringsToNull.php&quot;,
            &quot;line&quot;: 31,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php&quot;,
            &quot;line&quot;: 21,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TrimStrings.php&quot;,
            &quot;line&quot;: 40,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\TrimStrings&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/ValidatePostSize.php&quot;,
            &quot;line&quot;: 27,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/PreventRequestsDuringMaintenance.php&quot;,
            &quot;line&quot;: 86,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Http/Middleware/TrustProxies.php&quot;,
            &quot;line&quot;: 39,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 180,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Http\\Middleware\\TrustProxies&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php&quot;,
            &quot;line&quot;: 116,
            &quot;function&quot;: &quot;Illuminate\\Pipeline\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php&quot;,
            &quot;line&quot;: 165,
            &quot;function&quot;: &quot;then&quot;,
            &quot;class&quot;: &quot;Illuminate\\Pipeline\\Pipeline&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php&quot;,
            &quot;line&quot;: 134,
            &quot;function&quot;: &quot;sendRequestThroughRouter&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Strategies/Responses/ResponseCalls.php&quot;,
            &quot;line&quot;: 300,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Http\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Strategies/Responses/ResponseCalls.php&quot;,
            &quot;line&quot;: 288,
            &quot;function&quot;: &quot;callLaravelOrLumenRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Strategies/Responses/ResponseCalls.php&quot;,
            &quot;line&quot;: 91,
            &quot;function&quot;: &quot;makeApiCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Strategies/Responses/ResponseCalls.php&quot;,
            &quot;line&quot;: 44,
            &quot;function&quot;: &quot;makeResponseCall&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Strategies/Responses/ResponseCalls.php&quot;,
            &quot;line&quot;: 35,
            &quot;function&quot;: &quot;makeResponseCallIfConditionsPass&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Extractor.php&quot;,
            &quot;line&quot;: 236,
            &quot;function&quot;: &quot;__invoke&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Extractor.php&quot;,
            &quot;line&quot;: 166,
            &quot;function&quot;: &quot;iterateThroughStrategies&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Extracting/Extractor.php&quot;,
            &quot;line&quot;: 95,
            &quot;function&quot;: &quot;fetchResponses&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/GroupedEndpoints/GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 125,
            &quot;function&quot;: &quot;processRoute&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Extracting\\Extractor&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/GroupedEndpoints/GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 72,
            &quot;function&quot;: &quot;extractEndpointsInfoFromLaravelApp&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/GroupedEndpoints/GroupedEndpointsFromApp.php&quot;,
            &quot;line&quot;: 50,
            &quot;function&quot;: &quot;extractEndpointsInfoAndWriteToDisk&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/knuckleswtf/scribe/src/Commands/GenerateDocumentation.php&quot;,
            &quot;line&quot;: 53,
            &quot;function&quot;: &quot;get&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\GroupedEndpoints\\GroupedEndpointsFromApp&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php&quot;,
            &quot;line&quot;: 36,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Knuckles\\Scribe\\Commands\\GenerateDocumentation&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Container/Util.php&quot;,
            &quot;line&quot;: 41,
            &quot;function&quot;: &quot;Illuminate\\Container\\{closure}&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php&quot;,
            &quot;line&quot;: 93,
            &quot;function&quot;: &quot;unwrapIfClosure&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Util&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;callBoundMethod&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Container/Container.php&quot;,
            &quot;line&quot;: 661,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\BoundMethod&quot;,
            &quot;type&quot;: &quot;::&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Console/Command.php&quot;,
            &quot;line&quot;: 183,
            &quot;function&quot;: &quot;call&quot;,
            &quot;class&quot;: &quot;Illuminate\\Container\\Container&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/symfony/console/Command/Command.php&quot;,
            &quot;line&quot;: 326,
            &quot;function&quot;: &quot;execute&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Console/Command.php&quot;,
            &quot;line&quot;: 153,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Command\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/symfony/console/Application.php&quot;,
            &quot;line&quot;: 1078,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Command&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/symfony/console/Application.php&quot;,
            &quot;line&quot;: 324,
            &quot;function&quot;: &quot;doRunCommand&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/symfony/console/Application.php&quot;,
            &quot;line&quot;: 175,
            &quot;function&quot;: &quot;doRun&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Console/Application.php&quot;,
            &quot;line&quot;: 102,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Symfony\\Component\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php&quot;,
            &quot;line&quot;: 155,
            &quot;function&quot;: &quot;run&quot;,
            &quot;class&quot;: &quot;Illuminate\\Console\\Application&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        },
        {
            &quot;file&quot;: &quot;/var/www/html/artisan&quot;,
            &quot;line&quot;: 37,
            &quot;function&quot;: &quot;handle&quot;,
            &quot;class&quot;: &quot;Illuminate\\Foundation\\Console\\Kernel&quot;,
            &quot;type&quot;: &quot;-&gt;&quot;
        }
    ]
}</code>
 </pre>
            </span>
            <span id="execution-results-PUTapi-auth-password-reset" hidden>
                <blockquote>Received response<span id="execution-response-status-PUTapi-auth-password-reset"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-PUTapi-auth-password-reset" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-PUTapi-auth-password-reset" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-PUTapi-auth-password-reset"></code></pre>
            </span>
            <form id="form-PUTapi-auth-password-reset" data-method="PUT" data-path="api/auth/password/reset"
                data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('PUTapi-auth-password-reset', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-PUTapi-auth-password-reset"
                        onclick="tryItOut('PUTapi-auth-password-reset');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-PUTapi-auth-password-reset"
                        onclick="cancelTryOut('PUTapi-auth-password-reset');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-PUTapi-auth-password-reset" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-darkblue">PUT</small>
                    <b><code>api/auth/password/reset</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="PUTapi-auth-password-reset" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="PUTapi-auth-password-reset" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="password"
                        data-endpoint="PUTapi-auth-password-reset" value="E%]z'CN3FM" data-component="body">
                    <br>
                    <p>Example: <code>E%]z'CN3FM</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>confirm_password</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="confirm_password"
                        data-endpoint="PUTapi-auth-password-reset" value="hic" data-component="body">
                    <br>
                    <p>Example: <code>hic</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="token"
                        data-endpoint="PUTapi-auth-password-reset" value="sed" data-component="body">
                    <br>
                    <p>Example: <code>sed</code></p>
                </div>
            </form>

            <h2 id="user-management-GETapi-auth-me">Me API</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint will return the currently logged-in user.</p>

            <span id="example-requests-GETapi-auth-me">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/auth/me" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/me"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8000/api/auth/me',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/auth/me'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-auth-me">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=anxR6oZaDjlpa00vWPw5yy0QmmJA0PpoxLtILqIt; expires=Thu, 08 Feb 2024 07:39:06 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-auth-me" hidden>
                <blockquote>Received response<span id="execution-response-status-GETapi-auth-me"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-auth-me" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-auth-me" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-auth-me"></code></pre>
            </span>
            <form id="form-GETapi-auth-me" data-method="GET" data-path="api/auth/me" data-authed="1"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-auth-me', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-auth-me" onclick="tryItOut('GETapi-auth-me');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-auth-me" onclick="cancelTryOut('GETapi-auth-me');" hidden>Cancel
                        🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-auth-me" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/auth/me</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="GETapi-auth-me" value="Bearer {YOUR_AUTH_KEY}" data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="GETapi-auth-me" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-auth-me"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
            </form>

            <h2 id="user-management-POSTapi-auth-logout">Logout API</h2>

            <p>
            </p>

            <p>This endpoint allows you to logout user.</p>

            <span id="example-requests-POSTapi-auth-logout">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/auth/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/auth/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8000/api/auth/logout',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/auth/logout'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-auth-logout">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=gotJZ0lc1lTZfSwtKY4kmfVypQ6kgvgTzzGIWlng; expires=Thu, 08 Feb 2024 07:39:06 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-POSTapi-auth-logout" hidden>
                <blockquote>Received response<span id="execution-response-status-POSTapi-auth-logout"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-auth-logout" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-auth-logout" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-auth-logout"></code></pre>
            </span>
            <form id="form-POSTapi-auth-logout" data-method="POST" data-path="api/auth/logout" data-authed="0"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-logout', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-auth-logout" onclick="tryItOut('POSTapi-auth-logout');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-auth-logout" onclick="cancelTryOut('POSTapi-auth-logout');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-auth-logout" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/auth/logout</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="POSTapi-auth-logout" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="POSTapi-auth-logout" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
            </form>

            <h2 id="user-management-GETapi-user">Get all Users</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you get all Users.</p>

            <span id="example-requests-GETapi-user">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user?search=minus&amp;role=non" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user"
);

const params = {
    "search": "minus",
    "role": "non",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8000/api/user',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'search' =&gt; 'minus',
            'role' =&gt; 'non',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user'
params = {
  'search': 'minus',
  'role': 'non',
}
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers, params=params)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-user">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=cNM03wECM2INuJeDLRj4oBuVhC4PgX4yA5JcAbAQ; expires=Thu, 08 Feb 2024 07:39:07 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-user" hidden>
                <blockquote>Received response<span id="execution-response-status-GETapi-user"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-user" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-user" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-user"></code></pre>
            </span>
            <form id="form-GETapi-user" data-method="GET" data-path="api/user" data-authed="1"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-user" onclick="tryItOut('GETapi-user');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-user" onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-user" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/user</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="GETapi-user" value="Bearer {YOUR_AUTH_KEY}" data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type" data-endpoint="GETapi-user"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-user"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="search" data-endpoint="GETapi-user"
                        value="minus" data-component="query">
                    <br>
                    <p>used to search from email, username, first_name, and last_name Example: <code>minus</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="role" data-endpoint="GETapi-user"
                        value="non" data-component="query">
                    <br>
                    <p>used to filter results based on a specific role. Example: <code>non</code></p>
                </div>
            </form>

            <h2 id="user-management-POSTapi-user">Store User</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you create a new User.</p>

            <span id="example-requests-POSTapi-user">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/user" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"bkkdryhrbjbqqmitzozbtc\",
    \"email\": \"eabshire@example.net\",
    \"password\": \"eEToJ:\",
    \"first_name\": \"dolorum\",
    \"last_name\": \"id\",
    \"role\": \"voluptatem\",
    \"activate\": true,
    \"phone_number\": 758394021,
    \"country_code\": 20171532
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "bkkdryhrbjbqqmitzozbtc",
    "email": "eabshire@example.net",
    "password": "eEToJ:",
    "first_name": "dolorum",
    "last_name": "id",
    "role": "voluptatem",
    "activate": true,
    "phone_number": 758394021,
    "country_code": 20171532
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8000/api/user',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'username' =&gt; 'bkkdryhrbjbqqmitzozbtc',
            'email' =&gt; 'eabshire@example.net',
            'password' =&gt; 'eEToJ:',
            'first_name' =&gt; 'dolorum',
            'last_name' =&gt; 'id',
            'role' =&gt; 'voluptatem',
            'activate' =&gt; true,
            'phone_number' =&gt; 758394021.0,
            'country_code' =&gt; 20171532.0,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user'
payload = {
    "username": "bkkdryhrbjbqqmitzozbtc",
    "email": "eabshire@example.net",
    "password": "eEToJ:",
    "first_name": "dolorum",
    "last_name": "id",
    "role": "voluptatem",
    "activate": true,
    "phone_number": 758394021,
    "country_code": 20171532
}
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-user">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=aMrNBxajFXgYXqIoVZJphc4sOVcQrHyXyiCaH6S1; expires=Thu, 08 Feb 2024 07:39:08 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-POSTapi-user" hidden>
                <blockquote>Received response<span id="execution-response-status-POSTapi-user"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-user" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-user" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-user"></code></pre>
            </span>
            <form id="form-POSTapi-user" data-method="POST" data-path="api/user" data-authed="1"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-user', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-user" onclick="tryItOut('POSTapi-user');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-user" onclick="cancelTryOut('POSTapi-user');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-user" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/user</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="POSTapi-user" value="Bearer {YOUR_AUTH_KEY}" data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type" data-endpoint="POSTapi-user"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept" data-endpoint="POSTapi-user"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="username" data-endpoint="POSTapi-user"
                        value="bkkdryhrbjbqqmitzozbtc" data-component="body">
                    <br>
                    <p>Must be at least 2 characters. Must not be greater than 255 characters. Example:
                        <code>bkkdryhrbjbqqmitzozbtc</code>
                    </p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="email" data-endpoint="POSTapi-user"
                        value="eabshire@example.net" data-component="body">
                    <br>
                    <p>Must be a valid email address. Example: <code>eabshire@example.net</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="password" data-endpoint="POSTapi-user"
                        value="eEToJ:" data-component="body">
                    <br>
                    <p>Example: <code>eEToJ:</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="first_name" data-endpoint="POSTapi-user"
                        value="dolorum" data-component="body">
                    <br>
                    <p>Example: <code>dolorum</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="last_name" data-endpoint="POSTapi-user"
                        value="id" data-component="body">
                    <br>
                    <p>Example: <code>id</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="role" data-endpoint="POSTapi-user"
                        value="voluptatem" data-component="body">
                    <br>
                    <p>Example: <code>voluptatem</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>permissions</code></b>&nbsp;&nbsp;
                    <small>object</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="permissions" data-endpoint="POSTapi-user"
                        value="" data-component="body">
                    <br>

                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>activate</code></b>&nbsp;&nbsp;
                    <small>boolean</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <label data-endpoint="POSTapi-user" style="display: none">
                        <input type="radio" name="activate" value="true" data-endpoint="POSTapi-user"
                            data-component="body">
                        <code>true</code>
                    </label>
                    <label data-endpoint="POSTapi-user" style="display: none">
                        <input type="radio" name="activate" value="false" data-endpoint="POSTapi-user"
                            data-component="body">
                        <code>false</code>
                    </label>
                    <br>
                    <p>Example: <code>true</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>phone_number</code></b>&nbsp;&nbsp;
                    <small>number</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="number" style="display: none" name="phone_number" data-endpoint="POSTapi-user"
                        value="758394021" data-component="body">
                    <br>
                    <p>Example: <code>758394021</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>country_code</code></b>&nbsp;&nbsp;
                    <small>number</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="number" style="display: none" name="country_code" data-endpoint="POSTapi-user"
                        value="20171532" data-component="body">
                    <br>
                    <p>Example: <code>20171532</code></p>
                </div>
            </form>

            <h2 id="user-management-PUTapi-user-mfa">PUT api/user/mfa</h2>

            <p>
            </p>



            <span id="example-requests-PUTapi-user-mfa">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/user/mfa" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"default_factor\": \"push\"
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/mfa"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "default_factor": "push"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'http://localhost:8000/api/user/mfa',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'default_factor' =&gt; 'push',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/mfa'
payload = {
    "default_factor": "push"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-PUTapi-user-mfa">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=rxnpF4VJQGm0SzjF5DIwQuvkMA8eEi0oPZDC3a8Q; expires=Thu, 08 Feb 2024 07:39:08 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-PUTapi-user-mfa" hidden>
                <blockquote>Received response<span id="execution-response-status-PUTapi-user-mfa"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-PUTapi-user-mfa" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-PUTapi-user-mfa" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-PUTapi-user-mfa"></code></pre>
            </span>
            <form id="form-PUTapi-user-mfa" data-method="PUT" data-path="api/user/mfa" data-authed="0"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('PUTapi-user-mfa', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-PUTapi-user-mfa" onclick="tryItOut('PUTapi-user-mfa');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-PUTapi-user-mfa" onclick="cancelTryOut('PUTapi-user-mfa');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-PUTapi-user-mfa" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-darkblue">PUT</small>
                    <b><code>api/user/mfa</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="PUTapi-user-mfa" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept" data-endpoint="PUTapi-user-mfa"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>default_factor</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="default_factor"
                        data-endpoint="PUTapi-user-mfa" value="push" data-component="body">
                    <br>
                    <p>Example: <code>push</code></p>
                </div>
            </form>

            <h2 id="user-management-POSTapi-user-change">Change Password</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets users change their own passwords</p>

            <span id="example-requests-POSTapi-user-change">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/user/change" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"password_current\": \"repellendus\",
    \"password\": \"^bP4Wp&lt;1P5jH:`\",
    \"password_confirmation\": \"x\"
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/change"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "password_current": "repellendus",
    "password": "^bP4Wp&lt;1P5jH:`",
    "password_confirmation": "x"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8000/api/user/change',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'password_current' =&gt; 'repellendus',
            'password' =&gt; '^bP4Wp&lt;1P5jH:`',
            'password_confirmation' =&gt; 'x',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/change'
payload = {
    "password_current": "repellendus",
    "password": "^bP4Wp&lt;1P5jH:`",
    "password_confirmation": "x"
}
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-user-change">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=zjs5JBW28wOuzw1z4rtIgogZz03eoJKXMRaoZcqJ; expires=Thu, 08 Feb 2024 07:39:09 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-POSTapi-user-change" hidden>
                <blockquote>Received response<span id="execution-response-status-POSTapi-user-change"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-user-change" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-user-change" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-user-change"></code></pre>
            </span>
            <form id="form-POSTapi-user-change" data-method="POST" data-path="api/user/change" data-authed="1"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-user-change', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-user-change" onclick="tryItOut('POSTapi-user-change');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-user-change" onclick="cancelTryOut('POSTapi-user-change');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-user-change" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/user/change</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="POSTapi-user-change" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="POSTapi-user-change" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="POSTapi-user-change" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>password_current</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="password_current"
                        data-endpoint="POSTapi-user-change" value="repellendus" data-component="body">
                    <br>
                    <p>Example: <code>repellendus</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="password"
                        data-endpoint="POSTapi-user-change" value="^bP4Wp<1P5jH:`" data-component="body">
                    <br>
                    <p>This field is required when <code>password_confirmation</code> is present. The value and
                        <code>password_confirmation</code> must match. Must be at least 6 characters. Must not be
                        greater than 15 characters. Example: `^bP4Wp&lt;1P5jH:``
                    </p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="password_confirmation"
                        data-endpoint="POSTapi-user-change" value="x" data-component="body">
                    <br>
                    <p>Must be at least 6 characters. Must not be greater than 15 characters. Example: <code>x</code>
                    </p>
                </div>
            </form>

            <h2 id="user-management-GETapi-user--id-">Get a User</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you get a User.</p>

            <span id="example-requests-GETapi-user--id-">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8000/api/user/1',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-user--id-">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=X72zDr5DXfPqPQOlQrM9Go2tdLHXTbqwpn2rJ8ez; expires=Thu, 08 Feb 2024 07:39:10 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-user--id-" hidden>
                <blockquote>Received response<span id="execution-response-status-GETapi-user--id-"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-user--id-" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-user--id-" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-user--id-"></code></pre>
            </span>
            <form id="form-GETapi-user--id-" data-method="GET" data-path="api/user/{id}" data-authed="1"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-user--id-', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-user--id-" onclick="tryItOut('GETapi-user--id-');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-user--id-" onclick="cancelTryOut('GETapi-user--id-');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-user--id-" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/user/{id}</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="GETapi-user--id-" value="Bearer {YOUR_AUTH_KEY}" data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="GETapi-user--id-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-user--id-"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="id" data-endpoint="GETapi-user--id-"
                        value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
            </form>

            <h2 id="user-management-PUTapi-user--id-">Update a User</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you update a User's data.</p>

            <span id="example-requests-PUTapi-user--id-">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/user/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"sbqltoimzlnlpmej\",
    \"email\": \"ehudson@example.org\",
    \"first_name\": \"guelyjid\",
    \"last_name\": \"iookidlqkmdffoocuqajwc\"
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "sbqltoimzlnlpmej",
    "email": "ehudson@example.org",
    "first_name": "guelyjid",
    "last_name": "iookidlqkmdffoocuqajwc"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'http://localhost:8000/api/user/1',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'username' =&gt; 'sbqltoimzlnlpmej',
            'email' =&gt; 'ehudson@example.org',
            'first_name' =&gt; 'guelyjid',
            'last_name' =&gt; 'iookidlqkmdffoocuqajwc',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1'
payload = {
    "username": "sbqltoimzlnlpmej",
    "email": "ehudson@example.org",
    "first_name": "guelyjid",
    "last_name": "iookidlqkmdffoocuqajwc"
}
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-PUTapi-user--id-">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=6M0yj60b9G84LTcJJwp3cVz6eRGjKXK9LWS9Cfnk; expires=Thu, 08 Feb 2024 07:39:12 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-PUTapi-user--id-" hidden>
                <blockquote>Received response<span id="execution-response-status-PUTapi-user--id-"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-PUTapi-user--id-" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-PUTapi-user--id-" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-PUTapi-user--id-"></code></pre>
            </span>
            <form id="form-PUTapi-user--id-" data-method="PUT" data-path="api/user/{id}" data-authed="1"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('PUTapi-user--id-', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-PUTapi-user--id-" onclick="tryItOut('PUTapi-user--id-');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-PUTapi-user--id-" onclick="cancelTryOut('PUTapi-user--id-');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-PUTapi-user--id-" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-darkblue">PUT</small>
                    <b><code>api/user/{id}</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="PUTapi-user--id-" value="Bearer {YOUR_AUTH_KEY}" data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="PUTapi-user--id-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept" data-endpoint="PUTapi-user--id-"
                        value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="id" data-endpoint="PUTapi-user--id-"
                        value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="username" data-endpoint="PUTapi-user--id-"
                        value="sbqltoimzlnlpmej" data-component="body">
                    <br>
                    <p>Must be at least 5 characters. Must not be greater than 255 characters. Example:
                        <code>sbqltoimzlnlpmej</code>
                    </p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="email" data-endpoint="PUTapi-user--id-"
                        value="ehudson@example.org" data-component="body">
                    <br>
                    <p>Must be a valid email address. Must not be greater than 255 characters. Example:
                        <code>ehudson@example.org</code>
                    </p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="first_name"
                        data-endpoint="PUTapi-user--id-" value="guelyjid" data-component="body">
                    <br>
                    <p>Must be at least 2 characters. Must not be greater than 100 characters. Example:
                        <code>guelyjid</code>
                    </p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="last_name"
                        data-endpoint="PUTapi-user--id-" value="iookidlqkmdffoocuqajwc" data-component="body">
                    <br>
                    <p>Must be at least 2 characters. Must not be greater than 100 characters. Example:
                        <code>iookidlqkmdffoocuqajwc</code>
                    </p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="role" data-endpoint="PUTapi-user--id-"
                        value="" data-component="body">
                    <br>

                </div>
            </form>

            <h2 id="user-management-POSTapi-user--user_id--mfa">POST api/user/{user_id}/mfa</h2>

            <p>
            </p>



            <span id="example-requests-POSTapi-user--user_id--mfa">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/user/1/mfa" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1/mfa"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8000/api/user/1/mfa',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1/mfa'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-user--user_id--mfa">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=p1ckn2BkWCQ2uSnlPmRY1ZD2H5N3rjCfx2jYeguD; expires=Thu, 08 Feb 2024 07:39:12 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-POSTapi-user--user_id--mfa" hidden>
                <blockquote>Received response<span id="execution-response-status-POSTapi-user--user_id--mfa"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-user--user_id--mfa" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-user--user_id--mfa" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-user--user_id--mfa"></code></pre>
            </span>
            <form id="form-POSTapi-user--user_id--mfa" data-method="POST" data-path="api/user/{user_id}/mfa"
                data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-user--user_id--mfa', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-user--user_id--mfa"
                        onclick="tryItOut('POSTapi-user--user_id--mfa');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-user--user_id--mfa"
                        onclick="cancelTryOut('POSTapi-user--user_id--mfa');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-user--user_id--mfa" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/user/{user_id}/mfa</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="POSTapi-user--user_id--mfa" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="POSTapi-user--user_id--mfa" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="user_id"
                        data-endpoint="POSTapi-user--user_id--mfa" value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
            </form>

            <h2 id="user-management-DELETEapi-user--user_id--mfa">DELETE api/user/{user_id}/mfa</h2>

            <p>
            </p>



            <span id="example-requests-DELETEapi-user--user_id--mfa">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/user/1/mfa" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1/mfa"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'http://localhost:8000/api/user/1/mfa',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1/mfa'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-DELETEapi-user--user_id--mfa">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=9s82aOQnlAv2qO4vsDkY87HP4b2WS60Mjyr7GhD0; expires=Thu, 08 Feb 2024 07:39:12 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-DELETEapi-user--user_id--mfa" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-DELETEapi-user--user_id--mfa"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-DELETEapi-user--user_id--mfa" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-DELETEapi-user--user_id--mfa" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-DELETEapi-user--user_id--mfa"></code></pre>
            </span>
            <form id="form-DELETEapi-user--user_id--mfa" data-method="DELETE" data-path="api/user/{user_id}/mfa"
                data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('DELETEapi-user--user_id--mfa', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-DELETEapi-user--user_id--mfa"
                        onclick="tryItOut('DELETEapi-user--user_id--mfa');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-DELETEapi-user--user_id--mfa"
                        onclick="cancelTryOut('DELETEapi-user--user_id--mfa');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-DELETEapi-user--user_id--mfa" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-red">DELETE</small>
                    <b><code>api/user/{user_id}/mfa</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="DELETEapi-user--user_id--mfa" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="DELETEapi-user--user_id--mfa" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="user_id"
                        data-endpoint="DELETEapi-user--user_id--mfa" value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
            </form>

            <h2 id="user-management-GETapi-user--user_id--qr">GET api/user/{user_id}/qr</h2>

            <p>
            </p>



            <span id="example-requests-GETapi-user--user_id--qr">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user/1/qr" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1/qr"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8000/api/user/1/qr',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1/qr'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-user--user_id--qr">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=60EgQOfSuy5CBA1ROH0xjHDJrDksJjxNTIMbCtjM; expires=Thu, 08 Feb 2024 07:39:12 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-user--user_id--qr" hidden>
                <blockquote>Received response<span id="execution-response-status-GETapi-user--user_id--qr"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-user--user_id--qr" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-user--user_id--qr" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-user--user_id--qr"></code></pre>
            </span>
            <form id="form-GETapi-user--user_id--qr" data-method="GET" data-path="api/user/{user_id}/qr"
                data-authed="0" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-user--user_id--qr', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-user--user_id--qr" onclick="tryItOut('GETapi-user--user_id--qr');">Try
                        it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-user--user_id--qr"
                        onclick="cancelTryOut('GETapi-user--user_id--qr');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-user--user_id--qr" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/user/{user_id}/qr</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="GETapi-user--user_id--qr" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="GETapi-user--user_id--qr" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="user_id"
                        data-endpoint="GETapi-user--user_id--qr" value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
            </form>

            <h2 id="user-management-DELETEapi-user--id-">Destroy a User</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you update a User.</p>

            <span id="example-requests-DELETEapi-user--id-">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/user/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'http://localhost:8000/api/user/1',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-DELETEapi-user--id-">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=vp1Ys5cK49LVkDva3E4R7xJMXX8WtspRwPCNXAAK; expires=Thu, 08 Feb 2024 07:39:13 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-DELETEapi-user--id-" hidden>
                <blockquote>Received response<span id="execution-response-status-DELETEapi-user--id-"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-DELETEapi-user--id-" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-DELETEapi-user--id-" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-DELETEapi-user--id-"></code></pre>
            </span>
            <form id="form-DELETEapi-user--id-" data-method="DELETE" data-path="api/user/{id}" data-authed="1"
                data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('DELETEapi-user--id-', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-DELETEapi-user--id-" onclick="tryItOut('DELETEapi-user--id-');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-DELETEapi-user--id-" onclick="cancelTryOut('DELETEapi-user--id-');"
                        hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-DELETEapi-user--id-" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-red">DELETE</small>
                    <b><code>api/user/{id}</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="DELETEapi-user--id-" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="DELETEapi-user--id-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="DELETEapi-user--id-" value="application/json" data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="id"
                        data-endpoint="DELETEapi-user--id-" value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
            </form>

            <h1 id="user-permission-management">User Permission Management</h1>

            <p>APIs for managing a User's Permissions</p>

            <h2 id="user-permission-management-GETapi-user--user_id--permission">Get User Permission</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you get a User's Permissions</p>

            <span id="example-requests-GETapi-user--user_id--permission">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user/1/permission" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1/permission"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8000/api/user/1/permission',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1/permission'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-user--user_id--permission">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=hx1jVVkEk3hpU68Jlrduzl8rb54qK1WQyU4IHk83; expires=Thu, 08 Feb 2024 07:39:18 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-user--user_id--permission" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-GETapi-user--user_id--permission"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-user--user_id--permission" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-user--user_id--permission" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-user--user_id--permission"></code></pre>
            </span>
            <form id="form-GETapi-user--user_id--permission" data-method="GET"
                data-path="api/user/{user_id}/permission" data-authed="1" data-hasfiles="0" data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-user--user_id--permission', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-user--user_id--permission"
                        onclick="tryItOut('GETapi-user--user_id--permission');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-user--user_id--permission"
                        onclick="cancelTryOut('GETapi-user--user_id--permission');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-user--user_id--permission" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/user/{user_id}/permission</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="GETapi-user--user_id--permission" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="GETapi-user--user_id--permission" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="GETapi-user--user_id--permission" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="user_id"
                        data-endpoint="GETapi-user--user_id--permission" value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
            </form>

            <h2 id="user-permission-management-PUTapi-user--user_id--permission">Update User Permission</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you update a Permission from a User</p>

            <span id="example-requests-PUTapi-user--user_id--permission">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/user/1/permission" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1/permission"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'http://localhost:8000/api/user/1/permission',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1/permission'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-PUTapi-user--user_id--permission">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=pmC0zu9UoPWon10iMW0pF58lvP994Et5v1IxUB0j; expires=Thu, 08 Feb 2024 07:39:20 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-PUTapi-user--user_id--permission" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-PUTapi-user--user_id--permission"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-PUTapi-user--user_id--permission" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-PUTapi-user--user_id--permission" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-PUTapi-user--user_id--permission"></code></pre>
            </span>
            <form id="form-PUTapi-user--user_id--permission" data-method="PUT"
                data-path="api/user/{user_id}/permission" data-authed="1" data-hasfiles="0" data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('PUTapi-user--user_id--permission', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-PUTapi-user--user_id--permission"
                        onclick="tryItOut('PUTapi-user--user_id--permission');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-PUTapi-user--user_id--permission"
                        onclick="cancelTryOut('PUTapi-user--user_id--permission');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-PUTapi-user--user_id--permission" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-darkblue">PUT</small>
                    <b><code>api/user/{user_id}/permission</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="PUTapi-user--user_id--permission" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="PUTapi-user--user_id--permission" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="PUTapi-user--user_id--permission" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="user_id"
                        data-endpoint="PUTapi-user--user_id--permission" value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
            </form>

            <h2 id="user-permission-management-POSTapi-user--user_id--permission">Store User Permission</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you add a Permission to a User</p>

            <span id="example-requests-POSTapi-user--user_id--permission">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/user/1/permission" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1/permission"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8000/api/user/1/permission',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1/permission'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-user--user_id--permission">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=a7sFCmESchjH8NymunvqbJqcgRaRrEXXp12WcNp7; expires=Thu, 08 Feb 2024 07:39:21 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-POSTapi-user--user_id--permission" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-POSTapi-user--user_id--permission"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-user--user_id--permission" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-user--user_id--permission" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-user--user_id--permission"></code></pre>
            </span>
            <form id="form-POSTapi-user--user_id--permission" data-method="POST"
                data-path="api/user/{user_id}/permission" data-authed="1" data-hasfiles="0" data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-user--user_id--permission', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-user--user_id--permission"
                        onclick="tryItOut('POSTapi-user--user_id--permission');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-user--user_id--permission"
                        onclick="cancelTryOut('POSTapi-user--user_id--permission');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-user--user_id--permission" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/user/{user_id}/permission</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="POSTapi-user--user_id--permission" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="POSTapi-user--user_id--permission" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="POSTapi-user--user_id--permission" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="user_id"
                        data-endpoint="POSTapi-user--user_id--permission" value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
            </form>

            <h2 id="user-permission-management-DELETEapi-user--user_id--permission">Destroy User Permission</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you delete a Permission from a User</p>

            <span id="example-requests-DELETEapi-user--user_id--permission">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/user/1/permission" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1/permission"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'http://localhost:8000/api/user/1/permission',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1/permission'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-DELETEapi-user--user_id--permission">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=LkVYf8KA8CxGpwOFujsFOrhziUf5fg7duqEPLJd7; expires=Thu, 08 Feb 2024 07:39:22 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-DELETEapi-user--user_id--permission" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-DELETEapi-user--user_id--permission"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-DELETEapi-user--user_id--permission" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-DELETEapi-user--user_id--permission" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-DELETEapi-user--user_id--permission"></code></pre>
            </span>
            <form id="form-DELETEapi-user--user_id--permission" data-method="DELETE"
                data-path="api/user/{user_id}/permission" data-authed="1" data-hasfiles="0" data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('DELETEapi-user--user_id--permission', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-DELETEapi-user--user_id--permission"
                        onclick="tryItOut('DELETEapi-user--user_id--permission');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-DELETEapi-user--user_id--permission"
                        onclick="cancelTryOut('DELETEapi-user--user_id--permission');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-DELETEapi-user--user_id--permission" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-red">DELETE</small>
                    <b><code>api/user/{user_id}/permission</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="DELETEapi-user--user_id--permission" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="DELETEapi-user--user_id--permission" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="DELETEapi-user--user_id--permission" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="user_id"
                        data-endpoint="DELETEapi-user--user_id--permission" value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
            </form>

            <h1 id="user-role-management">User Role Management</h1>

            <p>APIs for managing a User's Role</p>

            <h2 id="user-role-management-GETapi-user--user_id--role">Get User Roles</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you get a User's Roles</p>

            <span id="example-requests-GETapi-user--user_id--role">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/user/1/role" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1/role"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8000/api/user/1/role',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1/role'
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-user--user_id--role">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=6ze6AlVkfJgxA9KTSrr3PMUxJa0SQd7HSyry6g7K; expires=Thu, 08 Feb 2024 07:39:14 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-user--user_id--role" hidden>
                <blockquote>Received response<span id="execution-response-status-GETapi-user--user_id--role"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-user--user_id--role" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-user--user_id--role" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-user--user_id--role"></code></pre>
            </span>
            <form id="form-GETapi-user--user_id--role" data-method="GET" data-path="api/user/{user_id}/role"
                data-authed="1" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-user--user_id--role', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-user--user_id--role"
                        onclick="tryItOut('GETapi-user--user_id--role');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-user--user_id--role"
                        onclick="cancelTryOut('GETapi-user--user_id--role');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-user--user_id--role" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/user/{user_id}/role</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="GETapi-user--user_id--role" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="GETapi-user--user_id--role" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="GETapi-user--user_id--role" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="user_id"
                        data-endpoint="GETapi-user--user_id--role" value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
            </form>

            <h2 id="user-role-management-POSTapi-user--user_id--role">Add Role to User</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you add a Role to a User.</p>

            <span id="example-requests-POSTapi-user--user_id--role">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/user/1/role" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"slug\": \"wzckxonnsphxkihatdg\"
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1/role"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "slug": "wzckxonnsphxkihatdg"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8000/api/user/1/role',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'slug' =&gt; 'wzckxonnsphxkihatdg',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1/role'
payload = {
    "slug": "wzckxonnsphxkihatdg"
}
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-user--user_id--role">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=cxYJdhhujf60vJzFi0JhDhbsyVXjigtRQ09Xx4Tr; expires=Thu, 08 Feb 2024 07:39:15 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-POSTapi-user--user_id--role" hidden>
                <blockquote>Received response<span id="execution-response-status-POSTapi-user--user_id--role"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-user--user_id--role" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-user--user_id--role" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-user--user_id--role"></code></pre>
            </span>
            <form id="form-POSTapi-user--user_id--role" data-method="POST" data-path="api/user/{user_id}/role"
                data-authed="1" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-user--user_id--role', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-user--user_id--role"
                        onclick="tryItOut('POSTapi-user--user_id--role');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-user--user_id--role"
                        onclick="cancelTryOut('POSTapi-user--user_id--role');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-user--user_id--role" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/user/{user_id}/role</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="POSTapi-user--user_id--role" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="POSTapi-user--user_id--role" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="POSTapi-user--user_id--role" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="user_id"
                        data-endpoint="POSTapi-user--user_id--role" value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="slug"
                        data-endpoint="POSTapi-user--user_id--role" value="wzckxonnsphxkihatdg"
                        data-component="body">
                    <br>
                    <p>Must be at least 2 characters. Must not be greater than 100 characters. Example:
                        <code>wzckxonnsphxkihatdg</code>
                    </p>
                </div>
            </form>

            <h2 id="user-role-management-PUTapi-user--user_id--role">Update Role to User</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>The endpoint lets you update a Role to a User</p>

            <span id="example-requests-PUTapi-user--user_id--role">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/user/1/role" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"slug\": \"xofumt\"
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1/role"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "slug": "xofumt"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'http://localhost:8000/api/user/1/role',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'slug' =&gt; 'xofumt',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1/role'
payload = {
    "slug": "xofumt"
}
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-PUTapi-user--user_id--role">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=hU5IWSOIQhfs5fVzxLnTYDaofFeyDwdby4nwIfVN; expires=Thu, 08 Feb 2024 07:39:16 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-PUTapi-user--user_id--role" hidden>
                <blockquote>Received response<span id="execution-response-status-PUTapi-user--user_id--role"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-PUTapi-user--user_id--role" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-PUTapi-user--user_id--role" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-PUTapi-user--user_id--role"></code></pre>
            </span>
            <form id="form-PUTapi-user--user_id--role" data-method="PUT" data-path="api/user/{user_id}/role"
                data-authed="1" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('PUTapi-user--user_id--role', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-PUTapi-user--user_id--role"
                        onclick="tryItOut('PUTapi-user--user_id--role');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-PUTapi-user--user_id--role"
                        onclick="cancelTryOut('PUTapi-user--user_id--role');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-PUTapi-user--user_id--role" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-darkblue">PUT</small>
                    <b><code>api/user/{user_id}/role</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="PUTapi-user--user_id--role" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="PUTapi-user--user_id--role" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="PUTapi-user--user_id--role" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="user_id"
                        data-endpoint="PUTapi-user--user_id--role" value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="slug"
                        data-endpoint="PUTapi-user--user_id--role" value="xofumt" data-component="body">
                    <br>
                    <p>Must be at least 2 characters. Must not be greater than 20 characters. Example:
                        <code>xofumt</code>
                    </p>
                </div>
            </form>

            <h2 id="user-role-management-DELETEapi-user--user_id--role">Delete a User&#039;s Role</h2>

            <p>
                <small class="badge badge-darkred">requires authentication</small>
            </p>

            <p>This endpoint lets you delete a User's Role</p>

            <span id="example-requests-DELETEapi-user--user_id--role">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/user/1/role" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"slug\": \"nhreydsnqqyh\"
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/user/1/role"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "slug": "nhreydsnqqyh"
};

fetch(url, {
    method: "DELETE",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>


                <div class="php-example">
                    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'http://localhost:8000/api/user/1/role',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {YOUR_AUTH_KEY}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'slug' =&gt; 'nhreydsnqqyh',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
                </div>


                <div class="python-example">
                    <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/user/1/role'
payload = {
    "slug": "nhreydsnqqyh"
}
headers = {
  'Authorization': 'Bearer {YOUR_AUTH_KEY}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('DELETE', url, headers=headers, json=payload)
response.json()</code></pre>
                </div>

            </span>

            <span id="example-responses-DELETEapi-user--user_id--role">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small
                            onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show
                            headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
set-cookie: laravel_restful_api_session=VLheV045IxYOJSRcbyvkP6ExmpzJzJ8lyODuSXc5; expires=Thu, 08 Feb 2024 07:39:17 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-DELETEapi-user--user_id--role" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-DELETEapi-user--user_id--role"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-DELETEapi-user--user_id--role" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-DELETEapi-user--user_id--role" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-DELETEapi-user--user_id--role"></code></pre>
            </span>
            <form id="form-DELETEapi-user--user_id--role" data-method="DELETE" data-path="api/user/{user_id}/role"
                data-authed="1" data-hasfiles="0" data-isarraybody="0" autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('DELETEapi-user--user_id--role', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-DELETEapi-user--user_id--role"
                        onclick="tryItOut('DELETEapi-user--user_id--role');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-DELETEapi-user--user_id--role"
                        onclick="cancelTryOut('DELETEapi-user--user_id--role');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-DELETEapi-user--user_id--role" hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-red">DELETE</small>
                    <b><code>api/user/{user_id}/role</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Authorization" class="auth-value"
                        data-endpoint="DELETEapi-user--user_id--role" value="Bearer {YOUR_AUTH_KEY}"
                        data-component="header">
                    <br>
                    <p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Content-Type"
                        data-endpoint="DELETEapi-user--user_id--role" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none" name="Accept"
                        data-endpoint="DELETEapi-user--user_id--role" value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
                    <small>integer</small>&nbsp;
                    &nbsp;
                    <input type="number" style="display: none" name="user_id"
                        data-endpoint="DELETEapi-user--user_id--role" value="1" data-component="url">
                    <br>
                    <p>The ID of the user. Example: <code>1</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none" name="slug"
                        data-endpoint="DELETEapi-user--user_id--role" value="nhreydsnqqyh" data-component="body">
                    <br>
                    <p>Must be at least 2 characters. Must not be greater than 100 characters. Example:
                        <code>nhreydsnqqyh</code>
                    </p>
                </div>
            </form>




        </div>
        <div class="dark-box">
            <div class="lang-selector">
                <button type="button" class="lang-button" data-language-name="bash">bash</button>
                <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                <button type="button" class="lang-button" data-language-name="php">php</button>
                <button type="button" class="lang-button" data-language-name="python">python</button>
            </div>
        </div>
    </div>
</body>

</html>
