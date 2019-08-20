FROM php:7.3-cli-alpine

RUN apk add autoconf gcc g++ make\
  && pecl install apcu \
  && docker-php-ext-enable apcu

RUN cd $(mktemp -d) \
 && curl https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer global require hirak/prestissimo

WORKDIR /home/bench
