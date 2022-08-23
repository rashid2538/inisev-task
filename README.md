# Steps to Setup
## Install dependencies `composer update`
## Create .env file with proper MySQL and SMTP credentials
## Run command `php artisan migrate:fresh --seed`
## Create some subscribers via post reqeust to `/api/1/subscribe/{userId}` or run `php artisan test` a few times
## Send newsletter with latest post form a website (e.g. 1 in this case) using artisan command `php artisan newsletter:send 1`