# Simulation of an ATM 

# preview
![Screenshot from 2023-08-14 02-49-10](https://github.com/keroles19/Atm/assets/36054945/482d566f-6956-4687-8e94-7569312173ab)

<video src="https://user-images.githubusercontent.com/36054945/260335481-00098047-b42a-4afc-be17-fe5c11a1d117.mp4"></video>
## BY
[![Laravel](https://img.shields.io/badge/-Laravel-white?style=flat-square&logo=laravel)](https://github.com/keroles19/)
[![mysql](https://img.shields.io/badge/-mysql-005C84?style=flat-square&logo=mysql&logoColor=white)](https://github.com/keroles19/)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)](https://github.com/keroles19/)
[![HTML5](https://img.shields.io/badge/-HTML5-E34F26?style=flat-square&logo=html5&logoColor=white&link=https://github.com/keroles19/)](https://github.com/keroles19/)
[![CSS3](https://img.shields.io/badge/-CSS3-1572B6?style=flat-square&logo=css3&link=https://github.com/keroles19/)](https://github.com/keroles19/)
[![Bootstrap](https://img.shields.io/badge/-Bootstrap-563D7C?style=flat-square&logo=bootstrap&link=https://github.com/keroles19/)](https://github.com/keroles19/)
[![JQUERY](https://img.shields.io/badge/jQuery-0769AD?style=flat-square&logo=jquery&logoColor=white&link=https://github.com/keroles19/)](https://github.com/keroles19/)
[![JS](https://img.shields.io/badge/-JavaScript-black?style=flat-square&logo=javascript&link=https://github.com/keroles19/)](https://github.com/keroles19/)

# Requirments:
- PHP 8.1 or later.
- MySQL 5.7 or later.

## installation
after clone/ download the project file, `cd` into the project directory and follow the steps below:

- run `composer install` for download the required packages.
- if you don't see the `.env` file please do the following:
    - run `cp .env.example .env` to copy env file.
    - run `php artisan key:generate` to generate new app key.
- run `php artisan migrate` to run database migration.
- run `php artisan db:seed` to run database seeds.
- run `php artisan serve` to run project.

### NOTE
if you get any errors in this step, when seeding the database, realted to exsisting data, please run the following:
- run `chmod ugo=rwx storage -R` to give permissions to storage folder for read/wirte actions.
- run `chown www-data storage -R` for the same reason described above.
- run `php artisan optimize:clear` to reset setting to is last good case.

### NOTE 2
you can run the database commands all together like:
`php artisan migrate:fresh --seed` this will migrate and seed the database.

## TESTING
- runing all tests: `composer test`
- running test with coverage report: `composer test:coverage`


## Clearing configurations and Cache
- run `composer clear:cache`

## Using docker
- install `docker` and `docker-compose`, for Linux [ubuntu] OS, you can user `docker-install.sh` file inside project folder, for windows and mac you can setup docker desktop
- run `docker-compose build app`
- run `docker-compose up -d`
- navigate to `127.0.0.1:8000`
- you're done!
