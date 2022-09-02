# Flight Notifier

A project to study about Clean Architecture and Clean Code.

## Run locally


```bash
docker run -v "$PWD":/app composer composer install --ignore-platform-reqs
docker run -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:7.4-cli  php src/main/getDataApi.php
docker run -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:7.4-cli php src/main/cron.php
```

## Tests

```bash
docker run -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:7.4-cli php vendor/bin/phpunit tests --color
```
