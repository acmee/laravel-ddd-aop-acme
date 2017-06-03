# Acme Laravel DDD AOP 

![Build Status](https://travis-ci.org/acmee/laravel-ddd-aop-acme.svg?branch=master)

## Build and run the project with docker

We added a docker configuration for the sake of simplicity (will be removed in the near future and replaced by acme-ansible-docker).

To build the application type ```$ make install``` and navigate to ```http://localhost:8080```.

To start the application type ```$ make start``` and navigate to ```http://localhost:8080```.

To stop the application type ```$ make stop```.

To rebuild the application type ```$ make rebuild```.

To run the php-unit tests, type ```$ make run-tests```.

To log into the nginx container, type ```$ make app-ssh```.

To tail nginx container logs, type ```$ make app-logs```.
