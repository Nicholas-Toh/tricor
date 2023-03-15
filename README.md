## Tricor - Technical Assessment


### Dependencies
1. php 8.1
2. composer 2.5.4
3. npm 9.5

### Installation
1. `git clone` this repository.
2. Run `composer install`.
3. Run `npm build`.
4. Create .env file and customize the fields.
5. Run `php artisan key:generate`
6. Run `php artisan optimize`.
7. Run `php artisan serve`.

### Features
These features were developed in accordance to the requirements specified in the technical assessment document.
#### Common
1. Login
2. Logout

#### Marketing Agent
1. Enter sales transaction
2. View recent sales transactions

#### Manager
1. Retrieve monthly sales reports by date and agent ID.
2. Retrieve yearly sales reports by date and agent ID.
