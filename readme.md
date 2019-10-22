Установка
------------------
* Клонировать репозиторий.
```
git clone git@github.com:stepankarasov/laravel58-api-test.git
```

* Изменить конфиг БД или привести базу к формату:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=api_test
DB_USERNAME=root
DB_PASSWORD=root
```

* Затем применить миграции:
```
php artisan migrate
```

* Затем создать oauth2 ключи:
```
php artisan passport:install
```

* Для авторизации понадобится client_id и client_secret.
Можно взять из БД (поля id и secret):
```
php artisan passport:install
```

* Заполнить БД данными
```
php artisan db:seed
```

* Заполнить БД данными
```
php artisan db:seed
```

* Запустить сервер:
```
php artisan serve
```
* Swagger UI доступен по ссылке:
```
http://127.0.0.1:8000/api/documentation
```
