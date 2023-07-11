# What is it

This is a RestApi application with simple functionality, rough operations on authors and books. The application is written using the repository template, tests are written, the sanctum package is used for authentication, swagger is also used to generate ui for api.

# Instalation 

 ```
 git clone https://github.com/Dorero/librarium.git && cd librarium 
 cp env.example env
 composer install
 ```

 # Run

 You must have docker and docker-compose installed on your computer. This command will start the local environment, keep this process in the background, do not close this terminal tab, enter other commands in other terminal tabs.

 ```
 ./vendor/bin/sail up 
 ```

 # Test

Run tests

```
 ./vendor/bin/sail php artisan test
```

# Swagger ui

To view routes in swagger ui, type ```http://localhost:80/api/documentation``` in your browser