# Refactoring Challenge

> This is a demo project, not for production use.

## Installation

```bash
git clone git@github.com:belovai/refactoring-challenge.git

cd refactoring-challenge

cp .env.example .env

docker-compose up -d

docker-compose exec app bash -c "php artisan key:generate"
```

## Usage examples

```bash
docker-compose exec app php artisan process invoice 1 12500
```


```bash
docker-compose exec app php artisan process receipt 354 30000
```


```bash
docker-compose exec app php artisan process proforma 23 10000
```


```bash
docker-compose exec app php artisan process invoice 354 1 --json
```


```bash
docker-compose exec app php artisan process invoice 354 1 --file other.csv
```

## Development

### Code style (pint)

```bash
docker-compose exec app bash -c "./vendor/bin/pint"
```

### Static Analysis (PHPStan)

```bash
docker-compose exec app bash -c "./vendor/bin/phpstan analyse"
```
