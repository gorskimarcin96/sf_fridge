# sf_fridge

## Run project

### Set .env file for docker

```sh
cp docker/.env.dist docker/.env
```

### Generate jwt keypair

```sh
cd docker && docker-compose exec php ./bin/console lexik:jwt:generate-keypair
```

### Run docker containers

```sh
cd docker && docker-compose up -d
```

## Tests

### Run phpunits

```sh
cd docker && docker-compose exec php ./bin/phpunit
```
