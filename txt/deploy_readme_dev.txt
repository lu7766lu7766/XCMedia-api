1. copy .env.example as .env
2. configure .env
(2) configure database entry
(3) configure REDIS entry
3. composer install
4. php artisan key:generate
5. php artisan vendor:publish & input 0 to run all publish.
6. php artisan migrate
7. php artisan passport:keys
8. php artisan db:seed
9. php artisan config:cache <== 此指令在你有修改 any config file 時 記得要在執行過,讓laravel cache住
