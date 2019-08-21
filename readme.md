<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Склонировать портал

` git clone https://github.com/ValeryKruglov/valerykruglov.github.io.git finance`

В директории появится папка "finance"

## Выоплнить composer install

Перейти в директорию "finance" и запустить команду `composer install`

## Настройка

В приложениии уже подключена тестовая база данных с 3 пользователями. У всех одинаковый пароль для входа "12345678".
Логины пользователей:
* Valery_Kruglov@test.com
* Petr_Sidelnikov@test.com
* Shirnin_Vasiliy@test.com

Если необходимо подключить свою базу данных, то в корневой директории приложения, в файле .env, нужно задать параметры подключения базы данных:
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=homestead
* DB_USERNAME=homestead
* DB_PASSWORD=secret

Далее сохраняем файл .env и выполняем команду `php artisan migrate`

## Запуск

После выполнения настроек можно запустить команду `php artisan serve` и перейти в браузере по указанной ссылке.

