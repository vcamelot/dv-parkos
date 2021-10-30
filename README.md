## Launch ##

Run `composer update`

Run `php artisan key:generate`

Edit database connection and E-mail settings in `.env`

Run `php artisan migrate`

Run `php artisan db:seed --class=DestinationSeeder`

Run `php artisan serve`

The application API will be available at `http://localhost:8000/api`
