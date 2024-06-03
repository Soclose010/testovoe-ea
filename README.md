### Тестовое EA
## Для запуска


1. Создать директорию для докера
```
mkdir ./storage/docker
```
2. Скопировать .env.example
```
cp .env.example .env
```
3. Добавить пользователя в .env
```
echo UID=$(id -u) >> .env
echo GID=$(id -g) >> .env
```
4. Запустить сервисы докера
```
docker compose up -d --build
```
5. Установить зависимости
```
docker exec ea-app composer install
```
6. Опубликовать ключ
```
docker exec ea-app php artisan key:generate
```
7. Прописать доступы к БД в файле `.env`
- если нужна локальная
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
```
- если нужна на хостинге
```
DB_CONNECTION=mysql
DB_HOST=server185.hosting.reg.ru
DB_PORT=3306
DB_DATABASE=u2675001_laravel
DB_USERNAME=u2675001_ivan
DB_PASSWORD=yZ0hI2gG1qbJ0nN4
```
6. Сделать миграции
```
docker exec posts-app php artisan migrate --seed
```

## Для теста работы
- через web - 4 роута
```
/sales
/orders
/incomes
/stocks
```
- через консоль
```
docker exec ea-app php artisan app:parse
```
