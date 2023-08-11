# Kings Of Stonks

> ### King of Stonks is a fictional service that retrieves the latest stock prices of a collection ofcompany stocks at the end of each day, and makes them available to its users by an API and scheduled email. The New York Stock Exchange and NASDAQ Exchange close each day at 21:00 UTC.

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/10.x/installation)

Clone the repository

    git clone https://github.com/ZiphoDanca1994/kings-of-stonks.git

Switch to the repo folder

    cd kings-of-stonks

Install all the dependencies using composer

    composer install

Install node modules and compile them

    npm install && npm run dev

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Create database database and run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

(**Set the mail connection in .env**) I am recommending [Mailtrap](https://mailtrap.io)

The King of Stonks service relies on access to a stock api to retrieve its information about stocks. This is a free service and you can easily sign up to receive an [api_key](https://site.financialmodelingprep.com) then set the Api key in .env

    STOCK_API_KEY = *****************

Create dummy users for testing using the below command which takes the number of users parameter 

    php artisan create:users {number}

Install passport 

    php artisan passport:install

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

```
git clone https://github.com/ZiphoDanca1994/kings-of-stonks.git
cd kings-of-stonks
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan passport:install
php artisan serve
```

## Commands

Scheduled daily at 20:55 UTC which retrieves and store stock tickers on local database

    php artisan store:stock-tickers

Scheduled daily at 22:00 UTC which sends the email to all the users with the latest price for the stock tickers

    php artisan send:email

Emails are being send using queue, we need below command to be up and running to listen to queues and send emails

    php artisan queue:listen

Scheduled daily, it deletes the stock tickers that are older than 60 days

    php artisan clean:stock-tickers

----------

# Code overview

## Folders

- `app/Models` - Contains all the Eloquent models
- `app/Console/Commands` - Contains commands for creating users, storing retrieved stock tickers from the api, sending email, cleaning stock tickers older than 60 days
- `app/Http/Controllers` - Contains all the web controllers
- `app/Http/Controllers/Auth` - Contains all the auth controllers
- `app/Http/Controllers/Api` - Contains all the api controllers
- `app/Jobs` - Contains send email job
- `app/Mail` - Contains send email mailable class
- `app/Services` - Contains stock ticker service with the functionality to retrieve the stock ticker from the api and saving it on the database
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `resources/views/email` - Contains the email template
- `resources/views` - Contains application views
- `routes` - Contains all the api routes defined in api.php file and all the web routes defined in web.php
- `tests` - Contains all the application tests

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing API

Run the laravel development server

    php artisan serve

Register API can be accessed at **returns access tocken**

    http://localhost:8000/api/register


| **Required** 	| **Key**              	| **Type**      |
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|                 
| Yes      	| X-Requested-With 	| XMLHttpRequest   	|                 
| Yes     	| name        	    | string         	|                 
| Yes       | email       	    | email            	|                 
| Yes       | password       	| string           	|                 
| Yes       | confirm_password  | string           	|

Login API can be accessed at **returns access tocken**

    http://localhost:8000/api/register


| **Required** 	| **Key**              	| **Type**      |
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|                 
| Yes      	| X-Requested-With 	| XMLHttpRequest   	|                                
| Yes       | email       	    | email            	|                 
| Yes       | password       	| string           	|                 

Retrieve stock price records by GET request api can now be accessed at **returns json**

    http://localhost:8000/api/v4/quote


| **Required** 	| **Key**              	| **Type**      | **Default** |
|----------	|------------------	|------------------	|-----------------|
| Yes      	| Content-Type     	| application/json 	|                 |
| Yes      	| X-Requested-With 	| XMLHttpRequest   	|                 |
| Yes     	| Authorization    	| Bearer {token}   	|                 |
| Yes     	| symbol        	| string         	|                 |
| Optional  | fromDate       	| date             	|                 |
| Optional  | toDate       	    | date             	|                 |
| Optional  | sort       	    | ASC            	| DESC            |

----------
