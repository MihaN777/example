<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About

-   Обрабатывать заявки нужно из панели администратора
-   После регестрации, пользователю (ответственному лицу) нужно задать роль (role) администратора в БД (const ROLE_ADMIN = 1), что бы зайти в адми-панель

## Endpointы API:

Тип содержимого запроса должен быть application/x-www-form-urlencoded .
Все текстовые поля должны иметь кодировку Юникод (UTF-8).

Все Endpointы API возвращают статус выполнения (status):

-   ok - успешно, также вернется сообщение о выполнении (message).
-   fail - не выполнено/произошла ошибка, также вернется массив ошибок (errors).

GET /requests - получение заявок ответственным лицом, с фильтрацией по статусу

-   параметр status - enum(“Active”, “Resolved”) (не обязательный).
-   возвращает заявки.

PUT /comment-request - ответ на конкретную задачу ответственным лицом

-   параметр id - (integer) (обязательный).
-   параметр comment - (string) (обязательный).
-   возвращает статус выполнения.

POST /make-request - отправка заявки пользователями системы

-   параметр name - (string) (обязательный).
-   параметр email - (string) (обязательный).
-   параметр message - (string) (обязательный).
-   возвращает статус выполнения.
