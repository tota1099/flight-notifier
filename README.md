[![Coverage Status](https://coveralls.io/repos/github/tota1099/flight-notifier/badge.svg?branch=master)](https://coveralls.io/github/tota1099/flight-notifier?branch=master)

# Flight Notifier

A project to study about Clean Architecture and Clean Code.

## Run locally


```bash
docker run -v "$PWD":/app composer composer install --prefer-dist --no-progress
docker run -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli  php src/main/getDataApi.php
docker run -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php src/main/cron.php
```

## Tests

```bash
docker run -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php vendor/bin/phpunit tests --testdox
```
