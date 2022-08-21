FROM php:8.0.10-apache-bullseye

COPY php/docker-php-ext-disable /usr/local/bin
RUN chmod +x /usr/local/bin/docker-php-ext-disable

COPY php/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

COPY php/conf.d /usr/local/etc/php/conf.d

WORKDIR /var/www

RUN apt-get --allow-releaseinfo-change update && apt-get install -y --no-install-recommends \
    git libmcrypt-dev libcurl4-openssl-dev libzip-dev libmagickwand-dev openssh-client rsync libxslt-dev gnupg libpq-dev \
    zip unzip htop iputils-ping supervisor vim

RUN pecl install imagick \
    && docker-php-ext-enable imagick

RUN docker-php-ext-install pdo gd ctype curl iconv zip xsl

RUN a2enmod rewrite
#
RUN pecl install xdebug-3.0.3
RUN docker-php-ext-enable xdebug

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt-get install symfony-cli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 80
