
## Тестовый проект на Laravel Framework.

#### Основной функционал:
##### Простейшее API для каталога товаров. Приложение должно содержать:

- Категории товаров

- Конкретные товары, которые принадлежат к какой-то категории (один товар может принадлежать нескольким категориям)

- Пользователей, которые могут авторизоваться

##### Возможные действия:

- Получение списка всех категорий

- Получение списка товаров в конкретной категории

- Авторизация пользователей

- Добавление/Редактирование/Удаление категории (для авторизованных пользователей)

- Добавление/Редактирование/Удаление товара (для авторизованных пользователей)

##### На весь проект ушло около 5 часов. 
- Добавление данных (Миграции, Модели, Сидеры). 30 минут
- Установка и настройка JWT. 1 час
- Подготовка проекта (дополнения для Handler, добавление Casts, Traits, Observers). 1.5-2 часа
- Controllers and Routes. 1 час
- Тестирование API через Postman и исправления. 1 час

**Для _авторизации_ в проекте используется библотека для JWT(JsonWebToken)** https://jwt-auth.readthedocs.io/en/develop/laravel-installation/

**Ссылка на Postman Collection:** https://www.getpostman.com/collections/83c63a576255c6b5f149

## Инструкции для разворачивания.

Необходимы (документация Laravel 7.0):
- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

Также конечно, должно быть установлено одно из баз данных (желательно MYSQL)

#### Установка проекта (пошагово):
```
> git clone https://github.com/arstoktarov/laravel-test-project.git

> cd /path_to_project

> composer install

> copy .env.example .env

> Настроить APP_URL, DB_CONNECTION, DB_DATABASE, DB_PASSWORD в файле .env

> php artisan key:generate

> php artisan jwt:secret

> php artisan migrate

> php artisan db:seed
```
#### Дополнительные объяснения насчет реализации:

- ##### App\Casts: Image
Добавлен для сохранения image и возвращения полного url к image из хранилища.

- ##### App\Observers
При удалении продукта нужно удалить также его картинку из хранилища. 
Для решения этой проблемы был создан ProductObserver

Аналогично с удалением категории, но также вместе с категорией удаляются все его продукты.

- ##### App\Traits: HashesPassword
В трейте HashesPassword есть функция-мутатор для модельки user которая хеширует атрибут password.

- ##### App\Exception\Handler.php
В хендлере добавлены несколько проверок предназначенные для возвращения json вместо html.
