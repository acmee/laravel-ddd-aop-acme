# Acme Laravel DDD AOP 

![Build Status](https://travis-ci.org/acmee/laravel-ddd-aop-acme.svg?branch=master)

## Run the project with docker

### Prerequisites
We use [an automated nginx reverse proxy for docker containers](https://hub.docker.com/r/jwilder/nginx-proxy/) to run the app at `http://acme.dev`.

* [Docker itself](https://www.docker.com)
* dnsmasq
    * MacOS
        * via [brew](https://brew.sh/) 
        ``` 
        brew install dnsmasq
        # find your docker IP, with docker-machine as 'docker-machine ip', or it is just 127.0.0.1
        sudo echo 'address=/dev/YOUR_DOCKER_IP' >> /usr/local/etc/dnsmasq.conf
        sudo mkdir -p /etc/resolver
        echo 'nameserver 127.0.0.1' | sudo tee /etc/resolver/dev
        sudo brew services restart dnsmasq
        # may be restart your computer for the local dns resolver to be recognized
        ```

### How to install and run

To build the application, type ```$ make build``` and navigate to ```http://acme.dev```.

To install composer dependencies, type ```$ make composer <COMPOSER ARGS>```. If you need to pass options (like --prefer-source) to the command, you have to prefix your call with `--`:
``$ make -- composer <COMPOSER ARGS> --prefer-source``

To stop the application, type ```$ make stop```.

To start the application, type ```$ make start``` and navigate to ```http://acme.dev```.

To rebuild the application, type ```$ make rebuild```.

To remove the application and containers, type ```$ make remove```.

To run the php-unit tests, type ```$ make tests```.

To log into the nginx container, type ```$ make app-ssh```.

To tail nginx container logs, type ```$ make app-logs```.

To log into the mysql container, type ```$ make app-mysql```.

To run Laravel artisan, type ```$make artisan <ARTISAN ARGS>```. If you need to pass options (like -h) to the command, you have to prefix your call with `--`:
``$ make -- artisan <ARTISAN ARGS> -h``
