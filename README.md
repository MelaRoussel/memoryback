Utilisation de https://github.com/jmvargas/docker-compose-php-stack.git pour générer une base.

## Requirements

You only need docker and docker-compose installed.

Install [docker](https://docs.docker.com/engine/installation/) and [docker-compose](https://docs.docker.com/compose/install/)

## Run

```
docker-compose up
```

Now, you only have to visit http://localhost:8888 In http://localhost:8888/example.php you can see a little example querying Postgres

## Structure

```
├── app
│   ├── example.php # Example querying database
│   └── index.php # phpinfo
├── docker-compose.yml
├── log # (Created after run docker-compose)
│   ├── nginx # Nginx logs
│   └── php-fmp # PHP logs
├── .data # (Created after run docker-compose)
│   └── db # Database data
├── nginx
│   └── vhost.conf # VirtualHost conf file for Nginx
└── php-fpm
    ├── Dockerfile # PHP docker image, modify it to add PHP extensions, for example
    ├── php-fpm.conf # PHP-fpm conf file
    └── php.ini # php.ini file
```
