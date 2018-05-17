
<p align="center">
<img src="https://laravel.com/assets/img/components/logo-laravel.svg" height="50">
</p>

# Car Rental

Scalable RESTful API which provides management functionality for car rental network. Authenticated users can choose and rent a car from list of available rental branches.

Web application built on Laravel framework. Authentication implemented with OAuth protocol. 
Also implemented RBAC (Role Based Access Control).
Extended validation rules during order creation ensures that correct price provided by the user.

User with respective access rights has ability to manage any entity of the system including the following:
* users
* user roles/actions
* products
* product types
* countries (in which branches are available)
* cities (in which branches are available)
* branches
* discount system
* rental plans (amount of hours for rent)
* payment types
* payment statuses
* orders

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Installing

1. `git clone git@github.com:michael-ignatiev/car-rental.git project-folder`
2. `composer install && composer update`
3. `php artisan key:generate`
4. `php artisan migrate`
5. `php artisan db:seed`
6. `update db connection credentials in the .env file`

### Installing Passport

* `php artisan passport:install`
* copy generated keys and paste to .env file:
```
PERSONAL_CLIENT_ID=1
PERSONAL_CLIENT_SECRET=xxxxxxxxxxxxxxxxxxxxxxxxxxxxx
PASSWORD_CLIENT_ID=2
PASSWORD_CLIENT_SECRET=xxxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

### Run PHP Server
`php artisan serve`

### Compile assets for React

One time compiling `npm run dev` or runtime compiling `npm run watch`

## Built With

* [Laravel](https://laravel.com/) - The PHP Framework