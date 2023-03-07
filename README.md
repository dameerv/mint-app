# E-commerce (API)

### Локальный запуск проекта

```
cd ~
git clone git@gitlab.webvork.ru:teledoc/vsezakonno.ru.git bankrot
cd bankrot

docker-compose up -d --build

docker exec -ti ecommerce-api_php_1 bash -c "composer install"
docker exec -ti ecommerce-api_php_1 bash -c "php bin/console doctrine:migrations:migrate --em=main --configuration=config/migrations/doctrine_migrations_main.yaml"
docker exec -ti ecommerce-api_php_1 bash -c "php bin/console doctrine:fixtures:load"
```

Проект можно запустить по адресу:

[localhost:82](http://localhost:82)

### Переменные окружения

`APP_ENV` -- Окружение проекта. Может быть "dev" (локальная разработка), "stage", "prod".

### БД

```
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
```

### Миграции

```
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
```

### Фикстуры

```
php bin/console doctrine:fixtures:load
```

### Код-стайл

```
vendor/bin/phpcbf
vendor/bin/phpcs
```

# Frontend

```
gulp style:build  
gulp style:production   
gulp watch
```

### Sentry

[Geberich Sentry](https://sentry.webvork.net/organizations/sentry/issues/?project=)
