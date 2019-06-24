# Endouble API

### 1. Frameworks and bundles used
    
1. `Symfony: 3.4`
2. For caching, memcached is used.
3. Nginx
4. php-fpm
    
#### 1.1. Architecture

Memcached is used to cache responses using the request information as cache key.
Caching keys are being cached for 1 day only.

I used the default Symfony Memcached adapter.
https://symfony.com/doc/3.4/components/cache/adapters/memcached_adapter.html     
    
### 2. Installations

1. Setup project and containers:

    1.1 checkout the project
    
        git clone git@github.com:mnsami/endouble-api.git
        cd endouble-api
    
    1.2. Start the containers and install dependencies

        make all

### 3. API Available routes

To make api request use `http://localhost/v1/` as base url.
i.e. `http://localhost/v1/items` 


|  Name|                 Method|   Scheme|   Host|   Path|
|--------------------|--------|--------|------|---------------------|
|  get_items|       GET|     ANY|      ANY|    /v1/items|
|  alive|                GET|      ANY|      ANY|    /v1/_healthCheck|

#### 3.1 Api Documentation

#### 3.1.1`GET /v1/items`
- **Description:** Get items.
- **method**: `GET`
- **Response**: Items list. Request meta information.
- **Url Params**:
  - **sourceId:** Data source, **type:** string, **required:** true
  - **year:** year, **type:** integer, **required:** false
  - **limit:** limit, **type:** integer, **required:** false
