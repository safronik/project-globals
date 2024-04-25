<h1 align="center">safronik/globals</h1>
<p align="center">
    <strong>A PHP library to ease gaining of PHP global variables</strong>
</p>

# About

This package is about convenient way to operate global variables. It's include few classes to achieve that:

- Server
- Request
- Cookie
- Get
- Post

# Installation

The preferred method of installation is via Composer. Run the following
command to install the package and add it as a requirement to your project's
`composer.json`:

```bash
composer require safronik/globals
```
or just download files or clone repository (in this case you should bother about autoloader)

# Usage

This class caches the values in its own Multiton storage, to prevent multiple filtration.

## Gain variable value 

You can get any of those by simply call:

```php
$get_variable = Get::get('some_Get_variable');
$get_variable = Post::get('some_Post_variable');
$get_variable = Cookie::get('some_Cookie_variable');
$get_variable = Server::get('some_Server_variable');
$get_variable = Request::get('some_Request_variable');
```

## Server

Server class has the method `getHTTPHeaders()`. It will return all the variables in SERVER starts with 'http_' (case insensitive).

```php
$http_headers = Server::getHTTPHeaders();
```

## Cookie

`Cookie` class can also helpful to set a cookie header, unless the headers are sent.

```php
$expires   = 0; 
$path      = ''; 
$domain    = 'some.domain'; 
$secure    = true; 
$http_only = true; 
$same_site = 'Lax'; 

$http_headers = Cookie::set(
    'cookie_name',
    'cookie_value',
    $expires,
    $path,
    $domain,
    $secure,
    $http_only,
    $same_site,
);
```