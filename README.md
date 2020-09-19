# Larachain

Larachain is a blockchain explorer powered by the Ark.io API made by Alfonso Bribiesca powered by the [TALL Stack](https://tallstack.dev/).

[http://larachain.com/](http://larachain.com/)

## Tech stack

As mentioned in the description this project was made by using the TALL Stack:

- TailwindCSS
- Alpine.js
- Laravel
- Livewire

## Features

By using this projects you can:

- List transactions
- List blocks
- List wallets
- See a details page for those 3 elements
- Create an account to change the timezone (used in the charts) and toggle a dark mode

## Installation

To install and run this project follow this steps:

#### 1. Clone the repository

`git clone git@github.com:alfonsobries/larachain.git`

#### 2. Install dependencies

`composer install`

`yarn install`

#### 3. Compile assets

`yarn run dev // or yarn run production` 


#### 4. Copy the .env.example file

`cp .env.example .env` 

#### 5. Generate a laravel key

`php artisan key:generate` 


#### 6. Update the .env files to match your env settings

Pay special attention to the database settings:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

You can also update the API URL for another valid ark API endpoint.

```
ARK_MAINNET=https://explorer.ark.io/api
ARK_DEVNET=https://dexplorer.ark.io/api
```

#### 7. Once the database is set run the migrations

`php artisan migrate` 

#### 8. You re all set,

Just open the application in local enviroment URL and you should see the application:

[http://larachain.test/](http://larachain.test/)


## Testing

For testing this project just run phpunit in your console

`./vendor/bin/phpunit`

