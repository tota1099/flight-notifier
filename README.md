[![Coverage Status](https://coveralls.io/repos/github/tota1099/flight-notifier/badge.svg?branch=master)](https://coveralls.io/github/tota1099/flight-notifier?branch=master)

# Flight Notifier

A robot that notifies you when a flight is about to land or depart the airport.

## Configure

Create a copy from .env.example to .env and set the values:

```
API_URL="http://api.aviationstack.com/v1"
API_KEY=[YOUR AVIATION STACK KEY]
AIRPORT=[AIRPORT IATA]
NOTIFICATION_MINUTES=[HOW MUCH MINUTES BEFORE YOU WANT TO BE NOTIFIED]

## TELEGRAM
TELEGRAM_CHAT_ID=[TELEGRAM_CHAT_ID]
TELEGRAM_TOKEN_ID=[TELEGRAM_TOKEN_ID]
```

## How to use

### Install dependencies and migrate database

```bash
docker run -v "$PWD":/app composer composer install --prefer-dist --no-progress
docker run -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php vendor/bin/phinx migrate
```

### Run two scripts

#### getDataApi.php

This script get the flights from current day and save in the database.

#### cron.php

This script notifies you about the flights.

```
docker run -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli  php src/main/getDataApi.php
docker run -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php src/main/cron.php
```

## Dependencies

This library depends on PHP version 8.1 or bigger.

## Run tests

```bash
docker run -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli php vendor/bin/phpunit tests --testdox
```
