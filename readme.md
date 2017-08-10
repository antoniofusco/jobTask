Welcome to my example of rest api to convert integer to roman string in Laravel 5.4

The API is REST API and uses internal laravel authorization for user authentication purposes. 
Currently, return format for all endpoints is JSON.
You can try this api with this simple command:

1) insert in your cmd

php artisan migrate --seed

to create table and seed

2) insert in your cmd
php artisan serve
to launch laravel internal server

3) Access the api with your best tool such as postman , curl ,etc.etc.

http://localhost:8080/api/login

Headers :
Accept : application/json
Content-Type :application/json

Parameters (Backdoor password set in seed)

email: adminapi@test.com
Password : apitest

and retrieve your api_token for the other request


Now you are logged in the api

List of command

1) Retrieve all your past conversion

GET
http://127.0.0.1:8000/api/conversionsapi

Parameters

api_token: your api token 

2) Retrieve last 10 conversion
GET
http://127.0.0.1:8000/api/conversionsapi/show

Parameters

api_token: your api token 

3) Convert a new number
POST
http://127.0.0.1:8000/api/conversionsapi

Parameters

api_token: your api token 
Number: integer to convert

If you wont you can register a new user with this command

POST
http://127.0.0.1:8000/api/register

Parameters

name: Name of the user

email : email of the user

password : password of the user

password_confirmation : confirmation of password

to logout

http://127.0.0.1:8000/api/logout
