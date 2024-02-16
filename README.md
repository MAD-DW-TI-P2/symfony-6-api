# Symfomy 6 API

symfony new init --version=6.4

cd init

composer require symfony/maker-bundle --dev

composer require symfony/orm-pack

php bin/console make:entity

Coder, name, age...

composer require form validator twig-bundle security-csrf

php bin/console make:crud 

En el .env descomento SQlite

php bin/console doctrine:schema:update --force

symfony server:start (pruebo el CRUD)

Para ponerlo bonito, en el head de base: ``<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">``

Crear API: symfony composer require api

Podemos ver la documentación: https://127.0.0.1:8000/api

Para que aparezca, solo tengo que añadir en una entidad: use ApiPlatform\Metadata\ApiResource;

y 

``#[ApiResource(
    description: 'A coder',
)]``

Una API Restfull con Postman: https://127.0.0.1:8000/api/coders

(Fíjate que en .env CORS_ALLOW_ORIGIN='^https?://(localhost|127.0.0.1)(:[0-9]+)?$')

Dentro de poco: Relaciones entre tablar y Login y register desacoplado