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

### Install and run

Run `$ make help` to list available commands.

Run `$ make build` to create containers and install composer dependencies.

Run `$ make migrate` to run database migrations.

Run `$ make stop` to stop all containers.

Run `$ make start` to start all containers.
