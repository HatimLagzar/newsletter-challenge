## Setup

Create your environment file

`cp .env.example .env`

For sending emails, you can use https://MailTrap.io credentials to test.

Copy the credentials given by mailtrap in `.env` file

Create a database and replace the name in `.env`

Generate laravel key

`php artisan key:generate`

Run the migrations

`php artisan migrate`

Seed the database

`php artisan db:seed UserSeeder`

`php artisan db:seed WebsiteSeeder`

Start the server

`php artisan serv`

### Send Newsletter Command
By default, it's scheduled to run daily but you can run it manually using:

`php artisan newsletter:send`

To change the schedule, go to `app/Console/Kernel.php` and change it under the `schedule()` method

### API
He's the postman collection


https://www.postman.com/hatimdev/workspace/nick-challenge/collection/11074314-df274521-69a6-49bc-a8bc-db3f435484d0?ctx=documentation


You're ready to go :)