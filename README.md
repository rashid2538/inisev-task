# Steps to Setup
## Install dependencies `composer update`
## Create .env file with proper MySQL and SMTP credentials
## Run command `php artisan migrate:fresh --seed`
## Create some subscribers via post reqeust to `/api/subscribe/` with JSON `{"website_id":1,"user_id":3}` or run `php artisan test` a few times
## Send newsletter with recent posts to all the subscribers using artisan command `php artisan newsletter:send`