# Content API

This API is an exercise to apply anti-corruption pattern along with practicing DDD.

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

Cache keys are generated like using this formula `sourceId_year_limit`, from the request.
    
### 2. Installations

1. Setup project and containers:

    1.1 checkout the project
    
        git clone git@github.com:mnsami/content-api.git
        cd content-api
        
    1.2. copy `parameters.yml`
    
        make
    
    1.3. Start the containers and install dependencies

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

### 4. Helper Make commands

I like to use `make` for my projects, hence below are some helper `make` commands

- `make all`: Start up the container services and install project dependencies.
- `make composer`: Install composer dependencies.
- `make cc`: Remove symfony caches.
- `make clear`: Delete vendor. cache, logs and library binaries.
- `make lint`: Lint all php, yml, json and composer.
- `make phpcs`: Run code sniffer to check styles.
- `make phpcbf`: fix styles.
- `make tests`: Run tests
- `make coverage`: Generate coverage report
- `make tear-down`: Stop all containers and down.
- `make container-up`: Start all container services
- `make container-stop`: Stop all containers services.
- `make container-down`: down all containers.
