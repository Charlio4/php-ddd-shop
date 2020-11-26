FROM nanoninja/php-fpm:7.4.10

WORKDIR /web

RUN apt update && apt install -y vim curl git iputils-ping telnet && mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

COPY ./php-xdebug.ini /usr/local/etc/php/conf.d/php-xdebug.ini
